<?php
/**
 * Image component.
 *
 * @package Stax
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since 1.0
 */

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ElementImage extends Element implements ElementInterface {
	/**
	 * ElementImage constructor.
	 */
	public function __construct() {
		parent::__construct();
		$this->name        = 'Image';
		$this->slug        = 'image';
		$this->icon->size  = 'mdi-24px';
		$this->icon->type  = 'mdi-image';
		$this->icon->color = 'sq-imageItem';
		$this->template    = '<div class="item sq-image" data-controller="container">' .
		                     '<a class="item-child" href="" data-controller="url"><img src="#" class="item-image" data-controller="img"></a>' .
		                     '</div>';

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
							'field'   => [],
						]
					],
					[
						'label'    => 'Blank',
						'value'    => '_blank',
						'extra'    => [],
						'selected' => false,
						'trigger'  => [
							'section' => [],
							'field'   => [],
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
				'label'       => 'Image',
				'name'        => 'img-upload-field',
				'visibility'  => true,
				'type'        => self::FIELD_IMAGE,
				'controller'  => 'img',
				'edit'        => self::EDIT_SRC,
				'value'       => STAX_ASSETS_URL . 'images/choose_your_image.png',
				'units'       => [],
				'selector'    => [],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Caption:',
				'name'        => 'img-caption-field',
				'visibility'  => true,
				'type'        => self::FIELD_INPUT_TEXT,
				'controller'  => 'img',
				'edit'        => 'alt',
				'value'       => '',
				'units'       => [],
				'selector'    => [],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Border radius:',
				'name'        => 'image-border-radius',
				'visibility'  => true,
				'type'        => self::FIELD_BORDER_RADIUS,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => [
					[
						'position' => 'Top left',
						'value'    => '',
					],
					[
						'position' => 'Top right',
						'value'    => '',
					],
					[
						'position' => 'Bottom right',
						'value'    => '',
					],
					[
						'position' => 'Bottom left',
						'value'    => '',
					]
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
					]
				],
				'selector'    => [
					'{{SELECTOR}} .item-image' => 'border-radius: {{VALUE_1}}{{UNIT}} {{VALUE_2}}{{UNIT}} {{VALUE_3}}{{UNIT}} {{VALUE_4}}{{UNIT}}',
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Image on default header',
				'name'        => 'image-normal-separator',
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
				'label'       => 'Image height:',
				'name'        => 'image-normal-height-field',
				'visibility'  => true,
				'type'        => self::FIELD_INPUT_NUMBER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '',
				'units'       => [
					[
						'type'   => 'px',
						'active' => true,
					],
				],
				'selector'    => [
					'.header-section {{SELECTOR}} img' => [
						'height: {{VALUE}}{{UNIT}}',
						'max-height: initial !important'
					],
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Image on resized header',
				'name'        => 'image-resize-separator',
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
				'label'       => 'Image height:',
				'name'        => 'image-resize-height-field',
				'visibility'  => true,
				'type'        => self::FIELD_INPUT_NUMBER,
				'controller'  => '',
				'edit'        => self::EDIT_CSS,
				'value'       => '',
				'units'       => [
					[
						'type'   => 'px',
						'active' => true,
					],
				],
				'selector'    => [
					'.header-section.is-sticky.is-resized {{SELECTOR}} img' => [
						'height: {{VALUE}}{{UNIT}}',
						'max-height: initial !important'
					],
				],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$this->addSection( new EditorSection( [
			'title' => $this->name,
			'name'  => 'option-section',
		] ), $fields );

		$this->setBoxDefaults( [
			self::ADVANCED_MARGIN => [
				'value' => [ 0, 2, 0, 2 ]
			]
		] );

	}
}
