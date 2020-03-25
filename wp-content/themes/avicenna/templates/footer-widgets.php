<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage AVICENNA
 * @since AVICENNA 1.0.10
 */

// Footer sidebar
$avicenna_footer_name = avicenna_get_theme_option('footer_widgets');
$avicenna_footer_present = !avicenna_is_off($avicenna_footer_name) && is_active_sidebar($avicenna_footer_name);
if ($avicenna_footer_present) { 
	avicenna_storage_set('current_sidebar', 'footer');
	$avicenna_footer_wide = avicenna_get_theme_option('footer_wide');
	ob_start();
	if ( is_active_sidebar($avicenna_footer_name) ) {
		dynamic_sidebar($avicenna_footer_name);
	}
	$avicenna_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($avicenna_out)) {
		$avicenna_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $avicenna_out);
		$avicenna_need_columns = true;
		if ($avicenna_need_columns) {
			$avicenna_columns = max(0, (int) avicenna_get_theme_option('footer_columns'));
			if ($avicenna_columns == 0) $avicenna_columns = min(4, max(1, substr_count($avicenna_out, '<aside ')));
			if ($avicenna_columns > 1)
				$avicenna_out = preg_replace("/<aside([^>]*)class=\"widget/", "<aside$1class=\"column-1_".esc_attr($avicenna_columns).' widget', $avicenna_out);
			else
				$avicenna_need_columns = false;
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo !empty($avicenna_footer_wide) ? ' footer_fullwidth' : ''; ?> sc_layouts_row  sc_layouts_row_type_normal">
			<div class="footer_widgets_inner widget_area_inner">
				<?php 
				if (!$avicenna_footer_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($avicenna_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'avicenna_action_before_sidebar' );
				avicenna_show_layout($avicenna_out);
				do_action( 'avicenna_action_after_sidebar' );
				if ($avicenna_need_columns) {
					?></div><!-- /.columns_wrap --><?php
				}
				if (!$avicenna_footer_wide) {
					?></div><!-- /.content_wrap --><?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
?>