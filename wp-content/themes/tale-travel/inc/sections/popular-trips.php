<?php
/**
 * Popular Trips section
 *
 * This is the template for the content of popular trips section
 *
 * @package Theme Palace
 * @subpackage Tale Travel
 * @since Tale Travel 1.0.0
 */
if ( ! function_exists( 'tale_travel_add_popular_trips_section' ) ) :
    /**
    * Add popular trips section
    *
    *@since Tale Travel 1.0.0
    */
    function tale_travel_add_popular_trips_section() {
    	$options = tale_travel_get_theme_options();
        // Check if destination is enabled on frontpage
        $popular_trips_enable = apply_filters( 'tale_travel_section_status', true, 'popular_trips_section_enable' );

        if ( true !== $popular_trips_enable ) {
            return false;
        }
        // Get destination section details
        $section_details = array();
        $section_details = apply_filters( 'tale_travel_filter_popular_trips_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render destination section now.
        tale_travel_render_popular_trips_section( $section_details );
    }
endif;

if ( ! function_exists( 'tale_travel_get_popular_trips_section_details' ) ) :
    /**
    * popular trips section details.
    *
    * @since Tale Travel 1.0.0
    * @param array $input popular trips section details.
    */
    function tale_travel_get_popular_trips_section_details( $input ) {
        $options = tale_travel_get_theme_options();

        // Content type.
        $popular_trips_content_type  = $options['popular_trips_content_type'];
        
        $content = array();
        switch ( $popular_trips_content_type ) {
        	
            case 'category':
                $cat_id = ! empty( $options['popular_trips_content_category'] ) ? $options['popular_trips_content_category'] : '';
                $args = array(
                    'post_type'         => 'post',
                    'posts_per_page'    => 2,
                    'cat'               => absint( $cat_id ),
                    'ignore_sticky_posts'   => true,
                    );                    
            break;

            case 'trip-types':

                if ( ! class_exists( 'WP_Travel' ) )
                    return;
                
                $cat_id = ! empty( $options['popular_trips_content_trip_types'] ) ? $options['popular_trips_content_trip_types'] : '';
                $args = array(
                    'post_type'      => 'itineraries',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'itinerary_types',
                            'field'    => 'id',
                            'terms'    => $cat_id,
                        ),
                    ),
                    'posts_per_page'  => 2,
                    );                    
            break;

            default:
            break;
        }


            // Run The Loop.
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) : 
                while ( $query->have_posts() ) : $query->the_post();
                    $page_post['id']        = get_the_id();
                    $page_post['title']     = get_the_title();
                    $page_post['url']       = get_the_permalink();
                    $page_post['excerpt']   = tale_travel_trim_content( 25 );
                    $page_post['author']    = tale_travel_author_meta();
                    $page_post['image']  	= has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : '';

                    // Push to the main array.
                    array_push( $content, $page_post );
                endwhile;
            endif;
            wp_reset_postdata();

            
        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// destination section content details.
add_filter( 'tale_travel_filter_popular_trips_section_details', 'tale_travel_get_popular_trips_section_details' );


if ( ! function_exists( 'tale_travel_render_popular_trips_section' ) ) :
  /**
   * Start destination section
   *
   * @return string destination content
   * @since Tale Travel 1.0.0
   *
   */
   function tale_travel_render_popular_trips_section( $content_details = array() ) {
        $options = tale_travel_get_theme_options();
        $popular_trips_content_type  = $options['popular_trips_content_type'];

        if ( empty( $content_details ) ) {
            return;
        } ?>

        <div id="most-viewed-posts" class="relative page-section">
            <div class="wrapper">
                <div class="section-header">
                    <?php if ( ! empty( $options['popular_trips_title'] ) ) : ?>
                        <h2 class="section-title"><?php echo esc_html( $options['popular_trips_title'] ); ?></h2>
                    <?php endif; ?>
                </div><!-- .section-header -->

                <div class="section-content">
                    <?php foreach ( $content_details as $content ) : ?>
                        <article class="<?php echo ! empty( $content['image'] ) ? 'has' : 'no'; ?>-post-thumbnail">
                            <?php if ( ! empty( $content['image'] ) ) : ?>
                                <div class="featured-image" style="background-image: url('<?php echo esc_url( $content['image'] ); ?>');">
                                    <a href="<?php echo esc_url( $content['url'] ); ?>" class="post-thumbnail-link"></a>
                                </div><!-- .featured-image -->
                            <?php endif; ?>
                                
                            <div class="entry-container">
                                <?php if ( ! in_array( $popular_trips_content_type, array( 'category', 'page', 'post' ) ) ) : 
                                   
                                    $trip_price      = WP_Travel_Helpers_Pricings::get_price(array('trip_id'=>$content['id'] ));
                                
                                    $settings        = tale_travel_wptravel_get_settings();
                                    $currency_code   = ( isset( $settings['currency'] ) ) ? $settings['currency'] : '';
                                    $currency_symbol = tale_travel_wptravel_get_currency_symbol( $currency_code );
                                    ?>
                                    <div class="price-meta-wrapper">
                                        <span class="trip-price">                       
                                            <span class="current-price">
                                                <?php 
                                                    echo tale_travel_wptravel_get_formated_price_currency( $trip_price );
                                                ?>
                                            </span>
                                        </span><!-- .trip-price -->
                                    </div>
                                <?php endif;

                                if ( in_array( $popular_trips_content_type, array( 'category', 'post' ) ) ) :
                                    the_category( '', '', $content['id'] );
                                elseif ( ! in_array( $popular_trips_content_type, array( 'category', 'page', 'post' ) ) ) :
                                    $categories = get_the_terms( $content['id'], 'travel_locations' );
                                    if ( ! empty( $categories ) ) : ?>
                                        <ul class="post-categories">
                                            <?php foreach ( $categories as $cat ) : ?>
                                                <li><a href="<?php echo esc_url( get_term_link( $cat->term_id ) ); ?>" rel="category tag"><?php echo esc_html( $cat->name ); ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif;
                                endif; ?>

                                <header class="entry-header">
                                    <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                </header>

                                <div class="entry-content">
                                    <p><?php echo esc_html( $content['excerpt'] ); ?></p>
                                </div><!-- .entry-content -->

                                <div class="entry-meta">
                                    <?php 
                                        tale_travel_posted_on( $content['id'] ); 
                                        echo wp_kses_post( $content['author'] );
                                    ?>
                                </div><!-- .entry-meta -->
                            </div><!-- .entry-container -->
                        </article>
                    <?php endforeach; ?>
                </div><!-- .section-content -->
            </div><!-- .wrapper -->
        </div><!-- #most-viewed-posts -->

    <?php }
endif;