<?php
/**
 * Single Product tabs
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $product_tabs ) ) : ?>

	<div class="woocommerce-tabs wc-tabs-wrapper product-tab" data-product-tabs>

		<!-- Tab Headers -->
		<ul class="tabs wc-tabs flex border-b border-gray-200 overflow-x-auto" role="tablist">
			<?php $first = true; ?>
			<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
				<li class="<?php echo esc_attr( $key ); ?>_tab flex-shrink-0 <?php echo $first ? 'active' : ''; ?>" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
					<a href="#tab-<?php echo esc_attr( $key ); ?>" class="block px-5 py-3.5 text-sm md:text-base font-semibold transition-colors duration-200 border-b-2 <?php echo $first ? 'text-primary border-primary' : 'text-gray-500 border-transparent hover:text-primary'; ?>">
						<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
					</a>
				</li>
				<?php $first = false; ?>
			<?php endforeach; ?>
		</ul>

		<!-- Tab Content -->
		<?php $first = true; ?>
		<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
			<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab p-5 md:p-6 <?php echo $first ? '' : 'hidden'; ?>" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
				<?php
				if ( isset( $product_tab['callback'] ) ) {
					call_user_func( $product_tab['callback'], $key, $product_tab );
				}
				?>
			</div>
			<?php $first = false; ?>
		<?php endforeach; ?>

	</div>

<?php endif; ?>
