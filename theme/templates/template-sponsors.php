<?php
/**
 * Template Name: SIBACOM Sponsors Template
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
        ?>
        <div class="sibacom-circuit-bg" style="padding-top: 3rem; padding-bottom: 5rem; position: relative;">
            <?php if (function_exists('sibacom_the_circuit_bg')) { sibacom_the_circuit_bg('light'); } ?>
            <div class="sibacom-container" style="position: relative; z-index: 1;">
                <header class="sibacom-section-header">
                    <div class="sibacom-badge">
                        <i class="fa-regular fa-handshake" style="color: var(--sibacom-techgreen);"></i>
                        <span><?php echo esc_html(get_option('sibacom_sponsors_sec_badge', __('Industry Collaboration', 'sibacom'))); ?></span>
                    </div>
                    <h1 class="font-display"><?php echo esc_html(get_option('sibacom_sponsors_sec_title', __('Partners & Sponsors Gallery', 'sibacom'))); ?></h1>
                    <p><?php echo esc_html(get_option('sibacom_sponsors_sec_desc', __('We extend our profound appreciation to our title sponsors, enterprise technology partners, and innovation accelerators.', 'sibacom'))); ?></p>
                </header>

                <?php
                if (shortcode_exists('sibacom_sponsors')) {
                    echo do_shortcode('[sibacom_sponsors]');
                }
                the_content();
                ?>
            </div>
        </div>
        <?php
    }

endwhile;

get_footer();

