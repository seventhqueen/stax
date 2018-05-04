<?php
/**
 * Menu component.
 *
 * @package Stax
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since 1.0
 */

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ElementMenu extends Element implements ElementInterface {
	/**
	 * ElementMenu constructor.
	 */
	public function __construct() {
		parent::__construct();
		$this->name        = 'Menu';
		$this->slug        = 'menu';
		$this->icon->size  = 'mdi-24px';
		$this->icon->type  = 'mdi-menu';
		$this->icon->color = 'sq-menuItem';
		$this->template    = '<div class="item sq-menu" data-controller="container">' .
		                     '<div class="menu-default flexMenu item-child" data-controller="menu"></div>' .
		                     '</div>';

		$fields_1 = [];

		$fields_1[] = new EditorSectionField(
			[
				'label'       => 'Menu:',
				'name'        => 'menu-field',
				'visibility'  => true,
				'type'        => self::FIELD_DROPDOWN_MENU,
				'controller'  => 'menu',
				'edit'        => self::EDIT_INNER,
				'value'       => '',
				'units'       => [],
				'selector'    => [],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_1[] = new EditorSectionField(
			[
				'label'       => 'Enable Flex',
				'name'        => 'menu-flex-field',
				'visibility'  => true,
				'type'        => self::FIELD_SWITCH,
				'controller'  => 'menu',
				'edit'        => self::EDIT_CLASS,
				'value'       => [
					[
						'label'   => '',
						'value'   => 'flexMenu',
						'extra'   => [],
						'checked' => false,
						'trigger' => [
							'section' => [],
							'field'   => [
								'flex-icon-field'
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

		$fields_1[] = new EditorSectionField(
			[
				'label'       => 'Flex icon:',
				'name'        => 'flex-icon-field',
				'visibility'  => false,
				'type'        => self::FIELD_ICON,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => 'mdi-dots-vertical',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} .menu-default > ul > li.flexMenu-viewMore.has-submenu > a:after' => 'content: "{{VALUE}}"'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_1[] = new EditorSectionField(
			[
				'label'       => 'Typography',
				'name'        => 'typo-separator',
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
					'{{SELECTOR}} a' => 'font-family: {{VALUE}}'
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
					'{{SELECTOR}} a' => 'font-size: {{VALUE}}{{UNIT}}'
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
					'{{SELECTOR}} a' => 'font-weight: {{VALUE}}'
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
					'{{SELECTOR}} a' => 'text-transform: {{VALUE}}'
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
					'{{SELECTOR}} a' => 'font-style: {{VALUE}}'
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
					'{{SELECTOR}} .item-child' => 'letter-spacing: {{VALUE}}{{UNIT}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_1[] = new EditorSectionField(
			[
				'label'       => 'Layout',
				'name'        => 'menu-layout-separator',
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
				'label'       => 'Padding:',
				'name'        => 'padding-field-menu',
				'visibility'  => true,
				'type'        => self::FIELD_SPACING,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => [
					[
						'position' => 'Top',
						'value'    => '10',
					],
					[
						'position' => 'Right',
						'value'    => '10',
					],
					[
						'position' => 'Bottom',
						'value'    => '10',
					],
					[
						'position' => 'Left',
						'value'    => '10',
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
					'{{SELECTOR}} .item-child > ul > li > a.item' => [
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

		$fields_1[] = new EditorSectionField(
			[
				'label'       => 'Margin:',
				'name'        => 'margin-field-menu',
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
					'{{SELECTOR}} .item-child > ul > li' => [
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
				'name'        => 'menu-border-radius-field',
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
					'{{SELECTOR}} .menu-default' => [
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

		$fields_2 = [];

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Style:',
				'name'        => 'menu-style-type-field',
				'visibility'  => true,
				'type'        => self::FIELD_DROPDOWN,
				'controller'  => 'menu',
				'edit'        => self::EDIT_CLASS,
				'value'       => [
					[
						'label'    => 'Default',
						'value'    => '',
						'extra'    => [],
						'selected' => true,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => 'Style 1',
						'value'    => 'menu-style-1',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => [
								'menu-style-1-border-field',
								'menu-style-1-border-color-field'
							]
						]
					],
					[
						'label'    => 'Style 2',
						'value'    => 'menu-style-2',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => [
								'menu-style-2-item-bg-field',
								'menu-style-2-item-border-radius-field'
							]
						]
					],
					[
						'label'    => 'Style 3',
						'value'    => 'menu-style-3',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => [
								'menu-style-3-border-field',
								'menu-style-3-border-color-field',
								'menu-style-3-item-border-radius-field'
							]
						]
					],
					[
						'label'    => 'Style 4',
						'value'    => 'menu-style-4',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => [
								'menu-style-4-item-bg-field'
							]
						]
					],
					[
						'label'    => 'Style 5',
						'value'    => 'menu-style-5',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => [
								'menu-style-5-item-border-bg-field'
							]
						]
					],
					[
						'label'    => 'Style 6',
						'value'    => 'menu-style-6',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => [
								'menu-style-6-item-border-bg-field'
							]
						]
					],
					[
						'label'    => 'Style 7',
						'value'    => 'menu-style-7',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => [
								'menu-style-7-item-border-bg-field'
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
				'label'       => 'Normal style',
				'name'        => 'menu-normal-style-separator',
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
				'name'        => 'menu-color-field',
				'visibility'  => true,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => 'rgb(0,0,0)',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} .menu-default > ul > li > a'                         => 'color: {{VALUE}}',
					'{{SELECTOR}} .menu-default > ul > li.flexMenu-viewMore > a:after' => 'color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Background:',
				'name'        => 'menu-bg-field',
				'visibility'  => true,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} .menu-default' => 'background-color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Hover style',
				'name'        => 'menu-hover-style-separator',
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
				'name'        => 'menu-hover-color-field',
				'visibility'  => true,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => 'rgb(255,51,102)',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} .menu-default > ul > li:hover > a'                         => 'color: {{VALUE}}',
					'{{SELECTOR}} .menu-default > ul > li.menu-item.current-menu-item > a'   => 'color: {{VALUE}}',
					'{{SELECTOR}} .menu-default > ul > li.flexMenu-viewMore:hover > a:after' => 'color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Item border width:',
				'name'        => 'menu-style-1-border-field',
				'visibility'  => false,
				'type'        => self::FIELD_INPUT_NUMBER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '3',
				'units'       => [
					[
						'type'   => 'px',
						'active' => true,
					],
				],
				'selector'    => [
					'{{SELECTOR}} .menu-style-1 > ul > li.menu-item > a::before' => 'height: {{VALUE}}{{UNIT}}',
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Item border color:',
				'name'        => 'menu-style-1-border-color-field',
				'visibility'  => false,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => 'rgb(255,51,102)',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}}  .menu-style-1 > ul > li.menu-item > a::before' => 'background: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Item background:',
				'name'        => 'menu-style-2-item-bg-field',
				'visibility'  => false,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} .menu-style-2 > ul > li.menu-item.current-menu-item > a' => 'background: {{VALUE}}',
					'{{SELECTOR}} .menu-style-2 > ul > li.menu-item:hover > a'             => 'background: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Item border radius:',
				'name'        => 'menu-style-2-item-border-radius-field',
				'visibility'  => false,
				'type'        => self::FIELD_BORDER_RADIUS,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => [
					[
						'value'    => '3',
						'position' => 'Top left'
					],
					[
						'value'    => '3',
						'position' => 'Top right'
					],
					[
						'value'    => '3',
						'position' => 'Bottom right'
					],
					[
						'value'    => '3',
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
					'{{SELECTOR}} .menu-style-2 > ul > li.menu-item.current-menu-item > a' => [
						'border-top-left-radius: {{VALUE_1}}{{UNIT}}',
						'border-top-right-radius: {{VALUE_2}}{{UNIT}}',
						'border-bottom-right-radius: {{VALUE_3}}{{UNIT}}',
						'border-bottom-left-radius: {{VALUE_4}}{{UNIT}}'
					],
					'{{SELECTOR}} .menu-style-2 > ul > li.menu-item:hover > a'             => [
						'border-top-left-radius: {{VALUE_1}}{{UNIT}}',
						'border-top-right-radius: {{VALUE_2}}{{UNIT}}',
						'border-bottom-right-radius: {{VALUE_3}}{{UNIT}}',
						'border-bottom-left-radius: {{VALUE_4}}{{UNIT}}'
					],
					'{{SELECTOR}} .menu-style-2 > ul > li.menu-item.has-submenu .submenu'  => [
						'border-top-right-radius: {{VALUE_2}}{{UNIT}}',
						'border-bottom-right-radius: {{VALUE_3}}{{UNIT}}',
						'border-bottom-left-radius: {{VALUE_4}}{{UNIT}}'
					]
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Item border width:',
				'name'        => 'menu-style-3-border-field',
				'visibility'  => false,
				'type'        => self::FIELD_INPUT_NUMBER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '3',
				'units'       => [
					[
						'type'   => 'px',
						'active' => true,
					],
				],
				'selector'    => [
					'{{SELECTOR}} .menu-style-3 > ul > li.menu-item > a' => 'border-width: {{VALUE}}{{UNIT}}',
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Item border color:',
				'name'        => 'menu-style-3-border-color-field',
				'visibility'  => false,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => 'rgb(255,51,102)',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} .menu-style-3 > ul > li.menu-item:hover > a'             => 'border-color: {{VALUE}}',
					'{{SELECTOR}} .menu-style-3 > ul > li.menu-item.current-menu-item > a' => 'border-color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Item border radius:',
				'name'        => 'menu-style-3-item-border-radius-field',
				'visibility'  => false,
				'type'        => self::FIELD_BORDER_RADIUS,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => [
					[
						'value'    => '3',
						'position' => 'Top left'
					],
					[
						'value'    => '3',
						'position' => 'Top right'
					],
					[
						'value'    => '3',
						'position' => 'Bottom right'
					],
					[
						'value'    => '3',
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
					'{{SELECTOR}} .menu-style-3 > ul > li.menu-item > a' => [
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

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Item background:',
				'name'        => 'menu-style-4-item-bg-field',
				'visibility'  => false,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} .menu-style-4 > ul > li.menu-item > a:after' => 'background: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Item border color:',
				'name'        => 'menu-style-5-item-border-bg-field',
				'visibility'  => false,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => 'rgb(255,51,102)',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} .menu-style-5 > ul > li.menu-item > a::before' => 'background: {{VALUE}}',
					'{{SELECTOR}} .menu-style-5 > ul > li.menu-item > a::after'  => 'background: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Item border color:',
				'name'        => 'menu-style-6-item-border-bg-field',
				'visibility'  => false,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => 'rgb(255,51,102)',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} .menu-style-6 > ul > li.menu-item > a::before' => 'background: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Item border color:',
				'name'        => 'menu-style-7-item-border-bg-field',
				'visibility'  => false,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => 'rgb(255,51,102)',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} .menu-style-7 > ul > li.menu-item > a::before' => 'border-color: {{VALUE}}',
					'{{SELECTOR}} .menu-style-7 > ul > li.menu-item > a::after'  => 'border-color: {{VALUE}}',
					'{{SELECTOR}} .menu-style-7 > ul > li.menu-item::before'     => 'border-color: {{VALUE}}',
					'{{SELECTOR}} .menu-style-7 > ul > li.menu-item::after'      => 'border-color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_3 = [];

		$fields_3[] = new EditorSectionField(
			[
				'label'       => 'Container padding:',
				'name'        => 'padding-submenu-box-field',
				'visibility'  => true,
				'type'        => self::FIELD_SPACING,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => [
					[
						'position' => 'Top',
						'value'    => '8',
					],
					[
						'position' => 'Right',
						'value'    => '8',
					],
					[
						'position' => 'Bottom',
						'value'    => '8',
					],
					[
						'position' => 'Left',
						'value'    => '8',
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
					'{{SELECTOR}} .item-child > ul > li ul' => [
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


		$fields_3[] = new EditorSectionField(
			[
				'label'       => 'Items padding:',
				'name'        => 'padding-submenu-field',
				'visibility'  => true,
				'type'        => self::FIELD_SPACING,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => [
					[
						'position' => 'Top',
						'value'    => '5',
					],
					[
						'position' => 'Right',
						'value'    => '5',
					],
					[
						'position' => 'Bottom',
						'value'    => '5',
					],
					[
						'position' => 'Left',
						'value'    => '5',
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
					'{{SELECTOR}} .item-child > ul > li ul > li > a.item' => [
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

		$fields_3[] = new EditorSectionField(
			[
				'label'       => 'Style',
				'name'        => 'submenu-style-separator',
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
				'name'        => 'submenu-color-field',
				'visibility'  => true,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => 'rgb(0,0,0)',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} ul li > ul.submenu a' => 'color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_3[] = new EditorSectionField(
			[
				'label'       => 'Background:',
				'name'        => 'menu-drop-bg-field',
				'visibility'  => true,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => 'rgb(255, 255, 255)',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} ul li > ul.submenu' => 'background-color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_3[] = new EditorSectionField(
			[
				'label'       => 'Hover style',
				'name'        => 'submenu-hover-style-separator',
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
				'name'        => 'submenu-hover-color-field',
				'visibility'  => true,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}} ul li > ul.submenu li:hover a' => 'color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$this->addSection( new EditorSection( [
			'title' => $this->name,
			'name'  => 'option-section'
		] ), $fields_1 );

		$this->addSection( new EditorSection( [
			'title' => 'Menu style',
			'name'  => 'menu-section',
			'state' => true
		] ), $fields_2 );

		$this->addSection( new EditorSection( [
			'title' => 'Submenu',
			'name'  => 'submenu-section',
			'state' => true
		] ), $fields_3 );

		$this->setBoxDefaults( [
			self::ADVANCED_FULL_HEIGHT => [
				'value' => 'is-full-height'
			]
		] );

		$this->setBoxDefaults( [
			self::ADVANCED_MARGIN => [
				'value' => [ 0, 30, 0, 30 ]
			]
		] );
	}
}
