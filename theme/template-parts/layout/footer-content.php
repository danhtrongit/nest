<?php
/**
 * Template part for displaying the footer content
 *
 * @package Nest
 */

?>

<footer id="colophon" class="relative border-t-4 border-hover bg-primary bg-repeat" style="background-image: url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/footer_pattent.png' ); ?>')">

	<!-- Mid Footer -->
	<div class="relative py-10 lg:pt-[60px] lg:pb-10">
		<div class="container mx-auto px-4">
			<div class="flex flex-wrap -mx-2.5">

				<!-- Column 1: Logo + Contact + Social (30%) -->
				<div class="w-full lg:w-[30%] px-2.5 mb-5 lg:mb-0">

					<!-- Logo -->
					<div class="mb-4">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-block max-w-[220px]" title="<?php bloginfo( 'name' ); ?>">
							<?php if ( has_custom_logo() ) : ?>
								<?php
								$custom_logo_id  = get_theme_mod( 'custom_logo' );
								$custom_logo_url = wp_get_attachment_image_url( $custom_logo_id, 'full' );
								?>
								<img src="<?php echo esc_url( $custom_logo_url ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="w-full h-auto" width="300" height="96">
							<?php else : ?>
								<span class="text-2xl font-heading font-extrabold text-white"><?php bloginfo( 'name' ); ?></span>
							<?php endif; ?>
						</a>
					</div>

					<!-- Contact Info -->
					<div class="space-y-2 text-sm font-medium text-white">
						<div class="flex items-start gap-2">
							<svg class="w-4 h-4 fill-secondary shrink-0 mt-[3px]" viewBox="0 0 16 16"><path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/></svg>
							<span><strong><?php esc_html_e( 'Địa chỉ:', 'nest' ); ?></strong> <?php echo esc_html( nest_get_option( 'address' ) ); ?></span>
						</div>
						<div class="flex items-start gap-2">
							<svg class="w-4 h-4 fill-secondary shrink-0 mt-[3px]" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/></svg>
							<span><strong><?php esc_html_e( 'Điện thoại:', 'nest' ); ?></strong>
							<?php $phone = nest_get_option( 'hotline_number' ); ?>
							<a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>" class="text-secondary hover:text-hover transition-all duration-200"><?php echo esc_html( $phone ); ?></a></span>
						</div>
						<div class="flex items-start gap-2">
							<svg class="w-4 h-4 fill-secondary shrink-0 mt-[3px]" viewBox="0 0 16 16"><path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/></svg>
							<span><strong><?php esc_html_e( 'Email:', 'nest' ); ?></strong>
							<?php $email = nest_get_option( 'email' ); ?>
							<a href="mailto:<?php echo esc_attr( $email ); ?>" class="text-secondary hover:text-hover transition-all duration-200"><?php echo esc_html( $email ); ?></a></span>
						</div>
					</div>

					<!-- Social Icons -->
					<div class="mt-5 flex items-center gap-2.5">
						<?php
						$socials = array(
							'facebook'  => nest_get_option( 'social_facebook' ),
							'instagram' => nest_get_option( 'social_instagram' ),
							'shopee'    => nest_get_option( 'social_shopee' ),
							'lazada'    => nest_get_option( 'social_lazada' ),
							'tiktok'    => nest_get_option( 'social_tiktok' ),
						);

						foreach ( $socials as $name => $url ) :
							if ( ! empty( $url ) ) :
								?>
								<a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer" class="inline-block w-[35px] h-[35px] rounded-full hover:brightness-130 transition-all duration-300" aria-label="<?php echo esc_attr( ucfirst( $name ) ); ?>" title="<?php echo esc_attr( ucfirst( $name ) ); ?>">
									<?php if ( file_exists( get_template_directory() . '/assets/images/' . $name . '.svg' ) ) : ?>
										<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $name . '.svg' ); ?>" alt="<?php echo esc_attr( ucfirst( $name ) ); ?>" width="35" height="35">
									<?php else : ?>
										<span class="flex items-center justify-center w-full h-full bg-white/20 rounded-full text-white text-xs font-bold"><?php echo esc_html( strtoupper( substr( $name, 0, 2 ) ) ); ?></span>
									<?php endif; ?>
								</a>
								<?php
							endif;
						endforeach;
						?>
					</div>
				</div>

				<!-- Column 2: Chính sách (20%) -->
				<div class="w-full md:w-1/3 lg:w-[20%] px-2.5 mb-5 lg:mb-0">
					<h4 class="footer-title font-heading text-[1.1rem] font-bold text-white uppercase tracking-wide leading-normal mb-3">
						<span class="relative block pl-6 before:content-[''] before:absolute before:top-1/2 before:-translate-y-1/2 before:left-0 before:w-2.5 before:h-2.5 before:border before:border-secondary before:rotate-45 after:content-[''] after:absolute after:top-1/2 after:-translate-y-1/2 after:left-1.5 after:w-2.5 after:h-2.5 after:border after:border-secondary after:rotate-45"><?php esc_html_e( 'Chính sách', 'nest' ); ?></span>
					</h4>
					<?php
					if ( has_nav_menu( 'footer-policy' ) ) :
						wp_nav_menu(
							array(
								'theme_location' => 'footer-policy',
								'container'      => false,
								'menu_class'     => 'footer-menu-list leading-[30px]',
								'depth'          => 1,
								'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
							)
						);
					else :
						?>
						<ul class="footer-menu-list leading-[30px]">
							<li><a href="#"><?php esc_html_e( 'Chính sách mua hàng', 'nest' ); ?></a></li>
							<li><a href="#"><?php esc_html_e( 'Chính sách thanh toán', 'nest' ); ?></a></li>
							<li><a href="#"><?php esc_html_e( 'Chính sách vận chuyển', 'nest' ); ?></a></li>
							<li><a href="#"><?php esc_html_e( 'Cam kết cửa hàng', 'nest' ); ?></a></li>
							<li><a href="#"><?php esc_html_e( 'Chính sách bảo mật', 'nest' ); ?></a></li>
						</ul>
					<?php endif; ?>
				</div>

				<!-- Column 3: Hướng dẫn (20%) -->
				<div class="w-full md:w-1/3 lg:w-[20%] px-2.5 mb-5 lg:mb-0">
					<h4 class="footer-title font-heading text-[1.1rem] font-bold text-white uppercase tracking-wide leading-normal mb-3">
						<span class="relative block pl-6 before:content-[''] before:absolute before:top-1/2 before:-translate-y-1/2 before:left-0 before:w-2.5 before:h-2.5 before:border before:border-secondary before:rotate-45 after:content-[''] after:absolute after:top-1/2 after:-translate-y-1/2 after:left-1.5 after:w-2.5 after:h-2.5 after:border after:border-secondary after:rotate-45"><?php esc_html_e( 'Hướng dẫn', 'nest' ); ?></span>
					</h4>
					<?php
					if ( has_nav_menu( 'footer-guide' ) ) :
						wp_nav_menu(
							array(
								'theme_location' => 'footer-guide',
								'container'      => false,
								'menu_class'     => 'footer-menu-list leading-[30px]',
								'depth'          => 1,
								'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
							)
						);
					else :
						?>
						<ul class="footer-menu-list leading-[30px]">
							<li><a href="#"><?php esc_html_e( 'Hướng dẫn mua hàng', 'nest' ); ?></a></li>
							<li><a href="#"><?php esc_html_e( 'Hướng dẫn đổi trả', 'nest' ); ?></a></li>
							<li><a href="#"><?php esc_html_e( 'Hướng dẫn thanh toán', 'nest' ); ?></a></li>
							<li><a href="#"><?php esc_html_e( 'Quy định bảo hành', 'nest' ); ?></a></li>
							<li><a href="#"><?php esc_html_e( 'Hướng dẫn chuyển khoản', 'nest' ); ?></a></li>
						</ul>
					<?php endif; ?>
				</div>

				<!-- Column 4: Payment + Certification (30%) -->
				<div class="w-full md:w-1/3 lg:w-[30%] px-2.5">

					<!-- Payment Methods -->
					<div>
						<h4 class="footer-title font-heading text-[1.1rem] font-bold text-white uppercase tracking-wide leading-normal mb-3">
							<span class="relative block pl-6 before:content-[''] before:absolute before:top-1/2 before:-translate-y-1/2 before:left-0 before:w-2.5 before:h-2.5 before:border before:border-secondary before:rotate-45 after:content-[''] after:absolute after:top-1/2 after:-translate-y-1/2 after:left-1.5 after:w-2.5 after:h-2.5 after:border after:border-secondary after:rotate-45"><?php esc_html_e( 'Hỗ trợ thanh toán', 'nest' ); ?></span>
						</h4>
						<div class="mt-5 max-w-[220px]">
							<?php if ( is_active_sidebar( 'footer-payment' ) ) : ?>
								<?php dynamic_sidebar( 'footer-payment' ); ?>
							<?php else : ?>
								<div class="flex flex-wrap gap-1.5">
									<?php
									$payments = array(
										'payment_1' => 'MoMo',
										'payment_2' => 'ZaloPay',
										'payment_3' => 'VNPay',
										'payment_4' => 'Moca',
										'payment_5' => 'Visa',
										'payment_6' => 'ATM',
									);
									foreach ( $payments as $file => $label ) :
										?>
										<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $file . '.png' ); ?>" alt="<?php echo esc_attr( $label ); ?>" class="w-[63px] h-[29px] rounded-[5px] object-contain" width="63" height="29">
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>

					<!-- Certification -->
					<div class="mt-5">
						<h4 class="footer-title font-heading text-[1.1rem] font-bold text-white uppercase tracking-wide leading-normal mb-3">
							<span class="relative block pl-6 before:content-[''] before:absolute before:top-1/2 before:-translate-y-1/2 before:left-0 before:w-2.5 before:h-2.5 before:border before:border-secondary before:rotate-45 after:content-[''] after:absolute after:top-1/2 after:-translate-y-1/2 after:left-1.5 after:w-2.5 after:h-2.5 after:border after:border-secondary after:rotate-45"><?php esc_html_e( 'Chứng nhận', 'nest' ); ?></span>
						</h4>
						<div class="mt-4 flex items-center gap-1.5">
							<?php if ( is_active_sidebar( 'footer-certification' ) ) : ?>
								<?php dynamic_sidebar( 'footer-certification' ); ?>
							<?php else : ?>
								<a href="#" class="inline-block"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/certifi_1.png' ); ?>" alt="<?php esc_attr_e( 'Chứng nhận', 'nest' ); ?>" class="h-[45px] w-auto" height="45"></a>
								<a href="#" class="inline-block"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/certifi_2.png' ); ?>" alt="<?php esc_attr_e( 'Chứng nhận', 'nest' ); ?>" class="h-[45px] w-auto" height="45"></a>
							<?php endif; ?>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Copyright -->
	<div class="bg-[#031913] text-center relative">
		<div class="container mx-auto px-4">
			<span class="block py-2.5 text-sm text-white leading-6">
				<span class="block md:inline w-full md:w-auto leading-6">&copy;
					<?php
					$copyright_text = nest_get_option( 'copyright_text' );
					if ( $copyright_text ) :
						echo wp_kses_post( $copyright_text );
					else :
						esc_html_e( 'Bản quyền thuộc về', 'nest' );
						?>
						<strong><?php bloginfo( 'name' ); ?></strong>
					<?php endif; ?>
					<span class="hidden md:inline"> | </span>
				</span>
				<?php
				$powered_by_text = nest_get_option( 'powered_by_text' );
				$powered_by_name = nest_get_option( 'powered_by_name' );
				$powered_by_url  = nest_get_option( 'powered_by_url' );
				?>
				<?php if ( $powered_by_name ) : ?>
					<span class="opacity-80"><?php echo esc_html( $powered_by_text ); ?></span>
					<a href="<?php echo esc_url( $powered_by_url ); ?>" rel="nofollow" target="_blank" class="font-bold text-white hover:text-secondary hover:underline transition-colors duration-200"><?php echo esc_html( $powered_by_name ); ?></a>
				<?php endif; ?>
			</span>
		</div>
	</div>

	<!-- Back to Top -->
	<a href="#" id="back-to-top" class="fixed bottom-[100px] md:bottom-[100px] right-4 z-[99] w-10 h-10 opacity-0 invisible -translate-y-5 transition-all duration-300" title="<?php esc_attr_e( 'Lên đầu trang', 'nest' ); ?>">
		<svg class="w-full h-full -rotate-90" width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
			<rect x="2.13" y="29" width="38" height="38" transform="rotate(-45 2.13 29)" stroke="currentColor" fill="white" stroke-width="2" class="text-primary"></rect>
			<rect x="8" y="29.21" width="30" height="30" transform="rotate(-45 8 29.21)" fill="currentColor" class="text-primary"></rect>
			<path d="M18.5 29H39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
			<path d="M29 18.5L39.5 29L29 39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
		</svg>
	</a>

</footer><!-- #colophon -->
