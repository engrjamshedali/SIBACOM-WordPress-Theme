<?php
/**
 * SIBACOM About Section Elementor Widget
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

class SIBACOM_About_Widget extends Widget_Base {

    public function get_name() {
        return 'sibacom_about';
    }

    public function get_title() {
        return esc_html__('SIBACOM About & Vision', 'sibacom-manager');
    }

    public function get_icon() {
        return 'eicon-image-before-after';
    }

    public function get_categories() {
        return array('sibacom-elements');
    }

    protected function register_controls() {
        // CONTENT TAB
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__('About Content & Narrative', 'sibacom-manager'),
            )
        );

        $this->add_control(
            'badge_text',
            array(
                'label'   => esc_html__('Badge Label', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Institutional Excellence',
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__('Heading Title', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => get_option('sibacom_about_title', 'Igniting Technology Leadership Across Pakistan'),
            )
        );

        $this->add_control(
            'description',
            array(
                'label'   => esc_html__('Main Narrative', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => get_option('sibacom_about_description', 'SIBACOM (Sukkur IBA Annual Mega Olympiad) is the flagship national collegiate technology, hackathon, and computing summit presented by Sukkur IBA University, the Department of Computer Systems Engineering (CSE), and SISC Student Council.'),
            )
        );

        $this->add_control(
            'vision_text',
            array(
                'label'   => esc_html__('Our Vision Statement', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => get_option('sibacom_about_vision', 'To cultivate Pakistan’s foremost student technology ecosystem, empowering youth to translate theoretical computational science into sovereign engineering solutions.'),
            )
        );

        $this->add_control(
            'mission_text',
            array(
                'label'   => esc_html__('Our Mission Statement', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => get_option('sibacom_about_mission', 'Providing a transparent, rigorous, and technologically advanced arena where students test hardware-software integration, competitive programming, and ethical AI systems.'),
            )
        );

        $this->add_control(
            'campus_image',
            array(
                'label'   => esc_html__('Campus Showcase Image', 'sibacom-manager'),
                'type'    => Controls_Manager::MEDIA,
                'default' => array(
                    'url' => function_exists('sibacom_get_campus_bg_url') ? sibacom_get_campus_bg_url() : '',
                ),
            )
        );

        // Stats
        $this->add_control(
            'stat1_num',
            array(
                'label'   => esc_html__('Stat 1 Number', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => get_option('sibacom_about_stat1_num', '120+'),
            )
        );
        $this->add_control(
            'stat1_label',
            array(
                'label'   => esc_html__('Stat 1 Label', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => get_option('sibacom_about_stat1_label', 'Participating Universities'),
            )
        );

        $this->add_control(
            'stat2_num',
            array(
                'label'   => esc_html__('Stat 2 Number', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => get_option('sibacom_about_stat2_num', '1,500+'),
            )
        );
        $this->add_control(
            'stat2_label',
            array(
                'label'   => esc_html__('Stat 2 Label', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => get_option('sibacom_about_stat2_label', 'Student Innovators'),
            )
        );

        $this->add_control(
            'stat3_num',
            array(
                'label'   => esc_html__('Stat 3 Number', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => get_option('sibacom_about_stat3_num', 'PKR 1.5M'),
            )
        );
        $this->add_control(
            'stat3_label',
            array(
                'label'   => esc_html__('Stat 3 Label', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => get_option('sibacom_about_stat3_label', 'Prize Pool'),
            )
        );

        $this->add_control(
            'stat4_num',
            array(
                'label'   => esc_html__('Stat 4 Number', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => get_option('sibacom_about_stat4_num', '14+'),
            )
        );
        $this->add_control(
            'stat4_label',
            array(
                'label'   => esc_html__('Stat 4 Label', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => get_option('sibacom_about_stat4_label', 'Competitive Modules'),
            )
        );

        $this->end_controls_section();

        // STYLE TAB
        $this->start_controls_section(
            'section_style',
            array(
                'label' => esc_html__('Colors & Typography', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'title_typography',
                'label'    => esc_html__('Title Typography', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .sibacom-about-title',
            )
        );

        $this->add_control(
            'title_color',
            array(
                'label'     => esc_html__('Title Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#17233D',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-about-title' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $badge    = !empty($settings['badge_text']) ? $settings['badge_text'] : (!empty($settings['section_badge']) ? $settings['section_badge'] : 'Institutional Excellence');
        $title    = !empty($settings['title']) ? $settings['title'] : (!empty($settings['section_title']) ? $settings['section_title'] : get_option('sibacom_about_title', 'Igniting Technology Leadership Across Pakistan'));
        $desc     = !empty($settings['description']) ? $settings['description'] : (!empty($settings['lead_text']) ? $settings['lead_text'] : get_option('sibacom_about_description'));
        $vision   = !empty($settings['vision_text']) ? $settings['vision_text'] : get_option('sibacom_about_vision');
        $mission  = !empty($settings['mission_text']) ? $settings['mission_text'] : get_option('sibacom_about_mission');
        $img_url  = !empty($settings['campus_image']['url']) ? $settings['campus_image']['url'] : (function_exists('sibacom_get_campus_bg_url') ? sibacom_get_campus_bg_url() : '');

        $stat1_num   = !empty($settings['stat1_num']) ? $settings['stat1_num'] : get_option('sibacom_about_stat1_num', '120+');
        $stat1_label = !empty($settings['stat1_label']) ? $settings['stat1_label'] : get_option('sibacom_about_stat1_label', 'Participating Universities');
        $stat2_num   = !empty($settings['stat2_num']) ? $settings['stat2_num'] : get_option('sibacom_about_stat2_num', '1,500+');
        $stat2_label = !empty($settings['stat2_label']) ? $settings['stat2_label'] : get_option('sibacom_about_stat2_label', 'Student Innovators');
        $stat3_num   = !empty($settings['stat3_num']) ? $settings['stat3_num'] : get_option('sibacom_about_stat3_num', 'PKR 1.5M');
        $stat3_label = !empty($settings['stat3_label']) ? $settings['stat3_label'] : get_option('sibacom_about_stat3_label', 'Prize Pool');
        $stat4_num   = !empty($settings['stat4_num']) ? $settings['stat4_num'] : get_option('sibacom_about_stat4_num', '14+');
        $stat4_label = !empty($settings['stat4_label']) ? $settings['stat4_label'] : get_option('sibacom_about_stat4_label', 'Competitive Modules');
        ?>
        <div class="sibacom-widget-wrap">
            <div class="sibacom-about-grid">
                <div class="sibacom-about-content">
                    <?php if (!empty($badge)) : ?>
                        <div class="sibacom-badge" style="margin-bottom: 1rem; align-self: flex-start;">
                            <i class="fa-solid fa-compass" style="color: var(--sibacom-techgreen);"></i>
                            <span><?php echo esc_html($badge); ?></span>
                        </div>
                    <?php endif; ?>

                    <h2 class="font-display sibacom-about-title" style="font-size: clamp(2rem, 3.2vw, 2.75rem); margin-bottom: 1.25rem; line-height: 1.25; color: var(--sibacom-primary);">
                        <?php echo esc_html($title); ?>
                    </h2>

                    <p style="font-size: 1.05rem; line-height: 1.75; margin-bottom: 2rem; color: var(--sibacom-text-secondary);">
                        <?php echo esc_html($desc); ?>
                    </p>

                    <?php if (!empty($vision)) : ?>
                        <div class="sibacom-vision-card neu-card sibacom-card-circuit">
                            <?php if (function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
                            <div style="display: flex; gap: 1.15rem; align-items: flex-start;">
                                <div class="sibacom-vm-icon-box">
                                    <i class="fa-solid fa-eye"></i>
                                </div>
                                <div style="flex: 1;">
                                    <h4 class="font-display" style="color: var(--sibacom-primary); font-size: 1.15rem; margin-bottom: 0.4rem;">
                                        <?php esc_html_e('Our Vision', 'sibacom-manager'); ?>
                                    </h4>
                                    <p style="margin: 0; font-size: 0.95rem; line-height: 1.6; color: var(--sibacom-text-secondary);"><?php echo esc_html($vision); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($mission)) : ?>
                        <div class="sibacom-mission-card neu-card sibacom-card-circuit">
                            <?php if (function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
                            <div style="display: flex; gap: 1.15rem; align-items: flex-start;">
                                <div class="sibacom-vm-icon-box">
                                    <i class="fa-solid fa-bullseye"></i>
                                </div>
                                <div style="flex: 1;">
                                    <h4 class="font-display" style="color: var(--sibacom-techgreen); font-size: 1.15rem; margin-bottom: 0.4rem;">
                                        <?php esc_html_e('Our Mission', 'sibacom-manager'); ?>
                                    </h4>
                                    <p style="margin: 0; font-size: 0.95rem; line-height: 1.6; color: var(--sibacom-text-secondary);"><?php echo esc_html($mission); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Stats & Campus Highlight Card -->
                <div>
                    <div class="sibacom-about-showcase-card sibacom-card-circuit">
                        <?php if (function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
                        <?php if (!empty($img_url)) : ?>
                            <div class="sibacom-campus-img-frame">
                                <img src="<?php echo esc_url($img_url); ?>" alt="<?php esc_attr_e('Sukkur IBA Campus', 'sibacom-manager'); ?>" width="1024" height="576" loading="lazy" decoding="async" />
                                <div class="sibacom-campus-img-overlay">
                                    <span style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.08em; font-weight: 700; color: var(--sibacom-techgreen-light, #10B981); display: block; margin-bottom: 0.2rem;"><?php esc_html_e('Host Institution', 'sibacom-manager'); ?></span>
                                    <strong style="font-size: 0.98rem; font-weight: 700; color: #FFFFFF; display: block; line-height: 1.25;"><?php esc_html_e('Sukkur IBA University Campus', 'sibacom-manager'); ?></strong>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="sibacom-about-stats-grid">
                            <div class="neu-card-flat text-center" style="padding: 1.25rem 0.75rem;">
                                <span class="font-display" style="font-size: 2.1rem; font-weight: 800; color: var(--sibacom-primary); display: block; line-height: 1;"><?php echo esc_html($stat1_num); ?></span>
                                <span style="font-size: 0.75rem; font-weight: 600; color: var(--sibacom-text-secondary); text-transform: uppercase; margin-top: 0.4rem; display: block;"><?php echo esc_html($stat1_label); ?></span>
                            </div>
                            <div class="neu-card-flat text-center" style="padding: 1.25rem 0.75rem;">
                                <span class="font-display" style="font-size: 2.1rem; font-weight: 800; color: var(--sibacom-techgreen); display: block; line-height: 1;"><?php echo esc_html($stat2_num); ?></span>
                                <span style="font-size: 0.75rem; font-weight: 600; color: var(--sibacom-text-secondary); text-transform: uppercase; margin-top: 0.4rem; display: block;"><?php echo esc_html($stat2_label); ?></span>
                            </div>
                            <div class="neu-card-flat text-center" style="padding: 1.25rem 0.75rem;">
                                <span class="font-display" style="font-size: 1.95rem; font-weight: 800; color: var(--sibacom-primary); display: block; line-height: 1;"><?php echo esc_html($stat3_num); ?></span>
                                <span style="font-size: 0.75rem; font-weight: 600; color: var(--sibacom-text-secondary); text-transform: uppercase; margin-top: 0.4rem; display: block;"><?php echo esc_html($stat3_label); ?></span>
                            </div>
                            <div class="neu-card-flat text-center" style="padding: 1.25rem 0.75rem;">
                                <span class="font-display" style="font-size: 2.1rem; font-weight: 800; color: var(--sibacom-navy); display: block; line-height: 1;"><?php echo esc_html($stat4_num); ?></span>
                                <span style="font-size: 0.75rem; font-weight: 600; color: var(--sibacom-text-secondary); text-transform: uppercase; margin-top: 0.4rem; display: block;"><?php echo esc_html($stat4_label); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}

