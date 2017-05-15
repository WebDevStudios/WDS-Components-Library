<?php
/**
 * WDS Component Library Pricing Table Tests.
 *
 * @since   0.0.0
 * @package WDS_Component_Library
 */
class WDSCL_Pricing_Table_Test extends WP_UnitTestCase {

	/**
	 * Test if our class exists.
	 *
	 * @since  0.0.0
	 */
	function test_class_exists() {
		$this->assertTrue( class_exists( 'WDSCL_Pricing_Table') );
	}

	/**
	 * Test that we can access our class through our helper function.
	 *
	 * @since  0.0.0
	 */
	function test_class_access() {
		$this->assertInstanceOf( wds_component_library()->pricing-table, 'WDSCL_Pricing_Table' );
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
