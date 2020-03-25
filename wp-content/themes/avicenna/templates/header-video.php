<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage AVICENNA
 * @since AVICENNA 1.0.14
 */
$avicenna_header_video = avicenna_get_header_video();
$avicenna_embed_video = '';
if (!empty($avicenna_header_video) && !avicenna_is_from_uploads($avicenna_header_video)) {
	if (avicenna_is_youtube_url($avicenna_header_video) && preg_match('/[=\/]([^=\/]*)$/', $avicenna_header_video, $matches) && !empty($matches[1])) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr($matches[1]); ?>"></div><?php
	} else {
		global $wp_embed;
		if (false && is_object($wp_embed)) {
			$avicenna_embed_video = do_shortcode($wp_embed->run_shortcode( '[embed]' . trim($avicenna_header_video) . '[/embed]' ));
			$avicenna_embed_video = avicenna_make_video_autoplay($avicenna_embed_video);
		} else {
			$avicenna_header_video = str_replace('/watch?v=', '/embed/', $avicenna_header_video);
			$avicenna_header_video = avicenna_add_to_url($avicenna_header_video, array(
				'feature' => 'oembed',
				'controls' => 0,
				'autoplay' => 1,
				'showinfo' => 0,
				'modestbranding' => 1,
				'wmode' => 'transparent',
				'enablejsapi' => 1,
				'origin' => home_url(),
				'widgetid' => 1
			));
			$avicenna_embed_video = '<iframe src="' . esc_url($avicenna_header_video) . '" width="1170" height="658" allowfullscreen="0" frameborder="0"></iframe>';
		}
		?><div id="background_video"><?php avicenna_show_layout($avicenna_embed_video); ?></div><?php
	}
}
?>