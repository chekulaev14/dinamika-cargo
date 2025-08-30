/**
 * customizer.js
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	var myCustomizer = window.parent.window.wp.customize;
	
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	
	// Header text hide and show and text color.
	wp.customize( 'header_textcolor', function( value ) {
		if(value() == 'blank'){
			myCustomizer.control('transportex_title_font_size', function(control) {
				control.container.hide();
			});
		}else{
			myCustomizer.control('transportex_title_font_size', function(control) {
				control.container.show();
			});
		}
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
				$( '.site-branding-text ' ).addClass('d-none');
				myCustomizer.control('transportex_title_font_size', function(control) {
					control.container.hide();
				});
			} else {
				$('.site-title').css('position', 'unset');
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-branding-text ' ).removeClass('d-none');
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
				myCustomizer.control('transportex_title_font_size', function(control) {
					control.container.show();
				});
			}
		} );
	} );
	
	// Site Title Font Size.
	wp.customize( 'transportex_title_font_size', function( value ) {
		value.bind( function( newVal ) {
			$( '.site-title a' ).css( {
				'font-size': newVal+'px',
			} );
		} );
	} );

} )( jQuery );
