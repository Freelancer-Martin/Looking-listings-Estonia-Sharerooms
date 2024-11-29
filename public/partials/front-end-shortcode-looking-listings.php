<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}


function looking_listings_shortcode($atts = [], $content = null, $tag = '')
{


      // normalize attribute keys, lowercase
     $atts = array_change_key_case((array)$atts, CASE_LOWER);

     // override default attributes with user attributes
     $wporg_atts = shortcode_atts([
                                      'page_id' => '1',
                                  ], $atts, $tag);

     // start output
     $shortcode_container = '';
     $page_id = $wporg_atts['page_id'];
     // start box

     $shortcode_container .= '<div class="spartan-gallery-box">';

     //$page_id = $wporg_atts['page_id'];


     
     
      $argss = array(
          'posts_per_page' => -1,
          'post_type' => 'looking_listing',
          'fields' => 'ids'
      );

      
      $custom_posts = get_posts($argss);

   
      foreach ($custom_posts as $key => $value) {
         $meta = get_post_meta( $value );
         
         //print_r( get_post( $value )  );
         $get_post = get_post( $value );
         //print_r( $get_post );
         echo '<div style="padding: 20px;border: 1px solid black"  class="" >';
          echo '<span style="padding: 10px;" >'.get_the_post_thumbnail( $value ).'</span>';
          echo  '<a style="text-align:left;" href="'.$get_post->guid.'" >'.$get_post->post_name.'</a><span style="padding-top: 20px;padding-bottom: 30px;text-align:right;float: right;" >'.$get_post->post_date.'</span></br>';
          //echo  '<a href="'.$get_post->guid.'" >'.$get_post->post_modified.'</a></br>';
         echo '</div>';

      }


     // end box
     $shortcode_container .= '</div>';

     // return output
     return $shortcode_container;
}

/*
add_filter( 'single_template', 'override_single_template' );
function override_single_template( $single_template ){
    global $post;

    //$file = dirname(__FILE__) .'/templates/single-'. $post->post_type .'.php';
    //$file = require_once plugin_dir_path( dirname( __FILE__ ) ) . '/partials/content-listing.php';

    if( file_exists( $file ) ) $single_template = $file;

    return $single_template;
}



function wpdocs_filter_theme_page_templates( $page_templates, $post ) {
    $current_blog_id = get_current_blog_id();
    $food_blog_id    = 2;
 
    //if ( $current_blog_id != $food_blog_id ) {
        //if ( isset( $page_templates['content-single.php'] ) ) {
            unset( $page_templates['content-single.php'] );
        //}
    //}
    //return $page_templates;
    //print_r(   );
}
add_filter( 'theme_page_templates', 'wpdocs_filter_theme_page_templates', 20, 3 );
*/


function looking_listings_shortcodes_init()
{
    add_shortcode('display_looking_listings', 'looking_listings_shortcode');
}

add_action('init', 'looking_listings_shortcodes_init');
