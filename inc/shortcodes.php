<?php

add_action( 'init', 'berkeley_shortcodes_register' );

function berkeley_shortcodes_register() {
	add_shortcode( 'site-name', 'berkeley_eng_sitename_shortcode' );
	add_shortcode( 'people', 'berkeley_eng_people_directory' );
	add_shortcode( 'subcategories', 'berkeley_eng_category_directory' );
}

function berkeley_eng_sitename_shortcode() {
	return get_option( 'blogname' );
}

function berkeley_eng_people_directory( $atts ) {
	if ( !isset( $atts['type'] ) )
		$type = 'faculty';
	else
		$type = $atts['type'];
		
	$args = array(
		'post_type' => 'people',
		'meta_key' => 'last_name',
		'orderby' => 'meta_value title',
		'order' => 'ASC',
		'tax_query' => array(
				array(
					'taxonomy' => 'people_type',
					'field'    => 'slug',
					'terms'    => $type
				),
			),
		'posts_per_page' => -1
	);
	$the_query = new WP_Query( $args );

	$out = '<table cellpadding="0" cellspacing="0"><thead><tr>';
	$out .= '<th>'.esc_html__('Name', 'beng').'</th> <th>'.esc_html__('title', 'beng').'</th> <th>'.esc_html__('Phone', 'beng').'</th> <th>'.esc_html__('Email', 'beng').'</th>';
	$out .= '</tr></thead><tbody>';
	
	while ( $the_query->have_posts() ) :
		$the_query->the_post();
		$phone = get_post_meta( $the_query->post->ID, 'phone', true ) ? : '';
		$phonelink = 'tel:+1' . str_replace( array( '.', '-', '(', ')' ), '', esc_attr( $phone ) );
		$email = get_post_meta( $the_query->post->ID, 'email', true ) ? : '';
		
		$out .= '<tr itemscope itemtype="http://schema.org/Person" class="vcard">';
		$out .= sprintf( '<th itemprop="name" class="fn"><a href="%s">%s</a></th>', esc_url( get_permalink() ), get_the_title() );
		$out .= sprintf( '<td itemprop="jobTitle" class="note">%s</td>', get_post_meta( $the_query->post->ID, 'job_title', true ) );
		$out .= sprintf( '<td itemprop="telephone" class="tel"><a href="%s">%s</a></td>', esc_url( $phonelink ), $phone );
		$out .= sprintf( '<td itemprop="email" class="email"><a href="mailto:%1$s">%1$s</a></td>', antispambot( $email ) );
		$out .= '</tr>';
	endwhile;
	
	$out .= '</tbody></table>';
	wp_reset_query();
	wp_reset_postdata();
	
	return $out;
}


function berkeley_eng_category_directory( $atts ) {
	
	extract( $atts );
	if ( !isset( $taxonomy ) && isset( $atts[0] ) )
		$taxonomy = $atts[0];
	else 
		return;
	
	return wp_list_categories( array(
		'taxonomy' => $taxonomy, 
		'title_li' => '', 
		'show_option_none' => esc_html__( 'None listed' ), 
		'echo' => false, 
		'depth' => 1,
	) );
}
