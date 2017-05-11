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
}
