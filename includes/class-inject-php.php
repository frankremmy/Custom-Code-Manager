<?php

class Custom_Code_Manager_Inject_PHP {
	/*
	 * Constructor to setup the hooks
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'inject_php_code' ) );
	}

	/*
	 * Inject PHP code snippet
	 */
	public function inject_php_code() {
		$php_code = get_option( 'ccm_php_code' );

		if ( ! empty( $php_code ) ) {
			try {
				eval( $php_code );
			} catch ( Exception $e ) {
				// Handle any errors in a secure way, like logging
				error_log( 'Custom Code Manager Error: ' . $e->getMessage() );
			}
		}
	}
}