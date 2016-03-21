<?php

// Silence SearchWP warning about post_term cache
add_action( 'pre_get_posts', function( $wp_query ) {
	if ( is_search() ) {
		set_query_var( 'update_post_term_cache', false );
	}
} );

// Always sort people by last name, first name
add_filter( 'pre_get_posts', 'berkeley_engineering_alphabetize_people' );

function berkeley_engineering_alphabetize_people( $query ) {
	if ( is_admin() )
		return $query;
		
	if ( isset( $query->post_type ) && $query->post_type == 'people' ) {
		// Alphabetize 
	    $query->set( 'meta_key', 'lastname' );			// meta_key must be set to use meta_value in orderby
		$query->set( 'orderby', 'meta_value title');	// sorts strings alphabetically
		$query->set( 'order', 'ASC');					// a,b,c instead of z,y,x
	}
}

// Change placeholder text for  post titles
add_filter( 'enter_title_here', 'berkeley_engineering_title_placeholders' );

function berkeley_engineering_title_placeholders( $placeholder ){
    $screen = get_current_screen();
	switch ( $screen->post_type ) {
		case 'people':
			$placeholder = 'Enter full name';
			break;
		case 'course':
			$placeholder = 'Enter course title';
			break;
		case 'facility':
			$placeholder = 'Enter facility or item name';
			break;
		case 'research':
			$placeholder = 'Enter research project title';
			break;
		case 'publication':
			$placeholder = 'Enter publication title';
			break;
		default: break;
		
	}

    return $placeholder;
}