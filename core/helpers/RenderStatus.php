<?php

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class RenderStatus {
	/**
	 * @var null
	 */
	public static $instance = null;

	/**
	 * @return null|RenderStatus
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * @return bool
	 */
	public function getStatus() {
		return boolval( get_option( 'stax-render-status' ) );
	}

	/**
	 * @return bool
	 */
	public function toggleStatus() {
		if ( $this->getStatus() ) {
			delete_option( 'stax-render-status' );
		} else {
			add_option( 'stax-render-status', true );
		}

		return $this->getStatus();
	}
}
