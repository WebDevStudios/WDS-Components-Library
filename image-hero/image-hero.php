<?php
/**
 * Image Hero
 *
 * @package _s
 */

/**
 * Build the Image Hero markup.
 *
 * @param   array  [$args = array()]  The hero arguments.
 * @return  string                    The hero markup.
 *
 * @author Carrie Forde
 */
function _s_get_image_hero( $args = array() ) {

	$defaults = array(
		'image'         => 'https://unsplash.it/1920/1080',
		'title'         => 'Image Hero Title',
		'description'   => 'This is a hero description. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mihi enim erit isdem istis fortasse iam utendum. Quare ad ea primum, si videtur; Nec hoc ille non vidit, sed verborum magnificentia est et gloria delectatus.',
		'button_link'   => '',
		'button_title'  => 'Click to see more',
		'button_text'   => 'Click Me',
		'class'         => '',
	);
	$args = wp_parse_args( $args, $defaults );

	ob_start(); ?>

	<section class="hero-area image-as-background" style="background-image: url( <?php echo esc_url( $args['image'] ); ?> );" role="dialog" aria-labelledby="hero-title" aria-describedby="hero-description">
		<div class="hero-content">
			<h2 class="hero-title"><?php echo esc_html( $args['title'] ); ?></h2>
			<p class="hero-description"><?php echo esc_html( $args['description'] ); ?></p>
			<a href="<?php echo esc_url( $args['button_link'] ); ?>" class="hero-button" title="<?php echo esc_attr( $args['button_title'] ); ?>"><?php echo esc_html( $args['button_text'] ); ?></a>
		</div><!-- .hero-content -->
	</section><!-- .hero-area -->
	<!-- End Your Code -->

	<?php return ob_get_clean();
}

/**
 * Echo the Image Hero
 *
 * @param  array  [$args = array()]  The hero arguments.
 *
 * @author Carrie Forde
 */
function _s_the_image_hero( $args = array() ) {

	$post_id = get_the_ID();

	// Get the hero meta.
	$image         = get_post_meta( $post_id, 'background_image', true );
	$title         = get_post_meta( $post_id, 'hero_title', true );
	$description   = get_post_meta( $post_id, 'hero_description', true );
	$button_link   = get_post_meta( $post_id, 'button_link', true );
	$button_title  = get_post_meta( $post_id, 'button_title', true );
	$button_text   = get_post_meta( $post_id, 'button_text', true );

	// Grab the image object's URL.
	$image = wp_get_attachment_image_url( $image, 'full' );

	// Call our hero function.
	echo _s_get_image_hero( array( // WPCS: XSS OK
		'image'         => $image,
		'title'         => $title,
		'description'   => $description,
		'button_link'   => $button_link,
		'button_title'  => $button_title,
		'button_text'   => $button_text,
	) );
}
