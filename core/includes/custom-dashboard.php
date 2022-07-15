<?php

/**
 * Add title tag to wp-head
 */
add_theme_support('title-tag');

/**
 * Add html5 tags support
 */
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );

/**
 * Enable thumbnails
 */
add_theme_support( 'post-thumbnails', array( 'animals' ) );

/**
 * Thumbnails in dashboard area
 */
if ( !function_exists('AddThumbColumn') && function_exists('add_theme_support') ) {
    function AddThumbColumn($cols) {
        $cols['thumbnail'] = __('Мініатюра', 'wp-theme-back');
        return $cols;
    }
    function AddThumbValue($column_name, $post_id) {
        $width = (int) 60;
        $height = (int) 60;
        if ( 'thumbnail' == $column_name ) {
            // thumbnail of WP 2.9
            $thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
            // image from gallery
            $attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
            if ($thumbnail_id)
                $thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
            elseif ($attachments) {
                foreach ( $attachments as $attachment_id => $attachment ) {
                    $thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
                }
            } else {
				$thumb = get_field('photo', $post_id);
	            $thumb = wp_get_attachment_image( $thumb['ID'], array($width, $height), true );
            }
            if ( isset($thumb) && $thumb ) {
                echo $thumb;
            } else {
                echo __('None', 'wp-theme-back');
            }
        }
    }
    // for posts
    add_filter( 'manage_posts_columns', 'AddThumbColumn' );
    add_action( 'manage_posts_custom_column', 'AddThumbValue', 10, 2 );
}

/**
 * Hide default widgets
 ****************************************************/
function remove_dashboard_widgets() {
    global $wp_meta_boxes;
//    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
//    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );

/**
 * Hide top menu
 ****************************************************/
function sl_dashboard_tweaks_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('new-content');
    $wp_admin_bar->remove_menu('about');
    $wp_admin_bar->remove_menu('wporg');
    $wp_admin_bar->remove_menu('documentation');
    $wp_admin_bar->remove_menu('support-forums');
    $wp_admin_bar->remove_menu('feedback');
    $wp_admin_bar->remove_menu('view-site');
    $wp_admin_bar->remove_menu('comments'); // optional, delete comments as many websites don't even have those enabled.
}
add_action( 'wp_before_admin_bar_render', 'sl_dashboard_tweaks_render' );

/**
 * Hide some dashboard pages
 */
function remove_menus() {
//    remove_menu_page( 'tools.php' );                  //Tools
    remove_submenu_page('tools.php', 'tools.php');
//    remove_menu_page( 'index.php' );                  //Dashboard
    remove_menu_page( 'edit.php' );                   //Posts
//    remove_menu_page( 'upload.php' );                 //Media
//    remove_menu_page( 'edit.php?post_type=page' );    //Pages
//    remove_menu_page( 'edit-comments.php' );          //Comments
//    remove_menu_page( 'themes.php' );                 //Appearance
//    remove_menu_page( 'plugins.php' );                //Plugins
//    remove_menu_page( 'users.php' );                  //Users
//    remove_menu_page( 'options-general.php' );        //Settings
}
add_action( 'admin_menu', 'remove_menus' );

/**
 * Remove +New post in top Admin Menu Bar
 */
function remove_default_post_type_menu_bar( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'new-post' );
}
add_action( 'admin_bar_menu', 'remove_default_post_type_menu_bar', 999 );

/**
 * Hide welcome screen
 ****************************************************/
add_action('load-index.php', 'hide_welcome_message_panel');
function hide_welcome_message_panel() {
    $user_id = get_current_user_id();
    update_user_meta( $user_id, 'show_welcome_panel', 0 );
}
function my_custom_admin_head_welcome_hide() {
    echo '<style>[for="wp_welcome_panel-hide"] {display: none !important;}</style>';
}
add_action('admin_head', 'my_custom_admin_head_welcome_hide');

/**
 * Hide help tab
 ****************************************************/
add_action('admin_head', 'mytheme_remove_help_tabs');
function mytheme_remove_help_tabs() {
	$screen = get_current_screen();
	$screen->remove_help_tabs();
}

/**
 * Footer copyright
 ****************************************************/
add_filter('admin_footer_text', 'remove_footer_admin');
function remove_footer_admin () {
    ?>Demo site made by <a href="mailto:artgana@gmail.com" target="_blank" rel="noreferrer noopener">Igor Gana</a> special for saphira.agency<?php
}
function replace_footer_version() {
    return __('Powered by', 'wp-theme-back').' <a target="_blank" rel="noreferrer noopener" href="https://wordpress.org/">WordPress</a>';
}
add_filter( 'update_footer', 'replace_footer_version', '1234');

/**
 * Custom editor styles
 */
function my_theme_add_editor_styles() {
    add_editor_style( TEMPLATE_DIRECTORY_URL . '/assets/css/editor.min.css?ver=' . THEME_VERSION );
}
add_action( 'after_setup_theme', 'my_theme_add_editor_styles' );

/**
 * Disable autosave
 */
function disableAutoSave() {
    wp_deregister_script('autosave');
}
add_action( 'admin_init', 'disableAutoSave' );

/**
 * Hide admin top bar on front-end
 */
if(get_option('hide_admin_top_bar')) {
    add_action( 'admin_print_styles-profile.php', 'global_profile_hide_admin_bar' );
    add_action( 'admin_print_styles-user-edit.php', 'global_profile_hide_admin_bar' );
    function global_profile_hide_admin_bar() {
        echo '<style>.show-admin-bar { display: none !important; }</style>';
        return;
    }
    add_filter( 'show_admin_bar', '__return_false' );
}

/**
 * Allow svg upload
 */
add_filter('upload_mimes', 'custom_upload_mimes');
function custom_upload_mimes ( $existing_mimes ) {
    // add the file extension to the array
    $existing_mimes['svg'] = 'image/svg+xml';
    // call the modified list of extensions
    return $existing_mimes;
}

/**
 * Hide metaboxes
 */
//add_action( 'add_meta_boxes', 'remove_meta_boxes', 100);
//function remove_meta_boxes() {
//	remove_meta_box( 'categorydiv', 'post', 'side' ); // Category meta box
//	remove_meta_box( 'tagsdiv-post_tag', 'post', 'side' ); // Posts tag
//}

/**
 * Remove Categories & Tags From Admin Menu
 */
//add_action('admin_menu', 'remove_sub_menus');
//function remove_sub_menus() {
//	remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category');
//	remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
//}

/**
 * Remove Categories and Tags from Admin Dashboard
 */
//function my_manage_columns( $columns ) {
//	unset($columns['categories'], $columns['tags']);
//	return $columns;
//}
//function my_column_init() {
//	add_filter( 'manage_posts_columns' , 'my_manage_columns' );
//}
//add_action( 'admin_init' , 'my_column_init' );

/**
 * Remove color scheme
 */
remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

/**
 * Remove <p> Tag From Contact Form 7
 */
add_filter('wpcf7_autop_or_not', '__return_false');

/**
 * Move Yoast to bottom
 */
function yoasttobottom() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');
