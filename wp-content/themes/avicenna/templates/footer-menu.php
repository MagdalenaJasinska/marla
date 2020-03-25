<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage AVICENNA
 * @since AVICENNA 1.0.10
 */

// Footer menu
$avicenna_menu_footer = avicenna_get_nav_menu(array(
											'location' => 'menu_footer',
											'class' => 'sc_layouts_menu sc_layouts_menu_default'
											));
if (!empty($avicenna_menu_footer)) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php avicenna_show_layout($avicenna_menu_footer); ?>
		</div>
	</div>
	<?php
}
?>