<?php
/**
 * The Front Page template file.
 *
 * @package WordPress
 * @subpackage AVICENNA
 * @since AVICENNA 1.0.31
 */

get_header();

// If front-page is a static page
if (get_option('show_on_front') == 'page') {

	// If Front Page Builder is enabled - display sections
	if (avicenna_is_on(avicenna_get_theme_option('front_page_enabled'))) {

		if ( have_posts() ) the_post();

		$avicenna_sections = avicenna_array_get_keys_by_value(avicenna_get_theme_option('front_page_sections'), 1, false);
		if (is_array($avicenna_sections)) {
			foreach ($avicenna_sections as $avicenna_section) {
				get_template_part("front-page/section", $avicenna_section);
			}
		}
	
	// Else if this page is blog archive
	} else if (is_page_template('blog.php')) {
		get_template_part('blog');

	// Else - display native page content
	} else {
		get_template_part('page');
	}

// Else get index template to show posts
} else {
	get_template_part('index');
}

get_footer();
?>