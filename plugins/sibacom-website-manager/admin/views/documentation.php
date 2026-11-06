<?php
/**
 * SIBACOM Admin Documentation View
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
            <div class="sibacom-admin-badge">
                <span style="display:inline-block; width:8px; height:8px; border-radius:50%; background:#079B58;"></span>
                <span><?php esc_html_e('User Guide & Technical Handbook', 'sibacom-manager'); ?></span>
            </div>
            <h1>
                <span class="dashicons dashicons-book" style="font-size:28px;"></span>
                <span><?php esc_html_e('SIBACOM Website Documentation', 'sibacom-manager'); ?></span>
            </h1>
            <p><?php esc_html_e('Complete administrative reference for managing event content, visual editing with Elementor Pro, and brand standards.', 'sibacom-manager'); ?></p>
        </div>
    </div>

    <!-- Doc Sections -->
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 25px;">
        <div>
            <div class="sibacom-panel-card" style="margin-bottom: 25px;">
                <h2><?php esc_html_e('1. Official Event Identity & Conventions', 'sibacom-manager'); ?></h2>
                <p>The official event name is <strong>SIBACOM</strong>, always written as one word in all-uppercase.</p>
                <p>SIBACOM is an academic technology Olympiad and computing summit presented by <strong>Sukkur IBA University</strong> (Overarching Institutional Identity), jointly organized by the <strong>Computer Systems Engineering Society (CSE Society)</strong> and the <strong>Electrical Engineering Society (EE Society)</strong> as equal primary organizers, supported by their respective academic affiliations: the <strong>Department of Computer Systems Engineering</strong> and the <strong>Department of Electrical Engineering</strong>.</p>
                <p><strong>Design System:</strong> Premium Neumorphism (calibrated soft shadows, pure white surfaces <code>#FFFFFF</code> on light backdrop <code>#F4F6FA</code>, Royal Blue <code>#173F91</code>, Deep Navy <code>#102E68</code>, and Technology Green <code>#079B58</code>).</p>
            </div>

            <div class="sibacom-panel-card" style="margin-bottom: 25px;">
                <h2><?php esc_html_e('2. Content Management vs Elementor Pro Visual Editing', 'sibacom-manager'); ?></h2>
                <p>SIBACOM uses a dual-layer architecture designed for maximum flexibility:</p>
                <ol style="line-height: 1.8; padding-left: 20px;">
                    <li><strong>WordPress Admin Dashboard (SIBACOM Menu):</strong> Manage structured database records including Event Competitions & Pricing, Schedule Sessions, Keynote Speakers & Dignitaries, Sponsor Tiers, and FAQs. Whenever a new speaker or event is published in the dashboard, it instantly and automatically synchronizes to the frontend and Elementor dynamic queries.</li>
                    <li><strong>Elementor Pro Visual Editor:</strong> Open any page (Home, About, Events, Schedule, Speakers, Guests, Organizers, Sponsors, Contact) directly inside Elementor. Drag, drop, duplicate, reorder, and visually customize widgets. Each widget offers both dynamic querying and manual repeater mode for custom styling.</li>
                </ol>
            </div>

            <div class="sibacom-panel-card" style="margin-bottom: 25px;">
                <h2><?php esc_html_e('3. Event Registration & Pricing Configuration', 'sibacom-manager'); ?></h2>
                <p>The website is purely an event presentation and frontend marketing portal. Registration buttons are frontend CTAs linking directly to externally configured registration forms or portals.</p>
                <p>Each event competition supports:</p>
                <ul style="line-height: 1.8; padding-left: 20px;">
                    <li><strong>Fee / Pricing Category:</strong> Free Registration, Standard Individual Fee (e.g. PKR 500, PKR 1,000), Team Registration, or Special Category.</li>
                    <li><strong>Registration Status:</strong> Registration Open, Registration Not Open Yet, Registration Closing Soon, Registration Closed, or Fully Booked.</li>
                    <li><strong>Calculation Mode:</strong> Manual status override or automatic calculation based on Opening & Closing dates.</li>
                </ul>
            </div>

            <div class="sibacom-panel-card" style="margin-bottom: 25px;">
                <h2><?php esc_html_e('4. Speaker & Guest Directory System', 'sibacom-manager'); ?></h2>
                <p>Every speaker and guest profile displays a high-resolution photograph (styled with <code>object-fit: cover</code> and calibrated portrait aspect ratios), full name, academic/professional designation, organization, talk topic, biography, and social profiles.</p>
                <p>Speakers are categorized into: <strong>Chief Guests</strong>, <strong>Guest Speakers</strong>, <strong>Keynote Speakers</strong>, <strong>Trainers</strong>, <strong>Special Guests</strong>, and <strong>Organizing Team</strong>.</p>
            </div>
        </div>

        <div>
            <div class="sibacom-panel-card" style="margin-bottom: 25px;">
                <h3><?php esc_html_e('Quick Shortcuts', 'sibacom-manager'); ?></h3>
                <ul style="line-height: 2;">
                    <li><a href="<?php echo esc_url(admin_url('post-new.php?post_type=sibacom_event')); ?>">+ <?php esc_html_e('Add New Event / Competition', 'sibacom-manager'); ?></a></li>
                    <li><a href="<?php echo esc_url(admin_url('post-new.php?post_type=sibacom_speaker')); ?>">+ <?php esc_html_e('Add Speaker or Guest', 'sibacom-manager'); ?></a></li>
                    <li><a href="<?php echo esc_url(admin_url('post-new.php?post_type=sibacom_session')); ?>">+ <?php esc_html_e('Add Schedule Session', 'sibacom-manager'); ?></a></li>
                    <li><a href="<?php echo esc_url(admin_url('post-new.php?post_type=sibacom_sponsor')); ?>">+ <?php esc_html_e('Add Sponsor / Partner', 'sibacom-manager'); ?></a></li>
                    <li><a href="<?php echo esc_url(admin_url('post-new.php?post_type=sibacom_faq')); ?>">+ <?php esc_html_e('Add New FAQ', 'sibacom-manager'); ?></a></li>
                    <li><a href="<?php echo esc_url(admin_url('admin.php?page=sibacom-demo-import')); ?>"><span class="dashicons dashicons-download"></span> <?php esc_html_e('Run Demo Importer', 'sibacom-manager'); ?></a></li>
                </ul>
            </div>

            <div class="sibacom-panel-card">
                <h3><?php esc_html_e('Theme Branding Hex Codes', 'sibacom-manager'); ?></h3>
                <div style="display:flex; flex-direction:column; gap:8px; font-size:13px; font-weight:600;">
                    <div style="display:flex; align-items:center; gap:8px;"><span style="width:20px; height:20px; background:#173F91; border-radius:4px; display:inline-block;"></span> Royal Blue: #173F91</div>
                    <div style="display:flex; align-items:center; gap:8px;"><span style="width:20px; height:20px; background:#102E68; border-radius:4px; display:inline-block;"></span> Deep Navy: #102E68</div>
                    <div style="display:flex; align-items:center; gap:8px;"><span style="width:20px; height:20px; background:#079B58; border-radius:4px; display:inline-block;"></span> Tech Green: #079B58</div>
                    <div style="display:flex; align-items:center; gap:8px;"><span style="width:20px; height:20px; background:#F4F6FA; border:1px solid #CBD5E1; border-radius:4px; display:inline-block;"></span> Soft Surface: #F4F6FA</div>
                    <div style="display:flex; align-items:center; gap:8px;"><span style="width:20px; height:20px; background:#FFFFFF; border:1px solid #CBD5E1; border-radius:4px; display:inline-block;"></span> Pure White: #FFFFFF</div>
                    <div style="display:flex; align-items:center; gap:8px;"><span style="width:20px; height:20px; background:#17233D; border-radius:4px; display:inline-block;"></span> Text Primary: #17233D</div>
                </div>
            </div>
        </div>
    </div>

</div>

