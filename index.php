<?php

/**
 * Plugin Name: STAX Header Builder
 * Description: Header builder for WordPress. The most advanced front-end drag & drop tool. Create pixel perfect headers with ease. Works with any theme.
 * Plugin URI: https://staxbuilder.com/stax/?utm_source=wp-plugins&utm_campaign=plugin-uri&utm_medium=wp-dash
 * Author: SeventhQueen
 * Version: 1.0.8
 * Author URI: https://seventhqueen.com/?utm_source=wp-plugins&utm_campaign=author-uri&utm_medium=wp-dash
 *
 * Text Domain: stax
 *
 * @package Stax
 * @category Core
 *
 * @fs_premium_only /assets/framework/
 * @fs_free_only /assets/framework-base/
 *
 * Stax is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * Stax is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 */

if ( !defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly.
}


if ( !function_exists( 'stax_fs' ) ) {
    define( 'STAX_VERSION', '1.0.8' );
    define( 'STAX_FILE', __FILE__ );
    define( 'STAX_PLUGIN_BASE', plugin_basename( STAX_FILE ) );
    define( 'STAX_BASE_URL', plugins_url( '/', STAX_FILE ) );
    define( 'STAX_BASE_PATH', plugin_dir_path( STAX_FILE ) );
    define( 'STAX_CORE_PATH', STAX_BASE_PATH . 'core/' );
    define( 'STAX_FRONT_PATH', STAX_BASE_PATH . 'front/' );
    define( 'STAX_FRONT_URL', STAX_BASE_URL . 'front/' );
    define( 'STAX_ASSETS_URL', STAX_BASE_URL . 'assets/' );
    define( 'STAX_API_NAMESPACE', 'stax' );
    /**
     * Create a helper function for easy SDK access.
     *
     * @return Freemius
     */
    function stax_fs()
    {
        global  $stax_fs ;
        
        if ( !isset( $stax_fs ) ) {
            // Include Freemius SDK.
            require_once STAX_CORE_PATH . 'lib/freemius/start.php';
            $stax_fs = fs_dynamic_init( array(
                'id'             => '1977',
                'slug'           => 'stax',
                'type'           => 'plugin',
                'public_key'     => 'pk_ae5f43d871441d1c2411eedbe5d76',
                'is_premium'     => false,
                'has_addons'     => false,
                'has_paid_plans' => true,
                'menu'           => array(
                'slug'    => 'stax',
                'contact' => false,
                'support' => false,
            ),
                'is_live'        => true,
            ) );
        }
        
        return $stax_fs;
    }
    
    // Init Freemius.
    stax_fs();
    // Signal that SDK was initiated.
    do_action( 'stax_fs_loaded' );
    $fw_url = STAX_BASE_URL . 'assets/framework-base/';
    if ( defined( 'STAX_DEV' ) && STAX_DEV ) {
        $fw_url = STAX_BASE_URL . 'assets/framework/';
    }
    define( 'STAX_ASSETS_FW_URL', $fw_url );
    require_once STAX_CORE_PATH . 'plugin.php';
}
