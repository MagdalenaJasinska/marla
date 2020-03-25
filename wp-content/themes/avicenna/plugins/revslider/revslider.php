<?php
/* Revolution Slider support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('avicenna_revslider_theme_setup9')) {
	add_action( 'after_setup_theme', 'avicenna_revslider_theme_setup9', 9 );
	function avicenna_revslider_theme_setup9() {
		if (avicenna_exists_revslider()) {
			add_action( 'wp_enqueue_scripts', 					'avicenna_revslider_frontend_scripts', 1100 );
			add_filter( 'avicenna_filter_merge_styles',			'avicenna_revslider_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'avicenna_filter_tgmpa_required_plugins','avicenna_revslider_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'avicenna_revslider_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('avicenna_filter_tgmpa_required_plugins',	'avicenna_revslider_tgmpa_required_plugins');
	function avicenna_revslider_tgmpa_required_plugins($list=array()) {
		if (avicenna_storage_isset('required_plugins', 'revslider')) {
			$path = avicenna_get_file_dir('plugins/revslider/revslider.zip');
			if (!empty($path) || avicenna_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
					'name' 		=> avicenna_storage_get_array('required_plugins', 'revslider'),
					'slug' 		=> 'revslider',
                    'version'	=> '6.0.9',
					'source'	=> !empty($path) ? $path : 'upload://revslider.zip',
					'required' 	=> false
				);
			}
		}
		return $list;
	}
}

// Check if RevSlider installed and activated
if ( !function_exists( 'avicenna_exists_revslider' ) ) {
	function avicenna_exists_revslider() {
		return function_exists('rev_slider_shortcode');
	}
}
	
// Enqueue custom styles
if ( !function_exists( 'avicenna_revslider_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'avicenna_revslider_frontend_scripts', 1100 );
	function avicenna_revslider_frontend_scripts() {
		if (avicenna_is_on(avicenna_get_theme_option('debug_mode')) && avicenna_get_file_dir('plugins/revslider/revslider.css')!='')
			wp_enqueue_style( 'avicenna-revslider',  avicenna_get_file_url('plugins/revslider/revslider.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'avicenna_revslider_merge_styles' ) ) {
	//Handler of the add_filter('avicenna_filter_merge_styles', 'avicenna_revslider_merge_styles');
	function avicenna_revslider_merge_styles($list) {
		$list[] = 'plugins/revslider/revslider.css';
		return $list;
	}
}
?>