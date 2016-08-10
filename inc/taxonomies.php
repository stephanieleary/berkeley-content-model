<?php

// register taxonomies

function berkeley_content_model_taxonomies() {
	
	$labels = array(
		'name'                       => esc_html_x( 'People Types', 'Taxonomy General Name', 'beng' ),
		'singular_name'              => esc_html_x( 'People Type', 'Taxonomy Singular Name', 'beng' ),
		'menu_name'                  => esc_html__( 'People Types', 'beng' ),
		'all_items'                  => esc_html__( 'People Types', 'beng' ),
		'parent_item'                => esc_html__( 'Parent Type' , 'beng'),
		'parent_item_colon'          => esc_html__( 'Parent Type:' , 'beng'),
		'new_item_name'              => esc_html__( 'New Type', 'beng' ),
		'add_new_item'               => esc_html__( 'Add New Type' , 'beng'),
		'edit_item'                  => esc_html__( 'Edit Type', 'beng' ),
		'update_item'                => esc_html__( 'Update Type', 'beng' ),
		'view_item'                  => esc_html__( 'View Type', 'beng' ),
		'separate_items_with_commas' => esc_html__( 'Separate types with commas', 'beng' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove types', 'beng' ),
		'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'beng' ),
		'popular_items'              => esc_html__( 'Popular Types', 'beng' ),
		'search_items'               => esc_html__( 'Search Types', 'beng' ),
		'not_found'                  => esc_html__( 'No Types Found', 'beng' ),
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
		'name'                       => esc_html_x( 'Organizations', 'Taxonomy General Name', 'beng' ),
		'singular_name'              => esc_html_x( 'Organization', 'Taxonomy Singular Name', 'beng' ),
		'menu_name'                  => esc_html__( 'Organization', 'beng' ),
		'all_items'                  => esc_html__( 'Organizations', 'beng' ),
		'parent_item'                => esc_html__( 'Parent Organization', 'beng' ),
		'parent_item_colon'          => esc_html__( 'Parent Organization:', 'beng' ),
		'new_item_name'              => esc_html__( 'New Organization', 'beng' ),
		'add_new_item'               => esc_html__( 'Add New Organization', 'beng' ),
		'edit_item'                  => esc_html__( 'Edit Organization', 'beng' ),
		'update_item'                => esc_html__( 'Update Organization', 'beng' ),
		'view_item'                  => esc_html__( 'View Organization', 'beng' ),
		'separate_items_with_commas' => esc_html__( 'Separate organizations with commas', 'beng' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove organizations', 'beng' ),
		'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'beng' ),
		'popular_items'              => esc_html__( 'Popular Organizations', 'beng' ),
		'search_items'               => esc_html__( 'Search Organizations', 'beng' ),
		'not_found'                  => esc_html__( 'No Organizations Found', 'beng' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'organization', array( 'people', 'course' ), $args );
		
	$labels = array(
		'name'                       => esc_html_x( 'Subject Areas', 'Taxonomy General Name', 'beng' ),
		'singular_name'              => esc_html_x( 'Subject Area', 'Taxonomy Singular Name', 'beng' ),
		'menu_name'                  => esc_html__( 'Subject Area', 'beng' ),
		'all_items'                  => esc_html__( 'Subject Areas', 'beng' ),
		'parent_item'                => esc_html__( 'Parent Subject Area', 'beng' ),
		'parent_item_colon'          => esc_html__( 'Parent Subject Area:', 'beng' ),
		'new_item_name'              => esc_html__( 'New Subject Area', 'beng' ),
		'add_new_item'               => esc_html__( 'Add New Subject Area', 'beng' ),
		'edit_item'                  => esc_html__( 'Edit Subject Area', 'beng' ),
		'update_item'                => esc_html__( 'Update Subject Area', 'beng' ),
		'view_item'                  => esc_html__( 'View Subject Area', 'beng' ),
		'separate_items_with_commas' => esc_html__( 'Separate subject areas with commas' , 'beng' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove subject areas', 'beng' ),
		'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'beng' ),
		'popular_items'              => esc_html__( 'Popular Subject Areas', 'beng' ),
		'search_items'               => esc_html__( 'Search Subject Areas', 'beng' ),
		'not_found'                  => esc_html__( 'No Subject Areas Found', 'beng' ),
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
	register_taxonomy( 'subject_area', array( 'people', 'facility', 'publication', 'course', 'research' ), $args );

	$labels = array(
		'name'                       => esc_html_x( 'Facility Types', 'Taxonomy General Name', 'beng' ),
		'singular_name'              => esc_html_x( 'Facility Type', 'Taxonomy Singular Name', 'beng' ),
		'menu_name'                  => esc_html__( 'Facility Type', 'beng' ),
		'all_items'                  => esc_html__( 'Facility Types', 'beng' ),
		'parent_item'                => esc_html__( 'Parent Type', 'beng' ),
		'parent_item_colon'          => esc_html__( 'Parent Type:', 'beng' ),
		'new_item_name'              => esc_html__( 'New Type', 'beng' ),
		'add_new_item'               => esc_html__( 'Add New Type', 'beng' ),
		'edit_item'                  => esc_html__( 'Edit Type', 'beng' ),
		'update_item'                => esc_html__( 'Update Type', 'beng' ),
		'view_item'                  => esc_html__( 'View Type', 'beng' ),
		'separate_items_with_commas' => esc_html__( 'Separate types with commas', 'beng' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove types', 'beng' ),
		'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'beng' ),
		'popular_items'              => esc_html__( 'Popular Types', 'beng' ),
		'search_items'               => esc_html__( 'Search Types', 'beng' ),
		'not_found'                  => esc_html__( 'No Types Found', 'beng' ),
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
	register_taxonomy( 'facility_type', array( 'facility' ), $args );
	
	
	$labels = array(
		'name'                       => esc_html_x( 'Student Types', 'Taxonomy General Name', 'beng' ),
		'singular_name'              => esc_html_x( 'Student Type', 'Taxonomy Singular Name', 'beng' ),
		'menu_name'                  => esc_html__( 'Student Type', 'beng' ),
		'all_items'                  => esc_html__( 'Student Types', 'beng' ),
		'parent_item'                => esc_html__( 'Parent Type' , 'beng'),
		'parent_item_colon'          => esc_html__( 'Parent Type:', 'beng' ),
		'new_item_name'              => esc_html__( 'New Type', 'beng' ),
		'add_new_item'               => esc_html__( 'Add New Type' , 'beng'),
		'edit_item'                  => esc_html__( 'Edit Type', 'beng' ),
		'update_item'                => esc_html__( 'Update Type', 'beng' ),
		'view_item'                  => esc_html__( 'View Type', 'beng' ),
		'separate_items_with_commas' => esc_html__( 'Separate types with commas', 'beng' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove types', 'beng' ),
		'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'beng' ),
		'popular_items'              => esc_html__( 'Popular Types', 'beng' ),
		'search_items'               => esc_html__( 'Search Types', 'beng' ),
		'not_found'                  => esc_html__( 'No Types Found', 'beng' ),
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
	register_taxonomy( 'student_type', array( 'people' ), $args );
	
	
	// Optional taxonomies
	
	$taxes = get_option( 'berkeley_taxes' );
	
	if ( isset( $taxes['committee'] ) && $taxes['committee'] ) {
		$labels = array(
			'name'                       => esc_html_x( 'Committees', 'Taxonomy General Name', 'beng' ),
			'singular_name'              => esc_html_x( 'Committee',  'Taxonomy Singular Name', 'beng' ),
			'menu_name'                  => esc_html__( 'Committees', 'beng' ),
			'all_items'                  => esc_html__( 'All Committees', 'beng' ),
			'parent_item'                => esc_html__( 'Parent Committee', 'beng' ),
			'parent_item_colon'          => esc_html__( 'Parent Committee:', 'beng' ),
			'new_item_name'              => esc_html__( 'New Committee Name', 'beng' ),
			'add_new_item'               => esc_html__( 'Add New Committee', 'beng' ),
			'edit_item'                  => esc_html__( 'Edit Committee', 'beng' ),
			'update_item'                => esc_html__( 'Update Committee', 'beng' ),
			'view_item'                  => esc_html__( 'View Committee', 'beng' ),
			'separate_items_with_commas' => esc_html__( 'Separate committee with commas', 'beng' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove committees', 'beng' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'beng' ),
			'popular_items'              => esc_html__( 'Popular Committees', 'beng' ),
			'search_items'               => esc_html__( 'Search Committees', 'beng' ),
			'not_found'                  => esc_html__( 'No Committees Areas Found', 'beng' ),
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
			'name'                       => esc_html_x( 'Groups', 'Taxonomy General Name', 'beng' ),
			'singular_name'              => esc_html_x( 'Group',  'Taxonomy Singular Name', 'beng' ),
			'menu_name'                  => esc_html__( 'Groups', 'beng' ),
			'all_items'                  => esc_html__( 'All Groups', 'beng' ),
			'parent_item'                => esc_html__( 'Parent Group', 'beng' ),
			'parent_item_colon'          => esc_html__( 'Parent Group:', 'beng' ),
			'new_item_name'              => esc_html__( 'New Group Name', 'beng' ),
			'add_new_item'               => esc_html__( 'Add New Group', 'beng' ),
			'edit_item'                  => esc_html__( 'Edit Group', 'beng' ),
			'update_item'                => esc_html__( 'Update Group', 'beng' ),
			'view_item'                  => esc_html__( 'View Group', 'beng' ),
			'separate_items_with_commas' => esc_html__( 'Separate groups with commas', 'beng' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove groups', 'beng' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'beng' ),
			'popular_items'              => esc_html__( 'Popular Groups', 'beng' ),
			'search_items'               => esc_html__( 'Search Groups', 'beng' ),
			'not_found'                  => esc_html__( 'No Groups Found', 'beng' ),
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
	
	if ( isset( $taxes['research_areas'] ) && $taxes['research_areas'] ) {
		$labels = array(
			'name'                       => esc_html_x( 'Research Areas', 'Taxonomy General Name', 'beng' ),
			'singular_name'              => esc_html_x( 'Research Area', 'Taxonomy Singular Name', 'beng' ),
			'menu_name'                  => esc_html__( 'Research Areas', 'beng' ),
			'all_items'                  => esc_html__( 'All Research Areas', 'beng' ),
			'parent_item'                => esc_html__( 'Parent Research Area', 'beng' ),
			'parent_item_colon'          => esc_html__( 'Parent Research Area:', 'beng' ),
			'new_item_name'              => esc_html__( 'New Research Area Name', 'beng' ),
			'add_new_item'               => esc_html__( 'Add New Research Area', 'beng' ),
			'edit_item'                  => esc_html__( 'Edit Research Area', 'beng' ),
			'update_item'                => esc_html__( 'Update Research Area', 'beng' ),
			'view_item'                  => esc_html__( 'View Research Area', 'beng' ),
			'separate_items_with_commas' => esc_html__( 'Separate areas with commas', 'beng' ),
			'add_or_remove_items'        => esc_html__( 'Add or remove areas', 'beng' ),
			'choose_from_most_used'      => esc_html__( 'Choose from the most used', 'beng' ),
			'popular_items'              => esc_html__( 'Popular Research Areas', 'beng' ),
			'search_items'               => esc_html__( 'Search Research Areas', 'beng' ),
			'not_found'                  => esc_html__( 'No Research Areas Found', 'beng' ),
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
		register_taxonomy( 'research_areas', array( 'people' ), $args );
	}
}

// insert default terms

function berkeley_engineering_create_terms() {
	
	$default_terms = array(
		esc_html__( 'Faculty', 'beng' ) 	=> 'people_type',
		esc_html__( 'Staff', 'beng' )		=> 'people_type',
		esc_html__( 'Student', 'beng' ) 	=> 'people_type',
		
		esc_html__( 'Undergrad', 'beng' )	=> 'student_type',
		esc_html__( 'Masters', 'beng' )		=> 'student_type',
		esc_html__( 'PhD', 'beng' )			=> 'student_type',
		esc_html__( 'Post Doc', 'beng' )	=> 'student_type',
		esc_html__( 'Visitor', 'beng' )		=> 'student_type',
		
		esc_html__( 'Building', 'beng' )  	=> 'facility_type',
		esc_html__( 'Room', 'beng' )  		=> 'facility_type',
		esc_html__( 'Lab', 'beng' )			=> 'facility_type',
		esc_html__( 'Tool or Equipment', 'beng' )  => 'facility_type',
	);
	
	foreach ( $default_terms as $term => $taxonomy ) {
		$exists = term_exists( $term, $taxonomy );
		if ( !$exists ) {
			if ( esc_html__( 'Tool or Equipment', 'beng' ) == $term )
				wp_insert_term( $term, $taxonomy, array( 'slug' => 'equipment' ) );
			else
				wp_insert_term( $term, $taxonomy );
		}	
	}
		
}