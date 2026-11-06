<?php
/**
 * SIBACOM Main Index Template
 *
 * @package SIBACOM
 */

get_header();
?>
<div class="sibacom-section">
    <div class="sibacom-container">
        <header class="sibacom-section-header">
            <div class="sibacom-badge">
                <span class="pulse-dot"></span>
                <span><?php esc_html_e('Latest Updates', 'sibacom'); ?></span>
            </div>
            <h1 class="font-display"><?php esc_html_e('SIBACOM News & Announcements', 'sibacom'); ?></h1>
            <p><?php esc_html_e('Stay informed with official updates from the Sukkur IBA University organizing committee.', 'sibacom'); ?></p>
        </header>

        <?php if (have_posts()) : ?>
            <div class="sibacom-highlights-grid">
                <?php
                while (have_posts()) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('neu-card'); ?> style="display: flex; flex-direction: column; justify-content: space-between;">
                        <div>
                            <?php if (has_post_thumbnail()) : ?>
                                <div style="border-radius: var(--radius-md); overflow: hidden; margin-bottom: 1.25rem;">
                                    <?php the_post_thumbnail('medium_large', array('style' => 'width: 100%; height: 200px; object-fit: cover;')); ?>
                                </div>
                            <?php endif; ?>

                            <div style="font-size: 0.8rem; font-weight: 600; color: var(--sibacom-techgreen); margin-bottom: 0.5rem;">
                                <?php echo get_the_date(); ?>
                            </div>

                            <h3 class="font-display" style="font-size: 1.35rem; margin-bottom: 0.75rem;">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>

                            <div style="font-size: 0.92rem; color: var(--sibacom-text-secondary); margin-bottom: 1.5rem;">
                                <?php the_excerpt(); ?>
                            </div>
                        </div>

                        <div>
                            <a href="<?php the_permalink(); ?>" class="sibacom-btn sibacom-btn-secondary" style="width: 100%;">
                                <span><?php esc_html_e('Read Article', 'sibacom'); ?></span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                    <?php
                endwhile;
                ?>
            </div>

            <div style="margin-top: 3rem; text-align: center;">
                <?php the_posts_pagination(); ?>
            </div>
        <?php else : ?>
            <div class="neu-card text-center" style="max-width: 600px; margin: 0 auto;">
                <h3><?php esc_html_e('No announcements found', 'sibacom'); ?></h3>
                <p><?php esc_html_e('Check back soon for latest schedule updates and keynote announcements.', 'sibacom'); ?></p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php
get_footer();

