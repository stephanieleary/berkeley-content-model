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
	unset( $config['sections']['genesis_updates'] );
	unset( $config['sections']['genesis_header'] );
	return $config;
}


add_action( 'customize_register', 'berkeley_theme_settings_customizer_register', 999 );

function berkeley_theme_settings_customizer_register( $wp_customize ) {
	
	$mods = get_theme_mods();
	
	if ( !isset( $mods['genesis_be_blog_meta'] ) )
		$mods['genesis_be_blog_meta'] = genesis_get_option( 'post_meta' );
	if ( !isset( $mods['genesis_be_blog_info'] ) )
		$mods['genesis_be_blog_info'] = genesis_get_option( 'post_info' );
	if ( !isset( $mods['genesis_be_hide_title'] ) )
		$mods['genesis_be_hide_title'] = genesis_get_option( 'hide_home_title' );
	if ( !isset( $mods['genesis_be_show_logo'] ) )
		$mods['genesis_be_show_logo'] = genesis_get_option( 'hide_home_title' );
	
	$mods = wp_parse_args( $mods, berkeley_theme_defaults() );
	
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
		'default' => $mods['genesis_be_blog_info'],
		'sanitize_callback' => 'berkeley_theme_option_sanitization',
		'transport' => 'refresh',
		'type' => 'theme_mod',
	) );
 
	$wp_customize->add_control( 'genesis_be_post_info', array(
		'label' => __( 'Display below title', 'beng'),
		'section' => 'genesis_be_blog_meta',
		'type' => 'text',
	) );
	
	// setting and control for post_meta
	$wp_customize->add_setting( 'genesis_be_post_meta', array(
		'default' => $mods['genesis_be_blog_meta'],
		'sanitize_callback' => 'berkeley_theme_option_sanitization',
		'transport' => 'refresh',
		'type' => 'theme_mod',
	) );
 
	$wp_customize->add_control( 'genesis_be_post_meta', array(
		'label' => __( 'Display below content', 'beng' ),
		'section' => 'genesis_be_blog_meta',
		'type' => 'text',
	) );
	
	// setting and control for hide_title
	$wp_customize->add_setting( 'genesis_be_hide_title', array(
		'default' => $mods['genesis_be_hide_title'],
		'sanitize_callback' => 'berkeley_theme_option_sanitization',
		'transport' => 'refresh',
		'type' => 'theme_mod',
	) );
 
	$wp_customize->add_control( 'genesis_be_hide_title', array(
		'label' => __( 'Hide page title on home page', 'beng' ),
		'section' => 'title_tagline',
		'type' => 'checkbox',
		'priority' => 35,
	) );
	
	// setting and control for show_logo
	$wp_customize->add_setting( 'genesis_be_show_logo', array(
		'default' => $mods['genesis_be_show_logo'],
		'sanitize_callback' => 'berkeley_theme_option_sanitization',
		'transport' => 'refresh',
		'type' => 'theme_mod',
	) );
 
	$wp_customize->add_control( 'genesis_be_show_logo', array(
		'label' => __( 'Show Berkeley Engineering logo above the site title', 'beng' ),
		'section' => 'title_tagline',
		'type' => 'checkbox',
		'priority' => 35,
	) );

}


add_filter( 'genesis_theme_settings_defaults', 'berkeley_theme_defaults' );

function berkeley_theme_defaults( $defaults = array() ) {
	$defaults['genesis_be_show_logo'] = false;
	$defaults['genesis_be_hide_title'] = false;
	$defaults['style_selection'] = 'pool';
	$defaults['genesis_be_blog_meta'] = '[post_categories] [post_tags]';
	$defaults['genesis_be_blog_info'] = 'Posted on [post_date] by [post_author]';
	return $defaults;
}


add_action( 'genesis_settings_sanitizer_init', 'berkeley_theme_option_sanitization' );

function berkeley_theme_option_sanitization() {
		
	genesis_add_option_filter( 
		'no_html', 
		'genesis_be_show_logo'
	);
	
	genesis_add_option_filter( 
		'no_html', 
		'genesis_be_hide_title'
	);
	
	genesis_add_option_filter( 
		'safe_html', 
		'genesis_be_post_meta'
	);
	
	genesis_add_option_filter( 
		'safe_html', 
		'genesis_be_post_info'
	);
}