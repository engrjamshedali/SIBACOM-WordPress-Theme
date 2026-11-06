<?php
/**
 * SIBACOM Shortcodes Implementation
 *
 * @package SIBACOM_Website_Manager
 */

if (!defined('ABSPATH')) {
    exit;
}

class SIBACOM_Shortcodes {

    public static function init() {
        add_shortcode('sibacom_hero', array(__CLASS__, 'render_hero'));
        add_shortcode('sibacom_countdown', array(__CLASS__, 'render_countdown'));
        add_shortcode('sibacom_info', array(__CLASS__, 'render_info'));
        add_shortcode('sibacom_events', array(__CLASS__, 'render_events'));
        add_shortcode('sibacom_highlights', array(__CLASS__, 'render_highlights'));
        add_shortcode('sibacom_about', array(__CLASS__, 'render_about'));
        add_shortcode('sibacom_schedule', array(__CLASS__, 'render_schedule'));
        add_shortcode('sibacom_speakers', array(__CLASS__, 'render_speakers'));
        add_shortcode('sibacom_guests', array(__CLASS__, 'render_guests'));
        add_shortcode('sibacom_organizers', array(__CLASS__, 'render_organizers'));
        add_shortcode('sibacom_joint_organizers', array(__CLASS__, 'render_joint_organizers'));
        add_shortcode('sibacom_academic_partners', array(__CLASS__, 'render_academic_partners'));
        add_shortcode('sibacom_sponsors', array(__CLASS__, 'render_sponsors'));
        add_shortcode('sibacom_faq', array(__CLASS__, 'render_faq'));
        add_shortcode('sibacom_contact', array(__CLASS__, 'render_contact'));
        add_shortcode('sibacom_cta_banner', array(__CLASS__, 'render_cta_banner'));
        add_shortcode('sibacom_portal', array(__CLASS__, 'render_portal'));
        add_shortcode('sibacom_participant_portal', array(__CLASS__, 'render_participant_portal'));
        add_shortcode('sibacom_staff_portal', array(__CLASS__, 'render_staff_portal'));
        add_shortcode('sibacom_payment_verification', array(__CLASS__, 'render_payment_verification'));
        add_shortcode('sibacom_registration_confirmation', array(__CLASS__, 'render_registration_confirmation'));
        add_shortcode('sibacom_portal_login', array(__CLASS__, 'render_portal_login'));
    }

    /**
     * Hero Shortcode
     */
    public static function render_hero($atts) {
        $atts = shortcode_atts(array(
            'title'       => get_option('sibacom_event_name', 'SIBACOM'),
            'headline'    => get_option('sibacom_hero_tagline', get_option('sibacom_hero_headline', 'POWER TO PROGRESS')),
            'subtitle'    => get_option('sibacom_hero_subtitle', 'Igniting Algorithmic Brilliance, Engineering Innovation & Technological Leadership.'),
            'description' => get_option('sibacom_hero_description', "SIBACOM is Pakistan's premier collegiate technology festival, bringing together talented university students, programmers, robotics enthusiasts, AI innovators, cybersecurity enthusiasts, and future technology leaders for an extraordinary celebration of innovation and technology."),
            'dates'       => get_option('sibacom_event_dates', 'November 30, 2026'),
            'venue'       => get_option('sibacom_event_venue', 'Academic Block-III, Sukkur IBA University'),
            'cta_text'    => function_exists('sibacom_get_register_text') ? sibacom_get_register_text() : get_option('sibacom_header_cta_text', 'Register Now'),
            'cta_url'     => function_exists('sibacom_get_register_url') ? sibacom_get_register_url() : get_option('sibacom_header_cta_url', 'https://portal.sibacom.tech/'),
            'cta_target'  => function_exists('sibacom_get_register_target') ? sibacom_get_register_target() : get_option('sibacom_header_cta_target', '_blank'),
            'cta_enabled' => function_exists('sibacom_is_register_enabled') ? (sibacom_is_register_enabled() ? '1' : '0') : get_option('sibacom_header_cta_enabled', '1'),
            'sec_text'    => get_option('sibacom_hero_secondary_cta_text', 'Explore Event Details'),
            'sec_url'     => get_option('sibacom_hero_secondary_cta_url', '#events'),
            'target_date' => get_option('sibacom_hero_countdown_date', '2026-11-30T09:00:00'),
            'bg_image'    => get_option('sibacom_hero_bg_image_url', ''),
        ), $atts);

        if (empty($atts['bg_image']) && function_exists('sibacom_get_campus_bg_url')) {
            $atts['bg_image'] = sibacom_get_campus_bg_url();
        }

        ob_start();
        ?>
        <section class="sibacom-hero-wrap">
            <div class="sibacom-hero-bg">
                <?php if (!empty($atts['bg_image'])) : ?>
                    <img src="<?php echo esc_url($atts['bg_image']); ?>" alt="<?php echo esc_attr($atts['title']); ?>" width="1024" height="576" fetchpriority="high" decoding="async" />
                <?php endif; ?>
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
                        sibacom_the_hero_brand_lockup($atts['title'], "'26");
                    } else {
                    ?>
                    <div class="sibacom-brand-hero-emblem-wrap">
                        <div class="sibacom-brand-glow" aria-hidden="true"></div>
                        <div class="sibacom-brand-wordmark-lockup">
                            <h1 class="sibacom-hero-wordmark font-display" aria-label="SIBACOM 2026">
                                <span class="sibacom-wordmark-core"><?php echo esc_html($atts['title']); ?></span>
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
                        sibacom_the_electrified_tagline($atts['headline']);
                    } else {
                    ?>
                    <div class="sibacom-tagline-electrified-container" role="text" aria-label="<?php echo esc_attr($atts['headline']); ?>">
                        <div class="sibacom-electric-conduit conduit-left" aria-hidden="true"><span class="sibacom-conduit-line"></span><span class="sibacom-conduit-node"><span class="sibacom-conduit-node-spark"></span></span></div>
                        <p class="sibacom-hero-tagline-electrified" aria-hidden="true">
                            <span class="sibacom-electric-word"><span><?php echo esc_html($atts['headline']); ?></span></span>
                            <span class="sibacom-tagline-electric-beam" aria-hidden="true"></span>
                            <span class="sibacom-tagline-aura" aria-hidden="true"></span>
                        </p>
                        <div class="sibacom-electric-conduit conduit-right" aria-hidden="true"><span class="sibacom-conduit-node"><span class="sibacom-conduit-node-spark"></span></span><span class="sibacom-conduit-line"></span></div>
                    </div>
                    <?php } ?>

                    <!-- 4. Description Body -->
                    <p class="sibacom-hero-description">
                        <?php echo esc_html($atts['description']); ?>
                    </p>

                    <div class="sibacom-meta-bar">
                        <div class="sibacom-meta-item">
                            <i class="fa-regular fa-calendar-days"></i>
                            <span><?php echo esc_html($atts['dates']); ?></span>
                        </div>
                        <div class="sibacom-meta-divider"></div>
                        <div class="sibacom-meta-item">
                            <i class="fa-solid fa-location-dot"></i>
                            <span><?php echo esc_html($atts['venue']); ?></span>
                        </div>
                        <div class="sibacom-meta-divider"></div>
                        <div class="sibacom-meta-item">
                            <i class="fa-solid fa-users"></i>
                            <span><?php esc_html_e('1,500+ Innovators', 'sibacom-manager'); ?></span>
                        </div>
                    </div>

                    <div class="sibacom-countdown" data-target-date="<?php echo esc_attr($atts['target_date']); ?>">
                        <div class="sibacom-countdown-box">
                            <span class="sibacom-countdown-number days-val">00</span>
                            <span class="sibacom-countdown-label"><?php esc_html_e('Days', 'sibacom-manager'); ?></span>
                        </div>
                        <div class="sibacom-countdown-box">
                            <span class="sibacom-countdown-number hours-val">00</span>
                            <span class="sibacom-countdown-label"><?php esc_html_e('Hours', 'sibacom-manager'); ?></span>
                        </div>
                        <div class="sibacom-countdown-box">
                            <span class="sibacom-countdown-number minutes-val">00</span>
                            <span class="sibacom-countdown-label"><?php esc_html_e('Mins', 'sibacom-manager'); ?></span>
                        </div>
                        <div class="sibacom-countdown-box">
                            <span class="sibacom-countdown-number seconds-val">00</span>
                            <span class="sibacom-countdown-label"><?php esc_html_e('Secs', 'sibacom-manager'); ?></span>
                        </div>
                    </div>

                    <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; margin-top: 2.25rem;">
                        <?php if ($atts['cta_enabled'] === '1' || $atts['cta_enabled'] === 1 || $atts['cta_enabled'] === 'yes') : 
                            $cta_rel = ($atts['cta_target'] === '_blank') ? ' target="_blank" rel="noopener noreferrer"' : '';
                        ?>
                        <a href="<?php echo esc_url($atts['cta_url']); ?>"<?php echo $cta_rel; ?> class="sibacom-btn sibacom-btn-primary">
                            <span><?php echo esc_html($atts['cta_text']); ?></span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                        <?php endif; ?>
                        <a href="<?php echo esc_url($atts['sec_url']); ?>" class="sibacom-btn sibacom-btn-secondary">
                            <span><?php echo esc_html($atts['sec_text']); ?></span>
                            <i class="fa-solid fa-circle-info"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <?php
        return ob_get_clean();
    }

    /**
     * Countdown Shortcode
     */
    public static function render_countdown($atts) {
        $atts = shortcode_atts(array(
            'target_date' => get_option('sibacom_hero_countdown_date', '2026-11-30T09:00:00'),
        ), $atts);

        ob_start();
        ?>
        <div class="sibacom-countdown" data-target-date="<?php echo esc_attr($atts['target_date']); ?>">
            <div class="sibacom-countdown-box">
                <span class="sibacom-countdown-number days-val">00</span>
                <span class="sibacom-countdown-label"><?php esc_html_e('Days', 'sibacom-manager'); ?></span>
            </div>
            <div class="sibacom-countdown-box">
                <span class="sibacom-countdown-number hours-val">00</span>
                <span class="sibacom-countdown-label"><?php esc_html_e('Hours', 'sibacom-manager'); ?></span>
            </div>
            <div class="sibacom-countdown-box">
                <span class="sibacom-countdown-number minutes-val">00</span>
                <span class="sibacom-countdown-label"><?php esc_html_e('Mins', 'sibacom-manager'); ?></span>
            </div>
            <div class="sibacom-countdown-box">
                <span class="sibacom-countdown-number seconds-val">00</span>
                <span class="sibacom-countdown-label"><?php esc_html_e('Secs', 'sibacom-manager'); ?></span>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Event Information Cards Shortcode (Section C)
     * Displays 6 Neumorphic Information Cards:
     * 1. Event Date
     * 2. Event Venue
     * 3. Registration Deadline
     * 4. Event Category
     * 5. Participation Information
     * 6. Registration Status
     */
    public static function render_info($atts) {
        $atts = (array)$atts;

        // Robust resolver: $atts -> primary option -> alternate options -> default fallback
        $resolve = function($att_keys, $opt_keys, $default) use ($atts) {
            foreach ((array)$att_keys as $k) {
                if (!empty($atts[$k])) {
                    return $atts[$k];
                }
            }
            foreach ((array)$opt_keys as $k) {
                $val = get_option($k, '');
                if (!empty($val)) {
                    return $val;
                }
            }
            return $default;
        };

        // Card 1
        $date_title = $resolve(array('card1_title', 'date_title'), array('sibacom_info_date_title', 'sibacom_info_card1_label', 'sibacom_info_card1_title'), 'Event Dates');
        $date_val   = $resolve(array('card1_val', 'date_val'), array('sibacom_info_date_val', 'sibacom_info_card1_val'), 'Nov 30 – Dec 02, 2026');
        $date_sub   = $resolve(array('card1_sub', 'date_sub'), array('sibacom_info_date_sub', 'sibacom_info_card1_sub'), '1-Day National Summit');
        $date_pill  = $resolve(array('card1_pill', 'date_pill'), array('sibacom_info_card1_pill'), 'Official Dates');
        $date_icon  = $resolve(array('card1_icon', 'date_icon'), array('sibacom_info_card1_icon'), 'fa-regular fa-calendar-days');
        $date_link  = $resolve(array('card1_link', 'date_link'), array('sibacom_info_card1_link'), '');

        // Card 2
        $venue_title = $resolve(array('card2_title', 'venue_title'), array('sibacom_info_venue_title', 'sibacom_info_card2_label', 'sibacom_info_card2_title'), 'Event Venue');
        $venue_val   = $resolve(array('card2_val', 'venue_val'), array('sibacom_info_venue_val', 'sibacom_info_card2_val'), 'Academic Block-III');
        $venue_sub   = $resolve(array('card2_sub', 'venue_sub'), array('sibacom_info_venue_sub', 'sibacom_info_card2_sub'), 'Sukkur IBA University');
        $venue_pill  = $resolve(array('card2_pill', 'venue_pill'), array('sibacom_info_card2_pill'), 'Main Campus');
        $venue_icon  = $resolve(array('card2_icon', 'venue_icon'), array('sibacom_info_card2_icon'), 'fa-solid fa-location-dot');
        $venue_link  = $resolve(array('card2_link', 'venue_link'), array('sibacom_info_card2_link'), '');

        // Card 3
        $dead_title = $resolve(array('card3_title', 'deadline_title'), array('sibacom_info_deadline_title', 'sibacom_info_card3_label', 'sibacom_info_card3_title'), 'Registration Deadline');
        $dead_val   = $resolve(array('card3_val', 'deadline_val'), array('sibacom_info_deadline_val', 'sibacom_info_card3_val'), 'Nov 25, 2026');
        $dead_sub   = $resolve(array('card3_sub', 'deadline_sub'), array('sibacom_info_deadline_sub', 'sibacom_info_card3_sub'), '11:59 PM PKT Strict Cutoff');
        $dead_pill  = $resolve(array('card3_pill', 'deadline_pill'), array('sibacom_info_card3_pill'), 'Strict Cutoff');
        $dead_icon  = $resolve(array('card3_icon', 'deadline_icon'), array('sibacom_info_card3_icon'), 'fa-solid fa-hourglass-half');
        $dead_link  = $resolve(array('card3_link', 'deadline_link'), array('sibacom_info_card3_link'), '');

        // Card 4
        $cat_title = $resolve(array('card4_title', 'category_title'), array('sibacom_info_category_title', 'sibacom_info_card4_label', 'sibacom_info_card4_title'), 'Event Category');
        $cat_val   = $resolve(array('card4_val', 'category_val'), array('sibacom_info_category_val', 'sibacom_info_card4_val'), 'Tech Olympiad');
        $cat_sub   = $resolve(array('card4_sub', 'category_sub'), array('sibacom_info_category_sub', 'sibacom_info_card4_sub'), '14+ Competitive Tracks');
        $cat_pill  = $resolve(array('card4_pill', 'category_pill'), array('sibacom_info_card4_pill'), '14+ Tracks');
        $cat_icon  = $resolve(array('card4_icon', 'category_icon'), array('sibacom_info_card4_icon'), 'fa-solid fa-microchip');
        $cat_link  = $resolve(array('card4_link', 'category_link'), array('sibacom_info_card4_link'), '');

        // Card 5
        $part_title = $resolve(array('card5_title', 'participation_title'), array('sibacom_info_participation_title', 'sibacom_info_card5_label', 'sibacom_info_card5_title'), 'Participation');
        $part_val   = $resolve(array('card5_val', 'participation_val'), array('sibacom_info_participation_val', 'sibacom_info_card5_val'), '1,500+ Innovators');
        $part_sub   = $resolve(array('card5_sub', 'participation_sub'), array('sibacom_info_participation_sub', 'sibacom_info_card5_sub'), '120+ Universities Nationwide');
        $part_pill  = $resolve(array('card5_pill', 'participation_pill'), array('sibacom_info_card5_pill'), 'Nationwide');
        $part_icon  = $resolve(array('card5_icon', 'participation_icon'), array('sibacom_info_card5_icon'), 'fa-solid fa-users');
        $part_link  = $resolve(array('card5_link', 'participation_link'), array('sibacom_info_card5_link'), '');

        // Card 6
        $status_title = $resolve(array('card6_title', 'status_title'), array('sibacom_info_status_title', 'sibacom_info_card6_label', 'sibacom_info_card6_title'), 'Registration Status');
        $status_val   = $resolve(array('card6_val', 'status_val'), array('sibacom_info_status_val', 'sibacom_info_card6_val'), 'Registration Open');
        $status_sub   = $resolve(array('card6_sub', 'status_sub'), array('sibacom_info_status_sub', 'sibacom_info_card6_sub'), 'Verified Delegate Portals');
        $status_pill  = $resolve(array('card6_pill', 'status_pill'), array('sibacom_info_card6_pill'), 'Live Now');
        $status_icon  = $resolve(array('card6_icon', 'status_icon'), array('sibacom_info_card6_icon'), 'fa-solid fa-circle-check');
        $status_link  = $resolve(array('card6_link', 'status_link'), array('sibacom_info_card6_link'), '');

        ob_start();
        ?>
        <div class="sibacom-event-info-cards-wrap">
            <div class="sibacom-info-cards-grid">
                <!-- Card 1: Event Date -->
                <?php $tag1 = !empty($date_link) ? 'a' : 'div'; $href1 = !empty($date_link) ? ' href="' . esc_url($date_link) . '"' : ''; ?>
                <<?php echo $tag1; ?><?php echo $href1; ?> class="neu-card sibacom-info-card card-variant-dates">
                    <div class="sibacom-info-card-header">
                        <div class="sibacom-info-icon-badge" style="color: #173F91; background: linear-gradient(135deg, rgba(23, 63, 145, 0.12) 0%, rgba(37, 99, 235, 0.06) 100%);">
                            <i class="<?php echo esc_attr($date_icon); ?>"></i>
                        </div>
                        <span class="sibacom-info-pill pill-blue">
                            <i class="fa-regular fa-calendar-check"></i> <?php echo esc_html($date_pill); ?>
                        </span>
                    </div>
                    <div class="sibacom-info-card-body">
                        <span class="sibacom-info-label"><?php echo esc_html($date_title); ?></span>
                        <h4 class="font-display sibacom-info-val"><?php echo esc_html($date_val); ?></h4>
                        <span class="sibacom-info-sub"><?php echo esc_html($date_sub); ?></span>
                    </div>
                    <div class="sibacom-info-watermark" aria-hidden="true">
                        <i class="<?php echo esc_attr($date_icon); ?>"></i>
                    </div>
                </<?php echo $tag1; ?>>

                <!-- Card 2: Event Venue -->
                <?php $tag2 = !empty($venue_link) ? 'a' : 'div'; $href2 = !empty($venue_link) ? ' href="' . esc_url($venue_link) . '"' : ''; ?>
                <<?php echo $tag2; ?><?php echo $href2; ?> class="neu-card sibacom-info-card card-variant-venue">
                    <div class="sibacom-info-card-header">
                        <div class="sibacom-info-icon-badge" style="color: #079B58; background: linear-gradient(135deg, rgba(7, 155, 88, 0.12) 0%, rgba(16, 185, 129, 0.06) 100%);">
                            <i class="<?php echo esc_attr($venue_icon); ?>"></i>
                        </div>
                        <span class="sibacom-info-pill pill-green">
                            <i class="fa-solid fa-building-columns"></i> <?php echo esc_html($venue_pill); ?>
                        </span>
                    </div>
                    <div class="sibacom-info-card-body">
                        <span class="sibacom-info-label"><?php echo esc_html($venue_title); ?></span>
                        <h4 class="font-display sibacom-info-val"><?php echo esc_html($venue_val); ?></h4>
                        <span class="sibacom-info-sub"><?php echo esc_html($venue_sub); ?></span>
                    </div>
                    <div class="sibacom-info-watermark" aria-hidden="true">
                        <i class="<?php echo esc_attr($venue_icon); ?>"></i>
                    </div>
                </<?php echo $tag2; ?>>

                <!-- Card 3: Registration Deadline -->
                <?php $tag3 = !empty($dead_link) ? 'a' : 'div'; $href3 = !empty($dead_link) ? ' href="' . esc_url($dead_link) . '"' : ''; ?>
                <<?php echo $tag3; ?><?php echo $href3; ?> class="neu-card sibacom-info-card card-variant-deadline">
                    <div class="sibacom-info-card-header">
                        <div class="sibacom-info-icon-badge" style="color: #D97706; background: linear-gradient(135deg, rgba(217, 119, 6, 0.12) 0%, rgba(245, 158, 11, 0.06) 100%);">
                            <i class="<?php echo esc_attr($dead_icon); ?>"></i>
                        </div>
                        <span class="sibacom-info-pill pill-amber">
                            <i class="fa-solid fa-hourglass-half"></i> <?php echo esc_html($dead_pill); ?>
                        </span>
                    </div>
                    <div class="sibacom-info-card-body">
                        <span class="sibacom-info-label"><?php echo esc_html($dead_title); ?></span>
                        <h4 class="font-display sibacom-info-val"><?php echo esc_html($dead_val); ?></h4>
                        <span class="sibacom-info-sub"><?php echo esc_html($dead_sub); ?></span>
                    </div>
                    <div class="sibacom-info-watermark" aria-hidden="true">
                        <i class="<?php echo esc_attr($dead_icon); ?>"></i>
                    </div>
                </<?php echo $tag3; ?>>

                <!-- Card 4: Event Category -->
                <?php $tag4 = !empty($cat_link) ? 'a' : 'div'; $href4 = !empty($cat_link) ? ' href="' . esc_url($cat_link) . '"' : ''; ?>
                <<?php echo $tag4; ?><?php echo $href4; ?> class="neu-card sibacom-info-card card-variant-category">
                    <div class="sibacom-info-card-header">
                        <div class="sibacom-info-icon-badge" style="color: #102E68; background: linear-gradient(135deg, rgba(16, 46, 104, 0.12) 0%, rgba(67, 56, 202, 0.06) 100%);">
                            <i class="<?php echo esc_attr($cat_icon); ?>"></i>
                        </div>
                        <span class="sibacom-info-pill pill-navy">
                            <i class="fa-solid fa-layer-group"></i> <?php echo esc_html($cat_pill); ?>
                        </span>
                    </div>
                    <div class="sibacom-info-card-body">
                        <span class="sibacom-info-label"><?php echo esc_html($cat_title); ?></span>
                        <h4 class="font-display sibacom-info-val"><?php echo esc_html($cat_val); ?></h4>
                        <span class="sibacom-info-sub"><?php echo esc_html($cat_sub); ?></span>
                    </div>
                    <div class="sibacom-info-watermark" aria-hidden="true">
                        <i class="<?php echo esc_attr($cat_icon); ?>"></i>
                    </div>
                </<?php echo $tag4; ?>>

                <!-- Card 5: Participation Information -->
                <?php $tag5 = !empty($part_link) ? 'a' : 'div'; $href5 = !empty($part_link) ? ' href="' . esc_url($part_link) . '"' : ''; ?>
                <<?php echo $tag5; ?><?php echo $href5; ?> class="neu-card sibacom-info-card card-variant-participation">
                    <div class="sibacom-info-card-header">
                        <div class="sibacom-info-icon-badge" style="color: #1D4ED8; background: linear-gradient(135deg, rgba(29, 78, 216, 0.12) 0%, rgba(2, 132, 199, 0.06) 100%);">
                            <i class="<?php echo esc_attr($part_icon); ?>"></i>
                        </div>
                        <span class="sibacom-info-pill pill-cyan">
                            <i class="fa-solid fa-globe"></i> <?php echo esc_html($part_pill); ?>
                        </span>
                    </div>
                    <div class="sibacom-info-card-body">
                        <span class="sibacom-info-label"><?php echo esc_html($part_title); ?></span>
                        <h4 class="font-display sibacom-info-val"><?php echo esc_html($part_val); ?></h4>
                        <span class="sibacom-info-sub"><?php echo esc_html($part_sub); ?></span>
                    </div>
                    <div class="sibacom-info-watermark" aria-hidden="true">
                        <i class="<?php echo esc_attr($part_icon); ?>"></i>
                    </div>
                </<?php echo $tag5; ?>>

                <!-- Card 6: Registration Status -->
                <?php $tag6 = !empty($status_link) ? 'a' : 'div'; $href6 = !empty($status_link) ? ' href="' . esc_url($status_link) . '"' : ''; ?>
                <<?php echo $tag6; ?><?php echo $href6; ?> class="neu-card sibacom-info-card card-variant-status">
                    <div class="sibacom-info-card-header">
                        <div class="sibacom-info-icon-badge" style="color: #079B58; background: linear-gradient(135deg, rgba(7, 155, 88, 0.14) 0%, rgba(5, 150, 105, 0.06) 100%);">
                            <span class="pulse-dot-live"></span>
                        </div>
                        <span class="sibacom-info-pill pill-live">
                            <span class="pulse-dot-live" style="width:6px; height:6px;"></span> <?php echo esc_html($status_pill); ?>
                        </span>
                    </div>
                    <div class="sibacom-info-card-body">
                        <span class="sibacom-info-label"><?php echo esc_html($status_title); ?></span>
                        <h4 class="font-display sibacom-info-val"><?php echo esc_html($status_val); ?></h4>
                        <span class="sibacom-info-sub"><?php echo esc_html($status_sub); ?></span>
                    </div>
                    <div class="sibacom-info-watermark" aria-hidden="true">
                        <i class="<?php echo esc_attr($status_icon); ?>"></i>
                    </div>
                </<?php echo $tag6; ?>>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Event Competitions, Pricing & Registration Section Shortcode (Section D)
     * Displays attractive event competition cards with:
     * - Event name
     * - Image / banner
     * - Short description
     * - Date & Venue
     * - Pricing tag (Free Registration, PKR 500, PKR 1,000, Team Registration, Special Category)
     * - Registration opening & closing dates
     * - Status badge (Registration Not Open Yet, Registration Open, Registration Closing Soon, Registration Closed, Fully Booked)
     * - Register Now button (frontend CTA linking externally)
     */
    public static function render_events($atts) {
        $atts = shortcode_atts(array(
            'limit'      => -1,
            'featured'   => '',
            'category'   => '',
            'columns'    => 3,
        ), $atts);

        $args = array(
            'post_type'      => 'sibacom_event',
            'posts_per_page' => intval($atts['limit']),
            'post_status'    => 'publish',
            'orderby'        => array('menu_order' => 'ASC', 'date' => 'ASC'),
        );

        $meta_query = array(
            'relation' => 'AND',
            array(
                'relation' => 'OR',
                array(
                    'key'     => '_sibacom_event_visibility',
                    'compare' => 'NOT EXISTS',
                ),
                array(
                    'key'     => '_sibacom_event_visibility',
                    'value'   => 'visible',
                    'compare' => '=',
                ),
            ),
        );
        if ($atts['featured'] === 'yes') {
            $meta_query[] = array(
                'key'   => '_sibacom_event_featured',
                'value' => 'yes',
            );
        }
        $args['meta_query'] = $meta_query;

        if (!empty($atts['category'])) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'sibacom_event_category',
                    'field'    => 'slug',
                    'terms'    => $atts['category'],
                )
            );
        }

        $query = new WP_Query($args);

        if ($query->have_posts() && !empty($query->posts)) {
            $sorted_posts = $query->posts;
            usort($sorted_posts, function($a, $b) {
                $order_a = get_post_meta($a->ID, '_sibacom_event_order', true);
                $order_b = get_post_meta($b->ID, '_sibacom_event_order', true);
                $val_a = ($order_a !== '' && $order_a !== false) ? intval($order_a) : $a->menu_order;
                $val_b = ($order_b !== '' && $order_b !== false) ? intval($order_b) : $b->menu_order;
                if ($val_a === $val_b) {
                    return $a->ID <=> $b->ID;
                }
                return $val_a <=> $val_b;
            });
            $query->posts = $sorted_posts;
        }

        ob_start();
        if ($query->have_posts()) :
            $col_class = 'col-' . intval($atts['columns']);
            ?>
            <div class="sibacom-events-grid <?php echo esc_attr($col_class); ?>">
                <?php
                while ($query->have_posts()) :
                    $query->the_post();
                    $event_id    = get_the_ID();
                    $date        = get_post_meta($event_id, '_sibacom_event_date', true);
                    $start_time  = get_post_meta($event_id, '_sibacom_event_start_time', true);
                    $end_time    = get_post_meta($event_id, '_sibacom_event_end_time', true);
                    $venue       = get_post_meta($event_id, '_sibacom_event_venue', true);
                    $fee_amount  = get_post_meta($event_id, '_sibacom_event_fee_amount', true) ?: 'Free Registration';
                    $fee_type    = get_post_meta($event_id, '_sibacom_event_fee_type', true) ?: 'free';
                    $reg_open    = get_post_meta($event_id, '_sibacom_event_reg_open', true);
                    $reg_close   = get_post_meta($event_id, '_sibacom_event_reg_close', true);
                    $banner_url  = get_post_meta($event_id, '_sibacom_event_banner_url', true);
                    $categories  = get_the_terms($event_id, 'sibacom_event_category');
                    $cat_name    = (!empty($categories) && !is_wp_error($categories)) ? $categories[0]->name : '';

                    if (empty($banner_url) && has_post_thumbnail()) {
                        $banner_url = get_the_post_thumbnail_url($event_id, 'large');
                    }
                    if (empty($banner_url)) {
                        $banner_url = 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=800&q=80';
                    }

                    $status_info = SIBACOM_Meta_Boxes::get_event_status_info($event_id);
                    ?>
                    <div class="sibacom-event-card neu-card sibacom-card-circuit">
                        <?php if (function_exists('sibacom_the_circuit_corner')) {
                            sibacom_the_circuit_corner('tl');
                            sibacom_the_circuit_corner('br');
                        } ?>
                        <!-- Banner Image Container -->
                        <div class="sibacom-event-banner sibacom-event-card-media">
                            <img src="<?php echo esc_url($banner_url); ?>" alt="<?php the_title_attribute(); ?>" width="600" height="338" loading="lazy" decoding="async" />
                            <div class="sibacom-event-badges-bar sibacom-event-badges">
                                <span class="sibacom-price-badge price-<?php echo esc_attr($fee_type); ?>">
                                    <i class="fa-solid fa-tag"></i>
                                    <?php echo esc_html($fee_amount); ?>
                                </span>
                                <span class="sibacom-status-badge <?php echo esc_attr($status_info['class']); ?>">
                                    <span class="status-indicator"></span>
                                    <?php echo esc_html($status_info['label']); ?>
                                </span>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="sibacom-event-card-body">
                            <?php if (!empty($cat_name)) : ?>
                                <div style="margin-bottom: 0.35rem;">
                                    <span style="display: inline-block; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--sibacom-primary, #173F91); background: rgba(23,63,145,0.08); padding: 0.2rem 0.6rem; border-radius: 4px;">
                                        <?php echo esc_html($cat_name); ?>
                                    </span>
                                </div>
                            <?php endif; ?>

                            <h3 class="sibacom-event-card-title font-display"><?php the_title(); ?></h3>
                            
                            <div class="sibacom-event-card-desc">
                                <?php the_excerpt(); ?>
                            </div>

                            <!-- Meta details (Date, Venue, Timeline) -->
                            <div class="sibacom-event-meta-list">
                                <?php if (!empty($date)) : ?>
                                    <div class="sibacom-event-meta-row">
                                        <i class="fa-regular fa-calendar" style="color: var(--sibacom-primary);"></i>
                                        <span><strong><?php esc_html_e('Date:', 'sibacom-manager'); ?></strong> <?php echo esc_html($date); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($start_time) || !empty($end_time)) : ?>
                                    <div class="sibacom-event-meta-row">
                                        <i class="fa-regular fa-clock" style="color: var(--sibacom-techgreen);"></i>
                                        <span><strong><?php esc_html_e('Time:', 'sibacom-manager'); ?></strong> <?php echo esc_html(trim($start_time . ' - ' . $end_time, ' -')); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($venue)) : ?>
                                    <div class="sibacom-event-meta-row">
                                        <i class="fa-solid fa-location-dot" style="color: var(--sibacom-techgreen);"></i>
                                        <span><strong><?php esc_html_e('Venue:', 'sibacom-manager'); ?></strong> <?php echo esc_html($venue); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($reg_close)) : ?>
                                    <div class="sibacom-event-meta-row">
                                        <i class="fa-regular fa-hourglass-half" style="color: #D97706;"></i>
                                        <span><strong><?php esc_html_e('Registration Closes:', 'sibacom-manager'); ?></strong> <?php echo esc_html($reg_close); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Card Footer Action CTA -->
                            <div class="sibacom-event-card-footer">
                                <?php if ($status_info['is_active']) : ?>
                                    <a href="<?php echo esc_url($status_info['url']); ?>" target="_blank" rel="noopener noreferrer" class="sibacom-btn sibacom-btn-primary sibacom-btn-full">
                                        <span><?php echo esc_html($status_info['btn_text']); ?></span>
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                <?php else : ?>
                                    <button class="sibacom-btn sibacom-btn-disabled sibacom-btn-full" disabled="disabled">
                                        <span><?php echo esc_html($status_info['btn_text']); ?></span>
                                        <i class="fa-solid fa-lock"></i>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <?php
        else :
            ?>
            <div class="neu-card text-center" style="max-width: 600px; margin: 0 auto; padding: 2.5rem;">
                <p style="font-size: 1.05rem; color: var(--sibacom-text-secondary); margin: 0;">
                    <?php esc_html_e('No event competitions or pricing plans published yet. Manage events in SIBACOM > Events & Pricing.', 'sibacom-manager'); ?>
                </p>
            </div>
            <?php
        endif;

        return ob_get_clean();
    }

    /**
     * Highlights Shortcode
     */
    public static function render_highlights($atts) {
        $cards = array(
            array(
                'icon'  => 'fa-code',
                'title' => 'Speed Programming',
                'desc'  => 'Timed algorithmic coding league featuring strict automated test suites in C++, Java, and Python under ACM-ICPC rules.',
                'badge' => 'Collegiate League'
            ),
            array(
                'icon'  => 'fa-laptop-code',
                'title' => 'Hackathon 24H',
                'desc'  => 'High-intensity continuous product ideation and build sprint across AI agents, smart cities, and fintech infrastructure.',
                'badge' => 'Product Sprint'
            ),
            array(
                'icon'  => 'fa-shield-halved',
                'title' => 'Capture The Flag (CTF)',
                'desc'  => 'Jeopardy-style offensive & defensive cyber defense challenge: binary exploitation, cryptography, and digital forensics.',
                'badge' => 'Cyber Security'
            ),
            array(
                'icon'  => 'fa-robot',
                'title' => 'RoboWars & Automation',
                'desc'  => 'Combat robot clashes, autonomous line-following micro-mazes, and embedded hardware sensor challenges.',
                'badge' => 'Hardware Arena'
            ),
            array(
                'icon'  => 'fa-brain',
                'title' => 'AI Agent Challenge',
                'desc'  => 'Frontier machine learning workflows, multi-agent orchestrations, and prompt-tuning benchmarks.',
                'badge' => 'Frontier AI'
            ),
            array(
                'icon'  => 'fa-rocket',
                'title' => 'Startup Showcase & Pitch',
                'desc'  => 'Venture showcase where student founders pitch innovative prototypes directly to accredited angel investors.',
                'badge' => 'Venture Capital'
            ),
        );

        ob_start();
        ?>
        <div class="sibacom-highlights-grid">
            <?php foreach ($cards as $c) : ?>
                <div class="sibacom-highlight-card neu-card">
                    <div class="sibacom-highlight-icon">
                        <i class="fa-solid <?php echo esc_attr($c['icon']); ?>"></i>
                    </div>
                    <span style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; color: var(--sibacom-techgreen); letter-spacing: 0.08em; margin-bottom: 0.5rem; display: block;">
                        <?php echo esc_html($c['badge']); ?>
                    </span>
                    <h3 class="font-display" style="font-size: 1.35rem; margin-bottom: 0.75rem; color: var(--sibacom-text-primary);">
                        <?php echo esc_html($c['title']); ?>
                    </h3>
                    <p style="font-size: 0.92rem; color: var(--sibacom-text-secondary); line-height: 1.65; margin: 0;">
                        <?php echo esc_html($c['desc']); ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * About Section Shortcode
     */
    public static function render_about($atts) {
        $title    = get_option('sibacom_about_title', 'Igniting Technology Leadership Across Pakistan');
        $desc     = get_option('sibacom_about_description', 'SIBACOM (Sukkur IBA Annual Mega Olympiad) is the flagship national collegiate technology, hackathon, and computing summit presented by Sukkur IBA University, the Department of Computer Systems Engineering (CSE), and SISC Student Council.');
        $vision   = get_option('sibacom_about_vision', 'To cultivate Pakistan’s foremost student technology ecosystem, empowering youth to translate theoretical computational science into sovereign engineering solutions.');
        $mission  = get_option('sibacom_about_mission', 'Providing a transparent, rigorous, and technologically advanced arena where students test hardware-software integration, competitive programming, and ethical AI systems.');
        $stat1_n  = get_option('sibacom_about_stat1_num', '120+');
        $stat1_l  = get_option('sibacom_about_stat1_label', 'Participating Universities');
        $stat2_n  = get_option('sibacom_about_stat2_num', '1,500+');
        $stat2_l  = get_option('sibacom_about_stat2_label', 'Student Innovators');
        $stat3_n  = get_option('sibacom_about_stat3_num', 'PKR 1.5M');
        $stat3_l  = get_option('sibacom_about_stat3_label', 'Prize Pool');
        $stat4_n  = get_option('sibacom_about_stat4_num', '14+');
        $stat4_l  = get_option('sibacom_about_stat4_label', 'Competitive Modules');

        ob_start();
        ?>
        <div class="sibacom-about-grid">
            <div class="sibacom-about-content">
                <div class="sibacom-badge" style="margin-bottom: 1rem; align-self: flex-start;">
                    <i class="fa-solid fa-compass" style="color: var(--sibacom-techgreen);"></i>
                    <span><?php esc_html_e('Institutional Excellence', 'sibacom-manager'); ?></span>
                </div>
                <h2 class="font-display" style="font-size: clamp(2rem, 3.2vw, 2.75rem); margin-bottom: 1.25rem; line-height: 1.25; color: var(--sibacom-primary);">
                    <?php echo esc_html($title); ?>
                </h2>
                <p style="font-size: 1.05rem; line-height: 1.75; margin-bottom: 2rem; color: var(--sibacom-text-secondary);">
                    <?php echo esc_html($desc); ?>
                </p>

                <div class="sibacom-vision-card neu-card sibacom-card-circuit">
                    <?php if (function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
                    <div style="display: flex; gap: 1.15rem; align-items: flex-start;">
                        <div class="sibacom-vm-icon-box">
                            <i class="fa-solid fa-eye"></i>
                        </div>
                        <div style="flex: 1;">
                            <h4 class="font-display" style="color: var(--sibacom-primary); font-size: 1.15rem; margin-bottom: 0.4rem;">
                                <?php esc_html_e('Our Vision', 'sibacom-manager'); ?>
                            </h4>
                            <p style="margin: 0; font-size: 0.95rem; line-height: 1.6; color: var(--sibacom-text-secondary);"><?php echo esc_html($vision); ?></p>
                        </div>
                    </div>
                </div>

                <div class="sibacom-mission-card neu-card sibacom-card-circuit">
                    <?php if (function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
                    <div style="display: flex; gap: 1.15rem; align-items: flex-start;">
                        <div class="sibacom-vm-icon-box">
                            <i class="fa-solid fa-bullseye"></i>
                        </div>
                        <div style="flex: 1;">
                            <h4 class="font-display" style="color: var(--sibacom-techgreen); font-size: 1.15rem; margin-bottom: 0.4rem;">
                                <?php esc_html_e('Our Mission', 'sibacom-manager'); ?>
                            </h4>
                            <p style="margin: 0; font-size: 0.95rem; line-height: 1.6; color: var(--sibacom-text-secondary);"><?php echo esc_html($mission); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats & Campus Highlight Card -->
            <div>
                <div class="sibacom-about-showcase-card sibacom-card-circuit">
                    <?php if (function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
                    <div class="sibacom-campus-img-frame">
                        <?php if (function_exists('sibacom_get_campus_bg_url')) : ?>
                            <img src="<?php echo esc_url(sibacom_get_campus_bg_url()); ?>" alt="<?php esc_attr_e('Sukkur IBA Campus', 'sibacom-manager'); ?>" width="1024" height="576" loading="lazy" decoding="async" />
                        <?php endif; ?>
                        <div class="sibacom-campus-img-overlay">
                            <span style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.08em; font-weight: 700; color: var(--sibacom-techgreen-light, #10B981); display: block; margin-bottom: 0.2rem;"><?php esc_html_e('Host Institution', 'sibacom-manager'); ?></span>
                            <strong style="font-size: 0.98rem; font-weight: 700; color: #FFFFFF; display: block; line-height: 1.25;"><?php esc_html_e('Sukkur IBA University Campus', 'sibacom-manager'); ?></strong>
                        </div>
                    </div>

                    <div class="sibacom-about-stats-grid">
                        <div class="neu-card-flat text-center" style="padding: 1.25rem 0.75rem;">
                            <span class="font-display" style="font-size: 2.1rem; font-weight: 800; color: var(--sibacom-primary); display: block; line-height: 1;"><?php echo esc_html($stat1_n); ?></span>
                            <span style="font-size: 0.75rem; font-weight: 600; color: var(--sibacom-text-secondary); text-transform: uppercase; margin-top: 0.4rem; display: block;"><?php echo esc_html($stat1_l); ?></span>
                        </div>
                        <div class="neu-card-flat text-center" style="padding: 1.25rem 0.75rem;">
                            <span class="font-display" style="font-size: 2.1rem; font-weight: 800; color: var(--sibacom-techgreen); display: block; line-height: 1;"><?php echo esc_html($stat2_n); ?></span>
                            <span style="font-size: 0.75rem; font-weight: 600; color: var(--sibacom-text-secondary); text-transform: uppercase; margin-top: 0.4rem; display: block;"><?php echo esc_html($stat2_l); ?></span>
                        </div>
                        <div class="neu-card-flat text-center" style="padding: 1.25rem 0.75rem;">
                            <span class="font-display" style="font-size: 1.95rem; font-weight: 800; color: var(--sibacom-primary); display: block; line-height: 1;"><?php echo esc_html($stat3_n); ?></span>
                            <span style="font-size: 0.75rem; font-weight: 600; color: var(--sibacom-text-secondary); text-transform: uppercase; margin-top: 0.4rem; display: block;"><?php echo esc_html($stat3_l); ?></span>
                        </div>
                        <div class="neu-card-flat text-center" style="padding: 1.25rem 0.75rem;">
                            <span class="font-display" style="font-size: 2.1rem; font-weight: 800; color: var(--sibacom-navy); display: block; line-height: 1;"><?php echo esc_html($stat4_n); ?></span>
                            <span style="font-size: 0.75rem; font-weight: 600; color: var(--sibacom-text-secondary); text-transform: uppercase; margin-top: 0.4rem; display: block;"><?php echo esc_html($stat4_l); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Schedule Timeline Shortcode (Premium Redesign)
     */
    public static function render_schedule($atts) {
        $atts = shortcode_atts(array(
            'day'       => '',
            'limit'     => -1,
            'category'  => '',
            'featured'  => '',
            'layout'    => 'left',
            'orderby'   => 'order',
            'order'     => 'ASC',
        ), $atts);

        $args = array(
            'post_type'      => 'sibacom_session',
            'posts_per_page' => intval($atts['limit']),
            'post_status'    => 'publish',
        );

        if ($atts['orderby'] === 'title') {
            $args['orderby'] = 'title';
            $args['order']   = in_array(strtoupper($atts['order']), array('ASC', 'DESC')) ? strtoupper($atts['order']) : 'ASC';
        } else {
            $args['orderby'] = array('menu_order' => 'ASC', 'date' => 'ASC');
        }

        $meta_query = array('relation' => 'AND');

        // Visibility filter: hide sessions set to 'hidden'
        $meta_query[] = array(
            'relation' => 'OR',
            array(
                'key'     => '_sibacom_session_visibility',
                'compare' => 'NOT EXISTS',
            ),
            array(
                'key'     => '_sibacom_session_visibility',
                'value'   => 'hidden',
                'compare' => '!=',
            ),
        );

        if (!empty($atts['day'])) {
            $meta_query[] = array(
                'key'   => '_sibacom_session_day',
                'value' => sanitize_text_field($atts['day']),
            );
        }

        if (!empty($atts['category'])) {
            $meta_query[] = array(
                'key'   => '_sibacom_session_category',
                'value' => sanitize_text_field($atts['category']),
            );
        }

        if ($atts['featured'] === 'yes') {
            $meta_query[] = array(
                'key'   => '_sibacom_session_featured',
                'value' => 'yes',
            );
        }

        if (!empty($meta_query)) {
            $args['meta_query'] = $meta_query;
        }

        $query = new WP_Query($args);

        if ($query->have_posts() && !empty($query->posts)) {
            $sorted_posts = $query->posts;
            usort($sorted_posts, function($a, $b) use ($atts) {
                $id_a = is_object($a) ? $a->ID : (isset($a['ID']) ? $a['ID'] : 0);
                $id_b = is_object($b) ? $b->ID : (isset($b['ID']) ? $b['ID'] : 0);
                $mo_a = is_object($a) ? $a->menu_order : (isset($a['menu_order']) ? $a['menu_order'] : 0);
                $mo_b = is_object($b) ? $b->menu_order : (isset($b['menu_order']) ? $b['menu_order'] : 0);

                if ($atts['orderby'] === 'start') {
                    $start_a = get_post_meta($id_a, '_sibacom_session_start', true);
                    $start_b = get_post_meta($id_b, '_sibacom_session_start', true);
                    return strcmp($start_a, $start_b);
                }
                $order_a = get_post_meta($id_a, '_sibacom_session_order', true);
                $order_b = get_post_meta($id_b, '_sibacom_session_order', true);
                $val_a = ($order_a !== '' && $order_a !== false) ? intval($order_a) : $mo_a;
                $val_b = ($order_b !== '' && $order_b !== false) ? intval($order_b) : $mo_b;
                if ($val_a === $val_b) {
                    return $id_a <=> $id_b;
                }
                return $val_a <=> $val_b;
            });
            $query->posts = $sorted_posts;
        }

        // Category definitions and icons
        $cat_configs = array(
            'keynote'     => array('label' => esc_html__('Keynote Address', 'sibacom-manager'), 'icon' => 'fa-solid fa-microphone', 'cls' => 'cat-keynote'),
            'competition' => array('label' => esc_html__('Competition Sprint', 'sibacom-manager'), 'icon' => 'fa-solid fa-code', 'cls' => 'cat-competition'),
            'workshop'    => array('label' => esc_html__('Technical Workshop', 'sibacom-manager'), 'icon' => 'fa-solid fa-laptop-code', 'cls' => 'cat-workshop'),
            'panel'       => array('label' => esc_html__('Panel Discussion', 'sibacom-manager'), 'icon' => 'fa-solid fa-comments', 'cls' => 'cat-panel'),
            'ceremony'    => array('label' => esc_html__('Ceremony & Gala', 'sibacom-manager'), 'icon' => 'fa-solid fa-award', 'cls' => 'cat-ceremony'),
            'networking'  => array('label' => esc_html__('Networking & Meetup', 'sibacom-manager'), 'icon' => 'fa-solid fa-users', 'cls' => 'cat-networking'),
            'break'       => array('label' => esc_html__('Luncheon & Intermission', 'sibacom-manager'), 'icon' => 'fa-solid fa-mug-saucer', 'cls' => 'cat-break'),
        );

        $layout_class = ($atts['layout'] === 'alternating') ? 'layout-alternating' : 'layout-left';

        ob_start();
        if ($query->have_posts()) :
            $index = 0;
            ?>
            <div class="sibacom-timeline <?php echo esc_attr($layout_class); ?>" data-layout="<?php echo esc_attr($atts['layout']); ?>">
                <div class="sibacom-timeline-spine" aria-hidden="true"></div>
                <?php if (function_exists('sibacom_the_timeline_signal_track')) { sibacom_the_timeline_signal_track(); } ?>
                <?php
                while ($query->have_posts()) :
                    $query->the_post();
                    $index++;
                    $item_id   = get_the_ID();
                    $day       = get_post_meta($item_id, '_sibacom_session_day', true) ?: '1';
                    $start     = get_post_meta($item_id, '_sibacom_session_start', true) ?: '10:00 AM';
                    $end       = get_post_meta($item_id, '_sibacom_session_end', true) ?: '';
                    $duration  = get_post_meta($item_id, '_sibacom_session_duration', true);
                    $speaker   = get_post_meta($item_id, '_sibacom_session_speaker', true);
                    $spk_photo = get_post_meta($item_id, '_sibacom_session_speaker_photo', true);
                    $venue     = get_post_meta($item_id, '_sibacom_session_venue', true);
                    $category  = get_post_meta($item_id, '_sibacom_session_category', true) ?: 'keynote';
                    $icon_meta = get_post_meta($item_id, '_sibacom_session_icon', true);
                    $featured  = get_post_meta($item_id, '_sibacom_session_featured', true) === 'yes';

                    // Determine Category metadata
                    $cat_info = isset($cat_configs[$category]) ? $cat_configs[$category] : array('label' => ucfirst($category), 'icon' => 'fa-regular fa-clock', 'cls' => 'cat-default');
                    $node_icon = !empty($icon_meta) ? $icon_meta : $cat_info['icon'];

                    // Determine time slot (morning / afternoon / evening)
                    $slot = 'morning';
                    if (stripos($start, 'PM') !== false) {
                        preg_match('/(\d+):/i', $start, $t_m);
                        $hour = !empty($t_m[1]) ? intval($t_m[1]) : 12;
                        if ($hour === 12 || ($hour >= 1 && $hour < 5)) {
                            $slot = 'afternoon';
                        } else {
                            $slot = 'evening';
                        }
                    }

                    // Alternate side for alternating timeline
                    $side_class = ($index % 2 === 0) ? 'item-right' : 'item-left';
                    $featured_class = $featured ? 'is-featured' : '';
                    ?>
                    <div class="sibacom-timeline-item <?php echo esc_attr($side_class . ' ' . $featured_class); ?>" data-day="<?php echo esc_attr($day); ?>" data-slot="<?php echo esc_attr($slot); ?>" data-category="<?php echo esc_attr($category); ?>">
                        <!-- Timeline Node & Connecting Stem -->
                        <div class="sibacom-timeline-node <?php echo esc_attr($cat_info['cls']); ?>">
                            <div class="sibacom-node-inner" title="<?php echo esc_attr($cat_info['label']); ?>">
                                <i class="<?php echo esc_attr($node_icon); ?>"></i>
                            </div>
                            <?php if ($featured) : ?>
                                <span class="sibacom-node-pulse"></span>
                            <?php endif; ?>
                        </div>
                        <div class="sibacom-timeline-stem" aria-hidden="true"></div>

                        <!-- Session Card -->
                        <div class="sibacom-timeline-card neu-card sibacom-card-circuit <?php echo $featured ? 'sibacom-card-featured' : ''; ?>">
                            <?php if (function_exists('sibacom_the_circuit_corner')) {
                                sibacom_the_circuit_corner('tr');
                            } ?>
                            <!-- Top Meta & Category Bar -->
                            <div class="sibacom-timeline-meta-bar">
                                <div class="sibacom-timeline-time-badge">
                                    <i class="fa-regular fa-clock"></i>
                                    <span><?php if (!empty($day) && intval($day) > 1) { printf(esc_html__('Day %s &bull; ', 'sibacom-manager'), esc_html($day)); } ?><?php echo esc_html($start); ?><?php echo !empty($end) ? ' – ' . esc_html($end) : ''; ?></span>
                                </div>

                                <div class="sibacom-timeline-badges-wrap">
                                    <?php if (!empty($duration)) : ?>
                                        <span class="sibacom-timeline-duration-badge">
                                            <i class="fa-regular fa-hourglass-half"></i>
                                            <span><?php echo esc_html($duration); ?></span>
                                        </span>
                                    <?php endif; ?>

                                    <span class="sibacom-timeline-cat-badge <?php echo esc_attr($cat_info['cls']); ?>">
                                        <i class="<?php echo esc_attr($node_icon); ?>" style="margin-right: 0.35rem;"></i>
                                        <span><?php echo esc_html($cat_info['label']); ?></span>
                                    </span>

                                    <?php if ($featured) : ?>
                                        <span class="sibacom-timeline-featured-badge">
                                            <i class="fa-solid fa-star"></i>
                                            <span><?php esc_html_e('Featured Session', 'sibacom-manager'); ?></span>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Session Title -->
                            <h3 class="font-display sibacom-timeline-title">
                                <?php the_title(); ?>
                            </h3>

                            <!-- Session Description -->
                            <div class="sibacom-timeline-desc">
                                <?php the_content(); ?>
                            </div>

                            <!-- Bottom Meta Bar: Speaker & Location -->
                            <?php if (!empty($speaker) || !empty($venue)) : ?>
                                <div class="sibacom-timeline-footer-meta">
                                    <?php if (!empty($speaker)) : ?>
                                        <div class="sibacom-session-speaker-info">
                                            <?php if (!empty($spk_photo)) : ?>
                                                <img src="<?php echo esc_url($spk_photo); ?>" alt="<?php echo esc_attr($speaker); ?>" class="sibacom-session-speaker-photo" width="44" height="44" loading="lazy" decoding="async" />
                                            <?php else : ?>
                                                <div class="sibacom-session-speaker-photo-fallback">
                                                    <i class="fa-solid fa-user-tie"></i>
                                                </div>
                                            <?php endif; ?>
                                            <div class="sibacom-session-speaker-details">
                                                <span class="speaker-role-label"><?php esc_html_e('Lead Presenter / Speaker', 'sibacom-manager'); ?></span>
                                                <strong class="speaker-full-name"><?php echo esc_html($speaker); ?></strong>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($venue)) : ?>
                                        <div class="sibacom-session-venue-info" title="<?php esc_attr_e('Session Room / Venue', 'sibacom-manager'); ?>">
                                            <i class="fa-solid fa-location-dot"></i>
                                            <span><?php echo esc_html($venue); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <?php
        else :
            ?>
            <div class="neu-card sibacom-timeline-empty text-center" style="max-width: 620px; margin: 2rem auto; padding: 3rem 2rem;">
                <div class="sibacom-empty-icon" style="font-size: 2.75rem; color: var(--sibacom-techgreen); margin-bottom: 1rem;">
                    <i class="fa-regular fa-calendar-xmark"></i>
                </div>
                <h4 class="font-display" style="font-size: 1.35rem; color: var(--sibacom-primary); margin-bottom: 0.5rem;">
                    <?php esc_html_e('No Sessions Scheduled', 'sibacom-manager'); ?>
                </h4>
                <p style="font-size: 0.95rem; color: var(--sibacom-text-secondary); margin: 0; line-height: 1.6;">
                    <?php esc_html_e('There are no sessions currently scheduled for the selected filter. Please choose another event day or check back as the schedule is updated.', 'sibacom-manager'); ?>
                </p>
            </div>
            <?php
        endif;

        return ob_get_clean();
    }

    /**
     * Default Seed Profiles: 4 Competition Judges & Keynote Speakers
     *
     * @return array
     */
    public static function get_default_speakers_and_judges() {
        return array(
            array(
                'name'         => 'Dr. Bushra Naeem',
                'role_type'    => 'judge',
                'category'     => 'Competition Judges',
                'designation'  => 'Associate Professor & Lead AI / Robotics Jury',
                'org'          => 'Sukkur IBA University',
                'topic'        => 'Algorithmic Resilience & Autonomous Robotics Adjudication',
                'bio'          => 'Senior research evaluator with deep expertise in embedded computer vision, smart robotics, and high-stakes coding evaluations.',
                'photo_url'    => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80',
                'linkedin'     => 'https://linkedin.com',
                'twitter'      => 'https://x.com',
                'github'       => 'https://github.com',
            ),
            array(
                'name'         => 'Tariq Mehmood',
                'role_type'    => 'judge',
                'category'     => 'Industry Jury',
                'designation'  => 'Chief Technology Officer & Enterprise Hackathon Judge',
                'org'          => 'Techlogix Pakistan',
                'topic'        => 'Commercial Scalability & Full-Stack System Architectures',
                'bio'          => 'Enterprise technology executive and software judge evaluating speed-programming, database optimization, and venture-ready technical solutions.',
                'photo_url'    => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=400&q=80',
                'linkedin'     => 'https://linkedin.com',
                'twitter'      => 'https://x.com',
                'github'       => 'https://github.com',
            ),
            array(
                'name'         => 'Dr. Asim Khwaja',
                'role_type'    => 'judge',
                'category'     => 'Competition Judges',
                'designation'  => 'Director of Applied AI & Hackathon Jury Chair',
                'org'          => 'Center for Frontier Computing & AI',
                'topic'        => 'Frontier AI Models & Machine Intelligence Benchmarking',
                'bio'          => 'Pioneering researcher in machine intelligence, high-throughput computational architectures, and algorithmic competition benchmarking.',
                'photo_url'    => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80',
                'linkedin'     => 'https://linkedin.com',
                'twitter'      => 'https://x.com',
                'github'       => 'https://github.com',
            ),
            array(
                'name'         => 'Engr. Faraz Ahmed',
                'role_type'    => 'judge',
                'category'     => 'Industry Jury',
                'designation'  => 'Principal Cloud Architect & Speed-Programming Judge',
                'org'          => 'Systems Limited',
                'topic'        => 'Cloud-Native Microservices & High-Scale Systems',
                'bio'          => 'Industry veteran evaluating enterprise software architecture, low-latency microservices, and speed-programming competitions.',
                'photo_url'    => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=400&q=80',
                'linkedin'     => 'https://linkedin.com',
                'twitter'      => 'https://x.com',
                'github'       => 'https://github.com',
            ),
            array(
                'name'         => 'Prof. Dr. Asif Ahmed Shaikh',
                'role_type'    => 'speaker',
                'category'     => 'Keynote Speakers',
                'designation'  => 'Vice Chancellor & Institutional Patron',
                'org'          => 'Sukkur IBA University',
                'topic'        => 'Innovation in Pakistani Higher Education & Frontier Research',
                'bio'          => 'Distinguished academician and institutional visionary steering Sukkur IBA to national excellence in computing, engineering, and business.',
                'photo_url'    => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80',
                'linkedin'     => 'https://linkedin.com',
                'twitter'      => 'https://x.com',
                'github'       => 'https://github.com',
            ),
        );
    }

    /**
     * Speakers & Judges Shortcode
     */
    public static function render_speakers($atts) {
        $atts = shortcode_atts(array(
            'limit'     => 4,
            'category'  => '',
            'featured'  => '',
            'role_type' => '', // '', 'all', 'speaker', or 'judge'
            'columns'   => 4,
            'fallback'  => 'yes',
        ), $atts);

        $limit_val = intval($atts['limit']);
        $cols_val  = intval($atts['columns']) > 0 ? intval($atts['columns']) : 4;
        $col_class = 'col-' . $cols_val;

        $args = array(
            'post_type'      => 'sibacom_speaker',
            'posts_per_page' => $limit_val > 0 ? $limit_val : -1,
            'post_status'    => 'publish',
            'orderby'        => array('menu_order' => 'ASC', 'date' => 'ASC'),
        );

        $meta_query = array();

        // Role type filtering: speaker, judge, or both
        if (!empty($atts['role_type']) && $atts['role_type'] !== 'all') {
            $meta_query[] = array(
                'key'   => '_sibacom_speaker_role_type',
                'value' => sanitize_text_field($atts['role_type']),
            );
        } else {
            // Default: include speakers and judges (exclude guest role which belongs in Guests section)
            $meta_query[] = array(
                'relation' => 'OR',
                array(
                    'key'     => '_sibacom_speaker_role_type',
                    'value'   => array('speaker', 'judge', 'trainer'),
                    'compare' => 'IN',
                ),
                array(
                    'key'     => '_sibacom_speaker_role_type',
                    'compare' => 'NOT EXISTS',
                ),
            );
        }

        if ($atts['featured'] === 'yes') {
            $meta_query[] = array(
                'key'   => '_sibacom_speaker_featured',
                'value' => 'yes',
            );
        }

        if (!empty($meta_query)) {
            $args['meta_query'] = $meta_query;
        }

        if (!empty($atts['category'])) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'sibacom_speaker_category',
                    'field'    => 'slug',
                    'terms'    => sanitize_text_field($atts['category']),
                )
            );
        }

        $query = new WP_Query($args);

        if ($query->have_posts() && !empty($query->posts)) {
            $sorted_posts = $query->posts;
            usort($sorted_posts, function($a, $b) {
                $id_a = is_object($a) ? $a->ID : (isset($a['ID']) ? $a['ID'] : 0);
                $id_b = is_object($b) ? $b->ID : (isset($b['ID']) ? $b['ID'] : 0);
                $mo_a = is_object($a) ? $a->menu_order : (isset($a['menu_order']) ? $a['menu_order'] : 0);
                $mo_b = is_object($b) ? $b->menu_order : (isset($b['menu_order']) ? $b['menu_order'] : 0);

                $order_a = get_post_meta($id_a, '_sibacom_speaker_order', true);
                $order_b = get_post_meta($id_b, '_sibacom_speaker_order', true);
                $val_a = ($order_a !== '' && $order_a !== false) ? intval($order_a) : $mo_a;
                $val_b = ($order_b !== '' && $order_b !== false) ? intval($order_b) : $mo_b;
                if ($val_a === $val_b) {
                    return $id_a <=> $id_b;
                }
                return $val_a <=> $val_b;
            });
            $query->posts = $sorted_posts;
        }

        ob_start();
        if ($query->have_posts()) :
            ?>
            <div class="sibacom-speakers-grid <?php echo esc_attr($col_class); ?>">
                <?php
                while ($query->have_posts()) :
                    $query->the_post();
                    $speaker_id   = get_the_ID();
                    $role_type    = get_post_meta($speaker_id, '_sibacom_speaker_role_type', true) ?: 'speaker';
                    $designation  = get_post_meta($speaker_id, '_sibacom_speaker_designation', true);
                    $org          = get_post_meta($speaker_id, '_sibacom_speaker_org', true);
                    $category     = get_post_meta($speaker_id, '_sibacom_speaker_category', true);
                    $topic        = get_post_meta($speaker_id, '_sibacom_speaker_topic', true);
                    $bio          = get_post_meta($speaker_id, '_sibacom_speaker_bio', true);
                    $linkedin     = get_post_meta($speaker_id, '_sibacom_speaker_linkedin', true);
                    $twitter      = get_post_meta($speaker_id, '_sibacom_speaker_twitter', true);
                    $github       = get_post_meta($speaker_id, '_sibacom_speaker_github', true);
                    $photo_url    = get_post_meta($speaker_id, '_sibacom_speaker_photo_url', true);

                    if (empty($photo_url) && has_post_thumbnail()) {
                        $photo_url = get_the_post_thumbnail_url($speaker_id, 'large');
                    }
                    if (empty($photo_url)) {
                        $photo_url = 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80';
                    }

                    $is_judge    = ($role_type === 'judge' || stripos($category, 'judge') !== false || stripos($category, 'jury') !== false);
                    $badge_icon  = $is_judge ? 'fa-solid fa-gavel' : 'fa-solid fa-microphone-lines';
                    $topic_label = $is_judge ? esc_html__('Jury Track / Domain', 'sibacom-manager') : esc_html__('Keynote Topic', 'sibacom-manager');
                    $cat_slug    = !empty($category) ? strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $category)) : ($is_judge ? 'judge' : 'speaker');
                    ?>
                    <div class="sibacom-speaker-card neu-card sibacom-card-circuit <?php echo $is_judge ? 'is-judge-card' : 'is-speaker-card'; ?>" data-category="<?php echo esc_attr($cat_slug); ?>">
                        <?php if (function_exists('sibacom_the_circuit_corner')) {
                            sibacom_the_circuit_corner('tl');
                            sibacom_the_circuit_corner('br');
                        } ?>
                        <div class="sibacom-speaker-img-wrap">
                            <img src="<?php echo esc_url($photo_url); ?>" alt="<?php the_title_attribute(); ?>" width="96" height="96" loading="lazy" decoding="async">
                        </div>

                        <?php if (!empty($category)) : ?>
                            <span class="sibacom-speaker-badge <?php echo $is_judge ? 'judge-badge' : ''; ?>">
                                <i class="<?php echo esc_attr($badge_icon); ?>" style="margin-right: 4px;"></i>
                                <?php echo esc_html($category); ?>
                            </span>
                        <?php endif; ?>

                        <h3 class="sibacom-speaker-name font-display"><?php the_title(); ?></h3>
                        <?php if (!empty($designation)) : ?>
                            <p class="sibacom-speaker-designation"><?php echo esc_html($designation); ?></p>
                        <?php endif; ?>
                        <?php if (!empty($org)) : ?>
                            <p class="sibacom-speaker-org"><?php echo esc_html($org); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($topic)) : ?>
                            <div class="sibacom-speaker-topic">
                                <span class="topic-label"><?php echo esc_html($topic_label); ?></span>
                                <?php echo esc_html($topic); ?>
                            </div>
                        <?php endif; ?>

                        <div class="sibacom-speaker-bio">
                            <?php 
                            if (!empty($bio)) {
                                echo esc_html($bio);
                            } else {
                                the_excerpt();
                            }
                            ?>
                        </div>

                        <div class="sibacom-speaker-social">
                            <?php if (!empty($linkedin)) : ?>
                                <a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                            <?php endif; ?>
                            <?php if (!empty($twitter)) : ?>
                                <a href="<?php echo esc_url($twitter); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
                            <?php endif; ?>
                            <?php if (!empty($github)) : ?>
                                <a href="<?php echo esc_url($github); ?>" target="_blank" rel="noopener noreferrer" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <?php
        elseif ($atts['fallback'] === 'yes') :
            // Default Fallback: 4 Profile Cards (2 Speakers, 2 Judges)
            $default_profiles = self::get_default_speakers_and_judges();
            
            // Filter fallback by role if requested
            if (!empty($atts['role_type']) && $atts['role_type'] !== 'all') {
                $default_profiles = array_filter($default_profiles, function($p) use ($atts) {
                    return $p['role_type'] === $atts['role_type'];
                });
            }
            if ($limit_val > 0 && count($default_profiles) > $limit_val) {
                $default_profiles = array_slice($default_profiles, 0, $limit_val);
            }
            ?>
            <div class="sibacom-speakers-grid <?php echo esc_attr($col_class); ?>">
                <?php foreach ($default_profiles as $p) : 
                    $is_judge    = ($p['role_type'] === 'judge');
                    $badge_icon  = $is_judge ? 'fa-solid fa-gavel' : 'fa-solid fa-microphone-lines';
                    $topic_label = $is_judge ? esc_html__('Jury Track / Domain', 'sibacom-manager') : esc_html__('Keynote Topic', 'sibacom-manager');
                    $cat_slug    = !empty($p['category']) ? strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $p['category'])) : ($is_judge ? 'judge' : 'speaker');
                    ?>
                    <div class="sibacom-speaker-card neu-card sibacom-card-circuit <?php echo $is_judge ? 'is-judge-card' : 'is-speaker-card'; ?>" data-category="<?php echo esc_attr($cat_slug); ?>">
                        <?php if (function_exists('sibacom_the_circuit_corner')) {
                            sibacom_the_circuit_corner('tl');
                            sibacom_the_circuit_corner('br');
                        } ?>
                        <div class="sibacom-speaker-img-wrap">
                            <img src="<?php echo esc_url($p['photo_url']); ?>" alt="<?php echo esc_attr($p['name']); ?>" width="96" height="96" loading="lazy" decoding="async">
                        </div>

                        <?php if (!empty($p['category'])) : ?>
                            <span class="sibacom-speaker-badge <?php echo $is_judge ? 'judge-badge' : ''; ?>">
                                <i class="<?php echo esc_attr($badge_icon); ?>" style="margin-right: 4px;"></i>
                                <?php echo esc_html($p['category']); ?>
                            </span>
                        <?php endif; ?>

                        <h3 class="sibacom-speaker-name font-display"><?php echo esc_html($p['name']); ?></h3>
                        <?php if (!empty($p['designation'])) : ?>
                            <p class="sibacom-speaker-designation"><?php echo esc_html($p['designation']); ?></p>
                        <?php endif; ?>
                        <?php if (!empty($p['org'])) : ?>
                            <p class="sibacom-speaker-org"><?php echo esc_html($p['org']); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($p['topic'])) : ?>
                            <div class="sibacom-speaker-topic">
                                <span class="topic-label"><?php echo esc_html($topic_label); ?></span>
                                <?php echo esc_html($p['topic']); ?>
                            </div>
                        <?php endif; ?>

                        <div class="sibacom-speaker-bio">
                            <?php echo esc_html($p['bio']); ?>
                        </div>

                        <div class="sibacom-speaker-social">
                            <?php if (!empty($p['linkedin'])) : ?>
                                <a href="<?php echo esc_url($p['linkedin']); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                            <?php endif; ?>
                            <?php if (!empty($p['twitter'])) : ?>
                                <a href="<?php echo esc_url($p['twitter']); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
                            <?php endif; ?>
                            <?php if (!empty($p['github'])) : ?>
                                <a href="<?php echo esc_url($p['github']); ?>" target="_blank" rel="noopener noreferrer" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if (function_exists('current_user_can') && current_user_can('manage_options')) : ?>
                <div class="sibacom-admin-quick-edit-bar" style="margin-top: 1.75rem; text-align: center;">
                    <span style="font-size: 0.85rem; color: #475569; background: #F8FAFC; border: 1px dashed #CBD5E1; border-radius: 9999px; padding: 7px 18px; display: inline-flex; align-items: center; gap: 10px; flex-wrap: wrap; justify-content: center;">
                        <i class="fa-solid fa-sliders" style="color: #173F91;"></i>
                        <span><strong><?php esc_html_e('SIBACOM Profiles active:', 'sibacom-manager'); ?></strong> <?php esc_html_e('4 Competition Judges.', 'sibacom-manager'); ?></span>
                        <a href="<?php echo esc_url(admin_url('edit.php?post_type=sibacom_speaker')); ?>" style="color: #173F91; font-weight: 700; text-decoration: underline;" target="_blank"><?php esc_html_e('Manage in Admin', 'sibacom-manager'); ?></a>
                        <span style="color: #CBD5E1;">•</span>
                        <a href="<?php echo esc_url(admin_url('post-new.php?post_type=sibacom_speaker')); ?>" style="color: #079B58; font-weight: 700; text-decoration: underline;" target="_blank"><?php esc_html_e('+ Add New Speaker/Judge', 'sibacom-manager'); ?></a>
                    </span>
                </div>
            <?php endif; ?>
            <?php
        else :
            ?>
            <div class="neu-card text-center" style="max-width: 600px; margin: 0 auto; padding: 2rem;">
                <p style="margin:0;"><?php esc_html_e('Speakers and judges will be announced soon. Add them in SIBACOM > Speakers & Judges.', 'sibacom-manager'); ?></p>
            </div>
            <?php
        endif;

        return ob_get_clean();
    }

    /**
     * Get Default Honorary Dignitaries & Chief Guests
     *
     * @return array
     */
    public static function get_default_guests() {
        return array(
            array(
                'name'         => 'Prof. Dr. Asif Ahmed Shaikh',
                'role_type'    => 'guest',
                'category'     => 'Chief Guest & Patron',
                'designation'  => 'Vice Chancellor',
                'org'          => 'Sukkur IBA University',
                'topic'        => 'Inaugural Address: Innovation in Higher Education',
                'bio'          => 'Distinguished academician, scholar, and institutional visionary serving as the Vice Chancellor of Sukkur IBA University, steering the institution to premier national excellence in computing, engineering, and innovation.',
                'photo_url'    => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80',
                'linkedin'     => 'https://www.linkedin.com/school/sukkur-iba-university/',
                'twitter'      => 'https://x.com',
            ),
            array(
                'name'         => 'Engr. Zahid Hussain Khand',
                'role_type'    => 'guest',
                'category'     => 'Guest of Honor',
                'designation'  => 'Registrar & Senior Engineer',
                'org'          => 'Sukkur IBA University',
                'topic'        => 'Keynote: Engineering Governance & Future Skills',
                'bio'          => 'Esteemed engineering educator and institutional administrator spearheading academic governance, faculty collaboration, and technical capacity building across university campuses.',
                'photo_url'    => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=400&q=80',
                'linkedin'     => 'https://www.linkedin.com/school/sukkur-iba-university/',
                'twitter'      => 'https://x.com',
            ),
            array(
                'name'         => 'Dr. Sher Muhammad Daudpota',
                'role_type'    => 'guest',
                'category'     => 'Patron & Special Guest',
                'designation'  => 'Director QEC & Professor of Computer Science',
                'org'          => 'Sukkur IBA University',
                'topic'        => 'Academic Rigor & Algorithmic Excellence in Tech Competitions',
                'bio'          => 'Senior computer scientist, research mentor, and academic leader overseeing university quality enhancement and fostering algorithmic problem solving and international research initiatives.',
                'photo_url'    => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=400&q=80',
                'linkedin'     => 'https://www.linkedin.com/school/sukkur-iba-university/',
                'twitter'      => 'https://x.com',
            ),
        );
    }

    /**
     * Dedicated Guests Shortcode
     */
    public static function render_guests($atts) {
        $atts = shortcode_atts(array(
            'limit'     => 3,
            'category'  => '',
            'featured'  => '',
            'columns'   => 3,
            'fallback'  => 'yes',
        ), $atts);

        $limit_val = intval($atts['limit']);
        $cols_val  = intval($atts['columns']) > 0 ? intval($atts['columns']) : 3;
        $col_class = 'col-' . $cols_val;

        $args = array(
            'post_type'      => 'sibacom_speaker',
            'posts_per_page' => $limit_val > 0 ? $limit_val : -1,
            'post_status'    => 'publish',
            'orderby'        => array('menu_order' => 'ASC', 'date' => 'ASC'),
        );

        $meta_query = array(
            array(
                'key'   => '_sibacom_speaker_role_type',
                'value' => 'guest',
            )
        );
        if ($atts['featured'] === 'yes') {
            $meta_query[] = array(
                'key'   => '_sibacom_speaker_featured',
                'value' => 'yes',
            );
        }
        $args['meta_query'] = $meta_query;

        if (!empty($atts['category'])) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'sibacom_speaker_category',
                    'field'    => 'slug',
                    'terms'    => sanitize_text_field($atts['category']),
                )
            );
        }

        $query = new WP_Query($args);

        if ($query->have_posts() && !empty($query->posts)) {
            $sorted_posts = $query->posts;
            usort($sorted_posts, function($a, $b) {
                $id_a = is_object($a) ? $a->ID : (isset($a['ID']) ? $a['ID'] : 0);
                $id_b = is_object($b) ? $b->ID : (isset($b['ID']) ? $b['ID'] : 0);
                $mo_a = is_object($a) ? $a->menu_order : (isset($a['menu_order']) ? $a['menu_order'] : 0);
                $mo_b = is_object($b) ? $b->menu_order : (isset($b['menu_order']) ? $b['menu_order'] : 0);

                $order_a = get_post_meta($id_a, '_sibacom_speaker_order', true);
                $order_b = get_post_meta($id_b, '_sibacom_speaker_order', true);
                $val_a = ($order_a !== '' && $order_a !== false) ? intval($order_a) : $mo_a;
                $val_b = ($order_b !== '' && $order_b !== false) ? intval($order_b) : $mo_b;
                if ($val_a === $val_b) {
                    return $id_a <=> $id_b;
                }
                return $val_a <=> $val_b;
            });
            $query->posts = $sorted_posts;
        }

        ob_start();
        if ($query->have_posts()) :
            ?>
            <div class="sibacom-speakers-grid sibacom-guests-grid <?php echo esc_attr($col_class); ?>">
                <?php
                while ($query->have_posts()) :
                    $query->the_post();
                    $guest_id     = get_the_ID();
                    $designation  = get_post_meta($guest_id, '_sibacom_speaker_designation', true);
                    $org          = get_post_meta($guest_id, '_sibacom_speaker_org', true);
                    $category     = get_post_meta($guest_id, '_sibacom_speaker_category', true) ?: 'Special Guests';
                    $bio          = get_post_meta($guest_id, '_sibacom_speaker_bio', true);
                    $linkedin     = get_post_meta($guest_id, '_sibacom_speaker_linkedin', true);
                    $twitter      = get_post_meta($guest_id, '_sibacom_speaker_twitter', true);
                    $photo_url    = get_post_meta($guest_id, '_sibacom_speaker_photo_url', true);

                    if (empty($photo_url) && has_post_thumbnail()) {
                        $photo_url = get_the_post_thumbnail_url($guest_id, 'large');
                    }
                    if (empty($photo_url)) {
                        $photo_url = 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80';
                    }
                    ?>
                    <div class="sibacom-speaker-card sibacom-guest-card neu-card sibacom-card-circuit">
                        <?php if (function_exists('sibacom_the_circuit_corner')) {
                            sibacom_the_circuit_corner('tl');
                            sibacom_the_circuit_corner('br');
                        } ?>
                        <div class="sibacom-speaker-img-wrap guest-portrait">
                            <img src="<?php echo esc_url($photo_url); ?>" alt="<?php the_title_attribute(); ?>" width="140" height="140" loading="lazy" decoding="async">
                        </div>

                        <span class="sibacom-speaker-badge guest-badge">
                            <i class="fa-solid fa-award" style="margin-right: 4px;"></i>
                            <?php echo esc_html($category); ?>
                        </span>

                        <h3 class="sibacom-speaker-name font-display"><?php the_title(); ?></h3>
                        <?php if (!empty($designation)) : ?>
                            <p class="sibacom-speaker-designation"><?php echo esc_html($designation); ?></p>
                        <?php endif; ?>
                        <?php if (!empty($org)) : ?>
                            <p class="sibacom-speaker-org"><?php echo esc_html($org); ?></p>
                        <?php endif; ?>

                        <div class="sibacom-speaker-bio">
                            <?php 
                            if (!empty($bio)) {
                                echo esc_html($bio);
                            } else {
                                the_excerpt();
                            }
                            ?>
                        </div>

                        <div class="sibacom-speaker-social">
                            <?php if (!empty($linkedin)) : ?>
                                <a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                            <?php endif; ?>
                            <?php if (!empty($twitter)) : ?>
                                <a href="<?php echo esc_url($twitter); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <?php
        elseif ($atts['fallback'] === 'yes') :
            // Default Fallback: 3 Profile Cards for Chief Guests & Dignitaries
            $default_guests = self::get_default_guests();
            if ($limit_val > 0 && count($default_guests) > $limit_val) {
                $default_guests = array_slice($default_guests, 0, $limit_val);
            }
            ?>
            <div class="sibacom-speakers-grid sibacom-guests-grid <?php echo esc_attr($col_class); ?>">
                <?php foreach ($default_guests as $g) : ?>
                    <div class="sibacom-speaker-card sibacom-guest-card neu-card sibacom-card-circuit">
                        <?php if (function_exists('sibacom_the_circuit_corner')) {
                            sibacom_the_circuit_corner('tl');
                            sibacom_the_circuit_corner('br');
                        } ?>
                        <div class="sibacom-speaker-img-wrap guest-portrait">
                            <img src="<?php echo esc_url($g['photo_url']); ?>" alt="<?php echo esc_attr($g['name']); ?>" width="140" height="140" loading="lazy" decoding="async">
                        </div>

                        <span class="sibacom-speaker-badge guest-badge">
                            <i class="fa-solid fa-award" style="margin-right: 4px;"></i>
                            <?php echo esc_html($g['category']); ?>
                        </span>

                        <h3 class="sibacom-speaker-name font-display"><?php echo esc_html($g['name']); ?></h3>
                        <?php if (!empty($g['designation'])) : ?>
                            <p class="sibacom-speaker-designation"><?php echo esc_html($g['designation']); ?></p>
                        <?php endif; ?>
                        <?php if (!empty($g['org'])) : ?>
                            <p class="sibacom-speaker-org"><?php echo esc_html($g['org']); ?></p>
                        <?php endif; ?>

                        <div class="sibacom-speaker-bio">
                            <?php echo esc_html($g['bio']); ?>
                        </div>

                        <div class="sibacom-speaker-social">
                            <?php if (!empty($g['linkedin'])) : ?>
                                <a href="<?php echo esc_url($g['linkedin']); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                            <?php endif; ?>
                            <?php if (!empty($g['twitter'])) : ?>
                                <a href="<?php echo esc_url($g['twitter']); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if (function_exists('current_user_can') && current_user_can('manage_options')) : ?>
                <div class="sibacom-admin-quick-edit-bar" style="margin-top: 1.75rem; text-align: center;">
                    <span style="font-size: 0.85rem; color: #475569; background: #F8FAFC; border: 1px dashed #CBD5E1; border-radius: 9999px; padding: 7px 18px; display: inline-flex; align-items: center; gap: 10px; flex-wrap: wrap; justify-content: center;">
                        <i class="fa-solid fa-sliders" style="color: #173F91;"></i>
                        <span><strong><?php esc_html_e('SIBACOM Dignitaries active:', 'sibacom-manager'); ?></strong> <?php esc_html_e('3 Distinguished Guests & Patrons.', 'sibacom-manager'); ?></span>
                        <a href="<?php echo esc_url(admin_url('edit.php?post_type=sibacom_speaker')); ?>" style="color: #173F91; font-weight: 700; text-decoration: underline;" target="_blank"><?php esc_html_e('Manage in Admin', 'sibacom-manager'); ?></a>
                        <span style="color: #CBD5E1;">•</span>
                        <a href="<?php echo esc_url(admin_url('post-new.php?post_type=sibacom_speaker')); ?>" style="color: #079B58; font-weight: 700; text-decoration: underline;" target="_blank"><?php esc_html_e('+ Add New Guest', 'sibacom-manager'); ?></a>
                    </span>
                </div>
            <?php endif; ?>
            <?php
        else :
            ?>
            <div class="neu-card text-center" style="max-width: 600px; margin: 0 auto; padding: 2rem;">
                <p style="margin:0;"><?php esc_html_e('Distinguished guests will be announced shortly.', 'sibacom-manager'); ?></p>
            </div>
            <?php
        endif;

        return ob_get_clean();
    }

    /**
     * Organizers Shortcode
     */
    public static function render_organizers($atts) {
        $atts = is_array($atts) ? $atts : array();

        $resolve = function($val, $opt_key, $legacy_key, $default) {
            if (is_string($val) && trim($val) !== '') {
                return trim($val);
            }
            if (!empty($opt_key)) {
                $opt = get_option($opt_key);
                if (is_string($opt) && trim($opt) !== '') {
                    return trim($opt);
                }
            }
            if (!empty($legacy_key)) {
                $opt = get_option($legacy_key);
                if (is_string($opt) && trim($opt) !== '') {
                    return trim($opt);
                }
            }
            return $default;
        };

        // Section Badges & Headings
        $show_headers       = (!isset($atts['show_section_headers']) || $atts['show_section_headers'] !== 'no');
        $joint_sec_badge    = $resolve($atts['joint_sec_badge'] ?? '', 'sibacom_organizers_sec_badge', '', __('Joint Primary Organizers', 'sibacom-manager'));
        $joint_sec_title    = $resolve($atts['joint_sec_title'] ?? '', 'sibacom_organizers_sec_title', '', __('Co-Equal Student Engineering Societies', 'sibacom-manager'));
        $joint_sec_subtitle = $resolve($atts['joint_sec_subtitle'] ?? '', 'sibacom_organizers_sec_subtitle', '', __('Bringing together the Computer Systems Engineering and Electrical Engineering communities.', 'sibacom-manager'));

        // 1. CSE Society Card
        $cse_soc_title       = $resolve($atts['cse_title'] ?? '', 'sibacom_organizers_cse_society_title', 'sibacom_organizers_society_title', 'Computer Systems Engineering Society (CSE Society)');
        $cse_soc_desc        = $resolve($atts['cse_desc'] ?? '', 'sibacom_organizers_cse_society_desc', 'sibacom_organizers_society_desc', 'The premier student engineering society of the Department of Computer Systems Engineering, pioneering technical competitions, algorithmic hackathons, and hardware-software innovation at Sukkur IBA University.');
        $cse_soc_badge       = $resolve($atts['cse_badge'] ?? '', '', '', __('Joint Primary Organizer', 'sibacom-manager'));
        $cse_soc_affiliation = $resolve($atts['cse_affiliation'] ?? '', 'sibacom_organizers_cse_society_affiliation', '', __('Co-Equal Secretariat & Computing Track Lead', 'sibacom-manager'));
        $cse_soc_icon        = $resolve($atts['cse_icon'] ?? '', '', '', 'fa-solid fa-code');
        $cse_soc_footer_icon = $resolve($atts['cse_footer_icon'] ?? '', '', '', 'fa-solid fa-circle-check');
        $cse_soc_logo        = !empty($atts['cse_logo']) ? (is_array($atts['cse_logo']) ? ($atts['cse_logo']['url'] ?? '') : $atts['cse_logo']) : '';

        // 2. EE Society Card
        $ee_soc_title       = $resolve($atts['ee_title'] ?? '', 'sibacom_organizers_ee_society_title', '', 'Electrical Engineering Society (EE Society)');
        $ee_soc_desc        = $resolve($atts['ee_desc'] ?? '', 'sibacom_organizers_ee_society_desc', '', 'The leading student engineering society of the Department of Electrical Engineering, driving excellence in circuit design, embedded robotics, telecommunications, and power systems at Sukkur IBA University.');
        $ee_soc_badge       = $resolve($atts['ee_badge'] ?? '', '', '', __('Joint Primary Organizer', 'sibacom-manager'));
        $ee_soc_affiliation = $resolve($atts['ee_affiliation'] ?? '', 'sibacom_organizers_ee_society_affiliation', '', __('Co-Equal Secretariat & Electrical Track Lead', 'sibacom-manager'));
        $ee_soc_icon        = $resolve($atts['ee_icon'] ?? '', '', '', 'fa-solid fa-bolt');
        $ee_soc_footer_icon = $resolve($atts['ee_footer_icon'] ?? '', '', '', 'fa-solid fa-circle-check');
        $ee_soc_logo        = !empty($atts['ee_logo']) ? (is_array($atts['ee_logo']) ? ($atts['ee_logo']['url'] ?? '') : $atts['ee_logo']) : '';

        // Circuit Separator
        $enable_circuits  = (!isset($atts['enable_org_circuits']) || $atts['enable_org_circuits'] !== 'no') && (!isset($atts['enable_circuits']) || $atts['enable_circuits'] !== 'no');
        $enable_connector = (!isset($atts['enable_connector']) || $atts['enable_connector'] !== 'no');
        $bus_left         = $resolve($atts['bus_left'] ?? '', '', '', 'CSE_BUS');
        $chip_brand       = $resolve($atts['chip_brand'] ?? '', '', '', 'SIBACOM');
        $chip_model       = $resolve($atts['chip_model'] ?? '', '', '', 'BRIDGE');
        $bus_right        = $resolve($atts['bus_right'] ?? '', '', '', 'EE_BUS');

        // Academic Partners Section
        $academic_sec_badge    = $resolve($atts['academic_sec_badge'] ?? '', 'sibacom_academic_sec_badge', '', __('Academic Partners', 'sibacom-manager'));
        $academic_sec_title    = $resolve($atts['academic_sec_title'] ?? '', 'sibacom_academic_sec_title', '', __('University Academic Departments', 'sibacom-manager'));
        $academic_sec_subtitle = $resolve($atts['academic_sec_subtitle'] ?? '', 'sibacom_academic_sec_subtitle', '', __('Supporting academic departments providing faculty advisement, research laboratory facilities, and international judging standards.', 'sibacom-manager'));

        // 3. Dept of CSE Card
        $cse_dept_title       = $resolve($atts['cse_dept_title'] ?? '', 'sibacom_academic_cse_dept_title', 'sibacom_organizers_dept_title', 'Department of Computer Systems Engineering');
        $cse_dept_desc        = $resolve($atts['cse_dept_desc'] ?? '', 'sibacom_academic_cse_dept_desc', 'sibacom_organizers_dept_desc', 'Academic affiliation and supporting partner for the CSE Society, providing high-performance computing clusters, embedded systems labs, and faculty adjudication across computing and AI tracks.');
        $cse_dept_badge       = $resolve($atts['cse_dept_badge'] ?? '', '', '', __('Academic Partner', 'sibacom-manager'));
        $cse_dept_support     = $resolve($atts['cse_dept_support'] ?? '', 'sibacom_academic_cse_dept_support', '', __('Computing Labs & Faculty Adjudication', 'sibacom-manager'));
        $cse_dept_icon        = $resolve($atts['cse_dept_icon'] ?? '', '', '', 'fa-solid fa-microchip');
        $cse_dept_footer_icon = $resolve($atts['cse_dept_footer_icon'] ?? '', '', '', 'fa-solid fa-microchip');
        $cse_dept_logo        = !empty($atts['cse_dept_logo']) ? (is_array($atts['cse_dept_logo']) ? ($atts['cse_dept_logo']['url'] ?? '') : $atts['cse_dept_logo']) : '';

        // 4. Dept of EE Card
        $ee_dept_title       = $resolve($atts['ee_dept_title'] ?? '', 'sibacom_academic_ee_dept_title', '', 'Department of Electrical Engineering');
        $ee_dept_desc        = $resolve($atts['ee_dept_desc'] ?? '', 'sibacom_academic_ee_dept_desc', '', 'Academic affiliation and supporting partner for the EE Society, providing state-of-the-art electronics, telecommunications, and power engineering laboratories, along with senior faculty mentorship.');
        $ee_dept_badge       = $resolve($atts['ee_dept_badge'] ?? '', '', '', __('Academic Partner', 'sibacom-manager'));
        $ee_dept_support     = $resolve($atts['ee_dept_support'] ?? '', 'sibacom_academic_ee_dept_support', '', __('Electronics Labs & Technical Adjudication', 'sibacom-manager'));
        $ee_dept_icon        = $resolve($atts['ee_dept_icon'] ?? '', '', '', 'fa-solid fa-plug-circle-bolt');
        $ee_dept_footer_icon = $resolve($atts['ee_dept_footer_icon'] ?? '', '', '', 'fa-solid fa-plug-circle-check');
        $ee_dept_logo        = !empty($atts['ee_dept_logo']) ? (is_array($atts['ee_dept_logo']) ? ($atts['ee_dept_logo']['url'] ?? '') : $atts['ee_dept_logo']) : '';

        // 5. Host Institution
        $uni_title       = $resolve($atts['uni_title'] ?? '', 'sibacom_organizers_uni_title', '', 'Sukkur IBA University');
        $uni_desc        = $resolve($atts['uni_desc'] ?? '', 'sibacom_organizers_uni_desc', '', 'A top-ranked public sector university chartered by the Government of Sindh and recognized by HEC Pakistan, renowned for its merit-based admission, cutting-edge labs, and academic prestige.');
        $uni_badge       = $resolve($atts['uni_badge'] ?? '', '', '', __('Host Institution & Patron', 'sibacom-manager'));
        $uni_support     = $resolve($atts['uni_support'] ?? '', 'sibacom_organizers_uni_badge', '', __('Chartered Public Sector University', 'sibacom-manager'));
        $uni_icon        = $resolve($atts['uni_icon'] ?? '', '', '', 'fa-solid fa-building-columns');
        $uni_footer_icon = $resolve($atts['uni_footer_icon'] ?? '', '', '', 'fa-solid fa-shield-halved');
        $uni_logo        = !empty($atts['uni_logo']) ? (is_array($atts['uni_logo']) ? ($atts['uni_logo']['url'] ?? '') : $atts['uni_logo']) : '';

        // 6. SISC Student Council
        $sisc_title       = $resolve($atts['sisc_title'] ?? '', 'sibacom_organizers_sisc_title', '', 'SISC – Sukkur IBA Student Council');
        $sisc_desc        = $resolve($atts['sisc_desc'] ?? '', 'sibacom_organizers_sisc_desc', '', 'The apex representative student leadership council of Sukkur IBA University, overseeing cross-departmental coordination, university-wide engagement, and delegate hospitality.');
        $sisc_badge       = $resolve($atts['sisc_badge'] ?? '', '', '', __('Student Leadership', 'sibacom-manager'));
        $sisc_support     = $resolve($atts['sisc_support'] ?? '', '', '', __('Student Governance & Delegations', 'sibacom-manager'));
        $sisc_icon        = $resolve($atts['sisc_icon'] ?? '', '', '', 'fa-solid fa-users');
        $sisc_footer_icon = $resolve($atts['sisc_footer_icon'] ?? '', '', '', 'fa-solid fa-handshake-angle');
        $sisc_logo        = !empty($atts['sisc_logo']) ? (is_array($atts['sisc_logo']) ? ($atts['sisc_logo']['url'] ?? '') : $atts['sisc_logo']) : '';

        ob_start();
        ?>
        <!-- Group 1: Joint Primary Organizers (Co-equal prominence) -->
        <div style="margin-bottom: 1.5rem;">
            <?php if ($show_headers) : ?>
            <div style="text-align: center; margin-bottom: 1.75rem;">
                <span class="sibacom-badge" style="margin-bottom: 0.5rem;">
                    <i class="fa-solid fa-users-gear" style="color: var(--sibacom-primary);"></i>
                    <span><?php echo esc_html($joint_sec_badge); ?></span>
                </span>
                <h3 class="font-display" style="font-size: 1.6rem; color: var(--sibacom-primary);"><?php echo esc_html($joint_sec_title); ?></h3>
                <?php if (!empty($joint_sec_subtitle)) : ?>
                    <p style="font-size: 0.95rem; color: var(--sibacom-text-secondary); max-width: 680px; margin: 0.5rem auto 0 auto;"><?php echo esc_html($joint_sec_subtitle); ?></p>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <div class="sibacom-organizers-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.75rem;">
                <!-- 1. CSE Society -->
                <div class="sibacom-org-card primary-society neu-card sibacom-card-circuit">
                    <?php if ($enable_circuits && function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                            <span style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; color: var(--sibacom-primary); background: rgba(23,63,145,0.1); padding: 0.25rem 0.75rem; border-radius: var(--radius-full);">
                                <?php echo esc_html($cse_soc_badge); ?>
                            </span>
                            <i class="<?php echo esc_attr($cse_soc_icon); ?>" style="color: var(--sibacom-primary); font-size: 1.25rem;"></i>
                        </div>
                        <div class="sibacom-org-logo-wrap">
                            <?php 
                            if (!empty($cse_soc_logo)) {
                                echo '<img src="' . esc_url($cse_soc_logo) . '" alt="' . esc_attr($cse_soc_title) . '" class="society-logo cse-society-logo" width="160" height="42" fetchpriority="high" decoding="async" style="height:42px; max-height:42px; width:auto; max-width:160px; object-fit:contain;" />';
                            } elseif (function_exists('sibacom_the_cse_society_logo')) {
                                sibacom_the_cse_society_logo();
                            } elseif (function_exists('sibacom_the_society_logo')) {
                                sibacom_the_society_logo();
                            }
                            ?>
                        </div>
                        <h3 class="font-display" style="font-size: 1.35rem; margin-bottom: 0.75rem; color: var(--sibacom-text-primary);">
                            <?php echo esc_html($cse_soc_title); ?>
                        </h3>
                        <p style="font-size: 0.92rem; color: var(--sibacom-text-secondary); line-height: 1.65;">
                            <?php echo esc_html($cse_soc_desc); ?>
                        </p>
                    </div>
                    <div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--sibacom-border);">
                        <span style="font-size: 0.8rem; font-weight: 600; color: var(--sibacom-techgreen);">
                            <i class="<?php echo esc_attr($cse_soc_footer_icon); ?>" style="margin-right: 0.35rem;"></i>
                            <?php echo esc_html($cse_soc_affiliation); ?>
                        </span>
                    </div>
                </div>

                <!-- 2. EE Society -->
                <div class="sibacom-org-card primary-society neu-card sibacom-card-circuit" style="border-color: rgba(7, 155, 88, 0.45);">
                    <?php if ($enable_circuits && function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                            <span style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; color: var(--sibacom-techgreen); background: rgba(7,155,88,0.12); padding: 0.25rem 0.75rem; border-radius: var(--radius-full);">
                                <?php echo esc_html($ee_soc_badge); ?>
                            </span>
                            <i class="<?php echo esc_attr($ee_soc_icon); ?>" style="color: var(--sibacom-techgreen); font-size: 1.25rem;"></i>
                        </div>
                        <div class="sibacom-org-logo-wrap">
                            <?php 
                            if (!empty($ee_soc_logo)) {
                                echo '<img src="' . esc_url($ee_soc_logo) . '" alt="' . esc_attr($ee_soc_title) . '" class="society-logo ee-society-logo" width="160" height="42" fetchpriority="high" decoding="async" style="height:42px; max-height:42px; width:auto; max-width:160px; object-fit:contain;" />';
                            } elseif (function_exists('sibacom_the_ee_society_logo')) {
                                sibacom_the_ee_society_logo();
                            }
                            ?>
                        </div>
                        <h3 class="font-display" style="font-size: 1.35rem; margin-bottom: 0.75rem; color: var(--sibacom-text-primary);">
                            <?php echo esc_html($ee_soc_title); ?>
                        </h3>
                        <p style="font-size: 0.92rem; color: var(--sibacom-text-secondary); line-height: 1.65;">
                            <?php echo esc_html($ee_soc_desc); ?>
                        </p>
                    </div>
                    <div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--sibacom-border);">
                        <span style="font-size: 0.8rem; font-weight: 600; color: var(--sibacom-techgreen);">
                            <i class="<?php echo esc_attr($ee_soc_footer_icon); ?>" style="margin-right: 0.35rem;"></i>
                            <?php echo esc_html($ee_soc_affiliation); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Decorative Circuit Connector Separator -->
        <?php if ($enable_circuits && $enable_connector && function_exists('sibacom_the_circuit_connector')) : ?>
            <?php sibacom_the_circuit_connector($bus_left, $chip_brand, $chip_model, $bus_right); ?>
        <?php endif; ?>

        <!-- Group 2: Supporting Academic Partners -->
        <div style="margin-top: 2rem; margin-bottom: 2rem;">
            <?php if ($show_headers) : ?>
            <div style="text-align: center; margin-bottom: 1.75rem;">
                <span class="sibacom-badge" style="margin-bottom: 0.5rem;">
                    <i class="fa-solid fa-building-columns" style="color: var(--sibacom-techgreen);"></i>
                    <span><?php echo esc_html($academic_sec_badge); ?></span>
                </span>
                <h3 class="font-display" style="font-size: 1.6rem; color: var(--sibacom-text-primary);"><?php echo esc_html($academic_sec_title); ?></h3>
                <?php if (!empty($academic_sec_subtitle)) : ?>
                    <p style="font-size: 0.95rem; color: var(--sibacom-text-secondary); max-width: 680px; margin: 0.5rem auto 0 auto;"><?php echo esc_html($academic_sec_subtitle); ?></p>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <div class="sibacom-organizers-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.75rem;">
                <!-- 3. Department of CSE -->
                <div class="sibacom-org-card neu-card sibacom-card-circuit">
                    <?php if ($enable_circuits && function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                            <span style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; color: var(--sibacom-primary); background: rgba(23,63,145,0.08); padding: 0.25rem 0.75rem; border-radius: var(--radius-full);">
                                <?php echo esc_html($cse_dept_badge); ?>
                            </span>
                            <i class="<?php echo esc_attr($cse_dept_icon); ?>" style="color: var(--sibacom-primary); font-size: 1.25rem;"></i>
                        </div>
                        <div class="sibacom-org-logo-wrap">
                            <?php 
                            if (!empty($cse_dept_logo)) {
                                echo '<img src="' . esc_url($cse_dept_logo) . '" alt="' . esc_attr($cse_dept_title) . '" class="dept-logo cse-dept-logo" width="160" height="55" decoding="async" style="height:55px; max-height:55px; width:auto; max-width:160px; object-fit:contain;" />';
                            } elseif (function_exists('sibacom_the_cse_dept_logo')) {
                                sibacom_the_cse_dept_logo();
                            } elseif (function_exists('sibacom_the_dept_logo')) {
                                sibacom_the_dept_logo();
                            }
                            ?>
                        </div>
                        <h3 class="font-display" style="font-size: 1.35rem; margin-bottom: 0.75rem; color: var(--sibacom-text-primary);">
                            <?php echo esc_html($cse_dept_title); ?>
                        </h3>
                        <p style="font-size: 0.92rem; color: var(--sibacom-text-secondary); line-height: 1.65;">
                            <?php echo esc_html($cse_dept_desc); ?>
                        </p>
                    </div>
                    <div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--sibacom-border);">
                        <span style="font-size: 0.8rem; font-weight: 600; color: var(--sibacom-primary);">
                            <i class="<?php echo esc_attr($cse_dept_footer_icon); ?>" style="margin-right: 0.35rem;"></i>
                            <?php echo esc_html($cse_dept_support); ?>
                        </span>
                    </div>
                </div>

                <!-- 4. Department of EE -->
                <div class="sibacom-org-card neu-card sibacom-card-circuit">
                    <?php if ($enable_circuits && function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                            <span style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; color: var(--sibacom-techgreen); background: rgba(7,155,88,0.08); padding: 0.25rem 0.75rem; border-radius: var(--radius-full);">
                                <?php echo esc_html($ee_dept_badge); ?>
                            </span>
                            <i class="<?php echo esc_attr($ee_dept_icon); ?>" style="color: var(--sibacom-techgreen); font-size: 1.25rem;"></i>
                        </div>
                        <div class="sibacom-org-logo-wrap">
                            <?php 
                            if (!empty($ee_dept_logo)) {
                                echo '<img src="' . esc_url($ee_dept_logo) . '" alt="' . esc_attr($ee_dept_title) . '" class="dept-logo ee-dept-logo" width="160" height="55" decoding="async" style="height:55px; max-height:55px; width:auto; max-width:160px; object-fit:contain;" />';
                            } elseif (function_exists('sibacom_the_ee_dept_logo')) {
                                sibacom_the_ee_dept_logo();
                            }
                            ?>
                        </div>
                        <h3 class="font-display" style="font-size: 1.35rem; margin-bottom: 0.75rem; color: var(--sibacom-text-primary);">
                            <?php echo esc_html($ee_dept_title); ?>
                        </h3>
                        <p style="font-size: 0.92rem; color: var(--sibacom-text-secondary); line-height: 1.65;">
                            <?php echo esc_html($ee_dept_desc); ?>
                        </p>
                    </div>
                    <div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--sibacom-border);">
                        <span style="font-size: 0.8rem; font-weight: 600; color: var(--sibacom-techgreen);">
                            <i class="<?php echo esc_attr($ee_dept_footer_icon); ?>" style="margin-right: 0.35rem;"></i>
                            <?php echo esc_html($ee_dept_support); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Group 3: Institutional Patron & Student Governance -->
        <div style="margin-top: 2rem;">
            <div class="sibacom-organizers-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.75rem;">
                <!-- 5. Sukkur IBA University -->
                <div class="sibacom-org-card neu-card sibacom-card-circuit">
                    <?php if ($enable_circuits && function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                            <span style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; color: var(--sibacom-primary); background: rgba(23,63,145,0.1); padding: 0.25rem 0.75rem; border-radius: var(--radius-full);">
                                <?php echo esc_html($uni_badge); ?>
                            </span>
                            <i class="<?php echo esc_attr($uni_icon); ?>" style="color: var(--sibacom-primary); font-size: 1.25rem;"></i>
                        </div>
                        <div class="sibacom-org-logo-wrap">
                            <?php 
                            if (!empty($uni_logo)) {
                                echo '<img src="' . esc_url($uni_logo) . '" alt="' . esc_attr($uni_title) . '" class="uni-logo" width="150" height="44" fetchpriority="high" decoding="async" style="height:44px; width:auto; max-width:150px; object-fit:contain;" />';
                            } elseif (function_exists('sibacom_the_university_logo')) {
                                sibacom_the_university_logo();
                            }
                            ?>
                        </div>
                        <h3 class="font-display" style="font-size: 1.35rem; margin-bottom: 0.75rem; color: var(--sibacom-text-primary);">
                            <?php echo esc_html($uni_title); ?>
                        </h3>
                        <p style="font-size: 0.92rem; color: var(--sibacom-text-secondary); line-height: 1.65;">
                            <?php echo esc_html($uni_desc); ?>
                        </p>
                    </div>
                    <div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--sibacom-border);">
                        <span style="font-size: 0.8rem; font-weight: 600; color: var(--sibacom-techgreen);">
                            <i class="<?php echo esc_attr($uni_footer_icon); ?>" style="margin-right: 0.35rem;"></i>
                            <?php echo esc_html($uni_support); ?>
                        </span>
                    </div>
                </div>

                <!-- 6. SISC Student Council -->
                <div class="sibacom-org-card neu-card sibacom-card-circuit">
                    <?php if ($enable_circuits && function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                            <span style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; color: var(--sibacom-navy); background: rgba(16,46,104,0.1); padding: 0.25rem 0.75rem; border-radius: var(--radius-full);">
                                <?php echo esc_html($sisc_badge); ?>
                            </span>
                            <i class="<?php echo esc_attr($sisc_icon); ?>" style="color: var(--sibacom-navy); font-size: 1.25rem;"></i>
                        </div>
                        <div class="sibacom-org-logo-wrap">
                            <?php 
                            if (!empty($sisc_logo)) {
                                echo '<img src="' . esc_url($sisc_logo) . '" alt="' . esc_attr($sisc_title) . '" class="sisc-logo" width="160" height="55" decoding="async" style="height:55px; width:auto; object-fit:contain;" />';
                            } elseif (function_exists('sibacom_the_sisc_logo')) {
                                sibacom_the_sisc_logo();
                            }
                            ?>
                        </div>
                        <h3 class="font-display" style="font-size: 1.35rem; margin-bottom: 0.75rem; color: var(--sibacom-text-primary);">
                            <?php echo esc_html($sisc_title); ?>
                        </h3>
                        <p style="font-size: 0.92rem; color: var(--sibacom-text-secondary); line-height: 1.65;">
                            <?php echo esc_html($sisc_desc); ?>
                        </p>
                    </div>
                    <div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--sibacom-border);">
                        <span style="font-size: 0.8rem; font-weight: 600; color: var(--sibacom-navy);">
                            <i class="<?php echo esc_attr($sisc_footer_icon); ?>" style="margin-right: 0.35rem;"></i>
                            <?php echo esc_html($sisc_support); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Joint Organizers Standalone Shortcode
     */
    public static function render_joint_organizers($atts) {
        $atts = is_array($atts) ? $atts : array();

        $resolve = function($val, $opt_key, $legacy_key, $default) {
            if (is_string($val) && trim($val) !== '') {
                return trim($val);
            }
            if (!empty($opt_key)) {
                $opt = get_option($opt_key);
                if (is_string($opt) && trim($opt) !== '') {
                    return trim($opt);
                }
            }
            if (!empty($legacy_key)) {
                $opt = get_option($legacy_key);
                if (is_string($opt) && trim($opt) !== '') {
                    return trim($opt);
                }
            }
            return $default;
        };

        $enable_circuits = (!isset($atts['enable_org_circuits']) || $atts['enable_org_circuits'] !== 'no') && (!isset($atts['enable_circuits']) || $atts['enable_circuits'] !== 'no');

        // 1. CSE Society Card
        $cse_soc_title       = $resolve($atts['cse_title'] ?? '', 'sibacom_organizers_cse_society_title', 'sibacom_organizers_society_title', 'Computer Systems Engineering Society (CSE Society)');
        $cse_soc_desc        = $resolve($atts['cse_desc'] ?? '', 'sibacom_organizers_cse_society_desc', 'sibacom_organizers_society_desc', 'The premier student engineering society of the Department of Computer Systems Engineering, pioneering technical competitions, algorithmic hackathons, and hardware-software innovation at Sukkur IBA University.');
        $cse_soc_badge       = $resolve($atts['cse_badge'] ?? '', '', '', __('Joint Primary Organizer', 'sibacom-manager'));
        $cse_soc_affiliation = $resolve($atts['cse_affiliation'] ?? '', 'sibacom_organizers_cse_society_affiliation', '', __('Co-Equal Secretariat & Computing Track Lead', 'sibacom-manager'));
        $cse_soc_icon        = $resolve($atts['cse_icon'] ?? '', '', '', 'fa-solid fa-code');
        $cse_soc_footer_icon = $resolve($atts['cse_footer_icon'] ?? '', '', '', 'fa-solid fa-circle-check');
        $cse_soc_logo        = !empty($atts['cse_logo']) ? (is_array($atts['cse_logo']) ? ($atts['cse_logo']['url'] ?? '') : $atts['cse_logo']) : '';

        // 2. EE Society Card
        $ee_soc_title       = $resolve($atts['ee_title'] ?? '', 'sibacom_organizers_ee_society_title', '', 'Electrical Engineering Society (EE Society)');
        $ee_soc_desc        = $resolve($atts['ee_desc'] ?? '', 'sibacom_organizers_ee_society_desc', '', 'The leading student engineering society of the Department of Electrical Engineering, driving excellence in circuit design, embedded robotics, telecommunications, and power systems at Sukkur IBA University.');
        $ee_soc_badge       = $resolve($atts['ee_badge'] ?? '', '', '', __('Joint Primary Organizer', 'sibacom-manager'));
        $ee_soc_affiliation = $resolve($atts['ee_affiliation'] ?? '', 'sibacom_organizers_ee_society_affiliation', '', __('Co-Equal Secretariat & Electrical Track Lead', 'sibacom-manager'));
        $ee_soc_icon        = $resolve($atts['ee_icon'] ?? '', '', '', 'fa-solid fa-bolt');
        $ee_soc_footer_icon = $resolve($atts['ee_footer_icon'] ?? '', '', '', 'fa-solid fa-circle-check');
        $ee_soc_logo        = !empty($atts['ee_logo']) ? (is_array($atts['ee_logo']) ? ($atts['ee_logo']['url'] ?? '') : $atts['ee_logo']) : '';

        ob_start();
        ?>
        <div class="sibacom-organizers-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.75rem;">
            <!-- CSE Society -->
            <div class="sibacom-org-card primary-society neu-card sibacom-card-circuit">
                <?php if ($enable_circuits && function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                        <span style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; color: var(--sibacom-primary); background: rgba(23,63,145,0.1); padding: 0.25rem 0.75rem; border-radius: var(--radius-full);">
                            <?php echo esc_html($cse_soc_badge); ?>
                        </span>
                        <i class="<?php echo esc_attr($cse_soc_icon); ?>" style="color: var(--sibacom-primary); font-size: 1.25rem;"></i>
                    </div>
                    <div class="sibacom-org-logo-wrap">
                        <?php 
                        if (!empty($cse_soc_logo)) {
                            echo '<img src="' . esc_url($cse_soc_logo) . '" alt="' . esc_attr($cse_soc_title) . '" class="society-logo cse-society-logo" width="160" height="42" fetchpriority="high" decoding="async" style="height:42px; max-height:42px; width:auto; max-width:160px; object-fit:contain;" />';
                        } elseif (function_exists('sibacom_the_cse_society_logo')) {
                            sibacom_the_cse_society_logo();
                        } elseif (function_exists('sibacom_the_society_logo')) {
                            sibacom_the_society_logo();
                        }
                        ?>
                    </div>
                    <h3 class="font-display" style="font-size: 1.35rem; margin-bottom: 0.75rem; color: var(--sibacom-text-primary);">
                        <?php echo esc_html($cse_soc_title); ?>
                    </h3>
                    <p style="font-size: 0.92rem; color: var(--sibacom-text-secondary); line-height: 1.65;">
                        <?php echo esc_html($cse_soc_desc); ?>
                    </p>
                </div>
                <div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--sibacom-border);">
                    <span style="font-size: 0.8rem; font-weight: 600; color: var(--sibacom-techgreen);">
                        <i class="<?php echo esc_attr($cse_soc_footer_icon); ?>" style="margin-right: 0.35rem;"></i>
                        <?php echo esc_html($cse_soc_affiliation); ?>
                    </span>
                </div>
            </div>

            <!-- EE Society -->
            <div class="sibacom-org-card primary-society neu-card sibacom-card-circuit" style="border-color: rgba(7, 155, 88, 0.45);">
                <?php if ($enable_circuits && function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                        <span style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; color: var(--sibacom-techgreen); background: rgba(7,155,88,0.12); padding: 0.25rem 0.75rem; border-radius: var(--radius-full);">
                            <?php echo esc_html($ee_soc_badge); ?>
                        </span>
                        <i class="<?php echo esc_attr($ee_soc_icon); ?>" style="color: var(--sibacom-techgreen); font-size: 1.25rem;"></i>
                    </div>
                    <div class="sibacom-org-logo-wrap">
                        <?php 
                        if (!empty($ee_soc_logo)) {
                            echo '<img src="' . esc_url($ee_soc_logo) . '" alt="' . esc_attr($ee_soc_title) . '" class="society-logo ee-society-logo" width="160" height="42" fetchpriority="high" decoding="async" style="height:42px; max-height:42px; width:auto; max-width:160px; object-fit:contain;" />';
                        } elseif (function_exists('sibacom_the_ee_society_logo')) {
                            sibacom_the_ee_society_logo();
                        }
                        ?>
                    </div>
                    <h3 class="font-display" style="font-size: 1.35rem; margin-bottom: 0.75rem; color: var(--sibacom-text-primary);">
                        <?php echo esc_html($ee_soc_title); ?>
                    </h3>
                    <p style="font-size: 0.92rem; color: var(--sibacom-text-secondary); line-height: 1.65;">
                        <?php echo esc_html($ee_soc_desc); ?>
                    </p>
                </div>
                <div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--sibacom-border);">
                    <span style="font-size: 0.8rem; font-weight: 600; color: var(--sibacom-techgreen);">
                        <i class="<?php echo esc_attr($ee_soc_footer_icon); ?>" style="margin-right: 0.35rem;"></i>
                        <?php echo esc_html($ee_soc_affiliation); ?>
                    </span>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Academic Partners Standalone Shortcode
     */
    public static function render_academic_partners($atts) {
        $atts = is_array($atts) ? $atts : array();

        $resolve = function($val, $opt_key, $legacy_key, $default) {
            if (is_string($val) && trim($val) !== '') {
                return trim($val);
            }
            if (!empty($opt_key)) {
                $opt = get_option($opt_key);
                if (is_string($opt) && trim($opt) !== '') {
                    return trim($opt);
                }
            }
            if (!empty($legacy_key)) {
                $opt = get_option($legacy_key);
                if (is_string($opt) && trim($opt) !== '') {
                    return trim($opt);
                }
            }
            return $default;
        };

        $enable_circuits = (!isset($atts['enable_org_circuits']) || $atts['enable_org_circuits'] !== 'no') && (!isset($atts['enable_circuits']) || $atts['enable_circuits'] !== 'no');

        // 3. Dept of CSE Card
        $cse_dept_title       = $resolve($atts['cse_dept_title'] ?? '', 'sibacom_academic_cse_dept_title', 'sibacom_organizers_dept_title', 'Department of Computer Systems Engineering');
        $cse_dept_desc        = $resolve($atts['cse_dept_desc'] ?? '', 'sibacom_academic_cse_dept_desc', 'sibacom_organizers_dept_desc', 'Academic affiliation and supporting partner for the CSE Society, providing high-performance computing clusters, embedded systems labs, and faculty adjudication across computing and AI tracks.');
        $cse_dept_badge       = $resolve($atts['cse_dept_badge'] ?? '', '', '', __('Academic Partner', 'sibacom-manager'));
        $cse_dept_support     = $resolve($atts['cse_dept_support'] ?? '', 'sibacom_academic_cse_dept_support', '', __('Computing Labs & Faculty Adjudication', 'sibacom-manager'));
        $cse_dept_icon        = $resolve($atts['cse_dept_icon'] ?? '', '', '', 'fa-solid fa-microchip');
        $cse_dept_footer_icon = $resolve($atts['cse_dept_footer_icon'] ?? '', '', '', 'fa-solid fa-microchip');
        $cse_dept_logo        = !empty($atts['cse_dept_logo']) ? (is_array($atts['cse_dept_logo']) ? ($atts['cse_dept_logo']['url'] ?? '') : $atts['cse_dept_logo']) : '';

        // 4. Dept of EE Card
        $ee_dept_title       = $resolve($atts['ee_dept_title'] ?? '', 'sibacom_academic_ee_dept_title', '', 'Department of Electrical Engineering');
        $ee_dept_desc        = $resolve($atts['ee_dept_desc'] ?? '', 'sibacom_academic_ee_dept_desc', '', 'Academic affiliation and supporting partner for the EE Society, providing state-of-the-art electronics, telecommunications, and power engineering laboratories, along with senior faculty mentorship.');
        $ee_dept_badge       = $resolve($atts['ee_dept_badge'] ?? '', '', '', __('Academic Partner', 'sibacom-manager'));
        $ee_dept_support     = $resolve($atts['ee_dept_support'] ?? '', 'sibacom_academic_ee_dept_support', '', __('Electronics Labs & Technical Adjudication', 'sibacom-manager'));
        $ee_dept_icon        = $resolve($atts['ee_dept_icon'] ?? '', '', '', 'fa-solid fa-plug-circle-bolt');
        $ee_dept_footer_icon = $resolve($atts['ee_dept_footer_icon'] ?? '', '', '', 'fa-solid fa-plug-circle-check');
        $ee_dept_logo        = !empty($atts['ee_dept_logo']) ? (is_array($atts['ee_dept_logo']) ? ($atts['ee_dept_logo']['url'] ?? '') : $atts['ee_dept_logo']) : '';

        ob_start();
        ?>
        <div class="sibacom-organizers-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.75rem;">
            <!-- Department of CSE -->
            <div class="sibacom-org-card neu-card sibacom-card-circuit">
                <?php if ($enable_circuits && function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                        <span style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; color: var(--sibacom-primary); background: rgba(23,63,145,0.08); padding: 0.25rem 0.75rem; border-radius: var(--radius-full);">
                            <?php echo esc_html($cse_dept_badge); ?>
                        </span>
                        <i class="<?php echo esc_attr($cse_dept_icon); ?>" style="color: var(--sibacom-primary); font-size: 1.25rem;"></i>
                    </div>
                    <div class="sibacom-org-logo-wrap">
                        <?php 
                        if (!empty($cse_dept_logo)) {
                            echo '<img src="' . esc_url($cse_dept_logo) . '" alt="' . esc_attr($cse_dept_title) . '" class="dept-logo cse-dept-logo" width="160" height="55" decoding="async" style="height:55px; max-height:55px; width:auto; max-width:160px; object-fit:contain;" />';
                        } elseif (function_exists('sibacom_the_cse_dept_logo')) {
                            sibacom_the_cse_dept_logo();
                        } elseif (function_exists('sibacom_the_dept_logo')) {
                            sibacom_the_dept_logo();
                        }
                        ?>
                    </div>
                    <h3 class="font-display" style="font-size: 1.35rem; margin-bottom: 0.75rem; color: var(--sibacom-text-primary);">
                        <?php echo esc_html($cse_dept_title); ?>
                    </h3>
                    <p style="font-size: 0.92rem; color: var(--sibacom-text-secondary); line-height: 1.65;">
                        <?php echo esc_html($cse_dept_desc); ?>
                    </p>
                </div>
                <div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--sibacom-border);">
                    <span style="font-size: 0.8rem; font-weight: 600; color: var(--sibacom-primary);">
                        <i class="<?php echo esc_attr($cse_dept_footer_icon); ?>" style="margin-right: 0.35rem;"></i>
                        <?php echo esc_html($cse_dept_support); ?>
                    </span>
                </div>
            </div>

            <!-- Department of EE -->
            <div class="sibacom-org-card neu-card sibacom-card-circuit">
                <?php if ($enable_circuits && function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                        <span style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; color: var(--sibacom-techgreen); background: rgba(7,155,88,0.08); padding: 0.25rem 0.75rem; border-radius: var(--radius-full);">
                            <?php echo esc_html($ee_dept_badge); ?>
                        </span>
                        <i class="<?php echo esc_attr($ee_dept_icon); ?>" style="color: var(--sibacom-techgreen); font-size: 1.25rem;"></i>
                    </div>
                    <div class="sibacom-org-logo-wrap">
                        <?php 
                        if (!empty($ee_dept_logo)) {
                            echo '<img src="' . esc_url($ee_dept_logo) . '" alt="' . esc_attr($ee_dept_title) . '" class="dept-logo ee-dept-logo" width="160" height="55" decoding="async" style="height:55px; max-height:55px; width:auto; max-width:160px; object-fit:contain;" />';
                        } elseif (function_exists('sibacom_the_ee_dept_logo')) {
                            sibacom_the_ee_dept_logo();
                        }
                        ?>
                    </div>
                    <h3 class="font-display" style="font-size: 1.35rem; margin-bottom: 0.75rem; color: var(--sibacom-text-primary);">
                        <?php echo esc_html($ee_dept_title); ?>
                    </h3>
                    <p style="font-size: 0.92rem; color: var(--sibacom-text-secondary); line-height: 1.65;">
                        <?php echo esc_html($ee_dept_desc); ?>
                    </p>
                </div>
                <div style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--sibacom-border);">
                    <span style="font-size: 0.8rem; font-weight: 600; color: var(--sibacom-techgreen);">
                        <i class="<?php echo esc_attr($ee_dept_footer_icon); ?>" style="margin-right: 0.35rem;"></i>
                        <?php echo esc_html($ee_dept_support); ?>
                    </span>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Sponsors Shortcode
     */
    public static function render_sponsors($atts) {
        $query = new WP_Query(array(
            'post_type'      => 'sibacom_sponsor',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'orderby'        => array('menu_order' => 'ASC', 'date' => 'ASC'),
        ));

        if ($query->have_posts() && !empty($query->posts)) {
            $sorted_posts = $query->posts;
            usort($sorted_posts, function($a, $b) {
                $id_a = is_object($a) ? $a->ID : (isset($a['ID']) ? $a['ID'] : 0);
                $id_b = is_object($b) ? $b->ID : (isset($b['ID']) ? $b['ID'] : 0);
                $mo_a = is_object($a) ? $a->menu_order : (isset($a['menu_order']) ? $a['menu_order'] : 0);
                $mo_b = is_object($b) ? $b->menu_order : (isset($b['menu_order']) ? $b['menu_order'] : 0);

                $order_a = get_post_meta($id_a, '_sibacom_sponsor_order', true);
                $order_b = get_post_meta($id_b, '_sibacom_sponsor_order', true);
                $val_a = ($order_a !== '' && $order_a !== false) ? intval($order_a) : $mo_a;
                $val_b = ($order_b !== '' && $order_b !== false) ? intval($order_b) : $mo_b;
                if ($val_a === $val_b) {
                    return $id_a <=> $id_b;
                }
                return $val_a <=> $val_b;
            });
            $query->posts = $sorted_posts;
        }

        ob_start();
        if ($query->have_posts()) :
            $sponsors_by_tier = array();
            while ($query->have_posts()) :
                $query->the_post();
                $tier = get_post_meta(get_the_ID(), '_sibacom_sponsor_tier', true) ?: 'Partners';
                $url  = get_post_meta(get_the_ID(), '_sibacom_sponsor_url', true);
                $logo = get_post_meta(get_the_ID(), '_sibacom_sponsor_logo', true);

                if (empty($logo) && has_post_thumbnail()) {
                    $logo = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                }

                $sponsors_by_tier[$tier][] = array(
                    'title' => get_the_title(),
                    'url'   => $url,
                    'logo'  => $logo,
                );
            endwhile;
            wp_reset_postdata();

            foreach ($sponsors_by_tier as $tier_name => $sponsors) :
                ?>
                <div class="sibacom-sponsors-tier">
                    <span class="sibacom-sponsors-tier-title"><?php echo esc_html($tier_name); ?></span>
                    <div class="sibacom-sponsors-grid">
                        <?php foreach ($sponsors as $s) : ?>
                            <a href="<?php echo !empty($s['url']) ? esc_url($s['url']) : '#'; ?>" target="_blank" rel="noopener noreferrer" class="sibacom-sponsor-card neu-card" title="<?php echo esc_attr($s['title']); ?>">
                                <?php if (!empty($s['logo'])) : ?>
                                    <img src="<?php echo esc_url($s['logo']); ?>" alt="<?php echo esc_attr($s['title']); ?>" width="160" height="55" loading="lazy" decoding="async">
                                <?php else : ?>
                                    <span class="font-display" style="font-weight: 700; color: var(--sibacom-primary); font-size: 1.1rem;"><?php echo esc_html($s['title']); ?></span>
                                <?php endif; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php
            endforeach;
        else :
            $theme_uri = defined('SIBACOM_THEME_URI') ? SIBACOM_THEME_URI : get_template_directory_uri();
            $default_sponsors = array(
                'Institutional & Title Partners' => array(
                    array('title' => 'Sukkur IBA University', 'url' => 'https://iba-suk.edu.pk', 'logo' => $theme_uri . '/assets/images/sukkur_iba_white_logo.png'),
                    array('title' => 'CSE Society', 'url' => home_url('/organizers/'), 'logo' => $theme_uri . '/assets/images/cse_society_logo_white.png'),
                    array('title' => 'EE Society', 'url' => home_url('/organizers/'), 'logo' => $theme_uri . '/assets/images/ee_society_logo_white.png'),
                ),
                'Academic & Laboratory Partners' => array(
                    array('title' => 'Department of CSE', 'url' => home_url('/organizers/#academic-partners'), 'logo' => $theme_uri . '/assets/images/cse_dept_logo.jpg'),
                    array('title' => 'Department of EE', 'url' => home_url('/organizers/#academic-partners'), 'logo' => $theme_uri . '/assets/images/ee_dept_logo.jpg'),
                ),
            );
            foreach ($default_sponsors as $tier_name => $sponsors) :
                ?>
                <div class="sibacom-sponsors-tier">
                    <span class="sibacom-sponsors-tier-title"><?php echo esc_html($tier_name); ?></span>
                    <div class="sibacom-sponsors-grid">
                        <?php foreach ($sponsors as $s) : ?>
                            <a href="<?php echo esc_url($s['url']); ?>" target="_blank" rel="noopener noreferrer" class="sibacom-sponsor-card neu-card" title="<?php echo esc_attr($s['title']); ?>" style="display: flex; align-items: center; justify-content: center; padding: 1.25rem;">
                                <?php if (!empty($s['logo'])) : ?>
                                    <img src="<?php echo esc_url($s['logo']); ?>" alt="<?php echo esc_attr($s['title']); ?>" width="160" height="55" loading="lazy" decoding="async" style="max-height: 48px; width: auto; object-fit: contain;">
                                <?php else : ?>
                                    <span class="font-display" style="font-weight: 700; color: var(--sibacom-primary); font-size: 1.1rem;"><?php echo esc_html($s['title']); ?></span>
                                <?php endif; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php
            endforeach;
        endif;

        return ob_get_clean();
    }

    /**
     * FAQ Shortcode
     */
    public static function render_faq($atts) {
        $query = new WP_Query(array(
            'post_type'      => 'sibacom_faq',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'orderby'        => array('menu_order' => 'ASC', 'date' => 'ASC'),
        ));

        if ($query->have_posts() && !empty($query->posts)) {
            $sorted_posts = $query->posts;
            usort($sorted_posts, function($a, $b) {
                $order_a = get_post_meta($a->ID, '_sibacom_faq_order', true);
                $order_b = get_post_meta($b->ID, '_sibacom_faq_order', true);
                $val_a = ($order_a !== '' && $order_a !== false) ? intval($order_a) : $a->menu_order;
                $val_b = ($order_b !== '' && $order_b !== false) ? intval($order_b) : $b->menu_order;
                if ($val_a === $val_b) {
                    return $a->ID <=> $b->ID;
                }
                return $val_a <=> $val_b;
            });
            $query->posts = $sorted_posts;
        }

        ob_start();
        if ($query->have_posts()) :
            ?>
            <div class="sibacom-accordion">
                <?php
                $count = 0;
                while ($query->have_posts()) :
                    $query->the_post();
                    $count++;
                    $is_first = ($count === 1) ? 'active' : '';
                    ?>
                    <div class="sibacom-accordion-item neu-card <?php echo esc_attr($is_first); ?>">
                        <div class="sibacom-accordion-header">
                            <span><?php the_title(); ?></span>
                            <div class="sibacom-accordion-icon">
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="sibacom-accordion-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <?php
        else :
            $default_faqs = array(
                array(
                    'q' => esc_html__('Who is eligible to participate in SIBACOM 2026?', 'sibacom-manager'),
                    'a' => esc_html__('Undergraduate and graduate students actively enrolled in recognized colleges and universities across Pakistan are eligible to participate in their chosen competitive tracks.', 'sibacom-manager'),
                ),
                array(
                    'q' => esc_html__('How are team registration and fee payments validated?', 'sibacom-manager'),
                    'a' => esc_html__('Registrations are submitted through the official portal. Upon submission, delegations receive a tracking slip and can confirm dues via online bank deposit or campus registration desks.', 'sibacom-manager'),
                ),
                array(
                    'q' => esc_html__('Can participants compete in more than one event track?', 'sibacom-manager'),
                    'a' => esc_html__('Yes, participants may compete in multiple tracks provided their respective competition sprint schedules and laboratory sessions do not conflict.', 'sibacom-manager'),
                ),
                array(
                    'q' => esc_html__('Will certificates and cash honors be provided to participants?', 'sibacom-manager'),
                    'a' => esc_html__('All registered participants receive official certificates of participation, while track winners and runners-up receive shields, trophies, and designated cash honoraria awarded at the Closing Ceremony.', 'sibacom-manager'),
                ),
            );
            ?>
            <div class="sibacom-accordion">
                <?php
                $f_count = 0;
                foreach ($default_faqs as $faq) :
                    $f_count++;
                    $f_first = ($f_count === 1) ? 'active' : '';
                    ?>
                    <div class="sibacom-accordion-item neu-card <?php echo esc_attr($f_first); ?>">
                        <div class="sibacom-accordion-header">
                            <span><?php echo esc_html($faq['q']); ?></span>
                            <div class="sibacom-accordion-icon">
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="sibacom-accordion-content">
                            <p><?php echo esc_html($faq['a']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php
        endif;

        return ob_get_clean();
    }

    /**
     * Contact Information Shortcode
     */
    public static function render_contact($atts = array()) {
        $atts = shortcode_atts(array(
            // Venue Card
            'show_venue'    => 'yes',
            'venue_title'   => get_option('sibacom_contact_venue_title', 'Event Venue Location'),
            'venue_icon'    => 'fa-solid fa-location-dot',
            'venue_address' => get_option('sibacom_contact_address', ''),
            'venue_sub'     => get_option('sibacom_contact_venue_sub', 'Accessible via Sukkur Airport & M-5 Motorway'),
            'venue_url'     => '',

            // Email Card
            'show_email'    => 'yes',
            'email_title'   => get_option('sibacom_contact_email_title', 'Electronic Mail'),
            'email_icon'    => 'fa-solid fa-envelope',
            'email_val'     => get_option('sibacom_contact_email', 'info@sibacom.tech'),
            'email_sub'     => get_option('sibacom_contact_email_sub', 'Official Secretariat Helpdesk'),
            'email_url'     => '',

            // Phone Card
            'show_phone'    => 'yes',
            'phone_title'   => get_option('sibacom_contact_phone_title', 'Telephone & Helpdesk'),
            'phone_icon'    => 'fa-solid fa-phone',
            'phone_val'     => get_option('sibacom_contact_phone', '03253171046'),
            'phone_sub'     => get_option('sibacom_contact_phone_sub', 'Mon – Fri, 09:00 AM – 05:00 PM PKT'),
            'phone_url'     => '',

            // Bug Report Card
            'show_bug'      => 'yes',
            'bug_title'     => get_option('sibacom_bug_contact_title', 'Bug Report'),
            'bug_icon'      => 'fa-solid fa-bug',
            'bug_name'      => get_option('sibacom_bug_contact_name', 'Jamshed Ali'),
            'bug_role'      => get_option('sibacom_bug_contact_role', 'Web Engineer _ SIBACOM EVENT'),
            'bug_email'     => get_option('sibacom_bug_contact_email', 'jamshed.ali@sibacom.tech'),
            'bug_desc'      => get_option('sibacom_bug_contact_desc', 'For users to report any website bugs or technical issues'),
            'bug_url'       => '',

            // Layout
            'columns'       => '4',
            'circuit'       => 'yes',
        ), $atts);

        // Visibility Booleans
        $show_venue  = in_array(strtolower((string)$atts['show_venue']), array('yes', '1', 'true'), true);
        $show_email  = in_array(strtolower((string)$atts['show_email']), array('yes', '1', 'true'), true);
        $show_phone  = in_array(strtolower((string)$atts['show_phone']), array('yes', '1', 'true'), true);
        $show_bug    = in_array(strtolower((string)$atts['show_bug']), array('yes', '1', 'true'), true);
        $has_circuit = in_array(strtolower((string)$atts['circuit']), array('yes', '1', 'true'), true);

        // Intelligent Address Fallback - Guaranteed to never be empty
        $address = !empty($atts['venue_address']) ? trim((string)$atts['venue_address']) : trim((string)get_option('sibacom_contact_address', ''));
        if (empty($address)) {
            $venue = get_option('sibacom_event_venue');
            $loc   = get_option('sibacom_event_location');
            if (!empty($venue) || !empty($loc)) {
                $address = trim($venue . ', ' . $loc, ', ');
            }
        }
        if (empty($address)) {
            $address = 'Sukkur IBA University, Airport Road, Sukkur, Sindh, Pakistan';
        }

        // Email Fallback
        $email = !empty($atts['email_val']) ? trim((string)$atts['email_val']) : trim((string)get_option('sibacom_contact_email', ''));
        if (empty($email)) {
            $email = 'info@sibacom.tech';
        }

        // Phone Fallback
        $phone = !empty($atts['phone_val']) ? trim((string)$atts['phone_val']) : trim((string)get_option('sibacom_contact_phone', ''));
        if (empty($phone)) {
            $phone = '03253171046';
        }

        // Bug Details Fallbacks
        $bug_title = !empty($atts['bug_title']) ? $atts['bug_title'] : 'Bug Report';
        $bug_name  = !empty($atts['bug_name']) ? $atts['bug_name'] : 'Jamshed Ali';
        $bug_role  = !empty($atts['bug_role']) ? $atts['bug_role'] : 'Web Engineer _ SIBACOM EVENT';
        $bug_email = !empty($atts['bug_email']) ? $atts['bug_email'] : 'jamshed.ali@sibacom.tech';
        $bug_desc  = !empty($atts['bug_desc']) ? $atts['bug_desc'] : 'For users to report any website bugs or technical issues';

        // Titles & Subtitles
        $venue_title = !empty($atts['venue_title']) ? $atts['venue_title'] : 'Event Venue Location';
        $venue_sub   = !empty($atts['venue_sub']) ? $atts['venue_sub'] : 'Accessible via Sukkur Airport & M-5 Motorway';
        $email_title = !empty($atts['email_title']) ? $atts['email_title'] : 'Electronic Mail';
        $email_sub   = !empty($atts['email_sub']) ? $atts['email_sub'] : 'Official Secretariat Helpdesk';
        $phone_title = !empty($atts['phone_title']) ? $atts['phone_title'] : 'Telephone & Helpdesk';
        $phone_sub   = !empty($atts['phone_sub']) ? $atts['phone_sub'] : 'Mon – Fri, 09:00 AM – 05:00 PM PKT';

        // Icons
        $venue_icon = !empty($atts['venue_icon']) ? $atts['venue_icon'] : 'fa-solid fa-location-dot';
        $email_icon = !empty($atts['email_icon']) ? $atts['email_icon'] : 'fa-solid fa-envelope';
        $phone_icon = !empty($atts['phone_icon']) ? $atts['phone_icon'] : 'fa-solid fa-phone';
        $bug_icon   = !empty($atts['bug_icon']) ? $atts['bug_icon'] : 'fa-solid fa-bug';

        $card_cls = 'neu-card' . ($has_circuit ? ' sibacom-card-circuit' : '');

        ob_start();
        ?>
        <div class="sibacom-contact-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.75rem; max-width: 1200px; margin: 0 auto;">
            <?php if ($show_venue) : ?>
            <div class="<?php echo esc_attr($card_cls); ?>" style="display: flex; flex-direction: column;">
                <?php if ($has_circuit && function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
                <div>
                    <div class="sibacom-highlight-icon"><i class="<?php echo esc_attr($venue_icon); ?>"></i></div>
                    <h3 class="font-display" style="font-size: 1.25rem; margin-bottom: 0.5rem; color: var(--sibacom-navy, #17233D);"><?php echo esc_html($venue_title); ?></h3>
                    <p style="font-size: 0.95rem; margin-bottom: 1rem; color: var(--sibacom-text-secondary, #64748B); line-height: 1.55;">
                        <?php if (!empty($atts['venue_url'])) : ?>
                            <a href="<?php echo esc_url($atts['venue_url']); ?>" target="_blank" rel="noopener noreferrer" style="color: inherit; text-decoration: none;">
                                <?php echo esc_html($address); ?>
                            </a>
                        <?php else : ?>
                            <?php echo esc_html($address); ?>
                        <?php endif; ?>
                    </p>
                </div>
                <div style="margin-top: auto; padding-top: 0.5rem;">
                    <span style="font-size: 0.82rem; font-weight: 600; color: var(--sibacom-techgreen, #079B58); display: block;">
                        <?php echo esc_html($venue_sub); ?>
                    </span>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($show_email) : ?>
            <div class="<?php echo esc_attr($card_cls); ?>" style="display: flex; flex-direction: column;">
                <?php if ($has_circuit && function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
                <div>
                    <div class="sibacom-highlight-icon"><i class="<?php echo esc_attr($email_icon); ?>"></i></div>
                    <h3 class="font-display" style="font-size: 1.25rem; margin-bottom: 0.5rem; color: var(--sibacom-navy, #17233D);"><?php echo esc_html($email_title); ?></h3>
                    <p style="font-size: 0.95rem; margin-bottom: 1rem;">
                        <a href="<?php echo !empty($atts['email_url']) ? esc_url($atts['email_url']) : 'mailto:' . esc_attr($email); ?>" style="font-weight: 600; color: var(--sibacom-primary, #173F91); word-break: break-all; text-decoration: none;"><?php echo esc_html($email); ?></a>
                    </p>
                </div>
                <div style="margin-top: auto; padding-top: 0.5rem;">
                    <span style="font-size: 0.82rem; font-weight: 600; color: var(--sibacom-techgreen, #079B58); display: block;">
                        <?php echo esc_html($email_sub); ?>
                    </span>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($show_phone) : ?>
            <div class="<?php echo esc_attr($card_cls); ?>" style="display: flex; flex-direction: column;">
                <?php if ($has_circuit && function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
                <div>
                    <div class="sibacom-highlight-icon"><i class="<?php echo esc_attr($phone_icon); ?>"></i></div>
                    <h3 class="font-display" style="font-size: 1.25rem; margin-bottom: 0.5rem; color: var(--sibacom-navy, #17233D);"><?php echo esc_html($phone_title); ?></h3>
                    <p style="font-size: 0.95rem; margin-bottom: 1rem;">
                        <a href="<?php echo !empty($atts['phone_url']) ? esc_url($atts['phone_url']) : 'tel:' . esc_attr($phone); ?>" style="font-weight: 600; color: var(--sibacom-primary, #173F91); text-decoration: none;"><?php echo esc_html($phone); ?></a>
                    </p>
                </div>
                <div style="margin-top: auto; padding-top: 0.5rem;">
                    <span style="font-size: 0.82rem; font-weight: 600; color: var(--sibacom-techgreen, #079B58); display: block;">
                        <?php echo esc_html($phone_sub); ?>
                    </span>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($show_bug) : ?>
            <div class="<?php echo esc_attr($card_cls); ?>" style="display: flex; flex-direction: column;">
                <?php if ($has_circuit && function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
                <div>
                    <div class="sibacom-highlight-icon"><i class="<?php echo esc_attr($bug_icon); ?>"></i></div>
                    <h3 class="font-display" style="font-size: 1.25rem; margin-bottom: 0.35rem; color: var(--sibacom-navy, #17233D);"><?php echo esc_html($bug_title); ?></h3>
                    <div style="margin-bottom: 0.6rem;">
                        <strong style="font-size: 1.02rem; color: var(--sibacom-navy, #17233D); display: block;"><?php echo esc_html($bug_name); ?></strong>
                        <span style="font-size: 0.8rem; font-weight: 700; color: var(--sibacom-techgreen, #079B58); text-transform: uppercase; letter-spacing: 0.04em; display: block; margin-top: 2px;">
                            <?php echo esc_html($bug_role); ?>
                        </span>
                    </div>
                    <p style="font-size: 0.95rem; margin-bottom: 1rem;">
                        <a href="<?php echo !empty($atts['bug_url']) ? esc_url($atts['bug_url']) : 'mailto:' . esc_attr($bug_email); ?>" style="font-weight: 600; color: var(--sibacom-primary, #173F91); word-break: break-all; text-decoration: none;"><?php echo esc_html($bug_email); ?></a>
                    </p>
                </div>
                <div style="margin-top: auto; padding-top: 0.5rem;">
                    <span style="font-size: 0.82rem; font-weight: 600; color: var(--sibacom-techgreen, #079B58); display: block;">
                        <?php echo esc_html($bug_desc); ?>
                    </span>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Final Call to Action Banner Shortcode
     */
    public static function render_cta_banner($atts) {
        $atts = shortcode_atts(array(
            'badge'      => 'Be Part of the Innovation Summit',
            'title'      => 'Join Over 1,500+ Innovators at SIBACOM',
            'subtitle'   => 'Represent your university, compete for national prestige and cash prizes, and showcase your engineering capabilities before industry leaders.',
            'btn_text'   => function_exists('sibacom_get_register_text') ? sibacom_get_register_text() : get_option('sibacom_header_cta_text', 'Register Now'),
            'btn_url'    => function_exists('sibacom_get_register_url') ? sibacom_get_register_url() : get_option('sibacom_header_cta_url', 'https://portal.sibacom.tech/'),
            'btn_target' => function_exists('sibacom_get_register_target') ? sibacom_get_register_target() : get_option('sibacom_header_cta_target', '_blank'),
        ), $atts);

        ob_start();
        $target_rel = ($atts['btn_target'] === '_blank') ? ' target="_blank" rel="noopener noreferrer"' : '';
        ?>
        <div class="neu-card sibacom-final-cta-card sibacom-card-circuit" style="background: linear-gradient(135deg, var(--sibacom-navy) 0%, var(--sibacom-primary) 100%); color: #fff; text-align: center; padding: 4.5rem 2rem; position: relative; overflow: hidden; border-radius: var(--radius-lg);">
            <?php if (function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
            <div style="position: absolute; right: -80px; bottom: -80px; width: 320px; height: 320px; border-radius: 50%; background: radial-gradient(circle, rgba(7, 155, 88, 0.25) 0%, transparent 70%); pointer-events: none;"></div>
            <div style="position: relative; z-index: 2; max-width: 720px; margin: 0 auto;">
                <span class="sibacom-badge" style="background: rgba(255, 255, 255, 0.12); color: #fff; border-color: rgba(255, 255, 255, 0.25); box-shadow: none; margin-bottom: 1.25rem;">
                    <span class="pulse-dot"></span>
                    <span><?php echo esc_html($atts['badge']); ?></span>
                </span>
                <h2 class="font-display" style="color: #fff; font-size: clamp(2rem, 4vw, 3rem); margin-bottom: 1.25rem; line-height: 1.2;">
                    <?php echo esc_html($atts['title']); ?>
                </h2>
                <p style="color: #CBD5E1; font-size: 1.1rem; line-height: 1.7; margin-bottom: 2.25rem;">
                    <?php echo esc_html($atts['subtitle']); ?>
                </p>
                <a href="<?php echo esc_url($atts['btn_url']); ?>"<?php echo $target_rel; ?> class="sibacom-btn sibacom-btn-tech" style="font-size: 1.05rem; padding: 1rem 2.5rem;">
                    <span><?php echo esc_html($atts['btn_text']); ?></span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Unified Portal Shortcode
     */
    public static function render_portal($atts) {
        $logo_url = function_exists('sibacom_get_logo_url') ? sibacom_get_logo_url() : (defined('SIBACOM_PLUGIN_URL') ? SIBACOM_PLUGIN_URL . 'assets/images/sibacom_logo.jpg' : 'theme/assets/images/sibacom_logo.jpg');
        ob_start();
        ?>
        <div class="sibacom-portal-wrapper" style="margin: 2rem 0;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.75rem;">
                <!-- Participant Portal -->
                <div class="neu-card" style="padding: 2rem; border-radius: 16px;">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 1rem;">
                        <div style="background: #03326A; padding: 3px; border-radius: 8px; display: inline-flex;">
                            <img src="<?php echo esc_url($logo_url); ?>" alt="SIBACOM" width="40" height="40" style="height: 40px; width: 40px; aspect-ratio: 1/1; border-radius: 6px; object-fit: contain; display: block;" />
                        </div>
                        <div>
                            <h4 style="margin: 0; font-size: 1.15rem; color: var(--sibacom-primary); font-weight: 800;"><?php esc_html_e('Participant Portal', 'sibacom-manager'); ?></h4>
                            <span style="font-size: 0.78rem; color: var(--sibacom-text-secondary);"><?php esc_html_e('Contestant & Team Access', 'sibacom-manager'); ?></span>
                        </div>
                    </div>
                    <p style="font-size: 0.9rem; color: var(--sibacom-text-secondary); line-height: 1.6; margin-bottom: 1.25rem;">
                        <?php esc_html_e('Access your verified delegate badge, review competition scheduling, and manage registered team teammates.', 'sibacom-manager'); ?>
                    </p>
                    <a href="portal.html#tab-participant" class="sibacom-btn sibacom-btn-primary" style="width: 100%; justify-content: center; font-size: 0.9rem;">
                        <span><?php esc_html_e('Sign In to Delegate Portal', 'sibacom-manager'); ?></span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Staff & Jury Portal -->
                <div class="neu-card" style="padding: 2rem; border-radius: 16px;">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 1rem;">
                        <div style="background: #03326A; padding: 3px; border-radius: 8px; display: inline-flex;">
                            <img src="<?php echo esc_url($logo_url); ?>" alt="SIBACOM" width="40" height="40" style="height: 40px; width: 40px; aspect-ratio: 1/1; border-radius: 6px; object-fit: contain; display: block;" />
                        </div>
                        <div>
                            <h4 style="margin: 0; font-size: 1.15rem; color: #102E68; font-weight: 800;"><?php esc_html_e('Staff & Secretariat', 'sibacom-manager'); ?></h4>
                            <span style="font-size: 0.78rem; color: var(--sibacom-text-secondary);"><?php esc_html_e('Campus Verification Desks', 'sibacom-manager'); ?></span>
                        </div>
                    </div>
                    <p style="font-size: 0.9rem; color: var(--sibacom-text-secondary); line-height: 1.6; margin-bottom: 1.25rem;">
                        <?php esc_html_e('Faculty jury scoring console, physical desk attendee check-in scanner, and accreditation credentials.', 'sibacom-manager'); ?>
                    </p>
                    <a href="portal.html#tab-staff" class="sibacom-btn sibacom-btn-secondary" style="width: 100%; justify-content: center; font-size: 0.9rem;">
                        <span><?php esc_html_e('Staff Accreditation Portal', 'sibacom-manager'); ?></span>
                        <i class="fa-solid fa-shield-halved"></i>
                    </a>
                </div>

                <!-- Payment Verification -->
                <div class="neu-card" style="padding: 2rem; border-radius: 16px;">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 1rem;">
                        <div style="background: #03326A; padding: 3px; border-radius: 8px; display: inline-flex;">
                            <img src="<?php echo esc_url($logo_url); ?>" alt="SIBACOM" width="40" height="40" style="height: 40px; width: 40px; aspect-ratio: 1/1; border-radius: 6px; object-fit: contain; display: block;" />
                        </div>
                        <div>
                            <h4 style="margin: 0; font-size: 1.15rem; color: #079B58; font-weight: 800;"><?php esc_html_e('Payment Verification', 'sibacom-manager'); ?></h4>
                            <span style="font-size: 0.78rem; color: var(--sibacom-text-secondary);"><?php esc_html_e('Bank Challan Confirmation', 'sibacom-manager'); ?></span>
                        </div>
                    </div>
                    <p style="font-size: 0.9rem; color: var(--sibacom-text-secondary); line-height: 1.6; margin-bottom: 1.25rem;">
                        <?php esc_html_e('Verify treasury confirmation status of your team fee deposit using your 12-character tracking reference.', 'sibacom-manager'); ?>
                    </p>
                    <a href="portal.html#tab-verification" class="sibacom-btn sibacom-btn-primary" style="width: 100%; justify-content: center; font-size: 0.9rem; background: linear-gradient(135deg, #079B58 0%, #03326A 100%);">
                        <span><?php esc_html_e('Verify Payment Status', 'sibacom-manager'); ?></span>
                        <i class="fa-solid fa-receipt"></i>
                    </a>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    public static function render_participant_portal($atts) {
        return self::render_portal($atts);
    }

    public static function render_staff_portal($atts) {
        return self::render_portal($atts);
    }

    public static function render_payment_verification($atts) {
        return self::render_portal($atts);
    }

    public static function render_registration_confirmation($atts) {
        return self::render_portal($atts);
    }

    public static function render_portal_login($atts) {
        return self::render_portal($atts);
    }
}

SIBACOM_Shortcodes::init();
