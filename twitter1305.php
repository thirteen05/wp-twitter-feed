<?php

/*
Plugin Name: 	Twitter1305 Responsive Twitter User Timeline
Description: 	Responsive Twitter User Timeline for WordPress that allows you to drop in your API Key and API Secret, then display a custom Twitter user timeline based on the users Twitter screen name.
*/

//Stylesheet for admin page

wp_enqueue_style('twitter1305-admin-styles','/wp-content/plugins/twitter1305/css/twitter1305.css');

// create custom plugin settings menu
add_action('admin_menu', 'twitter1305_create_menu');

function twitter1305_create_menu() {

	//create new top-level menu
	add_menu_page('Twitter1305 Settings', 'Twitter1305 Settings', 'administrator', __FILE__, 'twitter1305_settings_page' , plugins_url('/images/icon.png', __FILE__) );

	//call register settings function
	add_action( 'admin_init', 'register_twitter1305_settings' );
}


function register_twitter1305_settings() {
	//register our settings
	register_setting( 'twitter1305-settings-group', 'twitterAPI' );
	register_setting( 'twitter1305-settings-group', 'twitterSecret' );
	register_setting( 'twitter1305-settings-group', 'twitterHandle' );
	register_setting( 'twitter1305-settings-group', 'tweetQuantity' );
}

function twitter1305_settings_page() {
	include 'views/admin_options.php';
}

function display_tweets(){

	include 'views/recent_tweets.php';

}

function twitter_api_init(){
	include 'vendor/autoload.php';
}

add_action('init', 'twitter_api_init');

?>