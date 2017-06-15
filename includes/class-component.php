<?php
/**
 * WDS Component Library Component.
 *
 * @since   0.0.0
 * @package WDS_Component_Library
 */

require_once dirname( __FILE__ ) . '/../vendor/cpt-core/CPT_Core.php';

/**
 * WDS Component Library Component post type class.
 *
 * @since 0.0.0
 *
 * @see   https://github.com/WebDevStudios/CPT_Core
 */
class WDSCL_Component extends CPT_Core {
	/**
	 * Parent plugin class.
	 *
	 * @var WDS_Component_Library
	 * @since  0.0.0
	 */
	protected $plugin = null;

	/**
	 * Constructor.
	 *
	 * Register Custom Post Types.
	 *
	 * See documentation in CPT_Core, and in wp-includes/post.php.
	 *
	 * @since  0.0.0
	 *
	 * @param  WDS_Component_Library $plugin Main plugin object.
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
		$this->hooks();

		// Register this cpt.
		// First parameter should be an array with Singular, Plural, and Registered name.
		parent::__construct(
			array(
				__( 'Component', 'wds-component-library' ),
				__( 'Components', 'wds-component-library' ),
				'wdscl-component',
			),
			array(
				'supports'  => array(
					'title',
					'editor',
					'thumbnail',
				),
				'menu_icon' => 'dashicons-archive',
				'public'    => true,
			)
		);
	}

	/**
	 * Initiate our hooks.
	 *
	 * @since  0.0.0
	 */
	public function hooks() {
		add_filter( 'template_include', array( $this, 'component_template' ), 99 );
		add_filter( 'body_class', array( $this, 'add_body_classes' ) );
	}

	/**
	 * Registers admin columns to display. Hooked in via CPT_Core.
	 *
	 * @since  0.0.0
	 *
	 * @param  array $columns Array of registered column names/labels.
	 * @return array          Modified array.
	 */
	public function columns( $columns ) {
		$new_column = array();
		return array_merge( $new_column, $columns );
	}

	/**
	 * Handles admin column display. Hooked in via CPT_Core.
	 *
	 * @since  0.0.0
	 *
	 * @param array   $column   Column currently being rendered.
	 * @param integer $post_id  ID of post to display column for.
	 */
	public function columns_display( $column, $post_id ) {
		switch ( $column ) {
		}
	}

	/**
	 * Display component post meta.
	 *
	 * @author  Carrie Forde
	 */
	public function display_post_entry_meta( $post_id = 0 ) {

		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U', $post_id ) !== get_post_modified_time( 'U', false, $post_id ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c', $post_id ) ),
			esc_html( get_the_date( '', $post_id ) ),
			esc_attr( get_post_modified_time( 'c', false, $post_id ) ),
			esc_html( get_post_modified_time( '', false, $post_id ) )
		);

		$posted_on = sprintf(
			esc_html_x( 'Published %s', 'post date', 'wds-component-library' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$author_id = get_post_field( 'post_author', $post_id );

		$byline = sprintf(
			esc_html_x( 'by %s', 'post author', 'wds-component-library' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( $author_id ) ) . '">' . esc_html( get_the_author_meta( 'display_name', $author_id ) ) . '</a></span>'
		);

		printf( '<div class="entry-meta"><span class="posted-on">%s</span><span class="byline">%s</span></div>', $posted_on, $byline ); // WPCS: XSS OK.
	}

	/**
	 * Add body class.
	 */
	public function add_body_classes( $classes ) {

		if ( is_singular( 'wdscl-component' ) ) {

			// Get our data.
			$component = get_post_meta( get_the_ID(), 'component', true );

			// Replace underscores with hyphens.
			$component = str_replace( '_', '-', $component[0] );

			// Add the component name to the string.
			$classes[] = 'component-' . $component;
		}

		return $classes;
	}

	/**
	 * Retrieve the name of the highest priority template file that exists.
	 *
	 * Searches in the STYLESHEETPATH before TEMPLATEPATH so that themes which
	 * inherit from a parent theme can just overload one file. If the template is
	 * not found in either of those, it looks in the theme-compat folder last.
	 *
	 * Modified from example on Pippin's Plugins.
	 *
	 * @link  https://pippinsplugins.com/template-file-loaders-plugins/
	 *
	 * @since 0.0.0
	 *
	 * @param string|array $template_names Template file(s) to search for, in order.
	 * @param bool $load If true the template file will be loaded if it is found.
	 * @param bool $require_once Whether to require_once or require. Default true.
	 *                            Has no effect if $load is false.
	 * @return string The template filename if one is located.
	 */
	public function locate_component_template( $template_names, $load = false, $require_once = true ) {

		// No file found yet
		$located = false;

		// Try to find a template file
		foreach ( (array) $template_names as $template_name ) {

			// Continue if template is empty.
			if ( empty( $template_name ) ) {
				continue;
			}

			// Trim off any slashes from the template name
			$template_name = ltrim( $template_name, '/' );

			// Check child theme first.
			if ( file_exists( trailingslashit( get_stylesheet_directory() ) . 'template-parts/components/' . $template_name ) ) {
				$located = trailingslashit( get_stylesheet_directory() ) . 'template-parts/components/' . $template_name;
				break;

			// Check parent theme next.
			} elseif ( file_exists( trailingslashit( get_template_directory() ) . 'template-parts/components/' . $template_name ) ) {
				$located = trailingslashit( get_template_directory() ) . 'template-parts/components/' . $template_name;
				break;

			// Check theme compatibility last.
			} elseif ( file_exists( trailingslashit( $this->plugin->path ) . 'components/' . $template_name ) ) {
				$located = trailingslashit( $this->plugin->path ) . 'components/' . $template_name;
				break;
			}
		}

		if ( ( true === $load ) && ! empty( $located ) ) {
			load_template( $located, $require_once );
		}

		return $located;
	}

	/**
	 * Retrieves a template part
	 *
	 * Modified from example on Pippin's Plugins.
	 *
	 * @link  https://pippinsplugins.com/template-file-loaders-plugins/
	 *
	 * @since 0.0.0
	 *
	 * @param string $slug
	 * @param string $name Optional. Default null
	 */
	public function get_component_template_part( $slug, $name = null, $load = true ) {

		// Execute code for this part
		do_action( 'get_template_part_' . $slug, $slug, $name );

		// Setup possible parts
		$templates = array();
		if ( isset( $name ) ) {
			$templates[] = $slug . '-' . $name . '.php';
		}
		$templates[] = $slug . '.php';

		// Allow template parts to be filtered
		$templates = apply_filters( 'get_component_template_part', $templates, $slug, $name );

		// Return the part that is found
		return $this->locate_component_template( $templates, $load, false );
	}

	/**
	 * Cycle through flexible content and display the corresponding markup.
	 *
	 * @param  int  $post_id  ID of the post.
	 * @author      Carrie Forde
	 */
	public function display_component( $post_id = 0 ) {

		// Get the post id.
		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		// Get our data.
		$component = get_post_meta( $post_id, 'component', true );

		// Determine which layout to grab.
		foreach ( (array) $component as $count => $component ) {
			include( $this->get_component_template_part( 'component', $component, false ) );
		}
	}

	/**
	 * Get the component markup for output in component meta.
	 *
	 * @param   int  $post_id  The Post ID. By passing a post ID, the hero can be used outside the loop.
	 * @return  string         The component markup.
	 * @author                 Carrie Forde
	 */
	public function get_component_markup( $post_id = 0 ) {

		ob_start();
		$this->display_component();
		return ob_get_clean();
	}

	/**
	 * Build the markup for the component meta.
	 *
	 * @param   interger  $post_id  ID of the post for which to display the meta.
	 * @author                      Carrie Forde
	 */
	public function display_component_meta( $post_id = 0 ) {

		// Get the post id.
		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		// Get our data.
		$usage          = get_post_meta( $post_id, 'usage', true );
		$implementation = get_post_meta( $post_id, 'implementation', true );
		$php            = get_post_meta( $post_id, 'php', true );
		$sass           = get_post_meta( $post_id, 'sass', true );
		$js             = get_post_meta( $post_id, 'javascript', true );

		// Start the markup. 🎉 ?>
		<div class="wds-component-meta">

			<?php if ( ! empty( $usage ) ) : ?>
				<div class="component-usage">
					<header class="meta-heading">
						<h2><?php esc_html_e( 'Usage', 'wds-component-library' ); ?></h2>
					</header>
					<div><?php echo wp_kses_post( wpautop( $usage ) ); ?></div>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $implementation ) ) : ?>
				<div class="code-implementation">
					<header class="meta-heading">
						<h2><?php esc_html_e( 'Implementation', 'wds-component-library' ); ?></h2>
					</header>
					<pre>
						<code class="language-php"><?php echo esc_html( $implementation ); ?></code>
					</pre>
				</div>
			<?php endif; ?>

			<div id="code-tabs" class="code-tabs">
				<header class="meta-heading">
					<h2><?php esc_html_e( 'Code', 'wds-component-library' ); ?></h2>
				</header>
				<ul>
					<li><a href="#html-output"><?php esc_html_e( 'HTML Output', 'wdscl-components' ); ?></a></li>
					<?php echo ( ! empty( $php ) ) ? '<li><a href="#php-code">' . esc_html__( 'PHP', 'wdscl-components' ) . '</a></li>' : ''; ?>
					<?php echo ( ! empty( $sass ) ) ? '<li><a href="#sass-code">' . esc_html__( 'Sass', 'wdscl-components' ) . '</a></li>' : ''; ?>
					<?php echo ( ! empty( $js ) ) ? '<li><a href="#js-code">' . esc_html__( 'JavaScript', 'wdscl-components' ) . '</a></li>' : ''; ?>
				</ul>

				<div id="html-output" class="html-output">
					<pre>
						<code class="language-html">
							<?php echo esc_html( $this->get_component_markup() ); ?>
						</code>
					</pre>
				</div><!-- .html-output -->
				<?php if ( ! empty( $php ) ) : ?>
					<div id="php-code" class="php-code">
						<pre>
							<code class="language-php"><?php echo esc_html( $php ); ?></code>
						</pre>
					</div><!-- .php-code -->
				<?php endif; ?>

				<?php if ( ! empty( $sass ) ) : ?>
					<div id="sass-code" class="sass-code">
						<pre>
							<code class="language-scss"><?php echo esc_html( $sass ); ?></code>
						</pre>
					</div><!-- .sass-code -->
				<?php endif; ?>

				<?php if ( ! empty( $js ) ) : ?>
					<div id="js-code" class="js-code">
						<pre>
							<code class="language-js"><?php echo esc_html( $js ); ?></code>
						</pre>
					</div><!-- .js-code -->
				<?php endif; ?>
			</div><!-- .code-tabs -->
		</div><!-- .wds-component-meta -->

		<?php
	}

	/**
	 * Use the plugin's single-wdscl-template.php if one can't be found in the theme.
	 *
	 * @param   $template  The template we need.
	 * @return             The template path.
	 * @author             Carrie Forde
	 */
	public function component_template( $template ) {

		// The default template.
		$component_template = 'single-wdscl-component.php';

		// Check if a template for the wdscl-component post type exists in the theme.
		if ( is_singular( 'wdscl-component' ) ) {

			// If a single-wdscl-component.php template exists in the theme, use that, otherwise, use the plugin version.
			if ( locate_template( $component_template ) ) {
				$template = locate_template( $component_template );
			} else {
				$template = $this->plugin->path . $component_template;
			}
		}

		return $template;
	}
}
