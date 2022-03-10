<?php

require_once 'ajax_search.php';
require_once 'header_search.php';
require_once 'ajax.php';

/**
 * Twenty Twenty functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

/**
 * Table of Contents:
 * Theme Support
 * Required Files
 * Register Styles
 * Register Scripts
 * Register Menus
 * Custom Logo
 * WP Body Open
 * Register Sidebars
 * Enqueue Block Editor Assets
 * Enqueue Classic Editor Styles
 * Block Editor Settings
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function twentytwenty_theme_support() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Custom background color.
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'f5efe0',
		)
	);

	// Set content-width.
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 580;
	}

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Set post thumbnail size.
	set_post_thumbnail_size( 1200, 9999 );

	// Add custom image size used in Cover Template.
	add_image_size( 'twentytwenty-fullscreen', 1980, 9999 );

	// Custom logo.
	$logo_width  = 120;
	$logo_height = 90;

	// If the retina setting is active, double the recommended width and height.
	if ( get_theme_mod( 'retina_logo', false ) ) {
		$logo_width  = floor( $logo_width * 2 );
		$logo_height = floor( $logo_height * 2 );
	}

	add_theme_support(
		'custom-logo',
		array(
			'height'      => $logo_height,
			'width'       => $logo_width,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Twenty Twenty, use a find and replace
	 * to change 'twentytwenty' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentytwenty' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	/*
	 * Adds starter content to highlight the theme on fresh sites.
	 * This is done conditionally to avoid loading the starter content on every
	 * page load, as it is a one-off operation only needed once in the customizer.
	 */
	if ( is_customize_preview() ) {
		require get_template_directory() . '/inc/starter-content.php';
		add_theme_support( 'starter-content', twentytwenty_get_starter_content() );
	}

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Adds `async` and `defer` support for scripts registered or enqueued
	 * by the theme.
	 */
	$loader = new TwentyTwenty_Script_Loader();
	add_filter( 'script_loader_tag', array( $loader, 'filter_script_loader_tag' ), 10, 2 );

}

add_action( 'after_setup_theme', 'twentytwenty_theme_support' );

/**
 * REQUIRED FILES
 * Include required files.
 */
require get_template_directory() . '/inc/template-tags.php';

// Handle SVG icons.
require get_template_directory() . '/classes/class-twentytwenty-svg-icons.php';
require get_template_directory() . '/inc/svg-icons.php';

// Handle Customizer settings.
require get_template_directory() . '/classes/class-twentytwenty-customize.php';

// Require Separator Control class.
require get_template_directory() . '/classes/class-twentytwenty-separator-control.php';

// Custom comment walker.
require get_template_directory() . '/classes/class-twentytwenty-walker-comment.php';

// Custom page walker.
require get_template_directory() . '/classes/class-twentytwenty-walker-page.php';

// Custom script loader class.
require get_template_directory() . '/classes/class-twentytwenty-script-loader.php';

// Non-latin language handling.
require get_template_directory() . '/classes/class-twentytwenty-non-latin-languages.php';

// Custom CSS.
require get_template_directory() . '/inc/custom-css.php';

/**
 * Register and Enqueue Styles.
 */
function twentytwenty_register_styles() {

	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'twentytwenty-style', get_stylesheet_uri(), array(), $theme_version );
	wp_style_add_data( 'twentytwenty-style', 'rtl', 'replace' );

	// Add output of Customizer settings as inline style.
	wp_add_inline_style( 'twentytwenty-style', twentytwenty_get_customizer_css( 'front-end' ) );

	// Add print CSS.
	wp_enqueue_style( 'twentytwenty-print-style', get_template_directory_uri() . '/print.css', null, $theme_version, 'print' );

}

add_action( 'wp_enqueue_scripts', 'twentytwenty_register_styles' );

/**
 * Register and Enqueue Scripts.
 */
function twentytwenty_register_scripts() {

	$theme_version = wp_get_theme()->get( 'Version' );

	if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'twentytwenty-js', get_template_directory_uri() . '/assets/js/index.js', array(), $theme_version, false );
	wp_script_add_data( 'twentytwenty-js', 'async', true );

}

add_action( 'wp_enqueue_scripts', 'twentytwenty_register_scripts' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function twentytwenty_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'twentytwenty_skip_link_focus_fix' );

/** Enqueue non-latin language styles
 *
 * @since Twenty Twenty 1.0
 *
 * @return void
 */
function twentytwenty_non_latin_languages() {
	$custom_css = TwentyTwenty_Non_Latin_Languages::get_non_latin_css( 'front-end' );

	if ( $custom_css ) {
		wp_add_inline_style( 'twentytwenty-style', $custom_css );
	}
}

add_action( 'wp_enqueue_scripts', 'twentytwenty_non_latin_languages' );

/**
 * Register navigation menus uses wp_nav_menu in five places.
 */
function twentytwenty_menus() {

	$locations = array(
		'primary'  => __( 'Desktop Horizontal Menu', 'twentytwenty' ),
		'expanded' => __( 'Desktop Expanded Menu', 'twentytwenty' ),
		'mobile'   => __( 'Mobile Menu', 'twentytwenty' ),
		'footer'   => __( 'Footer Menu', 'twentytwenty' ),
		'social'   => __( 'Social Menu', 'twentytwenty' ),
	);

	register_nav_menus( $locations );
}

add_action( 'init', 'twentytwenty_menus' );

/**
 * Get the information about the logo.
 *
 * @param string $html The HTML output from get_custom_logo (core function).
 * @return string
 */
function twentytwenty_get_custom_logo( $html ) {

	$logo_id = get_theme_mod( 'custom_logo' );

	if ( ! $logo_id ) {
		return $html;
	}

	$logo = wp_get_attachment_image_src( $logo_id, 'full' );

	if ( $logo ) {
		// For clarity.
		$logo_width  = esc_attr( $logo[1] );
		$logo_height = esc_attr( $logo[2] );

		// If the retina logo setting is active, reduce the width/height by half.
		if ( get_theme_mod( 'retina_logo', false ) ) {
			$logo_width  = floor( $logo_width / 2 );
			$logo_height = floor( $logo_height / 2 );

			$search = array(
				'/width=\"\d+\"/iU',
				'/height=\"\d+\"/iU',
			);

			$replace = array(
				"width=\"{$logo_width}\"",
				"height=\"{$logo_height}\"",
			);

			// Add a style attribute with the height, or append the height to the style attribute if the style attribute already exists.
			if ( strpos( $html, ' style=' ) === false ) {
				$search[]  = '/(src=)/';
				$replace[] = "style=\"height: {$logo_height}px;\" src=";
			} else {
				$search[]  = '/(style="[^"]*)/';
				$replace[] = "$1 height: {$logo_height}px;";
			}

			$html = preg_replace( $search, $replace, $html );

		}
	}

	return $html;

}

add_filter( 'get_custom_logo', 'twentytwenty_get_custom_logo' );

if ( ! function_exists( 'wp_body_open' ) ) {

	/**
	 * Shim for wp_body_open, ensuring backward compatibility with versions of WordPress older than 5.2.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

/**
 * Include a skip to content link at the top of the page so that users can bypass the menu.
 */
function twentytwenty_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#site-content">' . __( 'Skip to the content', 'twentytwenty' ) . '</a>';
}

add_action( 'wp_body_open', 'twentytwenty_skip_link', 5 );

/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentytwenty_sidebar_registration() {

	// Arguments used in all register_sidebar() calls.
	$shared_args = array(
		'before_title'  => '<h2 class="widget-title subheading heading-size-3">',
		'after_title'   => '</h2>',
		'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
	);

	// Footer #1.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #1', 'twentytwenty' ),
				'id'          => 'sidebar-1',
				'description' => __( 'Widgets in this area will be displayed in the first column in the footer.', 'twentytwenty' ),
			)
		)
	);

	// Footer #2.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #2', 'twentytwenty' ),
				'id'          => 'sidebar-2',
				'description' => __( 'Widgets in this area will be displayed in the second column in the footer.', 'twentytwenty' ),
			)
		)
	);
// Header Phone.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Header Phone', 'twentytwenty' ),
				'id'          => 'sidebar-3',
				'description' => __( 'Widgets in this area will be displayed in the Header.', 'twentytwenty' ),
			)
		)
	);
	
	// Book An Appointment.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Book An Appointment', 'twentytwenty' ),
				'id'          => 'sidebar-4',
				'description' => __( 'Widgets in this area will be displayed in the Header.', 'twentytwenty' ),
			)
		)
	);
	
		// Book An Appointment.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Copyright', 'twentytwenty' ),
				'id'          => 'sidebar-5',
				'description' => __( 'Widgets in this area will be displayed in the Footer.', 'twentytwenty' ),
			)
		)
	);
	
}

add_action( 'widgets_init', 'twentytwenty_sidebar_registration' );

/**
 * Enqueue supplemental block editor styles.
 */
function twentytwenty_block_editor_styles() {

	// Enqueue the editor styles.
	wp_enqueue_style( 'twentytwenty-block-editor-styles', get_theme_file_uri( '/assets/css/editor-style-block.css' ), array(), wp_get_theme()->get( 'Version' ), 'all' );
	wp_style_add_data( 'twentytwenty-block-editor-styles', 'rtl', 'replace' );

	// Add inline style from the Customizer.
	wp_add_inline_style( 'twentytwenty-block-editor-styles', twentytwenty_get_customizer_css( 'block-editor' ) );

	// Add inline style for non-latin fonts.
	wp_add_inline_style( 'twentytwenty-block-editor-styles', TwentyTwenty_Non_Latin_Languages::get_non_latin_css( 'block-editor' ) );

	// Enqueue the editor script.
	wp_enqueue_script( 'twentytwenty-block-editor-script', get_theme_file_uri( '/assets/js/editor-script-block.js' ), array( 'wp-blocks', 'wp-dom' ), wp_get_theme()->get( 'Version' ), true );
}

add_action( 'enqueue_block_editor_assets', 'twentytwenty_block_editor_styles', 1, 1 );

/**
 * Enqueue classic editor styles.
 */
function twentytwenty_classic_editor_styles() {

	$classic_editor_styles = array(
		'/assets/css/editor-style-classic.css',
	);

	add_editor_style( $classic_editor_styles );

}

add_action( 'init', 'twentytwenty_classic_editor_styles' );

/**
 * Output Customizer settings in the classic editor.
 * Adds styles to the head of the TinyMCE iframe. Kudos to @Otto42 for the original solution.
 *
 * @param array $mce_init TinyMCE styles.
 * @return array TinyMCE styles.
 */
function twentytwenty_add_classic_editor_customizer_styles( $mce_init ) {

	$styles = twentytwenty_get_customizer_css( 'classic-editor' );

	if ( ! isset( $mce_init['content_style'] ) ) {
		$mce_init['content_style'] = $styles . ' ';
	} else {
		$mce_init['content_style'] .= ' ' . $styles . ' ';
	}

	return $mce_init;

}

add_filter( 'tiny_mce_before_init', 'twentytwenty_add_classic_editor_customizer_styles' );

/**
 * Output non-latin font styles in the classic editor.
 * Adds styles to the head of the TinyMCE iframe. Kudos to @Otto42 for the original solution.
 *
 * @param array $mce_init TinyMCE styles.
 * @return array TinyMCE styles.
 */
function twentytwenty_add_classic_editor_non_latin_styles( $mce_init ) {

	$styles = TwentyTwenty_Non_Latin_Languages::get_non_latin_css( 'classic-editor' );

	// Return if there are no styles to add.
	if ( ! $styles ) {
		return $mce_init;
	}

	if ( ! isset( $mce_init['content_style'] ) ) {
		$mce_init['content_style'] = $styles . ' ';
	} else {
		$mce_init['content_style'] .= ' ' . $styles . ' ';
	}

	return $mce_init;

}

add_filter( 'tiny_mce_before_init', 'twentytwenty_add_classic_editor_non_latin_styles' );

/**
 * Block Editor Settings.
 * Add custom colors and font sizes to the block editor.
 */
function twentytwenty_block_editor_settings() {

	// Block Editor Palette.
	$editor_color_palette = array(
		array(
			'name'  => __( 'Accent Color', 'twentytwenty' ),
			'slug'  => 'accent',
			'color' => twentytwenty_get_color_for_area( 'content', 'accent' ),
		),
		array(
			'name'  => __( 'Primary', 'twentytwenty' ),
			'slug'  => 'primary',
			'color' => twentytwenty_get_color_for_area( 'content', 'text' ),
		),
		array(
			'name'  => __( 'Secondary', 'twentytwenty' ),
			'slug'  => 'secondary',
			'color' => twentytwenty_get_color_for_area( 'content', 'secondary' ),
		),
		array(
			'name'  => __( 'Subtle Background', 'twentytwenty' ),
			'slug'  => 'subtle-background',
			'color' => twentytwenty_get_color_for_area( 'content', 'borders' ),
		),
	);

	// Add the background option.
	$background_color = get_theme_mod( 'background_color' );
	if ( ! $background_color ) {
		$background_color_arr = get_theme_support( 'custom-background' );
		$background_color     = $background_color_arr[0]['default-color'];
	}
	$editor_color_palette[] = array(
		'name'  => __( 'Background Color', 'twentytwenty' ),
		'slug'  => 'background',
		'color' => '#' . $background_color,
	);

	// If we have accent colors, add them to the block editor palette.
	if ( $editor_color_palette ) {
		add_theme_support( 'editor-color-palette', $editor_color_palette );
	}

	// Block Editor Font Sizes.
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name'      => _x( 'Small', 'Name of the small font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'S', 'Short name of the small font size in the block editor.', 'twentytwenty' ),
				'size'      => 18,
				'slug'      => 'small',
			),
			array(
				'name'      => _x( 'Regular', 'Name of the regular font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'M', 'Short name of the regular font size in the block editor.', 'twentytwenty' ),
				'size'      => 21,
				'slug'      => 'normal',
			),
			array(
				'name'      => _x( 'Large', 'Name of the large font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'L', 'Short name of the large font size in the block editor.', 'twentytwenty' ),
				'size'      => 26.25,
				'slug'      => 'large',
			),
			array(
				'name'      => _x( 'Larger', 'Name of the larger font size in the block editor', 'twentytwenty' ),
				'shortName' => _x( 'XL', 'Short name of the larger font size in the block editor.', 'twentytwenty' ),
				'size'      => 32,
				'slug'      => 'larger',
			),
		)
	);

	add_theme_support( 'editor-styles' );

	// If we have a dark background color then add support for dark editor style.
	// We can determine if the background color is dark by checking if the text-color is white.
	if ( '#ffffff' === strtolower( twentytwenty_get_color_for_area( 'content', 'text' ) ) ) {
		add_theme_support( 'dark-editor-style' );
	}

}

add_action( 'after_setup_theme', 'twentytwenty_block_editor_settings' );

/**
 * Overwrite default more tag with styling and screen reader markup.
 *
 * @param string $html The default output HTML for the more tag.
 * @return string
 */
function twentytwenty_read_more_tag( $html ) {
	return preg_replace( '/<a(.*)>(.*)<\/a>/iU', sprintf( '<div class="read-more-button-wrap"><a$1><span class="faux-button">$2</span> <span class="screen-reader-text">"%1$s"</span></a></div>', get_the_title( get_the_ID() ) ), $html );
}

add_filter( 'the_content_more_link', 'twentytwenty_read_more_tag' );

/**
 * Enqueues scripts for customizer controls & settings.
 *
 * @since Twenty Twenty 1.0
 *
 * @return void
 */
function twentytwenty_customize_controls_enqueue_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );

	// Add main customizer js file.
	wp_enqueue_script( 'twentytwenty-customize', get_template_directory_uri() . '/assets/js/customize.js', array( 'jquery' ), $theme_version, false );

	// Add script for color calculations.
	wp_enqueue_script( 'twentytwenty-color-calculations', get_template_directory_uri() . '/assets/js/color-calculations.js', array( 'wp-color-picker' ), $theme_version, false );

	// Add script for controls.
	wp_enqueue_script( 'twentytwenty-customize-controls', get_template_directory_uri() . '/assets/js/customize-controls.js', array( 'twentytwenty-color-calculations', 'customize-controls', 'underscore', 'jquery' ), $theme_version, false );
	wp_localize_script( 'twentytwenty-customize-controls', 'twentyTwentyBgColors', twentytwenty_get_customizer_color_vars() );
}

add_action( 'customize_controls_enqueue_scripts', 'twentytwenty_customize_controls_enqueue_scripts' );

/**
 * Enqueue scripts for the customizer preview.
 *
 * @since Twenty Twenty 1.0
 *
 * @return void
 */
function twentytwenty_customize_preview_init() {
	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_script( 'twentytwenty-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview', 'customize-selective-refresh', 'jquery' ), $theme_version, true );
	wp_localize_script( 'twentytwenty-customize-preview', 'twentyTwentyBgColors', twentytwenty_get_customizer_color_vars() );
	wp_localize_script( 'twentytwenty-customize-preview', 'twentyTwentyPreviewEls', twentytwenty_get_elements_array() );

	wp_add_inline_script(
		'twentytwenty-customize-preview',
		sprintf(
			'wp.customize.selectiveRefresh.partialConstructor[ %1$s ].prototype.attrs = %2$s;',
			wp_json_encode( 'cover_opacity' ),
			wp_json_encode( twentytwenty_customize_opacity_range() )
		)
	);
}

add_action( 'customize_preview_init', 'twentytwenty_customize_preview_init' );

/**
 * Get accessible color for an area.
 *
 * @since Twenty Twenty 1.0
 *
 * @param string $area The area we want to get the colors for.
 * @param string $context Can be 'text' or 'accent'.
 * @return string Returns a HEX color.
 */
function twentytwenty_get_color_for_area( $area = 'content', $context = 'text' ) {

	// Get the value from the theme-mod.
	$settings = get_theme_mod(
		'accent_accessible_colors',
		array(
			'content'       => array(
				'text'      => '#000000',
				'accent'    => '#cd2653',
				'secondary' => '#6d6d6d',
				'borders'   => '#dcd7ca',
			),
			'header-footer' => array(
				'text'      => '#000000',
				'accent'    => '#cd2653',
				'secondary' => '#6d6d6d',
				'borders'   => '#dcd7ca',
			),
		)
	);

	// If we have a value return it.
	if ( isset( $settings[ $area ] ) && isset( $settings[ $area ][ $context ] ) ) {
		return $settings[ $area ][ $context ];
	}

	// Return false if the option doesn't exist.
	return false;
}

/**
 * Returns an array of variables for the customizer preview.
 *
 * @since Twenty Twenty 1.0
 *
 * @return array
 */
function twentytwenty_get_customizer_color_vars() {
	$colors = array(
		'content'       => array(
			'setting' => 'background_color',
		),
		'header-footer' => array(
			'setting' => 'header_footer_background_color',
		),
	);
	return $colors;
}

/**
 * Get an array of elements.
 *
 * @since Twenty Twenty 1.0
 *
 * @return array
 */
function twentytwenty_get_elements_array() {

	// The array is formatted like this:
	// [key-in-saved-setting][sub-key-in-setting][css-property] = [elements].
	$elements = array(
		'content'       => array(
			'accent'     => array(
				'color'            => array( '.color-accent', '.color-accent-hover:hover', '.color-accent-hover:focus', ':root .has-accent-color', '.has-drop-cap:not(:focus):first-letter', '.wp-block-button.is-style-outline', 'a' ),
				'border-color'     => array( 'blockquote', '.border-color-accent', '.border-color-accent-hover:hover', '.border-color-accent-hover:focus' ),
				'background-color' => array( 'button', '.button', '.faux-button', '.wp-block-button__link', '.wp-block-file .wp-block-file__button', 'input[type="button"]', 'input[type="reset"]',  '.bg-accent', '.bg-accent-hover:hover', '.bg-accent-hover:focus', ':root .has-accent-background-color', '.comment-reply-link' ),
				'fill'             => array( '.fill-children-accent', '.fill-children-accent *' ),
			),
			'background' => array(
				'color'            => array( ':root .has-background-color', 'button', '.button', '.faux-button', '.wp-block-button__link', '.wp-block-file__button', 'input[type="button"]', 'input[type="reset"]','.wp-block-button', '.comment-reply-link', '.has-background.has-primary-background-color:not(.has-text-color)', '.has-background.has-primary-background-color *:not(.has-text-color)', '.has-background.has-accent-background-color:not(.has-text-color)', '.has-background.has-accent-background-color *:not(.has-text-color)' ),
				'background-color' => array( ':root .has-background-background-color' ),
			),
			'text'       => array(
				'color'            => array( 'body', '.entry-title a', ':root .has-primary-color' ),
				'background-color' => array( ':root .has-primary-background-color' ),
			),
			'secondary'  => array(
				'color'            => array( 'cite', 'figcaption', '.wp-caption-text', '.post-meta', '.entry-content .wp-block-archives li', '.entry-content .wp-block-categories li', '.entry-content .wp-block-latest-posts li', '.wp-block-latest-comments__comment-date', '.wp-block-latest-posts__post-date', '.wp-block-embed figcaption', '.wp-block-image figcaption', '.wp-block-pullquote cite', '.comment-metadata', '.comment-respond .comment-notes', '.comment-respond .logged-in-as', '.pagination .dots', '.entry-content hr:not(.has-background)', 'hr.styled-separator', ':root .has-secondary-color' ),
				'background-color' => array( ':root .has-secondary-background-color' ),
			),
			'borders'    => array(
				'border-color'        => array( 'pre', 'fieldset', 'input', 'textarea', 'table', 'table *', 'hr' ),
				'background-color'    => array( 'caption', 'code', 'code', 'kbd', 'samp', '.wp-block-table.is-style-stripes tbody tr:nth-child(odd)', ':root .has-subtle-background-background-color' ),
				'border-bottom-color' => array( '.wp-block-table.is-style-stripes' ),
				'border-top-color'    => array( '.wp-block-latest-posts.is-grid li' ),
				'color'               => array( ':root .has-subtle-background-color' ),
			),
		),
		'header-footer' => array(
			'accent'     => array(
				'color'            => array( 'body:not(.overlay-header) .primary-menu > li > a', 'body:not(.overlay-header) .primary-menu > li > .icon', '.modal-menu a', '.footer-menu a, .footer-widgets a', '#site-footer .wp-block-button.is-style-outline', '.wp-block-pullquote:before', '.singular:not(.overlay-header) .entry-header a', '.archive-header a', '.header-footer-group .color-accent', '.header-footer-group .color-accent-hover:hover' ),
				'background-color' => array( '.social-icons a', '#site-footer button:not(.toggle)', '#site-footer .button', '#site-footer .faux-button', '#site-footer .wp-block-button__link', '#site-footer .wp-block-file__button', '#site-footer input[type="button"]', '#site-footer input[type="reset"]', '#site-footer input[type="submit"]' ),
			),
			'background' => array(
				'color'            => array( '.social-icons a', 'body:not(.overlay-header) .primary-menu ul', '.header-footer-group button', '.header-footer-group .button', '.header-footer-group .faux-button', '.header-footer-group .wp-block-button:not(.is-style-outline) .wp-block-button__link', '.header-footer-group .wp-block-file__button', '.header-footer-group input[type="button"]', '.header-footer-group input[type="reset"]', '.header-footer-group input[type="submit"]' ),
				'background-color' => array( '#site-header', '.footer-nav-widgets-wrapper', '#site-footer', '.menu-modal', '.menu-modal-inner', '.search-modal-inner', '.archive-header', '.singular .entry-header', '.singular .featured-media:before', '.wp-block-pullquote:before' ),
			),
			'text'       => array(
				'color'               => array( '.header-footer-group', 'body:not(.overlay-header) #site-header .toggle', '.menu-modal .toggle' ),
				'background-color'    => array( 'body:not(.overlay-header) .primary-menu ul' ),
				'border-bottom-color' => array( 'body:not(.overlay-header) .primary-menu > li > ul:after' ),
				'border-left-color'   => array( 'body:not(.overlay-header) .primary-menu ul ul:after' ),
			),
			'secondary'  => array(
				'color' => array( '.site-description', 'body:not(.overlay-header) .toggle-inner .toggle-text', '.widget .post-date', '.widget .rss-date', '.widget_archive li', '.widget_categories li', '.widget cite', '.widget_pages li', '.widget_meta li', '.widget_nav_menu li', '.powered-by-wordpress', '.to-the-top', '.singular .entry-header .post-meta', '.singular:not(.overlay-header) .entry-header .post-meta a' ),
			),
			'borders'    => array(
				'border-color'     => array( '.header-footer-group pre', '.header-footer-group fieldset', '.header-footer-group input', '.header-footer-group textarea', '.header-footer-group table', '.header-footer-group table *', '.footer-nav-widgets-wrapper', '#site-footer', '.menu-modal nav *', '.footer-widgets-outer-wrapper', '.footer-top' ),
				'background-color' => array( '.header-footer-group table caption', 'body:not(.overlay-header) .header-inner .toggle-wrapper::before' ),
			),
		),
	);

	/**
	* Filters Twenty Twenty theme elements
	*
	* @since Twenty Twenty 1.0
	*
	* @param array Array of elements
	*/
	return apply_filters( 'twentytwenty_get_elements_array', $elements );
}

/******* Call All JS & CSS files - Code Start ******/

function wpdocs_theme_name_scripts() {
    wp_enqueue_style( 'bootstrap', get_template_directory_uri(). "/assets/css/bootstrap.min.css" );
        wp_enqueue_style( 'fontawsome', get_template_directory_uri(). "/assets/css/fontawsome.css" );

    wp_enqueue_style( 'slick', get_template_directory_uri()  . "/assets/css/all.min.css" );
    if(ICL_LANGUAGE_CODE == 'ar'){
    wp_enqueue_style( 'Arabic style', get_template_directory_uri()  . "/assets/css/arstyle.css" );

    } else {
    wp_enqueue_style( 'style', get_template_directory_uri()  . "/assets/css/style.css" );
}
        wp_enqueue_style( 'responsive', get_template_directory_uri(). "/assets/css/responsive.css" );


    wp_enqueue_script( 'jquery.min', get_theme_file_uri( '/assets/js/jquery.min.js' ), array(),'1.0.0', true);
	wp_enqueue_script( 'bootstrap', get_theme_file_uri( '/assets/js/bootstrap.min.js' ), array(),'1.0.0', true);
	wp_enqueue_script( 'slick', get_theme_file_uri( '/assets/js/slick.js' ), array(),'1.0.0', true);
		wp_enqueue_script( 'slick-animation', get_theme_file_uri( '/assets/js/slick-animation.js' ), array(),'1.0.0', true);
if(ICL_LANGUAGE_CODE == 'ar'){
	 	wp_enqueue_script( 'custom', get_theme_file_uri( '/assets/js/arcustom.js' ), array(),'1.0.0', true);
  } else {
	wp_enqueue_script( 'custom', get_theme_file_uri( '/assets/js/custom.js' ), array(),'1.0.0', true);
}
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );

/******* Call All JS & CSS files - Code End ******/

/******* Main Navigartion Walker - Code Start ******/


if ( ! class_exists( 'WP_Bootstrap_Mega_Navwalker' ) ) {
	/**
	 * WP_Bootstrap_Mega_Navwalker class.
	 *
	 * @extends Walker_Nav_Menu
	 */
	class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {

    /**
     * Unique id for dropdowns
     */
    public $submenu_unique_id = '';

    /**
     * Starts the list before the elements are added.
     * @see Walker::start_lvl()
     */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat( $t, $depth );

        $before_start_lvl = '<div class="dropdown-menu">';






        if($depth==0){
            $output .= "{$n}{$indent}{$before_start_lvl}<ul id=\"$this->submenu_unique_id\" class=\"container megamenu-background sub-menu dropdown-content\">{$n}";
        }
        else{
            $output .= "{$n}{$indent}<ul id=\"$this->submenu_unique_id\" class=\"sub-menu dropdown-content\">{$n}";
        }

    }

    /**
     * Ends the list of after the elements are added.
     * @see Walker::end_lvl()
     */
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat( $t, $depth );
        $after_end_lvl = '</div>';

        if($depth==0){
            $output .= "$indent</ul>{$after_end_lvl}{$n}";
        }
        else{
            $output .= "$indent</ul>{$n}";
        }

    }

    /**
     * @see Walker::start_el()
     */
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'dropdown';

        // set active class for current nav menu item
        if( $item->current == 1 ) {
            $classes[] = 'active';
        }

        // set active class for current nav menu item parent
        if( in_array( 'current-menu-parent' ,  $classes ) ) {
            $classes[] = 'active';
        }

        /**
         * Filters the arguments for a single nav menu item.
         */
        $args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

        // add a divider in dropdown menus
        if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
            $output .= $indent . '<li class="divider">';
        } else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
            $output .= $indent . '<li class="divider">';
        } else {
            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );

            //adding col-md-3 class to column
            if( in_array('menu-item-has-children', $classes ) ) {
				
                if( $depth === 1 ) {                 
			 
					
    $class_names = $class_names ? ' class="col-md-6 col-6 '.esc_attr( $class_names ) . ' '. $depth . '"' : '';
                } else {
                    $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
                }
            }else{
                $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
            }

            $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
            $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

            $output .= $indent . '<li' . $id . $class_names .'>';

            $atts = array();
            $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
            $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
            $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';



            if( in_array('menu-item-has-children', $classes ) ) {
                $atts['href']   = ! empty( $item->url ) ? $item->url  : '';
                $this->submenu_unique_id = 'dropdown-'.$item->ID;
            } else {
                $atts['href']   = ! empty( $item->url ) ? $item->url  : '';
                $atts['class'] = '';
            }

            $atts['class'] .= 'menu-item-link-class ';

            $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

            $attributes = '';
            foreach ( $atts as $attr => $value ) {
                if ( ! empty( $value ) ) {
                    $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            if( ! in_array( 'icon-only' , $classes ) ) {

                $title = apply_filters( 'the_title', $item->title, $item->ID );

                $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );
            }

            $item_output = $args->before;

               
            if( in_array('menu-item-has-children', $classes ) ) {
            	if( $depth === 1 ) { 
            	$item_output .= '<h4'. $attributes .'>';
            } else {
$item_output .= '<a'. $attributes .'>';
            }
            	 } else {
            	 	$item_output .= '<a'. $attributes .'>';
            	 }
            

            // set icon on left side
            if( !empty( $classes ) ) {
                foreach ($classes as $class_name) {
                    if( strpos( $class_name , 'fa' ) !== FALSE ) {
                        $icon_name = explode( '-' , $class_name );
                        if( isset( $icon_name[1] ) && !empty( $icon_name[1] ) ) {
                            $item_output .= '<i class="fa fa-'.$icon_name[1].'" aria-hidden="true"></i> ';
                        }
                    }
                }
            }

            $item_output .= $args->link_before . $title . $args->link_after;

            /* if( in_array('menu-item-has-children', $classes) ){
                if( $depth == 0 ) {
                    $item_output .= ' <i class="fas fa-chevron-down" aria-hidden="true"></i>';
                }
            } */
if( in_array('menu-item-has-children', $classes ) ) {
	if( $depth === 1 ) {
		$item_output .= '</h4>';
		} else {
			$item_output .= '</a>';
		}
	} else {
            $item_output .= '</a>';
        }
			
            if( in_array('menu-item-has-children', $classes) ){
                if( $depth == 0 ) {
                    $item_output .= ' <i class="fas fa-chevron-down" aria-hidden="true"></i>';
                }
            }
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }
    }

    /**
     * Ends the element output, if needed.
     *
     */
    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $output .= "</li>{$n}";
    }

} //
}

/******* Main Navigartion Walker - Code End ******/



/** Breadcrumb **/
function danat_breadcrumb() {
    global $post;


     echo '<div class="bannerBreadcrumbs"><ul>';
	                	$arrow_img = get_template_directory_uri().'/assets/images//arrow-icon.png';
	              
	                if(!is_home()){
	                echo '<li><a href="'.site_url().'"><i class="fas fa-home"></i></a></li>';
	                
	                //echo '<span>&nbsp; :: &nbsp;</span>';
	                if (is_single()) {
					
                    $post_type = get_post_type( $post->ID );
					$category = get_the_category(); 
						
					$category_parent_id = $category[0]->category_parent;
					 
					if ( $category_parent_id == 31 ) {
						$category_parent = get_term( $category_parent_id, 'category' );
						$css_slug = $category_parent->name;
							?><li> <?php echo $css_slug;?></li> <?php
					}  
					
                            if($post_type == 'leader'){?>
							<?php if(ICL_LANGUAGE_CODE=='ar'){echo ' <li>فريق القيادة   </li>';}else{echo '<li>Leadership Team</li>';}?>	 	<?php
							}
					  if($post_type == 'doctors'){?>
							<?php if(ICL_LANGUAGE_CODE=='ar'){echo ' <li>أطبائنا</li>';}else{echo '<li>Our Doctors</li>';}?>	 	<?php
							}	 
	                 if (is_single()) {
			              
						 $category_detail= get_the_category($post->ID);//$post->ID
                 foreach($category_detail as $cd){
					  
					 if ($cd->cat_name != ''){
						  echo '<li class="parent"><a href="'.site_url().'/category/'.$cd->slug.'">'.$cd->cat_name.'</a></li>';   
					 }
             
                   }
					 $post_id = get_the_ID(); 
						
						 $categories = get_the_terms($post_id, 'services');
						  
						 if( $categories && $post_type != 'doctors'){
						  $parent = "";
                             $parent_slug = "";
							 //display all the top-level categories first
							 foreach ($categories as $category) {
								 if( !$category->parent ){
									 $parent .= $category->name;
									  $parent_slug .= $category->slug;
								 }
							 }if(empty($parent)){
									 
								 }
							 else{
							 
				echo ' <li class="parent"><a href="'.site_url().'/services/'.$parent_slug.'">' .$parent. '</a></li> ';
							 }
							
							 //now, display all the child categories
						
							 $child= "";
                             $child_slug= "";
							 foreach ($categories as $category) {
								 if( $category->parent ){
									 $child .=  $category->name;
									 $child_slug .=  $category->slug;
								
								 }
							 }
							 if(empty($child)){
									 
								 }
							 else{
								 echo '<li class="child"><a href="'.site_url().'/services/'.$child_slug.'">'.$child.'</a></li>'; 
							 }
						 }	 
						 foreach ( get_the_terms($post_id, 'patientvisitor') as $tax ) {
                          echo '<li>' . __( $tax->name ) . '</li>';
                         }
						 
								}

				 } 
						elseif(is_category()){
                
				 }
				 elseif (is_page()) {
					 	
						if($post->post_parent){
                        
						$anc = get_post_ancestors( $post->ID );
						
						$title = get_the_title();
						foreach ( $anc as $ancestor ) {
						$output = '<a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a> ';
						} ?>
						<li><?php echo $output; ?> </li>
<!-- 						<li><?php //echo $title; ?></li> -->
						<?php
						} else { ?>
						<li><?php echo get_the_title(); ?></li>
						<?php }
					}
					elseif (is_tag()) { single_tag_title(); }
					elseif (is_day()) { echo "Posts for "; the_time('F jS, Y');}
					elseif (is_month()) { echo"Posts for "; the_time('F, Y'); }
                    elseif (is_year()) { echo"Posts for "; the_time('Y'); }
                    elseif (is_author()) { echo"<span>Author Posts "; echo'</span>';}
                    elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<span>Blog Archives"; echo'</span>';}
                 
			    }
			    if(is_search()){
					  
					
                    if(ICL_LANGUAGE_CODE=='ar'){echo '<li>نتائج البحث</li> <li>'.get_search_query().'</li>';}else{echo '<li>Search Results</li> <li>'.get_search_query().'</li>';} 
	                }elseif(is_archive()){ 
					  $current_term = get_queried_object();  
				      	if($current_term->taxonomy == 'category'){?>
							  <?php if(ICL_LANGUAGE_CODE=='ar'){echo ' <li class="ss">المركز الاعلامي </li>';}else{echo ' <li>Media Center</li> ';}?>	 

						<?php }
					else{ 
				
						?><li><?php echo $current_term->taxonomy ?></li>
					<?php }
					 if(is_day() || is_month() || is_year()){ ?>
	                	<li><?php the_time('F, Y'); ?></li>
	                   <?php   }else{
					?> 
	                	<?php  }
	                
	                 }
	            echo '</ul></div>';

}

/*** Option Page ***/

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}


 
add_action( 'init', 'wpb_register_cpt_testimonial' );

function wpb_register_cpt_testimonial() {

$labels = array(
'name' => _x( 'Testimonial', 'testimonial' ),
'singular_name' => _x( 'testimonial', 'testimonial' ),
'add_new' => _x( 'Add New', 'testimonial' ),
'add_new_items' => _x( 'Add New testimonial', 'testimonial' ),
'edit_items' => _x( 'Edit testimonial', 'testimonial' ),
'new_items' => _x( 'New testimonial', 'testimonial' ),
'view_items' => _x( 'View testimonial', 'testimonial' ),
'search_items' => _x( 'Search testimonial', 'testimonial' ),
'not_found' => _x( 'No testimonial found', 'testimonial' ),
'not_found_in_trash' => _x( 'No testimonial found in Trash', 'testimonial' ),
'parent_items_colon' => _x( 'Parent testimonial:', 'testimonial' ),
'menu_name' => _x( 'Testimonial', 'testimonial' ),
);

$args = array(
'labels' => $labels,
'hierarchical' => false,
'supports' => array( 'title', 'thumbnail', 'editor' , 'editor', 'page-attributes' ),
'public' => true,
'show_ui' => true,
'show_in_menu' => true,
'show_in_nav_menus' => true,
'publicly_queryable' => true,
'exclude_from_search' => false,
'has_archive' => true,
'query_var' => true,
'can_export' => true,
'menu_icon' => 'dashicons-screenoptions',
'rewrite' => true,
'capability_type' => 'post'
    );
register_post_type( 'testimonial', $args );
flush_rewrite_rules();
}
 

add_action( 'init', 'wpb_register_cpt_doctors' ); 

function wpb_register_cpt_doctors() {

$labels = array(
'name' => _x( 'Doctors', 'doctors' ),
'singular_name' => _x( 'doctors', 'doctors' ),
'add_new' => _x( 'Add New', 'doctors' ),
'add_new_items' => _x( 'Add New doctors', 'doctors' ),
'edit_items' => _x( 'Edit doctors', 'doctors' ),
'new_items' => _x( 'New doctors', 'doctors' ),
'view_items' => _x( 'View doctors', 'doctors' ),
'search_items' => _x( 'Search doctors', 'doctors' ),
'not_found' => _x( 'No doctors found', 'doctors' ),
'not_found_in_trash' => _x( 'No doctors found in Trash', 'doctors' ),
'parent_items_colon' => _x( 'Parent doctors:', 'doctors' ),
'menu_name' => _x( 'Doctors', 'doctors' ),
);

$args = array(
'labels' => $labels,
'hierarchical' => false,
'supports' => array( 'title', 'thumbnail', 'editor' , 'editor', 'page-attributes' ),
'public' => true,
'show_ui' => true,
'show_in_menu' => true,
'show_in_nav_menus' => true,
'publicly_queryable' => true,
'exclude_from_search' => false,
'has_archive' => true,
'query_var' => true,
'can_export' => true,
'menu_icon' => 'dashicons-screenoptions',
'rewrite' => true,
'capability_type' => 'post'
    );
register_post_type( 'doctors', $args );
flush_rewrite_rules();
}


// Leadership Team

add_action( 'init', 'wpb_register_cpt_leader' ); 

function wpb_register_cpt_leader() {

$labels = array(
'name' => _x( 'Leaders Team', 'leader' ),
'singular_name' => _x( 'leader', 'leader' ),
'add_new' => _x( 'Add New', 'leader' ),
'add_new_items' => _x( 'Add New leader', 'leader' ),
'edit_items' => _x( 'Edit leader', 'leader' ),
'new_items' => _x( 'New leader', 'leader' ),
'view_items' => _x( 'View leader', 'leader' ),
'search_items' => _x( 'Search leaders', 'leader' ),
'not_found' => _x( 'No doctors found', 'leader' ),
'not_found_in_trash' => _x( 'No doctors found in Trash', 'leader' ),
'parent_items_colon' => _x( 'Parent leader:', 'leader' ),
'menu_name' => _x( 'Leaders Team', 'leader' ),
);

$args = array(
'labels' => $labels,
'hierarchical' => false,
'supports' => array( 'title', 'thumbnail', 'editor' , 'editor', 'page-attributes' ),
'public' => true,
'show_ui' => true,
'show_in_menu' => true,
'show_in_nav_menus' => true,
'publicly_queryable' => true,
'exclude_from_search' => false,
'has_archive' => true,
'query_var' => true,
'can_export' => true,
'menu_icon' => 'dashicons-screenoptions',
'rewrite' => true,
'capability_type' => 'post'
    );
register_post_type( 'leader', $args );
flush_rewrite_rules();
}


// End Leadrship Team
add_action( 'init', 'wpb_register_cpt_service' );

function wpb_register_cpt_service() {

$labels = array(
'name' => _x( 'Service', 'service' ),
'singular_name' => _x( 'service', 'service' ),
'add_new' => _x( 'Add New', 'service' ),
'add_new_items' => _x( 'Add New service', 'service' ),
'edit_items' => _x( 'Edit service', 'service' ),
'new_items' => _x( 'New service', 'service' ),
'view_items' => _x( 'View service', 'service' ),
'search_items' => _x( 'Search service', 'service' ),
'not_found' => _x( 'No service found', 'service' ),
'not_found_in_trash' => _x( 'No service found in Trash', 'service' ),
'parent_items_colon' => _x( 'Parent service:', 'service' ),
'menu_name' => _x( 'Service', 'service' ),
);

$args = array(
'labels' => $labels,
'hierarchical' => false,
'supports' => array( 'title', 'thumbnail', 'editor' , 'editor', 'page-attributes' ),
'public' => true,
'show_ui' => true,
'show_in_menu' => true,
'show_in_nav_menus' => true,
'publicly_queryable' => true,
'exclude_from_search' => false,
'has_archive' => true,
'query_var' => true,
'can_export' => true,
'menu_icon' => 'dashicons-screenoptions',
'rewrite' => true,
'capability_type' => 'post'
    );
register_post_type( 'service', $args );
flush_rewrite_rules();
}

function services() {
	register_taxonomy(
		'services',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'service',   		 //post type name
		array(
			'hierarchical' 		=> true,
			'label' 		=> 'Services Category',  //Display name
			'query_var' 		=> true,
			'rewrite'		=> array(
			'slug' 			=> 'services', // This controls the base slug that will display before each term
			'hierarchical' => true,
			'with_front' 	=> false // Don't display the category base before
					)
			)
		);
}
add_action( 'init', 'services');



add_action( 'init', 'wpb_register_cpt_patientvisitor' );

function wpb_register_cpt_patientvisitor() {

$labels = array(
'name' => _x( 'Patient Visitor', 'patientvisitor' ),
'singular_name' => _x( 'patientvisitor', 'patientvisitor' ),
'add_new' => _x( 'Add New', 'patientvisitor' ),
'add_new_items' => _x( 'Add New patientvisitor', 'patientvisitor' ),
'edit_items' => _x( 'Edit patientvisitor', 'patientvisitor' ),
'new_items' => _x( 'New patientvisitor', 'patientvisitor' ),
'view_items' => _x( 'View patientvisitor', 'patientvisitor' ),
'search_items' => _x( 'Search patientvisitor', 'patientvisitor' ),
'not_found' => _x( 'No patientvisitor found', 'patientvisitor' ),
'not_found_in_trash' => _x( 'No patientvisitor found in Trash', 'patientvisitor' ),
'parent_items_colon' => _x( 'Parent patientvisitor:', 'patientvisitor' ),
'menu_name' => _x( 'Patient Visitor', 'patientvisitor' ),
);

$args = array(
'labels' => $labels,
'hierarchical' => false,
'supports' => array( 'title', 'thumbnail', 'editor' , 'editor', 'page-attributes' ),
'public' => true,
'show_ui' => true,
'show_in_menu' => true,
'show_in_nav_menus' => true,
'publicly_queryable' => true,
'exclude_from_search' => false,
'has_archive' => true,
'query_var' => true,
'can_export' => true,
'menu_icon' => 'dashicons-screenoptions',
'rewrite' => true,
'capability_type' => 'post'
    );
register_post_type( 'patientvisitor', $args );
flush_rewrite_rules();
}

function patientvisitorcat() {
	register_taxonomy(
		'patientvisitor',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'patientvisitor',   		 //post type name
		array(
			'hierarchical' 		=> true,
			'label' 		=> 'Patient Visitor Category',  //Display name
			'query_var' 		=> true,
			'rewrite'		=> array(
			'slug' 			=> 'patientvisitorcat', // This controls the base slug that will display before each term
			'hierarchical' => true,
			'with_front' 	=> false // Don't display the category base before
					)
			)
		);
}
add_action( 'init', 'patientvisitorcat');














/*** Patient Education Custom Post Type  ***/


function patient_education_cp() {
  $labels = array(
    'name'               => _x( 'Education', 'post type general name' ),
    'singular_name'      => _x( 'Education', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'Education' ),
    'add_new_item'       => __( 'Add New Education' ),
    'edit_item'          => __( 'Edit Education' ),
    'new_item'           => __( 'New Education' ),
    'all_items'          => __( 'All Educations' ),
    'view_item'          => __( 'View Education' ),
    'search_items'       => __( 'Search Educations' ),
    'not_found'          => __( 'No Education found' ),
    'not_found_in_trash' => __( 'No Education found in the Trash' ),
    'parent_item_colon'  => '',
    'menu_name'          => 'Patient Education'
  );
  $args = array(
    'labels'        => $labels,
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments','custom-fields' ),
    'has_archive'   => true,
  );
  register_post_type( 'patient_education', $args );
}
add_action( 'init', 'patient_education_cp' );

function taxonomies_patient_education() {
  $labels = array(
    'name'              => _x( 'Categories', 'taxonomy general name' ),
    'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Categories' ),
    'all_items'         => __( 'All Categories' ),
    'parent_item'       => __( 'Parent Category' ),
    'parent_item_colon' => __( 'Parent Category:' ),
    'edit_item'         => __( 'Edit Category' ),
    'update_item'       => __( 'Update Category' ),
    'add_new_item'      => __( 'Add New Category' ),
    'new_item_name'     => __( 'New Category' ),
    'menu_name'         => __( 'Categories' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'education_cat', 'patient_education', $args );
}
add_action( 'init', 'taxonomies_patient_education', 0 );







/**** Header Phone number *****/

function headerphone_register_widget() {

register_widget( 'headerphone_widget' );

}

add_action( 'widgets_init', 'headerphone_register_widget' );

class headerphone_widget extends WP_Widget {

function __construct() {

parent::__construct(

// widget ID

'headerphone_widget',

// widget name

__('Header Phone', ' headerphone_widget_domain'),

// widget description

array( 'description' => __( 'Headerphone Widget Tutorial', 'headerphone_widget_domain' ), )

);

}

public function widget( $args, $instance ) {

$phone = apply_filters( 'widget_phone', $instance['phone'] );
$link = apply_filters( 'widget_link', $instance['link'] );
echo $args['before_widget'];

//if title is present

if ( ! empty( $phone ) )

echo $args['before_title'] . $phone . $args['after_title'];

	if ( ! empty( $link ) )

echo $args['before_title'] . $link . $args['after_title'];
//output

echo __( '', 'headerphone_widget_domain' );

echo $args['after_widget'];

}

public function form( $instance ) {

if ( isset( $instance[ 'phone' ] ) )

$phone = $instance[ 'phone' ];

else

$title = __( 'Default Title', 'headerphone_widget_domain' );

	
if ( isset( $instance[ 'link' ] ) )
$link = $instance[ 'link' ];

?>

<p>

<label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e( 'Phone Number:' ); ?></label>

<input class="widefat" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" type="text" value="<?php echo esc_attr( $phone ); ?>" />

	<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Link:' ); ?></label>

<input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>" />
</p>

<?php

}

public function update( $new_instance, $old_instance ) {

$instance = array();

$instance['phone'] = ( ! empty( $new_instance['phone'] ) ) ? strip_tags( $new_instance['phone'] ) : '';
$instance['link'] = ( ! empty( $new_instance['link'] ) ) ? strip_tags( $new_instance['link'] ) : '';

return $instance;

}

}


/**** End Header phone number *****/

/**** Header Book An Appointment *****/

function bookappointment_register_widget() {

register_widget( 'bookappointment_widget' );

}

add_action( 'widgets_init', 'bookappointment_register_widget' );

class bookappointment_widget extends WP_Widget {

function __construct() {

parent::__construct(

// widget ID

'bookappointment_widget',

// widget name

__('Book Appointment', ' bookappointment_widget_domain'),

// widget description

array( 'description' => __( 'Bookappointment Widget Tutorial', 'bookappointment_widget_domain' ), )

);

}

public function widget( $args, $instance ) {

$title = apply_filters( 'widget_title', $instance['title'] );
$link = apply_filters( 'widget_link', $instance['link'] );
echo $args['before_widget'];

//if title is present

if ( ! empty( $title ) )

echo $args['before_title'] . $title . $args['after_title'];

	if ( ! empty( $link ) )

echo $args['before_title'] . $link . $args['after_title'];
//output

echo __( '', 'bookappointment_widget_domain' );

echo $args['after_widget'];

}

public function form( $instance ) {

if ( isset( $instance[ 'title' ] ) )

$title = $instance[ 'title' ];

else

$title = __( 'Default Title', 'bookappointment_widget_domain' );

	
if ( isset( $instance[ 'link' ] ) )
$link = $instance[ 'link' ];

?>

<p>

<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>

<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />

	<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Link:' ); ?></label>

<input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr( $link ); ?>" />
</p>

<?php

}

public function update( $new_instance, $old_instance ) {

$instance = array();

$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
$instance['link'] = ( ! empty( $new_instance['link'] ) ) ? strip_tags( $new_instance['link'] ) : '';

return $instance;

}

}

/**** End Header Book An Appointment *****/

/*

function blog_scripts() {
    // Register the script
    wp_register_script( 'custom-script', get_stylesheet_directory_uri(). '/assets/js/load-more.js', array('jquery'), false, true );
 
    // Localize the script with new data
    $script_data_array = array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'security' => wp_create_nonce( 'load_more_posts' ),
    );
    wp_localize_script( 'custom-script', 'blog', $script_data_array );
 
    // Enqueued script with localized data.
    wp_enqueue_script( 'custom-script' );
}
add_action( 'wp_enqueue_scripts', 'blog_scripts' );



add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');
add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback');

function load_posts_by_ajax_callback() {
    check_ajax_referer('load_more_posts', 'security');
    $paged = $_POST['page'];
    $args = array(
        'post_type' => 'service',
        'post_status' => 'publish',
        'posts_per_page' => '2',
        'paged' => $paged,
    );
    $blog_posts = new WP_Query( $args );
    ?>
 
    <?php if ( $blog_posts->have_posts() ) : ?>
        <?php while ( $blog_posts->have_posts() ) : $blog_posts->the_post(); ?>
            <h2><?php the_title(); ?></h2>
            <?php the_excerpt(); ?>
        <?php endwhile; ?>
        <?php
    endif;
  
}


wp_localize_script( 'twentyfifteen-script', 'ajax_posts', array(
    'ajaxurl' => admin_url( 'admin-ajax.php' ),
    'noposts' => __('No older posts found', 'twentyfifteen'),
));

function more_post_ajax(){
     
    $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 1;
    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;
    
    header("Content-Type: text/html");

    $args = array(
        'suppress_filters' => true,
        'post_type' => 'services',
        'posts_per_page' => $ppp,
         'paged'    => $page,
		'cat'  => $category->term_id,
    );
  
    $loop = new WP_Query($args);
 print_r($args);
    $out = '';

    if ($loop -> have_posts()) :  while ($loop -> have_posts()) : $loop -> the_post();
        $out .= '<div class="filterGalleryGrid">
                <h1>'.get_the_title().'</h1>
                <p>'.get_the_content().'</p>
         </div>';

    endwhile;
    endif;
    wp_reset_postdata();
    die($out);
}

add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');

*/

function my_acf_google_map_api( $api ){
    $api['key'] = 'AIzaSyADlk166150RMLLGby78Ayq9kUKyAdHtp0';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
 
 
function dynamic_field_values( $tag, $unused ) {

    if ( $tag['name'] != 'doctors' )
        return $tag;
           $args = array (
        'numberposts'   => -1,
        'post_type'     => 'doctors',
        'orderby'       => 'title',
        'order'         => 'ASC',
		'suppress_filters' => false,

    );

    $custom_posts = get_posts($args);

    if ( ! $custom_posts )
        return $tag;

    foreach ( $custom_posts as $custom_post ) {
     
        $tag['raw_values'][] = $custom_post->post_title;
        $tag['values'][] = $custom_post->ID;
        $tag['labels'][] = $custom_post->post_title;

    }

    return $tag;

}

add_filter( 'wpcf7_form_tag', 'dynamic_field_values', 10, 2);
 
//
add_action( 'wp_ajax_get_dr_form', 'get_dr_form');
add_action( 'wp_ajax_nopriv_get_dr_form', 'get_dr_form');
 
 function get_dr_form(){	 
 
$p_id = $_POST['sr_id'];
    $args=array(
	//'cat' => $cat_id,
	'post_type' => 'service',// You can set custom post type here
	'post_status' => 'publish',
	'posts_per_page' => -1, 
	'orderby' => 'title', 
	'order' => 'ASC', 
     'p' => $p_id,
	//'meta_key' => 'doctors',
		 
	);

	$my_query = null;
	$my_query = new WP_Query($args);
	if( $my_query->have_posts() ) {
		while ($my_query->have_posts()) : $my_query->the_post(); 
  
        $featured_posts = get_field('doctors'); 
		    if( $featured_posts ): 
		      foreach( $featured_posts as $post): 
		      
		 setup_postdata($post);
		   $locations[] = $post;
			 endforeach; 
		wp_reset_postdata(); 
		endif;  
		endwhile; 
	     $locations = array_unique($locations);
    if($locations == ''){?>
 <option value="" ><?php if(ICL_LANGUAGE_CODE=='ar'){echo ' لا طبيب';}else{echo 'No Doctor';}?>   </option>
		<?php	}
	else{ 						   
       $doctor_posts  = new WP_Query( array('post_type'=> 'doctors','post__in' =>$locations,'posts_per_page' => -1,'post_status'=> 'publish','orderby' =>  'title',
        'order' => 'ASC', ) );		 						   
	   if($doctor_posts->have_posts()) :
              while($doctor_posts->have_posts()) :  $doctor_posts->the_post();					   	 
		        $meta = get_post_meta($location); 
                $drname = get_the_title( $location ); 	   
			  	if ($drname != ''){ 
				$id = get_the_ID();	
	                  $designationdr= get_field('designation') 	;
			       ?><option value="" ><?php echo $drname;?>   </option>        
				  <?php } 
		            endwhile;	 else:
                    endif;} }exit(); }  
add_action( 'wpcf7_init', 'custom_add_form_tag_customlist' );

function custom_add_form_tag_customlist() {
    wpcf7_add_form_tag( array( 'customlist', 'customlist*' ), 
'custom_customlist_form_tag_handler', true );
}

function custom_customlist_form_tag_handler( $tag ) {

    $tag = new WPCF7_FormTag( $tag );

    if ( empty( $tag->name ) ) {
        return '';
    }

    $customlist = '';

    $query = new WP_Query(array(
        'post_type' => 'service',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby'       => 'title',
        'order'         => 'ASC',
    ));

    while ($query->have_posts()) {
        $query->the_post();
        $post_title = get_the_title();
		$sr_id= get_the_ID();
        $customlist .= sprintf( '<option id="'.$sr_id.'" value="%2$s">%2$s</option>', 
esc_html( $post_title ), esc_html( $post_title ) );
		
    }

    wp_reset_query();

    $customlist = sprintf(
        '<select name="%1$s" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required form-field" id="ser_cat">%3$s</select>', $tag->name,
    $tag->name . '-options',
        $customlist );

    return $customlist;
}

  


add_image_size( "doctor-image", 200, 200 );
add_filter( 'image_size_names_choose', 'my_custom_sizes' );

function my_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'doctor-image' => __('DoctorImage'),
    ) );
}


 add_shortcode( 'list-slider', 'testimonial' );

function testimonial( $atts ) {
    ob_start();
   	$args = array(  
		'post_type' => 'testimonial',
		'post_status' => 'publish',
		'posts_per_page' => -1, 
		'orderby' => 'post_date', 
		'order' => 'DESC', 
		);
	$loop = new WP_Query( $args ); 
  ?> 
	 <section class="whatOurpatientSayingMain testimonial commonPY">
        <div class="container">
            <div class="whatOurpatientSayingInner">
                <div class="headingText white lightUppercase borderLine">
                    <p>What our happy customers say about us</p>
                    <h2>What our patients are saying</h2>
                </div>
                <div class="happyCustomerSliderOuter">
                    <div class="happyCustomerSlider">
						<?php
         while ( $loop->have_posts() ) : $loop->the_post(); 
						?> 
						 <div class="item">
                            <div class="imgPart">
                                <img src="<?php the_post_thumbnail('full-size');?> " alt="" />
                            </div>
                            <p> <?php the_content(); ?></p>
                            <h5><?php echo the_title();?></h5>
                        </div>
					 
						<?php
						endwhile;

						wp_reset_postdata(); 

						?>	
						 
                    </div>
                </div>
            </div>
        </div>
    </section><!--What our patients are saying End-->	
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    
}
function replace_text($text) {
	$text = str_replace('your email address', 'email', $text); 
	return $text;
}
add_filter('the_content', 'replace_text');
function start_modify_html() {

    ob_start();
}

function end_modify_html() {
      if(ICL_LANGUAGE_CODE=='ar'){
		  
	$html = ob_get_clean();
    $html = str_replace( 'your email address', 'عنوان بريدك الإلكتروني', $html );
    $html = str_replace( 'your email address', 'عنوان بريدك الإلكتروني', $html );
    echo $html;
	  }
 }

add_action( 'wp_head', 'start_modify_html' );
add_action( 'wp_footer', 'end_modify_html' );

function start_modify_html2() {
  ob_start();
}

function end_modify_html2() {
      if(ICL_LANGUAGE_CODE=='ar'){
	 
	$html2 = ob_get_clean();
    $html2 = str_replace( 'No Result Found', 'لم يتم العثور على نتيجة', $html2 );
    $html2 = str_replace( 'No Result Found', 'لم يتم العثور على نتيجة', $html2 );
    echo $html2;
	  }
 }

add_action( 'wp_head', 'start_modify_html2' );
add_action( 'wp_footer', 'end_modify_html2' );

 function start_DownloadPDF() {
  ob_start();
}

function end_DownloadPDF() {
      if(ICL_LANGUAGE_CODE=='ar'){
	 
	$html2 = ob_get_clean();
    $html2 = str_replace( 'Download PDF', 'تحميل PDF', $html2 );
    $html2 = str_replace( 'Download PDF', 'تحميل PDF', $html2 );
    echo $html2;
	  }
 }

add_action( 'wp_head', 'start_DownloadPDF' );
add_action( 'wp_footer', 'end_DownloadPDF' );


 

 