<?php
/**
 * Template part for displaying posts as cards in grid layouts
 *
 * Used by: archive.php, index.php, search.php, single.php (related posts)
 *
 * @package Nest
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'group' ); ?>>
	<div class="bg-white border border-gray-100 overflow-hidden h-full flex flex-col shadow-sm hover:shadow-md transition-shadow duration-300">

		<!-- Thumbnail -->
		<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>" class="block aspect-[16/10] overflow-hidden" aria-hidden="true" tabindex="-1">
				<?php the_post_thumbnail( 'medium_large', array(
					'class'   => 'w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300',
					'loading' => 'lazy',
				) ); ?>
			</a>
		<?php else : ?>
			<a href="<?php the_permalink(); ?>" class="block aspect-[16/10] overflow-hidden bg-gray-100 flex items-center justify-center" aria-hidden="true" tabindex="-1">
				<svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1">
					<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a2.25 2.25 0 002.25-2.25V5.25a2.25 2.25 0 00-2.25-2.25H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z"></path>
				</svg>
			</a>
		<?php endif; ?>

		<!-- Content -->
		<div class="p-4 flex flex-col flex-1">

			<!-- Category badge -->
			<?php
			$categories = get_the_category();
			if ( ! empty( $categories ) ) :
				$cat = $categories[0];
				?>
				<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" class="inline-block self-start text-xs font-semibold uppercase text-primary bg-secondary/20 px-2 py-0.5 mb-2 hover:bg-secondary/40 transition-colors">
					<?php echo esc_html( $cat->name ); ?>
				</a>
			<?php endif; ?>

			<!-- Title -->
			<h3 class="font-heading font-bold text-base mb-2 flex-1">
				<a href="<?php the_permalink(); ?>" class="text-foreground hover:text-primary transition-colors line-clamp-2 no-underline">
					<?php the_title(); ?>
				</a>
			</h3>

			<!-- Excerpt -->
			<?php if ( has_excerpt() || get_the_content() ) : ?>
				<p class="text-sm text-gray-600 leading-relaxed line-clamp-2 mb-3">
					<?php echo esc_html( wp_trim_words( get_the_excerpt(), 20, '...' ) ); ?>
				</p>
			<?php endif; ?>

			<!-- Meta: date + read more -->
			<div class="flex items-center justify-between mt-auto pt-3 border-t border-gray-50">
				<div class="flex items-center gap-1.5 text-xs text-gray-400">
					<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
						<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"></path>
					</svg>
					<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
				</div>

				<a href="<?php the_permalink(); ?>" class="text-xs font-semibold text-primary hover:text-hover transition-colors inline-flex items-center gap-1 no-underline">
					<?php esc_html_e( 'Xem thêm', 'nest' ); ?>
					<svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
						<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"></path>
					</svg>
				</a>
			</div>

		</div>

	</div>
</article>
