jQuery( document ).ready(function() {
		
	// hide all taxonomy-specific fields
	jQuery( ".faculty" ).hide();
	jQuery( ".staff" ).hide();
	jQuery( ".student" ).hide();
	jQuery( ".room" ).hide();
	jQuery( ".lab" ).hide();
	jQuery( ".equipment" ).hide();
	
	// also hide subject_area and interests taxonomy box when student is selected
	jQuery( "#tagsdiv-interest" ).hide();
	jQuery( "#tagsdiv-subject_area" ).hide();
	
	// tax_ids.people_types and tax_ids.facility_types objects are set via wp_localize_script in main plugin file
	//console.log( "People types object: %o", taxids.people_types );
	//console.log( "Facility types object: %o", taxids.facility_types );
	
	// Show correct inputs when an initial value is set
	var people = jQuery( '#people_type input:radio:checked' ).val();
	var peoplegroup = taxids.people_types[people];
	jQuery( "." + peoplegroup ).show();
	if ( peoplegroup == "faculty" ) {
		jQuery( "#tagsdiv-interest" ).show();
		jQuery( "#tagsdiv-subject_area" ).show();
	}
	
	if ( peoplegroup == "student" ) {
		jQuery( "#tagsdiv-department" ).hide();
		jQuery( "#postdivrich" ).hide();
	}
	
	var facility = jQuery( '#facility_type input:radio:checked' ).val();
	var facilitygroup = taxids.facility_types[facility];
	jQuery( "." + facilitygroup ).show();
	
	// toggle people fields' visibility when the taxonomy radio buttons change
	jQuery( "#people_type input:radio" ).change(function(){
		
		people = jQuery( '#people_type input:radio:checked' ).val();
		//console.log( people + " is now checked" );
		peoplegroup = taxids.people_types[people];
		//console.log( "People type is now: " + peoplegroup );
		jQuery( ".faculty" ).hide();
		jQuery( ".staff" ).hide();
		jQuery( ".student" ).hide();
		jQuery( "." + peoplegroup ).show();
		if ( peoplegroup == "faculty" ) {
			jQuery( "#tagsdiv-interest" ).show();
			jQuery( "#tagsdiv-subject_area" ).show();
		}
		else {
			jQuery( "#tagsdiv-interest" ).hide();
			jQuery( "#tagsdiv-subject_area" ).hide();
		}
		// students don't use the bio (main content) field
		if ( peoplegroup == "student" ) {
			jQuery( "#tagsdiv-department" ).hide();
			jQuery( "#postdivrich" ).hide();
		}
		else {
			jQuery( "#postdivrich" ).show();
		}
	});
	
	
	// toggle facility fields' visibility when the taxonomy radio buttons change
	jQuery( "#facility_type input:radio" ).change(function(){
		
		facility = jQuery( '#facility_type input:radio:checked' ).val();
		//console.log( facility + " is now checked" );
		facilitygroup = taxids.facility_types[facility];
		//console.log( "Facility type is now: " + facilitygroup );
		jQuery( ".room" ).hide();
		jQuery( ".lab" ).hide();
		jQuery( ".equipment" ).hide();
		jQuery( "." + facilitygroup ).show();
	})
	
    
});

