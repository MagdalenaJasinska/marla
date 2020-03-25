<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage AVICENNA
 * @since AVICENNA 1.0
 */

$avicenna_post_format = get_post_format();
$avicenna_post_format = empty($avicenna_post_format) ? 'standard' : str_replace('post-format-', '', $avicenna_post_format);
$avicenna_animation = avicenna_get_theme_option('blog_animation');
$avicenna_show_learn_more = !in_array($avicenna_post_format, array('link', 'aside', 'status', 'quote'));


?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_excerpt post_format_'.esc_attr($avicenna_post_format) ); ?>
	<?php echo (!avicenna_is_off($avicenna_animation) ? ' data-animation="'.esc_attr(avicenna_get_animation_classes($avicenna_animation)).'"' : ''); ?>
	><?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Title
	if (get_the_title() != '') {
		?>
		<div class="post_header entry-header">
			<?php
			do_action('avicenna_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
			?>
		</div><!-- .post_header --><?php
	}

    // Featured image
    avicenna_show_post_featured(array( 'thumb_size' => avicenna_get_thumb_size( strpos(avicenna_get_theme_option('body_style'), 'full')!==false ? 'full' : 'big' ) ));
	
	// Post content
	?><div class="post_content entry-content"><?php
		if (avicenna_get_theme_option('blog_content') == 'fullpost') {
			// Post content area
			?><div class="post_content_inner"><?php
				the_content( '' );
			?></div><?php
			// Inner pages
			wp_link_pages( array(
				'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'avicenna' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'avicenna' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

		} else {


			// Post content area
			?><div class="post_content_inner"><?php
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
			?></div><?php

		}
	?></div><!-- .entry-content -->

    <?php
    // Title and post meta
        ?>
        <div class="excerpt_meta <?php echo esc_attr($avicenna_show_learn_more?'with_learn_more':''); ?>"><?php

            do_action('avicenna_action_before_post_meta');

            // Post meta
            $avicenna_components = avicenna_is_inherit(avicenna_get_theme_option_from_meta('meta_parts'))
                ? 'counters,date,author'
                : avicenna_array_get_keys_by_value(avicenna_get_theme_option('meta_parts'));
            $avicenna_counters = avicenna_is_inherit(avicenna_get_theme_option_from_meta('counters'))
                ? 'comments'
                : avicenna_array_get_keys_by_value(avicenna_get_theme_option('counters'));

            if (!empty($avicenna_components))
                avicenna_show_post_meta(apply_filters('avicenna_filter_post_meta_args', array(
                        'components' => $avicenna_components,
                        'counters' => $avicenna_counters,
                        'seo' => false
                    ), 'excerpt', 1)
                );

            // More button
            if ( $avicenna_show_learn_more ) {
                ?><a class="sc_button color_style_link2 more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read More', 'avicenna'); ?></a><?php
            }
            ?></div><!-- .excerpt_meta --><?php
    ?>
</article>