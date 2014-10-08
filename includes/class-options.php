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

            $this->plugin_path = plugin_dir_path( SCWP_FILE );
            $this->plugin_url  = trailingslashit( plugin_dir_url( SCWP_FILE ) );

            if ( false == $this->options ) {
                add_option( $this->option_name, $this->default_sociable_values() );
                $this->options = $this->get_options();
            }

            if ( ! isset( $this->options['version'] ) || $this->options['version'] < SCWP_VERSION ) {
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
         * Return all active social networks
         *
         * @return array
         */
        public function get_social_networks() {
            $social_networks = array();

            $this->options = $this->get_options();

            if ( ! empty( $this->options['networks'] ) ) {
                $networks = $this->options['networks'];

                $social_networks = explode ( ',', $networks );

                foreach ($social_networks as $position => $social_network) {
                    //For now, only get name
                    $social_networks[$position] = $social_network;

                    //To do: call social network class for each network and get link and SVG icon from class - add this to array

                }

            }

            return $social_networks;
        }

        /**
         * Check if all the options are set, to prevent a notice if debugging is enabled
         * When we have new changes, the settings are saved to the options class
         *
         * @param array $options
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
         */
        private function upgrade() {

        }

        /**
         * Set the default Sociable settings here
         * @return array
         */
        public function default_sociable_values() {
            return array(
                $this->option_prefix => array(
                    'enabled' => 0,
                    'networks' => '',
                )
            );
        }
    }
}