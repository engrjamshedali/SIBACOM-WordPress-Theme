<?php
/**
 * Template Name: SIBACOM Speakers Template
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
        <div class="sibacom-circuit-bg" style="padding-top: 3.5rem; padding-bottom: 5.5rem; position: relative;">
            <?php if (function_exists('sibacom_the_circuit_bg')) { sibacom_the_circuit_bg('light'); } ?>
            <div class="sibacom-container" style="position: relative; z-index: 1;">
                <header class="sibacom-section-header">
                    <div class="sibacom-badge">
                        <i class="fa-solid fa-microphone-lines" style="color: var(--sibacom-techgreen);"></i>
                        <span><?php esc_html_e('Distinguished Experts & Jury', 'sibacom'); ?></span>
                    </div>
                    <h1 class="font-display"><?php esc_html_e('Meet Our Keynote Speakers & Judges', 'sibacom'); ?></h1>
                    <p><?php esc_html_e('Eminent researchers, industry chief architects, and senior academic leaders adjudicating competitive brackets and sharing frontier insights at SIBACOM.', 'sibacom'); ?></p>
                </header>

                <!-- Category Filter Pills -->
                <div class="sibacom-speaker-filters" style="display: flex; justify-content: center; gap: 0.65rem; margin-bottom: 3rem; flex-wrap: wrap;">
                    <button type="button" class="neu-btn sibacom-speaker-pill active" data-filter="all" style="padding: 0.55rem 1.35rem; font-weight: 700; font-size: 0.9rem; cursor: pointer;">
                        <i class="fa-solid fa-users" style="margin-right: 0.4rem; color: var(--sibacom-techgreen);"></i><?php esc_html_e('All Experts', 'sibacom'); ?>
                    </button>
                    <button type="button" class="neu-btn sibacom-speaker-pill" data-filter="keynote" style="padding: 0.55rem 1.35rem; font-weight: 700; font-size: 0.9rem; cursor: pointer;">
                        <i class="fa-solid fa-star" style="margin-right: 0.4rem; color: var(--sibacom-primary);"></i><?php esc_html_e('Keynote Speakers', 'sibacom'); ?>
                    </button>
                    <button type="button" class="neu-btn sibacom-speaker-pill" data-filter="judge" style="padding: 0.55rem 1.35rem; font-weight: 700; font-size: 0.9rem; cursor: pointer;">
                        <i class="fa-solid fa-gavel" style="margin-right: 0.4rem; color: var(--sibacom-primary);"></i><?php esc_html_e('Competition Judges', 'sibacom'); ?>
                    </button>
                    <button type="button" class="neu-btn sibacom-speaker-pill" data-filter="trainer" style="padding: 0.55rem 1.35rem; font-weight: 700; font-size: 0.9rem; cursor: pointer;">
                        <i class="fa-solid fa-chalkboard-user" style="margin-right: 0.4rem; color: var(--sibacom-techgreen);"></i><?php esc_html_e('Technical Trainers', 'sibacom'); ?>
                    </button>
                </div>

                <?php
                if (shortcode_exists('sibacom_speakers')) {
                    echo do_shortcode('[sibacom_speakers]');
                }
                the_content();
                ?>
            </div>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var pills = document.querySelectorAll('.sibacom-speaker-pill');
            var cards = document.querySelectorAll('.sibacom-speaker-card');
            if (!pills.length || !cards.length) return;

            pills.forEach(function(pill) {
                pill.addEventListener('click', function() {
                    pills.forEach(function(p) { p.classList.remove('active'); });
                    this.classList.add('active');
                    var filter = this.getAttribute('data-filter');

                    cards.forEach(function(card) {
                        var cat = card.getAttribute('data-category') || '';
                        if (filter === 'all' || cat.indexOf(filter) !== -1) {
                            card.style.display = '';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
        });
        </script>
        <?php
    }

endwhile;

get_footer();
