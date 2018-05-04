<?php
/**
 * EditorSectionField.
 *
 * @package Stax
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since 1.0
 */

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Stax\Exception\FieldValueException;
use Stax\Exception\MissingException;
use Stax\Exception\FatalException;

class EditorSectionField extends ElementSpecs {
	/**
	 * @var bool|string
	 */
	/**
	 * @var bool|mixed|string
	 */
	/**
	 * @var bool|mixed|string
	 */
	/**
	 * @var bool|mixed|string
	 */
	/**
	 * @var bool|mixed|string
	 */
	/**
	 * @var bool|mixed|string
	 */
	/**
	 * @var bool|mixed|string
	 */
	/**
	 * @var bool|mixed|string
	 */
	/**
	 * @var bool|mixed|string
	 */
	/**
	 * @var bool|mixed|string
	 */
	/**
	 * @var bool|mixed|string
	 */
	/**
	 * @var array|bool|mixed|string
	 */
	public
		$id,
		$name,
		$visibility,
		$label,
		$type,
		$controller,
		$edit,
		$selector,
		$value,
		$units,
		$tooltip,
		$editorClass;

	/**
	 * EditorSectionField constructor.
	 *
	 * @param array $props
	 */
	public function __construct( array $props ) {
		$this->id          = substr( number_format( time() * rand(), 0, '', '' ), 0, 6 );
		$this->name        = $props['name'];
		$this->visibility  = $props['visibility'];
		$this->label       = $props['label'];
		$this->type        = $props['type'];
		$this->controller  = $props['controller'];
		$this->edit        = $props['edit'];
		$this->selector    = $props['selector'];
		$this->value       = $props['value'];
		$this->units       = $props['units'];
		$this->tooltip     = $props['tooltip'];
		$this->editorClass = isset( $props['editorClass'] ) ? $props['editorClass'] : [];
	}
}
