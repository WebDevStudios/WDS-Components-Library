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

			<?php do_action( 'wpcl_before_entry' ); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="post-thumbnail">
						<?php the_post_thumbnail(); ?>
					</div>
				<?php endif; ?>

				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header>

				<div class="component-example">
					<?php wp_component_library()->component->display_component(); ?>
				</div>

				<div class="entry-content">
					
					<?php the_content(); ?>
					
					<?php
						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-component-library' ),
							'after'  => '</div>',
						) );
					?>
				</div>

				<div class="component-code">
					<?php wp_component_library()->component->display_component_meta(); ?>
				</div>

				<?php //wpcl_the_entry_footer(); ?>
			</article>

			<?php do_action( 'wpcl_after_entry' ); ?>

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
