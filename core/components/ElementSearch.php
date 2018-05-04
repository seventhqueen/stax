<?php
/**
 * Search component.
 *
 * @package Stax
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since 1.0
 */

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ElementSearch extends Element implements ElementInterface {
	/**
	 * ElementSearch constructor.
	 */
	public function __construct() {
		parent::__construct();
		$this->name        = 'Search';
		$this->slug        = 'search';
		$this->icon->size  = 'mdi-24px';
		$this->icon->type  = 'mdi-magnify';
		$this->icon->color = 'sq-searchItem';
		$this->template    = '<div class="item sq-search" data-controller="container"><div class="item-child"><form class="floating-placeholder" action="' . site_url() . '" method="GET">' .
		                     '<span class="mdi mdi-magnify" data-controller="icon"></span>' .
		                     '<input type="text" name="s" class="input-text" placeholder="" value="" required data-controller="search">' .
		                     '<label for="search" class="input-label">Search for</label>' .
		                     '</form></div></div>';

		$fields_2 = [];

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Font family:',
				'name'        => 'typo-input-font-family-field',
				'visibility'  => true,
				'type'        => self::FIELD_FONT_FAMILY,
				'controller'  => '',
				'edit'        => self::EDIT_FONT,
				'value'       => '',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} input' => 'font-family: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Font size:',
				'name'        => 'typo-input-font-size-field',
				'visibility'  => true,
				'type'        => self::FIELD_INPUT_NUMBER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '14',
				'units'       => [
					[
						'type'   => 'px',
						'active' => true
					],
					[
						'type'   => 'em',
						'active' => false
					]
				],
				'selector'    => [
					'{{SELECTOR}} input' => 'font-size: {{VALUE}}{{UNIT}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Font weight:',
				'name'        => 'typo-input-font-weight-field',
				'visibility'  => true,
				'type'        => self::FIELD_DROPDOWN,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => [
					[
						'label'    => '100',
						'value'    => '100',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => '200',
						'value'    => '200',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => '300',
						'value'    => '300',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => '400',
						'value'    => '400',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => '500',
						'value'    => '500',
						'extra'    => [],
						'selected' => true,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => '600',
						'value'    => '600',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => '700',
						'value'    => '700',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => '800',
						'value'    => '800',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => '900',
						'value'    => '900',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					]
				],
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} input' => 'font-weight: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Text transform:',
				'name'        => 'typo-input-font-transform-field',
				'visibility'  => true,
				'type'        => self::FIELD_DROPDOWN,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => [
					[
						'label'    => 'Initial',
						'value'    => 'initial',
						'extra'    => [],
						'selected' => true,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => 'Uppercase',
						'value'    => 'uppercase',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => 'Lowercase',
						'value'    => 'lowercase',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => 'Capitalize',
						'value'    => 'capitalize',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					]
				],
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} input' => 'text-transform: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Text style:',
				'name'        => 'typo-input-font-type-field',
				'visibility'  => true,
				'type'        => self::FIELD_DROPDOWN,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => [
					[
						'label'    => 'Normal',
						'value'    => 'normal',
						'extra'    => [],
						'selected' => true,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => 'Italic',
						'value'    => 'italic',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => 'Oblique',
						'value'    => 'oblique',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					]
				],
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} input' => 'font-style: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Letter spacing:',
				'name'        => 'typo-input-letter-spacing-field',
				'visibility'  => true,
				'type'        => self::FIELD_INPUT_NUMBER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '1',
				'units'       => [
					[
						'type'   => 'px',
						'active' => true
					],
					[
						'type'   => 'em',
						'active' => false
					]
				],
				'selector'    => [
					'{{SELECTOR}} input' => 'letter-spacing: {{VALUE}}{{UNIT}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Layout',
				'name'        => 'input-layout-separator',
				'visibility'  => true,
				'type'        => self::FIELD_SEPARATOR,
				'controller'  => '',
				'edit'        => '',
				'value'       => '',
				'units'       => [],
				'selector'    => [],
				'tooltip'     => '',
				'editorClass' => [
					'padding-m'
				]
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Min-width:',
				'name'        => 'input-min-width-field',
				'visibility'  => true,
				'type'        => self::FIELD_INPUT_NUMBER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '300',
				'units'       => [
					[
						'type'   => 'px',
						'active' => true
					],
					[
						'type'   => '%',
						'active' => false
					]
				],
				'selector'    => [
					'{{SELECTOR}} input' => 'min-width: {{VALUE}}{{UNIT}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Padding:',
				'name'        => 'padding-search-field',
				'visibility'  => true,
				'type'        => self::FIELD_SPACING,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => [
					[
						'position' => 'Top',
						'value'    => '6',
					],
					[
						'position' => 'Right',
						'value'    => '0',
					],
					[
						'position' => 'Bottom',
						'value'    => '6',
					],
					[
						'position' => 'Left',
						'value'    => '30',
					],
				],
				'units'       => [
					[
						'type'   => 'px',
						'active' => true,
					],
					[
						'type'   => 'em',
						'active' => false,
					],
					[
						'type'   => '%',
						'active' => false,
					],
				],
				'selector'    => [
					'{{SELECTOR}} input' => [
						'padding-top: {{VALUE_1}}{{UNIT}}',
						'padding-right: {{VALUE_2}}{{UNIT}}',
						'padding-bottom: {{VALUE_3}}{{UNIT}}',
						'padding-left: {{VALUE_4}}{{UNIT}}',
					],
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Border radius:',
				'name'        => 'search-border-radius-field',
				'visibility'  => true,
				'type'        => self::FIELD_BORDER_RADIUS,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => [
					[
						'position' => 'Top left',
						'value'    => '30'
					],
					[
						'position' => 'Top right',
						'value'    => '30'
					],
					[
						'position' => 'Bottom right',
						'value'    => '30'
					],
					[
						'position' => 'Bottom left',
						'value'    => '30'
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
					'{{SELECTOR}} input' => 'border-radius: {{VALUE_1}}{{UNIT}} {{VALUE_2}}{{UNIT}} {{VALUE_3}}{{UNIT}} {{VALUE_4}}{{UNIT}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Style',
				'name'        => 'input-style-separator',
				'visibility'  => true,
				'type'        => self::FIELD_SEPARATOR,
				'controller'  => '',
				'edit'        => '',
				'value'       => '',
				'units'       => [],
				'selector'    => [],
				'tooltip'     => '',
				'editorClass' => [
					'padding-m'
				]
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Color:',
				'name'        => 'search-color-field',
				'visibility'  => true,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => 'rgb(33, 150, 243)',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} input' => 'color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Background:',
				'name'        => 'search-bg-field',
				'visibility'  => true,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => 'rgb(255, 255, 255)',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} input' => 'background-color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Border type:',
				'name'        => 'search-border-type-field',
				'visibility'  => true,
				'type'        => self::FIELD_DROPDOWN,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => [
					[
						'label'    => 'None',
						'value'    => '',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => 'Solid',
						'value'    => 'solid',
						'extra'    => [],
						'selected' => true,
						'trigger'  => [
							'section' => [],
							'field'   => [
								'search-border-width-field',
								'search-border-color-field'
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
								'search-border-width-field',
								'search-border-color-field'
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
								'search-border-width-field',
								'search-border-color-field'
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
								'search-border-width-field',
								'search-border-color-field'
							]
						]
					]
				],
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} input' => 'border-style: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Border width:',
				'name'        => 'search-border-width-field',
				'visibility'  => true,
				'type'        => self::FIELD_INPUT_NUMBER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '2',
				'units'       => [
					[
						'type'   => 'px',
						'active' => true
					]
				],
				'selector'    => [
					'{{SELECTOR}} input' => 'border-width: {{VALUE}}{{UNIT}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Border color:',
				'name'        => 'search-border-color-field',
				'visibility'  => true,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => 'rgb(33, 150, 243)',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} input' => 'border-color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Shadow:',
				'name'        => 'search-shadow-field',
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
					'{{SELECTOR}} input' => [
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
				'label'       => 'Focus style',
				'name'        => 'input-focus-separator',
				'visibility'  => true,
				'type'        => self::FIELD_SEPARATOR,
				'controller'  => '',
				'edit'        => '',
				'value'       => '',
				'units'       => [],
				'selector'    => [],
				'tooltip'     => '',
				'editorClass' => [
					'padding-m'
				]
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Color:',
				'name'        => 'search-focus-color-field',
				'visibility'  => true,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => 'rgb(33, 150, 243)',
				'units'       => [],
				'selector'    => [
					'.header-section {{SELECTOR}} input:focus' => 'color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Background:',
				'name'        => 'search-focus-bg-field',
				'visibility'  => true,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => 'rgb(255, 255, 255)',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} input:focus' => 'background-color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Border type:',
				'name'        => 'search-focus-border-type-field',
				'visibility'  => true,
				'type'        => self::FIELD_DROPDOWN,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => [
					[
						'label'    => 'None',
						'value'    => '',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => 'Solid',
						'value'    => 'solid',
						'extra'    => [],
						'selected' => true,
						'trigger'  => [
							'section' => [],
							'field'   => [
								'search-border-width-field',
								'search-border-color-field'
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
								'search-border-width-field',
								'search-border-color-field'
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
								'search-border-width-field',
								'search-border-color-field'
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
								'search-border-width-field',
								'search-border-color-field'
							]
						]
					]
				],
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} input:focus' => 'border-style: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Border width:',
				'name'        => 'search-focus-border-width-field',
				'visibility'  => true,
				'type'        => self::FIELD_INPUT_NUMBER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '2',
				'units'       => [
					[
						'type'   => 'px',
						'active' => true
					]
				],
				'selector'    => [
					'{{SELECTOR}} input:focus' => 'border-width: {{VALUE}}{{UNIT}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Border color:',
				'name'        => 'search-focus-border-color-field',
				'visibility'  => true,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => 'rgb(33, 150, 243)',
				'units'       => [],
				'selector'    => [
					'.header-section {{SELECTOR}} input:focus' => 'border-color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Shadow:',
				'name'        => 'search-focus-shadow-field',
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
					'{{SELECTOR}} input:focus' => [
						'-webkit-box-shadow: {{X}}{{UNIT}} {{Y}}{{UNIT}} {{BLUR}}{{UNIT}} {{SPREAD}}{{UNIT}} {{COLOR}}',
						'-moz-box-shadow: {{X}}{{UNIT}} {{Y}}{{UNIT}} {{BLUR}}{{UNIT}} {{SPREAD}}{{UNIT}} {{COLOR}}',
						'box-shadow: {{X}}{{UNIT}} {{Y}}{{UNIT}} {{BLUR}}{{UNIT}} {{SPREAD}}{{UNIT}} {{COLOR}}'
					]
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_3 = [];

		$fields_3[] = new EditorSectionField(
			[
				'label'       => 'Size:',
				'name'        => 'search-icon-size-field',
				'visibility'  => true,
				'type'        => self::FIELD_DROPDOWN,
				'controller'  => 'icon',
				'edit'        => self::EDIT_CLASS,
				'value'       => [
					[
						'label'    => '18 px',
						'value'    => 'mdi-18px',
						'extra'    => [],
						'selected' => true,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => '24 px',
						'value'    => 'mdi-24px',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => '36 px',
						'value'    => 'mdi-36px',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => '48 px',
						'value'    => 'mdi-48px',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
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

		$fields_3[] = new EditorSectionField(
			[
				'label'       => 'Style',
				'name'        => 'icon-style-separator',
				'visibility'  => true,
				'type'        => self::FIELD_SEPARATOR,
				'controller'  => '',
				'edit'        => '',
				'value'       => '',
				'units'       => [],
				'selector'    => [],
				'tooltip'     => '',
				'editorClass' => [
					'padding-m'
				]
			]
		);

		$fields_3[] = new EditorSectionField(
			[
				'label'       => 'Color:',
				'name'        => 'search-icon-color-field',
				'visibility'  => true,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => 'rgb(33, 150, 243)',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} span.mdi' => 'color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_3[] = new EditorSectionField(
			[
				'label'       => 'Focus style',
				'name'        => 'icon-focus-style-separator',
				'visibility'  => true,
				'type'        => self::FIELD_SEPARATOR,
				'controller'  => '',
				'edit'        => '',
				'value'       => '',
				'units'       => [],
				'selector'    => [],
				'tooltip'     => '',
				'editorClass' => [
					'padding-m'
				]
			]
		);

		$fields_3[] = new EditorSectionField(
			[
				'label'       => 'Color:',
				'name'        => 'search-focus-icon-color-field',
				'visibility'  => true,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => 'rgb(33, 150, 243)',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} .floating-placeholder.is-focused span.mdi' => 'color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_4 = [];

		$fields_4[] = new EditorSectionField(
			[
				'label'       => 'Text:',
				'name'        => 'placeholder-text-field',
				'visibility'  => true,
				'type'        => self::FIELD_INPUT_TEXT,
				'controller'  => 'search',
				'edit'        => 'placeholder',
				'value'       => 'Search for...',
				'units'       => [],
				'selector'    => [],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_4[] = new EditorSectionField(
			[
				'label'       => 'Typography',
				'name'        => 'placeholder-typo-separator',
				'visibility'  => true,
				'type'        => self::FIELD_SEPARATOR,
				'controller'  => '',
				'edit'        => '',
				'value'       => '',
				'units'       => [],
				'selector'    => [],
				'tooltip'     => '',
				'editorClass' => [
					'padding-m'
				]
			]
		);

		$fields_4[] = new EditorSectionField(
			[
				'label'       => 'Font family:',
				'name'        => 'typo-font-family-field',
				'visibility'  => true,
				'type'        => self::FIELD_FONT_FAMILY,
				'controller'  => '',
				'edit'        => self::EDIT_FONT,
				'value'       => '',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} input::-webkit-input-placeholder' => 'font-family: {{VALUE}}',
					'{{SELECTOR}} input::-moz-placeholder'          => 'font-family: {{VALUE}}',
					'{{SELECTOR}} input:-ms-input-placeholder'      => 'font-family: {{VALUE}}',
					'{{SELECTOR}} input:-moz-placeholder'           => 'font-family: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_4[] = new EditorSectionField(
			[
				'label'       => 'Font size:',
				'name'        => 'typo-font-size-field',
				'visibility'  => true,
				'type'        => self::FIELD_INPUT_NUMBER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '14',
				'units'       => [
					[
						'type'   => 'px',
						'active' => true
					],
					[
						'type'   => 'em',
						'active' => false
					]
				],
				'selector'    => [
					'{{SELECTOR}} input::-webkit-input-placeholder' => 'font-size: {{VALUE}}{{UNIT}}',
					'{{SELECTOR}} input::-moz-placeholder'          => 'font-size: {{VALUE}}{{UNIT}}',
					'{{SELECTOR}} input:-ms-input-placeholder'      => 'font-size: {{VALUE}}{{UNIT}}',
					'{{SELECTOR}} input:-moz-placeholder'           => 'font-size: {{VALUE}}{{UNIT}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_4[] = new EditorSectionField(
			[
				'label'       => 'Font weight:',
				'name'        => 'typo-font-weight-field',
				'visibility'  => true,
				'type'        => self::FIELD_DROPDOWN,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => [
					[
						'label'    => '100',
						'value'    => '100',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => '200',
						'value'    => '200',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => '300',
						'value'    => '300',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => '400',
						'value'    => '400',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => '500',
						'value'    => '500',
						'extra'    => [],
						'selected' => true,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => '600',
						'value'    => '600',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => '700',
						'value'    => '700',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => '800',
						'value'    => '800',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => '900',
						'value'    => '900',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					]
				],
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} input::-webkit-input-placeholder' => 'font-weight: {{VALUE}}',
					'{{SELECTOR}} input::-moz-placeholder'          => 'font-weight: {{VALUE}}',
					'{{SELECTOR}} input:-ms-input-placeholder'      => 'font-weight: {{VALUE}}',
					'{{SELECTOR}} input:-moz-placeholder'           => 'font-weight: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_4[] = new EditorSectionField(
			[
				'label'       => 'Text transform:',
				'name'        => 'typo-font-transform-field',
				'visibility'  => true,
				'type'        => self::FIELD_DROPDOWN,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => [
					[
						'label'    => 'Initial',
						'value'    => 'initial',
						'extra'    => [],
						'selected' => true,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => 'Uppercase',
						'value'    => 'uppercase',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => 'Lowercase',
						'value'    => 'lowercase',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => 'Capitalize',
						'value'    => 'capitalize',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					]
				],
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} input::-webkit-input-placeholder' => 'text-transform: {{VALUE}}',
					'{{SELECTOR}} input::-moz-placeholder'          => 'text-transform: {{VALUE}}',
					'{{SELECTOR}} input:-ms-input-placeholder'      => 'text-transform: {{VALUE}}',
					'{{SELECTOR}} input:-moz-placeholder'           => 'text-transform: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_4[] = new EditorSectionField(
			[
				'label'       => 'Text style:',
				'name'        => 'typo-font-type-field',
				'visibility'  => true,
				'type'        => self::FIELD_DROPDOWN,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => [
					[
						'label'    => 'Normal',
						'value'    => 'normal',
						'extra'    => [],
						'selected' => true,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => 'Italic',
						'value'    => 'italic',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => 'Oblique',
						'value'    => 'oblique',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					]
				],
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} input::-webkit-input-placeholder' => 'font-style: {{VALUE}}',
					'{{SELECTOR}} input::-moz-placeholder'          => 'font-style: {{VALUE}}',
					'{{SELECTOR}} input:-ms-input-placeholder'      => 'font-style: {{VALUE}}',
					'{{SELECTOR}} input:-moz-placeholder'           => 'font-style: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_4[] = new EditorSectionField(
			[
				'label'       => 'Letter spacing:',
				'name'        => 'typo-letter-spacing-field',
				'visibility'  => true,
				'type'        => self::FIELD_INPUT_NUMBER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '1',
				'units'       => [
					[
						'type'   => 'px',
						'active' => true
					],
					[
						'type'   => 'em',
						'active' => false
					]
				],
				'selector'    => [
					'{{SELECTOR}} input::-webkit-input-placeholder' => 'letter-spacing: {{VALUE}}{{UNIT}}',
					'{{SELECTOR}} input::-moz-placeholder'          => 'letter-spacing: {{VALUE}}{{UNIT}}',
					'{{SELECTOR}} input:-ms-input-placeholder'      => 'letter-spacing: {{VALUE}}{{UNIT}}',
					'{{SELECTOR}} input:-moz-placeholder'           => 'letter-spacing: {{VALUE}}{{UNIT}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_4[] = new EditorSectionField(
			[
				'label'       => 'Style',
				'name'        => 'style-placeholder-separator',
				'visibility'  => true,
				'type'        => self::FIELD_SEPARATOR,
				'controller'  => '',
				'edit'        => '',
				'value'       => '',
				'units'       => [],
				'selector'    => [],
				'tooltip'     => '',
				'editorClass' => [
					'padding-m'
				]
			]
		);

		$fields_4[] = new EditorSectionField(
			[
				'label'       => 'Color:',
				'name'        => 'search-placeholder-color-field',
				'visibility'  => true,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} input::-webkit-input-placeholder' => 'color: {{VALUE}}',
					'{{SELECTOR}} input::-moz-placeholder'          => 'color: {{VALUE}}',
					'{{SELECTOR}} input:-ms-input-placeholder'      => 'color: {{VALUE}}',
					'{{SELECTOR}} input:-moz-placeholder'           => 'color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_4[] = new EditorSectionField(
			[
				'label'       => 'Focus style',
				'name'        => 'style-focus-placeholder-separator',
				'visibility'  => true,
				'type'        => self::FIELD_SEPARATOR,
				'controller'  => '',
				'edit'        => '',
				'value'       => '',
				'units'       => [],
				'selector'    => [],
				'tooltip'     => '',
				'editorClass' => [
					'padding-m'
				]
			]
		);

		$fields_4[] = new EditorSectionField(
			[
				'label'       => 'Color:',
				'name'        => 'search-focus-placeholder-color-field',
				'visibility'  => true,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} input:focus::-webkit-input-placeholder' => 'color: {{VALUE}}',
					'{{SELECTOR}} input:focus::-moz-placeholder'          => 'color: {{VALUE}}',
					'{{SELECTOR}} input:focus:-ms-input-placeholder'      => 'color: {{VALUE}}',
					'{{SELECTOR}} input:focus:-moz-placeholder'           => 'color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_5 = [];

		$fields_5[] = new EditorSectionField(
			[
				'label'       => 'Show:',
				'name'        => 'label-show-field',
				'visibility'  => true,
				'type'        => self::FIELD_SWITCH,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => [
					[
						'label'   => '',
						'value'   => '',
						'extra'   => [],
						'checked' => true,
						'trigger' => [
							'section' => [],
							'field'   => [
								'label-style-separator',
								'label-color-field'
							]
						]
					]
				],
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} label' => 'display: none !important'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_5[] = new EditorSectionField(
			[
				'label'       => 'Style',
				'name'        => 'label-style-separator',
				'visibility'  => false,
				'type'        => self::FIELD_SEPARATOR,
				'controller'  => '',
				'edit'        => '',
				'value'       => '',
				'units'       => [],
				'selector'    => [],
				'tooltip'     => '',
				'editorClass' => [
					'padding-m'
				]
			]
		);

		$fields_5[] = new EditorSectionField(
			[
				'label'       => 'Color:',
				'name'        => 'label-color-field',
				'visibility'  => true,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} label' => 'color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$this->addSection( new EditorSection( [
			'title' => 'Input',
			'name'  => 'input-section'
		] ), $fields_2 );

		$this->addSection( new EditorSection( [
			'title' => 'Icon',
			'name'  => 'icon-section',
			'state' => true
		] ), $fields_3 );

		$this->addSection( new EditorSection( [
			'title' => 'Placeholder',
			'name'  => 'placeholder-section',
			'state' => true
		] ), $fields_4 );

		$this->addSection( new EditorSection( [
			'title' => 'Label',
			'name'  => 'label-section',
			'state' => true
		] ), $fields_5 );

		$this->setBoxDefaults( [
			self::ADVANCED_MARGIN => [
				'value' => [ 0, 2, 0, 2 ]
			]
		] );

	}
}
