<?php
/**
 * Cards component.
 *
 * This component is used to show sections of cards.
 *
 * @since   0.0.0
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
$type = get_post_meta( $post_id, $prefix . 'type', true );
$number = get_post_meta( $post_id, $prefix . 'number_of_posts', true );

// Start the markup. ?>
<section class="container cards cards-<?php echo esc_attr( $type ); ?>">

	<div class="row">
		<?php wdscl_fetch_posts( array( 'posts_per_page' => $number ) ); ?>
	</div>
</section>
