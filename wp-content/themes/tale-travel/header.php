<?php
	/**
	 * The header for our theme.
	 *
	 * This is the template that displays all of the <head> section and everything up until <div id="content">
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
	 *
	 * @package Theme Palace
	 * @subpackage Tale Travel
	 * @since Tale Travel 1.0.0
	 */

	/**
	 * tale_travel_doctype hook
	 *
	 * @hooked tale_travel_doctype -  10
	 *
	 */
	do_action( 'tale_travel_doctype' );

?>
<head>
<?php
	/**
	 * tale_travel_before_wp_head hook
	 *
	 * @hooked tale_travel_head -  10
	 *
	 */
	do_action( 'tale_travel_before_wp_head' );

	wp_head(); 
?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>

<?php
	/**
	 * tale_travel_page_start_action hook
	 *
	 * @hooked tale_travel_page_start -  10
	 *
	 */
	do_action( 'tale_travel_page_start_action' ); 

	/**
	 * tale_travel_header_action hook
	 *
	 * @hooked tale_travel_header_start -  10
	 * @hooked tale_travel_site_branding -  20
	 * @hooked tale_travel_site_navigation -  30
	 * @hooked tale_travel_header_end -  50
	 *
	 */
	do_action( 'tale_travel_header_action' );

	/**
	 * tale_travel_content_start_action hook
	 *
	 * @hooked tale_travel_content_start -  10
	 *
	 */
	do_action( 'tale_travel_content_start_action' );

	/**
	 * tale_travel_header_image_action hook
	 *
	 * @hooked tale_travel_header_image -  10
	 *
	 */
	do_action( 'tale_travel_header_image_action' );

    if ( tale_travel_is_frontpage() ) {
    	$i = 1;
    	$sections = tale_travel_sortable_sections();
		foreach ( $sections as $section => $value ) {
			add_action( 'tale_travel_primary_content', 'tale_travel_add_'. $section .'_section', $i . 0 );
			$i++;
		}
		do_action( 'tale_travel_primary_content' );
	}