<?php


class Yoast_Sociable_Tumblr_Button implements Yoast_Sociable_Social_Button {



    /**
     * Get SVG code for Pinterest button
     *
     * @return String
     */
    public function getSVG() {
        return '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="18px" height="18px" viewBox="0 0 28 28" enable-background="new 0 0 28 28" xml:space="preserve"><path d="M18.02 21.842c-2.029 0.052-2.422-1.396-2.439-2.446v-7.294h4.729V7.874h-4.71V1.592c0 0-3.653 0-3.714 0 s-0.167 0.053-0.182 0.186c-0.218 1.935-1.144 5.33-4.988 6.688v3.637h2.927v7.677c0 2.8 1.7 6.7 7.3 6.6 c1.863-0.03 3.934-0.795 4.392-1.453l-1.22-3.539C19.595 21.6 18.7 21.8 18 21.842z"/></svg>';
    }

    /**
     * Get link for Pinterest button
     * TODO: change url, media and description to dynamic data
     *
     * @return String
     */
    public function getLink() {
        return 'http://tumblr.com/share?s=&amp;v=3&t=Ridiculously%20Responsive%20Social%20Sharing%20Buttons%20by%20KNI%20Labs&amp;u=http%3A%2F%2Fwww.kurtnoble.com%2Flabs%2Frrssb';
    }

}