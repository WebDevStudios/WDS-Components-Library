<?php
/**
 * WDS Component Library Video Hero Tests.
 *
 * @since   0.0.0
 * @package WDS_Component_Library
 */
class WDSCL_Video_Hero_Test extends WP_UnitTestCase {

	/**
	 * Test if our class exists.
	 *
	 * @since  0.0.0
	 */
	function test_class_exists() {
		$this->assertTrue( class_exists( 'WDSCL_Video_Hero') );
	}

	/**
	 * Test that we can access our class through our helper function.
	 *
	 * @since  0.0.0
	 */
	function test_class_access() {
		$this->assertInstanceOf( wds_component_library()->video-hero, 'WDSCL_Video_Hero' );
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
