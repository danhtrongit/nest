<?php

class Nest_Nav_Walker extends Walker_Nav_Menu {

	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$indent = str_repeat( "\t", $depth );

		if ( 0 === $depth ) {
			$classes = 'invisible opacity-0 group-hover/item:visible group-hover/item:opacity-100 absolute left-0 top-full z-50 min-w-[220px] bg-white shadow-lg rounded-b-lg py-2 transition-all duration-200';
		} else {
			$classes = 'invisible opacity-0 group-hover/sub:visible group-hover/sub:opacity-100 absolute left-full top-0 z-50 min-w-[200px] bg-white shadow-lg rounded-lg py-2 transition-all duration-200';
		}

		$output .= "\n{$indent}<ul class=\"{$classes}\">\n";
	}

	public function end_lvl( &$output, $depth = 0, $args = null ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "{$indent}</ul>\n";
	}

	public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
		$item    = $data_object;
		$indent  = $depth ? str_repeat( "\t", $depth ) : '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$has_children = in_array( 'menu-item-has-children', $classes, true );

		if ( 0 === $depth ) {
			$li_class = 'relative group/item';
			if ( in_array( 'current-menu-item', $classes, true ) || in_array( 'current-menu-ancestor', $classes, true ) ) {
				$li_class .= ' [&>a]:text-secondary';
			}
		} elseif ( 1 === $depth && $has_children ) {
			$li_class = 'relative group/sub';
		} else {
			$li_class = 'relative';
		}

		$output .= $indent . '<li class="' . esc_attr( $li_class ) . '">';

		$atts           = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
		$atts['href']   = ! empty( $item->url ) ? $item->url : '';

		if ( 0 === $depth ) {
			$atts['class'] = 'flex items-center gap-1 px-4 py-3 text-sm font-medium text-white uppercase tracking-wide hover:text-secondary transition-colors duration-200';
		} else {
			$atts['class'] = 'block px-4 py-2 text-sm text-foreground hover:bg-gray-50 hover:text-primary transition-colors duration-150';
		}

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$attributes .= ' ' . $attr . '="' . esc_attr( $value ) . '"';
			}
		}

		$title = apply_filters( 'the_title', $item->title, $item->ID );
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output  = $args->before ?? '';
		$item_output .= '<a' . $attributes . '>';
		$item_output .= ( $args->link_before ?? '' ) . $title . ( $args->link_after ?? '' );

		if ( $has_children ) {
			$item_output .= '<svg class="w-3 h-3 ml-1 fill-current" viewBox="0 0 16 16"><path d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/></svg>';
		}

		$item_output .= '</a>';
		$item_output .= $args->after ?? '';

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	public function end_el( &$output, $data_object, $depth = 0, $args = null ) {
		$output .= "</li>\n";
	}
}
