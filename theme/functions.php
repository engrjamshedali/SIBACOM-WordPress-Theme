<?php
/**
 * SIBACOM Theme Functions & Setup
 *
 * @package SIBACOM
 * @version 2.0.2
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

define('SIBACOM_THEME_VERSION', '2.0.2');
define('SIBACOM_THEME_DIR', get_template_directory());
define('SIBACOM_THEME_URI', get_template_directory_uri());

/**
 * Include theme includes
 */
require_once SIBACOM_THEME_DIR . '/inc/theme-setup.php';
require_once SIBACOM_THEME_DIR . '/inc/template-tags.php';
require_once SIBACOM_THEME_DIR . '/inc/elementor-compatibility.php';
require_once SIBACOM_THEME_DIR . '/inc/customizer.php';

