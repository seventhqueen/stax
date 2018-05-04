<?php
/**
 * Settings Model.
 *
 * @package Stax
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since 1.0
 */

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Model_Settings extends Base_Model {

	/**
	 * Instance
	 *
	 * @var Model_Settings
	 */
	public static $instance = null;

	/**
	 * Class instance
	 *
	 * @return Model_Settings
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Get array with xpath or selector settings
	 *
	 * @return array
	 */
	public function get_current_tag() {
		$tag          = [];
		$current_data = get_option( STAX_OPTION_NAME );

		if ( $current_data ) {
			$theme = Compatibility::instance()->get_current_theme();

			if ( isset( $current_data[ $theme ] ) && isset( $current_data[ $theme ]['tag'] ) ) {
				$tag = [
					'tag'     => $current_data[ $theme ]['tag'],
					'tagType' => $current_data[ $theme ]['tagType'],
				];
			}
		}
		if ( empty( $tag ) && Compatibility::instance()->get_tag() ) {
			$tag = Compatibility::instance()->get_tag();
		}

		return $tag;
	}

	/**
	 * Save settings
	 *
	 * @param \WP_REST_Request $request Request.
	 *
	 * @return mixed|\WP_REST_Response
	 */
	public function update_settings( \WP_REST_Request $request ) {

		$data = $request->get_params();
		if ( isset( $data['tag'] ) && isset( $data['tagType'] ) ) {

			$current_data = $this->get_current_tag();

			$theme = Compatibility::instance()->get_current_theme();

			$current_data[ $theme ] = array(
				'tag'     => $data['tag'],
				'tagType' => $data['tagType'],
			);

			if ( update_option( STAX_OPTION_NAME, $current_data ) ) {
				return $this->response( self::STATUS_OK, $current_data );
			}
		}

		return $this->response( self::STATUS_FAILED );
	}

	/**
	 * @param \WP_REST_Request $request
	 *
	 * @return mixed|\WP_REST_Response
	 */
	public function update_theme( \WP_REST_Request $request ) {
		$data = $request->get_params();
		if ( isset( $data['theme'] ) ) {
			update_option( 'stax_editor_theme', $data['theme'] );

			return $this->response( self::STATUS_OK );
		}

		return $this->response( self::STATUS_FAILED );
	}

	/**
	 * @param \WP_REST_Request $request
	 *
	 * @return mixed|\WP_REST_Response
	 */
	public function update_colors( \WP_REST_Request $request ) {
		$data = $request->get_params();
		if ( isset( $data['colors'] ) ) {
			update_option( 'stax_color_picker', $data['colors'] );

			return $this->response( self::STATUS_OK );
		}

		return $this->response( self::STATUS_FAILED );
	}
}
