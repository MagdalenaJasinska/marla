<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
	$parent_style = 'avicenna-style';
    wp_enqueue_style( 'avicenna-style', get_template_directory_uri() . '/style.css' );
 	wp_enqueue_style( 'avicenna-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        null,
        'all'
        //wp_get_theme()->get('Version')
    );
}