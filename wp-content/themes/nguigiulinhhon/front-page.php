<?php

/**
 * Home Page.
 *
 * @category   Genesis_Sandbox
 * @package    Templates
 * @subpackage Home
 * @author     Travis Smith and Jonathan Perez, for Surefire Themes
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link       http://wpsmith.net/
 * @since      1.1.0
 */

add_action( 'get_header', 'gs_home_helper' );
add_action( 'genesis_loop', 'child_home_loop_helper' ); // Execute custom child loop
/**
 * Remove default loop. Execute child loop instead.
 *
 * @author Greg Rickaby
 * @since 1.0.0
 */
function child_home_loop_helper() { 
echo '<div id="home-body" class="home-body">';
?>

<!--Add our hero unit here so we can wrap the rest of the page content with a background-->
<section id="panels">
	<?php //get_template_part('parts/panels'); ?>
</section>

<?php } 
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function gs_home_helper() {

        if ( is_active_sidebar( 'content_one' )) {

                remove_action( 'genesis_loop', 'genesis_do_loop' );
                add_action( 'genesis_loop', 'gs_home_widgets' );
                
                /** Force Full Width */
                add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
                add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );
                
        }
}



/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function gs_home_widgets() {

    
		genesis_widget_area(
                'content_one', 
                array( 'before' => '<aside id="home-content-one" class="home-widget widget-area"><div class="row">', 
                        'after' => '</div></aside><!-- end #home-content-one -->', ) 
        );
		echo '<div class="clear"></div>';
}
genesis();