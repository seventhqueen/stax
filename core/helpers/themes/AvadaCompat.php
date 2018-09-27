<?php
/**
 * Avada theme compatibility.
 *
 * @package Stax
 */

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class AvadaCompat
 *
 * @package Stax
 */
class AvadaCompat implements CompatibleTheme {

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
		remove_all_actions( 'avada_header', 20 );
		add_action( 'avada_header', [ Plugin::instance(), 'the_header_html' ] );
	}

	/**
	 * Compatibility tag for the current theme header
	 *
	 * @return string
	 */
	public function get_tag() {
		return '.fusion-header-wrapper';
	}
}
