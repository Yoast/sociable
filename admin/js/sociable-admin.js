$(function() {

	/**
	 * Make active network box sortable and give it a placeholder. Copy the active networks to a hidden form to save this when form is submitted
	 */
	$( 'ul#active').sortable({
		connectWith: 'ul',
		placeholder: 'network-placeholder',

		deactivate: function( event, ui ) {
			var networks = $(this).sortable('serialize');

			var data = {
				'action': 'networks_string',
				'active_networks': networks
			};

			jQuery.post( ajax_object.ajax_url, data, function( response ) {
				$( '#yoast-sociable-form-hidden-settings-networks' ) .val( response );
			});
		}
	});

	/**
	 * Make inactive network box sortable and give it a placeholder.
	 */
	$( 'ul#inactive').sortable({
		connectWith: 'ul',
		placeholder: 'network-placeholder'
	});
});