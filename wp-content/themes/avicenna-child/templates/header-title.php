<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage AVICENNA
 * @since AVICENNA 1.0
 */

// Page (category, tag, archive, author) title

if ( avicenna_need_page_title() ) {
	avicenna_sc_layouts_showed('title', true);
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Blog/Post title
						?><div class="sc_layouts_title_title"><?php
							$avicenna_blog_title = avicenna_get_blog_title();
							$avicenna_blog_title_text = $avicenna_blog_title_class = $avicenna_blog_title_link = $avicenna_blog_title_link_text = '';
							if (is_array($avicenna_blog_title)) {
								$avicenna_blog_title_text = $avicenna_blog_title['text'];
								$avicenna_blog_title_class = !empty($avicenna_blog_title['class']) ? ' '.$avicenna_blog_title['class'] : '';
								$avicenna_blog_title_link = !empty($avicenna_blog_title['link']) ? $avicenna_blog_title['link'] : '';
								$avicenna_blog_title_link_text = !empty($avicenna_blog_title['link_text']) ? $avicenna_blog_title['link_text'] : '';
							} else
								$avicenna_blog_title_text = $avicenna_blog_title;
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr($avicenna_blog_title_class); ?>"><?php
								$avicenna_top_icon = avicenna_get_category_icon();
								if (!empty($avicenna_top_icon)) {
									$avicenna_attr = avicenna_getimagesize($avicenna_top_icon);
									?><img src="<?php echo esc_url($avicenna_top_icon); ?>"  <?php if (!empty($avicenna_attr[3])) avicenna_show_layout($avicenna_attr[3]);?>><?php
								}
								echo wp_kses_post($avicenna_blog_title_text);
							?></h1>
							<?php
							if (!empty($avicenna_blog_title_link) && !empty($avicenna_blog_title_link_text)) {
								?><a href="<?php echo esc_url($avicenna_blog_title_link); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html($avicenna_blog_title_link_text); ?></a><?php
							}
							
							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) 
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
		
						?></div><?php
	
						// Breadcrumbs
						?><div class="sc_layouts_title_breadcrumbs"><?php
							do_action( 'avicenna_action_breadcrumbs');
						?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>