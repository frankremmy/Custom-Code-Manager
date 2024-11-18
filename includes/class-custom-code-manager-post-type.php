<?php

class Custom_Code_Manager_Post_Type {
	/**
	 * Initialize hooks for registering the custom post type.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_code_snippets_post_type' ) );
	}

	/*
	 * Register the CPT
	 */
	public function register_code_snippets_post_type() {
		$labels = array(
			'name' => 'Code Snippets',
			'singular_name' => 'Code Snippet',
			'menu_name' => 'Code Snippets',
			'name_admin_bar' => 'Code Snippet',
			'add_new' => 'Add New',
			'add_new_item' => 'Add New',
			'new_item' => 'New Code Snippet',
			'edit_item' => 'Edit Code Snippet',
			'view_item' => 'View Code Snippet',
			'all_items' => 'All Code Snippets',
			'search_items' => 'Search Code Snippets',
			'not_found' => 'No code snippets found.',
			'not_found_in_trash' => 'No code snippets found in Trash.',
		);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'has_archive' => true,
			'menu_icon' => 'dashicons-editor-code',
			'supports' => array( 'title', 'editor', 'author' ),
			'show_in_rest' => true,
		);
		register_post_type( 'ccm_code_snippets', $args );
	}
}