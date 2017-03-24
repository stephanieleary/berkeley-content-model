<?php

add_action( 'init', 'berkeley_cpt_slugs', 99 );

function berkeley_cpt_slugs() {
	if ( !function_exists( 'genesis_get_cpt_option' ) )
		return;
	
    $post_types = get_post_types( array( 'public' => true ) ); 
	$flush = false;
	
	foreach ( $post_types as $post_type ) {
		
		$slug = sanitize_title( genesis_get_cpt_option( 'slug', $post_type ) );

		if ( empty( $slug ) )
			continue;
		
		if ( taxonomy_exists( $slug ) || post_type_exists( $slug ) ) {		
			add_action( 'admin_notices', 'berkeley_cpt_url_error_notice' );
			return;
		}	

		$args = get_post_type_object( $post_type );
		$args->rewrite['slug'] = $slug;
		register_post_type( $post_type, $args );
		
		if ( !$flush )	
			$flush = true;
			
	}
	if ( $flush )
		flush_rewrite_rules();
}

add_action( 'genesis_cpt_archives_settings_metaboxes' , 'berkeley_register_cpt_settings_box' );

function berkeley_register_cpt_settings_box( $hook ) {
	add_meta_box( 'berkeley-url-settings', esc_html__( 'URL Settings' ), 'berkeley_cpt_url_settings_box', $hook, 'main', 'low' );
}


add_filter( 'genesis_cpt_archive_settings_defaults', 'berkeley_cpt_url_settings_defaults', 10, 2 );

function berkeley_cpt_url_settings_defaults( $settings, $post_type ) {
    $settings['slug'] = '';
    return $settings;
}


add_action( 'genesis_settings_sanitizer_init', 'berkeley_cpt_url_genesis_sanitize_settings' );

function berkeley_cpt_url_genesis_sanitize_settings() {
	// URL Slug setting
	$post_types = get_post_types( array( 'public' => true ) ); 

	foreach ( $post_types as $post_type ) {
		if ( isset( $post_type ) && is_object( $post_type ) && post_type_exists( $post_type ) ) {
			$setting = '_genesis_admin_cpt_archives_' . $post_type;
		    genesis_add_option_filter(
		        'no_html',
		        $GLOBALS[$setting]->settings_field,
		        array(
		            'slug',
		        )
		    );
		}
	}
    
}

function berkeley_cpt_url_error_notice() {
	printf( '<div class="error notice"><p>%s</p></div>', esc_html__( 'The URL slug you have entered is already being used by another post type or taxonomy. This archive will be unreachable until you choose a different slug.' ) );
}


function berkeley_cpt_url_settings_box() { 
	if ( !function_exists( 'genesis_get_cpt_option' ) )
		return;
		
	$name = GENESIS_CPT_ARCHIVE_SETTINGS_FIELD_PREFIX . $_REQUEST['post_type'] . '[slug]';
	$slug = sanitize_title( genesis_get_cpt_option( 'slug', $_REQUEST['post_type'] ), false );
	?>
	<table class="form-table">
	<tbody>

	<tr valign="top">
		<th scope="row">
			<label for="<?php echo esc_attr( $name ); ?>"><?php esc_html_e( 'Change archive URL slug to' );?></label>
		</th>
		<td>
		<p>
		<?php echo get_option( 'home' ) . '/'; ?>
		<input type="text" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $slug ); ?>" /> 
		</p>
		</td>
	</tr>

	</tbody>
	</table>
    <?php
}