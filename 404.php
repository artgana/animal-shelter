<?php
get_header();
get_template_part( 'parts/overall', 'header' );
?>


	<div class="page404 container">
		<div class="cont">
			<h1 class="page-title"><?php _e( '404', 'wp-theme' ); ?></h1>
			<h2><?php _e( 'Page not found', 'wp-theme' ); ?></h2>
			<p><?php _e( 'Try return to <a href="/">Home page</a>.', 'wp-theme' ); ?></p>
		</div>
	</div>


<?php
get_template_part( 'parts/overall', 'footer' );
get_footer();