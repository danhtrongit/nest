<?php

class Nest_Category_Walker extends Walker_Nav_Menu {

	public function start_lvl( &$output, $depth = 0, $args = null ) {
		$indent = str_repeat( "\t", $depth );

		if ( 0 === $depth ) {
			$classes = 'invisible opacity-0 group-hover/cat:visible group-hover/cat:opacity-100 absolute left-full top-0 z-50 min-w-[240px] bg-white shadow-lg rounded-r-lg py-3 border-l border-gray-100 transition-all duration-200';
		} else {
			$classes = 'invisible opacity-0 group-hover/catsub:visible group-hover/catsub:opacity-100 absolute left-full top-0 z-50 min-w-[200px] bg-white shadow-lg rounded-r-lg py-2 border-l border-gray-100 transition-all duration-200';
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
			$li_class = 'relative group/cat border-b border-gray-50 last:border-0';
		} elseif ( $has_children ) {
			$li_class = 'relative group/catsub';
		} else {
			$li_class = 'relative';
		}

		$output .= $indent . '<li class="' . esc_attr( $li_class ) . '">';

		$atts           = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : $item->title;
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
		$atts['href']   = ! empty( $item->url ) ? $item->url : '';

		if ( 0 === $depth ) {
			$atts['class'] = 'flex items-center justify-between px-4 py-2.5 text-sm text-foreground hover:text-primary hover:bg-gray-50 transition-colors duration-150';
		} else {
			$atts['class'] = 'flex items-center justify-between px-4 py-2 text-sm text-foreground hover:text-primary hover:bg-gray-50 transition-colors duration-150';
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
		$item_output .= '<span>' . ( $args->link_before ?? '' ) . $title . ( $args->link_after ?? '' ) . '</span>';

		if ( $has_children ) {
			$item_output .= '<svg class="w-3 h-3 fill-current text-gray-400" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/></svg>';
		}

		$item_output .= '</a>';
		$item_output .= $args->after ?? '';

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	public function end_el( &$output, $data_object, $depth = 0, $args = null ) {
		$output .= "</li>\n";
	}
}
