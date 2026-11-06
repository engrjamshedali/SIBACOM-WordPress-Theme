<?php
/**
 * SIBACOM Content None Template Part
 *
 * @package SIBACOM
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<section class="no-results not-found neu-card text-center" style="max-width: 680px; margin: 3rem auto; padding: 3rem 2rem;">
    <header class="page-header" style="margin-bottom: 1rem;">
        <h2 class="page-title font-display"><?php esc_html_e('Nothing Found', 'sibacom'); ?></h2>
    </header>

    <div class="page-content">
        <?php if (is_search()) : ?>
            <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'sibacom'); ?></p>
            <?php get_search_form(); ?>
        <?php else : ?>
            <p><?php esc_html_e('It seems we cannot find what you are looking for. Perhaps searching can help.', 'sibacom'); ?></p>
            <?php get_search_form(); ?>
        <?php endif; ?>
    </div>
</section>

