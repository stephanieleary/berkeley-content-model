<?php
function berkeley_engineering_dashboard_widget_setup() {
	if ( current_user_can('manage_options') ) {
		wp_add_dashboard_widget( 'berkeley_engineering_dashboard_wayfinding_widget', 'Manage Content...', 'berkeley_engineering_wayfinding_dashboard_widget');
	}
	
	// Remove built-in Dashboard widgets
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	// WordPress Blog
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	// Other WordPress News
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
}

add_action('wp_dashboard_setup', 'berkeley_engineering_dashboard_widget_setup');


function berkeley_engineering_wayfinding_dashboard_widget() {?>
	<div class="welcome-panel">
	<div class="welcome-panel-content">
	<div class="welcome-panel-column-container">
	<div class="welcome-panel-column">
		<h3><?php _e( 'Post Types' ); ?></h3>
		<ul>
			<?php
		    $content_types = get_post_types( '', 'objects' );
		    $ignored = array( 'revision', 'nav_menu_item', 'deprecated_log', 'acf-field', 'acf-field-group', 'import_users' );
		    foreach ( $content_types as $content_type ) {
		    	if ( !in_array( $content_type->name, $ignored ) ) { ?>
		    		<li>
						<?php printf( '<a href="%s">%s</a>' , add_query_arg( array( 'post_type' => $content_type->name ) , admin_url('edit.php') ), $content_type->labels->name ); ?>
					</li>
		    	<?php }
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
		 	if ( !in_array( $taxonomy->name, $ignored ) ) { ?>
	    		<li>
					<?php printf( '<a href="%s">%s</a>' , add_query_arg( array( 'taxonomy' => $taxonomy->name ), admin_url('edit-tags.php') ), $taxonomy->label ); ?>
				</li>
    		<?php }
	    }
	    ?>
	</div>
	<div class="welcome-panel-column welcome-panel-last">
		<h3><?php _e( 'Users' ); ?></h3>
		<ul>
			<li><?php printf( '<a href="%s">%s</a>', admin_url( 'users.php' ), __( 'Manage Users' ) ); ?></li>
		</ul>
	</div>
	</div>
	</div>
	</div>
	<?php
	
}