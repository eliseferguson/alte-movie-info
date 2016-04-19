<?php
/**
* Plugin Name: ALTE IMDB Info
* Plugin URI: https://github.com/eliseferguson/alte-movie-info
* Description: A custom plugin to display movie information
* Version: 1.0.6
* Author: Elise Ferguson
* Author URI: https://github.com/eliseferguson
* License: GPL2
**/

// Updater stuff
if( ! class_exists( 'Alte_Updater' ) ){
    include_once( plugin_dir_path( __FILE__ ) . 'updater.php' );
}
$updater = new Alte_Updater( __FILE__ );
$updater->set_username( 'eliseferguson' );
$updater->set_repository( 'alte-movie-info' );
/*
    $updater->authorize( 'abcdefghijk1234567890' ); // Your auth code goes here for private repos
*/
$updater->initialize();

// Asssign global variables

$plugin_url = WP_PLUGIN_URL . '/alte-movie-info';
$options = array();
$display_json = false;

// Add a link to the plugin in the admin menu under Settings
function alte_movie_info_menu() {
	add_options_page(
		'ALTE Movie Info Plugin',
		'Movie Info',
		'manage_options',
		'alte-movie-info',
		'alte_movie_info_options_page'
	);
}

add_action('admin_menu', 'alte_movie_info_menu');

function alte_movie_info_options_page() {
	if(!current_user_can('manage_options')) {
		wp_die('You do not have sufficient permissions to access this page.');
	}
    global $plugin_url;
    global $options;
    global $display_json;

    if(isset($_POST['alte_movie_code_form_submitted'])) {
    	$hidden_field = esc_html($_POST['alte_movie_code_form_submitted']);
    	if($hidden_field == 'Y') {
    		$alte_movie_code = esc_html($_POST['alte_movie_code']);

    		$alte_movie_movie = alte_movie_info_get_info($alte_movie_code);
    		
    		$options['alte_movie_code'] = $alte_movie_code;
    		$options['alte_movie_movie'] = $alte_movie_movie;
    		$options['last_updated'] = time();

    		update_option('alte_movie_movie', $options);
    	}
    	//echo $alte_movie_code;
    }

    $options = get_option('alte_movie_movie');
    if($options != '') {
    	$alte_movie_code = $options['alte_movie_code'];
    	$alte_movie_movie = $options['alte_movie_movie'];
    }
    //var_dump( $alte_movie_movie );
	require('inc/options-page-wrapper.php');
}

class alte_movie_Movie_Widget extends WP_Widget {

    function alte_movie_movie_widget() {
        // Instantiate the parent object
        parent::__construct( false, 'ALTE Movie Info Widget' );
    }

    function widget( $args, $instance ) {
        // Widget output

        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $show_plot = $instance['show_plot'];
        
        $options = get_option('alte_movie_movie');
        
        $alte_movie_info = $options['alte_movie_movie'];

        require('inc/front-end.php');
    }

    function update( $new_instance, $old_instance ) {
        // Save widget options
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['show_plot'] = strip_tags($new_instance['show_plot']);

        return $instance;
    }

    function form( $instance ) {
        // Output admin widget options form

        $title = esc_attr($instance['title']);
        $show_plot = esc_attr($instance['show_plot']);
        require('inc/widget-fields.php');
    }
}

function alte_movie_movie_register_widgets() {
    register_widget( 'alte_movie_Movie_Widget' );
}

add_action( 'widgets_init', 'alte_movie_movie_register_widgets' );


function alte_movie_info_shortcode($atts, $content = null) {
    
    global $post;
    
    extract(shortcode_atts( array(
            'plot' => 'yes'
    ), $atts));
    
    if($plot == 'yes') $plot = 1;
    if($plot == 'no') $plot = 0;
    
    $show_plot = $plot;
    
    $options = get_option('alte_movie_movie');
    $alte_movie_info = $options['alte_movie_movie'];

    ob_start();
    require('inc/front-end.php');
    $content = ob_get_clean();
    return $content;
} 
add_shortcode('alte_movie_info', 'alte_movie_info_shortcode');

function alte_movie_info_get_info($alte_movie_code) {
	
	$json_feed_url = 'http://www.omdbapi.com/?i=' . $alte_movie_code . '&plot=short&r=json';
	$args = array('timeout' => 120);

	$json_feed = wp_remote_get($json_feed_url, $args);
	$alte_movie_movie = json_decode($json_feed['body']);

	return $alte_movie_movie;
}

function alte_movie_info_refresh_movie() {
    $options = get_option('alte_movie_movie');
    $last_updated= $options['last_updated'];
    $current_time = time();

    $update_difference = $current_time - $last_updated;
    if ( $udpate_difference > 86400 ) {
        $alte_movie_code = $options['alte_movie_code'];
        $options['alte_movie_movie'] = alte_movie_info_get_info($alte_movie_code);
        $options['last_updated'] = time();

        update_option('alte_movie_info', $options);


    }

   die();
}
add_action('wp_ajax_alte_movie_info_refresh_movie', 'alte_movie_info_refresh_movie');

function alte_movie_info_enable_frontend_ajax() {
?>
        <script>    
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
        </script>
<?php
}
add_action('wp_head', 'alte_movie_info_enable_frontend_ajax');

function alte_movie_info_styles() {
	wp_enqueue_style('alte_movie_info_styles', plugins_url('alte-movie-info/alte-movie-info.css') );

}
add_action('admin_head', 'alte_movie_info_styles');

function alte_movie_info_frontend_scripts_and_styles() {

    
    wp_enqueue_script( 'alte_movie_info_js', plugins_url( 'alte-movie-info/alte-movie-info.js' ), array('jquery'), '', true );

}
add_action( 'wp_enqueue_scripts', 'alte_movie_info_frontend_scripts_and_styles' );


// function media_sideload_image_id( $file, $post_id, $desc = null, $return = 'src' ) {
//     if ( ! empty( $file ) ) {
 
//         // Set variables for storage, fix file filename for query strings.
//         preg_match( '/[^\?]+\.(jpe?g|jpe|gif|png)\b/i', $file, $matches );
//         if ( ! $matches ) {
//             return new WP_Error( 'image_sideload_failed', __( 'Invalid image URL' ) );
//         }
 
//         $file_array = array();
//         $file_array['name'] = basename( $matches[0] );
 
//         // Download file to temp location.
//         $file_array['tmp_name'] = download_url( $file );
 
//         // If error storing temporarily, return the error.
//         if ( is_wp_error( $file_array['tmp_name'] ) ) {
//             return $file_array['tmp_name'];
//         }
 
//         // Do the validation and storage stuff.
//         $id = media_handle_sideload( $file_array, $post_id, $desc );
 
//         // If error storing permanently, unlink.
//         if ( is_wp_error( $id ) ) {
//             @unlink( $file_array['tmp_name'] );
//             return $id;
//         }
 
//         $src = wp_get_attachment_url( $id );
//     }
 
//     // Finally, check to make sure the file has been saved, then return the HTML.
//     if ( ! empty( $src ) ) {
//         if ( $return === 'src' ) {
//             //return $src;
//             return $id;
//         }
 
//         $alt = isset( $desc ) ? esc_attr( $desc ) : '';
//         $html = "<img src='$src' alt='$alt' />";
//         return $html;
//     } else {
//         return new WP_Error( 'image_sideload_failed' );
//     }
// }

?>