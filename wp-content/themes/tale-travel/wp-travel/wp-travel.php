<?php

	function tale_travel_wptravel_get_formated_price_currency( $attr ){
		if ( function_exists( 'wptravel_get_formated_price_currency' ) ) {
			return wptravel_get_formated_price_currency( $attr );
		} elseif ( function_exists( 'wp_travel_get_formated_price_currency' ) ) {
			return wp_travel_get_formated_price_currency( $attr );
		}
	}
	function tale_travel_wptravel_archive_wrapper_close(){
		if ( function_exists( 'wptravel_archive_wrapper_close' ) ) {
			return wptravel_get_formated_price_currency();
		} elseif ( function_exists( 'wp_travel_archive_wrapper_close' ) ) {
			return wp_travel_archive_wrapper_close();
		}
	}
	function tale_travel_wptravel_get_template_part( $attr1, $attr2 ){
		if ( function_exists( 'wptravel_get_template_part' ) ) {
			return wptravel_get_template_part( $attr1, $attr2 );
		} elseif ( function_exists( 'wp_travel_get_template_part' ) ) {
			return wp_travel_get_template_part( $attr1, $attr2 );
		}
	}
	function tale_travel_wptravel_get_page_permalink( $page){
		if ( function_exists( 'wptravel_get_page_permalink' ) ) {
			return wptravel_get_page_permalink( $page);
		} elseif ( function_exists( 'wp_travel_get_page_permalink' ) ) {
			return wp_travel_get_page_permalink( $page );
		}
	}

	function tale_travel_wptravel_get_currency_symbol( $currency_code ){
		if ( function_exists( 'wptravel_get_currency_symbol' ) ) {
			return wptravel_get_currency_symbol( $currency_code );
		} elseif ( function_exists( 'wp_travel_get_currency_symbol' ) ) {
			return wp_travel_get_currency_symbol( $currency_code );
		}
	}
	function tale_travel_wptravel_get_settings( ){
		if ( function_exists( 'wptravel_get_settings' ) ) {
			return wptravel_get_settings( );
		} elseif ( function_exists( 'wp_travel_get_settings' ) ) {
			return wp_travel_get_settings( );
		}
	}
	function tale_travel_wptravel_trip_price( $trip_id, $hide_rating = ''){
		if ( function_exists( 'wptravel_trip_price' ) ) {
			return wptravel_trip_price( $trip_id, $hide_rating = '');
		} elseif ( function_exists( 'wp_travel_trip_price' ) ) {
			return wp_travel_trip_price( $trip_id, $hide_rating = '');
		}
	}
	function tale_travel_wptravel_single_excerpt( $post_id){
		if ( function_exists( 'wptravel_single_excerpt' ) ) {
			return wptravel_single_excerpt( $post_id);
		} elseif ( function_exists( 'wp_travel_single_excerpt' ) ) {
			return wp_travel_single_excerpt( $post_id);
		}
	}

	function tale_travel_wptravel_trip_map( $post_id){
		if ( function_exists( 'wptravel_trip_map' ) ) {
			return wptravel_trip_map( $post_id);
		} elseif ( function_exists( 'wp_travel_trip_map' ) ) {
			return wp_travel_trip_map( $post_id);
		}
	}

 ?>
