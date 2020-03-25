<?php
/* gdpr-compliance support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('avicenna_gdpr_theme_setup9')) {
	add_action( 'after_setup_theme', 'avicenna_gdpr_theme_setup9', 9 );
	function avicenna_gdpr_theme_setup9() {
		if (avicenna_exists_gdpr()) {
			add_filter( 'avicenna_filter_merge_styles',					'avicenna_gdpr_merge_styles');
		}
		if (is_admin()) {
			add_filter( 'avicenna_filter_tgmpa_required_plugins',		'avicenna_gdpr_tgmpa_required_plugins' );
		}
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'avicenna_exists_gdpr' ) ) {
	function avicenna_exists_gdpr() {
		return function_exists('__gdpr_load_plugin') || defined('GDPR_VERSION');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'avicenna_gdpr_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('avicenna_filter_tgmpa_required_plugins',	'avicenna_gdpr_tgmpa_required_plugins');
	function avicenna_gdpr_tgmpa_required_plugins($list=array()) {
		if (avicenna_storage_isset('required_plugins', 'wp-gdpr-compliance')) {
			$list[] = array(
				'name'     => esc_html__( 'WP GDPR Compliance', 'avicenna' ),
				'slug'     => 'wp-gdpr-compliance',
				'required' => false
			);
		}
		return $list;
	}
}

