<?php
/**
 * WP Component Library Component Tests.
 *
 * @since   0.0.0
 * @package WP_Component_Library
 */
class WPCL_Component_Test extends WP_UnitTestCase {

	/**
	 * Test if our class exists.
	 *
	 * @since  0.0.0
	 */
	function test_class_exists() {
		$this->assertTrue( class_exists( 'WPCL_Component') );
	}

	/**
	 * Test that we can access our class through our helper function.
	 *
	 * @since  0.0.0
	 */
	function test_class_access() {
		$this->assertInstanceOf( wp_component_library()->component, 'WPCL_Component' );
	}

	/**
	 * Test to make sure the CPT now exists.
	 *
	 * @since  0.0.0
	 */
	function test_cpt_exists() {
		$this->assertTrue( post_type_exists( 'wpcl-component' ) );
	}

	/**
	 * Replace this with some actual testing code.
	 *
	 * @since  0.0.0
	 */
	function test_sample() {
		$this->assertTrue( true );
	}
}
