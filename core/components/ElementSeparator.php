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

class ElementSeparator extends Element implements ElementInterface {
	/**
	 * ElementSeparator constructor.
	 */
	public function __construct() {
		parent::__construct();
		$this->name        = 'Separator';
		$this->slug        = 'separator';
		$this->icon->size  = 'mdi-24px';
		$this->icon->type  = 'mdi-format-horizontal-align-center';
		$this->icon->color = 'sq-textItem';
		$this->template    = '<div class="item sq-separator" data-controller="container"><div class="item-child"></div></div>';

		$fields = [];

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
				'label'       => 'Background:',
				'name'        => 'separator-bg-color-field',
				'visibility'  => true,
				'type'        => self::FIELD_COLOR_PICKER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => 'rgb(204,204,204)',
				'units'       => [],
				'selector'    => [
					'{{SELECTOR}}' => 'background-color: {{VALUE}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Height:',
				'name'        => 'separator-height-field',
				'visibility'  => true,
				'type'        => self::FIELD_INPUT_NUMBER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '26',
				'units'       => [
					[
						'type'   => 'px',
						'active' => true
					]
				],
				'selector'    => [
					'{{SELECTOR}}' => 'height: {{VALUE}}{{UNIT}}'
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Width:',
				'name'        => 'separator-width-field',
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
					'{{SELECTOR}}' => 'width: {{VALUE}}{{UNIT}}'
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
				'value' => [ 20, 0, 20, 0 ]
			]
		] );
	}
}
