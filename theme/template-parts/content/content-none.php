<?php
/**
 * Template part for displaying a message when posts are not found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Nest
 */

?>

<div class="bg-white border border-gray-100 rounded-lg p-10 max-md:p-6 text-center max-w-xl mx-auto">

	<!-- Illustration -->
	<div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gray-50 flex items-center justify-center">
		<?php if ( is_search() ) : ?>
			<svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1">
				<path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
			</svg>
		<?php else : ?>
			<svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1">
				<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"></path>
			</svg>
		<?php endif; ?>
	</div>

	<?php if ( is_search() ) : ?>

		<h2 class="font-heading font-bold text-xl text-foreground mb-2">
			<?php esc_html_e( 'Không tìm thấy kết quả', 'nest' ); ?>
		</h2>

		<p class="text-sm text-gray-500 mb-6 max-w-sm mx-auto">
			<?php esc_html_e( 'Không có kết quả nào phù hợp với từ khóa tìm kiếm của bạn. Vui lòng thử lại với từ khóa khác.', 'nest' ); ?>
		</p>

		<?php get_search_form(); ?>

	<?php elseif ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

		<h2 class="font-heading font-bold text-xl text-foreground mb-2">
			<?php esc_html_e( 'Chưa có bài viết', 'nest' ); ?>
		</h2>

		<p class="text-sm text-gray-500 mb-6">
			<?php esc_html_e( 'Trang web của bạn được thiết lập để hiển thị bài viết mới nhất nhưng chưa có bài viết nào được xuất bản.', 'nest' ); ?>
		</p>

		<a href="<?php echo esc_url( admin_url( 'post-new.php' ) ); ?>" class="nest-btn" title="<?php esc_attr_e( 'Tạo bài viết', 'nest' ); ?>">
			<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
			<span class="nest-btn__text"><?php esc_html_e( 'Tạo bài viết', 'nest' ); ?></span>
			<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco -scale-x-100"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
		</a>

	<?php else : ?>

		<h2 class="font-heading font-bold text-xl text-foreground mb-2">
			<?php esc_html_e( 'Không tìm thấy nội dung', 'nest' ); ?>
		</h2>

		<p class="text-sm text-gray-500 mb-6 max-w-sm mx-auto">
			<?php esc_html_e( 'Nội dung bạn yêu cầu không tồn tại hoặc đã bị xóa. Vui lòng thử tìm kiếm.', 'nest' ); ?>
		</p>

		<?php get_search_form(); ?>

	<?php endif; ?>

	<!-- Back to home -->
	<div class="mt-6">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nest-btn" title="<?php esc_attr_e( 'Về trang chủ', 'nest' ); ?>">
			<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
			<span class="nest-btn__text"><?php esc_html_e( 'Về trang chủ', 'nest' ); ?></span>
			<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco -scale-x-100"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>
		</a>
	</div>

</div>
