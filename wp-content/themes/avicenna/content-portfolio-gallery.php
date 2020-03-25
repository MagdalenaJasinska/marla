<?php
/**
 * The Gallery template to display posts
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage AVICENNA
 * @since AVICENNA 1.0
 */

$avicenna_blog_style = explode('_', avicenna_get_theme_option('blog_style'));
$avicenna_columns = empty($avicenna_blog_style[1]) ? 2 : max(2, $avicenna_blog_style[1]);
$avicenna_post_format = get_post_format();
$avicenna_post_format = empty($avicenna_post_format) ? 'standard' : str_replace('post-format-', '', $avicenna_post_format);
$avicenna_animation = avicenna_get_theme_option('blog_animation');
$avicenna_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_gallery post_layout_gallery_'.esc_attr($avicenna_columns).' post_format_'.esc_attr($avicenna_post_format) ); ?>
	<?php echo (!avicenna_is_off($avicenna_animation) ? ' data-animation="'.esc_attr(avicenna_get_animation_classes($avicenna_animation)).'"' : ''); ?>
	data-size="<?php if (!empty($avicenna_image[1]) && !empty($avicenna_image[2])) echo intval($avicenna_image[1]) .'x' . intval($avicenna_image[2]); ?>"
	data-src="<?php if (!empty($avicenna_image[0])) echo esc_url($avicenna_image[0]); ?>"
	>

	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	$avicenna_image_hover = 'icon';
	if (in_array($avicenna_image_hover, array('icons', 'zoom'))) $avicenna_image_hover = 'dots';
	$avicenna_components = avicenna_is_inherit(avicenna_get_theme_option_from_meta('meta_parts')) 
								? 'categories,date,counters,share'
								: avicenna_array_get_keys_by_value(avicenna_get_theme_option('meta_parts'));
	$avicenna_counters = avicenna_is_inherit(avicenna_get_theme_option_from_meta('counters')) 
								? 'comments'
								: avicenna_array_get_keys_by_value(avicenna_get_theme_option('counters'));
	avicenna_show_post_featured(array(
		'hover' => $avicenna_image_hover,
		'thumb_size' => avicenna_get_thumb_size( strpos(avicenna_get_theme_option('body_style'), 'full')!==false || $avicenna_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only' => true,
		'show_no_image' => true,
		'post_info' => '<div class="post_details">'
							. '<h2 class="post_title"><a href="'.esc_url(get_permalink()).'">'. esc_html(get_the_title()) . '</a></h2>'
							. '<div class="post_description">'
								. (!empty($avicenna_components)
										? avicenna_show_post_meta(apply_filters('avicenna_filter_post_meta_args', array(
											'components' => $avicenna_components,
											'counters' => $avicenna_counters,
											'seo' => false,
											'echo' => false
											), $avicenna_blog_style[0], $avicenna_columns))
										: '')
								. '<div class="post_description_content">'
									. apply_filters('the_excerpt', get_the_excerpt())
								. '</div>'
								. '<a href="'.esc_url(get_permalink()).'" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__('Learn more', 'avicenna') . '</span></a>'
							. '</div>'
						. '</div>'
	));
	?>
</article>