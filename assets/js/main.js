/**
 * GV Craft by JarvanIT — front-end behaviour.
 *
 * Vanilla JS, no jQuery dependency.
 */
( function () {
	'use strict';

	var data = window.gvcData || {};

	function $( selector, scope ) {
		return ( scope || document ).querySelector( selector );
	}

	function $$( selector, scope ) {
		return Array.prototype.slice.call( ( scope || document ).querySelectorAll( selector ) );
	}

	/* ---------------------------------------------------------------
	 * Toast
	 * ------------------------------------------------------------ */
	var toastTimer;

	function toast( message, isError ) {
		var el = $( '#gvc-toast' );

		if ( ! el ) {
			return;
		}

		el.textContent = message;
		el.style.background = isError ? 'var(--gvc-error)' : 'var(--gvc-forest)';
		el.classList.add( 'is-visible' );

		window.clearTimeout( toastTimer );
		toastTimer = window.setTimeout( function () {
			el.classList.remove( 'is-visible' );
		}, 3600 );
	}

	/* ---------------------------------------------------------------
	 * Sticky header shadow
	 * ------------------------------------------------------------ */
	function initStickyHeader() {
		var header = $( '#gvc-header' );

		if ( ! header ) {
			return;
		}

		var onScroll = function () {
			header.classList.toggle( 'is-stuck', window.scrollY > 8 );
		};

		window.addEventListener( 'scroll', onScroll, { passive: true } );
		onScroll();
	}

	/* ---------------------------------------------------------------
	 * Mobile drawer
	 * ------------------------------------------------------------ */
	function initDrawer() {
		var drawer = $( '#gvc-drawer' );

		if ( ! drawer ) {
			return;
		}

		var openers = $$( '[data-gvc-drawer-open]' );
		var closers = $$( '[data-gvc-drawer-close]' );

		function open() {
			drawer.classList.add( 'is-open' );
			drawer.setAttribute( 'aria-hidden', 'false' );
			document.body.style.overflow = 'hidden';

			openers.forEach( function ( button ) {
				button.setAttribute( 'aria-expanded', 'true' );
			} );
		}

		function close() {
			drawer.classList.remove( 'is-open' );
			drawer.setAttribute( 'aria-hidden', 'true' );
			document.body.style.overflow = '';

			openers.forEach( function ( button ) {
				button.setAttribute( 'aria-expanded', 'false' );
			} );
		}

		openers.forEach( function ( button ) {
			button.addEventListener( 'click', open );
		} );

		closers.forEach( function ( button ) {
			button.addEventListener( 'click', close );
		} );

		document.addEventListener( 'keydown', function ( event ) {
			if ( event.key === 'Escape' && drawer.classList.contains( 'is-open' ) ) {
				close();
			}
		} );
	}

	/* ---------------------------------------------------------------
	 * AJAX add to cart
	 * ------------------------------------------------------------ */
	function initAddToCart() {
		document.addEventListener( 'click', function ( event ) {
			var button = event.target.closest( '[data-gvc-add]' );

			if ( ! button ) {
				return;
			}

			event.preventDefault();

			if ( button.classList.contains( 'is-loading' ) ) {
				return;
			}

			button.classList.add( 'is-loading' );

			var body = new FormData();
			body.append( 'action', 'gvc_add_to_cart' );
			body.append( 'nonce', data.nonce );
			body.append( 'product_id', button.getAttribute( 'data-gvc-add' ) );
			body.append( 'quantity', 1 );

			fetch( data.ajaxUrl, {
				method: 'POST',
				credentials: 'same-origin',
				body: body
			} )
				.then( function ( response ) {
					return response.json();
				} )
				.then( function ( payload ) {
					button.classList.remove( 'is-loading' );

					if ( payload && payload.success ) {
						button.classList.add( 'is-added' );
						window.setTimeout( function () {
							button.classList.remove( 'is-added' );
						}, 2500 );

						updateCartCount( payload.data.count );

						if ( payload.data.message ) {
							toast( payload.data.message );
						}
					} else {
						toast( ( payload && payload.data && payload.data.message ) || data.i18n.error, true );
					}
				} )
				.catch( function () {
					button.classList.remove( 'is-loading' );
					toast( data.i18n.error, true );
				} );
		} );
	}

	function updateCartCount( count ) {
		$$( '[data-gvc-cart-count]' ).forEach( function ( el ) {
			el.textContent = count;

			var badge = el.closest( '.gvc-cart-btn' );

			if ( badge ) {
				badge.classList.toggle( 'is-empty', 0 === count );
			}
		} );

		$$( '.gvc-mobile-nav__badge' ).forEach( function ( el ) {
			el.textContent = count;
		} );
	}

	/* ---------------------------------------------------------------
	 * Wishlist (local storage)
	 * ------------------------------------------------------------ */
	function initWishlist() {
		var stored = [];

		try {
			stored = JSON.parse( window.localStorage.getItem( 'gvc_wishlist' ) || '[]' );
		} catch ( error ) {
			stored = [];
		}

		function save() {
			try {
				window.localStorage.setItem( 'gvc_wishlist', JSON.stringify( stored ) );
			} catch ( error ) {
				/* storage unavailable */
			}
		}

		function paint() {
			$$( '[data-gvc-wishlist]' ).forEach( function ( button ) {
				var id = button.getAttribute( 'data-gvc-wishlist' );
				var active = stored.indexOf( id ) > -1;

				button.classList.toggle( 'is-active', active );
				button.style.color = active ? 'var(--gvc-error)' : '';

				var icon = button.querySelector( '.gvc-icon' );

				if ( icon ) {
					icon.style.fontVariationSettings = active ? '"FILL" 1' : '"FILL" 0';
				}
			} );

			// Wishlist page — reveal the saved pieces.
			var items = $$( '[data-gvc-wishlist-item]' );

			if ( items.length ) {
				var found = 0;

				items.forEach( function ( item ) {
					var id = item.getAttribute( 'data-gvc-wishlist-item' );
					var active = stored.indexOf( id ) > -1;

					item.style.display = active ? '' : 'none';

					if ( active ) {
						found++;
					}
				} );

				var empty = $( '#gvc-wishlist-empty' );

				if ( empty ) {
					empty.style.display = found ? 'none' : '';
				}
			}
		}

		document.addEventListener( 'click', function ( event ) {
			var button = event.target.closest( '[data-gvc-wishlist]' );

			if ( ! button ) {
				return;
			}

			event.preventDefault();

			var id = button.getAttribute( 'data-gvc-wishlist' );
			var index = stored.indexOf( id );

			if ( index > -1 ) {
				stored.splice( index, 1 );
				toast( 'Removed from your wishlist.' );
			} else {
				stored.push( id );
				toast( 'Saved to your wishlist.' );
			}

			save();
			paint();
		} );

		paint();
	}

	/* ---------------------------------------------------------------
	 * Single product: gallery, tabs, swatches
	 * ------------------------------------------------------------ */
	function initProductGallery() {
		var main = $( '#gvc-main-image' );

		if ( ! main ) {
			return;
		}

		$$( '[data-gvc-thumb]' ).forEach( function ( thumb ) {
			thumb.addEventListener( 'click', function () {
				var id = thumb.getAttribute( 'data-gvc-thumb' );

				$$( '[data-gvc-thumb]' ).forEach( function ( other ) {
					other.classList.remove( 'is-active' );
				} );

				thumb.classList.add( 'is-active' );

				var attachment = window.gvcData && window.gvcData.attachments ? window.gvcData.attachments : {};

				if ( attachment[ id ] ) {
					main.src = attachment[ id ];
					main.srcset = attachment[ id ];
				}
			} );
		} );
	}

	function initTabs() {
		var tabs = $( '[data-gvc-tabs]' );

		if ( ! tabs ) {
			return;
		}

		$$( '[data-gvc-tab]', tabs ).forEach( function ( button ) {
			button.addEventListener( 'click', function () {
				var key = button.getAttribute( 'data-gvc-tab' );

				$$( '[data-gvc-tab]', tabs ).forEach( function ( other ) {
					other.classList.remove( 'is-active' );
				} );

				$$( '[data-gvc-panel]', tabs ).forEach( function ( panel ) {
					panel.classList.toggle( 'is-active', panel.getAttribute( 'data-gvc-panel' ) === key );
				} );

				button.classList.add( 'is-active' );
			} );
		} );
	}

	function initSwatches() {
		$$( '[data-gvc-colorway]' ).forEach( function ( swatch ) {
			swatch.addEventListener( 'click', function () {
				$$( '[data-gvc-colorway]' ).forEach( function ( other ) {
					other.classList.remove( 'is-active' );
				} );

				swatch.classList.add( 'is-active' );

				var label = $( '[data-gvc-colorway-name]' );

				if ( label ) {
					label.textContent = swatch.getAttribute( 'data-gvc-colorway' );
				}
			} );
		} );
	}

	/* ---------------------------------------------------------------
	 * Quantity buttons (WooCommerce forms)
	 * ------------------------------------------------------------ */
	function initQuantity() {
		document.addEventListener( 'click', function ( event ) {
			var button = event.target.closest( '[data-gvc-qty]' );

			if ( ! button ) {
				return;
			}

			event.preventDefault();

			var wrap = button.closest( '.gvc-qty' );
			var input = wrap ? wrap.querySelector( 'input.qty' ) : null;

			if ( ! input ) {
				return;
			}

			var step = parseFloat( input.getAttribute( 'step' ) || '1' );
			var min = parseFloat( input.getAttribute( 'min' ) || '0' );
			var max = parseFloat( input.getAttribute( 'max' ) || '0' );
			var value = parseFloat( input.value || '1' );

			if ( 'plus' === button.getAttribute( 'data-gvc-qty' ) ) {
				value += step;
			} else {
				value -= step;
			}

			if ( value < min ) {
				value = min;
			}

			if ( max && value > max ) {
				value = max;
			}

			input.value = value;
			input.dispatchEvent( new Event( 'change', { bubbles: true } ) );
		} );
	}

	/* ---------------------------------------------------------------
	 * Shop: mobile filter sidebar + ordering
	 * ------------------------------------------------------------ */
	function initShop() {
		var toggle = $( '[data-gvc-toggle-sidebar]' );
		var sidebar = $( '#gvc-shop-sidebar' );

		if ( toggle && sidebar ) {
			toggle.style.display = 'inline-flex';

			toggle.addEventListener( 'click', function () {
				var open = sidebar.classList.toggle( 'is-open' );

				toggle.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
			} );
		}

		var ordering = $( '.woocommerce-ordering select' );

		if ( ordering ) {
			ordering.addEventListener( 'change', function () {
				var form = ordering.closest( 'form' );

				if ( form ) {
					form.submit();
				}
			} );
		}
	}

	/* ---------------------------------------------------------------
	 * Search shortcut
	 * ------------------------------------------------------------ */
	function initSearchShortcut() {
		document.addEventListener( 'keydown', function ( event ) {
			if ( ( event.metaKey || event.ctrlKey ) && 'k' === event.key.toLowerCase() ) {
				var field = $( '.gvc-header__search input[type="search"]' ) || $( 'input[type="search"]' );

				if ( field ) {
					event.preventDefault();
					field.focus();
				}
			}
		} );
	}

	/* ---------------------------------------------------------------
	 * Boot
	 * ------------------------------------------------------------ */
	function boot() {
		initStickyHeader();
		initDrawer();
		initAddToCart();
		initWishlist();
		initProductGallery();
		initTabs();
		initSwatches();
		initQuantity();
		initShop();
		initSearchShortcut();
	}

	if ( 'loading' === document.readyState ) {
		document.addEventListener( 'DOMContentLoaded', boot );
	} else {
		boot();
	}
}() );
