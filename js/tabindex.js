// Set focus on first name field for people, where title field is hidden
jQuery( document ).ready(function() {
	// people
	jQuery( "body.post-type-people #first_name .acf-input input" ).focus();
	// facilities
	jQuery( "body.post-type-facility #title" ).focus();
});

// people
(function($) { $(document).on( 'keydown', '#title, body.post-type-people .acf-field-email .acf-input input', function( e ) {
	var keyCode = e.keyCode || e.which;
	if ( 9 == keyCode){
		e.preventDefault();
		var target = $(this).attr('id') == 'title' ? '.acf-field-email .acf-input input' : 'textarea#content';
		if ( (target === '.acf-field-email .acf-input input') || $('#wp-content-wrap').hasClass('html-active') ) {
			$(target).focus();
		} else {
			tinymce.execCommand('mceFocus',false,'content');
		}
	}
}); })(jQuery);

// facilities
(function($) { $(document).on( 'keydown', '#title, body.post-type-facility .acf-field-email .acf-input input', function( e ) {
	var keyCode = e.keyCode || e.which;
	if ( 9 == keyCode){
		e.preventDefault();
		var target = $(this).attr('id') == 'title' ? '#facility_type .acf-input ul li:first-child input' : 'textarea#content';
		if ( (target === '#facility_type .acf-input ul li:first-child input') || $('#wp-content-wrap').hasClass('html-active') ) {
			$(target).focus();
		} else {
			tinymce.execCommand('mceFocus',false,'content');
		}
	}
}); })(jQuery);

