( function($) {
	var file_frame;
	$( '#widgets-right' )
		.on( 'click', '.select-image', function(e) {
			var $parent = $(this).parents( '.widget-content' );

		    e.preventDefault();

		    if ( file_frame )
		        file_frame.remove();

		    file_frame = wp.media.frames.file_frame = wp.media( {
		        title: $(this).data( 'uploader_title' ),
		        button: {
		            text: $(this).data( 'uploader_button_text' )
		        },
		        multiple: false
		    } );

		    file_frame.on( 'select', function() {
		        var attachment = file_frame.state().get( 'selection' ).first().toJSON();
				$parent.find( '.image-widget-image-container' ).val( attachment.url );
				$parent.find( '.widget-image-container' ).html( '<img src="' + attachment.url + '" alt="" style="max-width:100%;" />' );
		    } );

		    file_frame.open();
		} )
		.on( 'click', '.delete-image', function(e) {
			var $parent = $(this).parents( '.widget-content' );

		    e.preventDefault();
			$parent.find( '.image-widget-image-container' ).val( '' );
			$parent.find( '.widget-image-container' ).html( '' );
		} );
} )(jQuery);