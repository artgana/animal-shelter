<?php

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array (
        'id' => 'acf_overall',
        'title' => 'Хедер',
        'fields' => array (
			array (
				'key' => 'field_5685498c824ef',
				'label' => 'Лого',
				'name' => 'logo',
				'type' => 'image',
				'column_width' => '',
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
        ),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'overall',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'active' => 1,
    ));

    acf_add_local_field_group(array (
        'key' => 'group_58ea51123d11',
        'title' => 'Fav icons',
        'fields' => array (
            array (
                'key' => 'field_56854953423413423423',
                'label' => '',
                'name' => 'fav_icons',
				'type' => 'group',
				'required' => 0,
				'conditional_logic' => 0,
				'layout' => 'table',
                'sub_fields' => array (
                    array (
                        'key' => 'field_569e3fd36a4cd',
                        'label' => 'Apple touch icon',
                        'name' => 'apple_touch_icon',
                        'type' => 'image',
                        'instructions' => '180x180px',
                        'save_format' => 'url',
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                    ),
                    array (
                        'key' => 'field_569e40df6a4ce',
                        'label' => 'Fav icon png',
                        'name' => 'fav_icon_png',
                        'type' => 'image',
                        'instructions' => '192x192px',
                        'save_format' => 'url',
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                    ),
                ),
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'overall',
                ),
            ),
        ),
        'menu_order' => 2,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => 1,
    ));

    acf_add_local_field_group(array (
        'key' => 'group_58ea51afda217',
        'title' => 'Підвал',
        'fields' => array (
	        array(
		        'key' => 'field_62cc8ee1e4487',
		        'label' => 'Текст',
		        'name' => 'copy',
		        'type' => 'textarea',
		        'required' => 0,
		        'conditional_logic' => 0,
		        'rows' => 4,
		        'new_lines' => 'wpautop',
	        ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'overall',
                ),
            ),
        ),
        'menu_order' => 3,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => 1,
    ));

endif;
