<div class="front_page_section front_page_section_googlemap<?php
			$avicenna_scheme = avicenna_get_theme_option('front_page_googlemap_scheme');
			if (!avicenna_is_inherit($avicenna_scheme)) echo ' scheme_'.esc_attr($avicenna_scheme);
			echo ' front_page_section_paddings_'.esc_attr(avicenna_get_theme_option('front_page_googlemap_paddings'));
		?>"<?php
		$avicenna_css = '';
		$avicenna_bg_image = avicenna_get_theme_option('front_page_googlemap_bg_image');
		if (!empty($avicenna_bg_image)) 
			$avicenna_css .= 'background-image: url('.esc_url(avicenna_get_attachment_url($avicenna_bg_image)).');';
		if (!empty($avicenna_css))
			echo ' style="' . esc_attr($avicenna_css) . '"';
?>><?php
	// Add anchor
	$avicenna_anchor_icon = avicenna_get_theme_option('front_page_googlemap_anchor_icon');	
	$avicenna_anchor_text = avicenna_get_theme_option('front_page_googlemap_anchor_text');	
	if ((!empty($avicenna_anchor_icon) || !empty($avicenna_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_googlemap"'
										. (!empty($avicenna_anchor_icon) ? ' icon="'.esc_attr($avicenna_anchor_icon).'"' : '')
										. (!empty($avicenna_anchor_text) ? ' title="'.esc_attr($avicenna_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_googlemap_inner<?php
			if (avicenna_get_theme_option('front_page_googlemap_fullheight'))
				echo ' avicenna-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$avicenna_css = '';
			$avicenna_bg_mask = avicenna_get_theme_option('front_page_googlemap_bg_mask');
			$avicenna_bg_color = avicenna_get_theme_option('front_page_googlemap_bg_color');
			if (!empty($avicenna_bg_color) && $avicenna_bg_mask > 0)
				$avicenna_css .= 'background-color: '.esc_attr($avicenna_bg_mask==1
																	? $avicenna_bg_color
																	: avicenna_hex2rgba($avicenna_bg_color, $avicenna_bg_mask)
																).';';
			if (!empty($avicenna_css))
				echo ' style="' . esc_attr($avicenna_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_googlemap_content_wrap<?php
			$avicenna_layout = avicenna_get_theme_option('front_page_googlemap_layout');
			if ($avicenna_layout != 'fullwidth')
				echo ' content_wrap';
		?>">
			<?php
			// Content wrap with title and description
			$avicenna_caption = avicenna_get_theme_option('front_page_googlemap_caption');
			$avicenna_description = avicenna_get_theme_option('front_page_googlemap_description');
			if (!empty($avicenna_caption) || !empty($avicenna_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				if ($avicenna_layout == 'fullwidth') {
					?><div class="content_wrap"><?php
				}
					// Caption
					if (!empty($avicenna_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
						?><h2 class="front_page_section_caption front_page_section_googlemap_caption front_page_block_<?php echo !empty($avicenna_caption) ? 'filled' : 'empty'; ?>"><?php
							echo wp_kses_post($avicenna_caption);
						?></h2><?php
					}
				
					// Description (text)
					if (!empty($avicenna_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
						?><div class="front_page_section_description front_page_section_googlemap_description front_page_block_<?php echo !empty($avicenna_description) ? 'filled' : 'empty'; ?>"><?php
							echo wp_kses_post(wpautop($avicenna_description));
						?></div><?php
					}
				if ($avicenna_layout == 'fullwidth') {
					?></div><?php
				}
			}

			// Content (text)
			$avicenna_content = avicenna_get_theme_option('front_page_googlemap_content');
			if (!empty($avicenna_content) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				if ($avicenna_layout == 'columns') {
					?><div class="front_page_section_columns front_page_section_googlemap_columns columns_wrap">
						<div class="column-1_3">
					<?php
				} else if ($avicenna_layout == 'fullwidth') {
					?><div class="content_wrap"><?php
				}
	
				?><div class="front_page_section_content front_page_section_googlemap_content front_page_block_<?php echo !empty($avicenna_content) ? 'filled' : 'empty'; ?>"><?php
					echo wp_kses_post($avicenna_content);
				?></div><?php
	
				if ($avicenna_layout == 'columns') {
					?></div><div class="column-2_3"><?php
				} else if ($avicenna_layout == 'fullwidth') {
					?></div><?php
				}
			}
			
			// Widgets output
			?><div class="front_page_section_output front_page_section_googlemap_output"><?php 
				if (is_active_sidebar('front_page_googlemap_widgets')) {
					dynamic_sidebar( 'front_page_googlemap_widgets' );
				} else if (current_user_can( 'edit_theme_options' )) {
					if (!avicenna_exists_trx_addons())
						avicenna_customizer_need_trx_addons_message();
					else
						avicenna_customizer_need_widgets_message('front_page_googlemap_caption', 'ThemeREX Addons - Google map');
				}
			?></div><?php

			if ($avicenna_layout == 'columns' && (!empty($avicenna_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?></div></div><?php
			}
			?>			
		</div>
	</div>
</div>