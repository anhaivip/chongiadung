<?php
//* Start the engine
include_once( get_stylesheet_directory() . '/lib/init.php' );
//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Người giữ linh hồn' );
define( 'CHILD_THEME_URL', 'http://www.phongcachmoingay.com/' );
//* CSS Cache Buster
define( 'CHILD_THEME_VERSION', filemtime( get_stylesheet_directory() . '/style.css' ) );

// if(extension_loaded("zlib") && (ini_get("output_handler") != "ob_gzhandler"))
//     add_action('wp', create_function('', '@ob_end_clean();@ini_set("zlib.output_compression", 1);'));

//Theme Set Up Function
add_action( 'genesis_setup', 'gs_theme_setup', 15 );

function gs_theme_setup() {
	
	//* Add HTML5 markup structure
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	//* Add viewport meta tag for mobile browsers
	add_theme_support( 'genesis-responsive-viewport' );

	//Enable Post Navigation
	// add_action( 'genesis_after_entry_content', 'genesis_prev_next_post_nav', 5 );
	
	//Custom Image Sizes
	add_image_size( 'featured-image', 180, 150, TRUE );
	
	// Enable Custom Background
	//add_theme_support( 'custom-background' );

	// Enable Custom Header
	//add_theme_support('genesis-custom-header');


	// Add support for structural wraps
	add_theme_support( 'genesis-structural-wraps', array(
		'header',
		'nav',
		'subnav',
		'inner',
		'footer-widgets',
		'footer'
	));
	
	/** 
	 * 01 Set width of oEmbed
	 * genesis_content_width() will be applied; Filters the content width based on the user selected layout.
	 *
	 * @see genesis_content_width()
	 * @param integer $default Default width
	 * @param integer $small Small width
	 * @param integer $large Large width
	 */
	$content_width = apply_filters( 'content_width', 600, 430, 920 );
	
	
	/**
	 * 02 Footer Widgets
	 * Add support for 3-column footer widgets
	 * Change 3 for support of up to 6 footer widgets (automatically styled for layout)
	 */
	add_theme_support( 'genesis-footer-widgets', 3 );

	/**
	 * 03 Genesis Menus
	 * Genesis Sandbox comes with 4 navigation systems built-in ready.
	 * Delete any menu systems that you do not wish to use.
	 */
	add_theme_support(
		'genesis-menus', 
		array(
			'primary'   => __( 'Primary Navigation Menu', CHILD_DOMAIN ), 
			'secondary' => __( 'Secondary Navigation Menu', CHILD_DOMAIN ),
			'footer'    => __( 'Footer Navigation Menu', CHILD_DOMAIN ),
			'mobile'    => __( 'Mobile Navigation Menu', CHILD_DOMAIN ),
		)
	);
	
	// Add Mobile Navigation
	add_action( 'genesis_before', 'gs_mobile_navigation', 5 );
	
	//Enqueue Sandbox Scripts
	add_action( 'wp_enqueue_scripts', 'gs_enqueue_scripts' );
	
	/**
	 * 4 Editor Styles
	 * Takes a stylesheet string or an array of stylesheets.
	 * Default: editor-style.css 
	 */
	//add_editor_style();
	
	
	// Register Sidebars
	gs_register_sidebars();
	
	// Dòng sự kiện
	add_action('genesis_before', 'genesis_ticker');
	
} // End of Set Up Function

// Register Sidebars
function gs_register_sidebars() {
	$sidebars = array(
		array(
			'id'			=> 'content_one',
			'name'			=> __( 'News Content', CHILD_DOMAIN ),
			'description'	=> __( 'Phần nội dung tin tức.', CHILD_DOMAIN ),
		)
	);
	foreach ( $sidebars as $sidebar )
		genesis_register_sidebar( $sidebar );
}

/**
 * Add navigation menu 
 * Required for each registered menu.
 * 
 * @uses gs_navigation() Sandbox Navigation Helper Function in gs-functions.php.
 */
function gs_mobile_navigation() {
	
	$mobile_menu_args = array(
		'echo' => true,
	);
	gs_navigation( 'mobile', $mobile_menu_args );
}

// Add Widget Area After Post
add_action('genesis_after_entry', 'gs_do_after_entry');
function gs_do_after_entry() {
 	if ( is_single() ) {
		genesis_widget_area( 
			'after-post', array(
				'before' => '<aside id="after-post" class="after-post"><div class="home-widget widget-area">', 
				'after' => '</div></aside><!-- end #home-left -->',
			) 
		);
    }
}
 
// Adds Customized version of Genesis Featured Posts Widget
// require_once('lib/widgets/custom-post-widget.php');
// register our custom widget..
// register_widget( 'Genesis_Special_Post' );

// Adds Customized version of Genesis Featured Posts Widget Amplified
//require_once('lib/widgets/custom-cpt-post-widget.php');
//register_widget( 'Genesis_CPT_Post' );


/**
 * Enqueue and Register Scripts - Twitter Bootstrap, Font-Awesome, and Common.
 */
require_once(get_stylesheet_directory() . '/lib/scripts.php');

/*
if you're using custom post types, you can use this example to create your own. You can also use the example templates if you want to customize the look of your custom post type pages
*/
// require_once( get_stylesheet_directory() . '/lib/metaboxes/init.php');
// require_once(get_stylesheet_directory() . '/lib/cpt/custom-post-types.php');
// require_once(get_stylesheet_directory() . '/lib/cpt/resources.php');
// require_once(get_stylesheet_directory() . '/lib/cpt/featured.php');

//* Bài viết nổi bật

function genesis_ticker(){
    get_template_part( '/lib/inc/ticker' );
}