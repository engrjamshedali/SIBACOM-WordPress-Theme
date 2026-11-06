<?php
/**
 * SIBACOM Organizers Elementor Widget
 *
 * Fully editable widget allowing customization of all Joint Organizers cards,
 * Academic Partners cards, Institutional Host & Council, and PCB Circuit accents.
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

class SIBACOM_Organizers_Widget extends Widget_Base {

    public function get_name() {
        return 'sibacom_organizers';
    }

    public function get_title() {
        return esc_html__('SIBACOM Organizers Grid', 'sibacom-manager');
    }

    public function get_icon() {
        return 'eicon-site-identity';
    }

    public function get_categories() {
        return array('sibacom-elements');
    }

    protected function register_controls() {
        // =========================================================================
        // 1. CONTENT TAB: Display Structure & Hierarchy
        // =========================================================================
        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__('Organizers Configuration', 'sibacom-manager'),
            )
        );

        $this->add_control(
            'data_mode',
            array(
                'label'   => esc_html__('Display Structure', 'sibacom-manager'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'dynamic',
                'options' => array(
                    'dynamic'            => esc_html__('Complete Hierarchy (Joint Organizers + Academic Partners + Host)', 'sibacom-manager'),
                    'joint_only'         => esc_html__('Joint Primary Organizers Only (CSE & EE Societies)', 'sibacom-manager'),
                    'academic_only'      => esc_html__('Academic Partners Only (CSE & EE Departments)', 'sibacom-manager'),
                    'institutional_only' => esc_html__('Institutional Host & Student Leadership Only', 'sibacom-manager'),
                    'manual'             => esc_html__('Custom Organizing Partners (Visual Repeater)', 'sibacom-manager'),
                ),
            )
        );

        $this->add_control(
            'show_section_headers',
            array(
                'label'        => esc_html__('Show Section Headers & Badges', 'sibacom-manager'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'sibacom-manager'),
                'label_off'    => esc_html__('No', 'sibacom-manager'),
                'return_value' => 'yes',
                'default'      => 'yes',
                'condition'    => array(
                    'data_mode!' => 'manual',
                ),
            )
        );

        $this->add_control(
            'enable_org_circuits',
            array(
                'label'        => esc_html__('Enable Circuit Corner Accents', 'sibacom-manager'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'sibacom-manager'),
                'label_off'    => esc_html__('No', 'sibacom-manager'),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->end_controls_section();

        // =========================================================================
        // 2. CONTENT TAB: Joint Primary Organizers (CSE & EE Societies)
        // =========================================================================
        $this->start_controls_section(
            'section_joint_organizers',
            array(
                'label'     => esc_html__('Joint Primary Organizers Cards', 'sibacom-manager'),
                'condition' => array(
                    'data_mode' => array('dynamic', 'joint_only'),
                ),
            )
        );

        $this->add_control(
            'joint_sec_badge',
            array(
                'label'       => esc_html__('Section Badge Text', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'Joint Primary Organizers',
                'placeholder' => 'Joint Primary Organizers',
            )
        );

        $this->add_control(
            'joint_sec_title',
            array(
                'label'       => esc_html__('Section Heading', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'Co-Equal Student Engineering Societies',
                'placeholder' => 'Co-Equal Student Engineering Societies',
            )
        );

        $this->add_control(
            'joint_sec_subtitle',
            array(
                'label'       => esc_html__('Section Subtitle', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => 'Bringing together the Computer Systems Engineering and Electrical Engineering communities.',
                'placeholder' => 'Bringing together the Computer Systems Engineering and Electrical Engineering communities.',
            )
        );

        // CSE Society Card
        $this->add_control(
            'heading_cse_soc',
            array(
                'label'     => esc_html__('Card 1: CSE Society (Computing Track Lead)', 'sibacom-manager'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $this->add_control(
            'cse_badge',
            array(
                'label'   => esc_html__('CSE Badge', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Joint Primary Organizer',
            )
        );

        $this->add_control(
            'cse_icon',
            array(
                'label'       => esc_html__('CSE Top Icon (Font Awesome class)', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'fa-solid fa-code',
                'placeholder' => 'fa-solid fa-code',
            )
        );

        $this->add_control(
            'cse_logo',
            array(
                'label'   => esc_html__('CSE Custom Logo Image (Optional)', 'sibacom-manager'),
                'type'    => Controls_Manager::MEDIA,
                'default' => array('url' => ''),
            )
        );

        $this->add_control(
            'cse_title',
            array(
                'label'   => esc_html__('CSE Society Title', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Computer Systems Engineering Society (CSE Society)',
            )
        );

        $this->add_control(
            'cse_desc',
            array(
                'label'   => esc_html__('CSE Society Narrative / Description', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => 'The premier student engineering society of the Department of Computer Systems Engineering, pioneering technical competitions, algorithmic hackathons, and hardware-software innovation at Sukkur IBA University.',
            )
        );

        $this->add_control(
            'cse_affiliation',
            array(
                'label'   => esc_html__('CSE Footer Tag / Track Lead', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Co-Equal Secretariat & Computing Track Lead',
            )
        );

        $this->add_control(
            'cse_footer_icon',
            array(
                'label'   => esc_html__('CSE Footer Icon', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'fa-solid fa-circle-check',
            )
        );

        // EE Society Card
        $this->add_control(
            'heading_ee_soc',
            array(
                'label'     => esc_html__('Card 2: EE Society (Electrical Track Lead)', 'sibacom-manager'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $this->add_control(
            'ee_badge',
            array(
                'label'   => esc_html__('EE Badge', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Joint Primary Organizer',
            )
        );

        $this->add_control(
            'ee_icon',
            array(
                'label'       => esc_html__('EE Top Icon (Font Awesome class)', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'fa-solid fa-bolt',
                'placeholder' => 'fa-solid fa-bolt',
            )
        );

        $this->add_control(
            'ee_logo',
            array(
                'label'   => esc_html__('EE Custom Logo Image (Optional)', 'sibacom-manager'),
                'type'    => Controls_Manager::MEDIA,
                'default' => array('url' => ''),
            )
        );

        $this->add_control(
            'ee_title',
            array(
                'label'   => esc_html__('EE Society Title', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Electrical Engineering Society (EE Society)',
            )
        );

        $this->add_control(
            'ee_desc',
            array(
                'label'   => esc_html__('EE Society Narrative / Description', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => 'The leading student engineering society of the Department of Electrical Engineering, driving excellence in circuit design, embedded robotics, telecommunications, and power systems at Sukkur IBA University.',
            )
        );

        $this->add_control(
            'ee_affiliation',
            array(
                'label'   => esc_html__('EE Footer Tag / Track Lead', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Co-Equal Secretariat & Electrical Track Lead',
            )
        );

        $this->add_control(
            'ee_footer_icon',
            array(
                'label'   => esc_html__('EE Footer Icon', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'fa-solid fa-circle-check',
            )
        );

        $this->end_controls_section();

        // =========================================================================
        // 3. CONTENT TAB: Circuit Connector Separator
        // =========================================================================
        $this->start_controls_section(
            'section_circuit_bridge',
            array(
                'label'     => esc_html__('Circuit Connector & Interconnect Chip', 'sibacom-manager'),
                'condition' => array(
                    'data_mode' => array('dynamic', 'joint_only'),
                ),
            )
        );

        $this->add_control(
            'enable_connector',
            array(
                'label'        => esc_html__('Show Circuit Bus Separator', 'sibacom-manager'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'sibacom-manager'),
                'label_off'    => esc_html__('No', 'sibacom-manager'),
                'return_value' => 'yes',
                'default'      => 'yes',
            )
        );

        $this->add_control(
            'bus_left',
            array(
                'label'       => esc_html__('Left Terminal Bus Label', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'CSE_BUS',
                'placeholder' => 'CSE_BUS',
            )
        );

        $this->add_control(
            'chip_brand',
            array(
                'label'       => esc_html__('Interconnect Chip Line 1', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'SIBACOM',
                'placeholder' => 'SIBACOM',
            )
        );

        $this->add_control(
            'chip_model',
            array(
                'label'       => esc_html__('Interconnect Chip Line 2', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'BRIDGE',
                'placeholder' => 'BRIDGE',
            )
        );

        $this->add_control(
            'bus_right',
            array(
                'label'       => esc_html__('Right Terminal Bus Label', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'EE_BUS',
                'placeholder' => 'EE_BUS',
            )
        );

        $this->end_controls_section();

        // =========================================================================
        // 4. CONTENT TAB: Academic Partners (Departments)
        // =========================================================================
        $this->start_controls_section(
            'section_academic_partners',
            array(
                'label'     => esc_html__('Academic Partners Cards', 'sibacom-manager'),
                'condition' => array(
                    'data_mode' => array('dynamic', 'academic_only'),
                ),
            )
        );

        $this->add_control(
            'academic_sec_badge',
            array(
                'label'       => esc_html__('Academic Section Badge', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'Academic Partners',
                'placeholder' => 'Academic Partners',
            )
        );

        $this->add_control(
            'academic_sec_title',
            array(
                'label'       => esc_html__('Academic Section Heading', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXT,
                'default'     => 'University Academic Departments',
                'placeholder' => 'University Academic Departments',
            )
        );

        $this->add_control(
            'academic_sec_subtitle',
            array(
                'label'       => esc_html__('Academic Section Subtitle', 'sibacom-manager'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => 'Supporting academic departments providing faculty advisement, research laboratory facilities, and international judging standards.',
                'placeholder' => 'Supporting academic departments providing faculty advisement, research laboratory facilities, and international judging standards.',
            )
        );

        // Dept of CSE Card
        $this->add_control(
            'heading_cse_dept',
            array(
                'label'     => esc_html__('Card 3: Department of CSE', 'sibacom-manager'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $this->add_control(
            'cse_dept_badge',
            array(
                'label'   => esc_html__('CSE Dept Badge', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Academic Partner',
            )
        );

        $this->add_control(
            'cse_dept_icon',
            array(
                'label'   => esc_html__('CSE Dept Icon', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'fa-solid fa-microchip',
            )
        );

        $this->add_control(
            'cse_dept_logo',
            array(
                'label'   => esc_html__('CSE Dept Custom Logo', 'sibacom-manager'),
                'type'    => Controls_Manager::MEDIA,
                'default' => array('url' => ''),
            )
        );

        $this->add_control(
            'cse_dept_title',
            array(
                'label'   => esc_html__('CSE Dept Title', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Department of Computer Systems Engineering',
            )
        );

        $this->add_control(
            'cse_dept_desc',
            array(
                'label'   => esc_html__('CSE Dept Description', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => 'Academic affiliation and supporting partner for the CSE Society, providing high-performance computing clusters, embedded systems labs, and faculty adjudication across computing and AI tracks.',
            )
        );

        $this->add_control(
            'cse_dept_support',
            array(
                'label'   => esc_html__('CSE Dept Footer Role / Facility Tag', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Computing Labs & Faculty Adjudication',
            )
        );

        // Dept of EE Card
        $this->add_control(
            'heading_ee_dept',
            array(
                'label'     => esc_html__('Card 4: Department of EE', 'sibacom-manager'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $this->add_control(
            'ee_dept_badge',
            array(
                'label'   => esc_html__('EE Dept Badge', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Academic Partner',
            )
        );

        $this->add_control(
            'ee_dept_icon',
            array(
                'label'   => esc_html__('EE Dept Icon', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'fa-solid fa-plug-circle-bolt',
            )
        );

        $this->add_control(
            'ee_dept_logo',
            array(
                'label'   => esc_html__('EE Dept Custom Logo', 'sibacom-manager'),
                'type'    => Controls_Manager::MEDIA,
                'default' => array('url' => ''),
            )
        );

        $this->add_control(
            'ee_dept_title',
            array(
                'label'   => esc_html__('EE Dept Title', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Department of Electrical Engineering',
            )
        );

        $this->add_control(
            'ee_dept_desc',
            array(
                'label'   => esc_html__('EE Dept Description', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => 'Academic affiliation and supporting partner for the EE Society, providing state-of-the-art electronics, telecommunications, and power engineering laboratories, along with senior faculty mentorship.',
            )
        );

        $this->add_control(
            'ee_dept_support',
            array(
                'label'   => esc_html__('EE Dept Footer Role / Facility Tag', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Electronics Labs & Technical Adjudication',
            )
        );

        $this->end_controls_section();

        // =========================================================================
        // 5. CONTENT TAB: Host Institution & Student Governance
        // =========================================================================
        $this->start_controls_section(
            'section_host_governance',
            array(
                'label'     => esc_html__('Host Institution & Student Leadership', 'sibacom-manager'),
                'condition' => array(
                    'data_mode' => array('dynamic', 'institutional_only'),
                ),
            )
        );

        // Host Institution Card
        $this->add_control(
            'heading_host_uni',
            array(
                'label' => esc_html__('Card 5: Sukkur IBA University', 'sibacom-manager'),
                'type'  => Controls_Manager::HEADING,
            )
        );

        $this->add_control(
            'uni_badge',
            array(
                'label'   => esc_html__('University Badge', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Host Institution & Patron',
            )
        );

        $this->add_control(
            'uni_icon',
            array(
                'label'   => esc_html__('University Icon', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'fa-solid fa-building-columns',
            )
        );

        $this->add_control(
            'uni_logo',
            array(
                'label'   => esc_html__('University Custom Logo', 'sibacom-manager'),
                'type'    => Controls_Manager::MEDIA,
                'default' => array('url' => ''),
            )
        );

        $this->add_control(
            'uni_title',
            array(
                'label'   => esc_html__('University Title', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Sukkur IBA University',
            )
        );

        $this->add_control(
            'uni_desc',
            array(
                'label'   => esc_html__('University Description', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => 'A top-ranked public sector university chartered by the Government of Sindh and recognized by HEC Pakistan, renowned for its merit-based admission, cutting-edge labs, and academic prestige.',
            )
        );

        $this->add_control(
            'uni_support',
            array(
                'label'   => esc_html__('University Footer Tag', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Chartered Public Sector University',
            )
        );

        // SISC Student Council Card
        $this->add_control(
            'heading_sisc_council',
            array(
                'label'     => esc_html__('Card 6: SISC Student Council', 'sibacom-manager'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $this->add_control(
            'sisc_badge',
            array(
                'label'   => esc_html__('SISC Badge', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Student Leadership',
            )
        );

        $this->add_control(
            'sisc_icon',
            array(
                'label'   => esc_html__('SISC Icon', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'fa-solid fa-users',
            )
        );

        $this->add_control(
            'sisc_logo',
            array(
                'label'   => esc_html__('SISC Custom Logo', 'sibacom-manager'),
                'type'    => Controls_Manager::MEDIA,
                'default' => array('url' => ''),
            )
        );

        $this->add_control(
            'sisc_title',
            array(
                'label'   => esc_html__('SISC Title', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'SISC – Sukkur IBA Student Council',
            )
        );

        $this->add_control(
            'sisc_desc',
            array(
                'label'   => esc_html__('SISC Description', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => 'The apex representative student leadership council of Sukkur IBA University, overseeing cross-departmental coordination, university-wide engagement, and delegate hospitality.',
            )
        );

        $this->add_control(
            'sisc_support',
            array(
                'label'   => esc_html__('SISC Footer Tag', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Student Governance & Delegations',
            )
        );

        $this->end_controls_section();

        // =========================================================================
        // 6. CONTENT TAB: Custom Visual Repeater Mode
        // =========================================================================
        $this->start_controls_section(
            'section_manual_content',
            array(
                'label'     => esc_html__('Custom Organizing Partners (Repeater)', 'sibacom-manager'),
                'condition' => array(
                    'data_mode' => 'manual',
                ),
            )
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'org_badge',
            array(
                'label'   => esc_html__('Role Badge', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Organizing Body',
            )
        );

        $repeater->add_control(
            'org_icon',
            array(
                'label'   => esc_html__('Card Icon (Font Awesome)', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'fa-solid fa-award',
            )
        );

        $repeater->add_control(
            'org_title',
            array(
                'label'   => esc_html__('Organization Title', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'CSE Society – Technology Circuit',
            )
        );

        $repeater->add_control(
            'org_desc',
            array(
                'label'   => esc_html__('Description', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => 'The premier student engineering society of the Department of Computer Systems Engineering.',
            )
        );

        $repeater->add_control(
            'org_logo',
            array(
                'label'   => esc_html__('Logo Image', 'sibacom-manager'),
                'type'    => Controls_Manager::MEDIA,
            )
        );

        $repeater->add_control(
            'org_footer_text',
            array(
                'label'   => esc_html__('Footer Tag', 'sibacom-manager'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Executive Secretariat Lead',
            )
        );

        $repeater->add_control(
            'org_accent_color',
            array(
                'label'   => esc_html__('Accent Color', 'sibacom-manager'),
                'type'    => Controls_Manager::COLOR,
                'default' => '#173F91',
            )
        );

        $this->add_control(
            'manual_orgs',
            array(
                'label'       => esc_html__('Custom Partners & Committees', 'sibacom-manager'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ org_title }}}',
            )
        );

        $this->end_controls_section();

        // =========================================================================
        // 7. STYLE TAB: Card Appearance & Typography
        // =========================================================================
        $this->start_controls_section(
            'section_style_org',
            array(
                'label' => esc_html__('Cards Appearance', 'sibacom-manager'),
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
                    '{{WRAPPER}} .sibacom-org-card' => 'background-color: {{VALUE}} !important;',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'title_typography',
                'label'    => esc_html__('Title Typography', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .sibacom-org-card h3',
            )
        );

        $this->add_control(
            'title_color',
            array(
                'label'     => esc_html__('Title Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-org-card h3' => 'color: {{VALUE}} !important;',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'desc_typography',
                'label'    => esc_html__('Description Typography', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .sibacom-org-card p',
            )
        );

        $this->add_control(
            'desc_color',
            array(
                'label'     => esc_html__('Description Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .sibacom-org-card p' => 'color: {{VALUE}} !important;',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'card_shadow',
                'label'    => esc_html__('Card Shadow', 'sibacom-manager'),
                'selector' => '{{WRAPPER}} .sibacom-org-card',
            )
        );

        $this->add_control(
            'logo_max_height',
            array(
                'label'      => esc_html__('Logo Maximum Height', 'sibacom-manager'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px'),
                'range'      => array(
                    'px' => array(
                        'min'  => 40,
                        'max'  => 140,
                        'step' => 2,
                    ),
                ),
                'default'    => array(
                    'unit' => 'px',
                    'size' => 75,
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .sibacom-org-logo-wrap img' => 'height: {{SIZE}}{{UNIT}} !important; max-height: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .sibacom-org-logo-wrap .ee-society-insignia' => 'height: {{SIZE}}{{UNIT}} !important; max-height: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .sibacom-org-logo-wrap .ee-dept-insignia' => 'height: {{SIZE}}{{UNIT}} !important; max-height: {{SIZE}}{{UNIT}} !important;',
                ),
            )
        );

        $this->end_controls_section();

        // =========================================================================
        // 8. STYLE TAB: Circuit Accents
        // =========================================================================
        $this->start_controls_section(
            'section_style_org_circuits',
            array(
                'label' => esc_html__('Circuit Styling & PCB Accents', 'sibacom-manager'),
                'tab'   => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'circuit_trace_color',
            array(
                'label'     => esc_html__('Circuit Trace Color', 'sibacom-manager'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .corner-line' => 'stroke: {{VALUE}} !important;',
                    '{{WRAPPER}} .corner-via'  => 'fill: {{VALUE}} !important;',
                ),
            )
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $mode     = !empty($settings['data_mode']) ? $settings['data_mode'] : 'dynamic';

        // Prepare parameter map for shortcodes/rendering
        $args = array(
            'show_section_headers' => !empty($settings['show_section_headers']) ? $settings['show_section_headers'] : 'yes',
            'enable_org_circuits'  => !empty($settings['enable_org_circuits']) ? $settings['enable_org_circuits'] : 'yes',
            'enable_circuits'      => !empty($settings['enable_org_circuits']) ? $settings['enable_org_circuits'] : 'yes',
            'enable_connector'     => !empty($settings['enable_connector']) ? $settings['enable_connector'] : 'yes',

            // Joint Section
            'joint_sec_badge'      => !empty($settings['joint_sec_badge']) ? $settings['joint_sec_badge'] : '',
            'joint_sec_title'      => !empty($settings['joint_sec_title']) ? $settings['joint_sec_title'] : '',
            'joint_sec_subtitle'   => !empty($settings['joint_sec_subtitle']) ? $settings['joint_sec_subtitle'] : '',

            // Card 1: CSE Society
            'cse_title'            => !empty($settings['cse_title']) ? $settings['cse_title'] : '',
            'cse_badge'            => !empty($settings['cse_badge']) ? $settings['cse_badge'] : '',
            'cse_desc'             => !empty($settings['cse_desc']) ? $settings['cse_desc'] : '',
            'cse_affiliation'      => !empty($settings['cse_affiliation']) ? $settings['cse_affiliation'] : '',
            'cse_icon'             => !empty($settings['cse_icon']) ? $settings['cse_icon'] : '',
            'cse_footer_icon'      => !empty($settings['cse_footer_icon']) ? $settings['cse_footer_icon'] : '',
            'cse_logo'             => !empty($settings['cse_logo']['url']) ? $settings['cse_logo']['url'] : '',

            // Card 2: EE Society
            'ee_title'             => !empty($settings['ee_title']) ? $settings['ee_title'] : '',
            'ee_badge'             => !empty($settings['ee_badge']) ? $settings['ee_badge'] : '',
            'ee_desc'              => !empty($settings['ee_desc']) ? $settings['ee_desc'] : '',
            'ee_affiliation'       => !empty($settings['ee_affiliation']) ? $settings['ee_affiliation'] : '',
            'ee_icon'              => !empty($settings['ee_icon']) ? $settings['ee_icon'] : '',
            'ee_footer_icon'       => !empty($settings['ee_footer_icon']) ? $settings['ee_footer_icon'] : '',
            'ee_logo'              => !empty($settings['ee_logo']['url']) ? $settings['ee_logo']['url'] : '',

            // Circuit Connector
            'bus_left'             => !empty($settings['bus_left']) ? $settings['bus_left'] : '',
            'chip_brand'           => !empty($settings['chip_brand']) ? $settings['chip_brand'] : '',
            'chip_model'           => !empty($settings['chip_model']) ? $settings['chip_model'] : '',
            'bus_right'            => !empty($settings['bus_right']) ? $settings['bus_right'] : '',

            // Academic Partners Section
            'academic_sec_badge'   => !empty($settings['academic_sec_badge']) ? $settings['academic_sec_badge'] : '',
            'academic_sec_title'   => !empty($settings['academic_sec_title']) ? $settings['academic_sec_title'] : '',
            'academic_sec_subtitle'=> !empty($settings['academic_sec_subtitle']) ? $settings['academic_sec_subtitle'] : '',

            // Card 3: Dept of CSE
            'cse_dept_title'       => !empty($settings['cse_dept_title']) ? $settings['cse_dept_title'] : '',
            'cse_dept_badge'       => !empty($settings['cse_dept_badge']) ? $settings['cse_dept_badge'] : '',
            'cse_dept_desc'        => !empty($settings['cse_dept_desc']) ? $settings['cse_dept_desc'] : '',
            'cse_dept_support'     => !empty($settings['cse_dept_support']) ? $settings['cse_dept_support'] : '',
            'cse_dept_icon'        => !empty($settings['cse_dept_icon']) ? $settings['cse_dept_icon'] : '',
            'cse_dept_logo'        => !empty($settings['cse_dept_logo']['url']) ? $settings['cse_dept_logo']['url'] : '',

            // Card 4: Dept of EE
            'ee_dept_title'        => !empty($settings['ee_dept_title']) ? $settings['ee_dept_title'] : '',
            'ee_dept_badge'        => !empty($settings['ee_dept_badge']) ? $settings['ee_dept_badge'] : '',
            'ee_dept_desc'         => !empty($settings['ee_dept_desc']) ? $settings['ee_dept_desc'] : '',
            'ee_dept_support'      => !empty($settings['ee_dept_support']) ? $settings['ee_dept_support'] : '',
            'ee_dept_icon'         => !empty($settings['ee_dept_icon']) ? $settings['ee_dept_icon'] : '',
            'ee_dept_logo'        => !empty($settings['ee_dept_logo']['url']) ? $settings['ee_dept_logo']['url'] : '',

            // Card 5: Sukkur IBA University
            'uni_title'            => !empty($settings['uni_title']) ? $settings['uni_title'] : '',
            'uni_badge'            => !empty($settings['uni_badge']) ? $settings['uni_badge'] : '',
            'uni_desc'             => !empty($settings['uni_desc']) ? $settings['uni_desc'] : '',
            'uni_support'          => !empty($settings['uni_support']) ? $settings['uni_support'] : '',
            'uni_icon'             => !empty($settings['uni_icon']) ? $settings['uni_icon'] : '',
            'uni_logo'             => !empty($settings['uni_logo']['url']) ? $settings['uni_logo']['url'] : '',

            // Card 6: SISC Student Council
            'sisc_title'           => !empty($settings['sisc_title']) ? $settings['sisc_title'] : '',
            'sisc_badge'           => !empty($settings['sisc_badge']) ? $settings['sisc_badge'] : '',
            'sisc_desc'            => !empty($settings['sisc_desc']) ? $settings['sisc_desc'] : '',
            'sisc_support'         => !empty($settings['sisc_support']) ? $settings['sisc_support'] : '',
            'sisc_icon'            => !empty($settings['sisc_icon']) ? $settings['sisc_icon'] : '',
            'sisc_logo'            => !empty($settings['sisc_logo']['url']) ? $settings['sisc_logo']['url'] : '',
        );

        echo '<div class="sibacom-widget-wrap">';

        if ($mode === 'joint_only') {
            if (class_exists('SIBACOM_Shortcodes')) {
                echo SIBACOM_Shortcodes::render_joint_organizers($args);
            }
        } elseif ($mode === 'academic_only') {
            if (class_exists('SIBACOM_Shortcodes')) {
                echo SIBACOM_Shortcodes::render_academic_partners($args);
            }
        } elseif ($mode === 'dynamic') {
            if (class_exists('SIBACOM_Shortcodes')) {
                echo SIBACOM_Shortcodes::render_organizers($args);
            }
        } elseif ($mode === 'institutional_only') {
            ?>
            <div class="sibacom-organizers-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.75rem;">
                <!-- Sukkur IBA University -->
                <div class="sibacom-org-card neu-card sibacom-card-circuit">
                    <?php if ((!isset($settings['enable_org_circuits']) || $settings['enable_org_circuits'] !== 'no') && function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                            <span style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; color: var(--sibacom-primary); background: rgba(23,63,145,0.1); padding: 0.25rem 0.75rem; border-radius: var(--radius-full);">
                                <?php echo esc_html(!empty($args['uni_badge']) ? $args['uni_badge'] : __('Host Institution & Patron', 'sibacom-manager')); ?>
                            </span>
                            <i class="<?php echo esc_attr(!empty($args['uni_icon']) ? $args['uni_icon'] : 'fa-solid fa-building-columns'); ?>" style="color: var(--sibacom-primary); font-size: 1.25rem;"></i>
                        </div>
                        <div class="sibacom-org-logo-wrap">
                            <?php 
                            if (!empty($args['uni_logo'])) {
                                echo '<img src="' . esc_url($args['uni_logo']) . '" alt="' . esc_attr($args['uni_title']) . '" class="uni-logo" width="150" height="44" style="height:44px; width:auto; max-width:150px; object-fit:contain;" />';
                            } elseif (function_exists('sibacom_the_university_logo')) {
                                sibacom_the_university_logo();
                            }
                            ?>
                        </div>
                        <h3 class="font-display" style="font-size: 1.35rem; margin-bottom: 0.75rem; color: var(--sibacom-text-primary);">
                            <?php echo esc_html(!empty($args['uni_title']) ? $args['uni_title'] : 'Sukkur IBA University'); ?>
                        </h3>
                        <p style="font-size: 0.92rem; color: var(--sibacom-text-secondary); line-height: 1.65;">
                            <?php echo esc_html(!empty($args['uni_desc']) ? $args['uni_desc'] : 'A top-ranked public sector university chartered by the Government of Sindh and recognized by HEC Pakistan, renowned for its merit-based admission, cutting-edge labs, and academic prestige.'); ?>
                        </p>
                    </div>
                    <div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--sibacom-border);">
                        <span style="font-size: 0.8rem; font-weight: 600; color: var(--sibacom-techgreen);">
                            <i class="fa-solid fa-shield-halved" style="margin-right: 0.35rem;"></i>
                            <?php echo esc_html(!empty($args['uni_support']) ? $args['uni_support'] : __('Chartered Public Sector University', 'sibacom-manager')); ?>
                        </span>
                    </div>
                </div>

                <!-- SISC Student Council -->
                <div class="sibacom-org-card neu-card sibacom-card-circuit">
                    <?php if ((!isset($settings['enable_org_circuits']) || $settings['enable_org_circuits'] !== 'no') && function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                            <span style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; color: var(--sibacom-navy); background: rgba(16,46,104,0.1); padding: 0.25rem 0.75rem; border-radius: var(--radius-full);">
                                <?php echo esc_html(!empty($args['sisc_badge']) ? $args['sisc_badge'] : __('Student Leadership', 'sibacom-manager')); ?>
                            </span>
                            <i class="<?php echo esc_attr(!empty($args['sisc_icon']) ? $args['sisc_icon'] : 'fa-solid fa-users'); ?>" style="color: var(--sibacom-navy); font-size: 1.25rem;"></i>
                        </div>
                        <div class="sibacom-org-logo-wrap">
                            <?php 
                            if (!empty($args['sisc_logo'])) {
                                echo '<img src="' . esc_url($args['sisc_logo']) . '" alt="' . esc_attr($args['sisc_title']) . '" class="sisc-logo" width="160" height="55" style="height:55px; width:auto; object-fit:contain;" />';
                            } elseif (function_exists('sibacom_the_sisc_logo')) {
                                sibacom_the_sisc_logo();
                            }
                            ?>
                        </div>
                        <h3 class="font-display" style="font-size: 1.35rem; margin-bottom: 0.75rem; color: var(--sibacom-text-primary);">
                            <?php echo esc_html(!empty($args['sisc_title']) ? $args['sisc_title'] : 'SISC – Sukkur IBA Student Council'); ?>
                        </h3>
                        <p style="font-size: 0.92rem; color: var(--sibacom-text-secondary); line-height: 1.65;">
                            <?php echo esc_html(!empty($args['sisc_desc']) ? $args['sisc_desc'] : 'The apex representative student leadership council of Sukkur IBA University, overseeing cross-departmental coordination, university-wide engagement, and delegate hospitality.'); ?>
                        </p>
                    </div>
                    <div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--sibacom-border);">
                        <span style="font-size: 0.8rem; font-weight: 600; color: var(--sibacom-navy);">
                            <i class="fa-solid fa-handshake-angle" style="margin-right: 0.35rem;"></i>
                            <?php echo esc_html(!empty($args['sisc_support']) ? $args['sisc_support'] : __('Student Governance & Delegations', 'sibacom-manager')); ?>
                        </span>
                    </div>
                </div>
            </div>
            <?php
        } else {
            // Manual Repeater Mode
            $orgs = !empty($settings['manual_orgs']) ? $settings['manual_orgs'] : array();
            ?>
            <div class="sibacom-organizers-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.75rem;">
                <?php foreach ($orgs as $o) : 
                    $logo_url     = !empty($o['org_logo']['url']) ? $o['org_logo']['url'] : '';
                    $accent_color = !empty($o['org_accent_color']) ? $o['org_accent_color'] : '#173F91';
                    $badge_text   = !empty($o['org_badge']) ? $o['org_badge'] : __('Organizing Body', 'sibacom-manager');
                    $icon_class   = !empty($o['org_icon']) ? $o['org_icon'] : 'fa-solid fa-award';
                    $title_text   = !empty($o['org_title']) ? $o['org_title'] : 'Partner Title';
                    $desc_text    = !empty($o['org_desc']) ? $o['org_desc'] : '';
                    $footer_text  = !empty($o['org_footer_text']) ? $o['org_footer_text'] : '';
                    ?>
                    <div class="sibacom-org-card neu-card sibacom-card-circuit" style="border-color: <?php echo esc_attr($accent_color); ?>;">
                        <?php if ((!isset($settings['enable_org_circuits']) || $settings['enable_org_circuits'] !== 'no') && function_exists('sibacom_the_circuit_corner')) : ?>
                            <?php sibacom_the_circuit_corner('tl'); ?>
                            <?php sibacom_the_circuit_corner('br'); ?>
                        <?php endif; ?>
                        <div>
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                                <span style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; color: <?php echo esc_attr($accent_color); ?>; background: rgba(23,63,145,0.08); padding: 0.25rem 0.75rem; border-radius: var(--radius-full);">
                                    <?php echo esc_html($badge_text); ?>
                                </span>
                                <i class="<?php echo esc_attr($icon_class); ?>" style="color: <?php echo esc_attr($accent_color); ?>; font-size: 1.25rem;"></i>
                            </div>
                            <?php if (!empty($logo_url)) : ?>
                                <div class="sibacom-org-logo-wrap">
                                    <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($title_text); ?>" width="200" height="75" loading="lazy" decoding="async" style="max-height: 75px; width: auto; object-fit: contain;">
                                </div>
                            <?php endif; ?>
                            <h3 class="font-display" style="font-size: 1.35rem; margin-bottom: 0.75rem; color: var(--sibacom-text-primary);">
                                <?php echo esc_html($title_text); ?>
                            </h3>
                            <?php if (!empty($desc_text)) : ?>
                                <p style="font-size: 0.92rem; color: var(--sibacom-text-secondary); line-height: 1.65;">
                                    <?php echo esc_html($desc_text); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($footer_text)) : ?>
                            <div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--sibacom-border);">
                                <span style="font-size: 0.8rem; font-weight: 600; color: var(--sibacom-techgreen);">
                                    <i class="fa-solid fa-circle-check" style="margin-right: 0.35rem;"></i>
                                    <?php echo esc_html($footer_text); ?>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php
        }

        echo '</div>';
    }
}
