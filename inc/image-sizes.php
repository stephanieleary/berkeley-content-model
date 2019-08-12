<?php

// Disable WordPress's terrible image compression function. We'll handle this with a plugin.
add_filter( 'jpeg_quality', function( $arg ){ return 100; } );

// Disable Genesis's default first-uploaded image fallback

add_filter( 'genesis_get_image_default_args', 'berkeley_eng_image_default_args' );

function berkeley_eng_image_default_args( $args ) {
	$args['fallback'] = '';
	return $args;
}

// Blog post image sizes

add_filter( 'genesis_pre_get_option_image_size', 'berkeley_eng_blog_image_sizes' );

function berkeley_eng_blog_image_sizes( $size = 'thumbnail' ) {
	if ( is_sticky() && ( 'post' == get_post_type() || !is_main_query() ) ) {
		$size = 'medium';
	}
	return $size;
}

add_filter( 'genesis_attr_entry-image', 'berkeley_eng_blog_image_classes', 10, 2 );

function berkeley_eng_blog_image_classes( $attributes, $context ) {
	if ( is_sticky() && ( 'post' == get_post_type() || !is_main_query() ) ) {
		$attributes['class'] = str_replace( array( 'alignleft', 'alignnone', 'aligncenter' ), '', $attributes['class'] );
		$attributes['class'] .= ' alignright';
	}
	return $attributes;
}

// Default site icon / favicon

add_filter( 'get_custom_logo', 'berkeley_eng_site_icon' );

function berkeley_eng_site_icon( $html ) {
	if ( empty( $html ) ) {
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		if ( !isset($custom_logo_id ) || empty( $custom_logo_id ) ) {
			$logo_url = wp_get_attachment_image( $custom_logo_id, 'full', false, array( 'class' => 'custom-logo' ) );
		}
		else {
			$logo_url = get_stylesheet_directory_uri() . '/images/BE-favicon.png';
		}
		$html = sprintf( '<a href="%s" class="custom-logo-link" rel="home" itemprop="url"><img class="custom-logo" itemprop="logo" src="%s" /></a>', esc_url( home_url( '/' ) ), $logo_url );
	}
	return $html;
}

remove_action( 'wp_head', 'genesis_load_favicon' );
add_filter( 'genesis_pre_load_favicon', 'berkeley_load_favicon' );

function berkeley_load_favicon( $favicon_url ) {
	if ( has_site_icon() )
		return $favicon_url;
	return get_stylesheet_directory_uri() . '/images/BE-favicon-150x150.png';
}

// Featured Image support

//add_action( 'genesis_before_entry', 'berkeley_eng_featured_image_singular', 8 );
add_action( 'genesis_entry_header', 'berkeley_eng_featured_image_singular', 1 );
function berkeley_eng_featured_image_singular() {
	if ( ! is_singular() || ! has_post_thumbnail() )
		return;
	
	$showimg = get_post_meta( get_the_ID(), 'display_featured_image', true );
	if( !$showimg )
		return;
	
	/*
    $imgdata = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
    $imgwidth = $imgdata[1]; // thumbnail's width                   
    $wanted_width = 900;
    if ( ( $imgwidth >= $wanted_width ) ) {
		// print here
    }
	/**/
	
	// caption is stored as thumbnail's post excerpt
	// use post content to use description field instead
	$img = get_the_post_thumbnail( get_the_ID(), 'large' );
	$caption = get_post_field( 'post_excerpt', get_post_thumbnail_id() );
	printf( '<div class="featured-image">%s<div class="wp-caption-text">%s</div></div>', $img, $caption );
}