<?php
/**
 * WP Component Library Component.
 *
 * @since   0.0.0
 * @package WP_Component_Library
 */

require_once dirname( __FILE__ ) . '/../vendor/cpt-core/CPT_Core.php';

/**
 * WP Component Library Component post type class.
 *
 * @since 0.0.0
 *
 * @see   https://github.com/WebDevStudios/CPT_Core
 */
class WPCL_Component extends CPT_Core {
	/**
	 * Parent plugin class.
	 *
	 * @var WP_Component_Library
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
	 * @param  WP_Component_Library $plugin Main plugin object.
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
		$this->hooks();

		// Register this cpt.
		// First parameter should be an array with Singular, Plural, and Registered name.
		parent::__construct(
			array(
				__( 'Component', 'wp-component-library' ),
				__( 'Components', 'wp-component-library' ),
				'wpcl-component',
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
	 * Cycle through flexible content and display the corresponding markup.
	 *
	 * @param  int  $post_id  ID of the post.
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

			switch ( $component ) {

				// Image Hero.
				case 'image_hero' :

					wp_component_library()->image_hero->image_hero_markup( $post_id, $count );
					break;
			}
		}
	}

	/**
	 * Get the component markup for output in component meta.
	 *
	 * @param   int  $post_id  The Post ID. By passing a post ID, the hero can be used outside the loop.
	 *
	 * @return  string  The component markup.
	 */
	public function get_component_markup( $post_id = 0 ) {

		ob_start();
		$this->display_component();
		return ob_get_clean();
	}

	/**
	 * Build the markup for the component meta.
	 *
	 * @param  interger  $post_id  ID of the post for which to display the meta.
	 */
	public function display_component_meta( $post_id = 0 ) {

		// Get the post id.
		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		// Get our data.
		$usage = get_post_meta( $post_id, 'usage', true );
		$php   = get_post_meta( $post_id, 'php', true );
		$sass  = get_post_meta( $post_id, 'sass', true );
		$js    = get_post_meta( $post_id, 'javascript', true );

		// Start the markup. 🎉 ?>
		<div class="wp-component-meta">

			<?php if ( ! empty( $usage ) ) : ?>
				<div class="code-usage">
					<pre>
						<code class="language-php"><?php echo esc_html( $usage ); ?></code>
					</pre>
				</div>
			<?php endif; ?>

			<div class="code-tabs">
				<ul>
					<li><a href="#html-output"><?php esc_html_e( 'HTML Output', 'wpcl-components' ); ?></a></li>
					<?php echo ( ! empty( $php ) ) ? '<li><a href="#php-code">' . esc_html__( 'PHP', 'wpcl-components' ) . '</a></li>' : ''; ?>
					<?php echo ( ! empty( $sass ) ) ? '<li><a href="#sass-code">' . esc_html__( 'Sass', 'wpcl-components' ) . '</a></li>' : ''; ?>
					<?php echo ( ! empty( $js ) ) ? '<li><a href="#js-code">' . esc_html__( 'JavaScript', 'wpcl-components' ) . '</a></li>' : ''; ?>
				</ul>

				<div class="html-output">
					<pre>
						<code class="language-html">
							<?php echo esc_html( $this->get_component_markup() ); ?>
						</code>
					</pre>
				</div><!-- .html-output -->
				<?php if ( ! empty( $php ) ) : ?>
					<div class="php-code">
						<pre>
							<code class="language-php"><?php echo esc_html( $php ); ?></code>
						</pre>
					</div><!-- .php-code -->
				<?php endif; ?>

				<?php if ( ! empty( $sass ) ) : ?>
					<div class="sass-code">
						<pre>
							<code class="language-scss"><?php echo esc_html( $sass ); ?></code>
						</pre>
					</div><!-- .sass-code -->
				<?php endif; ?>

				<?php if ( ! empty( $js ) ) : ?>
					<div class="js-code">
						<pre>
							<code class="language-js"><?php echo esc_html( $js ); ?></code>
						</pre>
					</div><!-- .js-code -->
				<?php endif; ?>
			</div><!-- .code-tabs -->
		</div><!-- .wp-component-meta -->

		<?php
	}
}
