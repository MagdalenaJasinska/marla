<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage AVICENNA
 * @since AVICENNA 1.0.10
 */

// Copyright area
$avicenna_footer_scheme =  avicenna_is_inherit(avicenna_get_theme_option('footer_scheme')) ? avicenna_get_theme_option('color_scheme') : avicenna_get_theme_option('footer_scheme');
$avicenna_copyright_scheme = avicenna_is_inherit(avicenna_get_theme_option('copyright_scheme')) ? $avicenna_footer_scheme : avicenna_get_theme_option('copyright_scheme');
?> 
<div class="footer_copyright_wrap scheme_<?php echo esc_attr($avicenna_copyright_scheme); ?>">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text"><?php
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$avicenna_copyright = avicenna_prepare_macros(avicenna_get_theme_option('copyright'));
				if (!empty($avicenna_copyright)) {
					// Replace {date_format} on the current date in the specified format
					if (preg_match("/(\\{[\\w\\d\\\\\\-\\:]*\\})/", $avicenna_copyright, $avicenna_matches)) {
						$avicenna_copyright = str_replace($avicenna_matches[1], date_i18n(str_replace(array('{', '}'), '', $avicenna_matches[1])), $avicenna_copyright);
					}
					// Display copyright
					echo wp_kses_data(nl2br($avicenna_copyright));
				}
			?></div>
		</div>
	</div>
</div>
