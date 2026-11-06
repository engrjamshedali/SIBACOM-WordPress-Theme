<?php
/**
 * SIBACOM Default Site Header Template Part
 *
 * @package SIBACOM
 */

if (!defined('ABSPATH')) {
    exit;
}

$is_register_enabled = function_exists('sibacom_is_register_enabled') ? sibacom_is_register_enabled() : true;
$register_url        = function_exists('sibacom_get_register_url') ? sibacom_get_register_url() : sibacom_get_option('header_cta_url', 'https://portal.sibacom.tech/');
$register_text       = function_exists('sibacom_get_register_text') ? sibacom_get_register_text() : sibacom_get_option('header_cta_text', 'Register Now');
$register_target     = function_exists('sibacom_get_register_target') ? sibacom_get_register_target() : '_blank';
$register_rel        = ($register_target === '_blank') ? ' rel="noopener noreferrer"' : '';
?>
<header class="sibacom-header" id="masthead">
    <div class="sibacom-container">
        <div class="sibacom-header-inner">
            
            <!-- Branding: Official SIBACOM Logo & Sukkur IBA University Lockup -->
            <a href="<?php echo esc_url(home_url('/')); ?>" class="sibacom-branding" rel="home" title="<?php esc_attr_e('SIBACOM 2026 – Home', 'sibacom'); ?>">
                <div class="sibacom-logo-badge" style="display: flex; align-items: center; justify-content: center; width: 44px; height: 44px; border-radius: 9px; overflow: hidden; background: #03326A; box-shadow: 0 2px 8px rgba(3, 50, 106, 0.22); flex-shrink: 0;">
                    <?php if (function_exists('sibacom_the_official_logo')) { sibacom_the_official_logo('header', 'sibacom-main-logo', 44); } else { ?>
                        <img src="<?php echo esc_url(SIBACOM_THEME_URI . '/assets/images/sibacom_logo.jpg'); ?>" alt="<?php esc_attr_e('SIBACOM Official Logo', 'sibacom'); ?>" width="44" height="44" class="sibacom-main-logo" style="height:44px; width:44px; object-fit:contain;" />
                    <?php } ?>
                </div>
                <div class="sibacom-branding-divider"></div>
                <?php sibacom_the_university_logo(); ?>
                <div class="sibacom-branding-divider sibacom-branding-divider-secondary"></div>
                <div class="sibacom-brand-title-wrap" style="display: flex; flex-direction: column; justify-content: center;">
                    <span class="sibacom-brand-name font-display" style="font-size: 1.4rem; font-weight: 800; color: var(--sibacom-primary); letter-spacing: -0.02em; line-height: 1.1;"><?php echo esc_html(function_exists('sibacom_get_option') ? sibacom_get_option('event_name', 'SIBACOM') : 'SIBACOM'); ?></span>
                    <span class="sibacom-brand-sub" style="font-size: 0.68rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--sibacom-techgreen); display: flex; align-items: center; gap: 4px; margin-top: 2px;">
                        <span>CSE Society</span>
                        <span style="color: var(--sibacom-text-secondary); opacity: 0.5;">&</span>
                        <span>EE Society</span>
                    </span>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="sibacom-nav-wrap" aria-label="<?php esc_attr_e('Primary Menu', 'sibacom'); ?>">
                <?php
                if (has_nav_menu('primary-menu')) {
                    wp_nav_menu(array(
                        'theme_location' => 'primary-menu',
                        'menu_class'     => 'sibacom-nav-desktop',
                        'container'      => false,
                        'fallback_cb'    => false,
                    ));
                } else {
                    // Comprehensive verified navigation links for all 9 standalone pages
                    ?>
                    <ul class="sibacom-nav-desktop">
                        <li class="<?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('home')) ? 'current-menu-item' : ''; ?>">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="sibacom-nav-link <?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('home')) ? 'active is-active' : ''; ?>" <?php if (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('home')) echo 'aria-current="page"'; ?>><?php esc_html_e('Home', 'sibacom'); ?></a>
                        </li>
                        <li class="<?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('about')) ? 'current-menu-item' : ''; ?>">
                            <a href="<?php echo esc_url(home_url('/about/')); ?>" class="sibacom-nav-link <?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('about')) ? 'active is-active' : ''; ?>" <?php if (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('about')) echo 'aria-current="page"'; ?>><?php esc_html_e('About', 'sibacom'); ?></a>
                        </li>
                        <li class="<?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('events')) ? 'current-menu-item' : ''; ?>">
                            <a href="<?php echo esc_url(home_url('/events/')); ?>" class="sibacom-nav-link <?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('events')) ? 'active is-active' : ''; ?>" <?php if (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('events')) echo 'aria-current="page"'; ?>><?php esc_html_e('Events', 'sibacom'); ?></a>
                        </li>
                        <li class="<?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('schedule')) ? 'current-menu-item' : ''; ?>">
                            <a href="<?php echo esc_url(home_url('/schedule/')); ?>" class="sibacom-nav-link <?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('schedule')) ? 'active is-active' : ''; ?>" <?php if (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('schedule')) echo 'aria-current="page"'; ?>><?php esc_html_e('Schedule', 'sibacom'); ?></a>
                        </li>
                        <li class="<?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('speakers')) ? 'current-menu-item' : ''; ?>">
                            <a href="<?php echo esc_url(home_url('/speakers/')); ?>" class="sibacom-nav-link <?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('speakers')) ? 'active is-active' : ''; ?>" <?php if (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('speakers')) echo 'aria-current="page"'; ?>><?php esc_html_e('Speakers', 'sibacom'); ?></a>
                        </li>
                        <li class="<?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('guests')) ? 'current-menu-item' : ''; ?>">
                            <a href="<?php echo esc_url(home_url('/guests/')); ?>" class="sibacom-nav-link <?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('guests')) ? 'active is-active' : ''; ?>" <?php if (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('guests')) echo 'aria-current="page"'; ?>><?php esc_html_e('Guests', 'sibacom'); ?></a>
                        </li>
                        <li class="<?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('organizers')) ? 'current-menu-item' : ''; ?>">
                            <a href="<?php echo esc_url(home_url('/organizers/')); ?>" class="sibacom-nav-link <?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('organizers')) ? 'active is-active' : ''; ?>" <?php if (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('organizers')) echo 'aria-current="page"'; ?>><?php esc_html_e('Organizers', 'sibacom'); ?></a>
                        </li>
                        <li class="<?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('contact')) ? 'current-menu-item' : ''; ?>">
                            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="sibacom-nav-link <?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('contact')) ? 'active is-active' : ''; ?>" <?php if (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('contact')) echo 'aria-current="page"'; ?>><?php esc_html_e('Contact', 'sibacom'); ?></a>
                        </li>
                    </ul>
                    <?php
                }
                ?>
            </nav>

            <!-- Header Action CTA & Mobile Toggle -->
            <div class="sibacom-header-actions">
                <?php if ($is_register_enabled) : ?>
                <a href="<?php echo esc_url($register_url); ?>" target="<?php echo esc_attr($register_target); ?>"<?php echo $register_rel; ?> class="sibacom-btn sibacom-btn-primary">
                    <span><?php echo esc_html($register_text); ?></span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
                <?php endif; ?>

                <button class="sibacom-mobile-toggle" aria-label="<?php esc_attr_e('Toggle navigation menu', 'sibacom'); ?>" aria-expanded="false" aria-controls="sibacom-mobile-drawer">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>

        </div>
    </div>

    <!-- Mobile Slide-Down Menu Drawer -->
    <div class="sibacom-mobile-menu" id="sibacom-mobile-drawer" role="region" aria-label="<?php esc_attr_e('Mobile Navigation', 'sibacom'); ?>">
        <div class="sibacom-mobile-header" style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 1rem; margin-bottom: 1rem; border-bottom: 1px solid var(--sibacom-border);">
            <div style="display: flex; align-items: center; gap: 10px;">
                <div class="sibacom-logo-badge sibacom-logo-badge-mobile" style="width: 40px; height: 40px; border-radius: 8px; overflow: hidden; background: #03326A; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 2px 8px rgba(3, 50, 106, 0.25);">
                    <img src="<?php echo esc_url(function_exists('sibacom_get_logo_url') ? sibacom_get_logo_url() : SIBACOM_THEME_URI . '/assets/images/sibacom_logo.jpg'); ?>" alt="<?php esc_attr_e('SIBACOM Official Logo', 'sibacom'); ?>" width="40" height="40" style="height: 40px; width: 40px; aspect-ratio: 1/1; object-fit: contain;" />
                </div>
                <div>
                    <span style="font-weight: 800; font-size: 1.1rem; color: var(--sibacom-primary); letter-spacing: -0.02em; display: block;"><?php echo esc_html(function_exists('sibacom_get_option') ? sibacom_get_option('event_name', 'SIBACOM 2026') : 'SIBACOM 2026'); ?></span>
                    <span style="font-size: 0.68rem; font-weight: 700; color: var(--sibacom-techgreen); text-transform: uppercase; letter-spacing: 0.04em;">CSE Society &bull; EE Society</span>
                </div>
            </div>
            <button class="sibacom-mobile-close" aria-label="<?php esc_attr_e('Close Menu', 'sibacom'); ?>" style="background: none; border: none; font-size: 1.25rem; color: var(--sibacom-text-primary); cursor: pointer; min-width: 44px; min-height: 44px; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <ul class="sibacom-mobile-nav">
            <li class="<?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('home')) ? 'current-menu-item' : ''; ?>">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="<?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('home')) ? 'active is-active' : ''; ?>" <?php if (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('home')) echo 'aria-current="page"'; ?>>
                    <i class="fa-solid fa-house" style="margin-right: 8px; color: var(--sibacom-primary);"></i><?php esc_html_e('Home', 'sibacom'); ?>
                </a>
            </li>
            <li class="<?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('about')) ? 'current-menu-item' : ''; ?>">
                <a href="<?php echo esc_url(home_url('/about/')); ?>" class="<?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('about')) ? 'active is-active' : ''; ?>" <?php if (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('about')) echo 'aria-current="page"'; ?>>
                    <i class="fa-solid fa-compass" style="margin-right: 8px; color: var(--sibacom-techgreen);"></i><?php esc_html_e('About SIBACOM', 'sibacom'); ?>
                </a>
            </li>
            <li class="<?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('events')) ? 'current-menu-item' : ''; ?>">
                <a href="<?php echo esc_url(home_url('/events/')); ?>" class="<?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('events')) ? 'active is-active' : ''; ?>" <?php if (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('events')) echo 'aria-current="page"'; ?>>
                    <i class="fa-solid fa-ticket" style="margin-right: 8px; color: var(--sibacom-primary);"></i><?php esc_html_e('Events & Competitions', 'sibacom'); ?>
                </a>
            </li>
            <li class="<?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('schedule')) ? 'current-menu-item' : ''; ?>">
                <a href="<?php echo esc_url(home_url('/schedule/')); ?>" class="<?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('schedule')) ? 'active is-active' : ''; ?>" <?php if (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('schedule')) echo 'aria-current="page"'; ?>>
                    <i class="fa-solid fa-clock" style="margin-right: 8px; color: var(--sibacom-techgreen);"></i><?php esc_html_e('Event Schedule', 'sibacom'); ?>
                </a>
            </li>
            <li class="<?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('speakers')) ? 'current-menu-item' : ''; ?>">
                <a href="<?php echo esc_url(home_url('/speakers/')); ?>" class="<?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('speakers')) ? 'active is-active' : ''; ?>" <?php if (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('speakers')) echo 'aria-current="page"'; ?>>
                    <i class="fa-solid fa-microphone-lines" style="margin-right: 8px; color: var(--sibacom-primary);"></i><?php esc_html_e('Distinguished Speakers', 'sibacom'); ?>
                </a>
            </li>
            <li class="<?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('guests')) ? 'current-menu-item' : ''; ?>">
                <a href="<?php echo esc_url(home_url('/guests/')); ?>" class="<?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('guests')) ? 'active is-active' : ''; ?>" <?php if (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('guests')) echo 'aria-current="page"'; ?>>
                    <i class="fa-solid fa-award" style="margin-right: 8px; color: var(--sibacom-techgreen);"></i><?php esc_html_e('Chief & Special Guests', 'sibacom'); ?>
                </a>
            </li>
            <li class="<?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('organizers')) ? 'current-menu-item' : ''; ?>">
                <a href="<?php echo esc_url(home_url('/organizers/')); ?>" class="<?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('organizers')) ? 'active is-active' : ''; ?>" <?php if (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('organizers')) echo 'aria-current="page"'; ?>>
                    <i class="fa-solid fa-building-columns" style="margin-right: 8px; color: var(--sibacom-navy);"></i><?php esc_html_e('Organizing Committee', 'sibacom'); ?>
                </a>
            </li>
            <li class="<?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('contact')) ? 'current-menu-item' : ''; ?>">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="<?php echo (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('contact')) ? 'active is-active' : ''; ?>" <?php if (function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('contact')) echo 'aria-current="page"'; ?>>
                    <i class="fa-solid fa-envelope" style="margin-right: 8px; color: var(--sibacom-primary);"></i><?php esc_html_e('Official Contact', 'sibacom'); ?>
                </a>
            </li>
            <?php if ($is_register_enabled) : ?>
            <li style="margin-top: 1.25rem;">
                <a href="<?php echo esc_url($register_url); ?>" target="<?php echo esc_attr($register_target); ?>"<?php echo $register_rel; ?> class="sibacom-btn sibacom-btn-primary" style="color: #fff; width: 100%; justify-content: center;">
                    <span><?php echo esc_html($register_text); ?></span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</header>
