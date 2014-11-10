$(function() {

	var active_networks = $("#active li").length;
	var active_networks_width = 0;

	for ( var i = 0; i < active_networks; i++ ) {
		active_networks_width = active_networks_width + 100;
	}
	if (active_networks_width == 0 ) {
		document.getElementById('active-networks').style.width = '100%';
	} else {
		document.getElementById('active-networks').style.width = active_networks_width + "px";
	}

	var inactive_networks = $("#inactive li").length;
	var inactive_networks_width = 0;

	for ( var i = 0; i < inactive_networks; i++ ) {
		inactive_networks_width = inactive_networks_width + 100;
	}

	if (inactive_networks_width == 0 ) {
		document.getElementById('inactive-networks').style.width = '100%';
	} else {
		document.getElementById('inactive-networks').style.width = inactive_networks_width + "px";
	}

	$( 'ul#active' ).sortable({
		placeholder: "ui-state-highlight",
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
		placeholder: "ui-state-highlight",
		connectWith: 'ul'

	});

});