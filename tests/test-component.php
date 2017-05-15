<?php
/**
 * WDS Component Library Component Tests.
 *
 * @since   0.0.0
 * @package WP_Component_Library
 */
class WDSCL_Component_Test extends WP_UnitTestCase {

	/**
	 * Test if our class exists.
	 *
	 * @since  0.0.0
	 */
	function test_class_exists() {
		$this->assertTrue( class_exists( 'WDSCL_Component') );
	}

	/**
	 * Test that we can access our class through our helper function.
	 *
	 * @since  0.0.0
	 */
	function test_class_access() {
		$this->assertInstanceOf( wp_component_library()->component, 'WDSCL_Component' );
	}

	/**
	 * Test to make sure the CPT now exists.
	 *
	 * @since  0.0.0
	 */
	function test_cpt_exists() {
		$this->assertTrue( post_type_exists( 'wdscl-component' ) );
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
