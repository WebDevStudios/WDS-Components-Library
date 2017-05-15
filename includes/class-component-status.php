<?php
/**
 * WDS Component Library Component Status.
 *
 * @since   0.0.0
 * @package WP_Component_Library
 */

require_once dirname( __FILE__ ) . '/../vendor/taxonomy-core/Taxonomy_Core.php';

/**
 * WDS Component Library Component Status.
 *
 * @since 0.0.0
 *
 * @see   https://github.com/WebDevStudios/Taxonomy_Core
 */
class WDSCL_Component_Status extends Taxonomy_Core {
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
				__( 'Component Status', 'wds-component-library' ),
				__( 'Component Statuses', 'wds-component-library' ),
				'wdscl-component-status',
			),
			// Register taxonomy arguments.
			array(
				'hierarchical' => true,
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

	/**
	 * Get the status of a component.
	 *
	 * @author  Carrie Forde
	 */
	public function get_status() {

		$terms = get_the_terms( get_the_ID(), 'wdscl-component-status' );

		if ( $terms && ! is_wp_error( $status ) ) {

			$status = array();

			foreach ( $terms as $term ) {

				$status_color = get_term_meta( $term->term_id, 'status_color', true );

				printf( '<div class="component-status"><span class="status-color" style="background-color: %s"></span>%s</div>', esc_attr( $status_color ), esc_html( $term->name ) );
			}
		}
	}
}
