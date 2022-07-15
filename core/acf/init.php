<?php

/**
 * Show or hide in dashboard
 */
if(!get_option('show_acf_in_dashboard')){
    define( 'ACF_LITE', true );
} else{
    define( 'ACF_LITE', false );
}

/**
 * Acf options pages init
 */
include_once( 'options-pages-menu.php' );

/**
 * Fields init
 */
include_once( 'fields/options-page-overall.php' );

include_once( 'fields/page-home.php' );

include_once( 'fields/post-type-animals.php' );
