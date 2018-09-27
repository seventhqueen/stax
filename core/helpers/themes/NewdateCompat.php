<?php
/**
 * NewDate theme compatibility.
 *
 * @package Stax
 */

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NewdateCompat implements CompatibleTheme {

	/**
	 * @return bool
	 */
	public function is_front_compatible() {
		return true;
	}

	/**
	 *
	 */
	public function front_actions() {
		remove_action( 'kleo_header', 'kleo_show_header', 12 );
		add_action( 'kleo_header', [ Plugin::instance(), 'the_header_html' ], 12 );
	}

	/**
	 * @return string
	 */
	public function get_tag() {
		return '#header';
	}
}
