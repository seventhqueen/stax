<?php
/**
 * Button component.
 *
 * @package Stax
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since 1.0
 */

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ElementButton extends Element implements ElementInterface {
	/**
	 * ElementButton constructor.
	 */
	public function __construct() {
		parent::__construct();
		$this->name        = 'Button';
		$this->slug        = 'button';
		$this->icon->size  = 'mdi-24px';
		$this->icon->type  = 'mdi-crop-square';
		$this->icon->color = 'sq-buttonItem';
		$this->template    = '<div class="item sq-button" data-controller="container"><a class="item-child" href="#" data-controller="url">' .
		                     '<span class="mdi" data-controller="icon"></span><span class="item-text" data-controller="item-text"></span>' .
		                     '</a></div>';

		$fields = [];

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Link:',
				'name'        => 'url-field',
				'visibility'  => true,
				'type'        => self::FIELD_INPUT_URL,
				'controller'  => 'url',
				'edit'        => self::EDIT_HREF,
				'value'       => '#',
				'units'       => [],
				'selector'    => [],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Link target:',
				'name'        => 'url-target-field',
				'visibility'  => true,
				'type'        => self::FIELD_DROPDOWN,
				'controller'  => 'url',
				'edit'        => 'target',
				'value'       => [
					[
						'label'    => 'Self',
						'value'    => '_self',
						'extra'    => [],
						'selected' => true,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => 'Blank',
						'value'    => '_blank',
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

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Layout',
				'name'        => 'btn-layout-separator',
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

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Padding:',
				'name'        => 'btn-padding-field',
				'visibility'  => true,
				'type'        => self::FIELD_SPACING,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => [
					[
						'position' => 'Top',
						'value'    => '6'
					],
					[
						'position' => 'Right',
						'value'    => '20'
					],
					[
						'position' => 'Bottom',
						'value'    => '6'
					],
					[
						'position' => 'Left',
						'value'    => '20',
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
					'{{SELECTOR}} a' => [
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

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Border radius:',
				'name'        => 'btn-border-radius-field',
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
					'{{SELECTOR}} a' => 'border-radius: {{VALUE_1}}{{UNIT}} {{VALUE_2}}{{UNIT}} {{VALUE_3}}{{UNIT}} {{VALUE_4}}{{UNIT}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Style',
				'name'        => 'btn-normal-separator',
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

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Background:',
				'name'        => 'btn-bg-color-field',
				'visibility'  => true,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => 'rgb(33, 150, 243)',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} a' => 'background-color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Border type:',
				'name'        => 'btn-border-normal-type-field',
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
								'btn-border-normal-width-field',
								'btn-border-normal-color-field'
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
								'btn-border-normal-width-field',
								'btn-border-normal-color-field'
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
								'btn-border-normal-width-field',
								'btn-border-normal-color-field'
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
								'btn-border-normal-width-field',
								'btn-border-normal-color-field'
							]
						]
					]
				],
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} a' => 'border-style: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Border width:',
				'name'        => 'btn-border-normal-width-field',
				'visibility'  => true,
				'type'        => self::FIELD_INPUT_NUMBER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '2',
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
					'{{SELECTOR}} a' => 'border-width: {{VALUE}}{{UNIT}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Border color:',
				'name'        => 'btn-border-normal-color-field',
				'visibility'  => true,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => 'rgb(33, 150, 243)',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} a' => 'border-color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Hover style',
				'name'        => 'btn-hover-separator',
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

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Background:',
				'name'        => 'btn-bg-hover-field',
				'visibility'  => true,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => 'rgb(19, 134, 226)',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} a:hover' => 'background-color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Border type:',
				'name'        => 'btn-border-hover-type-field',
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
								'btn-border-hover-width-field',
								'btn-border-hover-color-field'
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
								'btn-border-hover-width-field',
								'btn-border-hover-color-field'
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
								'btn-border-hover-width-field',
								'btn-border-hover-color-field'
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
								'btn-border-hover-width-field',
								'btn-border-hover-color-field'
							]
						]
					]
				],
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} a:hover' => 'border-style: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Border width:',
				'name'        => 'btn-border-hover-width-field',
				'visibility'  => false,
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
					'{{SELECTOR}} a:hover' => 'border-width: {{VALUE}}{{UNIT}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Border color:',
				'name'        => 'btn-border-hover-color-field',
				'visibility'  => false,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} a:hover' => 'border-color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_1 = [];

		$fields_1[] = new EditorSectionField(
			[
				'label'       => 'Text:',
				'name'        => 'icon-text-field',
				'visibility'  => true,
				'type'        => self::FIELD_INPUT_TEXT,
				'controller'  => 'item-text',
				'edit'        => self::EDIT_INNER,
				'value'       => 'Your text here',
				'units'       => [],
				'selector'    => [],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_1[] = new EditorSectionField(
			[
				'label'       => 'Typography',
				'name'        => 'text-typo-separator',
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

		$fields_1[] = new EditorSectionField(
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
					'{{SELECTOR}} a span.item-text' => 'font-family: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_1[] = new EditorSectionField(
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
					'{{SELECTOR}} a span.item-text' => 'font-size: {{VALUE}}{{UNIT}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_1[] = new EditorSectionField(
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
					'{{SELECTOR}} a span.item-text' => 'font-weight: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_1[] = new EditorSectionField(
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
					'{{SELECTOR}} a span.item-text' => 'text-transform: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_1[] = new EditorSectionField(
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
					'{{SELECTOR}} a span.item-text' => 'font-style: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_1[] = new EditorSectionField(
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
					'{{SELECTOR}} .item-child' => 'letter-spacing: {{VALUE}}{{UNIT}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_1[] = new EditorSectionField(
			[
				'label'       => 'Style',
				'name'        => 'text-normal-separator',
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

		$fields_1[] = new EditorSectionField(
			[
				'label'       => 'Color:',
				'name'        => 'text-color-field',
				'visibility'  => true,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => 'rgb(255, 255, 255)',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} > a span.item-text' => 'color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_1[] = new EditorSectionField(
			[
				'label'       => 'Hover style',
				'name'        => 'text-hover-separator',
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

		$fields_1[] = new EditorSectionField(
			[
				'label'       => 'Color:',
				'name'        => 'text-hover-color-field',
				'visibility'  => true,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}}:hover > a span.item-text' => 'color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2 = [];

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Show:',
				'name'        => 'icon-switch-field',
				'visibility'  => true,
				'type'        => self::FIELD_SWITCH,
				'controller'  => '',
				'edit'        => '',
				'value'       => [
					[
						'label'   => '',
						'value'   => '',
						'extra'   => [],
						'checked' => true,
						'trigger' => [
							'section' => [],
							'field'   => [
								'icon-field',
								'icon-size-field',
								'icon-style-separator',
								'icon-border-radius-field',
								'icon-bg-color-field',
								'icon-bg-hover-color-field',
								'icon-color-field',
								'icon-color-hover-field',
								'icon-padding-field',
								'icon-margin-field',
								'icon-border-normal-type-field',
								'icon-border-hover-type-field',
								'icon-normal-separator',
								'icon-hover-separator'
							]
						]
					]
				],
				'units'       => [],
				'selector'    => [],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Type:',
				'name'        => 'icon-field',
				'visibility'  => true,
				'type'        => self::FIELD_ICON,
				'controller'  => 'icon',
				'edit'        => self::EDIT_CLASS,
				'value'       => 'mdi-arrow-right-bold-circle',
				'units'       => [],
				'selector'    => [],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Size:',
				'name'        => 'icon-size-field',
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

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Layout',
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

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Padding:',
				'name'        => 'icon-padding-field',
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
					'{{SELECTOR}} a span.mdi' => [
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

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Margin:',
				'name'        => 'icon-margin-field',
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
						'value'    => '7'
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
					'{{SELECTOR}} a span.mdi' => [
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

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Border radius:',
				'name'        => 'icon-border-radius-field',
				'visibility'  => true,
				'type'        => self::FIELD_BORDER_RADIUS,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => [
					[
						'position' => 'Top left',
						'value'    => ''
					],
					[
						'position' => 'Top right',
						'value'    => ''
					],
					[
						'position' => 'Bottom right',
						'value'    => ''
					],
					[
						'position' => 'Bottom left',
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
					'{{SELECTOR}} a span.mdi' => 'border-radius: {{VALUE_1}}{{UNIT}} {{VALUE_2}}{{UNIT}} {{VALUE_3}}{{UNIT}} {{VALUE_4}}{{UNIT}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Style',
				'name'        => 'icon-normal-separator',
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
				'name'        => 'icon-color-field',
				'visibility'  => true,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => 'rgb(255, 255, 255)',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} > a span.mdi' => 'color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Background:',
				'name'        => 'icon-bg-color-field',
				'visibility'  => true,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} a span.mdi' => 'background-color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Border type:',
				'name'        => 'icon-border-normal-type-field',
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
								'icon-border-normal-width-field',
								'icon-border-normal-color-field'
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
								'icon-border-normal-width-field',
								'icon-border-normal-color-field'
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
								'icon-border-normal-width-field',
								'icon-border-normal-color-field'
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
								'icon-border-normal-width-field',
								'icon-border-normal-color-field'
							]
						]
					]
				],
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} a span.mdi' => 'border-style: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Border width:',
				'name'        => 'icon-border-normal-width-field',
				'visibility'  => false,
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
					'{{SELECTOR}} a span.mdi' => 'border-width: {{VALUE}}{{UNIT}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Border color:',
				'name'        => 'icon-border-normal-color-field',
				'visibility'  => false,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} a span.mdi' => 'border-color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Hover style',
				'name'        => 'icon-hover-separator',
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
				'name'        => 'icon-color-hover-field',
				'visibility'  => true,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}}:hover > a span.mdi' => 'color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Background:',
				'name'        => 'icon-bg-hover-color-field',
				'visibility'  => true,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}}:hover a span.mdi' => 'background-color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Border type:',
				'name'        => 'icon-border-hover-type-field',
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
								'icon-border-hover-width-field',
								'icon-border-hover-color-field'
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
								'icon-border-hover-width-field',
								'icon-border-hover-color-field'
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
								'icon-border-hover-width-field',
								'icon-border-hover-color-field'
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
								'icon-border-hover-width-field',
								'icon-border-hover-color-field'
							]
						]
					]
				],
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}}:hover a span.mdi' => 'border-style: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Border width:',
				'name'        => 'icon-border-hover-width-field',
				'visibility'  => false,
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
					'{{SELECTOR}}:hover a span.mdi' => 'border-width: {{VALUE}}{{UNIT}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Border color:',
				'name'        => 'icon-border-hover-color-field',
				'visibility'  => false,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}}:hover a span.mdi' => 'border-color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$this->addSection( new EditorSection( [
			'title' => $this->name,
			'name'  => 'option-section'
		] ), $fields );

		$this->addSection( new EditorSection( [
			'title' => 'Text',
			'name'  => 'text-section'
		] ), $fields_1 );

		$this->addSection( new EditorSection( [
			'title' => 'Icon',
			'name'  => 'icon-section',
			'state' => true
		] ), $fields_2 );

		$this->setBoxDefaults( [
			self::ADVANCED_MARGIN => [
				'value' => [ 0, 2, 0, 2 ]
			]
		] );

	}
}
