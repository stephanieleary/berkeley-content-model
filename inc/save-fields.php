<?php

add_action( 'save_post', 		'berkeley_engineering_save_meta_data', 99 );

function berkeley_engineering_save_meta_data( $post_id ) {
	// ignore autosaves
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return $post_id;
		
	// check post type
	if ( 'people' != $_POST['post_type'] )
		return $post_id;
		
	// check capabilites
	if ( !current_user_can( 'edit_posts' ) )
		return $post_id;
	
	// get ACF's name fields, which should be already saved
	$name = array();	
	$name[] = get_post_meta( $post_id, 'first_name', 	 true );
	$name[] = get_post_meta( $post_id, 'middle_initial', true );
	$name[] = get_post_meta( $post_id, 'last_name', 	 true );

	$name = implode( ' ', array_filter( $name ) );
	
	if ( !empty( $name ) ) {
		
		// remove this function from the save_post action to avoid an infinite loop
		remove_action( 'save_post', 		'berkeley_engineering_save_meta_data', 99 );

		// save combined name as post title and regenerate slug
		wp_update_post( array( 'ID' => $post_id, 'post_title' => $name, 'post_name' => sanitize_title( $name ) ) );

		// re-hook this function
		add_action( 'save_post', 		'berkeley_engineering_save_meta_data', 99 );	
	}

}