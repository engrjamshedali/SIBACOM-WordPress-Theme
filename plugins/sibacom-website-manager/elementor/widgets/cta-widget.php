<?php
/**
 * SIBACOM Final Participation CTA Elementor Widget
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

class SIBACOM_CTA_Widget extends Widget_Base {

    public function get_name() {
        return 'sibacom_cta_banner';
    }

    public function get_title() {
        return esc_html__('SIBACOM Participation CTA Banner', 'sibacom-manager');
    }

    public function get_icon() {
        return 'eicon-call-to-action';
    }

    public function get_categories() {
        return array('sibacom-elements');
    }

    protected function register_controls() {
        // CONTENT TAB
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__('Banner Content', 'sibacom-manager'),
            )
        );

        $this->add_control(
            'badge',
            array(
                'label'   => esc_html__('Top Badge Text', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Be Part of the Innovation Summit',
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__('Heading Title', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Join Over 1,500+ Innovators at SIBACOM',
            )
        );

        $this->add_control(
            'description',
            array(
                'label'   => esc_html__('Description Paragraph', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => 'Represent your university, compete for national prestige and cash prizes, and showcase your engineering capabilities before industry leaders.',
            )
        );

        $this->add_control(
            'btn_text',
            array(
                'label'   => esc_html__('CTA Button Text', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Get Your Event Pass Today',
            )
        );

        $this->add_control(
            'btn_url',
            array(
                'label'   => esc_html__('CTA Button URL', 'sibacom-manager'),
                'type'    => Controls_Manager::URL,
                'default' => array(
                    'url' => 'https://portal.sibacom.tech/',
                ),
            )
        );

        $this->end_controls_section();

        // STYLE TAB
        $this->start_controls_section(
            'section_style',
            array(
                'label' => esc_html__('Banner Appearance', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'title_typography',
                'label'    => esc_html__('Title Typography', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} h2',
            )
        );

        $this->add_control(
            'bg_gradient_start',
            array(
                'label'   => esc_html__('Gradient Start Color', 'sibacom-manager'),
                'type'    => Controls_Manager::COLOR,
                'default' => '#102E68',
            )
        );

        $this->add_control(
            'bg_gradient_end',
            array(
                'label'   => esc_html__('Gradient End Color', 'sibacom-manager'),
                'type'    => Controls_Manager::COLOR,
                'default' => '#173F91',
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $url      = !empty($settings['btn_url']['url']) ? $settings['btn_url']['url'] : 'https://portal.sibacom.tech/';
        $g_start  = !empty($settings['bg_gradient_start']) ? $settings['bg_gradient_start'] : '#102E68';
        $g_end    = !empty($settings['bg_gradient_end']) ? $settings['bg_gradient_end'] : '#173F91';
        ?>
        <div class="sibacom-widget-wrap">
            <div class="neu-card sibacom-final-cta-card" style="background: linear-gradient(135deg, <?php echo esc_attr($g_start); ?> 0%, <?php echo esc_attr($g_end); ?> 100%); color: #fff; text-align: center; padding: 4.5rem 2rem; position: relative; overflow: hidden; border-radius: var(--radius-lg);">
                <div style="position: absolute; right: -80px; bottom: -80px; width: 320px; height: 320px; border-radius: 50%; background: radial-gradient(circle, rgba(7, 155, 88, 0.25) 0%, transparent 70%); pointer-events: none;"></div>
                <div style="position: relative; z-index: 2; max-width: 720px; margin: 0 auto;">
                    <?php if (!empty($settings['badge'])) : ?>
                        <span class="sibacom-badge" style="background: rgba(255, 255, 255, 0.12); color: #fff; border-color: rgba(255, 255, 255, 0.25); box-shadow: none; margin-bottom: 1.25rem;">
                            <span class="pulse-dot"></span>
                            <span><?php echo esc_html($settings['badge']); ?></span>
                        </span>
                    <?php endif; ?>

                    <h2 class="font-display" style="color: #fff; font-size: clamp(2rem, 4vw, 3rem); margin-bottom: 1.25rem; line-height: 1.2;">
                        <?php echo esc_html($settings['title']); ?>
                    </h2>

                    <p style="color: #CBD5E1; font-size: 1.1rem; line-height: 1.7; margin-bottom: 2.25rem;">
                        <?php echo esc_html($settings['description']); ?>
                    </p>

                    <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" class="sibacom-btn sibacom-btn-tech" style="font-size: 1.05rem; padding: 1rem 2.5rem;">
                        <span><?php echo esc_html($settings['btn_text']); ?></span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <?php
    }
}

