(function($) { $(document).on( 'keydown', '#title, #acf_after_title-sortables input', function( e ) {
  var keyCode = e.keyCode || e.which;
  if ( 9 === keyCode){
    e.preventDefault();
    var target = $(this).attr('id') === 'title' ? '#acf_after_title-sortables input' : 'textarea#content';
    if ( (target === '#acf_after_title-sortables input') || $('#wp-content-wrap').hasClass('html-active') ) {
      $(target).focus();
    } else {
      tinymce.execCommand('mceFocus',false,'content');
    }
  }
}); })(jQuery);