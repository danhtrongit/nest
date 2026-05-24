<?php
/**
 * Template Name: Giới thiệu
 * Template Post Type: page
 *
 * Trang giới thiệu Lucky Life Care.
 *
 * @package Nest
 */

get_header();

$assets = get_template_directory_uri() . '/assets/images/';
?>

<main id="main">

	<!-- ════════════════════════════════════════════════════════════════════════
	     1. HERO SECTION
	     ════════════════════════════════════════════════════════════════════════ -->
	<section class="relative overflow-hidden bg-primary bg-cover bg-center bg-no-repeat py-24 max-lg:py-14 max-md:py-10" style="background-image: url('<?php echo esc_url( $assets . 'section_about_bg.jpg' ); ?>')">
		<!-- Dark overlay -->
		<div class="absolute inset-0 bg-primary/70"></div>

		<div class="container mx-auto px-4 relative z-[1]">
			<div class="max-w-3xl mx-auto text-center">

				<!-- Badge -->
				<span class="inline-block bg-secondary/20 border border-secondary/40 text-secondary text-sm font-semibold uppercase tracking-widest px-5 py-1.5 rounded-full mb-6">
					<?php esc_html_e( 'Giới thiệu', 'nest' ); ?>
				</span>

				<h1 class="font-heading font-extrabold text-4xl md:text-5xl lg:text-[3.5rem] text-white leading-tight mb-6">
					<?php esc_html_e( 'Lucky Life Care', 'nest' ); ?>
				</h1>

				<p class="text-secondary font-heading text-xl md:text-2xl font-semibold leading-snug mb-6">
					<?php esc_html_e( 'Chăm sóc sức khỏe bền vững từ tinh hoa thiên nhiên', 'nest' ); ?>
				</p>

				<p class="text-white/90 text-base md:text-lg leading-relaxed max-w-2xl mx-auto">
					<?php esc_html_e( 'Lucky Life Care là thương hiệu chuyên cung cấp các sản phẩm chăm sóc sức khỏe cao cấp có nguồn gốc từ thiên nhiên, được chọn lọc kỹ lưỡng nhằm mang đến giá trị bền vững cho cá nhân, gia đình và doanh nghiệp.', 'nest' ); ?>
				</p>

			</div>
		</div>
	</section>


	<!-- ════════════════════════════════════════════════════════════════════════
	     2. PHILOSOPHY (TRIẾT LÝ)
	     ════════════════════════════════════════════════════════════════════════ -->
	<section class="py-16 max-md:py-10 bg-white">
		<div class="container mx-auto px-4">

			<div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center">

				<!-- Left: Content -->
				<div>
					<p class="text-foreground text-base md:text-lg leading-relaxed mb-6 text-justify">
						<?php esc_html_e( 'Chúng tôi tin rằng: sức khỏe không chỉ là nền tảng của hạnh phúc, mà còn là món quà ý nghĩa nhất để trao gửi sự quan tâm, trân trọng và gắn kết lâu dài.', 'nest' ); ?>
					</p>
					<p class="text-foreground text-base md:text-lg leading-relaxed text-justify">
						<?php esc_html_e( 'Với triết lý đó, Lucky Life Care không ngừng đầu tư vào chất lượng sản phẩm, tính minh bạch và trải nghiệm khách hàng, hướng tới chuẩn mực cao cấp trong ngành chăm sóc sức khỏe tại Việt Nam.', 'nest' ); ?>
					</p>
				</div>

				<!-- Right: Showroom image -->
				<div class="relative">
					<div class="relative rounded-lg overflow-hidden shadow-xl">
						<?php
						// Use the page's featured image or a fallback.
						if ( has_post_thumbnail() ) {
							the_post_thumbnail(
								'large',
								array(
									'class'   => 'w-full h-auto object-cover',
									'loading' => 'lazy',
								)
							);
						} else {
							?>
							<img src="<?php echo esc_url( $assets . 'section_about_product_1.png' ); ?>" alt="<?php esc_attr_e( 'Cửa hàng Lucky Life Care', 'nest' ); ?>" class="w-full h-auto object-cover" loading="lazy">
							<?php
						}
						?>
					</div>
					<!-- Caption -->
					<p class="text-center text-sm text-gray-500 italic mt-3">
						<?php esc_html_e( 'Cửa hàng Lucky Life Care', 'nest' ); ?>
					</p>
				</div>

			</div>

		</div>
	</section>


	<!-- ════════════════════════════════════════════════════════════════════════
	     3. TẦM NHÌN & SỨ MỆNH
	     ════════════════════════════════════════════════════════════════════════ -->
	<section class="py-16 max-md:py-10 bg-gray-50">
		<div class="container mx-auto px-4">

			<div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">

				<!-- Tầm nhìn -->
				<div class="relative bg-white rounded-lg shadow-sm p-8 max-md:p-6 border-t-4 border-primary">
					<!-- Icon -->
					<div class="w-14 h-14 rounded-full bg-gradient-to-r from-secondary to-hover flex items-center justify-center mb-5">
						<svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
							<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
							<path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
						</svg>
					</div>

					<h2 class="font-heading font-extrabold text-2xl md:text-3xl text-primary uppercase mb-4">
						<?php esc_html_e( 'Tầm nhìn', 'nest' ); ?>
					</h2>

					<!-- Separator -->
					<div class="w-12 h-0.5 bg-secondary mb-5"></div>

					<p class="text-foreground text-base leading-relaxed text-justify">
						<?php esc_html_e( 'Trở thành thương hiệu chăm sóc sức khỏe thiên nhiên uy tín hàng đầu Việt Nam, được khách hàng tin chọn trong tiêu dùng cá nhân và là đối tác cung cấp quà tặng sức khỏe cao cấp cho doanh nghiệp, góp phần nâng cao chất lượng sống và lan tỏa giá trị bền vững cho cộng đồng.', 'nest' ); ?>
					</p>
				</div>

				<!-- Sứ mệnh -->
				<div class="relative bg-white rounded-lg shadow-sm p-8 max-md:p-6 border-t-4 border-secondary">
					<!-- Icon -->
					<div class="w-14 h-14 rounded-full bg-gradient-to-r from-secondary to-hover flex items-center justify-center mb-5">
						<svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
							<path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
						</svg>
					</div>

					<h2 class="font-heading font-extrabold text-2xl md:text-3xl text-primary uppercase mb-4">
						<?php esc_html_e( 'Sứ mệnh', 'nest' ); ?>
					</h2>

					<!-- Separator -->
					<div class="w-12 h-0.5 bg-secondary mb-5"></div>

					<ul class="space-y-3 text-foreground text-base leading-relaxed">
						<li class="flex items-start gap-2.5">
							<span class="w-2 h-2 rounded-full bg-secondary shrink-0 mt-2"></span>
							<span><?php esc_html_e( 'Mang đến các giải pháp chăm sóc sức khỏe an toàn – hiệu quả – bền vững từ thiên nhiên.', 'nest' ); ?></span>
						</li>
						<li class="flex items-start gap-2.5">
							<span class="w-2 h-2 rounded-full bg-secondary shrink-0 mt-2"></span>
							<span><?php esc_html_e( 'Nâng tầm các sản phẩm truyền thống như yến sào, nấm linh chi, đông trùng hạ thảo theo tiêu chuẩn chất lượng cao, phù hợp nhu cầu hiện đại.', 'nest' ); ?></span>
						</li>
						<li class="flex items-start gap-2.5">
							<span class="w-2 h-2 rounded-full bg-secondary shrink-0 mt-2"></span>
							<span><?php esc_html_e( 'Đồng hành cùng doanh nghiệp trong việc xây dựng văn hóa tri ân và chăm sóc đối tác, nhân sự thông qua các sản phẩm quà tặng sức khỏe đẳng cấp.', 'nest' ); ?></span>
						</li>
					</ul>
				</div>

			</div>

		</div>
	</section>


	<!-- ════════════════════════════════════════════════════════════════════════
	     4. GIÁ TRỊ CỐT LÕI
	     ════════════════════════════════════════════════════════════════════════ -->
	<section class="py-16 max-md:py-10 bg-white">
		<div class="container mx-auto px-4">

			<!-- Section Title -->
			<div class="section-title text-center relative mb-10">
				<span class="block w-full font-medium uppercase text-primary text-sm max-md:text-xs"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
				<h2 class="inline-block font-heading font-extrabold text-[2.6rem] max-md:text-[2rem] uppercase mb-0"><?php esc_html_e( 'Giá trị cốt lõi', 'nest' ); ?></h2>
				<div class="section-separator flex justify-center relative mt-2.5">
					<div class="relative w-8 h-3 before:content-[''] before:absolute before:top-0 before:left-2 before:w-2.5 before:h-2.5 before:border before:border-primary before:rotate-45 after:content-[''] after:absolute after:top-0 after:right-2 after:w-2.5 after:h-2.5 after:border after:border-primary after:rotate-45"></div>
				</div>
			</div>

			<?php
			$core_values = array(
				array(
					'number' => '01',
					'title'  => __( 'Chất lượng là nền tảng', 'nest' ),
					'desc'   => __( 'Mỗi sản phẩm của Lucky Life Care đều được tuyển chọn kỹ từ vùng nguyên liệu, kiểm soát quy trình và ưu tiên nguồn gốc rõ ràng, an toàn cho người sử dụng.', 'nest' ),
					'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>',
				),
				array(
					'number' => '02',
					'title'  => __( 'Thiên nhiên & bền vững', 'nest' ),
					'desc'   => __( 'Chúng tôi tôn trọng giá trị tự nhiên, hướng đến khai thác và phát triển bền vững, cân bằng lợi ích sức khỏe và môi trường.', 'nest' ),
					'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
				),
				array(
					'number' => '03',
					'title'  => __( 'Minh bạch & uy tín', 'nest' ),
					'desc'   => __( 'Cam kết cung cấp thông tin rõ ràng về sản phẩm, nguồn gốc, thành phần và giá trị sử dụng.', 'nest' ),
					'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>',
				),
				array(
					'number' => '04',
					'title'  => __( 'Lấy khách hàng làm trung tâm', 'nest' ),
					'desc'   => __( 'Không chỉ bán sản phẩm, Lucky Life Care hướng đến giải pháp chăm sóc sức khỏe dài hạn và trải nghiệm dịch vụ chuyên nghiệp.', 'nest' ),
					'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>',
				),
			);
			?>

			<div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
				<?php foreach ( $core_values as $value ) : ?>
					<div class="group relative bg-gray-50 rounded-lg p-6 lg:p-8 border border-gray-100 hover:border-secondary/50 hover:shadow-md transition-all duration-300">
						<div class="flex items-start gap-5">

							<!-- Number + Icon -->
							<div class="shrink-0">
								<div class="w-16 h-16 rounded-full bg-gradient-to-br from-secondary to-hover flex items-center justify-center group-hover:[transform:rotateY(180deg)] transition-all duration-500">
									<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
										<?php echo $value['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- trusted SVG path data. ?>
									</svg>
								</div>
							</div>

							<!-- Text -->
							<div class="flex-1 min-w-0">
								<div class="flex items-baseline gap-3 mb-2">
									<span class="text-secondary/50 font-heading font-extrabold text-3xl leading-none"><?php echo esc_html( $value['number'] ); ?></span>
									<h3 class="font-heading font-bold text-lg lg:text-xl text-primary mb-0"><?php echo esc_html( $value['title'] ); ?></h3>
								</div>
								<p class="text-foreground text-sm lg:text-base leading-relaxed mb-0"><?php echo esc_html( $value['desc'] ); ?></p>
							</div>

						</div>
					</div>
				<?php endforeach; ?>
			</div>

		</div>
	</section>


	<!-- ════════════════════════════════════════════════════════════════════════
	     5. CAM KẾT CỦA LUCKY LIFE CARE
	     ════════════════════════════════════════════════════════════════════════ -->
	<section class="relative overflow-hidden bg-primary bg-cover bg-bottom bg-no-repeat py-16 max-md:py-10 border-y-4 border-hover" style="background-image: url('<?php echo esc_url( $assets . 'section_about_bg.jpg' ); ?>')">
		<!-- Overlay -->
		<div class="absolute inset-0 bg-primary/80"></div>

		<div class="container mx-auto px-4 relative z-[1]">

			<!-- Section Title (light variant) -->
			<div class="section-title text-center relative mb-10">
				<span class="block w-full font-medium uppercase text-white text-sm"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
				<h2 class="inline-block font-heading font-extrabold text-[2.6rem] max-md:text-[2rem] uppercase mb-0 text-secondary drop-shadow-md"><?php esc_html_e( 'Cam kết của Lucky Life Care', 'nest' ); ?></h2>
				<div class="section-separator section-separator--light flex justify-center relative mt-2.5">
					<div class="relative w-8 h-3 before:content-[''] before:absolute before:top-0 before:left-2 before:w-2.5 before:h-2.5 before:border before:border-secondary before:rotate-45 after:content-[''] after:absolute after:top-0 after:right-2 after:w-2.5 after:h-2.5 after:border after:border-secondary after:rotate-45"></div>
				</div>
			</div>

			<?php
			$commitments = array(
				array(
					'title' => __( 'Cam kết chất lượng', 'nest' ),
					'desc'  => __( 'Sản phẩm đúng nguồn gốc, đúng tiêu chuẩn, không pha trộn, không đánh tráo giá trị.', 'nest' ),
					'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
				),
				array(
					'title' => __( 'Cam kết an toàn', 'nest' ),
					'desc'  => __( 'Ưu tiên các sản phẩm có kiểm soát chất lượng, phù hợp sử dụng lâu dài.', 'nest' ),
					'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>',
				),
				array(
					'title' => __( 'Cam kết giá trị thật', 'nest' ),
					'desc'  => __( 'Mỗi sản phẩm mang lại giá trị sức khỏe tương xứng với chi phí khách hàng bỏ ra.', 'nest' ),
					'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
				),
				array(
					'title' => __( 'Cam kết đồng hành', 'nest' ),
					'desc'  => __( 'Hỗ trợ tư vấn sử dụng, thiết kế giải pháp quà tặng theo nhu cầu cá nhân & doanh nghiệp.', 'nest' ),
					'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>',
				),
			);
			?>

			<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
				<?php foreach ( $commitments as $item ) : ?>
					<div class="text-center p-6 bg-white/10 backdrop-blur-sm rounded-lg border border-white/10 hover:bg-white/15 transition-all duration-300">
						<!-- Icon -->
						<div class="w-16 h-16 mx-auto rounded-full bg-secondary/20 border-2 border-secondary/40 flex items-center justify-center mb-4">
							<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
								<?php echo $item['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</svg>
						</div>
						<h3 class="font-heading font-bold text-lg text-secondary mb-3"><?php echo esc_html( $item['title'] ); ?></h3>
						<p class="text-white/85 text-sm leading-relaxed mb-0"><?php echo esc_html( $item['desc'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>

		</div>
	</section>


	<!-- ════════════════════════════════════════════════════════════════════════
	     6. DANH MỤC SẢN PHẨM
	     ════════════════════════════════════════════════════════════════════════ -->
	<section class="py-16 max-md:py-10 bg-white">
		<div class="container mx-auto px-4">

			<!-- Section Title -->
			<div class="section-title text-center relative mb-10">
				<span class="block w-full font-medium uppercase text-primary text-sm max-md:text-xs"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
				<h2 class="inline-block font-heading font-extrabold text-[2.6rem] max-md:text-[2rem] uppercase mb-0"><?php esc_html_e( 'Danh mục sản phẩm', 'nest' ); ?></h2>
				<div class="section-separator flex justify-center relative mt-2.5">
					<div class="relative w-8 h-3 before:content-[''] before:absolute before:top-0 before:left-2 before:w-2.5 before:h-2.5 before:border before:border-primary before:rotate-45 after:content-[''] after:absolute after:top-0 after:right-2 after:w-2.5 after:h-2.5 after:border after:border-primary after:rotate-45"></div>
				</div>
			</div>

			<?php
			$categories = array(
				array(
					'emoji'    => '',
					'title'    => __( 'Yến sào cao cấp', 'nest' ),
					'features' => array(
						__( 'Yến sào nguyên chất, chọn lọc kỹ', 'nest' ),
						__( 'Phù hợp bồi bổ sức khỏe, phục hồi thể trạng', 'nest' ),
						__( 'Lý tưởng cho quà biếu cao cấp', 'nest' ),
					),
					'icon'     => '<path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>',
					'color'    => 'from-amber-100 to-amber-50',
					'accent'   => 'text-amber-700',
					'border'   => 'border-amber-200',
				),
				array(
					'emoji'    => '',
					'title'    => __( 'Nấm linh chi đỏ', 'nest' ),
					'features' => array(
						__( 'Linh chi chất lượng cao', 'nest' ),
						__( 'Hỗ trợ tăng cường sức đề kháng, thanh lọc cơ thể', 'nest' ),
						__( 'Phù hợp sử dụng lâu dài cho người trưởng thành', 'nest' ),
					),
					'icon'     => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>',
					'color'    => 'from-red-100 to-red-50',
					'accent'   => 'text-red-700',
					'border'   => 'border-red-200',
				),
				array(
					'emoji'    => '',
					'title'    => __( 'Nấm đông trùng hạ thảo', 'nest' ),
					'features' => array(
						__( 'Đông trùng hạ thảo nuôi cấy chất lượng cao', 'nest' ),
						__( 'Hỗ trợ bồi bổ sức khỏe, tăng cường sinh lực', 'nest' ),
						__( 'Được ưa chuộng trong chăm sóc sức khỏe hiện đại', 'nest' ),
					),
					'icon'     => '<path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>',
					'color'    => 'from-orange-100 to-orange-50',
					'accent'   => 'text-orange-700',
					'border'   => 'border-orange-200',
				),
				array(
					'emoji'    => '',
					'title'    => __( 'Giải pháp quà tặng doanh nghiệp', 'nest' ),
					'features' => array(
						__( 'Bộ quà sức khỏe cao cấp theo ngân sách', 'nest' ),
						__( 'Thiết kế sang trọng, cá nhân hóa theo thương hiệu', 'nest' ),
						__( 'Phù hợp tri ân đối tác, khách hàng, nhân sự cấp cao', 'nest' ),
					),
					'icon'     => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>',
					'color'    => 'from-emerald-100 to-emerald-50',
					'accent'   => 'text-emerald-700',
					'border'   => 'border-emerald-200',
				),
			);
			?>

			<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
				<?php foreach ( $categories as $cat ) : ?>
					<div class="group bg-gradient-to-b <?php echo esc_attr( $cat['color'] ); ?> rounded-lg p-6 border <?php echo esc_attr( $cat['border'] ); ?> hover:shadow-lg transition-all duration-300">
						<!-- Icon -->
						<div class="w-14 h-14 rounded-full bg-white shadow-sm flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
							<svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 <?php echo esc_attr( $cat['accent'] ); ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
								<?php echo $cat['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</svg>
						</div>

						<h3 class="font-heading font-bold text-lg text-primary mb-4"><?php echo esc_html( $cat['title'] ); ?></h3>

						<ul class="space-y-2.5">
							<?php foreach ( $cat['features'] as $feature ) : ?>
								<li class="flex items-start gap-2 text-sm text-foreground leading-relaxed">
									<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 <?php echo esc_attr( $cat['accent'] ); ?> shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
										<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
									</svg>
									<span><?php echo esc_html( $feature ); ?></span>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endforeach; ?>
			</div>

		</div>
	</section>


	<!-- ════════════════════════════════════════════════════════════════════════
	     7. CTA – CLOSING
	     ════════════════════════════════════════════════════════════════════════ -->
	<section class="py-20 max-md:py-12 bg-gray-50">
		<div class="container mx-auto px-4">

			<div class="max-w-3xl mx-auto text-center">

				<h2 class="font-heading font-extrabold text-3xl md:text-4xl text-primary uppercase mb-4">
					<?php esc_html_e( 'Lucky Life Care', 'nest' ); ?>
				</h2>

				<p class="font-heading text-xl md:text-2xl text-secondary font-semibold italic mb-6">
					<?php esc_html_e( 'A Little Peace of Mind', 'nest' ); ?>
				</p>

				<!-- Separator -->
				<div class="section-separator flex justify-center relative mb-8">
					<div class="relative w-8 h-3 before:content-[''] before:absolute before:top-0 before:left-2 before:w-2.5 before:h-2.5 before:border before:border-primary before:rotate-45 after:content-[''] after:absolute after:top-0 after:right-2 after:w-2.5 after:h-2.5 after:border after:border-primary after:rotate-45"></div>
				</div>

				<p class="text-foreground text-base md:text-lg leading-relaxed mb-8 max-w-2xl mx-auto">
					<?php esc_html_e( 'Chúng tôi không chỉ cung cấp sản phẩm, mà mang đến sự an tâm, giá trị sức khỏe bền vững và đẳng cấp trao gửi trong từng lựa chọn của khách hàng.', 'nest' ); ?>
				</p>

				<!-- CTA Buttons -->
				<div class="flex flex-wrap items-center justify-center gap-4">
					<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="nest-btn" title="<?php esc_attr_e( 'Xem sản phẩm', 'nest' ); ?>">
						<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
						<span class="nest-btn__text"><?php esc_html_e( 'Xem sản phẩm', 'nest' ); ?></span>
						<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco -scale-x-100"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
					</a>

					<a href="<?php echo esc_url( home_url( '/lien-he' ) ); ?>" class="nest-btn nest-btn--primary" title="<?php esc_attr_e( 'Liên hệ tư vấn', 'nest' ); ?>">
						<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
						<span class="nest-btn__text"><?php esc_html_e( 'Liên hệ tư vấn', 'nest' ); ?></span>
						<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco -scale-x-100"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
					</a>
				</div>

			</div>

		</div>
	</section>

</main>

<?php
get_footer();
