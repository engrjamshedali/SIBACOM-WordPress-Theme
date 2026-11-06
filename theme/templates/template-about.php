<?php
/**
 * Template Name: SIBACOM About Template
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
        <div class="sibacom-circuit-bg" style="padding-top: 3rem;">
            <div class="sibacom-container">
                <header class="sibacom-section-header">
                    <div class="sibacom-badge">
                        <span class="pulse-dot"></span>
                        <span><?php echo esc_html(get_option('sibacom_about_badge', __('About The Olympiad', 'sibacom'))); ?></span>
                    </div>
                    <h1 class="font-display"><?php echo esc_html(get_option('sibacom_about_title', __('About SIBACOM – Sukkur IBA University', 'sibacom'))); ?></h1>
                    <p><?php echo esc_html(get_option('sibacom_about_description', __('Learn about Pakistan’s flagship university technology Olympiad, fostering algorithmic mastery and engineering innovation.', 'sibacom'))); ?></p>
                </header>

                <?php
                if (shortcode_exists('sibacom_about')) {
                    echo do_shortcode('[sibacom_about]');
                }
                ?>

                <!-- Additional About Content -->
                <div style="margin-top: 4rem;">
                    <div class="neu-card sibacom-card-circuit" style="margin-bottom: 2.5rem;">
                        <?php if (function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
                        <h2 class="font-display" style="font-size: 1.85rem; margin-bottom: 1rem; color: var(--sibacom-primary);">
                            <?php esc_html_e('Joint Dual-Society Leadership & Institutional Vision', 'sibacom'); ?>
                        </h2>
                        <p style="font-size: 1.05rem; line-height: 1.8; margin-bottom: 1.25rem;">
                            <?php esc_html_e('SIBACOM is the flagship national collegiate technology festival jointly organized by two premier student engineering societies of Sukkur IBA University: the Computer Systems Engineering Society (CSE Society) and the Electrical Engineering Society (EE Society). Operating with equal organizational recognition and joint executive leadership, both societies bridge the computing, embedded systems, electronics, and power engineering communities.', 'sibacom'); ?>
                        </p>
                        <p style="font-size: 1.05rem; line-height: 1.8; color: var(--sibacom-text-secondary);">
                            <?php esc_html_e('The Olympiad is academically powered by two supporting academic partners—the Department of Computer Systems Engineering and the Department of Electrical Engineering—ensuring state-of-the-art laboratory facilities, faculty advisement, and rigorous international competition adjudication under the overarching institutional umbrella of Sukkur IBA University.', 'sibacom'); ?>
                        </p>
                    </div>

                    <div class="sibacom-highlights-grid" style="margin-bottom: 4rem;">
                        <div class="neu-card sibacom-card-circuit">
                            <?php if (function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
                            <div class="sibacom-highlight-icon"><i class="fa-solid fa-microchip"></i></div>
                            <h3 class="font-display" style="font-size: 1.35rem; margin-bottom: 0.75rem;"><?php esc_html_e('Frontier Engineering', 'sibacom'); ?></h3>
                            <p><?php esc_html_e('High-intensity competitions across AI, cybersecurity CTF, competitive coding, robotics, and hardware co-design.', 'sibacom'); ?></p>
                        </div>
                        <div class="neu-card sibacom-card-circuit">
                            <?php if (function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
                            <div class="sibacom-highlight-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                            <h3 class="font-display" style="font-size: 1.35rem; margin-bottom: 0.75rem;"><?php esc_html_e('Academic Rigor', 'sibacom'); ?></h3>
                            <p><?php esc_html_e('Adjudicated by distinguished faculty, Ph.D. scholars, and senior industry architects with verifiable automated judging engines.', 'sibacom'); ?></p>
                        </div>
                        <div class="neu-card sibacom-card-circuit">
                            <?php if (function_exists('sibacom_the_circuit_corner')) { sibacom_the_circuit_corner('tl'); sibacom_the_circuit_corner('br'); } ?>
                            <div class="sibacom-highlight-icon"><i class="fa-solid fa-network-wired"></i></div>
                            <h3 class="font-display" style="font-size: 1.35rem; margin-bottom: 0.75rem;"><?php esc_html_e('National Ecosystem', 'sibacom'); ?></h3>
                            <p><?php esc_html_e('Connecting student innovators with venture capital firms, technology incubators, and enterprise hiring partners.', 'sibacom'); ?></p>
                        </div>
                    </div>
                </div>

                <?php the_content(); ?>
            </div>
        </div>
        <?php
    }

endwhile;

get_footer();

