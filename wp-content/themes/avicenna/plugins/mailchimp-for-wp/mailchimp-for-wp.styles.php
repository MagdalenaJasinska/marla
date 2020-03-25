<?php
// Add plugin-specific colors and fonts to the custom CSS
if (!function_exists('avicenna_mailchimp_get_css')) {
	add_filter('avicenna_filter_get_css', 'avicenna_mailchimp_get_css', 10, 4);
	function avicenna_mailchimp_get_css($css, $colors, $fonts, $scheme='') {
		
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS
form.mc4wp-form .mc4wp-form-fields input[type="email"] {
	{$fonts['input_font-family']}
	{$fonts['input_font-size']}
	{$fonts['input_font-weight']}
	{$fonts['input_font-style']}
	{$fonts['input_line-height']}
	{$fonts['input_text-decoration']}
	{$fonts['input_text-transform']}
	{$fonts['input_letter-spacing']}
}
CSS;
		
			
			$rad = avicenna_get_border_radius();
			$css['fonts'] .= <<<CSS


CSS;
		}

		
		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

form.mc4wp-form input[type="email"] {
	background-color: {$colors['alter_bd_color']};
	border-color: {$colors['alter_bd_color']};
}
.sidebar_banner .scheme_dark form.mc4wp-form input[type="email"] {
	color: {$colors['text']};
	background-color: {$colors['alter_bd_color']};
	border-color: {$colors['alter_bd_color']};
}
form.mc4wp-form .mc4wp-alert {
	background-color: {$colors['text_link']};
	border-color: {$colors['text_hover']};
	color: {$colors['inverse_text']};
}
.sidebar_banner .scheme_dark form.mc4wp-form .mc4wp-form-fields input[type="submit"] {
	background-color: {$colors['text_hover']};
	color: {$colors['inverse_link']};
}
.sidebar_banner .scheme_dark form.mc4wp-form .mc4wp-form-fields input[type="submit"]:hover {
	background-color: {$colors['text_link']};
	color: {$colors['inverse_link']};
}
CSS;
		}

		return $css;
	}
}
?>