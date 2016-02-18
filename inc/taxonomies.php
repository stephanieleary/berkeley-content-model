<?php


// hide taxonomy metaboxes for fields that are shown in ACF
add_action( 'admin_menu', 'berkeley_engineering_remove_tax_metaboxes' );
function berkeley_engineering_remove_tax_metaboxes() {
	remove_meta_box( 'tagsdiv-people-type', 'people', 'side' );
	remove_meta_box( 'tagsdiv-facility-type', 'facility', 'side' );
}


// register taxonomies

function berkeley_content_model_taxonomies() {
	
	$labels = array(
		'name'                       => _x( 'People Types', 'Taxonomy General Name' ),
		'singular_name'              => _x( 'People Type', 'Taxonomy Singular Name' ),
		'menu_name'                  => __( 'People Types' ),
		'all_items'                  => __( 'People Types' ),
		'parent_item'                => __( 'Parent Type' ),
		'parent_item_colon'          => __( 'Parent Type:' ),
		'new_item_name'              => __( 'New Type' ),
		'add_new_item'               => __( 'Add New Type' ),
		'edit_item'                  => __( 'Edit Type' ),
		'update_item'                => __( 'Update Type' ),
		'view_item'                  => __( 'View Type' ),
		'separate_items_with_commas' => __( 'Separate types with commas' ),
		'add_or_remove_items'        => __( 'Add or remove types' ),
		'choose_from_most_used'      => __( 'Choose from the most used' ),
		'popular_items'              => __( 'Popular Types' ),
		'search_items'               => __( 'Search Types' ),
		'not_found'                  => __( 'No Types Found' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
	);
	register_taxonomy( 'people_type', array( 'people' ), $args );
	
	$labels = array(
		'name'                       => _x( 'Departments', 'Taxonomy General Name' ),
		'singular_name'              => _x( 'Department', 'Taxonomy Singular Name' ),
		'menu_name'                  => __( 'Department' ),
		'all_items'                  => __( 'Departments' ),
		'parent_item'                => __( 'Parent Department' ),
		'parent_item_colon'          => __( 'Parent Department:' ),
		'new_item_name'              => __( 'New Department' ),
		'add_new_item'               => __( 'Add New Department' ),
		'edit_item'                  => __( 'Edit Department' ),
		'update_item'                => __( 'Update Department' ),
		'view_item'                  => __( 'View Department' ),
		'separate_items_with_commas' => __( 'Separate departments with commas' ),
		'add_or_remove_items'        => __( 'Add or remove departments' ),
		'choose_from_most_used'      => __( 'Choose from the most used' ),
		'popular_items'              => __( 'Popular Departments' ),
		'search_items'               => __( 'Search Departments' ),
		'not_found'                  => __( 'No Departments Found' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'department', array( 'people', 'course' ), $args );
		
	$labels = array(
		'name'                       => _x( 'Research Interests', 'Taxonomy General Name' ),
		'singular_name'              => _x( 'Research Interest', 'Taxonomy Singular Name' ),
		'menu_name'                  => __( 'Research Interest' ),
		'all_items'                  => __( 'Research Interests' ),
		'parent_item'                => __( 'Parent Interest' ),
		'parent_item_colon'          => __( 'Parent Interest:' ),
		'new_item_name'              => __( 'New Interest' ),
		'add_new_item'               => __( 'Add New Interest' ),
		'edit_item'                  => __( 'Edit Interest' ),
		'update_item'                => __( 'Update Interest' ),
		'view_item'                  => __( 'View Interest' ),
		'separate_items_with_commas' => __( 'Separate interests with commas' ),
		'add_or_remove_items'        => __( 'Add or remove interests' ),
		'choose_from_most_used'      => __( 'Choose from the most used' ),
		'popular_items'              => __( 'Popular Interests' ),
		'search_items'               => __( 'Search Interests' ),
		'not_found'                  => __( 'No Interests Found' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'interest', array( 'people' ), $args );

	$labels = array(
		'name'                       => _x( 'Facility Types', 'Taxonomy General Name' ),
		'singular_name'              => _x( 'Facility Type', 'Taxonomy Singular Name' ),
		'menu_name'                  => __( 'Facility Type' ),
		'all_items'                  => __( 'Facility Types' ),
		'parent_item'                => __( 'Parent Type' ),
		'parent_item_colon'          => __( 'Parent Type:' ),
		'new_item_name'              => __( 'New Type' ),
		'add_new_item'               => __( 'Add New Type' ),
		'edit_item'                  => __( 'Edit Type' ),
		'update_item'                => __( 'Update Type' ),
		'view_item'                  => __( 'View Type' ),
		'separate_items_with_commas' => __( 'Separate types with commas' ),
		'add_or_remove_items'        => __( 'Add or remove types' ),
		'choose_from_most_used'      => __( 'Choose from the most used' ),
		'popular_items'              => __( 'Popular Types' ),
		'search_items'               => __( 'Search Types' ),
		'not_found'                  => __( 'No Types Found' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => false,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
	);
	register_taxonomy( 'facility_type', array( 'facility' ), $args );
	
	
	// Optional taxonomies
	
	$taxes = get_option( 'berkeley_taxes' );
	
	if ( isset( $taxes['committee'] ) && $taxes['committee'] ) {
		$labels = array(
			'name'                       => 'Committees',
			'singular_name'              => 'Committee',
			'menu_name'                  => 'Committees',
			'all_items'                  => 'All Committees',
			'parent_item'                => 'Parent Committee',
			'parent_item_colon'          => 'Parent Committee:',
			'new_item_name'              => 'New Committee Name',
			'add_new_item'               => 'Add New Committee',
			'edit_item'                  => 'Edit Committee',
			'update_item'                => 'Update Committee',
			'view_item'                  => 'View Committee',
			'separate_items_with_commas' => 'Separate committee with commas',
			'add_or_remove_items'        => 'Add or remove committees',
			'choose_from_most_used'      => 'Choose from the most used',
			'popular_items'              => 'Popular Committees',
			'search_items'               => 'Search Committees',
			'not_found'                  => 'No Committees Areas Found',
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		register_taxonomy( 'committee', array( 'people' ), $args );
	}
	
	if ( isset( $taxes['groups'] ) && $taxes['groups'] ) {
		$labels = array(
			'name'                       => 'Groups',
			'singular_name'              => 'Group',
			'menu_name'                  => 'Groups',
			'all_items'                  => 'All Groups',
			'parent_item'                => 'Parent Group',
			'parent_item_colon'          => 'Parent Group:',
			'new_item_name'              => 'New Group Name',
			'add_new_item'               => 'Add New Group',
			'edit_item'                  => 'Edit Group',
			'update_item'                => 'Update Group',
			'view_item'                  => 'View Group',
			'separate_items_with_commas' => 'Separate groups with commas',
			'add_or_remove_items'        => 'Add or remove groups',
			'choose_from_most_used'      => 'Choose from the most used',
			'popular_items'              => 'Popular Groups',
			'search_items'               => 'Search Groups',
			'not_found'                  => 'No Groups Found',
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		register_taxonomy( 'groups', array( 'people' ), $args );
	}
	
	if ( isset( $taxes['research-areas'] ) && $taxes['research-areas'] ) {
		$labels = array(
			'name'                       => 'Research Areas',
			'singular_name'              => 'Research Area',
			'menu_name'                  => 'Research Areas',
			'all_items'                  => 'All Research Areas',
			'parent_item'                => 'Parent Research Area',
			'parent_item_colon'          => 'Parent Research Area:',
			'new_item_name'              => 'New Research Area Name',
			'add_new_item'               => 'Add New Research Area',
			'edit_item'                  => 'Edit Research Area',
			'update_item'                => 'Update Research Area',
			'view_item'                  => 'View Research Area',
			'separate_items_with_commas' => 'Separate areas with commas',
			'add_or_remove_items'        => 'Add or remove areas',
			'choose_from_most_used'      => 'Choose from the most used',
			'popular_items'              => 'Popular Research Areas',
			'search_items'               => 'Search Research Areas',
			'not_found'                  => 'No Research Areas Found',
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		register_taxonomy( 'research-areas', array( 'people' ), $args );
	}
}

// insert default terms

function berkeley_engineering_create_terms() {
	$faculty = term_exists( 'Faculty', 'people_type' );
	if ( !$faculty )
		wp_insert_term( 'Faculty', 'people_type');
	
	$staff = term_exists( 'Staff', 'people_type' );
	if ( !$staff )
		wp_insert_term( 'Staff', 'people_type' );
	
	$student = term_exists( 'Student', 'people_type' );
	if ( !$student )
		wp_insert_term( 'Student', 'people_type' );
	
	$bldg = term_exists( 'Building', 'facility_type' );
	if ( !$bldg )
		wp_insert_term( 'Building', 'facility_type' );
	
	$room = term_exists( 'Room', 'facility_type' );
	if ( !$room )
		wp_insert_term( 'Room', 'facility_type' );
	
	$lab = term_exists( 'Lab', 'facility_type' );
	if ( !$lab )
		wp_insert_term( 'Lab', 'facility_type' );
	
	$tool = term_exists( 'Tool or Equipment', 'facility_type' );
	if ( !$tool )
		wp_insert_term( 'Tool or Equipment', 'facility_type', array( 'slug' => 'equipment' ) );
}