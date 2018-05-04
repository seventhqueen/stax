<?php
/**
 * Text component.
 *
 * @package Stax
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since 1.0
 */

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ElementText extends Element implements ElementInterface {
	/**
	 * ElementText constructor.
	 */
	public function __construct() {
		parent::__construct();
		$this->name        = 'Text';
		$this->slug        = 'text';
		$this->icon->size  = 'mdi-24px';
		$this->icon->type  = 'mdi-format-text';
		$this->icon->color = 'sq-textItem';
		$this->template    = '<div class="item sq-text" data-controller="container"><div class="item-child"></div></div>';

		$fields = [];

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Text:',
				'name'        => 'text-field',
				'visibility'  => true,
				'type'        => self::FIELD_TEXT_EDITOR,
				'controller'  => 'container',
				'edit'        => self::EDIT_INNER,
				'value'       => 'This is a demo text',
				'units'       => [],
				'selector'    => [],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields[] = new EditorSectionField(
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

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Font family:',
				'name'        => 'text-font-family-field',
				'visibility'  => true,
				'type'        => self::FIELD_FONT_FAMILY,
				'controller'  => '',
				'edit'        => self::EDIT_FONT,
				'value'       => '',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}}' => 'font-family: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Font size:',
				'name'        => 'text-font-size-field',
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
					'{{SELECTOR}}' => 'font-size: {{VALUE}}{{UNIT}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields[] = new EditorSectionField(
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
					'{{SELECTOR}}' => 'font-weight: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Line height:',
				'name'        => 'text-line-height-field',
				'visibility'  => true,
				'type'        => self::FIELD_INPUT_NUMBER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '20',
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
					'{{SELECTOR}}' => 'line-height: {{VALUE}}{{UNIT}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Letter spacing:',
				'name'        => 'text-letter-spacing-field',
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
					'{{SELECTOR}}' => 'letter-spacing: {{VALUE}}{{UNIT}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Style',
				'name'        => 'text-style-separator',
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
				'name'        => 'text-color-field',
				'visibility'  => true,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}}' => 'color: {{VALUE}}'
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
			self::ADVANCED_PADDING => [
				'value' => [ 10, 6, 10, 6 ]
			],
			self::ADVANCED_MARGIN  => [
				'value' => [ 0, 2, 0, 2 ]
			]
		] );
	}
}
