<?php
/**
 * Plugin Name: test-tooling
 * Description: This is a test
 * Version: 1.0.1
 * Author:      Steve Ariss
 * License:     GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: test-tooling-pi
 * Domain Path: /languages
 *
 * @package test-tooling
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Plugin version.
 */
define( 'TEST_TOOLING_VERSION', '1.0.0' );

/**
 * Plugin directory path.
 */
define( 'TEST_TOOLING_DIR', plugin_dir_path( __FILE__ ) );

/**
 * Plugin directory URL.
 */
define( 'TEST_TOOLING_URL', plugin_dir_url( __FILE__ ) );

/**
 * Initialize the plugin.
 */
function test_tooling_init() {
    // Load plugin text domain.
    load_plugin_textdomain( 'test-tooling', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

    // Hook into WordPress.
    add_action( 'wp_enqueue_scripts', 'test_tooling_enqueue_scripts' );

    // Add more initialization code here.
}
add_action( 'plugins_loaded', 'test_tooling_init' );

/**
 * Enqueue plugin scripts and styles.
 */
function test_tooling_enqueue_scripts() {
    // Enqueue your scripts and styles here.
    // Example:
    // wp_enqueue_style( 'test-tooling', TEST_TOOLING_URL . 'assets/css/style.css', array(), TEST_TOOLING_VERSION );
    // wp_enqueue_script( 'test-tooling', TEST_TOOLING_URL . 'assets/js/script.js', array( 'jquery' ), TEST_TOOLING_VERSION, true );
}

/**
 * Activation hook.
 */
function test_tooling_activate() {
    // Code to run on plugin activation.
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'test_tooling_activate' );

/**
 * Deactivation hook.
 */
function test_tooling_deactivate() {
    // Code to run on plugin deactivation.
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'test_tooling_deactivate' );
