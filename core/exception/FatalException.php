<?php
/**
 * FatalException.
 *
 * @package Stax
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since 1.0
 */

namespace Stax;

class FatalException extends \Exception {
	/**
	 * FatalException constructor.
	 *
	 * @param $message
	 * @param int $code
	 */
	public function __construct( $message, $code = 0 ) {
		parent::__construct( $message, $code );
	}

	/**
	 * @return string
	 */
	public function __toString() {
		return __CLASS__ . ": [{$this->code}]: {$this->message}";
	}
}
