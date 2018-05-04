<?php
/**
 * Composer.
 *
 * @package Stax
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since 1.0
 */

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Composer {
	/**
	 * @var array
	 */
	public $elements = [];

	/**
	 * @param Element $element
	 */
	public function registerElement( Element $element ) {
		$sanitizer = new Sanitizer( $element );
		$sanitizer->check();

		$this->elements[ $element->slug ] = $element;
	}
}
