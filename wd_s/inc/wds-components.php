<?php
/**
 * WDS Component Library functions.
 *
 * File for demonstrating the WDS Component Library.
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

	// If there is no image, bail!
	if ( empty( $args['image'] ) ) {
		return;
	}

	ob_start(); ?>

	<section class="hero-area image-as-background" style="background-image: url( <?php echo esc_url( $args['image'] ); ?> );" role="dialog" aria-labelledby="hero-title" aria-describedby="hero-description">
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


/**
 * Build and return the pricing section markup.
 *
 * @param   array   [$args = array()]  The args.
 * @return  string                     The pricing section markup.
 *
 * @author Carrie Forde
 */
function _s_get_pricing_card( $args = array() ) {

	$defaults = array(
		'title'       => 'Startup',
		'description' => '',
		'currency'    => '$',
		'price'       => '9.90',
		'feature'     => array( 'Unlimited calls', 'Free hosting', '40MB of storage' ),
		'button_text' => 'Choose Plan',
	);
	$args = wp_parse_args( $args, $defaults );

	// Start the markup party! 🎉
	ob_start(); ?>

	<section class="pricing-section">

		<?php if ( ! empty( $args['header'] ) ) : ?>
			<header class="pricing-header">
				<h2><?php echo esc_html( $args['header'] ); ?></h2>
			</header>
		<?php endif; ?>

		<div class="pricing-inner-wrap">

			<div class="pricing-item">
				<h3 class="pricing-title"><?php echo esc_html( $args['title'] ); ?></h3>
				<div class="pricing-price"><span class="pricing-currency"><?php echo esc_html( $args['currency'] ); ?></span><?php echo esc_html( $args['price'] ); ?></div>
				<p class="pricing-sentence"><?php echo esc_html( $args['description'] ); ?></p>
				<ul class="pricing-feature-list">
					<?php foreach ( $args['feature'] as $feature ) : ?>
						<li class="pricing-feature"><?php echo esc_html( $feature ); ?></li>
					<?php endforeach; ?>
				</ul>
				<button class="pricing-action"><?php echo esc_html( $args['button_text'] ); ?></button>
			</div>
		</div>
	</section>

	<?php return ob_get_clean();
}

/**
 * Build the markup for a section of pricing cards.
 *
 * @param   array  [$args = array()]  The args.
 * @return  string                    The pricing section markup.
 *
 * @author Carrie Forde
 */

function _s_get_pricing_card_section( $args = array() ) {

	$post_id = get_the_ID();

	// Get the post meta.
	$section_header = get_post_meta( $post_id, 'pricing_header', true );
	$pricing_card = get_post_meta( $post_id, 'pricing_card', true );

	ob_start();

	for ( $i = 0; $i < $pricing_card; $i++ ) {

		$title = get_post_meta( $post_id, 'pricing_card' . $i . 'card_title', true );
		$currency = get_post_meta( $post_id, 'pricing_card' . $i . 'currency_symbol', true );
		$price = get_post_meta( $post_id, 'pricing_card' . $i . 'price', true );
		$description = get_post_meta( $post_id, 'pricing_card', $i . 'card_description' );
		$features = get_post_meta( $post_id, 'pricing_card' . $i . 'features' );

		// Pass the meta to the card function to get the card markup.
		echo _s_get_pricing_card( array(
			'title'       => $title,
			'description' => $description,
			'currency'    => $currency,
			'price'       => $price,
//			'feature'     => array( $features ),
			'button_text' => 'Choose Plan',
		) );
	}

	return ob_get_clean();
}
