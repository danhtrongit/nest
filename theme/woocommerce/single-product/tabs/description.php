<?php
/**
 * Description tab content
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.0.0
 */

defined( 'ABSPATH' ) || exit;

global $post;

$heading = apply_filters( 'woocommerce_product_description_heading', '' );
?>

<?php if ( $heading ) : ?>
	<h2 class="text-lg font-bold mb-4"><?php echo esc_html( $heading ); ?></h2>
<?php endif; ?>

<div class="product-description prose prose-neutral max-w-none
	prose-headings:text-gray-900 prose-headings:font-bold
	prose-p:text-gray-700 prose-p:leading-relaxed
	prose-img:rounded-lg prose-img:mx-auto
	prose-li:text-gray-700
	prose-a:text-primary prose-a:no-underline hover:prose-a:underline">
	<?php the_content(); ?>
</div>

<!-- Show more / Show less on mobile -->
<div class="show-more mt-4 lg:hidden" data-show-more>
	<button type="button" class="nest-btn inline-flex items-center justify-center font-semibold transition-all duration-300 cursor-pointer h-10 px-6 text-base gap-2 bg-transparent text-primary border-2 border-primary hover:bg-primary hover:text-white w-full rounded-md">
		<span class="more-text inline-flex items-center gap-1.5">
			<span class="nest-btn__text"><?php esc_html_e( 'Xem thêm', 'nest' ); ?></span>
			<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"></path></svg>
		</span>
		<span class="less-text hidden inline-flex items-center gap-1.5">
			<span class="nest-btn__text"><?php esc_html_e( 'Thu gọn', 'nest' ); ?></span>
			<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"></path></svg>
		</span>
	</button>
</div>
