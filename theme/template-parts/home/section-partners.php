<?php
/**
 * Template part for the Partners section (Đối tác)
 *
 * Fallback rendering when widgets are not configured. Mirrors
 * Nest_Widget_Partners markup.
 *
 * @package Nest
 */

$eyebrow = get_bloginfo( 'name' );
$title   = __( 'Đối tác của chúng tôi', 'nest' );

$uri   = get_template_directory_uri() . '/assets/images/';
$items = array(
	array( 'image' => $uri . 'partner_1.svg', 'url' => '#', 'title' => 'Partner 1' ),
	array( 'image' => $uri . 'partner_2.svg', 'url' => '#', 'title' => 'Partner 2' ),
	array( 'image' => $uri . 'partner_3.svg', 'url' => '#', 'title' => 'Partner 3' ),
	array( 'image' => $uri . 'partner_4.svg', 'url' => '#', 'title' => 'Partner 4' ),
	array( 'image' => $uri . 'partner_5.svg', 'url' => '#', 'title' => 'Partner 5' ),
	array( 'image' => $uri . 'partner_6.svg', 'url' => '#', 'title' => 'Partner 6' ),
);
?>
<section class="section-index section-partners py-[30px] max-md:py-[25px]">
	<div class="container mx-auto px-4">
		<div class="section-title text-center relative mb-6">
			<span class="block w-full font-medium uppercase text-primary text-sm max-md:text-xs"><?php echo esc_html( $eyebrow ); ?></span>
			<h2 class="inline-block font-heading font-extrabold text-[2.6rem] max-md:text-[2rem] uppercase mb-0"><?php echo esc_html( $title ); ?></h2>
			<div class="section-separator flex justify-center relative mt-2.5">
				<div class="relative w-8 h-3 before:content-[''] before:absolute before:top-0 before:left-2 before:w-2.5 before:h-2.5 before:border before:border-primary before:rotate-45 after:content-[''] after:absolute after:top-0 after:right-2 after:w-2.5 after:h-2.5 after:border after:border-primary after:rotate-45"></div>
			</div>
		</div>

		<div class="section-slider section-slider--partners">
			<div class="swiper brands-slider">
				<div class="swiper-wrapper items-center">
					<?php foreach ( $items as $item ) : ?>
						<div class="swiper-slide">
							<a href="<?php echo esc_url( $item['url'] ); ?>" title="<?php echo esc_attr( $item['title'] ); ?>" class="brand-item block p-3 grayscale opacity-70 transition-all duration-300 hover:grayscale-0 hover:opacity-100">
								<img src="<?php echo esc_url( $item['image'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>" class="w-full h-auto max-h-[80px] object-contain mx-auto" width="225" height="113" loading="lazy">
							</a>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="swiper-button-prev">
					<svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="2.13" y="29" width="38" height="38" transform="rotate(-45 2.13 29)" stroke="currentColor" fill="#fff" stroke-width="2" class="rect-outer"></rect><rect x="8" y="29.21" width="30" height="30" transform="rotate(-45 8 29.21)" fill="currentColor" class="rect-inner"></rect><path d="M18.5 29H39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M29 18.5L39.5 29L29 39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
				</div>
				<div class="swiper-button-next">
					<svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="2.13" y="29" width="38" height="38" transform="rotate(-45 2.13 29)" stroke="currentColor" fill="#fff" stroke-width="2" class="rect-outer"></rect><rect x="8" y="29.21" width="30" height="30" transform="rotate(-45 8 29.21)" fill="currentColor" class="rect-inner"></rect><path d="M18.5 29H39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M29 18.5L39.5 29L29 39.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
				</div>
			</div>
		</div>
	</div>
</section>
