<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage AVICENNA
 * @since AVICENNA 1.0.10
 */

$avicenna_footer_scheme =  avicenna_is_inherit(avicenna_get_theme_option('footer_scheme')) ? avicenna_get_theme_option('color_scheme') : avicenna_get_theme_option('footer_scheme');
$avicenna_footer_id = str_replace('footer-custom-', '', avicenna_get_theme_option("footer_style"));
if ((int) $avicenna_footer_id == 0) {
	$avicenna_footer_id = avicenna_get_post_id(array(
												'name' => $avicenna_footer_id,
												'post_type' => defined('TRX_ADDONS_CPT_LAYOUTS_PT') ? TRX_ADDONS_CPT_LAYOUTS_PT : 'cpt_layouts'
												)
											);
} else {
	$avicenna_footer_id = apply_filters('avicenna_filter_get_translated_layout', $avicenna_footer_id);
}
$avicenna_footer_meta = get_post_meta($avicenna_footer_id, 'trx_addons_options', true);
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr($avicenna_footer_id); 
						?> footer_custom_<?php echo esc_attr(sanitize_title(get_the_title($avicenna_footer_id))); 
						if (!empty($avicenna_footer_meta['margin']) != '') 
							echo ' '.esc_attr(avicenna_add_inline_css_class('margin-top: '.avicenna_prepare_css_value($avicenna_footer_meta['margin']).';'));
						?> scheme_<?php echo esc_attr($avicenna_footer_scheme); 
						?>">
	<?php
    // Custom footer's layout
    do_action('avicenna_action_show_layout', $avicenna_footer_id);
	?>
</footer><!-- /.footer_wrap -->
