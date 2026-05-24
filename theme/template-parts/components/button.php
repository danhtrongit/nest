<?php
/**
 * Reusable Button Component
 *
 * Usage:
 *   get_template_part( 'template-parts/components/button', null, array(
 *       'text'    => 'Click me',               // Required – button label.
 *       'url'     => '/some-page',              // Optional – renders <a>; omit for <button>.
 *       'variant' => 'primary',                 // Optional – primary | secondary | outline | outline-white | frame | ghost. Default: primary.
 *       'size'    => 'md',                      // Optional – sm | md | lg. Default: md.
 *       'icon'    => '<svg …>…</svg>',          // Optional – inline SVG prepended to text.
 *       'icon_after' => '<svg …>…</svg>',       // Optional – inline SVG appended to text.
 *       'class'   => 'mt-4 w-full',             // Optional – extra utility classes.
 *       'attrs'   => 'data-product="123"',      // Optional – extra HTML attributes (string).
 *       'tag'     => 'button',                  // Optional – force tag: a | button | span. Auto-detected from url.
 *       'type'    => 'submit',                  // Optional – button type attribute. Default: button.
 *       'target'  => '_blank',                  // Optional – link target.
 *       'title'   => 'Tooltip',                 // Optional – title attribute.
 *       'full'    => false,                      // Optional – true for full-width button.
 *       'disabled'=> false,                      // Optional – disabled state.
 *   ) );
 *
 * @package Nest
 */

defined( 'ABSPATH' ) || exit;

// ── Defaults ────────────────────────────────────────────────────────────────
$defaults = array(
	'text'       => '',
	'url'        => '',
	'variant'    => 'primary',
	'size'       => 'md',
	'icon'       => '',
	'icon_after' => '',
	'class'      => '',
	'attrs'      => '',
	'tag'        => '',
	'type'       => 'button',
	'target'     => '',
	'title'      => '',
	'full'       => false,
	'disabled'   => false,
);

$args = wp_parse_args( $args ?? array(), $defaults );

// Nothing to render without text.
if ( empty( $args['text'] ) ) {
	return;
}

// ── Determine tag ───────────────────────────────────────────────────────────
$tag = $args['tag'];
if ( ! $tag ) {
	$tag = $args['url'] ? 'a' : 'button';
}

// ── Size classes ────────────────────────────────────────────────────────────
$size_classes = array(
	'sm' => 'h-8 px-4 text-sm gap-1.5',
	'md' => 'h-10 px-6 text-base gap-2',
	'lg' => 'h-12 px-8 text-lg gap-2.5',
);
$size_class = $size_classes[ $args['size'] ] ?? $size_classes['md'];

// ── Variant classes ─────────────────────────────────────────────────────────
$variant_classes = array(
	'primary'       => 'bg-primary text-white hover:bg-hover',
	'secondary'     => 'bg-secondary text-primary hover:bg-hover hover:text-white',
	'outline'       => 'bg-transparent text-primary border-2 border-primary hover:bg-primary hover:text-white',
	'outline-white' => 'bg-transparent text-white border-2 border-white hover:bg-white hover:text-primary',
	'ghost'         => 'bg-transparent text-primary hover:bg-primary/10',
	'danger'        => 'bg-red-600 text-white hover:bg-red-700',
	'frame'         => '', // Handled separately via .btn-frame CSS class.
);

$is_frame   = 'frame' === $args['variant'];
$var_class  = $variant_classes[ $args['variant'] ] ?? $variant_classes['primary'];

// ── Build class list ────────────────────────────────────────────────────────
$classes = array( 'nest-btn' );

if ( $is_frame ) {
	// .nest-btn CSS handles all frame styling. No extra classes needed.
} else {
	$classes[] = 'inline-flex items-center justify-center font-semibold transition-all duration-300 cursor-pointer';
	$classes[] = $size_class;
	$classes[] = $var_class;
}

if ( $args['full'] ) {
	$classes[] = 'w-full';
}

if ( $args['disabled'] ) {
	$classes[] = 'opacity-50 pointer-events-none';
}

if ( $args['class'] ) {
	$classes[] = $args['class'];
}

$class_str = implode( ' ', array_filter( $classes ) );

// ── Build attributes ────────────────────────────────────────────────────────
$attr_parts = array();
$attr_parts[] = 'class="' . esc_attr( $class_str ) . '"';

if ( 'a' === $tag && $args['url'] ) {
	$attr_parts[] = 'href="' . esc_url( $args['url'] ) . '"';
}

if ( 'button' === $tag ) {
	$attr_parts[] = 'type="' . esc_attr( $args['type'] ) . '"';
}

if ( $args['target'] ) {
	$attr_parts[] = 'target="' . esc_attr( $args['target'] ) . '"';
	if ( '_blank' === $args['target'] ) {
		$attr_parts[] = 'rel="noopener noreferrer"';
	}
}

if ( $args['title'] ) {
	$attr_parts[] = 'title="' . esc_attr( $args['title'] ) . '"';
}

if ( $args['disabled'] && 'button' === $tag ) {
	$attr_parts[] = 'disabled';
}

if ( $args['attrs'] ) {
	$attr_parts[] = $args['attrs'];
}

$attr_str = implode( ' ', $attr_parts );

// ── Frame SVG decorations (flex items, not absolute) ────────────────────────
$frame_svg_left  = '<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>';
$frame_svg_right = '<svg width="14" height="32" viewBox="0 0 14 32" fill="none" class="nest-btn__deco -scale-x-100"><path d="M13.3726 0H0.372559V13.2018L3.16222 16L6.37256 19L9.5 16L7.93628 14.5L6.37256 13L0.372559 18.6069V32H13.3726" stroke="currentColor"></path></svg>';
?>

<<?php echo tag_escape( $tag ); ?> <?php echo $attr_str; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- built from esc_* functions above. ?>>
	<?php if ( $is_frame ) : ?>
		<?php echo $frame_svg_left; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- trusted SVG. ?>
	<?php endif; ?>

	<?php if ( $args['icon'] ) : ?>
		<span class="nest-btn__icon shrink-0"><?php echo $args['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
	<?php endif; ?>

	<span class="nest-btn__text"><?php echo esc_html( $args['text'] ); ?></span>

	<?php if ( $args['icon_after'] ) : ?>
		<span class="nest-btn__icon shrink-0"><?php echo $args['icon_after']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
	<?php endif; ?>

	<?php if ( $is_frame ) : ?>
		<?php echo $frame_svg_right; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- trusted SVG. ?>
	<?php endif; ?>
</<?php echo tag_escape( $tag ); ?>>
