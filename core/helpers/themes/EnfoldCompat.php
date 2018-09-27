<?php
/**
 * Enfold theme compatibility.
 *
 * @package Stax
 */

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class EnfoldCompat
 *
 * @package Stax
 */
class EnfoldCompat implements CompatibleTheme {

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
		add_filter( 'avf_header_setting_filter', function( $header ) {
			$header['disabled'] = true;

			return $header;
		});

		global $stax_header_rendered;
		$stax_header_rendered = false;

		add_action( 'get_template_part_includes/helper', function( $slug, $name ) {
			if ( 'main-menu' === $name ) {
				global $stax_header_rendered;
				if ( false === $stax_header_rendered ) {
					$stax_header_rendered = true;
					Plugin::instance()->the_header_html();
				}
			}
		}, 10, 2 );
	}

	/**
	 * Compatibility tag for the current theme header
	 *
	 * @return string
	 */
	public function get_tag() {
		return '#header';
	}
}
