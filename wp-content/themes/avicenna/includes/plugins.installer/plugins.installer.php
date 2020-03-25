<?php
/**
 * Plugin install helper.
 *
 * @package WordPress
 * @subpackage AVICENNA
 * @since AVICENNA 1.0.31
 */

	
// Return button (link) to install/activate plugin
if (!function_exists('avicenna_plugins_installer_get_button_html')) {
	function avicenna_plugins_installer_get_button_html($slug, $show=true) {
		$output = '';
		if (!empty($slug)) {
			$state = avicenna_plugins_installer_check_plugin_state($slug);
			switch ($state) {
				case 'install':
					if (class_exists('TGM_Plugin_Activation')) {
						$instance = call_user_func(array(get_class($GLOBALS['tgmpa']), 'get_instance'));
						$nonce = wp_nonce_url(
							add_query_arg(
								array(
									'plugin' => urlencode($slug),
									'tgmpa-install' => 'install-plugin',
								),
								$instance->get_tgmpa_url()
							),
							'tgmpa-install',
							'tgmpa-nonce'
						);
					} else {
						$nonce  = wp_nonce_url(
							add_query_arg(
								array(
									'action' => 'install-plugin',
									'from'   => 'import',
									'plugin' => urlencode($slug),
								),
								network_admin_url('update.php')
							),
							'install-plugin_' . trim($slug)
						);
					}
					$output .= '<a class="avicenna_about_block_link avicenna_plugins_installer_link button button-primary install-now"'
									. ' href="'.esc_url($nonce).'"'
									. ' data-slug="'.esc_attr($slug).'"'
									. ' data-name="'.esc_attr($slug).'"'
									. ' data-processing="'.esc_attr__('Installing ...', 'avicenna').'"'
									// Translators: Add the plugin's slug to the 'aria-label'
									. ' aria-label="'.esc_attr(sprintf(esc_attr__('Install %s', 'avicenna'), $slug)).'"'
								. '>'
							   		. esc_html__('Install', 'avicenna')
								. '</a>';
					break;

				case 'activate':
					if (class_exists('TGM_Plugin_Activation')) {
						$instance = call_user_func(array(get_class($GLOBALS['tgmpa']), 'get_instance'));
						$nonce = wp_nonce_url(
							add_query_arg(
								array(
									'plugin' => urlencode($slug),
									'tgmpa-activate' => 'activate-plugin',
								),
								$instance->get_tgmpa_url()
							),
							'tgmpa-activate',
							'tgmpa-nonce'
						);
					} else {
						$plugin_link = $slug . '/' . $slug . '.php';
						$nonce = add_query_arg(
									array(
										'action'        => 'activate',
										'plugin'        => rawurlencode( $plugin_link ),
										'plugin_status' => 'all',
										'paged'         => '1',
										'_wpnonce'      => wp_create_nonce('activate-plugin_' . $plugin_link),
									),
									network_admin_url('plugins.php')
						);
					}
					$output .= '<a class="avicenna_about_block_link avicenna_plugins_installer_link button button-primary activate-now"'
									. ' href="'.esc_url($nonce).'"'
									. ' data-slug="'.esc_attr($slug).'"'
									. ' data-name="'.esc_attr($slug).'"'
									. ' data-processing="'.esc_attr__('Activating ...', 'avicenna').'"'
									// Translators: Add the plugin's slug to the 'aria-label'
									. ' aria-label="'.esc_attr(sprintf(esc_attr__('Activate %s', 'avicenna'), $slug)).'"'
								. '>'
							   		. esc_html__('Activate', 'avicenna')
								. '</a>';
					break;
			}
		}
		if ($show) avicenna_show_layout($output);
		return $output;
	}
}

// Return plugin's state
if (!function_exists('avicenna_plugins_installer_check_plugin_state')) {
	function avicenna_plugins_installer_check_plugin_state($slug) {
		$state = 'install';
		if (file_exists(ABSPATH . 'wp-content/plugins/' . $slug . '/' . $slug . '.php')
			|| file_exists(ABSPATH . 'wp-content/plugins/' . $slug . '/index.php')) {
			$state = !is_plugin_inactive($slug . '/' . $slug . '.php') || !is_plugin_inactive($slug . '/index.php') ? 'deactivate' : 'activate';
		}
		return $state;
	}
}

// Enqueue scripts
if (!function_exists('avicenna_plugins_installer_enqueue_scripts')) {
	function avicenna_plugins_installer_enqueue_scripts() {
		wp_enqueue_script('plugin-install');
		wp_enqueue_script('updates');
		wp_enqueue_script('avicenna-plugins-installer', avicenna_get_file_url('includes/plugins.installer/plugins.installer.js'), array('jquery'), null, true);
	}
}