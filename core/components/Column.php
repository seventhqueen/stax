<?php
/**
 * Column component.
 *
 * @package Stax
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since 1.0
 */

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Column extends ElementSpecs implements ColumnInterface {
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
	/**
	 * @var array|bool|object|string
	 */
	public
		$name,
		$slug,
		$type,
		$uuid,
		$icon,
		$position,
		$template,
		$builder,
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
		$mobileCSS,
		$layers;

	/**
	 * Column constructor.
	 */
	public function __construct() {
		$this->name              = 'Column';
		$this->slug              = '';
		$this->type              = 'column';
		$this->uuid              = '';
		$this->icon              = (object) [
			'size'  => 'mdi-24px',
			'type'  => 'mdi-tab-unselected',
			'color' => 'sq-columnItem'
		];
		$this->position          = '';
		$this->template          = '';
		$this->builder           = '';
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
		$this->layers            = false;

		$this->editor();
		$this->advancedEditor();
	}

	/**
	 * @param EditorSection $section
	 */
	protected function addSection( EditorSection $section ) {
		$this->editor[] = $section;
	}

	/**
	 *
	 */
	private function editor() {
		$section = new EditorSection( [
			'title' => 'Layout',
			'name'  => 'default-options',
			'state' => false,
			'icon'  => 'mdi-column-options'
		] );

		$fields = [];

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Shrink Width:',
				'name'        => 'shrink-field',
				'visibility'  => true,
				'type'        => self::FIELD_DROPDOWN,
				'controller'  => 'column-settings',
				'edit'        => self::EDIT_CLASS,
				'value'       => [
					[
						'label'    => 'No',
						'value'    => '',
						'extra'    => [],
						'selected' => true,
						'trigger'  => [
							'section' => [],
							'field'   => [
								'h-align-field'
							]
						]
					],
					[
						'label'    => 'Yes',
						'value'    => 'sq-col-auto',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
				],
				'units'       => [],
				'selector'    => [],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Vertical Align:',
				'name'        => 'v-align-field',
				'visibility'  => true,
				'type'        => self::FIELD_BUTTON_GROUP,
				'controller'  => 'column-settings',
				'edit'        => self::EDIT_CLASS,
				'value'       => [
					[
						'label'    => '<span class="mdi mdi-format-vertical-align-top mdi-18px"></span>',
						'value'    => 'align-items-start',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => '<span class="mdi mdi-format-vertical-align-center mdi-18px"></span>',
						'value'    => 'align-items-center',
						'extra'    => [],
						'selected' => true,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => '<span class="mdi mdi-format-vertical-align-bottom mdi-18px"></span>',
						'value'    => 'align-items-end',
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
				'label'       => 'Horizontal Align:',
				'name'        => 'h-align-field',
				'visibility'  => true,
				'type'        => self::FIELD_BUTTON_GROUP,
				'controller'  => 'column-settings',
				'edit'        => self::EDIT_CLASS,
				'value'       => [
					[
						'label'    => '<span class="mdi mdi-format-horizontal-align-left mdi-18px"></span>',
						'value'    => 'justify-content-start',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => '<span class="mdi mdi-format-horizontal-align-center mdi-18px"></span>',
						'value'    => 'justify-content-center',
						'extra'    => [],
						'selected' => true,
						'trigger'  => [
							'section' => [],
							'field'   => []
						]
					],
					[
						'label'    => '<span class="mdi mdi-format-horizontal-align-right mdi-18px"></span>',
						'value'    => 'justify-content-end',
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


		foreach ( $fields as $field ) {
			$section->addField( $field );
		}

		$this->editor[] = $section;
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
			'title' => 'Style',
			'name'  => 'normal-style-advanced',
			'state' => false,
			'icon'  => 'mdi-advanced'
		] );

		$fields_2 = [];

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Background:',
				'name'        => 'bg-color-field-advanced',
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
				'name'        => 'border-field-advanced',
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
								'border-width-field-advanced',
								'border-color-field-advanced'
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
								'border-width-field-advanced',
								'border-color-field-advanced'
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
								'border-width-field-advanced',
								'border-color-field-advanced'
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
								'border-width-field-advanced',
								'border-color-field-advanced'
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
				'name'        => 'border-width-field-advanced',
				'visibility'  => false,
				'type'        => self::FIELD_SPACING,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => [
					[
						'position' => 'Top',
						'value'    => '0'
					],
					[
						'position' => 'Right',
						'value'    => '0'
					],
					[
						'position' => 'Bottom',
						'value'    => '0'
					],
					[
						'position' => 'Left',
						'value'    => '0'
					]
				],
				'units'       => [
					[
						'type'   => 'px',
						'active' => true
					]
				],
				'selector'    => [
					'{{SELECTOR}}' => [
						'border-top-width: {{VALUE_1}}{{UNIT}}',
						'border-right-width: {{VALUE_2}}{{UNIT}}',
						'border-bottom-width: {{VALUE_3}}{{UNIT}}',
						'border-left-width: {{VALUE_4}}{{UNIT}}'
					]
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields_2[] = new EditorSectionField(
			[
				'label'       => 'Border color:',
				'name'        => 'border-color-field-advanced',
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

		foreach ( $fields_4 as $field ) {
			$section_4->addField( $field );
		}


		$this->editor['advanced_layout']        = $section_1;
		$this->editor['advanced_normal_style']  = $section_2;
		$this->editor['advanced_customization'] = $section_4;
	}
}
