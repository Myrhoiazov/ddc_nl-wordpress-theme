<?php 

add_action( 'init', 'create_cat_taxonomies', 0 );

function create_cat_taxonomies() {
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x( 'Category', 'taxonomy general name' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Catagories' ),
        'all_items'         => __( 'All Catagories' ),
        'parent_item'       => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item'         => __( 'Edit Category' ),
        'update_item'       => __( 'Update Category' ),
        'add_new_item'      => __( 'Add New Category' ),
        'new_item_name'     => __( 'New Category Name' ),
        'menu_name'         => __( 'Category' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'category' ),
    );

    register_taxonomy( 'cat', array( 'team' ), $args );
    
    $labels = array(
        'name'              => _x( 'Edition', 'taxonomy general name' ),
        'singular_name'     => _x( 'Edition', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Editions' ),
        'all_items'         => __( 'All Editions' ),
        'parent_item'       => __( 'Parent Edition' ),
        'parent_item_colon' => __( 'Parent Edition:' ),
        'edit_item'         => __( 'Edit Edition' ),
        'update_item'       => __( 'Update Edition' ),
        'add_new_item'      => __( 'Add New Edition' ),
        'new_item_name'     => __( 'New Edition Name' ),
        'menu_name'         => __( 'Edition' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'edition' ),
    );

    register_taxonomy( 'edition', array( 'choreographer' ), $args );
   
    $labels = array(
        'name'              => _x( 'Edition', 'taxonomy general name' ),
        'singular_name'     => _x( 'Edition', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Editions' ),
        'all_items'         => __( 'All Editions' ),
        'parent_item'       => __( 'Parent Edition' ),
        'parent_item_colon' => __( 'Parent Edition:' ),
        'edit_item'         => __( 'Edit Edition' ),
        'update_item'       => __( 'Update Edition' ),
        'add_new_item'      => __( 'Add New Edition' ),
        'new_item_name'     => __( 'New Edition Name' ),
        'menu_name'         => __( 'Edition' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'video-edition' ),
    );

    register_taxonomy( 'video_edition', array( 'highlights' ), $args );

	$labels = array(
        'name'              => _x( 'Blocks', 'taxonomy general name' ),
        'singular_name'     => _x( 'Blocks', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Blockss' ),
        'all_items'         => __( 'All Blockss' ),
        'parent_item'       => __( 'Parent Blocks' ),
        'parent_item_colon' => __( 'Parent Blocks:' ),
        'edit_item'         => __( 'Edit Blocks' ),
        'update_item'       => __( 'Update Blocks' ),
        'add_new_item'      => __( 'Add New Blocks' ),
        'new_item_name'     => __( 'New Blocks Name' ),
        'menu_name'         => __( 'Blocks' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'video-block' ),
    );

    register_taxonomy( 'video_block', array( 'highlights' ), $args );
   
    $labels = array(
        'name'              => _x( 'Edition', 'taxonomy general name' ),
        'singular_name'     => _x( 'Edition', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Editions' ),
        'all_items'         => __( 'All Editions' ),
        'parent_item'       => __( 'Parent Edition' ),
        'parent_item_colon' => __( 'Parent Edition:' ),
        'edit_item'         => __( 'Edit Edition' ),
        'update_item'       => __( 'Update Edition' ),
        'add_new_item'      => __( 'Add New Edition' ),
        'new_item_name'     => __( 'New Edition Name' ),
        'menu_name'         => __( 'Edition' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'team-edition' ),
    );

    register_taxonomy( 'team_edition', array( 'team' ), $args );

}