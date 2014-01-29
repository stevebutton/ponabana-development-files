<?php
/*
Plugin Name:  wpRichFeeds
Description:  Adds a given Custom Field, a Post Thumbnail or the first image of the content, to your feed as an enclosure or a media:content record to your RSS and ATOM entries. Additionally, allows you to add an image to the head of your feeds.
Author:       Williams Castillo
Plugin URI:   http://williamscastillo.com/code/plugins/wprichfeeds
Author URI:   http://www.williamscastillo.com/
Donate link:  http://j.mp/WPRichFeeds
Version:      1.04

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

*/

define('RF_NICE_NAME'	,'wpRichFeeds');
define('RF_DOMAIN'		,'wprichfeeds');
define('RF_FOLDER'		, plugin_basename(dirname(__FILE__)));
define('RF_PATH'		, WP_CONTENT_DIR.'/plugins/'.plugin_basename(dirname(__FILE__)));
define('RF_URL'			, WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)));
define('RF_VERSION'		, '1.04');

define('CUSTOM_FIELD'	,'CustomField');
define('POST_THUMBNAIL'	,'PostThumbnail');
define('FIRST_IMAGE'	,'FirstImage');

if ( is_admin() ) {	
	load_plugin_textdomain(RF_DOMAIN, null,RF_DOMAIN.'/languages/');
	require_once(RF_PATH.'/admin.php');
	
	add_action('admin_init', 'wprichfeeds_init' );
	add_action('admin_menu', 'wprichfeeds_admin_menu');	
} else {
	require_once(RF_PATH.'/feeds.php');
	
	add_action('rss_head'	, 'wprichfeeds_rss_head');
	add_action('rss2_head'	, 'wprichfeeds_rss_head');
	add_action('atom_head'	, 'wprichfeeds_atom_head');
	
	add_action('rss2_item'	, 'wprichfeeds_rss_item' );
	add_action('atom_entry'	, 'wprichfeeds_atom_item' );
}

?>