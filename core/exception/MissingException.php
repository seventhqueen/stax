<?php
/**
 * MissingException.
 *
 * @package Stax
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since 1.0
 */

namespace Stax;

class MissingException extends \Exception {
	/**
	 * MissingException constructor.
	 *
	 * @param $element
	 */
	public function __construct( $element ) {
		parent::__construct( 'Value of "' . $element . '" is missing a property', 102 );
	}

	/**
	 * @return string
	 */
	public function __toString() {
		return __CLASS__ . ": [{$this->code}]: {$this->message}";
	}
}
