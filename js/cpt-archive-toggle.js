jQuery(function() {
    jQuery('.toggle').on('change', function() {
		var trClass = jQuery(this).val();
    	jQuery('.toggle-row').hide();
		jQuery('.toggle-row.' + trClass).show('slow');
		
		if ( jQuery('#show_excerpt_checkbox').prop( 'checked', false ) )
			jQuery('.toggle-row.show_excerpt').hide();
    });

	jQuery('#subdivide').on('change', function() {
		jQuery('#posts_per_archive_page').show();
		if ( jQuery('#subdivide').val().length > 0 ) {
			//console.log( jQuery('#subdivide').val() );
			jQuery('#posts_per_archive_page').hide();
		}
	});
	
	if ( jQuery('#show_excerpt_checkbox').prop( 'checked' ) )
		jQuery('.toggle-row.show_excerpt').show();
		
	jQuery('#show_excerpt_checkbox').on('change', function() {
		jQuery('.toggle-row.show_excerpt').hide();
    	if ( jQuery('#show_excerpt_checkbox').prop( 'checked' ) )
			jQuery('.toggle-row.show_excerpt').show('slow');
    });
	
	
 });

jQuery(document).ready(function($){	
	
	// _cpt_archives (hidden input name) is set via wp_localize_script in archive-settings.php
	//console.log( _cpt_archives );
	
	/*Draggable Area*/
	$('.left_container .page_item').draggable({
		helper: 'clone',
		revert: 'invalid',
		scope: 'related_pages_scope',
		cursor: 'move',
		zIndex: 5
	});
	
	/*Droppable Area*/
	$('.right_container').droppable({
		accept: '.page_item',
		scope: 'related_pages_scope',
		hoverClass: 'hover-over-draggable',
		tolerance: 'touch',
		drop: function(event,ui){

			//define items for use
			var drop_helper = $('.right_container').find('.droppable-helper');
			var page_item = ui.draggable.clone(); 

			//on drop trigger actions
			page_item.find('.remove_item').addClass('active');
			page_item.append('<input type="hidden" name="'+ _cpt_archives +'[table_headers][]" value="' + page_item.attr('data-page-id') + '"/>');

			//add this new item to the end of the droppable list
			drop_helper.before(page_item);
			drop_helper.removeClass('active');

			trigger_remove_page_item_action();
			
			//console.log( _cpt_archives +'[table_headers]' );

		},
		over: function(event,ui){
			//when hovering over the droppable area, display the drop helper
			$('.right_container').find('.droppable-helper').addClass('active');

		},
		out: function(event,ui){
			$('.right_container').find('.droppable-helper').removeClass('active');
		}
	});
	
	/*Sortable Area*/
	$('.right_container').sortable({
		items: '.page_item',
		cursor: 'move',
		containment: 'parent',
		placeholder: 'my-placeholder'
	});
	
	//Remove page item functionality
	function trigger_remove_page_item_action(){
		$('.remove_item').on('click',function(){
			$(this).parents('.page_item').remove();
		});
	}
	trigger_remove_page_item_action();
	
	
});