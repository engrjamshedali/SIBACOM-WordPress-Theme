<?php
/**
 * SIBACOM Schedule Timeline Elementor Widget (Premium Redesign)
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

class SIBACOM_Schedule_Widget extends Widget_Base {

    public function get_name() {
        return 'sibacom_schedule';
    }

    public function get_title() {
        return esc_html__('SIBACOM Schedule Timeline', 'sibacom-manager');
    }

    public function get_icon() {
        return 'eicon-time-line';
    }

    public function get_categories() {
        return array('sibacom-elements');
    }

    protected function register_controls() {
        // CONTENT TAB: Query & Layout
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__('Schedule Query & Layout', 'sibacom-manager'),
            )
        );

        $this->add_control(
            'data_mode',
            array(
                'label'   => esc_html__('Data Source Mode', 'sibacom-manager'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'dynamic',
                'options' => array(
                    'dynamic' => esc_html__('Dynamic (WordPress Schedule CPT)', 'sibacom-manager'),
                    'manual'  => esc_html__('Custom Manual Sessions (Visual Repeater)', 'sibacom-manager'),
                ),
            )
        );

        $this->add_control(
            'timeline_layout',
            array(
                'label'   => esc_html__('Timeline Layout Structure', 'sibacom-manager'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => array(
                    'left'        => esc_html__('Left-Aligned Vertical Timeline', 'sibacom-manager'),
                    'alternating' => esc_html__('Alternating Central Timeline (Desktop)', 'sibacom-manager'),
                ),
                'description' => esc_html__('Alternating layout displays sessions left-and-right along a central line on desktop, gracefully collapsing to clean single-column on mobile.', 'sibacom-manager'),
            )
        );

        $this->add_responsive_control(
            'timeline_alignment',
            array(
                'label'     => esc_html__('Card Content Alignment', 'sibacom-manager'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => array(
                    'left'   => array('title' => esc_html__('Left', 'sibacom-manager'), 'icon' => 'eicon-text-align-left'),
                    'center' => array('title' => esc_html__('Center', 'sibacom-manager'), 'icon' => 'eicon-text-align-center'),
                    'right'  => array('title' => esc_html__('Right', 'sibacom-manager'), 'icon' => 'eicon-text-align-right'),
                ),
                'default'   => 'left',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-timeline-card' => 'text-align: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'day_filter',
            array(
                'label'     => esc_html__('Filter by Event Day', 'sibacom-manager'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '',
                'options'   => array(
                    ''  => esc_html__('All Sessions', 'sibacom-manager'),
                    '1' => esc_html__('Day 1 (Full Day)', 'sibacom-manager'),
                    '2' => esc_html__('Day 2 (Optional)', 'sibacom-manager'),
                    '3' => esc_html__('Day 3 (Optional)', 'sibacom-manager'),
                ),
                'condition' => array(
                    'data_mode' => 'dynamic',
                ),
            )
        );

        $this->add_control(
            'category_filter',
            array(
                'label'     => esc_html__('Filter by Track / Category', 'sibacom-manager'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '',
                'options'   => array(
                    ''            => esc_html__('All Categories', 'sibacom-manager'),
                    'keynote'     => esc_html__('Keynote Address', 'sibacom-manager'),
                    'competition' => esc_html__('Competition Sprint', 'sibacom-manager'),
                    'workshop'    => esc_html__('Technical Workshop', 'sibacom-manager'),
                    'panel'       => esc_html__('Panel Discussion', 'sibacom-manager'),
                    'ceremony'    => esc_html__('Ceremony & Gala', 'sibacom-manager'),
                    'networking'  => esc_html__('Networking & Meetup', 'sibacom-manager'),
                    'break'       => esc_html__('Luncheon & Intermission', 'sibacom-manager'),
                ),
                'condition' => array(
                    'data_mode' => 'dynamic',
                ),
            )
        );

        $this->add_control(
            'featured_only',
            array(
                'label'        => esc_html__('Show Featured Sessions Only', 'sibacom-manager'),
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

        $this->add_control(
            'posts_limit',
            array(
                'label'     => esc_html__('Number of Sessions (-1 for All)', 'sibacom-manager'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => -1,
                'condition' => array(
                    'data_mode' => 'dynamic',
                ),
            )
        );

        $this->add_control(
            'orderby',
            array(
                'label'     => esc_html__('Order Sessions By', 'sibacom-manager'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'order',
                'options'   => array(
                    'order' => esc_html__('Custom Display Order', 'sibacom-manager'),
                    'start' => esc_html__('Start Time', 'sibacom-manager'),
                    'title' => esc_html__('Session Title', 'sibacom-manager'),
                ),
                'condition' => array(
                    'data_mode' => 'dynamic',
                ),
            )
        );

        $this->add_control(
            'order',
            array(
                'label'     => esc_html__('Sorting Direction', 'sibacom-manager'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'ASC',
                'options'   => array(
                    'ASC'  => esc_html__('Ascending (A-Z / 1-9)', 'sibacom-manager'),
                    'DESC' => esc_html__('Descending (Z-A / 9-1)', 'sibacom-manager'),
                ),
                'condition' => array(
                    'data_mode' => 'dynamic',
                ),
            )
        );

        // Manual Repeater Configuration
        $repeater = new Repeater();

        $repeater->add_control(
            'session_title',
            array(
                'label'   => esc_html__('Session Title', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Grand Inaugural Ceremony & Keynote Address',
            )
        );

        $repeater->add_control(
            'session_day',
            array(
                'label'   => esc_html__('Event Day Number', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => '1',
            )
        );

        $repeater->add_control(
            'session_time',
            array(
                'label'   => esc_html__('Time Window', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => '10:00 AM – 11:30 AM',
            )
        );

        $repeater->add_control(
            'session_duration',
            array(
                'label'   => esc_html__('Duration Label', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => '90 mins',
            )
        );

        $repeater->add_control(
            'session_category',
            array(
                'label'   => esc_html__('Category Track', 'sibacom-manager'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'keynote',
                'options' => array(
                    'keynote'     => esc_html__('Keynote Address', 'sibacom-manager'),
                    'competition' => esc_html__('Competition Sprint', 'sibacom-manager'),
                    'workshop'    => esc_html__('Technical Workshop', 'sibacom-manager'),
                    'panel'       => esc_html__('Panel Discussion', 'sibacom-manager'),
                    'ceremony'    => esc_html__('Ceremony & Gala', 'sibacom-manager'),
                    'networking'  => esc_html__('Networking & Meetup', 'sibacom-manager'),
                    'break'       => esc_html__('Luncheon & Intermission', 'sibacom-manager'),
                ),
            )
        );

        $repeater->add_control(
            'session_icon',
            array(
                'label'   => esc_html__('Session Icon Class', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'fa-solid fa-microphone',
            )
        );

        $repeater->add_control(
            'session_desc',
            array(
                'label'   => esc_html__('Description', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => 'Official inauguration address by the Honorable Vice Chancellor, introduction of jury deans, and inaugural showcase.',
            )
        );

        $repeater->add_control(
            'session_speaker',
            array(
                'label'   => esc_html__('Speaker / Presenter', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Engr. Dr. Zahid Hussain',
            )
        );

        $repeater->add_control(
            'session_speaker_photo',
            array(
                'label'   => esc_html__('Speaker Photograph', 'sibacom-manager'),
                'type'    => Controls_Manager::MEDIA,
            )
        );

        $repeater->add_control(
            'session_venue',
            array(
                'label'   => esc_html__('Venue / Lab', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Nisar Ahmed Siddiqui Auditorium',
            )
        );

        $repeater->add_control(
            'session_featured',
            array(
                'label'        => esc_html__('Featured Session', 'sibacom-manager'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'sibacom-manager'),
                'label_off'    => esc_html__('No', 'sibacom-manager'),
                'return_value' => 'yes',
                'default'      => '',
            )
        );

        $this->add_control(
            'manual_sessions',
            array(
                'label'       => esc_html__('Manual Session Items', 'sibacom-manager'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ session_title }}}',
                'condition'   => array(
                    'data_mode' => 'manual',
                ),
            )
        );

        $this->end_controls_section();

        // STYLE TAB: 1. Timeline Line & Connecting Nodes
        $this->start_controls_section(
            'section_style_timeline_nodes',
            array(
                'label' => esc_html__('Timeline Line & Nodes', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'line_color',
            array(
                'label'     => esc_html__('Timeline Line Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#173F91',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-timeline::before'      => 'background: {{VALUE}};',
                    '{{WRAPPER}} .sibacom-timeline-spine'       => 'background: {{VALUE}};',
                    '{{WRAPPER}} .sibacom-timeline-stem'        => 'background: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'line_thickness',
            array(
                'label'      => esc_html__('Line Thickness (px)', 'sibacom-manager'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px'),
                'range'      => array('px' => array('min' => 1, 'max' => 8)),
                'default'    => array('unit' => 'px', 'size' => 3),
                'selectors'  => array(
                    '{{WRAPPER}} .sibacom-timeline::before' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .sibacom-timeline-spine'  => 'width: {{SIZE}}{{UNIT}};',
                ),
            )
        );

        $this->add_control(
            'node_size',
            array(
                'label'      => esc_html__('Node Size (px)', 'sibacom-manager'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px'),
                'range'      => array('px' => array('min' => 20, 'max' => 54)),
                'default'    => array('unit' => 'px', 'size' => 38),
                'selectors'  => array(
                    '{{WRAPPER}} .sibacom-timeline-node' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ),
            )
        );

        $this->add_control(
            'node_color',
            array(
                'label'     => esc_html__('Node Accent Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#079B58',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-timeline-node' => 'border-color: {{VALUE}}; color: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'node_bg',
            array(
                'label'     => esc_html__('Node Background', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FFFFFF',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-node-inner' => 'background-color: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'node_border_color',
            array(
                'label'     => esc_html__('Node Border Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#173F91',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-node-inner' => 'border-color: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'node_icon_color',
            array(
                'label'     => esc_html__('Node Icon Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#173F91',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-node-inner i' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_section();

        // STYLE TAB: 2. Session Cards
        $this->start_controls_section(
            'section_style_cards',
            array(
                'label' => esc_html__('Session Cards Styling', 'sibacom-manager'),
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
                    '{{WRAPPER}} .sibacom-timeline-card' => 'background-color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'     => 'card_border',
                'label'    => esc_html__('Card Border', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .sibacom-timeline-card',
            )
        );

        $this->add_control(
            'card_border_radius',
            array(
                'label'      => esc_html__('Border Radius', 'sibacom-manager'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', '%', 'rem'),
                'default'    => array('top' => 20, 'right' => 20, 'bottom' => 20, 'left' => 20, 'unit' => 'px'),
                'selectors'  => array(
                    '{{WRAPPER}} .sibacom-timeline-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_control(
            'card_padding',
            array(
                'label'      => esc_html__('Card Padding', 'sibacom-manager'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'rem'),
                'default'    => array('top' => 28, 'right' => 32, 'bottom' => 28, 'left' => 32, 'unit' => 'px'),
                'selectors'  => array(
                    '{{WRAPPER}} .sibacom-timeline-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'card_shadow',
                'label'    => esc_html__('Card Normal Shadow', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .sibacom-timeline-card',
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'card_hover_shadow',
                'label'    => esc_html__('Card Hover Shadow', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .sibacom-timeline-card:hover',
            )
        );

        $this->add_control(
            'featured_card_accent',
            array(
                'label'     => esc_html__('Featured Session Accent Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#173F91',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-timeline-card.sibacom-card-featured' => 'border-left-color: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_section();

        // STYLE TAB: 3. Typography & Text Colors
        $this->start_controls_section(
            'section_style_typography',
            array(
                'label' => esc_html__('Typography & Content Colors', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'title_typography',
                'label'    => esc_html__('Title Typography', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .sibacom-timeline-title',
            )
        );

        $this->add_control(
            'title_color',
            array(
                'label'     => esc_html__('Title Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#17233D',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-timeline-title' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'desc_typography',
                'label'    => esc_html__('Description Typography', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .sibacom-timeline-desc, {{WRAPPER}} .sibacom-timeline-desc p',
            )
        );

        $this->add_control(
            'desc_color',
            array(
                'label'     => esc_html__('Description Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#64748B',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-timeline-desc, {{WRAPPER}} .sibacom-timeline-desc p' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'time_badge_bg',
            array(
                'label'     => esc_html__('Time Badge Background', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#EDF1F7',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-timeline-time-badge' => 'background-color: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'time_badge_color',
            array(
                'label'     => esc_html__('Time Badge Text Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#173F91',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-timeline-time-badge' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_section();

        // STYLE TAB: 4. Electrical Timeline Signal & PCB Bus
        $this->start_controls_section(
            'section_style_timeline_signal',
            array(
                'label' => esc_html__('Electrical Timeline Signal & PCB Bus', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'enable_timeline_signal',
            array(
                'label'        => esc_html__('Enable Animated Electric Signal Pulse', 'sibacom-manager'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'sibacom-manager'),
                'label_off'    => esc_html__('No', 'sibacom-manager'),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->add_control(
            'signal_pulse_color',
            array(
                'label'     => esc_html__('Electric Pulse Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#079B58',
                'selectors' => array(
                    '{{WRAPPER}}' => '--sibacom-circuit-pulse-color: {{VALUE}};',
                ),
                'condition' => array('enable_timeline_signal' => 'yes'),
            )
        );

        $this->add_control(
            'signal_pulse_speed',
            array(
                'label'     => esc_html__('Pulse Travel Duration (Seconds)', 'sibacom-manager'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => array(
                    'px' => array('min' => 2, 'max' => 12, 'step' => 0.5),
                ),
                'default'   => array('size' => 5.5),
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-timeline-signal-pulse::after' => 'animation-duration: {{SIZE}}s;',
                ),
                'condition' => array('enable_timeline_signal' => 'yes'),
            )
        );

        $this->add_control(
            'signal_glow_radius',
            array(
                'label'     => esc_html__('Pulse Glow Radius', 'sibacom-manager'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => array(
                    'px' => array('min' => 0, 'max' => 30, 'step' => 1),
                ),
                'default'   => array('size' => 12),
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-timeline-signal-pulse::after' => 'box-shadow: 0 0 {{SIZE}}px var(--sibacom-circuit-pulse-color, #079B58);',
                ),
                'condition' => array('enable_timeline_signal' => 'yes'),
            )
        );

        $this->add_control(
            'timeline_spine_width',
            array(
                'label'     => esc_html__('PCB Bus Spine Thickness', 'sibacom-manager'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => array(
                    'px' => array('min' => 1, 'max' => 6, 'step' => 0.5),
                ),
                'default'   => array('size' => 3),
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-timeline.layout-left::before' => 'width: {{SIZE}}px !important;',
                    '{{WRAPPER}} .sibacom-timeline:not(.layout-alternating)::before' => 'width: {{SIZE}}px !important;',
                    '{{WRAPPER}} .sibacom-timeline-line' => 'width: {{SIZE}}px !important;',
                ),
                'condition' => array('enable_timeline_signal' => 'yes'),
            )
        );

        $this->add_responsive_control(
            'timeline_signal_visibility',
            array(
                'label'     => esc_html__('Signal Visibility', 'sibacom-manager'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'block',
                'options'   => array(
                    'block' => esc_html__('Visible', 'sibacom-manager'),
                    'none'  => esc_html__('Hidden', 'sibacom-manager'),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-timeline-signal-pulse' => 'display: {{VALUE}};',
                ),
                'condition' => array('enable_timeline_signal' => 'yes'),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $mode     = $settings['data_mode'];
        $layout   = !empty($settings['timeline_layout']) ? $settings['timeline_layout'] : 'left';

        if ($mode === 'dynamic') {
            $day      = $settings['day_filter'];
            $limit    = !empty($settings['posts_limit']) ? $settings['posts_limit'] : -1;
            $cat      = !empty($settings['category_filter']) ? $settings['category_filter'] : '';
            $featured = !empty($settings['featured_only']) ? 'yes' : '';
            $orderby  = !empty($settings['orderby']) ? $settings['orderby'] : 'order';
            $order    = !empty($settings['order']) ? $settings['order'] : 'ASC';

            if (class_exists('SIBACOM_Shortcodes')) {
                echo SIBACOM_Shortcodes::render_schedule(array(
                    'day'      => $day,
                    'limit'    => $limit,
                    'category' => $cat,
                    'featured' => $featured,
                    'layout'   => $layout,
                    'orderby'  => $orderby,
                    'order'    => $order,
                ));
            }
        } else {
            // Manual Repeater Rendering
            $sessions = !empty($settings['manual_sessions']) ? $settings['manual_sessions'] : array();
            $cat_configs = array(
                'keynote'     => array('label' => esc_html__('Keynote Address', 'sibacom-manager'), 'icon' => 'fa-solid fa-microphone', 'cls' => 'cat-keynote'),
                'competition' => array('label' => esc_html__('Competition Sprint', 'sibacom-manager'), 'icon' => 'fa-solid fa-code', 'cls' => 'cat-competition'),
                'workshop'    => array('label' => esc_html__('Technical Workshop', 'sibacom-manager'), 'icon' => 'fa-solid fa-laptop-code', 'cls' => 'cat-workshop'),
                'panel'       => array('label' => esc_html__('Panel Discussion', 'sibacom-manager'), 'icon' => 'fa-solid fa-comments', 'cls' => 'cat-panel'),
                'ceremony'    => array('label' => esc_html__('Ceremony & Gala', 'sibacom-manager'), 'icon' => 'fa-solid fa-award', 'cls' => 'cat-ceremony'),
                'networking'  => array('label' => esc_html__('Networking & Meetup', 'sibacom-manager'), 'icon' => 'fa-solid fa-users', 'cls' => 'cat-networking'),
                'break'       => array('label' => esc_html__('Luncheon & Intermission', 'sibacom-manager'), 'icon' => 'fa-solid fa-mug-saucer', 'cls' => 'cat-break'),
            );

            $layout_class = ($layout === 'alternating') ? 'layout-alternating' : 'layout-left';
            ?>
            <div class="sibacom-timeline <?php echo esc_attr($layout_class); ?>" data-layout="<?php echo esc_attr($layout); ?>">
                <div class="sibacom-timeline-spine" aria-hidden="true"></div>
                <?php if ((!isset($settings['enable_timeline_signal']) || $settings['enable_timeline_signal'] !== 'no') && function_exists('sibacom_the_timeline_signal_track')) : ?>
                    <?php sibacom_the_timeline_signal_track(); ?>
                <?php endif; ?>
                <?php
                $index = 0;
                foreach ($sessions as $s) :
                    $index++;
                    $cat_key   = !empty($s['session_category']) ? $s['session_category'] : 'keynote';
                    $cat_info  = isset($cat_configs[$cat_key]) ? $cat_configs[$cat_key] : array('label' => ucfirst($cat_key), 'icon' => 'fa-regular fa-clock', 'cls' => 'cat-default');
                    $node_icon = !empty($s['session_icon']) ? $s['session_icon'] : $cat_info['icon'];
                    $featured  = !empty($s['session_featured']) && $s['session_featured'] === 'yes';
                    $spk_photo = !empty($s['session_speaker_photo']['url']) ? $s['session_speaker_photo']['url'] : '';
                    $side_cls  = ($index % 2 === 0) ? 'item-right' : 'item-left';
                    $featured_cls = $featured ? 'is-featured' : '';
                    ?>
                    <div class="sibacom-timeline-item <?php echo esc_attr($side_cls . ' ' . $featured_cls); ?>" data-day="<?php echo esc_attr($s['session_day']); ?>">
                        <div class="sibacom-timeline-node <?php echo esc_attr($cat_info['cls']); ?>">
                            <div class="sibacom-node-inner" title="<?php echo esc_attr($cat_info['label']); ?>">
                                <i class="<?php echo esc_attr($node_icon); ?>"></i>
                            </div>
                            <?php if ($featured) : ?>
                                <span class="sibacom-node-pulse"></span>
                            <?php endif; ?>
                        </div>
                        <div class="sibacom-timeline-stem" aria-hidden="true"></div>

                        <div class="sibacom-timeline-card neu-card sibacom-card-circuit <?php echo $featured ? 'sibacom-card-featured' : ''; ?>">
                            <?php if (function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tr'); } ?>
                            <div class="sibacom-timeline-meta-bar">
                                <div class="sibacom-timeline-time-badge">
                                    <i class="fa-regular fa-clock"></i>
                                    <span><?php if (!empty($s['session_day']) && intval($s['session_day']) > 1) { printf(esc_html__('Day %s &bull; ', 'sibacom-manager'), esc_html($s['session_day'])); } ?><?php echo esc_html($s['session_time']); ?></span>
                                </div>

                                <div class="sibacom-timeline-badges-wrap">
                                    <?php if (!empty($s['session_duration'])) : ?>
                                        <span class="sibacom-timeline-duration-badge">
                                            <i class="fa-regular fa-hourglass-half"></i>
                                            <span><?php echo esc_html($s['session_duration']); ?></span>
                                        </span>
                                    <?php endif; ?>

                                    <span class="sibacom-timeline-cat-badge <?php echo esc_attr($cat_info['cls']); ?>">
                                        <i class="<?php echo esc_attr($node_icon); ?>" style="margin-right: 0.35rem;"></i>
                                        <span><?php echo esc_html($cat_info['label']); ?></span>
                                    </span>

                                    <?php if ($featured) : ?>
                                        <span class="sibacom-timeline-featured-badge">
                                            <i class="fa-solid fa-star"></i>
                                            <span><?php esc_html_e('Featured Session', 'sibacom-manager'); ?></span>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <h3 class="font-display sibacom-timeline-title">
                                <?php echo esc_html($s['session_title']); ?>
                            </h3>

                            <div class="sibacom-timeline-desc">
                                <p><?php echo esc_html($s['session_desc']); ?></p>
                            </div>

                            <?php if (!empty($s['session_speaker']) || !empty($s['session_venue'])) : ?>
                                <div class="sibacom-timeline-footer-meta">
                                    <?php if (!empty($s['session_speaker'])) : ?>
                                        <div class="sibacom-session-speaker-info">
                                            <?php if (!empty($spk_photo)) : ?>
                                                <img src="<?php echo esc_url($spk_photo); ?>" alt="<?php echo esc_attr($s['session_speaker']); ?>" class="sibacom-session-speaker-photo" width="44" height="44" loading="lazy" decoding="async" />
                                            <?php else : ?>
                                                <div class="sibacom-session-speaker-photo-fallback">
                                                    <i class="fa-solid fa-user-tie"></i>
                                                </div>
                                            <?php endif; ?>
                                            <div class="sibacom-session-speaker-details">
                                                <span class="speaker-role-label"><?php esc_html_e('Lead Presenter / Speaker', 'sibacom-manager'); ?></span>
                                                <strong class="speaker-full-name"><?php echo esc_html($s['session_speaker']); ?></strong>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($s['session_venue'])) : ?>
                                        <div class="sibacom-session-venue-info" title="<?php esc_attr_e('Session Room / Venue', 'sibacom-manager'); ?>">
                                            <i class="fa-solid fa-location-dot"></i>
                                            <span><?php echo esc_html($s['session_venue']); ?></span>
                                        </div>
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
