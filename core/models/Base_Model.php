<?php
/**
 * Base Model.
 *
 * @package Stax
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since 1.0
 */

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Base_Model {
	const
		STATUS_OK = 200,
		STATUS_FATAL = 201,
		STATUS_DENIED = 202,
		STATUS_FAILED = 203,
		STATUS_NOTFOUND = 204;

	const
		VIEWPORT_DESKTOP = 1,
		VIEWPORT_TABLET = 2,
		VIEWPORT_MOBILE = 3;


	/**
	 * @var string
	 */
	/**
	 * @var string
	 */
	/**
	 * @var string
	 */
	/**
	 * @var string
	 */
	/**
	 * @var string
	 */
	/**
	 * @var string
	 */
	/**
	 * @var string
	 */
	/**
	 * @var string
	 */
	protected
		$table_active_headers = 'stax_active_headers',
		$table_headers = 'stax_headers',
		$table_columns = 'stax_columns',
		$table_elements = 'stax_elements',
		$table_grp_header = 'stax_grp_header',
		$table_grp_header_items = 'stax_grp_header_items',
		$table_templates = 'stax_templates',
		$table_components = 'stax_components';

	/**
	 * @var \wpdb
	 */
	protected $db;


	/**
	 * Base_Model constructor.
	 */
	public function __construct() {
		$this->db = ( new DB )->wpdb();
	}

	/**
	 * @param $code
	 * @param null $stack
	 *
	 * @return mixed|\WP_REST_Response
	 */
	protected function response( $code, $stack = null ) {
		if ( ! is_null( $stack ) && ! is_array( $stack ) ) {
			return $this->response( self::STATUS_FATAL, null );
		}

		if ( ! in_array( $code, [
			self::STATUS_OK,
			self::STATUS_FATAL,
			self::STATUS_DENIED,
			self::STATUS_FAILED,
			self::STATUS_NOTFOUND
		] )
		) {
			return $this->response( self::STATUS_FATAL, null );
		}

		$response = [
			'code' => $code,
			'data' => $stack
		];

		return rest_ensure_response( $response );
	}

	/**
	 * @param $item
	 *
	 * @return mixed
	 */
	protected function clearTrash( $item ) {
		$views = [
			'editor',
			'desktop',
			'tablet',
			'mobile'
		];

		foreach ( $views as $view ) {
			foreach ( $item->{$view} as $items ) {
				foreach ( $items->fields as $key => $field ) {
					if ( is_array( $field->value ) ) {
						$value = [];
						foreach ( $field->value as $val ) {
							$stack          = [];
							$stack['value'] = $val->value;

							if ( isset( $val->checked ) ) {
								$stack['checked'] = $val->checked;
							}

							if ( isset( $val->selected ) ) {
								$stack['selected'] = $val->selected;
							}

							if ( isset( $val->extra ) ) {
								$stack['extra'] = $val->extra;
							}

							$value[] = $stack;
						}
					} else {
						$value = $field->value;
					}

					$items->fields[ $key ] = (object) [
						'name'       => $field->name,
						'visibility' => $field->visibility,
						'value'      => $value,
						'units'      => $field->units
					];
				}
			}
		}

		return $item;
	}

	/**
	 * @param $item
	 *
	 * @return mixed
	 */
	protected function matchAndMergeFields( $item ) {
		return Editor::instance()->matchAndMergeFields( $item );
	}

	/**
	 * @param array $stack
	 * @param $fonts
	 * @param $item
	 *
	 * @return array
	 */
	protected function getItemFonts( array $stack, $fonts, $item ) {
		foreach ( $fonts as $uuid => $id ) {
			if ( $item->uuid == $uuid ) {
				$stack[] = $id;
			}
		}

		return $stack;
	}

}
