<?php
/**
 * Template part for the 4-banner collection section
 *
 * @package Nest
 */

$banners = array(
	array(
		'image' => 'img_4banner_1.jpg',
		'title' => __( 'Bộ quà 4 mùa', 'nest' ),
		'price' => __( 'Giá chỉ từ 499k', 'nest' ),
		'url'   => '#',
	),
	array(
		'image' => 'img_4banner_2.jpg',
		'title' => __( 'Bộ quà Lộc Phát', 'nest' ),
		'price' => __( 'Giá chỉ từ 599k', 'nest' ),
		'url'   => '#',
	),
	array(
		'image' => 'img_4banner_3.jpg',
		'title' => __( 'Bộ quà Thịnh Vượng', 'nest' ),
		'price' => __( 'Giá chỉ từ 799k', 'nest' ),
		'url'   => '#',
	),
	array(
		'image' => 'img_4banner_4.jpg',
		'title' => __( 'Bộ quà Tài Lộc', 'nest' ),
		'price' => __( 'Giá chỉ từ 999k', 'nest' ),
		'url'   => '#',
	),
);
?>

<section class="section-index py-[30px] max-md:py-[25px]">
	<div class="container mx-auto px-4">

		<!-- Section Title -->
		<div class="section-title text-center relative mb-6">
			<span class="block w-full font-medium uppercase text-primary text-sm max-md:text-xs"><?php esc_html_e( 'Yến sào Lucky', 'nest' ); ?></span>
			<h2 class="inline-block font-heading font-extrabold text-[2.6rem] max-md:text-[2rem] uppercase mb-0"><?php esc_html_e( 'Bộ sưu tập quà tặng cao cấp', 'nest' ); ?></h2>
			<div class="text-base max-md:text-sm mx-auto mt-1 max-w-[760px]"><?php esc_html_e( 'Bộ quà tặng Lucky là giải pháp quà Tết, quà Trung Thu, quà tặng doanh nghiệp,.. được lựa chọn để kết nối các mối quan hệ xã hội, kết nối tình thân, vun đắp các mối quan hệ thêm bền chặt gắn kết.', 'nest' ); ?></div>

			<!-- Separator -->
			<div class="section-separator flex justify-center relative mt-2.5">
				<div class="relative w-8 h-3 before:content-[''] before:absolute before:top-0 before:left-2 before:w-2.5 before:h-2.5 before:border before:border-primary before:rotate-45 after:content-[''] after:absolute after:top-0 after:right-2 after:w-2.5 after:h-2.5 after:border after:border-primary after:rotate-45"></div>
			</div>
		</div>

		<!-- Banners Grid -->
		<div class="flex flex-nowrap md:flex-wrap md:-mx-2.5 max-md:overflow-x-auto max-md:snap-x max-md:snap-mandatory max-md:-mx-4 max-md:px-4 max-md:gap-4">
			<?php foreach ( $banners as $banner ) : ?>
				<div class="w-[65%] shrink-0 snap-start md:w-1/4 md:shrink md:px-2.5">
					<a href="<?php echo esc_url( $banner['url'] ); ?>" class="group/banner block relative overflow-hidden aspect-[382/574]" title="<?php echo esc_attr( $banner['title'] ); ?>">
						<!-- White border overlay -->
						<span class="absolute inset-1 border border-white/50 z-[1] pointer-events-none"></span>
						<!-- Image -->
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $banner['image'] ); ?>" alt="<?php echo esc_attr( $banner['title'] ); ?>" class="w-full h-full object-cover transition-transform duration-300 group-hover/banner:scale-[1.03]" width="382" height="574" loading="lazy">
						<!-- Info overlay -->
						<div class="absolute left-0 w-full p-4 max-lg:p-2.5 bg-black/70 backdrop-blur-sm text-white border-t-2 border-secondary z-[1] transition-all duration-300 bottom-0 lg:-bottom-9 lg:group-hover/banner:bottom-0">
							<h3 class="text-lg max-lg:text-sm font-bold leading-tight mb-0"><?php echo esc_html( $banner['title'] ); ?></h3>
							<span class="block text-sm max-lg:text-xs mt-1"><?php echo esc_html( $banner['price'] ); ?></span>
							<span class="hidden lg:block mt-1.5 text-sm italic text-secondary hover:text-hover"><?php esc_html_e( 'Xem ngay »', 'nest' ); ?></span>
						</div>
					</a>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</section>
