<?php

if ( ! class_exists( 'Yoast_Sociable_Frontend' ) ) {
    class Yoast_Sociable_Frontend extends Yoast_Sociable {

        /**
         * Constructor
         */
        public function __construct() {
            parent::__construct();

            add_filter( 'the_content', array( $this,  'add_social_networks' ), 99 );
        }

        /**
         * Get view from sociable-frontend-display and return the html
         *
         * @return string
         */
        public function frontend_display() {
            ob_start();
            require ( 'partials/sociable-frontend-display.php' );

            return ob_get_contents();
        }

        /**
         * Add all active social networks to posts and pages
         *
         * @param string $content
         *
         * @return string
         */
        public function add_social_networks( $content ) {
            $content = $content . $this->frontend_display();
            ob_clean();
            return $content;
        }

    }

    global $yoast_sociable_frontend;
    $yoast_sociable_frontend = new Yoast_Sociable_Frontend;
}
?>