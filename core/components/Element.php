<?php
/**
 * Element component.
 *
 * @package Stax
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since 1.0
 */

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Element extends ElementSpecs {
	const
		ADVANCED_FULL_WIDTH = 'advanced-full-width-field',
		ADVANCED_FULL_HEIGHT = 'advanced-full-height-field',
		ADVANCED_PADDING = 'padding-field-advanced',
		ADVANCED_MARGIN = 'margin-field-advanced',
		ADVANCED_BORDER_RADIUS = 'border-radius-field-advanced',
		ADVANCED_CSS_ID = 'css-id-field-advanced',
		ADVANCED_BG_NORMAL = 'bg-color-normal-field-advanced',
		ADVANCED_BORDER_TYPE_NORMAL = 'border-normal-field-advanced',
		ADVANCED_BORDER_WIDTH_NORMAL = 'border-normal-width-field-advanced',
		ADVANCED_BORDER_COLOR_NORMAL = 'border-normal-color-field-advanced',
		ADVANCED_BG_HOVER = 'bg-color-hover-field-advanced',
		ADVANCED_BORDER_TYPE_HOVER = 'border-hover-field-advanced',
		ADVANCED_BORDER_WIDTH_HOVER = 'border-width-hover-field-advanced',
		ADVANCED_BORDER_COLOR_HOVER = 'border-hover-color-field-advanced';

	/**
	 * @var string
	 */
	/**
	 * @var string
	 */
	/**
	 * @var string
	 */
	/**
	 * @var string
	 */
	/**
	 * @var object|string
	 */
	/**
	 * @var object|string
	 */
	/**
	 * @var object|string
	 */
	/**
	 * @var object|string
	 */
	/**
	 * @var object|string
	 */
	/**
	 * @var object|string
	 */
	/**
	 * @var object|string
	 */
	/**
	 * @var bool|object|string
	 */
	/**
	 * @var bool|object|string
	 */
	/**
	 * @var bool|object|string
	 */
	/**
	 * @var bool|object|string
	 */
	/**
	 * @var bool|object|string
	 */
	/**
	 * @var bool|object|string
	 */
	/**
	 * @var array|bool|object|string
	 */
	/**
	 * @var array|bool|object|string
	 */
	/**
	 * @var array|bool|object|string
	 */
	/**
	 * @var array|bool|object|string
	 */
	/**
	 * @var array|bool|object|string
	 */
	/**
	 * @var array|bool|object|string
	 */
	/**
	 * @var array|bool|object|string
	 */
	/**
	 * @var array|bool|object|string
	 */
	public
		$name,
		$slug,
		$type,
		$uuid,
		$icon,
		$template,
		$builder,
		$frontend,
		$css,
		$js,
		$authOption,
		$visibilityDesktop,
		$visibilityTablet,
		$visibilityMobile,
		$customDesktop,
		$customTablet,
		$customMobile,
		$editor,
		$desktop,
		$tablet,
		$mobile,
		$generalCSS,
		$desktopCSS,
		$tabletCSS,
		$mobileCSS;

	/**
	 * Element constructor.
	 */
	public function __construct() {
		$this->name              = '';
		$this->slug              = '';
		$this->type              = 'element';
		$this->uuid              = '';
		$this->icon              = (object) [
			'size'  => '',
			'type'  => '',
			'color' => ''
		];
		$this->template          = '';
		$this->builder           = '';
		$this->frontend          = '';
		$this->css               = '';
		$this->js                = '';
		$this->authOption        = '';
		$this->visibilityDesktop = true;
		$this->visibilityTablet  = true;
		$this->visibilityMobile  = true;
		$this->customDesktop     = false;
		$this->customTablet      = false;
		$this->customMobile      = false;
		$this->editor            = [];
		$this->desktop           = [];
		$this->tablet            = [];
		$this->mobile            = [];
		$this->generalCSS        = '';
		$this->desktopCSS        = '';
		$this->tabletCSS         = '';
		$this->mobileCSS         = '';

		$this->advancedEditor();
	}

	/**
	 * @param EditorSection $section
	 * @param array $fields
	 */
	protected function addSection( EditorSection $section, array $fields ) {
		foreach ( $fields as $field ) {
			$section->addField( $field );
		}

		$this->editor[] = $section;
	}

	/**
	 * @param array $fields
	 */
	protected function setBoxDefaults( array $fields ) {
		foreach ( $this->editor as $x => $group ) {
			if ( is_numeric( $x ) ) {
				continue;
			}

			foreach ( $this->editor[ $x ]->fields as $key => $field ) {
				foreach ( $fields as $name => $props ) {
					if ( $name === $field->name ) {

						if ( isset( $props['visibility'] ) ) {
							$this->editor[ $x ]->fields[ $key ]->visibility = $props['visibility'];
						}

						if ( is_array( $field->value ) && is_array( $props['value'] ) &&
						     count( $field->value ) === count( $props['value'] ) ) {
							for ( $i = 0; $i < count( $field->value ); $i ++ ) {
								$this->editor[ $x ]->fields[ $key ]->value[ $i ]['value'] = $props['value'][ $i ];
							}
						} else if ( is_array( $field->value ) && ( is_string( $props['value'] ) || is_numeric( $props['value'] ) ) ) {
							foreach ( $field->value as $i => $value ) {
								if ( $value['value'] == $props['value'] ) {
									if ( isset( $this->editor[ $x ]->fields[ $key ]->value[ $i ]['selected'] ) ) {
										$this->editor[ $x ]->fields[ $key ]->value[ $i ]['selected'] = true;
									} else {
										$this->editor[ $x ]->fields[ $key ]->value[ $i ]['checked'] = true;
									}
								} else {
									if ( isset( $this->editor[ $x ]->fields[ $key ]->value[ $i ]['selected'] ) ) {
										$this->editor[ $x ]->fields[ $key ]->value[ $i ]['selected'] = false;
									} else {
										$this->editor[ $x ]->fields[ $key ]->value[ $i ]['checked'] = false;
									}
								}
							}
						} else if ( ( is_numeric( $field->value ) || is_string( $field->value ) ) && ( is_string( $props['value'] ) || is_numeric( $props['value'] ) ) ) {
							$this->editor[ $x ]->fields[ $key ]->value = $props['value'];
						}
					}
				}
			}
		}
	}

	/**
	 *
	 */
	private function advancedEditor() {
		$section_1 = new EditorSection( [
			'title' => 'Layout',
			'name'  => 'layout-advanced',
			'state' => false,
			'icon'  => 'mdi-advanced'
		] );

		$fields_1 = [];

		$fields_1[] = new EditorSectionField(
			[
				'label'       => 'Height:',
				'name'        => 'advanced-full-height-field',
				'visibility'  => true,
				'type'        => self::FIELD_RADIO,
				'controller'  => 'container',
				'edit'        => self::EDIT_CLASS,
				'value'       => [
					[
						'label'   => 'Auto',
						'value'   => '',
						'extra'   => [],
						'checked' => true,
						'trigger' => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'   => 'Full',
						'value'   => 'is-full-height',
						'extra'   => [],
						'checked' => false,
						'trigger' => [
							'section' => [],
							'field'   => []
						]
					]
				],
				'units'       => [],
				'selector'    => [],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_1[] = new EditorSectionField(
			[
				'label'       => 'Width:',
				'name'        => 'advanced-full-width-field',
				'visibility'  => true,
				'type'        => self::FIELD_RADIO,
				'controller'  => 'container',
				'edit'        => self::EDIT_CLASS,
				'value'       => [
					[
						'label'   => 'Auto',
						'value'   => '',
						'extra'   => [],
						'checked' => true,
						'trigger' => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'   => 'Full',
						'value'   => 'is-full-width',
						'extra'   => [],
						'checked' => false,
						'trigger' => [
							'section' => [],
							'field'   => []
						]
					]
				],
				'units'       => [],
				'selector'    => [],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_1[] = new EditorSectionField(
			[
				'label'       => 'Padding:',
				'name'        => 'padding-field-advanced',
				'visibility'  => true,
				'type'        => self::FIELD_SPACING,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => [
					[
						'position' => 'Top',
						'value'    => ''
					],
					[
						'position' => 'Right',
						'value'    => ''
					],
					[
						'position' => 'Bottom',
						'value'    => ''
					],
					[
						'position' => 'Left',
						'value'    => '',
					]
				],
				'units'       => [
					[
						'type'   => 'px',
						'active' => true
					],
					[
						'type'   => 'em',
						'active' => false
					],
					[
						'type'   => '%',
						'active' => false
					]
				],
				'selector'    => [
					'{{SELECTOR}}' => [
						'padding-top: {{VALUE_1}}{{UNIT}}',
						'padding-right: {{VALUE_2}}{{UNIT}}',
						'padding-bottom: {{VALUE_3}}{{UNIT}}',
						'padding-left: {{VALUE_4}}{{UNIT}}'
					]
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_1[] = new EditorSectionField(
			[
				'label'       => 'Margin:',
				'name'        => 'margin-field-advanced',
				'visibility'  => true,
				'type'        => self::FIELD_SPACING,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => [
					[
						'position' => 'Top',
						'value'    => ''
					],
					[
						'position' => 'Right',
						'value'    => ''
					],
					[
						'position' => 'Bottom',
						'value'    => ''
					],
					[
						'position' => 'Left',
						'value'    => ''
					]
				],
				'units'       => [
					[
						'type'   => 'px',
						'active' => true
					],
					[
						'type'   => 'em',
						'active' => false
					],
					[
						'type'   => '%',
						'active' => false
					]
				],
				'selector'    => [
					'{{SELECTOR}}' => [
						'margin-top: {{VALUE_1}}{{UNIT}}',
						'margin-right: {{VALUE_2}}{{UNIT}}',
						'margin-bottom: {{VALUE_3}}{{UNIT}}',
						'margin-left: {{VALUE_4}}{{UNIT}}'
					]
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_1[] = new EditorSectionField(
			[
				'label'       => 'Border radius:',
				'name'        => 'border-normal-radius-field-advanced',
				'visibility'  => true,
				'type'        => self::FIELD_BORDER_RADIUS,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => [
					[
						'value'    => '',
						'position' => 'Top left'
					],
					[
						'value'    => '',
						'position' => 'Top right'
					],
					[
						'value'    => '',
						'position' => 'Bottom right'
					],
					[
						'value'    => '',
						'position' => 'Bottom left'
					]
				],
				'units'       => [
					[
						'type'   => 'px',
						'active' => true
					],
					[
						'type'   => 'em',
						'active' => false
					],
					[
						'type'   => '%',
						'active' => false
					]
				],
				'selector'    => [
					'{{SELECTOR}}' => [
						'border-top-left-radius: {{VALUE_1}}{{UNIT}}',
						'border-top-right-radius: {{VALUE_2}}{{UNIT}}',
						'border-bottom-right-radius: {{VALUE_3}}{{UNIT}}',
						'border-bottom-left-radius: {{VALUE_4}}{{UNIT}}'
					]
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$section_2 = new EditorSection( [
			'title' => 'Normal style',
			'name'  => 'normal-style-advanced',
			'state' => false,
			'icon'  => 'mdi-advanced'
		] );

		$fields_2 = [];

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Shadow:',
				'name'        => 'shadow-field-advanced',
				'visibility'  => true,
				'type'        => self::FIELD_SHADOW,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => [
					[
						'position' => 'Color',
						'value'    => ''
					],
					[
						'position' => 'X',
						'value'    => ''
					],
					[
						'position' => 'Y',
						'value'    => ''
					],
					[
						'position' => 'Blur',
						'value'    => '',
					],
					[
						'position' => 'Spread',
						'value'    => '',
					]
				],
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}}' => [
						'-webkit-box-shadow: {{X}}{{UNIT}} {{Y}}{{UNIT}} {{BLUR}}{{UNIT}} {{SPREAD}}{{UNIT}} {{COLOR}}',
						'-moz-box-shadow: {{X}}{{UNIT}} {{Y}}{{UNIT}} {{BLUR}}{{UNIT}} {{SPREAD}}{{UNIT}} {{COLOR}}',
						'box-shadow: {{X}}{{UNIT}} {{Y}}{{UNIT}} {{BLUR}}{{UNIT}} {{SPREAD}}{{UNIT}} {{COLOR}}'
					]
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Background:',
				'name'        => 'bg-color-normal-field-advanced',
				'visibility'  => true,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}}' => 'background-color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Border type:',
				'name'        => 'border-normal-field-advanced',
				'visibility'  => true,
				'type'        => self::FIELD_DROPDOWN,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => [
					[
						'label'    => 'None',
						'value'    => '',
						'extra'    => [],
						'selected' => true,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => 'Solid',
						'value'    => 'solid',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => [
								'border-normal-width-field-advanced',
								'border-normal-color-field-advanced'
							]
						]
					],
					[
						'label'    => 'Double',
						'value'    => 'double',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => [
								'border-normal-width-field-advanced',
								'border-normal-color-field-advanced'
							]
						]
					],
					[
						'label'    => 'Dotted',
						'value'    => 'dotted',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => [
								'border-normal-width-field-advanced',
								'border-normal-color-field-advanced'
							]
						]
					],
					[
						'label'    => 'Dashed',
						'value'    => 'dashed',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => [
								'border-normal-width-field-advanced',
								'border-normal-color-field-advanced'
							]
						]
					]
				],
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}}' => 'border-style: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Border width:',
				'name'        => 'border-normal-width-field-advanced',
				'visibility'  => false,
				'type'        => self::FIELD_INPUT_NUMBER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '1',
				'units'       => [
					[
						'type'   => 'px',
						'active' => true
					]
				],
				'selector'    => [
					'{{SELECTOR}}' => 'border-width: {{VALUE}}{{UNIT}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Border color:',
				'name'        => 'border-normal-color-field-advanced',
				'visibility'  => false,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}}' => 'border-color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$section_3 = new EditorSection( [
			'title' => 'Hover style',
			'name'  => 'hover-style-advanced',
			'state' => false,
			'icon'  => 'mdi-advanced'
		] );

		$fields_3 = [];

		$fields_3[] = new EditorSectionField(
			[
				'label'       => 'Shadow:',
				'name'        => 'shadow-hover-field-advanced',
				'visibility'  => true,
				'type'        => self::FIELD_SHADOW,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => [
					[
						'position' => 'Color',
						'value'    => ''
					],
					[
						'position' => 'X',
						'value'    => ''
					],
					[
						'position' => 'Y',
						'value'    => ''
					],
					[
						'position' => 'Blur',
						'value'    => '',
					],
					[
						'position' => 'Spread',
						'value'    => '',
					]
				],
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}}:hover' => [
						'-webkit-box-shadow: {{X}}{{UNIT}} {{Y}}{{UNIT}} {{BLUR}}{{UNIT}} {{SPREAD}}{{UNIT}} {{COLOR}}',
						'-moz-box-shadow: {{X}}{{UNIT}} {{Y}}{{UNIT}} {{BLUR}}{{UNIT}} {{SPREAD}}{{UNIT}} {{COLOR}}',
						'box-shadow: {{X}}{{UNIT}} {{Y}}{{UNIT}} {{BLUR}}{{UNIT}} {{SPREAD}}{{UNIT}} {{COLOR}}'
					]
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_3[] = new EditorSectionField(
			[
				'label'       => 'Background:',
				'name'        => 'bg-color-hover-field-advanced',
				'visibility'  => true,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}}:hover' => 'background-color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_3[] = new EditorSectionField(
			[
				'label'       => 'Border type:',
				'name'        => 'border-hover-field-advanced',
				'visibility'  => true,
				'type'        => self::FIELD_DROPDOWN,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => [
					[
						'label'    => 'None',
						'value'    => '',
						'extra'    => [],
						'selected' => true,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => 'Solid',
						'value'    => 'solid',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => [
								'border-width-hover-field-advanced',
								'border-hover-color-field-advanced'
							]
						]
					],
					[
						'label'    => 'Double',
						'value'    => 'double',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => [
								'border-width-hover-field-advanced',
								'border-hover-color-field-advanced'
							]
						]
					],
					[
						'label'    => 'Dotted',
						'value'    => 'dotted',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => [
								'border-width-hover-field-advanced',
								'border-hover-color-field-advanced'
							]
						]
					],
					[
						'label'    => 'Dashed',
						'value'    => 'dashed',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => [
								'border-width-hover-field-advanced',
								'border-hover-color-field-advanced'
							]
						]
					]
				],
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}}:hover' => 'border-style: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_3[] = new EditorSectionField(
			[
				'label'       => 'Border width:',
				'name'        => 'border-width-hover-field-advanced',
				'visibility'  => false,
				'type'        => self::FIELD_INPUT_NUMBER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '1',
				'units'       => [
					[
						'type'   => 'px',
						'active' => true
					]
				],
				'selector'    => [
					'{{SELECTOR}}:hover' => 'border-width: {{VALUE}}{{UNIT}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_3[] = new EditorSectionField(
			[
				'label'       => 'Border color:',
				'name'        => 'border-hover-color-field-advanced',
				'visibility'  => false,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}}:hover' => 'border-color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$section_4 = new EditorSection( [
			'title' => 'Customization',
			'name'  => 'customization-advanced',
			'state' => false,
			'icon'  => 'mdi-advanced'
		] );

		$fields_4 = [];

		$fields_4[] = new EditorSectionField(
			[
				'label'       => 'ID:',
				'name'        => 'css-id-field-advanced',
				'visibility'  => true,
				'type'        => self::FIELD_INPUT_TEXT,
				'controller'  => 'container',
				'edit'        => self::EDIT_ID,
				'value'       => '',
				'units'       => [],
				'selector'    => [],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_4[] = new EditorSectionField(
			[
				'label'       => 'Class:',
				'name'        => 'css-class-field-advanced',
				'visibility'  => true,
				'type'        => self::FIELD_INPUT_TEXT,
				'controller'  => 'container',
				'edit'        => self::EDIT_CLASS,
				'value'       => '',
				'units'       => [],
				'selector'    => [],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		foreach ( $fields_1 as $field ) {
			$section_1->addField( $field );
		}

		foreach ( $fields_2 as $field ) {
			$section_2->addField( $field );
		}

		foreach ( $fields_3 as $field ) {
			$section_3->addField( $field );
		}
		foreach ( $fields_4 as $field ) {
			$section_4->addField( $field );
		}


		$this->editor['advanced_layout']        = $section_1;
		$this->editor['advanced_normal_style']  = $section_2;
		$this->editor['advanced_hover_style']   = $section_3;
		$this->editor['advanced_customization'] = $section_4;
	}
}
