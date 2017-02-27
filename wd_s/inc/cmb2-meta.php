<?php
/**
 * image Hero CMB2 meta.
 *
 * @link https://github.com/WebDevStudios/CMB2/wiki/Basic-Usage
 */

//add_action( 'cmb2_admin_init', '_s_image_hero_meta' );
/**
 * Create the image Hero metabox.
 *
 */
function _s_image_hero_meta() {

	// Optional. See readme for usage.
	$prefix = '_s_';

	$image_hero = new_cmb2_box( array(
		'id' => 'image_meta',
		'title' => esc_html__( 'image Hero', '_s' ),
		'object_types' => array( 'page' ),
	) );

	$image_hero->add_field( array(
		'name'    => 'Background Image',
		'desc'    => 'Upload an image at least 1920 pixels wide. This is used as a backup in case the image fails.',
		'id'      => 'background_image',
		'type'    => 'file',
		'options' => array( 'url' => false, ),
	) );

	$image_hero->add_field( array(
		'name'  => 'Hero Title',
		'desc'  => 'Optional. Enter a title for the hero that draws the user into the content.',
		'id'    => 'hero_title',
		'type'  => 'text',
	) );

	$image_hero->add_field( array(
		'name'  => 'Hero Description',
		'desc'  => 'Optional. Add a description that will tell users more about you, your company, your products, or your services.',
		'id'    => 'hero_description',
		'type'  => 'wysiwyg',
	) );

	$image_hero->add_field( array(
		'name'  => 'Button Link',
		'desc'  => 'Optional, but required if using a button. Add a link to for the call to action.',
		'id'    => 'button_link',
		'type'  => 'text_url',
	) );

	$image_hero->add_field( array(
		'name'  => 'Button Title',
		'desc'  => 'Optional. The title helps with accessibility when the link text isn\'t very descriptive (i.e. Click Here).',
		'id'    => 'button_title',
		'type'  => 'text',
	) );

	$image_hero->add_field( array(
		'name'  => 'Button Text',
		'desc'  => 'Optional, but required if using a button. Add text to the button.',
		'id'    => 'button_text',
		'type'  => 'text'
	) );
}

//add_action( 'cmb2_admin_init', '_s_video_hero_meta' );
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
		'options' => array( 'url' => false, ),
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
		'type'  => 'text'
	) );
}

add_action( 'cmb2_admin_init', '_s_pricing_card_meta' );
/**
 * Create the Pricing Section metabox.
 */
function _s_pricing_card_meta() {

	// Optional. See readme for usage.
	$prefix = '_s_';

	$pricing_card = new_cmb2_box( array(
		'id'           => 'pricing_section',
		'title'        => esc_html__( 'Pricing Section', '_s' ),
		'object_types' => array( 'page' ),
	) );

	$pricing_card->add_field( array(
		'name'    => 'Pricing Section Title.',
		'desc'    => 'Optional. Add a title to the card section.',
		'id'      => 'pricing_header',
		'type'    => 'text',
	) );

	$pricing_card->add_field( array(
		'name' => 'Pricing Section Description.',
		'desc' => 'Optional. Add some descriptive text about the products or services offered.',
		'id'   => 'pricing_description',
		'type' => 'textarea',
	) );

	$pricing_card_group = $pricing_card->add_field( array(
		'id'      => 'pricing_card_group',
		'type'    => 'group',
		'desc'    => __( 'Add cards for individual products or services offered.', '_s' ),
		'options' => array(
			'group_title'   => __( 'Pricing Card {#}', '_s' ),
			'add_button'    => __( 'Add another card', '_s' ),
			'remove_button' => __( 'Remove card', '_s' ),
			'sortable'      => true,
		),
	) );

	$pricing_card->add_group_field( $pricing_card_group, array(
		'name' => 'Card Title',
		'desc' => 'Enter a title for the card.',
		'id'   => 'card_title',
		'type' => 'text',
	) );

	$pricing_card->add_group_field( $pricing_card_group, array(
		'name'    => 'Currency Symbol',
		'desc'    => 'Select a currency symbol.',
		'id'      => 'currency',
		'type'    => 'select',
		'options' => array(
			'$' => '$',
			'£' => '£',
		),
	) );

	$pricing_card->add_group_field( $pricing_card_group, array(
		'name' => 'Price',
		'desc' => 'Enter a price for the product or service.',
		'id'   => 'price',
		'type' => 'text',
	) );

	$pricing_card->add_group_field( $pricing_card_group, array(
		'name' => 'Description',
		'desc' => 'Enter a short description of the product or service.',
		'id'   => 'card_description',
		'type' => 'textarea',
	) );

	$pricing_card->add_group_field( $pricing_card_group, array(
		'name'       => 'Features',
		'desc'       => 'Enter the features or benefits of the product or service.',
		'id'         => 'features',
		'type'       => 'text',
		'repeatable' => true,
	) );

	$pricing_card->add_group_field( $pricing_card_group, array(
		'name' => 'Button Text',
		'desc' => 'Enter text to appear on the card button.',
		'id'   => 'button_text',
		'type' => 'text',
	) );
}
