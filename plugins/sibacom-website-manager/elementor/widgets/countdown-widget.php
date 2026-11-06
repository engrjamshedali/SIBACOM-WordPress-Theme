<?php
/**
 * SIBACOM Countdown Elementor Widget
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

class SIBACOM_Countdown_Widget extends Widget_Base {

    public function get_name() {
        return 'sibacom_countdown';
    }

    public function get_title() {
        return esc_html__('SIBACOM Event Countdown', 'sibacom-manager');
    }

    public function get_icon() {
        return 'eicon-countdown';
    }

    public function get_categories() {
        return array('sibacom-elements');
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__('Countdown Settings', 'sibacom-manager'),
            )
        );

        $this->add_control(
            'target_date',
            array(
                'label'   => esc_html__('Target Launch Date', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => get_option('sibacom_hero_countdown_date', '2026-11-30T09:00:00'),
                'description' => esc_html__('Format: YYYY-MM-DDTHH:MM:SS (e.g. 2026-11-30T09:00:00)', 'sibacom-manager'),
            )
        );

        $this->add_control(
            'completed_msg',
            array(
                'label'       => esc_html__('Completed Event Message', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'The SIBACOM Summit is in Progress!',
                'description' => esc_html__('Displayed once countdown reaches zero.', 'sibacom-manager'),
            )
        );

        $this->end_controls_section();

        // Style Tab
        $this->start_controls_section(
            'section_style',
            array(
                'label' => esc_html__('Digits Style', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'digit_color',
            array(
                'label'     => esc_html__('Digits Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#173F91',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-countdown-number' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'label_color',
            array(
                'label'     => esc_html__('Labels Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#64748B',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-countdown-label' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $target   = !empty($settings['target_date']) ? $settings['target_date'] : '2026-11-30T09:00:00';
        $completed = !empty($settings['completed_msg']) ? $settings['completed_msg'] : 'The SIBACOM Summit is in Progress!';
        ?>
        <div class="sibacom-widget-wrap">
            <div class="sibacom-countdown" data-target-date="<?php echo esc_attr($target); ?>" data-completed-msg="<?php echo esc_attr($completed); ?>" data-show-completed="true">
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
        </div>
        <?php
    }
}

