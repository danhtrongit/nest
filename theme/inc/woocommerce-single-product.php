<?php
/**
 * Nest WooCommerce Single Product customizations
 *
 * All hooks and template overrides for the single product page.
 *
 * @package Nest
 */

defined( 'ABSPATH' ) || exit;

// ──────────────────────────────────────────────────────────────────────────────
// 1. REMOVE DEFAULT HOOKS (clean up WooCommerce defaults)
// ──────────────────────────────────────────────────────────────────────────────

// Remove default sale flash (we render it inside gallery).
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

// Remove default product meta (SKU, categories, tags) – we have our own.
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

// Remove default short description – we re-add it at a different priority.
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

// Remove default sharing (if any plugin adds it).
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

// Remove default related products from after_single_product_summary (we use our own hook).
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

// Remove default upsell display from after_single_product_summary.
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );


// ──────────────────────────────────────────────────────────────────────────────
// 2. RE-ADD HOOKS WITH NEW PRIORITIES
// ──────────────────────────────────────────────────────────────────────────────

// Summary section - WooCommerce defaults we keep:
// woocommerce_template_single_title      → priority 5  (default, kept)
// woocommerce_template_single_rating     → priority 10 (default, kept)
// woocommerce_template_single_price      → priority 10 → moved to 15
// woocommerce_template_single_add_to_cart→ priority 30 (default, kept)

// Move price from 10 to 15 to make room for meta info.
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 15 );

// Custom hooks inserted in between.
add_action( 'woocommerce_single_product_summary', 'nest_template_single_meta_info', 12 );
add_action( 'woocommerce_single_product_summary', 'nest_template_single_short_description', 20 );
add_action( 'woocommerce_single_product_summary', 'nest_template_single_promotion', 25 );
// add_to_cart stays at 30 (WC default).
add_action( 'woocommerce_single_product_summary', 'nest_template_single_share', 45 );

// Sidebar section.
add_action( 'nest_single_product_sidebar', 'nest_template_single_sidebar', 10 );

// Related products on custom hook.
add_action( 'nest_after_single_product_tabs', 'woocommerce_output_related_products', 20 );


// ──────────────────────────────────────────────────────────────────────────────
// 3. TEMPLATE PART CALLBACKS
// ──────────────────────────────────────────────────────────────────────────────

/**
 * Output product meta info (brand, SKU, stock status).
 */
function nest_template_single_meta_info() {
	get_template_part( 'template-parts/woocommerce/single-product', 'meta' );
}

/**
 * Output short description with custom styling.
 */
function nest_template_single_short_description() {
	woocommerce_template_single_excerpt();
}

/**
 * Output promotion / gift box section.
 */
function nest_template_single_promotion() {
	get_template_part( 'template-parts/woocommerce/single-product', 'promotion' );
}

/**
 * Output social share and wishlist.
 */
function nest_template_single_share() {
	get_template_part( 'template-parts/woocommerce/single-product', 'share' );
}

/**
 * Output product sidebar (specs + recently viewed).
 */
function nest_template_single_sidebar() {
	get_template_part( 'template-parts/woocommerce/single-product', 'sidebar' );
}


// ──────────────────────────────────────────────────────────────────────────────
// 4. BREADCRUMB CUSTOMIZATION
// ──────────────────────────────────────────────────────────────────────────────

/**
 * Customize WooCommerce breadcrumb defaults for Tailwind styling.
 *
 * @param array $defaults Default breadcrumb args.
 * @return array
 */
function nest_wc_breadcrumb_defaults( $defaults ) {
	$defaults['wrap_before'] = '<nav class="woocommerce-breadcrumb py-3 mb-5 text-sm text-gray-500" aria-label="Breadcrumb"><div class="container mx-auto px-4"><ol class="flex flex-wrap items-center gap-1">';
	$defaults['wrap_after']  = '</ol></div></nav>';
	$defaults['before']      = '<li class="breadcrumb-item">';
	$defaults['after']       = '</li>';
	$defaults['delimiter']   = '<li class="breadcrumb-separator text-gray-300 mx-1"><svg width="6" height="10" viewBox="0 0 6 10" fill="currentColor"><path d="M1.4 0L0 1.4 3.6 5 0 8.6 1.4 10l5-5z"/></svg></li>';

	return $defaults;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'nest_wc_breadcrumb_defaults' );


// ──────────────────────────────────────────────────────────────────────────────
// 5. PRODUCT TABS CUSTOMIZATION
// ──────────────────────────────────────────────────────────────────────────────

/**
 * Customize product tabs - rename and add "Buying Guide" tab.
 *
 * @param array $tabs Default product tabs.
 * @return array
 */
function nest_product_tabs( $tabs ) {
	// Rename description tab.
	if ( isset( $tabs['description'] ) ) {
		$tabs['description']['title'] = __( 'Mô tả sản phẩm', 'nest' );
	}

	// Rename reviews tab.
	if ( isset( $tabs['reviews'] ) ) {
		$tabs['reviews']['title'] = __( 'Đánh giá', 'nest' );
	}

	// Rename additional information tab.
	if ( isset( $tabs['additional_information'] ) ) {
		$tabs['additional_information']['title'] = __( 'Thông tin bổ sung', 'nest' );
	}

	// Add buying guide tab.
	$buying_guide = get_option( 'nest_buying_guide', '' );
	if ( ! $buying_guide ) {
		// Default buying guide content.
		$buying_guide = '<p><strong>Bước 1</strong>: Truy cập website và lựa chọn sản phẩm cần mua để mua hàng</p>
		<p><strong>Bước 2</strong>: Click vào sản phẩm muốn mua, chọn số lượng và nhấn "Thêm vào giỏ" hoặc "Mua ngay"</p>
		<p><strong>Bước 3</strong>: Điền các thông tin của bạn để nhận đơn hàng</p>
		<p><strong>Bước 4</strong>: Lựa chọn hình thức thanh toán và vận chuyển cho đơn hàng</p>
		<p><strong>Bước 5</strong>: Xem lại thông tin đặt hàng và gửi đơn hàng</p>
		<p>Sau khi nhận được đơn hàng, chúng tôi sẽ liên hệ để xác nhận lại đơn hàng và địa chỉ của bạn.</p>
		<p>Trân trọng cảm ơn.</p>';
	}

	$tabs['buying_guide'] = array(
		'title'    => __( 'Hướng dẫn mua hàng', 'nest' ),
		'priority' => 25,
		'callback' => 'nest_buying_guide_tab_content',
	);

	return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'nest_product_tabs' );

/**
 * Buying guide tab content callback.
 */
function nest_buying_guide_tab_content() {
	$content = get_option( 'nest_buying_guide', '' );
	if ( ! $content ) {
		$content = '<p><strong>Bước 1</strong>: Truy cập website và lựa chọn sản phẩm cần mua để mua hàng</p>
		<p><strong>Bước 2</strong>: Click vào sản phẩm muốn mua, chọn số lượng và nhấn "Thêm vào giỏ" hoặc "Mua ngay"</p>
		<p><strong>Bước 3</strong>: Điền các thông tin của bạn để nhận đơn hàng</p>
		<p><strong>Bước 4</strong>: Lựa chọn hình thức thanh toán và vận chuyển cho đơn hàng</p>
		<p><strong>Bước 5</strong>: Xem lại thông tin đặt hàng và gửi đơn hàng</p>
		<p>Sau khi nhận được đơn hàng, chúng tôi sẽ liên hệ để xác nhận lại đơn hàng và địa chỉ của bạn.</p>
		<p>Trân trọng cảm ơn.</p>';
	}
	echo '<div class="prose prose-neutral max-w-none text-gray-700 leading-relaxed">';
	echo wp_kses_post( $content );
	echo '</div>';
}

/**
 * Remove description heading (we handle it in the tab).
 */
add_filter( 'woocommerce_product_description_heading', '__return_empty_string' );


// ──────────────────────────────────────────────────────────────────────────────
// 6. RELATED PRODUCTS CONFIGURATION
// ──────────────────────────────────────────────────────────────────────────────

/**
 * Customize related products args.
 *
 * @param array $args Related products args.
 * @return array
 */
function nest_related_products_args( $args ) {
	$args['posts_per_page'] = 8;
	$args['columns']        = 4;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'nest_related_products_args' );

/**
 * Customize related products heading.
 */
add_filter( 'woocommerce_product_related_products_heading', function () {
	return __( 'Sản phẩm liên quan', 'nest' );
} );


// ──────────────────────────────────────────────────────────────────────────────
// 7. PRODUCT GALLERY SCRIPTS (Swiper)
// ──────────────────────────────────────────────────────────────────────────────

/**
 * Enqueue single product Swiper gallery, tabs scripts, and GLightbox init.
 */
function nest_single_product_scripts() {
	if ( ! is_product() ) {
		return;
	}

	// Swiper is already enqueued globally. Add the product gallery init.
	wp_add_inline_script( 'swiper', nest_get_product_gallery_script(), 'after' );

	// GLightbox initialization.
	wp_add_inline_script( 'glightbox', nest_get_lightbox_script(), 'after' );
}
add_action( 'wp_enqueue_scripts', 'nest_single_product_scripts', 20 );

/**
 * Returns the inline JavaScript for the product gallery Swiper and tabs.
 *
 * @return string
 */
function nest_get_product_gallery_script() {
	ob_start();
	?>
	document.addEventListener('DOMContentLoaded', function() {
		// ── Product Gallery Swiper ──
		var galleryThumbs = null;
		var galleryTop = null;

		var thumbsEl = document.querySelector('.gallery-thumbs');
		if (thumbsEl) {
			galleryThumbs = new Swiper('.gallery-thumbs', {
				spaceBetween: 10,
				slidesPerView: 5,
				freeMode: true,
				watchSlidesProgress: true,
				navigation: {
					nextEl: '.gallery-thumbs .swiper-button-next',
					prevEl: '.gallery-thumbs .swiper-button-prev',
				},
				breakpoints: {
					0: { slidesPerView: 4, spaceBetween: 8 },
					768: { slidesPerView: 5, spaceBetween: 10 },
				}
			});
		}

		var topEl = document.querySelector('.gallery-top');
		if (topEl) {
			galleryTop = new Swiper('.gallery-top', {
				spaceBetween: 0,
				thumbs: {
					swiper: galleryThumbs,
				},
			});
		}

		// ── Product Tabs ──
		var tabWrapper = document.querySelector('[data-product-tabs]');
		if (tabWrapper) {
			var tabLinks = tabWrapper.querySelectorAll('.tabs li');
			var tabPanels = tabWrapper.querySelectorAll('.wc-tab');

			tabLinks.forEach(function(tabLink) {
				tabLink.addEventListener('click', function(e) {
					e.preventDefault();
					var targetId = this.querySelector('a').getAttribute('href');

					// Update tab links.
					tabLinks.forEach(function(link) {
						link.classList.remove('active');
						var a = link.querySelector('a');
						a.classList.remove('text-primary', 'border-primary');
						a.classList.add('text-gray-500', 'border-transparent');
					});
					this.classList.add('active');
					var activeA = this.querySelector('a');
					activeA.classList.remove('text-gray-500', 'border-transparent');
					activeA.classList.add('text-primary', 'border-primary');

					// Update tab panels.
					tabPanels.forEach(function(panel) {
						panel.classList.add('hidden');
					});
					var target = tabWrapper.querySelector(targetId);
					if (target) {
						target.classList.remove('hidden');
					}
				});
			});
		}

		// ── Show More / Show Less (Mobile) ──
		var showMoreBtns = document.querySelectorAll('[data-show-more] button');
		showMoreBtns.forEach(function(btn) {
			var content = btn.closest('.wc-tab').querySelector('.product-description');
			if (!content) return;

			// Initially limit height on mobile.
			if (window.innerWidth < 1024) {
				content.style.maxHeight = '400px';
				content.style.overflow = 'hidden';
				content.style.transition = 'max-height 0.3s ease';
			}

			var expanded = false;
			btn.addEventListener('click', function() {
				expanded = !expanded;
				if (expanded) {
					content.style.maxHeight = content.scrollHeight + 'px';
					btn.querySelector('.more-text').classList.add('hidden');
					btn.querySelector('.less-text').classList.remove('hidden');
				} else {
					content.style.maxHeight = '400px';
					btn.querySelector('.more-text').classList.remove('hidden');
					btn.querySelector('.less-text').classList.add('hidden');
				}
			});
		});

		// ── Related Products Swiper ──
		var relatedEl = document.querySelector('.swiper-related-products');
		if (relatedEl) {
			new Swiper('.swiper-related-products', {
				slidesPerView: 2,
				spaceBetween: 16,
				navigation: {
					nextEl: '.swiper-related-products .swiper-button-next',
					prevEl: '.swiper-related-products .swiper-button-prev',
				},
				breakpoints: {
					640: { slidesPerView: 2, spaceBetween: 16 },
					768: { slidesPerView: 3, spaceBetween: 16 },
					1024: { slidesPerView: 4, spaceBetween: 20 },
					1280: { slidesPerView: 5, spaceBetween: 20 },
				}
			});
		}

		// ── Recently Viewed Products (localStorage) ──
		var productData = {
			id: document.querySelector('.product')?.dataset?.productId || '',
			title: document.querySelector('.product_title')?.textContent?.trim() || '',
			url: window.location.pathname,
			image: document.querySelector('.gallery-top .swiper-slide img')?.src || '',
			price: document.querySelector('.price-box .woocommerce-Price-amount')?.textContent?.trim() || ''
		};

		if (productData.id || productData.url) {
			var viewedKey = 'nest_recently_viewed';
			var viewed = [];
			try { viewed = JSON.parse(localStorage.getItem(viewedKey)) || []; } catch(e) {}

			// Remove duplicate.
			viewed = viewed.filter(function(item) { return item.url !== productData.url; });

			// Add to beginning.
			viewed.unshift(productData);

			// Limit to 10 items.
			if (viewed.length > 10) viewed = viewed.slice(0, 10);

			localStorage.setItem(viewedKey, JSON.stringify(viewed));

			// Render recently viewed in sidebar (exclude current).
			var container = document.querySelector('[data-recently-viewed]');
			if (container) {
				var others = viewed.filter(function(item) { return item.url !== productData.url; }).slice(0, 6);
				if (others.length > 0) {
					container.classList.remove('hidden');
					var content = container.querySelector('.recently-viewed-content');
					others.forEach(function(item) {
						var html = '<a href="' + item.url + '" class="flex items-center gap-3 p-2 rounded-lg hover:bg-gray-50 transition-colors duration-200">';
						html += '<img src="' + item.image + '" alt="' + item.title + '" class="w-16 h-16 object-cover rounded-md flex-shrink-0" loading="lazy">';
						html += '<div class="min-w-0"><p class="text-sm font-medium text-gray-800 line-clamp-2">' + item.title + '</p>';
						if (item.price) {
							html += '<span class="text-sm font-bold text-red-600">' + item.price + '</span>';
						}
						html += '</div></a>';
						content.insertAdjacentHTML('beforeend', html);
					});
				}
			}
		}
	});
	<?php
	return ob_get_clean();
}

/**
 * Returns the inline JavaScript for the product GLightbox initialization.
 *
 * @return string
 */
function nest_get_lightbox_script() {
	ob_start();
	?>
	document.addEventListener('DOMContentLoaded', function() {
		if (typeof GLightbox === 'undefined') return;

		var lightbox = GLightbox({
			selector: '.glightbox',
			touchNavigation: true,
			loop: true,
			closeOnOutsideClick: true,
			draggable: true,
			zoomable: true,
			openEffect: 'fade',
			closeEffect: 'fade',
			cssEfects: { fade: { in: 'fadeIn', out: 'fadeOut' } },
		});

		// Sync: when lightbox opens/navigates, sync Swiper to the same slide.
		lightbox.on('slide_changed', function(data) {
			var galleryTop = document.querySelector('.gallery-top')?.swiper;
			if (galleryTop && data.current && typeof data.current.index !== 'undefined') {
				galleryTop.slideTo(data.current.index);
			}
		});

		// Zoom hint button: click opens lightbox at current Swiper slide.
		var zoomBtn = document.querySelector('.glightbox-trigger');
		if (zoomBtn) {
			zoomBtn.addEventListener('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				var galleryTop = document.querySelector('.gallery-top')?.swiper;
				var activeIndex = galleryTop ? galleryTop.activeIndex : 0;
				lightbox.openAt(activeIndex);
			});
		}
	});
	<?php
	return ob_get_clean();
}


// ──────────────────────────────────────────────────────────────────────────────
// 8. PRODUCT GALLERY ZOOM & LIGHTBOX SUPPORT
// ──────────────────────────────────────────────────────────────────────────────

/**
 * Disable default WooCommerce gallery features (we use Swiper instead).
 */
function nest_disable_wc_gallery_features() {
	remove_theme_support( 'wc-product-gallery-zoom' );
	remove_theme_support( 'wc-product-gallery-lightbox' );
	remove_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'nest_disable_wc_gallery_features', 100 );


// ──────────────────────────────────────────────────────────────────────────────
// 9. CUSTOM WC STAR RATING CSS (inline)
// ──────────────────────────────────────────────────────────────────────────────

/**
 * Add minimal star rating CSS for WooCommerce since default styles are removed.
 */
function nest_wc_star_rating_css() {
	if ( ! is_product() && ! is_shop() && ! is_product_category() ) {
		return;
	}
	?>
	<style>
		.star-rating {
			position: relative;
			display: inline-block;
			font-size: 14px;
			line-height: 1;
			overflow: hidden;
		}
		.star-rating::before {
			content: "\2605\2605\2605\2605\2605";
			color: #d1d5db;
			letter-spacing: 2px;
		}
		.star-rating span {
			position: absolute;
			top: 0;
			left: 0;
			overflow: hidden;
			white-space: nowrap;
		}
		.star-rating span::before {
			content: "\2605\2605\2605\2605\2605";
			color: #facc15;
			letter-spacing: 2px;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'nest_wc_star_rating_css' );


// ──────────────────────────────────────────────────────────────────────────────
// 10. CATALOG ORDERING (Vietnamese labels for sort options)
// ──────────────────────────────────────────────────────────────────────────────

/**
 * Customize WooCommerce catalog ordering options with Vietnamese labels.
 *
 * @param array $options Default ordering options.
 * @return array
 */
function nest_wc_catalog_orderby( $options ) {
	$options = array(
		'menu_order' => __( 'Mặc định', 'nest' ),
		'date'       => __( 'Hàng mới', 'nest' ),
		'price'      => __( 'Giá thấp đến cao', 'nest' ),
		'price-desc' => __( 'Giá cao đến thấp', 'nest' ),
	);
	return $options;
}
add_filter( 'woocommerce_catalog_orderby', 'nest_wc_catalog_orderby' );
