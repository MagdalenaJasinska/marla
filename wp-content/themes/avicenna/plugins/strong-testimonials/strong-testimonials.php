<?php
/* Strong Testimonials support functions
------------------------------------------------------------------------------- */
// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('avicenna_strong_testimonials_theme_setup9')) {
	add_action( 'after_setup_theme', 'avicenna_strong_testimonials_theme_setup9', 9 );
	function avicenna_strong_testimonials_theme_setup9() {
		if (is_admin()) {
			add_filter( 'avicenna_filter_tgmpa_required_plugins','avicenna_strong_testimonials_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'avicenna_strong_testimonials_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('avicenna_filter_tgmpa_required_plugins',	'avicenna_strong_testimonials_tgmpa_required_plugins');
	function avicenna_strong_testimonials_tgmpa_required_plugins($list=array()) {
		if (avicenna_storage_isset('required_plugins', 'strong-testimonials')) {
			$list[] = array(
				'name' 		=> avicenna_storage_get_array('required_plugins', 'strong-testimonials'),
				'slug' 		=> 'strong-testimonials',
				'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'avicenna_exists_strong_testimonials' ) ) {
	function avicenna_exists_strong_testimonials() {
		return class_exists('Strong_Testimonials');
	}
}

?>