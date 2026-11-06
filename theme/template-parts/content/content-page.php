<?php
/**
 * SIBACOM Content Page Template Part
 *
 * @package SIBACOM
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('neu-card'); ?>>
    <header class="entry-header" style="margin-bottom: 1.5rem;">
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

