<?php
/**
 * Template Name: SIBACOM Organizers Template
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
                        <i class="fa-solid fa-users-gear" style="color: var(--sibacom-primary);"></i>
                        <span><?php echo esc_html(get_option('sibacom_organizers_sec_badge', __('Dual-Society Leadership', 'sibacom'))); ?></span>
                    </div>
                    <h1 class="font-display"><?php echo esc_html(get_option('sibacom_organizers_sec_title', __('Organizers & Academic Partners', 'sibacom'))); ?></h1>
                    <p><?php echo esc_html(get_option('sibacom_organizers_sec_subtitle', __('SIBACOM is the flagship technology Olympiad of Sukkur IBA University, jointly organized by the Computer Systems Engineering Society (CSE Society) and the Electrical Engineering Society (EE Society), supported by academic partners: Department of Computer Systems Engineering and Department of Electrical Engineering.', 'sibacom'))); ?></p>
                </header>

                <?php
                if (shortcode_exists('sibacom_organizers')) {
                    echo do_shortcode('[sibacom_organizers]');
                }
                the_content();
                ?>
            </div>
        </div>
        <?php
    }

endwhile;

get_footer();

