<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage AVICENNA
 * @since AVICENNA 1.0
 */

if (avicenna_sidebar_present()) {
	ob_start();
	$avicenna_sidebar_name = avicenna_get_theme_option('sidebar_widgets');
	avicenna_storage_set('current_sidebar', 'sidebar');
	if ( is_active_sidebar($avicenna_sidebar_name) ) {
		dynamic_sidebar($avicenna_sidebar_name);
	}
	$avicenna_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($avicenna_out)) {
		$avicenna_sidebar_position = avicenna_get_theme_option('sidebar_position');
		?>
		<div class="sidebar <?php echo esc_attr($avicenna_sidebar_position); ?> widget_area<?php if (!avicenna_is_inherit(avicenna_get_theme_option('sidebar_scheme'))) echo ' scheme_'.esc_attr(avicenna_get_theme_option('sidebar_scheme')); ?>" role="complementary">
			<div class="sidebar_inner">
				<?php
				do_action( 'avicenna_action_before_sidebar' );
				avicenna_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $avicenna_out));
				do_action( 'avicenna_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<?php
	}
}
?>