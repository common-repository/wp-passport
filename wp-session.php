<?php
/*
Plugin Name: WP Passport
Plugin URI: todo
Description: Places user information in the global session for use in other applications on the same domain.
Author: Alton Crossley
Version: 0.2.1
Author URI: http://www.nogahidebootstrap.com
License: Free to use non-commercially.
Warranties: None.

*/

function wp_session_admin_actions() {
	add_options_page ( "WP Passport", "WP Passport", 1, "wp-passport-settings", "wp_passport_admin" );
}

function wp_passport_admin(){
if (!session_id())
    {
        @session_start();
    }
    print "<h3>WP Passport</h3><div>";
    print "The purpose of WP Passport is to expose the Wordpress user via PHP session for use in external code with access to the session.";
    print " As you can see, user information is placed in 'wp-user' namespace in the session.";
    print "</div><hr />";
	print sprintf('<div %2$s><pre>$_SESSION = %1$s</pre></div>', htmlentities(print_r($_SESSION, true)), 'wp-passport-stylin');
}

add_action ( 'admin_menu', 'wp_session_admin_actions' );

if ( !function_exists('wp_authenticate') ) :
/**
 * Checks a user's login information and logs them in if it checks out.
 *
 * @since 2.5.0
 *
 * @param string $username User's username
 * @param string $password User's password
 * @return WP_Error|WP_User WP_User object if login successful, otherwise WP_Error object.
 */
function wp_authenticate($username, $password) {

	$username = sanitize_user($username);
	$password = trim($password);

	$user = apply_filters('authenticate', null, $username, $password);

	if ( $user == null ) {
		// TODO what should the error message be? (Or would these even happen?)
		// Only needed if all authentication handlers fail to return anything.
		$user = new WP_Error('authentication_failed', __('<strong>ERROR</strong>: Invalid username or incorrect password.'));
	}

	$ignore_codes = array('empty_username', 'empty_password');

	if (is_wp_error($user) && !in_array($user->get_error_code(), $ignore_codes) ) {
		do_action('wp_login_failed', $username);
	}
	
	// --- Custom stuff here ---
	// start the session if it is not already
    if (!session_id())
    {
        session_start();
    }
    
    // get the user
    $user_array = (array)$user;
    // trim out redundancy 
    unset($user_array['data']);
    // save it in the session
	$_SESSION['wp-user'] = array_change_key_case($user_array, CASE_LOWER);
	
	return $user;
}
endif;