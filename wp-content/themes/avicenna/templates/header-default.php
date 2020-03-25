<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage AVICENNA
 * @since AVICENNA 1.0
 */


$avicenna_header_css = '';
$avicenna_header_image = get_header_image();
$avicenna_header_video = avicenna_get_header_video();
if (!empty($avicenna_header_image) && avicenna_trx_addons_featured_image_override(is_singular() || avicenna_storage_isset('blog_archive') || is_category())) {
	$avicenna_header_image = avicenna_get_current_mode_image($avicenna_header_image);
}

?><header class="top_panel top_panel_default<?php
echo !empty($avicenna_header_image) || !empty($avicenna_header_video) ? ' with_bg_image' : ' without_bg_image';
if ($avicenna_header_video!='') echo ' with_bg_video';
if ($avicenna_header_image!='') echo ' '.esc_attr(avicenna_add_inline_css_class('background-image: url('.esc_url($avicenna_header_image).');'));
if (is_single() && has_post_thumbnail()) echo ' with_featured_image';
if (avicenna_is_on(avicenna_get_theme_option('header_fullheight'))) echo ' header_fullheight avicenna-full-height';
if (!avicenna_is_inherit(avicenna_get_theme_option('header_scheme')))
	echo ' scheme_' . esc_attr(avicenna_get_theme_option('header_scheme'));
?>"><?php

	// Background video
	if (!empty($avicenna_header_video)) {
		get_template_part( 'templates/header-video' );
	}
	
	// Main menu
	if (avicenna_get_theme_option("menu_style") == 'top') {
		get_template_part( 'templates/header-navi' );
	}

	// Page title and breadcrumbs area
	get_template_part( 'templates/header-title');

	// Header widgets area
	get_template_part( 'templates/header-widgets' );

?></header>