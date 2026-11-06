<?php
/**
 * SIBACOM Archive Template
 *
 * @package SIBACOM
 */

get_header();

if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('archive')) :
?>
<div class="sibacom-section">
    <div class="sibacom-container">
        <header class="sibacom-section-header">
            <h1 class="font-display"><?php the_archive_title(); ?></h1>
            <div class="archive-description"><?php the_archive_description(); ?></div>
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
                                <span><?php esc_html_e('Read More', 'sibacom'); ?></span>
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
        <?php endif; ?>
    </div>
</div>
<?php
endif;

get_footer();
