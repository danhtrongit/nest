<?php
/**
 * Checkout Form
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data" aria-label="<?php echo esc_attr__( 'Checkout', 'woocommerce' ); ?>">

	<div class="flex flex-wrap -mx-2.5 lg:-mx-4">

		<!-- Left Column: Customer Details -->
		<div class="w-full lg:w-7/12 xl:w-2/3 px-2.5 lg:px-4 mb-5">

			<?php if ( $checkout->get_checkout_fields() ) : ?>

				<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

				<div id="customer_details">
					<!-- Billing -->
					<div class="bg-white border border-gray-100 p-4 max-md:p-3 mb-5">
						<?php do_action( 'woocommerce_checkout_billing' ); ?>
					</div>

					<!-- Shipping -->
					<div class="bg-white border border-gray-100 p-4 max-md:p-3 mb-5">
						<?php do_action( 'woocommerce_checkout_shipping' ); ?>
					</div>
				</div>

				<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

			<?php endif; ?>

		</div>

		<!-- Right Column: Order Review -->
		<div class="w-full lg:w-5/12 xl:w-1/3 px-2.5 lg:px-4">
			<div class="lg:sticky lg:top-4">

				<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>

				<div class="bg-white border border-gray-100 p-4 max-md:p-3">

					<h3 id="order_review_heading" class="text-lg font-bold text-foreground border-b border-gray-100 pb-3 mb-4">
						<?php esc_html_e( 'Đơn hàng của bạn', 'nest' ); ?>
					</h3>

					<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

					<div id="order_review" class="woocommerce-checkout-review-order">
						<?php do_action( 'woocommerce_checkout_order_review' ); ?>
					</div>

					<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

				</div>

			</div>
		</div>

	</div>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
