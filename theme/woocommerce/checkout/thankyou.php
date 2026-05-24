<?php
/**
 * Thankyou page
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.1.0
 *
 * @var WC_Order $order
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-order max-w-2xl mx-auto">

	<?php
	if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() );
		?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<div class="bg-white border border-red-200 rounded-lg p-8 max-md:p-5 text-center">
				<div class="w-16 h-16 mx-auto mb-4 rounded-full bg-red-50 flex items-center justify-center">
					<svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
						<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"></path>
					</svg>
				</div>

				<h2 class="font-heading font-bold text-xl text-foreground mb-2">
					<?php esc_html_e( 'Đặt hàng không thành công', 'nest' ); ?>
				</h2>

				<p class="text-sm text-gray-500 mb-6">
					<?php esc_html_e( 'Rất tiếc, đơn hàng của bạn không thể được xử lý. Ngân hàng hoặc đơn vị thanh toán đã từ chối giao dịch. Vui lòng thử lại.', 'nest' ); ?>
				</p>

				<div class="flex flex-col sm:flex-row items-center justify-center gap-3">
					<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="nest-btn nest-btn--primary" title="<?php esc_attr_e( 'Thanh toán lại', 'nest' ); ?>">
						<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
						<span class="nest-btn__text"><?php esc_html_e( 'Thanh toán lại', 'nest' ); ?></span>
						<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco -scale-x-100"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
					</a>

					<?php if ( is_user_logged_in() ) : ?>
						<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="nest-btn" title="<?php esc_attr_e( 'Tài khoản', 'nest' ); ?>">
							<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
							<span class="nest-btn__text"><?php esc_html_e( 'Tài khoản', 'nest' ); ?></span>
							<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco -scale-x-100"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
						</a>
					<?php endif; ?>
				</div>
			</div>

		<?php else : ?>

			<!-- Success state -->
			<div class="bg-white border border-gray-100 rounded-lg p-8 max-md:p-5 text-center mb-6">
				<div class="w-16 h-16 mx-auto mb-4 rounded-full bg-green-50 flex items-center justify-center">
					<svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
						<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
					</svg>
				</div>

				<h2 class="font-heading font-bold text-xl text-foreground mb-2">
					<?php esc_html_e( 'Đặt hàng thành công!', 'nest' ); ?>
				</h2>

				<p class="text-sm text-gray-500 mb-0">
					<?php esc_html_e( 'Cảm ơn bạn đã mua hàng. Đơn hàng của bạn đã được tiếp nhận và đang được xử lý.', 'nest' ); ?>
				</p>
			</div>

			<!-- Order details -->
			<div class="bg-white border border-gray-100 rounded-lg p-6 max-md:p-4 mb-6">
				<h3 class="text-base font-bold text-foreground border-b border-gray-100 pb-3 mb-4">
					<?php esc_html_e( 'Chi tiết đơn hàng', 'nest' ); ?>
				</h3>

				<div class="space-y-3">
					<div class="flex items-center justify-between text-sm">
						<span class="text-gray-600"><?php esc_html_e( 'Mã đơn hàng', 'nest' ); ?></span>
						<span class="font-semibold"><?php echo $order->get_order_number(); // phpcs:ignore ?></span>
					</div>

					<div class="flex items-center justify-between text-sm">
						<span class="text-gray-600"><?php esc_html_e( 'Ngày đặt', 'nest' ); ?></span>
						<span class="font-semibold"><?php echo wc_format_datetime( $order->get_date_created() ); // phpcs:ignore ?></span>
					</div>

					<?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
						<div class="flex items-center justify-between text-sm">
							<span class="text-gray-600"><?php esc_html_e( 'Email', 'nest' ); ?></span>
							<span class="font-semibold"><?php echo $order->get_billing_email(); // phpcs:ignore ?></span>
						</div>
					<?php endif; ?>

					<div class="flex items-center justify-between text-sm pt-3 border-t border-gray-100">
						<span class="text-base font-bold"><?php esc_html_e( 'Tổng tiền', 'nest' ); ?></span>
						<span class="text-lg font-bold text-price"><?php echo $order->get_formatted_order_total(); // phpcs:ignore ?></span>
					</div>

					<?php if ( $order->get_payment_method_title() ) : ?>
						<div class="flex items-center justify-between text-sm">
							<span class="text-gray-600"><?php esc_html_e( 'Thanh toán', 'nest' ); ?></span>
							<span class="font-semibold"><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></span>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<!-- Action buttons -->
			<div class="flex flex-col sm:flex-row items-center justify-center gap-3">
				<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="nest-btn" title="<?php esc_attr_e( 'Tiếp tục mua hàng', 'nest' ); ?>">
					<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
					<span class="nest-btn__text"><?php esc_html_e( 'Tiếp tục mua hàng', 'nest' ); ?></span>
					<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco -scale-x-100"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
				</a>

				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nest-btn" title="<?php esc_attr_e( 'Về trang chủ', 'nest' ); ?>">
					<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
					<span class="nest-btn__text"><?php esc_html_e( 'Về trang chủ', 'nest' ); ?></span>
					<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco -scale-x-100"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
				</a>
			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
		<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

	<?php else : ?>

		<!-- Order received but no order object -->
		<div class="bg-white border border-gray-100 rounded-lg p-8 max-md:p-5 text-center">
			<div class="w-16 h-16 mx-auto mb-4 rounded-full bg-green-50 flex items-center justify-center">
				<svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
					<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
				</svg>
			</div>

			<h2 class="font-heading font-bold text-xl text-foreground mb-2">
				<?php esc_html_e( 'Cảm ơn bạn!', 'nest' ); ?>
			</h2>

			<p class="text-sm text-gray-500 mb-6">
				<?php esc_html_e( 'Đơn hàng của bạn đã được tiếp nhận.', 'nest' ); ?>
			</p>

			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nest-btn" title="<?php esc_attr_e( 'Về trang chủ', 'nest' ); ?>">
				<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
				<span class="nest-btn__text"><?php esc_html_e( 'Về trang chủ', 'nest' ); ?></span>
				<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco -scale-x-100"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
			</a>
		</div>

	<?php endif; ?>

</div>
