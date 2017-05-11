<?php
/**
 * WP Component Library Image Hero.
 *
 * @since   0.0.0
 * @package WP_Component_Library
 */

/**
 * WP Component Library Image Hero.
 *
 * @since 0.0.0
 */
class WPCL_Image_Hero {
	/**
	 * Parent plugin class.
	 *
	 * @since 0.0.0
	 *
	 * @var   WP_Component_Library
	 */
	protected $plugin = null;

	/**
	 * Constructor.
	 *
	 * @since  0.0.0
	 *
	 * @param  WP_Component_Library $plugin Main plugin object.
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
	 * Build the image hero markup.
	 *
	 * @param  int  The Post ID. By passing a post ID, the hero can be used outside the loop.
	 *
	 * @author  Carrie Forde
	 */
	public function image_hero_markup( $post_id = 0 ) {

		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		$image       = get_post_meta( $post_id, 'background_image', true );
		$title       = get_post_meta( $post_id, 'title', true );
		$description = get_post_meta( $post_id, 'description', true );
		$cta_button  = get_post_meta( $post_id, 'cta_button', true );

		// Bail if the image is empty.
		if ( empty( $image ) ) {
			return;
		}

		// Start the markup. 🎉 ?>
		<section class="hero-area image-as-background" style="background-image: url( <?php echo esc_url( $image ); ?> );" role="dialog" aria-labelledby="hero-title" aria-describedby="hero-description">
			<div class="hero-content">
				<?php if ( ! empty( $title ) ) : ?>
					<h2 class="hero-title"><?php echo esc_html( $title ); ?></h2>
				<?php endif; ?>

				<?php if ( ! empty( $description ) ) : ?>
					<p class="hero-description"><?php echo esc_html( $description ); ?></p>
				<?php endif; ?>

				<?php if ( ! empty( $cta_button ) ) :
					$button_text = get_post_meta( $post_id, 'button_text', true );
					$button_link = get_post_meta( $post_id, 'button_link', true );
				?>
					<a href="<?php echo esc_url( $button_link ); ?>" class="hero-button"><?php echo esc_html( $button_text ); ?></a>
				<?php endif; ?>
			</div><!-- .hero-content -->
		</section><!-- .hero-area -->

	<?php
	}
}
