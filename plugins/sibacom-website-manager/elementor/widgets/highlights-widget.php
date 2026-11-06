<?php
/**
 * SIBACOM Highlights Grid Elementor Widget
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

class SIBACOM_Highlights_Widget extends Widget_Base {

    public function get_name() {
        return 'sibacom_highlights';
    }

    public function get_title() {
        return esc_html__('SIBACOM Highlights Grid', 'sibacom-manager');
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return array('sibacom-elements');
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__('Highlight Cards', 'sibacom-manager'),
            )
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'card_title',
            array(
                'label'   => esc_html__('Title', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Competition Track',
            )
        );

        $repeater->add_control(
            'card_badge',
            array(
                'label'   => esc_html__('Badge Tag', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'National Olympiad',
            )
        );

        $repeater->add_control(
            'card_icon',
            array(
                'label'   => esc_html__('FontAwesome Icon Class', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'fa-code',
            )
        );

        $repeater->add_control(
            'card_desc',
            array(
                'label'   => esc_html__('Description', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => 'Description of the competitive track, laboratory sandbox, or engineering challenge.',
            )
        );

        $this->add_control(
            'cards',
            array(
                'label'       => esc_html__('Highlight Items', 'sibacom-manager'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ card_title }}}',
                'default'     => array(
                    array(
                        'card_title' => 'Speed Programming',
                        'card_badge' => 'Collegiate League',
                        'card_icon'  => 'fa-code',
                        'card_desc'  => 'Timed algorithmic coding league featuring strict automated test suites in C++, Java, and Python under ACM-ICPC rules.',
                    ),
                    array(
                        'card_title' => 'Hackathon 24H',
                        'card_badge' => 'Product Sprint',
                        'card_icon'  => 'fa-laptop-code',
                        'card_desc'  => 'High-intensity continuous product ideation and build sprint across AI agents, smart cities, and fintech infrastructure.',
                    ),
                    array(
                        'card_title' => 'Capture The Flag (CTF)',
                        'card_badge' => 'Cyber Security',
                        'card_icon'  => 'fa-shield-halved',
                        'card_desc'  => 'Jeopardy-style offensive & defensive cyber defense challenge: binary exploitation, cryptography, and digital forensics.',
                    ),
                    array(
                        'card_title' => 'RoboWars & Automation',
                        'card_badge' => 'Hardware Arena',
                        'card_icon'  => 'fa-robot',
                        'card_desc'  => 'Combat robot clashes, autonomous line-following micro-mazes, and embedded hardware sensor challenges.',
                    ),
                    array(
                        'card_title' => 'AI Agent Challenge',
                        'card_badge' => 'Frontier AI',
                        'card_icon'  => 'fa-brain',
                        'card_desc'  => 'Frontier machine learning workflows, multi-agent orchestrations, and prompt-tuning benchmarks.',
                    ),
                    array(
                        'card_title' => 'Startup Showcase & Pitch',
                        'card_badge' => 'Venture Capital',
                        'card_icon'  => 'fa-rocket',
                        'card_desc'  => 'Venture showcase where student founders pitch innovative prototypes directly to accredited angel investors.',
                    ),
                ),
            )
        );

        $this->end_controls_section();

        // Style Tab
        $this->start_controls_section(
            'section_style_card',
            array(
                'label' => esc_html__('Card Styling', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'card_bg_color',
            array(
                'label'     => esc_html__('Card Background', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FFFFFF',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-highlight-card' => 'background-color: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'title_color',
            array(
                'label'     => esc_html__('Title Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#17233D',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-highlight-card h3' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="sibacom-widget-wrap">
            <div class="sibacom-highlights-grid">
                <?php if (!empty($settings['cards'])) : ?>
                    <?php foreach ($settings['cards'] as $c) : ?>
                        <div class="sibacom-highlight-card">
                            <div class="sibacom-highlight-icon">
                                <i class="fa-solid <?php echo esc_attr($c['card_icon']); ?>"></i>
                            </div>
                            <?php if (!empty($c['card_badge'])) : ?>
                                <span style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; color: var(--sibacom-techgreen); letter-spacing: 0.08em; margin-bottom: 0.5rem; display: block;">
                                    <?php echo esc_html($c['card_badge']); ?>
                                </span>
                            <?php endif; ?>
                            <h3 class="font-display" style="font-size: 1.35rem; margin-bottom: 0.75rem;">
                                <?php echo esc_html($c['card_title']); ?>
                            </h3>
                            <p style="font-size: 0.92rem; color: var(--sibacom-text-secondary); line-height: 1.65; margin: 0;">
                                <?php echo esc_html($c['card_desc']); ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}

