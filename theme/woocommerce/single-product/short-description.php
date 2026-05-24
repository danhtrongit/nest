<?php
/**
 * Single Product Short Description
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

defined( 'ABSPATH' ) || exit;

global $post;

$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

if ( ! $short_description ) {
	return;
}
?>
<div class="woocommerce-product-details__short-description text-sm text-gray-700 leading-relaxed mb-4">
	<div class="bg-gray-50 rounded-lg p-4">
		<?php echo $short_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</div>
</div>
