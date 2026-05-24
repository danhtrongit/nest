<?php
/**
 * Template part for product tab section
 *
 * @package Nest
 */

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

$parent_cat = get_terms(
	array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => true,
		'number'     => 1,
		'orderby'    => 'count',
		'order'      => 'DESC',
		'exclude'    => array( get_option( 'default_product_cat' ) ),
	)
);
$parent_cat = ! empty( $parent_cat ) ? $parent_cat[0] : null;

if ( ! $parent_cat ) {
	return;
}

$child_cats = get_terms(
	array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => true,
		'parent'     => $parent_cat->term_id,
		'orderby'    => 'menu_order',
	)
);

if ( empty( $child_cats ) ) {
	$child_cats = array( $parent_cat );
}

$first_cat = $child_cats[0];

$args = array(
	'post_type'      => 'product',
	'posts_per_page' => 8,
	'post_status'    => 'publish',
	'tax_query'      => array(
		array(
			'taxonomy' => 'product_cat',
			'field'    => 'term_id',
			'terms'    => $first_cat->term_id,
		),
	),
);

$products = new WP_Query( $args );
?>

<section class="section-index section-product-tab py-[30px] max-md:py-[25px]">
	<div class="container mx-auto px-4">

		<!-- Section Title -->
		<div class="section-title text-center relative mb-6">
			<span class="block w-full font-medium uppercase text-primary text-sm max-md:text-xs"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
			<h2 class="inline-block font-heading font-extrabold text-[2.6rem] max-md:text-[2rem] uppercase mb-0">
				<a href="<?php echo esc_url( get_term_link( $parent_cat ) ); ?>" title="<?php echo esc_attr( $parent_cat->name ); ?>"><?php echo esc_html( $parent_cat->name ); ?></a>
			</h2>
			<div class="section-separator flex justify-center relative mt-2.5">
				<div class="relative w-8 h-3 before:content-[''] before:absolute before:top-0 before:left-2 before:w-2.5 before:h-2.5 before:border before:border-primary before:rotate-45 after:content-[''] after:absolute after:top-0 after:right-2 after:w-2.5 after:h-2.5 after:border after:border-primary after:rotate-45"></div>
			</div>

			<?php if ( count( $child_cats ) > 1 ) : ?>
				<!-- Tabs -->
				<div class="mt-4 flex justify-center flex-wrap gap-2">
					<?php foreach ( $child_cats as $index => $cat ) : ?>
						<button class="product-tab-btn px-4 py-2 text-sm font-medium border border-primary/30 transition-all duration-200 hover:bg-primary hover:text-white <?php echo 0 === $index ? 'bg-primary text-white' : 'bg-white text-foreground'; ?>" data-tab="<?php echo esc_attr( $cat->slug ); ?>" data-cat-id="<?php echo esc_attr( $cat->term_id ); ?>">
							<?php echo esc_html( $cat->name ); ?>
						</button>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>

		<!-- Products Slider -->
		<div class="product-tab-content section-slider">
			<?php if ( $products->have_posts() ) : ?>
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

							// Promotions (ACF or custom meta).
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
													<a href="<?php echo esc_url( $permalink ); ?>" title="<?php echo esc_attr( $title ); ?>">
														<?php echo esc_html( $title ); ?>
													</a>
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
						<svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect x="2.13" y="29" width="38" height="38" transform="rotate(-45 2.13 29)" stroke="currentColor" fill="#fff" stroke-width="2" class="rect-outer"></rect>
							<rect x="8" y="29.21" width="30" height="30" transform="rotate(-45 8 29.21)" fill="currentColor" class="rect-inner"></rect>
							<path d="M18.5 29H39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
							<path d="M29 18.5L39.5 29L29 39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
						</svg>
					</div>
					<div class="swiper-button-next">
						<svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect x="2.13" y="29" width="38" height="38" transform="rotate(-45 2.13 29)" stroke="currentColor" fill="#fff" stroke-width="2" class="rect-outer"></rect>
							<rect x="8" y="29.21" width="30" height="30" transform="rotate(-45 8 29.21)" fill="currentColor" class="rect-inner"></rect>
							<path d="M18.5 29H39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
							<path d="M29 18.5L39.5 29L29 39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
						</svg>
					</div>
				</div>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<p class="text-center text-sm text-gray-400 py-8"><?php esc_html_e( 'Chưa có sản phẩm trong danh mục này.', 'nest' ); ?></p>
			<?php endif; ?>
		</div>

	</div>
</section>
