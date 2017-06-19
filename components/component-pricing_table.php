<?php
/**
 * Pricing Table
 *
 * @package WDS_Components_Library
 */

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

			$title       = get_post_meta( $post_id, $prefix . 'pricing_card_' . $i . '_card_title', true );
			$price       = get_post_meta( $post_id, $prefix . 'pricing_card_' . $i . '_price', true );
			$description = get_post_meta( $post_id, $prefix . 'pricing_card_' . $i . '_card_description', true );
			$features    = get_post_meta( $post_id, $prefix . 'pricing_card_' . $i . '_features', true );

			// Get each feature, and store them in an array.
			$features_new = array();

			// Loop over $features, which always has an index of 0, and store them in our $features_new array.
			for ( $j = 0; $j < $features[0]; $j++ ) :
				$features_new[] = get_post_meta( $post_id, $prefix . 'pricing_card_' . $i . '_features_' . $j . '_feature', true );
			endfor;

			include( wds_component_library()->component->get_component_template_part( 'component', 'pricing_card', false ) );
		endfor; ?>
	</div>
</section>
