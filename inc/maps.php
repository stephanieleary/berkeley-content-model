<?php
// * Render ACF Map fields
add_action( 'wp_head', 'berkeley_map_scripts' );

function berkeley_map_scripts() {
	if ( is_admin() )
		return;
	
	if ( !function_exists( 'get_field' ) )
		return;
		
	$location = get_field( 'map' );

	if ( empty( $location ) )
		return;
		
	wp_enqueue_script( 'berkeley-google-maps-api', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', '', '1.0.0', true );
	wp_enqueue_script( 'berkeley-acf-maps', get_stylesheet_directory_uri() . '/js/acf-maps.js', array( 'google-maps-api' ), '1.0.0', true );
}

function berkeley_render_map() {
	if ( !function_exists( 'get_field' ) )
		return;
		
	$location = get_field( 'map' );

	if( !empty( $location ) ):
	?>
	<div class="acf-map">
		<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
	</div>
	<?php endif;
}