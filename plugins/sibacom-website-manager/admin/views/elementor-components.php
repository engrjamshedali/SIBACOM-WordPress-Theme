<?php
/**
 * SIBACOM Elementor Components Guide View
 *
 * @package SIBACOM_Website_Manager
 */

if (!defined('ABSPATH')) {
    exit;
}

$widgets = array(
    array(
        'name'        => 'SIBACOM Hero Banner',
        'slug'        => 'sibacom_hero',
        'icon'        => 'dashicons-format-image',
        'description' => 'Top headline, countdown timer, royal blue/green gradient badges, official edition tag, and dual registration CTAs.',
        'controls'    => 'Content (Headline, Dates, Venue, Attendees, Background Image, CTAs), Style (Typography, Colors, Overlay).',
    ),
    array(
        'name'        => 'SIBACOM Event Information Cards',
        'slug'        => 'sibacom_info',
        'icon'        => 'dashicons-info',
        'description' => '6 Neumorphic Information Cards: Event Date, Event Venue, Registration Deadline, Category, Participation, and Registration Status.',
        'controls'    => 'Content (Custom Value Overrides for all 6 cards), Style (Card Background, Shadow, Border Radius).',
    ),
    array(
        'name'        => 'SIBACOM Events & Pricing',
        'slug'        => 'sibacom_events',
        'icon'        => 'dashicons-tickets-alt',
        'description' => 'Dedicated Event Registration & Pricing Section with pricing badges (Free, Paid, Team, Special), live registration statuses, and Register Now CTA.',
        'controls'    => 'Content (Dynamic CPT Query vs Manual Repeater, Columns 1-4, Limit, Category Filter), Style (Card Box Shadow, Price Badge Colors, Status Badge Colors, Button Styles).',
    ),
    array(
        'name'        => 'SIBACOM Highlights Grid',
        'slug'        => 'sibacom_highlights',
        'icon'        => 'dashicons-grid-view',
        'description' => '6 Competitive Pillars & Olympiad modules with FontAwesome icons, category badges, and neumorphic hover elevations.',
        'controls'    => 'Content (Unlimited Repeater Cards with Title, Badge, Icon, Description), Style (Card Background, Typography, Shadows).',
    ),
    array(
        'name'        => 'SIBACOM About & Vision',
        'slug'        => 'sibacom_about',
        'icon'        => 'dashicons-welcome-learn-more',
        'description' => 'Split narrative section with institutional vision, mission, campus photo showcase, and 4 high-impact metric counters.',
        'controls'    => 'Content (Title, Description, Vision, Mission, Campus Image, 4 Metric Numbers/Labels), Style (Colors, Typography).',
    ),
    array(
        'name'        => 'SIBACOM Schedule Timeline',
        'slug'        => 'sibacom_schedule',
        'icon'        => 'dashicons-clock',
        'description' => 'Event program timeline displaying sessions, start/end times, venues, categories, and speakers.',
        'controls'    => 'Content (Dynamic CPT vs Manual Repeater, Day Filter, Session Limit), Style (Card Shadow, Timeline Dot, Typography).',
    ),
    array(
        'name'        => 'SIBACOM Speakers Grid',
        'slug'        => 'sibacom_speakers',
        'icon'        => 'dashicons-businessperson',
        'description' => 'Distinguished keynote speakers and judges with portrait photographs (object-fit: cover), categories, topics, bios, and social links.',
        'controls'    => 'Content (Dynamic vs Manual, Columns 2-4, Limit, Category Filter, Featured Only), Style (Card Shadow, Typography, Badge Colors).',
    ),
    array(
        'name'        => 'SIBACOM Chief & Distinguished Guests',
        'slug'        => 'sibacom_guests',
        'icon'        => 'dashicons-businessman',
        'description' => 'Dedicated Guest Showcase for Chief Guests, Dignitaries, and Special Guests with premium portrait styling.',
        'controls'    => 'Content (Dynamic vs Manual, Category Filter, Columns, Bio Toggle), Style (Portrait Aspect Ratio, Typography, Shadows).',
    ),
    array(
        'name'        => 'SIBACOM Organizers Grid',
        'slug'        => 'sibacom_organizers',
        'icon'        => 'dashicons-groups',
        'description' => 'Official organizational hierarchy: Joint Primary Organizers (CSE Society & EE Society), Academic Partners (Dept of CSE & Dept of EE), and Overarching Institutional Identity (Sukkur IBA University).',
        'controls'    => 'Content (Complete Hierarchy vs Joint Only vs Academic Only vs Custom Repeater), Style (Card Shadow, Logo Max Height, Typography).',
    ),
    array(
        'name'        => 'SIBACOM Sponsor Gallery',
        'slug'        => 'sibacom_sponsors',
        'icon'        => 'dashicons-awards',
        'description' => 'Categorized sponsorship tiers (Title, Platinum, Gold, Silver, Community, Academic) with clean logo scaling.',
        'controls'    => 'Content (Dynamic CPT vs Manual Repeater), Style (Card Background, Max Logo Height, Shadows).',
    ),
    array(
        'name'        => 'SIBACOM FAQ Accordion',
        'slug'        => 'sibacom_faq',
        'icon'        => 'dashicons-editor-help',
        'description' => 'Interactive FAQ accordion with smooth toggle animations and accessibility keyboard navigation.',
        'controls'    => 'Content (Dynamic CPT vs Manual Repeater), Style (Card Background, Question Typography, Active Colors, Shadows).',
    ),
    array(
        'name'        => 'SIBACOM Participation CTA Banner',
        'slug'        => 'sibacom_cta_banner',
        'icon'        => 'dashicons-megaphone',
        'description' => 'Royal blue & navy gradient pre-footer participation card with prominent Register Now button.',
        'controls'    => 'Content (Badge, Title, Description, Button Label, URL), Style (Gradient Start/End Colors, Typography).',
    ),
    array(
        'name'        => 'SIBACOM Contact Cards',
        'slug'        => 'sibacom_contact',
        'icon'        => 'dashicons-email-alt',
        'description' => 'Neumorphic contact information cards displaying venue address, official email, and phone helpdesk.',
        'controls'    => 'Content (Default Settings vs Custom Address, Email, Phone), Style (Card Shadow, Typography).',
    ),
    array(
        'name'        => 'SIBACOM Countdown Timer',
        'slug'        => 'sibacom_countdown',
        'icon'        => 'dashicons-backup',
        'description' => 'Standalone real-time event countdown timer box with Days, Hours, Mins, and Secs.',
        'controls'    => 'Content (Target Date), Style (Digit Typography, Box Background, Shadow).',
    ),
    array(
        'name'        => 'SIBACOM Social Links',
        'slug'        => 'sibacom_social',
        'icon'        => 'dashicons-share',
        'description' => 'Circular neumorphic social icon buttons for LinkedIn, Twitter/X, Facebook, and Instagram.',
        'controls'    => 'Content (Social URLs), Style (Icon Size, Colors, Hover States).',
    ),
);
?>
<div class="wrap sibacom-admin-wrap">
    
    <div class="sibacom-admin-header">
        <div>
            <div class="sibacom-admin-badge">
                <span style="display:inline-block; width:8px; height:8px; border-radius:50%; background:#079B58;"></span>
                <span><?php esc_html_e('Elementor Pro Visual Suite', 'sibacom-manager'); ?></span>
            </div>
            <h1>
                <span class="dashicons dashicons-welcome-widgets-menus" style="font-size:28px;"></span>
                <span><?php esc_html_e('Elementor Components & Widgets', 'sibacom-manager'); ?></span>
            </h1>
            <p><?php esc_html_e('Discover the 15 dedicated custom Elementor widgets located under the "SIBACOM Elements" panel.', 'sibacom-manager'); ?></p>
        </div>
        <div>
            <a href="<?php echo esc_url(admin_url('edit.php?post_type=page')); ?>" class="button button-secondary" style="font-weight:700;">
                <span class="dashicons dashicons-edit" style="vertical-align:middle;"></span>
                <?php esc_html_e('Open Pages in Elementor', 'sibacom-manager'); ?>
            </a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 20px;">
        <?php foreach ($widgets as $w) : ?>
            <div class="sibacom-panel-card" style="display:flex; flex-direction:column; justify-content:space-between;">
                <div>
                    <div style="display:flex; align-items:center; gap:12px; margin-bottom:12px;">
                        <span class="dashicons <?php echo esc_attr($w['icon']); ?>" style="font-size:24px; color:#173F91; width:28px; height:28px;"></span>
                        <h3 style="margin:0; font-size:16px; font-weight:700; color:#17233D;"><?php echo esc_html($w['name']); ?></h3>
                    </div>
                    <code style="background:#EDF1F7; color:#173F91; font-weight:700; font-size:12px; padding:2px 8px; border-radius:4px;"><?php echo esc_html($w['slug']); ?></code>
                    <p style="font-size:13px; color:#64748B; line-height:1.6; margin-top:10px;"><?php echo esc_html($w['description']); ?></p>
                </div>
                <div style="margin-top:15px; padding-top:12px; border-top:1px solid #E2E8F0; font-size:12px; color:#475569;">
                    <strong><?php esc_html_e('Controls:', 'sibacom-manager'); ?></strong> <?php echo esc_html($w['controls']); ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>

