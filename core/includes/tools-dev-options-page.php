<?php

/**
 * Config page for admins
 */
function add_some_config_page() {
    add_submenu_page('options-general.php', __('Additional developer features', 'wp-theme-back'), __('Developer', 'wp-theme-back'), 'activate_plugins', 'dev', 'developer_config_page');
}
add_action('admin_menu', 'add_some_config_page');
function developer_config_page() {
    /**
     * Additional scripts
     */
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-tabs');
    /**
     * Save  options
     */
    if($_GET['settings-updated'] == true) {
        update_option('show_acf_in_dashboard', stripslashes($_POST['show_acf_in_dashboard']));
        update_option('disable_emoji', stripslashes($_POST['disable_emoji']));
        update_option('frontend_custom_header', stripslashes($_POST['frontend_custom_header']));
        update_option('frontend_custom_footer', stripslashes($_POST['frontend_custom_footer']));
        update_option('hide_admin_top_bar', stripslashes($_POST['hide_admin_top_bar']));
    }
    ?>
    <div class="wrap">
        <h2><?php _e('Additional developer features', 'wp-theme-back'); ?></h2>
        <?php if($_GET['settings-updated'] == true) { ?>
            <div id="setting-error-settings_updated" class="updated"><p><strong><?php _e('Changes have been saved', 'wp-theme-back'); ?></strong></p></div>
        <?php } ?>
        <style>
            .dev-options-tabs .ui-tabs-nav{
                padding: 0 10px 0;
                position: relative;
                display: block;
                margin-bottom: 0;
            }
            .dev-options-tabs .ui-tabs-nav li{
                display: inline-block;
                padding: 0;
                margin: 0;
            }
            .dev-options-tabs .ui-tabs-nav li a{
                display: block;
                text-decoration: none;
                padding: 10px 14px;
                color: rgb(0, 0, 0);
                font-size: 14px;
                box-shadow: none !important;
                border: solid 1px rgb(218, 218, 218);
                background-color: rgb(218, 218, 218);
                border-bottom: none;
                -webkit-border-top-left-radius: 2px;
                -webkit-border-top-right-radius: 2px;
                -moz-border-radius-topleft: 2px;
                -moz-border-radius-topright: 2px;
                border-top-left-radius: 2px;
                border-top-right-radius: 2px;
                transition: all .2s;
            }
            .dev-options-tabs .ui-tabs-nav li a:hover{
                border: solid 1px rgb(210, 210, 210);
                background-color: rgb(210, 210, 210);
                border-bottom: none;
            }
            .dev-options-tabs .ui-tabs-nav li.ui-state-active a{
                color: rgb(241, 241, 241);
                border-color: rgb(0, 115, 170);
                background-color: rgb(0, 115, 170);
            }
            .dev-options-tabs .ui-tabs-panel{
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
                box-sizing: border-box;
                padding: 8px 10px 16px 22px;
                -webkit-border-radius: 2px;
                -moz-border-radius: 2px;
                border-radius: 2px;
                max-width: 800px;
                border: solid 1px rgb(241, 241, 241);
            }
            .form-table th {
                padding: 15px 10px 20px 0;
            }
            .form-table td {
                line-height: 24px;
            }
        </style>
        <script type="text/javascript">
            (function ($) {
                $(document).ready(function () {
                    $( "#tabs" ).tabs({
                        collapsible: false
                    });
                });
            })(jQuery);
        </script>
        <form method="post" action="?page=dev&settings-updated=true">
        <div id="tabs" class="dev-options-tabs">
            <ul>
				<li><a href="#tabs-1"><?php _e("Front-end", 'wp-theme-back'); ?></a></li>
				<li><a href="#tabs-2"><?php _e("Back-end", 'wp-theme-back'); ?></a></li>
            </ul>
            <div id="tabs-1">
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label for="hide_admin_top_bar"><?php _e("Hide admin top bar", 'wp-theme-back'); ?></label></th>
                            <td>
                                <input type="checkbox" value="1" name="hide_admin_top_bar" id="hide_admin_top_bar"<?php if(get_option('hide_admin_top_bar')){ echo " checked='checked'"; } ?>/>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="disable_emoji"><?php _e("Disable Emoji", 'wp-theme-back'); ?></label></th>
                            <td>
                                <input type="checkbox" value="1" name="disable_emoji" id="disable_emoji"<?php if(get_option('disable_emoji')){ echo " checked='checked'"; } ?>/>
                                <?php _e("Disable Emoji (WordPress 4.2)", 'wp-theme-back'); ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="frontend_custom_header"><?php _e("Header custom code", 'wp-theme-back'); ?></label></th>
                            <td><textarea style="resize: vertical" name="frontend_custom_header" id="frontend_custom_header" rows="8" class="large-text"><?php echo get_option('frontend_custom_header'); ?></textarea></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="frontend_custom_footer"><?php _e("Footer custom code", 'wp-theme-back'); ?></label></th>
                            <td><textarea style="resize: vertical"  name="frontend_custom_footer" id="frontend_custom_footer" rows="8" class="large-text"><?php echo get_option('frontend_custom_footer'); ?></textarea></td>
                        </tr>
                    </tbody>
                </table>
            </div>
			<div id="tabs-2">
				<table class="form-table">
					<tbody>
					<tr>
						<th scope="row"><label for="show_acf_in_dashboard"><?php _e("Show ACF in dashboard", 'wp-theme-back'); ?></label></th>
						<td>
							<input type="checkbox" value="1" name="show_acf_in_dashboard" id="show_acf_in_dashboard"<?php if(get_option('show_acf_in_dashboard')){ echo " checked='checked'"; } ?>/>
					        <?php _e("God, bless Advanced Custom Fields!", 'wp-theme-back'); ?>
						</td>
					</tr>
					</tbody>
				</table>
			</div>
        </div>
        <p class="submit"><input type="submit" value="<?php _e("Save", 'wp-theme-back'); ?>" class="button-primary" /></p>
        </form>
    </div>
    <?php
}
