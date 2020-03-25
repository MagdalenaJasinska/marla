<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage AVICENNA
 * @since AVICENNA 1.0.10
 */

// Logo
if (avicenna_is_on(avicenna_get_theme_option('logo_in_footer'))) {
	$avicenna_logo_image = '';
	if (avicenna_is_on(avicenna_get_theme_option('logo_retina_enabled')) && avicenna_get_retina_multiplier(2) > 1)
		$avicenna_logo_image = avicenna_get_theme_option( 'logo_footer_retina' );
	if (empty($avicenna_logo_image)) 
		$avicenna_logo_image = avicenna_get_theme_option( 'logo_footer' );
	$avicenna_logo_text   = get_bloginfo( 'name' );
	if (!empty($avicenna_logo_image) || !empty($avicenna_logo_text)) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if (!empty($avicenna_logo_image)) {
					$avicenna_attr = avicenna_getimagesize($avicenna_logo_image);
					echo '<a href="'.esc_url(home_url('/')).'"><img src="'.esc_url($avicenna_logo_image).'" class="logo_footer_image" '.(!empty($avicenna_attr[3]) ? ' ' . wp_kses_data($avicenna_attr[3]) : '').'></a>' ;
				} else if (!empty($avicenna_logo_text)) {
					echo '<h1 class="logo_footer_text"><a href="'.esc_url(home_url('/')).'">' . esc_html($avicenna_logo_text) . '</a></h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
?>