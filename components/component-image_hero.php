<?php
/**
 * Image Hero
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
$image       = get_post_meta( $post_id, $prefix . 'background_image', true );
$title       = get_post_meta( $post_id, $prefix . 'title', true );
$description = get_post_meta( $post_id, $prefix . 'description', true );
$cta_button  = get_post_meta( $post_id, $prefix . 'cta_button', true );

// Bail if the image is empty.
if ( empty( $image ) ) {
	return;
}

// Start the markup. 🎉 ?>
<section class="hero-area image-as-background" style="background-image: url( <?php echo esc_url( wp_get_attachment_image_url( $image, 'hero-image' ) ); ?> );" role="dialog" aria-labelledby="hero-title" aria-describedby="hero-description">
	<div class="hero-content">
		<?php if ( ! empty( $title ) ) : ?>
			<h2 class="hero-title"><?php echo esc_html( $title ); ?></h2>
		<?php endif; ?>

		<?php if ( ! empty( $description ) ) : ?>
			<div class="hero-description"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
		<?php endif; ?>

		<?php if ( 'yes' === $cta_button ) :
			$button_text = get_post_meta( $post_id, $prefix . 'button_text', true );
			$button_link = get_post_meta( $post_id, $prefix . 'button_link', true );

			// Output the button if we have both the text & the link.
			if ( ! empty( $button_text && $button_link ) ) :?>
				<a href="<?php echo esc_url( $button_link ); ?>" class="button hero-button"><?php echo esc_html( $button_text ); ?></a>
			<?php endif;
		endif; ?>
	</div><!-- .hero-content -->
</section><!-- .hero-area -->
