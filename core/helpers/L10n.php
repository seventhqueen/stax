<?php

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class L10n {
	/**
	 * @var null
	 */
	public static $instance = null;

	/**
	 * @return null|L10n
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * @return object
	 */
	public function strings() {
		return (object) [
			'auth'        => [
				'labelBoth'    => __( 'Both', 'stax' ),
				'labelAuth'    => __( 'Auth', 'stax' ),
				'labelNotAuth' => __( 'Not auth', 'stax' )
			],
			'color'       => [
				'save'   => __( 'Add color', 'stax' ),
				'preset' => __( 'Preset colors', 'stax' )
			],
			'exit'        => [
				'confirmation' => __( 'There are unsaved changes. Do you want to proceed?', 'stax' )
			],
			'save'        => [
				'changesDetected' => __( 'You made changes! Don\'t forget to', 'stax' ),
				'save'            => __( 'save', 'stax' ),
				'success'         => __( 'Great, all settings are saved now', 'stax' )
			],
			'frame'       => [
				'loading'     => __( 'LOADING', 'stax' ),
				'closeEditor' => __( 'Close editor', 'stax' ),
				'saveSuccess' => __( 'All settings are saved!', 'stax' ),
				'saveFailed'  => __( 'All settings are NOT saved!', 'stax' )
			],
			'panel'       => [
				'titleStart'            => __( 'Editing ', 'stax' ),
				'titleLayers'           => __( 'Layers', 'stax' ),
				'titleTemplates'        => __( 'Templates', 'stax' ),
				'titleSaveTemplates'    => __( 'Save current headers as template', 'stax' ),
				'titleSavedTemplates'   => __( 'Saved header templates', 'stax' ),
				'titleDefaultTemplates' => __( 'Default templates', 'stax' ),
				'titleDeletedElements'  => __( 'Deleted Elements', 'stax' ),
				'titleLayoutElements'   => __( 'Layout Elements', 'stax' ),
				'titleContentElements'  => __( 'Content Elements', 'stax' ),
				'titleSavedElements'    => __( 'Saved elements', 'stax' ),
				'titleSettings'         => __( 'Settings', 'stax' ),
				'titleSettingsRender'   => __( 'Header render', 'stax' ),
				'titleSettingsTheme'    => __( 'Editor theme', 'stax' ),
				'titleSettingsColors'   => __( 'Preset colors', 'stax' ),
				'settingsColorsInfo'    => __( 'Useful preset colors that you can use them on the entire builder.', 'stax' ),
				'settingsRenderInfo'    => __( 'Change the area where the header will be rendered.', 'stax' ),
				'selectRenderArea'      => __( 'SELECT RENDER AREA', 'stax' ),
				'selectTheme'           => __( 'Select theme', 'stax' ),
				'settingsExport'        => __( 'Header export', 'stax' ),
				'settingsImport'        => __( 'Header import', 'stax' ),
				'saveAsTemplate'        => __( 'Save header as template', 'stax' ),
				'saveAsComponent'       => __( 'Save element as template', 'stax' ),
				'searchNoTemplates'     => __( 'No templates found.', 'stax' ),
				'searchNoElements'      => __( 'No elements found. Please try again.', 'stax' ),
				'resolutionSettings'    => __( 'Apply settings for %s only', 'stax' ),
				'saveTemplateInfo'      => __( 'You can use this layout later if you save it as template.', 'stax' ),
				'templatesAllPage'      => __( 'All page headers', 'stax' ),
				'templatesIndividual'   => __( 'Individual headers', 'stax' ),
				'saveTemplateSingle'    => __( 'You can save this %s for later use.', 'stax' ),
				'settingsExportInfo'    => __( 'Export your current header to file.', 'stax' ),
				'settingsImportInfo'    => __( 'Import header to templates from file.', 'stax' ),
				'actionExport'          => __( 'Export', 'stax' ),
				'actionImport'          => __( 'Import', 'stax' )
			],
			'modal'       => [
				'base'  => [
					'yes'                  => __( 'Yes', 'stax' ),
					'no'                   => __( 'No', 'stax' ),
					'save'                 => __( 'Save', 'stax' ),
					'cancel'               => __( 'Cancel', 'stax' ),
					'continueConfirmation' => __( 'Are you sure you want to continue?', 'stax' )
				],
				'frame' => [
					'deleteElement' => __( 'Are you sure you want to move this element to trash?', 'stax' ),
					'deleteColumn'  => __( 'Are you sure you want to delete this column and all of it\'s content?', 'stax' ),
					'deleteHeader'  => __( 'Are you sure you want to delete this header and all of it\'s content?', 'stax' )
				],
				'panel' => [
					'editPage'           => [
						'singleTitle'    => __( 'Go to general mode', 'stax' ),
						'masterTitle'    => __( 'Go to page mode', 'stax' ),
						'singleSubtitle' => __( 'You are switching back to general mode. The current changes will be lost and the header will be replaced with the general one.', 'stax' ),
						'masterSubtitle' => __( 'You are switching to page mode. From now on changes will be applied only to the current page.', 'stax' ),
						'btnFromCurrent' => __( 'Yes, start from current header', 'stax' ),
						'btnFromScratch' => __( 'Yes, start from scratch', 'stax' )
					],
					'individualSettings' => [
						'singleTitle' => __( 'This item\'s settings will be set to individual for this resolution. Don\'t worry, you can switch back anytime you want.', 'stax' ),
						'masterTitle' => __( 'This item\'s settings will be set to general for this resolution. Your changes for this resolution will be lost.', 'stax' )
					],
					'template'           => [
						'saveTitle'   => __( 'You are about to save this item as template, but first you have to name your template.', 'stax' ),
						'useTitle'    => __( 'You are about to append this template to your current content.', 'stax' ),
						'deleteTitle' => __( 'This template will be deleted.', 'stax' )
					],
					'element'            => [
						'deleteTitle' => __( 'This saved element will be deleted.', 'stax' )
					],
					'header'             => [
						'renderNewTitle'    => __( 'Switch to Stax Header?', 'stax' ),
						'renderOldTitle'    => __( 'Switch to the default header?', 'stax' ),
						'renderNewSubtitle' => __( 'You are about to replace your default header with the new Stax Header. You can always switch back to your old header using this option!', 'stax' ),
						'renderOldSubtitle' => __( 'You are about to replace your Stax Header with the default header. You can always switch back to your Stax Header using this option!', 'stax' )
					],
					'goPro'              => [
						'getMore'   => __( 'Get More with', 'stax' ),
						'title'     => __( 'Instant access to all premium features and new releases!', 'stax' ),
						'subtitle'  => __( 'More challenges, Unlimited Fun.', 'stax' ),
						'btnAction' => __( 'Go Pro', 'stax' )
					],
					'defineArea'         => [
						'title'        => __( 'Define header area.', 'stax' ),
						'subtitle'     => __( 'In order to use the builder, you need to choose your existing header area:', 'stax' ),
						'selectOption' => __( 'Using your mouse, select your current header', 'stax' ),
						'inputOption'  => __( 'Let me enter a CSS selector', 'stax' )
					]
				]
			],
			'error'       => [
				'noSelection' => __( 'Please select your section to edit.', 'stax' ),
				'noSelector'  => __( 'Please enter your CSS selector', 'stax' )
			],
			'select'      => [
				'menuPlaceholder'  => __( 'Select menu', 'stax' ),
				'fontsPlaceholder' => __( 'Select font', 'stax' )
			],
			'section'     => [
				'defaultTitle' => __( 'Options', 'stax' )
			],
			'imageUpload' => [
				'change' => __( 'Change', 'stax' ),
				'add'    => __( 'Add image', 'stax' )
			]
		];
	}

}
