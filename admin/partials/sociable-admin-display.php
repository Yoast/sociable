<?php
/**
 * Provide a dashboard view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      5.0.0
 *
 * @package    sociable
 * @subpackage sociable/admin/partials
 */

global $yoast_sociable_admin;

?>

<div id="yoast-sociable-wrapper">
	<div class="yoast-sociable-content">

		<h2 id="yoast_sociable_title"><?php _e( 'Sociable Settings', 'sociable-for-wordpress' ); ?></h2>

		<?php

settings_errors( 'yoast_sociable' );

		echo $yoast_sociable_admin->create_form( 'settings' );

		echo $yoast_sociable_admin->input( 'checkbox', __( 'Enable Sociable', 'sociable-for-wordpress' ), 'enabled', null, null );

		echo $yoast_sociable_admin->input( 'hidden', null, 'networks', null, null );

		echo $yoast_sociable_admin->end_form( __( 'Save changes', 'sociable-for-wordpress' ), 'settings' );

		?>
	</div>

</div>

		<ul class="rrssb-buttons clearfix" id="active">
			<?php
			
			foreach ( $yoast_sociable_admin->get_social_networks() as $network ) {
				echo '<li class="' . $network['name'] . '" id="' . $network ['name'] . '">';
				echo '<a href="#">';
				echo '<span class="icon">';
				echo $network['svg'];
				echo '</span>';
				echo '<span class="text">' . $network['name'] . '</span>';
				echo '</a>';
				echo '</li>';
			} ?>

		</ul>

		<ul id="inactive">
			<?php
			foreach ( $yoast_sociable_admin->get_inactive_networks() as $network ) {
				echo '<li id="network-' . $network . '">' . $network . '</li>';
			}
			?>
		</ul>





