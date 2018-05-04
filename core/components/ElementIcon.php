<?php
/**
 * Link component.
 *
 * @package Stax
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since 1.0
 */

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ElementIcon extends Element implements ElementInterface {
	/**
	 * ElementIcon constructor.
	 */
	public function __construct() {
		parent::__construct();
		$this->name        = 'Icon';
		$this->slug        = 'icon';
		$this->icon->size  = 'mdi-24px';
		$this->icon->type  = 'mdi-star-circle';
		$this->icon->color = 'sq-iconItem';
		$this->template    = '<div class="item sq-icon" data-controller="container"><a class="item-child" href="#" data-controller="url">' .
		                     '<span class="mdi" data-controller="icon"></span>' .
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
				'label'       => 'Type:',
				'name'        => 'icon-field',
				'visibility'  => true,
				'type'        => self::FIELD_ICON,
				'controller'  => 'icon',
				'edit'        => self::EDIT_CLASS,
				'value'       => 'mdi-account-outline',
				'units'       => [],
				'selector'    => [],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields[] = new EditorSectionField(
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
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => '24 px',
						'value'    => 'mdi-24px',
						'extra'    => [],
						'selected' => true,
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

		$fields[] = new EditorSectionField(
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

		$fields[] = new EditorSectionField(
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
						'value'    => '6'
					],
					[
						'position' => 'Right',
						'value'    => '6'
					],
					[
						'position' => 'Bottom',
						'value'    => '6'
					],
					[
						'position' => 'Left',
						'value'    => '6',
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

		$fields[] = new EditorSectionField(
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
						'value'    => '3'
					],
					[
						'position' => 'Top right',
						'value'    => '3'
					],
					[
						'position' => 'Bottom right',
						'value'    => '3'
					],
					[
						'position' => 'Bottom left',
						'value'    => '3'
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

		$fields[] = new EditorSectionField(
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

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Color:',
				'name'        => 'icon-color-field',
				'visibility'  => true,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => 'rgb(0,0,0)',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} > a span.mdi' => 'color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields[] = new EditorSectionField(
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

		$fields[] = new EditorSectionField(
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

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Border width:',
				'name'        => 'icon-border-normal-width-field',
				'visibility'  => true,
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
					'{{SELECTOR}} a span.mdi' => 'border-width: {{VALUE}}{{UNIT}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Border color:',
				'name'        => 'icon-border-normal-color-field',
				'visibility'  => true,
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

		$fields[] = new EditorSectionField(
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

		$fields[] = new EditorSectionField(
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

		$fields[] = new EditorSectionField(
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

		$fields[] = new EditorSectionField(
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

		$fields[] = new EditorSectionField(
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
					]
				],
				'selector'    => [
					'{{SELECTOR}}:hover a span.mdi' => 'border-width: {{VALUE}}{{UNIT}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields[] = new EditorSectionField(
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

		$this->setBoxDefaults( [
			self::ADVANCED_MARGIN => [
				'value' => [ 0, 2, 0, 2 ]
			]
		] );

	}
}
