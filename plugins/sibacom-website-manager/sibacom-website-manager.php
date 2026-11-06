<?php

/**

 * Plugin Name: SIBACOM Website Manager

 * Plugin URI: https://iba-suk.edu.pk/sibacom

 * Description: Dedicated companion plugin for SIBACOM – Sukkur IBA University. Manages website content, event schedules, speakers, joint organizing committee (CSE Society & EE Society), academic partners, sponsors, and FAQs with seamless Elementor Pro integration.

 * Version: 2.0.2

 * Author: Sukkur IBA University, CSE Society & EE Society

 * Author URI: https://iba-suk.edu.pk

 * Text Domain: sibacom-manager

 * Domain Path: /languages

 * License: GPLv2 or later

 */



if (!defined('ABSPATH')) {

    exit;

}



define('SIBACOM_PLUGIN_VERSION', '2.0.2');

define('SIBACOM_PLUGIN_DIR', plugin_dir_path(__FILE__));

define('SIBACOM_PLUGIN_URL', plugin_dir_url(__FILE__));



/**

 * Main Plugin Class

 */

final class SIBACOM_Website_Manager {



    private static $instance = null;



    public static function instance() {

        if (is_null(self::$instance)) {

            self::$instance = new self();

        }

        return self::$instance;

    }



    private function __construct() {

        $this->load_dependencies();

        $this->init_hooks();

    }



    private function load_dependencies() {

        require_once SIBACOM_PLUGIN_DIR . 'includes/class-sibacom-cpt.php';

        require_once SIBACOM_PLUGIN_DIR . 'includes/class-sibacom-meta-boxes.php';

        require_once SIBACOM_PLUGIN_DIR . 'includes/class-sibacom-settings.php';

        require_once SIBACOM_PLUGIN_DIR . 'includes/class-sibacom-shortcodes.php';

        require_once SIBACOM_PLUGIN_DIR . 'includes/class-sibacom-demo-importer.php';

        require_once SIBACOM_PLUGIN_DIR . 'admin/admin-menu.php';



        // Elementor integration

        add_action('plugins_loaded', array($this, 'init_elementor_integration'));

    }



    private function init_hooks() {

        add_action('init', array($this, 'load_textdomain'));

        add_action('admin_init', array($this, 'sync_primary_navigation_menu'));

        add_action('wp_enqueue_scripts', array($this, 'enqueue_frontend_assets'));

        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));

        register_activation_hook(__FILE__, array($this, 'on_activation'));

    }



    /**

     * Ensure the Primary Navigation Menu has Sponsors removed and Events added.

     */

    public function sync_primary_navigation_menu() {

        if (!current_user_can('manage_options')) {

            return;

        }



        $locations = get_theme_mod('nav_menu_locations');

        $menu_id = (isset($locations['primary-menu']) && $locations['primary-menu']) ? (int)$locations['primary-menu'] : 0;

        if (!$menu_id) {

            $menu_obj = wp_get_nav_menu_object('SIBACOM Primary Navigation');

            if ($menu_obj) {

                $menu_id = $menu_obj->term_id;

            }

        }



        if (!$menu_id) {

            return;

        }



        $items = wp_get_nav_menu_items($menu_id);

        if (!$items || !is_array($items)) {

            return;

        }



        $has_events = false;

        $about_order = 2;



        foreach ($items as $item) {

            $title = strtolower(trim($item->title));

            $url = strtolower(trim($item->url));



            if ($title === 'sponsors' || strpos($title, 'sponsor') !== false || strpos($url, '/sponsors') !== false || strpos($url, 'sponsors.html') !== false) {

                wp_delete_post($item->ID, true);

            }



            if ($title === 'events' || strpos($title, 'event') !== false || strpos($url, '/events') !== false || strpos($url, 'events.html') !== false) {

                $has_events = true;

            }



            if ($title === 'about' || strpos($title, 'about') !== false || strpos($url, '/about') !== false) {

                $about_order = (int)$item->menu_order;

            }

        }



        if (!$has_events) {

            $events_page = get_page_by_path('events');

            $events_page_id = $events_page ? $events_page->ID : 0;



            wp_update_nav_menu_item($menu_id, 0, array(

                'menu-item-title'     => esc_html__('Events', 'sibacom-manager'),

                'menu-item-object'    => $events_page_id ? 'page' : 'custom',

                'menu-item-object-id' => $events_page_id,

                'menu-item-type'      => $events_page_id ? 'post_type' : 'custom',

                'menu-item-url'       => $events_page_id ? '' : home_url('/events/'),

                'menu-item-status'    => 'publish',

                'menu-item-position'  => $about_order + 1,

            ));

        }

    }



    public function load_textdomain() {

        load_plugin_textdomain('sibacom-manager', false, dirname(plugin_basename(__FILE__)) . '/languages');

    }



    public function enqueue_frontend_assets() {

        wp_enqueue_style('sibacom-plugin-frontend', SIBACOM_PLUGIN_URL . 'assets/css/frontend.css', array(), SIBACOM_PLUGIN_VERSION);

        wp_enqueue_script('sibacom-plugin-frontend', SIBACOM_PLUGIN_URL . 'assets/js/frontend.js', array('jquery'), SIBACOM_PLUGIN_VERSION, true);

    }



    public function enqueue_admin_assets($hook) {

        // Enqueue on all SIBACOM admin pages and CPT pages

        if (strpos($hook, 'sibacom') !== false || in_array(get_post_type(), array('sibacom_session', 'sibacom_speaker', 'sibacom_sponsor', 'sibacom_faq'))) {

            wp_enqueue_media();

            wp_enqueue_style('sibacom-admin-css', SIBACOM_PLUGIN_URL . 'assets/css/admin.css', array(), SIBACOM_PLUGIN_VERSION);

            wp_enqueue_script('sibacom-admin-js', SIBACOM_PLUGIN_URL . 'assets/js/admin.js', array('jquery'), SIBACOM_PLUGIN_VERSION, true);



            wp_localize_script('sibacom-admin-js', 'sibacomAdminData', array(

                'ajaxUrl' => admin_url('admin-ajax.php'),

                'nonce'   => wp_create_nonce('sibacom_admin_nonce'),

            ));

        }

    }



    public function init_elementor_integration() {

        if (did_action('elementor/loaded')) {

            require_once SIBACOM_PLUGIN_DIR . 'elementor/class-sibacom-elementor-init.php';

        } else {

            add_action('elementor/init', array($this, 'load_elementor_init_fallback'));

        }

    }



    public function load_elementor_init_fallback() {

        if (!class_exists('SIBACOM_Elementor_Init')) {

            require_once SIBACOM_PLUGIN_DIR . 'elementor/class-sibacom-elementor-init.php';

        }

    }



    public function on_activation() {

        // Set default options if not yet existing

        SIBACOM_Settings::set_defaults();

        flush_rewrite_rules();

    }

}



/**

 * Initialize Plugin

 */

function sibacom_website_manager() {

    return SIBACOM_Website_Manager::instance();

}

sibacom_website_manager();



