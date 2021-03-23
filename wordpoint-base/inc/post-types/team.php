<?php
/**
 * Team post type.
 *
 * @package wordpoint-base
 */

add_action( 'init', 'wordpoint_base_post_type_team' );

/**
 * Register Team post type.
 */
function wordpoint_base_post_type_team() {
	$labels = [
		'name'               => _x( 'Team Members', 'post type general name', 'wordpoint-base' ),
		'singular_name'      => _x( 'Team Member', 'post type singular name', 'wordpoint-base' ),
		'menu_name'          => _x( 'Team', 'admin menu', 'wordpoint-base' ),
		'name_admin_bar'     => _x( 'Team Member', 'add new on admin bar', 'wordpoint-base' ),
		'add_new'            => _x( 'Add New', 'location', 'wordpoint-base' ),
		'add_new_item'       => __( 'Add New Team Member', 'wordpoint-base' ),
		'new_item'           => __( 'New Team Member', 'wordpoint-base' ),
		'edit_item'          => __( 'Edit Team Member', 'wordpoint-base' ),
		'view_item'          => __( 'View Team Member', 'wordpoint-base' ),
		'all_items'          => __( 'All Team Members', 'wordpoint-base' ),
		'search_items'       => __( 'Search Team Members', 'wordpoint-base' ),
		'parent_item_colon'  => __( 'Parent Team Members:', 'wordpoint-base' ),
		'not_found'          => __( 'No Team Members found.', 'wordpoint-base' ),
		'not_found_in_trash' => __( 'No Team Members found in Trash.', 'wordpoint-base' ),
	];

	$args = [
		'labels'             => $labels,
		'description'        => __( 'Description.', 'wordpoint-base' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'rewrite'            => [
			'slug'       => 'team-member',
			'with_front' => false,
		],
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => [ 'title', 'editor', 'thumbnail' ],
		'menu_icon'          => 'dashicons-groups',
	];

	register_post_type( 'team', $args );
}
