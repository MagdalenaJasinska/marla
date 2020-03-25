<?php
/* Essential Grid support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('avicenna_essential_grid_theme_setup9')) {
	add_action( 'after_setup_theme', 'avicenna_essential_grid_theme_setup9', 9 );
	function avicenna_essential_grid_theme_setup9() {
		if (avicenna_exists_essential_grid()) {
			add_action( 'wp_enqueue_scripts', 							'avicenna_essential_grid_frontend_scripts', 1100 );
			add_filter( 'avicenna_filter_merge_styles',					'avicenna_essential_grid_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'avicenna_filter_tgmpa_required_plugins',		'avicenna_essential_grid_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'avicenna_essential_grid_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('avicenna_filter_tgmpa_required_plugins',	'avicenna_essential_grid_tgmpa_required_plugins');
	function avicenna_essential_grid_tgmpa_required_plugins($list=array()) {
		if (avicenna_storage_isset('required_plugins', 'essential-grid')) {
			$path = avicenna_get_file_dir('plugins/essential-grid/essential-grid.zip');
			if (!empty($path) || avicenna_get_theme_setting('tgmpa_upload')) {
				$list[] = array(
						'name' 		=> avicenna_storage_get_array('required_plugins', 'essential-grid'),
						'slug' 		=> 'essential-grid',
                        'version'	=> '2.3.2',
						'source'	=> !empty($path) ? $path : 'upload://essential-grid.zip',
						'required' 	=> false
				);
			}
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( !function_exists( 'avicenna_exists_essential_grid' ) ) {
	function avicenna_exists_essential_grid() {
		return defined('EG_PLUGIN_PATH');
	}
}
	
// Enqueue plugin's custom styles
if ( !function_exists( 'avicenna_essential_grid_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'avicenna_essential_grid_frontend_scripts', 1100 );
	function avicenna_essential_grid_frontend_scripts() {
		if (avicenna_is_on(avicenna_get_theme_option('debug_mode')) && avicenna_get_file_dir('plugins/essential-grid/essential-grid.css')!='')
			wp_enqueue_style( 'avicenna-essential-grid',  avicenna_get_file_url('plugins/essential-grid/essential-grid.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'avicenna_essential_grid_merge_styles' ) ) {
	//Handler of the add_filter('avicenna_filter_merge_styles', 'avicenna_essential_grid_merge_styles');
	function avicenna_essential_grid_merge_styles($list) {
		$list[] = 'plugins/essential-grid/essential-grid.css';
		return $list;
	}
}
?>