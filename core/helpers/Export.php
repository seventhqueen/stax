<?php

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Export extends Base_Model {
	/**
	 * @var null
	 */
	public static $instance = null;

	/**
	 * @return null|Export
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * @param \WP_REST_Request $request
	 */
	public function execute( \WP_REST_Request $request ) {
		$data = $request->get_params();

		$template = Model_Templates::instance()->getById( $data['id'] );

		if ( $template ) {
			$pack = @json_decode( $template->pack );

			$templateItems           = new \stdClass();
			$templateItems->headers  = new \stdClass();
			$templateItems->columns  = new \stdClass();
			$templateItems->elements = new \stdClass();
			$templateItems->groups   = new \stdClass();
			$templateItems->fonts    = new \stdClass();
			$templateItems->general  = isset( $pack->general ) ? $pack->general : false;

			foreach ( $pack->headers as $header ) {
				$templateItems->headers->{$header->uuid} = $header;
			}

			foreach ( $pack->columns as $column ) {
				$templateItems->columns->{$column->uuid} = $column;
			}

			foreach ( $pack->elements as $element ) {
				$templateItems->elements->{$element->uuid} = $element;
			}

			foreach ( $pack->groups as $uuid => $group ) {
				$templateItems->groups->{$uuid} = $group;
			}

			$templateItems->fonts = $pack->fonts;

			$pack = [
				'headers'  => $templateItems->headers,
				'columns'  => $templateItems->columns,
				'elements' => $templateItems->elements,
				'groups'   => $templateItems->groups,
				'fonts'    => $templateItems->fonts,
				'general'  => $templateItems->general,
				'url_root' => site_url()
			];

			return $this->response( self::STATUS_OK, [ json_encode( $pack ) ] );
		}

		return $this->response( self::STATUS_FAILED );
	}

	public function cleanExport( \WP_REST_Request $request ) {
		$data = $request->get_params();

		if ( ! isset( $data['headers'] ) ||
		     ! isset( $data['columns'] ) ||
		     ! isset( $data['elements'] ) ||
		     ! isset( $data['groups'] ) ||
		     ! isset( $data['fonts'] ) ||
		     ! isset( $data['general'] ) ) {
			return $this->response( self::STATUS_FAILED );
		}

		$exportData           = new \stdClass();
		$exportData->headers  = new \stdClass();
		$exportData->columns  = new \stdClass();
		$exportData->elements = new \stdClass();
		$exportData->groups   = new \stdClass();
		$exportData->fonts    = new \stdClass();
		$exportData->general  = ( $data['general'] ) ? true : false;

		foreach ( @json_decode( $data['headers'] ) as $header ) {
			$exportData->headers->{$header->uuid} = $this->clearTrash( $header );
		}

		foreach ( @json_decode( $data['headers'] ) as $column ) {
			$exportData->columns->{$column->uuid} = $this->clearTrash( $column );
		}

		foreach ( @json_decode( $data['elements'] ) as $element ) {
			$exportData->elements->{$element->uuid} = $this->clearTrash( $element );
		}

		foreach ( @json_decode( $data['groups'] ) as $uuid => $group ) {
			$exportData->groups->{$uuid} = $group;
		}

		$exportData->fonts = @json_decode( $data['fonts'] );

		$pack = [
			'headers'  => $exportData->headers,
			'columns'  => $exportData->columns,
			'elements' => $exportData->elements,
			'groups'   => $exportData->groups,
			'fonts'    => $exportData->fonts,
			'general'  => $exportData->general,
			'url_root' => site_url()
		];

		return $this->response( self::STATUS_OK, [ json_encode( $pack ) ] );
	}

}
