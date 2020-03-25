<?php
/**
 * The template for homepage posts with "Chess" style
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
	if ($avicenna_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	if (!$avicenna_sticky_out) {
		?><div class="chess_wrap posts_container"><?php
	}
	while ( have_posts() ) { the_post(); 
		if ($avicenna_sticky_out && !is_sticky()) {
			$avicenna_sticky_out = false;
			?></div><div class="chess_wrap posts_container"><?php
		}
		get_template_part( 'content', $avicenna_sticky_out && is_sticky() ? 'sticky' :'chess' );
	}
	
	?></div><?php

	avicenna_show_pagination();

	avicenna_show_layout(get_query_var('blog_archive_end'));

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>