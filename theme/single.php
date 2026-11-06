<?php
/**
 * SIBACOM Single Post Template
 *
 * @package SIBACOM
 */

get_header();

if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('single')) :
?>
<div class="sibacom-section">
    <div class="sibacom-container" style="max-width: 860px;">
        <?php
        while (have_posts()) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('neu-card'); ?>>
                <?php if (has_post_thumbnail()) : ?>
                    <div style="border-radius: var(--radius-lg); overflow: hidden; margin-bottom: 2rem; box-shadow: var(--neu-flat);">
                        <?php the_post_thumbnail('large', array('style' => 'width: 100%; height: auto;')); ?>
                    </div>
                <?php endif; ?>

                <header class="entry-header" style="margin-bottom: 1.5rem;">
                    <div class="sibacom-badge" style="margin-bottom: 0.75rem;">
                        <span><?php echo get_the_date(); ?></span>
                    </div>
                    <h1 class="entry-title font-display" style="font-size: 2.25rem;"><?php the_title(); ?></h1>
                </header>

                <div class="entry-content" style="font-size: 1.05rem; line-height: 1.8;">
                    <?php the_content(); ?>
                </div>

                <footer class="entry-footer" style="margin-top: 2.5rem; padding-top: 1.5rem; border-top: 1px solid var(--sibacom-border);">
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                        <div><?php the_category(', '); ?></div>
                        <div><?php the_tags('<span class="tag-label">Tags: </span>', ', '); ?></div>
                    </div>
                </footer>
            </article>
            <?php
        endwhile;
        ?>
    </div>
</div>
<?php
endif;

get_footer();
