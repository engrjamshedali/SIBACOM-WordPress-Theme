<?php
/**
 * SIBACOM Homepage Manager View
 *
 * @package SIBACOM_Website_Manager
 */

if (!defined('ABSPATH')) {
    exit;
}

$hero_headline = get_option('sibacom_hero_headline', 'Connecting Ideas. Empowering Innovation. Building Tomorrow.');
$hero_subtitle = get_option('sibacom_hero_subtitle', 'Igniting Algorithmic Brilliance, Engineering Innovation & Technological Leadership.');
$hero_desc     = get_option('sibacom_hero_description', 'Pakistan’s premier collegiate technology festival convening top student programmers, robotics engineers, AI researchers, and startup founders for high-stakes competition at Sukkur IBA University.');
$hero_bg_url   = get_option('sibacom_hero_bg_image_url', '');
$header_cta_text = get_option('sibacom_header_cta_text', 'Register Now');
$header_cta_url  = get_option('sibacom_header_cta_url', 'https://iba-suk.edu.pk/sibacom/register');
$sec_cta_text    = get_option('sibacom_hero_secondary_cta_text', 'Explore Event Details');
$sec_cta_url     = get_option('sibacom_hero_secondary_cta_url', '#events');
$countdown_date  = get_option('sibacom_hero_countdown_date', '2026-11-30T09:00:00');

$pricing_badge = get_option('sibacom_pricing_sec_badge', 'Official Registrations & Fees');
$pricing_title = get_option('sibacom_pricing_sec_title', 'Event Registration & Competitive Categories');
$pricing_desc  = get_option('sibacom_pricing_sec_desc', 'Choose your competitive track, register your team, and confirm your participation in Pakistan’s premier technology summit.');

$spk_badge    = get_option('sibacom_speakers_sec_badge', 'Thought Leadership');
$spk_title    = get_option('sibacom_speakers_sec_title', 'Distinguished Speakers & Industry Jury');
$spk_desc     = get_option('sibacom_speakers_sec_desc', 'Learn from leading researchers, enterprise chief architects, and academic visionaries convening at Sukkur IBA University.');
$spk_cols     = get_option('sibacom_speakers_sec_columns', '4');
$spk_limit    = get_option('sibacom_speakers_sec_limit', '4');
$spk_btn_text = get_option('sibacom_speakers_sec_btn_text', 'View All Speakers & Judges');
$spk_btn_url  = get_option('sibacom_speakers_sec_btn_url', '/speakers/');

$hl_badge  = get_option('sibacom_highlights_badge', 'Competitive Tracks & Pillars');
$hl_title  = get_option('sibacom_highlights_title', 'Empowering Pakistan’s Next Generation of Technologists');
$hl_desc   = get_option('sibacom_highlights_desc', 'Explore high-impact competitive categories designed to challenge algorithmic mastery, engineering resilience, and technical vision.');

$sch_badge = get_option('sibacom_schedule_sec_badge', '1-Day Event Itinerary');
$sch_title = get_option('sibacom_schedule_sec_title', 'Program Schedule & Agenda');
$sch_desc  = get_option('sibacom_schedule_sec_desc', 'A comprehensive timeline of keynote sessions, competitive rounds, networking luncheons, and the grand closing ceremony.');

$gst_badge = get_option('sibacom_guests_sec_badge', 'Honorary Presence');
$gst_title = get_option('sibacom_guests_sec_title', 'Chief Guests & Distinguished Dignitaries');
$gst_desc  = get_option('sibacom_guests_sec_desc', 'Eminent academic leaders, government representatives, and institutional patrons presiding over SIBACOM 2026.');

$spn_badge = get_option('sibacom_sponsors_sec_badge', 'Industry Collaboration');
$spn_title = get_option('sibacom_sponsors_sec_title', 'Official Sponsors & Strategic Partners');
$spn_desc  = get_option('sibacom_sponsors_sec_desc', 'Proudly supported by leading technology conglomerates, research councils, and national innovation funds.');

$faq_badge = get_option('sibacom_faq_sec_badge', 'Common Inquiries');
$faq_title = get_option('sibacom_faq_sec_title', 'Frequently Asked Questions');
$faq_desc  = get_option('sibacom_faq_sec_desc', 'Find clear answers regarding participation eligibility, logistics, venue directions, and competition guidelines.');

$cnt_head  = get_option('sibacom_contact_heading', 'Get in Touch with SIBACOM Committee');
$cnt_desc  = get_option('sibacom_contact_description', 'Have questions regarding university delegations, sponsorship packages, or travel directions? Reach out to our secretariat.');
?>
<div class="wrap sibacom-admin-wrap">
    
    <div class="sibacom-admin-header">
        <div>
            <div class="sibacom-admin-badge">
                <span style="display:inline-block; width:8px; height:8px; border-radius:50%; background:#079B58;"></span>
                <span><?php esc_html_e('Homepage Control Hub', 'sibacom-manager'); ?></span>
            </div>
            <h1>
                <span class="dashicons dashicons-admin-home" style="font-size:28px;"></span>
                <span><?php esc_html_e('Homepage Manager', 'sibacom-manager'); ?></span>
            </h1>
            <p><?php esc_html_e('Enable, disable, and configure every core section of the public SIBACOM homepage.', 'sibacom-manager'); ?></p>
        </div>
        <div>
            <a href="<?php echo esc_url(home_url('/')); ?>" target="_blank" class="button button-secondary" style="font-weight:700;">
                <span class="dashicons dashicons-external" style="vertical-align:middle;"></span>
                <?php esc_html_e('View Live Homepage', 'sibacom-manager'); ?>
            </a>
        </div>
    </div>

    <form method="post" action="options.php">
        <?php
        settings_fields('sibacom_settings_group');
        do_settings_sections('sibacom_settings_group');
        ?>

        <!-- Section 1: Visibility & Ordering -->
        <div class="sibacom-panel-card" style="margin-bottom: 25px;">
            <h2><?php esc_html_e('Homepage Section Toggles (Enable / Disable)', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Easily control which sections appear on the homepage fallback template.', 'sibacom-manager'); ?></p>

            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row"><?php esc_html_e('Hero Section', 'sibacom-manager'); ?></th>
                        <td>
                            <label><input type="checkbox" name="sibacom_section_hero_enabled" value="1" <?php checked(get_option('sibacom_section_hero_enabled', '1'), '1'); ?> /> <?php esc_html_e('Display Top Hero Banner & Countdown', 'sibacom-manager'); ?></label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Event Information Cards', 'sibacom-manager'); ?></th>
                        <td>
                            <label><input type="checkbox" name="sibacom_section_info_enabled" value="1" <?php checked(get_option('sibacom_section_info_enabled', '1'), '1'); ?> /> <?php esc_html_e('Display 6 Neumorphic Event Information Cards (Date, Venue, Deadline, etc.)', 'sibacom-manager'); ?></label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Event Competitions & Pricing', 'sibacom-manager'); ?></th>
                        <td>
                            <label><input type="checkbox" name="sibacom_section_pricing_enabled" value="1" <?php checked(get_option('sibacom_section_pricing_enabled', '1'), '1'); ?> /> <?php esc_html_e('Display Dedicated Event Registration & Pricing Section', 'sibacom-manager'); ?></label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Highlights Section', 'sibacom-manager'); ?></th>
                        <td>
                            <label><input type="checkbox" name="sibacom_section_highlights_enabled" value="1" <?php checked(get_option('sibacom_section_highlights_enabled', '1'), '1'); ?> /> <?php esc_html_e('Display Pillars & Competitive Modules Grid', 'sibacom-manager'); ?></label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('About SIBACOM Section', 'sibacom-manager'); ?></th>
                        <td>
                            <label><input type="checkbox" name="sibacom_section_about_enabled" value="1" <?php checked(get_option('sibacom_section_about_enabled', '1'), '1'); ?> /> <?php esc_html_e('Display About, Vision, Mission & Campus Statistics', 'sibacom-manager'); ?></label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Schedule Preview', 'sibacom-manager'); ?></th>
                        <td>
                            <label><input type="checkbox" name="sibacom_section_schedule_enabled" value="1" <?php checked(get_option('sibacom_section_schedule_enabled', '1'), '1'); ?> /> <?php esc_html_e('Display Program Schedule Timeline Preview', 'sibacom-manager'); ?></label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Featured Speakers', 'sibacom-manager'); ?></th>
                        <td>
                            <label><input type="checkbox" name="sibacom_section_speakers_enabled" value="1" <?php checked(get_option('sibacom_section_speakers_enabled', '1'), '1'); ?> /> <?php esc_html_e('Display Distinguished Speakers & Jury Cards', 'sibacom-manager'); ?></label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Chief & Special Guests', 'sibacom-manager'); ?></th>
                        <td>
                            <label><input type="checkbox" name="sibacom_section_guests_enabled" value="1" <?php checked(get_option('sibacom_section_guests_enabled', '1'), '1'); ?> /> <?php esc_html_e('Display Distinguished Guests Section', 'sibacom-manager'); ?></label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Organizing Institutions & Academic Partners', 'sibacom-manager'); ?></th>
                        <td>
                            <label><input type="checkbox" name="sibacom_section_organizers_enabled" value="1" <?php checked(get_option('sibacom_section_organizers_enabled', '1'), '1'); ?> /> <?php esc_html_e('Display Joint Organizers (CSE Society & EE Society) and Academic Partners (Dept of CSE & Dept of EE)', 'sibacom-manager'); ?></label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Sponsors & Partners', 'sibacom-manager'); ?></th>
                        <td>
                            <label><input type="checkbox" name="sibacom_section_sponsors_enabled" value="1" <?php checked(get_option('sibacom_section_sponsors_enabled', '1'), '1'); ?> /> <?php esc_html_e('Display Categorized Sponsor Tiers', 'sibacom-manager'); ?></label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('FAQ Accordion', 'sibacom-manager'); ?></th>
                        <td>
                            <label><input type="checkbox" name="sibacom_section_faq_enabled" value="1" <?php checked(get_option('sibacom_section_faq_enabled', '1'), '1'); ?> /> <?php esc_html_e('Display Interactive Accordion for Inquiries', 'sibacom-manager'); ?></label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Final Participation CTA', 'sibacom-manager'); ?></th>
                        <td>
                            <label><input type="checkbox" name="sibacom_section_cta_enabled" value="1" <?php checked(get_option('sibacom_section_cta_enabled', '1'), '1'); ?> /> <?php esc_html_e('Display Grand Pre-Footer Registration Banner', 'sibacom-manager'); ?></label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Contact Information', 'sibacom-manager'); ?></th>
                        <td>
                            <label><input type="checkbox" name="sibacom_section_contact_enabled" value="1" <?php checked(get_option('sibacom_section_contact_enabled', '1'), '1'); ?> /> <?php esc_html_e('Display Contact Cards & Secretariat Helpdesk', 'sibacom-manager'); ?></label>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Section 2: Hero Section Settings -->
        <div class="sibacom-panel-card" style="margin-bottom: 25px;">
            <h2><?php esc_html_e('Hero Banner Content & Call to Actions', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Configure headline, description, countdown target, and buttons.', 'sibacom-manager'); ?></p>

            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row"><?php esc_html_e('Main Headline', 'sibacom-manager'); ?></th>
                        <td>
                            <input type="text" name="sibacom_hero_headline" value="<?php echo esc_attr($hero_headline); ?>" class="large-text" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Hero Subtitle', 'sibacom-manager'); ?></th>
                        <td>
                            <input type="text" name="sibacom_hero_subtitle" value="<?php echo esc_attr($hero_subtitle); ?>" class="large-text" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Description Paragraph', 'sibacom-manager'); ?></th>
                        <td>
                            <textarea name="sibacom_hero_description" rows="3" class="large-text"><?php echo esc_textarea($hero_desc); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Countdown Target Date', 'sibacom-manager'); ?></th>
                        <td>
                            <input type="text" name="sibacom_hero_countdown_date" value="<?php echo esc_attr($countdown_date); ?>" class="regular-text" />
                            <p class="description"><?php esc_html_e('Format: YYYY-MM-DDTHH:MM:SS (e.g. 2026-11-30T09:00:00)', 'sibacom-manager'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Primary Registration Button', 'sibacom-manager'); ?></th>
                        <td>
                            <label><input type="checkbox" name="sibacom_header_cta_enabled" value="1" <?php checked(get_option('sibacom_header_cta_enabled', '1'), '1'); ?> /> <?php esc_html_e('Enable Registration Button (Header, Mobile & Hero)', 'sibacom-manager'); ?></label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Primary Button Text', 'sibacom-manager'); ?></th>
                        <td>
                            <input type="text" name="sibacom_header_cta_text" value="<?php echo esc_attr($header_cta_text); ?>" class="regular-text" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Primary Button URL (Registration Link)', 'sibacom-manager'); ?></th>
                        <td>
                            <input type="url" name="sibacom_header_cta_url" value="<?php echo esc_attr($header_cta_url); ?>" class="large-text" placeholder="https://iba-suk.edu.pk/sibacom/register" />
                            <p class="description"><?php esc_html_e('Controls registration destinations across Header, Hero, Competitions Hub, Modal, and Final CTA.', 'sibacom-manager'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Primary Link Open Behavior', 'sibacom-manager'); ?></th>
                        <td>
                            <select name="sibacom_header_cta_target" style="min-width: 220px;">
                                <option value="_blank" <?php selected(get_option('sibacom_header_cta_target', '_blank'), '_blank'); ?>><?php esc_html_e('Open in New Tab (_blank)', 'sibacom-manager'); ?></option>
                                <option value="_self" <?php selected(get_option('sibacom_header_cta_target', '_blank'), '_self'); ?>><?php esc_html_e('Open in Same Tab (_self)', 'sibacom-manager'); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Secondary Button Text', 'sibacom-manager'); ?></th>
                        <td>
                            <input type="text" name="sibacom_hero_secondary_cta_text" value="<?php echo esc_attr($sec_cta_text); ?>" class="regular-text" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Secondary Button URL', 'sibacom-manager'); ?></th>
                        <td>
                            <input type="text" name="sibacom_hero_secondary_cta_url" value="<?php echo esc_attr($sec_cta_url); ?>" class="large-text" placeholder="#events or page link" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Background Campus Photograph', 'sibacom-manager'); ?></th>
                        <td>
                            <div style="display:flex; gap:10px; max-width:650px;">
                                <input type="text" id="sibacom_hero_bg_image_url" name="sibacom_hero_bg_image_url" value="<?php echo esc_attr($hero_bg_url); ?>" class="large-text" placeholder="https://..." />
                                <button type="button" class="button sibacom-media-upload-btn" data-target="#sibacom_hero_bg_image_url"><?php esc_html_e('Select Media', 'sibacom-manager'); ?></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Section 3: Pricing & Registration Section Header -->
        <div class="sibacom-panel-card" style="margin-bottom: 25px;">
            <h2><?php esc_html_e('Event Pricing & Registration Section Header', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Header narrative shown above the event cards on the homepage.', 'sibacom-manager'); ?></p>

            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row"><?php esc_html_e('Badge Tag', 'sibacom-manager'); ?></th>
                        <td>
                            <input type="text" name="sibacom_pricing_sec_badge" value="<?php echo esc_attr($pricing_badge); ?>" class="regular-text" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Section Title', 'sibacom-manager'); ?></th>
                        <td>
                            <input type="text" name="sibacom_pricing_sec_title" value="<?php echo esc_attr($pricing_title); ?>" class="large-text" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Section Subtitle / Description', 'sibacom-manager'); ?></th>
                        <td>
                            <textarea name="sibacom_pricing_sec_desc" rows="2" class="large-text"><?php echo esc_textarea($pricing_desc); ?></textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Section 4: Speakers & Industry Jury Section Settings -->
        <div class="sibacom-panel-card" style="margin-bottom: 25px;">
            <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px; margin-bottom:15px;">
                <div>
                    <h2 style="margin:0;"><?php esc_html_e('Distinguished Speakers & Industry Jury Section', 'sibacom-manager'); ?></h2>
                    <p class="subtitle" style="margin:4px 0 0;"><?php esc_html_e('Configure heading, grid layout, and profiles (2 Speakers + 2 Judges).', 'sibacom-manager'); ?></p>
                </div>
                <div style="display:flex; gap:8px;">
                    <a href="<?php echo esc_url(admin_url('edit.php?post_type=sibacom_speaker')); ?>" class="button button-secondary" target="_blank">
                        <span class="dashicons dashicons-groups" style="vertical-align:middle;"></span>
                        <?php esc_html_e('Manage All Profiles', 'sibacom-manager'); ?>
                    </a>
                    <a href="<?php echo esc_url(admin_url('post-new.php?post_type=sibacom_speaker')); ?>" class="button button-primary" target="_blank">
                        <span class="dashicons dashicons-plus-alt2" style="vertical-align:middle;"></span>
                        <?php esc_html_e('+ Add Speaker / Judge', 'sibacom-manager'); ?>
                    </a>
                </div>
            </div>

            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row"><?php esc_html_e('Badge Tag', 'sibacom-manager'); ?></th>
                        <td>
                            <input type="text" name="sibacom_speakers_sec_badge" value="<?php echo esc_attr($spk_badge); ?>" class="regular-text" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Section Title', 'sibacom-manager'); ?></th>
                        <td>
                            <input type="text" name="sibacom_speakers_sec_title" value="<?php echo esc_attr($spk_title); ?>" class="large-text" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Section Subtitle / Description', 'sibacom-manager'); ?></th>
                        <td>
                            <textarea name="sibacom_speakers_sec_desc" rows="2" class="large-text"><?php echo esc_textarea($spk_desc); ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Grid Columns Layout', 'sibacom-manager'); ?></th>
                        <td>
                            <select name="sibacom_speakers_sec_columns" class="regular-text">
                                <option value="4" <?php selected($spk_cols, '4'); ?>><?php esc_html_e('4 Columns (Recommended: 2 Speakers + 2 Judges in 1 Row)', 'sibacom-manager'); ?></option>
                                <option value="3" <?php selected($spk_cols, '3'); ?>><?php esc_html_e('3 Columns', 'sibacom-manager'); ?></option>
                                <option value="2" <?php selected($spk_cols, '2'); ?>><?php esc_html_e('2 Columns', 'sibacom-manager'); ?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Max Profiles to Display', 'sibacom-manager'); ?></th>
                        <td>
                            <input type="number" name="sibacom_speakers_sec_limit" value="<?php echo esc_attr($spk_limit); ?>" min="1" max="12" class="small-text" />
                            <p class="description"><?php esc_html_e('Default is 4 (2 speakers and 2 judges).', 'sibacom-manager'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Explore All Button Label', 'sibacom-manager'); ?></th>
                        <td>
                            <input type="text" name="sibacom_speakers_sec_btn_text" value="<?php echo esc_attr($spk_btn_text); ?>" class="regular-text" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Explore All Button URL', 'sibacom-manager'); ?></th>
                        <td>
                            <input type="text" name="sibacom_speakers_sec_btn_url" value="<?php echo esc_attr($spk_btn_url); ?>" class="regular-text" placeholder="/speakers/" />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Section 5: Highlights Section Header Settings -->
        <div class="sibacom-panel-card" style="margin-bottom: 25px;">
            <h2><?php esc_html_e('Event Highlights & Pillars Section Header', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Narrative displayed above the 6 Olympiad Competitive Pillars.', 'sibacom-manager'); ?></p>

            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row"><?php esc_html_e('Badge Tag', 'sibacom-manager'); ?></th>
                        <td><input type="text" name="sibacom_highlights_badge" value="<?php echo esc_attr($hl_badge); ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Section Title', 'sibacom-manager'); ?></th>
                        <td><input type="text" name="sibacom_highlights_title" value="<?php echo esc_attr($hl_title); ?>" class="large-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Section Subtitle / Description', 'sibacom-manager'); ?></th>
                        <td><textarea name="sibacom_highlights_desc" rows="2" class="large-text"><?php echo esc_textarea($hl_desc); ?></textarea></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Section 6: Schedule Section Header Settings -->
        <div class="sibacom-panel-card" style="margin-bottom: 25px;">
            <h2><?php esc_html_e('Event Schedule Section Header', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Narrative displayed above the agenda timeline preview on the homepage.', 'sibacom-manager'); ?></p>

            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row"><?php esc_html_e('Badge Tag', 'sibacom-manager'); ?></th>
                        <td><input type="text" name="sibacom_schedule_sec_badge" value="<?php echo esc_attr($sch_badge); ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Section Title', 'sibacom-manager'); ?></th>
                        <td><input type="text" name="sibacom_schedule_sec_title" value="<?php echo esc_attr($sch_title); ?>" class="large-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Section Subtitle / Description', 'sibacom-manager'); ?></th>
                        <td><textarea name="sibacom_schedule_sec_desc" rows="2" class="large-text"><?php echo esc_textarea($sch_desc); ?></textarea></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Section 7: Guests & Dignitaries Section Header Settings -->
        <div class="sibacom-panel-card" style="margin-bottom: 25px;">
            <h2><?php esc_html_e('Chief Guests & Dignitaries Section Header', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Narrative displayed above the honorary patrons and institutional leadership.', 'sibacom-manager'); ?></p>

            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row"><?php esc_html_e('Badge Tag', 'sibacom-manager'); ?></th>
                        <td><input type="text" name="sibacom_guests_sec_badge" value="<?php echo esc_attr($gst_badge); ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Section Title', 'sibacom-manager'); ?></th>
                        <td><input type="text" name="sibacom_guests_sec_title" value="<?php echo esc_attr($gst_title); ?>" class="large-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Section Subtitle / Description', 'sibacom-manager'); ?></th>
                        <td><textarea name="sibacom_guests_sec_desc" rows="2" class="large-text"><?php echo esc_textarea($gst_desc); ?></textarea></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Section 8: Sponsors & Partners Section Header Settings -->
        <div class="sibacom-panel-card" style="margin-bottom: 25px;">
            <h2><?php esc_html_e('Sponsors & Partners Section Header', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Narrative displayed above the partner logo galleries.', 'sibacom-manager'); ?></p>

            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row"><?php esc_html_e('Badge Tag', 'sibacom-manager'); ?></th>
                        <td><input type="text" name="sibacom_sponsors_sec_badge" value="<?php echo esc_attr($spn_badge); ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Section Title', 'sibacom-manager'); ?></th>
                        <td><input type="text" name="sibacom_sponsors_sec_title" value="<?php echo esc_attr($spn_title); ?>" class="large-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Section Subtitle / Description', 'sibacom-manager'); ?></th>
                        <td><textarea name="sibacom_sponsors_sec_desc" rows="2" class="large-text"><?php echo esc_textarea($spn_desc); ?></textarea></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Section 9: Frequently Asked Questions Header Settings -->
        <div class="sibacom-panel-card" style="margin-bottom: 25px;">
            <h2><?php esc_html_e('FAQ Section Header', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Narrative displayed above the interactive FAQ accordion.', 'sibacom-manager'); ?></p>

            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row"><?php esc_html_e('Badge Tag', 'sibacom-manager'); ?></th>
                        <td><input type="text" name="sibacom_faq_sec_badge" value="<?php echo esc_attr($faq_badge); ?>" class="regular-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Section Title', 'sibacom-manager'); ?></th>
                        <td><input type="text" name="sibacom_faq_sec_title" value="<?php echo esc_attr($faq_title); ?>" class="large-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Section Subtitle / Description', 'sibacom-manager'); ?></th>
                        <td><textarea name="sibacom_faq_sec_desc" rows="2" class="large-text"><?php echo esc_textarea($faq_desc); ?></textarea></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Section 10: Contact Section Header Settings -->
        <div class="sibacom-panel-card" style="margin-bottom: 25px;">
            <h2><?php esc_html_e('Contact Section Header', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Narrative displayed above the secretariat inquiry cards.', 'sibacom-manager'); ?></p>

            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row"><?php esc_html_e('Section Title', 'sibacom-manager'); ?></th>
                        <td><input type="text" name="sibacom_contact_heading" value="<?php echo esc_attr($cnt_head); ?>" class="large-text" /></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Section Subtitle / Description', 'sibacom-manager'); ?></th>
                        <td><textarea name="sibacom_contact_description" rows="2" class="large-text"><?php echo esc_textarea($cnt_desc); ?></textarea></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <?php submit_button(esc_html__('Save Homepage Configuration', 'sibacom-manager'), 'primary large'); ?>
    </form>
</div>

