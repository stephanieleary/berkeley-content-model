<?php

add_action( 'customize_controls_print_styles', 'berkeley_customizer_styles', 999 );

function berkeley_customizer_styles() { ?>
	<style>
		#customize-theme-controls #customize-control-genesis_style_selection {
			background: url( <?php echo plugins_url( '../images/color-schemes/color-schemes-layers.png', __FILE__ ); ?>) bottom left no-repeat;
			background-size: contain;
			padding-bottom: 650px;
		}
	</style>
	<?php
}


add_filter( 'genesis_customizer_theme_settings_config', 'berkeley_genesis_theme_settings_config' );

function berkeley_genesis_theme_settings_config( $config ) {
	unset( $config['genesis']['sections']['genesis_updates'] );
	unset( $config['genesis']['sections']['genesis_header'] );
	$config['genesis']['sections']['genesis_archives']['controls']['content_archive_thumbnail']['description'] = __( 'Affects all content archives unless set to table or grid view, e.g. People archive image display/size is under People > Archive Settings > Post Layout Settings in the Dashboard', 'beng' );
	return $config;
}



add_action( 'customize_register', 'berkeley_theme_settings_customizer_register', 999 );

function berkeley_theme_settings_customizer_register( $wp_customize ) {

	$defaults = berkeley_theme_defaults();
	
	// remove WP Colors section; use Theme Settings -> Color Scheme instead
	$wp_customize->remove_section( 'colors' );
	
	// section for all custom settings
	$wp_customize->add_section( 'genesis_be_blog_meta', array(
		'title' => __( 'Blog Post Settings', 'beng' ),
		'priority' => 155,
		'capability' => 'edit_pages',
	) );
 
	// setting and control for post_info
	$wp_customize->add_setting( 'genesis_be_post_info', array(
		'default' => $defaults['genesis_be_blog_info'],
		'sanitize_callback' => 'wp_kses_post',
		'transport' => 'refresh',
		'type' => 'option',
	) );
 
	$wp_customize->add_control( 'genesis_be_post_info', array(
		'label' => __( 'Display below title', 'beng'),
		'section' => 'genesis_be_blog_meta',
		'type' => 'text',
	) );
	
	// setting and control for post_meta
	$wp_customize->add_setting( 'genesis_be_post_meta', array(
		'default' => $defaults['genesis_be_blog_meta'],
		'sanitize_callback' => 'wp_kses_post',
		'transport' => 'refresh',
		'type' => 'option',
	) );
 
	$wp_customize->add_control( 'genesis_be_post_meta', array(
		'label' => __( 'Display below content', 'beng' ),
		'section' => 'genesis_be_blog_meta',
		'type' => 'text',
	) );
	
	// setting and control for hide_title
	$wp_customize->add_setting( 'genesis_be_hide_title', array(
		'default' => $defaults['genesis_be_hide_title'],
		'sanitize_callback' => 'absint',
		'transport' => 'refresh',
		'type' => 'option',
	) );
 
	$wp_customize->add_control( 'genesis_be_hide_title', array(
		'label' => __( 'Hide page title on home page', 'beng' ),
		'section' => 'title_tagline',
		'type' => 'checkbox',
		'priority' => 45,
	) );
	
	// setting and control for show_logo
	$wp_customize->add_setting( 'genesis_be_show_logo', array(
		'default' => $defaults['genesis_be_show_logo'],
		'sanitize_callback' => 'absint',
		'transport' => 'refresh',
		'type' => 'option',
	) );
 
	$wp_customize->add_control( 'genesis_be_show_logo', array(
		'label' => __( 'Show Berkeley Engineering logo above the site title', 'beng' ),
		'section' => 'title_tagline',
		'type' => 'checkbox',
		'priority' => 45,
	) );

}


add_filter( 'genesis_theme_settings_defaults', 'berkeley_theme_defaults' );

function berkeley_theme_defaults( $defaults = array() ) {
	$defaults['genesis_be_show_logo'] = true;
	$defaults['genesis_be_hide_title'] = false;
	$defaults['style_selection'] = 'pool';
	$defaults['genesis_be_blog_meta'] = '[post_categories] [post_tags]';
	$defaults['genesis_be_blog_info'] = 'Posted on [post_date] by [post_author]';
	return $defaults;
}

// Copy settings from older versions of Genesis
add_action( 'upgrader_process_complete', 'be_genesis_upgrade_completed', 10, 2 );

function be_genesis_upgrade_completed( $upgrader_object, $args ) { 
	if( $args['action'] == 'update' && $args['type'] == 'theme' ) {
		$version = genesis_get_option( 'theme_version' );
		if ( $version >= 3 ) {
			add_option( 'genesis_be_show_logo', genesis_get_option( 'be_logo' ) );
			add_option( 'genesis_be_hide_title', genesis_get_option( 'hide_title' ) );
			add_option( 'genesis_be_post_meta', genesis_get_option( 'post_meta' ) );
			add_option( 'genesis_be_post_info', genesis_get_option( 'post_info' ) );
		}
	}
}