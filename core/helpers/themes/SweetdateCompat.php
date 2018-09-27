<?php
/**
 * SweetDate theme compatibility.
 *
 * @package Stax
 */

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class SweetdateCompat implements CompatibleTheme {

	/**
	 * @return bool
	 */
	public function is_front_compatible() {
		if ( defined( 'SQUEEN_THEME_VERSION' ) && version_compare( SQUEEN_THEME_VERSION, '3.4', '>=' ) ) {
			return true;
		}
		return false;
	}

	/**
	 *
	 */
	public function front_actions() {
		remove_action( 'sweetdate_header', 'sweetdate_show_header' );
		add_action( 'sweetdate_header', [ Plugin::instance(), 'the_header_html' ] );
	}

	/**
	 * @return string
	 */
	public function get_tag() {
		return 'header';
	}
}
