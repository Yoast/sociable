<?php

/**
 * The dashboard-specific functionality of the plugin.
 *
 * @link       http://yoast.com
 * @since      5.0.0
 *
 * @package    sociable
 * @subpackage sociable/includes
 */

/**
 * The dashboard-specific functionality of the plugin.
 *
 * Defines the sociable, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    sociable
 * @subpackage sociable/admin
 * @author     Yoast.com <info@yoast.com>
 */


if ( ! class_exists( 'Sociable_Admin' ) ) {

	class Sociable_Admin {


		/**
		 * The ID of this plugin.
		 *
		 * @since    5.0.0
		 * @access   private
		 * @var      string $name The ID of this plugin.
		 */
		private $name;

		/**
		 * The version of this plugin.
		 *
		 * @since    5.0.0
		 * @access   private
		 * @var      string $version The current version of this plugin.
		 */
		private $version;
		
		public function __construct() {
			add_action( 'admin_menu', array( $this, 'create_sociable_menu' ) );

			if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

				if ( isset( $_POST['sociable-form-settings'] ) && wp_verify_nonce( $_POST['yoast_sociable_nonce'], 'save_settings' ) ) {


					// Post submitted and verified with our nonce
					$this->save_settings( $_POST );

					add_settings_error(
						'yoast_sociable',
						'yoast_gsociable',
						__( 'Settings saved!', 'sociable' ),
						'updated'
					);
				}
			}
		}

		/**
		 *
		 */
		public function create_sociable_menu() {
			add_menu_page( 'Yoast Sociable', 'Sociable', 'manage_options', 'Sociable Settings', array(
					$this,
					'load_page'
				) );
		}

		public function get_options() {
			$plugin_enabled = get_option( 'yoast_so' );
		}


		/**
		 * This function saves the settings in the option field and returns a wp success message on success
		 *
		 * @param $data
		 */
		public function save_settings( $data ) {
			// Check checkboxes, on a uncheck they won't be posted to this function
			$defaults = $this->default_sociable_values();
			foreach ( $defaults[ $this->option_prefix ] as $key => $value ) {
				if ( ! isset( $data[ $key ] ) ) {
					$this->options[ $key ] = $value;
				}
			}

			if ( $this->update_option( $this->options ) ) {
				// Success!
			} else {
				// Fail..
			}

		}

		public $options;

		public function save_options( $plugin_enabled ) {
			$options = array(
				'enabled' => $plugin_enabled,
			);
			update_option( 'yoast_sociable', $options );
		}

		public function load_page() {
			require_once( 'class-sociable-admin.php' );
			require_once( 'partials/sociable-admin-display.php' );
		}

		/**
		 * Create a form element to init a form
		 *
		 * @param string $namespace
		 *
		 * @return string
		 */
		public function create_form( $namespace ) {
			$this->form_namespace = $namespace;

			$action = admin_url( 'admin.php' );
			if ( isset( $_GET['page'] ) ) {
				$action .= '?page=' . $_GET['page'];
			}

			return '<form action="' . $action . '" method="post" id="yoast-sociable-form-' . $this->form_namespace . '" class="yoast_sociable_form">' . wp_nonce_field( 'save_settings', 'yoast_sociable_nonce', null, false );
		}

		/**
		 * Return the form end tag and the submit button
		 *
		 * @param string $button_label
		 * @param string $name
		 *
		 * @return null|string
		 */
		public function end_form( $button_label = 'Save changes', $name = 'submit' ) {
			$output = null;
			$output .= '<div class="sociable-form sociable-form-input">';
			$output .= '<input type="submit" name="sociable-form-' . $name . '" value="' . $button_label . '" class="button button-primary sociable-form-submit" id="yoast-sociable-form-submit-' . $this->form_namespace . '">';
			$output .= '</div></form>';

			return $output;
		}

		/**
		 * Create an input form element with our labels and wrap them
		 *
		 * @param string $type
		 * @param null|string $title
		 * @param null|string $name
		 * @param null|string $text_label
		 * @param null|string $description
		 *
		 * @return null|string
		 */
		public function input( $type = 'text', $title = null, $name = null, $text_label = null, $description = null ) {
			$input = null;
			$id    = str_replace( '[', '-', $name );
			$id    = str_replace( ']', '', $id );

			// Catch a notice if the option doesn't exist, yet
			if ( ! isset( $this->options[ $name ] ) ) {
				$this->options[ $name ] = '';
			}

			$input .= '<div class="sociable-form sociable-form-input">';
			if ( ! is_null( $title ) ) {
				$input .= '<label class="sociable-form sociable-form-' . $type . '-label sociable-form-label-left" id="yoast-sociable-form-label-' . $type . '-' . $this->form_namespace . '-' . $id . '" />' . $title . ':</label>';
			}

			if ( $type == 'checkbox' && $this->options[ $name ] == 1 ) {
				$input .= '<input type="' . $type . '" class="sociable-form sociable-form-checkbox" id="yoast-sociable-form-' . $type . '-' . $this->form_namespace . '-' . $id . '" name="' . $name . '" value="1" checked="checked" />';
			} elseif ( $type == 'checkbox' ) {
				$input .= '<input type="' . $type . '" class="sociable-form sociable-form-checkbox" id="yoast-sociable-form-' . $type . '-' . $this->form_namespace . '-' . $id . '" name="' . $name . '" value="1" />';
			} else {
				$input .= '<input type="' . $type . '" class="sociable-form sociable-form-' . $type . '" id="yoast-sociable-form-' . $type . '-' . $this->form_namespace . '-' . $id . '" name="' . $name . '" value="' . stripslashes( $this->options[ $name ] ) . '" />';
			}

			if ( ! is_null( $text_label ) ) {
				$input .= '<label class="sociable-form sociable-form-' . $type . '-label" id="yoast-sociable-form-label-' . $type . '-textlabel-' . $this->form_namespace . '-' . $id . '" for="yoast-sociable-form-' . $type . '-' . $this->form_namespace . '-' . $id . '" />' . $text_label . '</label>';
			}

			$input .= '</div>';

			// If we get a description, append it to this select field in a new row
			if ( ! is_null( $description ) ) {
				$input .= '<div class="sociable-form sociable-form-input">';
				$input .= '<label class="sociable-form sociable-form-select-label sociable-form-label-left" id="yoast-sociable-form-description-select-' . $this->form_namespace . '-' . $id . '" />&nbsp;</label>';
				$input .= '<span class="sociable-form sociable-form-description">' . $description . '</span>';
				$input .= '</div>';
			}

			return $input;
		}

		/**
		 * Register the stylesheets for the Dashboard.
		 *
		 * @since    5.0.0
		 */
		public function enqueue_styles() {

			/**
			 * This function is provided for demonstration purposes only.
			 *
			 * An instance of this class should be passed to the run() function
			 * defined in Sociable_Admin_Loader as all of the hooks are defined
			 * in that particular class.
			 *
			 * The Sociable_Admin_Loader will then create the relationship
			 * between the defined hooks and the functions defined in this
			 * class.
			 */

			wp_enqueue_style( $this->name, plugin_dir_url( __FILE__ ) . 'css/sociable-admin.css', array(), $this->version, 'all' );

		}

		/**
		 * Register the JavaScript for the dashboard.
		 *
		 * @since    5.0.0
		 */
		public function enqueue_scripts() {

			/**
			 * This function is provided for demonstration purposes only.
			 *
			 * An instance of this class should be passed to the run() function
			 * defined in Sociable_Admin_Loader as all of the hooks are defined
			 * in that particular class.
			 *
			 * The Sociable_Admin_Loader will then create the relationship
			 * between the defined hooks and the functions defined in this
			 * class.
			 */

			wp_enqueue_script( $this->name, plugin_dir_url( __FILE__ ) . 'js/sociable-admin.js', array( 'jquery' ), $this->version, false );

		}

	}

	global $yoast_sociable_admin;
	$yoast_sociable_admin = new Sociable_Admin;
}
