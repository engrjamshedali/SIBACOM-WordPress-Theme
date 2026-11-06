<?php
/**
 * SIBACOM Highlights Settings View
 *
 * @package SIBACOM_Website_Manager
 */

if (!defined('ABSPATH')) {
    exit;
}

$hl_badge = get_option('sibacom_highlights_badge', 'Competitive Tracks & Pillars');
$hl_title = get_option('sibacom_highlights_title', 'Empowering Pakistan’s Next Generation of Technologists');
$hl_desc  = get_option('sibacom_highlights_desc', 'Explore high-impact competitive categories designed to challenge algorithmic mastery, engineering resilience, and technical vision.');
?>
<div class="wrap sibacom-admin-wrap">
    <div class="sibacom-admin-header">
        <div>
            <h1><?php esc_html_e('Event Highlights & Competitive Pillars', 'sibacom-manager'); ?></h1>
            <p><?php esc_html_e('Highlights and competitive categories displayed in cards across the home and about sections.', 'sibacom-manager'); ?></p>
        </div>
    </div>

    <form method="post" action="options.php">
        <?php settings_fields('sibacom_settings_group'); ?>

        <div class="sibacom-panel-card" style="border-left: 4px solid #173F91;">
            <h2><?php esc_html_e('Highlights Section Header Settings', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Configure badge label, section title, and description displayed above the pillars.', 'sibacom-manager'); ?></p>

            <div class="sibacom-form-row">
                <label for="sibacom_highlights_badge"><?php esc_html_e('Section Badge Tag:', 'sibacom-manager'); ?></label>
                <input type="text" id="sibacom_highlights_badge" name="sibacom_highlights_badge" value="<?php echo esc_attr($hl_badge); ?>" style="max-width: 650px;" />
            </div>

            <div class="sibacom-form-row">
                <label for="sibacom_highlights_title"><?php esc_html_e('Section Main Heading:', 'sibacom-manager'); ?></label>
                <input type="text" id="sibacom_highlights_title" name="sibacom_highlights_title" value="<?php echo esc_attr($hl_title); ?>" style="max-width: 650px;" />
            </div>

            <div class="sibacom-form-row">
                <label for="sibacom_highlights_desc"><?php esc_html_e('Section Description Narrative:', 'sibacom-manager'); ?></label>
                <textarea id="sibacom_highlights_desc" name="sibacom_highlights_desc" rows="3" style="max-width: 650px;"><?php echo esc_textarea($hl_desc); ?></textarea>
            </div>
        </div>

        <div class="sibacom-panel-card">
            <h2><?php esc_html_e('Active Olympiad Pillars', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('These 6 core pillars represent the official competitive tracks of SIBACOM.', 'sibacom-manager'); ?></p>

            <table class="widefat striped">
                <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th><?php esc_html_e('Track Title', 'sibacom-manager'); ?></th>
                        <th><?php esc_html_e('Badge / Category', 'sibacom-manager'); ?></th>
                        <th><?php esc_html_e('Icon', 'sibacom-manager'); ?></th>
                        <th><?php esc_html_e('Summary', 'sibacom-manager'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>1</strong></td>
                        <td><strong>Speed Programming</strong></td>
                        <td><span style="background:#EFF6FF; color:#1D4ED8; padding:3px 8px; border-radius:12px; font-weight:bold; font-size:11px;">Collegiate League</span></td>
                        <td><code>fa-code</code></td>
                        <td>Timed algorithmic coding league featuring strict automated test suites in C++, Java, and Python.</td>
                    </tr>
                    <tr>
                        <td><strong>2</strong></td>
                        <td><strong>Hackathon 24H</strong></td>
                        <td><span style="background:#ECFDF5; color:#047857; padding:3px 8px; border-radius:12px; font-weight:bold; font-size:11px;">Product Sprint</span></td>
                        <td><code>fa-laptop-code</code></td>
                        <td>High-intensity continuous product ideation and build sprint across AI agents and fintech.</td>
                    </tr>
                    <tr>
                        <td><strong>3</strong></td>
                        <td><strong>Capture The Flag (CTF)</strong></td>
                        <td><span style="background:#FEF2F2; color:#B91C1C; padding:3px 8px; border-radius:12px; font-weight:bold; font-size:11px;">Cyber Security</span></td>
                        <td><code>fa-shield-halved</code></td>
                        <td>Jeopardy-style offensive & defensive cyber defense challenge across binary exploitation and forensics.</td>
                    </tr>
                    <tr>
                        <td><strong>4</strong></td>
                        <td><strong>RoboWars & Automation</strong></td>
                        <td><span style="background:#FFFBEB; color:#B45309; padding:3px 8px; border-radius:12px; font-weight:bold; font-size:11px;">Hardware Arena</span></td>
                        <td><code>fa-robot</code></td>
                        <td>Combat robot clashes, autonomous line-following micro-mazes, and embedded hardware.</td>
                    </tr>
                    <tr>
                        <td><strong>5</strong></td>
                        <td><strong>AI Agent Challenge</strong></td>
                        <td><span style="background:#F5F3FF; color:#6D28D9; padding:3px 8px; border-radius:12px; font-weight:bold; font-size:11px;">Frontier AI</span></td>
                        <td><code>fa-brain</code></td>
                        <td>Frontier machine learning workflows, multi-agent orchestrations, and prompt-tuning benchmarks.</td>
                    </tr>
                    <tr>
                        <td><strong>6</strong></td>
                        <td><strong>Startup Showcase & Pitch</strong></td>
                        <td><span style="background:#F0FDFA; color:#0F766E; padding:3px 8px; border-radius:12px; font-weight:bold; font-size:11px;">Venture Capital</span></td>
                        <td><code>fa-rocket</code></td>
                        <td>Venture showcase where student founders pitch innovative prototypes directly to angel investors.</td>
                    </tr>
                </tbody>
            </table>

            <div style="margin-top: 25px; padding: 15px; background: #F8FAFC; border-radius: 12px; border: 1px solid #E2E8F0;">
                <p style="margin: 0; font-size: 13px; color: #475569;">
                    <strong>Pro Tip:</strong> When designing custom sections in <strong>Elementor Pro</strong>, use the <strong>SIBACOM Highlights Grid</strong> widget to customize icons, borders, and layouts visually with drag-and-drop precision.
                </p>
            </div>
        </div>

        <p class="submit">
            <input type="submit" name="submit" class="button button-primary sibacom-btn-save" value="<?php esc_attr_e('Save Highlights Configuration', 'sibacom-manager'); ?>" />
        </p>
    </form>
</div>
<?php


