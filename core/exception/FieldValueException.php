<?php
/**
 * FieldValueException.
 *
 * @package Stax
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since 1.0
 */

namespace Stax;

class FieldValueException extends \Exception {
	/**
	 * FieldValueException constructor.
	 *
	 * @param $type
	 * @param $element
	 */
	public function __construct( $type, $element ) {
		parent::__construct( 'Value of "' . $element . '" must be type of ' . $type, 101 );
	}

	/**
	 * @return string
	 */
	public function __toString() {
		return __CLASS__ . ": [{$this->code}]: {$this->message}";
	}
}
