<?php

/**
 * Exit if accessed directly
 */
if(!defined('ABSPATH')){exit;}

/**
 * Constants
 */
//define( 'TEXTDOMAIN', 'wp-theme' );
//define( 'TEXTDOMAINBACK', 'wp-theme-back' );
define( 'THEME_PATH', get_template_directory() );
define( 'CORE_PATH', THEME_PATH . '/core' );
define( 'TEMPLATE_DIRECTORY_URL', get_template_directory_uri() );
define( 'CORE_URL', TEMPLATE_DIRECTORY_URL . '/core' );
define( 'THEME_VERSION', get_option('theme_version') );

/**
 * God, bless ACF! :)
 */
require_once 'acf/init.php';

/**
 * Theme activation
 */
function myactivationfunction($oldname, $oldtheme=false) {
    add_option('theme_version', '0.01');
}
add_action("after_switch_theme", "myactivationfunction", 10 ,  2);

/**
 * Theme deactivation
 */
function mydeactivationfunction($newname, $newtheme) {
    delete_option('theme_version');
}
add_action("switch_theme", "mydeactivationfunction", 10 , 2);

/**
 * Include PHP files
 */
include_once( 'includes/custom-admin-css-js.php' );
include_once( 'includes/custom-dashboard.php' );
include_once( 'includes/custom-front-end.php' );
include_once( 'includes/custom-login-page.php' );
include_once( 'includes/custom-post-types.php' );
include_once( 'includes/custom-taxonomies.php' );
include_once( 'includes/custom-tiny-mce.php' );
include_once( 'includes/system-nav-menus.php' );
include_once( 'includes/system-shortcodes.php' );
include_once( 'includes/system-user-roles.php' );
include_once( 'includes/tools-dev-options-page.php' );
