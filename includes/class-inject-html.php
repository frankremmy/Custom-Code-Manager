<?php

class Custom_Code_Manager_Inject_HTML {
	/*
	 * Constructor to setup hooks
	 */
	public function __construct() {
		add_action( 'wp_head', array( $this, 'inject_html_code' ) );
	}

	/*
	 * Inject the HTML code into the head tag
	 */
	public function inject_html_code() {
		$html_code = get_option( 'ccm_html_code' );

		if ( empty( $html_code ) ) {
			echo $html_code;
		}
	}
}