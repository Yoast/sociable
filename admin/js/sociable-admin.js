$(function() {
	$( 'ul#active' ).sortable({
		connectWith: 'ul',

		update: function( event, ui ) {
			var postData = $(this).sortable('serialize');
			console.log(postData);
		}
	});

	$( 'ul#inactive' ).sortable({
		connectWith: 'ul'
	});

});