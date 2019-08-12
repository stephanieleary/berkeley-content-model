<?php

add_action( 'admin_init', 'berkeley_eng_cpts_setting_api_init' );

function berkeley_eng_cpts_setting_api_init() {
	
	register_setting(
		'general',
		'berkeley_cpts',
		'berkeley_eng_cpts_setting_validate'
	);

	add_settings_field( 
		'berkeley_cpts', 
		esc_html__( 'Enable Content Types' ), 
		'berkeley_eng_cpts_setting_html', 
		'general' 
	);
	
	register_setting(
		'general',
		'berkeley_taxes',
		'berkeley_eng_taxes_setting_validate'
	);

	add_settings_field( 
		'berkeley_taxes', 
		esc_html__( 'Enable Extra Groups for People' ), 
		'berkeley_eng_taxes_setting_html', 
		'general' 
	);
	
	register_setting(
		'general',
		'berkeley_gmaps_api',
		'sanitize_text_field'
	);

	add_settings_field( 
		'berkeley_gmaps_api', 
		esc_html__( 'Google Maps API Key' ), 
		'berkeley_eng_gmaps_api_setting_html', 
		'general' 
	);
	
}

function berkeley_eng_cpts_setting_validate( $settings ) {
	
	$allcpts = array( 
		'course', 
		'research', 
		'facility', 
		'publication', 
		'people',
	);
	$newsettings = array();
	
	foreach ( $settings as $setting => $value ) {
		if ( in_array( $setting, $allcpts ) )
			$newsettings[$setting] = 1;
	}
	
	return $newsettings;
}

function berkeley_eng_taxes_setting_validate( $settings ) {
	
	$taxes = array( 
		'committee', 
		'groups', 
		'subject_area', 
	);
	$newsettings = array();
	
	foreach ( $settings as $setting => $value ) {
		if ( in_array( $setting, $taxes ) )
			$newsettings[$setting] = 1;
	}
	
	return $newsettings;
}

/**
 * HTML code to display a checkbox true/false option
 * for the CPT setting.
 *
 * @return html
 */
function berkeley_eng_cpts_setting_html() { 
	
	$cpts = get_option( 'berkeley_cpts' );

	$allcpts = array( 
		'course' 		=> 'Courses', 
		'research' 		=> 'Research', 
		'facility' 		=> 'Facilities', 
		'publication' 	=> 'Publications', 
		'people' 		=> 'People',
	);
	
	foreach ( $allcpts as $type => $label ) {
		
		printf( '<label for="berkeley_cpts[%1$s]">
		<input name="berkeley_cpts[%1$s]" id="berkeley_cpts[%1$s]" %2$s type="checkbox" value="1" /> %3$s</label><br />', $type, checked( $cpts[$type], '1', false ), $label );
	}
	
}


function berkeley_eng_taxes_setting_html() { 
	
	$taxes = get_option( 'berkeley_taxes' );

	$alltaxes = array( 
		'committee' 	 => 'Committees', 
		'research-areas' => 'Research Areas', 
		'groups' 		 => 'Groups', 
	);
	
	foreach ( $alltaxes as $type => $label ) {
		
		printf( '<label for="berkeley_taxes[%1$s]">
		<input name="berkeley_taxes[%1$s]" id="berkeley_taxes[%1$s]" %2$s type="checkbox" value="1" /> %3$s</label><br />', $type, checked( $taxes[$type], '1', false ), $label );
	}
	
}

function berkeley_eng_gmaps_api_setting_html() {
	
	$key = get_option( 'berkeley_gmaps_api' );
	
	printf( '<input name="berkeley_gmaps_api" id="berkeley_gmaps_api" value="%s" />', esc_attr( $key ) );
}