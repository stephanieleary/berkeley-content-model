<?php
function berkeley_engineering_dashboard_widget_setup() {
	add_meta_box(
	    'berkeley_engineering_dashboard_wayfinding_widget',
	   	'Manage Content',
	    'berkeley_engineering_wayfinding_dashboard_widget',
	    'dashboard', 
	    'normal',
	    'high'
	);
	
	// Remove built-in Dashboard widgets
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_browser_nag', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_latest_comments', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	// remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
}

add_action( 'wp_dashboard_setup', 'berkeley_engineering_dashboard_widget_setup' );


function berkeley_engineering_wayfinding_dashboard_widget() {?>
	<div class="welcome-panel">
	<div class="welcome-panel-content">
	<div class="welcome-panel-column-container">
	<div class="welcome-panel-column">
		<h3><?php _e( 'Post Types' ); ?></h3>
		<ul>
			<?php
		    $content_types = get_post_types( '', 'objects' );
		    $ignored = array( 
				'revision', 
				'nav_menu_item', 
				'deprecated_log', 
				'acf-field', 
				'acf-field-group', 
				'import_users', 
				'soliloquy', 
				'wp-help', 
				'safecss' 
			);
		    foreach ( $content_types as $content_type ) {
		    	if ( !in_array( $content_type->name, $ignored ) ) {
					printf( '<li><a href="%s">%s</a></li>' , add_query_arg( array( 'post_type' => $content_type->name ) , admin_url( 'edit.php' ) ), $content_type->labels->name );
				}
		    }
		    ?>
		</ul>
	</div>
	<div class="welcome-panel-column">
		<h3><?php _e( 'Taxonomies' ); ?></h3>
		
		<?php
	    $taxonomies = get_taxonomies( array( 'public' => true ), 'objects', 'and' );
		$ignored = array( 'post_format' );
	    foreach ( $taxonomies as $taxonomy ) {
		 	if ( !in_array( $taxonomy->name, $ignored ) ) {
				printf( '<li><a href="%s">%s</a></li>' , add_query_arg( array( 'taxonomy' => $taxonomy->name ), admin_url( 'edit-tags.php' ) ), $taxonomy->label );
			}
	    }
	    ?>
	</div>
	<?php if ( current_user_can('manage_options') ) { ?>
	<div class="welcome-panel-column welcome-panel-last">
		<h3><?php _e( 'Users' ); ?></h3>
		<ul>
			<li><?php printf( '<a href="%s">%s</a>', admin_url( 'users.php' ), __( 'Manage Users' ) ); ?></li>
		</ul>
	</div>
	<?php } ?>
	</div>
	</div>
	</div>
	<?php
}