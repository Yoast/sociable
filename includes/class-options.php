<?php

if ( ! class_exists( 'Yoast_Sociable_Options' ) ) {

    class Yoast_Sociable_Options {

        public $options;

        /**
         * Holds the settings for the Sociable plugin
         *
         * @var string
         */
        public $option_name = 'yst_sociable';

        /**
         * Holds the prefix we use within the option to save settings
         *
         * @var string
         */
        public $option_prefix = 'sociable_general';

        /**
         * Holds the path to the main plugin file
         *
         * @var string
         */
        public $plugin_path;

        /**
         * Holds the URL to the main plugin directory
         *
         * @var string
         */
        public $plugin_url;

        /**
         * Constructor for the options
         */
        public function __construct() {
            $this->options = $this->get_options();
            $this->options = $this->check_options( $this->options );

            $this->plugin_path = plugin_dir_path( GAWP_FILE );
            $this->plugin_url  = trailingslashit( plugin_dir_url( GAWP_FILE ) );

            if ( false == $this->options ) {
                add_option( $this->option_name, $this->default_sociable_values() );
                $this->options = $this->get_options();
            }

            if ( ! isset( $this->options['version'] ) || $this->options['version'] < GAWP_VERSION ) {
                $this->upgrade();
            }
        }

        /**
         * Updates the Sociable option within the current option_prefix
         *
         * @param array $val
         *
         * @return bool
         */
        public function update_option( $val ) {
            $options = get_option( $this->option_name );
            $options[$this->option_prefix] = $val;

            return update_option( $this->option_name, $options );
        }

        /**
         * Return the Sociable options
         *
         * @return mixed|void
         */
        public function get_options() {
            $options = get_option( $this->option_name );

            return $options[$this->option_prefix];
        }

        /**
         * Check if all the options are set, to prevent a notice if debugging is enabled
         * When we have new changes, the settings are saved to the options class
         *
         * @param $options
         *
         * @return mixed
         */
        public function check_options( $options ) {

            $changes = 0;
            foreach ( $this->default_sociable_values() as $key => $value ) {
                if ( ! isset( $options[$key] ) ) {
                    $options[$key] = $value;
                    $changes ++;
                }
            }

            if ( $changes >= 1 ) {
                $this->update_option( $options );
            }

            return $options;
        }

        /**
         * Upgrade the settings when settings are changed.
         *
         * @since 5.0.1
         */
        private function upgrade() {
            if ( ! isset( $this->options['version'] ) && is_null( $this->get_tracking_code() ) ) {
                $old_options = get_option( 'Yoast_Google_Analytics' );

                if ( isset( $old_options ) && is_array( $old_options ) ) {
                    if ( isset( $old_options['uastring'] ) && '' !== trim( $old_options['uastring'] ) ) {
                        // Save UA as manual UA, instead of saving all the old GA crap
                        $this->options['manual_ua_code']       = 1;
                        $this->options['manual_ua_code_field'] = $old_options['uastring'];
                    }

                    // Other settings
                    $this->options['allow_anchor']               = $old_options['allowanchor'];
                    $this->options['add_allow_linker']           = $old_options['allowlinker'];
                    $this->options['anonymous_data']             = $old_options['anonymizeip'];
                    $this->options['track_outbound']             = $old_options['trackoutbound'];
                    $this->options['track_internal_as_outbound'] = $old_options['internallink'];
                    $this->options['track_internal_as_label']    = $old_options['internallinklabel'];
                    $this->options['extensions_of_files']        = $old_options['dlextensions'];

                }

                delete_option( 'Yoast_Google_Analytics' );
            }

            // 5.0.0 to 5.0.1 fix of ignore users array
            if ( ! isset( $this->options['version'] ) || version_compare( $this->options['version'], '5.0.1', '<' ) ) {
                if ( isset( $this->options['ignore_users'] ) && ! is_array( $this->options['ignore_users'] ) ) {
                    $this->options['ignore_users'] = (array) $this->options['ignore_users'];
                }
            }

            // Check is API option already exists - if not add it
            $yst_ga_api = get_option( 'yst_ga_api' );
            if ( $yst_ga_api === false ) {
                add_option( 'yst_ga_api', array(), '', 'no' );
            }

            // Fallback to make sure every default option has a value
            $defaults = $this->default_sociable_values();
            foreach ( $defaults[$this->option_prefix] as $key => $value ) {
                if ( ! isset( $this->options[$key] ) ) {
                    $this->options[$key] = $value;
                }
            }

            // Set to the current version now that we've done all needed upgrades
            $this->options['version'] = GAWP_VERSION;

            $this->update_option( $this->options );
        }

        /**
         * Set the default Sociable settings here
         * @return array
         */
        public function default_sociable_values() {
            return array(
                $this->option_prefix => array(
                    'enabled' => 0,
                )
            );
        }
    }
}