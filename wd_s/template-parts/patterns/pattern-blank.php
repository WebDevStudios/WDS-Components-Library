<?php
/**
 * The template used for displaying X in the pattern library.
 *
 * @package _s
 */
?>

<section class="section-pattern">

	<h2 class="pattern-heading"><?php esc_html_e( 'X', '_s' ); ?></h2>

	<?php _s_get_pattern_section( array(
		'title'        => '',
		'description'  => '',
		'usage'        => '',
		'parameters'   => array(),
		'arguments'    => array(),
		'output'       => '',
	) ); ?>
</section>
