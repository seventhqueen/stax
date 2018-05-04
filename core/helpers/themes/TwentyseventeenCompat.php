<?php
/**
 * Twentyseventeen theme compatibility.
 *
 * @package Stax
 */

namespace Stax;


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
