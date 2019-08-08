<?php

function berkeley_eng_content_model_post_types() {
	
	add_post_type_support( 'page', 'excerpt' );

	$cpts = get_option( 'berkeley_cpts', array() );
	
	$supports = array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'genesis_seo', 'genesis-cpt-archives-settings', 'genesis-simple-sidebars' );

	if ( $cpts['people'] ) {
		$labels = array(
			'name'                	=> esc_html_x( 'People', 'Post Type General Name','beng' ),
			'singular_name'       	=> esc_html_x( 'Person', 'Post Type Singular Name', 'beng' ),
			'menu_name'           	=> esc_html__( 'People', 'beng' ),
			'parent_item_colon'   	=> esc_html__( 'Parent Person:', 'beng' ),
			'all_items'           	=> esc_html__( 'All People', 'beng' ),
			'view_item'           	=> esc_html__( 'View Person', 'beng' ),
			'add_new_item'         	=> esc_html__( 'Add New Person', 'beng' ),
			'add_new'             	=> esc_html__( 'Add New', 'beng' ),
			'edit_item'           	=> esc_html__( 'Edit Person', 'beng' ),
			'update_item'         	=> esc_html__( 'Update Person', 'beng' ),
			'search_items'        	=> esc_html__( 'Search People', 'beng' ),
			'not_found'           	=> esc_html__( 'No people found', 'beng' ),
			'not_found_in_trash'  	=> esc_html__( 'No people found in Trash', 'beng' ),
			'featured_image'		=> esc_html__( 'Portrait', 'beng' ),
			'set_featured_image'	=> esc_html__( 'Set portrait', 'beng' ),
			'remove_featured_image'	=> esc_html__( 'Remove portrait', 'beng' ),
			'use_featured_image'	=> esc_html__( 'Use as portrait', 'beng' ),
		);
		$args = array(
			'label'               => esc_html__( 'people', 'beng' ),
			'description'         => esc_html__( 'People', 'beng' ),
			'labels'              => $labels,
			'supports'            => $supports,
			'hierarchical'        => true,
			'public'              => true,
			'show_in_rest'		  => true,
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
			'name'                => esc_html_x( 'Publications', 'Post Type General Name', 'beng' ),
			'singular_name'       => esc_html_x( 'Publication', 'Post Type Singular Name', 'beng' ),
			'menu_name'           => esc_html__( 'Publications', 'beng' ),
			'parent_item_colon'   => esc_html__( 'Parent Publication:', 'beng' ),
			'all_items'           => esc_html__( 'All Publications', 'beng' ),
			'view_item'           => esc_html__( 'View Publication', 'beng' ),
			'add_new_item'        => esc_html__( 'Add New Publication', 'beng' ),
			'add_new'             => esc_html__( 'Add New', 'beng' ),
			'edit_item'           => esc_html__( 'Edit Publication', 'beng' ),
			'update_item'         => esc_html__( 'Update Publication', 'beng' ),
			'search_items'        => esc_html__( 'Search Publications', 'beng' ),
			'not_found'           => esc_html__( 'No publications found', 'beng' ),
			'not_found_in_trash'  => esc_html__( 'No publications found in Trash', 'beng' ),
		);
		$args = array(
			'labels'              => $labels,
			'supports'            => $supports,
			'hierarchical'        => false,
			'public'              => true,
			'show_in_rest'		  => true,
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
			'name'                => esc_html_x( 'Facilities', 'Post Type General Name', 'beng' ),
			'singular_name'       => esc_html_x( 'Facility', 'Post Type Singular Name', 'beng' ),
			'menu_name'           => esc_html__( 'Facilities', 'beng' ),
			'name_admin_bar'      => esc_html__( 'Facility', 'beng' ),
			'parent_item_colon'   => esc_html__( 'Parent Facility:', 'beng' ),
			'all_items'           => esc_html__( 'All Facilities', 'beng' ),
			'add_new_item'        => esc_html__( 'Add New Facility', 'beng' ),
			'add_new'             => esc_html__( 'Add New', 'beng' ),
			'new_item'            => esc_html__( 'New Facility', 'beng' ),
			'edit_item'           => esc_html__( 'Edit Facility', 'beng' ),
			'update_item'         => esc_html__( 'Update Facility', 'beng' ),
			'view_item'           => esc_html__( 'View Facility', 'beng' ),
			'search_items'        => esc_html__( 'Search Facility', 'beng' ),
			'not_found'           => esc_html__( 'No facilities found', 'beng' ),
			'not_found_in_trash'  => esc_html__( 'No facilities found in Trash', 'beng' ),
		);
		$args = array(
			'label'               => esc_html__( 'Facilities', 'beng' ),
			'labels'              => $labels,
			'supports'            => $supports,
			'hierarchical'        => false,
			'public'              => true,
			'show_in_rest'		  => true,
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
			'name'                => esc_html_x( 'Research', 'Post Type General Name', 'beng' ),
			'singular_name'       => esc_html_x( 'Research', 'Post Type Singular Name', 'beng' ),
			'menu_name'           => esc_html__( 'Research', 'beng' ),
			'name_admin_bar'      => esc_html__( 'Research', 'beng' ),
			'parent_item_colon'   => esc_html__( 'Parent Research:', 'beng' ),
			'all_items'           => esc_html__( 'All Research', 'beng' ),
			'add_new_item'        => esc_html__( 'Add New Research', 'beng' ),
			'add_new'             => esc_html__( 'Add New', 'beng' ),
			'new_item'            => esc_html__( 'New Research', 'beng' ),
			'edit_item'           => esc_html__( 'Edit Research', 'beng' ),
			'update_item'         => esc_html__( 'Update Research', 'beng' ),
			'view_item'           => esc_html__( 'View Research', 'beng' ),
			'search_items'        => esc_html__( 'Search Research', 'beng' ),
			'not_found'           => esc_html__( 'No research found', 'beng' ),
			'not_found_in_trash'  => esc_html__( 'No research found in Trash', 'beng' ),
		);
		$args = array(
			'label'               => esc_html__( 'Research', 'beng' ),
			'labels'              => $labels,
			'supports'            => $supports,
			'hierarchical'        => false,
			'public'              => true,
			'show_in_rest'		  => true,
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
			'name'                => esc_html_x( 'Courses', 'Post Type General Name', 'beng' ),
			'singular_name'       => esc_html_x( 'Course', 'Post Type Singular Name', 'beng' ),
			'menu_name'           => esc_html__( 'Courses', 'beng' ),
			'name_admin_bar'      => esc_html__( 'Courses', 'beng' ),
			'parent_item_colon'   => esc_html__( 'Parent Course:', 'beng' ),
			'all_items'           => esc_html__( 'All Courses', 'beng' ),
			'add_new_item'        => esc_html__( 'Add New Course', 'beng' ),
			'add_new'             => esc_html__( 'Add New', 'beng' ),
			'new_item'            => esc_html__( 'New Course', 'beng' ),
			'edit_item'           => esc_html__( 'Edit Course', 'beng' ),
			'update_item'         => esc_html__( 'Update Course', 'beng' ),
			'view_item'           => esc_html__( 'View Course', 'beng' ),
			'search_items'        => esc_html__( 'Search Courses', 'beng' ),
			'not_found'           => esc_html__( 'No courses found', 'beng' ),
			'not_found_in_trash'  => esc_html__( 'No courses found in Trash', 'beng' ),
		);
		$args = array(
			'label'               => esc_html__( 'Courses', 'beng' ),
			'labels'              => $labels,
			'supports'            => $supports,
			'hierarchical'        => false,
			'public'              => true,
			'show_in_rest'		  => true,
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