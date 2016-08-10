<?php
/*
Plugin Name: Berkeley Engineering Content Model
Description: Creates the custom post types and taxonomies for the Berkeley Engineering sites.
Author: Stephanie Leary
Version: 1.9.1
Author URI: http://stephanieleary.com
Text Domain: beng
GitHub Plugin URI: https://github.com/sillybean/berkeley-content-model
GitHub Branch:     master
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
include( 'inc/taxonomy-functions.php' );

add_action( 'init', 'berkeley_content_model_post_types' );
add_action( 'init', 'berkeley_content_model_taxonomies' );

register_activation_hook( __FILE__, 'berkeley_content_model_activate' );

function berkeley_content_model_activate() {
	berkeley_content_model_post_types();
	berkeley_content_model_taxonomies();
	berkeley_engineering_create_terms();
	flush_rewrite_rules();
	
	$cpts = array( 
		'course' 		=> 1, 
		'research' 		=> 1, 
		'facility' 		=> 1, 
		'publication' 	=> 1, 
		'people' 		=> 1,
	);
	
	update_option( 'berkeley_cpts', $cpts );
}


// Load CSS and JS files and pass PHP variables to JS scripts

add_action( 'admin_enqueue_scripts', 'berkeley_content_model_enqueue_files' );

function berkeley_content_model_enqueue_files( $hook ) {
	
	if ( !in_array( $hook, array( 'edit.php', 'post.php', 'post-new.php', 'index.php' ) ) )
		return;
	
	global $post;
	
	wp_enqueue_style( 'berkeley-content-model-css', plugins_url( '/css/style.css', __FILE__ ), '', '', 'screen' );
	wp_register_script( 'berkeley-tax-toggle-js', plugins_url( '/js/tax-toggle.js', __FILE__ ), 'jquery' );

	if ( $post->post_type === 'people' || $post->post_type === 'facility' ) {
		$args = array( 
			'fields' => 'id=>slug', 
			'hide_empty' => 0 
		);
		$tax_ids = array( 
			'people_types' => get_terms( 'people_type', $args ), 
			'facility_types' => get_terms( 'facility_type', $args ) 
		);

		wp_localize_script( 'berkeley-tax-toggle-js', 'Berkeley_Edit_Post_Toggles_taxids', $tax_ids );
		wp_enqueue_script(  'berkeley-tax-toggle-js' );
		wp_enqueue_script( 'berkeley-tabindex-js', plugins_url( '/js/tabindex.js', __FILE__ ), 'jquery' );
		
	}
}