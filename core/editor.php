<?php
/**
 * Stax editor related file.
 *
 * @package Stax
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since 1.0
 */

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Editor
 *
 * @package Stax
 */
class Editor {
	/**
	 * Editor instance
	 *
	 * @var null
	 */
	public static $instance = null;

	/**
	 * @var Composer
	 */
	public $composer;

	const TYPE_ELEMENT = 'element',
		TYPE_COLUMN = 'column',
		TYPE_HEADER = 'header';

	/**
	 * Editor constructor.
	 */
	public function __construct() {
		add_action( 'template_redirect', [ $this, 'init' ] );
		add_action( 'init', [ $this, 'removeAdminBar' ] );

		$this->composer = new Composer();
	}

	/**
	 * Class instance
	 *
	 * @return Editor
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Init.
	 */
	public function init() {
		if ( $this->edit_mode() ) {
			remove_all_actions( 'wp_head' );
			remove_all_actions( 'wp_print_styles' );
			remove_all_actions( 'wp_print_head_scripts' );
			remove_all_actions( 'wp_footer' );

			add_action( 'wp_head', 'wp_enqueue_scripts', 1 );
			add_action( 'wp_head', 'wp_print_styles', 8 );
			add_action( 'wp_head', 'wp_print_head_scripts', 9 );

			add_action( 'wp_footer', 'wp_print_footer_scripts', 20 );
			add_action( 'wp_footer', 'wp_auth_check_html', 30 );

			remove_all_actions( 'wp_enqueue_scripts' );

			add_filter( 'ajax_query_attachments_args', [ $this, 'filterMedia' ] );

			$this->loadEditor();

			return;
		}

		add_action( 'wp_enqueue_scripts', [ $this, 'general_style' ], 999999 );
		add_action( 'wp_enqueue_scripts', [ $this, 'general_script' ], 999999 );

		if ( ! is_super_admin() ) {
			return;
		}

		if ( Plugin::instance()->is_editor_frame() ) {
			add_action( 'wp_enqueue_scripts', [ $this, 'editor_frame_style' ], 999999 );
			add_action( 'wp_enqueue_scripts', [ $this, 'editor_frame_scripts' ], 999999 );
		}

		/* Show the button to open editor only to admin and not while previewing */
		if ( is_super_admin() && ! Plugin::instance()->is_preview() ) {
			add_action( 'wp_enqueue_scripts', [ $this, 'start_edit_style' ], 999999 );
		}

		/* For initial setup only */
		if ( Plugin::instance()->is_setup() ) {
			add_action( 'wp_head', [ $this, 'start_inline_script' ], 1 );
			add_action( 'wp_enqueue_scripts', [ $this, 'start_edit_script' ], 999999 );
		}

	}

	/**
	 * Are we in the edit panel?
	 */
	public function edit_mode() {
		return Plugin::instance()->is_editor_panel();
	}

	/**
	 *
	 */
	public function loadEditor() {
		add_action( 'wp_enqueue_scripts', [ $this, 'editor_scripts' ], 999 );
		add_action( 'wp_enqueue_scripts', [ $this, 'editor_styles' ], 999 );
		include STAX_CORE_PATH . 'ui/editor.php';
		die();
	}

	/**
	 *
	 */
	public function removeAdminBar() {
		if ( ( Plugin::instance()->is_editor_frame() || Plugin::instance()->is_preview() || Plugin::instance()->is_editor_panel() || Plugin::instance()->is_setup() ) && is_super_admin() ) {
			add_filter( 'show_admin_bar', '__return_false' );
		}
	}

	/**
	 *
	 */
	public function editor_scripts() {
		global $wp_styles, $wp_scripts;

		$wp_styles  = new \WP_Styles();
		$wp_scripts = new \WP_Scripts();

		wp_enqueue_media();

		wp_register_script(
			'scripts',
			STAX_ASSETS_URL . 'js/scripts.js',
			[],
			false,
			true
		);

		wp_register_script(
			'ng-inline',
			STAX_ASSETS_FW_URL . 'inline.bundle.js',
			[
				'scripts',
			],
			false,
			true
		);

		wp_register_script(
			'ng-polyfills',
			STAX_ASSETS_FW_URL . 'polyfills.bundle.js',
			[
				'scripts',
				'ng-inline',
			],
			false,
			true
		);

		if ( defined( 'STAX_DEV' ) && STAX_DEV ) {
			wp_register_script(
				'ng-vendor',
				STAX_ASSETS_FW_URL . 'vendor.bundle.js',
				[
					'scripts',
					'ng-inline',
					'ng-polyfills',
				],
				false,
				true
			);
		}

		wp_register_script(
			'ng-main',
			STAX_ASSETS_FW_URL . 'main.bundle.js',
			( defined( 'STAX_DEV' ) && STAX_DEV ) ?
				[
					'scripts',
					'ng-inline',
					'ng-polyfills',
					'ng-vendor',
				] :
				[
					'scripts',
					'ng-inline',
					'ng-polyfills',
				],
			false,
			true
		);

		wp_enqueue_script( 'heartbeat' );
		wp_enqueue_script( 'wp-auth-check' );
		wp_enqueue_script( 'ng-main' );
		wp_localize_script( 'ng-inline', 'editorVars', $this->websiteData() );
		$this->loadWpEditor();
	}

	/**
	 *
	 */
	public function editor_styles() {
		wp_register_style(
			'editor',
			STAX_ASSETS_URL . 'css/editor.css',
			[]
		);

		wp_register_style(
			'admin-dash',
			includes_url() . 'css/dashicons.min.css',
			[]
		);

		wp_register_style(
			'admin-media',
			admin_url() . 'css/media.min.css',
			[
				'admin-dash'
			]
		);

		wp_enqueue_style( 'wp_auth_check', '/wp-includes/css/wp-auth-check.css', [], null, 'all' );
		wp_enqueue_style( 'admin-media' );
		wp_enqueue_style( 'editor' );
	}

	/**
	 * Script for initial setup.
	 */
	public function start_edit_script() {

		wp_register_script(
			'start-editor',
			STAX_ASSETS_URL . 'js/start-editor.js',
			[
				'jquery',
			],
			false,
			true
		);

		wp_enqueue_script( 'start-editor' );
	}

	/**
	 *
	 */
	public function start_inline_script() {

		echo '<script type="text/javascript">' .
		     'var staxBody;' .
		     'document.addEventListener("DOMContentLoaded", function(event) {' .
		     'staxBody = document.querySelector("body").cloneNode(true);' .
		     ' });' .
		     ' </script>';
	}

	/**
	 *
	 */
	public function start_edit_style() {
		wp_register_style(
			'start-editor',
			STAX_ASSETS_URL . 'css/start-editor.css',
			[]
		);

		wp_enqueue_style( 'start-editor' );
	}

	/**
	 *
	 */
	public function general_script() {
		wp_register_script(
			'stax-script',
			STAX_ASSETS_URL . 'js/header.js',
			[
				'jquery',
			],
			false,
			true
		);

		wp_enqueue_script( 'stax-script' );
	}

	/**
	 *
	 */
	public function general_style() {

		wp_register_style(
			'material-icons',
			STAX_ASSETS_URL . 'css/materialdesignicons.css',
			[]
		);

		wp_register_style(
			'stax-style',
			STAX_ASSETS_URL . 'css/stax.css',
			[ 'material-icons' ]
		);

		wp_enqueue_style( 'stax-style' );
	}

	/**
	 *
	 */
	public function editor_frame_style() {
		wp_register_style(
			'material-icons',
			STAX_ASSETS_URL . 'css/materialdesignicons.css',
			[]
		);

		wp_register_style(
			'stax-overlay',
			STAX_ASSETS_URL . 'css/overlay.css',
			[
				'material-icons',
			]
		);

		wp_enqueue_style( 'stax-overlay' );
	}

	/**
	 *
	 */
	public function editor_frame_scripts() {
		wp_register_script(
			'link-disabled',
			STAX_ASSETS_URL . 'js/link-disabled.js',
			[
				'jquery'
			],
			false,
			true
		);

		wp_enqueue_script( 'link-disabled' );
	}

	/**
	 * @return array
	 */
	public function websiteData() {
		global $wp;
		$pageId = get_the_ID();

		$page_url = home_url( $wp->request );
		if ( ! $page_url ) {
			$page_url = home_url();
		}

		$generalEdit = true;
		if ( isset( $_GET['individual'] ) ) {
			$generalEdit = false;
		}

		$singleID = 0;
		if ( $pageId && ! is_home() ) {
			$itemMeta = get_option( 'stax_item_' . $pageId );
			if ( $itemMeta ) {
				$generalEdit = false;
				$singleID    = $itemMeta;
			}
		} else {
			$pageId = 0;
		}

		$hasActive = false;
		if ( $generalEdit ) {
			$theHeader = Model_ActiveHeaders::instance()->getGeneral();
			$hasActive = true;
		} else {
			$theHeader = Model_ActiveHeaders::instance()->getById( $singleID );
		}


		$defaultElements = $this->getDefaultElements();
		$customElements  = $this->getCustomElements();
		$packData        = $this->getItemsPack( $theHeader );
		$baseHeader      = new Header();
		$baseColumn      = new Column();
		$components      = [];
		$templates       = [];
		$tag             = '';
		$tagType         = '';

		if ( $hasActive ) {
			$generalData = $packData;
		} else {
			$tempHeader  = Model_ActiveHeaders::instance()->getGeneral();
			$generalData = $this->getItemsPack( $tempHeader );
		}


		do_action( 'stax_custom_elements' );

		$templatesPack = Model_Templates::instance()->get();

		foreach ( $templatesPack as $template ) {
			$pack = json_decode( $template->pack );

			if ( ! $pack ) {
				continue;
			}

			$templateItems           = new \stdClass();
			$templateItems->headers  = new \stdClass();
			$templateItems->columns  = new \stdClass();
			$templateItems->elements = new \stdClass();
			$templateItems->groups   = new \stdClass();
			$templateItems->fonts    = new \stdClass();
			$templateItems->general  = isset( $pack->general ) ? $pack->general : [];

			foreach ( $pack->headers as $header ) {
				$templateItems->headers->{$header->uuid} = $this->matchAndMergeFields( $header );
			}

			foreach ( $pack->columns as $column ) {
				$templateItems->columns->{$column->uuid} = $this->matchAndMergeFields( $column );
			}

			foreach ( $pack->elements as $element ) {
				$templateItems->elements->{$element->uuid} = $this->matchAndMergeFields( $element );
			}

			foreach ( $pack->groups as $uuid => $group ) {
				$templateItems->groups->{$uuid} = $group;
			}

			$templateItems->fonts = $pack->fonts;

			$templates[] = [
				'id'      => $template->id,
				'name'    => $template->name,
				'changed' => false,
				'pack'    => $templateItems
			];
		}

		$componentsPack = Model_Components::instance()->get();
		foreach ( $componentsPack as $component ) {
			$properties = @json_decode( $component->properties );
			$properties = $this->matchAndMergeFields( $properties );

			if ( ! $properties ) {
				continue;
			}

			$components[] = [
				'id'         => $component->id,
				'name'       => $component->name,
				'properties' => $properties
			];
		}

		$current_settings = Model_Settings::instance()->get_current_tag();
		if ( ! empty( $current_settings ) ) {
			$tag     = $current_settings['tag'];
			$tagType = $current_settings['tagType'];
		}


		$theme = get_option( 'stax_editor_theme' );
		if ( ! $theme ) {
			$theme = 'light';
		}

		$themes = (object) [
			'light' => [
				'label'    => 'Light',
				'selected' => ( $theme === 'light' ) ? true : false,
				'value'    => 'light'
			],
			'dark'  => [
				'label'    => 'Dark',
				'selected' => ( $theme === 'dark' ) ? true : false,
				'value'    => 'dark'
			]
		];

		$colors = get_option( 'stax_color_picker' );
		if ( ! $colors ) {
			$colors = [
				'#e91e63',
				'#673ab7',
				'#2196f3',
				'#00bcd4',
				'#4caf50',
				'#cddc39',
				'#ffc107'
			];
		} else {
			$colors = json_decode( $colors );
		}

		$data = [
			'config' => [
				'base_url'   => esc_url( site_url() ),
				'page_url'   => esc_url( $page_url ),
				'rest_url'   => esc_url( get_rest_url( null, STAX_API_NAMESPACE . '/' ) ),
				'admin_url'  => admin_url(),
				'assets_url' => STAX_ASSETS_URL,
				'pro_url'    => stax_fs()->get_upgrade_url(),
				'nonce'      => wp_create_nonce( 'wp_rest' ),
			],
			'editor' => [
				'base'             => [
					'header'          => $baseHeader,
					'column'          => $baseColumn,
					'defaultElements' => $defaultElements,
					'customElements'  => $customElements,
					'fonts'           => Fonts::instance()->get()
				],
				'generalItems'     => [
					'headers'  => $generalData->headers,
					'columns'  => $generalData->columns,
					'elements' => $generalData->elements,
					'groups'   => $generalData->groups,
					'fonts'    => $generalData->fonts
				],
				'settings'         => [
					'tag'          => $tag,
					'tagType'      => $tagType,
					'theme'        => $theme,
					'themes'       => $themes,
					'colors'       => $colors,
					'headerActive' => RenderStatus::instance()->getStatus()
				],
				'viewport'         => '',
				'headers'          => $packData->headers,
				'columns'          => $packData->columns,
				'elements'         => $packData->elements,
				'groups'           => $packData->groups,
				'fonts'            => $packData->fonts,
				'components'       => $components,
				'templates'        => array_merge( $templates, Templates::instance()->get() ),
				'defaultTemplates' => [],
				'deleted'          => new \stdClass(),
				'queue'            => new \stdClass(),
				'drop'             => new \stdClass(),
				'layerDrop'        => new \stdClass(),
				'layers'           => [],
				'icons'            => Icons::instance()->get(),
				'page'             => $pageId,
				'general'          => $generalEdit,
				'l10n'             => L10n::instance()->strings()
			]
		];

		return $data;
	}

	/**
	 * @param $item
	 *
	 * @return \stdClass
	 */
	protected function getItemsPack( $item ) {
		$result           = new \stdClass();
		$result->headers  = new \stdClass();
		$result->columns  = new \stdClass();
		$result->elements = new \stdClass();
		$result->groups   = new \stdClass();
		$result->fonts    = new \stdClass();

		if ( $item ) {
			$pack        = @json_decode( $item->pack );
			$headersPack = $pack->headers;

			foreach ( $headersPack as $uuid ) {
				$header = Model_Headers::instance()->get( $uuid );
				if ( $header ) {
					$result->headers->$uuid = $this->matchAndMergeFields( @json_decode( $header->properties ) );
				}
			}
		}

		foreach ( $result->headers as $headerUuid => $header ) {
			$heads = Model_GrpHeader::instance()->get( $headerUuid );

			$result->groups->{$headerUuid} = (object) [
				'viewport' => (object) []
			];

			foreach ( $heads as $headItem ) {
				$result->groups->{$headItem->header_uuid}->viewport->{$headItem->viewport} = (object) [
					'columns'    => (object) [],
					'position'   => $headItem->position,
					'visibility' => intval( $headItem->visibility )
				];

				$cols = Model_GrpHeaderItems::instance()->getByHeaderUuid( $headItem->header_uuid, $headItem->viewport );

				foreach ( $cols as $colItem ) {
					$storedColumn = Model_Columns::instance()->get( $colItem->column_uuid );

					if ( $storedColumn ) {
						$result->groups->{$headItem->header_uuid}->viewport->{$headItem->viewport}->columns->{$colItem->column_uuid} = (object) [
							'elements'   => (object) [],
							'position'   => $colItem->position,
							'visibility' => intval( $colItem->visibility )
						];

						$result->columns->{$colItem->column_uuid} = $this->matchAndMergeFields( @json_decode( $storedColumn->properties ) );

						$storedElements = json_decode( $colItem->elements );
						foreach ( $storedElements as $elementUuid => $elItem ) {
							$storedElement = Model_Elements::instance()->get( $elementUuid );
							if ( $storedElement ) {
								$result->groups->{$headItem->header_uuid}->viewport->{$headItem->viewport}->columns->{$colItem->column_uuid}->elements->{$elementUuid} = $elItem;

								$result->elements->{$elementUuid} = $this->matchAndMergeFields( @json_decode( $storedElement->properties ) );
							}
						}
					}
				}
			}
		}

		return $result;
	}

	/**
	 * @return array
	 * @throws FatalException
	 */
	protected function getDefaultElements() {
		$elements = [];

		$logo      = new ElementLogo();
		$menu      = new ElementMenu();
		$search    = new ElementSearch();
		$text      = new ElementText();
		$button    = new ElementButton();
		$image     = new ElementImage();
		$link      = new ElementLink();
		$icon      = new ElementIcon();
		$separator = new ElementSeparator();

		$elements[ $logo->slug ]      = $logo;
		$elements[ $menu->slug ]      = $menu;
		$elements[ $search->slug ]    = $search;
		$elements[ $button->slug ]    = $button;
		$elements[ $icon->slug ]      = $icon;
		$elements[ $text->slug ]      = $text;
		$elements[ $image->slug ]     = $image;
		$elements[ $link->slug ]      = $link;
		$elements[ $separator->slug ] = $separator;

		foreach ( $elements as $el ) {
			$sanitizer = new Sanitizer( $el );
			$sanitizer->check();
		}

		return $elements;
	}

	/**
	 * @return array
	 */
	protected function getCustomElements() {
		$elements = [];

		foreach ( $this->composer->elements as $customElement ) {
			if ( ! $customElement->slug ) {
				continue;
			}
			$elements[ $customElement->slug ] = $customElement;
		}

		return $elements;
	}

	/**
	 * @param $save
	 *
	 * @return mixed
	 * @throws FatalException
	 */
	public function matchAndMergeFields( $save ) {
		$views = [
			'editor',
			'desktop',
			'tablet',
			'mobile'
		];

		foreach ( $views as $view ) {
			$native = null;
			switch ( $save->type ) {
				case self::TYPE_ELEMENT:
					$defaultElements = $this->getDefaultElements();
					$customElements  = $this->getCustomElements();

					if ( isset( $defaultElements[ $save->slug ] ) ) {
						$native = $defaultElements[ $save->slug ];
					} elseif ( isset( $customElements[ $save->slug ] ) ) {
						$native = $customElements[ $save->slug ];
					}
					break;
				case self::TYPE_COLUMN:
					$native = new Column();
					break;
				case self::TYPE_HEADER:
					$native = new Header();
					break;
				default:
			}

			if ( ! $native ) {
				continue;
			}

			foreach ( $save->{$view} as $saveEditor ) {
				foreach ( $saveEditor->fields as $saveField ) {
					foreach ( $native->editor as $k => $nativeEditor ) {
						if ( $saveEditor->name === $nativeEditor->name ) {
							$native->editor[ $k ]->visibility = $saveEditor->visibility;
						}
						foreach ( $nativeEditor->fields as $i => $nativeField ) {
							if ( $saveField->name === $nativeField->name ) {
								if ( is_array( $saveField->value ) && is_array( $nativeField->value ) ) {
									foreach ( $saveField->value as $sKey => $savedFieldVal ) {
										foreach ( $nativeField->value as $nKey => $nativeFieldVal ) {
											if ( $nKey === $sKey ) {
												$saved_value                                                 = isset( $savedFieldVal->value ) ? $savedFieldVal->value : null;
												$native->editor[ $k ]->fields[ $i ]->value[ $nKey ]['value'] = $saved_value;

												if ( isset( $savedFieldVal->extra ) && isset( $nativeFieldVal['extra'] ) ) {
													$native->editor[ $k ]->fields[ $i ]->value[ $nKey ]['extra'] = $savedFieldVal->extra;
												}

												if ( isset( $savedFieldVal->checked ) && isset( $nativeFieldVal['checked'] ) ) {
													$native->editor[ $k ]->fields[ $i ]->value[ $nKey ]['checked'] = $savedFieldVal->checked;
												}

												if ( isset( $savedFieldVal->selected ) && isset( $nativeFieldVal['selected'] ) ) {
													$native->editor[ $k ]->fields[ $i ]->value[ $nKey ]['selected'] = $savedFieldVal->selected;
												}
											}
										}
									}
								} else {
									$native->editor[ $k ]->fields[ $i ]->value = $saveField->value;
								}
								$native->editor[ $k ]->fields[ $i ]->visibility = $saveField->visibility;
								$native->editor[ $k ]->fields[ $i ]->units      = $saveField->units;
							}
						}
					}
				}
			}

			if ( ! empty( $save->{$view} ) ) {
				$save->{$view} = $native->editor;
			}
		}

		return $save;
	}

	/**
	 * @return string
	 */
	public function loadWpEditor() {
		ob_start();

		wp_editor(
			'%%EDITORCONTENT%%',
			'sqwpeditor',
			[
				'editor_class'     => 'sq-wp-editor',
				'editor_height'    => 300,
				'drag_drop_upload' => true,
			]
		);

		return ob_get_clean();
	}

}
