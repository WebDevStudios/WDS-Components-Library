<?php
/**
 * WDS Component Library Component Category Tests.
 *
 * @since   0.0.0
 * @package WP_Component_Library
 */
class WDSCL_Component_Category_Test extends WP_UnitTestCase {

	/**
	 * Test if our class exists.
	 *
	 * @since  0.0.0
	 */
	function test_class_exists() {
		$this->assertTrue( class_exists( 'WDSCL_Component_Category') );
	}

	/**
	 * Test that we can access our class through our helper function.
	 *
	 * @since  0.0.0
	 */
	function test_class_access() {
		$this->assertInstanceOf( wp_component_library()->component-category, 'WDSCL_Component_Category' );
	}

	/**
	 * Test that our taxonomy now exists.
	 *
	 * @since  0.0.0
	 */
	function test_taxonomy_exists() {
		$this->assertTrue( taxonomy_exists( 'wdscl-component-categ' ) );
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
