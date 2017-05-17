<?php
/**
 * WDS Component Library Equal Height Cards Tests.
 *
 * @since   0.0.0
 * @package WDS_Component_Library
 */
class WDSCL_Equal_Height_Cards_Test extends WP_UnitTestCase {

	/**
	 * Test if our class exists.
	 *
	 * @since  0.0.0
	 */
	function test_class_exists() {
		$this->assertTrue( class_exists( 'WDSCL_Equal_Height_Cards') );
	}

	/**
	 * Test that we can access our class through our helper function.
	 *
	 * @since  0.0.0
	 */
	function test_class_access() {
		$this->assertInstanceOf( wds_component_library()->equal-height-cards, 'WDSCL_Equal_Height_Cards' );
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
