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
}
