<?php

function my_theme_enqueue_styles() {

    $parent_style = 'blog';
 
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . './style.css', array( $parent_style ), wp_get_theme()->get('Version'));


}

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

// Change excerpt to 10 words length
function mytheme_custom_excerpt_length( $length ) {
    return 15;
}
add_filter( 'excerpt_length', 'mytheme_custom_excerpt_length', 999 );


// Changing excerpt more
function new_excerpt_more($more) {
    global $post;
    return '… <a href="'. get_permalink($post->ID) . '">' . 'read more' . '</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');