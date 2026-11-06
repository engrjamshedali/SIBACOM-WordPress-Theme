<?php
/**
 * SIBACOM Footer Settings View
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
            <h1><?php esc_html_e('Footer Manager', 'sibacom-manager'); ?></h1>
            <p><?php esc_html_e('Customize institutional footer narrative, quick links, and copyright notices.', 'sibacom-manager'); ?></p>
        </div>
    </div>

    <form method="post" action="options.php">
        <?php settings_fields('sibacom_settings_group'); ?>

        <div class="sibacom-panel-card">
            <h2><?php esc_html_e('Footer Narrative & Copyright', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Displayed in the global footer on all pages.', 'sibacom-manager'); ?></p>

            <div class="sibacom-form-row">
                <label for="sibacom_footer_description"><?php esc_html_e('Footer Event Description:', 'sibacom-manager'); ?></label>
                <textarea id="sibacom_footer_description" name="sibacom_footer_description" rows="3"><?php echo esc_textarea(get_option('sibacom_footer_description', 'SIBACOM (Sukkur IBA Annual Mega Olympiad) is the flagship collegiate technology festival, computing symposium, and engineering championship presented by Sukkur IBA University, jointly organized by the Computer Systems Engineering Society (CSE Society) and the Electrical Engineering Society (EE Society), supported by academic partners: Department of Computer Systems Engineering and Department of Electrical Engineering.')); ?></textarea>
            </div>

            <div class="sibacom-form-row">
                <label for="sibacom_copyright_text"><?php esc_html_e('Copyright Line:', 'sibacom-manager'); ?></label>
                <input type="text" id="sibacom_copyright_text" name="sibacom_copyright_text" value="<?php echo esc_attr(get_option('sibacom_copyright_text', '© 2026 SIBACOM – Sukkur IBA University. All Rights Reserved.')); ?>" />
            </div>
        </div>

        <p class="submit">
            <input type="submit" name="submit" class="button button-primary sibacom-btn-save" value="<?php esc_attr_e('Save Footer Configuration', 'sibacom-manager'); ?>" />
        </p>
    </form>
</div>
<?php

