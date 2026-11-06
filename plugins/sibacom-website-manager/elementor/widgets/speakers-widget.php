<?php
/**
 * SIBACOM Speakers Grid Elementor Widget
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

class SIBACOM_Speakers_Widget extends Widget_Base {

    public function get_name() {
        return 'sibacom_speakers';
    }

    public function get_title() {
        return esc_html__('SIBACOM Speakers & Judges Grid', 'sibacom-manager');
    }

    public function get_icon() {
        return 'eicon-person';
    }

    public function get_categories() {
        return array('sibacom-elements');
    }

    protected function register_controls() {
        // CONTENT TAB: Query & Mode
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__('Speakers & Judges Query & Display', 'sibacom-manager'),
            )
        );

        $this->add_control(
            'data_mode',
            array(
                'label'   => esc_html__('Data Source Mode', 'sibacom-manager'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'dynamic',
                'options' => array(
                    'dynamic' => esc_html__('Dynamic (WordPress SIBACOM Speakers & Judges CPT)', 'sibacom-manager'),
                    'manual'  => esc_html__('Custom Manual Repeater (Visual Editor)', 'sibacom-manager'),
                ),
            )
        );

        $this->add_control(
            'role_filter',
            array(
                'label'   => esc_html__('Filter Profiles by Role', 'sibacom-manager'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'all',
                'options' => array(
                    'all'     => esc_html__('All Profiles (2 Speakers + 2 Judges)', 'sibacom-manager'),
                    'speaker' => esc_html__('Speakers Only (2 Keynote/Guest Speakers)', 'sibacom-manager'),
                    'judge'   => esc_html__('Judges Only (2 Competition/Industry Judges)', 'sibacom-manager'),
                ),
            )
        );

        $this->add_control(
            'columns',
            array(
                'label'   => esc_html__('Grid Columns', 'sibacom-manager'),
                'type'    => Controls_Manager::SELECT,
                'default' => '4',
                'options' => array(
                    '2' => esc_html__('2 Columns', 'sibacom-manager'),
                    '3' => esc_html__('3 Columns', 'sibacom-manager'),
                    '4' => esc_html__('4 Columns (Recommended for 4 Profile Cards)', 'sibacom-manager'),
                ),
            )
        );

        $this->add_control(
            'limit',
            array(
                'label'     => esc_html__('Number of Profiles to Display (-1 for All)', 'sibacom-manager'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 4,
                'condition' => array(
                    'data_mode' => 'dynamic',
                ),
            )
        );

        $this->add_control(
            'category_filter',
            array(
                'label'       => esc_html__('Filter by Category Slug (Optional)', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => 'e.g. keynote-speakers or competition-judges',
                'condition'   => array(
                    'data_mode' => 'dynamic',
                ),
            )
        );

        $this->add_control(
            'featured_only',
            array(
                'label'        => esc_html__('Only Featured Profiles', 'sibacom-manager'),
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

        // Manual Repeater for Visual In-Editor Editing
        $repeater = new Repeater();

        $repeater->add_control(
            'spk_name',
            array(
                'label'   => esc_html__('Full Name', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Dr. Asim Khwaja',
            )
        );

        $repeater->add_control(
            'spk_role_type',
            array(
                'label'   => esc_html__('Role Classification', 'sibacom-manager'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'speaker',
                'options' => array(
                    'speaker' => esc_html__('Speaker', 'sibacom-manager'),
                    'judge'   => esc_html__('Judge / Jury', 'sibacom-manager'),
                ),
            )
        );

        $repeater->add_control(
            'spk_category',
            array(
                'label'   => esc_html__('Category Badge', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Keynote Speaker',
            )
        );

        $repeater->add_control(
            'spk_designation',
            array(
                'label'   => esc_html__('Designation', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Director of Applied AI & Researcher',
            )
        );

        $repeater->add_control(
            'spk_org',
            array(
                'label'   => esc_html__('Institution / Company', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Center for Frontier Computing',
            )
        );

        $repeater->add_control(
            'spk_topic',
            array(
                'label'   => esc_html__('Keynote Topic / Jury Domain', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Engineering Scalable AI Systems for Developing Nations',
            )
        );

        $repeater->add_control(
            'spk_bio',
            array(
                'label'   => esc_html__('Brief Bio', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => 'Pioneering researcher in sovereign machine intelligence, localized language models, and high-throughput computational architectures.',
            )
        );

        $repeater->add_control(
            'spk_photo',
            array(
                'label'   => esc_html__('Profile Photograph', 'sibacom-manager'),
                'type'    => Controls_Manager::MEDIA,
                'default' => array(
                    'url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80',
                ),
            )
        );

        $repeater->add_control(
            'spk_linkedin',
            array(
                'label'   => esc_html__('LinkedIn Profile URL', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'https://linkedin.com',
            )
        );

        $repeater->add_control(
            'spk_twitter',
            array(
                'label'   => esc_html__('Twitter / X Profile URL', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'https://x.com',
            )
        );

        $repeater->add_control(
            'spk_github',
            array(
                'label'   => esc_html__('GitHub / Portfolio URL', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'https://github.com',
            )
        );

        // Preload default 4 profile cards (4 competition judges) in manual mode
        $default_manual_items = array(
            array(
                'spk_name'        => 'Dr. Bushra Naeem',
                'spk_role_type'   => 'judge',
                'spk_category'    => 'Competition Judge',
                'spk_designation' => 'Associate Professor & Lead AI / Robotics Jury',
                'spk_org'         => 'Sukkur IBA University',
                'spk_topic'       => 'Algorithmic Resilience & Autonomous Robotics Adjudication',
                'spk_bio'         => 'Senior research evaluator with deep expertise in embedded computer vision, smart robotics, and high-stakes coding evaluations.',
                'spk_photo'       => array('url' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80'),
                'spk_linkedin'    => 'https://linkedin.com',
                'spk_twitter'     => 'https://x.com',
                'spk_github'      => 'https://github.com',
            ),
            array(
                'spk_name'        => 'Tariq Mehmood',
                'spk_role_type'   => 'judge',
                'spk_category'    => 'Industry Judge',
                'spk_designation' => 'Chief Technology Officer & Hackathon Judge',
                'spk_org'         => 'Techlogix Pakistan',
                'spk_topic'       => 'Commercial Scalability & Full-Stack System Architectures',
                'spk_bio'         => 'Enterprise technology executive and software judge evaluating speed-programming, database optimization, and venture-ready technical solutions.',
                'spk_photo'       => array('url' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=400&q=80'),
                'spk_linkedin'    => 'https://linkedin.com',
                'spk_twitter'     => 'https://x.com',
                'spk_github'      => 'https://github.com',
            ),
            array(
                'spk_name'        => 'Dr. Asim Khwaja',
                'spk_role_type'   => 'judge',
                'spk_category'    => 'Competition Judge',
                'spk_designation' => 'Director of Applied AI & Hackathon Jury Chair',
                'spk_org'         => 'Center for Frontier Computing & AI',
                'spk_topic'       => 'Frontier AI Models & Machine Intelligence Benchmarking',
                'spk_bio'         => 'Pioneering researcher in machine intelligence, high-throughput computational architectures, and algorithmic competition benchmarking.',
                'spk_photo'       => array('url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80'),
                'spk_linkedin'    => 'https://linkedin.com',
                'spk_twitter'     => 'https://x.com',
                'spk_github'      => 'https://github.com',
            ),
            array(
                'spk_name'        => 'Engr. Faraz Ahmed',
                'spk_role_type'   => 'judge',
                'spk_category'    => 'Industry Judge',
                'spk_designation' => 'Principal Cloud Architect & Speed-Programming Judge',
                'spk_org'         => 'Systems Limited',
                'spk_topic'       => 'Cloud-Native Microservices & High-Scale Systems',
                'spk_bio'         => 'Industry veteran evaluating enterprise software architecture, low-latency microservices, and speed-programming competitions.',
                'spk_photo'       => array('url' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=400&q=80'),
                'spk_linkedin'    => 'https://linkedin.com',
                'spk_twitter'     => 'https://x.com',
                'spk_github'      => 'https://github.com',
            ),
        );

        $this->add_control(
            'manual_speakers',
            array(
                'label'       => esc_html__('Editable Profile Cards (4 Competition Judges)', 'sibacom-manager'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => $default_manual_items,
                'title_field' => '{{{ spk_name }}} ({{{ spk_category }}})',
                'condition'   => array(
                    'data_mode' => 'manual',
                ),
            )
        );

        $this->end_controls_section();

        // STYLE TAB
        $this->start_controls_section(
            'section_style_speaker',
            array(
                'label' => esc_html__('Speaker & Judge Cards Appearance', 'sibacom-manager'),
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
                    '{{WRAPPER}} .sibacom-speaker-card' => 'background-color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'name_typography',
                'label'    => esc_html__('Name Typography', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .sibacom-speaker-name',
            )
        );

        $this->add_control(
            'name_color',
            array(
                'label'     => esc_html__('Name Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#17233D',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-speaker-name' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'card_shadow',
                'label'    => esc_html__('Card Shadow', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .sibacom-speaker-card',
            )
        );

        $this->end_controls_section();

        // Style Tab: Card Circuit Accents & Pulse Glow
        $this->start_controls_section(
            'section_style_speaker_circuits',
            array(
                'label' => esc_html__('Circuit Accents & Edge Signals', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'enable_speaker_circuits',
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
            'circuit_accent_color',
            array(
                'label'     => esc_html__('Circuit Accent Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => 'rgba(23, 63, 145, 0.22)',
                'selectors' => array(
                    '{{WRAPPER}}' => '--sibacom-circuit-trace: {{VALUE}};',
                ),
                'condition' => array('enable_speaker_circuits' => 'yes'),
            )
        );

        $this->add_control(
            'circuit_glow_color',
            array(
                'label'     => esc_html__('Signal Glow Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#079B58',
                'selectors' => array(
                    '{{WRAPPER}}' => '--sibacom-circuit-techgreen: {{VALUE}};',
                ),
                'condition' => array('enable_speaker_circuits' => 'yes'),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $mode     = $settings['data_mode'];
        $cols     = !empty($settings['columns']) ? $settings['columns'] : '4';
        $limit    = !empty($settings['limit']) ? $settings['limit'] : 4;
        $featured = !empty($settings['featured_only']) ? 'yes' : '';
        $cat      = !empty($settings['category_filter']) ? $settings['category_filter'] : '';
        $role     = !empty($settings['role_filter']) ? $settings['role_filter'] : 'all';

        if ($mode === 'dynamic') {
            if (class_exists('SIBACOM_Shortcodes')) {
                echo SIBACOM_Shortcodes::render_speakers(array(
                    'limit'     => $limit,
                    'featured'  => $featured,
                    'category'  => $cat,
                    'role_type' => $role,
                    'columns'   => $cols,
                    'fallback'  => 'yes',
                ));
            }
        } else {
            $speakers = !empty($settings['manual_speakers']) ? $settings['manual_speakers'] : array();
            
            // Filter by role if requested in manual mode
            if ($role !== 'all') {
                $speakers = array_filter($speakers, function($s) use ($role) {
                    $item_role = !empty($s['spk_role_type']) ? $s['spk_role_type'] : 'speaker';
                    return $item_role === $role;
                });
            }
            ?>
            <div class="sibacom-speakers-grid col-<?php echo esc_attr($cols); ?>">
                <?php foreach ($speakers as $s) : 
                    $photo_url   = !empty($s['spk_photo']['url']) ? $s['spk_photo']['url'] : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80';
                    $is_judge    = (!empty($s['spk_role_type']) && $s['spk_role_type'] === 'judge') || (!empty($s['spk_category']) && (stripos($s['spk_category'], 'judge') !== false || stripos($s['spk_category'], 'jury') !== false));
                    $badge_icon  = $is_judge ? 'fa-solid fa-gavel' : 'fa-solid fa-microphone-lines';
                    $topic_label = $is_judge ? esc_html__('Jury Track / Domain', 'sibacom-manager') : esc_html__('Keynote Topic', 'sibacom-manager');
                    $cat_slug    = !empty($s['spk_category']) ? strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $s['spk_category'])) : ($is_judge ? 'judge' : 'speaker');
                    ?>
                    <div class="sibacom-speaker-card neu-card sibacom-card-circuit <?php echo $is_judge ? 'is-judge-card' : 'is-speaker-card'; ?>" data-category="<?php echo esc_attr($cat_slug); ?>">
                        <?php if ((!isset($settings['enable_speaker_circuits']) || $settings['enable_speaker_circuits'] !== 'no') && function_exists('sibacom_the_circuit_corner')) : ?>
                            <?php sibacom_the_circuit_corner('tl'); ?>
                            <?php sibacom_the_circuit_corner('br'); ?>
                        <?php endif; ?>
                        <div class="sibacom-speaker-img-wrap">
                            <img src="<?php echo esc_url($photo_url); ?>" alt="<?php echo esc_attr($s['spk_name']); ?>" width="96" height="96" loading="lazy" decoding="async">
                        </div>

                        <?php if (!empty($s['spk_category'])) : ?>
                            <span class="sibacom-speaker-badge <?php echo $is_judge ? 'judge-badge' : ''; ?>">
                                <i class="<?php echo esc_attr($badge_icon); ?>" style="margin-right: 4px;"></i>
                                <?php echo esc_html($s['spk_category']); ?>
                            </span>
                        <?php endif; ?>

                        <h3 class="sibacom-speaker-name font-display"><?php echo esc_html($s['spk_name']); ?></h3>
                        <?php if (!empty($s['spk_designation'])) : ?>
                            <p class="sibacom-speaker-designation"><?php echo esc_html($s['spk_designation']); ?></p>
                        <?php endif; ?>
                        <?php if (!empty($s['spk_org'])) : ?>
                            <p class="sibacom-speaker-org"><?php echo esc_html($s['spk_org']); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($s['spk_topic'])) : ?>
                            <div class="sibacom-speaker-topic">
                                <span class="topic-label"><?php echo esc_html($topic_label); ?></span>
                                <?php echo esc_html($s['spk_topic']); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($s['spk_bio'])) : ?>
                            <div class="sibacom-speaker-bio">
                                <?php echo esc_html($s['spk_bio']); ?>
                            </div>
                        <?php endif; ?>

                        <div class="sibacom-speaker-social">
                            <?php if (!empty($s['spk_linkedin'])) : ?>
                                <a href="<?php echo esc_url($s['spk_linkedin']); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                            <?php endif; ?>
                            <?php if (!empty($s['spk_twitter'])) : ?>
                                <a href="<?php echo esc_url($s['spk_twitter']); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
                            <?php endif; ?>
                            <?php if (!empty($s['spk_github'])) : ?>
                                <a href="<?php echo esc_url($s['spk_github']); ?>" target="_blank" rel="noopener noreferrer" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php
        }
    }
}
