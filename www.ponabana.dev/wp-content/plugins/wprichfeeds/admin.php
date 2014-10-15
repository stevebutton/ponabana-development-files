<?php
/*
File Name:    admin.php
Description:  Helper functions for the backend operations of the wpRichFeeds plugin
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

function wprichfeeds_logme($message) {
    if (WP_DEBUG === true) {
        if (is_array($message) || is_object($message)) {
            error_log(print_r($message, true));
        } else {
            error_log($message);
        }
    }
}
 
function wprichfeeds_admin_menu() {
    $page_title = sprintf(__('%s v%s - Settings',RF_DOMAIN),RF_NICE_NAME,RF_VERSION);
    $menu_title = RF_NICE_NAME;
    $capability = 'manage_options';
    $menu_slug = 'wpRichFeeds';
    $function = 'wprichfeeds_settings';
    add_options_page($page_title, $menu_title, $capability, $menu_slug, $function);
}

function wprichfeeds_settings() {
    if (!current_user_can('manage_options')) {
        wp_die('You do not have sufficient permissions to access this page.');
    }
 
    // Here is where you could start displaying the HTML needed for the settings
    // page, or you could include a file that handles the HTML output for you.
?>

<div class="wrap">
	<h2><?php echo sprintf(__('%s v%s - Settings',RF_DOMAIN),RF_NICE_NAME,RF_VERSION); ?></h2>
	<div style="width: 30%; float: right">
		<h3><?php _e('News from the developer...',RF_DOMAIN); ?></h3>
		<?php include_once(ABSPATH.WPINC.'/rss.php');
		wp_rss('http://williamscastillo.com/code/feed', 5); ?><br/><br/>
		<h3><?php _e('wpRichFeeds Filters',RF_DOMAIN); ?></h3>
		<p><?php _e('<strong>wpRichFeeds</strong> provides three filters you can use to sanitize the post images:',RF_DOMAIN); ?>
			<ul style="margin-left:20px">
				<li><?php _e('<strong><em>wprichfeeds_image_filter: </em></strong>It receives an array which elements are url, size and type. Beat them!',RF_DOMAIN); ?> <?php _e('There are also other elements in case you need them: path, width, height, attr and mime.',RF_DOMAIN); ?></li>
				<li><?php _e('<strong><em>wprichfeeds_image_path: </em></strong>It receives the image fetched from a post. If you are having trouble finding the size or format of this image, try to sanitize it and return the path to the image, instead of a its URL.',RF_DOMAIN); ?></li>
				<li><?php _e('<strong><em>wprichfeeds_image_url: </em></strong>It receives the image fetched from a post. If you are having trouble finding the size or format of this image or even the image itself, try to sanitize it and return a URL relative to the web root.',RF_DOMAIN); ?></li>
			</ul>
		</p>
		<a href="#wprichfeeds_filter_example"><?php _e('Show me an example, please!',RF_DOMAIN); ?></a>
		<br/><br/>
		<form target="_ext" action="https://www.paypal.com/cgi-bin/webscr" method="post" style="text-align:center;">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="SAKV697NQ7K4J">
			<input type="image" src="https://www.paypalobjects.com/WEBSCR-640-20110306-1/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
			<img alt="" border="0" src="https://www.paypalobjects.com/WEBSCR-640-20110306-1/en_US/i/scr/pixel.gif" width="1" height="1">
		</form>
		<br/><br/>
		<h3><?php _e('wpRichFeeds Fetching Methods',RF_DOMAIN); ?></h3>
		<p><?php _e('The Fetching Method tells wpRichFeeds how to obtain the image of a given post. There are three methods supported so far:',RF_DOMAIN); ?>
			<ul style="margin-left:20px">
				<li><?php _e('<strong><em>First Image: </em></strong> (default) This method commands wpRichFeeds to fetch the first image it encounters inside the post and use it as the image for the feed item.',RF_DOMAIN); ?></li>
				<li><?php _e('<strong><em>Custom Field: </em></strong>You must specify the name of the Custom Field you are using to hold the images. It must exists within your domain.',RF_DOMAIN); ?></li>
				<li><?php echo sprintf(__('<strong><em>Post Thumbnail: </em></strong>If you theme supports Post Thumbnails (%s), wpRichFeeds could retrieve them and use them as the image of the feed items.',RF_DOMAIN),(current_theme_supports('post-thumbnails')?__('and it does',RF_DOMAIN):__('actually, <strong><a href="http://codex.wordpress.org/Post_Thumbnails#Enabling_Support_for_Post_Thumbnails" target="_ext" title="Enabling Support for Post Thumbnails ">it doesn\'t</a></strong>',RF_DOMAIN))); ?></li>
			</ul>
		</p>
	</div>	

<div style="width: 70%; float: left">
	<form method="post" action="options.php"> 
<?php settings_fields( 'wprichfeeds_options' ); ?>	    
<?php do_settings_sections( 'main' ); ?>
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		</p>
<?php do_settings_sections( 'uninstall' ); ?>
	</form>
</div>
<div class="clear"></div>
	
<div style="width: 30%; float: right">
	<h3><?php _e('wpRichFeeds Publishing Methods',RF_DOMAIN); ?></h3>
	<p><?php _e('The Publishing Method tells wpRichFeeds the way it should includes the image in the feed item. Currently, there are two methods supported for RSS feeds (ATOM feeds always uses the <strong>enclosure</strong> method):',RF_DOMAIN); ?>
		<ul style="margin-left:20px">
			<li><?php _e('<strong><em>enclosure: </em></strong>Use the standard enclosure method. There can be only one per feed entry (default).',RF_DOMAIN); ?></li>
			<li><?php _e('<strong><em>media:content: </em></strong>Use the Yahoo media:content parameter. There\'s no limit in the number of images per feed entry (useful if you include more than one attachment in your posts)',RF_DOMAIN); ?></li>
		</ul>
	</p>
	<br/><br/>
	<form target="_ext" action="https://www.paypal.com/cgi-bin/webscr" method="post" style="text-align:center;">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" value="SAKV697NQ7K4J">
		<input type="image" src="https://www.paypalobjects.com/WEBSCR-640-20110306-1/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" border="0" src="https://www.paypalobjects.com/WEBSCR-640-20110306-1/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>	
</div>
<div style="width: 70%; float: left"><a name="wprichfeeds_filter_example"></a>
	<h3><?php _e('wpRichFeeds Filters Example',RF_DOMAIN); ?></h3>
	<p>
	<?php 
		$mysite = get_bloginfo('url');
		$mysite = str_replace('http://www.','',$mysite);
		$mysite = str_replace('http://','',$mysite);
		$mysite = trim($mysite,'/') . '/';
		
		
	?>
	<?php _e('The following example is suppousely to be run from the functions.php file of your theme.',RF_DOMAIN); ?><br/>
	<?php _e('It is a fictional example! It MUST be adecuated to your needs.',RF_DOMAIN); ?><br/>
		<textarea readonly="readonly" rows="25" cols="50" class="large-text">
function my_path_filter($path) {
	if (substr($path,0,7) == 'http://') {
		$path = str_replace('http://','',$path);
	}
	if ( strpos($path,'/') !== false ) {
		$path = substr($path,strpos($path,'/')+1);
	} elseif ( strpos($path,'?') !== false ) {
		$path = 'index.php'.substr($path,strpos($path,'?'));
	}
	
	return '/home/public_html/'.$path;
}

function my_url_filter($url) {
	return '<?php bloginfo('url'); ?>/timthumb.php?src='.urlencode($url).'&amp;h=180&amp;w=250&amp;zc=1';
}

function my_image_filter($image_array) {
	$image_array['width'] = 250;
	$image_array['height'] = 180;
	return $image_array;
}

add_filter('wprichfeeds_image'		,'my_image_filter');
add_filter('wprichfeeds_image_path'	,'my_path_filter');
add_filter('wprichfeeds_image_url'	,'my_url_filter');
</textarea>			
	</p>
</div>

</div>
<?php
}

function wprichfeeds_show_header_section() {
	$options = get_option('wprichfeeds');
	echo '<p>'.__('Provide the URL of the main image you want to show at the header of your RSS/ATOM feeds.',RF_DOMAIN).'</p>';
}

function wprichfeeds_show_post_section() {
	$options = get_option('wprichfeeds');
	echo '<p>'.__('Please, define the way how the plugin should behave at post level.',RF_DOMAIN).'</p>';
}

function wprichfeeds_show_uninstall_section() {
	_e('Check this box if you are planning to completelly deactivate this plugin. It will remove all its data the next time you deactivate it, otherwise, the data will be kept in your database for the next time you decide to activate it.',RF_DOMAIN);
}

function wprichfeeds_show_field($config) {	
	$options = get_option('wprichfeeds');

	if ( substr($config['value'],0,1) == '=' ) {
		$config['value'] = $options[substr($config['value'],1)];
	}
	
	switch ( $config['type'] ) {
		case 'radio':
			$items = $config['items'];
			foreach($items as $value => $label) {				
				$checked = ($config['value']==$value) ? ' checked="checked" ' : '';
				echo '<label><input  class="'.$config['class'].'" '.$checked.' value="'.$config['value'].'" name="'.$config['name'].'" type="radio" />'.$label.'</label><br />';
			}
		break;
		case 'checkbox':
			$checked = ( strtoupper($config['value']) == 'ON') ? ' checked="checked" ' : '';
			echo '<input '.$checked.' class="'.$config['class'].'" id="'.$config['id'].'" name="'.$config['name'].'" type="checkbox" value="ON" />';
		break;
		case 'password':
			echo '<input class="'.$config['class'].'" id="'.$config['id'].'" name="'.$config['name'].'"  type="password" value="'.$config['value'].'" />';
		break;
		case 'textarea':
			echo '<textarea id="'.$config['id'].'" name="'.$config['name'].'" rows="'.$config['rows'].'" cols="'.$config['cols'].'" type="textarea">'.$config['value'].'</textarea>';
		break;
		case 'select':
			$items = $config['items'];
			echo '<select class="'.$config['class'].'" id="'.$config['id'].'" name="'.$config['name'].'">';
			foreach($items as $value => $label) {
				$selected = ($config['value']==$value) ? 'selected="selected"' : '';
				echo '<option value="'.$value.'" '.$selected.'>'.$label.'</option>';
			}
			echo "</select>";
		break;
		case 'text':
		default:
			echo '<input class="'.$config['class'].'" id="'.$config['id'].'" name="'.$config['name'].'"  type="text" value="'.$config['value'].'" />';
		break;
	}
	if ($config['description'] != '') {
		echo '<br />'.$config['extra'].'<span class="description">'.$config['description'].'</span>';
	}
}

function wprichfeeds_init() {
	register_setting( 'wprichfeeds_options', 'wprichfeeds' );
	$options = get_option('wprichfeeds');
		
	$logo_img 	= '';
	$icon_img	= '';
	
	if ( $options['logo']) {
		$logo_img = '<img style="float: right;margin: 5px;max-width: 300px;" src="'.$options['logo'].'" alt="Logo" />';
	}
	if ( $options['icon']) {
		$icon_img = '<img style="float: right;margin: 5px;max-width: 150px;" src="'.$options['icon'].'" alt="icon" />';
	}
	
	$page 		= 'main';
	$section 	= 'header_fields';
	add_settings_section($section,				 	__('Header Image',RF_DOMAIN)	, 'wprichfeeds_show_header_section', $page);
		add_settings_field(
			'wprichfeeds-logo',		
			__('RSS/ATOM Logo URL',RF_DOMAIN)	, 
			'wprichfeeds_show_field', 
			$page, 
			$section, 
			array( 
				'id'=>'wprichfeeds-logo', 
				'type'=>'text',
				'name'=>'wprichfeeds[logo]',
				'value'=>'=logo', 
				'size'=>40, 
				'description'=>__('Introduce the URL to the image you want to be the main image of the feed (probably your logo).',RF_DOMAIN).'<br /><p><strong>'.sprintf(__('*** MUST BEGIN WITH: %s',RF_DOMAIN),get_bloginfo('url')).'</strong></p>',
				'class'=>'large-text',
				'extra' => $logo_img
				)
		);		 
		add_settings_field(
			'wprichfeeds-icon',		
			__('ATOM Icon URL',RF_DOMAIN)	, 
			'wprichfeeds_show_field', 
			$page, 
			$section, 
			array( 
				'id'=>'wprichfeeds-icon', 
				'type'=>'text',
				'name'=>'wprichfeeds[icon]',
				'value'=>'=icon', 
				'size'=>40, 
				'description'=>__('This icon will be used in ATOM feeds.',RF_DOMAIN).'<br /><p><strong>'.sprintf(__('*** MUST BEGIN WITH: %s',RF_DOMAIN),get_bloginfo('url')).'</strong></p>',
				'class'=>'large-text',
				'extra' => $icon_img
				)
		);
	
	$section 	= 'posts_fields';
	add_settings_section($section,				 	__('Post Images',RF_DOMAIN)		, 'wprichfeeds_show_post_section', $page);
		add_settings_field(
			'wprichfeeds-fetch',		
			__('Fetching Method',RF_DOMAIN)	, 
			'wprichfeeds_show_field', 
			$page, 
			$section, 
			array( 
				'id'=>'wprichfeeds-fetch', 
				'type'=>'select',
				'name'=>'wprichfeeds[fetch]',
				'value'=>'=fetch', 
				'size'=>40, 
				'description'=>__('Specify the primary method to use to obtain the image for a given post. If the image couldn\'t be found, the other methods will be used.',RF_DOMAIN), 
				'class'=>'', 
				'items'=> array( 
							'CustomField' => __('Custom Field',RF_DOMAIN), 
							'PostThumbnail'=> __('Post Thumbnail',RF_DOMAIN), 
							'FirstImage'=>__('First Image',RF_DOMAIN)
						)
				)
		);
		add_settings_field(
			'wprichfeeds-cfield',		
			__('Custom Field Name',RF_DOMAIN)	, 
			'wprichfeeds_show_field', 
			$page, 
			$section, 
			array( 
				'id'=>'wprichfeeds-cfield', 
				'type'=>'text',
				'name'=>'wprichfeeds[cfield]',
				'value'=>'=cfield', 
				'size'=>40, 
				'description'=>__('Custom Field name that holds the URL of the images in each post, if Custom Field was selected as the Fetching Method.',RF_DOMAIN), 
				'class'=>'regular-text'
				)
		);
		add_settings_field(
			'wprichfeeds-publish',		
			__('RSS Publishing Method',RF_DOMAIN)	, 
			'wprichfeeds_show_field', 
			$page, 
			$section, 
			array( 
				'id'=>'wprichfeeds-publish', 
				'type'=>'select',
				'name'=>'wprichfeeds[publish]',
				'value'=>'=publish', 
				'size'=>40, 
				'description'=>__('Specify the method how the image will be included in the feed.',RF_DOMAIN), 
				'class'=>'', 
				'items'=> array( 
							'enclosure' => __('enclosure (1 per feed entry)',RF_DOMAIN),
							'media:content' => __('media:content (may contain multiple instances per entry)',RF_DOMAIN),
						)
				)
		);
	$page 		= 'uninstall';
	$section 	= 'uninstall_fields';
	add_settings_section($section,				 	__('Uninstall Plugin',RF_DOMAIN)		, 'wprichfeeds_show_uninstall_section', $page);
		add_settings_field(
			'wprichfeeds-uninstall',		
			'<em style="float: right">'.__('Yeah! Zap it!',RF_DOMAIN).'</em>', 
			'wprichfeeds_show_field', 
			$page, 
			$section, 
			array( 
				'id'=>'wprichfeeds-uninstall', 
				'type'=>'checkbox',
				'name'=>'wprichfeeds[uninstall]',
				'value'=>'=uninstall', 
				'class'=>''
				)
		);
}

?>