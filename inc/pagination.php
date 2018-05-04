<?php

// Replace Genesis pagination function. Ours has extra screen reader text for better context and accessibility.
// Do it after_setup_theme; otherwise Genesis puts it back 
add_action( 'after_setup_theme', 'berkeley_setup_pagination', 99 );

function berkeley_setup_pagination() {
	remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );
	add_action( 'genesis_after_endwhile', 'berkeley_a11y_posts_nav' );
}

function berkeley_a11y_posts_nav() {

	if ( 'numeric' === genesis_get_option( 'posts_nav' ) ) {
		berkeley_a11y_numeric_posts_nav();
	} else {
		genesis_prev_next_posts_nav();
	}

}

function berkeley_a11y_numeric_posts_nav( $paged = NULL, $max = NULL ) {

	if( is_singular() ) {
		return;
	}

	global $wp_query;

	// Stop execution if there's only one page.
	if( $wp_query->max_num_pages <= 1 ) {
		return;
	}

	if ( !isset( $paged ) )
		$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	if ( !isset( $max ) )
	$max   = (int) $wp_query->max_num_pages;

	// Add current page to the array.
	if ( $paged >= 1 ) {
		$links[] = $paged;
	}

	// Add the pages around the current page to the array.
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	genesis_markup( array(
		'open'    => '<div %s>',
		'context' => 'archive-pagination',
	) );

	$before_number = genesis_a11y( 'screen-reader-text' ) ? '<span class="screen-reader-text">' . __( 'Go to page ', 'beng' ) .  '</span>' : '';

	echo '<ul role="navigation" aria-labelledby="paginglabel">';

	// Previous Post Link.
	if ( get_previous_posts_link() ) {
		printf( '<li class="pagination-previous">%s</li>' . "\n", get_previous_posts_link( apply_filters( 'genesis_prev_link_text', '&#x000AB; ' . __( '<span class="screen-reader-text">Go to </span> Previous Page', 'beng' ) ) ) );
	}

	// Link to first page, plus ellipses if necessary.
	if ( ! in_array( 1, $links ) ) {

		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), $before_number . '1' );

		if ( ! in_array( 2, $links ) ) {
			printf( '<li class="pagination-omission"><span class="screen-reader-text">%s </span>&#x02026;</li> ' . "\n", __( 'Interim pages omitted', 'beng' ) );
		}

	}

	// Link to current page, plus 2 pages in either direction if necessary.
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active" ' : '';
		$aria  = $paged == $link ? ' aria-label="' . esc_attr__( "You're currently reading page ", 'beng' ) . '"' : '';
		$before = $paged == $link ? '' : $before_number;
		printf( '<li%s><a href="%s"%s>%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $aria, $before . $link );
	}

	// Link to last page, plus ellipses if necessary.
	if ( ! in_array( $max, $links ) ) {

		if ( ! in_array( $max - 1, $links ) ) {
			printf( '<li class="pagination-omission"><span class="screen-reader-text">%s </span>&#x02026;</li> ' . "\n", __( 'Interim page numbers omitted', 'beng' ) );
		}

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $before_number . $max );

	}

	// Next Post Link.
	if ( get_next_posts_link() ) {
		printf( '<li class="pagination-next">%s</li> ' . "\n", get_next_posts_link( apply_filters( 'genesis_next_link_text', __( '<span class="screen-reader-text">Go to </span>Next Page', 'beng' ) . ' &#x000BB;' ) ) );
	}

	echo '</ul>';
	genesis_markup( array(
		'close'    => '</div>',
		'context' => 'archive-pagination',
	) );

	echo "\n";

}