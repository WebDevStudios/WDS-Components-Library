<?php
/**
 * Video Hero
 *
 * @package _s
 */


/**
 * Build the Video Hero markup.
 *
 * @param   array  [$args = array()]  The hero arguments.
 * @return  string                    The hero markup.
 *
 * @author Carrie Forde
 */
function _s_get_video_hero( $args = array() ) {

	$defaults = array(
		'image'        => 'https://unsplash.it/1920/1080',
		'video'        => 'https://dl.dropbox.com/s/xdjcqj9xurdty24/morning-storm-1080p.mp4?dl=0" type="video/mp4',
		'title'        => __( 'Video Hero Title', '_s' ),
		'description'  => __( 'This is the description. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Si longus, levis; An eum discere ea mavis, quae cum plane perdidiceriti nihil sciat?', '_s' ),
		'button_link'  => '#',
		'button_title' => __( 'Click to see more', '_s' ),
		'button_text'  => __( 'Click Me', '_s' ),
		'class'        => '',
	);
	$args = wp_parse_args( $args, $defaults );

	// Bail if there is no video.
	if ( empty( $args['video'] ) ) {
		return;
	}

	ob_start(); ?>

		<section class="hero-area image-as-background" <?php echo ( ! empty ( $args['image'] ) ) ? 'style="background-image: url(' . esc_url( $args['image'] ) . ')"' : '' ?> role="dialog" aria-labelledby="hero-title" aria-describedby="hero-description">
			<video class="video-as-background" autoplay muted loop preload="auto"><source src="<?php echo esc_url( $args['video'] ); ?>"></video>
			<div class="hero-content">
				<?php if ( ! empty( $args['title'] ) ) : ?>
					<h2 class="hero-title"><?php echo esc_html( $args['title'] ); ?></h2>
				<?php endif; ?>

				<?php if ( ! empty( $args['description'] ) ) : ?>
					<p class="hero-description"><?php echo esc_html( $args['description'] ); ?></p>
				<?php endif; ?>

				<?php if ( ! empty ( $args['button_link'] && $args['button_text'] ) ) : ?>
					<a href="<?php echo esc_url( $args['button_link'] ); ?>" class="hero-button" <?php echo ( ! empty( $args['button_title'] ) ) ? 'title="' . esc_attr( $args['button_title'] ) . '"' : '' ?>><?php echo esc_html( $args['button_text'] ); ?></a>
				<?php endif; ?>
			</div><!-- .hero-content -->
		</section><!-- .hero-area -->

	<?php return ob_get_clean();
}

/**
 * Echo the Video Hero.
 *
 * @param  array  [$args = array()]  The hero arguments.
 */
function _s_the_video_hero( $args = array() ) {

	$post_id = get_the_ID();

	// Get the hero meta.
	$image         = get_post_meta( $post_id, 'background_image', true );
	$video         = get_post_meta( $post_id, 'background_video', true );
	$title         = get_post_meta( $post_id, 'hero_title', true );
	$description   = get_post_meta( $post_id, 'hero_description', true );
	$button_link   = get_post_meta( $post_id, 'button_link', true );
	$button_title  = get_post_meta( $post_id, 'button_title', true );
	$button_text   = get_post_meta( $post_id, 'button_text', true );

	// Grab the image object's URL.
	$image = wp_get_attachment_image_url( $image, 'full' );

	// Call our hero function.
	echo _s_get_video_hero( array( // WPCS: XSS OK
		'image'         => $image,
		'video'         => $video,
		'title'         => $title,
		'description'   => $description,
		'button_link'   => $button_link,
		'button_title'  => $button_title,
		'button_text'   => $button_text,
	) );
}
