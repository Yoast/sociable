<?php

if ( ! class_exists( 'Yoast_Sociable' ) ) {
    class Yoast_Sociable extends Yoast_Sociable_Options {

        public function __construct() {
            parent::__construct();
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

                $social_networks = explode( ',', $networks );

                foreach ( $social_networks as $position => $social_network ) {

                    $network = $this->new_social_network( $social_network );

                    $social_networks[ $position ] = array(
                        'name' => $social_network,
                        'svg' => $network->getSVG(),
                    );
                }
            }

            return $social_networks;
        }

        /**
         * @param String $network_name
         * Factory method for producing a social button child
         *
         * @return object
         */
        private function new_social_network( $network_name ) {
            $network_class = 'Yoast_Sociable_' . ucwords($network_name) . '_Button';
            return new $network_class;
        }

    }

}