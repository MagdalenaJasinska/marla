<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('avicenna_mailchimp_theme_setup9')) {
	add_action( 'after_setup_theme', 'avicenna_mailchimp_theme_setup9', 9 );
	function avicenna_mailchimp_theme_setup9() {
		if (avicenna_exists_mailchimp()) {
			add_action( 'wp_enqueue_scripts',							'avicenna_mailchimp_frontend_scripts', 1100 );
			add_filter( 'avicenna_filter_merge_styles',					'avicenna_mailchimp_merge_styles');
		}
		if (is_admin()) {
			add_filter( 'avicenna_filter_tgmpa_required_plugins',		'avicenna_mailchimp_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'avicenna_mailchimp_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('avicenna_filter_tgmpa_required_plugins',	'avicenna_mailchimp_tgmpa_required_plugins');
	function avicenna_mailchimp_tgmpa_required_plugins($list=array()) {
		if (avicenna_storage_isset('required_plugins', 'mailchimp-for-wp')) {
			$list[] = array(
				'name' 		=> avicenna_storage_get_array('required_plugins', 'mailchimp-for-wp'),
				'slug' 		=> 'mailchimp-for-wp',
				'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'avicenna_exists_mailchimp' ) ) {
	function avicenna_exists_mailchimp() {
		return function_exists('__mc4wp_load_plugin') || defined('MC4WP_VERSION');
	}
}



// Custom styles and scripts
//------------------------------------------------------------------------

// Enqueue custom styles
if ( !function_exists( 'avicenna_mailchimp_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'avicenna_mailchimp_frontend_scripts', 1100 );
	function avicenna_mailchimp_frontend_scripts() {
		if (avicenna_exists_mailchimp()) {
			if (avicenna_is_on(avicenna_get_theme_option('debug_mode')) && avicenna_get_file_dir('plugins/mailchimp-for-wp/mailchimp-for-wp.css')!='')
				wp_enqueue_style( 'avicenna-mailchimp-for-wp',  avicenna_get_file_url('plugins/mailchimp-for-wp/mailchimp-for-wp.css'), array(), null );
		}
	}
}
	
// Merge custom styles
if ( !function_exists( 'avicenna_mailchimp_merge_styles' ) ) {
	//Handler of the add_filter( 'avicenna_filter_merge_styles', 'avicenna_mailchimp_merge_styles');
	function avicenna_mailchimp_merge_styles($list) {
		$list[] = 'plugins/mailchimp-for-wp/mailchimp-for-wp.css';
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if (avicenna_exists_mailchimp()) { require_once AVICENNA_THEME_DIR . 'plugins/mailchimp-for-wp/mailchimp-for-wp.styles.php'; }
?>