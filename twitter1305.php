<?php

/*
Plugin Name: 	Twitter1305 Responsive Twitter User Timeline
Description: 	Responsive Twitter User Timeline for WordPress that allows you to drop in your API Key and API Secret, then display a custom Twitter user timeline based on the users Twitter screen name.
*/

use Abraham\TwitterOAuth\TwitterOAuth;

//Stylesheet for admin page

wp_enqueue_style('twitter1305-admin-styles','/wp-content/plugins/twitter1305/css/twitter1305.css');

// create custom plugin settings menu
add_action('admin_menu', 'twitter1305_create_menu');

function twitter1305_create_menu() {

//create new top-level menu
add_menu_page('Twitter1305 Settings', 'Twitter1305', 'administrator', __FILE__, 'twitter1305_settings_page' , '
dashicons-welcome-widgets-menus' );

}

//call register settings function
add_action( 'admin_init', 'register_twitter1305_settings' );


function register_twitter1305_settings() {
	//register our settings
	register_setting( 'twitter1305-settings-group', 'twitterAPI' );
	register_setting( 'twitter1305-settings-group', 'twitterSecret' );
	register_setting( 'twitter1305-settings-group', 'twitterHandle' );
	register_setting( 'twitter1305-settings-group', 'tweetQuantity' );
	register_setting( 'twitter1305-settings-group', 'tweetExcludeReplies' );
  
}

function twitter1305_settings_page() {
	include 'views/admin_options.php';
}

function display_tweets(){

	include 'views/recent_tweets.php';

}

//Initialize the TwitterOAuth API through Composer autoload.php

function twitter_api_init(){
	include 'vendor/autoload.php';
}

add_action('init', 'twitter_api_init');

function get_twitter1305(){
  
    //Twitter API Configuration
    $twitterHandle = get_option('twitterHandle');
    $tweetQuantity = intval( get_option('tweetQuantity') );
    $consumerKey = get_option('twitterAPI');
    $consumerSecret = get_option('twitterSecret');
    $accessToken = "";
    $accessTokenSecret = ""; 

    if($twitterHandle && $consumerKey && $consumerSecret) {
          //Authentication with twitter
          $twitterConnection = new TwitterOAuth(
              $consumerKey,
              $consumerSecret,
              $accessToken,
              $accessTokenSecret
          );
          //Get user timeline feeds
          $twitterData = $twitterConnection->get(
              'statuses/user_timeline',
              array(
                  'screen_name'     => $twitterHandle,
                  'count'           => $tweetQuantity
              )
          );

          return $twitterData;

    }
  
}

function linkify_tweet($tweetText){
  
  
    $tweetText = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a href="http://$1" target="_blank">http://$1</a>', $tweetText);
    $tweetText = preg_replace('/https:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a href="http://$1" target="_blank">https://$1</a>', $tweetText);
    $tweetText = preg_replace('/@([a-z0-9_]+)/i', '<a class="tweet-author" href="http://twitter.com/$1" target="_blank">@$1</a>', $tweetText);
  
    return $tweetText;
  
}

?>