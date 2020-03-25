<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage AVICENNA
 * @since AVICENNA 1.0.06
 */

$avicenna_header_css = '';
$avicenna_header_image = get_header_image();
$avicenna_header_video = avicenna_get_header_video();
if (!empty($avicenna_header_image) && avicenna_trx_addons_featured_image_override(is_singular() || avicenna_storage_isset('blog_archive') || is_category())) {
	$avicenna_header_image = avicenna_get_current_mode_image($avicenna_header_image);
}

$avicenna_header_id = str_replace('header-custom-', '', avicenna_get_theme_option("header_style"));
if ((int) $avicenna_header_id == 0) {
	$avicenna_header_id = avicenna_get_post_id(array(
			'name' => $avicenna_header_id,
			'post_type' => defined('TRX_ADDONS_CPT_LAYOUTS_PT') ? TRX_ADDONS_CPT_LAYOUTS_PT : 'cpt_layouts'
		)
	);
} else {
	$avicenna_header_id = apply_filters('avicenna_filter_get_translated_layout', $avicenna_header_id);
}
$avicenna_header_meta = get_post_meta($avicenna_header_id, 'trx_addons_options', true);

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr($avicenna_header_id);
?> top_panel_custom_<?php echo esc_attr(sanitize_title(get_the_title($avicenna_header_id)));
echo !empty($avicenna_header_image) || !empty($avicenna_header_video)
	? ' with_bg_image'
	: ' without_bg_image';
if ($avicenna_header_video!='')
	echo ' with_bg_video';
if ($avicenna_header_image!='')
	echo ' '.esc_attr(avicenna_add_inline_css_class('background-image: url('.esc_url($avicenna_header_image).');'));
if (!empty($avicenna_header_meta['margin']) != '')
	echo ' '.esc_attr(avicenna_add_inline_css_class('margin-bottom: '.esc_attr(avicenna_prepare_css_value($avicenna_header_meta['margin'])).';'));
if (is_single() && has_post_thumbnail())
	echo ' with_featured_image';
if (avicenna_is_on(avicenna_get_theme_option('header_fullheight')))
	echo ' header_fullheight avicenna-full-height';
if (!avicenna_is_inherit(avicenna_get_theme_option('header_scheme')))
	echo ' scheme_' . esc_attr(avicenna_get_theme_option('header_scheme'));
?>"><?php


	// Background video
	if (!empty($avicenna_header_video)) {
		get_template_part( 'templates/header-video' );
	}
		
	// Custom header's layout
	do_action('avicenna_action_show_layout', $avicenna_header_id);

	// Header widgets area
	get_template_part( 'templates/header-widgets' );
		
?></header>