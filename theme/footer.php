<?php
/**
 * SIBACOM Theme Footer
 *
 * @package SIBACOM
 */

if (!defined('ABSPATH')) {
    exit;
}
?>
    </main><!-- #primary -->

    <?php
    // If Elementor Pro custom footer is active and location is handled:
    if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('footer')) {
        get_template_part('template-parts/footer/site-footer');
    }
    ?>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>

