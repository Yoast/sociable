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
                    //For now, only get name
                    $social_networks[ $position ] = $social_network;

                    //To do: call social network class for each network and get link and SVG icon from class - add this to array

                }
            }

            return $social_networks;
        }

    }

}
