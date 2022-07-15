<?php

/**
 * Custom post type for animals
 */
register_post_type('animals', array(
		'label' => "animals",
		'description' => '',
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'publicly_queryable'  => true,
		'capability_type' => 'post',
		'map_meta_cap' => true,
		'hierarchical' => false,
		'rewrite' => array('slug' => '', 'with_front' => 1),
		'query_var' => true,
		'has_archive' => false,
		'menu_position' => 4,
		'menu_icon' => 'dashicons-pets',
		'supports' => array('title','editor'),
		'labels' => array (
			'name' => "Притулок тварин",
			'singular_name' => "Тварина",
			'menu_name' => "Тварини",
			'all_items' => "Всі тварини",
			'add_new' => "Додати запис",
			'add_new_item' => "Додати новий запис",
			'edit' => "Редагувати",
			'edit_item' => "Редагувати запис",
			'search_items'       => 'Пошук',
		)
	)
);
