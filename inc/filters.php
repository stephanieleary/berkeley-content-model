<?php

// tell WP Engine to play nice with SearchWP
define( 'WPE_GOVERNOR', false );

// Pass Google Maps API key option to Advanced Custom Fields options
add_action( 'acf/init', 'berkeley_gmaps_for_acf' );

function berkeley_gmaps_for_acf() {
	$key = sanitize_text_field( get_option( 'berkeley_gmaps_api' ) );
	if ( $key )
		acf_update_setting( 'google_api_key', $key );
}

add_action( 'pre_get_posts', 'berkeley_engineering_pre_posts_filters' );

function berkeley_engineering_pre_posts_filters( $query ) {
	if ( is_admin() )
		return $query;
	
	if ( !$query->is_main_query() )
		return $query;
	
	if ( is_search() ) {
		set_query_var( 'update_post_term_cache', false );
	}
		
	// post_type might be set on lots of other archives by our filters
	if ( is_tax( 'people_type' ) || ( isset( $query->post_type ) && $query->post_type == 'people' ) ) {
		// Alphabetize 
	    $query->set( 'meta_key', 'last_name' );			// meta_key must be set to use meta_value in orderby
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
			$placeholder = esc_html__( 'Enter full name', 'beng' );
			break;
		case 'course':
			$placeholder = esc_html__( 'Enter course title', 'beng' );
			break;
		case 'facility':
			$placeholder = esc_html__( 'Enter facility or item name', 'beng' );
			break;
		case 'research':
			$placeholder = esc_html__( 'Enter research project title', 'beng' );
			break;
		case 'publication':
			$placeholder = esc_html__( 'Enter publication title', 'beng' );
			break;
		default: break;
		
	}

    return $placeholder;
}