<?php 

add_action( 'init', 'posts_init' );
/**
 * Register a report post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function posts_init() {
	$labels = array(
		'name' => 'Choreographer',
	);

	$args = array(
		'labels'				=> $labels,
		'supports'				=> array(
            'title',
            'thumbnail',
            'editor',
            'custom-fields',
            'page-attributes',
        ),
		'publicly_queryable'	=> true,
        'public'                => true,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
        'hierarchical'          => true,
        'capability_type'       => 'page',
		'menu_icon'				=> 'dashicons-admin-users',
		'rewrite'				=> array(
			'slug'				=> 'choreographer',
		),
	);

	register_post_type('choreographer', $args);

    $labels = array(
		'name' => 'Styles',
	);

	$args = array(
		'labels'				=> $labels,
		'supports'				=> array(
            'title',
            'thumbnail',
            'editor',
            'custom-fields',
            'page-attributes',
        ),
		'publicly_queryable'	=> true,
        'public'                => true,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
        'hierarchical'          => true,
        'capability_type'       => 'page',
		'menu_icon'				=> 'dashicons-admin-site-alt3',
		'rewrite'				=> array(
			'slug'				=> 'styles',
		),
	);

	register_post_type('styles', $args);

	$labels = array(
		'name' => 'Locations',
	);

	$args = array(
		'labels'				=> $labels,
		'supports'				=> array(
            'title',
            'thumbnail',
            'editor',
            'custom-fields',
        ),
		'publicly_queryable'	=> true,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
		'menu_icon'				=> 'dashicons-awards',
		'rewrite'				=> array(
			'slug'				=> 'locations',
		),
	);

	register_post_type('locations', $args);
	
	$labels = array(
		'name' => 'Team',
	);

	$args = array(
		'labels'				=> $labels,
		'supports'				=> array(
            'title',
			'thumbnail'
        ),
		'publicly_queryable'	=> false,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
		'menu_icon'				=> 'dashicons-groups',
		'rewrite'				=> array(
			'slug'				=> 'team',
		),
	);

	register_post_type('team', $args);
	

	$labels = array(
		'name' => 'Faq',
	);

	$args = array(
		'labels'				=> $labels,
		'supports'				=> array(
            'title',
            'thumbnail',
            'editor',
            'custom-fields',
            'page-attributes',
        ),
		'publicly_queryable'	=> false,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
        'show_in_rest'          => true,
		'menu_icon'				=> 'dashicons-info',
		'rewrite'				=> array(
			'slug'				=> 'faq',
		),
	);

	register_post_type('faq', $args);

    $labels = array(
		'name' => 'Schedule',
	);

	$args = array(
		'labels'				=> $labels,
		'supports'				=> array(
            'title',
            'thumbnail',
            'editor',
            'custom-fields',
            'page-attributes',
        ),
		'publicly_queryable'	=> true,
        'public'                => true,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
        'hierarchical'          => true,
        'capability_type'       => 'page',
		'menu_icon'				=> 'dashicons-universal-access',
		'rewrite'				=> array(
			'slug'				=> 'schedule',
		),
	);

	register_post_type('schedule', $args);
	
}

function ddc_nl_rewrite_rules(){
	posts_init();
	flush_rewrite_rules();
}

add_action( 'after_switch_theme', 'ddc_nl_rewrite_rules');
