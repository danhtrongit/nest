<?php
/**
 * Product card template — used on shop, archive and related products.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// WooCommerce wraps each product in <li> via woocommerce_product_loop_start/end.
// We hook into woocommerce_before_shop_loop_item / woocommerce_after_shop_loop_item
// but since we override the entire template, we don't call those hooks.
// The <li> wrapper is already provided by WC's loop-start.php / loop-end.php.

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$permalink     = get_permalink( $product->get_id() );
$title         = get_the_title( $product->get_id() );
$image         = $product->get_image( 'woocommerce_thumbnail', array( 'class' => 'duration-300 w-full h-auto', 'loading' => 'lazy' ) );
$regular_price = $product->get_regular_price();
$sale_price    = $product->get_sale_price();
$is_on_sale    = $product->is_on_sale();

// Sale percentage.
$percent = 0;
if ( $is_on_sale && (float) $regular_price > 0 ) {
	if ( $product->is_type( 'variable' ) ) {
		$rp = (float) $product->get_variation_regular_price( 'max' );
		$sp = (float) $product->get_variation_sale_price( 'min' );
	} else {
		$rp = (float) $regular_price;
		$sp = (float) $sale_price;
	}
	$percent = round( ( ( $rp - $sp ) / $rp ) * 100 );
}

// Promotions (ACF or custom meta).
$promotions = array();
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
if ( empty( $promotions ) ) {
	$meta_promos = get_post_meta( $product->get_id(), 'nest_product_promotions', true );
	if ( $meta_promos ) {
		$promotions = array_filter( array_map( 'trim', preg_split( '/[\n,]+/', $meta_promos ) ) );
	}
}
?>
<li <?php wc_product_class( '', $product ); ?>>
<div class="item_product_main">
	<div class="product-action item-product-main duration-300">

		<?php if ( $is_on_sale && $percent > 0 ) : ?>
			<span class="flash-sale">-<?php echo esc_html( $percent ); ?>%</span>
		<?php endif; ?>

		<?php if ( ! empty( $promotions ) ) : ?>
			<div class="tag-promo" title="<?php esc_attr_e( 'Quà tặng', 'nest' ); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 512 512"><path d="M152 0H154.2C186.1 0 215.7 16.91 231.9 44.45L256 85.46L280.1 44.45C296.3 16.91 325.9 0 357.8 0H360C408.6 0 448 39.4 448 88C448 102.4 444.5 115.1 438.4 128H480C497.7 128 512 142.3 512 160V224C512 241.7 497.7 256 480 256H32C14.33 256 0 241.7 0 224V160C0 142.3 14.33 128 32 128H73.6C67.46 115.1 64 102.4 64 88C64 39.4 103.4 0 152 0zM32 288H224V512H80C53.49 512 32 490.5 32 464V288zM288 512V288H480V464C480 490.5 458.5 512 432 512H288z"></path></svg>
				<div class="promotion-content">
					<div class="line-clamp-5-new">
						<?php foreach ( $promotions as $promo ) : ?>
							<p><?php echo wp_kses_post( '- ' . $promo ); ?></p>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<div class="product-thumbnail">
			<a class="image_thumb scale_hover" href="<?php echo esc_url( $permalink ); ?>" title="<?php echo esc_attr( $title ); ?>">
				<?php echo $image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</a>
		</div>

		<div class="product-info">
			<div class="name-price">
				<h3 class="product-name line-clamp-2-new">
					<a href="<?php echo esc_url( $permalink ); ?>" title="<?php echo esc_attr( $title ); ?>">
						<?php echo esc_html( $title ); ?>
					</a>
				</h3>
				<div class="product-price-cart">
					<?php if ( $is_on_sale ) : ?>
						<span class="compare-price"><?php echo wp_kses_post( wc_price( $regular_price ) ); ?></span>
						<span class="price"><?php echo wp_kses_post( wc_price( $sale_price ) ); ?></span>
					<?php elseif ( $product->get_price() ) : ?>
						<span class="price"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
					<?php else : ?>
						<span class="price"><?php esc_html_e( 'Liên hệ', 'nest' ); ?></span>
					<?php endif; ?>
				</div>
			</div>
			<div class="product-button">
				<?php if ( $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() ) : ?>
					<a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" data-quantity="1" class="btn-cart btn-views add_to_cart btn btn-primary ajax_add_to_cart" data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" title="<?php esc_attr_e( 'Thêm vào giỏ hàng', 'nest' ); ?>">
						<span><?php esc_html_e( 'Thêm vào giỏ', 'nest' ); ?></span>
						<svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 32 32"><g><g><path d="m23.8 30h-15.6c-3.3 0-6-2.7-6-6v-.2l.6-16c.1-3.3 2.8-5.8 6-5.8h14.4c3.2 0 5.9 2.5 6 5.8l.6 16c.1 1.6-.5 3.1-1.6 4.3s-2.6 1.9-4.2 1.9c0 0-.1 0-.2 0zm-15-26c-2.2 0-3.9 1.7-4 3.8l-.6 16.2c0 2.2 1.8 4 4 4h15.8c1.1 0 2.1-.5 2.8-1.3s1.1-1.8 1.1-2.9l-.6-16c-.1-2.2-1.8-3.8-4-3.8z"></path></g><g><path d="m16 14c-3.9 0-7-3.1-7-7 0-.6.4-1 1-1s1 .4 1 1c0 2.8 2.2 5 5 5s5-2.2 5-5c0-.6.4-1 1-1s1 .4 1 1c0 3.9-3.1 7-7 7z"></path></g></g></svg>
					</a>
				<?php else : ?>
					<a href="<?php echo esc_url( $permalink ); ?>" class="btn-cart btn-views btn btn-primary" title="<?php esc_attr_e( 'Tùy chọn', 'nest' ); ?>">
						<span><?php esc_html_e( 'Tùy chọn', 'nest' ); ?></span>
						<svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 32 32"><g><g><path d="m23.8 30h-15.6c-3.3 0-6-2.7-6-6v-.2l.6-16c.1-3.3 2.8-5.8 6-5.8h14.4c3.2 0 5.9 2.5 6 5.8l.6 16c.1 1.6-.5 3.1-1.6 4.3s-2.6 1.9-4.2 1.9c0 0-.1 0-.2 0zm-15-26c-2.2 0-3.9 1.7-4 3.8l-.6 16.2c0 2.2 1.8 4 4 4h15.8c1.1 0 2.1-.5 2.8-1.3s1.1-1.8 1.1-2.9l-.6-16c-.1-2.2-1.8-3.8-4-3.8z"></path></g><g><path d="m16 14c-3.9 0-7-3.1-7-7 0-.6.4-1 1-1s1 .4 1 1c0 2.8 2.2 5 5 5s5-2.2 5-5c0-.6.4-1 1-1s1 .4 1 1c0 3.9-3.1 7-7 7z"></path></g></g></svg>
					</a>
				<?php endif; ?>
			</div>
		</div>

	</div>
</div>
</li>
