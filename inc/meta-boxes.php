<?php
/**
 * GV Craft by JarvanIT — product meta boxes for the eco story fields.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the "Eco Story" product meta box.
 */
function gvc_add_product_meta_box() {
	add_meta_box(
		'gvc_eco_story',
		__( 'GV Craft — Eco Story', 'gv-craft' ),
		'gvc_render_eco_meta_box',
		'product',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'gvc_add_product_meta_box' );

/**
 * Render the meta box.
 *
 * @param WP_Post $post Product post.
 */
function gvc_render_eco_meta_box( $post ) {
	wp_nonce_field( 'gvc_save_eco_meta', 'gvc_eco_meta_nonce' );

	$fields = array(
		'badges'      => array(
			'label' => __( 'Eco badges (separate with |)', 'gv-craft' ),
			'type'  => 'text',
			'help'  => __( 'Example: 100% Organic|Plastic-Free|Fair Trade', 'gv-craft' ),
		),
		'guild'       => array(
			'label' => __( 'Artisan guild / origin', 'gv-craft' ),
			'type'  => 'text',
			'help'  => __( 'Example: Bengal Craft Guild', 'gv-craft' ),
		),
		'batch'       => array(
			'label' => __( 'Traceability batch number', 'gv-craft' ),
			'type'  => 'text',
		),
		'impact_1'    => array(
			'label' => __( 'Impact metric 1 (value | label)', 'gv-craft' ),
			'type'  => 'text',
			'help'  => __( 'Example: 3.2 kg | Ocean plastic diverted', 'gv-craft' ),
		),
		'impact_2'    => array(
			'label' => __( 'Impact metric 2 (value | label)', 'gv-craft' ),
			'type'  => 'text',
		),
		'impact_3'    => array(
			'label' => __( 'Impact metric 3 (value | label)', 'gv-craft' ),
			'type'  => 'text',
		),
		'material'    => array(
			'label' => __( 'Material story', 'gv-craft' ),
			'type'  => 'textarea',
		),
		'colorways'   => array(
			'label' => __( 'Colourways (name | hex | hex | name | hex | hex)', 'gv-craft' ),
			'type'  => 'text',
			'help'  => __( 'Example: Botanical Moss & Cream | #3d654c | #f4f2ec', 'gv-craft' ),
		),
		'provenance'  => array(
			'label' => __( 'Provenance image URL', 'gv-craft' ),
			'type'  => 'url',
		),
		'craft_hours' => array(
			'label' => __( 'Hours of hand craft', 'gv-craft' ),
			'type'  => 'text',
		),
	);

	echo '<style>.gvc-meta-field{margin-bottom:14px}.gvc-meta-field label{display:block;font-weight:600;margin-bottom:4px}.gvc-meta-field input[type=text],.gvc-meta-field input[type=url],.gvc-meta-field textarea{width:100%}.gvc-meta-field p.help{margin:4px 0 0;font-size:12px;color:#717973}</style>';

	foreach ( $fields as $key => $field ) {
		$value = get_post_meta( $post->ID, '_gvc_' . $key, true );

		echo '<div class="gvc-meta-field">';
		echo '<label for="gvc_' . esc_attr( $key ) . '">' . esc_html( $field['label'] ) . '</label>';

		if ( 'textarea' === $field['type'] ) {
			echo '<textarea id="gvc_' . esc_attr( $key ) . '" name="gvc_' . esc_attr( $key ) . '" rows="4">' . esc_textarea( $value ) . '</textarea>';
		} else {
			echo '<input type="' . esc_attr( $field['type'] ) . '" id="gvc_' . esc_attr( $key ) . '" name="gvc_' . esc_attr( $key ) . '" value="' . esc_attr( $value ) . '" />';
		}

		if ( ! empty( $field['help'] ) ) {
			echo '<p class="help">' . esc_html( $field['help'] ) . '</p>';
		}

		echo '</div>';
	}
}

/**
 * Save the eco meta fields.
 *
 * @param int $post_id Product ID.
 */
function gvc_save_eco_meta( $post_id ) {
	if ( ! isset( $_POST['gvc_eco_meta_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['gvc_eco_meta_nonce'] ) ), 'gvc_save_eco_meta' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$keys = array( 'badges', 'guild', 'batch', 'impact_1', 'impact_2', 'impact_3', 'material', 'colorways', 'provenance', 'craft_hours' );

	foreach ( $keys as $key ) {
		if ( ! isset( $_POST[ 'gvc_' . $key ] ) ) {
			continue;
		}

		$raw = wp_unslash( $_POST[ 'gvc_' . $key ] ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized

		if ( 'provenance' === $key ) {
			$value = esc_url_raw( $raw );
		} elseif ( 'material' === $key ) {
			$value = wp_kses_post( $raw );
		} else {
			$value = sanitize_text_field( $raw );
		}

		if ( '' === $value ) {
			delete_post_meta( $post_id, '_gvc_' . $key );
		} else {
			update_post_meta( $post_id, '_gvc_' . $key, $value );
		}
	}
}
add_action( 'save_post_product', 'gvc_save_eco_meta' );

/**
 * Add eco columns to the products list table.
 *
 * @param array $columns Columns.
 * @return array
 */
function gvc_product_admin_columns( $columns ) {
	$new = array();

	foreach ( $columns as $key => $label ) {
		$new[ $key ] = $label;

		if ( 'price' === $key ) {
			$new['gvc_guild'] = __( 'Guild', 'gv-craft' );
			$new['gvc_eco']   = __( 'Eco badges', 'gv-craft' );
		}
	}

	return $new;
}
add_filter( 'manage_edit-product_columns', 'gvc_product_admin_columns', 20 );

/**
 * Render the eco columns.
 *
 * @param string $column  Column key.
 * @param int    $post_id Product ID.
 */
function gvc_product_admin_column_content( $column, $post_id ) {
	if ( 'gvc_guild' === $column ) {
		echo esc_html( get_post_meta( $post_id, '_gvc_guild', true ) );
	}

	if ( 'gvc_eco' === $column ) {
		$badges = get_post_meta( $post_id, '_gvc_badges', true );

		if ( $badges ) {
			echo esc_html( str_replace( '|', ', ', $badges ) );
		} else {
			echo '—';
		}
	}
}
add_action( 'manage_product_posts_custom_column', 'gvc_product_admin_column_content', 10, 2 );
