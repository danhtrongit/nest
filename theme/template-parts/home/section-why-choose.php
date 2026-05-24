<?php
/**
 * Template part for the Why Choose Us section
 *
 * @package Nest
 */

$items = array(
	array(
		'icon'  => 'why_choise_1_icon.png',
		'title' => __( 'Yến sào cao cấp', 'nest' ),
		'desc'  => __( 'Hoàn toàn được gia công', 'nest' ),
	),
	array(
		'icon'  => 'why_choise_2_icon.png',
		'title' => __( 'Chất lượng tuyệt đối', 'nest' ),
		'desc'  => __( '100% tự nhiên', 'nest' ),
	),
	array(
		'icon'  => 'why_choise_3_icon.png',
		'title' => __( 'Sản phẩm', 'nest' ),
		'desc'  => __( 'Đạt chuẩn ATVSTP', 'nest' ),
	),
	array(
		'icon'  => 'why_choise_4_icon.png',
		'title' => __( 'Giá cả hợp lý', 'nest' ),
		'desc'  => __( 'Không qua trung gian', 'nest' ),
	),
	array(
		'icon'  => 'why_choise_5_icon.png',
		'title' => __( 'Giao hàng', 'nest' ),
		'desc'  => __( 'Siêu tốc trong 24h', 'nest' ),
	),
	array(
		'icon'  => 'why_choise_6_icon.png',
		'title' => __( 'Thanh toán', 'nest' ),
		'desc'  => __( 'Đa dạng và an toàn', 'nest' ),
	),
);

$left_items  = array_slice( $items, 0, 3 );
$right_items = array_slice( $items, 3, 3 );
?>

<section class="section-index section-why-choose py-[30px] max-md:py-[25px]">
	<div class="container mx-auto px-4">

		<!-- Section Title -->
		<div class="section-title text-center relative mb-6">
			<span class="block w-full font-medium uppercase text-primary text-sm max-md:text-xs"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
			<h2 class="inline-block font-heading font-extrabold text-[2.6rem] max-md:text-[2rem] uppercase mb-0"><?php esc_html_e( 'Vì sao chọn chúng tôi', 'nest' ); ?></h2>
			<div class="section-separator flex justify-center relative mt-2.5">
				<div class="relative w-8 h-3 before:content-[''] before:absolute before:top-0 before:left-2 before:w-2.5 before:h-2.5 before:border before:border-primary before:rotate-45 after:content-[''] after:absolute after:top-0 after:right-2 after:w-2.5 after:h-2.5 after:border after:border-primary after:rotate-45"></div>
			</div>
		</div>

		<!-- Desktop: 3-column layout -->
		<div class="flex flex-wrap items-center -mx-2.5 max-md:hidden">

			<!-- Left column -->
			<div class="w-full md:w-1/3 px-2.5">
				<?php foreach ( $left_items as $index => $item ) : ?>
					<div class="why-choose-item group flex items-center flex-row-reverse justify-between py-2.5 mb-5 <?php echo 1 === $index ? 'xl:mr-[10%]' : ''; ?>">
						<div class="why-choose-icon flex items-center justify-center w-[90px] h-[90px] lg:w-[70px] lg:h-[70px] rounded-full bg-gradient-to-r from-secondary to-hover transition-all duration-500 lg:group-hover:[transform:rotateY(180deg)] shrink-0">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $item['icon'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" class="w-16 h-16 lg:w-11 lg:h-11" width="64" height="64" loading="lazy">
						</div>
						<div class="flex-1 text-right pr-3">
							<h3 class="font-bold text-primary text-xl lg:text-base mb-0"><?php echo esc_html( $item['title'] ); ?></h3>
							<p class="mt-1.5 text-base lg:text-sm font-medium leading-snug mb-0"><?php echo esc_html( $item['desc'] ); ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

			<!-- Center: product image -->
			<div class="w-full md:w-1/3 px-2.5 flex justify-center">
				<div class="w-full aspect-[429/499]">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/banner_choise.png' ); ?>" alt="<?php esc_attr_e( 'Vì sao chọn chúng tôi', 'nest' ); ?>" class="w-full h-full object-contain" width="429" height="499" loading="lazy">
				</div>
			</div>

			<!-- Right column -->
			<div class="w-full md:w-1/3 px-2.5">
				<?php foreach ( $right_items as $index => $item ) : ?>
					<div class="why-choose-item group flex items-center justify-between py-2.5 mb-5 <?php echo 1 === $index ? 'xl:ml-[10%]' : ''; ?>">
						<div class="why-choose-icon flex items-center justify-center w-[90px] h-[90px] lg:w-[70px] lg:h-[70px] rounded-full bg-gradient-to-r from-secondary to-hover transition-all duration-500 lg:group-hover:[transform:rotateY(180deg)] shrink-0">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $item['icon'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" class="w-16 h-16 lg:w-11 lg:h-11" width="64" height="64" loading="lazy">
						</div>
						<div class="flex-1 text-left pl-3">
							<h3 class="font-bold text-primary text-xl lg:text-base mb-0"><?php echo esc_html( $item['title'] ); ?></h3>
							<p class="mt-1.5 text-base lg:text-sm font-medium leading-snug mb-0"><?php echo esc_html( $item['desc'] ); ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

		</div>

		<!-- Mobile: horizontal scroll -->
		<div class="md:hidden">
			<div class="flex flex-nowrap overflow-x-auto snap-x snap-mandatory -mx-[14px] px-[7px] scrollbar-none mb-3">
				<?php foreach ( $items as $item ) : ?>
					<div class="flex-none w-4/5 snap-start px-[7px]">
						<div class="flex items-center py-0 mb-3">
							<div class="flex items-center justify-center w-[70px] h-[70px] rounded-full bg-gradient-to-r from-secondary to-hover shrink-0 order-1">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $item['icon'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" class="w-12 h-12" width="48" height="48" loading="lazy">
							</div>
							<div class="flex-1 text-left pl-3 order-0">
								<h3 class="font-bold text-primary text-base mb-0"><?php echo esc_html( $item['title'] ); ?></h3>
								<p class="mt-1 text-sm font-medium leading-snug mb-0"><?php echo esc_html( $item['desc'] ); ?></p>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

			<!-- Mobile center image -->
			<div class="flex justify-center">
				<div class="max-w-[280px] w-full">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/banner_choise.png' ); ?>" alt="<?php esc_attr_e( 'Vì sao chọn chúng tôi', 'nest' ); ?>" class="w-full h-auto" width="429" height="499" loading="lazy">
				</div>
			</div>
		</div>

	</div>
</section>
