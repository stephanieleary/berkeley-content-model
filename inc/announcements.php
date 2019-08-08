<?php

add_action( 'genesis_after_header', 'berkeley_eng_announcements_widget_area', 1 );

function berkeley_eng_announcements_widget_area() {
	if ( is_active_sidebar( 'berkeley-announcements' ) ) {

		echo '<div class="announcements"><div class="wrap">';
		dynamic_sidebar( 'berkeley-announcements' );
		echo '</div></div><!-- end .announcements -->';

	}
}

add_action( 'genesis_after_header', 'berkeley_eng_slideshow_widget_area', 99 );

function berkeley_eng_slideshow_widget_area() {
	if ( ( is_front_page() || is_home() ) && is_active_sidebar( 'berkeley-featured' ) ) {

		echo '<div class="featured"><div class="wrap">';
		dynamic_sidebar( 'berkeley-featured' );
		echo '</div></div><!-- end .featured -->';

	}
}

add_filter( 'body_class', 'berkeley_eng_slideshow_body_class' );

function berkeley_eng_slideshow_body_class( $classes ) {
	if ( is_home() && is_active_sidebar( 'berkeley-featured' ) ) {
		$classes[] = 'has-slideshow';  // featured-content is reserved in Genesis
	}
	return $classes;
}