<?php
/**
 * Single Product Price
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
?>
<div class="price-box flex flex-wrap items-center gap-3 py-4 border-y border-gray-100 my-4">
	<?php if ( $product->is_on_sale() ) : ?>
		<span class="text-2xl md:text-3xl font-bold text-red-600">
			<?php echo wp_kses_post( wc_price( $product->get_sale_price() ) ); ?>
		</span>
		<del class="text-base md:text-lg text-gray-400 font-medium">
			<?php echo wp_kses_post( wc_price( $product->get_regular_price() ) ); ?>
		</del>
		<?php
		$regular_price = (float) $product->get_regular_price();
		$sale_price    = (float) $product->get_sale_price();
		if ( $product->is_type( 'variable' ) ) {
			$regular_price = (float) $product->get_variation_regular_price( 'max' );
			$sale_price    = (float) $product->get_variation_sale_price( 'min' );
		}
		if ( $regular_price > 0 ) :
			$percent = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
			?>
			<span class="inline-flex items-center bg-red-100 text-red-600 text-xs font-bold px-2 py-1 rounded">
				-<?php echo esc_html( $percent ); ?>%
			</span>
		<?php endif; ?>
	<?php elseif ( $product->get_price() ) : ?>
		<span class="text-2xl md:text-3xl font-bold text-red-600">
			<?php echo wp_kses_post( $product->get_price_html() ); ?>
		</span>
	<?php else : ?>
		<span class="text-lg text-gray-500"><?php esc_html_e( 'Liên hệ', 'nest' ); ?></span>
	<?php endif; ?>
</div>
