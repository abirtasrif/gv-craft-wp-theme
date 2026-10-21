<?php
/**
 * The search form.
 *
 * @package GV_Craft
 */

defined( 'ABSPATH' ) || exit;

$gvc_id = 'gvc-search-' . wp_rand( 100, 999 );
?>
<form role="search" method="get" class="gvc-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="<?php echo esc_attr( $gvc_id ); ?>"><?php esc_html_e( 'Search for:', 'gv-craft' ); ?></label>
	<input type="search" id="<?php echo esc_attr( $gvc_id ); ?>" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Search craft, weave, clay…', 'gv-craft' ); ?>" />
	<button type="submit" class="screen-reader-text"><?php esc_html_e( 'Search', 'gv-craft' ); ?></button>
</form>
