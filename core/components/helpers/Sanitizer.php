<?php
/**
 * Sanitizer.
 *
 * @package Stax
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since 1.0
 */

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sanitizer extends ElementSpecs {
	const
		TYPE_STRING = 'string',
		TYPE_ARRAY = 'array',
		TYPE_NUMERIC = 'numeric',
		TYPE_BOOL = 'boolean';

	/**
	 * @var array
	 */
	protected $fieldTypes = [
		self::FIELD_COLOR_PICKER,
		self::FIELD_BORDER_RADIUS,
		self::FIELD_DROPDOWN,
		self::FIELD_DROPDOWN_MENU,
		self::FIELD_INPUT_TEXT,
		self::FIELD_RADIO,
		self::FIELD_ICON,
		self::FIELD_CHECKBOX,
		self::FIELD_INPUT_URL,
		self::FIELD_INPUT_NUMBER,
		self::FIELD_SLIDER,
		self::FIELD_IMAGE,
		self::FIELD_SPACING,
		self::FIELD_SWITCH,
		self::FIELD_SEPARATOR,
		self::FIELD_TEXT_EDITOR,
		self::FIELD_TEXT_AREA,
		self::FIELD_FONT_FAMILY,
		self::FIELD_SHADOW,
		self::FIELD_DOUBLE_INPUT,
		self::FIELD_TABS,
		self::FIELD_GO_PRO
	];

	/**
	 * @var array
	 */
	protected $editTypes = [
		self::EDIT_HREF,
		self::EDIT_SRC,
		self::EDIT_INNER,
		self::EDIT_STYLE,
		self::EDIT_CSS,
		self::EDIT_FONT,
		self::EDIT_CLASS,
		self::EDIT_ID,
		self::EDIT_AFTER_BEGIN,
		self::EDIT_BEFORE_END,
		self::EDIT_SHORTCODE
	];

	/**
	 * @var Element
	 */
	protected $element;


	/**
	 * Sanitizer constructor.
	 *
	 * @param Element $element
	 */
	public function __construct( Element $element ) {
		$this->element = $element;
	}

	/**
	 * @throws FatalException
	 */
	public function check() {
		$this->checkValues();
		$this->checkProperties();
	}

	/**
	 * @throws FieldValueException
	 * @throws MissingException
	 */
	protected function checkValues() {
		foreach ( $this->element->editor as $section ) {
			foreach ( $section->fields as $field ) {
				switch ( $field->type ) {
					case self::FIELD_COLOR_PICKER:
						if ( ! is_string( $field->value ) ) {
							self::valueTypeError( self::TYPE_STRING, self::FIELD_COLOR_PICKER );
						}
						break;
					case self::FIELD_BORDER_RADIUS:
						if ( ! is_array( $field->value ) ) {
							self::valueTypeError( self::TYPE_ARRAY, self::FIELD_BORDER_RADIUS );
						}

						$records = count( $field->value );
						if ( $records != 4 ) {
							self::missingError( self::FIELD_BORDER_RADIUS );
						}

						break;
					case self::FIELD_DROPDOWN:
						if ( ! is_array( $field->value ) ) {
							self::valueTypeError( self::TYPE_ARRAY, self::FIELD_DROPDOWN );
						}

						foreach ( $field->value as $item ) {
							if ( ! is_array( $item ) ) {
								self::valueTypeError( self::TYPE_ARRAY, self::FIELD_DROPDOWN );
							}

							if ( ! isset( $item['label'] ) ||
							     ! isset( $item['value'] ) ||
							     ! isset( $item['extra'] ) ||
							     ! isset( $item['selected'] ) ||
							     ! isset( $item['trigger'] )
							) {
								self::missingError( self::FIELD_DROPDOWN );
							}

							if ( ! is_string( $item['label'] ) ) {
								self::valueTypeError( self::TYPE_STRING, self::FIELD_DROPDOWN );
							}

							if ( ! is_array( $item['extra'] ) ) {
								self::valueTypeError( self::TYPE_ARRAY, self::FIELD_DROPDOWN );
							}

							foreach ( $item['extra'] as $k => $value ) {
								if ( ! is_string( $value ) ) {
									self::valueTypeError( self::TYPE_STRING, self::FIELD_DROPDOWN );
								}
							}

							if ( ! is_bool( $item['selected'] ) ) {
								self::valueTypeError( self::TYPE_BOOL, self::FIELD_DROPDOWN );
							}

							if ( ! is_array( $item['trigger'] ) ) {
								self::valueTypeError( self::TYPE_ARRAY, self::FIELD_DROPDOWN );
							}

							foreach ( $item['trigger'] as $k => $value ) {
								if ( ! in_array( $k, [ 'section', 'field' ] ) ) {
									self::missingError( self::FIELD_DROPDOWN );
								}

								if ( ! is_array( $value ) ) {
									self::valueTypeError( self::TYPE_ARRAY, self::FIELD_DROPDOWN );
								}
							}
						}
						break;
					case self::FIELD_INPUT_TEXT:
						if ( ! is_string( $field->value ) ) {
							self::valueTypeError( self::TYPE_STRING, self::FIELD_INPUT_TEXT );
						}
						break;
					case self::FIELD_ICON:
						if ( ! is_string( $field->value ) ) {
							self::valueTypeError( self::TYPE_STRING, self::FIELD_ICON );
						}
						break;
					case self::FIELD_RADIO:
						if ( ! is_array( $field->value ) ) {
							self::valueTypeError( self::TYPE_ARRAY, self::FIELD_RADIO );
						}
						break;
					case self::FIELD_CHECKBOX:
						if ( ! is_array( $field->value ) ) {
							self::valueTypeError( self::TYPE_ARRAY, self::FIELD_CHECKBOX );
						}
						break;
					case self::FIELD_INPUT_URL:
						if ( ! is_string( $field->value ) ) {
							self::valueTypeError( self::TYPE_STRING, self::FIELD_INPUT_URL );
						}
						break;
					case self::FIELD_SLIDER:
						if ( ! is_string( $field->value ) ) {
							self::valueTypeError( self::TYPE_STRING, self::FIELD_SLIDER );
						}
						break;
					case self::FIELD_IMAGE:
						if ( ! is_string( $field->value ) ) {
							self::valueTypeError( self::TYPE_STRING, self::FIELD_IMAGE );
						}
						break;
					default:
				}
			}
		}
	}

	/**
	 * @throws FatalException
	 */
	protected function checkProperties() {
		foreach ( $this->element->editor as $section ) {
			foreach ( $section->fields as $field ) {
				if ( ! is_string( $field->label ) ||
				     ! is_string( $field->type ) ||
				     ! is_string( $field->controller ) ||
				     ! is_string( $field->edit )
				) {
					throw new FatalException( 'Invalid field type.' );
				}

				if ( ! is_array( $field->selector ) ) {
					throw new FatalException( 'Invalid field type.' );
				}

				if ( ! in_array( $field->type, $this->fieldTypes ) ) {
					throw new FatalException( 'Invalid field value.' );
				}

				/*				if ( ! in_array( $field->edit, $this->editTypes ) ) {
									throw new FatalException( 'Invalid field value.' );
								}*/
			}
		}
	}

	/**
	 * @param $type
	 * @param $element
	 *
	 * @throws FieldValueException
	 */
	public static function valueTypeError( $type, $element ) {
		throw new FieldValueException( $type, $element );
	}

	/**
	 * @param $element
	 *
	 * @throws MissingException
	 */
	public static function missingError( $element ) {
		throw new MissingException( $element );
	}
}
