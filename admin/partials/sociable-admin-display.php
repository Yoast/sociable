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

		echo $yoast_sociable_admin->input ( 'hidden', null, 'networks', null, null );

		?>
		<input type="hidden" name="nonce" id="sociable-wp-nonce" value="<?php echo wp_create_nonce( 'yoast_sociable_ajax' ); ?>">


		<label class="sociable-form-label-left"><?php _e( 'Pick Your Networks:', 'sociable-for-wordpress' ); ?></label>

			<div class="sociable-admin-network-box">
				<label class="sociable-form-label-networks"><?php _e( 'Active Networks', 'sociable-for-wordpress' ); ?></label>
				<ul id="sociable-admin-active-list">

					<?php
					foreach ( $yoast_sociable_admin->get_social_networks() as $network ) {
						echo '<li class="sociable-admin-network-icons" id="network-' . $network ['name'] . '">';
						echo '<span class="sociable-admin-network-icon">';
						echo $network['svg'];
						echo '</span>';
						echo '<span class="sociable-admin-network-text">' . $network['name'] . '</span>';
						echo '</li>';
					} ?>
				</ul>
			</div>
			<div class="sociable-admin-network-box">
				<label class="sociable-form-label-networks"><?php _e( 'Inactive Networks', 'sociable-for-wordpress' ); ?></label>
				<ul id="sociable-admin-inactive-list">

					<?php
					foreach ( $yoast_sociable_admin->get_inactive_networks() as $network ) {
						echo '<li class="sociable-admin-network-icons" id="network-' . $network['name'] . '">';
						echo '<span class="sociable-admin-network-icon">';
						echo $network['svg'];
						echo '</span>';
						echo '<span class="sociable-admin-network-text">' . $network['name'] . '</span>';
						echo '</li>';
					} ?>
				</ul>
			</div>

		<div class="clear"></div>

		<?php echo $yoast_sociable_admin->end_form( __( 'Save changes', 'sociable-for-wordpress' ), 'settings' ); ?>
	</div>

</div>




