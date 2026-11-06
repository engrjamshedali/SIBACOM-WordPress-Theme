<?php
/**
 * SIBACOM Template Tags & Helper Functions
 *
 * Official Dual-Society Organizational Branding & Academic Partnership Integration
 * - Overarching Institutional Identity: Sukkur IBA University
 * - Joint Primary Organizers: CSE Society & EE Society
 * - Supporting Academic Partners: Department of CSE & Department of EE
 *
 * @package SIBACOM
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get Option Helper with Fallback
 * Seamlessly checks both WordPress Options (Plugin settings) and Theme Mods (Customizer)
 */
function sibacom_get_option($key, $default = '') {
    $clean_key = (strpos($key, 'sibacom_') === 0) ? substr($key, 8) : $key;

    // 1. Check direct WordPress Option
    $val = get_option('sibacom_' . $clean_key, '');
    if ($val !== '' && $val !== false) {
        return $val;
    }

    // 2. Check Customizer Theme Mod
    $theme_mod = get_theme_mod('sibacom_' . $clean_key, '');
    if ($theme_mod !== '' && $theme_mod !== false) {
        return $theme_mod;
    }

    return $default;
}

/**
 * Get Official Registration Portal URL
 * Single Source of Truth for Header, Hero, Cards, Calculator, and Modals
 */
function sibacom_get_register_url() {
    $url = sibacom_get_option('header_cta_url', '');
    if (empty($url)) {
        $url = sibacom_get_option('default_register_url', '');
    }
    if (empty($url) || strpos($url, 'iba-suk.edu.pk') !== false) {
        $url = 'https://portal.sibacom.tech/';
    }
    return esc_url_raw($url);
}

/**
 * Get Official Registration Button Text
 */
function sibacom_get_register_text() {
    $text = sibacom_get_option('header_cta_text', '');
    if (empty($text)) {
        $text = 'Register Now';
    }
    return $text;
}

/**
 * Get Registration Link Target (_blank vs _self)
 */
function sibacom_get_register_target() {
    $target = sibacom_get_option('header_cta_target', '_blank');
    $url = sibacom_get_register_url();
    // Anchor links on the same page should stay on page unless user explicitly requested _blank
    if (strpos($url, '#') === 0 && empty(get_option('sibacom_header_cta_target', ''))) {
        return '_self';
    }
    return in_array($target, array('_blank', '_self'), true) ? $target : '_blank';
}

/**
 * Check if Registration Button is Enabled
 */
function sibacom_is_register_enabled() {
    $enabled = sibacom_get_option('header_cta_enabled', '1');
    return ($enabled === '1' || $enabled === 1 || $enabled === true || $enabled === 'yes');
}

/**
 * Output Standard SIBACOM Register Button
 */
function sibacom_the_register_button($class = 'sibacom-btn sibacom-btn-primary', $icon = 'fa-solid fa-arrow-right', $extra_attrs = '') {
    if (!sibacom_is_register_enabled()) {
        return;
    }
    $url = sibacom_get_register_url();
    $text = sibacom_get_register_text();
    $target = sibacom_get_register_target();
    $rel = ($target === '_blank') ? ' rel="noopener noreferrer"' : '';
    $icon_html = $icon ? '<i class="' . esc_attr($icon) . '"></i>' : '';

    echo '<a href="' . esc_url($url) . '" target="' . esc_attr($target) . '"' . $rel . ' class="' . esc_attr($class) . '" ' . $extra_attrs . '>';
    echo '<span>' . esc_html($text) . '</span>';
    if ($icon_html) {
        echo ' ' . $icon_html;
    }
    echo '</a>';
}

/**
 * Get Official SIBACOM Logo URL (Centralized Logo Asset Reference)
 */
function sibacom_get_logo_url() {
    $custom_logo = sibacom_get_option('official_logo_url');
    if (empty($custom_logo)) {
        $custom_logo = sibacom_get_option('logo_url');
    }
    if (!empty($custom_logo)) {
        return $custom_logo;
    }
    if (function_exists('get_theme_mod')) {
        $custom_logo_id = get_theme_mod('custom_logo');
        if ($custom_logo_id && function_exists('wp_get_attachment_image_url')) {
            $wp_logo = wp_get_attachment_image_url($custom_logo_id, 'full');
            if (!empty($wp_logo)) {
                return $wp_logo;
            }
        }
    }
    return SIBACOM_THEME_URI . '/assets/images/sibacom_logo.jpg';
}

/**
 * Display Official SIBACOM Logo (Primary Branding Asset)
 *
 * @param string $context Context of display: 'header', 'hero', 'footer', 'dashboard', 'portal', 'mobile'
 * @param string $class Additional CSS classes
 * @param int $size Display size in pixels (both width & height, as it is square)
 * @param string $custom_url Optional custom URL override
 */
function sibacom_the_official_logo($context = 'default', $class = 'sibacom-main-logo', $size = 46, $custom_url = '') {
    $logo_src = !empty($custom_url) ? $custom_url : sibacom_get_logo_url();
    $sz = intval($size);
    $px = $sz . 'px';
    $fetchpriority = in_array($context, array('header', 'hero', 'mobile')) ? 'fetchpriority="high"' : '';

    echo '<img src="' . esc_url($logo_src) . '" alt="' . esc_attr__('SIBACOM – Power to Progress Official Logo', 'sibacom') . '" class="' . esc_attr($class) . '" width="' . $sz . '" height="' . $sz . '" ' . $fetchpriority . ' decoding="async" style="height:' . $px . '; width:' . $px . '; aspect-ratio:1/1; object-fit:contain; border-radius:inherit;" />';
}

/**
 * Alias for sibacom_the_official_logo
 */
function sibacom_the_logo($context = 'default', $class = 'sibacom-main-logo', $size = 46, $custom_url = '') {
    sibacom_the_official_logo($context, $class, $size, $custom_url);
}

/**
 * Display Favicon & Application Icon Metadata Links
 */
function sibacom_the_favicon_meta() {
    $base = SIBACOM_THEME_URI . '/assets/images/';
    echo '<link rel="icon" type="image/x-icon" href="' . esc_url($base . 'favicon.ico') . '">' . "\n";
    echo '<link rel="icon" type="image/png" sizes="32x32" href="' . esc_url($base . 'favicon-32x32.png') . '">' . "\n";
    echo '<link rel="icon" type="image/png" sizes="16x16" href="' . esc_url($base . 'favicon-16x16.png') . '">' . "\n";
    echo '<link rel="apple-touch-icon" sizes="180x180" href="' . esc_url($base . 'apple-touch-icon.png') . '">' . "\n";
}

/**
 * Display Official University Logo (Overarching Institutional Identity)
 */
function sibacom_the_university_logo($mode = 'default', $custom_url = '') {
    if (!empty($custom_url)) {
        echo '<img src="' . esc_url($custom_url) . '" alt="' . esc_attr__('Sukkur IBA University – Overarching Institutional Identity', 'sibacom') . '" class="uni-logo" width="150" height="44" fetchpriority="high" decoding="async" style="height:44px; width:auto; max-width:150px; object-fit:contain;" />';
        return;
    }
    if ($mode === 'white') {
        $custom_white = sibacom_get_option('university_logo_white_url');
        if (!empty($custom_white)) {
            echo '<img src="' . esc_url($custom_white) . '" alt="' . esc_attr__('Sukkur IBA University – Overarching Institutional Identity', 'sibacom') . '" class="uni-logo uni-logo-white" width="150" height="44" decoding="async" style="height:44px; width:auto; max-width:150px; object-fit:contain;" />';
            return;
        }
        $default_logo = SIBACOM_THEME_URI . '/assets/images/sukkur_iba_white_logo.png';
        echo '<img src="' . esc_url($default_logo) . '" alt="' . esc_attr__('Sukkur IBA University – Overarching Institutional Identity', 'sibacom') . '" class="uni-logo uni-logo-white" width="150" height="44" decoding="async" style="height:44px; width:auto; max-width:150px; object-fit:contain;" />';
        return;
    }

    $custom_logo = sibacom_get_option('university_logo_url');
    if (!empty($custom_logo)) {
        echo '<img src="' . esc_url($custom_logo) . '" alt="' . esc_attr__('Sukkur IBA University – Overarching Institutional Identity', 'sibacom') . '" class="uni-logo" width="150" height="44" fetchpriority="high" decoding="async" style="height:44px; width:auto; max-width:150px; object-fit:contain;" />';
    } else {
        $default_logo = SIBACOM_THEME_URI . '/assets/images/sukkur_iba_logo.png';
        echo '<img src="' . esc_url($default_logo) . '" alt="' . esc_attr__('Sukkur IBA University – Overarching Institutional Identity', 'sibacom') . '" class="uni-logo" width="150" height="44" fetchpriority="high" decoding="async" style="height:44px; width:auto; max-width:150px; object-fit:contain;" />';
    }
}

/**
 * Display Official CSE Society Logo (Joint Primary Organizer)
 */
function sibacom_the_cse_society_logo($mode = 'color', $class = 'society-logo cse-society-logo', $height = 42, $max_width = 160, $custom_url = '') {
    $custom_logo = !empty($custom_url) ? $custom_url : sibacom_get_option('cse_society_logo_url');
    if (empty($custom_logo)) {
        $custom_logo = sibacom_get_option('society_logo_url');
    }

    $h = is_numeric($height) ? $height . 'px' : esc_attr($height);
    $w = is_numeric($max_width) ? $max_width . 'px' : esc_attr($max_width);
    $num_h = is_numeric($height) ? intval($height) : 42;
    $num_w = is_numeric($max_width) ? intval($max_width) : 160;

    if ($mode === 'white') {
        $white_logo = SIBACOM_THEME_URI . '/assets/images/cse_society_logo_white.png';
        if (!file_exists(SIBACOM_THEME_DIR . '/assets/images/cse_society_logo_white.png')) {
            $white_logo = SIBACOM_THEME_URI . '/assets/images/cse_society_logo_transparent.png';
        }
        echo '<img src="' . esc_url($white_logo) . '" alt="' . esc_attr__('Computer Systems Engineering Society (CSE Society) – Sukkur IBA University', 'sibacom') . '" class="' . esc_attr($class) . ' society-logo-white" width="' . $num_w . '" height="' . $num_h . '" decoding="async" style="height:' . $h . '; max-height:' . $h . '; width:auto; max-width:' . $w . '; object-fit:contain; display:inline-block;" />';
        return;
    }

    if (!empty($custom_logo)) {
        echo '<img src="' . esc_url($custom_logo) . '" alt="' . esc_attr__('Computer Systems Engineering Society (CSE Society) – Sukkur IBA University', 'sibacom') . '" class="' . esc_attr($class) . '" width="' . $num_w . '" height="' . $num_h . '" fetchpriority="high" decoding="async" style="height:' . $h . '; max-height:' . $h . '; width:auto; max-width:' . $w . '; object-fit:contain;" />';
    } else {
        $default_logo = SIBACOM_THEME_URI . '/assets/images/cse_society_logo_transparent.png';
        if (!file_exists(SIBACOM_THEME_DIR . '/assets/images/cse_society_logo_transparent.png')) {
            $default_logo = SIBACOM_THEME_URI . '/assets/images/cse_society_logo.png';
        }
        echo '<img src="' . esc_url($default_logo) . '" alt="' . esc_attr__('Computer Systems Engineering Society (CSE Society) – Sukkur IBA University', 'sibacom') . '" class="' . esc_attr($class) . '" width="' . $num_w . '" height="' . $num_h . '" fetchpriority="high" decoding="async" style="height:' . $h . '; max-height:' . $h . '; width:auto; max-width:' . $w . '; object-fit:contain;" />';
    }
}

/**
 * Display Official EE Society Logo (Joint Primary Organizer)
 * Equal prominence, exact display dimensions and aspect ratio handling
 */
function sibacom_the_ee_society_logo($mode = 'color', $class = 'society-logo ee-society-logo', $height = 42, $max_width = 160, $custom_url = '') {
    $custom_logo = !empty($custom_url) ? $custom_url : sibacom_get_option('ee_society_logo_url');
    $h = is_numeric($height) ? $height . 'px' : esc_attr($height);
    $w = is_numeric($max_width) ? $max_width . 'px' : esc_attr($max_width);
    $num_h = is_numeric($height) ? intval($height) : 42;
    $num_w = is_numeric($max_width) ? intval($max_width) : 160;

    if ($mode === 'white') {
        $white_logo = SIBACOM_THEME_URI . '/assets/images/ee_society_logo_white.png';
        if (!file_exists(SIBACOM_THEME_DIR . '/assets/images/ee_society_logo_white.png')) {
            $white_logo = SIBACOM_THEME_URI . '/assets/images/ee_society_logo_transparent.png';
        }
        if (!file_exists(SIBACOM_THEME_DIR . '/assets/images/ee_society_logo_transparent.png') && !file_exists(SIBACOM_THEME_DIR . '/assets/images/ee_society_logo_white.png')) {
            $white_logo = !empty($custom_logo) ? $custom_logo : SIBACOM_THEME_URI . '/assets/images/ee_society_logo.png';
        }
        echo '<img src="' . esc_url($white_logo) . '" alt="' . esc_attr__('Electrical Engineering Society (EE Society) – Sukkur IBA University', 'sibacom') . '" class="' . esc_attr($class) . ' society-logo-white" width="' . $num_w . '" height="' . $num_h . '" decoding="async" style="height:' . $h . '; max-height:' . $h . '; width:auto; max-width:' . $w . '; object-fit:contain; display:inline-block;" />';
        return;
    }

    if (!empty($custom_logo)) {
        echo '<img src="' . esc_url($custom_logo) . '" alt="' . esc_attr__('Electrical Engineering Society (EE Society) – Sukkur IBA University', 'sibacom') . '" class="' . esc_attr($class) . '" width="' . $num_w . '" height="' . $num_h . '" fetchpriority="high" decoding="async" style="height:' . $h . '; max-height:' . $h . '; width:auto; max-width:' . $w . '; object-fit:contain;" />';
        return;
    }

    // Bundled candidates in priority order (transparent PNG preferred)
    $bundled_candidates = array(
        'ee_society_logo_transparent.png',
        'ee_society_logo.png',
        'ee_society_logo.jpg',
        'ee_society_logo.svg'
    );
    $found_file = '';
    foreach ($bundled_candidates as $cand) {
        if (file_exists(SIBACOM_THEME_DIR . '/assets/images/' . $cand)) {
            $found_file = SIBACOM_THEME_URI . '/assets/images/' . $cand;
            break;
        }
    }

    if (!empty($found_file)) {
        echo '<img src="' . esc_url($found_file) . '" alt="' . esc_attr__('Electrical Engineering Society (EE Society) – Sukkur IBA University', 'sibacom') . '" class="' . esc_attr($class) . '" width="' . $num_w . '" height="' . $num_h . '" fetchpriority="high" decoding="async" style="height:' . $h . '; max-height:' . $h . '; width:auto; max-width:' . $w . '; object-fit:contain;" />';
    } else {
        // Formal typographic insignia card ensuring equal prominence without inventing a missing logo
        $is_white = ($mode === 'white');
        $bg_style = $is_white ? 'background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.22); color:#FFFFFF;' : 'background:#FFFFFF; border:1px solid #CBD5E1; color:#173F91; box-shadow:0 2px 6px rgba(0,0,0,0.04);';
        echo '<div class="' . esc_attr($class) . ' ee-society-insignia" style="height:' . $h . '; max-height:' . $h . '; width:auto; min-width:130px; max-width:' . $w . '; display:inline-flex; align-items:center; justify-content:center; gap:8px; padding:0 12px; border-radius:6px; ' . $bg_style . ' font-family:var(--font-heading, sans-serif); font-weight:700; font-size:13px; letter-spacing:0.02em; white-space:nowrap; text-align:center;">';
        echo '<span style="display:inline-block; width:8px; height:8px; border-radius:50%; background:var(--sibacom-techgreen, #079B58);"></span>';
        echo '<span>' . esc_html__('EE Society', 'sibacom') . '</span>';
        echo '</div>';
    }
}

/**
 * Backward Compatible: Display Primary Society Logo
 */
function sibacom_the_society_logo($class = 'society-logo', $height = 42, $max_width = 160) {
    sibacom_the_cse_society_logo('color', $class, $height, $max_width);
}

/**
 * Backward Compatible: Display White Society Logo
 */
function sibacom_the_society_logo_white($class = 'society-logo society-logo-white', $height = 42, $max_width = 160) {
    sibacom_the_cse_society_logo('white', $class, $height, $max_width);
}

/**
 * Display Department of CSE Logo (Supporting Academic Partner)
 */
function sibacom_the_cse_dept_logo($height = 55, $max_width = 160, $custom_url = '') {
    $custom_logo = !empty($custom_url) ? $custom_url : sibacom_get_option('cse_dept_logo_url');
    if (empty($custom_logo)) {
        $custom_logo = sibacom_get_option('dept_logo_url');
    }
    $h = is_numeric($height) ? $height . 'px' : esc_attr($height);
    $w = is_numeric($max_width) ? $max_width . 'px' : esc_attr($max_width);

    if (!empty($custom_logo)) {
        echo '<img src="' . esc_url($custom_logo) . '" alt="' . esc_attr__('Department of Computer Systems Engineering – Sukkur IBA University', 'sibacom') . '" class="dept-logo cse-dept-logo" width="160" height="' . intval($height) . '" decoding="async" style="height:' . $h . '; max-height:' . $h . '; width:auto; max-width:' . $w . '; object-fit:contain;" />';
    } else {
        $default_logo = SIBACOM_THEME_URI . '/assets/images/cse_dept_logo.jpg';
        echo '<img src="' . esc_url($default_logo) . '" alt="' . esc_attr__('Department of Computer Systems Engineering – Sukkur IBA University', 'sibacom') . '" class="dept-logo cse-dept-logo" width="160" height="' . intval($height) . '" decoding="async" style="height:' . $h . '; max-height:' . $h . '; width:auto; max-width:' . $w . '; object-fit:contain;" />';
    }
}

/**
 * Display Department of EE Logo (Supporting Academic Partner)
 */
function sibacom_the_ee_dept_logo($height = 55, $max_width = 160, $custom_url = '') {
    $custom_logo = !empty($custom_url) ? $custom_url : sibacom_get_option('ee_dept_logo_url');
    $h = is_numeric($height) ? $height . 'px' : esc_attr($height);
    $w = is_numeric($max_width) ? $max_width . 'px' : esc_attr($max_width);
    $num_h = is_numeric($height) ? intval($height) : 55;
    $num_w = is_numeric($max_width) ? intval($max_width) : 160;

    $bundled_candidates = array(
        'ee_dept_logo.jpg',
        'ee_dept_logo.png',
        'ee_dept_logo.svg'
    );
    $found_file = '';
    foreach ($bundled_candidates as $cand) {
        if (file_exists(SIBACOM_THEME_DIR . '/assets/images/' . $cand)) {
            $found_file = SIBACOM_THEME_URI . '/assets/images/' . $cand;
            break;
        }
    }

    $logo_src = !empty($custom_logo) ? $custom_logo : $found_file;

    if (!empty($logo_src)) {
        echo '<img src="' . esc_url($logo_src) . '" alt="' . esc_attr__('Department of Electrical Engineering – Sukkur IBA University', 'sibacom') . '" class="dept-logo ee-dept-logo" width="' . $num_w . '" height="' . $num_h . '" decoding="async" style="height:' . $h . '; max-height:' . $h . '; width:auto; max-width:' . $w . '; object-fit:contain;" />';
    } else {
        echo '<div class="dept-logo ee-dept-insignia" style="height:' . $h . '; max-height:' . $h . '; width:auto; min-width:130px; max-width:' . $w . '; display:inline-flex; align-items:center; justify-content:center; gap:8px; padding:0 12px; background:#F8FAFC; border:1px solid #CBD5E1; border-radius:6px; color:#102E68; font-family:var(--font-heading, sans-serif); font-weight:700; font-size:12px; letter-spacing:0.02em; white-space:nowrap; text-align:center;">';
        echo '<i class="fa-solid fa-bolt" style="color:var(--sibacom-techgreen, #079B58);"></i>';
        echo '<span>' . esc_html__('Dept. of EE', 'sibacom') . '</span>';
        echo '</div>';
    }
}

/**
 * Backward Compatible: Display Dept Logo (CSE)
 */
function sibacom_the_dept_logo() {
    sibacom_the_cse_dept_logo(55, 160);
}

/**
 * Display SISC Student Council Logo
 */
function sibacom_the_sisc_logo($custom_url = '') {
    $custom_logo = !empty($custom_url) ? $custom_url : sibacom_get_option('sisc_logo_url');
    if (!empty($custom_logo)) {
        echo '<img src="' . esc_url($custom_logo) . '" alt="' . esc_attr__('SISC – Sukkur IBA Student Council', 'sibacom') . '" class="sisc-logo" width="160" height="55" decoding="async" style="height:55px; width:auto; object-fit:contain;" />';
    } else {
        $default_logo = SIBACOM_THEME_URI . '/assets/images/sisc_logo.jpg';
        echo '<img src="' . esc_url($default_logo) . '" alt="' . esc_attr__('SISC – Sukkur IBA Student Council', 'sibacom') . '" class="sisc-logo" width="160" height="55" decoding="async" style="height:55px; width:auto; object-fit:contain;" />';
    }
}

/**
 * Get Background Campus Photo (Optimized with WebP priority)
 */
function sibacom_get_campus_bg_url() {
    $custom_bg = sibacom_get_option('hero_bg_image_url');
    if (!empty($custom_bg)) {
        return $custom_bg;
    }
    // Prefer WebP for faster above-the-fold delivery
    if (file_exists(SIBACOM_THEME_DIR . '/assets/images/academic_block3_clean_v2.webp')) {
        return SIBACOM_THEME_URI . '/assets/images/academic_block3_clean_v2.webp';
    }
    return SIBACOM_THEME_URI . '/assets/images/academic_block3_clean_v2.jpg';
}

/**
 * Determine if a specific navigation item is active
 *
 * @param string $slug Page slug or template identifier (e.g. 'home', 'about', 'events', etc.)
 * @return bool True if active, false otherwise.
 */
function sibacom_is_nav_active($slug) {
    if ($slug === 'home' || $slug === '' || $slug === '/') {
        return (is_front_page() || is_home());
    }

    if (function_exists('is_page') && is_page($slug)) {
        return true;
    }

    if (function_exists('is_page_template')) {
        if (is_page_template('templates/template-' . $slug . '.php')) {
            return true;
        }
        if ($slug === 'events' && (is_page_template('templates/template-events.php') || is_page_template('templates/template-competitions.php'))) {
            return true;
        }
    }

    if (isset($GLOBALS['sibacom_current_page']) && $GLOBALS['sibacom_current_page'] === $slug) {
        return true;
    }

    return false;
}

/**
 * ==========================================================================
 * SIBACOM Electrical Circuits, PCB Traces & Signal Flow Template Tags
 * ==========================================================================
 */

/**
 * Output Hero Section Animated Circuits (Left & Right Flanks + Digital Bus)
 */
function sibacom_the_hero_circuits() {
    ?>
    <div class="sibacom-hero-circuit-overlay" aria-hidden="true">
        <!-- Left Flank Circuit Pathways (MCU / Logic Ingest) -->
        <div class="sibacom-hero-circuit-left">
            <svg viewBox="0 0 340 700" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMid meet">
                <!-- Base Tracks (PCB Copper / Royal Blue Traces) -->
                <path d="M 0 90 L 130 90 L 170 130 L 170 240 L 210 280 L 210 390 L 170 430 L 110 430" class="sibacom-signal-track" stroke="var(--sibacom-circuit-trace)" stroke-width="1.5" />
                <path d="M 0 170 L 80 170 L 120 210 L 120 350 L 160 390 L 160 530 L 100 590 L 40 590" class="sibacom-signal-track" stroke="var(--sibacom-circuit-trace)" stroke-width="1.5" />
                <path d="M 0 310 L 60 310 L 90 340 L 90 470 L 140 520 L 210 520" class="sibacom-signal-track" stroke="var(--sibacom-circuit-trace)" stroke-width="1.2" stroke-dasharray="3 3" />
                
                <!-- Animated Signal Pulses (Travelling Energy Packets) -->
                <path d="M 0 90 L 130 90 L 170 130 L 170 240 L 210 280 L 210 390 L 170 430 L 110 430" class="sibacom-signal-pulse speed-normal" stroke-width="2.5" />
                <path d="M 0 170 L 80 170 L 120 210 L 120 350 L 160 390 L 160 530 L 100 590 L 40 590" class="sibacom-signal-pulse speed-fast delay-2" stroke-width="2.5" />
                <path d="M 0 310 L 60 310 L 90 340 L 90 470 L 140 520 L 210 520" class="sibacom-signal-pulse speed-slow delay-1" stroke-width="2" />

                <!-- Microchip Package Footprint (IC1 - MCU CORE) -->
                <rect x="25" y="225" width="45" height="50" rx="4" stroke="var(--sibacom-circuit-blue)" stroke-width="1.5" fill="#FFFFFF" fill-opacity="0.9" />
                <circle cx="35" cy="235" r="2.5" fill="var(--sibacom-circuit-blue)" />
                <text x="32" y="255" font-family="monospace" font-size="7" font-weight="700" fill="var(--sibacom-circuit-blue)" letter-spacing="0.5">MCU</text>
                <text x="32" y="264" font-family="monospace" font-size="6" font-weight="600" fill="var(--sibacom-circuit-techgreen)">32b</text>

                <!-- IC Pins (Right side) -->
                <line x1="70" y1="235" x2="85" y2="235" stroke="var(--sibacom-circuit-trace)" stroke-width="1.5" />
                <line x1="70" y1="245" x2="90" y2="245" stroke="var(--sibacom-circuit-trace)" stroke-width="1.5" />
                <line x1="70" y1="255" x2="85" y2="255" stroke="var(--sibacom-circuit-trace)" stroke-width="1.5" />
                <line x1="70" y1="265" x2="90" y2="265" stroke="var(--sibacom-circuit-trace)" stroke-width="1.5" />

                <!-- Terminal Vias & Illuminating Connection Nodes -->
                <circle cx="110" cy="430" r="5" class="sibacom-solder-pad" />
                <circle cx="110" cy="430" r="2.5" class="sibacom-circuit-node node-pulse-1" fill="var(--sibacom-circuit-techgreen)" />
                <text x="120" y="433" font-family="monospace" font-size="7" font-weight="700" fill="var(--sibacom-circuit-blue)" opacity="0.6">TP1_CLK</text>

                <circle cx="40" cy="590" r="5" class="sibacom-solder-pad" />
                <circle cx="40" cy="590" r="2.5" class="sibacom-circuit-node node-pulse-2" fill="var(--sibacom-circuit-techgreen)" />
                <text x="50" y="593" font-family="monospace" font-size="7" font-weight="700" fill="var(--sibacom-circuit-blue)" opacity="0.6">BUS_RX</text>

                <circle cx="210" cy="520" r="4" class="sibacom-solder-pad" />
                <circle cx="210" cy="520" r="2" class="sibacom-circuit-node node-pulse-4" fill="var(--sibacom-circuit-blue)" />

                <!-- Branching Test Points -->
                <circle cx="170" cy="130" r="3" fill="var(--sibacom-circuit-blue)" opacity="0.5" />
                <circle cx="210" cy="280" r="3" fill="var(--sibacom-circuit-techgreen)" opacity="0.7" />
                <circle cx="160" cy="390" r="3" fill="var(--sibacom-circuit-blue)" opacity="0.5" />
            </svg>
        </div>

        <!-- Right Flank Circuit Pathways (DSP / Bus Output) -->
        <div class="sibacom-hero-circuit-right">
            <svg viewBox="0 0 340 700" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMaxYMid meet">
                <!-- Base Tracks -->
                <path d="M 340 100 L 210 100 L 170 140 L 170 250 L 130 290 L 130 400 L 170 440 L 230 440" class="sibacom-signal-track" stroke="var(--sibacom-circuit-trace)" stroke-width="1.5" />
                <path d="M 340 190 L 250 190 L 210 230 L 210 370 L 170 410 L 170 550 L 230 610 L 290 610" class="sibacom-signal-track" stroke="var(--sibacom-circuit-trace)" stroke-width="1.5" />
                <path d="M 340 330 L 270 330 L 240 360 L 240 480 L 190 530 L 120 530" class="sibacom-signal-track" stroke="var(--sibacom-circuit-trace)" stroke-width="1.2" stroke-dasharray="3 3" />

                <!-- Animated Signal Pulses -->
                <path d="M 340 100 L 210 100 L 170 140 L 170 250 L 130 290 L 130 400 L 170 440 L 230 440" class="sibacom-signal-pulse speed-slow delay-3" stroke-width="2.5" />
                <path d="M 340 190 L 250 190 L 210 230 L 210 370 L 170 410 L 170 550 L 230 610 L 290 610" class="sibacom-signal-pulse speed-normal delay-1" stroke-width="2.5" />
                <path d="M 340 330 L 270 330 L 240 360 L 240 480 L 190 530 L 120 530" class="sibacom-signal-pulse speed-fast delay-4" stroke-width="2" />

                <!-- FPGA Package Footprint -->
                <rect x="270" y="240" width="45" height="48" rx="4" stroke="var(--sibacom-circuit-blue)" stroke-width="1.5" fill="#FFFFFF" fill-opacity="0.9" />
                <circle cx="305" cy="250" r="2.5" fill="var(--sibacom-circuit-techgreen)" />
                <text x="278" y="268" font-family="monospace" font-size="7" font-weight="700" fill="var(--sibacom-circuit-blue)" letter-spacing="0.5">DSP</text>
                <text x="278" y="277" font-family="monospace" font-size="6" font-weight="600" fill="var(--sibacom-circuit-techgreen)">CORE</text>

                <!-- IC Pins (Left side) -->
                <line x1="270" y1="248" x2="255" y2="248" stroke="var(--sibacom-circuit-trace)" stroke-width="1.5" />
                <line x1="270" y1="258" x2="250" y2="258" stroke="var(--sibacom-circuit-trace)" stroke-width="1.5" />
                <line x1="270" y1="268" x2="255" y2="268" stroke="var(--sibacom-circuit-trace)" stroke-width="1.5" />
                <line x1="270" y1="278" x2="250" y2="278" stroke="var(--sibacom-circuit-trace)" stroke-width="1.5" />

                <!-- Terminal Vias & Illuminating Connection Nodes -->
                <circle cx="230" cy="440" r="5" class="sibacom-solder-pad" />
                <circle cx="230" cy="440" r="2.5" class="sibacom-circuit-node node-pulse-3" fill="var(--sibacom-circuit-techgreen)" />
                <text x="175" y="443" font-family="monospace" font-size="7" font-weight="700" fill="var(--sibacom-circuit-blue)" opacity="0.6">BUS_TX</text>

                <circle cx="290" cy="610" r="5" class="sibacom-solder-pad" />
                <circle cx="290" cy="610" r="2.5" class="sibacom-circuit-node node-pulse-1" fill="var(--sibacom-circuit-techgreen)" />
                <text x="245" y="613" font-family="monospace" font-size="7" font-weight="700" fill="var(--sibacom-circuit-blue)" opacity="0.6">TP2_DATA</text>

                <circle cx="120" cy="530" r="4" class="sibacom-solder-pad" />
                <circle cx="120" cy="530" r="2" class="sibacom-circuit-node node-pulse-2" fill="var(--sibacom-circuit-blue)" />

                <!-- Branching Test Points -->
                <circle cx="170" cy="140" r="3" fill="var(--sibacom-circuit-techgreen)" opacity="0.7" />
                <circle cx="130" cy="290" r="3" fill="var(--sibacom-circuit-blue)" opacity="0.5" />
                <circle cx="170" cy="410" r="3" fill="var(--sibacom-circuit-techgreen)" opacity="0.6" />
            </svg>
        </div>

        <!-- Bottom Digital Data Bus (Linking Hero to Event Info Section) -->
        <div class="sibacom-hero-bus-bottom">
            <svg viewBox="0 0 1200 36" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <line x1="0" y1="12" x2="1200" y2="12" stroke="var(--sibacom-circuit-trace)" stroke-width="1.2" />
                <line x1="0" y1="20" x2="1200" y2="20" stroke="var(--sibacom-circuit-trace)" stroke-width="1.2" stroke-dasharray="4 8" />
                <line x1="0" y1="28" x2="1200" y2="28" stroke="var(--sibacom-circuit-trace)" stroke-width="1" />

                <!-- Bus Signal Pulses -->
                <path d="M 0 12 L 1200 12" class="sibacom-signal-pulse speed-fast delay-1" stroke-width="2" />
                <path d="M 1200 28 L 0 28" class="sibacom-signal-pulse speed-normal delay-3 reverse" stroke-width="1.8" />

                <!-- Bus Tap Nodes -->
                <circle cx="200" cy="12" r="3" fill="var(--sibacom-circuit-techgreen)" />
                <circle cx="450" cy="20" r="2.5" fill="var(--sibacom-circuit-blue)" />
                <circle cx="750" cy="12" r="3" fill="var(--sibacom-circuit-techgreen)" />
                <circle cx="1000" cy="28" r="2.5" fill="var(--sibacom-circuit-blue)" />
            </svg>
        </div>
    </div>
    <?php
}

/**
 * Output PCB Corner Bracket SVG
 *
 * @param string $pos Corner position: 'tl', 'tr', 'bl', 'br'
 */
function sibacom_the_circuit_corner($pos = 'tl') {
    $pos = in_array($pos, array('tl', 'tr', 'bl', 'br')) ? $pos : 'tl';
    ?>
    <div class="sibacom-circuit-corner corner-<?php echo esc_attr($pos); ?>" aria-hidden="true">
        <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <?php if ($pos === 'tl') : ?>
                <path d="M 2 26 L 2 12 L 12 2 L 26 2" class="corner-line" />
                <circle cx="26" cy="2" r="2" class="corner-via" />
                <circle cx="2" cy="26" r="2" class="corner-via" />
            <?php elseif ($pos === 'tr') : ?>
                <path d="M 46 26 L 46 12 L 36 2 L 22 2" class="corner-line" />
                <circle cx="22" cy="2" r="2" class="corner-via" />
                <circle cx="46" cy="26" r="2" class="corner-via" />
            <?php elseif ($pos === 'bl') : ?>
                <path d="M 2 22 L 2 36 L 12 46 L 26 46" class="corner-line" />
                <circle cx="26" cy="46" r="2" class="corner-via" />
                <circle cx="2" cy="22" r="2" class="corner-via" />
            <?php elseif ($pos === 'br') : ?>
                <path d="M 46 22 L 46 36 L 36 46 L 22 46" class="corner-line" />
                <circle cx="22" cy="46" r="2" class="corner-via" />
                <circle cx="46" cy="22" r="2" class="corner-via" />
            <?php endif; ?>
        </svg>
    </div>
    <?php
}

/**
 * Output Circuit Connector Separator between Joint Organizers & Academic Partners
 */
function sibacom_the_circuit_connector($bus_left = 'CSE_BUS', $chip_brand = 'SIBACOM', $chip_model = 'BRIDGE', $bus_right = 'EE_BUS') {
    $bus_left   = !empty(trim((string)$bus_left)) ? trim((string)$bus_left) : 'CSE_BUS';
    $chip_brand = !empty(trim((string)$chip_brand)) ? trim((string)$chip_brand) : 'SIBACOM';
    $chip_model = !empty(trim((string)$chip_model)) ? trim((string)$chip_model) : 'BRIDGE';
    $bus_right  = !empty(trim((string)$bus_right)) ? trim((string)$bus_right) : 'EE_BUS';
    ?>
    <div class="sibacom-circuit-connector" aria-hidden="true">
        <svg viewBox="0 0 680 48" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid meet">
            <!-- Left Wing (CSE Society Bridge) -->
            <path d="M 40 24 L 200 24 L 230 14 L 300 14" stroke="var(--sibacom-circuit-trace)" stroke-width="1.5" />
            <path d="M 80 34 L 180 34 L 210 24 L 290 24" stroke="var(--sibacom-circuit-trace)" stroke-width="1" stroke-dasharray="3 3" />
            <path d="M 40 24 L 200 24 L 230 14 L 300 14" class="sibacom-signal-pulse speed-normal" stroke-width="2.2" />

            <!-- Left Terminal Via -->
            <circle cx="40" cy="24" r="4.5" class="sibacom-solder-pad" />
            <circle cx="40" cy="24" r="2" fill="var(--sibacom-circuit-blue)" />
            <text x="52" y="20" font-family="monospace" font-size="7" font-weight="700" fill="var(--sibacom-circuit-blue)" opacity="0.7"><?php echo esc_html($bus_left); ?></text>

            <!-- Center Microprocessor Interconnect Chip -->
            <g transform="translate(300, 4)">
                <rect x="0" y="0" width="80" height="40" rx="4" class="sibacom-connector-chip" />
                <rect x="6" y="6" width="68" height="28" rx="2" fill="var(--sibacom-bg)" />
                <circle cx="16" cy="15" r="2" class="sibacom-connector-chip-core" />
                <circle cx="16" cy="25" r="2" class="sibacom-connector-chip-core" />
                <text x="24" y="18" font-family="monospace" font-size="7" font-weight="700" fill="var(--sibacom-circuit-blue)" letter-spacing="0.5"><?php echo esc_html($chip_brand); ?></text>
                <text x="24" y="27" font-family="monospace" font-size="6" font-weight="600" fill="var(--sibacom-circuit-techgreen)"><?php echo esc_html($chip_model); ?></text>

                <!-- Top & Bottom Micro-pins -->
                <line x1="20" y1="0" x2="20" y2="-4" stroke="var(--sibacom-circuit-blue)" stroke-width="1.2" />
                <line x1="32" y1="0" x2="32" y2="-4" stroke="var(--sibacom-circuit-blue)" stroke-width="1.2" />
                <line x1="44" y1="0" x2="44" y2="-4" stroke="var(--sibacom-circuit-blue)" stroke-width="1.2" />
                <line x1="56" y1="0" x2="56" y2="-4" stroke="var(--sibacom-circuit-blue)" stroke-width="1.2" />

                <line x1="20" y1="40" x2="20" y2="44" stroke="var(--sibacom-circuit-blue)" stroke-width="1.2" />
                <line x1="32" y1="40" x2="32" y2="44" stroke="var(--sibacom-circuit-blue)" stroke-width="1.2" />
                <line x1="44" y1="40" x2="44" y2="44" stroke="var(--sibacom-circuit-blue)" stroke-width="1.2" />
                <line x1="56" y1="40" x2="56" y2="44" stroke="var(--sibacom-circuit-blue)" stroke-width="1.2" />
            </g>

            <!-- Right Wing (EE Society Bridge) -->
            <path d="M 380 14 L 450 14 L 480 24 L 640 24" stroke="var(--sibacom-circuit-trace)" stroke-width="1.5" />
            <path d="M 390 24 L 470 24 L 500 34 L 600 34" stroke="var(--sibacom-circuit-trace)" stroke-width="1" stroke-dasharray="3 3" />
            <path d="M 380 14 L 450 14 L 480 24 L 640 24" class="sibacom-signal-pulse speed-normal delay-2" stroke-width="2.2" />

            <!-- Right Terminal Via -->
            <circle cx="640" cy="24" r="4.5" class="sibacom-solder-pad" />
            <circle cx="640" cy="24" r="2" fill="var(--sibacom-circuit-techgreen)" />
            <text x="585" y="20" font-family="monospace" font-size="7" font-weight="700" fill="var(--sibacom-circuit-techgreen)" opacity="0.8"><?php echo esc_html($bus_right); ?></text>
        </svg>
    </div>
    <?php
}

/**
 * Output Schedule Timeline Signal Pulse Track
 */
function sibacom_the_timeline_signal_track() {
    ?>
    <div class="sibacom-timeline-signal-pulse" aria-hidden="true"></div>
    <?php
}

/**
 * Output Footer Restrained PCB Background
 */
function sibacom_the_footer_circuits() {
    ?>
    <div class="sibacom-footer-circuit-bg" aria-hidden="true">
        <svg viewBox="0 0 1440 400" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice">
            <!-- Major Horizontal Buses -->
            <line x1="0" y1="60" x2="1440" y2="60" stroke="rgba(41, 98, 222, 0.22)" stroke-width="1.5" />
            <line x1="0" y1="72" x2="1440" y2="72" stroke="rgba(255, 255, 255, 0.08)" stroke-width="1" stroke-dasharray="6 8" />
            <line x1="0" y1="340" x2="1440" y2="340" stroke="rgba(41, 98, 222, 0.2)" stroke-width="1.2" />

            <!-- Flowing Signal Pulses across Footer Buses -->
            <path d="M 0 60 L 1440 60" class="sibacom-signal-pulse speed-slow" stroke="var(--sibacom-circuit-techgreen)" stroke-width="2" />
            <path d="M 1440 340 L 0 340" class="sibacom-signal-pulse speed-gentle delay-2 reverse" stroke="#2962DE" stroke-width="2" />

            <!-- Geometric Branching Traces -->
            <path d="M 180 60 L 180 180 L 240 240 L 240 340" stroke="rgba(41, 98, 222, 0.22)" stroke-width="1.5" />
            <path d="M 180 60 L 180 180 L 240 240 L 240 340" class="sibacom-signal-pulse speed-normal delay-1" stroke-width="2" />

            <path d="M 520 60 L 520 140 L 580 200 L 580 340" stroke="rgba(41, 98, 222, 0.18)" stroke-width="1.2" />
            <path d="M 880 340 L 880 220 L 820 160 L 820 60" stroke="rgba(41, 98, 222, 0.22)" stroke-width="1.5" />
            <path d="M 880 340 L 880 220 L 820 160 L 820 60" class="sibacom-signal-pulse speed-fast delay-3" stroke-width="2" />

            <path d="M 1240 60 L 1240 160 L 1180 220 L 1180 340" stroke="rgba(41, 98, 222, 0.18)" stroke-width="1.2" />

            <!-- Solder Pads & Glow Vias -->
            <circle cx="180" cy="180" r="3.5" fill="#2962DE" opacity="0.8" />
            <circle cx="240" cy="240" r="3.5" class="sibacom-circuit-node node-pulse-1" fill="var(--sibacom-circuit-techgreen)" />
            <circle cx="580" cy="200" r="3" fill="#2962DE" opacity="0.7" />
            <circle cx="820" cy="160" r="3.5" class="sibacom-circuit-node node-pulse-2" fill="var(--sibacom-circuit-techgreen)" />
            <circle cx="1180" cy="220" r="3" fill="#2962DE" opacity="0.7" />
        </svg>
    </div>
    <?php
}

/**
 * Output Reusable Subtle Circuit Background
 *
 * @param string $variant 'light' (default) or 'dark'
 * @param string $classes Extra CSS classes
 */
function sibacom_the_circuit_bg($variant = 'light', $classes = '') {
    $is_dark = ($variant === 'dark');
    $pattern_class = $is_dark ? 'sibacom-circuit-pattern-dark' : 'sibacom-circuit-pattern-light';
    ?>
    <div class="sibacom-circuit-background <?php echo esc_attr($pattern_class . ' ' . $classes); ?>" aria-hidden="true">
        <svg viewBox="0 0 1200 600" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <!-- Distributed Subtle PCB Traces -->
            <path d="M 50 40 L 180 40 L 220 80 L 220 180 L 260 220 L 400 220" class="trace-bus" />
            <path d="M 50 40 L 180 40 L 220 80 L 220 180 L 260 220 L 400 220" class="sibacom-signal-pulse speed-slow delay-2" stroke-width="1.8" />

            <path d="M 800 40 L 920 40 L 960 80 L 960 200 L 1020 260 L 1150 260" class="trace-bus" />
            <path d="M 800 40 L 920 40 L 960 80 L 960 200 L 1020 260 L 1150 260" class="sibacom-signal-pulse speed-gentle delay-1" stroke-width="1.8" />

            <path d="M 120 400 L 240 400 L 280 440 L 280 540 L 340 580" class="trace-thin" />
            <path d="M 720 540 L 840 540 L 880 500 L 880 380 L 940 320 L 1080 320" class="trace-bus" />
            <path d="M 720 540 L 840 540 L 880 500 L 880 380 L 940 320 L 1080 320" class="sibacom-signal-pulse speed-normal delay-3" stroke-width="1.8" />

            <!-- Circular Vias -->
            <circle cx="220" cy="80" r="3" class="circuit-via" />
            <circle cx="260" cy="220" r="3.5" class="circuit-via-green sibacom-circuit-node node-pulse-1" />
            <circle cx="960" cy="80" r="3" class="circuit-via" />
            <circle cx="1020" cy="260" r="3.5" class="circuit-via-green sibacom-circuit-node node-pulse-3" />
            <circle cx="880" cy="500" r="3" class="circuit-via" />
            <circle cx="940" cy="320" r="3.5" class="circuit-via-green sibacom-circuit-node node-pulse-2" />
        </svg>
    </div>
    <?php
}

/**
 * Render the Official SIBACOM '26 Brand Wordmark & Dynamic Orbital Trajectory Emblem
 *
 * @param string $title Main title (default: 'SIBACOM')
 * @param string $edition Edition label (default: "'26")
 */
function sibacom_the_hero_brand_lockup($title = 'SIBACOM', $edition = "'26") {
    $title = !empty($title) ? $title : 'SIBACOM';
    $edition = !empty($edition) ? $edition : "'26";
    $year_num = str_replace(array("'", "’"), '', $edition);
    ?>
    <div class="sibacom-brand-hero-emblem-wrap">
        <!-- Atmospheric Radial Ambient Backlight Aura -->
        <div class="sibacom-brand-glow" aria-hidden="true"></div>

        <div class="sibacom-brand-wordmark-lockup">
            <!-- Dynamic Vector Orbital Trajectory Arc, Apex Satellite Node & Official Dynamic Crescent Wings -->
            <svg class="sibacom-brand-orbital-arc" viewBox="0 0 760 210" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="none">
                <defs>
                    <!-- Primary Trajectory Gradient -->
                    <linearGradient id="sibacomBrandOrbitalGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#082856" stop-opacity="0.10" />
                        <stop offset="25%" stop-color="#173F91" stop-opacity="0.80" />
                        <stop offset="48%" stop-color="#0284C7" stop-opacity="0.95" />
                        <stop offset="72%" stop-color="#00D2FF" stop-opacity="1.00" />
                        <stop offset="88%" stop-color="#079B58" stop-opacity="0.95" />
                        <stop offset="100%" stop-color="#0BB768" stop-opacity="0.90" />
                    </linearGradient>

                    <!-- Secondary Acceleration Dash Trail Gradient -->
                    <linearGradient id="sibacomBrandSecTrailGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#0284C7" stop-opacity="0.08" />
                        <stop offset="50%" stop-color="#079B58" stop-opacity="0.50" />
                        <stop offset="100%" stop-color="#0BB768" stop-opacity="0.80" />
                    </linearGradient>

                    <!-- Outer Sweeping Crescent Wing Gradient (Official SIBACOM Emblem) -->
                    <linearGradient id="sibacomBrandWingGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" stop-color="#0284C7" stop-opacity="0.90" />
                        <stop offset="35%" stop-color="#00A3C4" stop-opacity="0.95" />
                        <stop offset="75%" stop-color="#079B58" stop-opacity="0.95" />
                        <stop offset="100%" stop-color="#0BB768" stop-opacity="0.85" />
                    </linearGradient>

                    <!-- Inner Sweeping Crescent Wing Gradient -->
                    <linearGradient id="sibacomBrandWingInnerGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" stop-color="#00B4D8" stop-opacity="0.80" />
                        <stop offset="50%" stop-color="#079B58" stop-opacity="0.90" />
                        <stop offset="100%" stop-color="#10B981" stop-opacity="0.80" />
                    </linearGradient>

                    <!-- Radial Glow for Apex Satellite -->
                    <radialGradient id="sibacomSatelliteHalo" cx="50%" cy="50%" r="50%">
                        <stop offset="0%" stop-color="#FFFFFF" stop-opacity="0.95" />
                        <stop offset="40%" stop-color="#00D2FF" stop-opacity="0.70" />
                        <stop offset="70%" stop-color="#079B58" stop-opacity="0.30" />
                        <stop offset="100%" stop-color="#079B58" stop-opacity="0" />
                    </radialGradient>
                </defs>

                <!-- Primary Sweeping Orbital Trajectory Arc echoing official SIBACOM emblem -->
                <path d="M 40 145 C 130 52, 250 18, 370 18 C 490 18, 610 46, 680 92 C 716 116, 730 144, 718 168 C 700 196, 646 206, 560 204" 
                      stroke="url(#sibacomBrandOrbitalGrad)" stroke-width="2.6" stroke-linecap="round" />

                <!-- Secondary Energetic Acceleration Dash Trail -->
                <path d="M 135 110 C 220 40, 305 28, 385 28 C 495 28, 608 52, 672 96 C 702 118, 712 142, 700 162 C 684 186, 638 196, 568 194" 
                      stroke="url(#sibacomBrandSecTrailGrad)" stroke-width="1.5" stroke-linecap="round" stroke-dasharray="8 6" opacity="0.8" />

                <!-- Official Aerodynamic Crescent Wing: Outer Wing Blade (Fitted to right perimeter) -->
                <path d="M 590 45 C 665 75, 735 115, 735 152 C 735 174, 710 192, 668 198 C 610 206, 545 204, 490 198 C 555 202, 635 196, 675 178 C 708 162, 705 125, 645 75 Z" 
                      fill="url(#sibacomBrandWingGrad)" />

                <!-- Official Aerodynamic Crescent Wing: Inner Wing Blade -->
                <path d="M 625 82 C 678 112, 706 138, 704 162 C 700 178, 680 188, 642 192 C 596 195, 544 192, 502 186 C 552 190, 614 188, 648 174 C 675 160, 670 128, 625 82 Z" 
                      fill="url(#sibacomBrandWingInnerGrad)" />

                <!-- Apex Satellite Halo & Pulse Rings (Orbit Apex at Crest) -->
                <circle cx="370" cy="18" r="14" fill="url(#sibacomSatelliteHalo)" />
                <circle cx="370" cy="18" r="8" fill="none" stroke="#00D2FF" stroke-width="1.5" class="sibacom-satellite-ring" />
                <circle cx="370" cy="18" r="5" fill="#FFFFFF" stroke="#0284C7" stroke-width="2" />
                <circle cx="370" cy="18" r="2.2" fill="#079B58" />

                <!-- Dynamic Orbital Energy Pulse Particle (Glides Along Trajectory) -->
                <circle class="sibacom-satellite-traveler" cx="370" cy="18" r="3.2" fill="#00E5FF" />

                <!-- Secondary Lockup Energy Diode near '26 Lockup -->
                <circle cx="618" cy="62" r="3" fill="#079B58" opacity="0.9" />
            </svg>

            <!-- Dominant Official Wordmark Composition: SIBACOM -->
            <h1 class="sibacom-hero-wordmark font-display" aria-label="<?php echo esc_attr($title . ' 20' . $year_num); ?>">
                <span class="sibacom-wordmark-core"><?php echo esc_html($title); ?></span>
                <span class="sibacom-brand-edition-lockup" aria-hidden="true">
                    <span class="sibacom-brand-edition-badge">
                        <span class="sibacom-brand-apostrophe">’</span><span class="sibacom-brand-year"><?php echo esc_html($year_num); ?></span>
                        <span class="sibacom-brand-edition-dot" aria-hidden="true"></span>
                    </span>
                </span>
            </h1>
        </div>
    </div>
    <?php
}

/**
 * Render Electrified "POWER TO PROGRESS" Tagline with Individual Letter Wave Pulses
 *
 * @param string $tagline Headline/tagline text (default: 'POWER TO PROGRESS')
 */
function sibacom_the_electrified_tagline($tagline = 'POWER TO PROGRESS') {
    $tagline = !empty($tagline) ? trim($tagline) : 'POWER TO PROGRESS';
    $words = explode(' ', $tagline);
    $char_index = 0;
    ?>
    <div class="sibacom-tagline-electrified-container" role="text" aria-label="<?php echo esc_attr($tagline); ?>">
        <!-- Left Electrical Spark Node & Energy Lead -->
        <div class="sibacom-electric-conduit conduit-left" aria-hidden="true">
            <span class="sibacom-conduit-line"></span>
            <span class="sibacom-conduit-node">
                <span class="sibacom-conduit-node-spark"></span>
            </span>
        </div>

        <!-- The Electrified Tagline Typography Lockup -->
        <p class="sibacom-hero-tagline-electrified" aria-hidden="true">
            <?php foreach ($words as $w_idx => $word) : ?>
                <span class="sibacom-electric-word" data-word="<?php echo esc_attr($word); ?>">
                    <?php
                    $chars = preg_split('//u', $word, -1, PREG_SPLIT_NO_EMPTY);
                    foreach ($chars as $ch) {
                        echo '<span class="sibacom-electric-char" style="--char-index: ' . $char_index . ';">' . esc_html($ch) . '</span>';
                        $char_index++;
                    }
                    ?>
                </span>
                <?php if ($w_idx < count($words) - 1) : ?>
                    <span class="sibacom-electric-gap">&nbsp;</span>
                <?php endif; ?>
            <?php endforeach; ?>

            <!-- Travelling Lightning-Inspired Energy Highlight Beam -->
            <span class="sibacom-tagline-electric-beam" aria-hidden="true"></span>

            <!-- Ambient Energy Wave Aura -->
            <span class="sibacom-tagline-aura" aria-hidden="true"></span>

            <!-- Plasma Filament Energy Wave (SVG) -->
            <svg class="sibacom-plasma-filament-svg" viewBox="0 0 380 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="none">
                <path d="M 0 8 Q 95 2, 190 8 T 380 8" stroke="url(#plasmaWaveGrad)" stroke-width="1.2" stroke-linecap="round" class="sibacom-plasma-trace" />
                <defs>
                    <linearGradient id="plasmaWaveGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" stop-color="#0284C7" stop-opacity="0" />
                        <stop offset="35%" stop-color="#0284C7" stop-opacity="0.6" />
                        <stop offset="50%" stop-color="#00D2FF" stop-opacity="0.9" />
                        <stop offset="65%" stop-color="#079B58" stop-opacity="0.6" />
                        <stop offset="100%" stop-color="#079B58" stop-opacity="0" />
                    </linearGradient>
                </defs>
            </svg>
        </p>

        <!-- Right Electrical Spark Node & Energy Lead -->
        <div class="sibacom-electric-conduit conduit-right" aria-hidden="true">
            <span class="sibacom-conduit-node">
                <span class="sibacom-conduit-node-spark"></span>
            </span>
            <span class="sibacom-conduit-line"></span>
        </div>
    </div>
    <?php
}



