<header class="site-header">

	<?php
	$logo = get_field('logo', 'options');
	?>
	<a class="logo<?php if(!is_front_page()) { echo ' link" href="' . home_url();} ?>">
		<?php if($logo) :
			echo svg_or_img($logo);
		endif; ?>
	</a>

	<nav id="main-menu" class="header-menu">
		<?php $args = array(
			'menu'            => 'Main menu',
			'container'       => '',
			'echo'            => true,
			'items_wrap'      => '<ul>%3$s</ul>',
			'depth'           => 0,
			'menu_class'      => '',
			'fallback_cb'     => '__return_empty_string',
		);
		wp_nav_menu( $args ); ?>
	</nav>

	<a href="#main-menu" class="menu-toggle mobile-show"><span></span></a>

</header>
<div id="mm-page">