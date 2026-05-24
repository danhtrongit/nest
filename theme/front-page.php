<?php
/**
 * The front page template
 *
 * @package Nest
 */

get_header();
?>

	<main id="main">
		<?php
		if ( is_active_sidebar( 'homepage-sections' ) ) :
			dynamic_sidebar( 'homepage-sections' );
		else :
			// Fallback: render sections in original order when no widgets configured.
			get_template_part( 'template-parts/home/section', 'slider' );
			get_template_part( 'template-parts/home/section', 'services' );
			get_template_part( 'template-parts/home/section', 'banner' );
			get_template_part( 'template-parts/home/section', 'about' );
			get_template_part( 'template-parts/home/section', 'product-tab' );
			get_template_part( 'template-parts/home/section', 'coupon' );
			get_template_part( 'template-parts/home/section', 'why-choose' );
		endif;
		?>
	</main>

<?php
get_footer();
