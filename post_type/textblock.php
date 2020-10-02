<?php

    function wpdocs_codex_text_box_init() {
        $labels = array(
            'name'                  => _x( 'Text Boxs', 'Post type general name', 'textdomain' ),
            'singular_name'         => _x( 'Text Box', 'Post type singular name', 'textdomain' ),
            'menu_name'             => _x( 'Text Boxs', 'Admin Menu text', 'textdomain' ),
            'name_admin_bar'        => _x( 'Text Box', 'Add New on Toolbar', 'textdomain' ),
            'add_new'               => __( 'Add New', 'textdomain' ),
            'add_new_item'          => __( 'Add New Text Box', 'textdomain' ),
            'new_item'              => __( 'New Text Box', 'textdomain' ),
            'edit_item'             => __( 'Edit Text Box', 'textdomain' ),
            'view_item'             => __( 'View Text Box', 'textdomain' ),
            'all_items'             => __( 'All Text Boxs', 'textdomain' ),
            'search_items'          => __( 'Search Text Boxs', 'textdomain' ),
            'parent_item_colon'     => __( 'Parent Text Boxs:', 'textdomain' ),
            'not_found'             => __( 'No books found.', 'textdomain' ),
            'not_found_in_trash'    => __( 'No books found in Trash.', 'textdomain' ),
            'featured_image'        => _x( 'Text Box Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'archives'              => _x( 'Text Box archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
            'insert_into_item'      => _x( 'Insert into book', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
            'uploaded_to_this_item' => _x( 'Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
            'filter_items_list'     => _x( 'Filter books list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
            'items_list_navigation' => _x( 'Text Boxs list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
            'items_list'            => _x( 'Text Boxs list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
        );


    
        $args = array(
            'labels'             => $labels,
           //  'public'             => true,
           //  'publicly_queryable' => true,
            'public'             => false,
            'publicly_queryable' => false,

            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
           // 'rewrite'            => array( 'slug' => 'text_box' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => true,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'page-attributes'),
        );
    
        register_post_type( 'text_box', $args );
    }
    
    add_action( 'init', 'wpdocs_codex_text_box_init' );

?>