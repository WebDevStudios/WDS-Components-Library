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
