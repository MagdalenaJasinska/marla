<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage AVICENNA
 * @since AVICENNA 1.0
 */

$avicenna_blog_style = explode('_', avicenna_get_theme_option('blog_style'));
$avicenna_columns = empty($avicenna_blog_style[1]) ? 2 : max(2, $avicenna_blog_style[1]);
$avicenna_expanded = !avicenna_sidebar_present() && avicenna_is_on(avicenna_get_theme_option('expand_content'));
$avicenna_post_format = get_post_format();
$avicenna_post_format = empty($avicenna_post_format) ? 'standard' : str_replace('post-format-', '', $avicenna_post_format);
$avicenna_animation = avicenna_get_theme_option('blog_animation');
$avicenna_components = avicenna_is_inherit(avicenna_get_theme_option_from_meta('meta_parts')) 
							? 'date,counters'
							: avicenna_array_get_keys_by_value(avicenna_get_theme_option('meta_parts'));
$avicenna_counters = avicenna_is_inherit(avicenna_get_theme_option_from_meta('counters')) 
							? 'comments'
							: avicenna_array_get_keys_by_value(avicenna_get_theme_option('counters'));

?><div class="<?php echo esc_html($avicenna_blog_style[0] == 'classic' ? 'column' : 'masonry_item masonry_item'); ?>-1_<?php echo esc_attr($avicenna_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_format_'.esc_attr($avicenna_post_format)
					. ' post_layout_classic post_layout_classic_'.esc_attr($avicenna_columns)
					. ' post_layout_'.esc_attr($avicenna_blog_style[0]) 
					. ' post_layout_'.esc_attr($avicenna_blog_style[0]).'_'.esc_attr($avicenna_columns)
					); ?>
	<?php echo (!avicenna_is_off($avicenna_animation) ? ' data-animation="'.esc_attr(avicenna_get_animation_classes($avicenna_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	avicenna_show_post_featured( array( 'thumb_size' => avicenna_get_thumb_size($avicenna_blog_style[0] == 'classic'
													? (strpos(avicenna_get_theme_option('body_style'), 'full')!==false 
															? ( $avicenna_columns > 2 ? 'big' : 'huge' )
															: (	$avicenna_columns > 2
																? ($avicenna_expanded ? 'med' : 'small')
																: ($avicenna_expanded ? 'big' : 'med')
																)
														)
													: (strpos(avicenna_get_theme_option('body_style'), 'full')!==false 
															? ( $avicenna_columns > 2 ? 'masonry-big' : 'full' )
															: (	$avicenna_columns <= 2 && $avicenna_expanded ? 'masonry-big' : 'masonry')
														)
								) ) );

	if ( !in_array($avicenna_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php 
			do_action('avicenna_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h5 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' );

			do_action('avicenna_action_before_post_meta'); 

			// Post meta
			if (!empty($avicenna_components))
				avicenna_show_post_meta(apply_filters('avicenna_filter_post_meta_args', array(
					'components' => $avicenna_components,
					'counters' => $avicenna_counters,
					'seo' => false
					), $avicenna_blog_style[0], $avicenna_columns)
				);

			do_action('avicenna_action_after_post_meta'); 
			?>
		</div><!-- .entry-header -->
		<?php
	}		
	?>

	<div class="post_content entry-content">
		<div class="post_content_inner">
			<?php
			$avicenna_show_learn_more = false;
			if (has_excerpt()) {
				the_excerpt();
			} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
				the_content( '' );
			} else if (in_array($avicenna_post_format, array('link', 'aside', 'status'))) {
				the_content();
			} else if ($avicenna_post_format == 'quote') {
				if (($quote = avicenna_get_tag(get_the_content(), '<blockquote>', '</blockquote>'))!='')
					avicenna_show_layout(wpautop($quote));
				else
					the_excerpt();
			} else if (substr(get_the_content(), 0, 1)!='[') {
				the_excerpt();
			}
			?>
		</div>
		<?php
		// Post meta
		if (in_array($avicenna_post_format, array('link', 'aside', 'status', 'quote'))) {
			if (!empty($avicenna_components))
				avicenna_show_post_meta(apply_filters('avicenna_filter_post_meta_args', array(
					'components' => $avicenna_components,
					'counters' => $avicenna_counters
					), $avicenna_blog_style[0], $avicenna_columns)
				);
		}
		// More button
		if ( $avicenna_show_learn_more ) {
			?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'avicenna'); ?></a></p><?php
		}
		?>
	</div><!-- .entry-content -->

</article></div>