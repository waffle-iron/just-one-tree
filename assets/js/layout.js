/**
 * Bits & bobs that make our layout look good.
 *
 *
 */

( function( $ ) {

	// This looks for the second word in our site title and wraps it in a span.
	// We use this to colour it differently in CSS.
	function findSecondWordofTitle() {
		$( '.site-title a' ).each( function() {
			var text = $( this ).text().split(' ');

			if ( text.length < 2 ) {
				return;
			} else {
				text[1] = '<span>'+text[1]+'</span>';
				$( this ).html( text.join(' ') );
			}
		});
	}

	// Look for any "learn more" toggle boxes and toggle them.
	$( '.justonetree-learnmore-toggle' ).click( function(e) {
		e.preventDefault();
		$( this ).toggleClass( 'expanded' );
		$( this ).parent( 'h2' ).next( '.justonetree-learnmore' ).toggleClass( 'hidden' );
	} );

	// Run our functions once the window has loaded fully
	$( window ).on( 'load', function() {
		findSecondWordofTitle();
	});

} )( jQuery );
