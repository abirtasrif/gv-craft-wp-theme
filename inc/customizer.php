<?php
/**
 * GV Craft by JarvanIT — Customizer.
 *
 * Every piece of homepage copy, the announcement bar, the impact ledger and the
 * footer can be edited from Appearance → Customize.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the GV Craft panel, sections, settings and controls.
 */
function gvc_customize_register( $wp_customize ) {
	$defaults = gvc_defaults();

	$blogname        = $wp_customize->get_setting( 'blogname' );
	$blogdescription = $wp_customize->get_setting( 'blogdescription' );

	if ( $blogname ) {
		$blogname->transport = 'postMessage';
	}

	if ( $blogdescription ) {
		$blogdescription->transport = 'postMessage';
	}

	$wp_customize->selective_refresh->add_partial(
		'blogname',
		array(
			'selector'        => '.gvc-logo-text',
			'render_callback' => function () {
				bloginfo( 'name' );
			},
		)
	);

	$wp_customize->add_panel(
		'gvc_panel',
		array(
			'title'       => __( 'GV Craft Options', 'gv-craft' ),
			'description' => __( 'All homepage, announcement, impact and footer content for the GV Craft design system.', 'gv-craft' ),
			'priority'    => 20,
		)
	);

	/**
	 * Helper: register a text style setting + control.
	 *
	 * @param string $key      Option key.
	 * @param array  $args     Control arguments.
	 * @param string $section  Section id.
	 * @param string $type     Control type.
	 */
	$gvc_add = function ( $key, $args, $section, $type = 'text' ) use ( $wp_customize, $defaults ) {
		$sanitize = isset( $args['sanitize'] ) ? $args['sanitize'] : 'wp_kses_post';
		$default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';

		$wp_customize->add_setting(
			'gvc_' . $key,
			array(
				'default'           => $default,
				'sanitize_callback' => $sanitize,
				'transport'         => isset( $args['transport'] ) ? $args['transport'] : 'refresh',
			)
		);

		$control_args = array(
			'label'       => $args['label'],
			'section'     => $section,
			'type'        => $type,
			'description' => isset( $args['description'] ) ? $args['description'] : '',
		);

		if ( 'url' === $type ) {
			$control_args['input_attrs'] = array( 'placeholder' => 'https://' );
		}

		$wp_customize->add_control( 'gvc_' . $key, $control_args );
	};

	/* ---------------------------------------------------------------------
	 * Announcement bar
	 * ------------------------------------------------------------------ */
	$wp_customize->add_section(
		'gvc_announce',
		array(
			'title'       => __( 'Announcement Bar', 'gv-craft' ),
			'panel'       => 'gvc_panel',
			'description' => __( 'The slim eco ribbon above the header.', 'gv-craft' ),
		)
	);

	$wp_customize->add_setting(
		'gvc_announce_enable',
		array(
			'default'           => true,
			'sanitize_callback' => 'gvc_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'gvc_announce_enable',
		array(
			'label'   => __( 'Show the announcement bar', 'gv-craft' ),
			'section' => 'gvc_announce',
			'type'    => 'checkbox',
		)
	);

	$gvc_add( 'announce_pill', array( 'label' => __( 'Badge text', 'gv-craft' ) ), 'gvc_announce' );
	$gvc_add( 'announce_text', array( 'label' => __( 'Message', 'gv-craft' ) ), 'gvc_announce' );
	$gvc_add( 'announce_shipping', array( 'label' => __( 'Shipping note', 'gv-craft' ) ), 'gvc_announce' );
	$gvc_add( 'announce_link_label', array( 'label' => __( 'Link label', 'gv-craft' ) ), 'gvc_announce' );
	$gvc_add( 'announce_link_url', array( 'label' => __( 'Link URL', 'gv-craft' ), 'transport' => 'refresh' ), 'gvc_announce', 'url' );

	/* ---------------------------------------------------------------------
	 * Hero
	 * ------------------------------------------------------------------ */
	$wp_customize->add_section(
		'gvc_hero',
		array(
			'title' => __( 'Hero Section', 'gv-craft' ),
			'panel' => 'gvc_panel',
		)
	);

	$gvc_add( 'hero_eyebrow', array( 'label' => __( 'Eyebrow text', 'gv-craft' ) ), 'gvc_hero' );
	$gvc_add( 'hero_title', array( 'label' => __( 'Headline', 'gv-craft' ) ), 'gvc_hero' );
	$gvc_add( 'hero_title_accent', array( 'label' => __( 'Accent line (italic)', 'gv-craft' ) ), 'gvc_hero' );
	$gvc_add( 'hero_text', array( 'label' => __( 'Paragraph', 'gv-craft' ) ), 'gvc_hero' );
	$gvc_add( 'hero_cta_label', array( 'label' => __( 'Primary button label', 'gv-craft' ) ), 'gvc_hero' );
	$gvc_add( 'hero_cta_url', array( 'label' => __( 'Primary button URL', 'gv-craft' ) ), 'gvc_hero', 'url' );
	$gvc_add( 'hero_cta2_label', array( 'label' => __( 'Secondary button label', 'gv-craft' ) ), 'gvc_hero' );
	$gvc_add( 'hero_cta2_url', array( 'label' => __( 'Secondary button URL', 'gv-craft' ) ), 'gvc_hero', 'url' );
	$gvc_add( 'hero_badge', array( 'label' => __( 'Showcase badge', 'gv-craft' ) ), 'gvc_hero' );
	$gvc_add( 'hero_hotspot_title', array( 'label' => __( 'Hotspot title', 'gv-craft' ) ), 'gvc_hero' );
	$gvc_add( 'hero_hotspot_text', array( 'label' => __( 'Hotspot text', 'gv-craft' ) ), 'gvc_hero' );
	$gvc_add( 'hero_stat1_value', array( 'label' => __( 'Stat 1 value', 'gv-craft' ) ), 'gvc_hero' );
	$gvc_add( 'hero_stat1_label', array( 'label' => __( 'Stat 1 label', 'gv-craft' ) ), 'gvc_hero' );
	$gvc_add( 'hero_stat2_value', array( 'label' => __( 'Stat 2 value', 'gv-craft' ) ), 'gvc_hero' );
	$gvc_add( 'hero_stat2_label', array( 'label' => __( 'Stat 2 label', 'gv-craft' ) ), 'gvc_hero' );
	$gvc_add( 'hero_stat3_value', array( 'label' => __( 'Stat 3 value', 'gv-craft' ) ), 'gvc_hero' );
	$gvc_add( 'hero_stat3_label', array( 'label' => __( 'Stat 3 label', 'gv-craft' ) ), 'gvc_hero' );

	/* ---------------------------------------------------------------------
	 * Home sections
	 * ------------------------------------------------------------------ */
	$wp_customize->add_section(
		'gvc_sections',
		array(
			'title'       => __( 'Home Sections', 'gv-craft' ),
			'panel'       => 'gvc_panel',
			'description' => __( 'Toggle the designed sections on the front page.', 'gv-craft' ),
		)
	);

	$toggles = array(
		'section_categories' => __( 'Craft disciplines / categories', 'gv-craft' ),
		'section_featured'   => __( 'Curated artisan goods', 'gv-craft' ),
		'section_impact'     => __( 'Impact ledger', 'gv-craft' ),
		'section_guild'      => __( 'Artisan guild spotlight', 'gv-craft' ),
		'section_guarantees' => __( 'Brand guarantees', 'gv-craft' ),
		'section_journal'    => __( 'Regenerative living journal', 'gv-craft' ),
		'section_newsletter' => __( 'Newsletter', 'gv-craft' ),
	);

	foreach ( $toggles as $key => $label ) {
		$wp_customize->add_setting(
			'gvc_' . $key,
			array(
				'default'           => true,
				'sanitize_callback' => 'gvc_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			'gvc_' . $key,
			array(
				'label'   => $label,
				'section' => 'gvc_sections',
				'type'    => 'checkbox',
			)
		);
	}

	/* ---------------------------------------------------------------------
	 * Categories section
	 * ------------------------------------------------------------------ */
	$wp_customize->add_section(
		'gvc_cats',
		array(
			'title' => __( 'Craft Disciplines', 'gv-craft' ),
			'panel' => 'gvc_panel',
		)
	);

	$gvc_add( 'cats_eyebrow', array( 'label' => __( 'Eyebrow', 'gv-craft' ) ), 'gvc_cats' );
	$gvc_add( 'cats_title', array( 'label' => __( 'Title', 'gv-craft' ) ), 'gvc_cats' );
	$gvc_add( 'cats_text', array( 'label' => __( 'Description', 'gv-craft' ) ), 'gvc_cats' );

	$wp_customize->add_setting(
		'gvc_cats_count',
		array(
			'default'           => 4,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'gvc_cats_count',
		array(
			'label'       => __( 'Number of discipline cards', 'gv-craft' ),
			'section'     => 'gvc_cats',
			'type'        => 'number',
			'input_attrs' => array( 'min' => 2, 'max' => 8 ),
		)
	);

	/* ---------------------------------------------------------------------
	 * Featured products
	 * ------------------------------------------------------------------ */
	$wp_customize->add_section(
		'gvc_featured',
		array(
			'title' => __( 'Curated Artisan Goods', 'gv-craft' ),
			'panel' => 'gvc_panel',
		)
	);

	$gvc_add( 'featured_title', array( 'label' => __( 'Title', 'gv-craft' ) ), 'gvc_featured' );
	$gvc_add( 'featured_text', array( 'label' => __( 'Description', 'gv-craft' ) ), 'gvc_featured' );

	$wp_customize->add_setting(
		'gvc_featured_count',
		array(
			'default'           => 8,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'gvc_featured_count',
		array(
			'label'       => __( 'Number of products', 'gv-craft' ),
			'section'     => 'gvc_featured',
			'type'        => 'number',
			'input_attrs' => array( 'min' => 2, 'max' => 24 ),
		)
	);

	/* ---------------------------------------------------------------------
	 * Impact ledger
	 * ------------------------------------------------------------------ */
	$wp_customize->add_section(
		'gvc_impact',
		array(
			'title' => __( 'Impact Ledger', 'gv-craft' ),
			'panel' => 'gvc_panel',
		)
	);

	$gvc_add( 'impact_eyebrow', array( 'label' => __( 'Eyebrow', 'gv-craft' ) ), 'gvc_impact' );
	$gvc_add( 'impact_title', array( 'label' => __( 'Title', 'gv-craft' ) ), 'gvc_impact' );
	$gvc_add( 'impact_text', array( 'label' => __( 'Description', 'gv-craft' ) ), 'gvc_impact' );

	for ( $i = 1; $i <= 4; $i++ ) {
		$gvc_add( 'impact_' . $i . '_value', array( 'label' => sprintf( 'Metric %d — value', $i ), ), 'gvc_impact' );
		$gvc_add( 'impact_' . $i . '_label', array( 'label' => sprintf( 'Metric %d — label', $i ), ), 'gvc_impact' );
		$gvc_add( 'impact_' . $i . '_note', array( 'label' => sprintf( 'Metric %d — note', $i ), ), 'gvc_impact' );
	}

	/* ---------------------------------------------------------------------
	 * Guild spotlight
	 * ------------------------------------------------------------------ */
	$wp_customize->add_section(
		'gvc_guild',
		array(
			'title' => __( 'Artisan Guild Spotlight', 'gv-craft' ),
			'panel' => 'gvc_panel',
		)
	);

	$gvc_add( 'guild_eyebrow', array( 'label' => __( 'Eyebrow', 'gv-craft' ) ), 'gvc_guild' );
	$gvc_add( 'guild_title', array( 'label' => __( 'Title', 'gv-craft' ) ), 'gvc_guild' );
	$gvc_add( 'guild_text', array( 'label' => __( 'Description', 'gv-craft' ) ), 'gvc_guild' );
	$gvc_add( 'guild_cta', array( 'label' => __( 'Button label', 'gv-craft' ) ), 'gvc_guild' );
	$gvc_add( 'guild_cta_url', array( 'label' => __( 'Button URL', 'gv-craft' ) ), 'gvc_guild', 'url' );

	/* ---------------------------------------------------------------------
	 * Guarantees
	 * ------------------------------------------------------------------ */
	$wp_customize->add_section(
		'gvc_guarantees',
		array(
			'title' => __( 'Brand Guarantees', 'gv-craft' ),
			'panel' => 'gvc_panel',
		)
	);

	for ( $i = 1; $i <= 4; $i++ ) {
		$gvc_add( 'guarantee_' . $i . '_title', array( 'label' => sprintf( 'Guarantee %d — title', $i ) ), 'gvc_guarantees' );
		$gvc_add( 'guarantee_' . $i . '_text', array( 'label' => sprintf( 'Guarantee %d — text', $i ) ), 'gvc_guarantees' );
	}

	/* ---------------------------------------------------------------------
	 * Newsletter
	 * ------------------------------------------------------------------ */
	$wp_customize->add_section(
		'gvc_newsletter',
		array(
			'title' => __( 'Newsletter', 'gv-craft' ),
			'panel' => 'gvc_panel',
		)
	);

	$gvc_add( 'newsletter_title', array( 'label' => __( 'Title', 'gv-craft' ) ), 'gvc_newsletter' );
	$gvc_add( 'newsletter_text', array( 'label' => __( 'Description', 'gv-craft' ) ), 'gvc_newsletter' );

	/* ---------------------------------------------------------------------
	 * Footer
	 * ------------------------------------------------------------------ */
	$wp_customize->add_section(
		'gvc_footer',
		array(
			'title' => __( 'Footer', 'gv-craft' ),
			'panel' => 'gvc_panel',
		)
	);

	$gvc_add( 'footer_about', array( 'label' => __( 'About text', 'gv-craft' ) ), 'gvc_footer' );
	$gvc_add( 'footer_address', array( 'label' => __( 'Address line', 'gv-craft' ) ), 'gvc_footer' );
	$gvc_add( 'footer_copyright', array( 'label' => __( 'Copyright line', 'gv-craft' ) ), 'gvc_footer' );
	$gvc_add( 'footer_engineering', array( 'label' => __( 'Engineering blurb', 'gv-craft' ) ), 'gvc_footer' );
	$gvc_add( 'footer_phone', array( 'label' => __( 'Phone', 'gv-craft' ) ), 'gvc_footer' );
	$gvc_add( 'footer_email', array( 'label' => __( 'Email', 'gv-craft' ), 'sanitize' => 'sanitize_email' ), 'gvc_footer' );

	/* ---------------------------------------------------------------------
	 * Social
	 * ------------------------------------------------------------------ */
	$wp_customize->add_section(
		'gvc_social',
		array(
			'title' => __( 'Social Profiles', 'gv-craft' ),
			'panel' => 'gvc_panel',
		)
	);

	foreach ( array( 'facebook', 'instagram', 'linkedin', 'twitter', 'youtube' ) as $network ) {
		$gvc_add( 'social_' . $network, array( 'label' => ucfirst( $network ) . ' URL' ), 'gvc_social', 'url' );
	}

	/* ---------------------------------------------------------------------
	 * Colours
	 * ------------------------------------------------------------------ */
	$wp_customize->add_section(
		'gvc_colors',
		array(
			'title' => __( 'Accent Colours', 'gv-craft' ),
			'panel' => 'gvc_panel',
		)
	);

	$wp_customize->add_setting(
		'gvc_accent',
		array(
			'default'           => '#40916C',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'gvc_accent',
			array(
				'label'   => __( 'Accent colour', 'gv-craft' ),
				'section' => 'gvc_colors',
			)
		)
	);

	$wp_customize->add_setting(
		'gvc_accent_contrast',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'gvc_accent_contrast',
			array(
				'label'   => __( 'Accent text colour', 'gv-craft' ),
				'section' => 'gvc_colors',
			)
		)
	);
}
add_action( 'customize_register', 'gvc_customize_register' );

/**
 * Checkbox sanitiser.
 *
 * @param mixed $checked Raw value.
 * @return bool
 */
function gvc_sanitize_checkbox( $checked ) {
	return ( isset( $checked ) && true === (bool) $checked );
}

/**
 * Post-message JS for live preview.
 */
function gvc_customize_preview_data() {
	wp_localize_script(
		'gv-craft-customizer',
		'gvcCustomize',
		array(
			'heroTitle'   => 'gvc_hero_title',
			'heroAccent'  => 'gvc_hero_title_accent',
			'heroText'    => 'gvc_hero_text',
			'catsTitle'   => 'gvc_cats_title',
			'catsText'    => 'gvc_cats_text',
			'featuredT'   => 'gvc_featured_title',
			'featuredX'   => 'gvc_featured_text',
			'impactTitle' => 'gvc_impact_title',
			'impactText'  => 'gvc_impact_text',
			'guildTitle'  => 'gvc_guild_title',
			'guildText'   => 'gvc_guild_text',
			'newsTitle'   => 'gvc_newsletter_title',
			'newsText'    => 'gvc_newsletter_text',
			'footerAbout' => 'gvc_footer_about',
		)
	);
}
add_action( 'customize_preview_init', 'gvc_customize_preview_data' );
