<?php
/**
 * Demo Import.
 *
 * This is the template that includes all the other files for core featured of Theme Palace
 *
 * @package Theme Palace
 * @subpackage Tale Travel
 * @since Tale Travel 1.0.0
 */

function tale_travel_intro_text( $default_text ) {
    $default_text .= sprintf( '<p class="about-description">%1$s <a href="%2$s">%3$s</a></p>', esc_html__( 'Demo content files for Tale Travel Theme.', 'tale-travel' ),
    esc_url( 'https://themepalace.com/instructions/themes/tale-travel' ), esc_html__( 'Click here for Demo File download', 'tale-travel' ) );

    return $default_text;
}
add_filter( 'cp-ctdi/plugin_intro_text', 'tale_travel_intro_text' );