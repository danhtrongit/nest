<?php
/**
 * Empty cart page
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="bg-white border border-gray-100 rounded-lg p-10 max-md:p-6 text-center max-w-xl mx-auto">

	<!-- Empty cart illustration -->
	<div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gray-50 flex items-center justify-center">
		<svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1">
			<path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"></path>
		</svg>
	</div>

	<h2 class="font-heading font-bold text-xl text-foreground mb-2">
		<?php esc_html_e( 'Giỏ hàng trống', 'nest' ); ?>
	</h2>

	<p class="text-sm text-gray-500 mb-6 max-w-sm mx-auto">
		<?php esc_html_e( 'Bạn chưa có sản phẩm nào trong giỏ hàng. Hãy khám phá các sản phẩm chăm sóc sức khỏe cao cấp từ Lucky Life Care.', 'nest' ); ?>
	</p>

	<?php do_action( 'woocommerce_cart_is_empty' ); ?>

	<?php if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
		<div class="flex flex-col sm:flex-row items-center justify-center gap-3">
			<a href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>" class="nest-btn" title="<?php esc_attr_e( 'Khám phá sản phẩm', 'nest' ); ?>">
				<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
				<span class="nest-btn__text"><?php echo esc_html( apply_filters( 'woocommerce_return_to_shop_text', __( 'Khám phá sản phẩm', 'nest' ) ) ); ?></span>
				<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco -scale-x-100"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
			</a>

			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nest-btn" title="<?php esc_attr_e( 'Về trang chủ', 'nest' ); ?>">
				<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
				<span class="nest-btn__text"><?php esc_html_e( 'Về trang chủ', 'nest' ); ?></span>
				<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco -scale-x-100"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
			</a>
		</div>
	<?php endif; ?>

</div>
