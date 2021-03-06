<?php

/**
 * Modify TinyMCE editor to remove H1.
 */
function tiny_mce_remove_unused_formats($init) {
	// Add block format elements you want to show in dropdown
	$init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Pre=pre';
	return $init;
}
add_filter('tiny_mce_before_init', 'tiny_mce_remove_unused_formats' );


/**
 * Remove unneeded buttons
 */
function myplugin_tinymce_buttons( $buttons ) {
	$remove = array( 'wp_more' );

	return array_diff( $buttons, $remove );
}
add_filter( 'mce_buttons', 'myplugin_tinymce_buttons' );

function myplugin_tinymce_buttons2( $buttons ) {
	$remove = array( 'charmap' );

	return array_diff( $buttons, $remove );
}
add_filter( 'mce_buttons_2', 'myplugin_tinymce_buttons2' );
