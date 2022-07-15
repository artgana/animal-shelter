<?php

/**
 * Pages
 */
add_action('admin_menu', 'add_options_pages');
function add_options_pages() {
    if (!function_exists('acf_add_options_page')) {
        return;
    }
    acf_add_options_page(array('page_title' => 'Параметри теми'));
    $parent = 'acf-options-parametry-temy';
	acf_add_options_sub_page(array('title' => 'Загальні', 'parent' => $parent, 'menu_slug' => 'overall'));

}