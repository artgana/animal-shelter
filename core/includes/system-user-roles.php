<?php

/**
 * Get current user role
 */
function get_current_user_role() {
	if ( is_user_logged_in() ) {
		$user = wp_get_current_user();
		$role = ( array ) $user->roles;

		return $role[0];
	} else {
		return false;
	}
}

/**
 * Remove unneeded fields from user profile
 */
function custom_modified_fields( $contact_methods ) {

	unset($contact_methods['facebook']);
	unset($contact_methods['instagram']);
	unset($contact_methods['linkedin']);
	unset($contact_methods['myspace']);
	unset($contact_methods['pinterest']);
	unset($contact_methods['soundcloud']);
	unset($contact_methods['tumblr']);
	unset($contact_methods['twitter']);
	unset($contact_methods['youtube']);
	unset($contact_methods['wikipedia']);

	return $contact_methods;
}
add_filter('user_contactmethods', 'custom_modified_fields');
