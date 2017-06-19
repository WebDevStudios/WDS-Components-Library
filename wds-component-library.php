<?php
/**
 * Plugin Name: WDS Component Library
 * Plugin URI:  https://webdevstudios.com
 * Description: Manage and collaborate on UI components through WordPress.
 * Version:     0.0.0
 * Author:      webdevstudios
 * Author URI:  https://webdevstudios.com
 * Donate link: https://webdevstudios.com
 * License:     GPLv2
 * Text Domain: wds-component-library
 * Domain Path: /languages
 *
 * @link    https://webdevstudios.com
 *
 * @package WDS_Component_Library
 * @version 0.0.0
 *
 * Built using generator-plugin-wp (https://github.com/WebDevStudios/generator-plugin-wp)
 */

/**
 * Copyright (c) 2017 webdevstudios (email : carrie@webdevstudios.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */


/**
 * Autoloads files with classes when needed.
 *
 * @since  0.0.0
 * @param  string $class_name Name of the class being requested.
 */
function wds_component_library_autoload_classes( $class_name ) {

	// If our class doesn't have our prefix, don't load it.
	if ( 0 !== strpos( $class_name, 'WDSCL_' ) ) {
		return;
	}

	// Set up our filename.
	$filename = strtolower( str_replace( '_', '-', substr( $class_name, strlen( 'WDSCL_' ) ) ) );

	// Include our file.
	WDS_Component_Library::include_file( 'includes/class-' . $filename );
}
spl_autoload_register( 'wds_component_library_autoload_classes' );

/**
 * Main initiation class.
 *
 * @since  0.0.0
 */
final class WDS_Component_Library {

	/**
	 * Current version.
	 *
	 * @var    string
	 * @since  0.0.0
	 */
	const VERSION = '0.0.0';

	/**
	 * URL of plugin directory.
	 *
	 * @var    string
	 * @since  0.0.0
	 */
	protected $url = '';

	/**
	 * Path of plugin directory.
	 *
	 * @var    string
	 * @since  0.0.0
	 */
	protected $path = '';

	/**
	 * Plugin basename.
	 *
	 * @var    string
	 * @since  0.0.0
	 */
	protected $basename = '';

	/**
	 * Detailed activation error messages.
	 *
	 * @var    array
	 * @since  0.0.0
	 */
	protected $activation_errors = array();

	/**
	 * Singleton instance of plugin.
	 *
	 * @var    WDS_Component_Library
	 * @since  0.0.0
	 */
	protected static $single_instance = null;

	/**
	 * Instance of WDSCL_Component
	 *
	 * @since0.0.0
	 * @var WDSCL_Component
	 */
	protected $component;

	/**
	 * Instance of WDSCL_Component_Status
	 *
	 * @since0.0.0
	 * @var WDSCL_Component_Status
	 */
	protected $component_status;

	/**
	 * Instance of WDSCL_Component_Category
	 *
	 * @since0.0.0
	 * @var WDSCL_Component_Category
	 */
	protected $component_category;

	/**
	 * Creates or returns an instance of this class.
	 *
	 * @since   0.0.0
	 * @return  WDS_Component_Library A single instance of this class.
	 */
	public static function get_instance() {
		if ( null === self::$single_instance ) {
			self::$single_instance = new self();
		}

		return self::$single_instance;
	}

	/**
	 * Sets up our plugin.
	 *
	 * @since  0.0.0
	 */
	protected function __construct() {
		$this->basename = plugin_basename( __FILE__ );
		$this->url      = plugin_dir_url( __FILE__ );
		$this->path     = plugin_dir_path( __FILE__ );
	}

	/**
	 * Attach other plugin classes to the base plugin class.
	 *
	 * @since  0.0.0
	 */
	public function plugin_classes() {

		$this->component = new WDSCL_Component( $this );
		$this->component_status = new WDSCL_Component_Status( $this );
		$this->component_category = new WDSCL_Component_Category( $this );
	} // END OF PLUGIN CLASSES FUNCTION

	/**
	 * Add hooks and filters.
	 * Priority needs to be
	 * < 10 for CPT_Core,
	 * < 5 for Taxonomy_Core,
	 * and 0 for Widgets because widgets_init runs at init priority 1.
	 *
	 * @since  0.0.0
	 */
	public function hooks() {
		add_action( 'init', array( $this, 'init' ), 0 );
		add_action( 'acf/settings/save_json', array( $this, 'acf_json_save_point' ) );
		add_action( 'acf/settings/load_json', array( $this, 'acf_json_load_point' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts_styles' ) );
	}

	/**
	 * Activate the plugin.
	 *
	 * @since  0.0.0
	 */
	public function _activate() {

		// Make sure any rewrite functionality has been loaded.
		flush_rewrite_rules();
	}

	/**
	 * Deactivate the plugin.
	 * Uninstall routines should be in uninstall.php.
	 *
	 * @since  0.0.0
	 */
	public function _deactivate() {
		// Add deactivation cleanup functionality here.
	}

	/**
	 * Init hooks
	 *
	 * @since  0.0.0
	 */
	public function init() {

		// Bail early if requirements aren't met.
		if ( ! $this->check_requirements() ) {
			return;
		}

		// Load translated strings for plugin.
		load_plugin_textdomain( 'wds-component-library', false, dirname( $this->basename ) . '/languages/' );

		// Initialize plugin classes.
		$this->plugin_classes();
	}

	/**
	 * Tell ACF that our acf-json save point is in the plugin.
	 *
	 * @param  string  The location of the acf-json directory.
	 */
	public function acf_json_save_point( $path ) {

		// Point the ACF JSON folder to the plugin.
		$path = plugin_dir_path( __FILE__ ) . '/acf-json';

		return $path;
	}

	/**
	 * Tell ACF where the acf-json meta is saved.
	 *
	 * @param  string  The location of the acf-json directory.
	 */
	public function acf_json_load_point( $paths ) {

		// Append path to load plugin's ACF JSON (allows multiple load points).
		$paths[] = $this->path . 'acf-json';

		return $paths;
	}

	/**
	 * Enqueue plugin scripts & styles.
	 */
	public function enqueue_scripts_styles() {

		// Include the plugin's stylesheet.
		wp_enqueue_style( 'wdscl-styles', $this->url . 'styles.css', array(), '0.0.0' );

		// Enqueue Prism.js (and .css) & jQuery tabs only on the single component.
		if ( 'wdscl-component' === get_post_type() ) {

			// Font Awesome font.
			wp_enqueue_script( 'wdscl-fontawesome', '//use.fontawesome.com/f7361d8348.js', array(), '1.0.0', false );

			// Prism Styles.
			wp_enqueue_style( 'prism-styles', $this->url . 'assets/css/prism.css', array(), '0.0.0' );

			// Prism JS.
			wp_enqueue_script( 'prismjs', $this->url . 'assets/scripts/prism.js', array(), '1.0.0', true );

			// jQuery tabs.
			wp_enqueue_script( 'jquery-ui-tabs' );
		}

		// Include the plugin's scripts.
		wp_enqueue_script( 'wdscl-scripts', $this->url . 'assets/scripts/project.js', array( 'jquery', 'jquery-ui-tabs' ), '0.0.0', true );
	}

	/**
	 * Check if the plugin meets requirements and
	 * disable it if they are not present.
	 *
	 * @since  0.0.0
	 *
	 * @return boolean True if requirements met, false if not.
	 */
	public function check_requirements() {

		// Bail early if plugin meets requirements.
		if ( $this->meets_requirements() ) {
			return true;
		}

		// Add a dashboard notice.
		add_action( 'all_admin_notices', array( $this, 'requirements_not_met_notice' ) );

		// Deactivate our plugin.
		add_action( 'admin_init', array( $this, 'deactivate_me' ) );

		// Didn't meet the requirements.
		return false;
	}

	/**
	 * Deactivates this plugin, hook this function on admin_init.
	 *
	 * @since  0.0.0
	 */
	public function deactivate_me() {

		// We do a check for deactivate_plugins before calling it, to protect
		// any developers from accidentally calling it too early and breaking things.
		if ( function_exists( 'deactivate_plugins' ) ) {
			deactivate_plugins( $this->basename );
		}
	}

	/**
	 * Check that all plugin requirements are met.
	 *
	 * @since  0.0.0
	 *
	 * @return boolean True if requirements are met.
	 */
	public function meets_requirements() {

		// Do checks for required classes / functions or similar.
		// Add detailed messages to $this->activation_errors array.
		return true;
	}

	/**
	 * Adds a notice to the dashboard if the plugin requirements are not met.
	 *
	 * @since  0.0.0
	 */
	public function requirements_not_met_notice() {

		// Compile default message.
		$default_message = sprintf( __( 'WDS Component Library is missing requirements and has been <a href="%s">deactivated</a>. Please make sure all requirements are available.', 'wds-component-library' ), admin_url( 'plugins.php' ) );

		// Default details to null.
		$details = null;

		// Add details if any exist.
		if ( $this->activation_errors && is_array( $this->activation_errors ) ) {
			$details = '<small>' . implode( '</small><br /><small>', $this->activation_errors ) . '</small>';
		}

		// Output errors.
		?>
		<div id="message" class="error">
			<p><?php echo wp_kses_post( $default_message ); ?></p>
			<?php echo wp_kses_post( $details ); ?>
		</div>
		<?php
	}

	/**
	 * Magic getter for our object.
	 *
	 * @since  0.0.0
	 *
	 * @param  string $field Field to get.
	 * @throws Exception     Throws an exception if the field is invalid.
	 * @return mixed         Value of the field.
	 */
	public function __get( $field ) {
		switch ( $field ) {
			case 'version':
				return self::VERSION;
			case 'basename':
			case 'url':
			case 'path':
			case 'component':
			case 'component_status':
			case 'component_category':
			case 'image_hero':
			case 'pricing_table':
			case 'video_hero':
			case 'social_menu':
			case 'equal_height_cards':
				return $this->$field;
			default:
				throw new Exception( 'Invalid ' . __CLASS__ . ' property: ' . $field );
		}
	}

	/**
	 * Include a file from the includes directory.
	 *
	 * @since  0.0.0
	 *
	 * @param  string $filename Name of the file to be included.
	 * @return boolean          Result of include call.
	 */
	public static function include_file( $filename ) {
		$file = self::dir( $filename . '.php' );
		if ( file_exists( $file ) ) {
			return include_once( $file );
		}
		return false;
	}

	/**
	 * This plugin's directory.
	 *
	 * @since  0.0.0
	 *
	 * @param  string $path (optional) appended path.
	 * @return string       Directory and path.
	 */
	public static function dir( $path = '' ) {
		static $dir;
		$dir = $dir ? $dir : trailingslashit( dirname( __FILE__ ) );
		return $dir . $path;
	}

	/**
	 * This plugin's url.
	 *
	 * @since  0.0.0
	 *
	 * @param  string $path (optional) appended path.
	 * @return string       URL and path.
	 */
	public static function url( $path = '' ) {
		static $url;
		$url = $url ? $url : trailingslashit( plugin_dir_url( __FILE__ ) );
		return $url . $path;
	}
}

/**
 * Grab the WDS_Component_Library object and return it.
 * Wrapper for WDS_Component_Library::get_instance().
 *
 * @since  0.0.0
 * @return WDS_Component_Library  Singleton instance of plugin class.
 */
function wds_component_library() {
	return WDS_Component_Library::get_instance();
}

// Kick it off.
add_action( 'plugins_loaded', array( wds_component_library(), 'hooks' ) );

// Activation and deactivation.
register_activation_hook( __FILE__, array( wds_component_library(), '_activate' ) );
register_deactivation_hook( __FILE__, array( wds_component_library(), '_deactivate' ) );
