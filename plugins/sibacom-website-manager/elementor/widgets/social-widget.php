<?php
/**
 * SIBACOM Social Links Elementor Widget
 *
 * @package SIBACOM_Website_Manager
 */

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class SIBACOM_Social_Widget extends Widget_Base {

    public function get_name() {
        return 'sibacom_social';
    }

    public function get_title() {
        return esc_html__('SIBACOM Social Links', 'sibacom-manager');
    }

    public function get_icon() {
        return 'eicon-social-icons';
    }

    public function get_categories() {
        return array('sibacom-elements');
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__('Social URLs', 'sibacom-manager'),
            )
        );

        $this->add_control(
            'linkedin',
            array(
                'label'   => esc_html__('LinkedIn URL', 'sibacom-manager'),
                'type'    => Controls_Manager::URL,
                'default' => array(
                    'url' => get_option('sibacom_social_linkedin', 'https://www.linkedin.com/school/sukkur-iba-university/'),
                ),
            )
        );

        $this->add_control(
            'twitter',
            array(
                'label'   => esc_html__('Twitter / X URL', 'sibacom-manager'),
                'type'    => Controls_Manager::URL,
                'default' => array(
                    'url' => get_option('sibacom_social_twitter', 'https://twitter.com'),
                ),
            )
        );

        $this->add_control(
            'facebook',
            array(
                'label'   => esc_html__('Facebook URL', 'sibacom-manager'),
                'type'    => Controls_Manager::URL,
                'default' => array(
                    'url' => get_option('sibacom_social_facebook', 'https://facebook.com'),
                ),
            )
        );

        $this->add_control(
            'instagram',
            array(
                'label'   => esc_html__('Instagram URL', 'sibacom-manager'),
                'type'    => Controls_Manager::URL,
                'default' => array(
                    'url' => get_option('sibacom_social_instagram', 'https://instagram.com'),
                ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="sibacom-widget-wrap">
            <div style="display: flex; gap: 0.85rem; align-items: center;">
                <?php if (!empty($settings['linkedin']['url'])) : ?>
                    <a href="<?php echo esc_url($settings['linkedin']['url']); ?>" target="_blank" rel="noopener noreferrer" style="width: 40px; height: 40px; border-radius: 50%; background: var(--sibacom-white); box-shadow: var(--neu-raised); border: 1px solid var(--sibacom-border-neu); display: flex; align-items: center; justify-content: center; color: var(--sibacom-primary); font-size: 1rem;"><i class="fa-brands fa-linkedin-in"></i></a>
                <?php endif; ?>
                <?php if (!empty($settings['twitter']['url'])) : ?>
                    <a href="<?php echo esc_url($settings['twitter']['url']); ?>" target="_blank" rel="noopener noreferrer" style="width: 40px; height: 40px; border-radius: 50%; background: var(--sibacom-white); box-shadow: var(--neu-raised); border: 1px solid var(--sibacom-border-neu); display: flex; align-items: center; justify-content: center; color: var(--sibacom-primary); font-size: 1rem;"><i class="fa-brands fa-x-twitter"></i></a>
                <?php endif; ?>
                <?php if (!empty($settings['facebook']['url'])) : ?>
                    <a href="<?php echo esc_url($settings['facebook']['url']); ?>" target="_blank" rel="noopener noreferrer" style="width: 40px; height: 40px; border-radius: 50%; background: var(--sibacom-white); box-shadow: var(--neu-raised); border: 1px solid var(--sibacom-border-neu); display: flex; align-items: center; justify-content: center; color: var(--sibacom-primary); font-size: 1rem;"><i class="fa-brands fa-facebook-f"></i></a>
                <?php endif; ?>
                <?php if (!empty($settings['instagram']['url'])) : ?>
                    <a href="<?php echo esc_url($settings['instagram']['url']); ?>" target="_blank" rel="noopener noreferrer" style="width: 40px; height: 40px; border-radius: 50%; background: var(--sibacom-white); box-shadow: var(--neu-raised); border: 1px solid var(--sibacom-border-neu); display: flex; align-items: center; justify-content: center; color: var(--sibacom-primary); font-size: 1rem;"><i class="fa-brands fa-instagram"></i></a>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}

