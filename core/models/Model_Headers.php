<?php
/**
 * Header models.
 *
 * @package Stax
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since 1.0
 */

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Model_Headers extends Base_Model {

	/**
	 * @var null
	 */
	public static $instance = null;

	/**
	 * @return null|Model_Headers
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
	 * @return array|null|object|void
	 */
	public function get( $uuid ) {
		$result = $this->db->get_row(
			$this->db->prepare(
				"SELECT * FROM `" . $this->db->prefix . $this->table_headers . "` WHERE `uuid` = %s",
				$uuid
			)
		);

		return $result;
	}

	/**
	 * @param $header
	 */
	public function createOrUpdate( $header ) {
		$header = $this->clearTrash( $header );

		$this->db->replace(
			$this->db->prefix . $this->table_headers,
			[
				'uuid'       => $header->uuid,
				'properties' => json_encode( $header )
			]
		);
	}
}
