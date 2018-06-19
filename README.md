=== Berkeley Content Model ===
Contributors: sillybean
Author: Stephanie Leary
Author URI: http://stephanieleary.com
GitHub Plugin URI: https://github.com/sillybean/berkeley-content-model
Description: Custom post types and taxonomies, plus various helper filters and Dashboard widget.
License: GPL2
Text Domain: beng
Requires at least: 3.1
Tested up to: 4.5
Stable tag: 1.9.5

== Description ==

Creates the custom post types, taxonomies, and Dashboard widget for the Berkeley Engineering sites. 

Features:

* Custom post types:  'people', 'publication', 'facility', 'research', 'course'
* Custom taxonomies: 'people_type', 'organization', 'subject_area', 'facility_type'
* Optional taxonomies: 'committee', 'groups', 'research_areas'
* Dashboard wayfinding widget
* Genesis archive settings for custom post type slugs
* Function to concatenate people's names as post titles on save

Shortcodes:

* 'people' (table/directory)
* 'subcategories' (list/directory)
* 'site-name'

Includes filters for:

* Edit post list columns
* Placeholder text and other inline hints
* Default hidden screen options
* Built-in Dashboard widgets

== Installation ==

1. Upload the plugin directory to `/wp-content/plugins/` 
1. Activate the plugin through the 'Plugins' menu in WordPress

== Changelog ==

= 1.9.5 =
* Adjust globals for PHP 7 compliance.
= 1.9.4 =
* Fix comma in taxonomy file
= 1.9.3 =
* Remove student_type taxonomy; make former student_type default terms children of 'student' people_type
= 1.9.2 =
* Google Maps API key option and filter for Advanced Custom Fields options
= 1.9.1 =
* Remove unnecessary maps file
* Enable REST API support for post types
= 1.9 =
* Escaping and translating function cleanup
* Prefix JS globals
* use admin_enqueue_scripts instead of admin_hook-*
* Remove admin columns used only for migration QA; check post_type before setting orderby
* clean up and consolidate pre_get_posts filters
* Prefix taxonomy functions
* Whitelist post_types/taxonomies and check caps in dashboard widget
= 1.8.8 =
* Dashboard code cleanup
* Argument cleanup in [people] shortcode
* set_option() -> update_option()
* set WPE_GOVERNOR contstant to help SearchWP
= 1.8.7 =
* Updated taxonomy toggle to accept both 'student' and 'students' term slugs
= 1.8.6 =
* Fixed attribute handling in people shortcode
= 1.8.5 =
* New focus/tabindex script; admin-settings -> theme
= 1.8.4 =
* use add_meta_box instead of wp_add_dashboard_widget for better positioning control
= 1.8.3 =
* Change priority of taxonomy meta box removal
* Set default to true for all CPT toggles
= 1.8.2 =
* Removed custom fields from wayfinding widget
* Corrected shortcode $atts
* Updated list of ignored post types in wayfinding widget
= 1.8.1 =
* Updated list of hidden meta boxes
= 1.8 =
* Added taxonomy helper functions
= 1.7.2 =
* Prevent pre_get_posts filter from running on admin screens
* Add Per Page Widget meta box to all custom post types
* Always regenerate people post titles from names
= 1.7.1 =
* updated default screen options
* ACF message field style
* hide tax input meta boxes that are duplicated in ACF fields
= 1.7 =
* Default screen options
* ACF after title field focus script
* ACF featured image display checkbox styles
* SearchWP error fix
= 1.6.1 =
* Added excerpts for pages.
= 1.6 =
* Moved archive settings file in from theme.
* Moved shortcodes in from theme. Added 'type' attribute for people directory.
* Changed Research Interests taxonomy to Subject Areas.
* Changed Departments taxonomy to Organizations.
* Added Student Type taxonomy.
= 1.5 =
* Restored function to concatenate names as post titles for people.
= 1.4 =
* Added Genesis SEO and CPT archive settings support to post types.
* Corrected JS show/hide toggle to correctly show fields when a taxonomy has already been selected.
* Cleaned up PHP notices when optional people taxonomies are not in use.
= 1.3.3 =
* Changed featured image labels for People post type
= 1.3.2 =
* Added JS show/hide toggle for taxonomy-specific People and Facility fields.
= 1.3.1 =
* Added extra taxonomy toggle in General Settings.
= 1.3 =
* Added CPT toggle in General Settings.
= 1.2 =
* Added [people] directory and [subcategories] shortcodes
* Added alphabetical filter for people listings
= 1.1 =
* Added default taxonomy terms
= 1.0 =
* Initial post types and taxonomies
* Filter to concatenate name fields into expert post title
* Dashboard wayfinding widget