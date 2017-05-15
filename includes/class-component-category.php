<?php
/**
 * WDS Component Library Component Category.
 *
 * @since   0.0.0
 * @package WP_Component_Library
 */

require_once dirname( __FILE__ ) . '/../vendor/taxonomy-core/Taxonomy_Core.php';

/**
 * WDS Component Library Component Category.
 *
 * @since 0.0.0
 *
 * @see   https://github.com/WebDevStudios/Taxonomy_Core
 */
class WDSCL_Component_Category extends Taxonomy_Core {
	/**
	 * Parent plugin class.
	 *
	 * @var    WP_Component_Library
	 * @since  0.0.0
	 */
	protected $plugin = null;

	/**
	 * Constructor.
	 *
	 * Register Taxonomy.
	 *
	 * See documentation in Taxonomy_Core, and in wp-includes/taxonomy.php.
	 *
	 * @since  0.0.0
	 *
	 * @param  WP_Component_Library $plugin Main plugin object.
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
		$this->hooks();

		parent::__construct(
			// Should be an array with Singular, Plural, and Registered name.
			array(
				__( 'Component Category', 'wds-component-library' ),
				__( 'Component Categories', 'wds-component-library' ),
				'wdscl-component-category',
			),
			// Register taxonomy arguments.
			array(
				'hierarchical' => false,
			),
			// Post types to attach to.
			array(
				'wdscl-component',
			)
		);
	}

	/**
	 * Initiate our hooks.
	 *
	 * @since 0.0.0
	 */
	public function hooks() {

	}
}
