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

	// Move the social navigation below our text widget.
	function moveFooterSocialLinks() {
		var $socialLinks = $( '#colophon' ).find( '.jetpack-social-navigation' );
		var $textWidget = $( '#colophon' ).find( '.widget_text' );

		if ( $socialLinks && $textWidget ) {
			$textWidget.append( $socialLinks );
		}
	}

	// Look for any "learn more" toggle boxes and toggle them.
	$( '.justonetree-learnmore-toggle' ).click( function(e) {
		e.preventDefault();
		$( this ).toggleClass( 'expanded' );
		$( this ).parent( 'h2' ).next( '.justonetree-learnmore' ).toggleClass( 'hidden' );
		$( this ).blur();
	} );

	// Run our functions once the window has loaded fully
	$( window ).on( 'load', function() {
		findSecondWordofTitle();
		moveFooterSocialLinks();
	});

} )( jQuery );
