<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage AVICENNA
 * @since AVICENNA 1.0
 */

$avicenna_args = get_query_var('avicenna_logo_args');

// Site logo
$avicenna_logo_type   = isset($avicenna_args['type']) ? $avicenna_args['type'] : '';
$avicenna_logo_image  = avicenna_get_logo_image($avicenna_logo_type);
$avicenna_logo_text   = avicenna_is_on(avicenna_get_theme_option('logo_text')) ? get_bloginfo( 'name' ) : '';
$avicenna_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($avicenna_logo_image) || !empty($avicenna_logo_text)) {
	?><a class="sc_layouts_logo" href="<?php echo is_front_page() ? '#' : esc_url(home_url('/')); ?>"><?php
		if (!empty($avicenna_logo_image)) {
			if (empty($avicenna_logo_type) && function_exists('the_custom_logo') && (int) $avicenna_logo_image > 0) {
				the_custom_logo();
			} else {
				$avicenna_attr = avicenna_getimagesize($avicenna_logo_image);
				echo '<img src="'.esc_url($avicenna_logo_image).'" '.(!empty($avicenna_attr[3]) ? ' '.wp_kses_data($avicenna_attr[3]) : '').'>';
			}
		} else {
			avicenna_show_layout(avicenna_prepare_macros($avicenna_logo_text), '<span class="logo_text">', '</span>');
			avicenna_show_layout(avicenna_prepare_macros($avicenna_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>