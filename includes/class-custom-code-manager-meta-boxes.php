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
			'ccm_snippet_meta_box',
			'Code Editor',
			array( $this, 'render_main_code_editor' ),
			'ccm_code_snippets',
			'normal', // Set to 'normal' to make it appear in the main area.
			'high'
		);
	}
		/*
		 * Render the meta box content
		 */

	/**
	 * Render the main code editor in the content area.
	 */
	public function render_main_code_editor( $post ) {
		// Add a nonce for security
		wp_nonce_field( 'ccm_save_meta_box_data', 'ccm_meta_box_nonce' );

		// Get the current content of the code snippet
		$snippet_content = get_post_meta( $post->ID, '_ccm_snippet_content', true );

		// Enqueue the CodeMirror scripts and styles
		wp_enqueue_code_editor( array( 'type' => 'text/html' ) );
		wp_enqueue_script( 'wp-theme-plugin-editor' );
		wp_enqueue_style( 'wp-codemirror' );

		// Output the custom code editor
		echo '<div style="margin-top: 10px;">';
		echo '<label for="ccm_snippet_content">Code Snippet:</label>';
		echo '<textarea id="ccm_snippet_content" name="ccm_snippet_content" rows="20" style="width: 100%;">' . esc_textarea( $snippet_content ) . '</textarea>';
		echo '</div>';

		// Initialize CodeMirror for syntax highlighting
		echo '<script>jQuery( function() { wp.codeEditor.initialize( "ccm_snippet_content", {} ); } );</script>';
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

		if ( isset( $_POST['ccm_snippet_content'] ) ) {
			update_post_meta( $post_id, '_ccm_snippet_content', $_POST['ccm_snippet_content'] );
		}

		$active_status = isset( $_POST['ccm_active_status'] ) ? 1 : 0;
		update_post_meta( $post_id, 'ccm_active_status', $active_status );
	}
}