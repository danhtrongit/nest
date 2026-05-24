<?php
/**
 * Login Form
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="max-w-4xl mx-auto">

	<div class="flex flex-wrap -mx-2.5 lg:-mx-4" id="customer_login">

		<!-- Login Column -->
		<div class="w-full <?php echo ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) ? 'md:w-1/2' : ''; ?> px-2.5 lg:px-4 mb-5">
			<div class="bg-white border border-gray-100 p-6 max-md:p-4 h-full">

				<h2 class="text-lg font-bold text-foreground border-b border-gray-100 pb-3 mb-4">
					<?php esc_html_e( 'Đăng nhập', 'nest' ); ?>
				</h2>

				<form class="woocommerce-form woocommerce-form-login login" method="post">

					<?php do_action( 'woocommerce_login_form_start' ); ?>

					<div class="space-y-4 mb-4">
						<div>
							<label for="username" class="block text-sm font-medium text-foreground mb-1">
								<?php esc_html_e( 'Tên tài khoản hoặc email', 'nest' ); ?>&nbsp;<span class="text-price">*</span>
							</label>
							<input type="text" class="w-full h-10 px-3 text-sm border border-gray-200 bg-white text-foreground focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary/20" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" required aria-required="true" /><?php // @codingStandardsIgnoreLine ?>
						</div>

						<div>
							<label for="password" class="block text-sm font-medium text-foreground mb-1">
								<?php esc_html_e( 'Mật khẩu', 'nest' ); ?>&nbsp;<span class="text-price">*</span>
							</label>
							<input class="w-full h-10 px-3 text-sm border border-gray-200 bg-white text-foreground focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary/20" type="password" name="password" id="password" autocomplete="current-password" required aria-required="true" />
						</div>
					</div>

					<?php do_action( 'woocommerce_login_form' ); ?>

					<div class="flex items-center justify-between flex-wrap gap-3 mb-4">
						<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme inline-flex items-center gap-2 cursor-pointer text-sm text-gray-600">
							<input class="woocommerce-form__input woocommerce-form__input-checkbox accent-primary w-4 h-4" name="rememberme" type="checkbox" id="rememberme" value="forever" />
							<span><?php esc_html_e( 'Ghi nhớ đăng nhập', 'nest' ); ?></span>
						</label>

						<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="text-sm text-primary hover:text-hover transition-colors no-underline">
							<?php esc_html_e( 'Quên mật khẩu?', 'nest' ); ?>
						</a>
					</div>

					<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>

					<button type="submit" class="nest-btn nest-btn--primary w-full" name="login" value="<?php esc_attr_e( 'Đăng nhập', 'nest' ); ?>">
						<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
						<span class="nest-btn__text"><?php esc_html_e( 'Đăng nhập', 'nest' ); ?></span>
						<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco -scale-x-100"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
					</button>

					<?php do_action( 'woocommerce_login_form_end' ); ?>

				</form>

			</div>
		</div>

		<!-- Register Column -->
		<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>
			<div class="w-full md:w-1/2 px-2.5 lg:px-4 mb-5">
				<div class="bg-white border border-gray-100 p-6 max-md:p-4 h-full">

					<h2 class="text-lg font-bold text-foreground border-b border-gray-100 pb-3 mb-4">
						<?php esc_html_e( 'Đăng ký tài khoản', 'nest' ); ?>
					</h2>

					<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?>>

						<?php do_action( 'woocommerce_register_form_start' ); ?>

						<div class="space-y-4 mb-4">

							<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
								<div>
									<label for="reg_username" class="block text-sm font-medium text-foreground mb-1">
										<?php esc_html_e( 'Tên tài khoản', 'nest' ); ?>&nbsp;<span class="text-price">*</span>
									</label>
									<input type="text" class="w-full h-10 px-3 text-sm border border-gray-200 bg-white text-foreground focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary/20" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" required aria-required="true" /><?php // @codingStandardsIgnoreLine ?>
								</div>
							<?php endif; ?>

							<div>
								<label for="reg_email" class="block text-sm font-medium text-foreground mb-1">
									<?php esc_html_e( 'Địa chỉ email', 'nest' ); ?>&nbsp;<span class="text-price">*</span>
								</label>
								<input type="email" class="w-full h-10 px-3 text-sm border border-gray-200 bg-white text-foreground focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary/20" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" required aria-required="true" /><?php // @codingStandardsIgnoreLine ?>
							</div>

							<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
								<div>
									<label for="reg_password" class="block text-sm font-medium text-foreground mb-1">
										<?php esc_html_e( 'Mật khẩu', 'nest' ); ?>&nbsp;<span class="text-price">*</span>
									</label>
									<input type="password" class="w-full h-10 px-3 text-sm border border-gray-200 bg-white text-foreground focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary/20" name="password" id="reg_password" autocomplete="new-password" required aria-required="true" />
								</div>
							<?php else : ?>
								<p class="text-sm text-gray-500"><?php esc_html_e( 'Mật khẩu sẽ được gửi đến email của bạn.', 'nest' ); ?></p>
							<?php endif; ?>

						</div>

						<?php do_action( 'woocommerce_register_form' ); ?>

						<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>

						<button type="submit" class="nest-btn w-full" name="register" value="<?php esc_attr_e( 'Đăng ký', 'nest' ); ?>">
							<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
							<span class="nest-btn__text"><?php esc_html_e( 'Đăng ký', 'nest' ); ?></span>
							<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco -scale-x-100"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
						</button>

						<?php do_action( 'woocommerce_register_form_end' ); ?>

					</form>

				</div>
			</div>
		<?php endif; ?>

	</div>

</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
