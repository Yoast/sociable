$(function() {
	$( 'ul#active' ).sortable({
		connectWith: 'ul',

		update: function( event, ui ) {
			var networks = $(this).sortable('serialize');
			console.log(networks);

			var data = {
				'action': 'networks_string',
				'active_networks': networks
			};

			jQuery.post( ajax_object.ajax_url, data, function( response ) {
				$( '#yoast-sociable-form-hidden-settings-networks' ) .val( response );
			});
		}
	});

	$( 'ul#inactive' ).sortable({
		connectWith: 'ul'
	});

});