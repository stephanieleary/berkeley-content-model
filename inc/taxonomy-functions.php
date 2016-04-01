<?php

function berkeley_find_post_type() {
	
	$type = get_query_var( 'post_type' );
	
	if ( ( !isset( $type ) || empty( $type ) ) && is_tax() ) {
		// we're on a term archive, where post type might not be set but can be inferred
		$current_term = get_queried_object();
		$tax_obj = get_taxonomy( $current_term->taxonomy );
		if ( count( $tax_obj->object_type ) == 1 )
			$type = $tax_obj->object_type[0];
	}
	
	return $type;
}

function taxonomy_link_for_post_type( $termlink, $term, $taxonomy ) {
	
	$tax_obj = get_taxonomy( $taxonomy );
	
	// if this is not a shared taxonomy, bail
	if ( count( $tax_obj->object_type ) == 1 )
		return $termlink;
	
	$post_type = berkeley_find_post_type();
	
	if ( !isset( $post_type ) || 'any' == $post_type )
		return $termlink;
	
	$termlink = add_query_arg( 'post_type', $post_type, $termlink );
	
	return $termlink;
}


// get an array of taxonomy term IDs associated with a specific post type (for shared taxonomies)
function get_term_ids_limited_to_post_type( $taxonomies, $post_types ) {
	
	$transient = sanitize_key( 'limited_term_ids_' . $taxonomies . '_for_' . $post_types );
	
	// Get any existing copy of our transient data
	if ( false === ( $terms_for_post_type = get_transient( $transient ) ) ) {
	    global $wpdb;

		if ( is_array($post_types) ) {
			$post_types = implode( "','", $post_types );
		}
		
		//if (current_user_can('manage_options')) { var_dump($posts_in); exit; }

	    $query = $wpdb->prepare(
	        "SELECT t.term_id from $wpdb->terms AS t
	        INNER JOIN $wpdb->term_taxonomy AS tt ON t.term_id = tt.term_id
	        INNER JOIN $wpdb->term_relationships AS r ON r.term_taxonomy_id = tt.term_taxonomy_id
	        INNER JOIN $wpdb->posts AS p ON p.ID = r.object_id
			WHERE p.post_type IN(%s) AND tt.taxonomy IN('%s')
			GROUP BY t.term_id",
	        $post_types,
	        $taxonomies
	    );
	
		//if (current_user_can('manage_options')) var_dump( $query );
	
	     $terms_for_post_type = $wpdb->get_col( stripslashes( $query ) );
	     set_transient( $transient, $terms_for_post_type, HOUR_IN_SECONDS );
	}
	
    return $terms_for_post_type;

}

function get_terms_parent_ids( $limited_term_ids, $taxonomy ) {
	
	$parent_ids = array();
	foreach ( $limited_term_ids as $child_term ) {
		$ancestors = get_ancestors( $child_term, $taxonomy );
		$parent_ids = array_merge( $parent_ids, $ancestors );
	}
	
	return array_merge( $limited_term_ids,  $parent_ids );
}

function get_term_post_count_by_type( $term_ids, $taxonomy, $post_type = '' ) {
	
	if ( !isset( $post_type ) || empty( $post_type ) )
		$post_type = berkeley_find_post_type();
	
	if ( !isset( $post_type ) )
		return -1;
		
    $args = array( 
        'fields' => 'ids',
        'posts_per_page' => -1,
        'post_type' => $post_type
    );
	if ( !empty( $taxonomy ) ) {
		$args['tax_query'] = array(
            array(
                'taxonomy' => $taxonomy,
                'field' => 'id',
                'terms' => $term_ids
            )
		);
	}
    $posts = get_posts( $args );
	//if ( current_user_can('manage_options') ) { var_dump($args); exit; }
    
	return count( $posts ); 
}