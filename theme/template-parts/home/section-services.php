<?php
/**
 * Template part for the services/promo section
 *
 * @package Nest
 */

$services = array(
	array(
		'icon'  => 'ser_1.png',
		'title' => __( 'Giao hàng siêu tốc', 'nest' ),
		'desc'  => __( 'Giao hàng trong 24h', 'nest' ),
	),
	array(
		'icon'  => 'ser_2.png',
		'title' => __( 'Tư vấn miễn phí', 'nest' ),
		'desc'  => __( 'Đội ngũ tư vấn tận tình', 'nest' ),
	),
	array(
		'icon'  => 'ser_3.png',
		'title' => __( 'Thanh toán', 'nest' ),
		'desc'  => __( 'Thanh toán an toàn', 'nest' ),
	),
	array(
		'icon'  => 'ser_4.png',
		'title' => __( 'Giải pháp quà tặng', 'nest' ),
		'desc'  => __( 'Dành cho doanh nghiệp', 'nest' ),
	),
);
?>

<section class="section-services py-[30px]">
	<div class="container mx-auto px-4">
		<div class="relative bg-white p-1">

			<!-- Wire decorations -->
			<div class="absolute bottom-full left-[17px] w-px h-[30px] bg-primary"></div>
			<div class="absolute bottom-full right-[17px] w-px h-[30px] bg-primary"></div>
			<div class="absolute top-[14px] left-[14px] w-[7px] h-[7px] border border-primary"></div>
			<div class="absolute top-[5px] left-[17px] w-px h-[13px] bg-primary"></div>
			<div class="absolute top-[14px] right-[14px] w-[7px] h-[7px] border border-primary"></div>
			<div class="absolute top-[5px] right-[17px] w-px h-[13px] bg-primary"></div>

			<!-- Services grid -->
			<div class="border border-primary">
				<div class="flex flex-wrap">
					<?php foreach ( $services as $index => $service ) : ?>
						<div class="service-item w-1/2 md:w-1/4 py-2.5 px-3 lg:py-2.5 lg:px-4 text-center lg:text-left border-primary transition-all duration-300 flex flex-col lg:flex-row items-center gap-1 lg:gap-2.5 <?php echo 3 !== $index ? 'border-r max-md:[&:nth-child(2)]:border-r-0' : ''; ?> <?php echo $index < 2 ? 'max-md:border-b' : ''; ?>">
							<div class="relative w-10 h-10 shrink-0">
								<span class="absolute -bottom-[5px] -left-[5px] w-[50px] h-[50px] rounded-full bg-[#fff3e1] hidden lg:block"></span>
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $service['icon'] ); ?>" alt="<?php echo esc_attr( $service['title'] ); ?>" class="relative w-full h-full object-contain" width="40" height="40">
							</div>
							<div>
								<h3 class="text-lg font-semibold text-primary leading-tight mb-0.5"><?php echo esc_html( $service['title'] ); ?></h3>
								<span class="text-sm text-gray-500 leading-tight"><?php echo esc_html( $service['desc'] ); ?></span>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

		</div>
	</div>
</section>
