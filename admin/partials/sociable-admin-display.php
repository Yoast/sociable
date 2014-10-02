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

		<?php echo $yoast_sociable_admin->create_form( 'settings' ); ?>

		<?php echo $yoast_sociable_admin->input( 'checkbox', 'Enable Sociable', 'enabled', null, null ); ?>

		<?php echo $yoast_sociable_admin->end_form( 'Save changes', 'settings' ); ?>

	</div>

</div>
