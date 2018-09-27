<?php
/**
 * Stax main loader file.
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
 * Class Plugin
 *
 * @package Stax
 */
class Plugin {

	/**
	 * @var null
	 */
	public static $instance = null;


	/**
	 * @var
	 */
	public $ui;

	/**
	 * @var
	 */
	public $settings;
	/**
	 * @var
	 */
	public $db;

	/**
	 * @var
	 */
	public $route;

	/**
	 * @var
	 */
	public $editor;

	/**
	 * @var null
	 */
	public static $zones_data = [];

	/**
	 * @var string
	 */
	private $theme_name = '';


	/**
	 * Plugin Instance
	 *
	 * @return null|Plugin
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Plugin constructor.
	 */
	public function __construct() {
		$this->include_models();
		$this->include_components();
		$this->include_helpers();
		$this->include_core_classes();
		$this->init_core();

		Routes::instance();

		register_activation_hook( STAX_FILE, [ $this, 'migrate' ] );

		add_action( 'wp', [ $this, 'wp' ] );
		add_action( 'init', [ $this, 'init' ] );
		add_action( 'wp_loaded', [ $this, 'wp_loaded' ], 1 );

		remove_action( 'wp_head', 'rest_output_link_wp_head' );

		$this->theme_name = strtolower( wp_get_theme( get_template() )->display( 'Name' ) );
	}

	/**
	 *
	 */
	public function wp() {
		Compatibility::instance()->register();
	}

	/**
	 *
	 */
	public function init() {
		if ( is_admin() ) {
			add_action( 'admin_menu', [ $this, 'init_admin_dashboard' ] );
		}

		add_shortcode( 'stax-menu', [ $this, 'init_menu_shortcode' ] );

		if ( $this->is_setup() || $this->is_preview() ) {
			add_action( 'wp_enqueue_scripts', [ $this, 'disable_links' ], 10 );
		}

		if ( ( $this->is_front() && RenderStatus::instance()->getStatus() ) || $this->is_preview() ) {
			add_action( 'wp_head', [ $this, 'front_fonts' ], 50 );
			add_action( 'wp_head', [ $this, 'front_css' ], 50 );
			if ( ! $this->is_setup() ) {
				add_action( 'wp_head', [ $this, 'register_replace' ], 1 );
			}
		}

		if ( $this->is_front() ) {
			add_action( 'wp_footer', [ $this, 'load_open_editor' ] );
		}

		add_action( 'in_plugin_update_message-stax/index.php', [$this, 'update_message' ], 10, 2 );

		add_action( 'after_plugin_row_wp-' . STAX_PLUGIN_BASE, [$this, 'ms_plugin_update_message' ], 10, 2 );

		$this->migrate();
	}

	function ms_plugin_update_message( $file, $plugin ) {

		if( isset( $plugin['upgrade_notice'] ) && is_multisite() && version_compare( $plugin['Version'], $plugin['new_version'], '<') ) {
			$wp_list_table = _get_list_table( 'WP_Plugins_List_Table' );
			printf(
				'<tr class="plugin-update-tr"><td colspan="%s" class="plugin-update update-message notice inline notice-warning notice-alt"><div class="update-message"><h4 style="margin: 0; font-size: 14px;">%s</h4>%s</div></td></tr>',
				$wp_list_table->get_column_count(),
				$plugin['Name'],
				wpautop( $plugin['upgrade_notice'] )
			);
		}
	}

	public function update_message( $data, $response ) {

		if( isset( $data['upgrade_notice'] ) ) {
			printf(
				'<div class="update-message">%s</div>',
				wpautop( $data['upgrade_notice'] )
			);
		}
	}


	public function body_class( $classes = array() ) {
		$classes[] = 'stax-editor-enabled';

		return $classes;
	}

	/**
	 *
	 */
	public function front_css() {
		$data = [];

		$zoneData = $this->get_zones_data();

		foreach ( $zoneData as $stack ) {
			foreach ( $stack as $item ) {
				$data[] = $item['css'];
			}
		}

		$output = '';
		foreach ( $data as $css ) {
			$output .= $this->get_front_css_by_data( $css );
		}

		echo '<style>' . $output . '</style>' . "\n";
	}

	/**
	 * @param $data
	 *
	 * @return mixed|string
	 */
	private function get_front_css_by_data( $data ) {
		$output = '';

		if ( ! is_array( $data ) || empty( $data ) ) {
			return '';
		}

		if ( ! $data['desktop'] && ! $data['tablet'] && ! $data['mobile'] ) {
			$output = $data['general'];
		} else {
			$output .= '@media (max-width: 767.99px) {' . ( ( $data['mobile'] ) ? $data['mobile'] : $data['general'] ) . '}';
			$output .= '@media (min-width: 768px) and (max-width: 991.99px) {' . ( ( $data['tablet'] ) ? $data['tablet'] : $data['general'] ) . '}';
			$output .= '@media (min-width: 992px) {' . ( ( $data['desktop'] ) ? $data['desktop'] : $data['general'] ) . '}';
		}

		return $output;
	}

	/**
	 *
	 */
	public function front_fonts() {
		$fonts = [];

		$zoneData = $this->get_zones_data();
		foreach ( $zoneData as $item ) {
			foreach ( $item as $itm ) {
				if ( isset( $itm['fonts'] ) && is_array( $itm['fonts'] ) ) {
					foreach ( $itm['fonts'] as $font_id ) {
						$fonts[] = $font_id;
					}
				}
			}
		}

		$fonts_url = $this->get_front_fonts_by_data( $fonts );
		if ( $fonts_url ) {
			echo '<link href="' . $fonts_url . '" rel="stylesheet" type="text/css">';
		}
	}

	/**
	 * @param array $fontsStack
	 *
	 * @return bool|string
	 */
	private function get_front_fonts_by_data( array $fontsStack ) {

		$finalURL = false;

		if ( ! is_array( $fontsStack ) || empty( $fontsStack ) ) {
			return $finalURL;
		}

		$fonts = Fonts::instance()->get();
		$list  = $fonts->items;

		$baseUrl = 'https://fonts.googleapis.com/css?family=';
		/* TODO Improve font weights to load just what it uses */
		$fontWeights = ':100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic';

		foreach ( $fontsStack as $key => $font ) {
			if ( array_key_exists( $font, $list ) ) {
				if ( $key + 1 === count( $fontsStack ) ) {
					$finalURL .= $baseUrl . urlencode( $list[ $font ]->family ) . $fontWeights;
				} else {
					$finalURL .= $baseUrl . urlencode( $list[ $font ]->family ) . $fontWeights . urlencode( '|' );
				}
			}
		}

		return $finalURL;
	}

	public function register_replace() {

		wp_register_script(
			'stax-replace',
			STAX_ASSETS_URL . 'js/replace.js',
			[],
			false,
			false
		);
		wp_enqueue_script( 'stax-replace' );

		$zones_data = $this->get_zones_data();

		$responsive    = [];
		$stax_listener = '';
		$output        = '';
		$css_output    = '';

		foreach ( $zones_data as $selector => $items ) {
			$responsive[ $selector ] = [
				'desktop' => '',
				'tablet'  => '',
				'mobile'  => '',
			];

			foreach ( $items as $item ) {
				foreach ( $item['html']['desktop'] as $content ) {
					$responsive[ $selector ]['desktop'] .= $content['content'];
				}
				foreach ( $item['html']['tablet'] as $content ) {
					$responsive[ $selector ]['tablet'] .= $content['content'];
				}
				foreach ( $item['html']['mobile'] as $content ) {
					$responsive[ $selector ]['mobile'] .= $content['content'];
				}

				$zone_id                            = $item['zone_id'];
				$responsive[ $selector ]['zoneId']  = $zone_id;
				$responsive[ $selector ]['isXpath'] = $item['xpath'];

				$css_output .= '@keyframes staxZoneDetected' . $zone_id . ' {from {opacity:0.99;} to {opacity:1;}}' . "\n";

				if ( ! $item['xpath'] ) {
					$css_output .= $selector . '{opacity: 0;' .
					               'animation-duration: 0.001s;' .
					               '-webkit-animation-duration: 0.001s;' .
					               'animation-name: staxZoneDetected' . $zone_id . ';' .
					               '-webkit-animation-name: staxZoneDetected' . $zone_id . ';' .
					               '}';
				}

				$stax_listener .= 'if (event.animationName == "staxZoneDetected' . $zone_id . '") { staxReplaceZone("' . $zone_id . '");}' . "\n";
			}
		}

		$output .= 'var staxResponsive = ' . json_encode( $responsive ) . ';' .
		           'staxWriteCss();';

		if ( $css_output ) {
			echo '<style>' . $css_output . '</style>';
		}

		$output .= 'document.addEventListener("animationstart", staxListener, false);' . "\n" .
		           'document.addEventListener("MSAnimationStart", staxListener, false);' . "\n" .
		           'document.addEventListener("webkitAnimationStart", staxListener, false);' . "\n";
		$output .= 'window.addEventListener("resize", function(){ staxReplaceZone(); });';

		wp_add_inline_script( 'stax-replace', $output );
	}


	/**
	 *
	 */
	public function wp_loaded() {
		if ( $this->isRestUrl() || is_admin() || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
			return;
		}

		if ( ( ! Compatibility::instance()->is_front_theme_compatible() && ! $this->is_editing()
		       && ! $this->is_setup() && RenderStatus::instance()->getStatus() ) || $this->is_preview()
		) {
			//check if we have zones to render
		}

		if ( $this->is_editing() || RenderStatus::instance()->getStatus() ) {
			add_action( 'body_class', [ $this, 'body_class' ] );

			add_filter( 'the_content', function ( $content ) {
				return '<div id="stax-before-content"></div><div id="stax-content">' . $content . '</div><div id="stax-after-content"></div>';
			}, 9999 );

			add_action( 'wp_footer', function () {
				echo '<div id="stax-footer"></div>';
			}, 9999 );
		}
	}

	/**
	 * @return bool
	 */
	public function isRestUrl() {
		$isRest = false;
		if ( function_exists( 'rest_url' ) && ! empty( $_SERVER['REQUEST_URI'] ) ) {
			$sRestUrlBase = get_rest_url( get_current_blog_id(), '/' );
			$sRestPath    = trim( parse_url( $sRestUrlBase, PHP_URL_PATH ), '/' );
			$sRequestPath = trim( $_SERVER['REQUEST_URI'], '/' );
			$isRest       = ( strpos( $sRequestPath, $sRestPath ) === 0 );
		}

		return $isRest;
	}

	/**
	 * Include our models
	 *
	 * @return void
	 */
	public function include_models() {
		include STAX_CORE_PATH . 'models/Base_Model.php';
		include STAX_CORE_PATH . 'models/Model_Zones.php';
		include STAX_CORE_PATH . 'models/Model_Container.php';
		include STAX_CORE_PATH . 'models/Model_ContainerViewport.php';
		include STAX_CORE_PATH . 'models/Model_ContainerItems.php';
		include STAX_CORE_PATH . 'models/Model_Columns.php';
		include STAX_CORE_PATH . 'models/Model_Elements.php';
		include STAX_CORE_PATH . 'models/Model_Templates.php';
		include STAX_CORE_PATH . 'models/Model_Components.php';
		include STAX_CORE_PATH . 'models/Model_Settings.php';
	}

	/**
	 * Include components
	 *
	 * @return void
	 */
	public function include_components() {
		include STAX_CORE_PATH . 'components/base/ContainerInterface.php';
		include STAX_CORE_PATH . 'components/base/ColumnInterface.php';
		include STAX_CORE_PATH . 'components/base/ElementInterface.php';

		include STAX_CORE_PATH . 'components/helpers/ElementSpecs.php';
		include STAX_CORE_PATH . 'components/helpers/EditorSection.php';
		include STAX_CORE_PATH . 'components/helpers/EditorSectionField.php';
		include STAX_CORE_PATH . 'components/helpers/Composer.php';
		//include STAX_CORE_PATH . 'components/helpers/Mobile_Detect.php'; //TODO Remove

		include STAX_CORE_PATH . 'components/Section.php';
		include STAX_CORE_PATH . 'components/Header.php';
		include STAX_CORE_PATH . 'components/Column.php';
		include STAX_CORE_PATH . 'components/Element.php';
		include STAX_CORE_PATH . 'components/ElementLogo.php';
		include STAX_CORE_PATH . 'components/ElementMenu.php';
		include STAX_CORE_PATH . 'components/ElementShortcode.php';
		include STAX_CORE_PATH . 'components/ElementSearch.php';
		include STAX_CORE_PATH . 'components/ElementButton.php';
		include STAX_CORE_PATH . 'components/ElementText.php';
		include STAX_CORE_PATH . 'components/ElementImage.php';
		include STAX_CORE_PATH . 'components/ElementLink.php';
		include STAX_CORE_PATH . 'components/ElementSeparator.php';
		include STAX_CORE_PATH . 'components/ElementIcon.php';
		include STAX_CORE_PATH . 'components/ElementAccordion.php';
		include STAX_CORE_PATH . 'components/ElementDivider.php';
		include STAX_CORE_PATH . 'components/ElementGoogleMaps.php';
		include STAX_CORE_PATH . 'components/ElementHeading.php';
		include STAX_CORE_PATH . 'components/ElementSpacer.php';
		include STAX_CORE_PATH . 'components/ElementTabs.php';
	}

	/**
	 * Include helpers
	 *
	 * @return void
	 */
	public function include_helpers() {
		include STAX_CORE_PATH . 'helpers/Underscore/Underscore.php';
		include STAX_CORE_PATH . 'helpers/Underscore/Bridge.php';
		include STAX_CORE_PATH . 'helpers/Icons.php';
		include STAX_CORE_PATH . 'helpers/Fonts.php';
		include STAX_CORE_PATH . 'helpers/Menus.php';
		include STAX_CORE_PATH . 'helpers/ShortCode.php';
		include STAX_CORE_PATH . 'helpers/MenuWalker.php';
		include STAX_CORE_PATH . 'helpers/CompatibleTheme.php';
		include STAX_CORE_PATH . 'helpers/Compatibility.php';
		include STAX_CORE_PATH . 'helpers/Import.php';
		include STAX_CORE_PATH . 'helpers/Export.php';
		include STAX_CORE_PATH . 'helpers/OptionsWP.php';
		include STAX_CORE_PATH . 'helpers/RenderStatus.php';
		include STAX_CORE_PATH . 'helpers/Templates.php';
		include STAX_CORE_PATH . 'helpers/L10n.php';
		include STAX_CORE_PATH . 'helpers/PageSeeker.php';
	}

	/**
	 * Include core classes
	 *
	 * @return void
	 */
	public function include_core_classes() {
		include STAX_CORE_PATH . 'routes.php';
		include STAX_CORE_PATH . 'db/db.php';
		include STAX_CORE_PATH . 'db/upgrade_db.php';
		include STAX_CORE_PATH . 'editor.php';
	}

	/**
	 * Init core
	 *
	 * @return void
	 */
	public function init_core() {
		$this->db     = new DB();
		$this->editor = Editor::instance();
	}

	/**
	 * Is the editor opened?
	 *
	 * @return bool
	 */
	public function is_editing() {
		if ( ( $this->is_editor_frame() || $this->is_editor_panel() ) && ! is_admin() ) {
			return true;
		}

		return false;
	}

	/**
	 * Are we in the editing panel
	 *
	 * @return bool
	 */
	public function is_editor_panel() {
		if ( isset( $_GET['stax-editor'] ) && current_user_can( 'administrator' ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Are we in the editing frame
	 *
	 * @return bool
	 */
	public function is_editor_frame() {
		if ( isset( $_GET['is-editing'] ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Check if we are previewing a zone
	 *
	 * @return bool
	 */
	public function is_preview() {
		if ( isset( $_GET['is-preview'] ) && isset( $_GET['section'] ) &&
		     ( is_numeric( $_GET['section'] ) || strpos( $_GET['section'], 'stax_tpl' ) === 0 ) && ! is_admin()
		) {
			return true;
		}

		return false;
	}

	/**
	 * Check if we are on initial setup
	 *
	 * @return bool
	 */
	public function is_setup() {
		if ( isset( $_GET['initial-setup'] ) ) {
			return true;
		}

		return false;
	}

	/**
	 * If we are in front area and not editing
	 *
	 * @return bool
	 */
	public function is_front() {
		if ( ! $this->is_editing() && ! $this->is_setup() && ! $this->is_preview() ) {
			return true;
		}

		return false;
	}

	/**
	 *
	 */
	public function migrate() {
		if ( ! get_option( 'stax-version' ) ) {
			$this->db->migrate();
		} else {
			UpgradeDB::instance()->run();
		}
	}

	/**
	 * @param array $stack
	 * @param $props
	 *
	 * @return array
	 */
	private function addCss( array $stack, $props ) {
		foreach ( $stack as $viewport => $string ) {
			if ( $props->{$viewport . 'CSS'} ) {
				$stack[ $viewport ] .= $props->{$viewport . 'CSS'};
			} else {
				$stack[ $viewport ] .= $props->generalCSS;
			}
		}

		return $stack;
	}

	/**
	 * @param array $stack
	 * @param $props
	 * @param $group
	 *
	 * @return array
	 */
	private function addHtml( array $stack, $props, $group ) {
		foreach ( $props->frontend as $viewport => $items ) {
			$position = 0;
			$addHtml  = true;
			if ( $this->is_preview() ) {
				foreach ( $group->viewport as $v => $item ) {
					if ( $v === $viewport ) {
						$position = intval( $item->position );
					}
				}
			} else {
				foreach ( $group as $item ) {
					if ( $item->viewport === $viewport ) {
						$position = intval( $item->position );
					}

					if ( ! (int) $item->visibility ) {
						$addHtml = false;
					}
				}
			}

			if ( $position && $addHtml ) {
				if ( is_user_logged_in() ) {
					$stack[ $viewport ][] = [
						'content'  => do_shortcode( $items->auth ),
						'position' => $position
					];
				} else {
					$stack[ $viewport ][] = [
						'content'  => do_shortcode( $items->not_auth ),
						'position' => $position
					];
				}
			}
		}

		return $stack;
	}

	/**
	 * @param $string
	 * @param $start
	 * @param $end
	 *
	 * @return bool|string
	 */
	private function get_string_between( $string, $start, $end ) {
		$string = " " . $string;
		$ini    = strpos( $string, $start );

		if ( $ini == 0 ) {
			return "";
		}

		$ini += strlen( $start );
		$len = strpos( $string, $end, $ini ) - $ini;

		return substr( $string, $ini, $len );
	}

	/**
	 * @return array
	 */
	public function get_zones_data() {
		$packs = [];

		if ( $this->is_preview() ) {
			$template = $this->get_preview_template();
			$pack     = @json_decode( $template->pack );

			if ( ! $pack ) {
				return null;
			}

			$zone = $pack->zone;

			$packs['body'][] = [
				'xpath'      => false,
				'selector'   => '.stax-editor-enabled',
				'groups'     => $pack->group,
				'containers' => isset( $pack->containers ) ? $pack->containers : new \stdClass(),
				'columns'    => isset( $pack->columns ) ? $pack->columns : new \stdClass(),
				'elements'   => isset( $pack->elements ) ? $pack->elements : new \stdClass(),
				'fonts'      => json_decode( $zone->fonts ),
				'zone_id'    => isset( $zone->uuid ) ? $zone->uuid : rand()
			];
		} else {
			$zones = Model_Zones::instance()->getAllEnabled();

			foreach ( $zones as $zone ) {
				$conditions = $zone['condition'];
				if ( ! empty( $conditions ) ) {
					$condition_stack = [];
					foreach ( $conditions as $condition ) {
						if ( $condition->category === "general" ) {
							$condition_stack[] = [
								'category' => "general",
								'target'   => '',
								'type'     => ''
							];
						} else if ( $condition->category === "archive" ) {
							foreach ( $this->display_conditions_archive() as $archCondition ) {
								if ( $archCondition['tag'] === $condition->subcategory ) {
									$condition_stack[] = [
										'category' => $archCondition['callback'],
										'target'   => '',
										'type'     => $condition->type
									];
								}
							}

						} else if ( $condition->category === "single" ) {
							foreach ( $this->display_conditions_single() as $sglCondition ) {
								if ( $sglCondition['tag'] === $condition->subcategory ) {
									$condition_stack[] = [
										'category' => $sglCondition['callback'],
										'target'   => $condition->target,
										'type'     => $condition->type
									];
								}
							}
						}
					}

					$eligible = false;

					foreach ( $condition_stack as $callback ) {
						if ( $callback['category'] === "general" ) {
							$eligible = true;
							continue;
						}

						if ( $callback['category']() ) {
							if ( $callback['target'] && $callback['target'] == get_the_ID() ) {
								if ( $callback['type'] === 'include' ) {
									$eligible = true;
								}
							} else {
								if ( $callback['type'] === 'include' ) {
									$eligible = true;
								}
							}
						}
					}

					if ( $eligible ) {
						$pack = @json_decode( $zone['pack'] );

						if ( $pack ) {
							if ( isset( $zone['selector']->{$this->theme_name} ) ) {
								if ( (int) $zone['selector']->{$this->theme_name}->visibility ) {
									$packs[ $zone['selector']->{$this->theme_name}->path ][] = [
										'xpath'      => $zone['selector']->{$this->theme_name}->xpath,
										'selector'   => $zone['selector']->{$this->theme_name}->path,
										'position'   => $zone['selector']->{$this->theme_name}->position,
										'containers' => $pack,
										'fonts'      => json_decode( $zone['fonts'] ),
										'zone_id'    => isset( $zone['uuid'] ) ? $zone['uuid'] : rand()
									];
								}
							}
						}
					}
				}
			}

			foreach ( $packs as $key => $pack ) {
				usort( $packs[ $key ], function ( $a, $b ) {
					return $a["position"] - $b["position"];
				} );
			}
		}

		return $this->buildZonesStack( $packs );
	}

	/**
	 * @param array $pack
	 *
	 * @return array
	 */
	private function buildZonesStack( array $pack ) {
		$containers = [];
		foreach ( $pack as $selector => $stack ) {
			foreach ( $stack as $item ) {
				$css = [
					'general' => '',
					'desktop' => '',
					'tablet'  => '',
					'mobile'  => ''
				];

				$html = [
					'desktop' => [],
					'tablet'  => [],
					'mobile'  => []
				];

				$existingColumns  = [];
				$existingElements = [];

				if ( $this->is_preview() ) {
					foreach ( $item['groups']->containers as $containerUuid => $container ) {
						$prContainer = $item['containers']->{$containerUuid};

						if ( ! $prContainer ) {
							continue;
						}

						$css  = $this->addCss( $css, $prContainer );
						$html = $this->addHtml( $html, $prContainer, $container );
						foreach ( $container->viewport as $v => $viewport ) {
							foreach ( $viewport->columns as $columnUuid => $column ) {
								$prColumn = $item['columns']->{$columnUuid};
								if ( ! $prColumn ) {
									continue;
								}

								if ( ! in_array( $columnUuid, $existingColumns ) ) {
									$css = $this->addCss( $css, $prColumn );
								}

								foreach ( $column->elements as $elementUuid => $element ) {
									$prElement = $item['elements']->{$elementUuid};
									if ( ! $prElement ) {
										continue;
									}

									if ( ! in_array( $elementUuid, $existingElements ) ) {
										$css = $this->addCss( $css, $prElement );
									}

									$existingElements[] = $elementUuid;
								}

								$existingColumns[] = $columnUuid;
							}
						}
					}

				} else {
					foreach ( $item['containers'] as $uuid ) {
						$container = Model_Container::instance()->get( $uuid );

						if ( $container ) {
							$containerGroup = Model_ContainerViewport::instance()->get( $container->uuid );

							if ( ! $containerGroup ) {
								continue;
							}

							$containerProps = json_decode( $container->properties );
							$css            = $this->addCss( $css, $containerProps );
							$html           = $this->addHtml( $html, $containerProps, $containerGroup );

							$columnsGroup = Model_ContainerItems::instance()->getByContainerUuid( $container->uuid );

							foreach ( $columnsGroup as $colGroup ) {
								if ( ! (int) $colGroup->visibility ) {
									continue;
								}

								$colProps = Model_Columns::instance()->get( $colGroup->column_uuid );
								if ( ! $colProps ) {
									continue;
								}

								if ( ! in_array( $colGroup->column_uuid, $existingColumns ) ) {
									$css = $this->addCss( $css, @json_decode( $colProps->properties ) );
								}

								$elementsGroup = @json_decode( $colGroup->elements );
								foreach ( $elementsGroup as $elUuid => $elGroup ) {
									if ( ! (int) $elGroup->visibility ) {
										continue;
									}

									$elementProps = Model_Elements::instance()->get( $elUuid );
									if ( ! $elementProps ) {
										continue;
									}

									if ( ! in_array( $elUuid, $existingElements ) ) {
										$css = $this->addCss( $css, @json_decode( $elementProps->properties ) );
									}

									$existingElements[] = $elUuid;
								}

								$existingColumns[] = $colGroup->column_uuid;
							}
						}
					}
				}

				$containers[ $selector ][] = [
					'xpath'    => $item['xpath'],
					'selector' => $item['selector'],
					'css'      => $css,
					'fonts'    => @json_decode( $item['fonts'] ),
					'html'     => $html,
					'zone_id'  => $item['zone_id']
				];
			}
		}

		return $containers;
	}

	/**
	 * Get header HTML.
	 *
	 * @param null $stax_id
	 * @param null $before
	 * @param null $after
	 * @param bool $echo
	 *
	 * @return void|string
	 */
	public function the_header_html( $stax_id = null, $before = null, $after = null, $echo = true ) {
		/*if ( ! $before ) {
			$before = '<div class="stax-zone">';
		}
		if ( ! $after ) {
			$after = '</div>';
		}
		$output = $before;
		$output .= $this->get_zones_data( null, $stax_id )->html;
		$output .= $after;

		if ( false === $echo ) {
			return $output;
		}

		echo $output;*/
	}

	/**
	 * @return array|bool|mixed|null|object|string
	 */
	private function get_preview_template() {
		if ( ! $this->is_preview() ) {
			return null;
		}

		$template = null;

		if ( strpos( $_GET['section'], 'stax_tpl_' ) === 0 ) {
			$id       = str_replace( 'stax_tpl_', '', $_GET['section'] );
			$template = Templates::instance()->get_by_id( $id );
		} else {
			$template = Model_Templates::instance()->getById( (int) $_GET['section'] );
		}

		return $template;
	}

	/**
	 * @return array
	 */
	public function display_conditions_archive() {
		$conditions = [];

		foreach ( $this->display_conditions() as $condition ) {
			if ( in_array( 'archive', $condition['category'] ) ) {
				$conditions[] = $condition;
			}
		}

		return $conditions;
	}

	/**
	 * @return array
	 */
	public function display_conditions_single() {
		$conditions = [];

		foreach ( $this->display_conditions() as $condition ) {
			if ( in_array( 'single', $condition['category'] ) ) {
				$conditions[] = $condition;
			}
		}

		return $conditions;
	}

	/**
	 * @return array
	 */
	public function display_conditions() {
		return [
			[
				'tag'      => 'front',
				'callback' => 'is_front_page',
				'fetch'    => 'get_page_front',
				'category' => [ 'single' ]
			],
			[
				'tag'      => 'author-page',
				'callback' => 'is_author',
				'fetch'    => 'get_page_author',
				'category' => [ 'archive' ]
			],
			[
				'tag'      => 'date-page',
				'callback' => 'is_date',
				'fetch'    => 'get_page_date',
				'category' => [ 'archive' ]
			],
			[
				'tag'      => 'search-result',
				'callback' => 'is_search',
				'fetch'    => 'get_page_search',
				'category' => [ 'archive' ]
			],
			[
				'tag'      => 'page',
				'callback' => 'is_page',
				'fetch'    => 'get_page_single',
				'category' => [ 'single' ]
			],
			[
				'tag'      => 'posts',
				'callback' => 'is_single',
				'fetch'    => 'get_page_post',
				'category' => [ 'single', 'archive' ]
			],
			[
				'tag'      => 'categories',
				'callback' => 'is_category',
				'fetch'    => 'get_page_category',
				'category' => [ 'single', 'archive' ]
			],
			[
				'tag'      => 'tag',
				'callback' => 'is_tag',
				'fetch'    => 'get_page_tag',
				'category' => [ 'single', 'archive' ]
			],
			[
				'tag'      => '404',
				'callback' => 'is_404',
				'fetch'    => 'get_page_notfound',
				'category' => [ 'single' ]
			]
		];
	}

	/**
	 * Convert $selector into an XPath string.
	 *
	 * @param $selector
	 *
	 * @return mixed
	 */
	public function selector_to_xpath( $selector ) {
		// remove spaces around operators
		$selector  = preg_replace( '/\s*>\s*/', '>', $selector );
		$selector  = preg_replace( '/\s*~\s*/', '~', $selector );
		$selector  = preg_replace( '/\s*\+\s*/', '+', $selector );
		$selector  = preg_replace( '/\s*,\s*/', ',', $selector );
		$selectors = preg_split( '/\s+(?![^\[]+\])/', $selector );
		foreach ( $selectors as &$selector ) {
			// ,
			$selector = preg_replace( '/,/', '|descendant-or-self::', $selector );
			// input:checked, :disabled, etc.
			$selector = preg_replace( '/(.+)?:(checked|disabled|required|autofocus)/', '\1[@\2="\2"]', $selector );
			// input:autocomplete, :autocomplete
			$selector = preg_replace( '/(.+)?:(autocomplete)/', '\1[@\2="on"]', $selector );
			// input:button, input:submit, etc.
			$selector = preg_replace( '/:(text|password|checkbox|radio|button|submit|reset|file|hidden|image|datetime|datetime-local|date|month|time|week|number|range|email|url|search|tel|color)/', 'input[@type="\1"]', $selector );
			// foo[id]
			$selector = preg_replace( '/(\w+)\[([_\w-]+[_\w\d-]*)\]/', '\1[@\2]', $selector );
			// [id]
			$selector = preg_replace( '/\[([_\w-]+[_\w\d-]*)\]/', '*[@\1]', $selector );
			// foo[id=foo]
			$selector = preg_replace( '/\[([_\w-]+[_\w\d-]*)=[\'"]?(.*?)[\'"]?\]/', '[@\1="\2"]', $selector );
			// [id=foo]
			$selector = preg_replace( '/^\[/', '*[', $selector );
			// div#foo
			$selector = preg_replace( '/([_\w-]+[_\w\d-]*)\#([_\w-]+[_\w\d-]*)/', '\1[@id="\2"]', $selector );
			// #foo
			$selector = preg_replace( '/\#([_\w-]+[_\w\d-]*)/', '*[@id="\1"]', $selector );
			// div.foo
			$selector = preg_replace( '/([_\w-]+[_\w\d-]*)\.([_\w-]+[_\w\d-]*)/', '\1[contains(concat(" ",@class," ")," \2 ")]', $selector );
			// .foo
			$selector = preg_replace( '/\.([_\w-]+[_\w\d-]*)/', '*[contains(concat(" ",@class," ")," \1 ")]', $selector );
			// div:first-child
			$selector = preg_replace( '/([_\w-]+[_\w\d-]*):first-child/', '*/\1[position()=1]', $selector );
			// div:last-child
			$selector = preg_replace( '/([_\w-]+[_\w\d-]*):last-child/', '*/\1[position()=last()]', $selector );
			// :first-child
			$selector = str_replace( ':first-child', '*/*[position()=1]', $selector );
			// :last-child
			$selector = str_replace( ':last-child', '*/*[position()=last()]', $selector );
			// :nth-last-child
			$selector = preg_replace( '/:nth-last-child\((\d+)\)/', '[position()=(last() - (\1 - 1))]', $selector );
			// div:nth-child
			$selector = preg_replace( '/([_\w-]+[_\w\d-]*):nth-child\((\d+)\)/', '*/*[position()=\2 and self::\1]', $selector );
			// :nth-child
			$selector = preg_replace( '/:nth-child\((\d+)\)/', '*/*[position()=\1]', $selector );
			// :contains(Foo)
			$selector = preg_replace( '/([_\w-]+[_\w\d-]*):contains\((.*?)\)/', '\1[contains(string(.),"\2")]', $selector );
			// >
			$selector = preg_replace( '/>/', '/', $selector );
			// ~
			$selector = preg_replace( '/~/', '/following-sibling::', $selector );
			// +
			$selector = preg_replace( '/\+([_\w-]+[_\w\d-]*)/', '/following-sibling::\1[position()=1]', $selector );
			$selector = str_replace( ']*', ']', $selector );
			$selector = str_replace( ']/*', ']', $selector );
		}
		// ' '
		$selector = implode( '/descendant::', $selectors );
		$selector = 'descendant-or-self::' . $selector;
		// :scope
		$selector = preg_replace( '/(((\|)?descendant-or-self::):scope)/', '.\3', $selector );
		// $element
		$sub_selectors = explode( ',', $selector );
		foreach ( $sub_selectors as $key => $sub_selector ) {
			$parts        = explode( '$', $sub_selector );
			$sub_selector = array_shift( $parts );
			if ( count( $parts ) && preg_match_all( '/((?:[^\/]*\/?\/?)|$)/', $parts[0], $matches ) ) {
				$results      = $matches[0];
				$results[]    = str_repeat( '/..', count( $results ) - 2 );
				$sub_selector .= implode( '', $results );
			}
			$sub_selectors[ $key ] = $sub_selector;
		}
		$selector = implode( ',', $sub_selectors );

		return $selector;
	}

	/**
	 * @param $vars
	 *
	 * @return false|string
	 */
	public function init_menu_shortcode( $vars ) {
		if ( ! isset( $vars['slug'] ) ) {
			return 'No menu found';
		}

		$menu = Menus::instance()->getBySlug( [ 'slug' => $vars['slug'] ], false );

		return $menu;
	}

	/**
	 *
	 */
	public function init_admin_dashboard() {
		add_menu_page(
			'STAX Builder',
			'Stax Builder',
			'manage_options',
			'stax',
			[ $this, 'admin_template' ],
			STAX_ASSETS_URL . 'images/stax-16.png',
			99
		);
	}

	/**
	 *
	 */
	public function admin_template() {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}

		require 'admin/index.php';
	}

	/**
	 * Load editor's template
	 *
	 * @return void
	 */
	public function load_open_editor() {
		if ( current_user_can( 'administrator' ) ) {
			require 'ui/start-editor.php';
		}
	}

	/**
	 * Add script to disable click actions
	 *
	 * @return void
	 */
	public function disable_links() {
		wp_register_script(
			'link-disabled',
			STAX_ASSETS_URL . 'js/link-disabled.js',
			[
				'jquery'
			],
			false
		);

		wp_enqueue_script( 'link-disabled' );
	}
}

Plugin::instance();
