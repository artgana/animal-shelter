<?php
/**
 * Login page styling
 */

function custom_login_url() {
	return home_url();
}
add_filter('login_headerurl', 'custom_login_url');

function custom_login_title() {
	return get_bloginfo('name');
}
add_filter('login_headertext', 'custom_login_title');

function custom_login_logo() {
	$logo = get_field('logo', 'options');
	if($logo) : ?>
		<style>
			.login #login h1 a {
				background-image: url( <?php echo $logo; ?> );
				background-size: 70px auto;
				margin-bottom: 0;
				outline: none;
			}
		</style>
	<?php endif;
}
add_action( 'login_enqueue_scripts', 'custom_login_logo' );

/**
 * Disable Login Language Selector
 */
add_filter( 'login_display_language_dropdown', '__return_false' );
