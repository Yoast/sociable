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

                    $network_class = 'Yoast_Sociable_' . ucwords($social_network) . '_Button';

                    $network = new $network_class;

                    $social_networks[ $position ] = array(
                        'name' => $social_network,
                        'svg' => $network->getSVG(),
                    );
                }
            }

            return $social_networks;
        }

    }

}