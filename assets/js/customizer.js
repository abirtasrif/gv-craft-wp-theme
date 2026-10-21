/**
 * GV Craft by JarvanIT — Customizer live preview.
 */
( function ( $ ) {
	'use strict';

	if ( ! window.gvcCustomize ) {
		return;
	}

	var map = window.gvcCustomize;

	function bind( setting, selector, wrap ) {
		if ( ! map[ setting ] ) {
			return;
		}

		wp.customize( map[ setting ], function ( value ) {
			value.bind( function ( to ) {
				var el = $( selector );

				if ( ! el.length ) {
					return;
				}

				if ( wrap ) {
					el.html( wrap( to ) );
				} else {
					el.text( to );
				}
			} );
		} );
	}

	function text( setting, selector ) {
		bind( setting, selector );
	}

	function html( setting, selector ) {
		bind( setting, selector, function ( to ) {
			return to;
		} );
	}

	text( 'heroTitle', '.gvc-hero__title' );
	text( 'heroAccent', '.gvc-hero__title .gvc-accent-text' );
	text( 'heroText', '.gvc-hero__copy .gvc-body-lg' );
	text( 'catsTitle', '#catalog .gvc-section-head h2' );
	text( 'catsText', '#catalog .gvc-section-head p' );
	text( 'featuredT', '#featured .gvc-section-head h2' );
	text( 'featuredX', '#featured .gvc-section-head p' );
	text( 'impactTitle', '#impact h2' );
	text( 'impactText', '#impact .gvc-body-lg' );
	text( 'guildTitle', '#guilds h2' );
	text( 'guildText', '#guilds .gvc-body-lg' );
	text( 'newsTitle', '#newsletter h2' );
	text( 'newsText', '#newsletter .gvc-body-md' );
	text( 'footerAbout', '.gvc-site-footer .gvc-body-md' );

	// Accent colour.
	if ( wp.customize( 'gvc_accent' ) ) {
		wp.customize( 'gvc_accent', function ( value ) {
			value.bind( function ( to ) {
				document.documentElement.style.setProperty( '--gvc-accent', to );
			} );
		} );
	}

	if ( wp.customize( 'gvc_accent_contrast' ) ) {
		wp.customize( 'gvc_accent_contrast', function ( value ) {
			value.bind( function ( to ) {
				document.documentElement.style.setProperty( '--gvc-accent-contrast', to );
			} );
		} );
	}

	// Site title.
	wp.customize( 'blogname', function ( value ) {
		value.bind( function ( to ) {
			$( '.gvc-logo-text' ).text( to );
		} );
	} );
}( window.jQuery ) );
