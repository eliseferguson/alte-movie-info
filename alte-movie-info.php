<?php
/**
* Plugin Name: ALTE IMDB Info
* Plugin URI: https://github.com/eliseferguson/alte-movie-info
* Description: A custom plugin to display movie information
* Version: 1.0.7
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
    		//get the code that the user inputed
            $alte_movie_code = esc_html($_POST['alte_movie_code']);

            //get the movie info based on the code
    		$alte_movie_movie = alte_movie_info_get_info($alte_movie_code);

            //get the image based on the code
            $url = $alte_movie_movie->{'Poster'};
            $post_id = 1;
            $desc = $alte_movie_movie->{'Title'} . ' Movie Poster';
            
            //check if image exists with the $desc as the title
            if( wp_exist_media_by_title( $desc ) != false ) {
                //media exist just return the attachment id
                // echo 'Media exists already <br/>';
                // echo $desc;
                
                $poster_attachment_id = wp_exist_media_by_title($desc);
            } else { 
                //media does not exist so upload it and return attachment id
                $poster_attachment_id = upload_movie_image( $url, $post_id, $desc );
                // echo 'The media does not exist <br/>';
                // echo $desc;
            }
 		
            //echo 'This should be the ID: ' . $poster_attachment_id;

            //put the movie info into the database
    		$options['alte_movie_code'] = $alte_movie_code;
    		$options['alte_movie_movie'] = $alte_movie_movie;
    		$options['last_updated'] = time();
            $options['poster_attachment_id'] = $poster_attachment_id;
            

    		update_option('alte_movie_movie', $options);
    	}
    	//echo $alte_movie_code;
    }

    $options = get_option('alte_movie_movie');
    if($options != '') {
    	$alte_movie_code = $options['alte_movie_code'];
    	$alte_movie_movie = $options['alte_movie_movie'];
        $poster_attachment_id = $options['poster_attachment_id'];
    }
    //var_dump( $alte_movie_movie );
    //echo 'Still have the id: ' . $poster_attachment_id;
	require('inc/options-page-wrapper.php');
}

function wp_exist_media_by_title( $title ) {
    global $wpdb;
    //egf this query isn't getting what it should
    //$return = $wpdb->get_row( "SELECT ID FROM wp_posts WHERE post_title = '" . $title . "' && post_status = 'publish' && post_type = 'attachment' ", 'ARRAY_N' );
    $return = $wpdb->get_row($wpdb->prepare("SELECT * FROM TpoyqsZMposts WHERE post_title = %s && post_type = 'attachment' limit 1", $title));
    //echo 'id: ' . $return->ID . '<br/>';
    
    if( empty( $return ) ) {
        return false;
    } else {
        //echo "Return: " . $return->ID . "<br/>";
        //return true;
        return $return->ID;
    }
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
        //egf what about attachment id?
        
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
    $poster_attachment_id = $options['poster_attachment_id'];
    
    
    $current_time = time();

    $update_difference = $current_time - $last_updated;
    if ( $udpate_difference > 86400 ) {
        $alte_movie_code = $options['alte_movie_code'];
        $options['alte_movie_movie'] = alte_movie_info_get_info($alte_movie_code);
        $options['last_updated'] = time();
        $options['poster_attachment_id'] = $poster_attachment_id;

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


function get_attachment_id_from_src ($image_src) {
  global $wpdb;
  $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
  $id = $wpdb->get_var($query);
  return $id;
}
function upload_movie_image( $url, $post_id, $desc ) {
    // Upload an Image
    $image = media_sideload_image($url, $post_id, $desc);
     
    // Remove any unwanted HTML, keep just a plain URL (or whatever is in the image src="..." )
    $image = preg_replace('/.*(?<=src=["\'])([^"\']*)(?=["\']).*/', '$1', $image);
    
    $attachment_id = get_attachment_id_from_src ($image);
    return $attachment_id;
}  
    

?>