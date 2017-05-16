<?php
/**
 * WDS Component Library Social Menu.
 *
 * @since   0.0.0
 * @package WDS_Component_Library
 */

/**
 * WDS Component Library Social Menu.
 *
 * @since 0.0.0
 */
class WDSCL_Social_Menu {
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
		add_action( 'after_setup_theme', array( $this, 'register_social_menu' ) );
	}

	/**
	 * Register a menu location for the social menu.
	 *
	 * @author  Carrie Forde
	 */
	public function register_social_menu() {

		// Register a social nav menu location.
		register_nav_menus( array(
			'social' => esc_html__( 'Social Menu', 'wds-component-library' ),
		) );
	}
}
