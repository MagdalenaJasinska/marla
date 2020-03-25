<?php
/**
 * The Portfolio template to display the content
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

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_portfolio_'.esc_attr($avicenna_columns).' post_format_'.esc_attr($avicenna_post_format).(is_sticky() && !is_paged() ? ' sticky' : '') ); ?>
	<?php echo (!avicenna_is_off($avicenna_animation) ? ' data-animation="'.esc_attr(avicenna_get_animation_classes($avicenna_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	$avicenna_image_hover = avicenna_get_theme_option('image_hover');
	// Featured image
	avicenna_show_post_featured(array(
		'thumb_size' => avicenna_get_thumb_size(strpos(avicenna_get_theme_option('body_style'), 'full')!==false || $avicenna_columns < 3 
								? 'masonry-big' 
								: 'masonry'),
		'show_no_image' => true,
		'class' => $avicenna_image_hover == 'dots' ? 'hover_with_info' : '',
		'post_info' => $avicenna_image_hover == 'dots' ? '<div class="post_info">'.esc_html(get_the_title()).'</div>' : ''
	));
	?>
</article>