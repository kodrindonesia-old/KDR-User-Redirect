<?php
/**
 * User Redirect Admin Function
 *
 * @author  Sandi Andrian <sandi@kodrindonesia.com>
 * @since   May 15, 2016
 **/
 

/**
 * Add options page under settings menu
 **/
add_action( 'admin_menu', 'kdr_user_redirect_admin_menu');
function kdr_user_redirect_admin_menu() 
{
    add_options_page(
        'User Redirect',
        'User Redirect',
        'manage_options',
        'kdr-user-redirect',
        'kdr_user_redirect_options_page'
    );
}

/**
 * Init Options
 **/
add_action('admin_init','kdr_user_redirect_init_options');
function kdr_user_redirect_init_options()
{
	add_settings_section(
		'kdr_user_redirect_settings_groups',
		'',
		'',
		'kdr-user-redirect'
	);
	 
	add_settings_field(
		'kdr_user_redirect_wpadmin',
		'WP Admin Redirect URL',
		'kdr_user_redirect_wp_admin_cb',
		'kdr-user-redirect',
		'kdr_user_redirect_settings_groups'
	);
	register_setting('kdr-user-redirect', 'kdr_user_redirect_wpadmin');
}

function kdr_user_redirect_wp_admin_cb() {
	$setting = esc_attr(get_option('kdr_user_redirect_wpadmin'));
	echo "<input type='text' name='kdr_user_redirect_wpadmin' value='$setting' />";
}

/**
 * KDR User Redirect Options Page
 **/
function kdr_user_redirect_options_page()
{
	?>
    <div class="wrap">
    	<form action="options.php" method="post">
        <h2>User Redirect</h2>
        <?php 
        settings_fields('kdr-user-redirect');
		do_settings_sections('kdr-user-redirect');
        submit_button(); 
        ?>
        </form>
    </div>
    <?php
}