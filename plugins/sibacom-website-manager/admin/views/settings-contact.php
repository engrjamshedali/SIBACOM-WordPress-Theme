<?php
/**
 * SIBACOM Contact Settings View
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
            <h1><?php esc_html_e('Contact Information Manager', 'sibacom-manager'); ?></h1>
            <p><?php esc_html_e('Configure official secretariat helpdesk email, phone, university address, directions, and bug reporting coordinates.', 'sibacom-manager'); ?></p>
        </div>
    </div>

    <form method="post" action="options.php">
        <?php settings_fields('sibacom_settings_group'); ?>

        <div class="sibacom-panel-card">
            <h2><?php esc_html_e('Contact Section Intro', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Header text shown in the contact section of the website.', 'sibacom-manager'); ?></p>

            <div class="sibacom-form-row">
                <label for="sibacom_contact_badge"><?php esc_html_e('Section Badge / Eyebrow:', 'sibacom-manager'); ?></label>
                <input type="text" id="sibacom_contact_badge" name="sibacom_contact_badge" value="<?php echo esc_attr(get_option('sibacom_contact_badge', 'Official Communications')); ?>" class="regular-text" />
            </div>

            <div class="sibacom-form-row">
                <label for="sibacom_contact_heading"><?php esc_html_e('Section Heading:', 'sibacom-manager'); ?></label>
                <input type="text" id="sibacom_contact_heading" name="sibacom_contact_heading" value="<?php echo esc_attr(get_option('sibacom_contact_heading', 'Get in Touch with SIBACOM Committee')); ?>" class="regular-text" />
            </div>

            <div class="sibacom-form-row">
                <label for="sibacom_contact_description"><?php esc_html_e('Section Description:', 'sibacom-manager'); ?></label>
                <textarea id="sibacom_contact_description" name="sibacom_contact_description" rows="3" class="large-text"><?php echo esc_textarea(get_option('sibacom_contact_description', 'Connect with our campus event coordinators for university delegator inquiries, venue travel routes, or event accreditation.')); ?></textarea>
            </div>
        </div>

        <div class="sibacom-panel-card">
            <h2><?php esc_html_e('Card 1: Venue & Location Coordinates', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Physical campus directions and address details.', 'sibacom-manager'); ?></p>

            <div class="sibacom-form-row">
                <label for="sibacom_contact_venue_title"><?php esc_html_e('Card Title:', 'sibacom-manager'); ?></label>
                <input type="text" id="sibacom_contact_venue_title" name="sibacom_contact_venue_title" value="<?php echo esc_attr(get_option('sibacom_contact_venue_title', 'Event Venue Location')); ?>" class="regular-text" />
            </div>

            <div class="sibacom-form-row">
                <label for="sibacom_contact_address"><?php esc_html_e('Physical Campus Address:', 'sibacom-manager'); ?></label>
                <input type="text" id="sibacom_contact_address" name="sibacom_contact_address" value="<?php echo esc_attr(get_option('sibacom_contact_address', 'Sukkur IBA University, Airport Road, Sukkur, Sindh, Pakistan')); ?>" class="large-text" />
            </div>

            <div class="sibacom-form-row">
                <label for="sibacom_contact_venue_sub"><?php esc_html_e('Footer Note / Subtitle:', 'sibacom-manager'); ?></label>
                <input type="text" id="sibacom_contact_venue_sub" name="sibacom_contact_venue_sub" value="<?php echo esc_attr(get_option('sibacom_contact_venue_sub', 'Accessible via Sukkur Airport & M-5 Motorway')); ?>" class="large-text" />
            </div>
        </div>

        <div class="sibacom-panel-card">
            <h2><?php esc_html_e('Card 2: Electronic Mail Secretariat', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Official email channels for delegations and inquiries.', 'sibacom-manager'); ?></p>

            <div class="sibacom-form-row">
                <label for="sibacom_contact_email_title"><?php esc_html_e('Card Title:', 'sibacom-manager'); ?></label>
                <input type="text" id="sibacom_contact_email_title" name="sibacom_contact_email_title" value="<?php echo esc_attr(get_option('sibacom_contact_email_title', 'Electronic Mail')); ?>" class="regular-text" />
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; max-width:650px;">
                <div class="sibacom-form-row">
                    <label for="sibacom_contact_email"><?php esc_html_e('Official Email Address:', 'sibacom-manager'); ?></label>
                    <input type="email" id="sibacom_contact_email" name="sibacom_contact_email" value="<?php echo esc_attr(get_option('sibacom_contact_email', 'info@sibacom.tech')); ?>" />
                </div>

                <div class="sibacom-form-row">
                    <label for="sibacom_contact_email_sub"><?php esc_html_e('Footer Note / Subtitle:', 'sibacom-manager'); ?></label>
                    <input type="text" id="sibacom_contact_email_sub" name="sibacom_contact_email_sub" value="<?php echo esc_attr(get_option('sibacom_contact_email_sub', 'Official Secretariat Helpdesk')); ?>" />
                </div>
            </div>
        </div>

        <div class="sibacom-panel-card">
            <h2><?php esc_html_e('Card 3: Telephone & Helpdesk Lines', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Direct phone lines, hours, and WhatsApp contact.', 'sibacom-manager'); ?></p>

            <div class="sibacom-form-row">
                <label for="sibacom_contact_phone_title"><?php esc_html_e('Card Title:', 'sibacom-manager'); ?></label>
                <input type="text" id="sibacom_contact_phone_title" name="sibacom_contact_phone_title" value="<?php echo esc_attr(get_option('sibacom_contact_phone_title', 'Telephone & Helpdesk')); ?>" class="regular-text" />
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; max-width:650px;">
                <div class="sibacom-form-row">
                    <label for="sibacom_contact_phone"><?php esc_html_e('Phone Number / Line:', 'sibacom-manager'); ?></label>
                    <input type="text" id="sibacom_contact_phone" name="sibacom_contact_phone" value="<?php echo esc_attr(get_option('sibacom_contact_phone', '03253171046')); ?>" />
                </div>

                <div class="sibacom-form-row">
                    <label for="sibacom_contact_phone_sub"><?php esc_html_e('Operating Hours / Subtitle:', 'sibacom-manager'); ?></label>
                    <input type="text" id="sibacom_contact_phone_sub" name="sibacom_contact_phone_sub" value="<?php echo esc_attr(get_option('sibacom_contact_phone_sub', 'Mon – Fri, 09:00 AM – 05:00 PM PKT')); ?>" />
                </div>
            </div>
        </div>

        <div class="sibacom-panel-card">
            <h2><?php esc_html_e('Card 4: Bug Report & Technical Lead', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Direct contact for users to report any website bugs or technical issues.', 'sibacom-manager'); ?></p>

            <div class="sibacom-form-row">
                <label for="sibacom_bug_contact_title"><?php esc_html_e('Card Title:', 'sibacom-manager'); ?></label>
                <input type="text" id="sibacom_bug_contact_title" name="sibacom_bug_contact_title" value="<?php echo esc_attr(get_option('sibacom_bug_contact_title', 'Bug Report')); ?>" class="regular-text" />
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; max-width:650px;">
                <div class="sibacom-form-row">
                    <label for="sibacom_bug_contact_name"><?php esc_html_e('Engineer / Lead Name:', 'sibacom-manager'); ?></label>
                    <input type="text" id="sibacom_bug_contact_name" name="sibacom_bug_contact_name" value="<?php echo esc_attr(get_option('sibacom_bug_contact_name', 'Jamshed Ali')); ?>" />
                </div>

                <div class="sibacom-form-row">
                    <label for="sibacom_bug_contact_role"><?php esc_html_e('Role / Designation:', 'sibacom-manager'); ?></label>
                    <input type="text" id="sibacom_bug_contact_role" name="sibacom_bug_contact_role" value="<?php echo esc_attr(get_option('sibacom_bug_contact_role', 'Web Engineer _ SIBACOM EVENT')); ?>" />
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; max-width:650px;">
                <div class="sibacom-form-row">
                    <label for="sibacom_bug_contact_email"><?php esc_html_e('Bug Report Email:', 'sibacom-manager'); ?></label>
                    <input type="email" id="sibacom_bug_contact_email" name="sibacom_bug_contact_email" value="<?php echo esc_attr(get_option('sibacom_bug_contact_email', 'jamshed.ali@sibacom.tech')); ?>" />
                </div>

                <div class="sibacom-form-row">
                    <label for="sibacom_bug_contact_desc"><?php esc_html_e('Bug Report Note / Description:', 'sibacom-manager'); ?></label>
                    <input type="text" id="sibacom_bug_contact_desc" name="sibacom_bug_contact_desc" value="<?php echo esc_attr(get_option('sibacom_bug_contact_desc', 'For users to report any website bugs or technical issues')); ?>" />
                </div>
            </div>
        </div>

        <p class="submit">
            <input type="submit" name="submit" class="button button-primary sibacom-btn-save" value="<?php esc_attr_e('Save Contact Information', 'sibacom-manager'); ?>" />
        </p>
    </form>
</div>
