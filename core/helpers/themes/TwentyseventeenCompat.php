<?php
/**
 * Twentyseventeen theme compatibility.
 *
 * @package Stax
 */

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class TwentyseventeenCompat implements CompatibleTheme {

	/**
	 * @return bool
	 */
	public function is_front_compatible() {
		return false;
	}

	/**
	 *
	 */
	public function front_actions() {}

	/**
	 * @return string
	 */
	public function get_tag() {
		return '#masthead';
	}
}
