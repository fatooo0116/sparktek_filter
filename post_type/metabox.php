<?php

function call_someClass() {
    new someClass();
}
 
if ( is_admin() ) {
    add_action( 'load-post.php',     'call_someClass' );
    add_action( 'load-post-new.php', 'call_someClass' );
}
 
/**
 * The Class.
 */
class someClass {
 
    /**
     * Hook into the appropriate actions when the class is constructed.
     */
    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
        add_action( 'save_post',      array( $this, 'save'         ) );
    }
 
    /**
     * Adds the meta box container.
     */
    public function add_meta_box( $post_type ) {
        // Limit meta box to certain post types.
        $post_types = array( 'text_box' );
 
        if ( in_array( $post_type, $post_types ) ) {
            add_meta_box(
                'some_meta_box_name',
                __( 'Some Meta Box Headline', 'textdomain' ),
                array( $this, 'render_meta_box_content' ),
                $post_type,
                'side',
                'default'
            );
        }
    }
 
 
    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function render_meta_box_content( $post ) {
 
        // Add an nonce field so we can check for it later.
        wp_nonce_field( 'myplugin_inner_custom_box', 'myplugin_inner_custom_box_nonce' );
 
       

        $myid = $post->ID;
        $tbox = '[stbox id=&quot;'.$myid.'&quot;  title=&quot;'.get_the_title().'&quot; ]';
       
        ?>

        <input type="text"  name="" value="<?php echo $tbox; ?>" style="width:100%;font-size:16px" readonly />
        <?php
    }
}


?>