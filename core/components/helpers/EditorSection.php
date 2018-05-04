<?php
/**
 * EditorSection.
 *
 * @package Stax
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since 1.0
 */

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class EditorSection extends ElementSpecs {
	/**
	 * @var mixed
	 */
	/**
	 * @var mixed|string
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
	/**
	 * @var array|bool|mixed|string
	 */
	public
		$name,
		$title,
		$visibility,
		$type,
		$state,
		$fields,
		$icon,
		$free;

	/**
	 * EditorSection constructor.
	 *
	 * @param array $property
	 */
	public function __construct( array $property ) {
		$this->title      = isset( $property['title'] ) ? $property['title'] : 'Options';
		$this->name       = $property['name'];
		$this->type       = isset( $property['type'] ) ? $property['type'] : 'default';
		$this->visibility = isset( $property['visibility'] ) ? $property['visibility'] : true;
		$this->state      = isset( $property['state'] ) ? $property['state'] : false;
		$this->fields     = [];
		$this->icon       = 'mdi-options';
		$this->free       = isset( $property['free'] ) ? $property['free'] : true;
	}

	/**
	 * @param EditorSectionField $field
	 */
	public function addField( EditorSectionField $field ) {
		$this->fields[] = $field;
	}
}
