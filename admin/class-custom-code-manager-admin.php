<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://frankremmy.com
 * @since      1.0.0
 *
 * @package    Custom_Code_Manager
 * @subpackage Custom_Code_Manager/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Custom_Code_Manager
 * @subpackage Custom_Code_Manager/admin
 * @author     Frank Remmy <ugochukwufrankremmy@outlook.com>
 */
class Custom_Code_Manager_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $custom_code_manager    The ID of this plugin.
	 */
	private $custom_code_manager;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $custom_code_manager       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $custom_code_manager, $version ) {

		$this->plugin_name = $custom_code_manager;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Custom_Code_Manager_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Custom_Code_Manager_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/custom-code-manager-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Custom_Code_Manager_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Custom_Code_Manager_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/custom-code-manager-admin.js', array( 'jquery' ), $this->version, false );

	}

}
