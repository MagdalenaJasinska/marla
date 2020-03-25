<?php
/**
 * The template to display the main menu
 *
 * @package WordPress
 * @subpackage AVICENNA
 * @since AVICENNA 1.0
 */
?>
<div class="head-img-sec">
	<center>
		<img src="<?php echo content_url('/uploads/2020/02/rsz_gold_logo.jpg');?>">
	</center>
</div>
<div class="top_panel_navi sc_layouts_row sc_layouts_row_type_compact sc_layouts_row_fixed sc_layouts_row_fixed_always sc_layouts_row_delimiter<?php
			if (false) {
			echo ' scheme_'. esc_attr(avicenna_is_inherit(avicenna_get_theme_option('menu_scheme')) 
												? (avicenna_is_inherit(avicenna_get_theme_option('header_scheme')) 
													? avicenna_get_theme_option('color_scheme') 
													: avicenna_get_theme_option('header_scheme')) 
												: avicenna_get_theme_option('menu_scheme'));
			}
			?> header-menu-navigate">
	<div class="content_wrap">
		<div class="columns_wrap columns_fluid">
			<?php /*?>
			<div class="sc_layouts_column sc_layouts_column_align_left sc_layouts_column_icons_position_left sc_layouts_column_fluid column-1_4">
				<?php
				// Logo
				?><div class="sc_layouts_item"><?php
					//get_template_part( 'templates/header-logo' );
				?></div>
			</div> <?php
			
			// Attention! Don't place any spaces between columns!
			*/?>
			<center>
				<!--column-3_4 sc_layouts_column_align_right-->
				<div class="adv-navigation-sec sc_layouts_column sc_layouts_column_icons_position_left sc_layouts_column_fluid column-12_12">
					<div class="sc_layouts_item">
						<?php
						// Main menu
						$avicenna_menu_main = avicenna_get_nav_menu(array(
							'location' => 'menu_main', 
							'class' => 'sc_layouts_menu sc_layouts_menu_default sc_layouts_hide_on_mobile'
							)
						);
						// Show any menu if no menu selected in the location 'menu_main'
						if (avicenna_get_theme_setting('autoselect_menu') && empty($avicenna_menu_main)) {
							$avicenna_menu_main = avicenna_get_nav_menu(array(
								'class' => 'sc_layouts_menu sc_layouts_menu_default sc_layouts_hide_on_mobile'
								)
							);
						}
						avicenna_show_layout($avicenna_menu_main);
						// Mobile menu button
						?>
						<div class="sc_layouts_iconed_text sc_layouts_menu_mobile_button">
							<a class="sc_layouts_item_link sc_layouts_iconed_text_link" href="#">
								<span class="sc_layouts_item_icon sc_layouts_iconed_text_icon trx_addons_icon-menu"></span>
							</a>
						</div>
					</div><?php
					
					/*if (avicenna_exists_trx_addons()) {
						?><div class="sc_layouts_item"><?php
							// Display search field
							do_action('avicenna_action_search', 'fullscreen', 'header_search', false);
						?></div><?php
					}*/
					?>
				</div>
			</center>
		</div><!-- /.columns_wrap -->
	</div><!-- /.content_wrap -->
</div><!-- /.top_panel_navi -->