<?php
// Add plugin-specific colors and fonts to the custom CSS
if (!function_exists('avicenna_booked_get_css')) {
	add_filter('avicenna_filter_get_css', 'avicenna_booked_get_css', 10, 4);
	function avicenna_booked_get_css($css, $colors, $fonts, $scheme='') {
		
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS

.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-people button,
body #booked-profile-page input[type="submit"],
body #booked-profile-page button,
body .booked-list-view input[type="submit"],
body .booked-list-view button,
body table.booked-calendar input[type="submit"],
body table.booked-calendar button,
body .booked-modal input[type="submit"],
body .booked-modal button {
	{$fonts['button_font-family']}
	{$fonts['button_font-size']}
	{$fonts['button_font-weight']}
	{$fonts['button_font-style']}
	{$fonts['button_line-height']}
	{$fonts['button_text-decoration']}
	{$fonts['button_text-transform']}
	{$fonts['button_letter-spacing']}
}

CSS;
		}
		
		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS



CSS;
		}

		return $css;
	}
}
?>