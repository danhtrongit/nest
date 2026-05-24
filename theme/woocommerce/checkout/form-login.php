<?php
/**
 * Checkout login form
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.0.0
 */

defined( 'ABSPATH' ) || exit;

$registration_at_checkout   = WC_Checkout::instance()->is_registration_enabled();
$login_reminder_at_checkout = 'yes' === get_option( 'woocommerce_enable_checkout_login_reminder' );

if ( is_user_logged_in() ) {
	return;
}

if ( $login_reminder_at_checkout ) : ?>
	<div class="woocommerce-form-login-toggle mb-4">
		<?php
		wc_print_notice(
			apply_filters( 'woocommerce_checkout_login_message', esc_html__( 'Bạn đã có tài khoản?', 'nest' ) ) .
			' <a href="#" class="showlogin">' . esc_html__( 'Đăng nhập tại đây', 'nest' ) . '</a>',
			'notice'
		);
		?>
	</div>
	<?php
endif;

if ( $registration_at_checkout || $login_reminder_at_checkout ) :

	// Always show the form after a login attempt.
	$show_form = isset( $_POST['login'] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing

	woocommerce_login_form(
		array(
			'message'  => esc_html__( 'Nếu bạn đã từng mua hàng tại đây, vui lòng đăng nhập. Nếu bạn là khách hàng mới, hãy tiếp tục điền thông tin bên dưới.', 'nest' ),
			'redirect' => wc_get_checkout_url(),
			'hidden'   => ! $show_form,
		)
	);
endif;
