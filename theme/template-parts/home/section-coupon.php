<?php
/**
 * Template part for the Coupon section
 *
 * @package Nest
 */

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

$coupons = get_posts(
	array(
		'post_type'      => 'shop_coupon',
		'posts_per_page' => 8,
		'post_status'    => 'publish',
		'orderby'        => 'date',
		'order'          => 'DESC',
	)
);

if ( empty( $coupons ) ) {
	return;
}
?>

<section class="section-index section-coupon py-[30px] max-md:py-[25px]">
	<div class="container mx-auto px-4">

		<!-- Section Title -->
		<div class="section-title text-center relative mb-6">
			<span class="block w-full font-medium uppercase text-primary text-sm max-md:text-xs"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
			<h2 class="inline-block font-heading font-extrabold text-[2.6rem] max-md:text-[2rem] uppercase mb-0"><?php esc_html_e( 'Mã giảm giá dành cho bạn', 'nest' ); ?></h2>
			<div class="section-separator flex justify-center relative mt-2.5">
				<div class="relative w-8 h-3 before:content-[''] before:absolute before:top-0 before:left-2 before:w-2.5 before:h-2.5 before:border before:border-primary before:rotate-45 after:content-[''] after:absolute after:top-0 after:right-2 after:w-2.5 after:h-2.5 after:border after:border-primary after:rotate-45"></div>
			</div>
		</div>

		<!-- Coupon Slider -->
		<div class="section-slider">
			<div class="swiper coupon-slider">
				<div class="swiper-wrapper">
					<?php foreach ( $coupons as $index => $coupon_post ) :
						$wc_coupon      = new WC_Coupon( $coupon_post->ID );
						$code           = $wc_coupon->get_code();
						$amount         = $wc_coupon->get_amount();
						$discount_type  = $wc_coupon->get_discount_type();
						$date_expires   = $wc_coupon->get_date_expires();
						$min_amount     = $wc_coupon->get_minimum_amount();
						$description    = $coupon_post->post_excerpt;

						if ( 'percent' === $discount_type ) {
							$label = sprintf( __( 'Giảm %s%% giá trị đơn hàng', 'nest' ), $amount );
						} else {
							$label = sprintf( __( 'Giảm %s giá trị đơn hàng', 'nest' ), wc_price( $amount ) );
						}

						$expiry_str = $date_expires ? date_i18n( 'd/m/Y', $date_expires->getTimestamp() ) : '';

						$image_index = ( $index % 4 ) + 1;
						$image_url   = get_template_directory_uri() . '/assets/images/img_coupon_' . $image_index . '.jpg';
						if ( has_post_thumbnail( $coupon_post->ID ) ) {
							$image_url = get_the_post_thumbnail_url( $coupon_post->ID, 'thumbnail' );
						}
					?>
						<div class="swiper-slide h-auto py-1">
							<div class="box-coupon relative flex items-center rounded p-2 h-full" style="filter: drop-shadow(0px 0px 3px rgba(0,0,0,0.15));">
								<div class="coupon-mask absolute inset-0 bg-white rounded" style="-webkit-mask: url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/ticket5.svg' ); ?>') no-repeat; mask: url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/ticket5.svg' ); ?>') no-repeat; mask-size: cover; -webkit-mask-size: cover;"></div>

								<div class="relative w-1/3 flex-none flex items-center justify-center aspect-square max-h-[70px]">
									<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( strtoupper( $code ) ); ?>" class="w-full h-full object-contain" width="88" height="88" loading="lazy">
								</div>

								<div class="relative flex-1 flex flex-col justify-between pl-3 min-h-[70px]">
									<div>
										<span class="block text-base font-bold leading-tight"><?php echo esc_html( strtoupper( $code ) ); ?></span>
										<span class="block text-xs text-gray-600 font-medium line-clamp-2 mt-0.5"><?php echo esc_html( $description ? $description : wp_strip_all_tags( $label ) ); ?></span>
									</div>
									<div class="flex items-end justify-between gap-1 mt-1.5">
										<?php if ( $expiry_str ) : ?>
											<span class="text-[11px] text-gray-500 font-medium"><?php printf( esc_html__( 'HSD: %s', 'nest' ), esc_html( $expiry_str ) ); ?></span>
										<?php endif; ?>
										<button class="js-copy-coupon bg-primary text-white text-[11px] font-medium px-2 py-0.5 relative cursor-pointer hover:bg-hover transition-colors before:content-[''] before:absolute before:inset-[2px] before:border before:border-white/30" data-code="<?php echo esc_attr( strtoupper( $code ) ); ?>"><?php esc_html_e( 'Copy mã', 'nest' ); ?></button>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="swiper-button-prev">
					<svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect x="2.13" y="29" width="38" height="38" transform="rotate(-45 2.13 29)" stroke="currentColor" fill="#fff" stroke-width="2" class="rect-outer"></rect>
						<rect x="8" y="29.21" width="30" height="30" transform="rotate(-45 8 29.21)" fill="currentColor" class="rect-inner"></rect>
						<path d="M18.5 29H39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
						<path d="M29 18.5L39.5 29L29 39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
					</svg>
				</div>
				<div class="swiper-button-next">
					<svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect x="2.13" y="29" width="38" height="38" transform="rotate(-45 2.13 29)" stroke="currentColor" fill="#fff" stroke-width="2" class="rect-outer"></rect>
						<rect x="8" y="29.21" width="30" height="30" transform="rotate(-45 8 29.21)" fill="currentColor" class="rect-inner"></rect>
						<path d="M18.5 29H39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
						<path d="M29 18.5L39.5 29L29 39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
					</svg>
				</div>
			</div>
		</div>

	</div>
</section>
