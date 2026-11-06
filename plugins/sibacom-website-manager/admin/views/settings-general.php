<?php
/**
 * SIBACOM General Settings View
 *
 * @package SIBACOM_Website_Manager
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<div class="wrap sibacom-admin-wrap">
    <div class="sibacom-admin-header">
        <div>
            <h1><?php esc_html_e('General Website Settings', 'sibacom-manager'); ?></h1>
            <p><?php esc_html_e('Manage core event information, institutional logos, contact credentials, and copyright text.', 'sibacom-manager'); ?></p>
        </div>
    </div>

    <form method="post" action="options.php">
        <?php
        settings_fields('sibacom_settings_group');
        ?>

        <!-- 1. Core Event Details -->
        <div class="sibacom-panel-card">
            <h2><?php esc_html_e('Event Identification', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Titles, dates, and venue coordinates.', 'sibacom-manager'); ?></p>

            <div class="sibacom-form-row">
                <label for="sibacom_event_name"><?php esc_html_e('Official Event Name (Must be SIBACOM):', 'sibacom-manager'); ?></label>
                <input type="text" id="sibacom_event_name" name="sibacom_event_name" value="<?php echo esc_attr(get_option('sibacom_event_name', 'SIBACOM')); ?>" required />
            </div>

            <div class="sibacom-form-row">
                <label for="sibacom_event_tagline"><?php esc_html_e('Event Tagline / Subtitle:', 'sibacom-manager'); ?></label>
                <input type="text" id="sibacom_event_tagline" name="sibacom_event_tagline" value="<?php echo esc_attr(get_option('sibacom_event_tagline', 'Sukkur IBA Annual Mega Olympiad & Innovation Competitions')); ?>" />
            </div>

            <div class="sibacom-form-row">
                <label for="sibacom_event_description"><?php esc_html_e('Event Description Summary:', 'sibacom-manager'); ?></label>
                <textarea id="sibacom_event_description" name="sibacom_event_description" rows="3"><?php echo esc_textarea(get_option('sibacom_event_description')); ?></textarea>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; max-width:650px;">
                <div class="sibacom-form-row">
                    <label for="sibacom_event_dates"><?php esc_html_e('Event Date Range Display:', 'sibacom-manager'); ?></label>
                    <input type="text" id="sibacom_event_dates" name="sibacom_event_dates" value="<?php echo esc_attr(get_option('sibacom_event_dates', 'November 30 – December 02, 2026')); ?>" />
                </div>

                <div class="sibacom-form-row">
                    <label for="sibacom_event_venue"><?php esc_html_e('Campus Venue Name:', 'sibacom-manager'); ?></label>
                    <input type="text" id="sibacom_event_venue" name="sibacom_event_venue" value="<?php echo esc_attr(get_option('sibacom_event_venue', 'Sukkur IBA University – Main Campus')); ?>" />
                </div>
            </div>

            <div class="sibacom-form-row">
                <label for="sibacom_event_location"><?php esc_html_e('Geographic Address / Location:', 'sibacom-manager'); ?></label>
                <input type="text" id="sibacom_event_location" name="sibacom_event_location" value="<?php echo esc_attr(get_option('sibacom_event_location', 'Airport Road, Sukkur, Sindh, Pakistan')); ?>" />
            </div>
        </div>

        <!-- 2. Official Registration Portal & Primary Call-to-Action (CTA) -->
        <div class="sibacom-panel-card" style="border-left: 4px solid #079B58;">
            <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
                <div>
                    <h2><?php esc_html_e('Official Registration Portal & Header CTA Button', 'sibacom-manager'); ?></h2>
                    <p class="subtitle"><?php esc_html_e('Single source of truth: controls the primary Register button, destination link, and target behavior across the whole website.', 'sibacom-manager'); ?></p>
                </div>
                <span class="sibacom-badge" style="background: rgba(7, 155, 88, 0.1); color: #079B58; border: 1px solid rgba(7, 155, 88, 0.3); font-weight: 700; padding: 4px 12px; border-radius: 20px; font-size: 0.82rem;">
                    <span class="dashicons dashicons-yes-alt" style="font-size: 16px; vertical-align: text-bottom; margin-right: 4px;"></span><?php esc_html_e('Active CTA Controller', 'sibacom-manager'); ?>
                </span>
            </div>

            <div class="sibacom-form-row" style="margin-top: 15px;">
                <label>
                    <input type="checkbox" name="sibacom_header_cta_enabled" value="1" <?php checked(get_option('sibacom_header_cta_enabled', '1'), '1'); ?> />
                    <strong><?php esc_html_e('Enable Registration Button in Header & Mobile Menu', 'sibacom-manager'); ?></strong>
                </label>
                <p class="description" style="color: #64748B; font-size: 0.85rem; margin-top: 4px;">
                    <?php esc_html_e('When enabled, the primary CTA button is prominently displayed in the site header and mobile navigation drawer.', 'sibacom-manager'); ?>
                </p>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; max-width:650px;">
                <div class="sibacom-form-row">
                    <label for="sibacom_header_cta_text"><strong><?php esc_html_e('Button Text / Label:', 'sibacom-manager'); ?></strong></label>
                    <input type="text" id="sibacom_header_cta_text" name="sibacom_header_cta_text" value="<?php echo esc_attr(get_option('sibacom_header_cta_text', 'Register Now')); ?>" placeholder="Register Now" />
                    <p class="description" style="color: #64748B; font-size: 0.82rem; margin-top: 4px;">
                        <?php esc_html_e('e.g. "Register Now", "Register for Event", "Join SIBACOM"', 'sibacom-manager'); ?>
                    </p>
                </div>

                <div class="sibacom-form-row">
                    <label for="sibacom_header_cta_target"><strong><?php esc_html_e('Link Open Behavior:', 'sibacom-manager'); ?></strong></label>
                    <select id="sibacom_header_cta_target" name="sibacom_header_cta_target" style="width: 100%; height: 38px;">
                        <option value="_blank" <?php selected(get_option('sibacom_header_cta_target', '_blank'), '_blank'); ?>><?php esc_html_e('Open in New Tab (_blank)', 'sibacom-manager'); ?></option>
                        <option value="_self" <?php selected(get_option('sibacom_header_cta_target', '_blank'), '_self'); ?>><?php esc_html_e('Open in Same Tab (_self)', 'sibacom-manager'); ?></option>
                    </select>
                </div>
            </div>

            <div class="sibacom-form-row">
                <label for="sibacom_header_cta_url"><strong><?php esc_html_e('Registration Portal URL / Link Destination:', 'sibacom-manager'); ?></strong></label>
                <input type="url" id="sibacom_header_cta_url" name="sibacom_header_cta_url" value="<?php echo esc_attr(get_option('sibacom_header_cta_url', 'https://portal.sibacom.tech/')); ?>" placeholder="https://portal.sibacom.tech/" style="width: 100%; max-width: 650px;" />
                <p class="description" style="color: #64748B; font-size: 0.85rem; margin-top: 4px;">
                    <?php esc_html_e('Full URL to your registration form, Google Form, or external ticketing portal. Updates Header, Mobile Drawer, Hero Banner, Competitions Hub, Modal Register button, and Final CTA Banner.', 'sibacom-manager'); ?>
                </p>
            </div>

            <div style="background: #F0FDF4; border: 1px solid #BBF7D0; border-radius: 8px; padding: 12px 16px; margin-top: 15px; font-size: 0.88rem; color: #166534; display: flex; align-items: flex-start; gap: 10px;">
                <span class="dashicons dashicons-info" style="color: #16A34A; margin-top: 2px;"></span>
                <span>
                    <strong><?php esc_html_e('Universal Synchronization:', 'sibacom-manager'); ?></strong> 
                    <?php esc_html_e('You can also edit this button in Appearance &rarr; Customize (&ldquo;SIBACOM Registration & CTA Button&rdquo;) or via the Homepage Manager. Changes made here apply instantly across all pages.', 'sibacom-manager'); ?>
                </span>
            </div>
        </div>

        <!-- 3. Official Branding Logos (Hierarchical Organization) -->
        <div class="sibacom-panel-card">
            <h2><?php esc_html_e('Official Branding & Institutional Logos', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Manage verified official logos for the overarching institution, joint organizing societies, and academic partners.', 'sibacom-manager'); ?></p>

            <!-- 0. Official SIBACOM Brand Asset -->
            <h3 style="font-size: 1.15rem; color: #03326A; margin: 1.25rem 0 0.75rem 0; padding-bottom: 0.35rem; border-bottom: 2px solid #03326A; display: flex; align-items: center; gap: 8px;">
                <span class="dashicons dashicons-shield-alt" style="color: #03326A;"></span>
                <span><?php esc_html_e('Primary Identity: Official SIBACOM Logo (Power to Progress)', 'sibacom-manager'); ?></span>
            </h3>

            <div class="sibacom-form-row">
                <label><?php esc_html_e('Official SIBACOM Logo Asset:', 'sibacom-manager'); ?></label>
                <div style="display: flex; gap: 16px; align-items: center; margin-bottom: 10px; flex-wrap: wrap;">
                    <div style="background: #03326A; padding: 4px; border-radius: 12px; box-shadow: 0 4px 14px rgba(3, 50, 106, 0.25); display: inline-flex;">
                        <img src="<?php echo esc_url(function_exists('sibacom_get_logo_url') ? sibacom_get_logo_url() : 'theme/assets/images/sibacom_logo.jpg'); ?>" alt="SIBACOM Official Logo Preview" width="64" height="64" style="height: 64px; width: 64px; aspect-ratio: 1/1; border-radius: 8px; object-fit: contain; display: block;" />
                    </div>
                    <div style="font-size: 0.85rem; color: #475569; line-height: 1.5;">
                        <strong style="color: #03326A;"><?php esc_html_e('Active Official Logo File:', 'sibacom-manager'); ?></strong> <code>sibacom_logo.jpg</code> (554x554 High-Res)<br>
                        <span><?php esc_html_e('Renders sharp on Retina displays, site header, hero banner, navigation, portals, dashboards, footer, and app icons.', 'sibacom-manager'); ?></span>
                    </div>
                </div>
                <div class="sibacom-media-row">
                    <input type="text" id="sibacom_official_logo_url" name="sibacom_official_logo_url" value="<?php echo esc_attr(get_option('sibacom_official_logo_url')); ?>" placeholder="Default bundled official logo will be used if empty" />
                    <button type="button" class="button sibacom-media-upload-btn" data-target="#sibacom_official_logo_url"><?php esc_html_e('Choose from Media', 'sibacom-manager'); ?></button>
                </div>
            </div>

            <!-- A. Institutional Identity -->
            <h3 style="font-size: 1.1rem; color: #173F91; margin: 1.5rem 0 0.75rem 0; padding-bottom: 0.35rem; border-bottom: 1px solid #E2E8F0;">
                <?php esc_html_e('A. Overarching Institutional Identity', 'sibacom-manager'); ?>
            </h3>
            
            <div class="sibacom-form-row">
                <label><?php esc_html_e('Sukkur IBA University Official Logo:', 'sibacom-manager'); ?></label>
                <div class="sibacom-media-row">
                    <input type="text" id="sibacom_university_logo_url" name="sibacom_university_logo_url" value="<?php echo esc_attr(get_option('sibacom_university_logo_url')); ?>" placeholder="Default bundled logo will be used if empty" />
                    <button type="button" class="button sibacom-media-upload-btn" data-target="#sibacom_university_logo_url"><?php esc_html_e('Choose from Media', 'sibacom-manager'); ?></button>
                </div>
            </div>

            <div class="sibacom-form-row">
                <label><?php esc_html_e('Sukkur IBA University White/Monochrome Logo (For Footer/Dark BG):', 'sibacom-manager'); ?></label>
                <div class="sibacom-media-row">
                    <input type="text" id="sibacom_university_logo_white_url" name="sibacom_university_logo_white_url" value="<?php echo esc_attr(get_option('sibacom_university_logo_white_url')); ?>" placeholder="Default bundled white logo will be used if empty" />
                    <button type="button" class="button sibacom-media-upload-btn" data-target="#sibacom_university_logo_white_url"><?php esc_html_e('Choose from Media', 'sibacom-manager'); ?></button>
                </div>
            </div>

            <!-- B. Joint Primary Organizers -->
            <h3 style="font-size: 1.1rem; color: #173F91; margin: 1.75rem 0 0.75rem 0; padding-bottom: 0.35rem; border-bottom: 1px solid #E2E8F0;">
                <?php esc_html_e('B. Joint Primary Organizers (Equal Prominence)', 'sibacom-manager'); ?>
            </h3>

            <div class="sibacom-form-row">
                <label><?php esc_html_e('CSE Society Official Logo (Joint Primary Organizer):', 'sibacom-manager'); ?></label>
                <div class="sibacom-media-row">
                    <input type="text" id="sibacom_cse_society_logo_url" name="sibacom_cse_society_logo_url" value="<?php echo esc_attr(get_option('sibacom_cse_society_logo_url', get_option('sibacom_society_logo_url'))); ?>" placeholder="Default bundled CSE Society logo will be used if empty" />
                    <button type="button" class="button sibacom-media-upload-btn" data-target="#sibacom_cse_society_logo_url"><?php esc_html_e('Choose from Media', 'sibacom-manager'); ?></button>
                </div>
            </div>

            <div class="sibacom-form-row">
                <label><?php esc_html_e('EE Society Official Logo (Joint Primary Organizer):', 'sibacom-manager'); ?></label>
                <div class="sibacom-media-row">
                    <input type="text" id="sibacom_ee_society_logo_url" name="sibacom_ee_society_logo_url" value="<?php echo esc_attr(get_option('sibacom_ee_society_logo_url')); ?>" placeholder="Upload official EE Society logo from Media Library" />
                    <button type="button" class="button sibacom-media-upload-btn" data-target="#sibacom_ee_society_logo_url"><?php esc_html_e('Choose from Media', 'sibacom-manager'); ?></button>
                </div>
                <p class="description" style="color: #64748B; font-size: 0.85rem; margin-top: 4px;">
                    <?php esc_html_e('Upload the original official EE Society logo. Proportions and dimensions are automatically aligned with the CSE Society logo to preserve 100% equal prominence.', 'sibacom-manager'); ?>
                </p>
            </div>

            <!-- C. Supporting Academic Partners -->
            <h3 style="font-size: 1.1rem; color: #102E68; margin: 1.75rem 0 0.75rem 0; padding-bottom: 0.35rem; border-bottom: 1px solid #E2E8F0;">
                <?php esc_html_e('C. Academic Partners (Departmental Affiliations)', 'sibacom-manager'); ?>
            </h3>

            <div class="sibacom-form-row">
                <label><?php esc_html_e('Department of Computer Systems Engineering Logo:', 'sibacom-manager'); ?></label>
                <div class="sibacom-media-row">
                    <input type="text" id="sibacom_cse_dept_logo_url" name="sibacom_cse_dept_logo_url" value="<?php echo esc_attr(get_option('sibacom_cse_dept_logo_url', get_option('sibacom_dept_logo_url'))); ?>" placeholder="Default bundled CSE Dept logo will be used if empty" />
                    <button type="button" class="button sibacom-media-upload-btn" data-target="#sibacom_cse_dept_logo_url"><?php esc_html_e('Choose from Media', 'sibacom-manager'); ?></button>
                </div>
            </div>

            <div class="sibacom-form-row">
                <label><?php esc_html_e('Department of Electrical Engineering Logo:', 'sibacom-manager'); ?></label>
                <div class="sibacom-media-row">
                    <input type="text" id="sibacom_ee_dept_logo_url" name="sibacom_ee_dept_logo_url" value="<?php echo esc_attr(get_option('sibacom_ee_dept_logo_url')); ?>" placeholder="Upload official EE Department logo from Media Library" />
                    <button type="button" class="button sibacom-media-upload-btn" data-target="#sibacom_ee_dept_logo_url"><?php esc_html_e('Choose from Media', 'sibacom-manager'); ?></button>
                </div>
                <p class="description" style="color: #64748B; font-size: 0.85rem; margin-top: 4px;">
                    <?php esc_html_e('Upload the official Department of Electrical Engineering logo for display in the Academic Partners section.', 'sibacom-manager'); ?>
                </p>
            </div>

            <!-- D. Student Governance -->
            <h3 style="font-size: 1.1rem; color: #64748B; margin: 1.75rem 0 0.75rem 0; padding-bottom: 0.35rem; border-bottom: 1px solid #E2E8F0;">
                <?php esc_html_e('D. Student Council (Coordination)', 'sibacom-manager'); ?>
            </h3>

            <div class="sibacom-form-row">
                <label><?php esc_html_e('SISC (Sukkur IBA Student Council) Logo:', 'sibacom-manager'); ?></label>
                <div class="sibacom-media-row">
                    <input type="text" id="sibacom_sisc_logo_url" name="sibacom_sisc_logo_url" value="<?php echo esc_attr(get_option('sibacom_sisc_logo_url')); ?>" placeholder="Default bundled logo will be used if empty" />
                    <button type="button" class="button sibacom-media-upload-btn" data-target="#sibacom_sisc_logo_url"><?php esc_html_e('Choose from Media', 'sibacom-manager'); ?></button>
                </div>
            </div>
        </div>

        <!-- 3. Official Contact & Social Media -->
        <div class="sibacom-panel-card">
            <h2><?php esc_html_e('Official Secretariat Contact & Social Handles', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Contact channels shown in the header, footer, and contact section.', 'sibacom-manager'); ?></p>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; max-width:650px;">
                <div class="sibacom-form-row">
                    <label for="sibacom_contact_email"><?php esc_html_e('Support / Official Email:', 'sibacom-manager'); ?></label>
                    <input type="email" id="sibacom_contact_email" name="sibacom_contact_email" value="<?php echo esc_attr(get_option('sibacom_contact_email', 'sibacom@iba-suk.edu.pk')); ?>" />
                </div>

                <div class="sibacom-form-row">
                    <label for="sibacom_contact_phone"><?php esc_html_e('Official Contact Phone:', 'sibacom-manager'); ?></label>
                    <input type="text" id="sibacom_contact_phone" name="sibacom_contact_phone" value="<?php echo esc_attr(get_option('sibacom_contact_phone', '+92 71 5644000')); ?>" />
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; max-width:650px;">
                <div class="sibacom-form-row">
                    <label for="sibacom_social_linkedin"><?php esc_html_e('LinkedIn URL:', 'sibacom-manager'); ?></label>
                    <input type="url" id="sibacom_social_linkedin" name="sibacom_social_linkedin" value="<?php echo esc_attr(get_option('sibacom_social_linkedin', 'https://www.linkedin.com/school/sukkur-iba-university/')); ?>" />
                </div>

                <div class="sibacom-form-row">
                    <label for="sibacom_social_twitter"><?php esc_html_e('Twitter / X URL:', 'sibacom-manager'); ?></label>
                    <input type="url" id="sibacom_social_twitter" name="sibacom_social_twitter" value="<?php echo esc_attr(get_option('sibacom_social_twitter', 'https://twitter.com')); ?>" />
                </div>
            </div>

            <div class="sibacom-form-row">
                <label for="sibacom_copyright_text"><?php esc_html_e('Copyright Line:', 'sibacom-manager'); ?></label>
                <input type="text" id="sibacom_copyright_text" name="sibacom_copyright_text" value="<?php echo esc_attr(get_option('sibacom_copyright_text', '© 2026 SIBACOM – Sukkur IBA University. All Rights Reserved.')); ?>" />
            </div>
        </div>

        <p class="submit">
            <input type="submit" name="submit" id="submit" class="button button-primary sibacom-btn-save" value="<?php esc_attr_e('Save General Settings', 'sibacom-manager'); ?>" />
        </p>
    </form>
</div>
<?php

