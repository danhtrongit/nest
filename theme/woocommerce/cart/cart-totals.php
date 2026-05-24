<?php
/**
 * Cart totals
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined( 'ABSPATH' ) || exit;

?>
<div class="cart_totals bg-white border border-gray-100 p-4 max-md:p-3 mb-5 <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

	<h2 class="text-lg font-bold text-foreground border-b border-gray-100 pb-3 mb-4"><?php esc_html_e( 'Thông tin đơn hàng', 'nest' ); ?></h2>

	<!-- Totals -->
	<div class="space-y-3 mb-4">
		<div class="cart-subtotal flex items-center justify-between text-sm">
			<span class="text-gray-600"><?php esc_html_e( 'Tạm tính', 'nest' ); ?></span>
			<span class="font-semibold"><?php wc_cart_totals_subtotal_html(); ?></span>
		</div>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<div class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?> flex items-center justify-between text-sm">
				<span class="text-gray-600"><?php wc_cart_totals_coupon_label( $coupon ); ?></span>
				<span class="font-semibold text-green-600"><?php wc_cart_totals_coupon_html( $coupon ); ?></span>
			</div>
		<?php endforeach; ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
			<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>
			<?php wc_cart_totals_shipping_html(); ?>
			<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>
		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<div class="fee flex items-center justify-between text-sm">
				<span class="text-gray-600"><?php echo esc_html( $fee->name ); ?></span>
				<span class="font-semibold"><?php wc_cart_totals_fee_html( $fee ); ?></span>
			</div>
		<?php endforeach; ?>

		<?php
		if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
			$taxable_address = WC()->customer->get_taxable_address();
			$estimated_text  = '';

			if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
				$estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
			}

			if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
				foreach ( WC()->cart->get_tax_totals() as $code => $tax ) {
					?>
					<div class="tax-rate flex items-center justify-between text-sm">
						<span class="text-gray-600"><?php echo esc_html( $tax->label ) . $estimated_text; // phpcs:ignore ?></span>
						<span class="font-semibold"><?php echo wp_kses_post( $tax->formatted_amount ); ?></span>
					</div>
					<?php
				}
			} else {
				?>
				<div class="tax-total flex items-center justify-between text-sm">
					<span class="text-gray-600"><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; // phpcs:ignore ?></span>
					<span class="font-semibold"><?php wc_cart_totals_taxes_total_html(); ?></span>
				</div>
				<?php
			}
		}
		?>

		<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

		<div class="order-total flex items-center justify-between pt-3 border-t border-gray-200">
			<span class="text-base font-bold"><?php esc_html_e( 'Tổng tiền', 'nest' ); ?></span>
			<span class="text-xl font-bold text-price"><?php wc_cart_totals_order_total_html(); ?></span>
		</div>

		<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>
	</div>

	<!-- Notes -->
	<div class="text-xs text-gray-500 space-y-1 mb-4 pb-4 border-b border-gray-100">
		<p class="mb-0"><?php esc_html_e( 'Phí vận chuyển sẽ được tính ở trang thanh toán.', 'nest' ); ?></p>
		<p class="mb-0"><?php esc_html_e( 'Bạn cũng có thể nhập mã giảm giá ở trang thanh toán.', 'nest' ); ?></p>
	</div>

	<!-- Checkout Button -->
	<div class="wc-proceed-to-checkout space-y-3">
		<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
		<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="nest-btn w-full" title="<?php esc_attr_e( 'Tiếp tục mua hàng', 'nest' ); ?>">
			<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
			<span class="nest-btn__text"><?php esc_html_e( 'Tiếp tục mua hàng', 'nest' ); ?></span>
			<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco -scale-x-100"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
		</a>
	</div>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
