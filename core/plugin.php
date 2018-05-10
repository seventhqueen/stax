<?php

/**
 * Stax main loader file.
 *
 * @package Stax
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since 1.0
 */
namespace Stax;

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Class Plugin
 *
 * @package Stax
 */
class Plugin
{
    /**
     * @var null
     */
    public static  $instance = null ;
    /**
     * @var
     */
    public  $ui ;
    /**
     * @var
     */
    public  $settings ;
    /**
     * @var
     */
    public  $db ;
    /**
     * @var
     */
    public  $route ;
    /**
     * @var
     */
    public  $editor ;
    /**
     * @var Mobile_Detect
     */
    private  $viewportDetect ;
    /**
     * @var null
     */
    public static  $header_data = array() ;
    /**
     * Plugin Instance
     *
     * @return null|Plugin
     */
    public static function instance()
    {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Plugin constructor.
     */
    public function __construct()
    {
        $this->include_models();
        $this->include_classes();
        $this->init_classes();
        Routes::instance();
        register_activation_hook( STAX_FILE, [ $this, 'migrate' ] );
        add_action( 'wp', [ $this, 'wp' ] );
        add_action( 'init', [ $this, 'init' ] );
        add_action( 'wp_loaded', [ $this, 'wp_loaded' ], 1 );
        $this->viewportDetect = new Mobile_Detect();
    }
    
    /**
     *
     */
    public function wp()
    {
        Compatibility::instance()->register();
    }
    
    /**
     *
     */
    public function init()
    {
        if ( is_admin() ) {
            add_action( 'admin_menu', [ $this, 'init_admin_dashboard' ] );
        }
        add_shortcode( 'stax-header', [ $this, 'init_header_shortcode' ] );
        add_shortcode( 'stax-menu', [ $this, 'init_menu_shortcode' ] );
        if ( $this->is_setup() || $this->is_preview() ) {
            add_action( 'wp_enqueue_scripts', [ $this, 'disable_links' ], 10 );
        }
        
        if ( !$this->is_editing() && !$this->is_preview() && !$this->is_setup() ) {
            add_action( 'wp_head', [ $this, 'front_fonts' ], 50 );
            add_action( 'wp_head', [ $this, 'front_css' ], 50 );
            add_action( 'wp_footer', [ $this, 'front_only_script' ], 9 );
            add_action( 'wp_footer', [ $this, 'load_open_editor' ] );
        } elseif ( $this->is_preview() ) {
            add_action( 'wp_head', [ $this, 'front_fonts' ], 50 );
            add_action( 'wp_head', [ $this, 'front_css' ], 50 );
            add_action( 'wp_footer', [ $this, 'front_only_script' ], 9 );
        }
    
    }
    
    public function body_class( $classes = array() )
    {
        $classes[] = 'stax-header-enabled';
        return $classes;
    }
    
    /**
     *
     */
    public function front_css()
    {
        
        if ( $this->is_preview() ) {
            $template = $this->get_preview_template();
            
            if ( $template ) {
                $data = $this->get_header_data( $template->pack )->css;
            } else {
                $data = $this->get_header_data()->css;
            }
        
        } else {
            $data = $this->get_header_data()->css;
        }
        
        $output = $this->get_front_css_by_data( $data );
        echo  '<style>' . $output . '</style>' . "\n" ;
    }
    
    private function get_front_css_by_data( $data )
    {
        $output = '';
        if ( !is_array( $data ) || empty($data) ) {
            return '';
        }
        
        if ( !$data['desktop'] && !$data['tablet'] && !$data['mobile'] ) {
            $output = $data['general'];
        } else {
            $output .= '@media (max-width: 767.99px) {' . (( $data['mobile'] ? $data['mobile'] : $data['general'] )) . '}';
            $output .= '@media (min-width: 768px) and (max-width: 991.99px) {' . (( $data['tablet'] ? $data['tablet'] : $data['general'] )) . '}';
            $output .= '@media (min-width: 992px) {' . (( $data['desktop'] ? $data['desktop'] : $data['general'] )) . '}';
        }
        
        return $output;
    }
    
    /**
     *
     */
    public function front_fonts()
    {
        
        if ( $this->is_preview() ) {
            $template = $this->get_preview_template();
            
            if ( $template ) {
                $headerFonts = $this->get_header_data( $template->pack )->fonts;
            } else {
                $headerFonts = $this->get_header_data()->fonts;
            }
        
        } else {
            $headerFonts = $this->get_header_data()->fonts;
        }
        
        $fonts_url = $this->get_front_fonts_by_data( $headerFonts );
        if ( $fonts_url ) {
            echo  '<link href="' . $fonts_url . '" rel="stylesheet" type="text/css">' ;
        }
    }
    
    private function get_front_fonts_by_data( $headerFonts )
    {
        $finalURL = false;
        if ( !is_array( $headerFonts ) || empty($headerFonts) ) {
            return $finalURL;
        }
        $fonts = Fonts::instance()->get();
        $list = $fonts->items;
        $baseUrl = 'https://fonts.googleapis.com/css?family=';
        $fontWeights = ':100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic';
        foreach ( $headerFonts as $key => $font ) {
            if ( array_key_exists( $font, $list ) ) {
                
                if ( $key + 1 === count( $headerFonts ) ) {
                    $finalURL .= $baseUrl . urlencode( $list[$font]->family ) . $fontWeights;
                } else {
                    $finalURL .= $baseUrl . urlencode( $list[$font]->family ) . $fontWeights . urlencode( '|' );
                }
            
            }
        }
        return $finalURL;
    }
    
    /**
     *
     */
    public function front_only_script()
    {
        
        if ( $this->is_preview() ) {
            $template = $this->get_preview_template();
            
            if ( $template ) {
                $header_data = $this->get_header_data( $template->pack )->responsive;
            } else {
                $header_data = $this->get_header_data()->responsive;
            }
        
        } else {
            $header_data = $this->get_header_data()->responsive;
        }
        
        if ( empty($header_data) ) {
            return;
        }
        echo  '<script>' . 'var staxResponsive = ' . json_encode( $header_data ) . ';' . "</script>\n" ;
    }
    
    /**
     *
     */
    public function wp_loaded()
    {
        if ( $this->isRestUrl() || is_admin() || defined( 'DOING_AJAX' ) && DOING_AJAX ) {
            return;
        }
        $tag = Model_Settings::instance()->get_current_tag();
        
        if ( !empty($tag) && !Compatibility::instance()->is_front_theme_compatible() && !$this->is_editing() && !$this->is_setup() && RenderStatus::instance()->getStatus() || $this->is_preview() ) {
            $this->special_hook();
            add_filter( 'sq_special_output', [ $this, 'render_header' ] );
        }
        
        if ( $this->is_editing() || RenderStatus::instance()->getStatus() ) {
            //Add our body class
            add_action( 'body_class', [ $this, 'body_class' ] );
        }
    }
    
    /**
     * @return bool
     */
    public function isRestUrl()
    {
        $isRest = false;
        
        if ( function_exists( 'rest_url' ) && !empty($_SERVER['REQUEST_URI']) ) {
            $sRestUrlBase = get_rest_url( get_current_blog_id(), '/' );
            $sRestPath = trim( parse_url( $sRestUrlBase, PHP_URL_PATH ), '/' );
            $sRequestPath = trim( $_SERVER['REQUEST_URI'], '/' );
            $isRest = strpos( $sRequestPath, $sRestPath ) === 0;
        }
        
        return $isRest;
    }
    
    /**
     * Include our models
     */
    public function include_models()
    {
        include STAX_CORE_PATH . 'models/Base_Model.php';
        include STAX_CORE_PATH . 'models/Model_ActiveHeaders.php';
        include STAX_CORE_PATH . 'models/Model_Headers.php';
        include STAX_CORE_PATH . 'models/Model_Columns.php';
        include STAX_CORE_PATH . 'models/Model_Elements.php';
        include STAX_CORE_PATH . 'models/Model_GrpHeader.php';
        include STAX_CORE_PATH . 'models/Model_GrpHeaderItems.php';
        include STAX_CORE_PATH . 'models/Model_Templates.php';
        include STAX_CORE_PATH . 'models/Model_Components.php';
        include STAX_CORE_PATH . 'models/Model_Settings.php';
        include STAX_CORE_PATH . 'components/base/HeaderInterface.php';
        include STAX_CORE_PATH . 'components/base/ColumnInterface.php';
        include STAX_CORE_PATH . 'components/base/ElementInterface.php';
        include STAX_CORE_PATH . 'components/helpers/ElementSpecs.php';
        include STAX_CORE_PATH . 'components/helpers/EditorSection.php';
        include STAX_CORE_PATH . 'components/helpers/EditorSectionField.php';
        include STAX_CORE_PATH . 'components/helpers/Sanitizer.php';
        include STAX_CORE_PATH . 'components/helpers/Composer.php';
        include STAX_CORE_PATH . 'components/helpers/Mobile_Detect.php';
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
        include STAX_CORE_PATH . 'components/ElementIcon.php';
        include STAX_CORE_PATH . 'components/ElementSeparator.php';
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
        include STAX_CORE_PATH . 'exception/FatalException.php';
        include STAX_CORE_PATH . 'exception/FieldValueException.php';
        include STAX_CORE_PATH . 'exception/MissingException.php';
    }
    
    /**
     * Include required classes
     *
     * @return void
     */
    public function include_classes()
    {
        include STAX_CORE_PATH . 'routes.php';
        include STAX_CORE_PATH . 'db/db.php';
        include STAX_CORE_PATH . 'editor.php';
    }
    
    /**
     * Init classes
     *
     * @return void
     */
    public function init_classes()
    {
        $this->db = new DB();
        $this->editor = Editor::instance();
    }
    
    /**
     * Are we editing the header?
     *
     * @return bool
     */
    public function is_editing()
    {
        if ( ($this->is_editor_frame() || $this->is_editor_panel()) && !is_admin() ) {
            return true;
        }
        return false;
    }
    
    /**
     * Are we in the editing panel
     *
     * @return bool
     */
    public function is_editor_panel()
    {
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
    public function is_editor_frame()
    {
        if ( isset( $_GET['is-editing'] ) ) {
            return true;
        }
        return false;
    }
    
    /**
     * Check if we are previewing a header
     *
     * @return bool
     */
    public function is_preview()
    {
        if ( isset( $_GET['is-preview'] ) && isset( $_GET['header'] ) && (is_numeric( $_GET['header'] ) || strpos( $_GET['header'], 'stax_tpl' ) === 0) && !is_admin() ) {
            return true;
        }
        return false;
    }
    
    /**
     * Check if we are on initial setup
     *
     * @return bool
     */
    public function is_setup()
    {
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
    public function is_front()
    {
        if ( !$this->is_editing() && !$this->is_setup() && !$this->is_preview() ) {
            return true;
        }
        return false;
    }
    
    /**
     *
     */
    public function special_hook()
    {
        ob_start();
        add_action( 'shutdown', function () {
            $final = '';
            $levels = ob_get_level();
            for ( $i = 0 ;  $i < $levels ;  $i++ ) {
                $final .= ob_get_clean();
            }
            /* Here we make the header replacement */
            echo  apply_filters( 'sq_special_output', $final ) ;
        }, 0 );
    }
    
    /**
     *
     */
    public function migrate()
    {
        $this->db->migrate();
    }
    
    /**
     * @param array $stack
     * @param $props
     *
     * @return array
     */
    private function addCss( array $stack, $props )
    {
        foreach ( $stack as $viewport => $string ) {
            
            if ( $props->{$viewport} ) {
                $stack[$viewport] .= $props->{$viewport};
            } else {
                $stack[$viewport] .= $props->generalCSS;
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
    private function addHtml( array $stack, $props, $group )
    {
        foreach ( $props->frontend as $viewport => $items ) {
            $position = 0;
            foreach ( $group as $item ) {
                if ( $item->viewport === $viewport ) {
                    $position = intval( $item->position );
                }
            }
            
            if ( $position ) {
                $stack[$viewport]['auth'][] = [
                    'content'  => $this->doShortcodes( $items->auth ),
                    'position' => $position,
                ];
                $stack[$viewport]['not_auth'][] = [
                    'content'  => $this->doShortcodes( $items->not_auth ),
                    'position' => $position,
                ];
            }
        
        }
        return $stack;
    }
    
    /**
     * @param $string
     *
     * @return mixed
     */
    private function doShortcodes( $string )
    {
        $menu = $this->get_string_between( $string, '[menu]', '[/menu]' );
        
        if ( $menu ) {
            $renderedMenu = do_shortcode( '[stax-menu slug="' . $menu . '"]' );
            $string = str_replace( "[menu]" . $menu . "[/menu]", $renderedMenu, $string );
        }
        
        return $string;
    }
    
    /**
     * @param $string
     * @param $start
     * @param $end
     *
     * @return bool|string
     */
    private function get_string_between( $string, $start, $end )
    {
        $string = " " . $string;
        $ini = strpos( $string, $start );
        if ( $ini == 0 ) {
            return "";
        }
        $ini += strlen( $start );
        $len = strpos( $string, $end, $ini ) - $ini;
        return substr( $string, $ini, $len );
    }
    
    /**
     * @param $stack
     *
     * @return array
     */
    private function sortHtml( $stack )
    {
        $html = [
            'desktop' => [
            'auth'     => '',
            'not_auth' => '',
        ],
            'tablet'  => [
            'auth'     => '',
            'not_auth' => '',
        ],
            'mobile'  => [
            'auth'     => '',
            'not_auth' => '',
        ],
        ];
        foreach ( $stack as $key => $item ) {
            usort( $stack[$key]['auth'], function ( $a, $b ) {
                return $a['position'] - $b['position'];
            } );
            usort( $stack[$key]['not_auth'], function ( $a, $b ) {
                return $a['position'] - $b['position'];
            } );
        }
        foreach ( $stack as $key => $item ) {
            foreach ( $item as $type => $content ) {
                foreach ( $content as $cont ) {
                    $html[$key][$type] .= $cont['content'];
                }
            }
        }
        return $html;
    }
    
    /**
     * @param null $previewPack
     * @param null $stax_id
     *
     * @return null|\stdClass
     */
    public function get_header_data( $previewPack = null, $stax_id = null )
    {
        $header_type = 'general';
        
        if ( !$stax_id ) {
            $id = get_the_ID();
            $stax_id = get_option( 'stax_item_' . $id );
        }
        
        if ( $stax_id ) {
            $header_type = $stax_id;
        }
        if ( isset( self::$header_data[$header_type] ) && !$previewPack ) {
            return self::$header_data[$header_type];
        }
        $pack = null;
        if ( !$previewPack && $stax_id ) {
            $pack = Model_ActiveHeaders::instance()->getById( $stax_id );
        }
        if ( !$pack && !$previewPack ) {
            $pack = Model_ActiveHeaders::instance()->getGeneral();
        }
        $headerStack = $this->buildHeaderStack( $pack );
        
        if ( $previewPack ) {
            
            if ( is_object( $previewPack ) ) {
                $previewItems = $previewPack;
            } else {
                $previewItems = json_decode( $previewPack );
            }
            
            foreach ( $previewItems->headers as $header ) {
                $previewHeaderGroup = $previewItems->groups->{$header->uuid};
                $tempDesktopGroup = new \stdClass();
                $tempDesktopGroup->viewport = 'desktop';
                $tempDesktopGroup->position = $previewHeaderGroup->viewport->desktop->position;
                $tempTabletGroup = new \stdClass();
                $tempTabletGroup->viewport = 'tablet';
                $tempTabletGroup->position = $previewHeaderGroup->viewport->tablet->position;
                $tempMobileGroup = new \stdClass();
                $tempMobileGroup->viewport = 'mobile';
                $tempMobileGroup->position = $previewHeaderGroup->viewport->mobile->position;
                $itemGroup[] = $tempDesktopGroup;
                $itemGroup[] = $tempTabletGroup;
                $itemGroup[] = $tempMobileGroup;
                $headerStack->css = $this->addCss( $headerStack->css, $header );
                $headerStack->stack = $this->addHtml( $headerStack->stack, $header, $itemGroup );
            }
            foreach ( $previewItems->columns as $column ) {
                $headerStack->css = $this->addCss( $headerStack->css, $column );
            }
            foreach ( $previewItems->elements as $element ) {
                $headerStack->css = $this->addCss( $headerStack->css, $element );
            }
        }
        
        $finalHtml = $this->sortHtml( $headerStack->stack );
        $header_template = $this->get_header_template( $finalHtml );
        
        if ( is_user_logged_in() ) {
            $desktop_template = $finalHtml['desktop']['auth'];
            $tablet_template = ( $finalHtml['tablet']['auth'] ? $finalHtml['tablet']['auth'] : $finalHtml['desktop']['auth'] );
            $mobile_template = ( $finalHtml['mobile']['auth'] ? $finalHtml['mobile']['auth'] : $finalHtml['desktop']['auth'] );
        } else {
            $desktop_template = $finalHtml['desktop']['not_auth'];
            $tablet_template = ( $finalHtml['tablet']['not_auth'] ? $finalHtml['tablet']['not_auth'] : $finalHtml['desktop']['not_auth'] );
            $mobile_template = ( $finalHtml['mobile']['not_auth'] ? $finalHtml['mobile']['not_auth'] : $finalHtml['desktop']['not_auth'] );
        }
        
        $responsive_data = [
            'mobile'  => $mobile_template,
            'tablet'  => $tablet_template,
            'desktop' => $desktop_template,
        ];
        $data = new \stdClass();
        $data->html = $header_template;
        $data->css = [
            'general' => $headerStack->css['generalCSS'],
            'desktop' => $headerStack->css['desktopCSS'],
            'tablet'  => $headerStack->css['tabletCSS'],
            'mobile'  => $headerStack->css['mobileCSS'],
        ];
        $data->viewports = $finalHtml;
        $data->fonts = $headerStack->fonts;
        $data->responsive = $responsive_data;
        /* Cache the result */
        if ( !$previewPack ) {
            self::$header_data[$header_type] = $data;
        }
        return $data;
    }
    
    private function get_header_template( $finalHtml )
    {
        
        if ( $this->viewportDetect->isMobile() ) {
            
            if ( is_user_logged_in() ) {
                $header_template = ( $finalHtml['mobile']['auth'] ? $finalHtml['mobile']['auth'] : $finalHtml['desktop']['auth'] );
            } else {
                $header_template = ( $finalHtml['mobile']['not_auth'] ? $finalHtml['mobile']['not_auth'] : $finalHtml['desktop']['not_auth'] );
            }
        
        } elseif ( $this->viewportDetect->isTablet() ) {
            
            if ( is_user_logged_in() ) {
                $header_template = ( $finalHtml['tablet']['auth'] ? $finalHtml['tablet']['auth'] : $finalHtml['desktop']['auth'] );
            } else {
                $header_template = ( $finalHtml['tablet']['not_auth'] ? $finalHtml['tablet']['not_auth'] : $finalHtml['desktop']['not_auth'] );
            }
        
        } else {
            
            if ( is_user_logged_in() ) {
                $header_template = $finalHtml['desktop']['auth'];
            } else {
                $header_template = $finalHtml['desktop']['not_auth'];
            }
        
        }
        
        return $header_template;
    }
    
    /**
     * @param $pack
     *
     * @return object
     */
    private function buildHeaderStack( $pack )
    {
        $css = [
            'generalCSS' => '',
            'desktopCSS' => '',
            'tabletCSS'  => '',
            'mobileCSS'  => '',
        ];
        $stack = [
            'desktop' => [
            'auth'     => [],
            'not_auth' => [],
        ],
            'tablet'  => [
            'auth'     => [],
            'not_auth' => [],
        ],
            'mobile'  => [
            'auth'     => [],
            'not_auth' => [],
        ],
        ];
        $fonts = [];
        
        if ( $pack ) {
            $pack = @json_decode( $pack->pack );
            $fonts = $pack->fonts;
            $existingColumns = [];
            $existingElements = [];
            foreach ( $pack->headers as $header ) {
                $header = Model_Headers::instance()->get( $header );
                
                if ( $header ) {
                    $headerGroup = Model_GrpHeader::instance()->get( $header->uuid );
                    if ( !$headerGroup ) {
                        continue;
                    }
                    $headerProps = json_decode( $header->properties );
                    $css = $this->addCss( $css, $headerProps );
                    $stack = $this->addHtml( $stack, $headerProps, $headerGroup );
                    $columnsGroup = Model_GrpHeaderItems::instance()->getByHeaderUuid( $headerProps->uuid );
                    foreach ( $columnsGroup as $colGroup ) {
                        $colProps = Model_Columns::instance()->get( $colGroup->column_uuid );
                        if ( !$colProps ) {
                            continue;
                        }
                        if ( !in_array( $colGroup->column_uuid, $existingColumns ) ) {
                            $css = $this->addCss( $css, @json_decode( $colProps->properties ) );
                        }
                        $elementsGroup = @json_decode( $colGroup->elements );
                        foreach ( $elementsGroup as $elUuid => $elGroup ) {
                            $elementProps = Model_Elements::instance()->get( $elUuid );
                            if ( !$elementProps ) {
                                continue;
                            }
                            if ( !in_array( $elUuid, $existingElements ) ) {
                                $css = $this->addCss( $css, @json_decode( $elementProps->properties ) );
                            }
                            $existingElements[] = $elUuid;
                        }
                        $existingColumns[] = $colGroup->column_uuid;
                    }
                }
            
            }
        }
        
        return (object) [
            'css'   => $css,
            'stack' => $stack,
            'fonts' => $fonts,
        ];
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
    public function the_header_html(
        $stax_id = null,
        $before = null,
        $after = null,
        $echo = true
    )
    {
        if ( !$before ) {
            $before = '<div class="stax-zone">';
        }
        if ( !$after ) {
            $after = '</div>';
        }
        $output = $before;
        $output .= $this->get_header_data( null, $stax_id )->html;
        $output .= $after;
        if ( false === $echo ) {
            return $output;
        }
        echo  $output ;
    }
    
    private function get_preview_template()
    {
        $template = false;
        if ( !$this->is_preview() ) {
            return $template;
        }
        /* Check Stax default Templates */
        
        if ( strpos( $_GET['header'], 'stax_tpl_' ) === 0 ) {
            $id = str_replace( 'stax_tpl_', '', $_GET['header'] );
            $template = Templates::instance()->get_by_id( $id );
        } else {
            $template = Model_Templates::instance()->getById( (int) $_GET['header'] );
        }
        
        return $template;
    }
    
    /**
     * Replace existing header with our own
     *
     * @param string $dom Existing HTML content.
     *
     * @return string
     */
    public function render_header( $dom )
    {
        
        if ( $this->is_preview() ) {
            $template = $this->get_preview_template();
            
            if ( $template ) {
                $headerData = $this->get_header_data( $template->pack );
                $dom = $this->process_header( $headerData, $dom );
            }
        
        } else {
            $headerData = $this->get_header_data();
            $dom = $this->process_header( $headerData, $dom );
        }
        
        return $dom;
    }
    
    /**
     * @param $headerData
     * @param $dom
     *
     * @return string
     */
    private function process_header( $headerData, $dom )
    {
        if ( !$headerData->html || empty($dom) ) {
            return $dom;
        }
        $handler = new \DOMDocument();
        libxml_use_internal_errors( true );
        $handler->loadHTML( $dom, LIBXML_NOWARNING );
        $newHeader = $handler->createElement( 'div' );
        $newHeader->setAttribute( 'class', 'stax-zone' );
        $newHeader = $this->appendHTML( $newHeader, $headerData->html );
        $current_tag = Model_Settings::instance()->get_current_tag();
        if ( empty($current_tag) ) {
            return $dom;
        }
        
        if ( 'selector' === $current_tag['tagType'] ) {
            $tag = $this->selector_to_xpath( $current_tag['tag'] );
        } else {
            $tag = $current_tag['tag'];
        }
        
        $x_path = new \DOMXPath( $handler );
        $nodeList = $x_path->query( $tag );
        $oldHeader = $nodeList->item( 0 );
        
        if ( $oldHeader ) {
            $oldHeader->parentNode->replaceChild( $newHeader, $oldHeader );
            $dom = $handler->saveHTML();
        }
        
        /*if ( $finalOutput ) {
        			$style = $handler->createDocumentFragment();
        			$style->appendXML( '<style>' . $finalOutput . '</style>' );
        			$x_path->query( 'head' )->item( 0 )->appendChild( $style );
        			$dom = $handler->saveHTML();
        		}*/
        return $dom;
    }
    
    /**
     * @param \DOMNode $parent
     * @param $source
     *
     * @return \DOMNode
     */
    public function appendHTML( \DOMNode $parent, $source )
    {
        $tmpDoc = new \DOMDocument();
        $tmpDoc->loadHTML( $source );
        foreach ( $tmpDoc->getElementsByTagName( 'body' )->item( 0 )->childNodes as $node ) {
            $node = $parent->ownerDocument->importNode( $node, true );
            $parent->appendChild( $node );
        }
        return $parent;
    }
    
    /**
     * Convert $selector into an XPath string.
     *
     * @param $selector
     *
     * @return mixed
     */
    public function selector_to_xpath( $selector )
    {
        // remove spaces around operators
        $selector = preg_replace( '/\\s*>\\s*/', '>', $selector );
        $selector = preg_replace( '/\\s*~\\s*/', '~', $selector );
        $selector = preg_replace( '/\\s*\\+\\s*/', '+', $selector );
        $selector = preg_replace( '/\\s*,\\s*/', ',', $selector );
        $selectors = preg_split( '/\\s+(?![^\\[]+\\])/', $selector );
        foreach ( $selectors as &$selector ) {
            // ,
            $selector = preg_replace( '/,/', '|descendant-or-self::', $selector );
            // input:checked, :disabled, etc.
            $selector = preg_replace( '/(.+)?:(checked|disabled|required|autofocus)/', '\\1[@\\2="\\2"]', $selector );
            // input:autocomplete, :autocomplete
            $selector = preg_replace( '/(.+)?:(autocomplete)/', '\\1[@\\2="on"]', $selector );
            // input:button, input:submit, etc.
            $selector = preg_replace( '/:(text|password|checkbox|radio|button|submit|reset|file|hidden|image|datetime|datetime-local|date|month|time|week|number|range|email|url|search|tel|color)/', 'input[@type="\\1"]', $selector );
            // foo[id]
            $selector = preg_replace( '/(\\w+)\\[([_\\w-]+[_\\w\\d-]*)\\]/', '\\1[@\\2]', $selector );
            // [id]
            $selector = preg_replace( '/\\[([_\\w-]+[_\\w\\d-]*)\\]/', '*[@\\1]', $selector );
            // foo[id=foo]
            $selector = preg_replace( '/\\[([_\\w-]+[_\\w\\d-]*)=[\'"]?(.*?)[\'"]?\\]/', '[@\\1="\\2"]', $selector );
            // [id=foo]
            $selector = preg_replace( '/^\\[/', '*[', $selector );
            // div#foo
            $selector = preg_replace( '/([_\\w-]+[_\\w\\d-]*)\\#([_\\w-]+[_\\w\\d-]*)/', '\\1[@id="\\2"]', $selector );
            // #foo
            $selector = preg_replace( '/\\#([_\\w-]+[_\\w\\d-]*)/', '*[@id="\\1"]', $selector );
            // div.foo
            $selector = preg_replace( '/([_\\w-]+[_\\w\\d-]*)\\.([_\\w-]+[_\\w\\d-]*)/', '\\1[contains(concat(" ",@class," ")," \\2 ")]', $selector );
            // .foo
            $selector = preg_replace( '/\\.([_\\w-]+[_\\w\\d-]*)/', '*[contains(concat(" ",@class," ")," \\1 ")]', $selector );
            // div:first-child
            $selector = preg_replace( '/([_\\w-]+[_\\w\\d-]*):first-child/', '*/\\1[position()=1]', $selector );
            // div:last-child
            $selector = preg_replace( '/([_\\w-]+[_\\w\\d-]*):last-child/', '*/\\1[position()=last()]', $selector );
            // :first-child
            $selector = str_replace( ':first-child', '*/*[position()=1]', $selector );
            // :last-child
            $selector = str_replace( ':last-child', '*/*[position()=last()]', $selector );
            // :nth-last-child
            $selector = preg_replace( '/:nth-last-child\\((\\d+)\\)/', '[position()=(last() - (\\1 - 1))]', $selector );
            // div:nth-child
            $selector = preg_replace( '/([_\\w-]+[_\\w\\d-]*):nth-child\\((\\d+)\\)/', '*/*[position()=\\2 and self::\\1]', $selector );
            // :nth-child
            $selector = preg_replace( '/:nth-child\\((\\d+)\\)/', '*/*[position()=\\1]', $selector );
            // :contains(Foo)
            $selector = preg_replace( '/([_\\w-]+[_\\w\\d-]*):contains\\((.*?)\\)/', '\\1[contains(string(.),"\\2")]', $selector );
            // >
            $selector = preg_replace( '/>/', '/', $selector );
            // ~
            $selector = preg_replace( '/~/', '/following-sibling::', $selector );
            // +
            $selector = preg_replace( '/\\+([_\\w-]+[_\\w\\d-]*)/', '/following-sibling::\\1[position()=1]', $selector );
            $selector = str_replace( ']*', ']', $selector );
            $selector = str_replace( ']/*', ']', $selector );
        }
        // ' '
        $selector = implode( '/descendant::', $selectors );
        $selector = 'descendant-or-self::' . $selector;
        // :scope
        $selector = preg_replace( '/(((\\|)?descendant-or-self::):scope)/', '.\\3', $selector );
        // $element
        $sub_selectors = explode( ',', $selector );
        foreach ( $sub_selectors as $key => $sub_selector ) {
            $parts = explode( '$', $sub_selector );
            $sub_selector = array_shift( $parts );
            
            if ( count( $parts ) && preg_match_all( '/((?:[^\\/]*\\/?\\/?)|$)/', $parts[0], $matches ) ) {
                $results = $matches[0];
                $results[] = str_repeat( '/..', count( $results ) - 2 );
                $sub_selector .= implode( '', $results );
            }
            
            $sub_selectors[$key] = $sub_selector;
        }
        $selector = implode( ',', $sub_selectors );
        return $selector;
    }
    
    /**
     * @param $vars
     *
     * @return string
     */
    public function init_header_shortcode( $vars )
    {
        if ( !isset( $vars['id'] ) ) {
            return 'Invalid header';
        }
        $header = $this->get_header_data( null, $vars['id'] );
        if ( !$header ) {
            return 'Invalid header';
        }
        $output = '';
        $fonts_url = $this->get_front_fonts_by_data( $header->fonts );
        if ( $fonts_url ) {
            $output .= '<link href="' . $fonts_url . '" rel="stylesheet" type="text/css">' . "\n";
        }
        $css_data = $this->get_front_css_by_data( $header->css );
        $output .= '<style>' . $css_data . '</style>' . "\n";
        $output .= $this->the_header_html(
            $vars['id'],
            null,
            null,
            false
        );
        return $output;
    }
    
    /**
     * @param $vars
     *
     * @return false|string
     */
    public function init_menu_shortcode( $vars )
    {
        if ( !isset( $vars['slug'] ) ) {
            return 'No menu found';
        }
        $menu = Menus::instance()->getBySlug( [
            'slug' => $vars['slug'],
        ], false );
        return $menu;
    }
    
    /**
     * @return string
     */
    public function init_demo_shortcode()
    {
        return 'Hello! I\'m the shortcode. :)';
    }
    
    /**
     *
     */
    public function init_admin_dashboard()
    {
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
    public function admin_template()
    {
        if ( !current_user_can( 'manage_options' ) ) {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }
        $headersInstance = Model_ActiveHeaders::instance();
        $masterHeader = $headersInstance->getGeneral();
        $attachedHeaders = OptionsWP::instance()->getAttachedHeaders();
        $headers = $headersInstance->getAll();
        foreach ( $attachedHeaders as $attached ) {
            foreach ( $headers as $key => $header ) {
                if ( intval( $header->general ) ) {
                    unset( $headers[$key] );
                }
                if ( $attached['header_id'] === intval( $header->id ) ) {
                    unset( $headers[$key] );
                }
            }
        }
        require 'admin/index.php';
    }
    
    /**
     *
     */
    public function load_open_editor()
    {
        if ( current_user_can( 'administrator' ) ) {
            require 'ui/start-editor.php';
        }
    }
    
    /**
     *
     */
    public function disable_links()
    {
        wp_register_script(
            'link-disabled',
            STAX_ASSETS_URL . 'js/link-disabled.js',
            [ 'jquery' ],
            false
        );
        wp_enqueue_script( 'link-disabled' );
    }

}
Plugin::instance();