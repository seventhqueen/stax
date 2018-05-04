<?php
/**
 * Active headers Model.
 *
 * @package Stax
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since 1.0
 */

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Model_ActiveHeaders extends Base_Model {

	/**
	 * @var null
	 */
	public static $instance = null;

	/**
	 * @return null|Model_ActiveHeaders
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * @return array|null|object|void
	 */
	public function getGeneral() {
		$header = $this->db->get_row(
			$this->db->prepare(
				"SELECT * FROM `" . $this->db->prefix . $this->table_active_headers . "` WHERE `deleted_at` IS NULL AND `general` = %s",
				1
			)
		);

		return $header;
	}

	/**
	 * @param $id
	 *
	 * @return array|null|object|void
	 */
	public function getById( $id ) {
		$header = $this->db->get_row(
			$this->db->prepare(
				"SELECT * FROM `" . $this->db->prefix . $this->table_active_headers . "` WHERE `deleted_at` IS NULL AND `id` = %s",
				$id
			)
		);

		return $header;
	}

	/**
	 * @return array|null|object
	 */
	public function getAll() {
		$headers = $this->db->get_results( "SELECT * FROM `" . $this->db->prefix . $this->table_active_headers . "` WHERE `deleted_at` IS NULL" );

		return $headers;
	}

	/**
	 * @param \WP_REST_Request $request
	 *
	 * @return mixed|\WP_REST_Response
	 */
	public function save( \WP_REST_Request $request ) {
		$data = $request->get_params();

		if ( ! is_array( $data )
		     || ! isset( $data['headers'] )
		     || ! isset( $data['columns'] )
		     || ! isset( $data['elements'] )
		     || ! isset( $data['groups'] )
		     || ! isset( $data['fonts'] )
		     || ! isset( $data['general'] )
		     || ! isset( $data['page'] )

		) {
			return $this->response( self::STATUS_FAILED );
		}

		$headers   = json_decode( $data['headers'] );
		$columns   = json_decode( $data['columns'] );
		$elements  = json_decode( $data['elements'] );
		$groups    = json_decode( $data['groups'] );
		$fonts     = json_decode( $data['fonts'] );
		$saveFonts = [];

		foreach ( $headers as $header ) {
			$saveFonts = $this->getItemFonts( $saveFonts, $fonts, $header );
			Model_Headers::instance()->createOrUpdate( $header );
		}

		foreach ( $columns as $column ) {
			$saveFonts = $this->getItemFonts( $saveFonts, $fonts, $column );
			Model_Columns::instance()->createOrUpdate( $column );
		}

		foreach ( $elements as $element ) {
			$saveFonts = $this->getItemFonts( $saveFonts, $fonts, $element );
			Model_Elements::instance()->createOrUpdate( $element );
		}

		$pack = [
			'headers' => [],
			'fonts'   => $saveFonts
		];

		foreach ( $groups as $headerUuid => $viewport ) {
			Model_GrpHeaderItems::instance()->deleteByHeaderUuid( $headerUuid );
			foreach ( $viewport->viewport as $viewportName => $headerProps ) {
				Model_GrpHeader::instance()->create( $headerUuid, $viewportName, $headerProps );

				foreach ( $headerProps->columns as $columnUuid => $columnProps ) {
					Model_GrpHeaderItems::instance()->create( $headerUuid, $columnUuid, $columnProps, $viewportName );
				}
			}

			$pack['headers'][] = $headerUuid;
		}

		$pageId      = (int) $data['page'];
		$generalSave = ( $data['general'] === 'true' ) ? true : false;

		if ( count( $pack ) ) {
			$id = Model_ActiveHeaders::instance()->createOrUpdate( $pack, $generalSave );

			$lastHeader = get_option( 'stax_item_' . $pageId );

			if ( $lastHeader ) {
				$this->delete( $lastHeader );
			}

			if ( ! $generalSave && is_numeric( $pageId ) ) {
				update_option( 'stax_item_' . $pageId, $id );
			} else {
				delete_option( 'stax_item_' . $pageId );
			}
		}

		return $this->response( self::STATUS_OK );
	}

	/**
	 * @param $pack
	 * @param $general
	 *
	 * @return int
	 */
	public function createOrUpdate( $pack, $general ) {
		if ( $general ) {
			$header = $this->db->get_row( "SELECT * FROM `" . $this->db->prefix . $this->table_active_headers . "` WHERE `general` = 1 AND `deleted_at` IS NULL" );

			$options = [
				'general' => 1,
				'pack'    => json_encode( $pack )
			];

			if ( $header ) {
				$options['id']         = $header->id;
				$options['updated_at'] = ( new \DateTime() )->format( 'Y-m-d H:i:s' );
			}

			$this->db->replace(
				$this->db->prefix . $this->table_active_headers,
				$options
			);
		} else {
			$this->db->insert(
				$this->db->prefix . $this->table_active_headers,
				[
					'general' => 0,
					'pack'    => json_encode( $pack )
				]
			);
		}

		return $this->db->insert_id;
	}

	/**
	 * @param $id
	 */
	public function delete( $id ) {
		$this->db->delete(
			$this->db->prefix . $this->table_active_headers,
			[
				'id' => $id
			]
		);
	}
}
