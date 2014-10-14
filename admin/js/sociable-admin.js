$(function() {
	$( '#active' ).sortable({

		update: function( event, ui ) {
			var postData = $(this).sortable('serialize');
			console.log(postData);
		}
	});

	$( "#inactive" ).sortable({
		connectWith: "ul"
	});

});