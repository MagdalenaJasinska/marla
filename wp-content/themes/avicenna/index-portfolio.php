<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage AVICENNA
 * @since AVICENNA 1.0
 */

avicenna_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	avicenna_show_layout(get_query_var('blog_archive_start'));

	$avicenna_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$avicenna_sticky_out = avicenna_get_theme_option('sticky_style')=='columns' 
							&& is_array($avicenna_stickies) && count($avicenna_stickies) > 0 && get_query_var( 'paged' ) < 1;
	
	// Show filters
	$avicenna_cat = avicenna_get_theme_option('parent_cat');
	$avicenna_post_type = avicenna_get_theme_option('post_type');
	$avicenna_taxonomy = avicenna_get_post_type_taxonomy($avicenna_post_type);
	$avicenna_show_filters = avicenna_get_theme_option('show_filters');
	$avicenna_tabs = array();
	if (!avicenna_is_off($avicenna_show_filters)) {
		$avicenna_args = array(
			'type'			=> $avicenna_post_type,
			'child_of'		=> $avicenna_cat,
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 0,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> $avicenna_taxonomy,
			'pad_counts'	=> false
		);
		$avicenna_portfolio_list = get_terms($avicenna_args);
		if (is_array($avicenna_portfolio_list) && count($avicenna_portfolio_list) > 0) {
			$avicenna_tabs[$avicenna_cat] = esc_html__('All', 'avicenna');
			foreach ($avicenna_portfolio_list as $avicenna_term) {
				if (isset($avicenna_term->term_id)) $avicenna_tabs[$avicenna_term->term_id] = $avicenna_term->name;
			}
		}
	}
	if (count($avicenna_tabs) > 0) {
		$avicenna_portfolio_filters_ajax = true;
		$avicenna_portfolio_filters_active = $avicenna_cat;
		$avicenna_portfolio_filters_id = 'portfolio_filters';
		?>
		<div class="portfolio_filters avicenna_tabs avicenna_tabs_ajax">
			<ul class="portfolio_titles avicenna_tabs_titles">
				<?php
				foreach ($avicenna_tabs as $avicenna_id=>$avicenna_title) {
					?><li><a href="<?php echo esc_url(avicenna_get_hash_link(sprintf('#%s_%s_content', $avicenna_portfolio_filters_id, $avicenna_id))); ?>" data-tab="<?php echo esc_attr($avicenna_id); ?>"><?php echo esc_html($avicenna_title); ?></a></li><?php
				}
				?>
			</ul>
			<?php
			$avicenna_ppp = avicenna_get_theme_option('posts_per_page');
			if (avicenna_is_inherit($avicenna_ppp)) $avicenna_ppp = '';
			foreach ($avicenna_tabs as $avicenna_id=>$avicenna_title) {
				$avicenna_portfolio_need_content = $avicenna_id==$avicenna_portfolio_filters_active || !$avicenna_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr(sprintf('%s_%s_content', $avicenna_portfolio_filters_id, $avicenna_id)); ?>"
					class="portfolio_content avicenna_tabs_content"
					data-blog-template="<?php echo esc_attr(avicenna_storage_get('blog_template')); ?>"
					data-blog-style="<?php echo esc_attr(avicenna_get_theme_option('blog_style')); ?>"
					data-posts-per-page="<?php echo esc_attr($avicenna_ppp); ?>"
					data-post-type="<?php echo esc_attr($avicenna_post_type); ?>"
					data-taxonomy="<?php echo esc_attr($avicenna_taxonomy); ?>"
					data-cat="<?php echo esc_attr($avicenna_id); ?>"
					data-parent-cat="<?php echo esc_attr($avicenna_cat); ?>"
					data-need-content="<?php echo (false===$avicenna_portfolio_need_content ? 'true' : 'false'); ?>"
				>
					<?php
					if ($avicenna_portfolio_need_content) 
						avicenna_show_portfolio_posts(array(
							'cat' => $avicenna_id,
							'parent_cat' => $avicenna_cat,
							'taxonomy' => $avicenna_taxonomy,
							'post_type' => $avicenna_post_type,
							'page' => 1,
							'sticky' => $avicenna_sticky_out
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		avicenna_show_portfolio_posts(array(
			'cat' => $avicenna_cat,
			'parent_cat' => $avicenna_cat,
			'taxonomy' => $avicenna_taxonomy,
			'post_type' => $avicenna_post_type,
			'page' => 1,
			'sticky' => $avicenna_sticky_out
			)
		);
	}

	avicenna_show_layout(get_query_var('blog_archive_end'));

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>