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
		'name'                       => _x( 'Organizations', 'Taxonomy General Name' ),
		'singular_name'              => _x( 'Organization', 'Taxonomy Singular Name' ),
		'menu_name'                  => __( 'Organization' ),
		'all_items'                  => __( 'Organizations' ),
		'parent_item'                => __( 'Parent Organization' ),
		'parent_item_colon'          => __( 'Parent Organization:' ),
		'new_item_name'              => __( 'New Organization' ),
		'add_new_item'               => __( 'Add New Organization' ),
		'edit_item'                  => __( 'Edit Organization' ),
		'update_item'                => __( 'Update Organization' ),
		'view_item'                  => __( 'View Organization' ),
		'separate_items_with_commas' => __( 'Separate organizations with commas' ),
		'add_or_remove_items'        => __( 'Add or remove organizations' ),
		'choose_from_most_used'      => __( 'Choose from the most used' ),
		'popular_items'              => __( 'Popular Organizations' ),
		'search_items'               => __( 'Search Organizations' ),
		'not_found'                  => __( 'No Organizations Found' ),
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
		'name'                       => _x( 'Subject Areas', 'Taxonomy General Name' ),
		'singular_name'              => _x( 'Subject Area', 'Taxonomy Singular Name' ),
		'menu_name'                  => __( 'Subject Area' ),
		'all_items'                  => __( 'Subject Areas' ),
		'parent_item'                => __( 'Parent Subject Area' ),
		'parent_item_colon'          => __( 'Parent Subject Area:' ),
		'new_item_name'              => __( 'New Subject Area' ),
		'add_new_item'               => __( 'Add New Subject Area' ),
		'edit_item'                  => __( 'Edit Subject Area' ),
		'update_item'                => __( 'Update Subject Area' ),
		'view_item'                  => __( 'View Subject Area' ),
		'separate_items_with_commas' => __( 'Separate subject areas with commas' ),
		'add_or_remove_items'        => __( 'Add or remove subject areas' ),
		'choose_from_most_used'      => __( 'Choose from the most used' ),
		'popular_items'              => __( 'Popular Subject Areas' ),
		'search_items'               => __( 'Search Subject Areas' ),
		'not_found'                  => __( 'No Subject Areas Found' ),
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
	
	
	$labels = array(
		'name'                       => _x( 'Student Types', 'Taxonomy General Name' ),
		'singular_name'              => _x( 'Student Type', 'Taxonomy Singular Name' ),
		'menu_name'                  => __( 'Student Type' ),
		'all_items'                  => __( 'Student Types' ),
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
	register_taxonomy( 'student_type', array( 'people' ), $args );
	
	
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
	
	if ( isset( $taxes['research_areas'] ) && $taxes['research_areas'] ) {
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
		register_taxonomy( 'research_areas', array( 'people' ), $args );
	}
}

// insert default terms

function berkeley_engineering_create_terms() {
	
	$default_terms = array(
		'Faculty' 	=> 'people_type',
		'Staff' 	=> 'people_type',
		'Student' 	=> 'people_type',
		
		'Undergrad'	=> 'student_type',
		'Masters'	=> 'student_type',
		'PhD'		=> 'student_type',
		'Post Doc'	=> 'student_type',
		'Visitor'	=> 'student_type',
		
		'Building'  => 'facility_type',
		'Room'  	=> 'facility_type',
		'Lab'  		=> 'facility_type',
		'Tool or Equipment'  => 'facility_type',
	);
	
	foreach ( $default_terms as $term => $taxonomy ) {
		$exists = term_exists( $term, $taxonomy );
		if ( !$exists ) {
			if ( 'Tool or Equipment' == $term )
				wp_insert_term( $term, $taxonomy, array( 'slug' => 'equipment' ) );
			else
				wp_insert_term( $term, $taxonomy );
		}	
	}
		
}