<?php
/**
 * SIBACOM Events & Pricing Elementor Widget
 * Fully Editable Visual Competitions & Pricing Card Grid for Elementor
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
use Elementor\Icons_Manager;

class SIBACOM_Events_Widget extends Widget_Base {

    public function get_name() {
        return 'sibacom_events';
    }

    public function get_title() {
        return esc_html__('SIBACOM Events & Pricing', 'sibacom-manager');
    }

    public function get_icon() {
        return 'eicon-price-table';
    }

    public function get_categories() {
        return array('sibacom-elements');
    }

    public function get_keywords() {
        return array('events', 'pricing', 'competitions', 'cards', 'sibacom', 'badges', 'hackathon', 'olympiad');
    }

    protected function register_controls() {
        // =========================================================================
        // CONTENT TAB: Source & Mode
        // =========================================================================
        $this->start_controls_section(
            'section_content_source',
            array(
                'label' => esc_html__('Event Grid Configuration', 'sibacom-manager'),
            )
        );

        $this->add_control(
            'data_mode',
            array(
                'label'       => esc_html__('Data Source Mode', 'sibacom-manager'),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'manual',
                'description' => esc_html__('Choose Manual to visually edit all cards, images, badges, dates, venues and buttons right here in Elementor.', 'sibacom-manager'),
                'options'     => array(
                    'manual'  => esc_html__('Custom Manual Repeater (Visual Elementor Editor)', 'sibacom-manager'),
                    'dynamic' => esc_html__('Dynamic (WordPress CPT / SIBACOM Events)', 'sibacom-manager'),
                ),
            )
        );

        $this->add_responsive_control(
            'columns',
            array(
                'label'           => esc_html__('Grid Columns', 'sibacom-manager'),
                'type'            => Controls_Manager::SELECT,
                'desktop_default' => '3',
                'tablet_default'  => '2',
                'mobile_default'  => '1',
                'options'         => array(
                    '1' => esc_html__('1 Column (Full Width)', 'sibacom-manager'),
                    '2' => esc_html__('2 Columns (Split)', 'sibacom-manager'),
                    '3' => esc_html__('3 Columns (Standard Grid)', 'sibacom-manager'),
                    '4' => esc_html__('4 Columns (Compact Grid)', 'sibacom-manager'),
                ),
                'selectors'       => array(
                    '{{WRAPPER}} .sibacom-events-grid' => 'grid-template-columns: repeat({{VALUE}}, minmax(0, 1fr)) !important;',
                ),
            )
        );

        $this->add_responsive_control(
            'grid_gap',
            array(
                'label'      => esc_html__('Grid Gap', 'sibacom-manager'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'rem', 'em'),
                'range'      => array(
                    'px' => array('min' => 0, 'max' => 60),
                ),
                'default'    => array('unit' => 'px', 'size' => 32),
                'selectors'  => array(
                    '{{WRAPPER}} .sibacom-events-grid' => 'gap: {{SIZE}}{{UNIT}};',
                ),
            )
        );

        // Dynamic Mode Controls
        $this->add_control(
            'limit',
            array(
                'label'     => esc_html__('Number of Events to Show (-1 for All)', 'sibacom-manager'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 7,
                'condition' => array(
                    'data_mode' => 'dynamic',
                ),
            )
        );

        $this->add_control(
            'featured_only',
            array(
                'label'        => esc_html__('Only Featured Events', 'sibacom-manager'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'sibacom-manager'),
                'label_off'    => esc_html__('No', 'sibacom-manager'),
                'return_value' => 'yes',
                'default'      => '',
                'condition'    => array(
                    'data_mode' => 'dynamic',
                ),
            )
        );

        $this->end_controls_section();

        // =========================================================================
        // CONTENT TAB: Manual Event Items (Fully Editable Cards)
        // =========================================================================
        $this->start_controls_section(
            'section_content_cards',
            array(
                'label'     => esc_html__('Event Competition Cards', 'sibacom-manager'),
                'condition' => array(
                    'data_mode' => 'manual',
                ),
            )
        );

        $repeater = new Repeater();

        // Card Basics
        $repeater->add_control(
            'heading_card_content',
            array(
                'label'     => esc_html__('1. Title & Details', 'sibacom-manager'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $repeater->add_control(
            'event_title',
            array(
                'label'       => esc_html__('Event Title', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'Startup Showcase & Venture Pitching',
                'label_block' => true,
            )
        );

        $repeater->add_control(
            'title_tag',
            array(
                'label'   => esc_html__('Title HTML Tag', 'sibacom-manager'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'h3',
                'options' => array(
                    'h2'   => 'H2',
                    'h3'   => 'H3',
                    'h4'   => 'H4',
                    'h5'   => 'H5',
                    'div'  => 'div',
                    'span' => 'span',
                ),
            )
        );

        $repeater->add_control(
            'event_desc',
            array(
                'label'   => esc_html__('Description / Excerpt', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXTAREA,
                'rows'    => 4,
                'default' => 'Collegiate founders pitch validated software and hardware prototypes directly before accredited venture capitalists and angel networks.',
            )
        );

        // Media & Image
        $repeater->add_control(
            'heading_card_media',
            array(
                'label'     => esc_html__('2. Card Banner Image', 'sibacom-manager'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $repeater->add_control(
            'event_banner',
            array(
                'label'   => esc_html__('Banner Image', 'sibacom-manager'),
                'type'    => Controls_Manager::MEDIA,
                'default' => array(
                    'url' => 'https://images.unsplash.com/photo-1559136555-9303baea8ebd?auto=format&fit=crop&w=800&q=80',
                ),
            )
        );

        $repeater->add_control(
            'event_banner_custom_url',
            array(
                'label'       => esc_html__('Direct Image URL Fallback', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'description' => esc_html__('Optional direct external image link if not uploading to WordPress media library.', 'sibacom-manager'),
                'label_block' => true,
            )
        );

        $repeater->add_control(
            'event_banner_alt',
            array(
                'label'       => esc_html__('Image Alt Text', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'description' => esc_html__('Defaults to Event Title if left blank.', 'sibacom-manager'),
            )
        );

        // Badge 1: Price / Registration Fee
        $repeater->add_control(
            'heading_badge_1',
            array(
                'label'     => esc_html__('3. Badge 1 (Price / Fee - Top Left)', 'sibacom-manager'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $repeater->add_control(
            'show_badge_1',
            array(
                'label'        => esc_html__('Show Price Badge', 'sibacom-manager'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'sibacom-manager'),
                'label_off'    => esc_html__('Hide', 'sibacom-manager'),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $repeater->add_control(
            'event_price',
            array(
                'label'       => esc_html__('Badge 1 Text (Price / Fee)', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'Free Registration',
                'condition'   => array('show_badge_1' => 'yes'),
                'label_block' => true,
            )
        );

        $repeater->add_control(
            'show_badge_1_icon',
            array(
                'label'        => esc_html__('Show Tag Icon', 'sibacom-manager'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'sibacom-manager'),
                'label_off'    => esc_html__('No', 'sibacom-manager'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => array('show_badge_1' => 'yes'),
            )
        );

        $repeater->add_control(
            'badge_1_icon',
            array(
                'label'       => esc_html__('Custom Badge 1 Icon', 'sibacom-manager'),
                'type'        => Controls_Manager::ICONS,
                'default'     => array(
                    'value'   => 'fa-solid fa-tag',
                    'library' => 'solid',
                ),
                'condition'   => array(
                    'show_badge_1'      => 'yes',
                    'show_badge_1_icon' => 'yes',
                ),
            )
        );

        $repeater->add_control(
            'event_fee_type',
            array(
                'label'     => esc_html__('Fee Style Preset', 'sibacom-manager'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'free',
                'options'   => array(
                    'free'    => esc_html__('Free (Emerald Green Pill)', 'sibacom-manager'),
                    'paid'    => esc_html__('Paid Standard (Deep Navy Pill)', 'sibacom-manager'),
                    'team'    => esc_html__('Team Registration (Deep Navy Pill)', 'sibacom-manager'),
                    'gold'    => esc_html__('Gold / Special Category', 'sibacom-manager'),
                    'custom'  => esc_html__('Custom Color Scheme', 'sibacom-manager'),
                ),
                'condition' => array('show_badge_1' => 'yes'),
            )
        );

        $repeater->add_control(
            'badge_1_bg_color',
            array(
                'label'     => esc_html__('Custom Background Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'condition' => array('show_badge_1' => 'yes'),
            )
        );

        $repeater->add_control(
            'badge_1_text_color',
            array(
                'label'     => esc_html__('Custom Text Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'condition' => array('show_badge_1' => 'yes'),
            )
        );

        // Badge 2: Registration Status
        $repeater->add_control(
            'heading_badge_2',
            array(
                'label'     => esc_html__('4. Badge 2 (Status - Top Right)', 'sibacom-manager'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $repeater->add_control(
            'show_badge_2',
            array(
                'label'        => esc_html__('Show Status Badge', 'sibacom-manager'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'sibacom-manager'),
                'label_off'    => esc_html__('Hide', 'sibacom-manager'),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $repeater->add_control(
            'event_status',
            array(
                'label'     => esc_html__('Status Color Preset', 'sibacom-manager'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'open',
                'options'   => array(
                    'open'         => esc_html__('Registration Open (Mint Green)', 'sibacom-manager'),
                    'closing_soon' => esc_html__('Closing Soon (Amber / Orange)', 'sibacom-manager'),
                    'not_open'     => esc_html__('Coming Soon / Proposed (Soft Blue)', 'sibacom-manager'),
                    'closed'       => esc_html__('Registration Closed (Red / Coral)', 'sibacom-manager'),
                    'full'         => esc_html__('Fully Booked (Muted Gray)', 'sibacom-manager'),
                    'custom'       => esc_html__('Custom Colors', 'sibacom-manager'),
                ),
                'condition' => array('show_badge_2' => 'yes'),
            )
        );

        $repeater->add_control(
            'event_status_custom_text',
            array(
                'label'       => esc_html__('Badge 2 Text Override', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'REGISTRATION OPEN',
                'placeholder' => 'REGISTRATION OPEN',
                'description' => esc_html__('Type any custom status text (e.g. REGISTRATION OPEN, PROPOSED, EARLY BIRD, etc.).', 'sibacom-manager'),
                'condition'   => array('show_badge_2' => 'yes'),
                'label_block' => true,
            )
        );

        $repeater->add_control(
            'show_status_dot',
            array(
                'label'        => esc_html__('Show Indicator Dot', 'sibacom-manager'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'sibacom-manager'),
                'label_off'    => esc_html__('No', 'sibacom-manager'),
                'return_value' => 'yes',
                'default'      => '',
                'condition'    => array('show_badge_2' => 'yes'),
            )
        );

        $repeater->add_control(
            'badge_2_bg_color',
            array(
                'label'     => esc_html__('Custom Status Background Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'condition' => array('show_badge_2' => 'yes'),
            )
        );

        $repeater->add_control(
            'badge_2_text_color',
            array(
                'label'     => esc_html__('Custom Status Text Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'condition' => array('show_badge_2' => 'yes'),
            )
        );

        $repeater->add_control(
            'badge_2_dot_color',
            array(
                'label'     => esc_html__('Custom Indicator Dot Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'condition' => array(
                    'show_badge_2'    => 'yes',
                    'show_status_dot' => 'yes',
                ),
            )
        );

        // Category Tag
        $repeater->add_control(
            'heading_category',
            array(
                'label'     => esc_html__('5. Category Tag', 'sibacom-manager'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $repeater->add_control(
            'show_category',
            array(
                'label'        => esc_html__('Show Category Pill', 'sibacom-manager'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'sibacom-manager'),
                'label_off'    => esc_html__('Hide', 'sibacom-manager'),
                'return_value' => 'yes',
                'default'      => '',
            )
        );

        $repeater->add_control(
            'event_category',
            array(
                'label'     => esc_html__('Category Name', 'sibacom-manager'),
                'type'      => Controls_Manager::TEXT,
                'default'   => 'Venture & Pitching',
                'condition' => array('show_category' => 'yes'),
            )
        );

        // Meta Details: Date, Time, Venue, Deadline
        $repeater->add_control(
            'heading_meta_details',
            array(
                'label'     => esc_html__('6. Meta Details (Date, Venue, Closes)', 'sibacom-manager'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $repeater->add_control(
            'show_meta',
            array(
                'label'        => esc_html__('Show Meta Section', 'sibacom-manager'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'sibacom-manager'),
                'label_off'    => esc_html__('Hide', 'sibacom-manager'),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        // Row 1: Date
        $repeater->add_control(
            'show_date',
            array(
                'label'        => esc_html__('Show Date Row', 'sibacom-manager'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'sibacom-manager'),
                'label_off'    => esc_html__('No', 'sibacom-manager'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => array('show_meta' => 'yes'),
            )
        );

        $repeater->add_control(
            'date_label',
            array(
                'label'     => esc_html__('Date Label', 'sibacom-manager'),
                'type'      => Controls_Manager::TEXT,
                'default'   => 'Date:',
                'condition' => array('show_meta' => 'yes', 'show_date' => 'yes'),
            )
        );

        $repeater->add_control(
            'event_date',
            array(
                'label'       => esc_html__('Date Value', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'November 22, 2026',
                'condition'   => array('show_meta' => 'yes', 'show_date' => 'yes'),
                'label_block' => true,
            )
        );

        $repeater->add_control(
            'date_icon',
            array(
                'label'     => esc_html__('Date Icon', 'sibacom-manager'),
                'type'      => Controls_Manager::ICONS,
                'default'   => array(
                    'value'   => 'fa-regular fa-calendar',
                    'library' => 'regular',
                ),
                'condition' => array('show_meta' => 'yes', 'show_date' => 'yes'),
            )
        );

        // Row 2: Time
        $repeater->add_control(
            'show_time',
            array(
                'label'        => esc_html__('Show Time Row', 'sibacom-manager'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'sibacom-manager'),
                'label_off'    => esc_html__('No', 'sibacom-manager'),
                'return_value' => 'yes',
                'default'      => '',
                'condition'    => array('show_meta' => 'yes'),
            )
        );

        $repeater->add_control(
            'time_label',
            array(
                'label'     => esc_html__('Time Label', 'sibacom-manager'),
                'type'      => Controls_Manager::TEXT,
                'default'   => 'Time:',
                'condition' => array('show_meta' => 'yes', 'show_time' => 'yes'),
            )
        );

        $repeater->add_control(
            'event_time',
            array(
                'label'       => esc_html__('Time Value', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => '09:00 AM - 02:00 PM',
                'placeholder' => '09:00 AM - 02:00 PM',
                'condition'   => array('show_meta' => 'yes', 'show_time' => 'yes'),
                'label_block' => true,
            )
        );

        $repeater->add_control(
            'time_icon',
            array(
                'label'     => esc_html__('Time Icon', 'sibacom-manager'),
                'type'      => Controls_Manager::ICONS,
                'default'   => array(
                    'value'   => 'fa-regular fa-clock',
                    'library' => 'regular',
                ),
                'condition' => array('show_meta' => 'yes', 'show_time' => 'yes'),
            )
        );

        // Row 3: Venue
        $repeater->add_control(
            'show_venue',
            array(
                'label'        => esc_html__('Show Venue Row', 'sibacom-manager'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'sibacom-manager'),
                'label_off'    => esc_html__('No', 'sibacom-manager'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => array('show_meta' => 'yes'),
            )
        );

        $repeater->add_control(
            'venue_label',
            array(
                'label'     => esc_html__('Venue Label', 'sibacom-manager'),
                'type'      => Controls_Manager::TEXT,
                'default'   => 'Venue:',
                'condition' => array('show_meta' => 'yes', 'show_venue' => 'yes'),
            )
        );

        $repeater->add_control(
            'event_venue',
            array(
                'label'       => esc_html__('Venue Value', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'Executive Boardroom, Academic Block-III',
                'condition'   => array('show_meta' => 'yes', 'show_venue' => 'yes'),
                'label_block' => true,
            )
        );

        $repeater->add_control(
            'venue_icon',
            array(
                'label'     => esc_html__('Venue Icon', 'sibacom-manager'),
                'type'      => Controls_Manager::ICONS,
                'default'   => array(
                    'value'   => 'fa-solid fa-location-dot',
                    'library' => 'solid',
                ),
                'condition' => array('show_meta' => 'yes', 'show_venue' => 'yes'),
            )
        );

        // Row 4: Registration Closes
        $repeater->add_control(
            'show_reg_close',
            array(
                'label'        => esc_html__('Show Registration Closes Row', 'sibacom-manager'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'sibacom-manager'),
                'label_off'    => esc_html__('No', 'sibacom-manager'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => array('show_meta' => 'yes'),
            )
        );

        $repeater->add_control(
            'reg_close_label',
            array(
                'label'     => esc_html__('Registration Closes Label', 'sibacom-manager'),
                'type'      => Controls_Manager::TEXT,
                'default'   => 'Registration Closes:',
                'condition' => array('show_meta' => 'yes', 'show_reg_close' => 'yes'),
            )
        );

        $repeater->add_control(
            'event_reg_close',
            array(
                'label'       => esc_html__('Registration Closes Value', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'November 16, 2026',
                'condition'   => array('show_meta' => 'yes', 'show_reg_close' => 'yes'),
                'label_block' => true,
            )
        );

        $repeater->add_control(
            'reg_close_icon',
            array(
                'label'     => esc_html__('Closes Icon', 'sibacom-manager'),
                'type'      => Controls_Manager::ICONS,
                'default'   => array(
                    'value'   => 'fa-regular fa-hourglass-half',
                    'library' => 'regular',
                ),
                'condition' => array('show_meta' => 'yes', 'show_reg_close' => 'yes'),
            )
        );

        // Optional Extra Row 5
        $repeater->add_control(
            'show_extra_meta',
            array(
                'label'        => esc_html__('Show Custom Extra Meta Row', 'sibacom-manager'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'sibacom-manager'),
                'label_off'    => esc_html__('No', 'sibacom-manager'),
                'return_value' => 'yes',
                'default'      => '',
                'condition'    => array('show_meta' => 'yes'),
            )
        );

        $repeater->add_control(
            'extra_meta_label',
            array(
                'label'     => esc_html__('Extra Label', 'sibacom-manager'),
                'type'      => Controls_Manager::TEXT,
                'default'   => 'Team Size:',
                'condition' => array('show_meta' => 'yes', 'show_extra_meta' => 'yes'),
            )
        );

        $repeater->add_control(
            'extra_meta_value',
            array(
                'label'     => esc_html__('Extra Value', 'sibacom-manager'),
                'type'      => Controls_Manager::TEXT,
                'default'   => 'Up to 2 Members',
                'condition' => array('show_meta' => 'yes', 'show_extra_meta' => 'yes'),
            )
        );

        $repeater->add_control(
            'extra_meta_icon',
            array(
                'label'     => esc_html__('Extra Icon', 'sibacom-manager'),
                'type'      => Controls_Manager::ICONS,
                'default'   => array(
                    'value'   => 'fa-solid fa-users',
                    'library' => 'solid',
                ),
                'condition' => array('show_meta' => 'yes', 'show_extra_meta' => 'yes'),
            )
        );

        // Action Button CTA
        $repeater->add_control(
            'heading_button',
            array(
                'label'     => esc_html__('7. Action Button (Register Now)', 'sibacom-manager'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $repeater->add_control(
            'show_button',
            array(
                'label'        => esc_html__('Show Button', 'sibacom-manager'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'sibacom-manager'),
                'label_off'    => esc_html__('Hide', 'sibacom-manager'),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $repeater->add_control(
            'event_btn_text',
            array(
                'label'       => esc_html__('Button Label', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'Register Now',
                'condition'   => array('show_button' => 'yes'),
                'label_block' => true,
            )
        );

        $repeater->add_control(
            'event_url',
            array(
                'label'       => esc_html__('Registration Link URL', 'sibacom-manager'),
                'type'        => Controls_Manager::URL,
                'placeholder' => 'https://portal.sibacom.tech/',
                'default'     => array(
                    'url'         => 'https://portal.sibacom.tech/',
                    'is_external' => true,
                    'nofollow'    => false,
                ),
                'condition'   => array('show_button' => 'yes'),
            )
        );

        $repeater->add_control(
            'button_state',
            array(
                'label'     => esc_html__('Button State', 'sibacom-manager'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'active',
                'options'   => array(
                    'active'   => esc_html__('Active (Clickable Register Button)', 'sibacom-manager'),
                    'disabled' => esc_html__('Disabled / Locked (Non-clickable Button)', 'sibacom-manager'),
                ),
                'condition' => array('show_button' => 'yes'),
            )
        );

        $repeater->add_control(
            'btn_icon',
            array(
                'label'     => esc_html__('Button Icon', 'sibacom-manager'),
                'type'      => Controls_Manager::ICONS,
                'default'   => array(
                    'value'   => 'fa-solid fa-arrow-right',
                    'library' => 'solid',
                ),
                'condition' => array('show_button' => 'yes'),
            )
        );

        $repeater->add_control(
            'btn_icon_align',
            array(
                'label'     => esc_html__('Icon Position', 'sibacom-manager'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'after',
                'options'   => array(
                    'before' => esc_html__('Before Text', 'sibacom-manager'),
                    'after'  => esc_html__('After Text', 'sibacom-manager'),
                ),
                'condition' => array('show_button' => 'yes'),
            )
        );

        $repeater->add_control(
            'btn_custom_bg',
            array(
                'label'     => esc_html__('Button Custom Background', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'condition' => array('show_button' => 'yes'),
            )
        );

        $repeater->add_control(
            'btn_custom_color',
            array(
                'label'     => esc_html__('Button Custom Text Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'condition' => array('show_button' => 'yes'),
            )
        );

        // Visibility & Circuit Accent
        $repeater->add_control(
            'heading_misc',
            array(
                'label'     => esc_html__('8. Settings & Visibility', 'sibacom-manager'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $repeater->add_control(
            'event_visibility',
            array(
                'label'   => esc_html__('Card Visibility', 'sibacom-manager'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'visible',
                'options' => array(
                    'visible' => esc_html__('Visible', 'sibacom-manager'),
                    'hidden'  => esc_html__('Hidden', 'sibacom-manager'),
                ),
            )
        );

        // ADD REPEATER CONTROL WITH PRE-POPULATED CARDS (MATCHING USER'S SCREENSHOT EXACTLY)
        $this->add_control(
            'manual_events',
            array(
                'label'       => esc_html__('Event Competition Cards', 'sibacom-manager'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ event_title }}} ({{{ event_price }}})',
                'default'     => array(
                    // Card 1: Startup Showcase & Venture Pitching
                    array(
                        'event_title'              => 'Startup Showcase & Venture Pitching',
                        'title_tag'                => 'h3',
                        'event_category'           => 'Venture & Pitching',
                        'show_category'            => '',
                        'event_banner'             => array('url' => 'https://images.unsplash.com/photo-1559136555-9303baea8ebd?auto=format&fit=crop&w=800&q=80'),
                        'show_badge_1'             => 'yes',
                        'event_price'              => 'Free Registration',
                        'event_fee_type'           => 'free',
                        'show_badge_1_icon'        => 'yes',
                        'badge_1_icon'             => array('value' => 'fa-solid fa-tag', 'library' => 'solid'),
                        'show_badge_2'             => 'yes',
                        'event_status'             => 'open',
                        'event_status_custom_text' => 'REGISTRATION OPEN',
                        'show_status_dot'          => '',
                        'event_desc'               => 'Collegiate founders pitch validated software and hardware prototypes directly before accredited venture capitalists and angel networks.',
                        'show_meta'                => 'yes',
                        'show_date'                => 'yes',
                        'date_label'               => 'Date:',
                        'event_date'               => 'November 22, 2026',
                        'date_icon'                => array('value' => 'fa-regular fa-calendar', 'library' => 'regular'),
                        'show_time'                => '',
                        'time_label'               => 'Time:',
                        'event_time'               => '',
                        'show_venue'               => 'yes',
                        'venue_label'              => 'Venue:',
                        'event_venue'              => 'Executive Boardroom, Academic Block-III',
                        'venue_icon'               => array('value' => 'fa-solid fa-location-dot', 'library' => 'solid'),
                        'show_reg_close'           => 'yes',
                        'reg_close_label'          => 'Registration Closes:',
                        'event_reg_close'          => 'November 16, 2026',
                        'reg_close_icon'           => array('value' => 'fa-regular fa-hourglass-half', 'library' => 'regular'),
                        'show_button'              => 'yes',
                        'event_btn_text'           => 'Register Now',
                        'button_state'             => 'active',
                        'btn_icon'                 => array('value' => 'fa-solid fa-arrow-right', 'library' => 'solid'),
                        'btn_icon_align'           => 'after',
                        'event_url'                => array('url' => 'https://portal.sibacom.tech/', 'is_external' => true),
                        'event_visibility'         => 'visible',
                    ),
                    // Card 2: Programming Challenge
                    array(
                        'event_title'              => 'Programming Challenge',
                        'title_tag'                => 'h3',
                        'event_category'           => 'Competitive Programming',
                        'show_category'            => '',
                        'event_banner'             => array('url' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=800&q=80'),
                        'show_badge_1'             => 'yes',
                        'event_price'              => 'PKR 500/Team',
                        'event_fee_type'           => 'team',
                        'show_badge_1_icon'        => 'yes',
                        'badge_1_icon'             => array('value' => 'fa-solid fa-tag', 'library' => 'solid'),
                        'show_badge_2'             => 'yes',
                        'event_status'             => 'open',
                        'event_status_custom_text' => 'REGISTRATION OPEN',
                        'show_status_dot'          => '',
                        'event_desc'               => 'Two-round competitive coding contest on HackerRank testing data structures, algorithmic complexity, and speed. Minimum 60 minutes per round for teams up to 2.',
                        'show_meta'                => 'yes',
                        'show_date'                => 'yes',
                        'date_label'               => 'Date:',
                        'event_date'               => 'November 26, 2026 (Proposed)',
                        'date_icon'                => array('value' => 'fa-regular fa-calendar', 'library' => 'regular'),
                        'show_time'                => 'yes',
                        'time_label'               => 'Time:',
                        'event_time'               => '09:00 AM - 02:00 PM',
                        'time_icon'                => array('value' => 'fa-regular fa-clock', 'library' => 'regular'),
                        'show_venue'               => 'yes',
                        'venue_label'              => 'Venue:',
                        'event_venue'              => 'Lab-II & English Lab, Academic Block-I',
                        'venue_icon'               => array('value' => 'fa-solid fa-location-dot', 'library' => 'solid'),
                        'show_reg_close'           => 'yes',
                        'reg_close_label'          => 'Registration Closes:',
                        'event_reg_close'          => 'November 20, 2026',
                        'reg_close_icon'           => array('value' => 'fa-regular fa-hourglass-half', 'library' => 'regular'),
                        'show_button'              => 'yes',
                        'event_btn_text'           => 'Register Now',
                        'button_state'             => 'active',
                        'btn_icon'                 => array('value' => 'fa-solid fa-arrow-right', 'library' => 'solid'),
                        'btn_icon_align'           => 'after',
                        'event_url'                => array('url' => 'https://portal.sibacom.tech/', 'is_external' => true),
                        'event_visibility'         => 'visible',
                    ),
                    // Card 3: ICT Quiz Contest
                    array(
                        'event_title'              => 'ICT Quiz Contest',
                        'title_tag'                => 'h3',
                        'event_category'           => 'Information Technology',
                        'show_category'            => '',
                        'event_banner'             => array('url' => 'https://images.unsplash.com/photo-1606326608606-aa0b62935f2b?auto=format&fit=crop&w=800&q=80'),
                        'show_badge_1'             => 'yes',
                        'event_price'              => 'PKR 200/Participant',
                        'event_fee_type'           => 'paid',
                        'show_badge_1_icon'        => 'yes',
                        'badge_1_icon'             => array('value' => 'fa-solid fa-tag', 'library' => 'solid'),
                        'show_badge_2'             => 'yes',
                        'event_status'             => 'open',
                        'event_status_custom_text' => 'REGISTRATION OPEN',
                        'show_status_dot'          => '',
                        'event_desc'               => 'Fast-paced individual technology intelligence challenge spanning two 60-minute rounds. Initial screening conducted interactively on the Kahoot platform.',
                        'show_meta'                => 'yes',
                        'show_date'                => 'yes',
                        'date_label'               => 'Date:',
                        'event_date'               => 'November 26, 2026 (Proposed)',
                        'date_icon'                => array('value' => 'fa-regular fa-calendar', 'library' => 'regular'),
                        'show_time'                => 'yes',
                        'time_label'               => 'Time:',
                        'event_time'               => '11:00 AM - 01:00 PM',
                        'time_icon'                => array('value' => 'fa-regular fa-clock', 'library' => 'regular'),
                        'show_venue'               => 'yes',
                        'venue_label'              => 'Venue:',
                        'event_venue'              => 'Auditorium, Sukkur IBA University',
                        'venue_icon'               => array('value' => 'fa-solid fa-location-dot', 'library' => 'solid'),
                        'show_reg_close'           => 'yes',
                        'reg_close_label'          => 'Registration Closes:',
                        'event_reg_close'          => 'November 20, 2026',
                        'reg_close_icon'           => array('value' => 'fa-regular fa-hourglass-half', 'library' => 'regular'),
                        'show_button'              => 'yes',
                        'event_btn_text'           => 'Register Now',
                        'button_state'             => 'active',
                        'btn_icon'                 => array('value' => 'fa-solid fa-arrow-right', 'library' => 'solid'),
                        'btn_icon_align'           => 'after',
                        'event_url'                => array('url' => 'https://portal.sibacom.tech/', 'is_external' => true),
                        'event_visibility'         => 'visible',
                    ),
                    // Card 4: Robo War
                    array(
                        'event_title'              => 'Robo War',
                        'title_tag'                => 'h3',
                        'event_category'           => 'Robotics & Hardware',
                        'show_category'            => '',
                        'event_banner'             => array('url' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?auto=format&fit=crop&w=800&q=80'),
                        'show_badge_1'             => 'yes',
                        'event_price'              => 'PKR 500/Team',
                        'event_fee_type'           => 'team',
                        'show_badge_1_icon'        => 'yes',
                        'badge_1_icon'             => array('value' => 'fa-solid fa-tag', 'library' => 'solid'),
                        'show_badge_2'             => 'yes',
                        'event_status'             => 'open',
                        'event_status_custom_text' => 'REGISTRATION OPEN',
                        'show_status_dot'          => '',
                        'event_desc'               => 'Combative robotics engineering showdown. Features pre-competition hands-on robot-building workshop with Arduino introduction, equipment demonstrations, and mentor assistance.',
                        'show_meta'                => 'yes',
                        'show_date'                => 'yes',
                        'date_label'               => 'Date:',
                        'event_date'               => 'November 26, 2026 (Proposed)',
                        'date_icon'                => array('value' => 'fa-regular fa-calendar', 'library' => 'regular'),
                        'show_time'                => 'yes',
                        'time_label'               => 'Time:',
                        'event_time'               => '09:30 AM - 05:00 PM',
                        'time_icon'                => array('value' => 'fa-regular fa-clock', 'library' => 'regular'),
                        'show_venue'               => 'yes',
                        'venue_label'              => 'Venue:',
                        'event_venue'              => 'Robotics Combat Arena (Awaiting Confirmation)',
                        'venue_icon'               => array('value' => 'fa-solid fa-location-dot', 'library' => 'solid'),
                        'show_reg_close'           => 'yes',
                        'reg_close_label'          => 'Registration Closes:',
                        'event_reg_close'          => 'November 20, 2026',
                        'reg_close_icon'           => array('value' => 'fa-regular fa-hourglass-half', 'library' => 'regular'),
                        'show_button'              => 'yes',
                        'event_btn_text'           => 'Register Now',
                        'button_state'             => 'active',
                        'btn_icon'                 => array('value' => 'fa-solid fa-arrow-right', 'library' => 'solid'),
                        'btn_icon_align'           => 'after',
                        'event_url'                => array('url' => 'https://portal.sibacom.tech/', 'is_external' => true),
                        'event_visibility'         => 'visible',
                    ),
                    // Card 5: Drone Competition
                    array(
                        'event_title'              => 'Drone Competition',
                        'title_tag'                => 'h3',
                        'event_category'           => 'Aviation & Robotics',
                        'show_category'            => '',
                        'event_banner'             => array('url' => 'https://images.unsplash.com/photo-1508614589041-895b88991e3e?auto=format&fit=crop&w=800&q=80'),
                        'show_badge_1'             => 'yes',
                        'event_price'              => 'PKR 500/Team',
                        'event_fee_type'           => 'team',
                        'show_badge_1_icon'        => 'yes',
                        'badge_1_icon'             => array('value' => 'fa-solid fa-tag', 'library' => 'solid'),
                        'show_badge_2'             => 'yes',
                        'event_status'             => 'open',
                        'event_status_custom_text' => 'REGISTRATION OPEN',
                        'show_status_dot'          => '',
                        'event_desc'               => 'Precision aerial flight and agility competition. Preceded by an intensive drone-building and piloting workshop covering components, assembly, telemetry, and safe flight protocols.',
                        'show_meta'                => 'yes',
                        'show_date'                => 'yes',
                        'date_label'               => 'Date:',
                        'event_date'               => 'November 26, 2026 (Proposed)',
                        'date_icon'                => array('value' => 'fa-regular fa-calendar', 'library' => 'regular'),
                        'show_time'                => 'yes',
                        'time_label'               => 'Time:',
                        'event_time'               => '10:00 AM - 04:00 PM',
                        'time_icon'                => array('value' => 'fa-regular fa-clock', 'library' => 'regular'),
                        'show_venue'               => 'yes',
                        'venue_label'              => 'Venue:',
                        'event_venue'              => 'Outdoor Flight Arena (Awaiting Confirmation)',
                        'venue_icon'               => array('value' => 'fa-solid fa-location-dot', 'library' => 'solid'),
                        'show_reg_close'           => 'yes',
                        'reg_close_label'          => 'Registration Closes:',
                        'event_reg_close'          => 'November 20, 2026',
                        'reg_close_icon'           => array('value' => 'fa-regular fa-hourglass-half', 'library' => 'regular'),
                        'show_button'              => 'yes',
                        'event_btn_text'           => 'Register Now',
                        'button_state'             => 'active',
                        'btn_icon'                 => array('value' => 'fa-solid fa-arrow-right', 'library' => 'solid'),
                        'btn_icon_align'           => 'after',
                        'event_url'                => array('url' => 'https://portal.sibacom.tech/', 'is_external' => true),
                        'event_visibility'         => 'visible',
                    ),
                    // Card 6: Line Following Robot (LFR)
                    array(
                        'event_title'              => 'Line Following Robot (LFR)',
                        'title_tag'                => 'h3',
                        'event_category'           => 'Hardware & Sensors',
                        'show_category'            => '',
                        'event_banner'             => array('url' => 'https://images.unsplash.com/photo-1561557944-6e7860d1a7eb?auto=format&fit=crop&w=800&q=80'),
                        'show_badge_1'             => 'yes',
                        'event_price'              => 'PKR 500/Team',
                        'event_fee_type'           => 'team',
                        'show_badge_1_icon'        => 'yes',
                        'badge_1_icon'             => array('value' => 'fa-solid fa-tag', 'library' => 'solid'),
                        'show_badge_2'             => 'yes',
                        'event_status'             => 'open',
                        'event_status_custom_text' => 'REGISTRATION OPEN',
                        'show_status_dot'          => '',
                        'event_desc'               => 'Autonomous robotics tracking challenge. Features an intensive workshop covering Arduino, IR sensor calibration, motor drivers, and closed-loop control algorithms.',
                        'show_meta'                => 'yes',
                        'show_date'                => 'yes',
                        'date_label'               => 'Date:',
                        'event_date'               => 'November 26, 2026 (Proposed)',
                        'date_icon'                => array('value' => 'fa-regular fa-calendar', 'library' => 'regular'),
                        'show_time'                => 'yes',
                        'time_label'               => 'Time:',
                        'event_time'               => '09:00 AM - 03:00 PM',
                        'time_icon'                => array('value' => 'fa-regular fa-clock', 'library' => 'regular'),
                        'show_venue'               => 'yes',
                        'venue_label'              => 'Venue:',
                        'event_venue'              => 'Robotics Track Arena (Awaiting Confirmation)',
                        'venue_icon'               => array('value' => 'fa-solid fa-location-dot', 'library' => 'solid'),
                        'show_reg_close'           => 'yes',
                        'reg_close_label'          => 'Registration Closes:',
                        'event_reg_close'          => 'November 20, 2026',
                        'reg_close_icon'           => array('value' => 'fa-regular fa-hourglass-half', 'library' => 'regular'),
                        'show_button'              => 'yes',
                        'event_btn_text'           => 'Register Now',
                        'button_state'             => 'active',
                        'btn_icon'                 => array('value' => 'fa-solid fa-arrow-right', 'library' => 'solid'),
                        'btn_icon_align'           => 'after',
                        'event_url'                => array('url' => 'https://portal.sibacom.tech/', 'is_external' => true),
                        'event_visibility'         => 'visible',
                    ),
                    // Card 7: Project Exhibition
                    array(
                        'event_title'              => 'Project Exhibition (Hardware & Software)',
                        'title_tag'                => 'h3',
                        'event_category'           => 'Innovation Showcase',
                        'show_category'            => '',
                        'event_banner'             => array('url' => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=800&q=80'),
                        'show_badge_1'             => 'yes',
                        'event_price'              => 'PKR 500/Team',
                        'event_fee_type'           => 'team',
                        'show_badge_1_icon'        => 'yes',
                        'badge_1_icon'             => array('value' => 'fa-solid fa-tag', 'library' => 'solid'),
                        'show_badge_2'             => 'yes',
                        'event_status'             => 'open',
                        'event_status_custom_text' => 'REGISTRATION OPEN',
                        'show_status_dot'          => '',
                        'event_desc'               => 'Comprehensive project showcase in Medical, Climate, Agriculture, and General themes with Junior and Senior cohorts and separate hardware and software prize tracks.',
                        'show_meta'                => 'yes',
                        'show_date'                => 'yes',
                        'date_label'               => 'Date:',
                        'event_date'               => 'November 26, 2026 (Proposed)',
                        'date_icon'                => array('value' => 'fa-regular fa-calendar', 'library' => 'regular'),
                        'show_time'                => 'yes',
                        'time_label'               => 'Time:',
                        'event_time'               => '09:30 AM - 04:30 PM',
                        'time_icon'                => array('value' => 'fa-regular fa-clock', 'library' => 'regular'),
                        'show_venue'               => 'yes',
                        'venue_label'              => 'Venue:',
                        'event_venue'              => 'VFX Lab, FYP Lab & Fab Lab',
                        'venue_icon'               => array('value' => 'fa-solid fa-location-dot', 'library' => 'solid'),
                        'show_reg_close'           => 'yes',
                        'reg_close_label'          => 'Registration Closes:',
                        'event_reg_close'          => 'November 20, 2026',
                        'reg_close_icon'           => array('value' => 'fa-regular fa-hourglass-half', 'library' => 'regular'),
                        'show_button'              => 'yes',
                        'event_btn_text'           => 'Register Now',
                        'button_state'             => 'active',
                        'btn_icon'                 => array('value' => 'fa-solid fa-arrow-right', 'library' => 'solid'),
                        'btn_icon_align'           => 'after',
                        'event_url'                => array('url' => 'https://portal.sibacom.tech/', 'is_external' => true),
                        'event_visibility'         => 'visible',
                    ),
                ),
            )
        );

        $this->end_controls_section();

        // =========================================================================
        // STYLE TAB: Card Container Styling
        // =========================================================================
        $this->start_controls_section(
            'section_style_cards',
            array(
                'label' => esc_html__('Card & Neumorphism Styling', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'card_bg',
            array(
                'label'     => esc_html__('Card Background Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FFFFFF',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-event-card' => 'background-color: {{VALUE}};',
                ),
            )
        );

        $this->add_responsive_control(
            'card_radius',
            array(
                'label'      => esc_html__('Card Border Radius', 'sibacom-manager'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'rem', '%'),
                'range'      => array(
                    'px' => array('min' => 0, 'max' => 50),
                ),
                'default'    => array('unit' => 'px', 'size' => 24),
                'selectors'  => array(
                    '{{WRAPPER}} .sibacom-event-card' => 'border-radius: {{SIZE}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'card_body_padding',
            array(
                'label'      => esc_html__('Card Body Padding', 'sibacom-manager'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'em', 'rem'),
                'selectors'  => array(
                    '{{WRAPPER}} .sibacom-event-card-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'     => 'card_border',
                'label'    => esc_html__('Card Border', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .sibacom-event-card',
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'card_box_shadow',
                'label'    => esc_html__('Card Box Shadow (Normal)', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .sibacom-event-card',
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'card_box_shadow_hover',
                'label'    => esc_html__('Card Box Shadow (Hover)', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .sibacom-event-card:hover',
            )
        );

        $this->add_control(
            'card_hover_lift',
            array(
                'label'      => esc_html__('Hover Lift Y-Offset', 'sibacom-manager'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => array(
                    'px' => array('min' => -20, 'max' => 0),
                ),
                'default'    => array('unit' => 'px', 'size' => -8),
                'selectors'  => array(
                    '{{WRAPPER}} .sibacom-event-card:hover' => 'transform: translateY({{SIZE}}{{UNIT}});',
                ),
            )
        );

        $this->end_controls_section();

        // =========================================================================
        // STYLE TAB: Banner Media Image
        // =========================================================================
        $this->start_controls_section(
            'section_style_media',
            array(
                'label' => esc_html__('Banner Image Media', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_responsive_control(
            'media_height',
            array(
                'label'      => esc_html__('Image Height', 'sibacom-manager'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'vh'),
                'range'      => array(
                    'px' => array('min' => 120, 'max' => 450),
                ),
                'default'    => array('unit' => 'px', 'size' => 200),
                'selectors'  => array(
                    '{{WRAPPER}} .sibacom-event-banner, {{WRAPPER}} .sibacom-event-card-media' => 'height: {{SIZE}}{{UNIT}};',
                ),
            )
        );

        $this->add_control(
            'image_hover_zoom',
            array(
                'label'        => esc_html__('Image Zoom on Hover', 'sibacom-manager'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'sibacom-manager'),
                'label_off'    => esc_html__('No', 'sibacom-manager'),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->end_controls_section();

        // =========================================================================
        // STYLE TAB: Badges (Price Badge & Status Badge)
        // =========================================================================
        $this->start_controls_section(
            'section_style_badges',
            array(
                'label' => esc_html__('Badges Styling (Price & Status)', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'badge_typography',
                'label'    => esc_html__('Badge Typography', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .sibacom-price-badge, {{WRAPPER}} .sibacom-status-badge',
            )
        );

        $this->add_responsive_control(
            'badge_radius',
            array(
                'label'      => esc_html__('Badge Border Radius', 'sibacom-manager'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'rem'),
                'default'    => array('unit' => 'px', 'size' => 999),
                'selectors'  => array(
                    '{{WRAPPER}} .sibacom-price-badge, {{WRAPPER}} .sibacom-status-badge' => 'border-radius: {{SIZE}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'badge_padding',
            array(
                'label'      => esc_html__('Badge Padding', 'sibacom-manager'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'rem', 'em'),
                'selectors'  => array(
                    '{{WRAPPER}} .sibacom-price-badge, {{WRAPPER}} .sibacom-status-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        // Price Badge Colors
        $this->add_control(
            'heading_style_price_badge',
            array(
                'label'     => esc_html__('Price Badge (Badge 1) Global Colors', 'sibacom-manager'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $this->add_control(
            'badge_free_bg',
            array(
                'label'     => esc_html__('Free Badge Background', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => 'rgba(7, 155, 88, 0.92)',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-price-badge.price-free' => 'background: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'badge_paid_bg',
            array(
                'label'     => esc_html__('Paid/Team Badge Background', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#102E68',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-price-badge:not(.price-free)' => 'background: {{VALUE}};',
                ),
            )
        );

        // Status Badge Colors
        $this->add_control(
            'heading_style_status_badge',
            array(
                'label'     => esc_html__('Status Badge (Badge 2) Global Colors', 'sibacom-manager'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $this->add_control(
            'status_open_bg',
            array(
                'label'     => esc_html__('Registration Open Background', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#E8F8F0',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-status-badge.status-open' => 'background: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'status_open_color',
            array(
                'label'     => esc_html__('Registration Open Text Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#079B58',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-status-badge.status-open' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'status_closing_bg',
            array(
                'label'     => esc_html__('Closing Soon Background', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FFF8E6',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-status-badge.status-closing' => 'background: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'status_closing_color',
            array(
                'label'     => esc_html__('Closing Soon Text Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#D97706',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-status-badge.status-closing' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_section();

        // =========================================================================
        // STYLE TAB: Title & Description
        // =========================================================================
        $this->start_controls_section(
            'section_style_typography',
            array(
                'label' => esc_html__('Title & Description', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'title_typography',
                'label'    => esc_html__('Title Typography', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .sibacom-event-card-title',
            )
        );

        $this->add_control(
            'title_color',
            array(
                'label'     => esc_html__('Title Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#17233D',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-event-card-title' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_responsive_control(
            'title_margin_bottom',
            array(
                'label'      => esc_html__('Title Margin Bottom', 'sibacom-manager'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'rem'),
                'default'    => array('unit' => 'px', 'size' => 12),
                'selectors'  => array(
                    '{{WRAPPER}} .sibacom-event-card-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'desc_typography',
                'label'    => esc_html__('Description Typography', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .sibacom-event-card-desc, {{WRAPPER}} .sibacom-event-card-desc p',
            )
        );

        $this->add_control(
            'desc_color',
            array(
                'label'     => esc_html__('Description Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#64748B',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-event-card-desc, {{WRAPPER}} .sibacom-event-card-desc p' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_responsive_control(
            'desc_margin_bottom',
            array(
                'label'      => esc_html__('Description Margin Bottom', 'sibacom-manager'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'rem'),
                'default'    => array('unit' => 'px', 'size' => 18),
                'selectors'  => array(
                    '{{WRAPPER}} .sibacom-event-card-desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ),
            )
        );

        $this->end_controls_section();

        // =========================================================================
        // STYLE TAB: Meta Details (Date, Venue, Closes)
        // =========================================================================
        $this->start_controls_section(
            'section_style_meta',
            array(
                'label' => esc_html__('Meta Details List', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'meta_typography',
                'label'    => esc_html__('Meta Typography', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .sibacom-event-meta-row',
            )
        );

        $this->add_control(
            'meta_text_color',
            array(
                'label'     => esc_html__('Meta Text Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#334155',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-event-meta-row' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'meta_label_color',
            array(
                'label'     => esc_html__('Meta Bold Label Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#0F172A',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-event-meta-row strong' => 'color: {{VALUE}}; font-weight: 700;',
                ),
            )
        );

        $this->add_control(
            'meta_date_icon_color',
            array(
                'label'     => esc_html__('Date Icon Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#173F91',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-event-meta-row.meta-date .meta-icon, {{WRAPPER}} .sibacom-event-meta-row.meta-date i' => 'color: {{VALUE}} !important;',
                ),
            )
        );

        $this->add_control(
            'meta_time_icon_color',
            array(
                'label'     => esc_html__('Time Icon Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#079B58',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-event-meta-row.meta-time .meta-icon, {{WRAPPER}} .sibacom-event-meta-row.meta-time i' => 'color: {{VALUE}} !important;',
                ),
            )
        );

        $this->add_control(
            'meta_venue_icon_color',
            array(
                'label'     => esc_html__('Venue Icon Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#079B58',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-event-meta-row.meta-venue .meta-icon, {{WRAPPER}} .sibacom-event-meta-row.meta-venue i' => 'color: {{VALUE}} !important;',
                ),
            )
        );

        $this->add_control(
            'meta_close_icon_color',
            array(
                'label'     => esc_html__('Registration Closes Icon Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#D97706',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-event-meta-row.meta-reg-close .meta-icon, {{WRAPPER}} .sibacom-event-meta-row.meta-reg-close i' => 'color: {{VALUE}} !important;',
                ),
            )
        );

        $this->add_responsive_control(
            'meta_row_spacing',
            array(
                'label'      => esc_html__('Row Spacing / Gap', 'sibacom-manager'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'rem'),
                'default'    => array('unit' => 'px', 'size' => 10),
                'selectors'  => array(
                    '{{WRAPPER}} .sibacom-event-meta-list' => 'gap: {{SIZE}}{{UNIT}};',
                ),
            )
        );

        $this->end_controls_section();

        // =========================================================================
        // STYLE TAB: Registration Button
        // =========================================================================
        $this->start_controls_section(
            'section_style_button',
            array(
                'label' => esc_html__('Registration Button Styling', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'btn_typography',
                'label'    => esc_html__('Button Typography', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .sibacom-btn-primary, {{WRAPPER}} .sibacom-btn-disabled',
            )
        );

        $this->start_controls_tabs('tabs_button_style');

        $this->start_controls_tab(
            'tab_button_normal',
            array(
                'label' => esc_html__('Normal', 'sibacom-manager'),
            )
        );

        $this->add_control(
            'btn_bg',
            array(
                'label'     => esc_html__('Button Background', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#173F91',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-btn-primary' => 'background: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'btn_text_color',
            array(
                'label'     => esc_html__('Button Text Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FFFFFF',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-btn-primary' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'btn_box_shadow',
                'label'    => esc_html__('Button Shadow', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .sibacom-btn-primary',
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            array(
                'label' => esc_html__('Hover', 'sibacom-manager'),
            )
        );

        $this->add_control(
            'btn_hover_bg',
            array(
                'label'     => esc_html__('Hover Background', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#102E68',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-btn-primary:hover' => 'background: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'btn_hover_text_color',
            array(
                'label'     => esc_html__('Hover Text Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FFFFFF',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-btn-primary:hover' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'btn_hover_box_shadow',
                'label'    => esc_html__('Hover Button Shadow', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .sibacom-btn-primary:hover',
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'btn_radius',
            array(
                'label'      => esc_html__('Button Border Radius', 'sibacom-manager'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'rem'),
                'default'    => array('unit' => 'px', 'size' => 10),
                'selectors'  => array(
                    '{{WRAPPER}} .sibacom-btn-primary, {{WRAPPER}} .sibacom-btn-disabled' => 'border-radius: {{SIZE}}{{UNIT}};',
                ),
                'separator'  => 'before',
            )
        );

        $this->add_responsive_control(
            'btn_padding',
            array(
                'label'      => esc_html__('Button Padding', 'sibacom-manager'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'rem', 'em'),
                'selectors'  => array(
                    '{{WRAPPER}} .sibacom-btn-primary, {{WRAPPER}} .sibacom-btn-disabled' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->end_controls_section();

        // =========================================================================
        // STYLE TAB: Circuit Accents
        // =========================================================================
        $this->start_controls_section(
            'section_style_card_circuits',
            array(
                'label' => esc_html__('Card Circuit Accents & Hover Signals', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'enable_card_circuits',
            array(
                'label'        => esc_html__('Enable Circuit Corner Accents', 'sibacom-manager'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'sibacom-manager'),
                'label_off'    => esc_html__('No', 'sibacom-manager'),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->add_control(
            'card_circuit_color',
            array(
                'label'     => esc_html__('Circuit Corner Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => 'rgba(23, 63, 145, 0.22)',
                'selectors' => array(
                    '{{WRAPPER}}' => '--sibacom-circuit-trace: {{VALUE}};',
                ),
                'condition' => array('enable_card_circuits' => 'yes'),
            )
        );

        $this->add_control(
            'card_pulse_color',
            array(
                'label'     => esc_html__('Hover Signal Accent Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#079B58',
                'selectors' => array(
                    '{{WRAPPER}}' => '--sibacom-circuit-techgreen: {{VALUE}};',
                ),
                'condition' => array('enable_card_circuits' => 'yes'),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $mode     = !empty($settings['data_mode']) ? $settings['data_mode'] : 'manual';
        $cols     = !empty($settings['columns']) ? $settings['columns'] : '3';
        $limit    = !empty($settings['limit']) ? $settings['limit'] : -1;
        $featured = !empty($settings['featured_only']) ? 'yes' : '';

        if ($mode === 'dynamic') {
            if (class_exists('SIBACOM_Shortcodes')) {
                echo SIBACOM_Shortcodes::render_events(array(
                    'limit'    => $limit,
                    'featured' => $featured,
                    'columns'  => $cols,
                ));
            }
        } else {
            // Render manual repeater items
            $events = !empty($settings['manual_events']) ? $settings['manual_events'] : array();
            $show_circuits = (!isset($settings['enable_card_circuits']) || $settings['enable_card_circuits'] !== 'no');
            ?>
            <style>
                /* Widget scoped styling for seamless Elementor preview & frontend */
                .sibacom-events-grid {
                    display: grid;
                    grid-template-columns: repeat(<?php echo esc_attr($cols); ?>, minmax(0, 1fr));
                    gap: 2rem;
                    margin-bottom: 2.5rem;
                    width: 100%;
                }
                .sibacom-event-card {
                    background: #ffffff;
                    border-radius: 24px;
                    border: 1px solid rgba(23, 63, 145, 0.12);
                    box-shadow: 0 10px 30px rgba(16, 46, 104, 0.08);
                    overflow: hidden;
                    display: flex;
                    flex-direction: column;
                    transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.35s ease, border-color 0.35s ease;
                    position: relative;
                }
                .sibacom-event-card:hover {
                    transform: translateY(-8px);
                    box-shadow: 0 20px 40px rgba(16, 46, 104, 0.15);
                    border-color: rgba(7, 155, 88, 0.35);
                }
                .sibacom-event-banner {
                    position: relative;
                    width: 100%;
                    height: 200px;
                    overflow: hidden;
                    background: linear-gradient(135deg, #102E68 0%, #173F91 100%);
                }
                .sibacom-event-banner img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    display: block;
                    transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
                }
                <?php if (!empty($settings['image_hover_zoom']) && $settings['image_hover_zoom'] === 'yes') : ?>
                .sibacom-event-card:hover .sibacom-event-banner img {
                    transform: scale(1.08);
                }
                <?php endif; ?>
                .sibacom-event-badges-bar {
                    position: absolute;
                    top: 1rem;
                    left: 1rem;
                    right: 1rem;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    gap: 0.5rem;
                    z-index: 3;
                    pointer-events: none;
                }
                .sibacom-price-badge {
                    display: inline-flex;
                    align-items: center;
                    gap: 0.4rem;
                    padding: 0.38rem 0.9rem;
                    border-radius: 999px;
                    font-size: 0.76rem;
                    font-weight: 700;
                    letter-spacing: 0.03em;
                    box-shadow: 0 4px 12px rgba(16, 46, 104, 0.25);
                    border: 1px solid rgba(255, 255, 255, 0.28);
                    color: #ffffff;
                    background: #102E68;
                    white-space: nowrap;
                }
                .sibacom-price-badge.price-free {
                    background: rgba(7, 155, 88, 0.94);
                    border-color: rgba(255, 255, 255, 0.35);
                }
                .sibacom-status-badge {
                    display: inline-flex;
                    align-items: center;
                    gap: 0.4rem;
                    padding: 0.38rem 0.9rem;
                    border-radius: 999px;
                    font-size: 0.72rem;
                    font-weight: 700;
                    text-transform: uppercase;
                    letter-spacing: 0.05em;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
                    white-space: nowrap;
                }
                .sibacom-status-badge .status-indicator {
                    width: 7px;
                    height: 7px;
                    border-radius: 50%;
                    background-color: currentColor;
                    display: inline-block;
                }
                .sibacom-status-badge.status-open {
                    background: #E8F8F0;
                    color: #079B58;
                    border: 1px solid rgba(7, 155, 88, 0.32);
                }
                .sibacom-status-badge.status-closing {
                    background: #FFF8E6;
                    color: #D97706;
                    border: 1px solid rgba(217, 119, 6, 0.32);
                }
                .sibacom-status-badge.status-closed {
                    background: #FEE2E2;
                    color: #DC2626;
                    border: 1px solid rgba(220, 38, 38, 0.32);
                }
                .sibacom-status-badge.status-upcoming {
                    background: #EFF6FF;
                    color: #173F91;
                    border: 1px solid rgba(23, 63, 145, 0.32);
                }
                .sibacom-status-badge.status-full {
                    background: #F1F5F9;
                    color: #64748B;
                    border: 1px solid rgba(100, 116, 139, 0.32);
                }
                .sibacom-event-card-body {
                    padding: 1.65rem 1.75rem;
                    display: flex;
                    flex-direction: column;
                    flex-grow: 1;
                }
                .sibacom-event-card-title {
                    font-family: inherit;
                    font-size: 1.35rem;
                    font-weight: 700;
                    color: #17233D;
                    margin: 0 0 0.75rem 0;
                    line-height: 1.3;
                }
                .sibacom-event-card-desc {
                    font-size: 0.92rem;
                    color: #64748B;
                    line-height: 1.62;
                    margin-bottom: 1.25rem;
                    flex-grow: 1;
                }
                .sibacom-event-card-desc p {
                    margin: 0;
                }
                .sibacom-event-meta-list {
                    display: flex;
                    flex-direction: column;
                    gap: 0.55rem;
                    padding: 0.95rem 0;
                    border-top: 1px solid rgba(23, 63, 145, 0.08);
                    border-bottom: 1px solid rgba(23, 63, 145, 0.08);
                    margin-bottom: 1.35rem;
                    font-size: 0.86rem;
                    color: #334155;
                }
                .sibacom-event-meta-row {
                    display: flex;
                    align-items: center;
                    gap: 0.65rem;
                }
                .sibacom-event-meta-row .meta-icon {
                    width: 18px;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 0.95rem;
                    flex-shrink: 0;
                }
                .sibacom-event-meta-row strong {
                    font-weight: 700;
                    color: #0F172A;
                }
                .sibacom-event-card-footer {
                    margin-top: auto;
                }
                .sibacom-btn {
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    gap: 0.55rem;
                    padding: 0.82rem 1.4rem;
                    border-radius: 10px;
                    font-weight: 700;
                    font-size: 0.92rem;
                    text-decoration: none;
                    transition: all 0.28s ease;
                    border: none;
                    cursor: pointer;
                    width: 100%;
                    box-sizing: border-box;
                }
                .sibacom-btn-primary {
                    background: #173F91;
                    color: #ffffff !important;
                    box-shadow: 0 4px 14px rgba(23, 63, 145, 0.32);
                }
                .sibacom-btn-primary:hover {
                    background: #102E68;
                    color: #ffffff !important;
                    transform: translateY(-2px);
                    box-shadow: 0 8px 20px rgba(16, 46, 104, 0.42);
                }
                .sibacom-btn-disabled {
                    background: #E2E8F0;
                    color: #94A3B8 !important;
                    cursor: not-allowed;
                    box-shadow: none;
                }
                .sibacom-circuit-corner {
                    position: absolute;
                    width: 38px;
                    height: 38px;
                    pointer-events: none;
                    z-index: 4;
                    color: var(--sibacom-circuit-trace, rgba(23, 63, 145, 0.22));
                }
                .sibacom-circuit-corner.corner-tl { top: 0; left: 0; }
                .sibacom-circuit-corner.corner-br { bottom: 0; right: 0; }
                .sibacom-circuit-corner svg { width: 100%; height: 100%; }
                .sibacom-circuit-corner .corner-line { stroke: currentColor; stroke-width: 1.5; fill: none; }
                .sibacom-circuit-corner .corner-via { fill: currentColor; }
                .sibacom-event-card:hover .sibacom-circuit-corner {
                    color: var(--sibacom-circuit-techgreen, #079B58);
                }
            </style>

            <div class="sibacom-events-grid col-<?php echo esc_attr($cols); ?>">
                <?php 
                foreach ($events as $index => $item) : 
                    if (!empty($item['event_visibility']) && $item['event_visibility'] === 'hidden') {
                        continue;
                    }

                    // Banner image
                    $banner_url = !empty($item['event_banner']['url']) ? $item['event_banner']['url'] : '';
                    if (empty($banner_url) && !empty($item['event_banner_custom_url'])) {
                        $banner_url = $item['event_banner_custom_url'];
                    }
                    if (empty($banner_url)) {
                        $banner_url = 'https://images.unsplash.com/photo-1559136555-9303baea8ebd?auto=format&fit=crop&w=800&q=80';
                    }

                    $banner_alt = !empty($item['event_banner_alt']) ? $item['event_banner_alt'] : (!empty($item['event_title']) ? $item['event_title'] : 'SIBACOM Event');

                    // Badge 1 (Price)
                    $show_badge_1      = (!isset($item['show_badge_1']) || $item['show_badge_1'] === 'yes');
                    $fee_type          = !empty($item['event_fee_type']) ? $item['event_fee_type'] : 'free';
                    $badge_1_text      = !empty($item['event_price']) ? $item['event_price'] : 'Free Registration';
                    $show_badge_1_icon = (!isset($item['show_badge_1_icon']) || $item['show_badge_1_icon'] === 'yes');

                    $badge_1_style = '';
                    if (!empty($item['badge_1_bg_color'])) {
                        $badge_1_style .= 'background: ' . esc_attr($item['badge_1_bg_color']) . ' !important;';
                    }
                    if (!empty($item['badge_1_text_color'])) {
                        $badge_1_style .= 'color: ' . esc_attr($item['badge_1_text_color']) . ' !important;';
                    }

                    // Badge 2 (Status)
                    $show_badge_2    = (!isset($item['show_badge_2']) || $item['show_badge_2'] === 'yes');
                    $status_key      = !empty($item['event_status']) ? $item['event_status'] : 'open';
                    $show_status_dot = (!empty($item['show_status_dot']) && $item['show_status_dot'] === 'yes');

                    // Status Class & Default Label
                    switch ($status_key) {
                        case 'closing_soon':
                            $default_status_label = 'CLOSING SOON';
                            $status_cls = 'status-closing';
                            break;
                        case 'not_open':
                            $default_status_label = 'COMING SOON';
                            $status_cls = 'status-upcoming';
                            break;
                        case 'closed':
                            $default_status_label = 'REGISTRATION CLOSED';
                            $status_cls = 'status-closed';
                            break;
                        case 'full':
                            $default_status_label = 'FULLY BOOKED';
                            $status_cls = 'status-full';
                            break;
                        case 'custom':
                            $default_status_label = 'REGISTRATION OPEN';
                            $status_cls = 'status-custom';
                            break;
                        case 'open':
                        default:
                            $default_status_label = 'REGISTRATION OPEN';
                            $status_cls = 'status-open';
                            break;
                    }

                    $badge_2_text = !empty($item['event_status_custom_text']) ? $item['event_status_custom_text'] : $default_status_label;

                    $badge_2_style = '';
                    if (!empty($item['badge_2_bg_color'])) {
                        $badge_2_style .= 'background: ' . esc_attr($item['badge_2_bg_color']) . ' !important;';
                    }
                    if (!empty($item['badge_2_text_color'])) {
                        $badge_2_style .= 'color: ' . esc_attr($item['badge_2_text_color']) . ' !important;';
                    }

                    $dot_style = '';
                    if (!empty($item['badge_2_dot_color'])) {
                        $dot_style = 'background-color: ' . esc_attr($item['badge_2_dot_color']) . ' !important;';
                    }

                    // Category
                    $show_category = (!empty($item['show_category']) && $item['show_category'] === 'yes');

                    // Title tag
                    $title_tag = !empty($item['title_tag']) ? $item['title_tag'] : 'h3';

                    // Meta
                    $show_meta      = (!isset($item['show_meta']) || $item['show_meta'] === 'yes');
                    $show_date      = (!isset($item['show_date']) || $item['show_date'] === 'yes') && !empty($item['event_date']);
                    $show_time      = (!empty($item['show_time']) && $item['show_time'] === 'yes');
                    $time_val       = !empty($item['event_time']) ? $item['event_time'] : (!empty($item['event_start_time']) ? trim($item['event_start_time'] . ' - ' . (!empty($item['event_end_time']) ? $item['event_end_time'] : ''), ' -') : '');
                    $show_venue     = (!isset($item['show_venue']) || $item['show_venue'] === 'yes') && !empty($item['event_venue']);
                    $show_reg_close = (!isset($item['show_reg_close']) || $item['show_reg_close'] === 'yes') && !empty($item['event_reg_close']);
                    $show_extra     = (!empty($item['show_extra_meta']) && $item['show_extra_meta'] === 'yes') && !empty($item['extra_meta_value']);

                    // Button
                    $show_button    = (!isset($item['show_button']) || $item['show_button'] === 'yes');
                    $btn_state      = !empty($item['button_state']) ? $item['button_state'] : 'active';
                    $btn_text       = !empty($item['event_btn_text']) ? $item['event_btn_text'] : 'Register Now';
                    $btn_align      = !empty($item['btn_icon_align']) ? $item['btn_icon_align'] : 'after';

                    $btn_style = '';
                    if (!empty($item['btn_custom_bg'])) {
                        $btn_style .= 'background: ' . esc_attr($item['btn_custom_bg']) . ' !important;';
                    }
                    if (!empty($item['btn_custom_color'])) {
                        $btn_style .= 'color: ' . esc_attr($item['btn_custom_color']) . ' !important;';
                    }

                    // Link attributes
                    $btn_link_key = 'event_btn_link_' . $index;
                    if (!empty($item['event_url']['url'])) {
                        $this->add_link_attributes($btn_link_key, $item['event_url']);
                    } else {
                        $this->add_render_attribute($btn_link_key, 'href', 'https://portal.sibacom.tech/');
                        $this->add_render_attribute($btn_link_key, 'target', '_blank');
                        $this->add_render_attribute($btn_link_key, 'rel', 'noopener noreferrer');
                    }
                    $this->add_render_attribute($btn_link_key, 'class', 'sibacom-btn sibacom-btn-primary sibacom-btn-full');
                    ?>
                    <div class="sibacom-event-card neu-card sibacom-card-circuit">
                        <?php if ($show_circuits) : ?>
                            <?php if (function_exists('sibacom_the_circuit_corner')) : ?>
                                <?php sibacom_the_circuit_corner('tl'); ?>
                                <?php sibacom_the_circuit_corner('br'); ?>
                            <?php else : ?>
                                <div class="sibacom-circuit-corner corner-tl" aria-hidden="true">
                                    <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M 2 26 L 2 12 L 12 2 L 26 2" class="corner-line" />
                                        <circle cx="26" cy="2" r="2" class="corner-via" />
                                        <circle cx="2" cy="26" r="2" class="corner-via" />
                                    </svg>
                                </div>
                                <div class="sibacom-circuit-corner corner-br" aria-hidden="true">
                                    <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M 46 22 L 46 36 L 36 46 L 22 46" class="corner-line" />
                                        <circle cx="22" cy="46" r="2" class="corner-via" />
                                        <circle cx="46" cy="22" r="2" class="corner-via" />
                                    </svg>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <!-- Banner Image Container with Badges -->
                        <div class="sibacom-event-banner sibacom-event-card-media">
                            <img src="<?php echo esc_url($banner_url); ?>" alt="<?php echo esc_attr($banner_alt); ?>" width="600" height="338" loading="lazy" decoding="async" />
                            
                            <?php if ($show_badge_1 || $show_badge_2) : ?>
                                <div class="sibacom-event-badges-bar sibacom-event-badges">
                                    <?php if ($show_badge_1) : ?>
                                        <span class="sibacom-price-badge price-<?php echo esc_attr($fee_type); ?>" <?php if (!empty($badge_1_style)) : ?>style="<?php echo esc_attr($badge_1_style); ?>"<?php endif; ?>>
                                            <?php if ($show_badge_1_icon) : ?>
                                                <?php if (!empty($item['badge_1_icon']['value'])) : ?>
                                                    <?php Icons_Manager::render_icon($item['badge_1_icon'], array('aria-hidden' => 'true')); ?>
                                                <?php else : ?>
                                                    <i class="fa-solid fa-tag" aria-hidden="true"></i>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <span><?php echo esc_html($badge_1_text); ?></span>
                                        </span>
                                    <?php else : ?>
                                        <span></span>
                                    <?php endif; ?>

                                    <?php if ($show_badge_2) : ?>
                                        <span class="sibacom-status-badge <?php echo esc_attr($status_cls); ?>" <?php if (!empty($badge_2_style)) : ?>style="<?php echo esc_attr($badge_2_style); ?>"<?php endif; ?>>
                                            <?php if ($show_status_dot) : ?>
                                                <span class="status-indicator" <?php if (!empty($dot_style)) : ?>style="<?php echo esc_attr($dot_style); ?>"<?php endif; ?>></span>
                                            <?php endif; ?>
                                            <span><?php echo esc_html($badge_2_text); ?></span>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Card Body -->
                        <div class="sibacom-event-card-body">
                            <?php if ($show_category && !empty($item['event_category'])) : ?>
                                <div style="margin-bottom: 0.45rem;">
                                    <span style="display: inline-block; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--sibacom-primary, #173F91); background: rgba(23,63,145,0.08); padding: 0.2rem 0.6rem; border-radius: 4px;">
                                        <?php echo esc_html($item['event_category']); ?>
                                    </span>
                                </div>
                            <?php endif; ?>

                            <<?php echo esc_attr($title_tag); ?> class="sibacom-event-card-title font-display">
                                <?php echo esc_html($item['event_title']); ?>
                            </<?php echo esc_attr($title_tag); ?>>

                            <?php if (!empty($item['event_desc'])) : ?>
                                <div class="sibacom-event-card-desc">
                                    <p><?php echo esc_html($item['event_desc']); ?></p>
                                </div>
                            <?php endif; ?>

                            <!-- Meta details (Date, Time, Venue, Registration Closes) -->
                            <?php if ($show_meta && ($show_date || ($show_time && !empty($time_val)) || $show_venue || $show_reg_close || $show_extra)) : ?>
                                <div class="sibacom-event-meta-list">
                                    <?php if ($show_date) : ?>
                                        <div class="sibacom-event-meta-row meta-date">
                                            <span class="meta-icon" style="color: var(--sibacom-primary, #173F91);">
                                                <?php if (!empty($item['date_icon']['value'])) : ?>
                                                    <?php Icons_Manager::render_icon($item['date_icon'], array('aria-hidden' => 'true')); ?>
                                                <?php else : ?>
                                                    <i class="fa-regular fa-calendar" aria-hidden="true"></i>
                                                <?php endif; ?>
                                            </span>
                                            <span><strong><?php echo esc_html(!empty($item['date_label']) ? $item['date_label'] : 'Date:'); ?></strong> <?php echo esc_html($item['event_date']); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($show_time && !empty($time_val)) : ?>
                                        <div class="sibacom-event-meta-row meta-time">
                                            <span class="meta-icon" style="color: var(--sibacom-techgreen, #079B58);">
                                                <?php if (!empty($item['time_icon']['value'])) : ?>
                                                    <?php Icons_Manager::render_icon($item['time_icon'], array('aria-hidden' => 'true')); ?>
                                                <?php else : ?>
                                                    <i class="fa-regular fa-clock" aria-hidden="true"></i>
                                                <?php endif; ?>
                                            </span>
                                            <span><strong><?php echo esc_html(!empty($item['time_label']) ? $item['time_label'] : 'Time:'); ?></strong> <?php echo esc_html($time_val); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($show_venue) : ?>
                                        <div class="sibacom-event-meta-row meta-venue">
                                            <span class="meta-icon" style="color: var(--sibacom-techgreen, #079B58);">
                                                <?php if (!empty($item['venue_icon']['value'])) : ?>
                                                    <?php Icons_Manager::render_icon($item['venue_icon'], array('aria-hidden' => 'true')); ?>
                                                <?php else : ?>
                                                    <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                                                <?php endif; ?>
                                            </span>
                                            <span><strong><?php echo esc_html(!empty($item['venue_label']) ? $item['venue_label'] : 'Venue:'); ?></strong> <?php echo esc_html($item['event_venue']); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($show_reg_close) : ?>
                                        <div class="sibacom-event-meta-row meta-reg-close">
                                            <span class="meta-icon" style="color: #D97706;">
                                                <?php if (!empty($item['reg_close_icon']['value'])) : ?>
                                                    <?php Icons_Manager::render_icon($item['reg_close_icon'], array('aria-hidden' => 'true')); ?>
                                                <?php else : ?>
                                                    <i class="fa-regular fa-hourglass-half" aria-hidden="true"></i>
                                                <?php endif; ?>
                                            </span>
                                            <span><strong><?php echo esc_html(!empty($item['reg_close_label']) ? $item['reg_close_label'] : 'Registration Closes:'); ?></strong> <?php echo esc_html($item['event_reg_close']); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($show_extra) : ?>
                                        <div class="sibacom-event-meta-row meta-extra">
                                            <span class="meta-icon" style="color: var(--sibacom-primary, #173F91);">
                                                <?php if (!empty($item['extra_meta_icon']['value'])) : ?>
                                                    <?php Icons_Manager::render_icon($item['extra_meta_icon'], array('aria-hidden' => 'true')); ?>
                                                <?php else : ?>
                                                    <i class="fa-solid fa-users" aria-hidden="true"></i>
                                                <?php endif; ?>
                                            </span>
                                            <span><strong><?php echo esc_html(!empty($item['extra_meta_label']) ? $item['extra_meta_label'] : 'Extra:'); ?></strong> <?php echo esc_html($item['extra_meta_value']); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Card Footer Button Action CTA -->
                            <?php if ($show_button) : ?>
                                <div class="sibacom-event-card-footer">
                                    <?php if ($btn_state === 'active') : ?>
                                        <a <?php echo $this->get_render_attribute_string($btn_link_key); ?> <?php if (!empty($btn_style)) : ?>style="<?php echo esc_attr($btn_style); ?>"<?php endif; ?>>
                                            <?php if ($btn_align === 'before' && !empty($item['btn_icon']['value'])) : ?>
                                                <?php Icons_Manager::render_icon($item['btn_icon'], array('aria-hidden' => 'true')); ?>
                                            <?php endif; ?>
                                            <span><?php echo esc_html($btn_text); ?></span>
                                            <?php if ($btn_align === 'after') : ?>
                                                <?php if (!empty($item['btn_icon']['value'])) : ?>
                                                    <?php Icons_Manager::render_icon($item['btn_icon'], array('aria-hidden' => 'true')); ?>
                                                <?php else : ?>
                                                    <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </a>
                                    <?php else : ?>
                                        <button class="sibacom-btn sibacom-btn-disabled sibacom-btn-full" disabled="disabled" <?php if (!empty($btn_style)) : ?>style="<?php echo esc_attr($btn_style); ?>"<?php endif; ?>>
                                            <?php if ($btn_align === 'before' && !empty($item['btn_icon']['value'])) : ?>
                                                <?php Icons_Manager::render_icon($item['btn_icon'], array('aria-hidden' => 'true')); ?>
                                            <?php endif; ?>
                                            <span><?php echo esc_html($btn_text); ?></span>
                                            <?php if ($btn_align === 'after') : ?>
                                                <?php if (!empty($item['btn_icon']['value'])) : ?>
                                                    <?php Icons_Manager::render_icon($item['btn_icon'], array('aria-hidden' => 'true')); ?>
                                                <?php else : ?>
                                                    <i class="fa-solid fa-lock" aria-hidden="true"></i>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php
        }
    }
}
