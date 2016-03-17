<?php

add_filter( 'default_hidden_meta_boxes', 'berkeley_cpts_hidden_meta_boxes', 10, 2 );

function berkeley_cpts_hidden_meta_boxes( $hidden, $screen ) {
	
	$hide_these = array( 
		'people_typediv', 
		'facility_typediv', 
		'wpe_dify_news_feed',
	);
	
	$hidden = array_merge( $hidden, $hide_these );
    return $hidden;
}