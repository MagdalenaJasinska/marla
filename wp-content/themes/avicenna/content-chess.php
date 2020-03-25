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
$avicenna_columns = empty($avicenna_blog_style[1]) ? 1 : max(1, $avicenna_blog_style[1]);
$avicenna_expanded = !avicenna_sidebar_present() && avicenna_is_on(avicenna_get_theme_option('expand_content'));
$avicenna_post_format = get_post_format();
$avicenna_post_format = empty($avicenna_post_format) ? 'standard' : str_replace('post-format-', '', $avicenna_post_format);
$avicenna_animation = avicenna_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_chess post_layout_chess_'.esc_attr($avicenna_columns).' post_format_'.esc_attr($avicenna_post_format) ); ?>
	<?php echo (!avicenna_is_off($avicenna_animation) ? ' data-animation="'.esc_attr(avicenna_get_animation_classes($avicenna_animation)).'"' : ''); ?>>

	<?php
	// Add anchor
	if ($avicenna_columns == 1 && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="post_'.esc_attr(get_the_ID()).'" title="'.esc_attr(get_the_title()).'"]');
	}

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	avicenna_show_post_featured( array(
											'class' => $avicenna_columns == 1 ? 'avicenna-full-height' : '',
											'show_no_image' => true,
											'thumb_bg' => true,
											'thumb_size' => avicenna_get_thumb_size(
																	strpos(avicenna_get_theme_option('body_style'), 'full')!==false
																		? ( $avicenna_columns > 1 ? 'huge' : 'original' )
																		: (	$avicenna_columns > 2 ? 'big' : 'huge')
																	)
											) 
										);

	?><div class="post_inner"><div class="post_inner_content"><?php 

		?><div class="post_header entry-header"><?php 
			do_action('avicenna_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
			
			do_action('avicenna_action_before_post_meta'); 

			// Post meta
			$avicenna_components = avicenna_is_inherit(avicenna_get_theme_option_from_meta('meta_parts')) 
										? 'date'.($avicenna_columns < 3 ? ',counters' : '').($avicenna_columns == 1 ? ',edit' : '')
										: avicenna_array_get_keys_by_value(avicenna_get_theme_option('meta_parts'));
			$avicenna_counters = avicenna_is_inherit(avicenna_get_theme_option_from_meta('counters')) 
										? 'comments'
										: avicenna_array_get_keys_by_value(avicenna_get_theme_option('counters'));
			$avicenna_post_meta = empty($avicenna_components) 
										? '' 
										: avicenna_show_post_meta(apply_filters('avicenna_filter_post_meta_args', array(
												'components' => $avicenna_components,
												'counters' => $avicenna_counters,
												'seo' => false,
												'echo' => false
												), $avicenna_blog_style[0], $avicenna_columns)
											);
			avicenna_show_layout($avicenna_post_meta);
		?></div><!-- .entry-header -->
	
		<div class="post_content entry-content">
			<div class="post_content_inner">
				<?php
				$avicenna_show_learn_more = !in_array($avicenna_post_format, array('link', 'aside', 'status', 'quote'));
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
				avicenna_show_layout($avicenna_post_meta);
			}
			// More button
			if ( $avicenna_show_learn_more ) {
				?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'avicenna'); ?></a></p><?php
			}
			?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article>