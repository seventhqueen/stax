<?php
/**
 * ContainerViewport Model.
 *
 * @package Stax
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since 1.0
 */

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Model_ContainerViewport extends Base_Model {

	/**
	 * @var null
	 */
	public static $instance = null;

	/**
	 * @return null|Model_ContainerViewport
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
				"SELECT * FROM `" . $this->db->prefix . $this->table_container_viewport . "` WHERE `container_uuid` = %s",
				$uuid
			)
		);

		return $result;
	}

	/**
	 * @param $container_uuid
	 * @param $viewport
	 * @param $props
	 */
	public function create( $container_uuid, $viewport, $props ) {
		$this->db->replace(
			$this->db->prefix . $this->table_container_viewport,
			[
				'container_uuid' => $container_uuid,
				'viewport'       => $viewport,
				'visibility'     => $props->visibility,
				'position'       => $props->position
			]
		);
	}

	/**
	 * @param $uuid
	 */
	public function delete( $uuid ) {
		$this->db->delete(
			$this->db->prefix . $this->table_container_viewport,
			[
				'container_uuid' => $uuid
			]
		);
	}
}
