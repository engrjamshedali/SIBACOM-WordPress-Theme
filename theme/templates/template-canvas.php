<?php
/**
 * Template Name: SIBACOM Canvas
 *
 * @package SIBACOM
 */

if (!defined('ABSPATH')) {
    exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class('sibacom-canvas'); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site sibacom-canvas-wrapper">
    <main id="primary" class="site-main">
        <?php
        while (have_posts()) :
            the_post();
            the_content();
        endwhile;
        ?>
    </main>
</div>

<?php wp_footer(); ?>
</body>
</html>

