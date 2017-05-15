<?php
/**
 * WDS Component Library Pricing Table.
 *
 * @since   0.0.0
 * @package WDS_Component_Library
 */

/**
 * WDS Component Library Pricing Table.
 *
 * @since 0.0.0
 */
class WDSCL_Pricing_Table {

	/**
	 * Set the element name.
	 */
	private $component_name = 'pricing_table';

	/**
	 * Parent plugin class.
	 *
	 * @since 0.0.0
	 *
	 * @var   WDS_Component_Library
	 */
	protected $plugin = null;

	/**
	 * Constructor.
	 *
	 * @since  0.0.0
	 *
	 * @param  WDS_Component_Library $plugin Main plugin object.
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
		$this->hooks();
	}

	/**
	 * Initiate our hooks.
	 *
	 * @since  0.0.0
	 */
	public function hooks() {

	}

	/**
	 * Build & display the pricing card.
	 *
	 * @param   int  $args  The args.
	 *
	 * @author              Carrie Forde
	 */
	public function pricing_card_markup( $args = array() ) {

		$defaults = array(
			'title' => '',
			'price' => '',
			'description' => '',
			'features' => '',
		);
		$args = wp_parse_args( $args, $defaults );

		// Start the markup. 🎉 ?>
		<div class="pricing-card">
				<h3 class="pricing-title"><?php echo esc_html( $args['title'] ); ?></h3>
				<div class="pricing-price"><span class="pricing-currency"><?php echo esc_html( $args['currency'] ); ?></span><?php echo esc_html( $args['price'] ); ?></div>

				<?php if ( ! empty( $args['description'] ) ) : ?>
					<p class="pricing-sentence"><?php echo esc_html( $args['description'] ); ?></p>
				<?php endif; ?>

				<ul class="pricing-feature-list">
					<?php foreach ( $args['features'] as $feature ) : ?>
						<li class="pricing-feature"><?php echo esc_html( $feature ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>

		<?php
	}

	/**
	 * Display the pricing table markup.
	 *
	 * @param   int  $post_id  The Post ID.
	 * @param   int  $count    The flexible content row.
	 *
	 * @author                 Carrie Forde
	 */
	public function pricing_table_markup( $post_id = 0, $count ) {

		// Set the post ID if one wasn't passed.
		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		// If we're using this within the components library, we need the flexible content name, and row count.
		$component = get_post_meta( $post_id, 'component', true );
		$prefix    = ( ! empty( $component ) ) ? 'component_' . $count . '_' : '';

		// Get component variables.
		$title       = get_post_meta( $post_id, $prefix . 'title', true );
		$description = get_post_meta( $post_id, $prefix . 'description', true );
		$card        = get_post_meta( $post_id, $prefix . 'pricing_card', true );

		// Bail if we don't have pricing cards.
		if ( empty( $card ) ) {
			return;
		}

		// Start the markup. 🎉 ?>
		<section class="pricing-table">
			
			<?php if ( ! empty( $title ) ) : ?>
				<header class="pricing-header">
					<h2><?php echo esc_html( $title ); ?></h2>
					<?php echo wp_kses_post( $description ); ?>
				</header>
			<?php endif; // if ( ! empty( $title ) ) ?>

			<div class="pricing-inner-wrap">

				<?php for ( $i = 0; $i < $card; $i++ ) :

					$title = get_post_meta( $post_id, $prefix . 'pricing_card_' . $i . '_card_title', true );
					$price = get_post_meta( $post_id, $prefix . 'pricing_card_' . $i . '_price', true );
					$description = get_post_meta( $post_id, $prefix . 'pricing_card_' . $i . '_card_description', true );
					$features = get_post_meta( $post_id, $prefix . 'pricing_card_' . $i . '_features', true );

					// Get each feature, and store them in an array.
					$features_new = array();

					// Loop over $features, which always has an index of 0, and store them in our $features_new array.
					for ( $j = 0; $j < $features[0]; $j++ ) :
						$features_new[] = get_post_meta( $post_id, $prefix . 'pricing_card_' . $i . '_features_' . $j . '_feature', true );
					endfor;

					$this->pricing_card_markup( array(
						'title' => $title,
						'price' => $price,
						'description' => $description,
						'features' => $features_new,
					) );
				endfor; ?>
			</div>
		</section>

		<?php
	}
}
