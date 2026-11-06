<?php
/**
 * SIBACOM Theme Customizer
 *
 * @package SIBACOM
 */

if (!defined('ABSPATH')) {
    exit;
}

function sibacom_customize_register($wp_customize) {
    // SIBACOM Branding & Colors Section
    $wp_customize->add_section('sibacom_colors_section', array(
        'title'       => esc_html__('SIBACOM Design & Colors', 'sibacom'),
        'priority'    => 30,
        'description' => esc_html__('Configure global colors for SIBACOM Neumorphic UI design system.', 'sibacom'),
    ));

    // Primary Royal Blue
    $wp_customize->add_setting('sibacom_primary_color', array(
        'default'           => '#173F91',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sibacom_primary_color', array(
        'label'    => esc_html__('Primary Royal Blue', 'sibacom'),
        'section'  => 'sibacom_colors_section',
        'settings' => 'sibacom_primary_color',
    )));

    // Deep Navy
    $wp_customize->add_setting('sibacom_navy_color', array(
        'default'           => '#102E68',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sibacom_navy_color', array(
        'label'    => esc_html__('Deep Navy', 'sibacom'),
        'section'  => 'sibacom_colors_section',
        'settings' => 'sibacom_navy_color',
    )));

    // Technology Green
    $wp_customize->add_setting('sibacom_techgreen_color', array(
        'default'           => '#079B58',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sibacom_techgreen_color', array(
        'label'    => esc_html__('Technology Green', 'sibacom'),
        'section'  => 'sibacom_colors_section',
        'settings' => 'sibacom_techgreen_color',
    )));

    // Background Color
    $wp_customize->add_setting('sibacom_bg_color', array(
        'default'           => '#F4F6FA',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sibacom_bg_color', array(
        'label'    => esc_html__('Background Soft Surface', 'sibacom'),
        'section'  => 'sibacom_colors_section',
        'settings' => 'sibacom_bg_color',
    )));

    // Section: Electrical Circuits & Signal Animations
    $wp_customize->add_section('sibacom_circuits_section', array(
        'title'       => esc_html__('SIBACOM Circuit & Signal Effects', 'sibacom'),
        'priority'    => 35,
        'description' => esc_html__('Configure animated electrical circuits, PCB traces, and signal flow pulses.', 'sibacom'),
    ));

    // Circuit Pulse Color
    $wp_customize->add_setting('sibacom_circuit_pulse_color', array(
        'default'           => '#079B58',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sibacom_circuit_pulse_color', array(
        'label'    => esc_html__('Signal Pulse Color', 'sibacom'),
        'section'  => 'sibacom_circuits_section',
        'settings' => 'sibacom_circuit_pulse_color',
    )));

    // Circuit Pulse Animation Speed
    $wp_customize->add_setting('sibacom_circuit_speed', array(
        'default'           => '4s',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('sibacom_circuit_speed', array(
        'label'       => esc_html__('Pulse Animation Base Speed (e.g. 4s)', 'sibacom'),
        'section'     => 'sibacom_circuits_section',
        'type'        => 'text',
    ));

    // ========================================================
    // Section: Header & Global Registration Button (CTA)
    // ========================================================
    $wp_customize->add_section('sibacom_registration_section', array(
        'title'       => esc_html__('SIBACOM Registration & CTA Button', 'sibacom'),
        'priority'    => 25,
        'description' => esc_html__('Configure the primary Registration Button (Text, Link, Target, and Visibility) displayed across the header, mobile drawer, hero banner, competitions hub, and modals.', 'sibacom'),
    ));

    // 1. Enable/Disable Registration Button
    $wp_customize->add_setting('sibacom_header_cta_enabled', array(
        'default'           => '1',
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sibacom_sanitize_checkbox',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('sibacom_header_cta_enabled', array(
        'label'       => esc_html__('Enable Registration Button', 'sibacom'),
        'description' => esc_html__('Toggle display of the primary registration button in site header and mobile navigation.', 'sibacom'),
        'section'     => 'sibacom_registration_section',
        'type'        => 'checkbox',
    ));

    // 2. Button Text / Label
    $wp_customize->add_setting('sibacom_header_cta_text', array(
        'default'           => 'Register Now',
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('sibacom_header_cta_text', array(
        'label'       => esc_html__('Registration Button Text', 'sibacom'),
        'description' => esc_html__('Label displayed on the button (e.g. "Register Now", "Register for Event", "Join SIBACOM").', 'sibacom'),
        'section'     => 'sibacom_registration_section',
        'type'        => 'text',
    ));

    // 3. Button Link / URL
    $wp_customize->add_setting('sibacom_header_cta_url', array(
        'default'           => 'https://portal.sibacom.tech/',
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('sibacom_header_cta_url', array(
        'label'       => esc_html__('Registration Portal URL / Link', 'sibacom'),
        'description' => esc_html__('Destination URL for registration (e.g. https://portal.sibacom.tech/, Google Form link, or #contact).', 'sibacom'),
        'section'     => 'sibacom_registration_section',
        'type'        => 'url',
    ));

    // 4. Link Target (_blank vs _self)
    $wp_customize->add_setting('sibacom_header_cta_target', array(
        'default'           => '_blank',
        'type'              => 'option',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('sibacom_header_cta_target', array(
        'label'       => esc_html__('Open Link In', 'sibacom'),
        'description' => esc_html__('Choose whether clicking the button opens a new browser tab or stays in the current tab.', 'sibacom'),
        'section'     => 'sibacom_registration_section',
        'type'        => 'select',
        'choices'     => array(
            '_blank' => esc_html__('New Tab (_blank)', 'sibacom'),
            '_self'  => esc_html__('Same Tab (_self)', 'sibacom'),
        ),
    ));
}
add_action('customize_register', 'sibacom_customize_register');

/**
 * Checkbox sanitization helper for Customizer
 */
function sibacom_sanitize_checkbox($checked) {
    return ((isset($checked) && true == $checked) ? '1' : '0');
}

/**
 * Output dynamic CSS variables for customizer overrides
 */
function sibacom_customizer_css() {
    $primary       = get_theme_mod('sibacom_primary_color', '#173F91');
    $navy          = get_theme_mod('sibacom_navy_color', '#102E68');
    $techgreen     = get_theme_mod('sibacom_techgreen_color', '#079B58');
    $bg            = get_theme_mod('sibacom_bg_color', '#F4F6FA');
    $pulse_color   = get_theme_mod('sibacom_circuit_pulse_color', '#079B58');
    $circuit_speed = get_theme_mod('sibacom_circuit_speed', '4s');

    $custom_css = "
        :root {
            --sibacom-primary: {$primary};
            --sibacom-navy: {$navy};
            --sibacom-techgreen: {$techgreen};
            --sibacom-bg: {$bg};
            --sibacom-circuit-pulse-color: {$pulse_color};
            --sibacom-circuit-speed: {$circuit_speed};
        }
    ";
    wp_add_inline_style('sibacom-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'sibacom_customizer_css', 20);

