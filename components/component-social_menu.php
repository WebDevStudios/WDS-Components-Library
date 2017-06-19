<?php
/**
 * Social Menu
 *
 * @package WDS_Components_Library
 */

// Start the markup. 🎉 ?>
<nav id="social-media-menu">

	<?php wp_nav_menu( array(
		'theme_location'  => 'social',
		'menu_class'      => 'social-menu',
		'container_class' => 'social-media-menu',
		'depth'           => 1,
		'link_before'     => '<span class="screen-reader-text">',
		'link_after'      => '</span>',
	) ); ?>
</nav>
