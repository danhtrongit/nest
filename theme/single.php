<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Nest
 */

get_header();
?>

<main id="main" class="py-[30px] max-md:py-[25px]">
	<div class="container mx-auto px-4">

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'max-w-4xl mx-auto' ); ?>>

				<!-- Breadcrumb-style meta -->
				<div class="flex items-center gap-2 text-sm text-gray-500 mb-4 flex-wrap">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-primary transition-colors"><?php esc_html_e( 'Trang chủ', 'nest' ); ?></a>
					<span class="text-gray-300">/</span>
					<?php
					$categories = get_the_category();
					if ( ! empty( $categories ) ) :
						$cat = $categories[0];
						?>
						<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" class="hover:text-primary transition-colors"><?php echo esc_html( $cat->name ); ?></a>
						<span class="text-gray-300">/</span>
					<?php endif; ?>
					<span class="text-gray-400 line-clamp-1"><?php the_title(); ?></span>
				</div>

				<!-- Post Header -->
				<header class="mb-6">
					<h1 class="font-heading font-extrabold text-2xl md:text-3xl text-foreground leading-tight mb-4">
						<?php the_title(); ?>
					</h1>

					<div class="flex items-center gap-4 flex-wrap text-sm text-gray-500">
						<!-- Author -->
						<div class="flex items-center gap-1.5">
							<svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"></path>
							</svg>
							<?php nest_posted_by(); ?>
						</div>

						<!-- Date -->
						<div class="flex items-center gap-1.5">
							<svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"></path>
							</svg>
							<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
						</div>

						<!-- Category -->
						<?php if ( ! empty( $categories ) ) : ?>
							<div class="flex items-center gap-1.5">
								<svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
									<path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"></path>
									<path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z"></path>
								</svg>
								<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" class="hover:text-primary transition-colors"><?php echo esc_html( $cat->name ); ?></a>
							</div>
						<?php endif; ?>

						<!-- Comments -->
						<?php if ( comments_open() || get_comments_number() ) : ?>
							<div class="flex items-center gap-1.5">
								<svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
									<path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"></path>
								</svg>
								<?php comments_popup_link( '0', '1', '%', 'hover:text-primary transition-colors' ); ?>
							</div>
						<?php endif; ?>
					</div>
				</header>

				<!-- Featured Image -->
				<?php if ( has_post_thumbnail() ) : ?>
					<figure class="mb-6 overflow-hidden rounded-lg">
						<?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-auto object-cover' ) ); ?>
					</figure>
				<?php endif; ?>

				<!-- Content -->
				<div <?php nest_content_class( 'entry-content max-w-none mb-8' ); ?>>
					<?php
					the_content();

					wp_link_pages(
						array(
							'before' => '<div class="flex items-center gap-2 mt-6 pt-4 border-t border-gray-100 text-sm">' . __( 'Trang:', 'nest' ),
							'after'  => '</div>',
						)
					);
					?>
				</div>

				<!-- Tags -->
				<?php
				$tags_list = get_the_tag_list( '', '' );
				if ( $tags_list ) :
					?>
					<div class="flex items-center gap-2 flex-wrap mb-6 pb-6 border-b border-gray-100">
						<span class="text-sm font-semibold text-foreground"><?php esc_html_e( 'Tags:', 'nest' ); ?></span>
						<div class="post-tags flex items-center gap-1.5 flex-wrap">
							<?php echo $tags_list; // phpcs:ignore ?>
						</div>
					</div>
				<?php endif; ?>

				<!-- Share -->
				<div class="flex items-center gap-3 mb-8 pb-6 border-b border-gray-100">
					<span class="text-sm font-semibold text-foreground"><?php esc_html_e( 'Chia sẻ:', 'nest' ); ?></span>
					<div class="flex items-center gap-2">
						<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode( get_permalink() ); ?>" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full bg-[#1877F2] text-white flex items-center justify-center hover:brightness-110 transition-all" title="Facebook">
							<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M9.101 23.691v-7.98H6.627v-3.667h2.474v-1.58c0-4.085 1.848-5.978 5.858-5.978.401 0 1.09.042 1.587.12V7.99h-1.298c-1.016 0-1.407.611-1.407 1.712v2.04h2.986l-.456 3.668H13.84v7.98"></path></svg>
						</a>
						<a href="https://twitter.com/intent/tweet?url=<?php echo rawurlencode( get_permalink() ); ?>&text=<?php echo rawurlencode( get_the_title() ); ?>" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full bg-black text-white flex items-center justify-center hover:brightness-110 transition-all" title="X">
							<svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path></svg>
						</a>
						<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo rawurlencode( get_permalink() ); ?>" target="_blank" rel="noopener noreferrer" class="w-8 h-8 rounded-full bg-[#0A66C2] text-white flex items-center justify-center hover:brightness-110 transition-all" title="LinkedIn">
							<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"></path></svg>
						</a>
					</div>
				</div>

				<!-- Post Navigation -->
				<div class="post-navigation grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
					<?php
					$prev_post = get_previous_post();
					$next_post = get_next_post();
					?>
					<?php if ( $prev_post ) : ?>
						<a href="<?php echo esc_url( get_permalink( $prev_post ) ); ?>" class="group flex items-center gap-3 p-4 bg-white border border-gray-100 hover:border-primary/30 transition-colors rounded-md">
							<svg class="w-5 h-5 text-gray-400 group-hover:text-primary shrink-0 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"></path>
							</svg>
							<div class="min-w-0">
								<span class="block text-xs text-gray-400 uppercase"><?php esc_html_e( 'Bài trước', 'nest' ); ?></span>
								<span class="block text-sm font-medium text-foreground group-hover:text-primary line-clamp-1 transition-colors"><?php echo esc_html( $prev_post->post_title ); ?></span>
							</div>
						</a>
					<?php else : ?>
						<div></div>
					<?php endif; ?>

					<?php if ( $next_post ) : ?>
						<a href="<?php echo esc_url( get_permalink( $next_post ) ); ?>" class="group flex items-center gap-3 p-4 bg-white border border-gray-100 hover:border-primary/30 transition-colors rounded-md text-right">
							<div class="flex-1 min-w-0">
								<span class="block text-xs text-gray-400 uppercase"><?php esc_html_e( 'Bài sau', 'nest' ); ?></span>
								<span class="block text-sm font-medium text-foreground group-hover:text-primary line-clamp-1 transition-colors"><?php echo esc_html( $next_post->post_title ); ?></span>
							</div>
							<svg class="w-5 h-5 text-gray-400 group-hover:text-primary shrink-0 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
								<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"></path>
							</svg>
						</a>
					<?php endif; ?>
				</div>

				<!-- Related Posts -->
				<?php
				$related_args = array(
					'post_type'      => 'post',
					'posts_per_page' => 3,
					'post__not_in'   => array( get_the_ID() ),
					'orderby'        => 'rand',
				);
				if ( ! empty( $categories ) ) {
					$related_args['cat'] = $cat->term_id;
				}
				$related = new WP_Query( $related_args );
				if ( $related->have_posts() ) :
					?>
					<div class="mb-8">
						<h3 class="font-heading font-bold text-xl text-foreground mb-4 pb-3 border-b border-gray-100">
							<?php esc_html_e( 'Bài viết liên quan', 'nest' ); ?>
						</h3>
						<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
							<?php
							while ( $related->have_posts() ) :
								$related->the_post();
								get_template_part( 'template-parts/content/content', 'card' );
							endwhile;
							wp_reset_postdata();
							?>
						</div>
					</div>
				<?php endif; ?>

				<!-- Comments -->
				<?php
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
				?>

			</article>

		<?php endwhile; ?>

	</div>
</main>

<?php
get_footer();
