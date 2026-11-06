<?php
/**
 * SIBACOM Front Page Template
 *
 * @package SIBACOM
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

while (have_posts()) :
    the_post();

    if (function_exists('sibacom_is_built_with_elementor') && sibacom_is_built_with_elementor()) {
        the_content();
    } else {
        // Load the complete homepage template
        get_template_part('templates/template', 'home-content');
    }

endwhile;

get_footer();
