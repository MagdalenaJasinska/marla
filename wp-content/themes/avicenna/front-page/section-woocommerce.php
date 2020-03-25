<div class="front_page_section front_page_section_woocommerce<?php
			$avicenna_scheme = avicenna_get_theme_option('front_page_woocommerce_scheme');
			if (!avicenna_is_inherit($avicenna_scheme)) echo ' scheme_'.esc_attr($avicenna_scheme);
			echo ' front_page_section_paddings_'.esc_attr(avicenna_get_theme_option('front_page_woocommerce_paddings'));
		?>"<?php
		$avicenna_css = '';
		$avicenna_bg_image = avicenna_get_theme_option('front_page_woocommerce_bg_image');
		if (!empty($avicenna_bg_image)) 
			$avicenna_css .= 'background-image: url('.esc_url(avicenna_get_attachment_url($avicenna_bg_image)).');';
		if (!empty($avicenna_css))
			echo ' style="' . esc_attr($avicenna_css) . '"';
?>><?php
	// Add anchor
	$avicenna_anchor_icon = avicenna_get_theme_option('front_page_woocommerce_anchor_icon');	
	$avicenna_anchor_text = avicenna_get_theme_option('front_page_woocommerce_anchor_text');	
	if ((!empty($avicenna_anchor_icon) || !empty($avicenna_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_woocommerce"'
										. (!empty($avicenna_anchor_icon) ? ' icon="'.esc_attr($avicenna_anchor_icon).'"' : '')
										. (!empty($avicenna_anchor_text) ? ' title="'.esc_attr($avicenna_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_woocommerce_inner<?php
			if (avicenna_get_theme_option('front_page_woocommerce_fullheight'))
				echo ' avicenna-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$avicenna_css = '';
			$avicenna_bg_mask = avicenna_get_theme_option('front_page_woocommerce_bg_mask');
			$avicenna_bg_color = avicenna_get_theme_option('front_page_woocommerce_bg_color');
			if (!empty($avicenna_bg_color) && $avicenna_bg_mask > 0)
				$avicenna_css .= 'background-color: '.esc_attr($avicenna_bg_mask==1
																	? $avicenna_bg_color
																	: avicenna_hex2rgba($avicenna_bg_color, $avicenna_bg_mask)
																).';';
			if (!empty($avicenna_css))
				echo ' style="' . esc_attr($avicenna_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_woocommerce_content_wrap content_wrap woocommerce">
			<?php
			// Content wrap with title and description
			$avicenna_caption = avicenna_get_theme_option('front_page_woocommerce_caption');
			$avicenna_description = avicenna_get_theme_option('front_page_woocommerce_description');
			if (!empty($avicenna_caption) || !empty($avicenna_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				// Caption
				if (!empty($avicenna_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><h2 class="front_page_section_caption front_page_section_woocommerce_caption front_page_block_<?php echo !empty($avicenna_caption) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses_post($avicenna_caption);
					?></h2><?php
				}
			
				// Description (text)
				if (!empty($avicenna_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><div class="front_page_section_description front_page_section_woocommerce_description front_page_block_<?php echo !empty($avicenna_description) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses_post(wpautop($avicenna_description));
					?></div><?php
				}
			}
		
			// Content (widgets)
			?><div class="front_page_section_output front_page_section_woocommerce_output list_products shop_mode_thumbs"><?php 
				$avicenna_woocommerce_sc = avicenna_get_theme_option('front_page_woocommerce_products');
				if ($avicenna_woocommerce_sc == 'products') {
					$avicenna_woocommerce_sc_ids = avicenna_get_theme_option('front_page_woocommerce_products_per_page');
					$avicenna_woocommerce_sc_per_page = count(explode(',', $avicenna_woocommerce_sc_ids));
				} else {
					$avicenna_woocommerce_sc_per_page = max(1, (int) avicenna_get_theme_option('front_page_woocommerce_products_per_page'));
				}
				$avicenna_woocommerce_sc_columns = max(1, min($avicenna_woocommerce_sc_per_page, (int) avicenna_get_theme_option('front_page_woocommerce_products_columns')));
				echo do_shortcode("[{$avicenna_woocommerce_sc}"
									. ($avicenna_woocommerce_sc == 'products' 
											? ' ids="'.esc_attr($avicenna_woocommerce_sc_ids).'"' 
											: '')
									. ($avicenna_woocommerce_sc == 'product_category' 
											? ' category="'.esc_attr(avicenna_get_theme_option('front_page_woocommerce_products_categories')).'"' 
											: '')
									. ($avicenna_woocommerce_sc != 'best_selling_products' 
											? ' orderby="'.esc_attr(avicenna_get_theme_option('front_page_woocommerce_products_orderby')).'"'
											  . ' order="'.esc_attr(avicenna_get_theme_option('front_page_woocommerce_products_order')).'"' 
											: '')
									. ' per_page="'.esc_attr($avicenna_woocommerce_sc_per_page).'"' 
									. ' columns="'.esc_attr($avicenna_woocommerce_sc_columns).'"' 
									. ']');
			?></div>
		</div>
	</div>
</div>