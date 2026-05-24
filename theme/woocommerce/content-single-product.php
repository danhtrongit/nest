<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

	<div class="bg-white rounded-lg shadow-sm p-4 md:p-6 mb-5">
		<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-10">

			<?php
			/**
			 * Hook: woocommerce_before_single_product_summary.
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
			do_action( 'woocommerce_before_single_product_summary' );
			?>

			<div class="summary entry-summary">
				<?php
				/**
				 * Hook: woocommerce_single_product_summary.
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked nest_template_single_meta_info - 12
				 * @hooked woocommerce_template_single_price - 15
				 * @hooked nest_template_single_short_description - 20
				 * @hooked nest_template_single_promotion - 25
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked nest_template_single_share - 45
				 */
				do_action( 'woocommerce_single_product_summary' );
				?>
			</div>

		</div>
	</div>

	<div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-5">
		<div class="lg:col-span-2">
			<div class="bg-white rounded-lg shadow-sm">
				<?php
				/**
				 * Hook: woocommerce_after_single_product_summary.
				 *
				 * @hooked woocommerce_output_product_data_tabs - 10
				 */
				do_action( 'woocommerce_after_single_product_summary' );
				?>
			</div>
		</div>
		<div class="lg:col-span-1">
			<?php
			/**
			 * Product sidebar: specifications + recently viewed.
			 */
			do_action( 'nest_single_product_sidebar' );
			?>
		</div>
	</div>

	<?php
	/**
	 * Hook: nest_after_single_product_tabs.
	 *
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'nest_after_single_product_tabs' );
	?>

</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
