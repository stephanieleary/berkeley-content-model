<?php

function berkeley_content_model_post_types() {
	
	add_post_type_support( 'page', 'excerpt' );

	$cpts = get_option( 'berkeley_cpts', array() );
	
	$supports = array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'genesis_seo', 'genesis-cpt-archives-settings', 'genesis-simple-sidebars' );

	if ( $cpts['people'] ) {
		$labels = array(
			'name'                	=> esc_html_x( 'People', 'Post Type General Name' ),
			'singular_name'       	=> esc_html_x( 'Person', 'Post Type Singular Name' ),
			'menu_name'           	=> esc_html__( 'People' ),
			'parent_item_colon'   	=> esc_html__( 'Parent Person:' ),
			'all_items'           	=> esc_html__( 'All People' ),
			'view_item'           	=> esc_html__( 'View Person' ),
			'add_new_item'         	=> esc_html__( 'Add New Person' ),
			'add_new'             	=> esc_html__( 'Add New' ),
			'edit_item'           	=> esc_html__( 'Edit Person' ),
			'update_item'         	=> esc_html__( 'Update Person' ),
			'search_items'        	=> esc_html__( 'Search People' ),
			'not_found'           	=> esc_html__( 'No people found' ),
			'not_found_in_trash'  	=> esc_html__( 'No people found in Trash' ),
			'featured_image'	=> esc_html__( 'Portrait' ),
			'set_featured_image'	=> esc_html__( 'Set portrait' ),
			'remove_featured_image'	=> esc_html__( 'Remove portrait' ),
			'use_featured_image'	=> esc_html__( 'Use as portrait' ),
		);
		$args = array(
			'label'               => esc_html__( 'people' ),
			'description'         => esc_html__( 'People' ),
			'labels'              => $labels,
			'supports'            => $supports,
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 25,
			'menu_icon'			  => 'dashicons-id-alt',
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		register_post_type( 'people', $args );
	}

	if ( $cpts['publication'] ) {
		$labels = array(
			'name'                => esc_html_x( 'Publications', 'Post Type General Name' ),
			'singular_name'       => esc_html_x( 'Publication', 'Post Type Singular Name' ),
			'menu_name'           => esc_html__( 'Publications' ),
			'parent_item_colon'   => esc_html__( 'Parent Publication:' ),
			'all_items'           => esc_html__( 'All Publications' ),
			'view_item'           => esc_html__( 'View Publication' ),
			'add_new_item'        => esc_html__( 'Add New Publication' ),
			'add_new'             => esc_html__( 'Add New' ),
			'edit_item'           => esc_html__( 'Edit Publication' ),
			'update_item'         => esc_html__( 'Update Publication' ),
			'search_items'        => esc_html__( 'Search Publications' ),
			'not_found'           => esc_html__( 'No publications found' ),
			'not_found_in_trash'  => esc_html__( 'No publications found in Trash' ),
		);
		$args = array(
			'labels'              => $labels,
			'supports'            => $supports,
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 25,
			'menu_icon'			  => 'dashicons-book-alt',
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		register_post_type( 'publication', $args );
	}

	if ( $cpts['facility'] ) {
		$labels = array(
			'name'                => esc_html_x( 'Facilities', 'Post Type General Name' ),
			'singular_name'       => esc_html_x( 'Facility', 'Post Type Singular Name' ),
			'menu_name'           => esc_html__( 'Facilities' ),
			'name_admin_bar'      => esc_html__( 'Facility' ),
			'parent_item_colon'   => esc_html__( 'Parent Facility:' ),
			'all_items'           => esc_html__( 'All Facilities' ),
			'add_new_item'        => esc_html__( 'Add New Facility' ),
			'add_new'             => esc_html__( 'Add New' ),
			'new_item'            => esc_html__( 'New Facility' ),
			'edit_item'           => esc_html__( 'Edit Facility' ),
			'update_item'         => esc_html__( 'Update Facility' ),
			'view_item'           => esc_html__( 'View Facility' ),
			'search_items'        => esc_html__( 'Search Facility' ),
			'not_found'           => esc_html__( 'No facilities found' ),
			'not_found_in_trash'  => esc_html__( 'No facilities found in Trash' ),
		);
		$args = array(
			'label'               => esc_html__( 'Facilities' ),
			'labels'              => $labels,
			'supports'            => $supports,
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 25,
			'menu_icon'           => 'dashicons-building',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,		
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		register_post_type( 'facility', $args );
	}
	
	if ( $cpts['research'] ) {
		$labels = array(
			'name'                => esc_html_x( 'Research', 'Post Type General Name' ),
			'singular_name'       => esc_html_x( 'Research', 'Post Type Singular Name' ),
			'menu_name'           => esc_html__( 'Research' ),
			'name_admin_bar'      => esc_html__( 'Research' ),
			'parent_item_colon'   => esc_html__( 'Parent Research:' ),
			'all_items'           => esc_html__( 'All Research' ),
			'add_new_item'        => esc_html__( 'Add New Research' ),
			'add_new'             => esc_html__( 'Add New' ),
			'new_item'            => esc_html__( 'New Research' ),
			'edit_item'           => esc_html__( 'Edit Research' ),
			'update_item'         => esc_html__( 'Update Research' ),
			'view_item'           => esc_html__( 'View Research' ),
			'search_items'        => esc_html__( 'Search Research' ),
			'not_found'           => esc_html__( 'No research found' ),
			'not_found_in_trash'  => esc_html__( 'No research found in Trash' ),
		);
		$args = array(
			'label'               => esc_html__( 'Research' ),
			'labels'              => $labels,
			'supports'            => $supports,
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 25,
			'menu_icon'           => 'dashicons-lightbulb',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,		
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		register_post_type( 'research', $args );
	}
	
	if ( $cpts['course'] ) {
		$labels = array(
			'name'                => esc_html_x( 'Courses', 'Post Type General Name' ),
			'singular_name'       => esc_html_x( 'Course', 'Post Type Singular Name' ),
			'menu_name'           => esc_html__( 'Courses' ),
			'name_admin_bar'      => esc_html__( 'Courses' ),
			'parent_item_colon'   => esc_html__( 'Parent Course:' ),
			'all_items'           => esc_html__( 'All Courses' ),
			'add_new_item'        => esc_html__( 'Add New Course' ),
			'add_new'             => esc_html__( 'Add New' ),
			'new_item'            => esc_html__( 'New Course' ),
			'edit_item'           => esc_html__( 'Edit Course' ),
			'update_item'         => esc_html__( 'Update Course' ),
			'view_item'           => esc_html__( 'View Course' ),
			'search_items'        => esc_html__( 'Search Courses' ),
			'not_found'           => esc_html__( 'No courses found' ),
			'not_found_in_trash'  => esc_html__( 'No courses found in Trash' ),
		);
		$args = array(
			'label'               => esc_html__( 'Courses' ),
			'labels'              => $labels,
			'supports'            => $supports,
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 25,
			'menu_icon'           => 'dashicons-welcome-learn-more',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,		
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		register_post_type( 'course', $args );
	}
	
}