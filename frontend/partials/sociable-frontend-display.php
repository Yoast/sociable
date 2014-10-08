<?php

global $yoast_sociable_frontend;

?>

<div class="yoast-sociable-display-social-networks">
    <?php
        foreach ( $yoast_sociable_frontend->get_social_networks() as $network ) {
            echo $network;
        } ?>
</div>