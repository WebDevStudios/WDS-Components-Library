<?php
/**
 * Video Hero CMB2 meta.
 *
 * @link https://github.com/WebDevStudios/CMB2/wiki/Basic-Usage
 */

add_action( 'cmb2_admin_init', '_s_video_hero_meta' );
/**
 * Create the Video Hero metabox.
 *
 */
function _s_video_hero_meta() {

	// Optional. See readme for usage.
	$prefix = '_s_';

	$video_hero = new_cmb2_box( array(
		'id' => 'video_meta',
		'title' => esc_html__( 'Video Hero', '_s' ),
		'object_types' => array( 'page' ),
	) );

	$video_hero->add_field( array(
		'name'    => 'Background Image',
		'desc'    => 'Upload an image at least 1920 pixels wide. This is used as a backup in case the video fails.',
		'id'      => 'background_image',
		'type'    => 'file',
		'options' => array( 'url' => false ),
	) );

	$video_hero->add_field( array(
		'name'    => 'Background Video',
		'desc'    => 'Provide a link to video that will be used.',
		'id'      => 'background_video',
		'type'    => 'text_url',
	) );

	$video_hero->add_field( array(
		'name'  => 'Hero Title',
		'desc'  => 'Optional. Enter a title for the hero that draws the user into the content.',
		'id'    => 'hero_title',
		'type'  => 'text',
	) );

	$video_hero->add_field( array(
		'name'  => 'Hero Description',
		'desc'  => 'Optional. Add a description that will tell users more about you, your company, your products, or your services.',
		'id'    => 'hero_description',
		'type'  => 'wysiwyg',
	) );

	$video_hero->add_field( array(
		'name'  => 'Button Link',
		'desc'  => 'Optional. Add a link to for the call to action.',
		'id'    => 'button_link',
		'type'  => 'text_url',
	) );

	$video_hero->add_field( array(
		'name'  => 'Button Title',
		'desc'  => 'Optional. The title helps with accessibility when the link text isn\'t very descriptive (i.e. Click Here).',
		'id'    => 'button_title',
		'type'  => 'text',
	) );

	$video_hero->add_field( array(
		'name'  => 'Button Text',
		'desc'  => 'Optional. Add text to the button.',
		'id'    => 'button_text',
		'type'  => 'text',
	) );
}
