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

		echo $yoast_sociable_admin->input( 'text', __( 'Active social networks', 'sociable-for-wordpress' ), 'networks', null, null );

		echo $yoast_sociable_admin->end_form( __( 'Save changes', 'sociable-for-wordpress' ), 'settings' );

		?>


		<ul id="active" >
			<?php
			foreach ( $yoast_sociable_admin->get_social_networks() as $key => $network ) {
				echo '<li id="' . $network . '_' . $key . '">' . $network . '</li>';
			} ?>
		</ul>

		<ul id="inactive">
		</ul>


	</div>

</div>