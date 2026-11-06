<?php
/**
 * SIBACOM Info & Meta Bar Elementor Widget
 *
 * Fully editable Neumorphic Event Information Cards with support for
 * both individual card controls, dynamic repeater, and WordPress sync.
 *
 * @package SIBACOM_Website_Manager
 */

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

class SIBACOM_Info_Widget extends Widget_Base {

    public function get_name() {
        return 'sibacom_info';
    }

    public function get_title() {
        return esc_html__('SIBACOM Event Information Cards', 'sibacom-manager');
    }

    public function get_icon() {
        return 'eicon-info-box';
    }

    public function get_categories() {
        return array('sibacom-elements');
    }

    public function get_keywords() {
        return array('info', 'event', 'date', 'venue', 'deadline', 'sibacom', 'cards', 'stats', 'meta');
    }

    protected function register_controls() {
        // ==========================================
        // CONTENT TAB: 1. Layout & Data Source
        // ==========================================
        $this->start_controls_section(
            'section_layout',
            array(
                'label' => esc_html__('Layout & Data Source', 'sibacom-manager'),
            )
        );

        $this->add_control(
            'display_mode',
            array(
                'label'   => esc_html__('Editing / Data Mode', 'sibacom-manager'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'cards',
                'options' => array(
                    'cards'    => esc_html__('Standard 6 Cards (Fully Editable)', 'sibacom-manager'),
                    'repeater' => esc_html__('Custom Repeater (Add / Remove / Reorder)', 'sibacom-manager'),
                    'settings' => esc_html__('Sync with SIBACOM Admin Settings', 'sibacom-manager'),
                ),
                'description' => esc_html__('Choose whether to edit all 6 standard cards individually, use a flexible repeater, or sync live with global WordPress settings.', 'sibacom-manager'),
            )
        );

        $this->add_responsive_control(
            'columns',
            array(
                'label'   => esc_html__('Grid Columns', 'sibacom-manager'),
                'type'    => Controls_Manager::SELECT,
                'default' => '3',
                'tablet_default' => '2',
                'mobile_default' => '1',
                'options' => array(
                    '1' => esc_html__('1 Column', 'sibacom-manager'),
                    '2' => esc_html__('2 Columns', 'sibacom-manager'),
                    '3' => esc_html__('3 Columns (Standard)', 'sibacom-manager'),
                    '4' => esc_html__('4 Columns', 'sibacom-manager'),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-info-cards-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr) !important;',
                ),
            )
        );

        $this->add_responsive_control(
            'grid_gap',
            array(
                'label'      => esc_html__('Cards Gap', 'sibacom-manager'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'rem'),
                'range'      => array('px' => array('min' => 8, 'max' => 60)),
                'default'    => array('unit' => 'px', 'size' => 28),
                'selectors'  => array(
                    '{{WRAPPER}} .sibacom-info-cards-grid' => 'gap: {{SIZE}}{{UNIT}} !important;',
                ),
            )
        );

        $this->add_control(
            'enable_hover_lift',
            array(
                'label'        => esc_html__('Card Hover Lift Animation', 'sibacom-manager'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'sibacom-manager'),
                'label_off'    => esc_html__('No', 'sibacom-manager'),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->end_controls_section();

        // ==========================================
        // CONTENT TAB: Card 1 (Event Dates)
        // ==========================================
        $this->start_controls_section(
            'section_card1',
            array(
                'label'     => esc_html__('1. Event Dates Card', 'sibacom-manager'),
                'condition' => array('display_mode' => 'cards'),
            )
        );
        $this->add_control('card1_title', array('label' => esc_html__('Label / Category', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'Event Dates'));
        $this->add_control('card1_val', array('label' => esc_html__('Main Value / Dates', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'Nov 30 – Dec 02, 2026'));
        $this->add_control('card1_sub', array('label' => esc_html__('Subtitle / Tagline', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => '1-Day National Summit'));
        $this->add_control('card1_show_pill', array('label' => esc_html__('Show Pill Badge', 'sibacom-manager'), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes'));
        $this->add_control('card1_pill', array('label' => esc_html__('Pill Badge Text', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'Official Dates', 'condition' => array('card1_show_pill' => 'yes')));
        $this->add_control('card1_pill_icon', array('label' => esc_html__('Pill Icon Class', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'fa-regular fa-calendar-check', 'condition' => array('card1_show_pill' => 'yes')));
        $this->add_control('card1_pill_style', array(
            'label'   => esc_html__('Pill Color Preset', 'sibacom-manager'),
            'type'    => Controls_Manager::SELECT,
            'default' => 'pill-blue',
            'options' => array(
                'pill-blue'  => esc_html__('Blue (Official)', 'sibacom-manager'),
                'pill-green' => esc_html__('Green (Main Campus)', 'sibacom-manager'),
                'pill-amber' => esc_html__('Amber (Strict Cutoff)', 'sibacom-manager'),
                'pill-navy'  => esc_html__('Navy (14+ Tracks)', 'sibacom-manager'),
                'pill-cyan'  => esc_html__('Cyan (Nationwide)', 'sibacom-manager'),
                'pill-live'  => esc_html__('Emerald (Live Now)', 'sibacom-manager'),
            ),
            'condition' => array('card1_show_pill' => 'yes'),
        ));
        $this->add_control('card1_icon', array('label' => esc_html__('Main Icon Class', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'fa-regular fa-calendar-days'));
        $this->add_control('card1_color', array('label' => esc_html__('Accent Theme Color', 'sibacom-manager'), 'type' => Controls_Manager::COLOR, 'default' => '#173F91'));
        $this->add_control('card1_show_watermark', array('label' => esc_html__('Show Background Watermark', 'sibacom-manager'), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes'));
        $this->add_control('card1_watermark_icon', array('label' => esc_html__('Watermark Icon Class', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'fa-regular fa-calendar-days', 'condition' => array('card1_show_watermark' => 'yes')));
        $this->add_control('card1_link', array('label' => esc_html__('Card Link (Optional)', 'sibacom-manager'), 'type' => Controls_Manager::URL, 'placeholder' => 'https://... or #events'));
        $this->end_controls_section();

        // ==========================================
        // CONTENT TAB: Card 2 (Event Venue)
        // ==========================================
        $this->start_controls_section(
            'section_card2',
            array(
                'label'     => esc_html__('2. Event Venue Card', 'sibacom-manager'),
                'condition' => array('display_mode' => 'cards'),
            )
        );
        $this->add_control('card2_title', array('label' => esc_html__('Label / Category', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'Event Venue'));
        $this->add_control('card2_val', array('label' => esc_html__('Main Value / Venue', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'Academic Block-III'));
        $this->add_control('card2_sub', array('label' => esc_html__('Subtitle / Campus Info', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'Sukkur IBA University'));
        $this->add_control('card2_show_pill', array('label' => esc_html__('Show Pill Badge', 'sibacom-manager'), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes'));
        $this->add_control('card2_pill', array('label' => esc_html__('Pill Badge Text', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'Main Campus', 'condition' => array('card2_show_pill' => 'yes')));
        $this->add_control('card2_pill_icon', array('label' => esc_html__('Pill Icon Class', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'fa-solid fa-building-columns', 'condition' => array('card2_show_pill' => 'yes')));
        $this->add_control('card2_pill_style', array(
            'label'   => esc_html__('Pill Color Preset', 'sibacom-manager'),
            'type'    => Controls_Manager::SELECT,
            'default' => 'pill-green',
            'options' => array(
                'pill-blue'  => esc_html__('Blue', 'sibacom-manager'),
                'pill-green' => esc_html__('Green', 'sibacom-manager'),
                'pill-amber' => esc_html__('Amber', 'sibacom-manager'),
                'pill-navy'  => esc_html__('Navy', 'sibacom-manager'),
                'pill-cyan'  => esc_html__('Cyan', 'sibacom-manager'),
                'pill-live'  => esc_html__('Emerald', 'sibacom-manager'),
            ),
            'condition' => array('card2_show_pill' => 'yes'),
        ));
        $this->add_control('card2_icon', array('label' => esc_html__('Main Icon Class', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'fa-solid fa-location-dot'));
        $this->add_control('card2_color', array('label' => esc_html__('Accent Theme Color', 'sibacom-manager'), 'type' => Controls_Manager::COLOR, 'default' => '#079B58'));
        $this->add_control('card2_show_watermark', array('label' => esc_html__('Show Background Watermark', 'sibacom-manager'), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes'));
        $this->add_control('card2_watermark_icon', array('label' => esc_html__('Watermark Icon Class', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'fa-solid fa-location-dot', 'condition' => array('card2_show_watermark' => 'yes')));
        $this->add_control('card2_link', array('label' => esc_html__('Card Link (Optional)', 'sibacom-manager'), 'type' => Controls_Manager::URL, 'placeholder' => 'https://... or #venue'));
        $this->end_controls_section();

        // ==========================================
        // CONTENT TAB: Card 3 (Registration Deadline)
        // ==========================================
        $this->start_controls_section(
            'section_card3',
            array(
                'label'     => esc_html__('3. Registration Deadline Card', 'sibacom-manager'),
                'condition' => array('display_mode' => 'cards'),
            )
        );
        $this->add_control('card3_title', array('label' => esc_html__('Label / Category', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'Registration Deadline'));
        $this->add_control('card3_val', array('label' => esc_html__('Main Value / Deadline', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'Nov 25, 2026'));
        $this->add_control('card3_sub', array('label' => esc_html__('Subtitle / Cutoff Notice', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => '11:59 PM PKT Strict Cutoff'));
        $this->add_control('card3_show_pill', array('label' => esc_html__('Show Pill Badge', 'sibacom-manager'), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes'));
        $this->add_control('card3_pill', array('label' => esc_html__('Pill Badge Text', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'Strict Cutoff', 'condition' => array('card3_show_pill' => 'yes')));
        $this->add_control('card3_pill_icon', array('label' => esc_html__('Pill Icon Class', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'fa-solid fa-hourglass-half', 'condition' => array('card3_show_pill' => 'yes')));
        $this->add_control('card3_pill_style', array(
            'label'   => esc_html__('Pill Color Preset', 'sibacom-manager'),
            'type'    => Controls_Manager::SELECT,
            'default' => 'pill-amber',
            'options' => array(
                'pill-blue'  => esc_html__('Blue', 'sibacom-manager'),
                'pill-green' => esc_html__('Green', 'sibacom-manager'),
                'pill-amber' => esc_html__('Amber', 'sibacom-manager'),
                'pill-navy'  => esc_html__('Navy', 'sibacom-manager'),
                'pill-cyan'  => esc_html__('Cyan', 'sibacom-manager'),
                'pill-live'  => esc_html__('Emerald', 'sibacom-manager'),
            ),
            'condition' => array('card3_show_pill' => 'yes'),
        ));
        $this->add_control('card3_icon', array('label' => esc_html__('Main Icon Class', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'fa-solid fa-hourglass-half'));
        $this->add_control('card3_color', array('label' => esc_html__('Accent Theme Color', 'sibacom-manager'), 'type' => Controls_Manager::COLOR, 'default' => '#D97706'));
        $this->add_control('card3_show_watermark', array('label' => esc_html__('Show Background Watermark', 'sibacom-manager'), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes'));
        $this->add_control('card3_watermark_icon', array('label' => esc_html__('Watermark Icon Class', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'fa-solid fa-hourglass-half', 'condition' => array('card3_show_watermark' => 'yes')));
        $this->add_control('card3_link', array('label' => esc_html__('Card Link (Optional)', 'sibacom-manager'), 'type' => Controls_Manager::URL, 'placeholder' => 'https://... or #register'));
        $this->end_controls_section();

        // ==========================================
        // CONTENT TAB: Card 4 (Event Category)
        // ==========================================
        $this->start_controls_section(
            'section_card4',
            array(
                'label'     => esc_html__('4. Event Category Card', 'sibacom-manager'),
                'condition' => array('display_mode' => 'cards'),
            )
        );
        $this->add_control('card4_title', array('label' => esc_html__('Label / Category', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'Event Category'));
        $this->add_control('card4_val', array('label' => esc_html__('Main Value / Title', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'Tech Olympiad'));
        $this->add_control('card4_sub', array('label' => esc_html__('Subtitle / Track Info', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => '14+ Competitive Tracks'));
        $this->add_control('card4_show_pill', array('label' => esc_html__('Show Pill Badge', 'sibacom-manager'), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes'));
        $this->add_control('card4_pill', array('label' => esc_html__('Pill Badge Text', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => '14+ Tracks', 'condition' => array('card4_show_pill' => 'yes')));
        $this->add_control('card4_pill_icon', array('label' => esc_html__('Pill Icon Class', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'fa-solid fa-layer-group', 'condition' => array('card4_show_pill' => 'yes')));
        $this->add_control('card4_pill_style', array(
            'label'   => esc_html__('Pill Color Preset', 'sibacom-manager'),
            'type'    => Controls_Manager::SELECT,
            'default' => 'pill-navy',
            'options' => array(
                'pill-blue'  => esc_html__('Blue', 'sibacom-manager'),
                'pill-green' => esc_html__('Green', 'sibacom-manager'),
                'pill-amber' => esc_html__('Amber', 'sibacom-manager'),
                'pill-navy'  => esc_html__('Navy', 'sibacom-manager'),
                'pill-cyan'  => esc_html__('Cyan', 'sibacom-manager'),
                'pill-live'  => esc_html__('Emerald', 'sibacom-manager'),
            ),
            'condition' => array('card4_show_pill' => 'yes'),
        ));
        $this->add_control('card4_icon', array('label' => esc_html__('Main Icon Class', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'fa-solid fa-microchip'));
        $this->add_control('card4_color', array('label' => esc_html__('Accent Theme Color', 'sibacom-manager'), 'type' => Controls_Manager::COLOR, 'default' => '#102E68'));
        $this->add_control('card4_show_watermark', array('label' => esc_html__('Show Background Watermark', 'sibacom-manager'), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes'));
        $this->add_control('card4_watermark_icon', array('label' => esc_html__('Watermark Icon Class', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'fa-solid fa-microchip', 'condition' => array('card4_show_watermark' => 'yes')));
        $this->add_control('card4_link', array('label' => esc_html__('Card Link (Optional)', 'sibacom-manager'), 'type' => Controls_Manager::URL, 'placeholder' => 'https://... or #events'));
        $this->end_controls_section();

        // ==========================================
        // CONTENT TAB: Card 5 (Participation)
        // ==========================================
        $this->start_controls_section(
            'section_card5',
            array(
                'label'     => esc_html__('5. Participation Card', 'sibacom-manager'),
                'condition' => array('display_mode' => 'cards'),
            )
        );
        $this->add_control('card5_title', array('label' => esc_html__('Label / Category', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'Participation'));
        $this->add_control('card5_val', array('label' => esc_html__('Main Value / Stats', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => '1,500+ Innovators'));
        $this->add_control('card5_sub', array('label' => esc_html__('Subtitle / Reach', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => '120+ Universities Nationwide'));
        $this->add_control('card5_show_pill', array('label' => esc_html__('Show Pill Badge', 'sibacom-manager'), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes'));
        $this->add_control('card5_pill', array('label' => esc_html__('Pill Badge Text', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'Nationwide', 'condition' => array('card5_show_pill' => 'yes')));
        $this->add_control('card5_pill_icon', array('label' => esc_html__('Pill Icon Class', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'fa-solid fa-globe', 'condition' => array('card5_show_pill' => 'yes')));
        $this->add_control('card5_pill_style', array(
            'label'   => esc_html__('Pill Color Preset', 'sibacom-manager'),
            'type'    => Controls_Manager::SELECT,
            'default' => 'pill-cyan',
            'options' => array(
                'pill-blue'  => esc_html__('Blue', 'sibacom-manager'),
                'pill-green' => esc_html__('Green', 'sibacom-manager'),
                'pill-amber' => esc_html__('Amber', 'sibacom-manager'),
                'pill-navy'  => esc_html__('Navy', 'sibacom-manager'),
                'pill-cyan'  => esc_html__('Cyan', 'sibacom-manager'),
                'pill-live'  => esc_html__('Emerald', 'sibacom-manager'),
            ),
            'condition' => array('card5_show_pill' => 'yes'),
        ));
        $this->add_control('card5_icon', array('label' => esc_html__('Main Icon Class', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'fa-solid fa-users'));
        $this->add_control('card5_color', array('label' => esc_html__('Accent Theme Color', 'sibacom-manager'), 'type' => Controls_Manager::COLOR, 'default' => '#1D4ED8'));
        $this->add_control('card5_show_watermark', array('label' => esc_html__('Show Background Watermark', 'sibacom-manager'), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes'));
        $this->add_control('card5_watermark_icon', array('label' => esc_html__('Watermark Icon Class', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'fa-solid fa-users', 'condition' => array('card5_show_watermark' => 'yes')));
        $this->add_control('card5_link', array('label' => esc_html__('Card Link (Optional)', 'sibacom-manager'), 'type' => Controls_Manager::URL, 'placeholder' => 'https://...'));
        $this->end_controls_section();

        // ==========================================
        // CONTENT TAB: Card 6 (Registration Status)
        // ==========================================
        $this->start_controls_section(
            'section_card6',
            array(
                'label'     => esc_html__('6. Registration Status Card', 'sibacom-manager'),
                'condition' => array('display_mode' => 'cards'),
            )
        );
        $this->add_control('card6_title', array('label' => esc_html__('Label / Category', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'Registration Status'));
        $this->add_control('card6_val', array('label' => esc_html__('Main Value / Status', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'Registration Open'));
        $this->add_control('card6_sub', array('label' => esc_html__('Subtitle / Portal Notice', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'Verified Delegate Portals'));
        $this->add_control('card6_show_pill', array('label' => esc_html__('Show Pill Badge', 'sibacom-manager'), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes'));
        $this->add_control('card6_pill', array('label' => esc_html__('Pill Badge Text', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'Live Now', 'condition' => array('card6_show_pill' => 'yes')));
        $this->add_control('card6_has_pulse', array('label' => esc_html__('Enable Radar Pulse Dot', 'sibacom-manager'), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes', 'condition' => array('card6_show_pill' => 'yes')));
        $this->add_control('card6_pill_icon', array('label' => esc_html__('Pill Icon Class (if pulse off)', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'fa-solid fa-circle-check', 'condition' => array('card6_show_pill' => 'yes')));
        $this->add_control('card6_pill_style', array(
            'label'   => esc_html__('Pill Color Preset', 'sibacom-manager'),
            'type'    => Controls_Manager::SELECT,
            'default' => 'pill-live',
            'options' => array(
                'pill-blue'  => esc_html__('Blue', 'sibacom-manager'),
                'pill-green' => esc_html__('Green', 'sibacom-manager'),
                'pill-amber' => esc_html__('Amber', 'sibacom-manager'),
                'pill-navy'  => esc_html__('Navy', 'sibacom-manager'),
                'pill-cyan'  => esc_html__('Cyan', 'sibacom-manager'),
                'pill-live'  => esc_html__('Emerald (Live Pulse)', 'sibacom-manager'),
            ),
            'condition' => array('card6_show_pill' => 'yes'),
        ));
        $this->add_control('card6_icon', array('label' => esc_html__('Main Icon Class', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'fa-solid fa-circle-check'));
        $this->add_control('card6_color', array('label' => esc_html__('Accent Theme Color', 'sibacom-manager'), 'type' => Controls_Manager::COLOR, 'default' => '#079B58'));
        $this->add_control('card6_show_watermark', array('label' => esc_html__('Show Background Watermark', 'sibacom-manager'), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes'));
        $this->add_control('card6_watermark_icon', array('label' => esc_html__('Watermark Icon Class', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'fa-solid fa-circle-check', 'condition' => array('card6_show_watermark' => 'yes')));
        $this->add_control('card6_link', array('label' => esc_html__('Card Link (Optional)', 'sibacom-manager'), 'type' => Controls_Manager::URL, 'placeholder' => 'https://... or #events'));
        $this->end_controls_section();

        // ==========================================
        // CONTENT TAB: Custom Repeater Mode
        // ==========================================
        $this->start_controls_section(
            'section_repeater',
            array(
                'label'     => esc_html__('Custom Cards Repeater', 'sibacom-manager'),
                'condition' => array('display_mode' => 'repeater'),
            )
        );

        $repeater = new Repeater();

        $repeater->add_control('card_title', array('label' => esc_html__('Label / Category', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'Card Label'));
        $repeater->add_control('card_val', array('label' => esc_html__('Main Value / Statistic', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'Highlight Value'));
        $repeater->add_control('card_sub', array('label' => esc_html__('Subtitle / Detail', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'Supporting descriptive text'));
        $repeater->add_control('card_show_pill', array('label' => esc_html__('Show Pill Badge', 'sibacom-manager'), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes'));
        $repeater->add_control('card_pill', array('label' => esc_html__('Pill Badge Text', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'Official Tag'));
        $repeater->add_control('card_pill_icon', array('label' => esc_html__('Pill Icon Class', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'fa-solid fa-tag'));
        $repeater->add_control('card_pill_style', array(
            'label'   => esc_html__('Pill Color Preset', 'sibacom-manager'),
            'type'    => Controls_Manager::SELECT,
            'default' => 'pill-blue',
            'options' => array(
                'pill-blue'  => esc_html__('Blue', 'sibacom-manager'),
                'pill-green' => esc_html__('Green', 'sibacom-manager'),
                'pill-amber' => esc_html__('Amber', 'sibacom-manager'),
                'pill-navy'  => esc_html__('Navy', 'sibacom-manager'),
                'pill-cyan'  => esc_html__('Cyan', 'sibacom-manager'),
                'pill-live'  => esc_html__('Emerald (Live Pulse)', 'sibacom-manager'),
            ),
        ));
        $repeater->add_control('card_has_pulse', array('label' => esc_html__('Enable Radar Pulse Dot', 'sibacom-manager'), 'type' => Controls_Manager::SWITCHER, 'default' => 'no'));
        $repeater->add_control('card_icon', array('label' => esc_html__('Main Icon Class', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'fa-solid fa-star'));
        $repeater->add_control('card_color', array('label' => esc_html__('Accent & Icon Color', 'sibacom-manager'), 'type' => Controls_Manager::COLOR, 'default' => '#173F91'));
        $repeater->add_control('card_show_watermark', array('label' => esc_html__('Show Background Watermark', 'sibacom-manager'), 'type' => Controls_Manager::SWITCHER, 'default' => 'yes'));
        $repeater->add_control('card_watermark_icon', array('label' => esc_html__('Watermark Icon Class', 'sibacom-manager'), 'type' => Controls_Manager::TEXT, 'default' => 'fa-solid fa-star'));
        $repeater->add_control('card_link', array('label' => esc_html__('Card Link (URL)', 'sibacom-manager'), 'type' => Controls_Manager::URL));

        $this->add_control(
            'repeater_cards',
            array(
                'label'       => esc_html__('Cards List', 'sibacom-manager'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ card_title }}}: {{{ card_val }}}',
                'default'     => array(
                    array(
                        'card_title'          => 'Event Dates',
                        'card_val'            => 'Nov 30 – Dec 02, 2026',
                        'card_sub'            => '1-Day National Summit',
                        'card_show_pill'      => 'yes',
                        'card_pill'           => 'Official Dates',
                        'card_pill_icon'      => 'fa-regular fa-calendar-check',
                        'card_pill_style'     => 'pill-blue',
                        'card_icon'           => 'fa-regular fa-calendar-days',
                        'card_color'          => '#173F91',
                        'card_show_watermark' => 'yes',
                        'card_watermark_icon' => 'fa-regular fa-calendar-days',
                    ),
                    array(
                        'card_title'          => 'Event Venue',
                        'card_val'            => 'Academic Block-III',
                        'card_sub'            => 'Sukkur IBA University',
                        'card_show_pill'      => 'yes',
                        'card_pill'           => 'Main Campus',
                        'card_pill_icon'      => 'fa-solid fa-building-columns',
                        'card_pill_style'     => 'pill-green',
                        'card_icon'           => 'fa-solid fa-location-dot',
                        'card_color'          => '#079B58',
                        'card_show_watermark' => 'yes',
                        'card_watermark_icon' => 'fa-solid fa-location-dot',
                    ),
                    array(
                        'card_title'          => 'Registration Deadline',
                        'card_val'            => 'Nov 25, 2026',
                        'card_sub'            => '11:59 PM PKT Strict Cutoff',
                        'card_show_pill'      => 'yes',
                        'card_pill'           => 'Strict Cutoff',
                        'card_pill_icon'      => 'fa-solid fa-hourglass-half',
                        'card_pill_style'     => 'pill-amber',
                        'card_icon'           => 'fa-solid fa-hourglass-half',
                        'card_color'          => '#D97706',
                        'card_show_watermark' => 'yes',
                        'card_watermark_icon' => 'fa-solid fa-hourglass-half',
                    ),
                    array(
                        'card_title'          => 'Event Category',
                        'card_val'            => 'Tech Olympiad',
                        'card_sub'            => '14+ Competitive Tracks',
                        'card_show_pill'      => 'yes',
                        'card_pill'           => '14+ Tracks',
                        'card_pill_icon'      => 'fa-solid fa-layer-group',
                        'card_pill_style'     => 'pill-navy',
                        'card_icon'           => 'fa-solid fa-microchip',
                        'card_color'          => '#102E68',
                        'card_show_watermark' => 'yes',
                        'card_watermark_icon' => 'fa-solid fa-microchip',
                    ),
                    array(
                        'card_title'          => 'Participation',
                        'card_val'            => '1,500+ Innovators',
                        'card_sub'            => '120+ Universities Nationwide',
                        'card_show_pill'      => 'yes',
                        'card_pill'           => 'Nationwide',
                        'card_pill_icon'      => 'fa-solid fa-globe',
                        'card_pill_style'     => 'pill-cyan',
                        'card_icon'           => 'fa-solid fa-users',
                        'card_color'          => '#1D4ED8',
                        'card_show_watermark' => 'yes',
                        'card_watermark_icon' => 'fa-solid fa-users',
                    ),
                    array(
                        'card_title'          => 'Registration Status',
                        'card_val'            => 'Registration Open',
                        'card_sub'            => 'Verified Delegate Portals',
                        'card_show_pill'      => 'yes',
                        'card_pill'           => 'Live Now',
                        'card_pill_icon'      => 'fa-solid fa-circle-check',
                        'card_pill_style'     => 'pill-live',
                        'card_has_pulse'      => 'yes',
                        'card_icon'           => 'fa-solid fa-circle-check',
                        'card_color'          => '#079B58',
                        'card_show_watermark' => 'yes',
                        'card_watermark_icon' => 'fa-solid fa-circle-check',
                    ),
                ),
            )
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB: 1. Cards Appearance
        // ==========================================
        $this->start_controls_section(
            'section_style_cards',
            array(
                'label' => esc_html__('Cards Box Appearance', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'card_bg_color',
            array(
                'label'     => esc_html__('Card Background Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FFFFFF',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-info-card' => 'background: {{VALUE}} !important;',
                ),
            )
        );

        $this->add_responsive_control(
            'card_radius',
            array(
                'label'      => esc_html__('Border Radius', 'sibacom-manager'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'rem'),
                'range'      => array('px' => array('min' => 0, 'max' => 40)),
                'default'    => array('unit' => 'px', 'size' => 20),
                'selectors'  => array(
                    '{{WRAPPER}} .sibacom-info-card' => 'border-radius: {{SIZE}}{{UNIT}} !important;',
                ),
            )
        );

        $this->add_responsive_control(
            'card_padding',
            array(
                'label'      => esc_html__('Card Padding', 'sibacom-manager'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'rem', '%'),
                'default'    => array('top' => 30, 'right' => 26, 'bottom' => 28, 'left' => 26, 'unit' => 'px', 'isLinked' => false),
                'selectors'  => array(
                    '{{WRAPPER}} .sibacom-info-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ),
            )
        );

        $this->add_control(
            'card_accent_bar_height',
            array(
                'label'      => esc_html__('Top Accent Bar Height', 'sibacom-manager'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px'),
                'range'      => array('px' => array('min' => 0, 'max' => 12)),
                'default'    => array('unit' => 'px', 'size' => 3),
                'selectors'  => array(
                    '{{WRAPPER}} .sibacom-info-card::before' => 'height: {{SIZE}}{{UNIT}} !important;',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'card_box_shadow',
                'label'    => esc_html__('Card Shadow', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .sibacom-info-card',
            )
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB: 2. Icon Badge & Pill Styling
        // ==========================================
        $this->start_controls_section(
            'section_style_badges',
            array(
                'label' => esc_html__('Icon Box & Pill Badges', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_responsive_control(
            'icon_box_size',
            array(
                'label'      => esc_html__('Icon Box Size', 'sibacom-manager'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px'),
                'range'      => array('px' => array('min' => 32, 'max' => 70)),
                'default'    => array('unit' => 'px', 'size' => 44),
                'selectors'  => array(
                    '{{WRAPPER}} .sibacom-info-icon-badge' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
                ),
            )
        );

        $this->add_responsive_control(
            'icon_font_size',
            array(
                'label'      => esc_html__('Icon Font Size', 'sibacom-manager'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'rem'),
                'range'      => array('px' => array('min' => 12, 'max' => 32)),
                'default'    => array('unit' => 'px', 'size' => 19),
                'selectors'  => array(
                    '{{WRAPPER}} .sibacom-info-icon-badge i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'pill_typography',
                'label'    => esc_html__('Pill Badge Typography', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .sibacom-info-pill',
            )
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB: 3. Typography & Content Colors
        // ==========================================
        $this->start_controls_section(
            'section_style_typography',
            array(
                'label' => esc_html__('Text Typography & Colors', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        // Label / Category
        $this->add_control(
            'heading_label_style',
            array(
                'label'     => esc_html__('Label / Category Header', 'sibacom-manager'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );
        $this->add_control(
            'label_color',
            array(
                'label'     => esc_html__('Label Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#64748B',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-info-label' => 'color: {{VALUE}} !important;',
                ),
            )
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'label_typography',
                'label'    => esc_html__('Label Typography', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .sibacom-info-label',
            )
        );

        // Value / Stat
        $this->add_control(
            'heading_val_style',
            array(
                'label'     => esc_html__('Main Value / Statistic', 'sibacom-manager'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );
        $this->add_control(
            'val_color',
            array(
                'label'     => esc_html__('Value Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#0F172A',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-info-val' => 'color: {{VALUE}} !important;',
                ),
            )
        );
        $this->add_control(
            'val_hover_color',
            array(
                'label'     => esc_html__('Value Hover Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-info-card:hover .sibacom-info-val' => 'color: {{VALUE}} !important;',
                ),
            )
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'val_typography',
                'label'    => esc_html__('Value Typography', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .sibacom-info-val',
            )
        );

        // Subtitle / Tagline
        $this->add_control(
            'heading_sub_style',
            array(
                'label'     => esc_html__('Subtitle / Detail', 'sibacom-manager'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );
        $this->add_control(
            'sub_color',
            array(
                'label'     => esc_html__('Subtitle Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#64748B',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-info-sub' => 'color: {{VALUE}} !important;',
                ),
            )
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'sub_typography',
                'label'    => esc_html__('Subtitle Typography', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .sibacom-info-sub',
            )
        );

        $this->end_controls_section();

        // ==========================================
        // STYLE TAB: 4. Watermark Icon
        // ==========================================
        $this->start_controls_section(
            'section_style_watermark',
            array(
                'label' => esc_html__('Watermark Silhouette', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_responsive_control(
            'watermark_font_size',
            array(
                'label'      => esc_html__('Watermark Icon Size', 'sibacom-manager'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'rem'),
                'range'      => array('px' => array('min' => 30, 'max' => 120)),
                'default'    => array('unit' => 'rem', 'size' => 4.8),
                'selectors'  => array(
                    '{{WRAPPER}} .sibacom-info-watermark' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                ),
            )
        );

        $this->add_control(
            'watermark_opacity',
            array(
                'label'      => esc_html__('Watermark Opacity', 'sibacom-manager'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => array('px' => array('min' => 0, 'max' => 1, 'step' => 0.01)),
                'default'    => array('size' => 0.05),
                'selectors'  => array(
                    '{{WRAPPER}} .sibacom-info-watermark' => 'opacity: {{SIZE}} !important;',
                ),
            )
        );

        $this->end_controls_section();
    }

    /**
     * Helper: Convert Hex color to RGBA string
     */
    private function hex2rgba($hex, $opacity = 0.12) {
        $hex = str_replace('#', '', $hex);
        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } elseif (strlen($hex) >= 6) {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        } else {
            return 'rgba(23, 63, 145, ' . $opacity . ')';
        }
        return "rgba($r, $g, $b, $opacity)";
    }

    /**
     * Render a single Info Card
     */
    private function render_card($data, $index) {
        $label          = !empty($data['title']) ? $data['title'] : 'Info Item';
        $val            = !empty($data['val']) ? $data['val'] : 'Highlight Value';
        $sub            = !empty($data['sub']) ? $data['sub'] : '';
        $show_pill      = isset($data['show_pill']) ? ($data['show_pill'] === 'yes') : true;
        $pill_text      = !empty($data['pill']) ? $data['pill'] : '';
        $pill_icon      = !empty($data['pill_icon']) ? $data['pill_icon'] : '';
        $pill_style     = !empty($data['pill_style']) ? $data['pill_style'] : 'pill-blue';
        $has_pulse      = !empty($data['has_pulse']) && ($data['has_pulse'] === 'yes');
        $icon           = !empty($data['icon']) ? $data['icon'] : 'fa-solid fa-star';
        $color          = !empty($data['color']) ? $data['color'] : '#173F91';
        $show_watermark = isset($data['show_watermark']) ? ($data['show_watermark'] === 'yes') : true;
        $watermark_icon = !empty($data['watermark_icon']) ? $data['watermark_icon'] : $icon;
        $link           = !empty($data['link']) ? $data['link'] : array();

        $variant_classes = array(
            1 => 'card-variant-dates',
            2 => 'card-variant-venue',
            3 => 'card-variant-deadline',
            4 => 'card-variant-category',
            5 => 'card-variant-participation',
            6 => 'card-variant-status',
        );
        $variant_cls = isset($variant_classes[$index]) ? $variant_classes[$index] : 'card-variant-custom';

        $bg_tint_start = $this->hex2rgba($color, 0.13);
        $bg_tint_end   = $this->hex2rgba($color, 0.05);
        $icon_bg_style = "color: " . esc_attr($color) . "; background: linear-gradient(135deg, {$bg_tint_start} 0%, {$bg_tint_end} 100%);";
        $card_accent_css = "--card-accent: " . esc_attr($color) . ";";

        $has_link = !empty($link['url']);
        $tag = $has_link ? 'a' : 'div';
        $link_attrs = '';
        if ($has_link) {
            $link_attrs = ' href="' . esc_url($link['url']) . '"';
            if (!empty($link['is_external'])) {
                $link_attrs .= ' target="_blank" rel="noopener noreferrer"';
            }
            if (!empty($link['nofollow'])) {
                $link_attrs .= ' rel="nofollow"';
            }
        }
        ?>
        <<?php echo $tag; ?><?php echo $link_attrs; ?> class="neu-card sibacom-info-card <?php echo esc_attr($variant_cls); ?>" style="<?php echo esc_attr($card_accent_css); ?>">
            <div class="sibacom-info-card-header">
                <div class="sibacom-info-icon-badge" style="<?php echo esc_attr($icon_bg_style); ?>">
                    <?php if ($has_pulse && $index === 6) : ?>
                        <span class="pulse-dot-live"></span>
                    <?php else : ?>
                        <i class="<?php echo esc_attr($icon); ?>" aria-hidden="true"></i>
                    <?php endif; ?>
                </div>

                <?php if ($show_pill && !empty($pill_text)) : ?>
                    <span class="sibacom-info-pill <?php echo esc_attr($pill_style); ?>">
                        <?php if ($has_pulse) : ?>
                            <span class="pulse-dot-live" style="width:6px; height:6px;"></span>
                        <?php elseif (!empty($pill_icon)) : ?>
                            <i class="<?php echo esc_attr($pill_icon); ?>" aria-hidden="true"></i>
                        <?php endif; ?>
                        <?php echo esc_html($pill_text); ?>
                    </span>
                <?php endif; ?>
            </div>

            <div class="sibacom-info-card-body">
                <span class="sibacom-info-label"><?php echo esc_html($label); ?></span>
                <h4 class="font-display sibacom-info-val"><?php echo esc_html($val); ?></h4>
                <?php if (!empty($sub)) : ?>
                    <span class="sibacom-info-sub"><?php echo esc_html($sub); ?></span>
                <?php endif; ?>
            </div>

            <?php if ($show_watermark && !empty($watermark_icon)) : ?>
                <div class="sibacom-info-watermark" aria-hidden="true">
                    <i class="<?php echo esc_attr($watermark_icon); ?>"></i>
                </div>
            <?php endif; ?>
        </<?php echo $tag; ?>>
        <?php
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $mode = !empty($settings['display_mode']) ? $settings['display_mode'] : 'cards';

        // Backward compatibility: If an old page set 'use_custom_values' => 'no'
        if (isset($settings['use_custom_values']) && $settings['use_custom_values'] === 'no') {
            $mode = 'settings';
        }

        // If explicitly requested to sync from WordPress settings
        if ($mode === 'settings') {
            if (class_exists('SIBACOM_Shortcodes')) {
                echo SIBACOM_Shortcodes::render_info(array());
            }
            return;
        }
        ?>
        <div class="sibacom-event-info-cards-wrap">
            <div class="sibacom-info-cards-grid">
                <?php
                if ($mode === 'repeater' && !empty($settings['repeater_cards'])) {
                    $idx = 1;
                    foreach ($settings['repeater_cards'] as $card_item) {
                        $this->render_card(array(
                            'title'          => $card_item['card_title'],
                            'val'            => $card_item['card_val'],
                            'sub'            => $card_item['card_sub'],
                            'show_pill'      => $card_item['card_show_pill'],
                            'pill'           => $card_item['card_pill'],
                            'pill_icon'      => $card_item['card_pill_icon'],
                            'pill_style'     => $card_item['card_pill_style'],
                            'has_pulse'      => $card_item['card_has_pulse'],
                            'icon'           => $card_item['card_icon'],
                            'color'          => $card_item['card_color'],
                            'show_watermark' => $card_item['card_show_watermark'],
                            'watermark_icon' => $card_item['card_watermark_icon'],
                            'link'           => $card_item['card_link'],
                        ), $idx);
                        $idx++;
                    }
                } else {
                    // Standard 6 Cards Mode with rock-solid fallback defaults
                    $defaults = array(
                        1 => array(
                            'title'          => !empty($settings['card1_title']) ? $settings['card1_title'] : 'Event Dates',
                            'val'            => !empty($settings['card1_val']) ? $settings['card1_val'] : 'Nov 30 – Dec 02, 2026',
                            'sub'            => !empty($settings['card1_sub']) ? $settings['card1_sub'] : '1-Day National Summit',
                            'show_pill'      => isset($settings['card1_show_pill']) ? $settings['card1_show_pill'] : 'yes',
                            'pill'           => !empty($settings['card1_pill']) ? $settings['card1_pill'] : 'Official Dates',
                            'pill_icon'      => !empty($settings['card1_pill_icon']) ? $settings['card1_pill_icon'] : 'fa-regular fa-calendar-check',
                            'pill_style'     => !empty($settings['card1_pill_style']) ? $settings['card1_pill_style'] : 'pill-blue',
                            'icon'           => !empty($settings['card1_icon']) ? $settings['card1_icon'] : 'fa-regular fa-calendar-days',
                            'color'          => !empty($settings['card1_color']) ? $settings['card1_color'] : '#173F91',
                            'show_watermark' => isset($settings['card1_show_watermark']) ? $settings['card1_show_watermark'] : 'yes',
                            'watermark_icon' => !empty($settings['card1_watermark_icon']) ? $settings['card1_watermark_icon'] : 'fa-regular fa-calendar-days',
                            'link'           => !empty($settings['card1_link']) ? $settings['card1_link'] : array(),
                        ),
                        2 => array(
                            'title'          => !empty($settings['card2_title']) ? $settings['card2_title'] : 'Event Venue',
                            'val'            => !empty($settings['card2_val']) ? $settings['card2_val'] : 'Academic Block-III',
                            'sub'            => !empty($settings['card2_sub']) ? $settings['card2_sub'] : 'Sukkur IBA University',
                            'show_pill'      => isset($settings['card2_show_pill']) ? $settings['card2_show_pill'] : 'yes',
                            'pill'           => !empty($settings['card2_pill']) ? $settings['card2_pill'] : 'Main Campus',
                            'pill_icon'      => !empty($settings['card2_pill_icon']) ? $settings['card2_pill_icon'] : 'fa-solid fa-building-columns',
                            'pill_style'     => !empty($settings['card2_pill_style']) ? $settings['card2_pill_style'] : 'pill-green',
                            'icon'           => !empty($settings['card2_icon']) ? $settings['card2_icon'] : 'fa-solid fa-location-dot',
                            'color'          => !empty($settings['card2_color']) ? $settings['card2_color'] : '#079B58',
                            'show_watermark' => isset($settings['card2_show_watermark']) ? $settings['card2_show_watermark'] : 'yes',
                            'watermark_icon' => !empty($settings['card2_watermark_icon']) ? $settings['card2_watermark_icon'] : 'fa-solid fa-location-dot',
                            'link'           => !empty($settings['card2_link']) ? $settings['card2_link'] : array(),
                        ),
                        3 => array(
                            'title'          => !empty($settings['card3_title']) ? $settings['card3_title'] : 'Registration Deadline',
                            'val'            => !empty($settings['card3_val']) ? $settings['card3_val'] : 'Nov 25, 2026',
                            'sub'            => !empty($settings['card3_sub']) ? $settings['card3_sub'] : '11:59 PM PKT Strict Cutoff',
                            'show_pill'      => isset($settings['card3_show_pill']) ? $settings['card3_show_pill'] : 'yes',
                            'pill'           => !empty($settings['card3_pill']) ? $settings['card3_pill'] : 'Strict Cutoff',
                            'pill_icon'      => !empty($settings['card3_pill_icon']) ? $settings['card3_pill_icon'] : 'fa-solid fa-hourglass-half',
                            'pill_style'     => !empty($settings['card3_pill_style']) ? $settings['card3_pill_style'] : 'pill-amber',
                            'icon'           => !empty($settings['card3_icon']) ? $settings['card3_icon'] : 'fa-solid fa-hourglass-half',
                            'color'          => !empty($settings['card3_color']) ? $settings['card3_color'] : '#D97706',
                            'show_watermark' => isset($settings['card3_show_watermark']) ? $settings['card3_show_watermark'] : 'yes',
                            'watermark_icon' => !empty($settings['card3_watermark_icon']) ? $settings['card3_watermark_icon'] : 'fa-solid fa-hourglass-half',
                            'link'           => !empty($settings['card3_link']) ? $settings['card3_link'] : array(),
                        ),
                        4 => array(
                            'title'          => !empty($settings['card4_title']) ? $settings['card4_title'] : 'Event Category',
                            'val'            => !empty($settings['card4_val']) ? $settings['card4_val'] : 'Tech Olympiad',
                            'sub'            => !empty($settings['card4_sub']) ? $settings['card4_sub'] : '14+ Competitive Tracks',
                            'show_pill'      => isset($settings['card4_show_pill']) ? $settings['card4_show_pill'] : 'yes',
                            'pill'           => !empty($settings['card4_pill']) ? $settings['card4_pill'] : '14+ Tracks',
                            'pill_icon'      => !empty($settings['card4_pill_icon']) ? $settings['card4_pill_icon'] : 'fa-solid fa-layer-group',
                            'pill_style'     => !empty($settings['card4_pill_style']) ? $settings['card4_pill_style'] : 'pill-navy',
                            'icon'           => !empty($settings['card4_icon']) ? $settings['card4_icon'] : 'fa-solid fa-microchip',
                            'color'          => !empty($settings['card4_color']) ? $settings['card4_color'] : '#102E68',
                            'show_watermark' => isset($settings['card4_show_watermark']) ? $settings['card4_show_watermark'] : 'yes',
                            'watermark_icon' => !empty($settings['card4_watermark_icon']) ? $settings['card4_watermark_icon'] : 'fa-solid fa-microchip',
                            'link'           => !empty($settings['card4_link']) ? $settings['card4_link'] : array(),
                        ),
                        5 => array(
                            'title'          => !empty($settings['card5_title']) ? $settings['card5_title'] : 'Participation',
                            'val'            => !empty($settings['card5_val']) ? $settings['card5_val'] : '1,500+ Innovators',
                            'sub'            => !empty($settings['card5_sub']) ? $settings['card5_sub'] : '120+ Universities Nationwide',
                            'show_pill'      => isset($settings['card5_show_pill']) ? $settings['card5_show_pill'] : 'yes',
                            'pill'           => !empty($settings['card5_pill']) ? $settings['card5_pill'] : 'Nationwide',
                            'pill_icon'      => !empty($settings['card5_pill_icon']) ? $settings['card5_pill_icon'] : 'fa-solid fa-globe',
                            'pill_style'     => !empty($settings['card5_pill_style']) ? $settings['card5_pill_style'] : 'pill-cyan',
                            'icon'           => !empty($settings['card5_icon']) ? $settings['card5_icon'] : 'fa-solid fa-users',
                            'color'          => !empty($settings['card5_color']) ? $settings['card5_color'] : '#1D4ED8',
                            'show_watermark' => isset($settings['card5_show_watermark']) ? $settings['card5_show_watermark'] : 'yes',
                            'watermark_icon' => !empty($settings['card5_watermark_icon']) ? $settings['card5_watermark_icon'] : 'fa-solid fa-users',
                            'link'           => !empty($settings['card5_link']) ? $settings['card5_link'] : array(),
                        ),
                        6 => array(
                            'title'          => !empty($settings['card6_title']) ? $settings['card6_title'] : 'Registration Status',
                            'val'            => !empty($settings['card6_val']) ? $settings['card6_val'] : 'Registration Open',
                            'sub'            => !empty($settings['card6_sub']) ? $settings['card6_sub'] : 'Verified Delegate Portals',
                            'show_pill'      => isset($settings['card6_show_pill']) ? $settings['card6_show_pill'] : 'yes',
                            'pill'           => !empty($settings['card6_pill']) ? $settings['card6_pill'] : 'Live Now',
                            'pill_icon'      => !empty($settings['card6_pill_icon']) ? $settings['card6_pill_icon'] : 'fa-solid fa-circle-check',
                            'pill_style'     => !empty($settings['card6_pill_style']) ? $settings['card6_pill_style'] : 'pill-live',
                            'has_pulse'      => isset($settings['card6_has_pulse']) ? $settings['card6_has_pulse'] : 'yes',
                            'icon'           => !empty($settings['card6_icon']) ? $settings['card6_icon'] : 'fa-solid fa-circle-check',
                            'color'          => !empty($settings['card6_color']) ? $settings['card6_color'] : '#079B58',
                            'show_watermark' => isset($settings['card6_show_watermark']) ? $settings['card6_show_watermark'] : 'yes',
                            'watermark_icon' => !empty($settings['card6_watermark_icon']) ? $settings['card6_watermark_icon'] : 'fa-solid fa-circle-check',
                            'link'           => !empty($settings['card6_link']) ? $settings['card6_link'] : array(),
                        ),
                    );

                    for ($i = 1; $i <= 6; $i++) {
                        $this->render_card($defaults[$i], $i);
                    }
                }
                ?>
            </div>
        </div>
        <?php
    }
}
