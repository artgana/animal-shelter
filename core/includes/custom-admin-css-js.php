<?php

add_action('admin_head', 'custom_admin_css_js');

function custom_admin_css_js() {
	echo '<style>
     .user-comment-shortcuts-wrap,
     .user-syntax-highlighting-wrap,
     .user-rich-editing-wrap,
     .user-url-wrap,
     .yoast_premium_upsell,
     .njt-wrap-postbox,
     #filebird_cross,
     #njt-ads-wrapper,
     #sidebar-container.wpseo_content_cell {
      display: none;
    }
    </style>';
	echo '<script>
        jQuery(document).ready(function() {
            jQuery( "h2:contains(\'About Yourself\')").next().hide();
            jQuery( "h2:contains(\'About Yourself\')").hide();
                        
            jQuery( "h2:contains(\'About the user\')").next().hide();
            jQuery( "h2:contains(\'About the user\')").hide();
            jQuery( ".njt-wrap-postbox").parent().parent().hide();
        });
    </script>';
}
