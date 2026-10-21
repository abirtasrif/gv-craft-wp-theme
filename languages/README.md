Place the theme's translated strings (.po / .mo) in this folder.

The text domain is `gv-craft` — for example:

    esc_html__( 'Add to Bag', 'gv-craft' );

To generate a POT file, run:

    wp i18n make-pot . languages/gv-craft.pot --domain=gv-craft
