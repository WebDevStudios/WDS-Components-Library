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
	 * Set the element name.
	 */
	private $component_name = 'image_hero';

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
		add_filter( 'after_theme_setup', array( $this, 'add_hero_image_size' ) );
	}

	/**
	 * Add an image size for the hero image.
	 */
	public function add_hero_image_size() {

		add_image_size( 'hero-image', 1920, 500, true );
	}

	/**
	 * Build the image hero markup.
	 *
	 * @param  int  $post_id  The Post ID. By passing a post ID, the hero can be used outside the loop.
	 * @param  int  $count    The flexible content row.
	 *
	 * @author  Carrie Forde
	 */
	public function image_hero_markup( $post_id = 0, $count ) {

		// Set the post ID if one wasn't passed.
		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		// If we're using this within the components library, we need the flexible content name, and row count.
		$component = get_post_meta( $post_id, 'component', true );
		$prefix    = ( ! empty( $component ) ) ? 'component_' . $count . '_' : '';

		// Get component variables.
		$image       = get_post_meta( $post_id, $prefix . 'background_image', true );
		$title       = get_post_meta( $post_id, $prefix . 'title', true );
		$description = get_post_meta( $post_id, $prefix . 'description', true );
		$cta_button  = get_post_meta( $post_id, $prefix . 'cta_button', true );

		// Bail if the image is empty.
		if ( empty( $image ) ) {
			return;
		}

		// Start the markup. 🎉 ?>
		<section class="hero-area image-as-background" style="background-image: url( <?php echo esc_url( wp_get_attachment_image_url( $image, 'hero-image' ) ); ?> );" role="dialog" aria-labelledby="hero-title" aria-describedby="hero-description">
			<div class="hero-content">
				<?php if ( ! empty( $title ) ) : ?>
					<h2 class="hero-title"><?php echo esc_html( $title ); ?></h2>
				<?php endif; ?>

				<?php if ( ! empty( $description ) ) : ?>
					<p class="hero-description"><?php echo esc_html( $description ); ?></p>
				<?php endif; ?>

				<?php if ( ! empty( $cta_button ) ) :
					$button_text = get_post_meta( $post_id, $prefix . 'button_text', true );
					$button_link = get_post_meta( $post_id, $prefix . 'button_link', true );

					// Return if either of button part is empty.
					if ( empty( $button_text || $button_link ) ) :
						return;
					endif;
				?>
					<a href="<?php echo esc_url( $button_link ); ?>" class="button hero-button"><?php echo esc_html( $button_text ); ?></a>
				<?php endif; ?>
			</div><!-- .hero-content -->
		</section><!-- .hero-area -->

	<?php
	}
}
