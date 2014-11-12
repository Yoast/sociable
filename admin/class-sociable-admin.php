<?php

/**
 * This class is for the backend
 */

if ( ! class_exists( 'Sociable_Admin' ) ) {

	class Sociable_Admin extends Yoast_Sociable {


		/**
		 * Constructor
		 */
		public function __construct() {
			parent::__construct();
			add_action( 'admin_init', array( $this, 'init_settings' ) );
			add_action( 'admin_menu', array( $this, 'create_menu' ) );
			add_action( 'admin_init', array( $this, 'enqueue_styles' ) );
			add_action( 'admin_init', array( $this, 'enqueue_scripts' ) );
			add_action( 'wp_ajax_networks_string', array( $this, 'active_networks_to_string' ) );
		}

		/**
		 * Init function for the settings of Sociable
		 */
		public function init_settings() {
			if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
				if ( ! function_exists( 'wp_verify_nonce' ) ) {
					require_once( ABSPATH . 'wp-includes/pluggable.php' );
				}

				if ( isset( $_POST['sociable-form-settings'] ) && wp_verify_nonce( $_POST['yoast_sociable_nonce'], 'save_settings' ) ) {
					// Post submitted and verified with our nonce
					$this->save_settings( $_POST );

					add_settings_error(
						'yoast_sociable',
						'yoast_sociable',
						__( 'Settings saved!', 'sociable-for-wordpress' ),
						'updated'
					);
				}
			}
		}

		/**
		 * Create the admin menu
		 */
		public function create_menu() {
			// Base 64 encoded SVG image
			$icon_svg = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCIgWw0KCTwhRU5USVRZIG5zX2Zsb3dzICJodHRwOi8vbnMuYWRvYmUuY29tL0Zsb3dzLzEuMC8iPg0KCTwhRU5USVRZIG5zX2V4dGVuZCAiaHR0cDovL25zLmFkb2JlLmNvbS9FeHRlbnNpYmlsaXR5LzEuMC8iPg0KCTwhRU5USVRZIG5zX2FpICJodHRwOi8vbnMuYWRvYmUuY29tL0Fkb2JlSWxsdXN0cmF0b3IvMTAuMC8iPg0KCTwhRU5USVRZIG5zX2dyYXBocyAiaHR0cDovL25zLmFkb2JlLmNvbS9HcmFwaHMvMS4wLyI+DQpdPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJMYWFnXzEiIHhtbG5zOng9IiZuc19leHRlbmQ7IiB4bWxuczppPSImbnNfYWk7IiB4bWxuczpncmFwaD0iJm5zX2dyYXBoczsiDQoJIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbG5zOmE9Imh0dHA6Ly9ucy5hZG9iZS5jb20vQWRvYmVTVkdWaWV3ZXJFeHRlbnNpb25zLzMuMC8iDQoJIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNDAgMzEuODkiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDQwIDMxLjg5IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxnPg0KPHBhdGggZmlsbD0iI0ZGRkZGRiIgZD0iTTQwLDEyLjUyNEM0MCw1LjYwOCwzMS40NjksMCwyMCwwQzguNTMsMCwwLDUuNjA4LDAsMTIuNTI0YzAsNS41Niw1LjI0MywxMC4yNzIsMTMuNTU3LDExLjkwN3YtNC4wNjUNCgljMCwwLDAuMDQtMS0wLjI4LTEuOTJjLTAuMzItMC45MjEtMS43Ni0zLjAwMS0xLjc2LTUuMTIxYzAtMi4xMjEsMi41NjEtOS41NjMsNS4xMjItMTAuNDQ0Yy0wLjQsMS4yMDEtMC4zMiw3LjY4My0wLjMyLDcuNjgzDQoJczEuNCwyLjcyLDQuNjQxLDIuNzJjMy4yNDIsMCw0LjUxMS0xLjc2LDQuNzE1LTIuMmMwLjIwNi0wLjQ0LDAuODQ2LTguNzIzLDAuODQ2LTguNzIzczQuMDgyLDQuNDAyLDMuNjgyLDkuMzYzDQoJYy0wLjQwMSw0Ljk2Mi00LjQ4Miw3LjIwMy02LjEyMiw5LjEyM2MtMS4yODYsMS41MDUtMi4yMjQsMy4xMy0yLjYyOSw0LjE2OGMwLjgwMS0wLjAzNCwxLjU4Ny0wLjA5OCwyLjM2MS0wLjE4NGw5LjE1MSw3LjA1OQ0KCWwtNC44ODQtNy44M0MzNS41MzUsMjIuMTYxLDQwLDE3LjcxMyw0MCwxMi41MjR6Ii8+DQo8L2c+DQo8L3N2Zz4=';
			$page_title = __('Yoast Sociable', 'sociable-for-wordpress' );
			$menu_title = __('Sociable', 'sociable-for-wordpress' );
			$capability = 'manage_options';
			$menu_slug = 'sociable_settings';

			add_menu_page( $page_title, $menu_title, $capability, $menu_slug, array(
				$this,
				'load_page',
			), $icon_svg );

		}

		/**
		 * This function saves the settings in the option field and returns a wp success message on success
		 *
		 * @param $data
		 */
		public function save_settings( $data ) {
			foreach ( $data as $key => $value ) {
				$this->options[$key] = $value;
			}

			// Check checkboxes, on a uncheck they won't be posted to this function
			$defaults = $this->default_sociable_values();
			foreach ( $defaults[$this->option_prefix] as $key => $value ) {
				if ( ! isset( $data[$key] ) ) {
					$this->options[$key] = $value;
				}
			}

			$this->update_option( $this->options );

		}

		/**
		 * Load the Settings page
		 */
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
		 * Add the styles in the admin head
		 */
		public function enqueue_styles() {
			wp_enqueue_style( 'yoast_sociable_admin', $this->plugin_url . 'admin/css/sociable-admin.css' );
			wp_enqueue_style( 'yoast_sociable_normalize', $this->plugin_url . 'admin/css/normalize.min.css' );
			wp_enqueue_style( 'yoast_sociable_rrssb', $this->plugin_url . 'admin/css/rrssb.css' );
		}

		/**
		 * Add JavaScript files and Ajax call to admin head
		 */
		public function enqueue_scripts() {
			wp_enqueue_script( 'yoast_sociable_rrssb', $this->plugin_url . 'admin/js/rrssb.js', array( 'jquery', 'jquery-ui-core', ) );
			wp_enqueue_script( 'yoast-sociable-admin-sociable', $this->plugin_url . 'admin/js/sociable-admin.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-sortable', ) );
			wp_localize_script( 'yoast-sociable-admin-sociable', 'ajax_object',
				array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'active_networks' => '' ) );
		}

		/**
		 * Get the data from the Ajax call and turn it into a comma separated string
		 */
		public function active_networks_to_string() {
			if ( wp_verify_nonce( $_POST['wp-nonce'], 'yoast_sociable_ajax' )  ) {

				$networks = $_POST['active_networks'];

				$searchReplaceArray = array(
					'network[]=' => '',
					'&'          => ',',
				);

				$networks = str_replace(
					array_keys( $searchReplaceArray ),
					array_values( $searchReplaceArray ),
					$networks
				);

				echo $networks;
			}

			//If we don't call die(), WordPress will add a '0' at the end of our String
			die();
		}

		/**
		 * Load inactive networks and remove active networks from list.
		 *
		 * @return array|mixed
		 */
		public function get_inactive_networks() {
			$social_networks = 'email,facebook,linkedin,twitter,googleplus,pinterest,tumblr';

			$this->options = $this->get_options();

			if ( empty ($this->options['networks']) ) {
				$inactive_networks = explode( ',', $social_networks );
			}
			else {
				$active_networks = explode ( ',', $this->options['networks'] );
				$inactive_networks = $social_networks;

				foreach( $active_networks as $active_network ) {
					$inactive_networks = str_replace( $active_network, '' , $inactive_networks );
				}

				//Remove any duplicate commas and remove comma from start and end from String
				$inactive_networks = preg_replace( '/,+/', ',', trim( $inactive_networks, ',' ) );

				$inactive_networks = explode ( ',', $inactive_networks );

				$inactive_networks = array_filter( $inactive_networks, 'strlen' );
			}

			foreach ( $inactive_networks as $position => $inactive_network ) {
					$network = $this->new_social_network( $inactive_network );

					$inactive_networks[ $position ] = array(
						'name' => $inactive_network,
						'svg' => $network->getSVG(),
					);
			}
			return $inactive_networks;
		}
	}

	global $yoast_sociable_admin;
	$yoast_sociable_admin = new Sociable_Admin;
}