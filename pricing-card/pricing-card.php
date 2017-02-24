<?php
/**
 * Image Hero
 *
 * @package _s
 */

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
