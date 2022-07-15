<?php
/**
 * Custom js
 */
function load_personal_resources() {
//    wp_enqueue_script('jquery');

    $theme_uri = get_template_directory_uri();

    wp_register_script('plugins', $theme_uri.'/assets/js/plugins.min.js', '', THEME_VERSION, true);
    wp_enqueue_script('plugins');
    wp_register_script('custom', $theme_uri.'/assets/js/custom.min.js', '', THEME_VERSION, true);
    wp_enqueue_script('custom');
}
add_action('wp_enqueue_scripts', 'load_personal_resources');

/**
 * Move jQuery to the footer.
 */
function wpse_enqueue_scripts() {
    wp_scripts()->add_data( 'jquery', 'group', 1 );
    wp_scripts()->add_data( 'jquery-core', 'group', 1 );
    wp_scripts()->add_data( 'jquery-migrate', 'group', 1 );
}
add_action( 'wp_enqueue_scripts', 'wpse_enqueue_scripts' );

/**
 * Deregister jQuery migrate
 */
function remove_jquery_migrate( $scripts ) {
    if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
        $script = $scripts->registered['jquery'];
        if ( $script->deps ) {
            $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
        }
    }
}
add_action( 'wp_default_scripts', 'remove_jquery_migrate' );

/**
 * Disable gutenberg block styles
 * since WordPress 5.9
 */
function wps_deregister_library() {
    wp_dequeue_style( 'wp-block-library' );
}
add_action( 'wp_print_styles', 'wps_deregister_library', 100 );

/**
 * Disable Gutenberg inline styles in header
 */
function wps_deregister_styles() {
    wp_dequeue_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'wps_deregister_styles', 100 );

/**
 * Clean other CSS and JS on header
 */
if (!is_admin()) {
    function my_init_method() {
        wp_deregister_script( 'l10n' );
    }
    add_action('init', 'my_init_method');
}

/**
 * Remove head junk
 */
add_action('init', 'remheadlink');
function remheadlink() {
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
	remove_action( 'wp_head', 'wp_resource_hints', 2);
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
	remove_action( 'wp_head', 'rel_canonical');

	/*
	 * Remove rest api
	 */
	remove_action( 'wp_head', 'rest_output_link_wp_head' );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
}

/**
 * Disable the emoji's
 */
if(get_option('disable_emoji')) {
    function disable_emojis() {
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
    }
    add_action( 'init', 'disable_emojis' );

    /**
     * Filter function used to remove the tinymce emoji plugin.
     *
     * @param    array  $plugins
     * @return   array             Difference between the two arrays
     */
    function disable_emojis_tinymce( $plugins ) {
        if ( is_array( $plugins ) ) {
            return array_diff( $plugins, array( 'wpemoji' ) );
        } else {
            return array();
        }
    }
}

/**
 * Header + footer
 */
function frontend_custom_header() {
    if (get_option('frontend_custom_header') != false) {
        echo get_option('frontend_custom_header') . "\n";
    }
}
add_filter('wp_head', 'frontend_custom_header');

function frontend_custom_footer() {
    if (get_option('frontend_custom_footer') != false) {
        echo get_option('frontend_custom_footer') . "\n";
    }
}
add_action('wp_footer', 'frontend_custom_footer',99);

/**
 * Text tags
 */
function process_text_tags($input) {
    $input = str_replace('[b]', '<b>', $input);
    $input = str_replace('[/b]', '</b>', $input);
    $input = str_replace('[i]', '<i>', $input);
    $input = str_replace('[/i]', '</i>', $input);
    $input = str_replace('[p]', '<span>', $input);
    $input = str_replace('[/p]', '</span>', $input);
    $input = str_replace('[nl]', '<br/>', $input);
    return $input;
}

/**
 * Check whether image is jpg/png or svg
 */
function svg_or_img($image) {
    if ( strpos( $image, '.svg' ) !== false ) {
        $image = str_replace( site_url(), '', $image);
        return file_get_contents(ABSPATH . $image);
    } else {
        return '<img src="' . $image . '" alt="image">';
    }
}

/**
 * Bg img to bg css
 */
function url_to_bg( $img_url ) {
	$bannerstyle = "";
	if ( ! empty( $img_url ) ) {
		$bannerstyle = sprintf(" style=\"background-image:url('%s'); \" ",$img_url);
	}
	return $bannerstyle;
}

/**
 * Clean phone number
 */
function clean_phone($number) {
	return str_replace(array(' ', '(', ')', '-'), '', $number);
}
