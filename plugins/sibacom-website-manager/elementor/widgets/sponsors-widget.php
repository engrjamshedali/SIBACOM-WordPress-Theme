<?php
/**
 * SIBACOM Sponsors Elementor Widget
 *
 * @package SIBACOM_Website_Manager
 */

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Box_Shadow;

class SIBACOM_Sponsors_Widget extends Widget_Base {

    public function get_name() {
        return 'sibacom_sponsors';
    }

    public function get_title() {
        return esc_html__('SIBACOM Sponsor Gallery', 'sibacom-manager');
    }

    public function get_icon() {
        return 'eicon-image-box';
    }

    public function get_categories() {
        return array('sibacom-elements');
    }

    protected function register_controls() {
        // CONTENT TAB
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__('Sponsors Setup & Mode', 'sibacom-manager'),
            )
        );

        $this->add_control(
            'data_mode',
            array(
                'label'   => esc_html__('Data Source Mode', 'sibacom-manager'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'dynamic',
                'options' => array(
                    'dynamic' => esc_html__('Dynamic (WordPress Sponsors CPT)', 'sibacom-manager'),
                    'manual'  => esc_html__('Custom Manual Sponsors (Visual Repeater)', 'sibacom-manager'),
                ),
            )
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'sponsor_name',
            array(
                'label'   => esc_html__('Sponsor Name', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Higher Education Commission (HEC)',
            )
        );

        $repeater->add_control(
            'sponsor_tier',
            array(
                'label'   => esc_html__('Tier Category', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Title Sponsor',
            )
        );

        $repeater->add_control(
            'sponsor_logo',
            array(
                'label'   => esc_html__('Logo Image', 'sibacom-manager'),
                'type'    => Controls_Manager::MEDIA,
            )
        );

        $repeater->add_control(
            'sponsor_url',
            array(
                'label'   => esc_html__('Website Link', 'sibacom-manager'),
                'type'    => Controls_Manager::URL,
                'default' => array(
                    'url' => 'https://hec.gov.pk',
                ),
            )
        );

        $this->add_control(
            'manual_sponsors',
            array(
                'label'       => esc_html__('Manual Sponsor Entries', 'sibacom-manager'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ sponsor_name }}} ({{{ sponsor_tier }}})',
                'condition'   => array(
                    'data_mode' => 'manual',
                ),
            )
        );

        $this->end_controls_section();

        // STYLE TAB
        $this->start_controls_section(
            'section_style_sponsors',
            array(
                'label' => esc_html__('Sponsor Card Appearance', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'card_bg',
            array(
                'label'     => esc_html__('Card Background', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FFFFFF',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-sponsor-card' => 'background-color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'card_shadow',
                'label'    => esc_html__('Card Shadow', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .sibacom-sponsor-card',
            )
        );

        $this->add_control(
            'logo_height',
            array(
                'label'      => esc_html__('Max Logo Height (px)', 'sibacom-manager'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px'),
                'range'      => array('px' => array('min' => 20, 'max' => 120)),
                'default'    => array('unit' => 'px', 'size' => 45),
                'selectors'  => array(
                    '{{WRAPPER}} .sibacom-sponsor-card img' => 'max-height: {{SIZE}}{{UNIT}};',
                ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $mode     = $settings['data_mode'];

        if ($mode === 'dynamic') {
            if (class_exists('SIBACOM_Shortcodes')) {
                echo SIBACOM_Shortcodes::render_sponsors(array());
            }
        } else {
            $sponsors = !empty($settings['manual_sponsors']) ? $settings['manual_sponsors'] : array();
            // Group by tier
            $by_tier = array();
            foreach ($sponsors as $s) {
                $tier = !empty($s['sponsor_tier']) ? $s['sponsor_tier'] : 'Partners';
                $by_tier[$tier][] = $s;
            }

            foreach ($by_tier as $tier_name => $items) : ?>
                <div class="sibacom-sponsors-tier">
                    <span class="sibacom-sponsors-tier-title"><?php echo esc_html($tier_name); ?></span>
                    <div class="sibacom-sponsors-grid">
                        <?php foreach ($items as $s) : 
                            $logo_url = !empty($s['sponsor_logo']['url']) ? $s['sponsor_logo']['url'] : '';
                            $url      = !empty($s['sponsor_url']['url']) ? $s['sponsor_url']['url'] : '#';
                            ?>
                            <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" class="sibacom-sponsor-card neu-card" title="<?php echo esc_attr($s['sponsor_name']); ?>">
                                <?php if (!empty($logo_url)) : ?>
                                    <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($s['sponsor_name']); ?>" width="160" height="55" loading="lazy" decoding="async">
                                <?php else : ?>
                                    <span class="font-display" style="font-weight: 700; color: var(--sibacom-primary); font-size: 1.1rem;"><?php echo esc_html($s['sponsor_name']); ?></span>
                                <?php endif; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach;
        }
    }
}
