<?php
/**
 * SIBACOM Homepage Content Fallback Part
 *
 * @package SIBACOM
 */

if (!defined('ABSPATH')) {
    exit;
}

$sec_hero_on       = get_option('sibacom_section_hero_enabled', '1') === '1';
$sec_info_on       = get_option('sibacom_section_info_enabled', '1') === '1';
$sec_pricing_on    = get_option('sibacom_section_pricing_enabled', '1') === '1';
$sec_about_on      = get_option('sibacom_section_about_enabled', '1') === '1';
$sec_highlights_on = get_option('sibacom_section_highlights_enabled', '1') === '1';
$sec_schedule_on   = get_option('sibacom_section_schedule_enabled', '1') === '1';
$sec_speakers_on   = get_option('sibacom_section_speakers_enabled', '1') === '1';
$sec_guests_on     = get_option('sibacom_section_guests_enabled', '1') === '1';
$sec_organizers_on = get_option('sibacom_section_organizers_enabled', '1') === '1';
$sec_sponsors_on   = get_option('sibacom_section_sponsors_enabled', '1') === '1';
$sec_faq_on        = get_option('sibacom_section_faq_enabled', '1') === '1';
$sec_cta_on        = get_option('sibacom_section_cta_enabled', '1') === '1';
$sec_contact_on    = get_option('sibacom_section_contact_enabled', '1') === '1';
?>
<div class="sibacom-home-wrapper sibacom-circuit-bg">

    <!-- 1. Hero Section -->
    <?php if ($sec_hero_on) : ?>
        <?php
        if (shortcode_exists('sibacom_hero')) {
            echo do_shortcode('[sibacom_hero]');
        } else {
            get_template_part('template-parts/content/content', 'hero-fallback');
        }
        ?>
    <?php endif; ?>

    <!-- 2. Event Information Cards -->
    <?php if ($sec_info_on) : ?>
        <section id="event-info" class="sibacom-section" style="padding-top: 1.5rem; padding-bottom: 2rem;">
            <div class="sibacom-container">
                <?php
                if (shortcode_exists('sibacom_info')) {
                    echo do_shortcode('[sibacom_info]');
                }
                ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- 3. Seven Event Cards (Competitions & Registration) -->
    <?php if ($sec_pricing_on) : ?>
        <section id="events" class="sibacom-section" style="background: var(--sibacom-white); border-top: 1px solid var(--sibacom-border-neu); border-bottom: 1px solid var(--sibacom-border-neu);">
            <div class="sibacom-container">
                <div class="sibacom-section-header">
                    <div class="sibacom-badge">
                        <span class="pulse-dot"></span>
                        <span><?php echo esc_html(get_option('sibacom_pricing_sec_badge', 'Official Registrations & Fees')); ?></span>
                    </div>
                    <h2 class="font-display"><?php echo esc_html(get_option('sibacom_pricing_sec_title', 'Event Registration & Competitive Categories')); ?></h2>
                    <p><?php echo esc_html(get_option('sibacom_pricing_sec_desc', 'Choose your competitive track, register your team, and confirm your participation in Pakistan’s premier technology summit.')); ?></p>
                </div>

                <?php
                if (shortcode_exists('sibacom_events')) {
                    echo do_shortcode('[sibacom_events limit="7" featured="yes" columns="3"]');
                }
                ?>

                <div class="text-center" style="margin-top: 2.5rem; display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
                    <a href="<?php echo esc_url(home_url('/competitions/')); ?>" class="sibacom-btn sibacom-btn-primary">
                        <span><?php esc_html_e('Explore All 9 Competitions & Cash Prizes', 'sibacom'); ?></span>
                        <i class="fa-solid fa-trophy"></i>
                    </a>
                    <a href="<?php echo esc_url(home_url('/competitions/#fee-calculator')); ?>" class="sibacom-btn sibacom-btn-secondary">
                        <span><?php esc_html_e('Fee Structure & Calculator', 'sibacom'); ?></span>
                        <i class="fa-solid fa-calculator"></i>
                    </a>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- 4. About SIBACOM Section -->
    <?php if ($sec_about_on) : ?>
        <section id="about" class="sibacom-section">
            <div class="sibacom-container">
                <?php
                if (shortcode_exists('sibacom_about')) {
                    echo do_shortcode('[sibacom_about]');
                }
                ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- 5. Event Highlights Section -->
    <?php if ($sec_highlights_on) : ?>
        <section id="highlights" class="sibacom-section" style="background: var(--sibacom-white); border-top: 1px solid var(--sibacom-border-neu); border-bottom: 1px solid var(--sibacom-border-neu);">
            <div class="sibacom-container">
                <div class="sibacom-section-header">
                    <div class="sibacom-badge">
                        <span class="pulse-dot"></span>
                        <span><?php echo esc_html(get_option('sibacom_highlights_badge', 'Competitive Tracks & Pillars')); ?></span>
                    </div>
                    <h2 class="font-display"><?php echo esc_html(get_option('sibacom_highlights_title', 'Empowering Pakistan’s Next Generation of Technologists')); ?></h2>
                    <p><?php echo esc_html(get_option('sibacom_highlights_desc', 'Explore high-impact competitive categories designed to challenge algorithmic mastery, engineering resilience, and technical vision.')); ?></p>
                </div>

                <?php
                if (shortcode_exists('sibacom_highlights')) {
                    echo do_shortcode('[sibacom_highlights]');
                }
                ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- 6. Event Schedule Preview -->
    <?php if ($sec_schedule_on) : ?>
        <section id="schedule" class="sibacom-section">
            <div class="sibacom-container">
                <div class="sibacom-section-header">
                    <div class="sibacom-badge">
                        <i class="fa-regular fa-clock" style="color: var(--sibacom-techgreen);"></i>
                        <span><?php echo esc_html(get_option('sibacom_schedule_sec_badge', '1-Day Event Itinerary')); ?></span>
                    </div>
                    <h2 class="font-display"><?php echo esc_html(get_option('sibacom_schedule_sec_title', 'Program Schedule & Agenda')); ?></h2>
                    <p><?php echo esc_html(get_option('sibacom_schedule_sec_desc', 'A comprehensive timeline of keynote sessions, competitive rounds, networking luncheons, and the grand closing ceremony.')); ?></p>
                </div>

                <?php
                if (shortcode_exists('sibacom_schedule')) {
                    echo do_shortcode('[sibacom_schedule limit="6"]');
                }
                ?>
                
                <div class="text-center" style="margin-top: 2.5rem;">
                    <a href="<?php echo esc_url(home_url('/schedule/')); ?>" class="sibacom-btn sibacom-btn-secondary">
                        <span><?php esc_html_e('View Full Schedule Timeline', 'sibacom'); ?></span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- 7. Featured Competition Judges & Industry Jury (4 Judges) -->
    <?php if ($sec_speakers_on) : ?>
        <?php
        $spk_badge    = get_option('sibacom_speakers_sec_badge', __('Expert Jury Panel', 'sibacom'));
        $spk_title    = get_option('sibacom_speakers_sec_title', __('Distinguished Competition Judges & Industry Jury', 'sibacom'));
        $spk_desc     = get_option('sibacom_speakers_sec_desc', __('Meet the esteemed evaluators, senior industry architects, and academic leaders presiding over the competitive tracks at Sukkur IBA University.', 'sibacom'));
        $spk_cols     = get_option('sibacom_speakers_sec_columns', '4');
        $spk_limit    = get_option('sibacom_speakers_sec_limit', '4');
        $spk_btn_text = get_option('sibacom_speakers_sec_btn_text', __('View All Speakers & Judges', 'sibacom'));
        $spk_btn_url  = get_option('sibacom_speakers_sec_btn_url', '/speakers/');
        ?>
        <section id="speakers" class="sibacom-section" style="background: var(--sibacom-white); border-top: 1px solid var(--sibacom-border-neu); border-bottom: 1px solid var(--sibacom-border-neu);">
            <div class="sibacom-container">
                <div class="sibacom-section-header">
                    <div class="sibacom-badge">
                        <i class="fa-solid fa-gavel" style="color: var(--sibacom-primary);"></i>
                        <span><?php echo esc_html($spk_badge); ?></span>
                    </div>
                    <h2 class="font-display"><?php echo esc_html($spk_title); ?></h2>
                    <p><?php echo esc_html($spk_desc); ?></p>
                </div>

                <?php
                if (shortcode_exists('sibacom_speakers')) {
                    echo do_shortcode('[sibacom_speakers featured="yes" limit="' . esc_attr($spk_limit) . '" columns="' . esc_attr($spk_cols) . '" role_type="judge" fallback="yes"]');
                }
                ?>

                <div class="text-center" style="margin-top: 2.5rem;">
                    <a href="<?php echo esc_url(home_url($spk_btn_url)); ?>" class="sibacom-btn sibacom-btn-secondary">
                        <span><?php echo esc_html($spk_btn_text); ?></span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- 8. Dignitaries & Guests -->
    <?php if ($sec_guests_on) : ?>
        <section id="guests" class="sibacom-section">
            <div class="sibacom-container">
                <div class="sibacom-section-header">
                    <div class="sibacom-badge">
                        <i class="fa-solid fa-award" style="color: var(--sibacom-techgreen);"></i>
                        <span><?php echo esc_html(get_option('sibacom_guests_sec_badge', __('Honorary Presence', 'sibacom'))); ?></span>
                    </div>
                    <h2 class="font-display"><?php echo esc_html(get_option('sibacom_guests_sec_title', __('Chief Guests & Distinguished Dignitaries', 'sibacom'))); ?></h2>
                    <p><?php echo esc_html(get_option('sibacom_guests_sec_desc', __('Eminent academic leaders, government representatives, and institutional patrons presiding over SIBACOM 2026.', 'sibacom'))); ?></p>
                </div>

                <?php
                if (shortcode_exists('sibacom_guests')) {
                    echo do_shortcode('[sibacom_guests limit="3" columns="3" fallback="yes"]');
                } else {
                    $theme_default_guests = array(
                        array(
                            'name'        => 'Prof. Dr. Asif Ahmed Shaikh',
                            'category'    => 'Chief Guest & Patron',
                            'designation' => 'Vice Chancellor',
                            'org'         => 'Sukkur IBA University',
                            'bio'         => 'Distinguished academician, scholar, and institutional leader steering Sukkur IBA University to premier national excellence in computing, engineering, and innovation.',
                            'photo_url'   => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80',
                            'linkedin'    => 'https://www.linkedin.com/school/sukkur-iba-university/',
                            'twitter'     => 'https://x.com',
                        ),
                        array(
                            'name'        => 'Engr. Zahid Hussain Khand',
                            'category'    => 'Guest of Honor',
                            'designation' => 'Registrar & Senior Engineer',
                            'org'         => 'Sukkur IBA University',
                            'bio'         => 'Esteemed engineering educator and institutional administrator spearheading academic governance, faculty collaboration, and technical capacity building across university campuses.',
                            'photo_url'   => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=400&q=80',
                            'linkedin'    => 'https://www.linkedin.com/school/sukkur-iba-university/',
                            'twitter'     => 'https://x.com',
                        ),
                        array(
                            'name'        => 'Dr. Sher Muhammad Daudpota',
                            'category'    => 'Distinguished Guest',
                            'designation' => 'Director QEC & Professor of Computer Science',
                            'org'         => 'Sukkur IBA University',
                            'bio'         => 'Senior computer scientist, research mentor, and academic leader overseeing university quality enhancement and fostering algorithmic problem solving and international research initiatives.',
                            'photo_url'   => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=400&q=80',
                            'linkedin'    => 'https://www.linkedin.com/school/sukkur-iba-university/',
                            'twitter'     => 'https://x.com',
                        ),
                    );
                    ?>
                    <div class="sibacom-speakers-grid sibacom-guests-grid col-3">
                        <?php foreach ($theme_default_guests as $g) : ?>
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
                    <?php
                }
                ?>

                <div class="text-center" style="margin-top: 2.5rem;">
                    <a href="<?php echo esc_url(home_url('/guests/')); ?>" class="sibacom-btn sibacom-btn-secondary">
                        <span><?php esc_html_e('View All Guests & Dignitaries', 'sibacom'); ?></span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- 9. Joint Primary Organizers & Academic Partners -->
    <?php if ($sec_organizers_on) : ?>
        <section id="organizers" class="sibacom-section" style="background: var(--sibacom-white); border-top: 1px solid var(--sibacom-border-neu); border-bottom: 1px solid var(--sibacom-border-neu);">
            <div class="sibacom-container">
                <div class="sibacom-section-header">
                    <div class="sibacom-badge">
                        <i class="fa-solid fa-users-gear" style="color: var(--sibacom-primary);"></i>
                        <span><?php echo esc_html(get_option('sibacom_organizers_sec_badge', 'Primary Event Organizers')); ?></span>
                    </div>
                    <h2 class="font-display"><?php echo esc_html(get_option('sibacom_organizers_sec_title', 'JOINTLY ORGANIZED BY')); ?></h2>
                    <p><?php echo esc_html(get_option('sibacom_organizers_sec_subtitle', 'Bringing together the Computer Systems Engineering and Electrical Engineering communities.')); ?></p>
                </div>

                <?php
                if (shortcode_exists('sibacom_organizers')) {
                    echo do_shortcode('[sibacom_organizers]');
                }
                ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- 10. Sponsors & Partners Section -->
    <?php if ($sec_sponsors_on) : ?>
        <section id="sponsors" class="sibacom-section">
            <div class="sibacom-container">
                <div class="sibacom-section-header">
                    <div class="sibacom-badge">
                        <i class="fa-regular fa-handshake" style="color: var(--sibacom-techgreen);"></i>
                        <span><?php echo esc_html(get_option('sibacom_sponsors_sec_badge', __('Industry Collaboration', 'sibacom'))); ?></span>
                    </div>
                    <h2 class="font-display"><?php echo esc_html(get_option('sibacom_sponsors_sec_title', __('Official Sponsors & Strategic Partners', 'sibacom'))); ?></h2>
                    <p><?php echo esc_html(get_option('sibacom_sponsors_sec_desc', __('Proudly supported by leading technology conglomerates, research councils, and national innovation funds.', 'sibacom'))); ?></p>
                </div>

                <?php
                if (shortcode_exists('sibacom_sponsors')) {
                    echo do_shortcode('[sibacom_sponsors]');
                }
                ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- 11. FAQ Section -->
    <?php if ($sec_faq_on) : ?>
        <section id="faq" class="sibacom-section" style="background: var(--sibacom-white); border-top: 1px solid var(--sibacom-border-neu); border-bottom: 1px solid var(--sibacom-border-neu);">
            <div class="sibacom-container">
                <div class="sibacom-section-header">
                    <div class="sibacom-badge">
                        <i class="fa-solid fa-circle-question" style="color: var(--sibacom-techgreen);"></i>
                        <span><?php echo esc_html(get_option('sibacom_faq_sec_badge', __('Common Inquiries', 'sibacom'))); ?></span>
                    </div>
                    <h2 class="font-display"><?php echo esc_html(get_option('sibacom_faq_sec_title', __('Frequently Asked Questions', 'sibacom'))); ?></h2>
                    <p><?php echo esc_html(get_option('sibacom_faq_sec_desc', __('Find clear answers regarding participation eligibility, logistics, venue directions, and competition guidelines.', 'sibacom'))); ?></p>
                </div>

                <?php
                if (shortcode_exists('sibacom_faq')) {
                    echo do_shortcode('[sibacom_faq]');
                }
                ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- 12. Event Participation CTA Banner -->
    <?php if ($sec_cta_on) : ?>
        <section class="sibacom-section" style="padding-top: 3.5rem; padding-bottom: 2rem;">
            <div class="sibacom-container">
                <?php
                if (shortcode_exists('sibacom_cta_banner')) {
                    echo do_shortcode('[sibacom_cta_banner]');
                }
                ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- 13. Contact Section -->
    <?php if ($sec_contact_on) : ?>
        <section id="contact" class="sibacom-section">
            <div class="sibacom-container">
                <div class="sibacom-section-header">
                    <div class="sibacom-badge">
                        <i class="fa-solid fa-envelope" style="color: var(--sibacom-techgreen);"></i>
                        <span><?php echo esc_html(get_option('sibacom_contact_badge', __('Secretariat Assistance', 'sibacom'))); ?></span>
                    </div>
                    <h2 class="font-display"><?php echo esc_html(get_option('sibacom_contact_heading', __('Get in Touch with SIBACOM Committee', 'sibacom'))); ?></h2>
                    <p><?php echo esc_html(get_option('sibacom_contact_description', __('Have questions regarding university delegations, sponsorship packages, or travel directions? Reach out to our secretariat.', 'sibacom'))); ?></p>
                </div>

                <?php
                if (shortcode_exists('sibacom_contact')) {
                    echo do_shortcode('[sibacom_contact]');
                }
                ?>
            </div>
        </section>
    <?php endif; ?>

    <!-- Ensure the_content hook is present for editor integration -->
    <div class="sibacom-page-the-content-wrapper" style="display:none;">
        <?php the_content(); ?>
    </div>

</div>
