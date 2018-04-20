jQuery(function() {
    jQuery('.toggle').click(function(){
		var trClass = jQuery(this).val();
    	jQuery('.toggle-row').hide();
		jQuery('.toggle-row.' + trClass).show('slow');
    });
 });

jQuery(document).ready(function($){	
	
	// _cpt_archives.input_name objects are set via wp_localize_script in archive-settings.php
	
	
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
			page_item.append('<input type="hidden" name="genesis-cpt-archive-settings-publication[table_headers][]" value="' + page_item.attr('data-page-id') + '"/>');

			//add this new item to the end of the droppable list
			drop_helper.before(page_item);
			drop_helper.removeClass('active');

			trigger_remove_page_item_action();

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