<?php
/**
 * Plugin Template Tags
 *
 * @package WDS_Components_Library
 */


add_filter( 'after_theme_setup', 'wdscl_hero_image_size' );
/**
 * Adds Hero Image size.
 */
function wdscl_hero_image_size() {

	add_image_size( 'hero-image', 1920, 500, true );
}

add_action( 'init', 'wdscl_register_social_menu' );
/**
 * Register a menu location for the social menu.
 */
function wdscl_register_social_menu() {

	// Register a social nav menu location.
	register_nav_menus( array(
		'social' => esc_html__( 'Social Menu', 'wds-component-library' ),
	) );
}
