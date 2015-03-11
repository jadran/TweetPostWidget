<?php
/*
Plugin Name: Tweet Dashboard Widget
Plugin URI: www.melange.hr
Description: Tweet posts from dashboard with post link
Version: 0.1
Author: Jadran Puharic
License: MIT
*/
/**
 * hook dokuma_tweet to wordpress
 */
add_action('wp_dashboard_setup', 'register_dokuma_tweet_widget_setup');

/**
 * Add Dashboard Widget over add_meta_box() function - desni dio dashboarda
 */
function register_dokuma_tweet_widget_setup() {
	add_meta_box( 
		'dokuma_tweet_dashboard',  // widget id
		'Tweet Post Widget',     // widget name
		'dokuma_tweet_widget',   // calling function
		'dashboard', 
		'side', 
		'high' );
}

/**
 * Main function Tweet Post Widget
 */
function dokuma_tweet_widget() {
	
    wp_enqueue_script('tweet-post-ajax', plugin_dir_url( __FILE__ ) . 'js/main.js', array('jquery'), '1.0', true );
?>	
	
	<p>Write or Paste url of your post...</p>
	<input type="text" name="post_url" id="post_url"style="margin: 0 0 8px; width: 100%;" autocomplete="off">
    <div id="submit-url-button"class="button button-primary">Tweet Post</div>
    <div id="tweet-status"></div>
	
<?php
}
