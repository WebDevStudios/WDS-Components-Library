<?php
/**
 * The template for displaying single components.
 *
 * @since   0.0.0
 * @package WDS_Component_Library
 */

get_header(); ?>

	<div id="primary" class="content-area">

		<?php do_action( 'WDSCL_before_main' ); ?>

		<main id="main" class="site-main" role="main">

		<?php do_action( 'WDSCL_before_main_inside' ); ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php do_action( 'WDSCL_before_entry' ); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="post-thumbnail">
						<?php the_post_thumbnail(); ?>
					</div>
				<?php endif; ?>

				<header class="entry-header">
					<div class="entry-header-inner">
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<?php wds_component_library()->component_status->get_status(); ?>
					</div>
					<div class="entry-meta">
						<?php wds_component_library()->component->display_post_entry_meta(); ?>
					</div>
				</header>

				<div class="component-example">
					<?php wds_component_library()->component->display_component(); ?>
				</div>

				<div class="entry-content">
					
					<?php the_content(); ?>
					
					<?php
						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wds-component-library' ),
							'after'  => '</div>',
						) );
					?>
				</div>

				<div class="component-code">
					<?php wds_component_library()->component->display_component_meta(); ?>
				</div>

				<?php //WDSCL_the_entry_footer(); ?>
			</article>

			<?php do_action( 'WDSCL_after_entry' ); ?>

			<?php the_post_navigation(); ?>

			<?php
				// Maybe load comments.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			?>

		<?php endwhile; ?>

		<?php do_action( 'WDSCL_after_main_inside' ); ?>

		</main>

		<?php do_action( 'WDSCL_after_main' ); ?>

	</div>

<?php get_footer(); ?>
