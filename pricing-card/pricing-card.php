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
