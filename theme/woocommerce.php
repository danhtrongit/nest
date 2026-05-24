<?php
/**
 * WooCommerce template wrapper
 *
 * @package Nest
 */

get_header();
?>

<main id="main" class="py-[30px] max-md:py-[25px]">
	<div class="container mx-auto px-4">
		<?php woocommerce_content(); ?>
	</div>
</main>

<?php
get_footer();
