<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Nest
 */

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function nest_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'nest_pingback_header' );

/**
 * Changes comment form default fields.
 *
 * @param array $defaults The default comment form arguments.
 *
 * @return array Returns the modified fields.
 */
function nest_comment_form_defaults( $defaults ) {
	$comment_field = $defaults['comment_field'];

	// Adjust height of comment form.
	$defaults['comment_field'] = preg_replace( '/rows="\d+"/', 'rows="5"', $comment_field );

	return $defaults;
}
add_filter( 'comment_form_defaults', 'nest_comment_form_defaults' );

/**
 * Filters the default archive titles.
 */
function nest_get_the_archive_title() {
	if ( is_category() ) {
		$title = '<span>' . single_term_title( '', false ) . '</span>';
	} elseif ( is_tag() ) {
		$title = __( 'Tag Archives: ', 'nest' ) . '<span>' . single_term_title( '', false ) . '</span>';
	} elseif ( is_author() ) {
		$title = __( 'Author Archives: ', 'nest' ) . '<span>' . get_the_author_meta( 'display_name' ) . '</span>';
	} elseif ( is_year() ) {
		$title = __( 'Yearly Archives: ', 'nest' ) . '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'nest' ) ) . '</span>';
	} elseif ( is_month() ) {
		$title = __( 'Monthly Archives: ', 'nest' ) . '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'nest' ) ) . '</span>';
	} elseif ( is_day() ) {
		$title = __( 'Daily Archives: ', 'nest' ) . '<span>' . get_the_date() . '</span>';
	} elseif ( is_post_type_archive() ) {
		$cpt   = get_post_type_object( get_queried_object()->name );
		$title = sprintf(
			/* translators: %s: Post type singular name */
			esc_html__( '%s Archives', 'nest' ),
			$cpt->labels->singular_name
		);
	} elseif ( is_tax() ) {
		$tax   = get_taxonomy( get_queried_object()->taxonomy );
		$title = sprintf(
			/* translators: %s: Taxonomy singular name */
			esc_html__( '%s Archives', 'nest' ),
			$tax->labels->singular_name
		);
	} else {
		$title = __( 'Archives:', 'nest' );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'nest_get_the_archive_title' );

/**
 * Determines whether the post thumbnail can be displayed.
 */
function nest_can_show_post_thumbnail() {
	return apply_filters( 'nest_can_show_post_thumbnail', ! post_password_required() && ! is_attachment() && has_post_thumbnail() );
}

/**
 * Returns the size for avatars used in the theme.
 */
function nest_get_avatar_size() {
	return 60;
}

/**
 * Create the continue reading link
 *
 * @param string $more_string The string shown within the more link.
 */
function nest_continue_reading_link( $more_string ) {

	if ( ! is_admin() ) {
		$continue_reading = sprintf(
			/* translators: %s: Name of current post. */
			wp_kses( __( 'Continue reading %s', 'nest' ), array( 'span' => array( 'class' => array() ) ) ),
			the_title( '<span class="sr-only">"', '"</span>', false )
		);

		$more_string = '<a href="' . esc_url( get_permalink() ) . '">' . $continue_reading . '</a>';
	}

	return $more_string;
}

// Filter the excerpt more link.
add_filter( 'excerpt_more', 'nest_continue_reading_link' );

// Filter the content more link.
add_filter( 'the_content_more_link', 'nest_continue_reading_link' );

/**
 * Outputs a comment in the HTML5 format.
 *
 * This function overrides the default WordPress comment output in HTML5
 * format, adding the required class for Tailwind Typography. Based on the
 * `html5_comment()` function from WordPress core.
 *
 * @param WP_Comment $comment Comment to display.
 * @param array      $args    An array of arguments.
 * @param int        $depth   Depth of the current comment.
 */
function nest_html5_comment( $comment, $args, $depth ) {
	$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

	$commenter          = wp_get_current_commenter();
	$show_pending_links = ! empty( $commenter['comment_author'] );

	if ( $commenter['comment_author_email'] ) {
		$moderation_note = __( 'Your comment is awaiting moderation.', 'nest' );
	} else {
		$moderation_note = __( 'Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.', 'nest' );
	}
	?>
	<<?php echo esc_attr( $tag ); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $comment->has_children ? 'parent' : '', $comment ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
					if ( 0 !== $args['avatar_size'] ) {
						echo get_avatar( $comment, $args['avatar_size'] );
					}
					?>
					<?php
					$comment_author = get_comment_author_link( $comment );

					if ( '0' === $comment->comment_approved && ! $show_pending_links ) {
						$comment_author = get_comment_author( $comment );
					}

					printf(
						/* translators: %s: Comment author link. */
						wp_kses_post( __( '%s <span class="says">says:</span>', 'nest' ) ),
						sprintf( '<b class="fn">%s</b>', wp_kses_post( $comment_author ) )
					);
					?>
				</div><!-- .comment-author -->

				<div class="comment-metadata">
					<?php
					printf(
						'<a href="%s"><time datetime="%s">%s</time></a>',
						esc_url( get_comment_link( $comment, $args ) ),
						esc_attr( get_comment_time( 'c' ) ),
						esc_html(
							sprintf(
							/* translators: 1: Comment date, 2: Comment time. */
								__( '%1$s at %2$s', 'nest' ),
								get_comment_date( '', $comment ),
								get_comment_time()
							)
						)
					);

					edit_comment_link( __( 'Edit', 'nest' ), ' <span class="edit-link">', '</span>' );
					?>
				</div><!-- .comment-metadata -->

				<?php if ( '0' === $comment->comment_approved ) : ?>
				<em class="comment-awaiting-moderation"><?php echo esc_html( $moderation_note ); ?></em>
				<?php endif; ?>
			</footer><!-- .comment-meta -->

			<div <?php nest_content_class( 'comment-content' ); ?>>
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<?php
			if ( '1' === $comment->comment_approved || $show_pending_links ) {
				comment_reply_link(
					array_merge(
						$args,
						array(
							'add_below' => 'div-comment',
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before'    => '<div class="reply">',
							'after'     => '</div>',
						)
					)
				);
			}
			?>
		</article><!-- .comment-body -->
	<?php
}

/**
 * Render a footer column header with the accordion-toggle button.
 * Used inside both widget output and template-part fallbacks so behavior
 * stays identical regardless of source.
 *
 * @param string $title       Visible heading text.
 * @param string $content_id  Unique id assigned to the collapsible content.
 */
function nest_render_footer_accordion_header( $title, $content_id ) {
	?>
	<h4 class="footer-title font-heading text-[1.1rem] font-bold text-white uppercase tracking-wide leading-normal mb-3 max-md:mb-0">
		<button type="button" class="footer-section__toggle relative w-full flex items-center justify-between gap-2 text-left md:pointer-events-none md:cursor-default max-md:py-3 max-md:border-b max-md:border-white/10" aria-expanded="false" aria-controls="<?php echo esc_attr( $content_id ); ?>">
			<span class="relative block pl-6 before:content-[''] before:absolute before:top-1/2 before:-translate-y-1/2 before:left-0 before:w-2.5 before:h-2.5 before:border before:border-secondary before:rotate-45 after:content-[''] after:absolute after:top-1/2 after:-translate-y-1/2 after:left-1.5 after:w-2.5 after:h-2.5 after:border after:border-secondary after:rotate-45"><?php echo esc_html( $title ); ?></span>
			<svg class="footer-section__chevron md:hidden shrink-0 w-3 h-3 fill-white/80 transition-transform duration-200" viewBox="0 0 16 16"><path d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>
		</button>
	</h4>
	<?php
}

/**
 * Render a footer fallback link list section (used when the column sidebar has
 * no widgets configured). If a nav menu location exists, render that; otherwise
 * render a plain list of labels (URL=#) for placeholder display.
 *
 * @param string $title    Section title.
 * @param string $menu_loc Optional theme_location to try first.
 * @param array  $labels   Fallback labels when the menu location is empty.
 */
function nest_render_footer_fallback( $title, $menu_loc, $labels ) {
	$uid = wp_unique_id( 'footer-acc-' );
	?>
	<div class="footer-section" data-footer-accordion>
		<?php nest_render_footer_accordion_header( $title, $uid ); ?>
		<div id="<?php echo esc_attr( $uid ); ?>" class="footer-section__content max-md:hidden md:!block">
			<?php
			if ( $menu_loc && has_nav_menu( $menu_loc ) ) {
				wp_nav_menu(
					array(
						'theme_location' => $menu_loc,
						'container'      => false,
						'menu_class'     => 'footer-menu-list leading-[30px]',
						'depth'          => 1,
						'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
					)
				);
			} else {
				echo '<ul class="footer-menu-list leading-[30px]">';
				foreach ( $labels as $label ) {
					echo '<li><a href="#">' . esc_html( $label ) . '</a></li>';
				}
				echo '</ul>';
			}
			?>
		</div>
	</div>
	<?php
}

/**
 * Render a footer fallback image grid section (used for payment/cert columns).
 *
 * @param string $title Section title.
 * @param array  $items List of [image, alt, url?] rows.
 * @param string $size  'sm' (63x29) or 'lg' (height 45px).
 */
function nest_render_footer_images_fallback( $title, $items, $size = 'sm' ) {
	$uid         = wp_unique_id( 'footer-acc-' );
	$img_classes = 'lg' === $size ? 'h-[45px] w-auto' : 'w-[63px] h-[29px] rounded-[5px] object-contain';
	?>
	<div class="footer-section" data-footer-accordion>
		<?php nest_render_footer_accordion_header( $title, $uid ); ?>
		<div id="<?php echo esc_attr( $uid ); ?>" class="footer-section__content max-md:hidden md:!block">
			<div class="flex flex-wrap gap-1.5 pt-2 md:pt-0">
				<?php foreach ( $items as $item ) :
					$img = isset( $item['image'] ) ? $item['image'] : '';
					$alt = isset( $item['alt'] ) ? $item['alt'] : '';
					$url = isset( $item['url'] ) ? $item['url'] : '';
					if ( ! $img ) {
						continue;
					}
					$tag = sprintf( '<img src="%s" alt="%s" class="%s" loading="lazy">', esc_url( $img ), esc_attr( $alt ), esc_attr( $img_classes ) );
					if ( $url ) :
						?>
						<a href="<?php echo esc_url( $url ); ?>" class="inline-block"><?php echo $tag; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
					<?php else :
						echo $tag; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					endif;
				endforeach; ?>
			</div>
		</div>
	</div>
	<?php
}

