<?php
/**
 * The default template to display the content of the single post, page or attachment
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage AVICENNA
 * @since AVICENNA 1.0
 */

$avicenna_seo = avicenna_is_on(avicenna_get_theme_option('seo_snippets'));
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post_item_single post_type_'.esc_attr(get_post_type()) 
												. ' post_format_'.esc_attr(str_replace('post-format-', '', get_post_format())) 
												);
		if ($avicenna_seo) {
			?> itemscope="itemscope" 
			   itemprop="articleBody" 
			   itemtype="http://schema.org/<?php echo esc_attr(avicenna_get_markup_schema()); ?>" 
			   itemid="<?php echo esc_url(get_the_permalink()); ?>"
			   content="<?php echo esc_attr(get_the_title()); ?>"<?php
		}
?>><?php

	do_action('avicenna_action_before_post_data'); 

	// Structured data snippets
	if ($avicenna_seo)
		get_template_part('templates/seo');

	// Featured image
	if ( avicenna_is_off(avicenna_get_theme_option('hide_featured_on_single'))
			&& !avicenna_sc_layouts_showed('featured') 
			&& strpos(get_the_content(), '[trx_widget_banner]')===false) {
		do_action('avicenna_action_before_post_featured'); 
		avicenna_show_post_featured();
		do_action('avicenna_action_after_post_featured'); 
	} else if (has_post_thumbnail()) {
		?><meta itemprop="image" itemtype="http://schema.org/ImageObject" content="<?php echo esc_url(wp_get_attachment_url(get_post_thumbnail_id())); ?>"><?php
	}

	// Title and post meta
	if ( (!avicenna_sc_layouts_showed('title')) && !in_array(get_post_format(), array('link', 'aside', 'status', 'quote')) ) {
		do_action('avicenna_action_before_post_title'); 
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			if (!avicenna_sc_layouts_showed('title')) {
				the_title( '<h3 class="post_title entry-title"'.($avicenna_seo ? ' itemprop="headline"' : '').'>', '</h3>' );
			}
			?>
		</div><!-- .post_header -->
		<?php
		do_action('avicenna_action_after_post_title'); 
	}

	do_action('avicenna_action_before_post_content'); 

	// Post content
	?>
	<div class="post_content entry-content" itemprop="mainEntityOfPage">
		<?php
		the_content( );

		do_action('avicenna_action_before_post_pagination'); 

		wp_link_pages( array(
			'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'avicenna' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'avicenna' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) );

		// Taxonomies and share
		if ( is_single() && !is_attachment() ) {
			
			do_action('avicenna_action_before_post_meta'); 

			?><div class="post_meta post_meta_single"><?php

                // Post meta
                if (!avicenna_sc_layouts_showed('postmeta') && avicenna_is_on(avicenna_get_theme_option('show_post_meta'))) {
                    avicenna_show_post_meta(apply_filters('avicenna_filter_post_meta_args', array(
                            'components' => avicenna_array_get_keys_by_value(avicenna_get_theme_option('meta_parts')),
                            'counters' => avicenna_array_get_keys_by_value(avicenna_get_theme_option('counters')),
                            'seo' => avicenna_is_on(avicenna_get_theme_option('seo_snippets'))
                        ), 'single', 1)
                    );
                }
				
				// Post taxonomies
				the_tags( '<span class="post_meta_item post_tags"><span class="post_meta_label">'.esc_html__('Tags:', 'avicenna').'</span> ', ', ', '</span>' );

				// Share
				if (avicenna_is_on(avicenna_get_theme_option('show_share_links'))) {
					avicenna_show_share_links(array(
							'type' => 'block',
							'caption' => '',
							'before' => '<span class="post_meta_item post_share">',
							'after' => '</span>'
						));
				}
			?></div><?php

			do_action('avicenna_action_after_post_meta'); 
		}
		?>
	</div><!-- .entry-content -->
	

	<?php
	do_action('avicenna_action_after_post_content'); 

	// Author bio.
	if ( avicenna_get_theme_option('show_author_info')==1 && is_single() && !is_attachment() && get_the_author_meta( 'description' ) ) {
		do_action('avicenna_action_before_post_author'); 
		get_template_part( 'templates/author-bio' );
		do_action('avicenna_action_after_post_author'); 
	}

	do_action('avicenna_action_after_post_data'); 
	?>
</article>
