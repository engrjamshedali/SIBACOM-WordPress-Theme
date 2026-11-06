<?php
/**
 * Template Name: SIBACOM Schedule Template
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
                        <i class="fa-regular fa-clock" style="color: var(--sibacom-techgreen);"></i>
                        <span><?php echo esc_html(get_option('sibacom_schedule_sec_badge', __('Complete 1-Day Technical Agenda', 'sibacom'))); ?></span>
                    </div>
                    <h1 class="font-display"><?php echo esc_html(get_option('sibacom_schedule_sec_title', __('SIBACOM Event Schedule', 'sibacom'))); ?></h1>
                    <p><?php echo esc_html(get_option('sibacom_schedule_sec_desc', __('Check chronological session tracks, opening addresses, technical competitions, hackathons, and the grand award ceremony throughout the day.', 'sibacom'))); ?></p>
                </header>

                <!-- Interactive Schedule Day Tabs -->
                <div class="sibacom-schedule-tabs" style="display: flex; justify-content: center; gap: 0.75rem; margin-bottom: 3rem; flex-wrap: wrap;">
                    <button type="button" class="neu-btn sibacom-day-tab active" data-filter="all" style="padding: 0.6rem 1.4rem; font-weight: 700; font-size: 0.95rem; cursor: pointer;">
                        <i class="fa-solid fa-calendar-day" style="margin-right: 0.5rem; color: var(--sibacom-techgreen);"></i><?php esc_html_e('Full Day Schedule', 'sibacom'); ?>
                    </button>
                    <button type="button" class="neu-btn sibacom-day-tab" data-filter="morning" style="padding: 0.6rem 1.4rem; font-weight: 700; font-size: 0.95rem; cursor: pointer;">
                        <i class="fa-solid fa-sun" style="margin-right: 0.5rem; color: var(--sibacom-primary);"></i><?php esc_html_e('Morning – Opening & Keynotes', 'sibacom'); ?>
                    </button>
                    <button type="button" class="neu-btn sibacom-day-tab" data-filter="afternoon" style="padding: 0.6rem 1.4rem; font-weight: 700; font-size: 0.95rem; cursor: pointer;">
                        <i class="fa-solid fa-code" style="margin-right: 0.5rem; color: var(--sibacom-primary);"></i><?php esc_html_e('Afternoon – Competitions & Sprints', 'sibacom'); ?>
                    </button>
                    <button type="button" class="neu-btn sibacom-day-tab" data-filter="evening" style="padding: 0.6rem 1.4rem; font-weight: 700; font-size: 0.95rem; cursor: pointer;">
                        <i class="fa-solid fa-trophy" style="margin-right: 0.5rem; color: var(--sibacom-techgreen);"></i><?php esc_html_e('Evening – Finals & Awards', 'sibacom'); ?>
                    </button>
                </div>

                <?php
                if (shortcode_exists('sibacom_schedule')) {
                    echo do_shortcode('[sibacom_schedule]');
                }
                the_content();
                ?>
            </div>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tabs = document.querySelectorAll('.sibacom-day-tab');
            var items = document.querySelectorAll('.sibacom-timeline-item');
            if (!tabs.length || !items.length) return;

            tabs.forEach(function(tab) {
                tab.addEventListener('click', function() {
                    tabs.forEach(function(t) { t.classList.remove('active'); });
                    this.classList.add('active');
                    var filter = this.getAttribute('data-filter');

                    items.forEach(function(item) {
                        var day = item.getAttribute('data-day');
                        var slot = item.getAttribute('data-slot');
                        var cat = (item.getAttribute('data-category') || '').toLowerCase();
                        if (filter === 'all' || filter === '1' || day === filter || slot === filter || cat === filter) {
                            item.style.display = '';
                        } else {
                            item.style.display = 'none';
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
