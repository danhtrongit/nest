<?php
/**
 * Nest functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Nest
 */

if ( ! defined( 'NEST_VERSION' ) ) {
	/*
	 * Set the theme’s version number.
	 *
	 * This is used primarily for cache busting. If you use `npm run bundle`
	 * to create your production build, the value below will be replaced in the
	 * generated zip file with a timestamp, converted to base 36.
	 */
	define( 'NEST_VERSION', '0.1.0' );
}

if ( ! defined( 'NEST_TYPOGRAPHY_CLASSES' ) ) {
	/*
	 * Set Tailwind Typography classes for the front end, block editor and
	 * classic editor using the constant below.
	 *
	 * For the front end, these classes are added by the `nest_content_class`
	 * function. You will see that function used everywhere an `entry-content`
	 * or `page-content` class has been added to a wrapper element.
	 *
	 * For the block editor, these classes are converted to a JavaScript array
	 * and then used by the `./javascript/block-editor.js` file, which adds
	 * them to the appropriate elements in the block editor (and adds them
	 * again when they’re removed.)
	 *
	 * For the classic editor (and anything using TinyMCE, like Advanced Custom
	 * Fields), these classes are added to TinyMCE’s body class when it
	 * initializes.
	 */
	define(
		'NEST_TYPOGRAPHY_CLASSES',
		'prose prose-neutral max-w-none prose-a:text-primary'
	);
}

if ( ! function_exists( 'nest_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function nest_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Nest, use a find and replace
		 * to change 'nest' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'nest', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1'        => __( 'Primary', 'nest' ),
				'category-menu' => __( 'Category Menu', 'nest' ),
				'footer-policy' => __( 'Footer - Chính sách', 'nest' ),
				'footer-guide'  => __( 'Footer - Hướng dẫn', 'nest' ),
				'menu-2'        => __( 'Footer Menu', 'nest' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add WooCommerce support.
		add_theme_support( 'woocommerce' );

		// Remove support for block templates.
		remove_theme_support( 'block-templates' );
	}
endif;
add_action( 'after_setup_theme', 'nest_setup' );

/**
 * Force Classic Editor everywhere: posts, pages, and widgets.
 */
// Disable Gutenberg for all post types.
add_filter( 'use_block_editor_for_post', '__return_false', 10 );

// Disable block-based widget editor → revert to classic widgets.
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
add_filter( 'use_widgets_block_editor', '__return_false' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function nest_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer', 'nest' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'nest' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer - Payment', 'nest' ),
			'id'            => 'footer-payment',
			'description'   => __( 'Add payment method images here.', 'nest' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="sr-only">',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer - Certification', 'nest' ),
			'id'            => 'footer-certification',
			'description'   => __( 'Add certification badges here.', 'nest' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="sr-only">',
			'after_title'   => '</h4>',
		)
	);
}
add_action( 'widgets_init', 'nest_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function nest_scripts() {
	wp_enqueue_style( 'nest-google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto+Slab:wght@100..900&display=swap', array(), null );
	wp_enqueue_style( 'nest-style', get_stylesheet_uri(), array( 'nest-google-fonts' ), NEST_VERSION );
	wp_enqueue_script( 'nest-script', get_template_directory_uri() . '/js/script.min.js', array(), NEST_VERSION, true );

	// Localize AJAX for product tab switching.
	wp_localize_script( 'nest-script', 'nestAjax', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'nest_ajax_nonce' ),
	) );

	wp_enqueue_style( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11' );
	wp_enqueue_script( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11', true );

	// GLightbox – product image lightbox gallery (single product only).
	if ( is_product() ) {
		wp_enqueue_style( 'glightbox', 'https://cdn.jsdelivr.net/npm/glightbox@3/dist/css/glightbox.min.css', array(), '3' );
		wp_enqueue_script( 'glightbox', 'https://cdn.jsdelivr.net/npm/glightbox@3/dist/js/glightbox.min.js', array(), '3', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'nest_scripts' );

/**
 * Enqueue the block editor script.
 */
function nest_enqueue_block_editor_script() {
	wp_enqueue_style( 'nest-google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto+Slab:wght@100..900&display=swap', array(), null );

	$current_screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;

	if (
		$current_screen &&
		$current_screen->is_block_editor() &&
		'widgets' !== $current_screen->id
	) {
		wp_enqueue_script(
			'nest-editor',
			get_template_directory_uri() . '/js/block-editor.min.js',
			array(
				'wp-blocks',
				'wp-edit-post',
			),
			NEST_VERSION,
			true
		);
		wp_add_inline_script( 'nest-editor', "tailwindTypographyClasses = '" . esc_attr( NEST_TYPOGRAPHY_CLASSES ) . "'.split(' ');", 'before' );
	}
}
add_action( 'enqueue_block_assets', 'nest_enqueue_block_editor_script' );

/**
 * Add the Tailwind Typography classes to TinyMCE.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */
function nest_tinymce_add_class( $settings ) {
	$settings['body_class'] = NEST_TYPOGRAPHY_CLASSES;
	return $settings;
}
add_filter( 'tiny_mce_before_init', 'nest_tinymce_add_class' );

/**
 * Limit the block editor to heading levels supported by Tailwind Typography.
 *
 * @param array  $args Array of arguments for registering a block type.
 * @param string $block_type Block type name including namespace.
 * @return array
 */
function nest_modify_heading_levels( $args, $block_type ) {
	if ( 'core/heading' !== $block_type ) {
		return $args;
	}

	// Remove <h1>, <h5> and <h6>.
	$args['attributes']['levelOptions']['default'] = array( 2, 3, 4 );

	return $args;
}
add_filter( 'register_block_type_args', 'nest_modify_heading_levels', 10, 2 );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

require get_template_directory() . '/inc/class-nest-nav-walker.php';
require get_template_directory() . '/inc/class-nest-category-walker.php';

/**
 * Theme settings (admin page + nest_get_option helper).
 */
require get_template_directory() . '/inc/theme-settings.php';

/**
 * Homepage section widgets.
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Legacy Customizer settings – kept for backward-compatibility but
 * values are now managed via Appearance > Nest Settings.
 * The nest_migrate_customizer_to_options() function in theme-settings.php
 * handles one-time migration of any existing Customizer values.
 */

/**
 * WooCommerce wrappers and customizations.
 *
 * The <main> + container wrapper is handled directly in woocommerce.php,
 * so we only need to remove the default WC wrappers and sidebar.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );

function nest_dequeue_wc_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );
	unset( $enqueue_styles['woocommerce-layout'] );
	unset( $enqueue_styles['woocommerce-smallscreen'] );
	return $enqueue_styles;
}
add_filter( 'woocommerce_enqueue_styles', 'nest_dequeue_wc_styles' );

function nest_dequeue_wc_block_styles() {
	wp_deregister_style( 'wc-blocks-style' );
	wp_dequeue_style( 'select2' );
}
add_action( 'wp_enqueue_scripts', 'nest_dequeue_wc_block_styles', 200 );

function nest_quantity_buttons_script() {
	if ( ! is_cart() && ! is_product() ) {
		return;
	}
	?>
	<script>
	document.addEventListener('click', function(e) {
		var btn = e.target.closest('.qty-btn');
		if (!btn) return;
		var wrap = btn.closest('.quantity');
		var input = wrap.querySelector('.qty');
		if (!input) return;
		var val = parseFloat(input.value) || 0;
		var step = parseFloat(input.getAttribute('step')) || 1;
		var min = parseFloat(input.getAttribute('min')) || 0;
		var max = parseFloat(input.getAttribute('max')) || Infinity;
		var newVal = btn.classList.contains('qty-minus') ? Math.max(min, val - step) : Math.min(max, val + step);
		input.value = newVal;
		var name = input.getAttribute('name');
		if (name) {
			document.querySelectorAll('input[name="' + name + '"]').forEach(function(el) {
				el.value = newVal;
			});
		}
		if (typeof jQuery !== 'undefined') {
			jQuery('input[name="' + name + '"]').trigger('change');
		} else {
			input.dispatchEvent(new Event('change', { bubbles: true }));
		}
	});
	</script>
	<?php
}
add_action( 'wp_footer', 'nest_quantity_buttons_script' );

/**
 * WooCommerce Single Product customizations.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce-single-product.php';
}

/**
 * AJAX handler for product tab switching on the homepage.
 */
add_action( 'wp_ajax_nest_load_products', 'nest_ajax_load_products' );
add_action( 'wp_ajax_nopriv_nest_load_products', 'nest_ajax_load_products' );

function nest_ajax_load_products() {
	check_ajax_referer( 'nest_ajax_nonce', 'nonce' );

	if ( ! class_exists( 'WooCommerce' ) ) {
		wp_die();
	}

	$cat_id   = isset( $_POST['cat_id'] ) ? absint( $_POST['cat_id'] ) : 0;
	$per_page = 8;

	if ( ! $cat_id ) {
		wp_die();
	}

	$products = new WP_Query( array(
		'post_type'      => 'product',
		'posts_per_page' => $per_page,
		'post_status'    => 'publish',
		'tax_query'      => array(
			array(
				'taxonomy' => 'product_cat',
				'field'    => 'term_id',
				'terms'    => $cat_id,
			),
		),
	) );

	if ( $products->have_posts() ) :
		?>
		<div class="swiper product-slider">
			<div class="swiper-wrapper">
				<?php
				while ( $products->have_posts() ) :
					$products->the_post();
					global $product;
					$permalink     = get_permalink( $product->get_id() );
					$title         = get_the_title( $product->get_id() );
					$image         = $product->get_image( 'woocommerce_thumbnail', array( 'class' => 'duration-300 w-full h-auto', 'loading' => 'lazy' ) );
					$regular_price = $product->get_regular_price();
					$sale_price    = $product->get_sale_price();
					$is_on_sale    = $product->is_on_sale();

					$percent = 0;
					if ( $is_on_sale && (float) $regular_price > 0 ) {
						if ( $product->is_type( 'variable' ) ) {
							$rp = (float) $product->get_variation_regular_price( 'max' );
							$sp = (float) $product->get_variation_sale_price( 'min' );
						} else {
							$rp = (float) $regular_price;
							$sp = (float) $sale_price;
						}
						$percent = round( ( ( $rp - $sp ) / $rp ) * 100 );
					}

					$promotions = array();
					if ( function_exists( 'get_field' ) ) {
						$acf_promos = get_field( 'product_promotions', $product->get_id() );
						if ( $acf_promos && is_array( $acf_promos ) ) {
							foreach ( $acf_promos as $promo ) {
								if ( ! empty( $promo['promotion_text'] ) ) {
									$promotions[] = $promo['promotion_text'];
								}
							}
						}
					}
					if ( empty( $promotions ) ) {
						$meta_promos = get_post_meta( $product->get_id(), 'nest_product_promotions', true );
						if ( $meta_promos ) {
							$promotions = array_filter( array_map( 'trim', preg_split( '/[\n,]+/', $meta_promos ) ) );
						}
					}
					?>
					<div class="swiper-slide">
						<div class="item_product_main">
							<div class="product-action item-product-main duration-300">
								<?php if ( $is_on_sale && $percent > 0 ) : ?>
									<span class="flash-sale">-<?php echo esc_html( $percent ); ?>%</span>
								<?php endif; ?>

								<?php if ( ! empty( $promotions ) ) : ?>
									<div class="tag-promo" title="<?php esc_attr_e( 'Quà tặng', 'nest' ); ?>">
										<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 512 512"><path d="M152 0H154.2C186.1 0 215.7 16.91 231.9 44.45L256 85.46L280.1 44.45C296.3 16.91 325.9 0 357.8 0H360C408.6 0 448 39.4 448 88C448 102.4 444.5 115.1 438.4 128H480C497.7 128 512 142.3 512 160V224C512 241.7 497.7 256 480 256H32C14.33 256 0 241.7 0 224V160C0 142.3 14.33 128 32 128H73.6C67.46 115.1 64 102.4 64 88C64 39.4 103.4 0 152 0zM32 288H224V512H80C53.49 512 32 490.5 32 464V288zM288 512V288H480V464C480 490.5 458.5 512 432 512H288z"></path></svg>
										<div class="promotion-content">
											<div class="line-clamp-5-new">
												<?php foreach ( $promotions as $promo ) : ?>
													<p><?php echo wp_kses_post( '- ' . $promo ); ?></p>
												<?php endforeach; ?>
											</div>
										</div>
									</div>
								<?php endif; ?>

								<div class="product-thumbnail">
									<a class="image_thumb scale_hover" href="<?php echo esc_url( $permalink ); ?>" title="<?php echo esc_attr( $title ); ?>">
										<?php echo $image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									</a>
								</div>

								<div class="product-info">
									<div class="name-price">
										<h3 class="product-name line-clamp-2-new">
											<a href="<?php echo esc_url( $permalink ); ?>" title="<?php echo esc_attr( $title ); ?>"><?php echo esc_html( $title ); ?></a>
										</h3>
										<div class="product-price-cart">
											<?php if ( $is_on_sale ) : ?>
												<span class="compare-price"><?php echo wp_kses_post( wc_price( $regular_price ) ); ?></span>
												<span class="price"><?php echo wp_kses_post( wc_price( $sale_price ) ); ?></span>
											<?php elseif ( $product->get_price() ) : ?>
												<span class="price"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
											<?php else : ?>
												<span class="price"><?php esc_html_e( 'Liên hệ', 'nest' ); ?></span>
											<?php endif; ?>
										</div>
									</div>
									<div class="product-button">
										<?php if ( $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() ) : ?>
											<a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" data-quantity="1" class="btn-cart btn-views add_to_cart btn btn-primary ajax_add_to_cart" data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" title="<?php esc_attr_e( 'Thêm vào giỏ hàng', 'nest' ); ?>">
												<span><?php esc_html_e( 'Thêm vào giỏ', 'nest' ); ?></span>
												<svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 32 32"><g><g><path d="m23.8 30h-15.6c-3.3 0-6-2.7-6-6v-.2l.6-16c.1-3.3 2.8-5.8 6-5.8h14.4c3.2 0 5.9 2.5 6 5.8l.6 16c.1 1.6-.5 3.1-1.6 4.3s-2.6 1.9-4.2 1.9c0 0-.1 0-.2 0zm-15-26c-2.2 0-3.9 1.7-4 3.8l-.6 16.2c0 2.2 1.8 4 4 4h15.8c1.1 0 2.1-.5 2.8-1.3s1.1-1.8 1.1-2.9l-.6-16c-.1-2.2-1.8-3.8-4-3.8z"></path></g><g><path d="m16 14c-3.9 0-7-3.1-7-7 0-.6.4-1 1-1s1 .4 1 1c0 2.8 2.2 5 5 5s5-2.2 5-5c0-.6.4-1 1-1s1 .4 1 1c0 3.9-3.1 7-7 7z"></path></g></g></svg>
											</a>
										<?php else : ?>
											<a href="<?php echo esc_url( $permalink ); ?>" class="btn-cart btn-views btn btn-primary" title="<?php esc_attr_e( 'Tùy chọn', 'nest' ); ?>">
												<span><?php esc_html_e( 'Tùy chọn', 'nest' ); ?></span>
												<svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 32 32"><g><g><path d="m23.8 30h-15.6c-3.3 0-6-2.7-6-6v-.2l.6-16c.1-3.3 2.8-5.8 6-5.8h14.4c3.2 0 5.9 2.5 6 5.8l.6 16c.1 1.6-.5 3.1-1.6 4.3s-2.6 1.9-4.2 1.9c0 0-.1 0-.2 0zm-15-26c-2.2 0-3.9 1.7-4 3.8l-.6 16.2c0 2.2 1.8 4 4 4h15.8c1.1 0 2.1-.5 2.8-1.3s1.1-1.8 1.1-2.9l-.6-16c-.1-2.2-1.8-3.8-4-3.8z"></path></g><g><path d="m16 14c-3.9 0-7-3.1-7-7 0-.6.4-1 1-1s1 .4 1 1c0 2.8 2.2 5 5 5s5-2.2 5-5c0-.6.4-1 1-1s1 .4 1 1c0 3.9-3.1 7-7 7z"></path></g></g></svg>
											</a>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
			<div class="swiper-button-prev">
				<svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="2.13" y="29" width="38" height="38" transform="rotate(-45 2.13 29)" stroke="currentColor" fill="#fff" stroke-width="2" class="rect-outer"></rect><rect x="8" y="29.21" width="30" height="30" transform="rotate(-45 8 29.21)" fill="currentColor" class="rect-inner"></rect><path d="M18.5 29H39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M29 18.5L39.5 29L29 39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
			</div>
			<div class="swiper-button-next">
				<svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="2.13" y="29" width="38" height="38" transform="rotate(-45 2.13 29)" stroke="currentColor" fill="#fff" stroke-width="2" class="rect-outer"></rect><rect x="8" y="29.21" width="30" height="30" transform="rotate(-45 8 29.21)" fill="currentColor" class="rect-inner"></rect><path d="M18.5 29H39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M29 18.5L39.5 29L29 39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
			</div>
		</div>
		<?php
		wp_reset_postdata();
	else :
		?>
		<p class="text-center text-sm text-gray-400 py-8"><?php esc_html_e( 'Chưa có sản phẩm trong danh mục này.', 'nest' ); ?></p>
		<?php
	endif;

	wp_die();
}
