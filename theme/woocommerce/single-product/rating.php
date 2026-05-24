<?php
/**
 * Single Product Rating
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! wc_review_ratings_enabled() ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

if ( $rating_count > 0 ) : ?>
	<div class="woocommerce-product-rating flex items-center gap-2 mb-2">
		<div class="star-rating text-yellow-400 text-sm" role="img" aria-label="<?php printf( esc_attr__( 'Rated %s out of 5', 'woocommerce' ), esc_html( $average ) ); ?>">
			<?php echo wc_get_star_rating_html( $average, $rating_count ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>
		<?php if ( comments_open() ) : ?>
			<a href="#reviews" class="woocommerce-review-link text-sm text-primary hover:underline" rel="nofollow">
				(<?php printf( _n( '%s review', '%s reviews', $review_count, 'woocommerce' ), '<span class="count">' . esc_html( $review_count ) . '</span>' ); ?>)
			</a>
		<?php endif; ?>
	</div>
<?php endif; ?>
