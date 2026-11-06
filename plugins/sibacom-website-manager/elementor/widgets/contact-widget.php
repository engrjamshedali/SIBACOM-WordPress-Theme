<?php
/**
 * SIBACOM Contact Details Elementor Widget
 *
 * Fully editable contact information cards with support for venue address,
 * official emails, telephone lines, and bug reporting coordinates.
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

class SIBACOM_Contact_Widget extends Widget_Base {

    public function get_name() {
        return 'sibacom_contact';
    }

    public function get_title() {
        return esc_html__('SIBACOM Contact Cards', 'sibacom-manager');
    }

    public function get_icon() {
        return 'eicon-envelope';
    }

    public function get_categories() {
        return array('sibacom-elements');
    }

    public function get_keywords() {
        return array('contact', 'cards', 'email', 'phone', 'location', 'address', 'venue', 'bug', 'support', 'helpdesk', 'sec', 'secretariat');
    }

    protected function register_controls() {

        // =========================================================================
        // CARD 1: EVENT VENUE LOCATION
        // =========================================================================
        $this->start_controls_section(
            'section_card_venue',
            array(
                'label' => esc_html__('Card 1: Event Venue Location', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'show_card1',
            array(
                'label'        => esc_html__('Show Venue Card', 'sibacom-manager'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'sibacom-manager'),
                'label_off'    => esc_html__('Hide', 'sibacom-manager'),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->add_control(
            'card1_title',
            array(
                'label'       => esc_html__('Card Title', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => get_option('sibacom_contact_venue_title', 'Event Venue Location'),
                'placeholder' => esc_html__('Event Venue Location', 'sibacom-manager'),
                'condition'   => array('show_card1' => 'yes'),
            )
        );

        $this->add_control(
            'card1_icon',
            array(
                'label'     => esc_html__('Icon', 'sibacom-manager'),
                'type'      => Controls_Manager::ICONS,
                'default'   => array(
                    'value'   => 'fa-solid fa-location-dot',
                    'library' => 'fa-solid',
                ),
                'condition' => array('show_card1' => 'yes'),
            )
        );

        $default_address = get_option('sibacom_contact_address');
        if (empty($default_address)) {
            $v = get_option('sibacom_event_venue');
            $l = get_option('sibacom_event_location');
            $default_address = (!empty($v) || !empty($l)) ? trim($v . ', ' . $l, ', ') : 'Sukkur IBA University, Airport Road, Sukkur, Sindh, Pakistan';
        }

        $this->add_control(
            'card1_address',
            array(
                'label'       => esc_html__('Physical Address', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 3,
                'default'     => $default_address,
                'placeholder' => esc_html__('Sukkur IBA University, Airport Road, Sukkur, Sindh, Pakistan', 'sibacom-manager'),
                'description' => esc_html__('Physical campus address and venue directions.', 'sibacom-manager'),
                'condition'   => array('show_card1' => 'yes'),
            )
        );

        $this->add_control(
            'card1_sub',
            array(
                'label'       => esc_html__('Footer Note / Subtitle', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => get_option('sibacom_contact_venue_sub', 'Accessible via Sukkur Airport & M-5 Motorway'),
                'placeholder' => esc_html__('Accessible via Sukkur Airport & M-5 Motorway', 'sibacom-manager'),
                'condition'   => array('show_card1' => 'yes'),
            )
        );

        $this->add_control(
            'card1_link',
            array(
                'label'         => esc_html__('Directions / Maps Link', 'sibacom-manager'),
                'type'          => Controls_Manager::URL,
                'placeholder'   => esc_html__('https://maps.google.com/?q=Sukkur+IBA+University', 'sibacom-manager'),
                'show_external' => true,
                'default'       => array(
                    'url'         => '',
                    'is_external' => true,
                    'nofollow'    => false,
                ),
                'condition'     => array('show_card1' => 'yes'),
            )
        );

        $this->end_controls_section();

        // =========================================================================
        // CARD 2: ELECTRONIC MAIL
        // =========================================================================
        $this->start_controls_section(
            'section_card_email',
            array(
                'label' => esc_html__('Card 2: Electronic Mail', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'show_card2',
            array(
                'label'        => esc_html__('Show Email Card', 'sibacom-manager'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'sibacom-manager'),
                'label_off'    => esc_html__('Hide', 'sibacom-manager'),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->add_control(
            'card2_title',
            array(
                'label'       => esc_html__('Card Title', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => get_option('sibacom_contact_email_title', 'Electronic Mail'),
                'placeholder' => esc_html__('Electronic Mail', 'sibacom-manager'),
                'condition'   => array('show_card2' => 'yes'),
            )
        );

        $this->add_control(
            'card2_icon',
            array(
                'label'     => esc_html__('Icon', 'sibacom-manager'),
                'type'      => Controls_Manager::ICONS,
                'default'   => array(
                    'value'   => 'fa-solid fa-envelope',
                    'library' => 'fa-solid',
                ),
                'condition' => array('show_card2' => 'yes'),
            )
        );

        $default_email = get_option('sibacom_contact_email');
        if (empty($default_email)) {
            $default_email = 'info@sibacom.tech';
        }

        $this->add_control(
            'card2_email',
            array(
                'label'       => esc_html__('Email Address', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => $default_email,
                'placeholder' => esc_html__('info@sibacom.tech', 'sibacom-manager'),
                'condition'   => array('show_card2' => 'yes'),
            )
        );

        $this->add_control(
            'card2_sub',
            array(
                'label'       => esc_html__('Footer Note / Subtitle', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => get_option('sibacom_contact_email_sub', 'Official Secretariat Helpdesk'),
                'placeholder' => esc_html__('Official Secretariat Helpdesk', 'sibacom-manager'),
                'condition'   => array('show_card2' => 'yes'),
            )
        );

        $this->add_control(
            'card2_link',
            array(
                'label'         => esc_html__('Custom Link (Optional)', 'sibacom-manager'),
                'type'          => Controls_Manager::URL,
                'placeholder'   => esc_html__('mailto:info@sibacom.tech', 'sibacom-manager'),
                'show_external' => false,
                'default'       => array(
                    'url'         => '',
                    'is_external' => false,
                    'nofollow'    => false,
                ),
                'description'   => esc_html__('Leave empty to automatically open mailto: with the email above.', 'sibacom-manager'),
                'condition'     => array('show_card2' => 'yes'),
            )
        );

        $this->end_controls_section();

        // =========================================================================
        // CARD 3: TELEPHONE & HELPDESK
        // =========================================================================
        $this->start_controls_section(
            'section_card_phone',
            array(
                'label' => esc_html__('Card 3: Telephone & Helpdesk', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'show_card3',
            array(
                'label'        => esc_html__('Show Phone Card', 'sibacom-manager'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'sibacom-manager'),
                'label_off'    => esc_html__('Hide', 'sibacom-manager'),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->add_control(
            'card3_title',
            array(
                'label'       => esc_html__('Card Title', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => get_option('sibacom_contact_phone_title', 'Telephone & Helpdesk'),
                'placeholder' => esc_html__('Telephone & Helpdesk', 'sibacom-manager'),
                'condition'   => array('show_card3' => 'yes'),
            )
        );

        $this->add_control(
            'card3_icon',
            array(
                'label'     => esc_html__('Icon', 'sibacom-manager'),
                'type'      => Controls_Manager::ICONS,
                'default'   => array(
                    'value'   => 'fa-solid fa-phone',
                    'library' => 'fa-solid',
                ),
                'condition' => array('show_card3' => 'yes'),
            )
        );

        $default_phone = get_option('sibacom_contact_phone');
        if (empty($default_phone)) {
            $default_phone = '03253171046';
        }

        $this->add_control(
            'card3_phone',
            array(
                'label'       => esc_html__('Phone Number / Helpline', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => $default_phone,
                'placeholder' => esc_html__('03253171046', 'sibacom-manager'),
                'condition'   => array('show_card3' => 'yes'),
            )
        );

        $this->add_control(
            'card3_sub',
            array(
                'label'       => esc_html__('Footer Note / Operating Hours', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => get_option('sibacom_contact_phone_sub', 'Mon – Fri, 09:00 AM – 05:00 PM PKT'),
                'placeholder' => esc_html__('Mon – Fri, 09:00 AM – 05:00 PM PKT', 'sibacom-manager'),
                'condition'   => array('show_card3' => 'yes'),
            )
        );

        $this->add_control(
            'card3_link',
            array(
                'label'         => esc_html__('Custom Link (Optional)', 'sibacom-manager'),
                'type'          => Controls_Manager::URL,
                'placeholder'   => esc_html__('tel:03253171046 or https://wa.me/...', 'sibacom-manager'),
                'show_external' => false,
                'default'       => array(
                    'url'         => '',
                    'is_external' => false,
                    'nofollow'    => false,
                ),
                'description'   => esc_html__('Leave empty to automatically open tel: with the phone number above.', 'sibacom-manager'),
                'condition'     => array('show_card3' => 'yes'),
            )
        );

        $this->end_controls_section();

        // =========================================================================
        // CARD 4: BUG REPORT & TECHNICAL LEAD
        // =========================================================================
        $this->start_controls_section(
            'section_card_bug',
            array(
                'label' => esc_html__('Card 4: Bug Report & Tech Support', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            )
        );

        // Keep 'show_bug' key for 100% backward compatibility
        $this->add_control(
            'show_bug',
            array(
                'label'        => esc_html__('Show Bug Report Card', 'sibacom-manager'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Show', 'sibacom-manager'),
                'label_off'    => esc_html__('Hide', 'sibacom-manager'),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->add_control(
            'card4_title',
            array(
                'label'       => esc_html__('Card Title', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => get_option('sibacom_bug_contact_title', 'Bug Report'),
                'placeholder' => esc_html__('Bug Report', 'sibacom-manager'),
                'condition'   => array('show_bug' => 'yes'),
            )
        );

        $this->add_control(
            'card4_icon',
            array(
                'label'     => esc_html__('Icon', 'sibacom-manager'),
                'type'      => Controls_Manager::ICONS,
                'default'   => array(
                    'value'   => 'fa-solid fa-bug',
                    'library' => 'fa-solid',
                ),
                'condition' => array('show_bug' => 'yes'),
            )
        );

        // Keep 'bug_name' key for backward compatibility
        $this->add_control(
            'bug_name',
            array(
                'label'       => esc_html__('Engineer / Lead Name', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => get_option('sibacom_bug_contact_name', 'Jamshed Ali'),
                'placeholder' => esc_html__('Jamshed Ali', 'sibacom-manager'),
                'condition'   => array('show_bug' => 'yes'),
            )
        );

        // Keep 'bug_role' key for backward compatibility
        $this->add_control(
            'bug_role',
            array(
                'label'       => esc_html__('Role / Designation Badge', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => get_option('sibacom_bug_contact_role', 'WEB ENGINEER _ SIBACOM EVENT'),
                'placeholder' => esc_html__('WEB ENGINEER _ SIBACOM EVENT', 'sibacom-manager'),
                'condition'   => array('show_bug' => 'yes'),
            )
        );

        // Keep 'bug_email' key for backward compatibility
        $this->add_control(
            'bug_email',
            array(
                'label'       => esc_html__('Bug Report Email', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => get_option('sibacom_bug_contact_email', 'jamshed.ali@sibacom.tech'),
                'placeholder' => esc_html__('jamshed.ali@sibacom.tech', 'sibacom-manager'),
                'condition'   => array('show_bug' => 'yes'),
            )
        );

        // Keep 'bug_desc' key for backward compatibility
        $this->add_control(
            'bug_desc',
            array(
                'label'       => esc_html__('Footer Note / Description', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => get_option('sibacom_bug_contact_desc', 'For users to report any website bugs or technical issues'),
                'placeholder' => esc_html__('For users to report any website bugs or technical issues', 'sibacom-manager'),
                'condition'   => array('show_bug' => 'yes'),
            )
        );

        $this->add_control(
            'card4_link',
            array(
                'label'         => esc_html__('Custom Link (Optional)', 'sibacom-manager'),
                'type'          => Controls_Manager::URL,
                'placeholder'   => esc_html__('mailto:jamshed.ali@sibacom.tech', 'sibacom-manager'),
                'show_external' => false,
                'default'       => array(
                    'url'         => '',
                    'is_external' => false,
                    'nofollow'    => false,
                ),
                'condition'     => array('show_bug' => 'yes'),
            )
        );

        $this->end_controls_section();

        // =========================================================================
        // SECTION: ADDITIONAL CUSTOM CARDS (REPEATER)
        // =========================================================================
        $this->start_controls_section(
            'section_custom_cards',
            array(
                'label' => esc_html__('Additional Custom Cards', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'enable_custom_cards',
            array(
                'label'        => esc_html__('Enable Extra Custom Cards', 'sibacom-manager'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'sibacom-manager'),
                'label_off'    => esc_html__('No', 'sibacom-manager'),
                'return_value' => 'yes',
                'default'      => '',
                'description'  => esc_html__('Enable to append custom contact cards (e.g. Media Desk, Registration Lead, Campus Ambassador, WhatsApp Hotline).', 'sibacom-manager'),
            )
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'item_title',
            array(
                'label'       => esc_html__('Card Title', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'Media Desk',
            )
        );

        $repeater->add_control(
            'item_icon',
            array(
                'label'   => esc_html__('Icon', 'sibacom-manager'),
                'type'    => Controls_Manager::ICONS,
                'default' => array(
                    'value'   => 'fa-solid fa-bullhorn',
                    'library' => 'fa-solid',
                ),
            )
        );

        $repeater->add_control(
            'item_person',
            array(
                'label'       => esc_html__('Lead / Person Name (Optional)', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => '',
                'placeholder' => esc_html__('e.g. Coordinator Name', 'sibacom-manager'),
            )
        );

        $repeater->add_control(
            'item_role',
            array(
                'label'       => esc_html__('Badge / Role (Optional)', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => '',
                'placeholder' => esc_html__('e.g. PRESS & MEDIA RELATIONS', 'sibacom-manager'),
            )
        );

        $repeater->add_control(
            'item_content',
            array(
                'label'       => esc_html__('Primary Contact Info / Text', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'media@sibacom.tech',
            )
        );

        $repeater->add_control(
            'item_sub',
            array(
                'label'       => esc_html__('Footer Note / Subtitle', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'Journalist and press accreditation desk',
            )
        );

        $repeater->add_control(
            'item_link',
            array(
                'label'         => esc_html__('Link URL', 'sibacom-manager'),
                'type'          => Controls_Manager::URL,
                'placeholder'   => esc_html__('mailto:media@sibacom.tech', 'sibacom-manager'),
                'show_external' => true,
                'default'       => array(
                    'url'         => '',
                    'is_external' => false,
                    'nofollow'    => false,
                ),
            )
        );

        $this->add_control(
            'custom_cards_list',
            array(
                'label'       => esc_html__('Custom Cards', 'sibacom-manager'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ item_title }}}',
                'condition'   => array('enable_custom_cards' => 'yes'),
            )
        );

        $this->end_controls_section();

        // =========================================================================
        // SECTION: LAYOUT & CIRCUIT ACCENTS
        // =========================================================================
        $this->start_controls_section(
            'section_layout',
            array(
                'label' => esc_html__('Grid Layout & Accents', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_responsive_control(
            'columns',
            array(
                'label'          => esc_html__('Grid Columns', 'sibacom-manager'),
                'type'           => Controls_Manager::SELECT,
                'default'        => '4',
                'tablet_default' => '2',
                'mobile_default' => '1',
                'options'        => array(
                    '1' => esc_html__('1 Column', 'sibacom-manager'),
                    '2' => esc_html__('2 Columns', 'sibacom-manager'),
                    '3' => esc_html__('3 Columns', 'sibacom-manager'),
                    '4' => esc_html__('4 Columns', 'sibacom-manager'),
                ),
                'selectors'      => array(
                    '{{WRAPPER}} .sibacom-contact-grid' => 'grid-template-columns: repeat({{VALUE}}, minmax(0, 1fr)) !important;',
                ),
            )
        );

        $this->add_responsive_control(
            'grid_gap',
            array(
                'label'      => esc_html__('Grid Gap', 'sibacom-manager'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'rem'),
                'range'      => array(
                    'px' => array('min' => 10, 'max' => 60),
                ),
                'default'    => array('unit' => 'rem', 'size' => 1.75),
                'selectors'  => array(
                    '{{WRAPPER}} .sibacom-contact-grid' => 'gap: {{SIZE}}{{UNIT}};',
                ),
            )
        );

        $this->add_control(
            'enable_circuit_accents',
            array(
                'label'        => esc_html__('Circuit PCB Corner Accents', 'sibacom-manager'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'sibacom-manager'),
                'label_off'    => esc_html__('No', 'sibacom-manager'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'description'  => esc_html__('Render interactive tech circuit trace corners on each card.', 'sibacom-manager'),
            )
        );

        // Retain legacy 'use_custom' control hidden for backward compatibility
        $this->add_control(
            'use_custom',
            array(
                'type'         => Controls_Manager::HIDDEN,
                'default'      => 'yes',
            )
        );
        $this->add_control('address', array('type' => Controls_Manager::HIDDEN));
        $this->add_control('email', array('type' => Controls_Manager::HIDDEN));
        $this->add_control('phone', array('type' => Controls_Manager::HIDDEN));

        $this->end_controls_section();

        // =========================================================================
        // STYLE TAB: CARDS APPEARANCE
        // =========================================================================
        $this->start_controls_section(
            'section_style_cards',
            array(
                'label' => esc_html__('Card Appearance', 'sibacom-manager'),
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
                    '{{WRAPPER}} .neu-card' => 'background-color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'     => 'card_border',
                'label'    => esc_html__('Card Border', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .neu-card',
            )
        );

        $this->add_control(
            'card_radius',
            array(
                'label'      => esc_html__('Border Radius', 'sibacom-manager'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'rem'),
                'range'      => array('px' => array('min' => 0, 'max' => 40)),
                'default'    => array('unit' => 'px', 'size' => 20),
                'selectors'  => array(
                    '{{WRAPPER}} .neu-card' => 'border-radius: {{SIZE}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'card_shadow',
                'label'    => esc_html__('Card Shadow', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .neu-card',
            )
        );

        $this->add_responsive_control(
            'card_padding',
            array(
                'label'      => esc_html__('Card Padding', 'sibacom-manager'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array('px', 'rem', '%'),
                'selectors'  => array(
                    '{{WRAPPER}} .neu-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'card_min_height',
            array(
                'label'      => esc_html__('Card Minimum Height', 'sibacom-manager'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px'),
                'range'      => array('px' => array('min' => 150, 'max' => 450)),
                'selectors'  => array(
                    '{{WRAPPER}} .neu-card' => 'min-height: {{SIZE}}{{UNIT}};',
                ),
            )
        );

        $this->end_controls_section();

        // =========================================================================
        // STYLE TAB: ICONS STYLING
        // =========================================================================
        $this->start_controls_section(
            'section_style_icons',
            array(
                'label' => esc_html__('Icon Badges', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'icon_color',
            array(
                'label'     => esc_html__('Icon Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#173F91',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-highlight-icon'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sibacom-highlight-icon i'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sibacom-highlight-icon svg' => 'fill: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'icon_bg_color',
            array(
                'label'     => esc_html__('Badge Background', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-highlight-icon' => 'background: {{VALUE}};',
                ),
            )
        );

        $this->add_responsive_control(
            'icon_size',
            array(
                'label'      => esc_html__('Icon Size', 'sibacom-manager'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'rem'),
                'range'      => array('px' => array('min' => 14, 'max' => 48)),
                'selectors'  => array(
                    '{{WRAPPER}} .sibacom-highlight-icon'     => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .sibacom-highlight-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'icon_badge_size',
            array(
                'label'      => esc_html__('Badge Size (Width/Height)', 'sibacom-manager'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px'),
                'range'      => array('px' => array('min' => 36, 'max' => 80)),
                'selectors'  => array(
                    '{{WRAPPER}} .sibacom-highlight-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ),
            )
        );

        $this->add_control(
            'icon_border_radius',
            array(
                'label'      => esc_html__('Badge Border Radius', 'sibacom-manager'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', '%'),
                'range'      => array('px' => array('min' => 0, 'max' => 40)),
                'selectors'  => array(
                    '{{WRAPPER}} .sibacom-highlight-icon' => 'border-radius: {{SIZE}}{{UNIT}};',
                ),
            )
        );

        $this->end_controls_section();

        // =========================================================================
        // STYLE TAB: TYPOGRAPHY & COLORS
        // =========================================================================
        $this->start_controls_section(
            'section_style_typography',
            array(
                'label' => esc_html__('Typography & Colors', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        // Titles
        $this->add_control(
            'heading_title_style',
            array(
                'label'     => esc_html__('Card Titles', 'sibacom-manager'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $this->add_control(
            'title_color',
            array(
                'label'     => esc_html__('Title Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#17233D',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-card-title' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .sibacom-card-title',
            )
        );

        // Body / Details
        $this->add_control(
            'heading_body_style',
            array(
                'label'     => esc_html__('Content & Address', 'sibacom-manager'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $this->add_control(
            'text_color',
            array(
                'label'     => esc_html__('Address / Text Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#64748B',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-card-address' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sibacom-card-text'    => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'text_typography',
                'selector' => '{{WRAPPER}} .sibacom-card-address, {{WRAPPER}} .sibacom-card-text',
            )
        );

        // Links
        $this->add_control(
            'heading_link_style',
            array(
                'label'     => esc_html__('Links (Email / Phone)', 'sibacom-manager'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $this->add_control(
            'link_color',
            array(
                'label'     => esc_html__('Link Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#173F91',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-card-link' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'link_hover_color',
            array(
                'label'     => esc_html__('Link Hover Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#079B58',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-card-link:hover' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'link_typography',
                'selector' => '{{WRAPPER}} .sibacom-card-link',
            )
        );

        // Subtitles / Footnotes
        $this->add_control(
            'heading_sub_style',
            array(
                'label'     => esc_html__('Footer Notes / Subtitles', 'sibacom-manager'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $this->add_control(
            'sub_color',
            array(
                'label'     => esc_html__('Subtitle Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#079B58',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-card-footnote' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'sub_typography',
                'selector' => '{{WRAPPER}} .sibacom-card-footnote',
            )
        );

        // Role / Designation Badges
        $this->add_control(
            'heading_badge_style',
            array(
                'label'     => esc_html__('Role / Designation Badges', 'sibacom-manager'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $this->add_control(
            'badge_color',
            array(
                'label'     => esc_html__('Badge Text Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#079B58',
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-card-role' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'badge_typography',
                'selector' => '{{WRAPPER}} .sibacom-card-role',
            )
        );

        $this->end_controls_section();
    }

    /**
     * Render an Elementor Icon or FontAwesome Fallback
     */
    protected function render_contact_icon($icon_setting, $fallback_class) {
        if (!empty($icon_setting['value'])) {
            if (class_exists('\Elementor\Icons_Manager')) {
                \Elementor\Icons_Manager::render_icon($icon_setting, array('aria-hidden' => 'true'));
            } else {
                echo '<i class="' . esc_attr($icon_setting['value']) . '" aria-hidden="true"></i>';
            }
        } else {
            echo '<i class="' . esc_attr($fallback_class) . '" aria-hidden="true"></i>';
        }
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // -------------------------------------------------------------------------
        // 1. VENUE CARD VALUES
        // -------------------------------------------------------------------------
        $show_card1 = (!isset($settings['show_card1']) || $settings['show_card1'] === 'yes');
        $card1_title = !empty($settings['card1_title'])
            ? $settings['card1_title']
            : get_option('sibacom_contact_venue_title', __('Event Venue Location', 'sibacom-manager'));

        // Address with robust multi-layer fallback so it is NEVER blank
        $card1_address = '';
        if (!empty($settings['card1_address']) && trim((string)$settings['card1_address']) !== '') {
            $card1_address = trim((string)$settings['card1_address']);
        } elseif (!empty($settings['address']) && trim((string)$settings['address']) !== '') {
            $card1_address = trim((string)$settings['address']);
        } else {
            $opt_addr = get_option('sibacom_contact_address');
            if (!empty($opt_addr) && trim((string)$opt_addr) !== '') {
                $card1_address = trim((string)$opt_addr);
            }
        }

        if (empty($card1_address)) {
            $venue = get_option('sibacom_event_venue');
            $loc   = get_option('sibacom_event_location');
            if (!empty($venue) || !empty($loc)) {
                $card1_address = trim($venue . ', ' . $loc, ', ');
            }
        }

        if (empty($card1_address)) {
            $card1_address = 'Sukkur IBA University, Airport Road, Sukkur, Sindh, Pakistan';
        }

        $card1_sub = !empty($settings['card1_sub'])
            ? $settings['card1_sub']
            : get_option('sibacom_contact_venue_sub', __('Accessible via Sukkur Airport & M-5 Motorway', 'sibacom-manager'));

        $card1_link = !empty($settings['card1_link']['url']) ? $settings['card1_link'] : null;

        // -------------------------------------------------------------------------
        // 2. EMAIL CARD VALUES
        // -------------------------------------------------------------------------
        $show_card2 = (!isset($settings['show_card2']) || $settings['show_card2'] === 'yes');
        $card2_title = !empty($settings['card2_title'])
            ? $settings['card2_title']
            : get_option('sibacom_contact_email_title', __('Electronic Mail', 'sibacom-manager'));

        $card2_email = '';
        if (!empty($settings['card2_email']) && trim((string)$settings['card2_email']) !== '') {
            $card2_email = trim((string)$settings['card2_email']);
        } elseif (!empty($settings['email']) && trim((string)$settings['email']) !== '') {
            $card2_email = trim((string)$settings['email']);
        } else {
            $opt_email = get_option('sibacom_contact_email');
            if (!empty($opt_email) && trim((string)$opt_email) !== '') {
                $card2_email = trim((string)$opt_email);
            }
        }
        if (empty($card2_email)) {
            $card2_email = 'info@sibacom.tech';
        }

        $card2_sub = !empty($settings['card2_sub'])
            ? $settings['card2_sub']
            : get_option('sibacom_contact_email_sub', __('Official Secretariat Helpdesk', 'sibacom-manager'));

        $card2_link_url = !empty($settings['card2_link']['url']) ? $settings['card2_link']['url'] : ('mailto:' . $card2_email);

        // -------------------------------------------------------------------------
        // 3. PHONE CARD VALUES
        // -------------------------------------------------------------------------
        $show_card3 = (!isset($settings['show_card3']) || $settings['show_card3'] === 'yes');
        $card3_title = !empty($settings['card3_title'])
            ? $settings['card3_title']
            : get_option('sibacom_contact_phone_title', __('Telephone & Helpdesk', 'sibacom-manager'));

        $card3_phone = '';
        if (!empty($settings['card3_phone']) && trim((string)$settings['card3_phone']) !== '') {
            $card3_phone = trim((string)$settings['card3_phone']);
        } elseif (!empty($settings['phone']) && trim((string)$settings['phone']) !== '') {
            $card3_phone = trim((string)$settings['phone']);
        } else {
            $opt_phone = get_option('sibacom_contact_phone');
            if (!empty($opt_phone) && trim((string)$opt_phone) !== '') {
                $card3_phone = trim((string)$opt_phone);
            }
        }
        if (empty($card3_phone)) {
            $card3_phone = '03253171046';
        }

        $card3_sub = !empty($settings['card3_sub'])
            ? $settings['card3_sub']
            : get_option('sibacom_contact_phone_sub', __('Mon – Fri, 09:00 AM – 05:00 PM PKT', 'sibacom-manager'));

        $clean_tel = preg_replace('/[^0-9+]/', '', $card3_phone);
        $card3_link_url = !empty($settings['card3_link']['url']) ? $settings['card3_link']['url'] : ('tel:' . $clean_tel);

        // -------------------------------------------------------------------------
        // 4. BUG REPORT CARD VALUES
        // -------------------------------------------------------------------------
        $show_bug = (!isset($settings['show_bug']) || $settings['show_bug'] === 'yes');
        $card4_title = !empty($settings['card4_title'])
            ? $settings['card4_title']
            : get_option('sibacom_bug_contact_title', __('Bug Report', 'sibacom-manager'));

        $card4_name = !empty($settings['bug_name'])
            ? $settings['bug_name']
            : get_option('sibacom_bug_contact_name', 'Jamshed Ali');
        if (empty($card4_name)) {
            $card4_name = 'Jamshed Ali';
        }

        $card4_role = !empty($settings['bug_role'])
            ? $settings['bug_role']
            : get_option('sibacom_bug_contact_role', 'Web Engineer _ SIBACOM EVENT');
        if (empty($card4_role)) {
            $card4_role = 'Web Engineer _ SIBACOM EVENT';
        }

        $card4_email = !empty($settings['bug_email'])
            ? $settings['bug_email']
            : get_option('sibacom_bug_contact_email', 'jamshed.ali@sibacom.tech');
        if (empty($card4_email)) {
            $card4_email = 'jamshed.ali@sibacom.tech';
        }

        $card4_desc = !empty($settings['bug_desc'])
            ? $settings['bug_desc']
            : get_option('sibacom_bug_contact_desc', 'For users to report any website bugs or technical issues');
        if (empty($card4_desc)) {
            $card4_desc = 'For users to report any website bugs or technical issues';
        }

        $card4_link_url = !empty($settings['card4_link']['url']) ? $settings['card4_link']['url'] : ('mailto:' . $card4_email);

        // -------------------------------------------------------------------------
        // 5. ACCENTS & CUSTOM CARDS
        // -------------------------------------------------------------------------
        $has_circuit = (!isset($settings['enable_circuit_accents']) || $settings['enable_circuit_accents'] === 'yes');
        $card_classes = 'neu-card' . ($has_circuit ? ' sibacom-card-circuit' : '');
        $enable_custom_cards = (!empty($settings['enable_custom_cards']) && $settings['enable_custom_cards'] === 'yes');
        $custom_cards = (!empty($settings['custom_cards_list']) && is_array($settings['custom_cards_list'])) ? $settings['custom_cards_list'] : array();
        ?>

        <div class="sibacom-contact-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.75rem; max-width: 1200px; margin: 0 auto;">

            <?php if ($show_card1) : ?>
            <!-- Card 1: Venue Location -->
            <div class="<?php echo esc_attr($card_classes); ?>" style="display: flex; flex-direction: column;">
                <?php if ($has_circuit && function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
                <div>
                    <div class="sibacom-highlight-icon">
                        <?php $this->render_contact_icon(!empty($settings['card1_icon']) ? $settings['card1_icon'] : null, 'fa-solid fa-location-dot'); ?>
                    </div>
                    <h3 class="font-display sibacom-card-title" style="font-size: 1.25rem; margin-bottom: 0.5rem; color: var(--sibacom-navy, #17233D);"><?php echo esc_html($card1_title); ?></h3>
                    <p class="sibacom-card-address" style="font-size: 0.95rem; margin-bottom: 1rem; color: var(--sibacom-text-secondary, #64748B); line-height: 1.55;">
                        <?php if (!empty($card1_link['url'])) : ?>
                            <a href="<?php echo esc_url($card1_link['url']); ?>" <?php echo !empty($card1_link['is_external']) ? 'target="_blank" rel="noopener noreferrer"' : ''; ?> class="sibacom-card-link" style="color: inherit; text-decoration: none;">
                                <?php echo esc_html($card1_address); ?>
                            </a>
                        <?php else : ?>
                            <?php echo esc_html($card1_address); ?>
                        <?php endif; ?>
                    </p>
                </div>
                <div style="margin-top: auto; padding-top: 0.5rem;">
                    <span class="sibacom-card-footnote" style="font-size: 0.82rem; font-weight: 600; color: var(--sibacom-techgreen, #079B58); display: block;">
                        <?php echo esc_html($card1_sub); ?>
                    </span>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($show_card2) : ?>
            <!-- Card 2: Electronic Mail -->
            <div class="<?php echo esc_attr($card_classes); ?>" style="display: flex; flex-direction: column;">
                <?php if ($has_circuit && function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
                <div>
                    <div class="sibacom-highlight-icon">
                        <?php $this->render_contact_icon(!empty($settings['card2_icon']) ? $settings['card2_icon'] : null, 'fa-solid fa-envelope'); ?>
                    </div>
                    <h3 class="font-display sibacom-card-title" style="font-size: 1.25rem; margin-bottom: 0.5rem; color: var(--sibacom-navy, #17233D);"><?php echo esc_html($card2_title); ?></h3>
                    <p style="font-size: 0.95rem; margin-bottom: 1rem;">
                        <a href="<?php echo esc_url($card2_link_url); ?>" class="sibacom-card-link" style="font-weight: 600; color: var(--sibacom-primary, #173F91); word-break: break-all; text-decoration: none;">
                            <?php echo esc_html($card2_email); ?>
                        </a>
                    </p>
                </div>
                <div style="margin-top: auto; padding-top: 0.5rem;">
                    <span class="sibacom-card-footnote" style="font-size: 0.82rem; font-weight: 600; color: var(--sibacom-techgreen, #079B58); display: block;">
                        <?php echo esc_html($card2_sub); ?>
                    </span>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($show_card3) : ?>
            <!-- Card 3: Telephone & Helpdesk -->
            <div class="<?php echo esc_attr($card_classes); ?>" style="display: flex; flex-direction: column;">
                <?php if ($has_circuit && function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
                <div>
                    <div class="sibacom-highlight-icon">
                        <?php $this->render_contact_icon(!empty($settings['card3_icon']) ? $settings['card3_icon'] : null, 'fa-solid fa-phone'); ?>
                    </div>
                    <h3 class="font-display sibacom-card-title" style="font-size: 1.25rem; margin-bottom: 0.5rem; color: var(--sibacom-navy, #17233D);"><?php echo esc_html($card3_title); ?></h3>
                    <p style="font-size: 0.95rem; margin-bottom: 1rem;">
                        <a href="<?php echo esc_url($card3_link_url); ?>" class="sibacom-card-link" style="font-weight: 600; color: var(--sibacom-primary, #173F91); text-decoration: none;">
                            <?php echo esc_html($card3_phone); ?>
                        </a>
                    </p>
                </div>
                <div style="margin-top: auto; padding-top: 0.5rem;">
                    <span class="sibacom-card-footnote" style="font-size: 0.82rem; font-weight: 600; color: var(--sibacom-techgreen, #079B58); display: block;">
                        <?php echo esc_html($card3_sub); ?>
                    </span>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($show_bug) : ?>
            <!-- Card 4: Bug Report & Tech Support -->
            <div class="<?php echo esc_attr($card_classes); ?>" style="display: flex; flex-direction: column;">
                <?php if ($has_circuit && function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
                <div>
                    <div class="sibacom-highlight-icon">
                        <?php $this->render_contact_icon(!empty($settings['card4_icon']) ? $settings['card4_icon'] : null, 'fa-solid fa-bug'); ?>
                    </div>
                    <h3 class="font-display sibacom-card-title" style="font-size: 1.25rem; margin-bottom: 0.35rem; color: var(--sibacom-navy, #17233D);"><?php echo esc_html($card4_title); ?></h3>
                    <div style="margin-bottom: 0.6rem;">
                        <strong class="sibacom-card-name" style="font-size: 1.02rem; color: var(--sibacom-navy, #17233D); display: block;"><?php echo esc_html($card4_name); ?></strong>
                        <span class="sibacom-card-role" style="font-size: 0.8rem; font-weight: 700; color: var(--sibacom-techgreen, #079B58); text-transform: uppercase; letter-spacing: 0.04em; display: block; margin-top: 2px;">
                            <?php echo esc_html($card4_role); ?>
                        </span>
                    </div>
                    <p style="font-size: 0.95rem; margin-bottom: 1rem;">
                        <a href="<?php echo esc_url($card4_link_url); ?>" class="sibacom-card-link" style="font-weight: 600; color: var(--sibacom-primary, #173F91); word-break: break-all; text-decoration: none;">
                            <?php echo esc_html($card4_email); ?>
                        </a>
                    </p>
                </div>
                <div style="margin-top: auto; padding-top: 0.5rem;">
                    <span class="sibacom-card-footnote" style="font-size: 0.82rem; font-weight: 600; color: var(--sibacom-techgreen, #079B58); display: block;">
                        <?php echo esc_html($card4_desc); ?>
                    </span>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($enable_custom_cards && !empty($custom_cards)) : ?>
                <?php foreach ($custom_cards as $card) :
                    $c_title  = !empty($card['item_title']) ? $card['item_title'] : '';
                    $c_person = !empty($card['item_person']) ? $card['item_person'] : '';
                    $c_role   = !empty($card['item_role']) ? $card['item_role'] : '';
                    $c_val    = !empty($card['item_content']) ? $card['item_content'] : '';
                    $c_sub    = !empty($card['item_sub']) ? $card['item_sub'] : '';
                    $c_link   = !empty($card['item_link']['url']) ? $card['item_link']['url'] : '';
                ?>
                <div class="<?php echo esc_attr($card_classes); ?>" style="display: flex; flex-direction: column;">
                    <?php if ($has_circuit && function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
                    <div>
                        <div class="sibacom-highlight-icon">
                            <?php $this->render_contact_icon(!empty($card['item_icon']) ? $card['item_icon'] : null, 'fa-solid fa-headset'); ?>
                        </div>
                        <h3 class="font-display sibacom-card-title" style="font-size: 1.25rem; margin-bottom: 0.5rem; color: var(--sibacom-navy, #17233D);"><?php echo esc_html($c_title); ?></h3>
                        
                        <?php if (!empty($c_person) || !empty($c_role)) : ?>
                            <div style="margin-bottom: 0.6rem;">
                                <?php if (!empty($c_person)) : ?>
                                    <strong class="sibacom-card-name" style="font-size: 1.02rem; color: var(--sibacom-navy, #17233D); display: block;"><?php echo esc_html($c_person); ?></strong>
                                <?php endif; ?>
                                <?php if (!empty($c_role)) : ?>
                                    <span class="sibacom-card-role" style="font-size: 0.8rem; font-weight: 700; color: var(--sibacom-techgreen, #079B58); text-transform: uppercase; letter-spacing: 0.04em; display: block; margin-top: 2px;">
                                        <?php echo esc_html($c_role); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($c_val)) : ?>
                            <p style="font-size: 0.95rem; margin-bottom: 1rem;">
                                <?php if (!empty($c_link)) : ?>
                                    <a href="<?php echo esc_url($c_link); ?>" class="sibacom-card-link" style="font-weight: 600; color: var(--sibacom-primary, #173F91); word-break: break-all; text-decoration: none;">
                                        <?php echo esc_html($c_val); ?>
                                    </a>
                                <?php else : ?>
                                    <span class="sibacom-card-text" style="color: var(--sibacom-text-secondary, #64748B);"><?php echo esc_html($c_val); ?></span>
                                <?php endif; ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($c_sub)) : ?>
                    <div style="margin-top: auto; padding-top: 0.5rem;">
                        <span class="sibacom-card-footnote" style="font-size: 0.82rem; font-weight: 600; color: var(--sibacom-techgreen, #079B58); display: block;">
                            <?php echo esc_html($c_sub); ?>
                        </span>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
        <?php
    }
}
