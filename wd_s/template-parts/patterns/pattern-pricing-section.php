<?php
/**
 * The template used for displaying the Pricing Section in the pattern library.
 *
 * @package _s
 */
?>

<section class="section-pattern">

	<h2 class="pattern-heading"><?php esc_html_e( 'Pricing Section', '_s' ); ?></h2>

	<?php echo _s_get_pattern_section( array(
		'title'        => 'Pricing Section',
		'description'  => '',
		'usage'        => '',
		'parameters'   => array(),
		'arguments'    => array(),
		'output'       => _s_get_pricing_card(),
	) ); ?>
</section>
