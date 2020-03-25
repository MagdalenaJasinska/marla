<?php
/* Booked Appointments support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('avicenna_booked_theme_setup9')) {
	add_action( 'after_setup_theme', 'avicenna_booked_theme_setup9', 9 );
	function avicenna_booked_theme_setup9() {
		if (avicenna_exists_booked()) {
			add_action( 'wp_enqueue_scripts', 							'avicenna_booked_frontend_scripts', 1100 );
			add_filter( 'avicenna_filter_merge_styles',					'avicenna_booked_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'avicenna_filter_tgmpa_required_plugins',		'avicenna_booked_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'avicenna_booked_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('avicenna_filter_tgmpa_required_plugins',	'avicenna_booked_tgmpa_required_plugins');
	function avicenna_booked_tgmpa_required_plugins($list=array()) {
		if (avicenna_storage_isset('required_plugins', 'booked')) {
			$path = avicenna_get_file_dir('plugins/booked/booked.zip');
			if (!empty($path) || avicenna_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
					'name' 		=> avicenna_storage_get_array('required_plugins', 'booked'),
					'slug' 		=> 'booked',
                    'version'	=> '2.2.5',
					'source' 	=> !empty($path) ? $path : 'upload://booked.zip',
					'required' 	=> false
				);
			}
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'avicenna_exists_booked' ) ) {
	function avicenna_exists_booked() {
		return class_exists('booked_plugin');
	}
}
	
// Enqueue plugin's custom styles
if ( !function_exists( 'avicenna_booked_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'avicenna_booked_frontend_scripts', 1100 );
	function avicenna_booked_frontend_scripts() {
		if (avicenna_is_on(avicenna_get_theme_option('debug_mode')) && avicenna_get_file_dir('plugins/booked/booked.css')!='')
			wp_enqueue_style( 'avicenna-booked',  avicenna_get_file_url('plugins/booked/booked.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'avicenna_booked_merge_styles' ) ) {
	//Handler of the add_filter('avicenna_filter_merge_styles', 'avicenna_booked_merge_styles');
	function avicenna_booked_merge_styles($list) {
		$list[] = 'plugins/booked/booked.css';
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if (avicenna_exists_booked()) { require_once AVICENNA_THEME_DIR . 'plugins/booked/booked.styles.php'; }
?>