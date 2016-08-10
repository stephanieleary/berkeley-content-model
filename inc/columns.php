<?php

// print the contents of all the custom columns
add_action( 'manage_posts_custom_column', 'berkeley_engineering_custom_column', 99, 2 );
add_action( 'manage_pages_custom_column', 'berkeley_engineering_custom_column', 99, 2 );
function berkeley_engineering_custom_column( $column, $id ) {
	
	$id = intval( $id );
	
	switch ( $column ) {
		case 'first_name':
		case 'last_name':
			echo esc_html( get_post_meta( $id, $column, true ) );
			break;
			
		default:
			break;
	}
}

// handle sorting by custom fields
// sorting by title, date, modified, comment count, other built-in 'orderby' values do not require this step
add_action( 'pre_get_posts', 'berkeley_engineering_column_orderby' );
function berkeley_engineering_column_orderby( $query ) {
    if( ! is_admin() )
        return;

    $orderby = $query->get( 'orderby');

	if( ! isset( $orderby ) )
        return;

	$post_type = $query->get( 'post_type');
	
	if ( 'people' !== $post_type )
		return;
 
	switch ( $orderby ) {
		case 'first_name':
		case 'last_name':
			$query->set( 'meta_key', $orderby );
	        $query->set( 'orderby', 'meta_value' );
			break;
	}

}