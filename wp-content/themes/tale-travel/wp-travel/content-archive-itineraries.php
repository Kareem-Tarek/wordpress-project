<?php
/**
 * Itinerary Archive Contnet Template
 *
 * This template can be overridden by copying it to yourtheme/wp-travel/content-archive-itineraries.php.
 *
 * HOWEVER, on occasion wp-travel will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.wensolutions.com/document/template-structure/
 * @author      WenSolutions
 * @package     wp-travel/Templates
 * @since       1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php
do_action( 'wp_travel_before_archive_itinerary', get_the_ID() );
if ( post_password_required() ) {
	echo get_the_password_form();
	return;
}
	$enable_sale 	= WP_Travel_Helpers_Trips::is_sale_enabled( array( 'trip_id' => get_the_ID() ) );
	$group_size 	= wptravel_get_group_size( get_the_ID() );
	$start_date 	= get_post_meta( get_the_ID(), 'wp_travel_start_date', true );
	$end_date 		= get_post_meta( get_the_ID(), 'wp_travel_end_date', true ); ?>
	<?php $view_mode = wptravel_get_archive_view_mode(); ?>
	<?php if ( 'list' === $view_mode ) : ?>
		<article class="wp-travel-default-article">
			<div class="wp-travel-article-image-wrap">
				<a href="<?php the_permalink(); ?>">
					<?php echo wptravel_get_post_thumbnail( get_the_ID(), 'post-thumbnail' ); ?>
				</a>
				<?php if ( wptravel_tab_show_in_menu( 'reviews' ) ) : ?>
					<?php wptravel_trip_rating( get_the_ID() ); ?>
					<?php $count = (int) wptravel_get_review_count(); ?>
					<span class="wp-travel-review-text"> (<?php printf( _n( '%d Review', '%d Reviews', $count, 'top-travel' ), $count ); ?>)</span>
				<?php endif; ?>

				<?php if ( $enable_sale ) : ?>
					<div class="wp-travel-offer">
						<span><?php esc_html_e( 'Offer', 'top-travel' ); ?></span>
					</div>
				<?php endif; ?>

			</div>
			<div class="wp-travel-entry-content-wrapper">
				<div class="description-left">
					<?php do_action( 'wp_travel_before_archive_content_title', get_the_ID() ); ?>
					<?php wptravel_do_deprecated_action( 'wp_tarvel_before_archive_title', array( get_the_ID() ), '2.0.4', 'wp_travel_before_archive_content_title' ); ?>
					<header class="entry-header">
						<h2 class="entry-title">
							<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute( array( 'before' => __( 'Permalink to: ', 'top-travel' ) ) ); ?>">
								<?php the_title(); ?>
							</a>
						</h2>
					</header><!-- .entry-header -->
					<?php do_action( 'wp_travel_after_archive_title', get_the_ID() ); ?>
					<div class="entry-content">
						<?php the_excerpt(); ?>

					</div>
					
					<div class="entry-meta">
						<div class="category-list-items">
							<span class="post-category">
								<?php $terms = get_the_terms( get_the_ID(), 'itinerary_types' ); ?>
								<?php if ( is_array( $terms ) && count( $terms ) > 0 ) : ?>
									<i class="wt-icon-regular wt-icon-folder" aria-hidden="true"></i>
									<?php
									$first_term = array_shift( $terms );
									$term_name = $first_term->name;
									$term_link = get_term_link( $first_term->term_id, 'itinerary_types' ); ?>
									<a href="<?php echo esc_url( $term_link, 'top-travel' ); ?>" rel="tag">
										<?php echo esc_html( $term_name ); ?>
									</a>

									<?php if ( count( $terms ) > 0 ) : ?>
									<div class="wp-travel-caret">
										<i class="wt-icon wt-icon-caret-down"></i>

										<div class="sub-category-menu">
											<?php foreach ( $terms as $term_trip ) : ?>
												<?php
													$term_name = $term_trip->name;
													$term_link = get_term_link( $term_trip->term_id, 'itinerary_types' ); ?>
												<a href="<?php echo esc_url( $term_link, 'top-travel' ); ?>">
													<?php echo esc_html( $term_name ); ?>
												</a>
											<?php endforeach; ?>
										</div>
									</div>
									<?php endif; ?>

								<?php endif; ?>
							</span>
						</div>
						<div class="travel-info">
							<span class="group-size"><?php esc_html_e( 'No. of Travellers:', 'top-travel' ); ?></span>
							<i class="wt-icon wt-icon-child" aria-hidden="true"></i> 
							<span class="value"><?php printf( '%s', $group_size ) ?></span>
						</div>
					</div>
				</div>
				<div class="description-right">
					<?php wptravel_trip_price( get_the_ID() ); ?>

					<div class="travel-info">
						<span><?php esc_html_e( 'Duration:', 'top-travel' ); ?></span>
						<?php wptravel_get_trip_duration( get_the_ID() ); ?>
					</div>

					<div class="wp-travel-explore">
						<a class="" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Explore', 'top-travel' ); ?></a>

					</div>
				</div>
			</div>
		</article>
	<?php else : ?>
		<?php wptravel_get_template_part( 'shortcode/itinerary', 'item' ); ?>
	<?php endif; ?>

<?php do_action( 'wp_travel_after_archive_itinerary', get_the_ID() ); ?>
