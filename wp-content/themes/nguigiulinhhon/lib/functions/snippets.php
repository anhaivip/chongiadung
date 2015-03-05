<?php 

/**
 * Snippets file.
 *
 * Contains the most popular Genesis snippets used.
 *
 * @category   Genesis_Sandbox
 * @package    Functions
 * @subpackage Snippets
 * @author     Travis Smith and Jonathan Perez
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link       http://wpsmith.net/
 * @since      1.1.0
 */


/* Table of Contents

   01 Layout
   02 Favicon
   03 Remove Genesis in-post metaboxes
   04 Remove Genesis Admin Menus
   05 Genesis Style Selector
   06 Body & Post Classes
   07 Author Boxes
   08 Post Info & Post Meta
   09 Customize Links
      -Next/Previous Links
      -Newer/Older Links
   10 Search Customizations
   11 Footer
   12 Remove Genesis Site Title, Site Description, & Header Right
   13 Reposition Items: Breadcrumbs, Footer, Primary & Secondary Navs
   14 Remove Genesis/WordPress widgets
   15 Remove Superfish
   16 Custom Genesis Post Content
   17 Genesis Settings breadcrumb
   18 Genesis Theme Settings
   19 Alternative Doctype
   20
   21 Genesis Slider
   22 Avatars
*/

/** Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) exit( 'accessed directly.' );

/*
01 Layout
---------------------------------------------------------------------------------------------------- */
/**** Truly Force Layout without allowing the User to Override the preferred/recommended layout ****/
// Force Full Width Layout
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );
 
// Force Content-Sidebar Layout
add_filter( 'genesis_site_layout', '__genesis_return_content_sidebar' );
 
// Force Sidebar-Content Layout
add_filter( 'genesis_site_layout', '__genesis_return_sidebar_content' );
 
// Force Content-Sidebar-Sidebar Layout
add_filter( 'genesis_site_layout', '__genesis_return_content_sidebar_sidebar' );
 
// Force Sidebar-Sidebar-Content Layout
add_filter( 'genesis_site_layout', '__genesis_return_sidebar_sidebar_content' );
 
// Force Sidebar-Content-Sidebar Layout
add_filter( 'genesis_site_layout', '__genesis_return_sidebar_content_sidebar' );
 
/**** Force Layout but allow the User to Override the preferred/recommended layout ****/
// Force Full Width Layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
 
// Force Content-Sidebar Layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );
 
// Force Sidebar-Content Layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_sidebar_content' );
 
// Force Content-Sidebar-Sidebar Layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar_sidebar' );
 
// Force Sidebar-Sidebar-Content Layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_sidebar_sidebar_content' );
 
// Force Sidebar-Content-Sidebar Layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_sidebar_content_sidebar' );

//* default layout for post sidebar-content
// add_filter( 'genesis_pre_get_option_site_layout', 'child_do_layout' );
function child_do_layout( $opt ) {
    if ( is_single() ) {
        $opt = 'sidebar-content';
        return $opt;
    }
}
/*
02 Favicon
---------------------------------------------------------------------------------------------------- */

/** Remove favicon */
remove_action('genesis_meta', 'genesis_load_favicon');
// remove_action('genesis_meta', 'genesis_load_stylesheet');

//add_filter( 'genesis_pre_load_favicon', 'gs_pre_load_favicon' );
/**
 * Change favicon
 *
 * @param  string $url Default Favicon URL
 * @return string New Favicon URL
 */
function gs_pre_load_favicon( $url ) {
	return 'http://domain.com/path/to/favicon.png';
}

//add_action( 'admin_head', 'gs_admin_favicon' );
/**
 * Adds Admin Favicon
 *
 */
function gs_admin_favicon() {
	echo '<link rel="shortcut icon" type="image/x-icon" href="' . INCIPIO_IMAGES . '/admin-favicon.png" />';
}

/*
03 Remove Genesis in-post metaboxes
---------------------------------------------------------------------------------------------------- */

/** Remove Genesis in-post SEO Settings */
remove_action( 'admin_menu', 'genesis_add_inpost_seo_box' );
 
/** Remove Genesis Layout Settings */
remove_theme_support( 'genesis-inpost-layouts' );

/*
04 Remove Genesis admin menus
---------------------------------------------------------------------------------------------------- */

/** Remove Genesis menu link */
// remove_theme_support( 'genesis-admin-menu' );
 
/** Remove Genesis SEO Settings menu link */
remove_theme_support( 'genesis-seo-settings-menu' );

/** Remove README theme support */
remove_theme_support( 'genesis-readme-menu' );

/*
05 Genesis Style Selector
---------------------------------------------------------------------------------------------------- */

/** Create color style options */
add_theme_support(
	'genesis-style-selector',
	array(
		'theme-blue'   => __( 'Blue', CHILD_DOMAIN ),
		'theme-green'  => __( 'Green', CHILD_DOMAIN ),
		'theme-orange' => __( 'Orange', CHILD_DOMAIN ),
		'theme-red'    => __( 'Red', CHILD_DOMAIN )
	)
);

/*
06 Body & Post Classes
---------------------------------------------------------------------------------------------------- */

//add_filter( 'body_class', 'gs_add_body_class' );
/**
 * Add custom body class to the head.
 *
 * @param  array $classes Array of existing body classes.
 * @return array $classes Modified Array of body classes.
 */
function gs_add_body_class( $classes ) {
	$classes[] = 'custom-class';
	return $classes;
}

//add_filter( 'post_class', 'gs_post_class' );
/**
 * Add custom post classes.
 *
 * @param  array $classes Array of existing post classes.
 * @return array $classes Modified Array of body classes.
 */
function gs_post_class( $classes ) {
	$classes[] = 'custom-class';
	return $classes;
}

/*
07 Author Boxes
---------------------------------------------------------------------------------------------------- */
/** Remove author box on single posts */
remove_action( 'genesis_after_post', 'genesis_do_author_box_single' );
 
/** Display author box on single posts */
// add_filter( 'get_the_author_genesis_author_box_single', '__return_true' );
 
/** Display author box on archive pages */
add_filter( 'get_the_author_genesis_author_box_archive', '__return_true' );
 
add_filter( 'genesis_author_box_title', 'gs_author_box_title' );
/**
 * Modify author box title 
 *
 * @param  string $title Default title (default: About {the author's name}).
 * @return string New author box title.
 */
function gs_author_box_title( $title ) {
	return '<strong>About '.$title.'</strong>';
}
 
// add_filter( 'genesis_author_box_gravatar_size', 'gs_author_box_gravatar_size', 10, 2 );
/**
 * Modify the size of the Gravatar in author box
 *
 * @param  int $size Size in pixels of gravatar (default: 70).
 * @param string $context Optional. Allows different author box markup for
 * different contexts, specifically 'single'. Default is empty string.
 * @return int New size in pixels of gravatar.
 */
function gs_author_box_gravatar_size( $size, $context ) {
	return 80;
}

add_filter( 'genesis_author_box', 'be_author_box', 10, 6 );
/**
 * Customize Author Box
 * @author Bill Erickson
 * @link http://www.billerickson.net/code/customize-author-box
 *
 * @param string $output
 * @param string $context
 * @param string $pattern
 * @param string $gravatar
 * @param string $title
 * @param string $description
 * @return string $output
 */
function be_author_box( $output, $context, $pattern, $gravatar, $title, $description ) 
{
    $output = '';
	// Author box on single post
	if( 'single' == $context ) {
		$output .= '<div class="author-box">';
		$output .= '<div class="left">';
		$output .= get_avatar( get_the_author_meta( 'email' ), 120 );
		$output .= '</div><!-- .left -->';
		$output .= '<div class="right">';
		$name = get_the_author();
		$title = get_the_author_meta( 'title' );
		if( !empty( $title ) )
			$name .= ', ' . $title;
		$output .= '<h4 class="title">' . $name . '</h4>';
		$output .= '<p class="desc">' . get_the_author_meta( 'description' ) . '</p>';
		$output .= '</div><!-- .right -->';
		$output .= '<div class="cl"></div>';
		$output .= '<div class="left"><p class="social">';
		if( get_the_author_meta( 'twitter_id' ) )
			$output .= '<a href="' . esc_url( get_the_author_meta( 'twitter_id' ) ) . '"><i class="fa fa-twitter fa-lg"></i></a> ';
		if( get_the_author_meta( 'google_profile' ) )
			$output .= '<a href="' . esc_url( get_the_author_meta( 'google_profile' ) ) . '"><i class="fa fa-google-plus fa-lg"></i></a> ';
		if( get_the_author_meta( 'facebook_id' ) )
			$output .= '<a href="' . esc_url( get_the_author_meta( 'facebook_id' ) ) . '"<i class="fa fa-facebook fa-lg"></i></a> ';
		$output .= '<a href="' . trailingslashit( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . 'feed"><i class="fa fa-rss fa-lg"></i></a>';
		$output .= '</div><!-- .left -->';
		$output .= '<div class="right">';
		$output .= '<p class="email"><a href="mailto:' . get_the_author_meta( 'email' ) . '">Email ' . get_the_author_meta( 'email' ) . '</a></p>';
		$output .= '</div><!-- .right -->';
		$output .= '</div><!-- .author-box -->';
	}
	else
	{
		$output .= '<div class="author-box">';
		$output .= '<div class="left">';
		$output .= get_avatar( get_the_author_meta( 'email' ), 200 );
		$output .= '</div><!-- .left -->';
		$output .= '<div class="right">';
		$name = get_the_author();
		$title = get_the_author_meta( 'title' );
		if( !empty( $title ) )
			$name .= ', ' . $title;
		$output .= '<h4 class="title">' . $name . '</h4>';
		$output .= '<p class="desc">' . get_the_author_meta( 'description' ) . '</p>';
		$output .= '</div><!-- .right -->';
		$output .= '<div class="cl"></div>';
		$output .= '<div class="left"><p class="social">';
		if( get_the_author_meta( 'twitter_id' ) )
			$output .= '<a href="' . esc_url( get_the_author_meta( 'twitter_id' ) ) . '"><i class="fa fa-twitter fa-lg"></i></a> ';
		if( get_the_author_meta( 'google_profile' ) )
			$output .= '<a href="' . esc_url( get_the_author_meta( 'google_profile' ) ) . '"><i class="fa fa-google-plus fa-lg"></i></a> ';
		if( get_the_author_meta( 'facebook_id' ) )
			$output .= '<a href="' . esc_url( get_the_author_meta( 'facebook_id' ) ) . '"<i class="fa fa-facebook fa-lg"></i></a> ';
		$output .= '<a href="' . trailingslashit( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . 'feed"><i class="fa fa-rss fa-lg"></i></a>';
		$output .= '</div><!-- .left -->';
		$output .= '<div class="right">';
		$output .= '<p class="email"><a href="mailto:' . get_the_author_meta( 'email' ) . '">Email ' . get_the_author_meta( 'email' ) . '</a></p>';
		$output .= '</div><!-- .right -->';
		$output .= '</div><!-- .author-box -->';
	}
	return $output;
}


/*
08 Post Info & Post Meta
---------------------------------------------------------------------------------------------------- */
add_filter( 'genesis_post_info', 'gs_post_info_filter' );
/** 
 * Customize the post info function
 *
 * @link http://my.studiopress.com/docs/shortcode-reference/
 * @param  string $post_info Default post info.
 * (default: '[post_date] ' . __( 'by', 'genesis' ) . ' [post_author_posts_link] [post_comments] [post_edit]')
 * @return string Modified post info.
 */
function gs_post_info_filter( $post_info ) {
	return '[post_date] bởi [post_author_posts_link] [post_comments zero="0 bình luận" one="1 bình luận" more="% bình luận"] [post_edit]';
}
 
/** Remove the post info function */
remove_action( 'genesis_before_post_content', 'genesis_post_info' );
//add_filter( 'genesis_post_info', '__return_null' );

add_filter( 'genesis_post_meta', 'gs_post_meta_filter' );
/** 
 * Customize the post meta function
 *
 * @link http://my.studiopress.com/docs/shortcode-reference/
 * @param  string $post_meta Default post meta.
 *  [post_date] - Date the entry was published
    [post_modified_date] - Date the entry was last modified
    [post_time] - Time the entry was published
    [post_modified_time] - Time the entry was last modified
    [post_author] - Entry author display name
    [post_author_link] - Entry author display name, linked to their website
    [post_author_posts_link] - Entry author display name, linked to their archive
    [post_comments] - Entry comments link
    [post_tags] - List of entry tags
    [post_categories] - List of entry categories
    [post_edit] - Entry edit link (visible to admins)
 * @return string Modified post meta.
 */
function gs_post_meta_filter( $post_meta ) {
    $creds = '[post_categories sep="/&nbsp;" before="Chuyên mục: "]';
    
    if (is_singular())
        $creds.=' [post_tags sep=",&nbsp;" before="Từ khoá: "]';
    return $creds;
}
 
/** Remove the post meta function */
remove_action( 'genesis_after_post_content', 'genesis_post_meta' );
//add_filter( 'genesis_post_meta', '__return_null' );

/*
09 Customize Links
   a. Next/Previous Links
---------------------------------------------------------------------------------------------------- */

add_filter ( 'genesis_next_link_text' , 'gs_next_link_text' );
/** 
 * Customize the next page link
 *
 * @param  string $text Default next page link.
 * (default: __( 'Next Page', 'genesis' ) . '&#x000BB;' )
 * @return string Modified next page link.
 */
function gs_next_link_text ( $text ) {
	return g_ent( '&raquo; ' ) . __( 'Trang sau', CHILD_DOMAIN );
}

/*
   b. Newer/Older Links
---------------------------------------------------------------------------------------------------- */

add_filter ( 'genesis_prev_link_text' , 'gs_prev_link_text' );
/** 
 * Customize the previous page link
 *
 * @param  string $text Default previous page link.
 * (default: __( 'Previous Page', 'genesis' ) . '&#x000BB;' )
 * @return string Modified previous page link.
 */
function gs_prev_link_text ( $text ) {
	return g_ent( '&laquo; ' ) . __( 'Trang trước', CHILD_DOMAIN );
}
 
add_filter ( 'genesis_newer_link_text' , 'gs_newer_link_text' );
/** 
 * Customize the newer posts link
 *
 * @param  string $text Default newer posts link.
 * (default: __( 'Newer Posts', 'genesis' ) . '&#x000BB;' )
 * @return string Modified newer posts link.
 */
function gs_newer_link_text ( $text ) {
	return g_ent( '&raquo; ' ) . __( 'Bài mới hơn', CHILD_DOMAIN );
}
 
add_filter ( 'genesis_older_link_text' , 'gs_older_link_text' );
/** 
 * Customize the older posts link
 *
 * @param  string $text Default older posts link.
 * (default: __( 'Older Posts', 'genesis' ) . '&#x000BB;' )
 * @return string Modified older posts link.
 */
function gs_older_link_text ( $text ) {
	return g_ent( '&laquo; ' ) . __( 'Bài viết cũ hơn', CHILD_DOMAIN );
}

/*
10 Search Customizations
---------------------------------------------------------------------------------------------------- */

// Customize search form input box text
add_filter( 'genesis_search_text', 'gs_search_text' );
/** 
 * Customize search form input box text
 *
 * @param  string $text Default search form input box text.
 * (default: esc_attr__( 'Search this website', 'genesis' ) . '&#x02026;' )
 * @return string Modified search form input box text.
 */
function gs_search_text($text) {
	return esc_attr( 'Tìm kiếm trong trang...' );
}
 
add_filter( 'genesis_search_button_text', 'gs_search_button_text' );
/** 
 * Customize search form input button text
 *
 * @param  string $text Default search form input button text.
 * (default: Search )
 * @return string Modified search form input button text.
 */
function gs_search_button_text($text) {
	return esc_attr( 'Tìm' );
}
/** Echo the title with the search term. */
add_filter('genesis_search_title_text', 'genesis_search_title_text');

function genesis_search_title_text($text)
{
    return esc_attr('Kết quả tìm kiếm cho:');
}

/** Echo the title with the search term. */
add_filter('genesis_noposts_text', 'genesis_noposts_text');

function genesis_noposts_text($text)
{
    return esc_attr('Xin lỗi, không có nội dung phù hợp tiêu chí của bạn.');
}
/*
11 Footer
---------------------------------------------------------------------------------------------------- */
add_filter ( 'genesis_footer_creds_text', 'footer_creds_text' );
function footer_creds_text($creds) {
    $creds = '[footer_copyright before="Bản quyền "] · [footer_childtheme_link before="" after=" bởi"] · [footer_loginout]';
    return $creds;
}

add_filter( 'genesis_footer_output', 'footer_output' );

function footer_output($footer_output) {
    $footer_output = '<p>[footer_copyright before="Copyright "] &middot; [footer_childtheme_link before="" after=" On"] [footer_genesis_link url="http://www.phongcachmoingay.com/" before=""] &middot; [footer_wordpress_link] &middot; [footer_loginout]</p>';
    return $footer_output;
}

//* Customizes go to top text
add_filter ( 'genesis_footer_backtotop_text', 'footer_backtotop_filter' );
function footer_backtotop_filter($creds) {
    $creds = '';
    return $creds;
}
/*
12 Remove Genesis Site Title, Site Description, & Header Right
---------------------------------------------------------------------------------------------------- */
/** Remove the site title */
// remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
 
/** Remove the site description */
// remove_action( 'genesis_site_description', 'genesis_seo_site_description' );
 
/** Remove the header right widget area */
unregister_sidebar( 'header-right' );

/*
13 Reposition Items: Breadcrumbs, Footer, Primary & Secondary Navs
---------------------------------------------------------------------------------------------------- */

/** Reposition the breadcrumbs */
// remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
// add_action( 'genesis_after_header', 'genesis_do_breadcrumbs' );

/** Reposition the footer */
// remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
// remove_action( 'genesis_footer', 'genesis_do_footer' );
// remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );
// add_action( 'genesis_after', 'genesis_footer_markup_open', 11 );
// add_action( 'genesis_after', 'genesis_do_footer', 12 );
// add_action( 'genesis_after', 'genesis_footer_markup_close', 13 );

/** Reposition the primary navigation menu */
// remove_action( 'genesis_after_header', 'genesis_do_nav' );
// add_action( 'genesis_before_header', 'genesis_do_nav' );
 
/** Reposition the secondary navigation menu */
// remove_action( 'genesis_after_header', 'genesis_do_subnav' );
// add_action( 'genesis_before_header', 'genesis_do_subnav' );

/*
14 Remove Genesis/WordPress widgets
---------------------------------------------------------------------------------------------------- */

add_action( 'widgets_init', 'gs_remove_enews_updates_widget', 20 );
/**
 * Remove Genesis/WordPress widgets
 */
function gs_remove_enews_updates_widget() {
	// Remove eNews and Updates widget (softly deprecated in Genesis 1.9)
	unregister_widget( 'Genesis_eNews_Updates' );
	
	// Remove Latest Tweets widget (softly deprecated in Genesis 1.9)
	unregister_widget( 'Genesis_Latest_Tweets_Widget' );
	
	// Remove Featured Page widget
	unregister_widget( 'Genesis_Featured_Page' );
	
	// Remove Featured Post widget
	// Don't do if using Genesis Featured Widget Amplified
	unregister_widget( 'Genesis_Featured_Post' );
	
	// Remove User Profile widget
	unregister_widget( 'Genesis_User_Profile_Widget' );
	
	// Remove these WordPress widgets:
	//unregister_widget( 'WP_Widget_Pages' );
	//unregister_widget( 'WP_Widget_Calendar' );
	//unregister_widget( 'WP_Widget_Archives' );
	//unregister_widget( 'WP_Widget_Links' );
	//unregister_widget( 'WP_Widget_Meta' );
	//unregister_widget( 'WP_Widget_Search' );
	//unregister_widget( 'WP_Widget_Text' );
	//unregister_widget( 'WP_Widget_Categories' );
	//unregister_widget( 'WP_Widget_Recent_Posts' );
	//unregister_widget( 'WP_Widget_Recent_Comments' );
	//unregister_widget( 'WP_Widget_RSS' );
	//unregister_widget( 'WP_Widget_Tag_Cloud' );
	//unregister_widget( 'WP_Nav_Menu_Widget' );
}

/*
15 Remove Superfish
---------------------------------------------------------------------------------------------------- */

add_action( 'wp_enqueue_scripts', 'unregister_superfish' );
/**
 * Unregister the superfish scripts
 */
function unregister_superfish() {
	wp_deregister_script( 'superfish' );
	wp_deregister_script( 'superfish-args' );
}

/*
16 Add Custom Genesis Post Content
---------------------------------------------------------------------------------------------------- */
remove_action('genesis_entry_content', 'genesis_do_post_content');
add_action('genesis_entry_content', 'genesis_tumblog_post_content');

function genesis_tumblog_post_content()
{
    if ( is_singular() )
    {
        // display content on posts/pages
        the_content(); 
        if ( is_single() && get_option('default_ping_status') == 'open' )
        {
            echo '<!--'; trackback_rdf(); echo '-->' ."\n";
        }
        if ( is_page() )
        {
            edit_post_link(__('(Sửa)', 'genesis'), '', '');
        }
    }
    elseif ( genesis_get_option('content_archive') == 'excerpts' )
    {
        the_excerpt();
    }
    else 
    {
        if ( genesis_get_option('content_archive_limit') )
        {
            the_content_limit( (int)genesis_get_option('content_archive_limit'), __('[đọc thêm...]', 'genesis') );
        }
        else
        {
            if ( has_post_thumbnail() ) 
            {
                $image_args = array(
                    'class' => "alignleft post-image entry-image attachment-$size",
                    'alt'   => trim( strip_tags( $wp_postmeta->_wp_attachment_image_alt ) ),
                    'itemprop'=>'image'
                );
                echo '<a href="', the_permalink(),'">',the_post_thumbnail(array(160,180), $image_args),'</a>';
            } else {
                echo '<img class="alignleft post-image entry-image" src="' . trailingslashit( get_stylesheet_directory_uri()) . 'images/no-featured-image.png' . '" alt="" />';
            }
            echo the_excerpt();
            remove_action( 'genesis_after_post_content', 'genesis_post_meta');
            echo '<div style="clear: both"></di>';
        }
    }
}


/**
 * Custom Widget Titles for Home
 *
 * @author Jen Baumann
 * @link http://dreamwhisperdesigns.com/?p=1005
 */
remove_action( 'gfwa_before_post_content', 'gfwa_do_post_title', 10, 1 );
add_action( 'gfwa_before_post_content', 'custom_gfwa_do_post_title', 10, 1 );
function custom_gfwa_do_post_title( $instance ) {
    $link = $instance['link_title_field'] && genesis_get_custom_field( $instance['link_title_field']) ? genesis_get_custom_field( $instance['link_title_field']) : get_permalink();

    $wrap_open = $instance['link_title'] == 1 ? sprintf( '<a href="%s" title="%s">', $link, the_title_attribute( 'echo=0' ) ) : '';
    $wrap_close = $instance['link_title'] == 1 ? '</a>' : '';

    if ( !empty( $instance['show_title'] ) && !empty( $instance['title_limit'] ) )
        printf( '<h2>%s%s%s%s</h2>', $wrap_open, genesis_get_custom_field( 'child_home_title' ), $instance['title_cutoff'], $wrap_close );
    elseif ( !empty( $instance['show_title'] ) )
    printf( '<h2>%s%s%s</h2>', $wrap_open, the_title_attribute( 'echo=0' ), $wrap_close );
     
}


/*
 17 Genesis Settings breadcrumb
 ---------------------------------------------------------------------------------------------------- */
add_filter( 'genesis_breadcrumb_args', 'sp_breadcrumb_args' );

function sp_breadcrumb_args( $args ) {
    $args['home'] = 'Trang chủ';
    $args['sep'] = ' / ';
    $args['list_sep'] = ', '; // Genesis 1.5 and later
    $args['prefix'] = '<div class="breadcrumb">';
    $args['suffix'] = '</div>';
    $args['heirarchial_attachments'] = true; // Genesis 1.5 and later
    $args['heirarchial_categories'] = true; // Genesis 1.5 and later
    $args['display'] = true;
    $args['labels']['prefix'] = '';
    $args['labels']['author'] = 'Lưu trữ cho ';
    $args['labels']['category'] = 'Lưu trữ cho '; // Genesis 1.6 and later
    $args['labels']['tag'] = 'Lưu trữ cho ';
    $args['labels']['date'] = 'Lưu trữ cho ';
    $args['labels']['search'] = 'Tìm kiếm cho ';
    $args['labels']['tax'] = 'Lưu trữ cho ';
    $args['labels']['post_type'] = 'Lưu trữ cho ';
    $args['labels']['404'] = 'Không tìm thấy'; // Genesis 1.5 and later
    return $args;
}
/*
18 Genesis Theme Settings
---------------------------------------------------------------------------------------------------- */

add_filter( 'genesis_options', 'gs_define_genesis_settings', 10, 2 );
/**
 * Define Genesis Options
 *
 * @param array $options Array of Setting Options.
 * @param string $setting Specific Setting.
 */
function gs_define_genesis_settings( $options, $setting ) {
    if ( GENESIS_SETTINGS_FIELD === $setting ) {
        $options['show_info']                 = 0; // Display theme info in document source
        $options['update']                    = 1; // Enable Automatic Updates
        $options['update_email']              = 0; // Notify when updates are available
        $options['update_email_address']      = ''; // Update email address
        $options['feed_uri']                  = ''; // Custom reed URI
        $options['redirect_feed']             = 0; // Redirect reed
        $options['comments_feed_uri']         = ''; // Custom comments feed URI
        $options['redirect_comments_feed']    = 0; // Redirect feed
        $options['site_layout']               = 'content-sidebar'; // Default layout
        $options['blog_title']                = 'image'; // Blog title/logo - 'text' or 'image'
        $options['nav']                       = 1; // Include primary navigation (DEPRECATED)
        $options['nav_superfish']             = 1; // Enable fancy dropdowns
        $options['nav_extras_enable']         = 0; // Enable extras
        $options['nav_extras']                = 'date'; // Extras - 'date', 'rss', 'search', 'twitter'
        $options['nav_extras_twitter_id']     = ''; // Twitter ID
        $options['nav_extras_twitter_text']   = 'Follow me on Twitter'; // Twitter link text
        $options['subnav']                    = 0; // Include secondary navigation (DEPRECATED)
        $options['subnav_superfish']          = 1; // Enable fancy dropdowns
        $options['breadcrumb_home']           = 0; // Enable breadcrumbs on Front Page
        $options['breadcrumb_single']         = 1; // Enable breadcrumbs on Posts
        $options['breadcrumb_page']           = 1; // Enable breadcrumbs on Pages
        $options['breadcrumb_archive']        = 1; // Enable breadcrumbs on Archives
        $options['breadcrumb_404']            = 1; // Enable breadcrumbs on 404 Page
        $options['breadcrumb_attachment']     = 1; // Enable breadcrumbs on Attachment Pages
        $options['comments_posts']            = 1; // Enable comments on Posts
        $options['comments_pages']            = 0; // Enable comments on Pages
        $options['trackbacks_posts']          = 1; // Enable trackbacks on Posts
        $options['trackbacks_pages']          = 0; // Enable trackbacks on Pages
        $options['content_archive']           = 'full'; // Content archives display - 'full', 'excerpts'
        $options['content_archive_limit']     = ''; // Limit content to n characters
        $options['content_archive_thumbnail'] = 0; // Include featured image
        $options['posts_nav']                 = 'numeric'; // Post navigation - 'older-newer', 'prev-next', 'numeric'
        $options['blog_cat']                  = '0'; // Blog page displays which category
        $options['blog_cat_exclude']          = ''; // Blog page excludes which category 
        $options['blog_cat_num']              = 10; // Number of posts to show
        $options['header_scripts']            = ''; // Header scripts, unfiltered, must include <script></script> tags
        $options['footer_scripts']            = ''; // Footer scripts, unfiltered, must include <script></script> tags
	}
	
    return $options;
}

add_action( 'genesis_theme_settings_metaboxes', 'child_remove_metaboxes' );
/** 
 * Remove unused theme settings
 *
 * @param string $_genesis_theme_settings_pagehook Genesis Admin Pagehook.
 */
function child_remove_metaboxes( $_genesis_theme_settings_pagehook ) {
	remove_meta_box( 'genesis-theme-settings-version', $_genesis_theme_settings_pagehook, 'main' );
	remove_meta_box( 'genesis-theme-settings-feeds', $_genesis_theme_settings_pagehook, 'main' );
	remove_meta_box( 'genesis-theme-settings-header', $_genesis_theme_settings_pagehook, 'main' );
	remove_meta_box( 'genesis-theme-settings-layout', $_genesis_theme_settings_pagehook, 'main' );
	remove_meta_box( 'genesis-theme-settings-nav', $_genesis_theme_settings_pagehook, 'main' );
	remove_meta_box( 'genesis-theme-settings-breadcrumb', $_genesis_theme_settings_pagehook, 'main' );
	remove_meta_box( 'genesis-theme-settings-comments', $_genesis_theme_settings_pagehook, 'main' );
	remove_meta_box( 'genesis-theme-settings-posts', $_genesis_theme_settings_pagehook, 'main' );
	remove_meta_box( 'genesis-theme-settings-blogpage', $_genesis_theme_settings_pagehook, 'main' );
	remove_meta_box( 'genesis-theme-settings-scripts', $_genesis_theme_settings_pagehook, 'main' );
}

/** Force Superfish */
add_filter( 'genesis_pre_get_option_nav_superfish', '__return_true' );

/*
19 Alternative Doctype
---------------------------------------------------------------------------------------------------- */

remove_action( 'genesis_doctype', 'genesis_do_doctype' );
add_action( 'genesis_doctype', 'gs_do_doctype' );
/**
 * Conditional html element classes
 */
function child_do_doctype() {
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if lt IE 7 ]> <html class="ie6" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class="" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>> <!--<![endif]-->
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
    <?php
}

/*
20 
---------------------------------------------------------------------------------------------------- */



/*
21 Genesis Slider
---------------------------------------------------------------------------------------------------- */

//add_filter( 'genesis_slider_settings_defaults', 'gs_genesis_slider_defaults' );
/**
 * Set Genesis Slider Defaults
 *
 * @param array $defaults Original Genesis Slider defaults
 * @return array $defaults Modified Genesis Slider defaults
 */
function gs_genesis_slider_defaults( $defaults ) {
	$defaults['slideshow_arrows']        = 0;
	$defaults['slideshow_height']        = 380;
	$defaults['slideshow_width']         = 960;
	$defaults['slideshow_more_text']     = __( 'Xem', CHILD_DOMAIN );
	$defaults['slideshow_title_show']    = 1;
	$defaults['slideshow_excerpt_width'] = 360;
	$defaults['location_vertical']       = 'top';
	
	return $defaults;

}

/*
22 Avatars
---------------------------------------------------------------------------------------------------- */

//add_filter( 'avatar_defaults', 'gs_new_avatar' );
/**
 * 01, Add Custom Avatar (Discussion Settings)
 *
 * @param array $avatar_defaults WordPress default avatars
 * @return array $avatar_defaults Amended defaults
 */
function gs_new_avatar( $avatar_defaults ){
	$avatar_defaults[INCIPIO_ADMIN . '/images/genesis-48x48.png'] = __( 'New Avatar Name', 'incipio' );
	
	return $avatar_defaults;
}

//add_action( 'admin_init', 'gs_avatar_default' );
/**
 * 02, Set new avatar to be default. This also assumes that
 * user will never want mystery man to be the default.
 *
 */
function gs_avatar_default() {
	$default = get_option( 'avatar_default' );
	if ( ( empty( $default ) ) || ( 'mystery' == $default ) )
		$default = INCIPIO_ADMIN . '/images/genesis-48x48.png';
	update_option( 'avatar_default', $default );
}

add_action( 'genesis_register_sidebar_defaults', 'gs_register_sidebar_defaults' );
/**
 * 03, Customize Genesis Sidebar Defaults
 *
 * This function customizes the sidebar defaults. This function must be
 * placed before the initialization of Genesis since genesis_register_sidebar_defaults
 * is fired in the genesis_setup hook. Feel free to completely remove this function.
 *
 * @since 1.1.0
 *
 * @param  array $defaults Genesis sidebar defaults
 * @return array Modified Genesis sidebar defaults
 */
function gs_register_sidebar_defaults( $defaults ) {
	return array(
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'  => "</div></div>\n",
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => "</h4>\n",
	);
}

/** 04, Add post thumbnails to page post type */
// add_theme_support( 'post-thumbnails', array( 'page', ) );

/** 05, Simple Menu Registration */
// add_theme_support( 'genesis-menus', array( 'primary' => 'Primary Navigation Menuss' ) );

/** 06, Remove Genesis Menus */
// remove_theme_support( 'genesis-menus' );

/** 07, Remove Unused Page Layouts */
foreach ( array( 'content-sidebar-sidebar', 'sidebar-sidebar-content', 'sidebar-content-sidebar', 'sidebar-content', 'content-sidebar', 'full-width-content', ) as $layout ){
    genesis_unregister_layout( $layout );
}
/** 08, Add excerpts to page post type. */
// add_post_type_support( 'page', 'excerpt' );
	
/** 09 Remove Edit link */
	add_filter( 'genesis_edit_post_link', '__return_false' );
	
/** 
 * 20 Remove Unused User Settings 
 * Run with high priority to keep any contact methods added via plugins.
*/
add_filter( 'user_contactmethods', 'gs_contactmethods', 1 );
foreach ( array( 'genesis_user_options_fields', 'genesis_user_archive_fields', 'genesis_user_seo_fields', 'genesis_user_layout_fields', ) as $field ) {
    remove_action( 'show_user_profile', $field );
    remove_action( 'edit_user_profile', $field );
}

	/*
23 Excerpt/Content Limit/Content Read More
---------------------------------------------------------------------------------------------------- */

/** Completely remove excerpt more. */
//add_filter( 'excerpt_more', '__return__null' );
add_filter( 'excerpt_more', 'gs_remove_excerpt_more' );
/** 
 * Edit excerpt read more link
 *
 * @param  string $more Read More Text, , default: ' ' . '[...]'
 * @return string Modified Read More Text.
 */
function gs_remove_excerpt_more() {
	return '...';
}

add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
/**
 * limit text in homepage
 */
function custom_excerpt_length( $length ) {
    
    if(is_category())
        return 100;
    
    return 9;
}
add_filter( 'get_the_content_more_link', 'gs_read_more_link' );
add_filter( 'the_content_more_link', 'gs_read_more_link' );
/** 
 * Edit read more link.
 *
 * @param  string $link HTML Read More Link, default: sprintf( '&#x02026; <a href="%s" class="more-link">%s</a>', get_permalink(), $more_link_text = '(more...)' ).
 * @return string Modified HTML Read More Link.
 */
function gs_read_more_link( $link ) {
	return g_ent('&nbsp;').'<a class="more-link" href="' . get_permalink() . '" title="Read More">Xem tiếp &hellip;</a>';
}
