<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Theme Palace
 * @subpackage Tale Travel
 * @since Tale Travel 1.0.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function tale_travel_body_classes( $classes ) {
	$options = tale_travel_get_theme_options();

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add a class for layout
	$classes[] = esc_attr( $options['site_layout'] );

	// Add a class for sidebar
	$sidebar_position = tale_travel_layout();
	$sidebar = 'sidebar-1';
	if ( is_singular() || is_home() ) {
		$id = ( is_home() && ! is_front_page() ) ? get_option( 'page_for_posts' ) : get_the_id();
	  	$sidebar = get_post_meta( $id, 'tale-travel-selected-sidebar', true );
	  	$sidebar = ! empty( $sidebar ) ? $sidebar : 'sidebar-1';
	}
	
	if ( is_active_sidebar('sidebar-1') && !is_post_type_archive( 'itineraries' ) ) {
		$classes[] = esc_attr( $sidebar_position );
	} elseif ( class_exists( 'WP_Travel' ) && ( is_single() && 'itineraries' == get_post_type() ) && is_active_sidebar('trip-sidebar-single') ) {
		$classes[] = esc_attr( $sidebar_position );
	} elseif ( class_exists( 'WP_Travel' ) && ( is_post_type_archive( 'itineraries' ) || is_tax( 'itinerary_types' ) || is_tax( 'activity' ) || is_tax( 'travel_locations' ) || is_tax( 'travel_keywords' ) ) && is_active_sidebar('wp-travel-archive-sidebar') ) {
		$classes[] = esc_attr( $sidebar_position );
	}else {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'tale_travel_body_classes' );
