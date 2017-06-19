<?php
/**
 * Queries used for grabbing posts.
 *
 * @package WDS_Components_Library
 */

/**
 * A simple query used to fetch posts with markup from a specified template part.
 *
 * @param   array  [$args = array()] The arguments.
 *
 * @return  string                   The HTML markup.
 */
function wdscl_fetch_posts( $args = array() ) {
	$defaults = array(
		'post_type'       => 'post',
		'posts_per_page'  => 1,
		'template_part'   => 'component-card-post',
	);
	$args = wp_parse_args( $args, $defaults );

	$post = array(
		'post_type'           => esc_attr( $args['post_type'] ),
		'posts_per_page'      => intval( $args['posts_per_page'] ),
	);

	$posts = new WP_Query( $post );

	if ( $posts->have_posts() ) {

		while ( $posts->have_posts() ) {
			$posts->the_post();
			wds_component_library()->component->get_component_template_part( $args['template_part'], false );
		}
	}

	wp_reset_postdata();
}
