<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage AVICENNA
 * @since AVICENNA 1.0
 */

// Header sidebar
$avicenna_header_name = avicenna_get_theme_option('header_widgets');
$avicenna_header_present = !avicenna_is_off($avicenna_header_name) && is_active_sidebar($avicenna_header_name);
if ($avicenna_header_present) { 
	avicenna_storage_set('current_sidebar', 'header');
	$avicenna_header_wide = avicenna_get_theme_option('header_wide');
	ob_start();
	if ( is_active_sidebar($avicenna_header_name) ) {
		dynamic_sidebar($avicenna_header_name);
	}
	$avicenna_widgets_output = ob_get_contents();
	ob_end_clean();
	if (!empty($avicenna_widgets_output)) {
		$avicenna_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $avicenna_widgets_output);
		$avicenna_need_columns = strpos($avicenna_widgets_output, 'columns_wrap')===false;
		if ($avicenna_need_columns) {
			$avicenna_columns = max(0, (int) avicenna_get_theme_option('header_columns'));
			if ($avicenna_columns == 0) $avicenna_columns = min(6, max(1, substr_count($avicenna_widgets_output, '<aside ')));
			if ($avicenna_columns > 1)
				$avicenna_widgets_output = preg_replace("/<aside([^>]*)class=\"widget/", "<aside$1class=\"column-1_".esc_attr($avicenna_columns).' widget', $avicenna_widgets_output);
			else
				$avicenna_need_columns = false;
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo !empty($avicenna_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php 
				if (!$avicenna_header_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($avicenna_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'avicenna_action_before_sidebar' );
				avicenna_show_layout($avicenna_widgets_output);
				do_action( 'avicenna_action_after_sidebar' );
				if ($avicenna_need_columns) {
					?></div>	<!-- /.columns_wrap --><?php
				}
				if (!$avicenna_header_wide) {
					?></div>	<!-- /.content_wrap --><?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
?>