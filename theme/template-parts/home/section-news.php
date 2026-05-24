<?php
/**
 * Template part for the News section (Tin tức)
 *
 * Fallback rendering when widgets are not configured. Mirrors
 * Nest_Widget_News markup.
 *
 * @package Nest
 */

$eyebrow  = get_bloginfo( 'name' );
$title    = __( 'Tin tức - Tư vấn từ Nest', 'nest' );
$btn_text = __( 'Xem thêm', 'nest' );
$btn_url  = get_permalink( get_option( 'page_for_posts' ) );
if ( ! $btn_url ) {
	$btn_url = home_url( '/' );
}

$posts_query = new WP_Query(
	array(
		'post_type'           => 'post',
		'posts_per_page'      => 7,
		'post_status'         => 'publish',
		'ignore_sticky_posts' => true,
	)
);

if ( ! $posts_query->have_posts() ) {
	return;
}

$posts    = $posts_query->posts;
$featured = array_shift( $posts );
$rest     = $posts;
?>
<section class="section-index section-news py-[30px] max-md:py-[25px]">
	<div class="container mx-auto px-4">
		<div class="section-title text-center relative mb-6">
			<span class="block w-full font-medium uppercase text-primary text-sm max-md:text-xs"><?php echo esc_html( $eyebrow ); ?></span>
			<h2 class="inline-block font-heading font-extrabold text-[2.6rem] max-md:text-[2rem] uppercase mb-0">
				<a href="<?php echo esc_url( $btn_url ); ?>" title="<?php echo esc_attr( $title ); ?>"><?php echo esc_html( $title ); ?></a>
			</h2>
			<div class="section-separator flex justify-center relative mt-2.5">
				<div class="relative w-8 h-3 before:content-[''] before:absolute before:top-0 before:left-2 before:w-2.5 before:h-2.5 before:border before:border-primary before:rotate-45 after:content-[''] after:absolute after:top-0 after:right-2 after:w-2.5 after:h-2.5 after:border after:border-primary after:rotate-45"></div>
			</div>
		</div>

		<div class="flex flex-wrap -mx-2.5">
			<?php if ( $featured ) :
				$f_id      = $featured->ID;
				$f_title   = get_the_title( $f_id );
				$f_link    = get_permalink( $f_id );
				$f_thumb   = get_the_post_thumbnail_url( $f_id, 'large' );
				$f_date    = get_the_date( 'd/m/Y', $f_id );
				$f_excerpt = wp_strip_all_tags( $featured->post_excerpt ? $featured->post_excerpt : wp_trim_words( $featured->post_content, 40 ) );
				?>
				<div class="w-full lg:w-1/3 px-2.5 mb-5 lg:mb-0">
					<a href="<?php echo esc_url( $f_link ); ?>" title="<?php echo esc_attr( $f_title ); ?>" class="news-item news-item--featured group block h-full bg-white border border-primary/10 overflow-hidden transition-shadow duration-300 hover:shadow-lg">
						<div class="relative overflow-hidden aspect-[4/3]">
							<?php if ( $f_thumb ) : ?>
								<img src="<?php echo esc_url( $f_thumb ); ?>" alt="<?php echo esc_attr( $f_title ); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
							<?php else : ?>
								<div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400 text-sm"><?php esc_html_e( 'No image', 'nest' ); ?></div>
							<?php endif; ?>
						</div>
						<div class="p-4">
							<h3 class="font-bold text-base lg:text-lg leading-snug mb-2 line-clamp-2 group-hover:text-hover transition-colors"><?php echo esc_html( $f_title ); ?></h3>
							<?php if ( $f_excerpt ) : ?>
								<p class="text-sm text-gray-600 leading-relaxed mb-3 line-clamp-3"><?php echo esc_html( $f_excerpt ); ?></p>
							<?php endif; ?>
							<p class="flex items-center gap-1.5 text-xs text-gray-500 mb-0">
								<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"></path><path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"></path></svg>
								<span><?php echo esc_html( $f_date ); ?></span>
							</p>
						</div>
					</a>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $rest ) ) : ?>
				<div class="w-full lg:w-2/3 px-2.5">
					<div class="grid grid-cols-2 md:grid-cols-3 gap-4">
						<?php foreach ( $rest as $post_obj ) :
							$p_id    = $post_obj->ID;
							$p_title = get_the_title( $p_id );
							$p_link  = get_permalink( $p_id );
							$p_thumb = get_the_post_thumbnail_url( $p_id, 'medium' );
							$p_date  = get_the_date( 'd/m/Y', $p_id );
							?>
							<a href="<?php echo esc_url( $p_link ); ?>" title="<?php echo esc_attr( $p_title ); ?>" class="news-item group block bg-white border border-primary/10 overflow-hidden transition-shadow duration-300 hover:shadow-lg">
								<div class="relative overflow-hidden aspect-[4/3]">
									<?php if ( $p_thumb ) : ?>
										<img src="<?php echo esc_url( $p_thumb ); ?>" alt="<?php echo esc_attr( $p_title ); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
									<?php else : ?>
										<div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400 text-xs"><?php esc_html_e( 'No image', 'nest' ); ?></div>
									<?php endif; ?>
								</div>
								<div class="p-3">
									<h3 class="font-semibold text-sm leading-snug mb-1.5 line-clamp-2 group-hover:text-hover transition-colors"><?php echo esc_html( $p_title ); ?></h3>
									<p class="flex items-center gap-1 text-[11px] text-gray-500 mb-0">
										<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16"><path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"></path><path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"></path></svg>
										<span><?php echo esc_html( $p_date ); ?></span>
									</p>
								</div>
							</a>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>

		<div class="flex justify-center mt-7">
			<a href="<?php echo esc_url( $btn_url ); ?>" class="nest-btn" title="<?php echo esc_attr( $btn_text ); ?>">
				<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
				<span class="nest-btn__text"><?php echo esc_html( $btn_text ); ?></span>
				<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco -scale-x-100"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
			</a>
		</div>
	</div>
</section>
<?php wp_reset_postdata();
