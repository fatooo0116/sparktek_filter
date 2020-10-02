<?php 


add_shortcode( 'stbox', 'sh_textbox_func' );
function sh_textbox_func( $atts ) {
    $atts = shortcode_atts( array(
        'id' => 0,        
    ), $atts, 'bartag' );
 
    ob_start();
    
    $content_post = get_post($atts['id']);
    $content = $content_post->post_content;
    $content = apply_filters('the_content', $content);

    echo do_shortcode($content);

    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
