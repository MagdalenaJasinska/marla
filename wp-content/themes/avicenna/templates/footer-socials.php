<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage AVICENNA
 * @since AVICENNA 1.0.10
 */


// Socials
if ( avicenna_is_on(avicenna_get_theme_option('socials_in_footer')) && ($avicenna_output = avicenna_get_socials_links()) != '') {
	?>
	<div class="footer_socials_wrap socials_wrap">
		<div class="footer_socials_inner">
			<?php avicenna_show_layout($avicenna_output); ?>
		</div>
	</div>
	<?php
}
?>