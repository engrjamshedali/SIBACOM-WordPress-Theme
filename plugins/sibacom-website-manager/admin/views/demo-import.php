<?php
/**
 * SIBACOM One-Click Demo Import View
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
            <h1><?php esc_html_e('One-Click Demo Content Import', 'sibacom-manager'); ?></h1>
            <p><?php esc_html_e('Quickly populate your WordPress installation with complete SIBACOM event pages, schedules, speakers, and sponsors.', 'sibacom-manager'); ?></p>
        </div>
    </div>

    <div class="sibacom-panel-card" style="max-width: 820px;">
        <h2><?php esc_html_e('Ready to Import SIBACOM Event Content', 'sibacom-manager'); ?></h2>
        <p class="subtitle"><?php esc_html_e('This turnkey importer configures your complete website with authentic Sukkur IBA University data.', 'sibacom-manager'); ?></p>

        <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 14px; padding: 22px; margin-bottom: 25px;">
            <h3 style="margin: 0 0 12px 0; font-size: 16px; color: #173F91;">
                <span class="dashicons dashicons-yes-alt" style="color: #079B58; margin-right: 6px;"></span>
                <?php esc_html_e('What will be imported and configured:', 'sibacom-manager'); ?>
            </h3>
            <ul style="margin: 0 0 0 24px; list-style: disc; line-height: 1.8; color: #475569; font-size: 14px;">
                <li><strong>Complete WordPress Pages:</strong> Home, About SIBACOM, Events & Competitions, Event Schedule, Speakers & Judges, Dignitaries & Guests, Organizing Committee, Contact Us.</li>
                <li><strong>Front Page Assignment:</strong> Automatically sets "Home" as the static front page.</li>
                <li><strong>Primary Navigation Menu:</strong> Generates and binds "SIBACOM Primary Navigation" to the theme header.</li>
                <li><strong>10 Detailed Schedule Sessions:</strong> Day 1, 2, and 3 sessions with timings, speakers, halls, and tracks.</li>
                <li><strong>6 Distinguished Keynote Speakers & Judges:</strong> Dr. Zahid Hussain, Dr. Asim Khwaja, Engr. Faraz Ahmed, etc.</li>
                <li><strong>6 Confirmed Sponsors & Partners:</strong> HEC Pakistan, Systems Limited, 10Pearls, Ignite, GDG, ACM.</li>
                <li><strong>6 Comprehensive FAQs:</strong> Logistics, eligibility, accommodation, and competition guidelines.</li>
                <li><strong>Official Institutional & Dual-Society Branding:</strong> Sets up default logo URLs, dual-society joint organizer profiles (CSE Society & EE Society), academic affiliations, and campus assets.</li>
            </ul>
        </div>

        <button type="button" id="sibacom-run-import-btn" class="button button-primary sibacom-btn-save" style="font-size: 16px !important; padding: 12px 30px !important;">
            <span class="dashicons dashicons-download" style="vertical-align: middle; margin-right: 6px;"></span>
            <?php esc_html_e('Run One-Click Demo Import Now', 'sibacom-manager'); ?>
        </button>

        <div id="sibacom-import-status"></div>
    </div>
</div>
<?php

