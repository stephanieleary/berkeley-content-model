<?php
/*
Plugin Name: Berkeley Engineering Content Model
Description: Creates the custom post types and taxonomies for the Berkeley Engineering sites.
Author: Stephanie Leary
Version: 2.3
Author URI: http://stephanieleary.com
Text Domain: beng
GitHub Plugin URI: https://github.com/sillybean/berkeley-content-model
GitHub Branch:     master
*/

include( 'inc/archive-settings.php' );
include( 'inc/admin-columns.php' );
include( 'inc/dashboard.php' );
include( 'inc/filters.php' );
include( 'inc/options.php' );
include( 'inc/post-types.php' );
include( 'inc/save-fields.php' );
include( 'inc/shortcodes.php' );
include( 'inc/taxonomies.php' );
include( 'inc/taxonomy-functions.php' );

include( 'inc/announcements.php' );
include( 'inc/content-filters.php' );
include( 'inc/editor.php' );
include( 'inc/footer.php' );
include( 'inc/image-sizes.php' );
include( 'inc/loops.php' );
include( 'inc/metaboxes.php' );
include( 'inc/pagination.php' );
include( 'inc/sidebars.php' );
include( 'inc/template-loader.php' );
include( 'inc/theme-options.php' );
include( 'inc/widgets.php' );

add_action( 'init', 'berkeley_eng_content_model_post_types' );
add_action( 'init', 'berkeley_eng_content_model_taxonomies' );

register_activation_hook( __FILE__, 'berkeley_eng_content_model_activate' );

function berkeley_eng_content_model_activate() {
	berkeley_eng_content_model_post_types();
	berkeley_eng_content_model_taxonomies();
	berkeley_eng_create_terms();
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

// load standard theme files from plugin folder
add_filter( 'template_include', 'berkeley_eng_genesis_templates' );
function berkeley_eng_genesis_templates( $original_template ) {
	if ( is_search() )
		return plugin_dir_path( __FILE__ ) . 'templates/search.php';
	if ( is_home() )
		return plugin_dir_path( __FILE__ ) . 'templates/home.php';
	return $original_template;
}

// Front-end scripts and styles
add_action( 'wp_enqueue_scripts', 'berkeley_eng_global_theme_scripts' );
function berkeley_eng_global_theme_scripts() {
	// Enqueue accordion js for Additional Content fields on single templates
	if ( is_singular() )
		wp_enqueue_script( 'berkeley-accordion', plugins_url( '/js/accordion.js', __FILE__ ), array( 'jquery' ), false, true );

	// Enqueue ACF maps scripts for maps
	if ( get_field( 'map', get_the_ID() ) ) {
		wp_enqueue_script( 'berkeley-google-maps-api', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', '', '1.0.0', true );
		wp_enqueue_script( 'berkeley-acf-maps', plugins_url( '/js/acf-maps.js', __FILE__ ), array( 'berkeley-google-maps-api' ), '1.0.0', true );
	}
}

// Tell modern browsers these files are not render blockers
add_filter( 'script_loader_tag', 'berkeley_eng_async_global_scripts', 10, 2 );
function berkeley_eng_async_global_scripts( $tag, $handle ) {
    if ( !in_array( $handle, array( 'berkeley-google-maps-api', 'berkeley-acf-maps' ) ) )
        return $tag;
    return str_replace( ' src', ' async="async" src', $tag );
}

// Admin scripts and styles for Genesis settings
add_action( 'admin_enqueue_scripts', 'berkeley_eng_admin_settings_styles', 99 );
function berkeley_eng_admin_settings_styles( $hook ) {
	
	if ( 'toplevel_page_genesis' === $current_screen->base && 'genesis' === $current_screen->parent_base ) {
		wp_enqueue_style( 'berkeley-admin-css', plugins_url( '/css/admin-style.css', __FILE__ ) );
	}
	
	if ( in_array( $hook, array( 'edit.php', 'post.php', 'post-new.php', 'widgets.php' ) ) )
		wp_enqueue_style( 'berkeley-admin-css', plugins_url( '/css/admin-style.css', __FILE__ ) );
		
}

// Load Admin CSS and JS files and pass PHP variables to JS scripts
add_action( 'admin_enqueue_scripts', 'berkeley_eng_admin_enqueue_files' );

function berkeley_eng_admin_enqueue_files( $hook ) {
	
	if ( !in_array( $hook, array( 'edit.php', 'post.php', 'post-new.php', 'index.php' ) ) )
		return;
	
	global $post;
	
	wp_enqueue_style( 'berkeley-content-model-css', plugins_url( '/css/admin-style.css', __FILE__ ), '', '', 'screen' );
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