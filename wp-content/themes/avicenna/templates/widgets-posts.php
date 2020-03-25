<?php
/**
 * The template to display posts in widgets and/or in the search results
 *
 * @package WordPress
 * @subpackage AVICENNA
 * @since AVICENNA 1.0
 */

$avicenna_post_id    = get_the_ID();
$avicenna_post_date  = avicenna_get_date();
$avicenna_post_title = get_the_title();
$avicenna_post_link  = get_permalink();
$avicenna_post_author_id   = get_the_author_meta('ID');
$avicenna_post_author_name = get_the_author_meta('display_name');
$avicenna_post_author_url  = get_author_posts_url($avicenna_post_author_id, '');

$avicenna_args = get_query_var('avicenna_args_widgets_posts');
$avicenna_show_date = isset($avicenna_args['show_date']) ? (int) $avicenna_args['show_date'] : 1;
$avicenna_show_image = isset($avicenna_args['show_image']) ? (int) $avicenna_args['show_image'] : 1;
$avicenna_show_author = isset($avicenna_args['show_author']) ? (int) $avicenna_args['show_author'] : 1;
$avicenna_show_counters = isset($avicenna_args['show_counters']) ? (int) $avicenna_args['show_counters'] : 1;
$avicenna_show_categories = isset($avicenna_args['show_categories']) ? (int) $avicenna_args['show_categories'] : 1;

$avicenna_output = avicenna_storage_get('avicenna_output_widgets_posts');

$avicenna_post_counters_output = '';
if ( $avicenna_show_counters ) {
	$avicenna_post_counters_output = '<span class="post_info_item post_info_counters">'
								. avicenna_get_post_counters('comments')
							. '</span>';
}


$avicenna_output .= '<article class="post_item with_thumb">';

if ($avicenna_show_image) {
	$avicenna_post_thumb = get_the_post_thumbnail($avicenna_post_id, avicenna_get_thumb_size('tiny'), array(
		'alt' => get_the_title()
	));
	if ($avicenna_post_thumb) $avicenna_output .= '<div class="post_thumb">' . ($avicenna_post_link ? '<a href="' . esc_url($avicenna_post_link) . '">' : '') . ($avicenna_post_thumb) . ($avicenna_post_link ? '</a>' : '') . '</div>';
}

$avicenna_output .= '<div class="post_content">'
			. ($avicenna_show_categories 
					? '<div class="post_categories">'
						. avicenna_get_post_categories()
						. $avicenna_post_counters_output
						. '</div>' 
					: '')
			. '<h6 class="post_title">' . ($avicenna_post_link ? '<a href="' . esc_url($avicenna_post_link) . '">' : '') . ($avicenna_post_title) . ($avicenna_post_link ? '</a>' : '') . '</h6>'
			. apply_filters('avicenna_filter_get_post_info', 
								'<div class="post_info">'
									. ($avicenna_show_date 
										? '<span class="post_info_item post_info_posted">'
											. ($avicenna_post_link ? '<a href="' . esc_url($avicenna_post_link) . '" class="post_info_date">' : '') 
											. esc_html($avicenna_post_date) 
											. ($avicenna_post_link ? '</a>' : '')
											. '</span>'
										: '')
									. ($avicenna_show_author 
										? '<span class="post_info_item post_info_posted_by">' 
											. esc_html__('by', 'avicenna') . ' ' 
											. ($avicenna_post_link ? '<a href="' . esc_url($avicenna_post_author_url) . '" class="post_info_author">' : '') 
											. esc_html($avicenna_post_author_name) 
											. ($avicenna_post_link ? '</a>' : '') 
											. '</span>'
										: '')
									. (!$avicenna_show_categories && $avicenna_post_counters_output
										? $avicenna_post_counters_output
										: '')
								. '</div>')
		. '</div>'
	. '</article>';
avicenna_storage_set('avicenna_output_widgets_posts', $avicenna_output);
?>