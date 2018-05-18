<?php

add_filter( 'pre_get_posts', 'berkeley_cpt_archive_sort' );

function berkeley_cpt_archive_sort( $query ) {
	if ( is_admin() )
		return $query;
	if ( !is_archive() )
		return $query;
		
	if ( isset ($query->query['post_type'] ) ) {
		switch ( $query->query['post_type'] ) {

			case 'course':
				$query->set( 'order', 'ASC' );
				$query->set( 'orderby', 'meta_value meta_value_num title' );
				$query->set( 'meta_key', 'course_number' );
				break;

			case 'facility':
				$query->set( 'order', 'ASC' );
				$query->set( 'orderby', 'title' );
				break;

			case 'people':
				$query->set( 'order', 'ASC' );
				$query->set( 'orderby', 'menu_order meta_value title' );
				$query->set( 'meta_key', 'last_name' );
				break;

			default:
				break;
		}
	}
	
	
	if ( isset( $query->query['people_type'] ) ) {
		$query->set( 'order', 'ASC' );
		$query->set( 'orderby', 'menu_order meta_value title' );
		$query->set( 'meta_key', 'last_name' );
	}
	
	if ( isset( $query->query['facility_type'] ) ) {
		$query->set( 'order', 'ASC' );
		$query->set( 'orderby', 'title' );
	}
	
	
	// handle CPT archive grid/table layout loop settings
	if ( is_post_type_archive() ) {
		berkeley_genesis_archive_paging( $query, $query->post_type );
	}
	
	// if single-CPT taxonomy, inherit CPT archive layout settings
	if ( is_tax() && function_exists( 'berkeley_find_post_type' ) ) {
		$post_type = berkeley_find_post_type();
		if ( isset( $post_type ) && !empty( $post_type ) ) {
			berkeley_genesis_archive_paging( $query, $post_type );
		}
	}
	
	return $query;
}


function berkeley_genesis_archive_paging( $query, $post_type ) {
	
	$layout = genesis_get_cpt_option( 'post_layout', $post_type );
	if ( 'grid' == $layout ) {
		$rows = genesis_get_cpt_option( 'grid_rows', $post_type );
		if ( -1 == $rows )
			$query->set( 'posts_per_archive_page', -1 );
		else {
			$columns = (int) genesis_get_cpt_option( 'grid_columns', $post_type );
			$query->set( 'posts_per_archive_page', $columns * (int)$rows );
		}
	}
	else {
		$perpage = genesis_get_cpt_option( 'posts_per_archive_page', $post_type );
		if ( isset( $perpage ) && !empty( $perpage ) ) {
			$query->set( 'posts_per_archive_page', $perpage );
		}
	}
	
	return $query;
}

// Grid loop post classes
add_filter( 'post_class', 'berkeley_grid_post_classes' );

function berkeley_grid_post_classes( $classes ) {
	if ( !is_post_type_archive() )
		return $classes;	
		
	$layout = genesis_get_cpt_option( 'post_layout', get_post_type() );
	if ( 'grid' !== $layout ) 
		return $classes;
		
	$columns = (int) genesis_get_cpt_option( 'grid_columns', get_post_type() );
	if ( !isset( $columns ) || empty( $columns ) )
		return $classes;
	
	global $wp_query;
	/*
	if( ! $wp_query->is_main_query() )
		return $classes;
	/**/
	switch ( $columns ) {
		case '6': 
			$classes[] = 'one-sixth';
			if ( 0 == $wp_query->current_post % 6 )
				$classes[] = 'first';
			break;
		case '5':
			$classes[] = 'one-fifth';
			if ( 0 == $wp_query->current_post % 5 )
				$classes[] = 'first';
			break;
		case '4':
			$classes[] = 'one-fourth';
			if ( 0 == $wp_query->current_post % 4 )
				$classes[] = 'first';
			break;
		case '3':
			$classes[] = 'one-third';
			if ( 0 == $wp_query->current_post % 3 )
				$classes[] = 'first';
			break;
		case '2':
		default: 
			$classes[] = 'one-half';
			if ( 0 == $wp_query->current_post % 2 )
				$classes[] = 'first';
		break;
	}
	
	return $classes;
}

// Grid loop image setting override 

add_action( 'genesis_meta', 'berkeley_grid_post_images' );

function berkeley_grid_post_images() {
	if ( !is_post_type_archive() )
		return;
		
	remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
	remove_action( 'genesis_post_content', 'genesis_do_post_image' );
	remove_action( 'genesis_entry_header', 'genesis_do_post_image', 1 );
	add_action( 'genesis_entry_header', 'berkeley_do_post_image', 1 );
}

function berkeley_do_post_image() {
	if ( !is_archive() )
		return;
		
	$post_type = get_post_type();
	
	if ( ( 'grid' == genesis_get_cpt_option( 'post_layout', $post_type ) && genesis_get_cpt_option( 'grid_thumbnails', $post_type ) ) || genesis_get_option( 'content_archive_thumbnail' ) ) {
		
		if ( 'grid' == genesis_get_cpt_option( 'post_layout', $post_type ) )
			$size = genesis_get_cpt_option( 'grid_thumbnails', $post_type );
		else
			$size = genesis_get_option( 'image_size' );
		
		$img = genesis_get_image( array(
			'format'  => 'html',
			'size'    => $size,
			'context' => 'archive',
			'attr'    => genesis_parse_attr( 'entry-image', array ( 'alt' => get_the_title() ) ),
		) );

		if ( ! empty( $img ) ) {

			genesis_markup( array(
				'open'    => '<a %s>',
				'close'   => '</a>',
				'content' => wp_make_content_images_responsive( $img ),
				'context' => 'entry-image-link'
			));

		}
	}
}

// Display featured image; switch loops when applicable
add_action( 'genesis_before', 'berkeley_genesis_hooks', 10 );
function berkeley_genesis_hooks() {
	$post_type = get_post_type();
	//remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );
	remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
	remove_action( 'genesis_post_content', 'genesis_do_post_image' );
	$showimg = get_post_meta( get_the_ID(), 'display_featured_image', true );
	if ( $showimg )
		add_action( 'genesis_entry_header', 'genesis_do_post_image', 1 );
	
	if ( is_singular() )
		return;
	
	if ( is_archive() )
		add_action( 'genesis_loop', 'berkeley_sticky_post_loop', 1 );
	
	if ( is_post_type_archive() ) {
		$layout = genesis_get_cpt_option( 'post_layout', $post_type );
		$subdivide = genesis_get_cpt_option( 'subdivide', $post_type );	
		
		if ( $layout == 'table' ) {
			remove_action( 'genesis_loop', 'genesis_do_loop' );
			add_action( 'genesis_loop', 'berkeley_cpt_table_loop', 10 );
		}
		elseif ( $subdivide ) {
			remove_action( 'genesis_loop', 'genesis_do_loop' );
			add_action( 'genesis_loop', 'berkeley_cpt_archive_subdivisions_loop', 10 );
		}
	}
	
	if ( is_tax() ) {
		add_action( 'genesis_before', 'berkeley_taxonomy_loop_switch', 99 );
		// inherit CPT archive settings for single-CPT taxonomies
		$post_type = berkeley_find_post_type();
		$layout = genesis_get_cpt_option( 'post_layout', $post_type );
		
		if ( $layout == 'table' ) {
			remove_action( 'genesis_loop', 'genesis_do_loop' );
			add_action( 'genesis_loop', 'berkeley_cpt_table_loop', 10 );
		}
	}
}


// Shared taxonomies: list post types with filtered links

function berkeley_list_taxonomy_post_types() {
	$current_term = get_queried_object();
	$tax_obj = get_taxonomy( $current_term->taxonomy );
	if ( count( $tax_obj->object_type ) ) {
		echo '<div class="entry"><ul class="post-type-list">';
		foreach ( $tax_obj->object_type as $post_type ) {
			$label = get_post_type_object( $post_type )->labels->singular_name;
			$link = add_query_arg( array( $current_term->taxonomy => $current_term->slug ), get_post_type_archive_link( $post_type ) );
			echo '<li><a href="' . $link . '">' . $label . '</a></li>';
		}
		echo '</ul></div>';
	}
}

// Single taxonomies: replace loop with list of post types if there's more than one

function berkeley_taxonomy_loop_switch() {
	if ( function_exists( 'berkeley_find_post_type' ) )
		$type = berkeley_find_post_type();
	else
		$type = get_query_var( 'post_type' );
		
	if ( empty( $type ) || 'any' == $type || is_array( $type ) ) {
		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_action( 'genesis_loop', 'berkeley_list_taxonomy_post_types', 1 );
	}
	else
		add_action( 'genesis_loop', 'berkeley_sticky_post_loop', 1 );
}

// CPT archives with optional taxonomy-based subdivisions

function berkeley_cpt_archive_subdivisions_loop() {
	
	$post_type = berkeley_find_post_type();
	$divide_by_tax = genesis_get_cpt_option( 'subdivide', $post_type );
	
	if ( empty( $divide_by_tax ) ) {
		// do not subdivide this archive page. Do the regular loop.
		genesis_do_loop();
		return;
	}	
	
	// Set up subdivisions
	$terms = get_terms( array(
	    'taxonomy' => $divide_by_tax,
	    'hide_empty' => true,
	) );
	if ( empty( $terms ) )
		return;

	global $query_args;

	foreach ( $terms as $term ) {
		
		$args = array(
			'fields' => 'ids',
			'posts_per_page'  => -1,
			'posts_per_archive_page' => -1,
			'nopaging' => true,
			'post_type' => $post_type,
			'tax_query' => array(
					array(
						'taxonomy' => $divide_by_tax,
						'field'    => 'slug',
						'terms'    => $term->slug,
						'include_children' => false
					),
				),
		);
		
		$have_posts = get_posts( wp_parse_args( $args, $query_args ) );
		
		if ( count( $have_posts ) ) {
			echo '<div class="wrap '.$post_type.'_type_loop '.$term->slug. ' ' .$divide_by_tax.'">';
			remove_action( 'genesis_loop_else', 'genesis_do_noposts' );
			remove_action( 'genesis_after_endwhile', 'berkeley_a11y_posts_nav' );
			printf( '<h2 %s>%s</h2>', genesis_attr( 'archive-title' ), strip_tags( $term->name ) );
			unset( $args['fields'] );
			genesis_custom_loop( wp_parse_args( $args, $query_args ) );
			echo '</div>';
		}
		
	}
}


// Sticky posts

function berkeley_sticky_post_loop() {
	if ( !get_option( 'sticky_posts' ) )
		return;
		
	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	if ( 1 == $paged ) :
		global $query_args;
		$args = array(
			'posts_per_page'  => 1,
			'posts_per_archive_page' => 1,
			'post_type'  	  => get_query_var( 'post_type' ),
			'post__in'		  => get_option( 'sticky_posts' ),
		 );
		
		if ( is_tax() ) {
			$queried_object = get_queried_object();
			$args[$queried_object->taxonomy] = $queried_object->slug;
		}
			
		echo '<div class="stickies">';
		remove_action( 'genesis_loop_else', 'genesis_do_noposts' );
		remove_action( 'genesis_after_endwhile', 'berkeley_a11y_posts_nav' );
		genesis_custom_loop( wp_parse_args( $args, $query_args ) );
		add_action( 'genesis_loop_else', 'genesis_do_noposts' );
		add_action( 'genesis_after_endwhile', 'berkeley_a11y_posts_nav' );
		echo '</div>';
	endif;
}

add_filter( 'post_class', 'berkeley_sticky_post_class' );

function berkeley_sticky_post_class( $classes ) {
	if ( is_sticky() || in_array( get_the_ID(), get_option( 'sticky_posts' ) ) )
		$classes[] = 'sticky';
	return $classes;
}

// Table loops

function berkeley_loop_table_headers( $headers ) {
	$headerrow = '';
	foreach ( $headers as $header ) {
		$headerrow .= sprintf( "<th>%s</th>\n", $header );
	}
	
	return sprintf( '<div class="loop"><table cellspacing="0" class="responsive">
		<thead>
			<tr>
		      %s
		    </tr>
		</thead>
		<tbody>'."\n", $headerrow );
}

function berkeley_loop_table_cells( $data ) {
	$datarow = '';
	$rowindex = 1;
	foreach ( $data as $title => $field ) {
		$class = '';
		if ( empty( trim ( $field ) ) )
			$class = ' class="empty"';
		$tag = 'td';
		if ( 1 == $rowindex )
			$tag = 'th';
		$datarow .= sprintf( '<%s title="%s" %s>%s</%1$s>'."\n", $tag, $title, $class, $field );
		$rowindex++;
	}
	
	return sprintf( "<tr id='post-%d' %s>\n %s \n </tr>\n", get_the_ID(), genesis_attr( 'entry' ), $datarow );
}

function berkeley_loop_table_footer() {
	return "</tbody>\n </table>\n</div><!-- .loop -->\n";
}


function berkeley_people_table_loop() {
	if ( have_posts() ) :

		do_action( 'genesis_before_while' );
		
		$headers = array( esc_html__('Name', 'berkeley-coe-theme'), esc_html__('Title', 'berkeley-coe-theme'), esc_html__('Office', 'berkeley-coe-theme'), esc_html__('Email', 'berkeley-coe-theme') );
		
		echo berkeley_loop_table_headers( $headers );
	
		while ( have_posts() ) : the_post();
		
			do_action( 'genesis_before_entry' );
			
			$data = array( 
				sprintf( '<a href="%s" title="%s">%s</a>', esc_url( get_permalink() ), the_title_attribute( 'echo=0' ), get_the_title() ),
				get_field( 'job_title' ),
				get_field( 'address_line_1' ),
				sprintf( '<a href="mailto:%1$s">%1$s</a>', antispambot( get_field( 'email' ) ) )
			);
			
			echo berkeley_loop_table_cells( array_combine( $headers, $data ) );
			
			do_action( 'genesis_after_entry' );

		endwhile; //* end of one post
		
		echo berkeley_loop_table_footer();
		
		do_action( 'genesis_after_endwhile' );
		
	else : //* if no posts exist
		do_action( 'genesis_loop_else' );
	endif; //* end loop
}

// Generic CPT table loops

function berkeley_cpt_table_loop() {
	if ( have_posts() ) :

		do_action( 'genesis_before_while' );
		
		$post_type = berkeley_find_post_type();
		$headers = apply_filters( 'berkeley_loop_table_headers', genesis_get_cpt_option( 'table_headers', $post_type ) );
					
		echo berkeley_loop_table_headers( $headers );
	
		while ( have_posts() ) : the_post();
		
			//do_action( 'genesis_before_entry' );
			
			$data = berkeley_loop_table_data( $headers );
			
			echo berkeley_loop_table_cells( array_combine( $headers, $data ) );
			
			//do_action( 'genesis_after_entry' );

		endwhile; //* end of one post
		
		echo '</tbody></table>';
		
		echo '</div>';
		
		do_action( 'genesis_after_endwhile' );

	else : //* if no posts exist
		do_action( 'genesis_loop_else' );
	endif; //* end loop
}

function berkeley_loop_table_data( $headers ) {
	$data = array();
	$post_id = get_the_ID();
	
	foreach ( $headers as $header => $label ) {
		
		switch ( $header ) {
			case 'title':
				$data[$header] = sprintf( '<a href="%s">%s</a>', get_permalink( $post_id ), get_the_title( $post_id ) );
				break;
			case 'post_excerpt': 
				$data[$header] = apply_filters( 'the_excerpt', get_the_excerpt( $post_id ) );
				break;
			case 'post_author':
				$author_id = get_post_field( 'post_author', $post_id );
				$data[$header] = sprintf( '<a href="%s">%s</a>', get_author_posts_url( $author_id ), get_the_author( $post_id ) ); 
				break;
			case 'date':
				$data[$header] = get_the_date( get_option( 'date_format' ), $post_id ); 
				break;
			case 'modified_date':
				$data[$header] = get_the_modified_date( get_option( 'date_format' ), $post_id );
				break;
			
			case 'course_title_num':
			 	$data[$header] = sprintf( '<a href="%s">%s %s</a>', get_permalink( $post_id ), get_field( 'course_number' ), get_the_title( $post_id ) );
				break;
				
			case 'first_name':
			case 'last_name':
			case 'publication_name':
			case 'instructors':
			case 'times':
			case 'job_title':
			case 'phone':
			case 'phone_number':
			case 'street_address':
			case 'city':
			case 'state':
			case 'zip':
			case 'hours':
			case 'major':
			case 'class_year':
				$data[$header] = get_field( $header );
				break;
			
			case 'course_number':
			 	$data[$header] = sprintf( '<a href="%s">%s</a>', get_permalink( $post_id ), get_field( $header ) );
				break;

			case 'link':
			case 'links':
			 	$data[$header] = make_clickable( get_field( $header ) );
				break;	
		
			case 'address':
				if ( !empty( get_field( 'address_line_2' ) ) )
			 		$data[$header] = sprintf( '%s<br />%s', get_field( 'address_line_1' ), get_field( 'address_line_2' ) );
				else
					$data[$header] = get_field( 'address_line_1' );
				break;
			
			case 'email':
				$data[$header] = sprintf( '<a href="mailto:%1$s">%1$s</a>', antispambot( get_field( $header ) ) );
				break;
					
			case 'facility_type':
			case 'people_type':
			case 'publication_type':
			case 'subject_area':
			case 'service':
			case 'post_tag':
				$data[$header] = get_the_term_list( $post_id, $header, '', ', ', '' );
				break;
			default: break;
		}
		
	}
	
	return apply_filters( 'berkeley_loop_table_data', $data );
}

add_filter( 'berkeley_loop_table_headers', 'berkeley_table_header_labels' );

function berkeley_table_header_labels( $headers ) {
	$post_type = berkeley_find_post_type();
	if ( empty( $headers ) )
		$headers = berkeley_get_default_table_view_headers( $post_type );
	$labels = berkeley_get_available_table_view_headers( $post_type );
	// array_intersect_keys() destroys order
	$header_labels = array();
	foreach ( $headers as $key ) {
		$header_labels[$key] = $labels[$key];
	}
	return $header_labels;
}