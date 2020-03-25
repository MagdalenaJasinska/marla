<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage AVICENNA
 * @since AVICENNA 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the WordPress editor or any Page Builder to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

// Get template page's content
$avicenna_content = '';
$avicenna_blog_archive_mask = '%%CONTENT%%';
$avicenna_blog_archive_subst = sprintf('<div class="blog_archive">%s</div>', $avicenna_blog_archive_mask);
if ( have_posts() ) {
	the_post();
	if (($avicenna_content = apply_filters('the_content', get_the_content())) != '') {
		if (($avicenna_pos = strpos($avicenna_content, $avicenna_blog_archive_mask)) !== false) {
			$avicenna_content = preg_replace('/(\<p\>\s*)?'.$avicenna_blog_archive_mask.'(\s*\<\/p\>)/i', $avicenna_blog_archive_subst, $avicenna_content);
		} else
			$avicenna_content .= $avicenna_blog_archive_subst;
		$avicenna_content = explode($avicenna_blog_archive_mask, $avicenna_content);
		// Add VC custom styles to the inline CSS
		$vc_custom_css = get_post_meta( get_the_ID(), '_wpb_shortcodes_custom_css', true );
		if ( !empty( $vc_custom_css ) ) avicenna_add_inline_css(strip_tags($vc_custom_css));
	}
}

// Prepare args for a new query
$avicenna_args = array(
	'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish'
);
$avicenna_args = avicenna_query_add_posts_and_cats($avicenna_args, '', avicenna_get_theme_option('post_type'), avicenna_get_theme_option('parent_cat'));
$avicenna_page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
if ($avicenna_page_number > 1) {
	$avicenna_args['paged'] = $avicenna_page_number;
	$avicenna_args['ignore_sticky_posts'] = true;
}
$avicenna_ppp = avicenna_get_theme_option('posts_per_page');
if ((int) $avicenna_ppp != 0)
	$avicenna_args['posts_per_page'] = (int) $avicenna_ppp;
// Make a new main query
$GLOBALS['wp_the_query']->query($avicenna_args);


// Add internal query vars in the new query!
if (is_array($avicenna_content) && count($avicenna_content) == 2) {
	set_query_var('blog_archive_start', $avicenna_content[0]);
	set_query_var('blog_archive_end', $avicenna_content[1]);
}

get_template_part('index');
?>