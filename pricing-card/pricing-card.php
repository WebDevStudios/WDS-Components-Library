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
		'description' => 'Small business solution',
		'currency'    => '$',
		'price'       => '9.90',
		'feature'     => array( 'Unlimited calls', 'Free hosting', '40MB of storage' ),
		'button_text' => 'Choose Plan',
	);
	$args = wp_parse_args( $args, $defaults );

	// Start the markup party! 🎉
	ob_start(); ?>

			<div class="pricing-card">
				<h3 class="pricing-title"><?php echo esc_html( $args['title'] ); ?></h3>
				<div class="pricing-price"><span class="pricing-currency"><?php echo esc_html( $args['currency'] ); ?></span><?php echo esc_html( $args['price'] ); ?></div>

				<?php if ( ! empty( $args['description'] ) ) : ?>
					<p class="pricing-sentence"><?php echo esc_html( $args['description'] ); ?></p>
				<?php endif; ?>

				<ul class="pricing-feature-list">
					<?php foreach ( $args['feature'] as $feature ) : ?>
						<li class="pricing-feature"><?php echo esc_html( $feature ); ?></li>
					<?php endforeach; ?>
				</ul>
				<button class="pricing-action"><?php echo esc_html( $args['button_text'] ); ?></button>
			</div>

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

	// Let's use a friendlier ID.
	$post_id = get_the_ID();

	// Get the post meta.
	$section_header      = get_post_meta( $post_id, 'pricing_header', true );
	$section_description = get_post_meta( $post_id, 'pricing_description', true );
	$pricing_card        = get_post_meta( $post_id, 'pricing_card', true );

	ob_start(); ?>

	<section class="pricing-section">

		<?php if ( ! empty( $section_header ) ) : ?>
			<header class="pricing-header">
				<h2><?php echo esc_html( $section_header ); ?></h2>
				<?php echo wp_kses_post( $section_description ); ?>
			</header>
		<?php endif; ?>

		<div class="pricing-inner-wrap">

			<?php for ( $i = 0; $i < $pricing_card; $i++ ) :

				$title            = get_post_meta( $post_id, 'pricing_card_' . $i . '_card_title', true );
				$currency         = get_post_meta( $post_id, 'pricing_card_' . $i . '_currency_symbol', true );
				$price            = get_post_meta( $post_id, 'pricing_card_' . $i . '_price', true );
				$card_description = get_post_meta( $post_id, 'pricing_card_' . $i . '_card_description', true );
				$features         = get_post_meta( $post_id, 'pricing_card_' . $i . '_features', true );
				$button_text      = get_post_meta( $post_id, 'pricing_card_' . $i . '_button_text', true );

				// Get each feature, and store them in an array.
				$features_new = array();

				// Loop over $features, which always has an index of 0, and store them in our $features_new array.
				for ( $j = 0; $j < $features[0]; $j++ ) :

					$features_new[] = get_post_meta( $post_id, 'pricing_card_' . $i . '_features_' . $j . '_feature', true );
				endfor;

				// Pass the meta to the card function to get the card markup.
				echo _s_get_pricing_card( array( // WPCS: XSS OK
					'title'       => $title,
					'description' => $card_description,
					'currency'    => $currency,
					'price'       => $price,
					'feature'     => $features_new,
					'button_text' => $button_text,
				) );
			endfor; ?>
		</div>
	</section>

	<?php return ob_get_clean();
}
