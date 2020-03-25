<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage AVICENNA
 * @since AVICENNA 1.0
 */

						// Widgets area inside page content
						avicenna_create_widgets_area('widgets_below_content');
						?>				
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					// get_sidebar();

					// Widgets area below page content
					avicenna_create_widgets_area('widgets_below_page');

					$avicenna_body_style = avicenna_get_theme_option('body_style');
					if ($avicenna_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$avicenna_footer_type = avicenna_get_theme_option("footer_type");
			if ($avicenna_footer_type == 'custom' && !avicenna_is_layouts_available())
				$avicenna_footer_type = 'default';
			get_template_part( "templates/footer-{$avicenna_footer_type}");
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php if (avicenna_is_on(avicenna_get_theme_option('debug_mode')) && avicenna_get_file_dir('images/makeup.jpg')!='') { ?>
		<img src="<?php echo esc_url(avicenna_get_file_url('images/makeup.jpg')); ?>" id="makeup">
	<?php } ?>

	<?php wp_footer(); ?>

</body>
</html>