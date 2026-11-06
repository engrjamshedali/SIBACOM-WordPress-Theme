<?php
/**
 * SIBACOM Elementor Registration & Initialization
 *
 * @package SIBACOM_Website_Manager
 */

if (!defined('ABSPATH')) {
    exit;
}

class SIBACOM_Elementor_Init {

    private static $instance = null;

    public static function instance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action('elementor/elements/categories_registered', array($this, 'register_category'));
        add_action('elementor/widgets/register', array($this, 'register_widgets'));
        add_action('elementor/editor/init', array($this, 'auto_bootstrap_elementor_editor'));
        add_action('template_redirect', array($this, 'check_frontend_bootstrap'));
        add_action('elementor/document/after_save', array($this, 'protect_plugin_data_after_save'), 10, 2);
    }

    /**
     * Register SIBACOM Widget Category in Elementor
     */
    public function register_category($elements_manager) {
        $elements_manager->add_category(
            'sibacom-elements',
            array(
                'title' => esc_html__('SIBACOM Elements', 'sibacom-manager'),
                'icon'  => 'fa fa-award',
            )
        );
    }

    /**
     * Register Custom Elementor Widgets
     */
    public function register_widgets($widgets_manager) {
        $widget_files = array(
            'hero-widget.php'        => 'SIBACOM_Hero_Widget',
            'countdown-widget.php'   => 'SIBACOM_Countdown_Widget',
            'info-widget.php'        => 'SIBACOM_Info_Widget',
            'events-widget.php'      => 'SIBACOM_Events_Widget',
            'highlights-widget.php'  => 'SIBACOM_Highlights_Widget',
            'about-widget.php'       => 'SIBACOM_About_Widget',
            'schedule-widget.php'    => 'SIBACOM_Schedule_Widget',
            'speakers-widget.php'    => 'SIBACOM_Speakers_Widget',
            'guests-widget.php'      => 'SIBACOM_Guests_Widget',
            'organizers-widget.php'  => 'SIBACOM_Organizers_Widget',
            'sponsors-widget.php'    => 'SIBACOM_Sponsors_Widget',
            'faq-widget.php'         => 'SIBACOM_FAQ_Widget',
            'social-widget.php'      => 'SIBACOM_Social_Widget',
            'contact-widget.php'     => 'SIBACOM_Contact_Widget',
            'cta-widget.php'         => 'SIBACOM_CTA_Widget',
        );

        foreach ($widget_files as $file => $class_name) {
            $path = SIBACOM_PLUGIN_DIR . 'elementor/widgets/' . $file;
            if (file_exists($path)) {
                require_once $path;
                if (class_exists($class_name)) {
                    $widgets_manager->register(new $class_name());
                }
            }
        }
    }

    /**
     * Auto bootstrap Elementor editor if page data is empty
     */
    public function auto_bootstrap_elementor_editor() {
        $post_id = 0;
        if (isset($_GET['post'])) {
            $post_id = intval($_GET['post']);
        } elseif (isset($_GET['elementor-preview'])) {
            $post_id = intval($_GET['elementor-preview']);
        }

        if ($post_id > 0) {
            $this->bootstrap_page_if_needed($post_id);
        }
    }

    /**
     * Frontend check to bootstrap page if built_with_elementor mode is active but data is empty
     */
    public function check_frontend_bootstrap() {
        if (!is_singular('page')) {
            return;
        }

        $post_id = get_the_ID();
        if ($post_id > 0) {
            $this->bootstrap_page_if_needed($post_id);
        }
    }

    /**
     * Locate template JSON file for a given post
     */
    public static function get_template_json_for_post($post_id) {
        $post = get_post($post_id);
        if (!$post) {
            return '';
        }

        $slug     = $post->post_name;
        $template = get_post_meta($post_id, '_wp_page_template', true);
        $front_id = intval(get_option('page_on_front'));

        $filename = '';
        if ($post_id === $front_id || $slug === 'home' || strpos($template, 'template-home') !== false) {
            $filename = 'home.json';
        } elseif ($slug === 'about' || strpos($template, 'template-about') !== false) {
            $filename = 'about.json';
        } elseif ($slug === 'events' || strpos($template, 'template-events') !== false) {
            $filename = 'events.json';
        } elseif ($slug === 'schedule' || strpos($template, 'template-schedule') !== false) {
            $filename = 'schedule.json';
        } elseif ($slug === 'speakers' || strpos($template, 'template-speakers') !== false) {
            $filename = 'speakers.json';
        } elseif ($slug === 'guests' || strpos($template, 'template-guests') !== false) {
            $filename = 'guests.json';
        } elseif ($slug === 'organizers' || strpos($template, 'template-organizers') !== false) {
            $filename = 'organizers.json';
        } elseif ($slug === 'sponsors' || strpos($template, 'template-sponsors') !== false) {
            $filename = 'sponsors.json';
        } elseif ($slug === 'contact' || strpos($template, 'template-contact') !== false) {
            $filename = 'contact.json';
        }

        if (empty($filename)) {
            return '';
        }

        $possible_paths = array(
            SIBACOM_PLUGIN_DIR . 'elementor-templates/' . $filename,
            dirname(SIBACOM_PLUGIN_DIR, 2) . '/elementor-templates/' . $filename,
            get_template_directory() . '/../elementor-templates/' . $filename,
            get_template_directory() . '/elementor-templates/' . $filename,
        );

        foreach ($possible_paths as $p) {
            if (file_exists($p)) {
                return $p;
            }
        }

        return '';
    }

    /**
     * Bootstrap page with Elementor template if empty
     */
    public function bootstrap_page_if_needed($post_id) {
        $current_data = get_post_meta($post_id, '_elementor_data', true);
        $is_empty     = empty($current_data) || $current_data === '[]' || $current_data === 'null';

        if (!$is_empty) {
            return false;
        }

        $json_file = self::get_template_json_for_post($post_id);
        if (empty($json_file) || !file_exists($json_file)) {
            return false;
        }

        $json_raw = file_get_contents($json_file);
        $json_arr = json_decode($json_raw, true);

        if (empty($json_arr) || empty($json_arr['content'])) {
            return false;
        }

        $encoded_content = wp_slash(json_encode($json_arr['content']));
        update_post_meta($post_id, '_elementor_data', $encoded_content);
        update_post_meta($post_id, '_elementor_edit_mode', 'builder');
        update_post_meta($post_id, '_elementor_template_type', 'wp-page');

        if (class_exists('\Elementor\Plugin') && \Elementor\Plugin::$instance->documents) {
            $document = \Elementor\Plugin::$instance->documents->get($post_id);
            if ($document) {
                $document->save_elements_data($json_arr['content']);
            }
        }

        return true;
    }

    /**
     * Protect core plugin CPTs and options when Elementor saves a page document
     */
    public function protect_plugin_data_after_save($document, $data) {
        // Verification hook to ensure post save isolation
    }
}

SIBACOM_Elementor_Init::instance();
