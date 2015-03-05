<?php 

/**
 * Script Register and Enqueue
 *
 * @package      Genesis Sandbox Clean
 * @author       Jonathan Perez
 * @copyright    Copyright (c) 2013, SureFireWebServices
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since        1.1.0
 */

/*
Scripts
---------------------------------------------------------------------------------------------------- */
add_action( 'init', 'gs_register_scripts' );
/**
 * Registers Appropriate Scripts and Styles when needed based on Debugging.
 * Assumes that the normal *.min.js/*.min.css is the minified version & *.js is beautified version.
 * To make the styles appear AFTER your base style, in the array(), place sanitize_title_with_dashes( CHILD_THEME_NAME )
 * so that: array( sanitize_title_with_dashes( CHILD_THEME_NAME ) )
 * e.g., wp_register_style( 'gs-twitter-bootstrap', CHILD_CSS . '/' . gs_script_suffix( 'bootstrap', 'css' ), array( sanitize_title_with_dashes( CHILD_THEME_NAME ) ), '1.0.0' );
 *
 * @uses wp_enqueue_script() WP adds JS to page safely.
 * @uses gs_script_suffix() Adds proper CSS/JS suffix based on WP_DEBUG or SCRIPT_DEBUG
 */
function gs_register_scripts()
{
	/**
	 * Twitter Bootstrap CSS
	 * @link http://www.bootstrapcdn.com/?v=10292012225705
	 * @link http://twitter.github.com/bootstrap/
	 */
	if ($_SERVER['SERVER_NAME'] == 'localhost')
		wp_register_style( 'gs-twitter-bootstrap', CHILD_CSS . '/' . gs_script_suffix( 'bootstrap', 'css' ), array(), '1.0.0' );
	else
		wp_register_style( 'gs-twitter-bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css', array(), '3.3.2' );
	
	/**
	 * Twitter Bootstrap JS
	 * @link http://www.bootstrapcdn.com/?v=10292012225705
	 * @link http://twitter.github.com/bootstrap/
	 */
	if ($_SERVER['SERVER_NAME'] == 'localhost')
		wp_register_script( 'gs-twitter-bootstrap', CHILD_JS . '/' . gs_script_suffix( 'bootstrap', 'js' ), array( 'jquery' ), '2.2.2' );
	else
		wp_register_script( 'gs-twitter-bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js', array( 'jquery' ), '3.3.2' );

	/**
	 * Font Awesome
	 * @link http://www.bootstrapcdn.com/?v=10292012225705
	 * @link http://fortawesome.github.com/Font-Awesome/
	 */
	if ($_SERVER['SERVER_NAME'] == 'localhost')
		wp_register_style( 'gs-font-awesome', CHILD_CSS . '/' . gs_script_suffix( 'font-awesome', 'css' ), array(), '1.0.0' );
	else
		wp_register_style( 'gs-font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', array(), '4.3.1' );
	
	/**
	 * Pretty Photo
	 * @link http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/
	 * @link http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/documentation
	 */
	//wp_register_style( 'gs-pretty-photo', CHILD_CSS . '/' . gs_script_suffix( 'prettyPhoto', 'css' ), array(), '3.1.4' );
	//wp_register_script( 'gs-pretty-photo', CHILD_JS . '/' . gs_script_suffix( 'jquery.prettyPhoto', 'js' ), array( 'jquery' ), '3.1.4' );
	
	/** Common, site specific */
	//wp_register_script( 'gs-common', CHILD_JS . '/' . gs_script_suffix( 'common' ), array( 'jquery' ) , CHILD_THEME_VERSION );
	
	wp_register_style( 'gs-simplyscroll', CHILD_CSS . '/' . gs_script_suffix( 'simplyscroll', 'css' ), array(), '1.0.0' );
	if ($_SERVER['SERVER_NAME'] == 'localhost')
		wp_register_script('simplyscroll-js', CHILD_JS . '/' . gs_script_suffix( 'jquery.simplyscroll.min', 'js'), array('jquery'), '2.0.5');
	else
		wp_register_script('simplyscroll-js', '//cdn.jsdelivr.net/jquery.simplyscroll/2.0.5/jquery.simplyscroll.min.js', array('jquery'), '2.0.5', true);
}

/**
 * Enqueues Appropriate Scripts and Styles when needed based on Debugging.
 * Assumes that the normal *.min.js/*.min.css is the minified version & *.js is beautified version.
 *
 * @uses wp_enqueue_script() WP adds JS to page safely.
 */
function gs_enqueue_scripts() {
		
	//* Styles
	// wp_enqueue_style( 'gs-twitter-bootstrap' );
	
	// wp_enqueue_style( 'gs-twitter-bootstrap-font-awesome' );
	
	// wp_enqueue_style( 'gs-font-awesome' );
	
	// wp_enqueue_style( 'gs-pretty-photo' );
	wp_enqueue_style( 'gs-simplyscroll' );
	
	//* Scripts
	// wp_enqueue_script( 'gs-twitter-bootstrap' );
	// wp_enqueue_script( 'gs-pretty-photo' );
	// add_action( 'wp_footer', 'gs_init_pretty_photo' );
	// wp_enqueue_script( 'gs-common' );
	
	wp_enqueue_script( 'simplyscroll-js');
	
	
	// Localize Script
	/*
	// This enables you to create variable variables in JS that will be referred to as gs.greeting
	$l10n_args = array(
		//REFERENCE => VALUE, example in next line, CHILD_DOMAIN is the text domain for internationalization.
		'greeting'  => __( 'Hello World!', CHILD_DOMAIN ),
	);
	// @link http://codex.wordpress.org/Function_Reference/wp_localize_script
	// wp_localize_script( REGISTERED-HANDLE, OBJECT_NAME, OBJECT_DATA );
	wp_localize_script( 'gs-common-scripts', 'gs', $l10n_args );
	*/
}


// * IE Conditional Styles - gotta load last
add_action('wp_enqueue_scripts', 'genesischild_ie_styles', 999);

function genesischild_ie_styles()
{
	wp_register_style('ie8', get_stylesheet_directory_uri() . '/css/ie8.css'); // target IE8 and Lower
    $GLOBALS['wp_styles']->add_data('ie8', 'conditional', 'lte IE 8');
    wp_register_style('ieall', get_stylesheet_directory_uri() . '/css/ieall.css'); // target IE9 and lower
    $GLOBALS['wp_styles']->add_data('ieall', 'conditional', 'IE');
	wp_enqueue_style('ie8');
    wp_enqueue_style('ieall');
}

/*
CSS Cache Buster
 ---------------------------------------------------------------------------------------------------- */

add_filter( 'stylesheet_uri', 'gs_stylesheet_uri' );
/**
 * CSS Cache Buster
 * Always load CSS regardless of cache.
*/
function gs_stylesheet_uri( $stylesheet_uri ) {
    return add_query_arg( 'v', filemtime( get_stylesheet_directory() . '/style.css' ), $stylesheet_uri );
}