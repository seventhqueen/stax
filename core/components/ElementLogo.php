<?php

/**
 * Logo component.
 *
 * @package Stax
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since 1.0
 */
namespace Stax;

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
class ElementLogo extends Element implements  ElementInterface 
{
    /**
     * ElementLogo constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->name = 'Logo';
        $this->slug = 'logo';
        $this->icon->size = 'mdi-24px';
        $this->icon->type = 'mdi-sticker-emoji';
        $this->icon->color = 'sq-logoItem';
        $this->template = '<div class="item sq-logo" data-controller="container">' . '<a class="item-child" href="#" data-controller="url"></a>' . '</div>';
        $fields_1 = [];
        $fields_1[] = new EditorSectionField( [
            'label'       => 'Logo type:',
            'name'        => 'type-field',
            'visibility'  => true,
            'type'        => self::FIELD_RADIO,
            'controller'  => 'url',
            'edit'        => self::EDIT_INNER,
            'value'       => [ [
            'label'   => 'Img',
            'value'   => '<img src="#" data-controller="img">',
            'extra'   => [],
            'checked' => true,
            'trigger' => [
            'section' => [ 'image-section', 'resized-logo-section', 'transparent-logo-section' ],
            'field'   => [],
        ],
        ], [
            'label'   => 'Text',
            'value'   => '<span class="mdi" data-controller="icon"></span><span class="logo-text" data-controller="icon-text"></span>',
            'extra'   => [],
            'checked' => false,
            'trigger' => [
            'section' => [ 'text-section', 'icon-section' ],
            'field'   => [],
        ],
        ] ],
            'units'       => [],
            'selector'    => [],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_1[] = new EditorSectionField( [
            'label'       => 'Link:',
            'name'        => 'url-field',
            'visibility'  => true,
            'type'        => self::FIELD_INPUT_URL,
            'controller'  => 'url',
            'edit'        => self::EDIT_HREF,
            'value'       => get_home_url(),
            'units'       => [],
            'selector'    => [],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_2 = [];
        $fields_2[] = new EditorSectionField( [
            'label'       => '',
            'name'        => 'img-upload-field',
            'visibility'  => true,
            'type'        => self::FIELD_IMAGE,
            'controller'  => 'img',
            'edit'        => self::EDIT_SRC,
            'value'       => STAX_ASSETS_URL . 'images/choose_your_image.png',
            'units'       => [],
            'selector'    => [],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_2[] = new EditorSectionField( [
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
            'editorClass' => [],
        ] );
        $fields_2[] = new EditorSectionField( [
            'label'       => 'Border radius:',
            'name'        => 'img-border-radius-field',
            'visibility'  => true,
            'type'        => self::FIELD_BORDER_RADIUS,
            'controller'  => '',
            'edit'        => self::EDIT_CSS,
            'value'       => [
            [
            'value'    => '',
            'position' => 'Top left',
        ],
            [
            'value'    => '',
            'position' => 'Top right',
        ],
            [
            'value'    => '',
            'position' => 'Bottom right',
        ],
            [
            'value'    => '',
            'position' => 'Bottom left',
        ]
        ],
            'units'       => [ [
            'type'   => 'px',
            'active' => true,
        ], [
            'type'   => 'em',
            'active' => false,
        ], [
            'type'   => '%',
            'active' => false,
        ] ],
            'selector'    => [
            '{{SELECTOR}} img' => [
            'border-top-left-radius: {{VALUE_1}}{{UNIT}}',
            'border-top-right-radius: {{VALUE_2}}{{UNIT}}',
            'border-bottom-right-radius: {{VALUE_3}}{{UNIT}}',
            'border-bottom-left-radius: {{VALUE_4}}{{UNIT}}'
        ],
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_2[] = new EditorSectionField( [
            'label'       => 'Logo on default header',
            'name'        => 'logo-normal-separator',
            'visibility'  => true,
            'type'        => self::FIELD_SEPARATOR,
            'controller'  => '',
            'edit'        => '',
            'value'       => '',
            'units'       => [],
            'selector'    => [],
            'tooltip'     => '',
            'editorClass' => [ 'padding-m' ],
        ] );
        $fields_2[] = new EditorSectionField( [
            'label'       => 'Image height:',
            'name'        => 'logo-normal-height-field',
            'visibility'  => true,
            'type'        => self::FIELD_INPUT_NUMBER,
            'controller'  => '',
            'edit'        => self::EDIT_CSS,
            'value'       => '',
            'units'       => [ [
            'type'   => 'px',
            'active' => true,
        ] ],
            'selector'    => [
            '.header-section {{SELECTOR}} img' => [ 'height: {{VALUE}}{{UNIT}}', 'max-height: initial !important' ],
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_3 = [];
        $fields_3[] = new EditorSectionField( [
            'label'       => 'Text:',
            'name'        => 'icon-text-field',
            'visibility'  => true,
            'type'        => self::FIELD_INPUT_TEXT,
            'controller'  => 'icon-text',
            'edit'        => self::EDIT_INNER,
            'value'       => get_bloginfo( 'name' ),
            'units'       => [],
            'selector'    => [],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_3[] = new EditorSectionField( [
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
            'editorClass' => [ 'padding-m' ],
        ] );
        $fields_3[] = new EditorSectionField( [
            'label'       => 'Font family:',
            'name'        => 'typo-font-family-field',
            'visibility'  => true,
            'type'        => self::FIELD_FONT_FAMILY,
            'controller'  => '',
            'edit'        => self::EDIT_FONT,
            'value'       => '',
            'units'       => [],
            'selector'    => [
            '{{SELECTOR}} .logo-text' => 'font-family: {{VALUE}}',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_3[] = new EditorSectionField( [
            'label'       => 'Font size:',
            'name'        => 'typo-font-size-field',
            'visibility'  => true,
            'type'        => self::FIELD_INPUT_NUMBER,
            'controller'  => '',
            'edit'        => self::EDIT_CSS,
            'value'       => '14',
            'units'       => [ [
            'type'   => 'px',
            'active' => true,
        ], [
            'type'   => 'em',
            'active' => false,
        ] ],
            'selector'    => [
            '{{SELECTOR}} .logo-text' => 'font-size: {{VALUE}}{{UNIT}}',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_3[] = new EditorSectionField( [
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
            'field'   => [],
        ],
        ],
            [
            'label'    => '200',
            'value'    => '200',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [],
        ],
        ],
            [
            'label'    => '300',
            'value'    => '300',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [],
        ],
        ],
            [
            'label'    => '400',
            'value'    => '400',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [],
        ],
        ],
            [
            'label'    => '500',
            'value'    => '500',
            'extra'    => [],
            'selected' => true,
            'trigger'  => [
            'section' => [],
            'field'   => [],
        ],
        ],
            [
            'label'    => '600',
            'value'    => '600',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [],
        ],
        ],
            [
            'label'    => '700',
            'value'    => '700',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [],
        ],
        ],
            [
            'label'    => '800',
            'value'    => '800',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [],
        ],
        ],
            [
            'label'    => '900',
            'value'    => '900',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [],
        ],
        ]
        ],
            'units'       => [],
            'selector'    => [
            '{{SELECTOR}} .logo-text' => 'font-weight: {{VALUE}}',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_3[] = new EditorSectionField( [
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
            'field'   => [],
        ],
        ],
            [
            'label'    => 'Uppercase',
            'value'    => 'uppercase',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [],
        ],
        ],
            [
            'label'    => 'Lowercase',
            'value'    => 'lowercase',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [],
        ],
        ],
            [
            'label'    => 'Capitalize',
            'value'    => 'capitalize',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [],
        ],
        ]
        ],
            'units'       => [],
            'selector'    => [
            '{{SELECTOR}} .logo-text' => 'text-transform: {{VALUE}}',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_3[] = new EditorSectionField( [
            'label'       => 'Text style:',
            'name'        => 'typo-font-type-field',
            'visibility'  => true,
            'type'        => self::FIELD_DROPDOWN,
            'controller'  => '',
            'edit'        => self::EDIT_CSS,
            'value'       => [ [
            'label'    => 'Normal',
            'value'    => 'normal',
            'extra'    => [],
            'selected' => true,
            'trigger'  => [
            'section' => [],
            'field'   => [],
        ],
        ], [
            'label'    => 'Italic',
            'value'    => 'italic',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [],
        ],
        ], [
            'label'    => 'Oblique',
            'value'    => 'oblique',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [],
        ],
        ] ],
            'units'       => [],
            'selector'    => [
            '{{SELECTOR}} .logo-text' => 'font-style: {{VALUE}}',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_3[] = new EditorSectionField( [
            'label'       => 'Letter spacing:',
            'name'        => 'typo-letter-spacing-field',
            'visibility'  => true,
            'type'        => self::FIELD_INPUT_NUMBER,
            'controller'  => '',
            'edit'        => self::EDIT_CSS,
            'value'       => '1',
            'units'       => [ [
            'type'   => 'px',
            'active' => true,
        ], [
            'type'   => 'em',
            'active' => false,
        ] ],
            'selector'    => [
            '{{SELECTOR}} .item-child' => 'letter-spacing: {{VALUE}}{{UNIT}}',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_3[] = new EditorSectionField( [
            'label'       => 'Layout',
            'name'        => 'general-style-separator',
            'visibility'  => true,
            'type'        => self::FIELD_SEPARATOR,
            'controller'  => '',
            'edit'        => '',
            'value'       => '',
            'units'       => [],
            'selector'    => [],
            'tooltip'     => '',
            'editorClass' => [ 'padding-m' ],
        ] );
        $fields_3[] = new EditorSectionField( [
            'label'       => 'Padding:',
            'name'        => 'a-padding-field',
            'visibility'  => true,
            'type'        => self::FIELD_SPACING,
            'controller'  => '',
            'edit'        => self::EDIT_CSS,
            'value'       => [
            [
            'position' => 'Top',
            'value'    => '',
        ],
            [
            'position' => 'Right',
            'value'    => '',
        ],
            [
            'position' => 'Bottom',
            'value'    => '',
        ],
            [
            'position' => 'Left',
            'value'    => '',
        ]
        ],
            'units'       => [ [
            'type'   => 'px',
            'active' => true,
        ], [
            'type'   => 'em',
            'active' => false,
        ], [
            'type'   => '%',
            'active' => false,
        ] ],
            'selector'    => [
            '{{SELECTOR}} a' => [
            'padding-top: {{VALUE_1}}{{UNIT}}',
            'padding-right: {{VALUE_2}}{{UNIT}}',
            'padding-bottom: {{VALUE_3}}{{UNIT}}',
            'padding-left: {{VALUE_4}}{{UNIT}}'
        ],
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_3[] = new EditorSectionField( [
            'label'       => 'Border radius:',
            'name'        => 'border-radius-field',
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
            'units'       => [ [
            'type'   => 'px',
            'active' => true,
        ], [
            'type'   => 'em',
            'active' => false,
        ], [
            'type'   => '%',
            'active' => false,
        ] ],
            'selector'    => [
            '{{SELECTOR}} a' => 'border-radius: {{VALUE_1}}{{UNIT}} {{VALUE_2}}{{UNIT}} {{VALUE_3}}{{UNIT}} {{VALUE_4}}{{UNIT}}',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_3[] = new EditorSectionField( [
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
            'editorClass' => [ 'padding-m' ],
        ] );
        $fields_3[] = new EditorSectionField( [
            'label'       => 'Color:',
            'name'        => 'color-field',
            'visibility'  => true,
            'type'        => self::FIELD_COLOR_PICKER,
            'controller'  => '',
            'edit'        => self::EDIT_CSS,
            'value'       => 'rgba(87, 44, 136, 1)',
            'units'       => [],
            'selector'    => [
            '{{SELECTOR}} > a' => 'color: {{VALUE}}',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_3[] = new EditorSectionField( [
            'label'       => 'Background:',
            'name'        => 'bg-color-field',
            'visibility'  => true,
            'type'        => self::FIELD_COLOR_PICKER,
            'controller'  => '',
            'edit'        => self::EDIT_CSS,
            'value'       => 'rgb(253,251,255)',
            'units'       => [],
            'selector'    => [
            '{{SELECTOR}} a' => 'background-color: {{VALUE}}',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_3[] = new EditorSectionField( [
            'label'       => 'Hover style',
            'name'        => 'text-style-hover-separator',
            'visibility'  => true,
            'type'        => self::FIELD_SEPARATOR,
            'controller'  => '',
            'edit'        => '',
            'value'       => '',
            'units'       => [],
            'selector'    => [],
            'tooltip'     => '',
            'editorClass' => [ 'padding-m' ],
        ] );
        $fields_3[] = new EditorSectionField( [
            'label'       => 'Color:',
            'name'        => 'color-hover-field',
            'visibility'  => true,
            'type'        => self::FIELD_COLOR_PICKER,
            'controller'  => '',
            'edit'        => self::EDIT_CSS,
            'value'       => 'rgba(87, 44, 136, 1)',
            'units'       => [],
            'selector'    => [
            '{{SELECTOR}}:hover > a' => 'color: {{VALUE}}',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_3[] = new EditorSectionField( [
            'label'       => 'Background:',
            'name'        => 'bg-hover-color-field',
            'visibility'  => true,
            'type'        => self::FIELD_COLOR_PICKER,
            'controller'  => '',
            'edit'        => self::EDIT_CSS,
            'value'       => 'rgb(253,251,255)',
            'units'       => [],
            'selector'    => [
            '{{SELECTOR}}:hover a' => 'background-color: {{VALUE}}',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_4 = [];
        $fields_4[] = new EditorSectionField( [
            'label'       => 'Show:',
            'name'        => 'icon-switch-field',
            'visibility'  => true,
            'type'        => self::FIELD_SWITCH,
            'controller'  => '',
            'edit'        => '',
            'value'       => [ [
            'label'   => '',
            'value'   => '',
            'extra'   => [],
            'checked' => false,
            'trigger' => [
            'section' => [],
            'field'   => [
            'icon-field',
            'icon-size-field',
            'icon-style-separator',
            'icon-padding-field',
            'icon-border-radius-field',
            'icon-normal-separator',
            'icon-color-field',
            'icon-bg-color-field',
            'icon-border-normal-type-field',
            'icon-hover-separator',
            'icon-color-hover-field',
            'icon-bg-hover-color-field',
            'icon-border-hover-type-field'
        ],
        ],
        ] ],
            'units'       => [],
            'selector'    => [],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_4[] = new EditorSectionField( [
            'label'       => 'Type:',
            'name'        => 'icon-field',
            'visibility'  => false,
            'type'        => self::FIELD_ICON,
            'controller'  => 'icon',
            'edit'        => self::EDIT_CLASS,
            'value'       => '',
            'units'       => [],
            'selector'    => [],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_4[] = new EditorSectionField( [
            'label'       => 'Size:',
            'name'        => 'icon-size-field',
            'visibility'  => false,
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
            'field'   => [],
        ],
        ],
            [
            'label'    => '24 px',
            'value'    => 'mdi-24px',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [],
        ],
        ],
            [
            'label'    => '36 px',
            'value'    => 'mdi-36px',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [],
        ],
        ],
            [
            'label'    => '48 px',
            'value'    => 'mdi-48px',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [],
        ],
        ]
        ],
            'units'       => [],
            'selector'    => [],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_4[] = new EditorSectionField( [
            'label'       => 'Layout',
            'name'        => 'icon-style-separator',
            'visibility'  => false,
            'type'        => self::FIELD_SEPARATOR,
            'controller'  => '',
            'edit'        => '',
            'value'       => '',
            'units'       => [],
            'selector'    => [],
            'tooltip'     => '',
            'editorClass' => [ 'padding-m' ],
        ] );
        $fields_4[] = new EditorSectionField( [
            'label'       => 'Padding:',
            'name'        => 'icon-padding-field',
            'visibility'  => false,
            'type'        => self::FIELD_SPACING,
            'controller'  => '',
            'edit'        => self::EDIT_CSS,
            'value'       => [
            [
            'position' => 'Top',
            'value'    => '',
        ],
            [
            'position' => 'Right',
            'value'    => '',
        ],
            [
            'position' => 'Bottom',
            'value'    => '',
        ],
            [
            'position' => 'Left',
            'value'    => '',
        ]
        ],
            'units'       => [ [
            'type'   => 'px',
            'active' => true,
        ], [
            'type'   => 'em',
            'active' => false,
        ], [
            'type'   => '%',
            'active' => false,
        ] ],
            'selector'    => [
            '{{SELECTOR}} a span.mdi' => [
            'padding-top: {{VALUE_1}}{{UNIT}}',
            'padding-right: {{VALUE_2}}{{UNIT}}',
            'padding-bottom: {{VALUE_3}}{{UNIT}}',
            'padding-left: {{VALUE_4}}{{UNIT}}'
        ],
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_4[] = new EditorSectionField( [
            'label'       => 'Border radius:',
            'name'        => 'icon-border-radius-field',
            'visibility'  => false,
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
            'units'       => [ [
            'type'   => 'px',
            'active' => true,
        ], [
            'type'   => 'em',
            'active' => false,
        ], [
            'type'   => '%',
            'active' => false,
        ] ],
            'selector'    => [
            '{{SELECTOR}} a span.mdi' => 'border-radius: {{VALUE_1}}{{UNIT}} {{VALUE_2}}{{UNIT}} {{VALUE_3}}{{UNIT}} {{VALUE_4}}{{UNIT}}',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_4[] = new EditorSectionField( [
            'label'       => 'Style',
            'name'        => 'icon-normal-separator',
            'visibility'  => false,
            'type'        => self::FIELD_SEPARATOR,
            'controller'  => '',
            'edit'        => '',
            'value'       => '',
            'units'       => [],
            'selector'    => [],
            'tooltip'     => '',
            'editorClass' => [ 'padding-m' ],
        ] );
        $fields_4[] = new EditorSectionField( [
            'label'       => 'Color:',
            'name'        => 'icon-color-field',
            'visibility'  => false,
            'type'        => self::FIELD_COLOR_PICKER,
            'controller'  => '',
            'edit'        => self::EDIT_CSS,
            'value'       => '',
            'units'       => [],
            'selector'    => [
            '{{SELECTOR}} > a span.mdi' => 'color: {{VALUE}}',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_4[] = new EditorSectionField( [
            'label'       => 'Background:',
            'name'        => 'icon-bg-color-field',
            'visibility'  => false,
            'type'        => self::FIELD_COLOR_PICKER,
            'controller'  => '',
            'edit'        => self::EDIT_CSS,
            'value'       => '',
            'units'       => [],
            'selector'    => [
            '{{SELECTOR}} a span.mdi' => 'background-color: {{VALUE}}',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_4[] = new EditorSectionField( [
            'label'       => 'Border type:',
            'name'        => 'icon-border-normal-type-field',
            'visibility'  => false,
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
            'field'   => [],
        ],
        ],
            [
            'label'    => 'Solid',
            'value'    => 'solid',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [ 'icon-border-normal-width-field', 'icon-border-normal-color-field' ],
        ],
        ],
            [
            'label'    => 'Double',
            'value'    => 'double',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [ 'icon-border-normal-width-field', 'icon-border-normal-color-field' ],
        ],
        ],
            [
            'label'    => 'Dotted',
            'value'    => 'dotted',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [ 'icon-border-normal-width-field', 'icon-border-normal-color-field' ],
        ],
        ],
            [
            'label'    => 'Dashed',
            'value'    => 'dashed',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [ 'icon-border-normal-width-field', 'icon-border-normal-color-field' ],
        ],
        ]
        ],
            'units'       => [],
            'selector'    => [
            '{{SELECTOR}} a span.mdi' => 'border-style: {{VALUE}}',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_4[] = new EditorSectionField( [
            'label'       => 'Border width:',
            'name'        => 'icon-border-normal-width-field',
            'visibility'  => false,
            'type'        => self::FIELD_INPUT_NUMBER,
            'controller'  => '',
            'edit'        => self::EDIT_CSS,
            'value'       => '1',
            'units'       => [ [
            'type'   => 'px',
            'active' => true,
        ] ],
            'selector'    => [
            '{{SELECTOR}} a span.mdi' => 'border-width: {{VALUE}}{{UNIT}}',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_4[] = new EditorSectionField( [
            'label'       => 'Border color:',
            'name'        => 'icon-border-normal-color-field',
            'visibility'  => false,
            'type'        => self::FIELD_COLOR_PICKER,
            'controller'  => '',
            'edit'        => self::EDIT_CSS,
            'value'       => '',
            'units'       => [],
            'selector'    => [
            '{{SELECTOR}} a span.mdi' => 'border-color: {{VALUE}}',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_4[] = new EditorSectionField( [
            'label'       => 'Hover style',
            'name'        => 'icon-hover-separator',
            'visibility'  => false,
            'type'        => self::FIELD_SEPARATOR,
            'controller'  => '',
            'edit'        => '',
            'value'       => '',
            'units'       => [],
            'selector'    => [],
            'tooltip'     => '',
            'editorClass' => [ 'padding-m' ],
        ] );
        $fields_4[] = new EditorSectionField( [
            'label'       => 'Color:',
            'name'        => 'icon-color-hover-field',
            'visibility'  => false,
            'type'        => self::FIELD_COLOR_PICKER,
            'controller'  => '',
            'edit'        => self::EDIT_CSS,
            'value'       => '',
            'units'       => [],
            'selector'    => [
            '{{SELECTOR}}:hover > a span.mdi' => 'color: {{VALUE}}',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_4[] = new EditorSectionField( [
            'label'       => 'Background:',
            'name'        => 'icon-bg-hover-color-field',
            'visibility'  => false,
            'type'        => self::FIELD_COLOR_PICKER,
            'controller'  => '',
            'edit'        => self::EDIT_CSS,
            'value'       => '',
            'units'       => [],
            'selector'    => [
            '{{SELECTOR}}:hover a span.mdi' => 'background-color: {{VALUE}}',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_4[] = new EditorSectionField( [
            'label'       => 'Border type:',
            'name'        => 'icon-border-hover-type-field',
            'visibility'  => false,
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
            'field'   => [],
        ],
        ],
            [
            'label'    => 'Solid',
            'value'    => 'solid',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [ 'icon-border-hover-width-field', 'icon-border-hover-color-field' ],
        ],
        ],
            [
            'label'    => 'Double',
            'value'    => 'double',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [ 'icon-border-hover-width-field', 'icon-border-hover-color-field' ],
        ],
        ],
            [
            'label'    => 'Dotted',
            'value'    => 'dotted',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [ 'icon-border-hover-width-field', 'icon-border-hover-color-field' ],
        ],
        ],
            [
            'label'    => 'Dashed',
            'value'    => 'dashed',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [ 'icon-border-hover-width-field', 'icon-border-hover-color-field' ],
        ],
        ]
        ],
            'units'       => [],
            'selector'    => [
            '{{SELECTOR}}:hover a span.mdi' => 'border-style: {{VALUE}}',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_4[] = new EditorSectionField( [
            'label'       => 'Border width:',
            'name'        => 'icon-border-hover-width-field',
            'visibility'  => false,
            'type'        => self::FIELD_INPUT_NUMBER,
            'controller'  => '',
            'edit'        => self::EDIT_CSS,
            'value'       => '1',
            'units'       => [ [
            'type'   => 'px',
            'active' => true,
        ] ],
            'selector'    => [
            '{{SELECTOR}}:hover a span.mdi' => 'border-width: {{VALUE}}{{UNIT}}',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_4[] = new EditorSectionField( [
            'label'       => 'Border color:',
            'name'        => 'icon-border-hover-color-field',
            'visibility'  => false,
            'type'        => self::FIELD_COLOR_PICKER,
            'controller'  => '',
            'edit'        => self::EDIT_CSS,
            'value'       => '',
            'units'       => [],
            'selector'    => [
            '{{SELECTOR}}:hover a span.mdi' => 'border-color: {{VALUE}}',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_5 = [];
        $fields_6 = [];
        $this->addSection( new EditorSection( [
            'title' => $this->name,
            'name'  => 'option-section',
        ] ), $fields_1 );
        $this->addSection( new EditorSection( [
            'title' => 'Image',
            'name'  => 'image-section',
        ] ), $fields_2 );
        $this->addSection( new EditorSection( [
            'title'      => 'Text',
            'name'       => 'text-section',
            'visibility' => false,
        ] ), $fields_3 );
        $this->addSection( new EditorSection( [
            'title'      => 'Icon',
            'name'       => 'icon-section',
            'visibility' => false,
        ] ), $fields_4 );
        $free = false;
        $this->addSection( new EditorSection( [
            'title'      => 'Logo on header resize',
            'name'       => 'resized-logo-section',
            'visibility' => true,
            'state'      => true,
            'free'       => $free,
        ] ), $fields_5 );
        $this->addSection( new EditorSection( [
            'title'      => 'Logo on header transparent',
            'name'       => 'transparent-logo-section',
            'visibility' => true,
            'state'      => true,
            'free'       => $free,
        ] ), $fields_6 );
        $this->setBoxDefaults( [
            self::ADVANCED_MARGIN => [
            'value' => [
            0,
            2,
            0,
            2
        ],
        ],
        ] );
    }

}