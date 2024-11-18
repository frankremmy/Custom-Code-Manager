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

		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );
		add_action( 'admin_init', array( $this, 'setup_admin_settings' ) );

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

	/*
	 * Add a menu item in the admin dashboard
	 */
	public function add_plugin_admin_menu() {
		add_menu_page(
			'Custom Code Manager',
			'Custom Code Manager',
			'manage_options',
			'custom-code-manager',
			array( $this, 'display_admin_page' ),
			'dashicons-editor-code',
			80
		);
	}

	/*
	 * Display the admin page content
	 */
	public function display_admin_page() {
		?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<form method="post" action="options.php">
				<?php
					settings_fields( 'custom_code_manager' );
					do_settings_sections( 'custom-code-manager' );
					submit_button();
				?>
			</form>
		</div>
		<?php
	}

	/*
	 * Register settings, sections and fields for the admin page.
	 */
	public function setup_admin_settings() {
		register_setting( 'custom_code_manager', 'ccm_php_code' );
		register_setting( 'custom_code_manager', 'ccm_html_code' );
		register_setting( 'custom_code_manager', 'ccm_js_code' );

		// Add a settings section
		add_settings_field(
			'ccm_php_code',
			'PHP Code',
			array( $this, 'php_code_field_callback' ),
			'custom-code-manager',
			'ccm_settings_section'
		);

		add_settings_field(
			'ccm_html_code',
			'HTML Code',
			array( $this, 'html_code_field_callback' ),
			'custom-code-manager',
			'ccm_settings_section'
		);

		add_settings_field(
			'ccm_js_code',
			'JS Code',
			array( $this, 'js_code_field_callback' ),
			'custom-code-manager',
			'ccm_settings_section'
		);
	}

	/*
	 * Callback for PHP code field
	 */
	public function php_code_field_callback() {
		$php_code = get_option( 'ccm_php_code' );
		echo '<textarea name="ccm_php_code" rows="10" cols="50" class="large-text">' . esc_textarea( $php_code ) . '</textarea>';
	}

	/*
	 * Callback for HTML code field
	 */
	public function html_code_field_callback() {
		$html_code = get_option( 'ccm_html_code' );
		echo '<textarea name="ccm_php_code" rows="10" cols="50" class="large-text">' . esc_textarea( $html_code ) . '</textarea>';
	}

	/*
	 * Callback for JS code field
	 */
	public function js_code_field_callback() {
		$js_code = get_option( 'ccm_js_code' );
		echo '<textarea name="ccm_php_code" rows="10" cols="50" class="large-text">' . esc_textarea( $js_code ) . '</textarea>';

	}
}
