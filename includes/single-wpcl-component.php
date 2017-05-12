<?php
/**
 * The template for displaying single components.
 *
 * @since   0.0.0
 * @package WP_Component_Library
 */

get_header(); ?>

	<div id="primary" class="content-area">

		<?php do_action( 'wpcl_before_main' ); ?>

		<main id="main" class="site-main" role="main">

		<?php do_action( 'wpcl_before_main_inside' ); ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wp_component_library()->component->display_component(); ?>

			<?php wp_component_library()->component->display_component_meta(); ?>

			<?php the_post_navigation(); ?>

			<?php
				// Maybe load comments.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			?>

		<?php endwhile; ?>

		<?php do_action( 'wpcl_after_main_inside' ); ?>

		</main>

		<?php do_action( 'wpcl_after_main' ); ?>

	</div>

<?php get_footer(); ?>
