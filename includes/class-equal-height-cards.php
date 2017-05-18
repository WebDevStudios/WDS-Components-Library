<?php
/**
 * WDS Component Library Equal Height Cards.
 *
 * @since   0.0.0
 * @package WDS_Component_Library
 */

/**
 * WDS Component Library Equal Height Cards.
 *
 * @since 0.0.0
 */
class WDSCL_Equal_Height_Cards {
	/**
	 * Parent plugin class.
	 *
	 * @since 0.0.0
	 *
	 * @var   WDS_Component_Library
	 */
	protected $plugin = null;

	/**
	 * Constructor.
	 *
	 * @since  0.0.0
	 *
	 * @param  WDS_Component_Library $plugin Main plugin object.
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
		$this->hooks();
	}

	/**
	 * Initiate our hooks.
	 *
	 * @since  0.0.0
	 */
	public function hooks() {

	}

	/**
	 * Builds the card markup.
	 */
	public function card_markup() {

		// Pull in the template tags.
		require_once( 'template-tags.php' );

		// Start the markup. 🎉 ?>
		<article <?php post_class( 'card' ); ?>>
			<header class="entry-header">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="post-thumbnail">
						<?php the_post_thumbnail(); ?>
					</div>
				<?php endif; ?>

				<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		
				<div class="entry-meta">
					<?php card_posted_on(); ?>
				</div><!-- .entry-meta -->
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php
					the_excerpt();
					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_s' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->

			<footer class="entry-footer">
				<?php card_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</article><!-- #post-## -->

		<?php
	}
}
