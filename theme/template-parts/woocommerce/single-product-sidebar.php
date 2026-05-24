<?php
/**
 * Template Part: Single Product - Sidebar (Specifications + Recently Viewed)
 *
 * @package Nest
 */

defined( 'ABSPATH' ) || exit;

global $product;
?>
<div class="product-sidebar space-y-5 lg:sticky lg:top-4">

	<?php
	// ── Product Specifications ──
	// Tries ACF 'product_specifications' group, then product attributes.
	$specifications = array();

	// 1. ACF repeater field.
	if ( function_exists( 'get_field' ) ) {
		$acf_specs = get_field( 'product_specifications', $product->get_id() );
		if ( $acf_specs && is_array( $acf_specs ) ) {
			foreach ( $acf_specs as $spec ) {
				if ( ! empty( $spec['label'] ) && ! empty( $spec['value'] ) ) {
					$specifications[ $spec['label'] ] = $spec['value'];
				}
			}
		}
	}

	// 2. Fallback: WooCommerce product attributes.
	if ( empty( $specifications ) ) {
		$attributes = $product->get_attributes();
		if ( $attributes ) {
			foreach ( $attributes as $attribute ) {
				if ( $attribute->get_visible() ) {
					$name = wc_attribute_label( $attribute->get_name() );
					if ( $attribute->is_taxonomy() ) {
						$values = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'names' ) );
						$value  = implode( ', ', $values );
					} else {
						$value = implode( ', ', $attribute->get_options() );
					}
					if ( $value ) {
						$specifications[ $name ] = $value;
					}
				}
			}
		}
	}

	// Also add Weight and Dimensions if available.
	if ( $product->has_weight() ) {
		$specifications[ __( 'Khối lượng', 'nest' ) ] = wc_format_weight( $product->get_weight() );
	}
	if ( $product->has_dimensions() ) {
		$specifications[ __( 'Kích thước', 'nest' ) ] = wc_format_dimensions( $product->get_dimensions( false ) );
	}

	if ( ! empty( $specifications ) ) :
		?>
		<div class="bg-white rounded-lg shadow-sm p-4 md:p-5">
			<h3 class="text-base font-bold text-gray-900 mb-4 pb-3 border-b border-gray-100">
				<?php esc_html_e( 'Thông tin chi tiết', 'nest' ); ?>
			</h3>
			<table class="w-full text-sm">
				<tbody>
					<?php
					$row_index = 0;
					foreach ( $specifications as $label => $value ) :
						$row_index++;
						?>
						<tr class="<?php echo $row_index % 2 === 0 ? 'bg-gray-50' : ''; ?>">
							<td class="py-2.5 px-3 font-semibold text-gray-700 w-2/5 align-top">
								<?php echo esc_html( $label ); ?>
							</td>
							<td class="py-2.5 px-3 text-gray-600 align-top">
								<?php echo wp_kses_post( $value ); ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	<?php endif; ?>

	<?php
	// ── Recently Viewed Products ──
	// Rendered via JavaScript in footer (WC session cookie or localStorage).
	?>
	<div class="recently-viewed-products bg-white rounded-lg shadow-sm p-4 md:p-5 hidden" data-recently-viewed>
		<h3 class="text-base font-bold text-gray-900 mb-4 pb-3 border-b border-gray-100">
			<?php esc_html_e( 'Bạn đã xem', 'nest' ); ?>
		</h3>
		<div class="recently-viewed-content space-y-3">
			<!-- Populated via JavaScript -->
		</div>
	</div>

</div>
