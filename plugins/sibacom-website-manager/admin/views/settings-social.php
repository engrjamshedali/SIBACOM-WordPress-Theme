<?php
/**
 * SIBACOM Social Media Settings View
 *
 * @package SIBACOM_Website_Manager
 */

if (!defined('ABSPATH')) {
    exit;
}

$linkedin  = get_option('sibacom_social_linkedin', 'https://www.linkedin.com/school/sukkur-iba-university/');
$twitter   = get_option('sibacom_social_twitter', 'https://twitter.com/Sukkur_IBA');
$facebook  = get_option('sibacom_social_facebook', 'https://www.facebook.com/SukkurIBA.University');
$instagram = get_option('sibacom_social_instagram', 'https://www.instagram.com/sukkur_iba_official');
$youtube   = get_option('sibacom_social_youtube', 'https://www.youtube.com/@SukkurIBAUniversityOfficial');
$github    = get_option('sibacom_social_github', 'https://github.com/cse-society-iba');
?>
<div class="wrap sibacom-admin-wrap">
    
    <div class="sibacom-admin-header">
        <div>
            <div class="sibacom-admin-badge">
                <span style="display:inline-block; width:8px; height:8px; border-radius:50%; background:#079B58;"></span>
                <span><?php esc_html_e('Institutional Outreach', 'sibacom-manager'); ?></span>
            </div>
            <h1>
                <span class="dashicons dashicons-share" style="font-size:28px;"></span>
                <span><?php esc_html_e('Social Media Profiles', 'sibacom-manager'); ?></span>
            </h1>
            <p><?php esc_html_e('Manage verified social media channels displayed in the header, footer, and contact modules.', 'sibacom-manager'); ?></p>
        </div>
    </div>

    <form method="post" action="options.php">
        <?php
        settings_fields('sibacom_settings_group');
        do_settings_sections('sibacom_settings_group');
        ?>

        <div class="sibacom-panel-card" style="margin-bottom: 25px;">
            <h2><?php esc_html_e('Official Social Channels', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Provide absolute URLs for each institutional social profile.', 'sibacom-manager'); ?></p>

            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row"><span class="dashicons dashicons-linkedin"></span> <?php esc_html_e('LinkedIn', 'sibacom-manager'); ?></th>
                        <td>
                            <input type="url" name="sibacom_social_linkedin" value="<?php echo esc_attr($linkedin); ?>" class="large-text" placeholder="https://linkedin.com/..." />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><span class="dashicons dashicons-twitter"></span> <?php esc_html_e('Twitter / X', 'sibacom-manager'); ?></th>
                        <td>
                            <input type="url" name="sibacom_social_twitter" value="<?php echo esc_attr($twitter); ?>" class="large-text" placeholder="https://x.com/..." />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><span class="dashicons dashicons-facebook"></span> <?php esc_html_e('Facebook', 'sibacom-manager'); ?></th>
                        <td>
                            <input type="url" name="sibacom_social_facebook" value="<?php echo esc_attr($facebook); ?>" class="large-text" placeholder="https://facebook.com/..." />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><span class="dashicons dashicons-instagram"></span> <?php esc_html_e('Instagram', 'sibacom-manager'); ?></th>
                        <td>
                            <input type="url" name="sibacom_social_instagram" value="<?php echo esc_attr($instagram); ?>" class="large-text" placeholder="https://instagram.com/..." />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><span class="dashicons dashicons-video-alt3"></span> <?php esc_html_e('YouTube', 'sibacom-manager'); ?></th>
                        <td>
                            <input type="url" name="sibacom_social_youtube" value="<?php echo esc_attr($youtube); ?>" class="large-text" placeholder="https://youtube.com/..." />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><span class="dashicons dashicons-editor-code"></span> <?php esc_html_e('GitHub', 'sibacom-manager'); ?></th>
                        <td>
                            <input type="url" name="sibacom_social_github" value="<?php echo esc_attr($github); ?>" class="large-text" placeholder="https://github.com/..." />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <?php submit_button(esc_html__('Save Social Profiles', 'sibacom-manager'), 'primary large'); ?>
    </form>
</div>

