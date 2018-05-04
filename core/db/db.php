<?php
/**
 * DB component.
 *
 * @package Stax
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since 1.0
 */

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class DB {

	/**
	 * @var string
	 */
	private $tb_headers;
	/**
	 * @var string
	 */
	private $tb_columns;
	/**
	 * @var string
	 */
	private $tb_elements;
	/**
	 * @var string
	 */
	private $tb_grp_header;
	/**
	 * @var string
	 */
	private $tb_grp_header_items;
	/**
	 * @var string
	 */
	private $tb_active_headers;
	/**
	 * @var string
	 */
	private $tb_templates;
	/**
	 * @var string
	 */
	private $tb_components;

	/**
	 * @var \wpdb
	 */
	private $db;

	/**
	 * DB constructor.
	 */
	public function __construct() {
		global $wpdb;

		$this->db = $wpdb;

		$this->tb_active_headers   = $this->db->prefix . 'stax_active_headers';
		$this->tb_headers          = $this->db->prefix . 'stax_headers';
		$this->tb_columns          = $this->db->prefix . 'stax_columns';
		$this->tb_elements         = $this->db->prefix . 'stax_elements';
		$this->tb_grp_header       = $this->db->prefix . 'stax_grp_header';
		$this->tb_grp_header_items = $this->db->prefix . 'stax_grp_header_items';
		$this->tb_templates        = $this->db->prefix . 'stax_templates';
		$this->tb_components       = $this->db->prefix . 'stax_components';
	}

	/**
	 *
	 */
	public function migrate() {
		if ( ! get_option( 'stax_migration' ) ) {
			add_option( 'stax-render-status', true );
			$charset_collate = $this->db->get_charset_collate();

			$sql[] = "CREATE TABLE IF NOT EXISTS `" . $this->tb_active_headers . "` (
                `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
                `general` tinyint(1) NOT NULL DEFAULT 0,
                `pack` MEDIUMBLOB,
                `deleted_at` datetime DEFAULT NULL,
                `created_at` timestamp NOT NULL,
                `updated_at` timestamp NOT NULL,
                PRIMARY KEY (`id`)
              ) $charset_collate;";

			$sql[] = "CREATE TABLE IF NOT EXISTS `" . $this->tb_headers . "` (
                `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
                `uuid` varchar(36) NOT NULL,
                `properties` MEDIUMBLOB,
                `deleted_at` datetime DEFAULT NULL,
                `created_at` timestamp NOT NULL,
                `updated_at` timestamp NOT NULL,
                PRIMARY KEY (`id`),
                UNIQUE (`uuid`)
              ) $charset_collate;";

			$sql[] = "CREATE TABLE IF NOT EXISTS `" . $this->tb_columns . "` (
                `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
                `uuid` varchar(36) NOT NULL,
                `properties` MEDIUMBLOB,
                `deleted_at` datetime DEFAULT NULL,
                `created_at` timestamp NOT NULL,
                `updated_at` timestamp NOT NULL,
                PRIMARY KEY (`id`),
                UNIQUE (`uuid`)
              ) $charset_collate;";

			$sql[] = "CREATE TABLE IF NOT EXISTS `" . $this->tb_elements . "` (
                `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
                `uuid` varchar(36) NOT NULL,
                `properties` MEDIUMBLOB,
                `deleted_at` datetime DEFAULT NULL,
                `created_at` timestamp NOT NULL,
                `updated_at` timestamp NOT NULL,
                PRIMARY KEY (`id`),
                UNIQUE (`uuid`)
              ) $charset_collate;";

			$sql[] = "CREATE TABLE IF NOT EXISTS `" . $this->tb_grp_header . "` (
                `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
                `header_uuid` varchar(36) NOT NULL,
                `viewport` varchar(10) NOT NULL,
                `visibility` tinyint(1) DEFAULT 1,
                `position` tinyint(1) DEFAULT 1,
                PRIMARY KEY (`id`),
                UNIQUE (`header_uuid`, `viewport`)
              ) $charset_collate;";

			$sql[] = "CREATE TABLE IF NOT EXISTS `" . $this->tb_grp_header_items . "` (
                `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
                `header_uuid` varchar(36) NOT NULL,
                `column_uuid` varchar(36) NOT NULL,
                `elements` MEDIUMBLOB,
                `viewport` varchar(10) NOT NULL,
                `visibility` tinyint(1) DEFAULT 1,
                `position` tinyint(1) DEFAULT 1,
                PRIMARY KEY (`id`),
                UNIQUE (`header_uuid`, `column_uuid`, `viewport`)
              ) $charset_collate;";

			$sql[] = "CREATE TABLE IF NOT EXISTS `" . $this->tb_templates . "` (
                `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
                `name` varchar(50) NOT NULL,
                `pack` MEDIUMBLOB,
                `deleted_at` datetime DEFAULT NULL,
                `created_at` timestamp NOT NULL,
                `updated_at` timestamp NOT NULL,
                PRIMARY KEY (`id`)
              ) $charset_collate;";

			$sql[] = "CREATE TABLE IF NOT EXISTS `" . $this->tb_components . "` (
                `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
                `name` varchar(50) NOT NULL,
                `properties` MEDIUMBLOB,
                `deleted_at` datetime DEFAULT NULL,
                `created_at` timestamp NOT NULL,
                `updated_at` timestamp NOT NULL,
                PRIMARY KEY (`id`)
              ) $charset_collate;";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

			foreach ( $sql as $query ) {
				dbDelta( $query );
			}

			update_option( 'stax_migration', '1' );
		}
	}

	/**
	 * @return \wpdb
	 */
	public function wpdb() {
		return $this->db;
	}

}
