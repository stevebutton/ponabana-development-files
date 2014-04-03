<?php
/*
Plugin Name: WPML Media
Plugin URI: http://wpml.org/
Description: Add multilingual support for Media files
Author: ICanLocalize
Author URI: http://wpml.org
Version: 2.1.3
*/

if (defined('WPML_MEDIA_VERSION')) {
	return;
}

define('WPML_MEDIA_VERSION', '2.1.3');
define('WPML_MEDIA_PATH', dirname(__FILE__));

require WPML_MEDIA_PATH . '/inc/constants.inc';
require WPML_MEDIA_PATH . '/inc/wpml-media-dependencies.class.php';
require WPML_MEDIA_PATH . '/inc/wpml-media-upgrade.class.php';
require WPML_MEDIA_PATH . '/inc/wpml-media.class.php';

global $WPML_media;
$WPML_media = new WPML_Media();
