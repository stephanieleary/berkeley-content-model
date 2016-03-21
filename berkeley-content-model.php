<?php
/*
Plugin Name: Berkeley Engineering Content Model
Description: Creates the custom post types and taxonomies for the Berkeley Engineering sites.
Author: Stephanie Leary
Version: 1.7.2
Author URI: http://stephanieleary.com
Text Domain: beng
*/

include( 'inc/archive-settings.php' );
include( 'inc/columns.php' );
include( 'inc/dashboard.php' );
include( 'inc/filters.php' );
include( 'inc/options.php' );
include( 'inc/post-types.php' );
include( 'inc/save-fields.php' );
include( 'inc/shortcodes.php' );
include( 'inc/taxonomies.php' );

add_action( 'init', 'berkeley_content_model_post_types' );
add_action( 'init', 'berkeley_content_model_taxonomies' );

register_activation_hook( __FILE__, 'berkeley_content_model_activate' );

function berkeley_content_model_activate() {
	berkeley_content_model_post_types();
	berkeley_content_model_taxonomies();
	berkeley_engineering_create_terms();
	flush_rewrite_rules();
}

// Load CSS on specified admin pages

add_action( 'admin_head-edit.php',   	'berkeley_content_model_enqueue_files' );	// List screens
add_action( 'admin_head-post.php', 		'berkeley_content_model_enqueue_files' );	// Edit screens
add_action( 'admin_head-post-new.php',  'berkeley_content_model_enqueue_files' );	// New edit screens
add_action( 'admin_head-index.php',   	'berkeley_content_model_enqueue_files' );	// Dashboard

function berkeley_content_model_enqueue_files() {
	wp_enqueue_style( 'berkeley-content-model-css', plugins_url( '/css/style.css', __FILE__ ), '', '', 'screen' );
	wp_enqueue_script( 'berkeley-field-focus-js', plugins_url( '/js/field-focus.js', __FILE__ ), 'jquery' );
	wp_register_script( 'berkeley-tax-toggle-js', plugins_url( '/js/tax-toggle.js', __FILE__ ), 'jquery' );

	$args = array( 
		'fields' => 'id=>slug', 
		'hide_empty' => 0 
	);
	$tax_ids = array( 
		'people_types' => get_terms( 'people_type', $args ), 
		'facility_types' => get_terms( 'facility_type', $args ) 
	);
	
	wp_localize_script( 'berkeley-tax-toggle-js', 'taxids', $tax_ids );
	wp_enqueue_script(  'berkeley-tax-toggle-js' );
}