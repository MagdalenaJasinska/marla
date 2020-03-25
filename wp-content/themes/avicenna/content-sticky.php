<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage AVICENNA
 * @since AVICENNA 1.0
 */

$avicenna_columns = max(1, min(3, count(get_option( 'sticky_posts' ))));
$avicenna_post_format = get_post_format();
$avicenna_post_format = empty($avicenna_post_format) ? 'standard' : str_replace('post-format-', '', $avicenna_post_format);
$avicenna_animation = avicenna_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($avicenna_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_'.esc_attr($avicenna_post_format) ); ?>
	<?php echo (!avicenna_is_off($avicenna_animation) ? ' data-animation="'.esc_attr(avicenna_get_animation_classes($avicenna_animation)).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	avicenna_show_post_featured(array(
		'thumb_size' => avicenna_get_thumb_size($avicenna_columns==1 ? 'big' : ($avicenna_columns==2 ? 'med' : 'avatar'))
	));

	if ( !in_array($avicenna_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			avicenna_show_post_meta(apply_filters('avicenna_filter_post_meta_args', array(), 'sticky', $avicenna_columns));
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div>