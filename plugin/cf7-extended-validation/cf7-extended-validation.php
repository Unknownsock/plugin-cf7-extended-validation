<?php
/**
 * Plugin Name: CF7 Extended Validation
 * Plugin URI: https://github.com/Unknownsock/plugin-cf7-extended-validation
 * Description: Extends Contact Form 7 validation with enhanced submit button handling, loading states, and improved user feedback.
 * Version: 1.0.0
 * Author: Unknownsock
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: cf7-extended-validation
 * Requires at least: 5.0
 * Requires PHP: 7.4
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Current plugin version.
 */
define('CF7_EXTENDED_VALIDATION_VERSION', '1.0.0');

/**
 * Plugin directory path
 */
define('CF7_EXTENDED_VALIDATION_PATH', plugin_dir_path(__FILE__));

/**
 * Plugin directory URL
 */
define('CF7_EXTENDED_VALIDATION_URL', plugin_dir_url(__FILE__));

/**
 * Load plugin translations
 */
function cf7_extended_validation_load_textdomain() {
    load_plugin_textdomain('cf7-extended-validation', false, dirname(plugin_basename(__FILE__)) . '/languages');
}
add_action('plugins_loaded', 'cf7_extended_validation_load_textdomain');

/**
 * Check if Contact Form 7 is active
 */
function cf7_extended_validation_check_cf7() {
    if (!function_exists('wpcf7')) {
        add_action('admin_notices', 'cf7_extended_validation_cf7_missing_notice');
        return false;
    }
    return true;
}

/**
 * Display admin notice if CF7 is not installed
 */
function cf7_extended_validation_cf7_missing_notice() {
    ?>
    <div class="notice notice-error">
        <p>
            <?php esc_html_e('CF7 Extended Validation requires Contact Form 7 to be installed and activated.', 'cf7-extended-validation'); ?>
        </p>
    </div>
    <?php
}

/**
 * Enqueue plugin scripts and styles
 */
function cf7_extended_validation_enqueue_scripts() {
    // Only enqueue if CF7 is active
    if (!cf7_extended_validation_check_cf7()) {
        return;
    }

    // Enqueue the compiled JavaScript
    wp_enqueue_script(
        'cf7-extended-validation',
        CF7_EXTENDED_VALIDATION_URL . 'dist/cf7-extended-validation.min.js',
        array(),
        CF7_EXTENDED_VALIDATION_VERSION,
        true
    );

    // Enqueue the compiled CSS
    wp_enqueue_style(
        'cf7-extended-validation',
        CF7_EXTENDED_VALIDATION_URL . 'dist/cf7-extended-validation.min.css',
        array(),
        CF7_EXTENDED_VALIDATION_VERSION
    );
}
add_action('wp_enqueue_scripts', 'cf7_extended_validation_enqueue_scripts');

/**
 * Add settings link to plugin page
 */
function cf7_extended_validation_plugin_action_links($links) {
    $settings_link = '<a href="' . admin_url('admin.php?page=wpcf7') . '">' . __('CF7 Settings', 'cf7-extended-validation') . '</a>';
    array_unshift($links, $settings_link);
    return $links;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'cf7_extended_validation_plugin_action_links');

/**
 * Activation hook
 */
function cf7_extended_validation_activate() {
    // Check if CF7 is installed
    if (!function_exists('wpcf7')) {
        deactivate_plugins(plugin_basename(__FILE__));
        wp_die(
            __('This plugin requires Contact Form 7 to be installed and activated.', 'cf7-extended-validation'),
            'Plugin dependency check',
            array('back_link' => true)
        );
    }
}
register_activation_hook(__FILE__, 'cf7_extended_validation_activate');
