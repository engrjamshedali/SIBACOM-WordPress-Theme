<?php
/**
 * SIBACOM Dedicated Guests Elementor Widget
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

class SIBACOM_Guests_Widget extends Widget_Base {

    public function get_name() {
        return 'sibacom_guests';
    }

    public function get_title() {
        return esc_html__('SIBACOM Chief & Distinguished Guests', 'sibacom-manager');
    }

    public function get_icon() {
        return 'eicon-user';
    }

    public function get_categories() {
        return array('sibacom-elements');
    }

    protected function register_controls() {
        // CONTENT TAB
        $this->start_controls_section(
            'section_content_source',
            array(
                'label' => esc_html__('Guests Query & Mode', 'sibacom-manager'),
            )
        );

        $this->add_control(
            'data_mode',
            array(
                'label'   => esc_html__('Data Source Mode', 'sibacom-manager'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'dynamic',
                'options' => array(
                    'dynamic' => esc_html__('Dynamic (WordPress SIBACOM Guests CPT)', 'sibacom-manager'),
                    'manual'  => esc_html__('Custom Manual Guests (Visual Repeater)', 'sibacom-manager'),
                ),
            )
        );

        $this->add_control(
            'columns',
            array(
                'label'   => esc_html__('Grid Columns', 'sibacom-manager'),
                'type'    => Controls_Manager::SELECT,
                'default' => '3',
                'options' => array(
                    '2' => esc_html__('2 Columns (Prominent Portraits)', 'sibacom-manager'),
                    '3' => esc_html__('3 Columns (Standard Grid)', 'sibacom-manager'),
                    '4' => esc_html__('4 Columns (Compact Grid)', 'sibacom-manager'),
                ),
            )
        );

        $this->add_control(
            'limit',
            array(
                'label'     => esc_html__('Number of Guests to Display (-1 for All)', 'sibacom-manager'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 3,
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
                'placeholder' => 'e.g. chief-guests or special-guests',
                'condition'   => array(
                    'data_mode' => 'dynamic',
                ),
            )
        );

        // Manual Repeater
        $repeater = new Repeater();

        $repeater->add_control(
            'guest_name',
            array(
                'label'   => esc_html__('Full Name', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Engr. Dr. Zahid Hussain',
            )
        );

        $repeater->add_control(
            'guest_category',
            array(
                'label'   => esc_html__('Category Tier', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Chief Guest & Patron',
            )
        );

        $repeater->add_control(
            'guest_designation',
            array(
                'label'   => esc_html__('Designation', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Vice Chancellor & Chief Patron',
            )
        );

        $repeater->add_control(
            'guest_org',
            array(
                'label'   => esc_html__('Institution / Organization', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Sukkur IBA University',
            )
        );

        $repeater->add_control(
            'guest_bio',
            array(
                'label'   => esc_html__('Brief Biography', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => 'Visionary educationist steering Sukkur IBA to national excellence across engineering, computer science, and innovation championships.',
            )
        );

        $repeater->add_control(
            'guest_photo',
            array(
                'label'   => esc_html__('Portrait Photograph', 'sibacom-manager'),
                'type'    => Controls_Manager::MEDIA,
                'default' => array(
                    'url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80',
                ),
            )
        );

        $repeater->add_control(
            'guest_linkedin',
            array(
                'label'   => esc_html__('LinkedIn URL', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'https://linkedin.com',
            )
        );

        $this->add_control(
            'manual_guests',
            array(
                'label'       => esc_html__('Guest Entries', 'sibacom-manager'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => array(
                    array(
                        'guest_name'        => 'Prof. Dr. Asif Ahmed Shaikh',
                        'guest_category'    => 'Chief Guest & Patron',
                        'guest_designation' => 'Vice Chancellor',
                        'guest_org'         => 'Sukkur IBA University',
                        'guest_bio'         => 'Distinguished academician, scholar, and institutional visionary serving as the Vice Chancellor of Sukkur IBA University, steering the institution to premier national excellence in computing, engineering, and innovation.',
                        'guest_photo'       => array('url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80'),
                        'guest_linkedin'    => 'https://www.linkedin.com/school/sukkur-iba-university/',
                    ),
                    array(
                        'guest_name'        => 'Engr. Zahid Hussain Khand',
                        'guest_category'    => 'Guest of Honor',
                        'guest_designation' => 'Registrar & Senior Engineer',
                        'guest_org'         => 'Sukkur IBA University',
                        'guest_bio'         => 'Esteemed engineering educator and institutional administrator spearheading academic governance, faculty collaboration, and technical capacity building across university campuses.',
                        'guest_photo'       => array('url' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=400&q=80'),
                        'guest_linkedin'    => 'https://www.linkedin.com/school/sukkur-iba-university/',
                    ),
                    array(
                        'guest_name'        => 'Dr. Sher Muhammad Daudpota',
                        'guest_category'    => 'Patron & Special Guest',
                        'guest_designation' => 'Director QEC & Professor of Computer Science',
                        'guest_org'         => 'Sukkur IBA University',
                        'guest_bio'         => 'Senior computer scientist, research mentor, and academic leader overseeing university quality enhancement and fostering algorithmic problem solving and international research initiatives.',
                        'guest_photo'       => array('url' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=400&q=80'),
                        'guest_linkedin'    => 'https://www.linkedin.com/school/sukkur-iba-university/',
                    ),
                ),
                'title_field' => '{{{ guest_name }}}',
                'condition'   => array(
                    'data_mode' => 'manual',
                ),
            )
        );

        $this->end_controls_section();

        // STYLE TAB
        $this->start_controls_section(
            'section_style_guests',
            array(
                'label' => esc_html__('Guest Cards Styling', 'sibacom-manager'),
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
                    '{{WRAPPER}} .sibacom-guest-card' => 'background-color: {{VALUE}};',
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

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'card_shadow',
                'label'    => esc_html__('Card Shadow', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .sibacom-guest-card',
            )
        );

        $this->end_controls_section();

        // Style Tab: Card Circuit Accents & Pulse Glow
        $this->start_controls_section(
            'section_style_guest_circuits',
            array(
                'label' => esc_html__('Circuit Accents & Edge Signals', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'enable_guest_circuits',
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
                'condition' => array('enable_guest_circuits' => 'yes'),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $mode     = $settings['data_mode'];
        $cols     = !empty($settings['columns']) ? $settings['columns'] : '3';
        $limit    = !empty($settings['limit']) ? $settings['limit'] : -1;
        $cat      = !empty($settings['category_filter']) ? $settings['category_filter'] : '';

        if ($mode === 'dynamic') {
            if (class_exists('SIBACOM_Shortcodes')) {
                echo SIBACOM_Shortcodes::render_guests(array(
                    'limit'    => $limit,
                    'category' => $cat,
                    'columns'  => $cols,
                ));
            }
        } else {
            $guests = !empty($settings['manual_guests']) ? $settings['manual_guests'] : array();
            ?>
            <div class="sibacom-speakers-grid sibacom-guests-grid col-<?php echo esc_attr($cols); ?>">
                <?php foreach ($guests as $g) : 
                    $photo_url = !empty($g['guest_photo']['url']) ? $g['guest_photo']['url'] : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80';
                    ?>
                    <div class="sibacom-speaker-card sibacom-guest-card neu-card sibacom-card-circuit">
                        <?php if ((!isset($settings['enable_guest_circuits']) || $settings['enable_guest_circuits'] !== 'no') && function_exists('sibacom_the_circuit_corner')) : ?>
                            <?php sibacom_the_circuit_corner('tl'); ?>
                            <?php sibacom_the_circuit_corner('br'); ?>
                        <?php endif; ?>
                        <div class="sibacom-speaker-img-wrap guest-portrait">
                            <img src="<?php echo esc_url($photo_url); ?>" alt="<?php echo esc_attr($g['guest_name']); ?>" width="140" height="140" loading="lazy" decoding="async">
                        </div>

                        <?php if (!empty($g['guest_category'])) : ?>
                            <span class="sibacom-speaker-badge guest-badge">
                                <i class="fa-solid fa-award" style="margin-right: 4px;"></i>
                                <?php echo esc_html($g['guest_category']); ?>
                            </span>
                        <?php endif; ?>

                        <h3 class="sibacom-speaker-name font-display"><?php echo esc_html($g['guest_name']); ?></h3>
                        <?php if (!empty($g['guest_designation'])) : ?>
                            <p class="sibacom-speaker-designation"><?php echo esc_html($g['guest_designation']); ?></p>
                        <?php endif; ?>
                        <?php if (!empty($g['guest_org'])) : ?>
                            <p class="sibacom-speaker-org"><?php echo esc_html($g['guest_org']); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($g['guest_bio'])) : ?>
                            <div class="sibacom-speaker-bio">
                                <?php echo esc_html($g['guest_bio']); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($g['guest_linkedin'])) : ?>
                            <div class="sibacom-speaker-social">
                                <a href="<?php echo esc_url($g['guest_linkedin']); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php
        }
    }
}

