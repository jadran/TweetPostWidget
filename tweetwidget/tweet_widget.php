<?php
/*
Plugin Name: Tweet Dashboard Widget
Plugin URI: www.melange.hr
Description: Tweet posts from dashboard with link to site post (translate source to english for international use)
Version: 0.1
Author: Jadran Puharic
License: MIT
*/
/**
 * hook dokuma_tweet u wordpress
 */
add_action('wp_dashboard_setup', 'register_dokuma_tweet_widget_setup');

/**
 * dodaj Dashboard Widget priko add_meta_box() funkcije - desni dio dashboarda!
 */
function register_dokuma_tweet_widget_setup() {
	add_meta_box( 
		'dokuma_tweet_dashboard',  // id widgeta
		'DokuMA Tweet Post',     // ime widgeta
		'dokuma_tweet_widget',   // pozvana funkcija
		'dashboard', 
		'side', 
		'high' );
}

/**
 * Glavna funkcija dokuma tweet-a
 */
function dokuma_tweet_widget() {
	echo 'Nesto cu tu vec napisat...';
	echo '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>';
	echo '<script type="text/javascript" src="../wp-content/plugins/tweetwidget/js/main.js"></script>';
	
	echo '<div class="inside"">
	<textarea name="post_url" id="post_url" rows="1" style="width: 100%;"></textarea>
	<span id="post_url-info" class="info"></span><br/>
    <button name="submit" class="button button-primary" onClick="sendTweet();">Tweet Post</button>
    <div id="tweet-status"></div>
	</div>';			
}
