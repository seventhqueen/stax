<?php

/**
 * Header component.
 *
 * @package Stax
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since 1.0
 */
namespace Stax;

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
class Header extends ElementSpecs implements  HeaderInterface 
{
    public 
        $name,
        $slug,
        $type,
        $uuid,
        $icon,
        $template,
        $builder,
        $frontend,
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
        $mobileCSS
    ;
    /**
     * Header constructor.
     */
    public function __construct()
    {
        $this->name = 'Header';
        $this->slug = 'header';
        $this->type = 'header';
        $this->uuid = '';
        $this->icon = (object) [
            'size'  => 'mdi-24px',
            'type'  => 'mdi-application',
            'color' => 'sq-headerItem',
        ];
        $this->template = '<header class="header-section stax-hs" data-controller="header-section">' . '<div class="header-content sq-container-fluid">' . '<div class="sq-row">' . '{{columns}}' . '</div>' . '</div>' . '</header>';
        $this->builder = '';
        $this->frontend = (object) [
            'desktop' => (object) [
            'auth'     => '',
            'not_auth' => '',
        ],
            'tablet'  => (object) [
            'auth'     => '',
            'not_auth' => '',
        ],
            'mobile'  => (object) [
            'auth'     => '',
            'not_auth' => '',
        ],
        ];
        $this->authOption = '';
        $this->visibilityDesktop = true;
        $this->visibilityTablet = true;
        $this->visibilityMobile = true;
        $this->customDesktop = false;
        $this->customTablet = false;
        $this->customMobile = false;
        $this->editor = [];
        $this->desktop = [];
        $this->tablet = [];
        $this->mobile = [];
        $this->generalCSS = '';
        $this->desktopCSS = '';
        $this->tabletCSS = '';
        $this->mobileCSS = '';
        $this->editor();
        $this->advancedEditor();
    }
    
    /**
     * @param EditorSection $section
     */
    protected function addSection( EditorSection $section )
    {
        $this->editor[] = $section;
    }
    
    /**
     *
     */
    private function editor()
    {
        $section_1 = new EditorSection( [
            'title' => 'Options',
            'name'  => 'default-options',
            'state' => false,
            'icon'  => 'mdi-header-options',
        ] );
        $fields_1 = [];
        $fields_1[] = new EditorSectionField( [
            'label'       => 'Type',
            'name'        => 'type',
            'visibility'  => true,
            'type'        => self::FIELD_DROPDOWN,
            'controller'  => 'header-settings',
            'edit'        => self::EDIT_CLASS,
            'value'       => [ [
            'label'    => 'Default',
            'value'    => 'header-default',
            'extra'    => [],
            'selected' => true,
            'trigger'  => [
            'section' => [],
            'field'   => [ 'width-field' ],
        ],
        ], [
            'label'    => 'Boxed',
            'value'    => 'header-boxed',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [ 'width-field' ],
        ],
        ], [
            'label'    => 'Full width',
            'value'    => 'header-fullwidth',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [],
        ],
        ] ],
            'units'       => [],
            'selector'    => [],
            'tooltip'     => 'Choose from different container widths.',
            'editorClass' => [],
        ] );
        $fields_1[] = new EditorSectionField( [
            'label'       => 'Height:',
            'name'        => 'height-field',
            'visibility'  => true,
            'type'        => self::FIELD_INPUT_NUMBER,
            'controller'  => 'header-section',
            'edit'        => 'data-height',
            'value'       => '80',
            'units'       => [ [
            'type'   => 'px',
            'active' => true,
        ] ],
            'selector'    => [
            '{{SELECTOR}}'                    => 'height: {{VALUE}}{{UNIT}}',
            '.header-section{{SELECTOR}} img' => 'max-height: {{VALUE}}{{UNIT}}',
        ],
            'tooltip'     => 'Set header height.',
            'editorClass' => [],
        ] );
        $fields_1[] = new EditorSectionField( [
            'label'       => 'Width',
            'name'        => 'width-field',
            'visibility'  => true,
            'type'        => self::FIELD_INPUT_NUMBER,
            'controller'  => '',
            'edit'        => self::EDIT_CSS,
            'value'       => '1200',
            'units'       => [ [
            'type'   => 'px',
            'active' => true,
        ] ],
            'selector'    => [
            '{{SELECTOR}} .header-content, {{SELECTOR}}.header-boxed' => 'max-width: {{VALUE}}{{UNIT}}',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_1[] = new EditorSectionField( [
            'label'       => 'Background image:',
            'name'        => 'bg-image-switch-field',
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
            'bg-img-upload-field',
            'bg-img-repeat-field',
            'bg-img-position-field',
            'bg-img-size-field'
        ],
        ],
        ] ],
            'units'       => [],
            'selector'    => [],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_1[] = new EditorSectionField( [
            'label'       => 'Image',
            'name'        => 'bg-img-upload-field',
            'visibility'  => false,
            'type'        => self::FIELD_IMAGE,
            'controller'  => '',
            'edit'        => self::EDIT_CSS,
            'value'       => '',
            'units'       => [],
            'selector'    => [
            '{{SELECTOR}}' => 'background-image: url("{{VALUE}}")',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_1[] = new EditorSectionField( [
            'label'       => 'Image repeat:',
            'name'        => 'bg-img-repeat-field',
            'visibility'  => false,
            'type'        => self::FIELD_DROPDOWN,
            'controller'  => '',
            'edit'        => self::EDIT_CSS,
            'value'       => [
            [
            'label'    => 'No repeat',
            'value'    => 'no-repeat',
            'extra'    => [],
            'selected' => true,
            'trigger'  => [
            'section' => [],
            'field'   => [],
        ],
        ],
            [
            'label'    => 'Repeat X & Y',
            'value'    => 'repeat',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [],
        ],
        ],
            [
            'label'    => 'Repeat X',
            'value'    => 'repeat-x',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [],
        ],
        ],
            [
            'label'    => 'Repeat Y',
            'value'    => 'repeat-y',
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
            '{{SELECTOR}}' => 'background-repeat: {{VALUE}}',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_1[] = new EditorSectionField( [
            'label'       => 'Image position:',
            'name'        => 'bg-img-position-field',
            'visibility'  => false,
            'type'        => self::FIELD_DROPDOWN,
            'controller'  => '',
            'edit'        => self::EDIT_CSS,
            'value'       => [
            [
            'label'    => 'Custom',
            'value'    => '',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [ 'img-position-custom-field' ],
        ],
        ],
            [
            'label'    => 'Center top',
            'value'    => 'center top',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [],
        ],
        ],
            [
            'label'    => 'Center center',
            'value'    => 'center center',
            'extra'    => [],
            'selected' => true,
            'trigger'  => [
            'section' => [],
            'field'   => [],
        ],
        ],
            [
            'label'    => 'Center bottom',
            'value'    => 'center bottom',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [],
        ],
        ],
            [
            'label'    => 'Left top',
            'value'    => 'left top',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [],
        ],
        ],
            [
            'label'    => 'Left center',
            'value'    => 'left center',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [],
        ],
        ],
            [
            'label'    => 'Left bottom',
            'value'    => 'left bottom',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [],
        ],
        ],
            [
            'label'    => 'Right top',
            'value'    => 'right top',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [],
        ],
        ],
            [
            'label'    => 'Right center',
            'value'    => 'right center',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [],
        ],
        ],
            [
            'label'    => 'Right bottom',
            'value'    => 'right bottom',
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
            '{{SELECTOR}}' => 'background-position: {{VALUE}}',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_1[] = new EditorSectionField( [
            'label'       => 'Left / Top offset:',
            'name'        => 'img-position-custom-field',
            'visibility'  => false,
            'type'        => self::FIELD_DOUBLE_INPUT,
            'controller'  => '',
            'edit'        => self::EDIT_CSS,
            'value'       => [ [
            'position' => 'Left',
            'value'    => '0',
        ], [
            'position' => 'Top',
            'value'    => '0',
        ] ],
            'units'       => [ [
            'type'   => 'px',
            'active' => true,
        ], [
            'type'   => '%',
            'active' => false,
        ] ],
            'selector'    => [
            '{{SELECTOR}}' => 'background-position: {{VALUE_1}}{{UNIT}} {{VALUE_2}}{{UNIT}}',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_1[] = new EditorSectionField( [
            'label'       => 'Image size:',
            'name'        => 'bg-img-size-field',
            'visibility'  => false,
            'type'        => self::FIELD_DROPDOWN,
            'controller'  => '',
            'edit'        => self::EDIT_CSS,
            'value'       => [
            [
            'label'    => 'Custom',
            'value'    => '',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [ 'bg-img-custom-size-field' ],
        ],
        ],
            [
            'label'    => 'Auto',
            'value'    => 'auto',
            'extra'    => [],
            'selected' => true,
            'trigger'  => [
            'section' => [],
            'field'   => [],
        ],
        ],
            [
            'label'    => 'Cover',
            'value'    => 'cover',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [],
        ],
        ],
            [
            'label'    => 'Contain',
            'value'    => 'contain',
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
            '{{SELECTOR}}' => 'background-size: {{VALUE}}',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_1[] = new EditorSectionField( [
            'label'       => 'Custom size:',
            'name'        => 'bg-img-custom-size-field',
            'visibility'  => false,
            'type'        => self::FIELD_INPUT_NUMBER,
            'controller'  => '',
            'edit'        => self::EDIT_CSS,
            'value'       => '',
            'units'       => [ [
            'type'   => 'px',
            'active' => true,
        ], [
            'type'   => '%',
            'active' => false,
        ] ],
            'selector'    => [
            '{{SELECTOR}}' => 'background-size: {{VALUE}}{{UNIT}}',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $section_2 = new EditorSection( [
            'title' => 'Sticky Header',
            'name'  => 'sticky-options',
            'state' => false,
            'icon'  => 'mdi-header-options',
        ] );
        $fields_2 = [];
        $fields_2[] = new EditorSectionField( [
            'label'       => 'Enable Sticky',
            'name'        => 'sticky-field',
            'visibility'  => true,
            'type'        => self::FIELD_SWITCH,
            'controller'  => 'header-settings',
            'edit'        => self::EDIT_CLASS,
            'value'       => [ [
            'label'   => '',
            'value'   => 'header-sticky',
            'extra'   => [],
            'checked' => false,
            'trigger' => [
            'section' => [],
            'field'   => [
            'resize-separator',
            'resize-field',
            'slide-separator',
            'slide-up-field',
            'transparent-separator',
            'transparent-field',
            'shadow-separator',
            'shadow-sticky-field'
        ],
        ],
        ] ],
            'units'       => [],
            'selector'    => [],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_2[] = new EditorSectionField( [
            'label'       => 'Shadow',
            'name'        => 'shadow-separator',
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
        $fields_2[] = new EditorSectionField( [
            'label'       => '',
            'name'        => 'shadow-sticky-field',
            'visibility'  => false,
            'type'        => self::FIELD_SHADOW,
            'controller'  => '',
            'edit'        => self::EDIT_CSS,
            'value'       => [
            [
            'position' => 'Color',
            'value'    => '',
        ],
            [
            'position' => 'X',
            'value'    => '',
        ],
            [
            'position' => 'Y',
            'value'    => '',
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
            '{{SELECTOR}}.is-sticky' => [ '-webkit-box-shadow: {{X}}{{UNIT}} {{Y}}{{UNIT}} {{BLUR}}{{UNIT}} {{SPREAD}}{{UNIT}} {{COLOR}}', '-moz-box-shadow: {{X}}{{UNIT}} {{Y}}{{UNIT}} {{BLUR}}{{UNIT}} {{SPREAD}}{{UNIT}} {{COLOR}}', 'box-shadow: {{X}}{{UNIT}} {{Y}}{{UNIT}} {{BLUR}}{{UNIT}} {{SPREAD}}{{UNIT}} {{COLOR}}' ],
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_2[] = new EditorSectionField( [
            'label'       => '',
            'name'        => 'resize-separator',
            'visibility'  => false,
            'type'        => self::FIELD_SEPARATOR,
            'controller'  => '',
            'edit'        => '',
            'value'       => '',
            'units'       => [],
            'selector'    => [],
            'tooltip'     => '',
            'editorClass' => [ 'padding-xs' ],
        ] );
        if ( stax_fs()->is_not_paying() || !stax_fs()->is_premium() ) {
            $fields_2[] = new EditorSectionField( [
                'label'       => 'Enable Resize',
                'name'        => 'resize-field',
                'visibility'  => true,
                'type'        => self::FIELD_GO_PRO,
                'controller'  => '',
                'edit'        => '',
                'value'       => '',
                'units'       => [],
                'selector'    => [],
                'tooltip'     => '',
                'editorClass' => [],
            ] );
        }
        $fields_2[] = new EditorSectionField( [
            'label'       => '',
            'name'        => 'slide-separator',
            'visibility'  => false,
            'type'        => self::FIELD_SEPARATOR,
            'controller'  => '',
            'edit'        => '',
            'value'       => '',
            'units'       => [],
            'selector'    => [],
            'tooltip'     => '',
            'editorClass' => [ 'padding-xs' ],
        ] );
        if ( stax_fs()->is_not_paying() || !stax_fs()->is_premium() ) {
            $fields_2[] = new EditorSectionField( [
                'label'       => 'Enable Hide & Reveal',
                'name'        => 'slide-up-field',
                'visibility'  => true,
                'type'        => self::FIELD_GO_PRO,
                'controller'  => '',
                'edit'        => '',
                'value'       => '',
                'units'       => [],
                'selector'    => [],
                'tooltip'     => '',
                'editorClass' => [],
            ] );
        }
        $fields_2[] = new EditorSectionField( [
            'label'       => '',
            'name'        => 'transparent-separator',
            'visibility'  => false,
            'type'        => self::FIELD_SEPARATOR,
            'controller'  => '',
            'edit'        => '',
            'value'       => '',
            'units'       => [],
            'selector'    => [],
            'tooltip'     => '',
            'editorClass' => [ 'padding-xs' ],
        ] );
        if ( stax_fs()->is_not_paying() || !stax_fs()->is_premium() ) {
            $fields_2[] = new EditorSectionField( [
                'label'       => 'Enable Transparent',
                'name'        => 'transparent-field',
                'visibility'  => true,
                'type'        => self::FIELD_GO_PRO,
                'controller'  => '',
                'edit'        => '',
                'value'       => '',
                'units'       => [],
                'selector'    => [],
                'tooltip'     => '',
                'editorClass' => [],
            ] );
        }
        foreach ( $fields_1 as $field ) {
            $section_1->addField( $field );
        }
        foreach ( $fields_2 as $field ) {
            $section_2->addField( $field );
        }
        $this->editor[] = $section_1;
        $this->editor[] = $section_2;
    }
    
    /**
     *
     */
    private function advancedEditor()
    {
        $section_1 = new EditorSection( [
            'title' => 'Layout',
            'name'  => 'layout-advanced',
            'state' => false,
            'icon'  => 'mdi-advanced',
        ] );
        $fields_1 = [];
        $fields_1[] = new EditorSectionField( [
            'label'       => 'Padding:',
            'name'        => 'padding-field-advanced',
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
            '{{SELECTOR}}' => [
            'padding-top: {{VALUE_1}}{{UNIT}}',
            'padding-right: {{VALUE_2}}{{UNIT}}',
            'padding-bottom: {{VALUE_3}}{{UNIT}}',
            'padding-left: {{VALUE_4}}{{UNIT}}'
        ],
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_1[] = new EditorSectionField( [
            'label'       => 'Margin:',
            'name'        => 'margin-field-advanced',
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
            '{{SELECTOR}}' => [
            'margin-top: {{VALUE_1}}{{UNIT}}',
            'margin-right: {{VALUE_2}}{{UNIT}}',
            'margin-bottom: {{VALUE_3}}{{UNIT}}',
            'margin-left: {{VALUE_4}}{{UNIT}}'
        ],
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_1[] = new EditorSectionField( [
            'label'       => 'Border radius:',
            'name'        => 'border-normal-radius-field-advanced',
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
            '{{SELECTOR}}' => [
            'border-top-left-radius: {{VALUE_1}}{{UNIT}}',
            'border-top-right-radius: {{VALUE_2}}{{UNIT}}',
            'border-bottom-right-radius: {{VALUE_3}}{{UNIT}}',
            'border-bottom-left-radius: {{VALUE_4}}{{UNIT}}'
        ],
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $section_2 = new EditorSection( [
            'title' => 'Style',
            'name'  => 'normal-style-advanced',
            'state' => false,
            'icon'  => 'mdi-advanced',
        ] );
        $fields_2 = [];
        $fields_2[] = new EditorSectionField( [
            'label'       => 'Background:',
            'name'        => 'bg-color-field-advanced',
            'visibility'  => true,
            'type'        => self::FIELD_COLOR_PICKER,
            'controller'  => '',
            'edit'        => self::EDIT_CSS,
            'value'       => 'rgb(255, 255, 255)',
            'units'       => [],
            'selector'    => [
            '{{SELECTOR}}' => 'background-color: {{VALUE}}',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_2[] = new EditorSectionField( [
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
            'field'   => [ 'border-width-field-advanced', 'border-color-field-advanced' ],
        ],
        ],
            [
            'label'    => 'Double',
            'value'    => 'double',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [ 'border-width-field-advanced', 'border-color-field-advanced' ],
        ],
        ],
            [
            'label'    => 'Dotted',
            'value'    => 'dotted',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [ 'border-width-field-advanced', 'border-color-field-advanced' ],
        ],
        ],
            [
            'label'    => 'Dashed',
            'value'    => 'dashed',
            'extra'    => [],
            'selected' => false,
            'trigger'  => [
            'section' => [],
            'field'   => [ 'border-width-field-advanced', 'border-color-field-advanced' ],
        ],
        ]
        ],
            'units'       => [],
            'selector'    => [
            '{{SELECTOR}}' => 'border-style: {{VALUE}}',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_2[] = new EditorSectionField( [
            'label'       => 'Border width:',
            'name'        => 'border-width-field-advanced',
            'visibility'  => false,
            'type'        => self::FIELD_SPACING,
            'controller'  => '',
            'edit'        => self::EDIT_CSS,
            'value'       => [
            [
            'position' => 'Top',
            'value'    => '0',
        ],
            [
            'position' => 'Right',
            'value'    => '0',
        ],
            [
            'position' => 'Bottom',
            'value'    => '1',
        ],
            [
            'position' => 'Left',
            'value'    => '0',
        ]
        ],
            'units'       => [ [
            'type'   => 'px',
            'active' => true,
        ] ],
            'selector'    => [
            '{{SELECTOR}}' => [
            'border-top-width: {{VALUE_1}}{{UNIT}}',
            'border-right-width: {{VALUE_2}}{{UNIT}}',
            'border-bottom-width: {{VALUE_3}}{{UNIT}}',
            'border-left-width: {{VALUE_4}}{{UNIT}}'
        ],
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_2[] = new EditorSectionField( [
            'label'       => 'Border color:',
            'name'        => 'border-color-field-advanced',
            'visibility'  => false,
            'type'        => self::FIELD_COLOR_PICKER,
            'controller'  => '',
            'edit'        => self::EDIT_CSS,
            'value'       => '',
            'units'       => [],
            'selector'    => [
            '{{SELECTOR}}' => 'border-color: {{VALUE}}',
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $fields_2[] = new EditorSectionField( [
            'label'       => 'Shadow:',
            'name'        => 'shadow-field-advanced',
            'visibility'  => true,
            'type'        => self::FIELD_SHADOW,
            'controller'  => '',
            'edit'        => self::EDIT_CSS,
            'value'       => [
            [
            'position' => 'Color',
            'value'    => '',
        ],
            [
            'position' => 'X',
            'value'    => '',
        ],
            [
            'position' => 'Y',
            'value'    => '',
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
            '{{SELECTOR}}' => [ '-webkit-box-shadow: {{X}}{{UNIT}} {{Y}}{{UNIT}} {{BLUR}}{{UNIT}} {{SPREAD}}{{UNIT}} {{COLOR}}', '-moz-box-shadow: {{X}}{{UNIT}} {{Y}}{{UNIT}} {{BLUR}}{{UNIT}} {{SPREAD}}{{UNIT}} {{COLOR}}', 'box-shadow: {{X}}{{UNIT}} {{Y}}{{UNIT}} {{BLUR}}{{UNIT}} {{SPREAD}}{{UNIT}} {{COLOR}}' ],
        ],
            'tooltip'     => '',
            'editorClass' => [],
        ] );
        $section_4 = new EditorSection( [
            'title' => 'Customization',
            'name'  => 'customization-advanced',
            'state' => false,
            'icon'  => 'mdi-advanced',
        ] );
        $fields_4 = [];
        $fields_4[] = new EditorSectionField( [
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
            'editorClass' => [],
        ] );
        $fields_4[] = new EditorSectionField( [
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
            'editorClass' => [],
        ] );
        foreach ( $fields_1 as $field ) {
            $section_1->addField( $field );
        }
        foreach ( $fields_2 as $field ) {
            $section_2->addField( $field );
        }
        foreach ( $fields_4 as $field ) {
            $section_4->addField( $field );
        }
        $this->editor['advanced_layout'] = $section_1;
        $this->editor['advanced_normal_style'] = $section_2;
        $this->editor['advanced_customization'] = $section_4;
    }

}