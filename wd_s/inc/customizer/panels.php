<?php
/**
 * Customizer panels.
 *
 * @package _s
 */

/**
 * Add a custom panels to attach sections too.
 */
function _s_customize_panels( $wp_customize ) {

	// Register a new panel.
	$wp_customize->add_panel( 'site-options', array(
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__( 'Site Options', '_s' ),
		'description'    => esc_html__( 'Other theme options.', '_s' ),
	) );
}
add_action( 'customize_register', '_s_customize_panels' );
