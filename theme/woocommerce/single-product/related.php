<?php
/**
 * Related Products — Swiper slider reusing the shared product card.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.9.0
 */

defined( 'ABSPATH' ) || exit;

if ( $related_products ) : ?>

	<section class="related products product-related product-swipers bg-white rounded-lg shadow-sm p-4 md:p-6 mb-5">

		<?php
		$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Sản phẩm liên quan', 'nest' ) );
		if ( $heading ) :
			?>
			<h2 class="text-lg md:text-xl font-bold text-gray-900 mb-5">
				<?php echo esc_html( $heading ); ?>
			</h2>
		<?php endif; ?>

		<div class="swiper swiper-related-products list_hover_pro">
			<div class="swiper-wrapper">
				<?php foreach ( $related_products as $related_product ) : ?>
					<?php
					$post_object = get_post( $related_product->get_id() );
					setup_postdata( $GLOBALS['post'] = &$post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride
					?>
					<div class="swiper-slide">
						<?php wc_get_template_part( 'content', 'product' ); ?>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="swiper-button-prev"></div>
			<div class="swiper-button-next"></div>
		</div>

	</section>

	<?php
endif;

wp_reset_postdata();
