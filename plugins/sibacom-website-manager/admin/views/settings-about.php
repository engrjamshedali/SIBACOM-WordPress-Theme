<?php
/**
 * SIBACOM About Section Settings View
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
            <h1><?php esc_html_e('About Section Manager', 'sibacom-manager'); ?></h1>
            <p><?php esc_html_e('Manage institutional narrative, mission, vision, and quantitative metrics counters.', 'sibacom-manager'); ?></p>
        </div>
    </div>

    <form method="post" action="options.php">
        <?php settings_fields('sibacom_settings_group'); ?>

        <div class="sibacom-panel-card">
            <h2><?php esc_html_e('Institutional Narrative', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Event introduction, vision, and mission.', 'sibacom-manager'); ?></p>

            <div class="sibacom-form-row">
                <label for="sibacom_about_title"><?php esc_html_e('About Section Main Heading:', 'sibacom-manager'); ?></label>
                <input type="text" id="sibacom_about_title" name="sibacom_about_title" value="<?php echo esc_attr(get_option('sibacom_about_title', 'Igniting Technology Leadership Across Pakistan')); ?>" />
            </div>

            <div class="sibacom-form-row">
                <label for="sibacom_about_description"><?php esc_html_e('About Description:', 'sibacom-manager'); ?></label>
                <textarea id="sibacom_about_description" name="sibacom_about_description" rows="4"><?php echo esc_textarea(get_option('sibacom_about_description')); ?></textarea>
            </div>

            <div class="sibacom-form-row">
                <label for="sibacom_about_vision"><?php esc_html_e('Institutional Vision Statement:', 'sibacom-manager'); ?></label>
                <textarea id="sibacom_about_vision" name="sibacom_about_vision" rows="3"><?php echo esc_textarea(get_option('sibacom_about_vision')); ?></textarea>
            </div>

            <div class="sibacom-form-row">
                <label for="sibacom_about_mission"><?php esc_html_e('Institutional Mission Statement:', 'sibacom-manager'); ?></label>
                <textarea id="sibacom_about_mission" name="sibacom_about_mission" rows="3"><?php echo esc_textarea(get_option('sibacom_about_mission')); ?></textarea>
            </div>
        </div>

        <div class="sibacom-panel-card">
            <h2><?php esc_html_e('Key Metrics & Quantitative Counters', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Highlight statistics displayed in the about section.', 'sibacom-manager'); ?></p>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; max-width:650px;">
                <div class="sibacom-form-row">
                    <label><?php esc_html_e('Stat 1 Number:', 'sibacom-manager'); ?></label>
                    <input type="text" name="sibacom_about_stat1_num" value="<?php echo esc_attr(get_option('sibacom_about_stat1_num', '120+')); ?>" />
                </div>
                <div class="sibacom-form-row">
                    <label><?php esc_html_e('Stat 1 Label:', 'sibacom-manager'); ?></label>
                    <input type="text" name="sibacom_about_stat1_label" value="<?php echo esc_attr(get_option('sibacom_about_stat1_label', 'Participating Universities')); ?>" />
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; max-width:650px;">
                <div class="sibacom-form-row">
                    <label><?php esc_html_e('Stat 2 Number:', 'sibacom-manager'); ?></label>
                    <input type="text" name="sibacom_about_stat2_num" value="<?php echo esc_attr(get_option('sibacom_about_stat2_num', '1,500+')); ?>" />
                </div>
                <div class="sibacom-form-row">
                    <label><?php esc_html_e('Stat 2 Label:', 'sibacom-manager'); ?></label>
                    <input type="text" name="sibacom_about_stat2_label" value="<?php echo esc_attr(get_option('sibacom_about_stat2_label', 'Student Innovators')); ?>" />
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; max-width:650px;">
                <div class="sibacom-form-row">
                    <label><?php esc_html_e('Stat 3 Number:', 'sibacom-manager'); ?></label>
                    <input type="text" name="sibacom_about_stat3_num" value="<?php echo esc_attr(get_option('sibacom_about_stat3_num', 'PKR 1.5M')); ?>" />
                </div>
                <div class="sibacom-form-row">
                    <label><?php esc_html_e('Stat 3 Label:', 'sibacom-manager'); ?></label>
                    <input type="text" name="sibacom_about_stat3_label" value="<?php echo esc_attr(get_option('sibacom_about_stat3_label', 'Total Prize Pool')); ?>" />
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; max-width:650px;">
                <div class="sibacom-form-row">
                    <label><?php esc_html_e('Stat 4 Number:', 'sibacom-manager'); ?></label>
                    <input type="text" name="sibacom_about_stat4_num" value="<?php echo esc_attr(get_option('sibacom_about_stat4_num', '14+')); ?>" />
                </div>
                <div class="sibacom-form-row">
                    <label><?php esc_html_e('Stat 4 Label:', 'sibacom-manager'); ?></label>
                    <input type="text" name="sibacom_about_stat4_label" value="<?php echo esc_attr(get_option('sibacom_about_stat4_label', 'Competition Modules')); ?>" />
                </div>
            </div>
        </div>

        <p class="submit">
            <input type="submit" name="submit" class="button button-primary sibacom-btn-save" value="<?php esc_attr_e('Save About Configuration', 'sibacom-manager'); ?>" />
        </p>
    </form>
</div>
<?php

