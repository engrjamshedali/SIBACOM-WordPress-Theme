<?php
/**
 * SIBACOM Admin Dashboard Overview View
 *
 * @package SIBACOM_Website_Manager
 */

if (!defined('ABSPATH')) {
    exit;
}

$count_events   = wp_count_posts('sibacom_event')->publish;
$count_sessions = wp_count_posts('sibacom_session')->publish;
$count_speakers = wp_count_posts('sibacom_speaker')->publish;
$count_sponsors = wp_count_posts('sibacom_sponsor')->publish;
$count_faqs     = wp_count_posts('sibacom_faq')->publish;

$event_name   = get_option('sibacom_event_name', 'SIBACOM');
$event_dates  = get_option('sibacom_event_dates', 'November 30 – December 02, 2026');
$event_venue  = get_option('sibacom_event_venue', 'Sukkur IBA University – Main Campus');
$cta_url      = get_option('sibacom_header_cta_url', 'https://portal.sibacom.tech/');
?>
<div class="wrap sibacom-admin-wrap">
    
    <!-- Top Header Card -->
    <div class="sibacom-admin-header">
        <div style="display: flex; align-items: center; gap: 18px; flex-wrap: wrap;">
            <div style="background: #03326A; border-radius: 12px; padding: 4px; box-shadow: 0 4px 14px rgba(3, 50, 106, 0.3); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <img src="<?php echo esc_url(function_exists('sibacom_get_logo_url') ? sibacom_get_logo_url() : (defined('SIBACOM_PLUGIN_URL') ? SIBACOM_PLUGIN_URL . 'assets/images/sibacom_logo.jpg' : 'plugins/sibacom-website-manager/assets/images/sibacom_logo.jpg')); ?>" alt="SIBACOM Official Logo" width="60" height="60" style="height: 60px; width: 60px; aspect-ratio: 1/1; border-radius: 8px; object-fit: contain; display: block;" />
            </div>
            <div>
                <div class="sibacom-admin-badge">
                    <span style="display:inline-block; width:8px; height:8px; border-radius:50%; background:#079B58;"></span>
                    <span>Sukkur IBA University &bull; Technology Circuit</span>
                </div>
                <h1 style="margin: 4px 0;">
                    <span><?php echo esc_html($event_name); ?> Website Manager</span>
                </h1>
                <p><?php esc_html_e('Centralized content administration for public-facing event pages, schedule sessions, speakers, pricing, and sponsors.', 'sibacom-manager'); ?></p>
            </div>
        </div>
        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <a href="<?php echo esc_url(admin_url('admin.php?page=sibacom-homepage')); ?>" class="button button-primary" style="font-weight:700; padding:6px 16px; border-radius:8px;">
                <span class="dashicons dashicons-admin-home" style="vertical-align:middle; margin-right:4px;"></span>
                <?php esc_html_e('Homepage Manager', 'sibacom-manager'); ?>
            </a>
            <a href="<?php echo esc_url(admin_url('admin.php?page=sibacom-demo-import')); ?>" class="button button-secondary" style="font-weight:700; padding:6px 16px; border-radius:8px;">
                <span class="dashicons dashicons-download" style="vertical-align:middle; margin-right:4px;"></span>
                <?php esc_html_e('Demo Import', 'sibacom-manager'); ?>
            </a>
        </div>
    </div>

    <!-- Metric Overview Cards -->
    <div class="sibacom-stats-grid">
        <div class="sibacom-stat-card">
            <div class="sibacom-stat-icon">
                <span class="dashicons dashicons-tickets-alt"></span>
            </div>
            <div>
                <span class="sibacom-stat-number"><?php echo esc_html($count_events); ?></span>
                <span class="sibacom-stat-label"><?php esc_html_e('Events & Pricing', 'sibacom-manager'); ?></span>
            </div>
        </div>

        <div class="sibacom-stat-card">
            <div class="sibacom-stat-icon">
                <span class="dashicons dashicons-clock"></span>
            </div>
            <div>
                <span class="sibacom-stat-number"><?php echo esc_html($count_sessions); ?></span>
                <span class="sibacom-stat-label"><?php esc_html_e('Schedule Sessions', 'sibacom-manager'); ?></span>
            </div>
        </div>

        <div class="sibacom-stat-card">
            <div class="sibacom-stat-icon">
                <span class="dashicons dashicons-businessperson"></span>
            </div>
            <div>
                <span class="sibacom-stat-number"><?php echo esc_html($count_speakers); ?></span>
                <span class="sibacom-stat-label"><?php esc_html_e('Speakers & Guests', 'sibacom-manager'); ?></span>
            </div>
        </div>

        <div class="sibacom-stat-card">
            <div class="sibacom-stat-icon">
                <span class="dashicons dashicons-awards"></span>
            </div>
            <div>
                <span class="sibacom-stat-number"><?php echo esc_html($count_sponsors); ?></span>
                <span class="sibacom-stat-label"><?php esc_html_e('Sponsors & Partners', 'sibacom-manager'); ?></span>
            </div>
        </div>

        <div class="sibacom-stat-card">
            <div class="sibacom-stat-icon">
                <span class="dashicons dashicons-editor-help"></span>
            </div>
            <div>
                <span class="sibacom-stat-number"><?php echo esc_html($count_faqs); ?></span>
                <span class="sibacom-stat-label"><?php esc_html_e('Published FAQs', 'sibacom-manager'); ?></span>
            </div>
        </div>
    </div>

    <!-- Quick Shortcuts & Event Status Grid -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px;">
        <div class="sibacom-panel-card">
            <h2><?php esc_html_e('Event Profile Details', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Core date, location, and institutional venue data.', 'sibacom-manager'); ?></p>

            <table class="widefat striped" style="border:none; box-shadow:none;">
                <tbody>
                    <tr>
                        <td style="font-weight:700; width:160px;"><?php esc_html_e('Event Title', 'sibacom-manager'); ?></td>
                        <td><?php echo esc_html($event_name); ?></td>
                    </tr>
                    <tr>
                        <td style="font-weight:700;"><?php esc_html_e('Event Dates', 'sibacom-manager'); ?></td>
                        <td><?php echo esc_html($event_dates); ?></td>
                    </tr>
                    <tr>
                        <td style="font-weight:700;"><?php esc_html_e('Primary Venue', 'sibacom-manager'); ?></td>
                        <td><?php echo esc_html($event_venue); ?></td>
                    </tr>
                    <tr>
                        <td style="font-weight:700;"><?php esc_html_e('Registration URL', 'sibacom-manager'); ?></td>
                        <td><a href="<?php echo esc_url($cta_url); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($cta_url); ?></a></td>
                    </tr>
                    <tr>
                        <td style="font-weight:700;"><?php esc_html_e('Host Institution', 'sibacom-manager'); ?></td>
                        <td><?php esc_html_e('Sukkur IBA University', 'sibacom-manager'); ?></td>
                    </tr>
                    <tr>
                        <td style="font-weight:700;"><?php esc_html_e('Lead Department', 'sibacom-manager'); ?></td>
                        <td><?php esc_html_e('Dept. of Computer Systems Engineering (CSE)', 'sibacom-manager'); ?></td>
                    </tr>
                </tbody>
            </table>
            
            <p style="margin-top:1.5rem;">
                <a href="<?php echo esc_url(admin_url('admin.php?page=sibacom-settings')); ?>" class="button button-secondary">
                    <?php esc_html_e('Edit General Settings &rarr;', 'sibacom-manager'); ?>
                </a>
            </p>
        </div>

        <div class="sibacom-panel-card">
            <h2><?php esc_html_e('Quick Content Publishing', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Fast actions to manage and populate your event website.', 'sibacom-manager'); ?></p>

            <ul style="line-height: 2.2; font-size:14px; margin: 15px 0;">
                <li>
                    <span class="dashicons dashicons-plus-alt" style="color:#079B58; vertical-align:middle;"></span>
                    <a href="<?php echo esc_url(admin_url('post-new.php?post_type=sibacom_event')); ?>"><strong><?php esc_html_e('Add New Event Competition & Pricing', 'sibacom-manager'); ?></strong></a>
                </li>
                <li>
                    <span class="dashicons dashicons-plus-alt" style="color:#079B58; vertical-align:middle;"></span>
                    <a href="<?php echo esc_url(admin_url('post-new.php?post_type=sibacom_session')); ?>"><strong><?php esc_html_e('Add Schedule Session', 'sibacom-manager'); ?></strong></a>
                </li>
                <li>
                    <span class="dashicons dashicons-plus-alt" style="color:#079B58; vertical-align:middle;"></span>
                    <a href="<?php echo esc_url(admin_url('post-new.php?post_type=sibacom_speaker')); ?>"><strong><?php esc_html_e('Add Speaker / Judge / Guest', 'sibacom-manager'); ?></strong></a>
                </li>
                <li>
                    <span class="dashicons dashicons-plus-alt" style="color:#079B58; vertical-align:middle;"></span>
                    <a href="<?php echo esc_url(admin_url('post-new.php?post_type=sibacom_sponsor')); ?>"><strong><?php esc_html_e('Add Sponsor or Partner', 'sibacom-manager'); ?></strong></a>
                </li>
                <li>
                    <span class="dashicons dashicons-plus-alt" style="color:#079B58; vertical-align:middle;"></span>
                    <a href="<?php echo esc_url(admin_url('post-new.php?post_type=sibacom_faq')); ?>"><strong><?php esc_html_e('Add Frequently Asked Question', 'sibacom-manager'); ?></strong></a>
                </li>
                <li>
                    <span class="dashicons dashicons-layout" style="color:#173F91; vertical-align:middle;"></span>
                    <a href="<?php echo esc_url(admin_url('admin.php?page=sibacom-event-info')); ?>"><strong><?php esc_html_e('Configure 6 Event Information Cards', 'sibacom-manager'); ?></strong></a>
                </li>
                <li>
                    <span class="dashicons dashicons-format-image" style="color:#173F91; vertical-align:middle;"></span>
                    <a href="<?php echo esc_url(admin_url('admin.php?page=sibacom-hero')); ?>"><strong><?php esc_html_e('Hero Banner & Campus Photograph', 'sibacom-manager'); ?></strong></a>
                </li>
                <li>
                    <span class="dashicons dashicons-info-outline" style="color:#173F91; vertical-align:middle;"></span>
                    <a href="<?php echo esc_url(admin_url('admin.php?page=sibacom-about')); ?>"><strong><?php esc_html_e('About Section & Olympiad Statistics', 'sibacom-manager'); ?></strong></a>
                </li>
                <li>
                    <span class="dashicons dashicons-star-filled" style="color:#173F91; vertical-align:middle;"></span>
                    <a href="<?php echo esc_url(admin_url('admin.php?page=sibacom-highlights')); ?>"><strong><?php esc_html_e('Highlights & Competitive Pillars', 'sibacom-manager'); ?></strong></a>
                </li>
                <li>
                    <span class="dashicons dashicons-groups" style="color:#173F91; vertical-align:middle;"></span>
                    <a href="<?php echo esc_url(admin_url('admin.php?page=sibacom-organizers')); ?>"><strong><?php esc_html_e('Organizers & Academic Partners', 'sibacom-manager'); ?></strong></a>
                </li>
                <li>
                    <span class="dashicons dashicons-share" style="color:#173F91; vertical-align:middle;"></span>
                    <a href="<?php echo esc_url(admin_url('admin.php?page=sibacom-social')); ?>"><strong><?php esc_html_e('Update Social Media Channels', 'sibacom-manager'); ?></strong></a>
                </li>
            </ul>
        </div>
    </div>

</div>
