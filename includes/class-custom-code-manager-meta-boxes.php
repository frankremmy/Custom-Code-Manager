<?php

class Custom_Code_Manager_Meta_Boxes {
	/**
	 * Initialize hooks for adding meta boxes
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_custom_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_meta_box_data' ) );
	}

	/*
	 * Add custom meta boxes for the Code Snippets post type
	 */
	public function add_custom_meta_boxes() {
		add_meta_box(
			'ccm_snippets_meta_boxes',
			'Snippet Settings',
			array( $this, 'render_meta_box' ),
			'ccm_code_snippets',
			'side',
			'default'
		);
	}
		/*
		 * Render the meta box content
		 */
	public function render_meta_box( $post ) {
		wp_nonce_field( 'ccm_save_meta_box_data', 'ccm_meta_box_nonce' );

		// Get the current values of the meta fields
		$snippet_type = get_post_meta( $post->ID, 'ccm_snippet_type', true );
		$active_status = get_post_meta( $post->ID, 'ccm_active_status', true );

		// Snippet type dropdown
		echo '<label for="ccm_snippet_type">Snippet Type:</label>';
		echo '<select id="ccm_snippet_type" name="ccm_snippet_type">';
		echo '<option value="php"' . selected( $snippet_type, 'php', false ) . '>PHP</option>';
		echo '<option value="html"' . selected( $snippet_type, 'html', false ) . '>HTML</option>';
		echo '<option value="js"' . selected( $snippet_type, 'js', false ) . '>JavaScript</option>';
		echo '</select>';

		// Active Status Checkbox
		echo '<p><label for="ccm_active_status">';
		echo '<input type="checkbox" id="ccm_active_status" name="ccm_active_status" value="1"' . checked( $active_status, '1', false ) . '>';
		echo ' Active</label></p>';
	}

	/*
	 * Save the meta box data when the post is saved
	 */
	public function save_meta_box_data( $post_id ) {
		if ( ! isset( $_POST['ccm_meta_box_nonce'] ) ) {
			return;
		}

		if ( ! wp_verify_nonce( $_POST['ccm_meta_box_nonce'], 'ccm_save_meta_box_data' ) ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( isset( $_POST['ccm_snippet_type'] ) ) {
			update_post_meta( $post_id, 'ccm_snippet_type', sanitize_text_field( $_POST['ccm_snippet_type'] ) );
		}

		$active_status = isset( $_POST['ccm_active_status'] ) ? 1 : 0;
		update_post_meta( $post_id, 'ccm_active_status', $active_status );
	}
}