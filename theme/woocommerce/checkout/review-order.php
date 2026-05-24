<?php
/**
 * Review order table
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;
?>

<!-- Cart items -->
<div class="space-y-3 mb-4">
	<?php
	do_action( 'woocommerce_review_order_before_cart_contents' );

	foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
		$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

		if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
			?>
			<div class="flex items-center gap-3 pb-3 border-b border-gray-50 <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
				<!-- Thumbnail -->
				<div class="w-14 h-14 shrink-0 border border-gray-100 overflow-hidden">
					<?php
					$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'woocommerce_gallery_thumbnail' ), $cart_item, $cart_item_key );
					echo $thumbnail; // phpcs:ignore
					?>
				</div>

				<!-- Name + Qty -->
				<div class="flex-1 min-w-0">
					<span class="text-sm text-foreground line-clamp-2 block">
						<?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ); ?>
					</span>
					<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', '<span class="text-xs text-gray-400">&times;&nbsp;' . $cart_item['quantity'] . '</span>', $cart_item, $cart_item_key ); // phpcs:ignore ?>
					<?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore ?>
				</div>

				<!-- Subtotal -->
				<div class="text-sm font-semibold text-price whitespace-nowrap">
					<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore ?>
				</div>
			</div>
			<?php
		}
	}

	do_action( 'woocommerce_review_order_after_cart_contents' );
	?>
</div>

<!-- Totals -->
<div class="space-y-3">
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
		<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>
		<?php wc_cart_totals_shipping_html(); ?>
		<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
	<?php endif; ?>

	<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
		<div class="fee flex items-center justify-between text-sm">
			<span class="text-gray-600"><?php echo esc_html( $fee->name ); ?></span>
			<span class="font-semibold"><?php wc_cart_totals_fee_html( $fee ); ?></span>
		</div>
	<?php endforeach; ?>

	<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
		<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
			<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>
				<div class="tax-rate flex items-center justify-between text-sm">
					<span class="text-gray-600"><?php echo esc_html( $tax->label ); ?></span>
					<span class="font-semibold"><?php echo wp_kses_post( $tax->formatted_amount ); ?></span>
				</div>
			<?php endforeach; ?>
		<?php else : ?>
			<div class="tax-total flex items-center justify-between text-sm">
				<span class="text-gray-600"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></span>
				<span class="font-semibold"><?php wc_cart_totals_taxes_total_html(); ?></span>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

	<div class="order-total flex items-center justify-between pt-3 border-t border-gray-200">
		<span class="text-base font-bold"><?php esc_html_e( 'Tổng tiền', 'nest' ); ?></span>
		<span class="text-xl font-bold text-price"><?php wc_cart_totals_order_total_html(); ?></span>
	</div>

	<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
</div>
