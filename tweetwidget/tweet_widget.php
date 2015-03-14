<?php
/*
Plugin Name: Tweet Dashboard Widget
Plugin URI: https://github.com/jadran/TweetPostWidget
Description: Tweet posts from admin dashboard with post link
Version: 0.3
Author: Jadran Puharic
License: MIT
*/

/* Hook tweet_dashboard_widget to wordpress */
add_action('wp_dashboard_setup', 'register_tweet_dashboard_widget');

/* Add Dashboard Widget over add_meta_box() function - right column in dashboard */
function register_tweet_dashboard_widget() {
	add_meta_box(
		'dokuma_tweet_dashboard', 	// widget id
		'Tweet Post',								// widget name
		'tweet_dashboard_widget', 	// calling function
		'dashboard', 								// add to dashboard
		'side', 										// side = right column in dashboard
		'high' );										// add to top of right column
}

/* Main function of Tweet Post Widget */
function tweet_dashboard_widget() {
	wp_enqueue_script('tweet-post-ajax', plugin_dir_url( __FILE__ ) . 'js/main.js', array('jquery'), '1.0', true );
	/* localize script to get proper url path in main.js */
	wp_localize_script('tweet-post-ajax', 'url', array( "twitterpost_path" => plugin_dir_url( __FILE__ ) . 'twitterpost.php' ) );
?>
	<p>Paste url of your post...</p>
	<input type="text" name="post_url" id="post_url"style="margin: 0 0 8px; width: 100%;" autocomplete="off">
  <div id="submit-url-button"class="button button-primary">Tweet Post</div>
  <div id="tweet-status"></div>
<?php
}
