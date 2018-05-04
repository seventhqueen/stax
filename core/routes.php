<?php
/**
 *  REST API routes.
 *
 * @package Stax
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since 1.0
 */

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Routes {
	/**
	 * @var null
	 */
	public static $instance = null;

	/**
	 * Routes constructor.
	 */
	public function __construct() {
		add_action( 'rest_api_init', [ $this, 'load' ] );
	}

	/**
	 * @return null|Routes
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 *
	 */
	public function load() {
		register_rest_route( STAX_API_NAMESPACE, '/save-header', [
			'methods'             => 'POST',
			'callback'            => [
				Model_ActiveHeaders::instance(),
				'save'
			],
			'permission_callback' => function () {
				return current_user_can( 'administrator' );
			}
		] );

		register_rest_route( STAX_API_NAMESPACE, '/save-template', [
			'methods'             => 'POST',
			'callback'            => [
				Model_Templates::instance(),
				'save'
			],
			'permission_callback' => function () {
				return current_user_can( 'administrator' );
			}
		] );

		register_rest_route( STAX_API_NAMESPACE, '/update-template', [
			'methods'             => 'POST',
			'callback'            => [
				Model_Templates::instance(),
				'update'
			],
			'permission_callback' => function () {
				return current_user_can( 'administrator' );
			}
		] );

		register_rest_route( STAX_API_NAMESPACE, '/get-default-template/(?P<id>\d+)', [
			'methods'             => 'GET',
			'callback'            => [
				Templates::instance(),
				'rest_get_by_id'
			],
			'permission_callback' => function () {
				return current_user_can( 'administrator' );
			}
		] );

		register_rest_route( STAX_API_NAMESPACE, '/save-component', [
			'methods'             => 'POST',
			'callback'            => [
				Model_Components::instance(),
				'save'
			],
			'permission_callback' => function () {
				return current_user_can( 'administrator' );
			}
		] );

		register_rest_route( STAX_API_NAMESPACE, '/save-settings', [
			'methods'             => 'POST',
			'callback'            => [
				Model_Components::instance(),
				'save_settings'
			],
			'permission_callback' => function () {
				return current_user_can( 'administrator' );
			}
		] );

		register_rest_route( STAX_API_NAMESPACE, '/update-editor-theme', [
			'methods'             => 'POST',
			'callback'            => [
				Model_Settings::instance(),
				'update_theme'
			],
			'permission_callback' => function () {
				return current_user_can( 'administrator' );
			}
		] );

		register_rest_route( STAX_API_NAMESPACE, '/update-preset-colors', [
			'methods'             => 'POST',
			'callback'            => [
				Model_Settings::instance(),
				'update_colors'
			],
			'permission_callback' => function () {
				return current_user_can( 'administrator' );
			}
		] );

		register_rest_route( STAX_API_NAMESPACE, '/helpers/import', [
			'methods'             => 'POST',
			'callback'            => [
				Import::instance(),
				'execute'
			],
			'permission_callback' => function () {
				return current_user_can( 'administrator' );
			}
		] );

		register_rest_route( STAX_API_NAMESPACE, '/helpers/menus', [
			'methods'             => 'GET',
			'callback'            => [
				Menus::instance(),
				'getSlugs'
			],
			'permission_callback' => function () {
				return current_user_can( 'administrator' );
			}
		] );

		register_rest_route( STAX_API_NAMESPACE, '/helpers/shortcode', [
			'methods'             => 'GET',
			'callback'            => [
				ShortCode::instance(),
				'getString'
			],
			'permission_callback' => function () {
				return current_user_can( 'administrator' );
			}
		] );

		register_rest_route( STAX_API_NAMESPACE, '/helpers/menu/(?P<slug>\S+)', [
			'methods'             => 'GET',
			'callback'            => [
				Menus::instance(),
				'getBySlug'
			],
			'permission_callback' => function () {
				return current_user_can( 'administrator' );
			}
		] );

		register_rest_route( STAX_API_NAMESPACE, '/helpers/render-status', [
			'methods'             => 'GET',
			'callback'            => [
				RenderStatus::instance(),
				'toggleStatus'
			],
			'permission_callback' => function () {
				return current_user_can( 'administrator' );
			}
		] );

		register_rest_route( STAX_API_NAMESPACE, '/delete-template/(?P<id>\d+)', [
			'methods'             => 'DELETE',
			'callback'            => [
				Model_Templates::instance(),
				'delete'
			],
			'permission_callback' => function () {
				return current_user_can( 'administrator' );
			}
		] );

		register_rest_route( STAX_API_NAMESPACE, '/delete-component/(?P<id>\d+)', [
			'methods'             => 'DELETE',
			'callback'            => [
				Model_Components::instance(),
				'delete'
			],
			'permission_callback' => function () {
				return current_user_can( 'administrator' );
			}
		] );
	}
}
