<?php

namespace Stax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Compatibility {
	/**
	 * @var null
	 */
	public static $instance = null;
	/**
	 * @var string
	 */
	public $theme;
	/**
	 * @var bool
	 */
	public $compatible = false;
	/**
	 * @var bool
	 */
	public $compatibility_registered = false;
	/**
	 * @var string
	 */
	public $tag = '';

	/**
	 * Compatibility constructor.
	 */
	public function __construct() {

		$this->theme = $this->get_current_theme();
	}

	/**
	 * Get active theme name
	 *
	 * @return string
	 */
	public function get_current_theme() {
		return strtolower( wp_get_theme( get_template() )->display( 'Name' ) );
	}

	/**
	 * @return null|Compatibility
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Get theme compatibility tag
	 *
	 * @return array
	 */
	public function get_tag() {
		if ( false === $this->compatibility_registered ) {
			$this->register();
		}

		$the_tag = apply_filters( 'stax_theme_tag', $this->tag );
		if ( $the_tag ) {
			return [
				'tag'     => $the_tag,
				'tagType' => 'selector',
			];
		}

		return [];
	}

	/**
	 *
	 */
	public function register() {
		$class_name = preg_replace( '/\s+/', '', ucfirst( $this->theme ) ) . 'Compat';
		$class_path = STAX_CORE_PATH . 'helpers/themes/' . $class_name . '.php';

		if ( file_exists( $class_path ) ) {
			include_once $class_path;
		} else {
			return;
		}

		if ( ! class_exists( '\Stax\\' . $class_name ) ) {
			return;
		}

		$class_name = '\Stax\\' . $class_name;

		/**
		 * Theme compat
		 *
		 * @return \Stax\CompatibleTheme
		 */
		$compatibility = new $class_name();

		$this->tag = $compatibility->get_tag();
		if ( !is_admin() && $compatibility->is_front_compatible() && RenderStatus::instance()->getStatus() ) {
			$this->compatible = true;

			// Todo: fix compatibility
			/* If we are in front area and not editing */
			/*if ( Plugin::instance()->is_front() && Plugin::instance()->get_header_data()->html ) {
				$compatibility->front_actions();
			}*/
		}

		$this->compatibility_registered = true;
	}

	/**
	 * Check if current theme has compatibility added.
	 *
	 * @return bool
	 */
	public function is_front_theme_compatible() {
		if ( true === apply_filters( 'stax_is_theme_compatible', $this->compatible ) ) {
			return true;
		}

		return false;
	}
}
