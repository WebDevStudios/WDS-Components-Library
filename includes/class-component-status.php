<?php
/**
 * WP Component Library Component Status.
 *
 * @since   0.0.0
 * @package WP_Component_Library
 */

require_once dirname( __FILE__ ) . '/../vendor/taxonomy-core/Taxonomy_Core.php';

/**
 * WP Component Library Component Status.
 *
 * @since 0.0.0
 *
 * @see   https://github.com/WebDevStudios/Taxonomy_Core
 */
class WPCL_Component_Status extends Taxonomy_Core {
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
				__( 'Component Status', 'wp-component-library' ),
				__( 'Component Statuses', 'wp-component-library' ),
				'wpcl-component-status',
			),
			// Register taxonomy arguments.
			array(
				'hierarchical' => false,
			),
			// Post types to attach to.
			array(
				'wpcl-component',
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

	public function get_status() {

		$terms = get_the_terms( get_the_ID(), 'wpcl-component-status' );

		if ( $terms && ! is_wp_error( $status ) ) {

			$status = array();

			foreach ( $terms as $term ) {

				$status_color = get_term_meta( $term->term_id, 'status_color', true );

				$status = printf( '<span class="component-status"><span class="status-color" style="background-color: %s"></span>%s</span>', esc_attr( $status_color ), esc_html( $term->name ) );
			}
		}
	}
}
