<?php
/**
 * My Account Dashboard
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$allowed_html = array(
	'a' => array(
		'href' => array(),
		'class' => array(),
	),
);
?>

<div class="space-y-6">

	<!-- Welcome -->
	<div class="flex items-center gap-4">
		<?php echo get_avatar( get_current_user_id(), 56, '', '', array( 'class' => 'w-14 h-14 rounded-full border-2 border-primary/20' ) ); ?>
		<div>
			<p class="text-base text-foreground mb-1">
				<?php
				printf(
					/* translators: 1: user display name 2: logout url */
					wp_kses( __( 'Xin chào, <strong>%1$s</strong> (không phải %1$s? <a href="%2$s" class="text-primary hover:text-hover no-underline">Đăng xuất</a>)', 'nest' ), $allowed_html ),
					esc_html( $current_user->display_name ),
					esc_url( wc_logout_url() )
				);
				?>
			</p>
			<p class="text-sm text-gray-500 mb-0">
				<?php esc_html_e( 'Từ trang tài khoản, bạn có thể xem đơn hàng, quản lý địa chỉ giao hàng và chỉnh sửa thông tin cá nhân.', 'nest' ); ?>
			</p>
		</div>
	</div>

	<!-- Quick links -->
	<div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
		<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>" class="group flex items-center gap-3 p-4 border border-gray-100 hover:border-primary/30 transition-colors no-underline">
			<div class="w-10 h-10 rounded-full bg-secondary/20 flex items-center justify-center shrink-0 group-hover:bg-secondary/30 transition-colors">
				<svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
					<path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
				</svg>
			</div>
			<div>
				<span class="block text-sm font-semibold text-foreground group-hover:text-primary transition-colors"><?php esc_html_e( 'Đơn hàng', 'nest' ); ?></span>
				<span class="block text-xs text-gray-400"><?php esc_html_e( 'Xem lịch sử đơn hàng', 'nest' ); ?></span>
			</div>
		</a>

		<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-address' ) ); ?>" class="group flex items-center gap-3 p-4 border border-gray-100 hover:border-primary/30 transition-colors no-underline">
			<div class="w-10 h-10 rounded-full bg-secondary/20 flex items-center justify-center shrink-0 group-hover:bg-secondary/30 transition-colors">
				<svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
					<path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
					<path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
				</svg>
			</div>
			<div>
				<span class="block text-sm font-semibold text-foreground group-hover:text-primary transition-colors"><?php esc_html_e( 'Địa chỉ', 'nest' ); ?></span>
				<span class="block text-xs text-gray-400"><?php esc_html_e( 'Quản lý địa chỉ giao hàng', 'nest' ); ?></span>
			</div>
		</a>

		<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-account' ) ); ?>" class="group flex items-center gap-3 p-4 border border-gray-100 hover:border-primary/30 transition-colors no-underline">
			<div class="w-10 h-10 rounded-full bg-secondary/20 flex items-center justify-center shrink-0 group-hover:bg-secondary/30 transition-colors">
				<svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
					<path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
				</svg>
			</div>
			<div>
				<span class="block text-sm font-semibold text-foreground group-hover:text-primary transition-colors"><?php esc_html_e( 'Tài khoản', 'nest' ); ?></span>
				<span class="block text-xs text-gray-400"><?php esc_html_e( 'Chỉnh sửa thông tin', 'nest' ); ?></span>
			</div>
		</a>
	</div>

</div>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );
