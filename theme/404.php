<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Nest
 */

get_header();
?>

<main id="main" class="py-[30px] max-md:py-[25px]">
	<div class="container mx-auto px-4">

		<div class="bg-white border border-gray-100 rounded-lg p-10 max-md:p-6 text-center max-w-xl mx-auto">

			<!-- 404 illustration -->
			<div class="mb-6">
				<span class="font-heading font-extrabold text-[8rem] max-md:text-[5rem] text-primary/10 leading-none select-none">404</span>
			</div>

			<h1 class="font-heading font-bold text-2xl text-foreground mb-2">
				<?php esc_html_e( 'Không tìm thấy trang', 'nest' ); ?>
			</h1>

			<p class="text-sm text-gray-500 mb-6 max-w-sm mx-auto">
				<?php esc_html_e( 'Trang bạn đang tìm kiếm không tồn tại hoặc đã bị di chuyển. Vui lòng kiểm tra lại đường dẫn hoặc tìm kiếm nội dung bạn cần.', 'nest' ); ?>
			</p>

			<!-- Search form -->
			<?php get_search_form(); ?>

			<!-- Action buttons -->
			<div class="flex flex-col sm:flex-row items-center justify-center gap-3 mt-6">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nest-btn" title="<?php esc_attr_e( 'Về trang chủ', 'nest' ); ?>">
					<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
					<span class="nest-btn__text"><?php esc_html_e( 'Về trang chủ', 'nest' ); ?></span>
					<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco -scale-x-100"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
				</a>

				<?php if ( class_exists( 'WooCommerce' ) ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="nest-btn" title="<?php esc_attr_e( 'Xem sản phẩm', 'nest' ); ?>">
						<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
						<span class="nest-btn__text"><?php esc_html_e( 'Xem sản phẩm', 'nest' ); ?></span>
						<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco -scale-x-100"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
					</a>
				<?php endif; ?>
			</div>

		</div>

	</div>
</main>

<?php
get_footer();
