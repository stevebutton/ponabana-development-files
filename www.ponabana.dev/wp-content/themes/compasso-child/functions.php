<?php
/**
 * override rating function from the parent theme,
 * to show a number instead of an image
 */
function g7_rating($rating, $size = '') {
	return sprintf(
		'<span class="custom-rating %s">%s</span>',
		$size,
		$rating
	);
}

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'custom_trim_excerpt');

function custom_trim_excerpt($text) { // Fakes an excerpt if needed
global $post;
if ( '' == $text ) {
$text = get_the_content('');
$text = apply_filters('the_content', $text);
$text = str_replace(']]>', ']]>', $text);
$text = strip_tags($text);
$excerpt_length = 30;
$words = explode(' ', $text, $excerpt_length + 1);
if (count($words) > $excerpt_length) {
array_pop($words);
array_push($words, '...');
$text = implode(' ', $words);
}
}
return $text;
}