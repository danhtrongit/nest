<?php
/**
 * Template Part: Single Product - Promotion / Gift box
 *
 * Uses ACF or a custom field 'nest_product_promotions' for dynamic promotions.
 * Falls back to a default message if no custom field set.
 *
 * @package Nest
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Try to get promotions from ACF repeater or custom meta.
$promotions = array();

// Support ACF repeater field.
if ( function_exists( 'get_field' ) ) {
	$acf_promos = get_field( 'product_promotions', $product->get_id() );
	if ( $acf_promos && is_array( $acf_promos ) ) {
		foreach ( $acf_promos as $promo ) {
			if ( ! empty( $promo['promotion_text'] ) ) {
				$promotions[] = $promo['promotion_text'];
			}
		}
	}
}

// Fallback: custom meta (comma or newline separated).
if ( empty( $promotions ) ) {
	$meta_promos = get_post_meta( $product->get_id(), 'nest_product_promotions', true );
	if ( $meta_promos ) {
		$promotions = preg_split( '/[\n,]+/', $meta_promos );
		$promotions = array_map( 'trim', $promotions );
		$promotions = array_filter( $promotions );
	}
}

if ( empty( $promotions ) ) {
	return;
}
?>
<div class="block-promotion bg-amber-50 border border-amber-200 rounded-lg p-4 my-4">
	<div class="flex items-center gap-2 mb-2.5 font-semibold text-amber-800 text-sm">
		<svg height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor">
			<path d="M152 0H154.2C186.1 0 215.7 16.91 231.9 44.45L256 85.46L280.1 44.45C296.3 16.91 325.9 0 357.8 0H360C408.6 0 448 39.4 448 88C448 102.4 444.5 115.1 438.4 128H480C497.7 128 512 142.3 512 160V224C512 241.7 497.7 256 480 256H32C14.33 256 0 241.7 0 224V160C0 142.3 14.33 128 32 128H73.6C67.46 115.1 64 102.4 64 88C64 39.4 103.4 0 152 0zM190.5 68.78C182.9 55.91 169.1 48 154.2 48H152C129.9 48 112 65.91 112 88C112 110.1 129.9 128 152 128H225.3L190.5 68.78zM360 48H357.8C342.9 48 329.1 55.91 321.5 68.78L286.7 128H360C382.1 128 400 110.1 400 88C400 65.91 382.1 48 360 48V48zM32 288H224V512H80C53.49 512 32 490.5 32 464V288zM288 512V288H480V464C480 490.5 458.5 512 432 512H288z"></path>
		</svg>
		<?php esc_html_e( 'Quà tặng dành cho bạn:', 'nest' ); ?>
	</div>
	<ul class="space-y-1.5 text-sm text-gray-700">
		<?php foreach ( $promotions as $promo ) : ?>
			<li class="flex items-start gap-2">
				<svg class="w-4 h-4 text-green-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
				<?php echo wp_kses_post( $promo ); ?>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
