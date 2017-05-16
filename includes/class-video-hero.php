<?php
/**
 * WDS Component Library Video Hero.
 *
 * @since   0.0.0
 * @package WDS_Component_Library
 */

/**
 * WDS Component Library Video Hero.
 *
 * @since 0.0.0
 */
class WDSCL_Video_Hero {

	/**
	 * Set the element name.
	 */
	private $component_name = 'video_hero';

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
		add_filter( 'after_theme_setup', array( $this, 'add_hero_image_size' ) );
	}

	/**
	 * Add an image size for the hero image.
	 */
	public function add_hero_image_size() {

		add_image_size( 'hero-image', 1920, 500, true );
	}

	/**
	 * Build the video hero markup.
	 *
	 * @param   int  $post_id  The Post ID.
	 * @param   int  $count    The flexible content row.
	 *
	 * @author                 Carrie Forde
	 */
	public function video_hero_markup( $post_id = 0, $count ) {

		// Set the post ID if one wasn't passed.
		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		// If we're using this within the components library, we need the flexible content name, and row count.
		$component = get_post_meta( $post_id, 'component', true );
		$prefix    = ( ! empty( $component ) ) ? 'component_' . $count . '_' : '';

		// Get component variables.
		$image       = get_post_meta( $post_id, $prefix . 'background_image', true );
		$video       = get_post_meta( $post_id, $prefix . 'background_video', true );
		$title       = get_post_meta( $post_id, $prefix . 'title', true );
		$description = get_post_meta( $post_id, $prefix . 'description', true );
		$cta_button  = get_post_meta( $post_id, $prefix . 'cta_button', true );

		// Bail if the video is empty.
		if ( empty( $video ) ) {
			return;
		}

		// Start the markup. 🎉 ?>
		<section class="hero-area image-as-background" <?php echo ( ! empty( $image ) ) ? 'style="background-image: url(' . esc_url( $image ) . ')"' : '' ?> role="dialog" aria-labelledby="hero-title" aria-describedby="hero-description">
			<video class="video-as-background" autoplay muted loop preload="auto"><source src="<?php echo esc_url( $video ); ?>"></video>
			<div class="hero-content">
				<?php if ( ! empty( $title ) ) : ?>
					<h2 class="hero-title"><?php echo esc_html( $title ); ?></h2>
				<?php endif; ?>

				<?php if ( ! empty( $description ) ) : ?>
					<div class="hero-description"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
				<?php endif; ?>

				<?php if ( 'yes' === $cta_button ) :
					$button_text = get_post_meta( $post_id, $prefix . 'button_text', true );
					$button_link = get_post_meta( $post_id, $prefix . 'button_link', true );

					// Output the button if we have both the text & the link.
					if ( empty( $button_text && $button_link ) ) :?>
						<a href="<?php echo esc_url( $button_link ); ?>" class="button hero-button"><?php echo esc_html( $button_text ); ?></a>
					<?php endif;
				endif; ?>
			</div><!-- .hero-content -->
		</section><!-- .hero-area -->

		<?php
	}
}
