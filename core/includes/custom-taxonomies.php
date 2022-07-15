<?php

/**
 * Custom taxonomies
 */
$labels = array(
	'name'              => _x( 'Тип тварин', 'taxonomy general name' ),
	'singular_name'     => _x( 'Тип тварин', 'taxonomy singular name' ),
	'search_items'      => __( 'Пошук типів' ),
	'all_items'         => __( 'Всі типи' ),
	'edit_item'         => __( 'Редагувати тип' ),
	'add_new_item'      => __( 'Додати новий тип' ),
	'menu_name'         => __( 'Тип тварин' ),
);
$args   = array(
	'hierarchical'      => true,
	'labels'            => $labels,
	'show_ui'           => true,
	'show_admin_column' => true,
	'query_var'         => true,
	'rewrite'           => [ 'slug' => 'types' ],
);
register_taxonomy( 'types', [ 'animals' ], $args );


/**
 * Use radio inputs instead of checkboxes for term checklists in specified taxonomies.
 *
 * @param   array   $args
 * @return  array
 */
function term_radio_checklist( $args ) {
	if ( ! empty( $args['taxonomy'] ) && $args['taxonomy'] === 'types') {
		if ( empty( $args['walker'] ) || is_a( $args['walker'], 'Walker' ) ) {
			if ( ! class_exists( 'Walker_Category_Radio_Checklist' ) ) {
				/**
				 * Custom walker for switching checkbox inputs to radio.
				 *
				 * @see Walker_Category_Checklist
				 */
				class Walker_Category_Radio_Checklist extends Walker_Category_Checklist {
					function walk( $elements, $max_depth, ...$args ) {
						$output = parent::walk( $elements, $max_depth, ...$args );
						$output = str_replace(
							array( 'type="checkbox"', "type='checkbox'" ),
							array( 'type="radio"', "type='radio'" ),
							$output
						);

						return $output;
					}
				}
			}

			$args['walker'] = new Walker_Category_Radio_Checklist;
		}
	}

	return $args;
}

add_filter( 'wp_terms_checklist_args', 'term_radio_checklist' );
