<?php


class Yoast_Sociable_Facebook_Button implements Yoast_Sociable_Social_Button {



    /**
     * Get SVG code for Facebook button
     *
     * @return String
     */
    public function getSVG() {
        return '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="28px" height="28px" viewBox="0 0 28 28" enable-background="new 0 0 28 28" xml:space="preserve">
                                    <path d="M27.825,4.783c0-2.427-2.182-4.608-4.608-4.608H4.783c-2.422,0-4.608,2.182-4.608,4.608v18.434
                                        c0,2.427,2.181,4.608,4.608,4.608H14V17.379h-3.379v-4.608H14v-1.795c0-3.089,2.335-5.885,5.192-5.885h3.718v4.608h-3.726
                                        c-0.408,0-0.884,0.492-0.884,1.236v1.836h4.609v4.608h-4.609v10.446h4.916c2.422,0,4.608-2.188,4.608-4.608V4.783z"/>
                                </svg>';
    }

    /**
     * Get link for Facebook button
     * TODO: change url, media and description to dynamic data
     *
     * @return String
     */
    public function getLink() {
        return 'https://www.facebook.com/sharer/sharer.php?u=http://kurtnoble.com/labs/rrssb/index.html';
    }

}