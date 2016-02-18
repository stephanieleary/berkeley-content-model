<?php


function berkeley_content_model_post_types() {

	$cpts = get_option( 'berkeley_cpts', array() );
	
	$supports = array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'genesis_seo', 'genesis-cpt-archives-settings', 'genesis-simple-sidebars' );

	if ( $cpts['people'] ) {
		$labels = array(
			'name'                	=> _x( 'People', 'Post Type General Name' ),
			'singular_name'       	=> _x( 'Person', 'Post Type Singular Name' ),
			'menu_name'           	=> __( 'People' ),
			'parent_item_colon'   	=> __( 'Parent Person:' ),
			'all_items'           	=> __( 'All People' ),
			'view_item'           	=> __( 'View Person' ),
			'add_new_item'         	=> __( 'Add New Person' ),
			'add_new'             	=> __( 'Add New' ),
			'edit_item'           	=> __( 'Edit Person' ),
			'update_item'         	=> __( 'Update Person' ),
			'search_items'        	=> __( 'Search People' ),
			'not_found'           	=> __( 'No people found' ),
			'not_found_in_trash'  	=> __( 'No people found in Trash' ),
			'featured_image'	  	=> __( 'Portrait' ),
			'set_featured_image'	=> __( 'Set portrait' ),
			'remove_featured_image'	=> __( 'Remove portrait' ),
			'use_featured_image'	=> __( 'Use as portrait' ),
		);
		$args = array(
			'label'               => __( 'people' ),
			'description'         => __( 'People' ),
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
			'name'                => _x( 'Publications', 'Post Type General Name' ),
			'singular_name'       => _x( 'Publication', 'Post Type Singular Name' ),
			'menu_name'           => __( 'Publications' ),
			'parent_item_colon'   => __( 'Parent Publication:' ),
			'all_items'           => __( 'All Publications' ),
			'view_item'           => __( 'View Publication' ),
			'add_new_item'        => __( 'Add New Publication' ),
			'add_new'             => __( 'Add New' ),
			'edit_item'           => __( 'Edit Publication' ),
			'update_item'         => __( 'Update Publication' ),
			'search_items'        => __( 'Search Publications' ),
			'not_found'           => __( 'No publications found' ),
			'not_found_in_trash'  => __( 'No publications found in Trash' ),
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
			'name'                => _x( 'Facilities', 'Post Type General Name' ),
			'singular_name'       => _x( 'Facility', 'Post Type Singular Name' ),
			'menu_name'           => __( 'Facilities' ),
			'name_admin_bar'      => __( 'Facility' ),
			'parent_item_colon'   => __( 'Parent Facility:' ),
			'all_items'           => __( 'All Facilities' ),
			'add_new_item'        => __( 'Add New Facility' ),
			'add_new'             => __( 'Add New' ),
			'new_item'            => __( 'New Facility' ),
			'edit_item'           => __( 'Edit Facility' ),
			'update_item'         => __( 'Update Facility' ),
			'view_item'           => __( 'View Facility' ),
			'search_items'        => __( 'Search Facility' ),
			'not_found'           => __( 'No facilities found' ),
			'not_found_in_trash'  => __( 'No facilities found in Trash' ),
		);
		$args = array(
			'label'               => __( 'Facilities' ),
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
			'name'                => _x( 'Research', 'Post Type General Name' ),
			'singular_name'       => _x( 'Research', 'Post Type Singular Name' ),
			'menu_name'           => __( 'Research' ),
			'name_admin_bar'      => __( 'Research' ),
			'parent_item_colon'   => __( 'Parent Research:' ),
			'all_items'           => __( 'All Research' ),
			'add_new_item'        => __( 'Add New Research' ),
			'add_new'             => __( 'Add New' ),
			'new_item'            => __( 'New Research' ),
			'edit_item'           => __( 'Edit Research' ),
			'update_item'         => __( 'Update Research' ),
			'view_item'           => __( 'View Research' ),
			'search_items'        => __( 'Search Research' ),
			'not_found'           => __( 'No research found' ),
			'not_found_in_trash'  => __( 'No research found in Trash' ),
		);
		$args = array(
			'label'               => __( 'Research' ),
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
			'name'                => _x( 'Courses', 'Post Type General Name' ),
			'singular_name'       => _x( 'Course', 'Post Type Singular Name' ),
			'menu_name'           => __( 'Courses' ),
			'name_admin_bar'      => __( 'Courses' ),
			'parent_item_colon'   => __( 'Parent Course:' ),
			'all_items'           => __( 'All Courses' ),
			'add_new_item'        => __( 'Add New Course' ),
			'add_new'             => __( 'Add New' ),
			'new_item'            => __( 'New Course' ),
			'edit_item'           => __( 'Edit Course' ),
			'update_item'         => __( 'Update Course' ),
			'view_item'           => __( 'View Course' ),
			'search_items'        => __( 'Search Courses' ),
			'not_found'           => __( 'No courses found' ),
			'not_found_in_trash'  => __( 'No courses found in Trash' ),
		);
		$args = array(
			'label'               => __( 'Courses' ),
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