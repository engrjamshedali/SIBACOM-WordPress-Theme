<?php
/**
 * SIBACOM Hero Section Settings View
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
            <h1><?php esc_html_e('Hero Section Manager', 'sibacom-manager'); ?></h1>
            <p><?php esc_html_e('Customize the visual landing banner, headline, campus background, CTA destinations, and event countdown.', 'sibacom-manager'); ?></p>
        </div>
    </div>

    <form method="post" action="options.php">
        <?php settings_fields('sibacom_settings_group'); ?>

        <div class="sibacom-panel-card">
            <h2><?php esc_html_e('Hero Headline & Messaging', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Visual typography and introduction displayed in the hero section.', 'sibacom-manager'); ?></p>

            <div class="sibacom-form-row">
                <label for="sibacom_hero_headline"><?php esc_html_e('Primary Headline:', 'sibacom-manager'); ?></label>
                <input type="text" id="sibacom_hero_headline" name="sibacom_hero_headline" value="<?php echo esc_attr(get_option('sibacom_hero_headline', 'Connecting Ideas. Empowering Innovation. Building Tomorrow.')); ?>" />
            </div>

            <div class="sibacom-form-row">
                <label for="sibacom_hero_subtitle"><?php esc_html_e('Supporting Subtitle:', 'sibacom-manager'); ?></label>
                <input type="text" id="sibacom_hero_subtitle" name="sibacom_hero_subtitle" value="<?php echo esc_attr(get_option('sibacom_hero_subtitle', 'Igniting Algorithmic Brilliance, Engineering Innovation & Technological Leadership.')); ?>" />
            </div>

            <div class="sibacom-form-row">
                <label for="sibacom_hero_description"><?php esc_html_e('Hero Description Body:', 'sibacom-manager'); ?></label>
                <textarea id="sibacom_hero_description" name="sibacom_hero_description" rows="3"><?php echo esc_textarea(get_option('sibacom_hero_description')); ?></textarea>
            </div>
        </div>

        <div class="sibacom-panel-card">
            <h2><?php esc_html_e('Campus Background Asset', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Sukkur IBA Academic Block 3 or custom hero background.', 'sibacom-manager'); ?></p>

            <div class="sibacom-form-row">
                <label><?php esc_html_e('Background Photo URL:', 'sibacom-manager'); ?></label>
                <div class="sibacom-media-row">
                    <input type="text" id="sibacom_hero_bg_image_url" name="sibacom_hero_bg_image_url" value="<?php echo esc_attr(get_option('sibacom_hero_bg_image_url')); ?>" placeholder="Leave blank to use Academic Block 3 photo bundled in theme" />
                    <button type="button" class="button sibacom-media-upload-btn" data-target="#sibacom_hero_bg_image_url"><?php esc_html_e('Choose Image', 'sibacom-manager'); ?></button>
                </div>
            </div>
        </div>

        <div class="sibacom-panel-card">
            <h2><?php esc_html_e('Calls to Action (CTAs)', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Configure button text, registration link destination, and target behavior.', 'sibacom-manager'); ?></p>

            <div class="sibacom-form-row">
                <label>
                    <input type="checkbox" name="sibacom_header_cta_enabled" value="1" <?php checked(get_option('sibacom_header_cta_enabled', '1'), '1'); ?> />
                    <strong><?php esc_html_e('Enable Primary Registration Button', 'sibacom-manager'); ?></strong>
                </label>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; max-width:650px;">
                <div class="sibacom-form-row">
                    <label for="sibacom_header_cta_text"><?php esc_html_e('Primary CTA Button Text:', 'sibacom-manager'); ?></label>
                    <input type="text" id="sibacom_header_cta_text" name="sibacom_header_cta_text" value="<?php echo esc_attr(get_option('sibacom_header_cta_text', 'Register Now')); ?>" />
                </div>

                <div class="sibacom-form-row">
                    <label for="sibacom_header_cta_target"><?php esc_html_e('Link Open Behavior:', 'sibacom-manager'); ?></label>
                    <select id="sibacom_header_cta_target" name="sibacom_header_cta_target" style="width: 100%; height: 38px;">
                        <option value="_blank" <?php selected(get_option('sibacom_header_cta_target', '_blank'), '_blank'); ?>><?php esc_html_e('Open in New Tab (_blank)', 'sibacom-manager'); ?></option>
                        <option value="_self" <?php selected(get_option('sibacom_header_cta_target', '_blank'), '_self'); ?>><?php esc_html_e('Open in Same Tab (_self)', 'sibacom-manager'); ?></option>
                    </select>
                </div>
            </div>

            <div class="sibacom-form-row">
                <label for="sibacom_header_cta_url"><?php esc_html_e('Primary CTA Destination URL (Registration Link):', 'sibacom-manager'); ?></label>
                <input type="url" id="sibacom_header_cta_url" name="sibacom_header_cta_url" value="<?php echo esc_attr(get_option('sibacom_header_cta_url', 'https://portal.sibacom.tech/')); ?>" style="max-width: 650px;" />
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; max-width:650px; margin-top: 15px; padding-top: 15px; border-top: 1px solid #E2E8F0;">
                <div class="sibacom-form-row">
                    <label for="sibacom_hero_secondary_cta_text"><?php esc_html_e('Secondary CTA Button Text:', 'sibacom-manager'); ?></label>
                    <input type="text" id="sibacom_hero_secondary_cta_text" name="sibacom_hero_secondary_cta_text" value="<?php echo esc_attr(get_option('sibacom_hero_secondary_cta_text', 'Explore Event Details')); ?>" />
                </div>

                <div class="sibacom-form-row">
                    <label for="sibacom_hero_secondary_cta_url"><?php esc_html_e('Secondary CTA Destination URL:', 'sibacom-manager'); ?></label>
                    <input type="text" id="sibacom_hero_secondary_cta_url" name="sibacom_hero_secondary_cta_url" value="<?php echo esc_attr(get_option('sibacom_hero_secondary_cta_url', '#events')); ?>" />
                </div>
            </div>
        </div>

        <div class="sibacom-panel-card">
            <h2><?php esc_html_e('Countdown Clock Target', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Target launch date and time for the real-time event countdown timer.', 'sibacom-manager'); ?></p>

            <div class="sibacom-form-row">
                <label for="sibacom_hero_countdown_date"><?php esc_html_e('Target Date & Time (ISO format YYYY-MM-DDTHH:MM:SS):', 'sibacom-manager'); ?></label>
                <input type="text" id="sibacom_hero_countdown_date" name="sibacom_hero_countdown_date" value="<?php echo esc_attr(get_option('sibacom_hero_countdown_date', '2026-11-30T09:00:00')); ?>" placeholder="e.g. 2026-11-30T09:00:00" />
            </div>
        </div>

        <p class="submit">
            <input type="submit" name="submit" class="button button-primary sibacom-btn-save" value="<?php esc_attr_e('Save Hero Configuration', 'sibacom-manager'); ?>" />
        </p>
    </form>
</div>
<?php

