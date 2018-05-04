<?php
/**
 * Model_GrpHeader Model.
 *
 * @package Stax
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since 1.0
 */

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Model_GrpHeader extends Base_Model {

	/**
	 * @var null
	 */
	public static $instance = null;

	/**
	 * @return null|Model_GrpHeader
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * @param $uuid
	 *
	 * @return array|null|object
	 */
	public function get( $uuid ) {
		$result = $this->db->get_results(
			$this->db->prepare(
				"SELECT * FROM `" . $this->db->prefix . $this->table_grp_header . "` WHERE `header_uuid` = %s",
				$uuid
			)
		);

		return $result;
	}

	/**
	 * @param $header_uuid
	 * @param $viewport
	 * @param $headerProps
	 */
	public function create( $header_uuid, $viewport, $headerProps ) {
		$this->db->replace(
			$this->db->prefix . $this->table_grp_header,
			[
				'header_uuid' => $header_uuid,
				'viewport'    => $viewport,
				'visibility'  => $headerProps->visibility,
				'position'    => $headerProps->position
			]
		);
	}

	/**
	 * @param $uuid
	 */
	public function delete( $uuid ) {
		$this->db->delete(
			$this->db->prefix . $this->table_grp_header,
			[
				'header_uuid' => $uuid
			]
		);
	}
}
