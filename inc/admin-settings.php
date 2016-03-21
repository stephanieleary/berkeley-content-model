<?php

add_filter( 'default_hidden_meta_boxes', 'berkeley_cpts_hidden_meta_boxes', 10, 2 );

function berkeley_cpts_hidden_meta_boxes( $hidden, $screen ) {
	
	$hide_these = array( 
		'people_typediv', 
		'facility_typediv', 
		'wpe_dify_news_feed',
		'i123_widgets_custom_fields',
	);
	
	$hidden = array_merge( $hidden, $hide_these );
    return $hidden;
}

// Enable Per Page Widgets on our custom post types
add_action( 'add_meta_boxes', 'berkeley_i123_widgets_custom_fields_add' );

function berkeley_i123_widgets_custom_fields_add() {
	if ( !function_exists( 'i123_widgets_admin_init' ) )
		return;
		
    i123_widgets_admin_init();
	$types = array( 'people', 'publication', 'facility', 'research', 'course' );
	foreach ( $types as $type ) {
		add_meta_box( 'i123_widgets_custom_fields', __('Per Page Widgets', 'i123_widgets'), 'i123_widgets_custom_fields_controllbox', $type, 'side', 'high' );
	}
}