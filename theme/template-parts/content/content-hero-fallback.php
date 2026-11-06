<?php
/**
 * SIBACOM Theme Fallback Hero Template Part
 *
 * @package SIBACOM
 */

if (!defined('ABSPATH')) {
    exit;
}

$hero_bg       = sibacom_get_campus_bg_url();
$hero_headline = sibacom_get_option('hero_tagline', sibacom_get_option('hero_headline', 'POWER TO PROGRESS'));
$hero_desc     = sibacom_get_option('hero_description', "SIBACOM is Pakistan's premier collegiate technology festival, bringing together talented university students, programmers, robotics enthusiasts, AI innovators, cybersecurity enthusiasts, and future technology leaders for an extraordinary celebration of innovation and technology.");
$event_dates   = sibacom_get_option('event_dates', 'November 30, 2026');
$event_venue   = sibacom_get_option('event_venue', 'Academic Block-III, Sukkur IBA University');
$cta_url       = function_exists('sibacom_get_register_url') ? sibacom_get_register_url() : sibacom_get_option('header_cta_url', 'https://portal.sibacom.tech/');
$cta_text      = function_exists('sibacom_get_register_text') ? sibacom_get_register_text() : sibacom_get_option('header_cta_text', 'Register Now');
$cta_target    = function_exists('sibacom_get_register_target') ? sibacom_get_register_target() : '_blank';
$cta_rel       = ($cta_target === '_blank') ? ' rel="noopener noreferrer"' : '';
$cta_enabled   = function_exists('sibacom_is_register_enabled') ? sibacom_is_register_enabled() : true;
$sec_cta_text  = sibacom_get_option('hero_secondary_cta_text', 'Explore Event Details');
$sec_cta_url   = sibacom_get_option('hero_secondary_cta_url', '#about');
$target_date   = sibacom_get_option('hero_countdown_date', '2026-11-30T09:00:00');
?>
<section class="sibacom-hero-wrap">
    <div class="sibacom-hero-bg">
        <img src="<?php echo esc_url($hero_bg); ?>" alt="<?php esc_attr_e('Sukkur IBA University Campus', 'sibacom'); ?>" width="1024" height="576" fetchpriority="high" decoding="async" />
        <div class="sibacom-hero-overlay-v"></div>
        <div class="sibacom-hero-overlay-h"></div>
    </div>

    <?php if (function_exists('sibacom_the_hero_circuits')) { sibacom_the_hero_circuits(); } ?>

    <div class="sibacom-container">
        <div class="sibacom-hero-content">
            
            <!-- 1. Institutional Announcement Badge -->
            <div class="sibacom-hero-badge" role="status">
                <span class="pulse-indicator" aria-hidden="true">
                    <span class="pulse-indicator-ring"></span>
                    <span class="pulse-indicator-core"></span>
                </span>
                <span class="sibacom-hero-badge-text">
                    <span>Sukkur IBA University Presents</span>
                    <span class="sibacom-hero-badge-sep" aria-hidden="true">•</span>
                    <span class="sibacom-hero-badge-highlight">National Tech Olympiad</span>
                </span>
            </div>

            <!-- 2. Dominant Brand Wordmark Identity: SIBACOM '26 & Official Emblem -->
            <?php 
            if (function_exists('sibacom_the_hero_brand_lockup')) {
                sibacom_the_hero_brand_lockup('SIBACOM', "'26");
            } else {
            ?>
            <div class="sibacom-brand-hero-emblem-wrap">
                <div class="sibacom-brand-glow" aria-hidden="true"></div>
                <div class="sibacom-brand-wordmark-lockup">
                    <h1 class="sibacom-hero-wordmark font-display" aria-label="SIBACOM 2026">
                        <span class="sibacom-wordmark-core">SIBACOM</span>
                        <span class="sibacom-brand-edition-lockup" aria-hidden="true">
                            <span class="sibacom-brand-edition-badge">
                                <span class="sibacom-brand-apostrophe">’</span><span class="sibacom-brand-year">26</span>
                                <span class="sibacom-brand-edition-dot" aria-hidden="true"></span>
                            </span>
                        </span>
                    </h1>
                </div>
            </div>
            <?php } ?>

            <!-- 3. Electrifying "POWER TO PROGRESS" Animated Tagline -->
            <?php 
            if (function_exists('sibacom_the_electrified_tagline')) {
                sibacom_the_electrified_tagline($hero_headline);
            } else {
            ?>
            <div class="sibacom-tagline-electrified-container" role="text" aria-label="<?php echo esc_attr($hero_headline); ?>">
                <div class="sibacom-electric-conduit conduit-left" aria-hidden="true"><span class="sibacom-conduit-line"></span><span class="sibacom-conduit-node"><span class="sibacom-conduit-node-spark"></span></span></div>
                <p class="sibacom-hero-tagline-electrified" aria-hidden="true">
                    <span class="sibacom-electric-word"><span><?php echo esc_html($hero_headline); ?></span></span>
                    <span class="sibacom-tagline-electric-beam" aria-hidden="true"></span>
                    <span class="sibacom-tagline-aura" aria-hidden="true"></span>
                </p>
                <div class="sibacom-electric-conduit conduit-right" aria-hidden="true"><span class="sibacom-conduit-node"><span class="sibacom-conduit-node-spark"></span></span><span class="sibacom-conduit-line"></span></div>
            </div>
            <?php } ?>

            <!-- 4. Description Body -->
            <p class="sibacom-hero-description">
                <?php echo esc_html($hero_desc); ?>
            </p>

            <!-- Metadata Pill Bar -->
            <div class="sibacom-meta-bar">
                <div class="sibacom-meta-item">
                    <i class="fa-regular fa-calendar-days"></i>
                    <span><?php echo esc_html($event_dates); ?></span>
                </div>
                <div class="sibacom-meta-divider"></div>
                <div class="sibacom-meta-item">
                    <i class="fa-solid fa-location-dot"></i>
                    <span><?php echo esc_html($event_venue); ?></span>
                </div>
                <div class="sibacom-meta-divider"></div>
                <div class="sibacom-meta-item">
                    <i class="fa-solid fa-users"></i>
                    <span><?php esc_html_e('1,500+ Innovators', 'sibacom'); ?></span>
                </div>
            </div>

            <!-- Countdown Timer -->
            <div class="sibacom-countdown" data-target-date="<?php echo esc_attr($target_date); ?>">
                <div class="sibacom-countdown-box">
                    <span class="sibacom-countdown-number days-val">00</span>
                    <span class="sibacom-countdown-label"><?php esc_html_e('Days', 'sibacom'); ?></span>
                </div>
                <div class="sibacom-countdown-box">
                    <span class="sibacom-countdown-number hours-val">00</span>
                    <span class="sibacom-countdown-label"><?php esc_html_e('Hours', 'sibacom'); ?></span>
                </div>
                <div class="sibacom-countdown-box">
                    <span class="sibacom-countdown-number minutes-val">00</span>
                    <span class="sibacom-countdown-label"><?php esc_html_e('Mins', 'sibacom'); ?></span>
                </div>
                <div class="sibacom-countdown-box">
                    <span class="sibacom-countdown-number seconds-val">00</span>
                    <span class="sibacom-countdown-label"><?php esc_html_e('Secs', 'sibacom'); ?></span>
                </div>
            </div>

            <!-- CTAs -->
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; margin-top: 2rem;">
                <?php if ($cta_enabled) : ?>
                <a href="<?php echo esc_url($cta_url); ?>" target="<?php echo esc_attr($cta_target); ?>"<?php echo $cta_rel; ?> class="sibacom-btn sibacom-btn-primary">
                    <span><?php echo esc_html($cta_text); ?></span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
                <?php endif; ?>
                <a href="<?php echo esc_url($sec_cta_url); ?>" class="sibacom-btn sibacom-btn-secondary">
                    <span><?php echo esc_html($sec_cta_text); ?></span>
                    <i class="fa-solid fa-circle-info"></i>
                </a>
            </div>

        </div>
    </div>
</section>

