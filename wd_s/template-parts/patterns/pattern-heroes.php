<?php
/**
 * The template used for displaying X in the pattern library.
 *
 * @package _s
 */
?>

<section class="section-pattern">

	<h2 class="pattern-heading"><?php esc_html_e( 'Heroes', '_s' ); ?></h2>

	<?php echo _s_get_pattern_section( array(
		'title'        => 'Image Hero',
		'description'  => 'The WDS Components Image Hero. View the /image-hero/ folder for php, Sass, and ACF or CMB2 meta fields that can be dropped into the theme.',
		'usage'        => '_s_the_image_hero()',
		'parameters'   => array( '$args' => 'array()' ),
		'arguments'    => array(
			'image'         => 'https://unsplash.it/1920/1080',
			'title'         => 'Image Hero Title',
			'description'   => 'This is a hero description. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mihi enim erit isdem istis fortasse iam utendum. Quare ad ea primum, si videtur; Nec hoc ille non vidit, sed verborum magnificentia est et gloria delectatus.',
			'button_link'   => '',
			'button_title'  => 'Click to see more',
			'button_text'   => 'Click Me',
			'class'         => '',
		),
		'output'       => _s_get_image_hero(),
	) ); ?>

	<?php echo _s_get_pattern_section( array(
		'title'        => 'Video Hero',
		'description'  => 'The WDS Components Video Hero. View the /video-hero/ folder for php, Sass, and ACF or CMB2 meta fields that can be dropped into the theme.',
		'usage'        => '_s_the_video_hero()',
		'parameters'   => array( '$args' => 'The hero args.' ),
		'arguments'    => array(
			'image'        => 'https://unsplash.it/1920/1080',
			'video'        => 'https://dl.dropbox.com/s/xdjcqj9xurdty24/morning-storm-1080p.mp4?dl=0" type="video/mp4',
			'title'        => __( 'Video Hero Title', '_s' ),
			'description'  => __( 'This is the description. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Si longus, levis; An eum discere ea mavis, quae cum plane perdidiceriti nihil sciat?', '_s' ),
			'button_link'  => '#',
			'button_title' => __( 'Click to see more', '_s' ),
			'button_text'  => __( 'Click Me', '_s' ),
			'class'        => '',
		),
		'output'       => _s_get_video_hero(),
	) ); ?>
</section>
