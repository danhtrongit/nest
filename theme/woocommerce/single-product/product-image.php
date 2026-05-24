<?php
/**
 * Single Product Image - Gallery with Swiper
 *
 * This template replaces the default WooCommerce product image template.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

global $product;

$attachment_ids = $product->get_gallery_image_ids();
$main_image_id  = $product->get_image_id();
$all_images     = array();

if ( $main_image_id ) {
	$all_images[] = $main_image_id;
}
if ( $attachment_ids ) {
	$all_images = array_merge( $all_images, $attachment_ids );
}

$has_gallery = count( $all_images ) > 1;
?>
<div class="product-gallery sticky top-4" data-product-gallery>

	<?php
	// Sale badge.
	if ( $product->is_on_sale() ) :
		$regular_price = (float) $product->get_regular_price();
		$sale_price    = (float) $product->get_sale_price();
		if ( $product->is_type( 'variable' ) ) {
			$regular_price = (float) $product->get_variation_regular_price( 'max' );
			$sale_price    = (float) $product->get_variation_sale_price( 'min' );
		}
		$percent = 0;
		if ( $regular_price > 0 ) {
			$percent = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
		}
		?>
		<span class="absolute top-3 left-3 z-10 bg-red-500 text-white text-sm font-bold px-2.5 py-1 rounded-md">
			-<?php echo esc_html( $percent ); ?>%
		</span>
	<?php endif; ?>

	<?php if ( ! empty( $all_images ) ) : ?>

		<!-- Main Gallery Swiper -->
		<div class="swiper gallery-top rounded-lg overflow-hidden border border-gray-100 mb-3 relative group">
			<div class="swiper-wrapper">
				<?php foreach ( $all_images as $index => $image_id ) :
					$full_src  = wp_get_attachment_image_url( $image_id, 'full' );
					$large_src = wp_get_attachment_image_url( $image_id, 'woocommerce_single' );
					$alt       = get_post_meta( $image_id, '_wp_attachment_image_alt', true ) ?: get_the_title();
					?>
					<a class="swiper-slide glightbox cursor-zoom-in" href="<?php echo esc_url( $full_src ); ?>" data-gallery="product-gallery" data-glightbox="description: <?php echo esc_attr( $alt ); ?>" data-hash="<?php echo esc_attr( $index ); ?>">
						<img
							src="<?php echo esc_url( $large_src ); ?>"
							alt="<?php echo esc_attr( $alt ); ?>"
							class="w-full h-auto object-contain mx-auto"
							loading="<?php echo 0 === $index ? 'eager' : 'lazy'; ?>"
						>
					</a>
				<?php endforeach; ?>
			</div>
			<!-- Zoom hint icon -->
			<button type="button" class="glightbox-trigger absolute top-3 right-3 z-10 bg-white/80 hover:bg-white text-gray-600 hover:text-primary rounded-full p-2 shadow-md transition-all duration-200 opacity-0 group-hover:opacity-100" aria-label="<?php esc_attr_e( 'Phóng to ảnh', 'nest' ); ?>">
				<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
					<path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16zM11 8v6M8 11h6"/>
				</svg>
			</button>
		</div>

		<?php if ( $has_gallery ) : ?>
			<!-- Thumbnail Swiper -->
			<div class="swiper gallery-thumbs">
				<div class="swiper-wrapper">
					<?php foreach ( $all_images as $index => $image_id ) :
						$thumb_src = wp_get_attachment_image_url( $image_id, 'thumbnail' );
						$alt       = get_post_meta( $image_id, '_wp_attachment_image_alt', true ) ?: get_the_title();
						?>
						<div class="swiper-slide cursor-pointer rounded-md overflow-hidden border-2 border-transparent transition-all duration-200 hover:border-primary [&.swiper-slide-thumb-active]:border-primary" data-hash="<?php echo esc_attr( $index ); ?>">
							<div class="aspect-square">
								<img
									src="<?php echo esc_url( $thumb_src ); ?>"
									alt="<?php echo esc_attr( $alt ); ?>"
									class="w-full h-full object-cover"
									loading="lazy"
								>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="swiper-button-next !text-gray-600 after:!text-sm"></div>
				<div class="swiper-button-prev !text-gray-600 after:!text-sm"></div>
			</div>
		<?php endif; ?>

	<?php else : ?>
		<div class="aspect-square bg-gray-100 rounded-lg flex items-center justify-center">
			<?php echo wc_placeholder_img( 'woocommerce_single' ); ?>
		</div>
	<?php endif; ?>

</div>
