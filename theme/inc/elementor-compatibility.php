<?php
/**
 * Elementor Compatibility & Theme Builder Integration
 *
 * @package SIBACOM
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Declare Elementor support
 */
function sibacom_elementor_support() {
    add_theme_support('elementor');
}
add_action('after_setup_theme', 'sibacom_elementor_support');

/**
 * Register Elementor Theme Builder Locations (Elementor Pro)
 */
function sibacom_register_elementor_locations($elementor_theme_manager) {
    $elementor_theme_manager->register_location('header');
    $elementor_theme_manager->register_location('footer');
    $elementor_theme_manager->register_location('single');
    $elementor_theme_manager->register_location('archive');
}
add_action('elementor/theme/register_locations', 'sibacom_register_elementor_locations');

/**
 * Check if Elementor is active
 */
function sibacom_is_elementor_active() {
    return did_action('elementor/loaded');
}

/**
 * Check if current page is built with Elementor or currently in Elementor editor
 */
function sibacom_is_built_with_elementor($post_id = null) {
    if (!sibacom_is_elementor_active()) {
        return false;
    }

    if (!$post_id) {
        $post_id = get_the_ID();
    }

    // Check if in Elementor Editor mode or Preview mode
    if (class_exists('\Elementor\Plugin')) {
        $elementor = \Elementor\Plugin::$instance;
        if (isset($elementor->editor) && $elementor->editor->is_edit_mode()) {
            return true;
        }
        if (isset($elementor->preview) && $elementor->preview->is_preview_mode()) {
            return true;
        }
    }

    // Check URL parameters for Elementor action
    if (isset($_GET['action']) && $_GET['action'] === 'elementor') {
        return true;
    }
    if (isset($_GET['elementor-preview'])) {
        return true;
    }

    if (!$post_id) {
        return false;
    }

    $document = \Elementor\Plugin::$instance->documents->get($post_id);
    if (!$document) {
        return false;
    }

    // Document must be built with Elementor AND contain valid element data
    if ($document->is_built_with_elementor()) {
        $data = $document->get_elements_data();
        if (!empty($data) && is_array($data) && count($data) > 0) {
            return true;
        }
    }

    return false;
}


