<?php

add_filter( 'default_hidden_meta_boxes', 'berkeley_cpts_hidden_meta_boxes', 10, 2 );

function berkeley_cpts_hidden_meta_boxes( $hidden, $screen ) {
	
	$hide_these = array( 
		'people_typediv', 
		'facility_typediv', 
		'wpe_dify_news_feed',
		'i123_widgets_custom_fields',
		'postcustom',
		'commentstatusdiv',
		'slugdiv',
		'authordiv',
		'genesis_inpost_scripts_box'
	);
	
	$hidden = array_merge( $hidden, $hide_these );
    return $hidden;
}

// hide taxonomy metaboxes for fields that are shown in ACF
add_action( 'admin_menu', 'berkeley_engineering_remove_tax_metaboxes', 99 );
function berkeley_engineering_remove_tax_metaboxes() {
	remove_meta_box( 'people_typediv', 'people', 'side' );
	remove_meta_box( 'facility_typediv', 'facility', 'side' );
}