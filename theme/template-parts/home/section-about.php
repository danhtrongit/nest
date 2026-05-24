<?php
/**
 * Template part for the About section
 *
 * @package Nest
 */

?>

<section class="section-index py-[30px] max-md:py-[25px]">
	<div class="relative overflow-hidden bg-primary bg-cover bg-bottom bg-no-repeat border-y-4 border-hover py-20 max-lg:py-10" style="background-image: url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/section_about_bg.jpg' ); ?>')">
		<div class="container mx-auto px-4">
			<div class="flex flex-wrap -mx-2.5">

				<!-- Left: Content -->
				<div class="w-full lg:w-1/2 px-2.5 flex items-center max-lg:mb-8">
					<div class="relative text-center p-7 max-md:p-5 bg-black/20 z-[1] before:content-[''] before:absolute before:inset-2 before:border before:border-secondary/50 before:-z-[1]">

						<!-- Section Title (secondary variant) -->
						<div class="section-title text-center relative mb-6">
							<span class="block w-full font-medium uppercase text-white text-sm"><?php esc_html_e( 'Yến sào Lucky', 'nest' ); ?></span>
							<h2 class="inline-block font-heading font-extrabold text-[2.6rem] max-md:text-[2rem] uppercase mb-0 text-secondary drop-shadow-md"><?php esc_html_e( 'Câu chuyện về Lucky', 'nest' ); ?></h2>
							<div class="section-separator section-separator--light flex justify-center relative mt-2.5">
								<div class="relative w-8 h-3 before:content-[''] before:absolute before:top-0 before:left-2 before:w-2.5 before:h-2.5 before:border before:border-secondary before:rotate-45 after:content-[''] after:absolute after:top-0 after:right-2 after:w-2.5 after:h-2.5 after:border after:border-secondary after:rotate-45"></div>
							</div>
						</div>

						<div class="text-white text-justify text-sm leading-relaxed">
							<?php esc_html_e( 'Như quý vị đã biết: "Tài sản lớn nhất của đời người là sức khỏe và trí tuệ", có sức khỏe và trí tuệ thì sẽ có tất cả. Sản phẩm yến sào là thực phẩm bổ dưỡng mang lại cho Quý vị sức khỏe, trí tuệ và sự trẻ trung. Yến sào được thị trường đón nhận với phương châm: "Chất lượng uy tín là thương hiệu".', 'nest' ); ?>
							<br>
							<?php
							printf(
								/* translators: %s: brand name */
								esc_html__( 'Sản phẩm yến sào của Yến sào %s được khai thác và yến nuôi tổ với chất lượng tuyệt đối...', 'nest' ),
								'<strong>' . esc_html( get_bloginfo( 'name' ) ) . '</strong>'
							);
							?>
						</div>

						<a href="<?php echo esc_url( home_url( nest_get_option( 'about_url', '/gioi-thieu' ) ) ); ?>" class="nest-btn mt-5" title="<?php esc_attr_e( 'Xem chi tiết', 'nest' ); ?>">
							<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
							<span class="nest-btn__text"><?php esc_html_e( 'Xem chi tiết', 'nest' ); ?></span>
							<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco -scale-x-100"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
						</a>

					</div>
				</div>

				<!-- Right: Product Image -->
				<div class="w-full lg:w-1/2 px-2.5 flex justify-center items-center">
					<div class="max-w-[600px] w-full aspect-[600/371]">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/section_about_product_1.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="w-full h-full object-contain" width="600" height="371" loading="lazy">
					</div>
				</div>

			</div>
		</div>
	</div>
</section>
