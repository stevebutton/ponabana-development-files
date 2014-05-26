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
//allow html in author bio
remove_filter('pre_user_description', 'wp_filter_kses');  
add_filter( 'pre_user_description', 'wp_filter_post_kses' );

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'custom_trim_excerpt');

remove_filter('template_redirect', 'redirect_canonical');

add_filter( 'post_thumbnail_html', 'my_post_image_html', 10, 3 );

function my_post_image_html( $html, $post_id, $post_image_id ) {

  $html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '">' . $html . '</a>';
  return $html;

}

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