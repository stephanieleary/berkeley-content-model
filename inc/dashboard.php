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
		<h3><?php esc_html_e( 'Post Types' ); ?></h3>
		<ul>
			<?php
		    $post_types = apply_filters( 'berkeley_dashboard_widget_post_types', array( 'post', 'page', 'attachment', 'people', 'facility', 'publication', 'course', 'research' ) );
			
		    foreach ( $post_types as $post_type ) {
				$content_type = get_post_type_object( $post_type );
		    	if ( current_user_can( $content_type->cap->edit_posts ) ) {
					printf( '<li><a href="%s">%s</a></li>' , esc_url( add_query_arg( array( 'post_type' => $content_type->name ) , admin_url( 'edit.php' ) ) ), $content_type->labels->name );
				}
		    }
		    ?>
		</ul>
	</div>
	<div class="welcome-panel-column">
		<h3><?php esc_html_e( 'Taxonomies' ); ?></h3>
		
		<?php
	    $taxonomies = apply_filters( 'berkeley_dashboard_widget_taxonomies', array( 'people_type', 'organization', 'subject_area', 'facility_type', 'student_type', 'committee', 'groups', 'research_areas' ) );
		
	    foreach ( $taxonomies as $tax ) {
			$taxonomy = get_taxonomy( $tax );
		 	if ( current_user_can( $taxonomy->cap->manage_terms ) ) {
				printf( '<li><a href="%s">%s</a></li>' , esc_url( add_query_arg( array( 'taxonomy' => $taxonomy->name ), admin_url( 'edit-tags.php' ) ) ), $taxonomy->label );
			}
	    }
	    ?>
	</div>
	<?php if ( current_user_can( 'edit_users' ) ) { ?>
	<div class="welcome-panel-column welcome-panel-last">
		<h3><?php esc_html_e( 'Users' ); ?></h3>
		<ul>
			<li><?php printf( '<a href="users.php">%s</a>', esc_html__( 'Manage Users' ) ); ?></li>
		</ul>
	</div>
	<?php } ?>
	</div>
	</div>
	</div>
	<?php
}