<?php
/**
 * SIBACOM Hero Elementor Widget
 *
 * @package SIBACOM_Website_Manager
 */

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

class SIBACOM_Hero_Widget extends Widget_Base {

    public function get_name() {
        return 'sibacom_hero';
    }

    public function get_title() {
        return esc_html__('SIBACOM Hero Banner', 'sibacom-manager');
    }

    public function get_icon() {
        return 'eicon-banner';
    }

    public function get_categories() {
        return array('sibacom-elements');
    }

    protected function register_controls() {
        // Content Section
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__('Hero Content & Headline', 'sibacom-manager'),
            )
        );

        $this->add_control(
            'badge_text',
            array(
                'label'   => esc_html__('Top Badge Text', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__('Sukkur IBA University Presents • National Tech Olympiad', 'sibacom-manager'),
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__('Event Title', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'SIBACOM',
            )
        );

        $this->add_control(
            'edition',
            array(
                'label'   => esc_html__('Edition / Year', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => "'26",
            )
        );

        $this->add_control(
            'headline',
            array(
                'label'   => esc_html__('Headline / Tagline', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => 'POWER TO PROGRESS',
            )
        );

        $this->add_control(
            'description',
            array(
                'label'   => esc_html__('Description', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => "SIBACOM is Pakistan's premier collegiate technology festival, bringing together talented university students, programmers, robotics enthusiasts, AI innovators, cybersecurity enthusiasts, and future technology leaders for an extraordinary celebration of innovation and technology.",
            )
        );

        $this->add_control(
            'event_dates',
            array(
                'label'   => esc_html__('Event Dates', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'November 30, 2026',
            )
        );

        $this->add_control(
            'event_venue',
            array(
                'label'   => esc_html__('Event Venue', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Academic Block-III, Sukkur IBA University',
            )
        );

        $this->add_control(
            'attendees_tag',
            array(
                'label'   => esc_html__('Attendees Tag', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => '1,500+ Innovators',
            )
        );

        $this->add_control(
            'bg_image',
            array(
                'label'   => esc_html__('Background Image', 'sibacom-manager'),
                'type'    => Controls_Manager::MEDIA,
                'default' => array(
                    'url' => function_exists('sibacom_get_campus_bg_url') ? sibacom_get_campus_bg_url() : '',
                ),
            )
        );

        $this->add_control(
            'cta_text',
            array(
                'label'   => esc_html__('Primary Button Text', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Register for SIBACOM',
            )
        );

        $this->add_control(
            'cta_url',
            array(
                'label'   => esc_html__('Primary Button URL', 'sibacom-manager'),
                'type'    => Controls_Manager::URL,
                'default' => array(
                    'url' => 'https://portal.sibacom.tech/',
                ),
            )
        );

        $this->add_control(
            'sec_text',
            array(
                'label'   => esc_html__('Secondary Button Text', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Explore Event Details',
            )
        );

        $this->add_control(
            'sec_url',
            array(
                'label'   => esc_html__('Secondary Button URL', 'sibacom-manager'),
                'type'    => Controls_Manager::URL,
                'default' => array(
                    'url' => '#events',
                ),
            )
        );

        $this->add_control(
            'countdown_date',
            array(
                'label'       => esc_html__('Countdown Target Date', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => '2026-11-30T09:00:00',
                'description' => esc_html__('Format: YYYY-MM-DDTHH:MM:SS (e.g. 2026-11-30T09:00:00)', 'sibacom-manager'),
            )
        );

        $this->end_controls_section();

        // Style Tab: Colors & Typography
        $this->start_controls_section(
            'section_style_typography',
            array(
                'label' => esc_html__('Typography & Colors', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'title_typography',
                'label'    => esc_html__('Title Typography', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .sibacom-hero-title',
            )
        );

        $this->add_control(
            'headline_color',
            array(
                'label'     => esc_html__('Headline Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#102E68',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-hero-tagline' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'description_color',
            array(
                'label'     => esc_html__('Description Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#64748B',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-hero-description' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_section();

        // Style Tab: Electrical Circuits & Signal Flow Effects
        $this->start_controls_section(
            'section_style_circuits',
            array(
                'label' => esc_html__('Electrical Circuits & Signal Effects', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'enable_circuits',
            array(
                'label'        => esc_html__('Enable Circuit Visual Effects', 'sibacom-manager'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'sibacom-manager'),
                'label_off'    => esc_html__('No', 'sibacom-manager'),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->add_control(
            'circuit_track_color',
            array(
                'label'     => esc_html__('Circuit Track Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => 'rgba(23, 63, 145, 0.22)',
                'selectors' => array(
                    '{{WRAPPER}}' => '--sibacom-circuit-trace: {{VALUE}};',
                ),
                'condition' => array('enable_circuits' => 'yes'),
            )
        );

        $this->add_control(
            'circuit_pulse_color',
            array(
                'label'     => esc_html__('Signal Pulse Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#079B58',
                'selectors' => array(
                    '{{WRAPPER}}' => '--sibacom-circuit-pulse-color: {{VALUE}};',
                ),
                'condition' => array('enable_circuits' => 'yes'),
            )
        );

        $this->add_control(
            'circuit_speed',
            array(
                'label'     => esc_html__('Animation Speed (Seconds)', 'sibacom-manager'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => array(
                    'px' => array('min' => 1, 'max' => 12, 'step' => 0.5),
                ),
                'default'   => array('size' => 4),
                'selectors' => array(
                    '{{WRAPPER}}' => '--sibacom-circuit-speed: {{SIZE}}s;',
                ),
                'condition' => array('enable_circuits' => 'yes'),
            )
        );

        $this->add_control(
            'circuit_glow_intensity',
            array(
                'label'     => esc_html__('Pulse Glow Radius', 'sibacom-manager'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => array(
                    'px' => array('min' => 0, 'max' => 25, 'step' => 1),
                ),
                'default'   => array('size' => 8),
                'selectors' => array(
                    '{{WRAPPER}}' => '--sibacom-circuit-glow: {{SIZE}}px;',
                ),
                'condition' => array('enable_circuits' => 'yes'),
            )
        );

        $this->add_control(
            'circuit_line_thickness',
            array(
                'label'     => esc_html__('Track Line Thickness', 'sibacom-manager'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => array(
                    'px' => array('min' => 1, 'max' => 5, 'step' => 0.5),
                ),
                'default'   => array('size' => 1.5),
                'selectors' => array(
                    '{{WRAPPER}}' => '--sibacom-circuit-stroke: {{SIZE}}px;',
                ),
                'condition' => array('enable_circuits' => 'yes'),
            )
        );

        $this->add_control(
            'circuit_pattern_opacity',
            array(
                'label'     => esc_html__('Pattern Opacity', 'sibacom-manager'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => array(
                    'px' => array('min' => 0, 'max' => 1, 'step' => 0.05),
                ),
                'default'   => array('size' => 0.85),
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-hero-circuit-overlay' => 'opacity: {{SIZE}};',
                ),
                'condition' => array('enable_circuits' => 'yes'),
            )
        );

        $this->add_responsive_control(
            'circuit_visibility',
            array(
                'label'     => esc_html__('Circuit Visibility', 'sibacom-manager'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'block',
                'options'   => array(
                    'block' => esc_html__('Visible', 'sibacom-manager'),
                    'none'  => esc_html__('Hidden', 'sibacom-manager'),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-hero-circuit-overlay' => 'display: {{VALUE}};',
                ),
                'condition' => array('enable_circuits' => 'yes'),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $bg_url    = !empty($settings['bg_image']['url']) ? $settings['bg_image']['url'] : (function_exists('sibacom_get_campus_bg_url') ? sibacom_get_campus_bg_url() : '');
        $cta_url   = !empty($settings['cta_url']['url']) ? $settings['cta_url']['url'] : 'https://portal.sibacom.tech/';
        $sec_url   = !empty($settings['sec_url']['url']) ? $settings['sec_url']['url'] : '#events';
        $attendees = !empty($settings['attendees_tag']) ? $settings['attendees_tag'] : '1,500+ Innovators';
        ?>
        <div class="sibacom-widget-wrap">
            <section class="sibacom-hero-wrap">
                <div class="sibacom-hero-bg">
                    <?php if (!empty($bg_url)) : ?>
                        <img src="<?php echo esc_url($bg_url); ?>" alt="<?php echo esc_attr($settings['title']); ?>" width="1024" height="576" fetchpriority="high" decoding="async" />
                    <?php endif; ?>
                    <div class="sibacom-hero-overlay-v"></div>
                    <div class="sibacom-hero-overlay-h"></div>
                </div>

                <?php if ((!isset($settings['enable_circuits']) || $settings['enable_circuits'] !== 'no') && function_exists('sibacom_the_hero_circuits')) : ?>
                    <?php sibacom_the_hero_circuits(); ?>
                <?php endif; ?>

                <div class="sibacom-container">
                    <div class="sibacom-hero-content">
                        <?php if (!empty($settings['badge_text'])) : ?>
                            <!-- 1. Institutional Announcement Badge -->
                            <div class="sibacom-hero-badge" role="status">
                                <span class="pulse-indicator" aria-hidden="true">
                                    <span class="pulse-indicator-ring"></span>
                                    <span class="pulse-indicator-core"></span>
                                </span>
                                <span class="sibacom-hero-badge-text">
                                    <span>Sukkur IBA University Presents</span>
                                    <span class="sibacom-hero-badge-sep" aria-hidden="true">•</span>
                                    <span class="sibacom-hero-badge-highlight">National Tech Olympiad</span>
                                </span>
                            </div>
                        <?php endif; ?>

                        <!-- 2. Dominant Brand Wordmark Identity: SIBACOM '26 & Official Emblem -->
                        <?php 
                        if (function_exists('sibacom_the_hero_brand_lockup')) {
                            sibacom_the_hero_brand_lockup($settings['title'], "'26");
                        } else {
                        ?>
                        <div class="sibacom-brand-hero-emblem-wrap">
                            <div class="sibacom-brand-glow" aria-hidden="true"></div>
                            <div class="sibacom-brand-wordmark-lockup">
                                <h1 class="sibacom-hero-wordmark font-display" aria-label="SIBACOM 2026">
                                    <span class="sibacom-wordmark-core"><?php echo esc_html($settings['title']); ?></span>
                                    <span class="sibacom-brand-edition-lockup" aria-hidden="true">
                                        <span class="sibacom-brand-edition-badge">
                                            <span class="sibacom-brand-apostrophe">’</span><span class="sibacom-brand-year">26</span>
                                            <span class="sibacom-brand-edition-dot" aria-hidden="true"></span>
                                        </span>
                                    </span>
                                </h1>
                            </div>
                        </div>
                        <?php } ?>

                        <!-- 3. Electrifying "POWER TO PROGRESS" Animated Tagline -->
                        <?php 
                        if (function_exists('sibacom_the_electrified_tagline')) {
                            sibacom_the_electrified_tagline($settings['headline']);
                        } else {
                        ?>
                        <div class="sibacom-tagline-electrified-container" role="text" aria-label="<?php echo esc_attr($settings['headline']); ?>">
                            <div class="sibacom-electric-conduit conduit-left" aria-hidden="true"><span class="sibacom-conduit-line"></span><span class="sibacom-conduit-node"><span class="sibacom-conduit-node-spark"></span></span></div>
                            <p class="sibacom-hero-tagline-electrified" aria-hidden="true">
                                <span class="sibacom-electric-word"><span><?php echo esc_html($settings['headline']); ?></span></span>
                                <span class="sibacom-tagline-electric-beam" aria-hidden="true"></span>
                                <span class="sibacom-tagline-aura" aria-hidden="true"></span>
                            </p>
                            <div class="sibacom-electric-conduit conduit-right" aria-hidden="true"><span class="sibacom-conduit-node"><span class="sibacom-conduit-node-spark"></span></span><span class="sibacom-conduit-line"></span></div>
                        </div>
                        <?php } ?>

                        <?php if (!empty($settings['description'])) : ?>
                            <p class="sibacom-hero-description">
                                <?php echo esc_html($settings['description']); ?>
                            </p>
                        <?php endif; ?>

                        <div class="sibacom-meta-bar">
                            <div class="sibacom-meta-item">
                                <i class="fa-regular fa-calendar-days"></i>
                                <span><?php echo esc_html($settings['event_dates']); ?></span>
                            </div>
                            <div class="sibacom-meta-divider"></div>
                            <div class="sibacom-meta-item">
                                <i class="fa-solid fa-location-dot"></i>
                                <span><?php echo esc_html($settings['event_venue']); ?></span>
                            </div>
                            <div class="sibacom-meta-divider"></div>
                            <div class="sibacom-meta-item">
                                <i class="fa-solid fa-users"></i>
                                <span><?php echo esc_html($attendees); ?></span>
                            </div>
                        </div>

                        <div class="sibacom-countdown" data-target-date="<?php echo esc_attr($settings['countdown_date']); ?>">
                            <div class="sibacom-countdown-box">
                                <span class="sibacom-countdown-number days-val">00</span>
                                <span class="sibacom-countdown-label"><?php esc_html_e('Days', 'sibacom-manager'); ?></span>
                            </div>
                            <div class="sibacom-countdown-box">
                                <span class="sibacom-countdown-number hours-val">00</span>
                                <span class="sibacom-countdown-label"><?php esc_html_e('Hours', 'sibacom-manager'); ?></span>
                            </div>
                            <div class="sibacom-countdown-box">
                                <span class="sibacom-countdown-number minutes-val">00</span>
                                <span class="sibacom-countdown-label"><?php esc_html_e('Mins', 'sibacom-manager'); ?></span>
                            </div>
                            <div class="sibacom-countdown-box">
                                <span class="sibacom-countdown-number seconds-val">00</span>
                                <span class="sibacom-countdown-label"><?php esc_html_e('Secs', 'sibacom-manager'); ?></span>
                            </div>
                        </div>

                        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; margin-top: 2.25rem;">
                            <?php if (!empty($settings['cta_text'])) : ?>
                                <a href="<?php echo esc_url($cta_url); ?>" class="sibacom-btn sibacom-btn-primary">
                                    <span><?php echo esc_html($settings['cta_text']); ?></span>
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            <?php endif; ?>
                            <?php if (!empty($settings['sec_text'])) : ?>
                                <a href="<?php echo esc_url($sec_url); ?>" class="sibacom-btn sibacom-btn-secondary">
                                    <span><?php echo esc_html($settings['sec_text']); ?></span>
                                    <i class="fa-solid fa-circle-info"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php
    }
}
