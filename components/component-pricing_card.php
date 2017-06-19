<?php
/**
 * Pricing Card
 *
 * @package WDS_Components_Library
 */

// Start the markup. 🎉 ?>
<div class="pricing-card">
	<h3 class="pricing-title"><?php echo esc_html( $title ); ?></h3>
	<div class="pricing-price"><?php echo esc_html( $price ); ?></div>

	<?php if ( ! empty( $description ) ) : ?>
		<p class="pricing-sentence"><?php echo esc_html( $description ); ?></p>
	<?php endif; ?>

	<ul class="pricing-feature-list">
		<?php foreach ( $features_new as $feature ) : ?>
			<li class="pricing-feature"><?php echo esc_html( $feature ); ?></li>
		<?php endforeach; ?>
	</ul>
</div>
