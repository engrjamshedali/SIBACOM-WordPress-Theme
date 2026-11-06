<?php
/**
 * Template Name: SIBACOM Guests & Dignitaries Template
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
                        <i class="fa-solid fa-award" style="color: var(--sibacom-techgreen);"></i>
                        <span><?php echo esc_html(get_option('sibacom_guests_sec_badge', __('Dignitaries, Patrons & Guests of Honor', 'sibacom'))); ?></span>
                    </div>
                    <h1 class="font-display"><?php echo esc_html(get_option('sibacom_guests_sec_title', __('Honorable Guests & Institutional Patrons', 'sibacom'))); ?></h1>
                    <p><?php echo esc_html(get_option('sibacom_guests_sec_desc', __('SIBACOM proudly welcomes eminent university leadership, national policymakers, academic dignitaries, and technology industry executives honoring our national Olympiad.', 'sibacom'))); ?></p>
                </header>

                <?php
                if (shortcode_exists('sibacom_guests')) {
                    echo do_shortcode('[sibacom_guests columns="3" fallback="yes"]');
                } else {
                    $theme_default_guests = array(
                        array(
                            'name'        => 'Prof. Dr. Asif Ahmed Shaikh',
                            'category'    => 'Chief Guest & Patron',
                            'designation' => 'Vice Chancellor',
                            'org'         => 'Sukkur IBA University',
                            'bio'         => 'Distinguished academician, scholar, and institutional leader steering Sukkur IBA University to premier national excellence in computing, engineering, and innovation.',
                            'photo_url'   => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80',
                            'linkedin'    => 'https://www.linkedin.com/school/sukkur-iba-university/',
                            'twitter'     => 'https://x.com',
                        ),
                        array(
                            'name'        => 'Engr. Zahid Hussain Khand',
                            'category'    => 'Guest of Honor',
                            'designation' => 'Registrar & Senior Engineer',
                            'org'         => 'Sukkur IBA University',
                            'bio'         => 'Esteemed engineering educator and institutional administrator spearheading academic governance, faculty collaboration, and technical capacity building across university campuses.',
                            'photo_url'   => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=400&q=80',
                            'linkedin'    => 'https://www.linkedin.com/school/sukkur-iba-university/',
                            'twitter'     => 'https://x.com',
                        ),
                        array(
                            'name'        => 'Dr. Sher Muhammad Daudpota',
                            'category'    => 'Distinguished Guest',
                            'designation' => 'Director QEC & Professor of Computer Science',
                            'org'         => 'Sukkur IBA University',
                            'bio'         => 'Senior computer scientist, research mentor, and academic leader overseeing university quality enhancement and fostering algorithmic problem solving and international research initiatives.',
                            'photo_url'   => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=400&q=80',
                            'linkedin'    => 'https://www.linkedin.com/school/sukkur-iba-university/',
                            'twitter'     => 'https://x.com',
                        ),
                    );
                    ?>
                    <div class="sibacom-speakers-grid sibacom-guests-grid col-3">
                        <?php foreach ($theme_default_guests as $g) : ?>
                            <div class="sibacom-speaker-card sibacom-guest-card neu-card sibacom-card-circuit">
                                <?php if (function_exists('sibacom_the_circuit_corner')) {
                                    sibacom_the_circuit_corner('tl');
                                    sibacom_the_circuit_corner('br');
                                } ?>
                                <div class="sibacom-speaker-img-wrap guest-portrait">
                                    <img src="<?php echo esc_url($g['photo_url']); ?>" alt="<?php echo esc_attr($g['name']); ?>" width="140" height="140" loading="lazy" decoding="async">
                                </div>

                                <span class="sibacom-speaker-badge guest-badge">
                                    <i class="fa-solid fa-award" style="margin-right: 4px;"></i>
                                    <?php echo esc_html($g['category']); ?>
                                </span>

                                <h3 class="sibacom-speaker-name font-display"><?php echo esc_html($g['name']); ?></h3>
                                <?php if (!empty($g['designation'])) : ?>
                                    <p class="sibacom-speaker-designation"><?php echo esc_html($g['designation']); ?></p>
                                <?php endif; ?>
                                <?php if (!empty($g['org'])) : ?>
                                    <p class="sibacom-speaker-org"><?php echo esc_html($g['org']); ?></p>
                                <?php endif; ?>

                                <div class="sibacom-speaker-bio">
                                    <?php echo esc_html($g['bio']); ?>
                                </div>

                                <div class="sibacom-speaker-social">
                                    <?php if (!empty($g['linkedin'])) : ?>
                                        <a href="<?php echo esc_url($g['linkedin']); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                                    <?php endif; ?>
                                    <?php if (!empty($g['twitter'])) : ?>
                                        <a href="<?php echo esc_url($g['twitter']); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php
                }
                the_content();
                ?>
            </div>
        </div>
        <?php
    }

endwhile;

get_footer();

