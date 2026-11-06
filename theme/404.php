<?php
/**
 * SIBACOM 404 Template
 *
 * @package SIBACOM
 */

get_header();
?>
<div class="sibacom-section" style="min-height: 70vh; display: flex; align-items: center;">
    <div class="sibacom-container">
        <div class="neu-card text-center" style="max-width: 640px; margin: 0 auto; padding: 3.5rem 2rem;">
            <div style="margin-bottom: 1.5rem; display: flex; justify-content: center;">
                <div style="background: #03326A; padding: 4px; border-radius: 16px; box-shadow: 0 8px 24px rgba(3, 50, 106, 0.25); display: inline-flex; align-items: center; justify-content: center;">
                    <img src="<?php echo esc_url(function_exists('sibacom_get_logo_url') ? sibacom_get_logo_url() : SIBACOM_THEME_URI . '/assets/images/sibacom_logo.jpg'); ?>" alt="<?php esc_attr_e('SIBACOM Official Logo', 'sibacom'); ?>" width="72" height="72" style="height: 72px; width: 72px; aspect-ratio: 1/1; border-radius: 12px; object-fit: contain;" />
                </div>
            </div>
            <div class="sibacom-badge" style="margin-bottom: 1.25rem;">
                <i class="fa-solid fa-triangle-exclamation" style="color: #EAB308;"></i>
                <span><?php esc_html_e('404 Error • Resource Relocated', 'sibacom'); ?></span>
            </div>
            <h1 class="font-display" style="font-size: 5rem; line-height: 1; color: var(--sibacom-primary); margin-bottom: 1rem;">404</h1>
            <h2 class="font-display" style="font-size: 1.75rem; margin-bottom: 1rem;"><?php esc_html_e('Page Not Found', 'sibacom'); ?></h2>
            <p style="margin-bottom: 2rem; color: var(--sibacom-text-secondary);">
                <?php esc_html_e('The event page or resource you are looking for does not exist or has been relocated.', 'sibacom'); ?>
            </p>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="sibacom-btn sibacom-btn-primary">
                <i class="fa-solid fa-house"></i>
                <span><?php esc_html_e('Back to SIBACOM Home', 'sibacom'); ?></span>
            </a>
        </div>
    </div>
</div>
<?php
get_footer();

