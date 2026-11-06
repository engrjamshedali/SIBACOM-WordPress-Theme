<?php
/**
 * SIBACOM Admin Menu & Dashboard Pages
 *
 * @package SIBACOM_Website_Manager
 */

if (!defined('ABSPATH')) {
    exit;
}

class SIBACOM_Admin_Menu {

    public static function init() {
        add_action('admin_menu', array(__CLASS__, 'register_admin_menus'));
    }

    public static function register_admin_menus() {
        // Main SIBACOM Top-Level Menu
        add_menu_page(
            esc_html__('SIBACOM Website Manager', 'sibacom-manager'),
            esc_html__('SIBACOM', 'sibacom-manager'),
            'manage_options',
            'sibacom-dashboard',
            array(__CLASS__, 'render_dashboard_overview'),
            'dashicons-superhero',
            26
        );

        // 1. Dashboard
        add_submenu_page(
            'sibacom-dashboard',
            esc_html__('Dashboard Overview', 'sibacom-manager'),
            esc_html__('Dashboard', 'sibacom-manager'),
            'manage_options',
            'sibacom-dashboard',
            array(__CLASS__, 'render_dashboard_overview')
        );

        // 2. General Settings
        add_submenu_page(
            'sibacom-dashboard',
            esc_html__('General Website Settings', 'sibacom-manager'),
            esc_html__('General Settings', 'sibacom-manager'),
            'manage_options',
            'sibacom-settings',
            array(__CLASS__, 'render_settings_general')
        );

        // 3. Homepage Manager
        add_submenu_page(
            'sibacom-dashboard',
            esc_html__('Homepage Section Manager', 'sibacom-manager'),
            esc_html__('Homepage Manager', 'sibacom-manager'),
            'manage_options',
            'sibacom-homepage',
            array(__CLASS__, 'render_settings_homepage')
        );

        // 3b. Hero Banner Manager
        add_submenu_page(
            'sibacom-dashboard',
            esc_html__('Hero Banner Manager', 'sibacom-manager'),
            esc_html__('Hero Banner', 'sibacom-manager'),
            'manage_options',
            'sibacom-hero',
            array(__CLASS__, 'render_settings_hero')
        );

        // 4. Event Information
        add_submenu_page(
            'sibacom-dashboard',
            esc_html__('Event Information Cards', 'sibacom-manager'),
            esc_html__('Event Information', 'sibacom-manager'),
            'manage_options',
            'sibacom-event-info',
            array(__CLASS__, 'render_settings_event_info')
        );

        // 5. Event Pricing & Status
        add_submenu_page(
            'sibacom-dashboard',
            esc_html__('Event Competitions & Pricing', 'sibacom-manager'),
            esc_html__('Event Pricing & Status', 'sibacom-manager'),
            'manage_options',
            'edit.php?post_type=sibacom_event'
        );

        // 6. Highlights
        add_submenu_page(
            'sibacom-dashboard',
            esc_html__('Highlights Manager', 'sibacom-manager'),
            esc_html__('Highlights', 'sibacom-manager'),
            'manage_options',
            'sibacom-highlights',
            array(__CLASS__, 'render_settings_highlights')
        );

        // 6b. About Section
        add_submenu_page(
            'sibacom-dashboard',
            esc_html__('About Section Manager', 'sibacom-manager'),
            esc_html__('About Section', 'sibacom-manager'),
            'manage_options',
            'sibacom-about',
            array(__CLASS__, 'render_settings_about')
        );

        // 7. Schedule
        add_submenu_page(
            'sibacom-dashboard',
            esc_html__('Schedule Sessions', 'sibacom-manager'),
            esc_html__('Schedule', 'sibacom-manager'),
            'manage_options',
            'edit.php?post_type=sibacom_session'
        );

        // 8. Speakers & Judges
        add_submenu_page(
            'sibacom-dashboard',
            esc_html__('Speakers & Industry Jury', 'sibacom-manager'),
            esc_html__('Speakers & Judges', 'sibacom-manager'),
            'manage_options',
            'edit.php?post_type=sibacom_speaker'
        );

        // 8b. Add New Speaker / Judge
        add_submenu_page(
            'sibacom-dashboard',
            esc_html__('Add New Speaker or Judge', 'sibacom-manager'),
            esc_html__('+ Add Speaker/Judge', 'sibacom-manager'),
            'manage_options',
            'post-new.php?post_type=sibacom_speaker'
        );

        // 8c. Judges & Jury Filter
        add_submenu_page(
            'sibacom-dashboard',
            esc_html__('Competition Judges & Industry Jury', 'sibacom-manager'),
            esc_html__('Judges & Jury', 'sibacom-manager'),
            'manage_options',
            'edit.php?post_type=sibacom_speaker&speaker_role_filter=judge'
        );

        // 9. Guests & Dignitaries
        add_submenu_page(
            'sibacom-dashboard',
            esc_html__('Chief Guests & Special Dignitaries', 'sibacom-manager'),
            esc_html__('Guests & Dignitaries', 'sibacom-manager'),
            'manage_options',
            'edit.php?post_type=sibacom_speaker&speaker_role_filter=guest'
        );

        // 10. Organizers
        add_submenu_page(
            'sibacom-dashboard',
            esc_html__('Organizing Institutions & Committee', 'sibacom-manager'),
            esc_html__('Organizers', 'sibacom-manager'),
            'manage_options',
            'sibacom-organizers',
            array(__CLASS__, 'render_settings_organizers')
        );

        // 11. Sponsors
        add_submenu_page(
            'sibacom-dashboard',
            esc_html__('Sponsors & Partners', 'sibacom-manager'),
            esc_html__('Sponsors', 'sibacom-manager'),
            'manage_options',
            'edit.php?post_type=sibacom_sponsor'
        );

        // 12. FAQs
        add_submenu_page(
            'sibacom-dashboard',
            esc_html__('Frequently Asked Questions', 'sibacom-manager'),
            esc_html__('FAQs', 'sibacom-manager'),
            'manage_options',
            'edit.php?post_type=sibacom_faq'
        );

        // 13. Contact Details
        add_submenu_page(
            'sibacom-dashboard',
            esc_html__('Contact Information', 'sibacom-manager'),
            esc_html__('Contact Details', 'sibacom-manager'),
            'manage_options',
            'sibacom-contact',
            array(__CLASS__, 'render_settings_contact')
        );

        // 14. Social Media
        add_submenu_page(
            'sibacom-dashboard',
            esc_html__('Social Media Profiles', 'sibacom-manager'),
            esc_html__('Social Media', 'sibacom-manager'),
            'manage_options',
            'sibacom-social',
            array(__CLASS__, 'render_settings_social')
        );

        // 15. Footer Settings
        add_submenu_page(
            'sibacom-dashboard',
            esc_html__('Footer Manager', 'sibacom-manager'),
            esc_html__('Footer Settings', 'sibacom-manager'),
            'manage_options',
            'sibacom-footer',
            array(__CLASS__, 'render_settings_footer')
        );

        // 16. Elementor Components
        add_submenu_page(
            'sibacom-dashboard',
            esc_html__('Elementor Pro Components & Widgets', 'sibacom-manager'),
            esc_html__('Elementor Components', 'sibacom-manager'),
            'manage_options',
            'sibacom-elementor-components',
            array(__CLASS__, 'render_elementor_components')
        );

        // 17. Documentation
        add_submenu_page(
            'sibacom-dashboard',
            esc_html__('SIBACOM Documentation', 'sibacom-manager'),
            esc_html__('Documentation', 'sibacom-manager'),
            'manage_options',
            'sibacom-documentation',
            array(__CLASS__, 'render_documentation')
        );

        // Demo Import
        add_submenu_page(
            'sibacom-dashboard',
            esc_html__('One-Click Demo Import', 'sibacom-manager'),
            esc_html__('Demo Import', 'sibacom-manager'),
            'manage_options',
            'sibacom-demo-import',
            array(__CLASS__, 'render_demo_import')
        );

        // Also register under Appearance > Theme Dashboard
        add_theme_page(
            esc_html__('SIBACOM Theme Dashboard', 'sibacom-manager'),
            esc_html__('Theme Dashboard', 'sibacom-manager'),
            'manage_options',
            'sibacom-dashboard',
            array(__CLASS__, 'render_dashboard_overview')
        );
    }

    public static function render_dashboard_overview() {
        require_once SIBACOM_PLUGIN_DIR . 'admin/views/dashboard-overview.php';
    }

    public static function render_settings_general() {
        require_once SIBACOM_PLUGIN_DIR . 'admin/views/settings-general.php';
    }

    public static function render_settings_homepage() {
        require_once SIBACOM_PLUGIN_DIR . 'admin/views/settings-homepage.php';
    }

    public static function render_settings_hero() {
        require_once SIBACOM_PLUGIN_DIR . 'admin/views/settings-hero.php';
    }

    public static function render_settings_about() {
        require_once SIBACOM_PLUGIN_DIR . 'admin/views/settings-about.php';
    }

    public static function render_settings_event_info() {
        require_once SIBACOM_PLUGIN_DIR . 'admin/views/settings-event-info.php';
    }

    public static function render_settings_highlights() {
        require_once SIBACOM_PLUGIN_DIR . 'admin/views/settings-highlights.php';
    }

    public static function render_settings_organizers() {
        require_once SIBACOM_PLUGIN_DIR . 'admin/views/settings-organizers.php';
    }

    public static function render_settings_contact() {
        require_once SIBACOM_PLUGIN_DIR . 'admin/views/settings-contact.php';
    }

    public static function render_settings_social() {
        require_once SIBACOM_PLUGIN_DIR . 'admin/views/settings-social.php';
    }

    public static function render_settings_footer() {
        require_once SIBACOM_PLUGIN_DIR . 'admin/views/settings-footer.php';
    }

    public static function render_elementor_components() {
        require_once SIBACOM_PLUGIN_DIR . 'admin/views/elementor-components.php';
    }

    public static function render_documentation() {
        require_once SIBACOM_PLUGIN_DIR . 'admin/views/documentation.php';
    }

    public static function render_demo_import() {
        require_once SIBACOM_PLUGIN_DIR . 'admin/views/demo-import.php';
    }
}

SIBACOM_Admin_Menu::init();
