<?php

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Export {
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

		$header = Model_ActiveHeaders::instance()->getById( $data['id'] );

		if ( $header ) {
			$pack        = @json_decode( $header->pack );
			$headersPack = $pack->headers;

			$headers  = new \stdClass();
			$columns  = new \stdClass();
			$elements = new \stdClass();
			$groups   = new \stdClass();

			foreach ( $headersPack as $uuid ) {
				$item = Model_Headers::instance()->get( $uuid );
				if ( $item ) {
					$headers->$uuid = json_decode( $item->properties );
				}
			}

			foreach ( $headers as $headerUuid => $header ) {
				$heads = Model_GrpHeader::instance()->get( $headerUuid );

				$groups->{$headerUuid} = (object) [
					'viewport' => (object) []
				];

				foreach ( $heads as $headItem ) {
					$groups->{$headItem->header_uuid}->viewport->{$headItem->viewport} = (object) [
						'columns'    => (object) [],
						'position'   => $headItem->position,
						'visibility' => intval( $headItem->visibility )
					];

					$cols = Model_GrpHeaderItems::instance()->getByHeaderUuid( $headItem->header_uuid, $headItem->viewport );

					foreach ( $cols as $colItem ) {
						$storedColumn = Model_Columns::instance()->get( $colItem->column_uuid );

						if ( $storedColumn ) {
							$groups->{$headItem->header_uuid}->viewport->{$headItem->viewport}->columns->{$colItem->column_uuid} = (object) [
								'elements'   => (object) [],
								'position'   => $colItem->position,
								'visibility' => intval( $colItem->visibility )
							];

							$columns->{$colItem->column_uuid} = json_decode( $storedColumn->properties );

							$storedElements = json_decode( $colItem->elements );
							foreach ( $storedElements as $elementUuid => $elItem ) {
								$storedElement = Model_Elements::instance()->get( $elementUuid );
								if ( $storedElement ) {
									$groups->{$headItem->header_uuid}->viewport->{$headItem->viewport}->columns->{$colItem->column_uuid}->elements->{$elementUuid} = $elItem;

									$elements->{$elementUuid} = json_decode( $storedElement->properties );
								}
							}
						}
					}
				}
			}

			$pack = [
				'headers'  => $headers,
				'columns'  => $columns,
				'elements' => $elements,
				'groups'   => $groups,
				'fonts'    => $pack->fonts,
				'url_root' => site_url()
			];

			$generated_at = date( 'd-m-Y' );

			header( "Content-Type: application/json; charset=utf-8" );
			header( "Content-disposition: attachment; filename=export_header_" . $data['id'] . '_' . $generated_at . ".json" );
			header( "Expires: 0" );

			echo json_encode( $pack );
			exit;
		}
	}

}
