<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Genesis Sample Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.1.2' );

//* Enqueue Google Fonts
add_action( 'wp_enqueue_scripts', 'genesis_sample_google_fonts' );
function genesis_sample_google_fonts() {

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700', array(), CHILD_THEME_VERSION );

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );


add_action('wp_enqueue_scripts', 'genesischild_ie_styles', 999);
function genesischild_ie_styles()
{	
	wp_enqueue_script('simplyscrolljs', '//cdn.jsdelivr.net/jquery.simplyscroll/2.0.5/jquery.simplyscroll.min.js', array('jquery'));
	//wp_enqueue_style('rollcss', '//cdn.jsdelivr.net/jquery.simplyscroll/2.0.5/jquery.simplyscroll.css');
}

//* Bài viết nổi bật
add_action('genesis_before', 'genesis_ticker');

function genesis_ticker(){
    get_template_part( 'include/ticker' );
}