<?php
/**
 * The main template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Nest
 */

get_header();
?>

<main id="main" class="py-[30px] max-md:py-[25px]">
	<div class="container mx-auto px-4">

		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<!-- Section Title -->
				<div class="section-title text-center relative mb-6">
					<span class="block w-full font-medium uppercase text-primary text-sm max-md:text-xs">
						<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
					</span>
					<h1 class="inline-block font-heading font-extrabold text-[2.6rem] max-md:text-[2rem] uppercase mb-0">
						<?php single_post_title(); ?>
					</h1>
					<div class="section-separator flex justify-center relative mt-2.5">
						<div class="relative w-8 h-3
							before:content-[''] before:absolute before:top-0 before:left-2
							before:w-2.5 before:h-2.5 before:border before:border-primary before:rotate-45
							after:content-[''] after:absolute after:top-0 after:right-2
							after:w-2.5 after:h-2.5 after:border after:border-primary after:rotate-45">
						</div>
					</div>
				</div>
			<?php endif; ?>

			<!-- Post Grid -->
			<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content/content', 'card' );
				endwhile;
				?>
			</div>

			<!-- Pagination -->
			<?php nest_the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content/content', 'none' ); ?>

		<?php endif; ?>

	</div>
</main>

<?php
get_footer();
