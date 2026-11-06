<?php
/**
 * SIBACOM Event Information Cards Admin View
 *
 * @package SIBACOM_Website_Manager
 */

if (!defined('ABSPATH')) {
    exit;
}

$get_val = function($key, $default) {
    $val = get_option($key, '');
    return (!empty($val) || $val === '0') ? $val : $default;
};

$date_title = $get_val('sibacom_info_date_title', 'Event Dates');
$date_val   = $get_val('sibacom_info_date_val', 'Nov 30 – Dec 02, 2026');
$date_sub   = $get_val('sibacom_info_date_sub', '1-Day National Summit');
$date_pill  = $get_val('sibacom_info_date_pill', 'Official Dates');

$venue_title = $get_val('sibacom_info_venue_title', 'Event Venue');
$venue_val   = $get_val('sibacom_info_venue_val', 'Academic Block-III');
$venue_sub   = $get_val('sibacom_info_venue_sub', 'Sukkur IBA University');
$venue_pill  = $get_val('sibacom_info_venue_pill', 'Main Campus');

$dead_title = $get_val('sibacom_info_deadline_title', 'Registration Deadline');
$dead_val   = $get_val('sibacom_info_deadline_val', 'Nov 25, 2026');
$dead_sub   = $get_val('sibacom_info_deadline_sub', '11:59 PM PKT Strict Cutoff');
$dead_pill  = $get_val('sibacom_info_deadline_pill', 'Strict Cutoff');

$cat_title = $get_val('sibacom_info_category_title', 'Event Category');
$cat_val   = $get_val('sibacom_info_category_val', 'Tech Olympiad');
$cat_sub   = $get_val('sibacom_info_category_sub', '14+ Competitive Tracks');
$cat_pill  = $get_val('sibacom_info_category_pill', '14+ Tracks');

$part_title = $get_val('sibacom_info_participation_title', 'Participation');
$part_val   = $get_val('sibacom_info_participation_val', '1,500+ Innovators');
$part_sub   = $get_val('sibacom_info_participation_sub', '120+ Universities Nationwide');
$part_pill  = $get_val('sibacom_info_participation_pill', 'Nationwide');

$status_title = $get_val('sibacom_info_status_title', 'Registration Status');
$status_val   = $get_val('sibacom_info_status_val', 'Registration Open');
$status_sub   = $get_val('sibacom_info_status_sub', 'Verified Delegate Portals');
$status_pill  = $get_val('sibacom_info_status_pill', 'Live Now');
?>
<div class="wrap sibacom-admin-wrap">
    
    <div class="sibacom-admin-header">
        <div>
            <div class="sibacom-admin-badge">
                <span style="display:inline-block; width:8px; height:8px; border-radius:50%; background:#079B58;"></span>
                <span><?php esc_html_e('Section C Administration', 'sibacom-manager'); ?></span>
            </div>
            <h1>
                <span class="dashicons dashicons-info" style="font-size:28px;"></span>
                <span><?php esc_html_e('Event Information Cards', 'sibacom-manager'); ?></span>
            </h1>
            <p><?php esc_html_e('Configure the 6 prominent Neumorphic Information Cards rendered directly below the Hero section.', 'sibacom-manager'); ?></p>
        </div>
    </div>

    <form method="post" action="options.php">
        <?php
        settings_fields('sibacom_settings_group');
        do_settings_sections('sibacom_settings_group');
        ?>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 20px; margin-bottom: 25px;">
            <!-- Card 1: Event Date -->
            <div class="sibacom-panel-card">
                <h3><span class="dashicons dashicons-calendar-alt" style="color:#173F91;"></span> 1. Event Dates</h3>
                <p>
                    <label><strong><?php esc_html_e('Label Title:', 'sibacom-manager'); ?></strong></label><br>
                    <input type="text" name="sibacom_info_date_title" value="<?php echo esc_attr($date_title); ?>" class="regular-text" style="width:100%;" />
                </p>
                <p>
                    <label><strong><?php esc_html_e('Displayed Dates:', 'sibacom-manager'); ?></strong></label><br>
                    <input type="text" name="sibacom_info_date_val" value="<?php echo esc_attr($date_val); ?>" class="regular-text" style="width:100%;" />
                </p>
                <p>
                    <label><strong><?php esc_html_e('Subtitle / Tagline:', 'sibacom-manager'); ?></strong></label><br>
                    <input type="text" name="sibacom_info_date_sub" value="<?php echo esc_attr($date_sub); ?>" class="regular-text" style="width:100%;" />
                </p>
                <p>
                    <label><strong><?php esc_html_e('Pill Badge Text:', 'sibacom-manager'); ?></strong></label><br>
                    <input type="text" name="sibacom_info_date_pill" value="<?php echo esc_attr($date_pill); ?>" class="regular-text" style="width:100%;" />
                </p>
            </div>

            <!-- Card 2: Event Venue -->
            <div class="sibacom-panel-card">
                <h3><span class="dashicons dashicons-location" style="color:#079B58;"></span> 2. Event Venue</h3>
                <p>
                    <label><strong><?php esc_html_e('Label Title:', 'sibacom-manager'); ?></strong></label><br>
                    <input type="text" name="sibacom_info_venue_title" value="<?php echo esc_attr($venue_title); ?>" class="regular-text" style="width:100%;" />
                </p>
                <p>
                    <label><strong><?php esc_html_e('Displayed Venue:', 'sibacom-manager'); ?></strong></label><br>
                    <input type="text" name="sibacom_info_venue_val" value="<?php echo esc_attr($venue_val); ?>" class="regular-text" style="width:100%;" />
                </p>
                <p>
                    <label><strong><?php esc_html_e('Subtitle / Campus Info:', 'sibacom-manager'); ?></strong></label><br>
                    <input type="text" name="sibacom_info_venue_sub" value="<?php echo esc_attr($venue_sub); ?>" class="regular-text" style="width:100%;" />
                </p>
                <p>
                    <label><strong><?php esc_html_e('Pill Badge Text:', 'sibacom-manager'); ?></strong></label><br>
                    <input type="text" name="sibacom_info_venue_pill" value="<?php echo esc_attr($venue_pill); ?>" class="regular-text" style="width:100%;" />
                </p>
            </div>

            <!-- Card 3: Registration Deadline -->
            <div class="sibacom-panel-card">
                <h3><span class="dashicons dashicons-clock" style="color:#D97706;"></span> 3. Registration Deadline</h3>
                <p>
                    <label><strong><?php esc_html_e('Label Title:', 'sibacom-manager'); ?></strong></label><br>
                    <input type="text" name="sibacom_info_deadline_title" value="<?php echo esc_attr($dead_title); ?>" class="regular-text" style="width:100%;" />
                </p>
                <p>
                    <label><strong><?php esc_html_e('Displayed Deadline:', 'sibacom-manager'); ?></strong></label><br>
                    <input type="text" name="sibacom_info_deadline_val" value="<?php echo esc_attr($dead_val); ?>" class="regular-text" style="width:100%;" />
                </p>
                <p>
                    <label><strong><?php esc_html_e('Subtitle / Notice:', 'sibacom-manager'); ?></strong></label><br>
                    <input type="text" name="sibacom_info_deadline_sub" value="<?php echo esc_attr($dead_sub); ?>" class="regular-text" style="width:100%;" />
                </p>
                <p>
                    <label><strong><?php esc_html_e('Pill Badge Text:', 'sibacom-manager'); ?></strong></label><br>
                    <input type="text" name="sibacom_info_deadline_pill" value="<?php echo esc_attr($dead_pill); ?>" class="regular-text" style="width:100%;" />
                </p>
            </div>

            <!-- Card 4: Event Category -->
            <div class="sibacom-panel-card">
                <h3><span class="dashicons dashicons-tag" style="color:#102E68;"></span> 4. Event Category</h3>
                <p>
                    <label><strong><?php esc_html_e('Label Title:', 'sibacom-manager'); ?></strong></label><br>
                    <input type="text" name="sibacom_info_category_title" value="<?php echo esc_attr($cat_title); ?>" class="regular-text" style="width:100%;" />
                </p>
                <p>
                    <label><strong><?php esc_html_e('Displayed Category:', 'sibacom-manager'); ?></strong></label><br>
                    <input type="text" name="sibacom_info_category_val" value="<?php echo esc_attr($cat_val); ?>" class="regular-text" style="width:100%;" />
                </p>
                <p>
                    <label><strong><?php esc_html_e('Subtitle / Tracks Summary:', 'sibacom-manager'); ?></strong></label><br>
                    <input type="text" name="sibacom_info_category_sub" value="<?php echo esc_attr($cat_sub); ?>" class="regular-text" style="width:100%;" />
                </p>
                <p>
                    <label><strong><?php esc_html_e('Pill Badge Text:', 'sibacom-manager'); ?></strong></label><br>
                    <input type="text" name="sibacom_info_category_pill" value="<?php echo esc_attr($cat_pill); ?>" class="regular-text" style="width:100%;" />
                </p>
            </div>

            <!-- Card 5: Participation Information -->
            <div class="sibacom-panel-card">
                <h3><span class="dashicons dashicons-groups" style="color:#173F91;"></span> 5. Participation Info</h3>
                <p>
                    <label><strong><?php esc_html_e('Label Title:', 'sibacom-manager'); ?></strong></label><br>
                    <input type="text" name="sibacom_info_participation_title" value="<?php echo esc_attr($part_title); ?>" class="regular-text" style="width:100%;" />
                </p>
                <p>
                    <label><strong><?php esc_html_e('Displayed Figures:', 'sibacom-manager'); ?></strong></label><br>
                    <input type="text" name="sibacom_info_participation_val" value="<?php echo esc_attr($part_val); ?>" class="regular-text" style="width:100%;" />
                </p>
                <p>
                    <label><strong><?php esc_html_e('Subtitle / Scope:', 'sibacom-manager'); ?></strong></label><br>
                    <input type="text" name="sibacom_info_participation_sub" value="<?php echo esc_attr($part_sub); ?>" class="regular-text" style="width:100%;" />
                </p>
                <p>
                    <label><strong><?php esc_html_e('Pill Badge Text:', 'sibacom-manager'); ?></strong></label><br>
                    <input type="text" name="sibacom_info_participation_pill" value="<?php echo esc_attr($part_pill); ?>" class="regular-text" style="width:100%;" />
                </p>
            </div>

            <!-- Card 6: Registration Status -->
            <div class="sibacom-panel-card">
                <h3><span class="dashicons dashicons-yes-alt" style="color:#079B58;"></span> 6. Registration Status</h3>
                <p>
                    <label><strong><?php esc_html_e('Label Title:', 'sibacom-manager'); ?></strong></label><br>
                    <input type="text" name="sibacom_info_status_title" value="<?php echo esc_attr($status_title); ?>" class="regular-text" style="width:100%;" />
                </p>
                <p>
                    <label><strong><?php esc_html_e('Displayed Live Status:', 'sibacom-manager'); ?></strong></label><br>
                    <input type="text" name="sibacom_info_status_val" value="<?php echo esc_attr($status_val); ?>" class="regular-text" style="width:100%;" />
                </p>
                <p>
                    <label><strong><?php esc_html_e('Subtitle / Portal Link Note:', 'sibacom-manager'); ?></strong></label><br>
                    <input type="text" name="sibacom_info_status_sub" value="<?php echo esc_attr($status_sub); ?>" class="regular-text" style="width:100%;" />
                </p>
                <p>
                    <label><strong><?php esc_html_e('Pill Badge Text:', 'sibacom-manager'); ?></strong></label><br>
                    <input type="text" name="sibacom_info_status_pill" value="<?php echo esc_attr($status_pill); ?>" class="regular-text" style="width:100%;" />
                </p>
            </div>
        </div>

        <?php submit_button(esc_html__('Save Event Information Cards', 'sibacom-manager'), 'primary large'); ?>
    </form>
</div>
