<?php

class Custom_Code_Manager_Inject_JS {
	/*
	 * Constructor to setup hooks
	 */
	public function __construct() {
		add_action( 'wp_footer', array( $this, 'inject_js_code' ) );
	}

	/*
	 * Inject the JavaScript code snippet into the footer
	 */
	public function inject_js_code() {
		$js_code = get_option( 'ccm_js_code' );

		if ( ! empty( $js_code ) ) {
			echo '<script type="text/javascript">' . $js_code . '</script>';
		}
	}
}