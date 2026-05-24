<?php
/**
 * Lost password form
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.2.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_lost_password_form' );
?>

<div class="max-w-md mx-auto">
	<div class="bg-white border border-gray-100 p-6 max-md:p-4">

		<h2 class="text-lg font-bold text-foreground border-b border-gray-100 pb-3 mb-4">
			<?php esc_html_e( 'Quên mật khẩu', 'nest' ); ?>
		</h2>

		<form method="post" class="woocommerce-ResetPassword lost_reset_password">

			<p class="text-sm text-gray-600 mb-4">
				<?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Nhập tên người dùng hoặc email của bạn. Bạn sẽ nhận được link tạo mật khẩu mới qua email.', 'nest' ) ); ?>
			</p>

			<div class="mb-4">
				<label for="user_login" class="block text-sm font-medium text-foreground mb-1">
					<?php esc_html_e( 'Tên tài khoản hoặc email', 'nest' ); ?>
				</label>
				<input class="w-full h-10 px-3 text-sm border border-gray-200 bg-white text-foreground focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary/20" type="text" name="user_login" id="user_login" autocomplete="username" required aria-required="true" />
			</div>

			<?php do_action( 'woocommerce_lostpassword_form' ); ?>

			<input type="hidden" name="wc_reset_password" value="true" />

			<button type="submit" class="nest-btn nest-btn--primary w-full" value="<?php esc_attr_e( 'Reset password', 'woocommerce' ); ?>">
				<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
				<span class="nest-btn__text"><?php esc_html_e( 'Lấy lại mật khẩu', 'nest' ); ?></span>
				<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco -scale-x-100"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
			</button>

			<?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>

		</form>

		<div class="mt-4 pt-4 border-t border-gray-100 text-center">
			<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="text-sm text-primary hover:text-hover transition-colors no-underline">
				<?php esc_html_e( 'Quay lại đăng nhập', 'nest' ); ?>
			</a>
		</div>

	</div>
</div>

<?php
do_action( 'woocommerce_after_lost_password_form' );
