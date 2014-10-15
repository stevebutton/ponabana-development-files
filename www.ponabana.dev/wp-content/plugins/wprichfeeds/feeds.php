<?php
/*
File Name:    feeds.php
Description:  Helper functions for the frontend operations of the wpRichFeeds plugin
Plugin URI:   http://williamscastillo.com/code/plugins/wprichfeeds
Author URI:   http://www.williamscastillo.com/
Author:       Williams Castillo

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

*/

function wprichfeeds_process_image_url($image_url) {
	$i = array();
	
	if ($image_url != '' ) {
		$i['url'] 	= '';
		$i['path'] 	= '';
		$i['size'] 	= '';
		$i['type']	= '';
		$i['width'] = '';
		$i['height']= '';
		$i['attr'] 	= '';
		$i['mime'] 	= '';
		
		$i['url'] 	= apply_filters('wprichfeeds_image_url',$image_url);
		$i['path'] = apply_filters('wprichfeeds_image_path',$image_url);		
		
		if (trim($i['path']) != '')
			list($i['width'], $i['height'], $i['type'], $i['attr'], $i['mime']) = getimagesize($i['path']);			
			
		if (trim($i['type']) != '')
			$i['type'] = image_type_to_mime_type($i['type']);
		elseif (version_compare( phpversion(), '4.3.0', '>=' ))
			$i['type'] = $i['mime'];
		
		if ( substr($i['url'],0,strlen(get_bloginfo('url')) == get_bloginfo('url') ) ) {
			if (version_compare( phpversion(), '5.0', '>=' )) {
				try {
				    $i['size']	= filesize($i['path']);
				} catch (Exception $e) {
					// 
				}
			} else {
				if ( filesize($i['path']) !== false) {
					$i['size']	= filesize($i['path']);
				}
			}
		}
	}
	
	return $i;
}

function wprichfeeds_fetch_custom_field($post) {
	$options = get_option('wprichfeeds');
	
	$image = '';
	$custom_field = $options['cfield'];
	if ( trim($custom_field) ) {
		$image = get_post_meta($post->ID, $custom_field, $single = true); 
	}
	
	return wprichfeeds_process_image_url($image);
}

function wprichfeeds_fetch_first_image($post) {
	/*
	ob_start();
	ob_end_clean();
	*/
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);	
	$image = $matches [1][0];
	
	return wprichfeeds_process_image_url($image);
}

function wprichfeeds_fetch_post_thumbnail($post) {
	$image = '';
	
	if ( $image_id = get_post_thumbnail_id($post->ID) ) {
		$image = wp_get_attachment_url( $image_id );
	}	
	
	return wprichfeeds_process_image_url($image);
}

function wprichfeeds_get_image() {
global $post;
	$options = get_option('wprichfeeds');
	if ( !isset($options['fetch']) ) {
		$options['fetch'] = FIRST_IMAGE;
	}
	
	$i = array();
	
	$methods = array(FIRST_IMAGE, POST_THUMBNAIL, CUSTOM_FIELD);	
		if ( !has_post_thumbnail($post->ID) ) {
			unset($methods[POST_THUMBNAIL]);
		}
	
		$key = array_keys($methods,$options['fetch']);
		if (count($key) ) {
			unset($methods[$key[0]]);
			array_unshift($methods,$options['fetch']);
		}
	
	foreach ($methods as $method) {
		switch ($method) {
			case FIRST_IMAGE:			
				$i = wprichfeeds_fetch_first_image($post);
			break;
			case POST_THUMBNAIL:
				$i = wprichfeeds_fetch_post_thumbnail($post);
			break;
			case CUSTOM_FIELD:
				$i = wprichfeeds_fetch_custom_field($post);
			break;
		}		
		if ( count($i) ) break;
	}
	
	if ( count($i) ) {
		$i = apply_filters('wprichfeeds_image',$i);
	}
	return $i;
}

// RSS/RSS2 Functions
function wprichfeeds_rss_head() {
	$options 	= get_option('wprichfeeds');	
	
	$logo 		= $options['logo'];		
	if($logo) {
		list($logo_w, $logo_h, $file_type, $file_attr) = getimagesize($logo);		
		
		if ( $logo_w > 144 ) $logo_w = 144;
		
		echo '
<image>
	<title>'.get_bloginfo('name').'</title>
	<url>'.$logo. '</url>
	<link>'.get_bloginfo('wpurl').'
</link>';
		
		if($logo_w)
			echo '
<width>'.$logo_w.'</width>';
		if($logo_h)
			echo '
<height>'.$logo_h .'</height>';
			
		echo '
<description>'.get_bloginfo('name').' - '.get_bloginfo('description').'</description>
</image>';
	}
}

function wprichfeeds_rss_item() {
global $post;
	$options = get_option('wprichfeeds');
	
	$image = wprichfeeds_get_image();	
	if ( count($image) ) {
		switch (strtolower($options['publish'])) {
			case 'media:content':
				echo '
		<media:group xmlns:media="http://search.yahoo.com/mrss">
			<media:content xmlns:media="http://search.yahoo.com/mrss"
				url="'.$image['url'].'"
				medium="image"';
				if ($image['size'] != '') echo 'fileSize="'.$image['size'].'"';
				echo '
				fileSize="'.$image['size'].'"
				isDefault="true"
				type="'.$image['type'].'"
				width="'.$image['width'].'"
				height="'.$image['height'].'" />
			<media:title  xmlns:media="http://search.yahoo.com/mrss">'.$post->post_title.'</media:title>
		</media:group>
';
			break;			
		
			case 'enclosure':
			default:		
				echo '
			<enclosure>
				<url>'.$image['url'].'</url>';
				if ($image['size'] != '') echo '<length>'.$image['size'].'</length>';
				echo '
				<type>'.$image['type'].'</type>
			</enclosure>
';
			break;
		}
	}
}

// Atom Functions
function wprichfeeds_atom_head() {
	$options 	= get_option('wprichfeeds');	
	
	$logo 		= $options['logo'];
	$icon 		= $options['icon'];
	
	if($logo)
		echo '<logo>'.$logo.'</logo>';
	if($icon)
		echo '<icon>'.$icon .'</icon>';
}

function wprichfeeds_atom_item() {
global $post;
	$options = get_option('wprichfeeds');
	
	$image = wprichfeeds_get_image();	
	if ( count($image) ) {
		switch (strtolower($options['publish'])) {	
			case 'media:content':
			case 'enclosure':
			default:
				echo '
		<link rel="enclosure" 
              href="'.$image['url'].'"';
				if ($image['size'] != '') echo 'length="'.$image['size'].'"';
				echo '              
              type="'.$image['type'].'"
              hreflang="'.WPLANG.'" />
';
			break;
		}
	}
}


?>