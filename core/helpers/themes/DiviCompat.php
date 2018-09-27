<?php
/**
 * Divi theme compatibility.
 *
 * @package Stax
 */

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class DiviCompat
 *
 * @package Stax
 */
class DiviCompat implements CompatibleTheme {

	/**
	 * Whether is compatible on front-end area.
	 *
	 * @return bool
	 */
	public function is_front_compatible() {
		return false;
	}

	/**
	 * Actions to perform when is front compatible
	 */
	public function front_actions() {}

	/**
	 * Compatibility tag for the current theme header
	 *
	 * @return string
	 */
	public function get_tag() {
		return '#main-header';
	}
}
