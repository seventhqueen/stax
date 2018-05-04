<?php
/**
 * Impreza theme compatibility.
 *
 * @package Stax
 */

namespace Stax;

/**
 * Class ImprezaCompat
 *
 * @package Stax
 */
class ImprezaCompat implements CompatibleTheme {

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

		add_action( 'us_before_header', function () {
			if ( class_exists( 'US_Layout' ) ) {
				$us_layout              = \US_Layout::instance();
				$us_layout->header_show = 'never';
			}
		} );
		add_action( 'us_after_header', [ Plugin::instance(), 'the_header_html' ] );
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
