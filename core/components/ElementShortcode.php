<?php
/**
 * Shortcode component.
 *
 * @package Stax
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since 1.0
 */

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ElementShortcode extends Element implements ElementInterface {
	/**
	 * ElementShortcode constructor.
	 */
	public function __construct() {
		parent::__construct();
		$this->name        = 'Shortcode';
		$this->slug        = 'shortcode';
		$this->icon->size  = 'mdi-24px';
		$this->icon->type  = 'mdi-code-braces';
		$this->icon->color = 'sq-shortcodeItem';
		$this->template    = '<div class="item sq-shortcode" data-controller="container"><div class="item-child"></div></div>';

		$fields = [];

		$fields[] = new EditorSectionField(
			[
				'label'       => 'Shortcode:',
				'name'        => 'shortcode-field',
				'visibility'  => true,
				'type'        => self::FIELD_TEXT_AREA,
				'controller'  => 'container',
				'edit'        => self::EDIT_SHORTCODE,
				'value'       => '[stax-demo-shortcode]',
				'units'       => [],
				'selector'    => [],
				'tooltip'     => '',
				'editorClass' => []
			]
		);

		$this->addSection( new EditorSection( [
			'title' => $this->name,
			'name'  => 'option-section'
		] ), $fields );

		$this->setBoxDefaults( [
			self::ADVANCED_MARGIN  => [
				'value' => [ 0, 2, 0, 2 ]
			]
		] );
	}
}
