<?php
/**
 * Quantity input.
 *
 * Compatible with the WooCommerce 10.1+ template variables.
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

$gvc_args       = isset( $args ) && is_array( $args ) ? $args : array();
$gvc_product_name = isset( $gvc_args['product_name'] ) ? $gvc_args['product_name'] : '';
$gvc_label      = ! empty( $gvc_args['product_name'] )
	? sprintf( /* translators: %s: product name. */ esc_html__( '%s quantity', 'gv-craft' ), wp_strip_all_tags( $gvc_args['product_name'] ) )
	: esc_html__( 'Quantity', 'gv-craft' );

$gvc_input_id  = isset( $input_id ) ? $input_id : uniqid( 'quantity_' );
$gvc_input_name = isset( $input_name ) ? $input_name : 'quantity';
$gvc_value     = isset( $input_value ) ? $input_value : '1';
$gvc_max       = isset( $max_value ) ? $max_value : 0;
$gvc_min       = isset( $min_value ) ? $min_value : 0;
$gvc_step      = isset( $step ) ? $step : 1;
$gvc_placeholder = isset( $placeholder ) ? $placeholder : '';
$gvc_type      = isset( $type ) ? $type : 'text';
$gvc_readonly  = ! empty( $readonly );
$gvc_classes   = isset( $classes ) ? (array) $classes : array( 'input-text', 'qty', 'text' );
$gvc_inputmode = isset( $inputmode ) ? $inputmode : 'numeric';
$gvc_autocomplete = isset( $autocomplete ) ? $autocomplete : 'on';

if ( $gvc_max && $gvc_min === $gvc_max ) {
	?>
	<div class="quantity hidden">
		<input type="hidden" id="<?php echo esc_attr( $gvc_input_id ); ?>" class="qty" name="<?php echo esc_attr( $gvc_input_name ); ?>" value="<?php echo esc_attr( $gvc_min ); ?>" />
	</div>
	<?php
	return;
}
?>
<div class="quantity gvc-qty">
	<?php do_action( 'woocommerce_before_quantity_input_field' ); ?>

	<button type="button" class="gvc-qty__minus" aria-label="<?php esc_attr_e( 'Decrease quantity', 'gv-craft' ); ?>" data-gvc-qty="minus">&minus;</button>

	<label class="screen-reader-text" for="<?php echo esc_attr( $gvc_input_id ); ?>"><?php echo esc_html( $gvc_label ); ?></label>
	<input
		type="<?php echo esc_attr( $gvc_type ); ?>"
		<?php echo $gvc_readonly ? 'readonly="readonly"' : ''; ?>
		id="<?php echo esc_attr( $gvc_input_id ); ?>"
		class="<?php echo esc_attr( join( ' ', array_filter( $gvc_classes ) ) ); ?>"
		name="<?php echo esc_attr( $gvc_input_name ); ?>"
		value="<?php echo esc_attr( $gvc_value ); ?>"
		aria-label="<?php echo esc_attr( $gvc_label ); ?>"
		size="4"
		min="<?php echo esc_attr( $gvc_min ); ?>"
		<?php if ( 0 < $gvc_max ) : ?>
			max="<?php echo esc_attr( $gvc_max ); ?>"
		<?php endif; ?>
		<?php if ( ! $gvc_readonly ) : ?>
			step="<?php echo esc_attr( $gvc_step ); ?>"
			placeholder="<?php echo esc_attr( $gvc_placeholder ); ?>"
			inputmode="<?php echo esc_attr( $gvc_inputmode ); ?>"
			autocomplete="<?php echo esc_attr( $gvc_autocomplete ); ?>"
		<?php endif; ?>
	/>

	<button type="button" class="gvc-qty__plus" aria-label="<?php esc_attr_e( 'Increase quantity', 'gv-craft' ); ?>" data-gvc-qty="plus">+</button>

	<?php do_action( 'woocommerce_after_quantity_input_field' ); ?>
</div>
