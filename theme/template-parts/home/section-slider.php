<?php
/**
 * Template part for the homepage hero slider
 *
 * @package Nest
 */

$slides = array(
	get_template_directory_uri() . '/assets/images/slider_1.jpg',
	get_template_directory_uri() . '/assets/images/slider_2.jpg',
);
?>

<section class="section-slider group/slider relative">
	<div class="swiper hero-slider">
		<div class="swiper-wrapper">
			<?php foreach ( $slides as $slide ) : ?>
				<div class="swiper-slide">
					<a href="#">
						<img src="<?php echo esc_url( $slide ); ?>" alt="" class="w-full h-auto object-cover">
					</a>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="swiper-pagination"></div>
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
		<div class="absolute bottom-0 left-0 w-full h-1 z-10">
			<div class="hero-slider-progress h-full bg-secondary" style="width:0"></div>
		</div>
	</div>
</section>
