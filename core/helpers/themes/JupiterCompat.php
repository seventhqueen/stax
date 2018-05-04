<?php
/**
 * Jupiter theme compatibility.
 *
 * @package Stax
 */

namespace Stax;

/**
 * Class JupiterCompat
 *
 * @package Stax
 */
class JupiterCompat implements CompatibleTheme {

	/**
	 * Whether is compatible on front-end area.
	 *
	 * @return bool
	 */
	public function is_front_compatible() {
		return true;
	}

	/**
	 * Actions to perform when is front compatible
	 */
	public function front_actions() {

		add_filter( 'get_header_style', function( $style ) {
			$style = 'custom';

			return $style;
		}, 999 );
		add_action('wp_head', function() {
			remove_all_actions( 'hb_grid_markup' );
			add_action( 'hb_grid_markup', [ Plugin::instance(), 'the_header_html' ] );
		});

	}

	/**
	 * Compatibility tag for the current theme header
	 *
	 * @return string
	 */
	public function get_tag() {
		return '.l-header';
	}
}
