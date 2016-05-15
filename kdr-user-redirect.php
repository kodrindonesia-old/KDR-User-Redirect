<?php
/**
 * Plugin Name: User Redirect
 * Plugin URI: https://www.kodrindonesia.com
 * Description: Manage user redirect login & register and allows you to disable access to admin dashboard
 * Version: 1.0.0
 * Author: Kodr Indonesia
 * Author URI: https://www.kodrindonesia.com
 * License: GPL2
 */

include "kdr-user-redirect-admin.php";

/**
 * Handle WP-Admin Redirection
 **/
add_action('init','kdr_wp_admin_redirect');
function kdr_wp_admin_redirect() 
{
	global $pagenow;
	if('wp-login.php' == $pagenow) {
		//get options
		$wpadmin_redirect = esc_attr(get_option('kdr_user_redirect_wpadmin'));
		if(!empty($wpadmin_redirect)) {
			wp_redirect($wpadmin_redirect);
			exit();
		}
	}
}

/**
 * After users login redirect
 **/
add_filter('login_redirect', 'kdr_login_redirect', 10, 3);
function kdr_login_redirect( $url, $request, $user )
{
    if($user && is_object( $user ) && is_a($user, 'WP_User' )) {
        if($user->has_cap('administrator')) {
            $url = admin_url();
        } else {
            $url = home_url('/members-only/');
        }
    }
    return $url;
}