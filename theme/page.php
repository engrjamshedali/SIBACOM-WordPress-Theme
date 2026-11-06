<?php
/**
 * SIBACOM Standard Page Template
 *
 * @package SIBACOM
 */

get_header();

while (have_posts()) :
    the_post();

    // Check if built with Elementor
    if (function_exists('sibacom_is_built_with_elementor') && sibacom_is_built_with_elementor()) {
        the_content();
    } else {
        // Standard WordPress page layout with Neumorphic card
        ?>
        <div class="sibacom-section">
            <div class="sibacom-container">
                <article id="post-<?php the_ID(); ?>" <?php post_class('neu-card'); ?>>
                    <header class="entry-header" style="margin-bottom: 2rem;">
                        <h1 class="entry-title font-display"><?php the_title(); ?></h1>
                    </header>

                    <div class="entry-content">
                        <?php
                        the_content();

                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'sibacom'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>
                </article>
            </div>
        </div>
        <?php
    }

endwhile;

get_footer();

