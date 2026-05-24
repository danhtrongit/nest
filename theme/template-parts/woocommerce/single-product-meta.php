<?php
/**
 * Template Part: Single Product - Meta Info (Brand, SKU, Stock)
 *
 * @package Nest
 */

defined( 'ABSPATH' ) || exit;

global $product;

$sku = $product->get_sku();
?>
<div class="product-meta flex flex-wrap items-center gap-x-4 gap-y-1 text-sm text-gray-600 mb-3">
	<?php
	// Brand / Vendor - using product attribute or tag.
	$brand = '';
	if ( taxonomy_exists( 'product_brand' ) ) {
		$brands = get_the_terms( $product->get_id(), 'product_brand' );
		if ( $brands && ! is_wp_error( $brands ) ) {
			$brand = $brands[0]->name;
		}
	}
	if ( ! $brand ) {
		$brand = $product->get_attribute( 'pa_thuong-hieu' );
	}
	if ( $brand ) :
		?>
		<span class="meta-item">
			<span class="text-gray-400"><?php esc_html_e( 'Thương hiệu:', 'nest' ); ?></span>
			<strong class="text-gray-800"><?php echo esc_html( $brand ); ?></strong>
		</span>
		<span class="text-gray-300">|</span>
	<?php endif; ?>

	<?php if ( $sku ) : ?>
		<span class="meta-item">
			<span class="text-gray-400"><?php esc_html_e( 'Mã:', 'nest' ); ?></span>
			<span class="text-gray-800"><?php echo esc_html( $sku ); ?></span>
		</span>
		<span class="text-gray-300">|</span>
	<?php endif; ?>

	<span class="meta-item">
		<span class="text-gray-400"><?php esc_html_e( 'Tình trạng:', 'nest' ); ?></span>
		<?php if ( $product->is_in_stock() ) : ?>
			<span class="text-green-600 font-medium"><?php esc_html_e( 'Còn hàng', 'nest' ); ?></span>
		<?php else : ?>
			<span class="text-red-500 font-medium"><?php esc_html_e( 'Hết hàng', 'nest' ); ?></span>
		<?php endif; ?>
	</span>
</div>
