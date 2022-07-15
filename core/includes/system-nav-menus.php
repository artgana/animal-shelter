<?php

/**
 * wp nav menus
 * register_nav_menus( array( 'main_header'=>'main_header' ) );
 * register_nav_menus( array( 'top_header_line_menu'=>'top_header_line_menu' ) );
 */
register_nav_menus();

/**
 * Clean menu classes
 */
add_filter('nav_menu_item_id', '__return_false');
