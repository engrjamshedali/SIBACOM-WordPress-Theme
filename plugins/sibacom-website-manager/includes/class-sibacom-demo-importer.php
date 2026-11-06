<?php
/**
 * SIBACOM One-Click Demo Content Importer
 *
 * @package SIBACOM_Website_Manager
 */

if (!defined('ABSPATH')) {
    exit;
}

class SIBACOM_Demo_Importer {

    public static function init() {
        add_action('wp_ajax_sibacom_run_demo_import', array(__CLASS__, 'ajax_import_demo'));
    }

    public static function ajax_import_demo() {
        check_ajax_referer('sibacom_admin_nonce', 'nonce');

        if (!current_user_can('manage_options')) {
            wp_send_json_error(array('message' => esc_html__('Permission denied.', 'sibacom-manager')));
        }

        $result = self::run_import();
        wp_send_json_success(array('message' => $result));
    }

    public static function run_import() {
        // 1. Populate default settings
        SIBACOM_Settings::set_defaults();

        // 2. Create Pages
        $pages = array(
            'home' => array(
                'title'    => 'Home',
                'template' => 'templates/template-home.php',
                'content'  => '<!-- SIBACOM Homepage Dynamic Content -->',
            ),
            'about' => array(
                'title'    => 'About SIBACOM',
                'template' => 'templates/template-about.php',
                'content'  => '<!-- SIBACOM About Page Content -->',
            ),
            'events' => array(
                'title'    => 'Events & Pricing',
                'template' => 'templates/template-events.php',
                'content'  => '<!-- SIBACOM Events & Pricing Page Content -->',
            ),
            'schedule' => array(
                'title'    => 'Event Schedule',
                'template' => 'templates/template-schedule.php',
                'content'  => '<!-- SIBACOM Schedule Page Content -->',
            ),
            'speakers' => array(
                'title'    => 'Speakers & Judges',
                'template' => 'templates/template-speakers.php',
                'content'  => '<!-- SIBACOM Speakers Page Content -->',
            ),
            'guests' => array(
                'title'    => 'Dignitaries & Guests',
                'template' => 'templates/template-guests.php',
                'content'  => '<!-- SIBACOM Guests Page Content -->',
            ),
            'organizers' => array(
                'title'    => 'Organizing Committee',
                'template' => 'templates/template-organizers.php',
                'content'  => '<!-- SIBACOM Organizers Page Content -->',
            ),
            'sponsors' => array(
                'title'    => 'Partners & Sponsors',
                'template' => 'templates/template-sponsors.php',
                'content'  => '<!-- SIBACOM Sponsors Page Content -->',
            ),
            'contact' => array(
                'title'    => 'Contact Us',
                'template' => 'templates/template-contact.php',
                'content'  => '<!-- SIBACOM Contact Page Content -->',
            ),
        );

        $created_page_ids = array();
        foreach ($pages as $slug => $p) {
            $existing = get_page_by_path($slug);
            if (!$existing) {
                $page_id = wp_insert_post(array(
                    'post_title'   => $p['title'],
                    'post_name'    => $slug,
                    'post_status'  => 'publish',
                    'post_type'    => 'page',
                    'post_content' => $p['content'],
                ));
                if ($page_id && !is_wp_error($page_id)) {
                    update_post_meta($page_id, '_wp_page_template', $p['template']);
                    $created_page_ids[$slug] = $page_id;
                }
            } else {
                $created_page_ids[$slug] = $existing->ID;
            }
        }

        // Bootstrap Elementor layout and widgets for all pages
        foreach ($created_page_ids as $slug => $page_id) {
            if (class_exists('SIBACOM_Elementor_Init')) {
                SIBACOM_Elementor_Init::instance()->bootstrap_page_if_needed($page_id);
            }
        }

        // Set Home as Front Page
        if (isset($created_page_ids['home'])) {
            update_option('show_on_front', 'page');
            update_option('page_on_front', $created_page_ids['home']);
        }

        // 3. Create or Synchronize Navigation Menu
        $menu_name = 'SIBACOM Primary Navigation';
        $menu_exists = wp_get_nav_menu_object($menu_name);

        $menu_items = array(
            array('title' => 'Home',       'page' => 'home'),
            array('title' => 'About',      'page' => 'about'),
            array('title' => 'Events',     'page' => 'events'),
            array('title' => 'Schedule',   'page' => 'schedule'),
            array('title' => 'Speakers',   'page' => 'speakers'),
            array('title' => 'Guests',     'page' => 'guests'),
            array('title' => 'Organizers', 'page' => 'organizers'),
            array('title' => 'Contact',    'page' => 'contact'),
        );

        if (!$menu_exists) {
            $menu_id = wp_create_nav_menu($menu_name);

            foreach ($menu_items as $order => $item) {
                if (isset($created_page_ids[$item['page']])) {
                    wp_update_nav_menu_item($menu_id, 0, array(
                        'menu-item-title'     => $item['title'],
                        'menu-item-object'    => 'page',
                        'menu-item-object-id' => $created_page_ids[$item['page']],
                        'menu-item-type'      => 'post_type',
                        'menu-item-status'    => 'publish',
                        'menu-item-position'  => $order + 1,
                    ));
                }
            }

            // Assign to theme location
            $locations = get_theme_mod('nav_menu_locations');
            if (!is_array($locations)) {
                $locations = array();
            }
            $locations['primary-menu'] = $menu_id;
            set_theme_mod('nav_menu_locations', $locations);
        } else {
            $menu_id = $menu_exists->term_id;

            // Remove any obsolete Sponsors item from existing menu
            $existing_items = wp_get_nav_menu_items($menu_id);
            $existing_pages = array();
            if ($existing_items && is_array($existing_items)) {
                foreach ($existing_items as $ei) {
                    $t = strtolower(trim($ei->title));
                    $u = strtolower(trim($ei->url));
                    if ($t === 'sponsors' || strpos($t, 'sponsor') !== false || strpos($u, '/sponsors') !== false || strpos($u, 'sponsors.html') !== false) {
                        wp_delete_post($ei->ID, true);
                    } else {
                        if ($ei->object_id) {
                            $existing_pages[] = (int)$ei->object_id;
                        }
                    }
                }
            }

            // If Events is not yet in the menu, add it after About
            if (isset($created_page_ids['events']) && !in_array((int)$created_page_ids['events'], $existing_pages)) {
                wp_update_nav_menu_item($menu_id, 0, array(
                    'menu-item-title'     => 'Events',
                    'menu-item-object'    => 'page',
                    'menu-item-object-id' => $created_page_ids['events'],
                    'menu-item-type'      => 'post_type',
                    'menu-item-status'    => 'publish',
                    'menu-item-position'  => 3,
                ));
            }
        }

        // 4. Seed Event Competitions & Pricing (sibacom_event) - EXACTLY 9 OFFICIAL COMPETITIONS (SIBACOM 2026 PROPOSAL)
        $events = array(
            array(
                'title'       => 'Circuit Design Competition',
                'excerpt'     => 'Three-stage technical electronics challenge: Stage 1 MCQs screening, Stage 2 Breadboard Circuit Design, and Stage 3 Complex Circuit Design. Evaluated on creativity, functionality, efficiency, and practical circuit skills.',
                'date'        => 'November 26, 2026 (Proposed)',
                'start_time'  => '09:00 AM',
                'end_time'    => '01:00 PM',
                'venue'       => 'Campus Technical Lab (Awaiting Confirmation)',
                'fee_type'    => 'team',
                'fee_amount'  => 'PKR 500/Team',
                'reg_open'    => 'October 01, 2026',
                'reg_close'   => 'November 20, 2026',
                'status'      => 'open',
                'featured'    => 'yes',
                'order'       => 1,
                'banner_url'  => 'https://images.unsplash.com/photo-1517077304055-6e89abbf09b0?auto=format&fit=crop&w=800&q=80',
            ),
            array(
                'title'       => 'E-Games Championship',
                'excerpt'     => 'High-stakes collegiate e-sports tournament featuring FIFA, Call of Duty, CS:GO, and PUBG. Online competition with live streaming and team matches for up to 4 players.',
                'date'        => 'November 26, 2026 (Proposed)',
                'start_time'  => '10:00 AM',
                'end_time'    => '06:00 PM',
                'venue'       => 'Online Tournament Hub & Live Broadcast',
                'fee_type'    => 'team',
                'fee_amount'  => 'PKR 500/Team',
                'reg_open'    => 'October 01, 2026',
                'reg_close'   => 'November 20, 2026',
                'status'      => 'open',
                'featured'    => 'yes',
                'order'       => 2,
                'banner_url'  => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&w=800&q=80',
            ),
            array(
                'title'       => 'Robo War',
                'excerpt'     => 'Combative robotics engineering showdown. Features pre-competition hands-on robot-building workshop with Arduino introduction, equipment demonstrations, and mentor assistance.',
                'date'        => 'November 26, 2026 (Proposed)',
                'start_time'  => '09:30 AM',
                'end_time'    => '05:00 PM',
                'venue'       => 'Robotics Combat Arena (Awaiting Confirmation)',
                'fee_type'    => 'team',
                'fee_amount'  => 'PKR 500/Team',
                'reg_open'    => 'October 01, 2026',
                'reg_close'   => 'November 20, 2026',
                'status'      => 'open',
                'featured'    => 'yes',
                'order'       => 3,
                'banner_url'  => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?auto=format&fit=crop&w=800&q=80',
            ),
            array(
                'title'       => 'Drone Competition',
                'excerpt'     => 'Precision aerial flight and agility competition. Preceded by an intensive drone-building and piloting workshop covering components, assembly, telemetry, and safe flight protocols.',
                'date'        => 'November 26, 2026 (Proposed)',
                'start_time'  => '10:00 AM',
                'end_time'    => '04:00 PM',
                'venue'       => 'Outdoor Flight Arena (Awaiting Confirmation)',
                'fee_type'    => 'team',
                'fee_amount'  => 'PKR 500/Team',
                'reg_open'    => 'October 01, 2026',
                'reg_close'   => 'November 20, 2026',
                'status'      => 'open',
                'featured'    => 'yes',
                'order'       => 4,
                'banner_url'  => 'https://images.unsplash.com/photo-1508614589041-895b88991e3e?auto=format&fit=crop&w=800&q=80',
            ),
            array(
                'title'       => 'Line Following Robot (LFR)',
                'excerpt'     => 'Autonomous robotics tracking challenge. Features an intensive workshop covering Arduino, IR sensor calibration, motor drivers, and closed-loop control algorithms.',
                'date'        => 'November 26, 2026 (Proposed)',
                'start_time'  => '09:00 AM',
                'end_time'    => '03:00 PM',
                'venue'       => 'Robotics Track Arena (Awaiting Confirmation)',
                'fee_type'    => 'team',
                'fee_amount'  => 'PKR 500/Team',
                'reg_open'    => 'October 01, 2026',
                'reg_close'   => 'November 20, 2026',
                'status'      => 'open',
                'featured'    => 'yes',
                'order'       => 5,
                'banner_url'  => 'https://images.unsplash.com/photo-1561557944-6e7860d1a7eb?auto=format&fit=crop&w=800&q=80',
            ),
            array(
                'title'       => 'Programming Challenge',
                'excerpt'     => 'Two-round competitive coding contest on HackerRank testing data structures, algorithmic complexity, and speed. Minimum 60 minutes per round for teams up to 2.',
                'date'        => 'November 26, 2026 (Proposed)',
                'start_time'  => '09:00 AM',
                'end_time'    => '02:00 PM',
                'venue'       => 'Lab-II & English Lab, Academic Block-I',
                'fee_type'    => 'team',
                'fee_amount'  => 'PKR 500/Team',
                'reg_open'    => 'October 01, 2026',
                'reg_close'   => 'November 20, 2026',
                'status'      => 'open',
                'featured'    => 'yes',
                'order'       => 6,
                'banner_url'  => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=800&q=80',
            ),
            array(
                'title'       => 'ICT Quiz Contest',
                'excerpt'     => 'Fast-paced individual technology intelligence challenge spanning two 60-minute rounds. Initial screening conducted interactively on the Kahoot platform.',
                'date'        => 'November 26, 2026 (Proposed)',
                'start_time'  => '11:00 AM',
                'end_time'    => '01:00 PM',
                'venue'       => 'Auditorium, Sukkur IBA University',
                'fee_type'    => 'paid',
                'fee_amount'  => 'PKR 200/Participant',
                'reg_open'    => 'October 01, 2026',
                'reg_close'   => 'November 20, 2026',
                'status'      => 'open',
                'featured'    => 'yes',
                'order'       => 7,
                'banner_url'  => 'https://images.unsplash.com/photo-1606326608606-aa0b62935f2b?auto=format&fit=crop&w=800&q=80',
            ),
            array(
                'title'       => 'Project Exhibition (Hardware & Software)',
                'excerpt'     => 'Comprehensive project showcase in Medical, Climate, Agriculture, and General themes. Features Junior (up to 5th sem) and Senior (6th sem onwards) cohorts with separate prizes for Hardware and Software.',
                'date'        => 'November 26, 2026 (Proposed)',
                'start_time'  => '09:30 AM',
                'end_time'    => '04:30 PM',
                'venue'       => 'VFX Lab, FYP Lab & Fab Lab',
                'fee_type'    => 'team',
                'fee_amount'  => 'PKR 500/Team',
                'reg_open'    => 'October 01, 2026',
                'reg_close'   => 'November 20, 2026',
                'status'      => 'open',
                'featured'    => 'yes',
                'order'       => 8,
                'banner_url'  => 'https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=800&q=80',
            ),
            array(
                'title'       => 'Tug of War (Fun Activities)',
                'excerpt'     => 'High-energy team sports competition focused on teamwork, synchronization, physical strength, strategy, coordination, and athletic endurance.',
                'date'        => 'November 26, 2026 (Proposed)',
                'start_time'  => '03:00 PM',
                'end_time'    => '05:30 PM',
                'venue'       => 'University Sports Ground (Awaiting Confirmation)',
                'fee_type'    => 'team',
                'fee_amount'  => 'PKR 300/Team',
                'reg_open'    => 'October 01, 2026',
                'reg_close'   => 'November 20, 2026',
                'status'      => 'open',
                'featured'    => 'yes',
                'order'       => 9,
                'banner_url'  => 'https://images.unsplash.com/photo-1526676037777-05a232554f77?auto=format&fit=crop&w=800&q=80',
            ),
        );

        foreach ($events as $ev) {
            $existing = get_page_by_title($ev['title'], OBJECT, 'sibacom_event');
            if (!$existing) {
                $post_id = wp_insert_post(array(
                    'post_title'   => $ev['title'],
                    'post_excerpt' => $ev['excerpt'],
                    'post_content' => $ev['excerpt'],
                    'post_type'    => 'sibacom_event',
                    'post_status'  => 'publish',
                    'menu_order'   => $ev['order'],
                ));
                if ($post_id) {
                    update_post_meta($post_id, '_sibacom_event_date', $ev['date']);
                    update_post_meta($post_id, '_sibacom_event_start_time', $ev['start_time']);
                    update_post_meta($post_id, '_sibacom_event_end_time', $ev['end_time']);
                    update_post_meta($post_id, '_sibacom_event_venue', $ev['venue']);
                    update_post_meta($post_id, '_sibacom_event_fee_type', $ev['fee_type']);
                    update_post_meta($post_id, '_sibacom_event_fee_amount', $ev['fee_amount']);
                    update_post_meta($post_id, '_sibacom_event_reg_open', $ev['reg_open']);
                    update_post_meta($post_id, '_sibacom_event_reg_close', $ev['reg_close']);
                    update_post_meta($post_id, '_sibacom_event_status_mode', 'manual');
                    update_post_meta($post_id, '_sibacom_event_status', $ev['status']);
                    update_post_meta($post_id, '_sibacom_event_featured', $ev['featured']);
                    update_post_meta($post_id, '_sibacom_event_visibility', 'visible');
                    update_post_meta($post_id, '_sibacom_event_order', $ev['order']);
                    update_post_meta($post_id, '_sibacom_event_banner_url', $ev['banner_url']);
                }
            } else {
                update_post_meta($existing->ID, '_sibacom_event_date', $ev['date']);
                update_post_meta($existing->ID, '_sibacom_event_start_time', $ev['start_time']);
                update_post_meta($existing->ID, '_sibacom_event_end_time', $ev['end_time']);
                update_post_meta($existing->ID, '_sibacom_event_venue', $ev['venue']);
                update_post_meta($existing->ID, '_sibacom_event_fee_type', $ev['fee_type']);
                update_post_meta($existing->ID, '_sibacom_event_fee_amount', $ev['fee_amount']);
                update_post_meta($existing->ID, '_sibacom_event_reg_open', $ev['reg_open']);
                update_post_meta($existing->ID, '_sibacom_event_reg_close', $ev['reg_close']);
                update_post_meta($existing->ID, '_sibacom_event_status_mode', 'manual');
                update_post_meta($existing->ID, '_sibacom_event_status', $ev['status']);
                update_post_meta($existing->ID, '_sibacom_event_featured', $ev['featured']);
                update_post_meta($existing->ID, '_sibacom_event_visibility', 'visible');
                update_post_meta($existing->ID, '_sibacom_event_order', $ev['order']);
                update_post_meta($existing->ID, '_sibacom_event_banner_url', $ev['banner_url']);
            }
        }

        // 5. Seed Sessions (Schedule)
        $sessions = array(
            array(
                'title'         => 'Delegate Check-In & Institutional Accreditation',
                'content'       => 'Verification of university credentials, issuance of smart RFID passes, and delegate welcome kit collection at the executive complex.',
                'day'           => '1',
                'start'         => '08:00 AM',
                'end'           => '09:00 AM',
                'duration'      => '60 Min',
                'speaker'       => 'SIBACOM Operations Secretariat',
                'speaker_photo' => '',
                'icon'          => 'fa-solid fa-id-card',
                'venue'         => 'Main Foyer, Executive Complex',
                'category'      => 'ceremony',
                'order'         => 1,
                'featured'      => 'no',
                'visibility'    => 'visible',
            ),
            array(
                'title'         => 'Grand Inaugural Ceremony & Keynote Address',
                'content'       => 'Official inauguration address by the Honorable Vice Chancellor, introduction of jury deans, and inaugural showcase of SIBACOM 2026.',
                'day'           => '1',
                'start'         => '09:00 AM',
                'end'           => '10:15 AM',
                'duration'      => '75 Min',
                'speaker'       => 'Engr. Dr. Zahid Hussain (Vice Chancellor)',
                'speaker_photo' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=300&auto=format&fit=crop&q=80',
                'icon'          => 'fa-solid fa-microphone',
                'venue'         => 'Nisar Ahmed Siddiqui Auditorium',
                'category'      => 'keynote',
                'order'         => 2,
                'featured'      => 'yes',
                'visibility'    => 'visible',
            ),
            array(
                'title'         => 'Keynote: "Engineering Scalable AI Systems for Developing Nations"',
                'content'       => 'Distinguished presentation on sovereign machine intelligence, localized foundation models, and high-throughput computational architectures.',
                'day'           => '1',
                'start'         => '10:15 AM',
                'end'           => '11:15 AM',
                'duration'      => '60 Min',
                'speaker'       => 'Dr. Asim Khwaja',
                'speaker_photo' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=300&auto=format&fit=crop&q=80',
                'icon'          => 'fa-solid fa-lightbulb',
                'venue'         => 'Nisar Ahmed Siddiqui Auditorium',
                'category'      => 'keynote',
                'order'         => 3,
                'featured'      => 'yes',
                'visibility'    => 'visible',
            ),
            array(
                'title'         => 'Technical Module Briefings & Lab Sandboxes',
                'content'       => 'Rules review, environment setup, and compiler sandboxes dry run for registered competitive programming and CTF delegates.',
                'day'           => '1',
                'start'         => '11:15 AM',
                'end'           => '12:00 PM',
                'duration'      => '45 Min',
                'speaker'       => 'Faculty Technical Secretariat',
                'speaker_photo' => '',
                'icon'          => 'fa-solid fa-laptop-code',
                'venue'         => 'Department of CSE Laboratories',
                'category'      => 'workshop',
                'order'         => 4,
                'featured'      => 'no',
                'visibility'    => 'visible',
            ),
            array(
                'title'         => 'Speed Programming League (Championship Round)',
                'content'       => 'Timed algorithmic problem-solving sprint featuring live automated scoreboard ranking and code verification.',
                'day'           => '1',
                'start'         => '12:00 PM',
                'end'           => '02:00 PM',
                'duration'      => '2 Hours',
                'speaker'       => 'ACM Adjudication Jury',
                'speaker_photo' => '',
                'icon'          => 'fa-solid fa-code',
                'venue'         => 'CSE Labs 1 & 2',
                'category'      => 'competition',
                'order'         => 5,
                'featured'      => 'no',
                'visibility'    => 'visible',
            ),
            array(
                'title'         => 'Networking Luncheon & Technical Posters Showcase',
                'content'       => 'Midday networking luncheon, delegate interaction, and poster exhibition of cutting-edge university research projects.',
                'day'           => '1',
                'start'         => '01:30 PM',
                'end'           => '02:30 PM',
                'duration'      => '60 Min',
                'speaker'       => 'SIBACOM Secretariat',
                'speaker_photo' => '',
                'icon'          => 'fa-solid fa-mug-saucer',
                'venue'         => 'Executive Lawn & Dining Hall',
                'category'      => 'break',
                'order'         => 6,
                'featured'      => 'no',
                'visibility'    => 'visible',
            ),
            array(
                'title'         => 'Capture The Flag (CTF) Cyber Defense Tournament',
                'content'       => 'Jeopardy-style security tournament: cryptography, binary exploitation, web vulnerabilities, and network forensics.',
                'day'           => '1',
                'start'         => '02:30 PM',
                'end'           => '05:00 PM',
                'duration'      => '2.5 Hours',
                'speaker'       => 'Cyber Defense Society',
                'speaker_photo' => '',
                'icon'          => 'fa-solid fa-shield-halved',
                'venue'         => 'Cyber Security Research Lab',
                'category'      => 'competition',
                'order'         => 7,
                'featured'      => 'no',
                'visibility'    => 'visible',
            ),
            array(
                'title'         => 'RoboWars & Autonomous Arena Clashes',
                'content'       => 'Featherweight combat robot clashes and autonomous line-follower micro-maze navigation rounds.',
                'day'           => '1',
                'start'         => '02:30 PM',
                'end'           => '04:45 PM',
                'duration'      => '2 Hours 15 Min',
                'speaker'       => 'Robotics Technical Committee',
                'speaker_photo' => '',
                'icon'          => 'fa-solid fa-robot',
                'venue'         => 'Sports Complex Arena',
                'category'      => 'competition',
                'order'         => 8,
                'featured'      => 'yes',
                'visibility'    => 'visible',
            ),
            array(
                'title'         => 'SIBACOM Fast-Track AI & Software Sprint',
                'content'       => 'High-intensity product engineering sprint where shortlisted university teams build and showcase innovative AI solutions.',
                'day'           => '1',
                'start'         => '02:30 PM',
                'end'           => '05:00 PM',
                'duration'      => '2.5 Hours',
                'speaker'       => 'Innovation Track Leads',
                'speaker_photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300&auto=format&fit=crop&q=80',
                'icon'          => 'fa-solid fa-fire',
                'venue'         => 'Executive Innovation Hall',
                'category'      => 'competition',
                'order'         => 9,
                'featured'      => 'yes',
                'visibility'    => 'visible',
            ),
            array(
                'title'         => 'Grand Award Ceremony, Shields & Gala Dinner',
                'content'       => 'Conferment of champion trophies, cash prize pool, honorary shields, and formal closing address by dignitaries.',
                'day'           => '1',
                'start'         => '05:30 PM',
                'end'           => '07:30 PM',
                'duration'      => '2 Hours',
                'speaker'       => 'Patron & Guests of Honor',
                'speaker_photo' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=300&auto=format&fit=crop&q=80',
                'icon'          => 'fa-solid fa-trophy',
                'venue'         => 'Nisar Ahmed Siddiqui Auditorium',
                'category'      => 'ceremony',
                'order'         => 10,
                'featured'      => 'yes',
                'visibility'    => 'visible',
            ),
        );

        foreach ($sessions as $s) {
            $existing = get_page_by_title($s['title'], OBJECT, 'sibacom_session');
            if (!$existing) {
                $post_id = wp_insert_post(array(
                    'post_title'   => $s['title'],
                    'post_content' => $s['content'],
                    'post_type'    => 'sibacom_session',
                    'post_status'  => 'publish',
                    'menu_order'   => $s['order'],
                ));
                if ($post_id) {
                    update_post_meta($post_id, '_sibacom_session_day', $s['day']);
                    update_post_meta($post_id, '_sibacom_session_start', $s['start']);
                    update_post_meta($post_id, '_sibacom_session_end', $s['end']);
                    update_post_meta($post_id, '_sibacom_session_duration', !empty($s['duration']) ? $s['duration'] : '');
                    update_post_meta($post_id, '_sibacom_session_speaker', $s['speaker']);
                    update_post_meta($post_id, '_sibacom_session_speaker_photo', !empty($s['speaker_photo']) ? $s['speaker_photo'] : '');
                    update_post_meta($post_id, '_sibacom_session_icon', !empty($s['icon']) ? $s['icon'] : '');
                    update_post_meta($post_id, '_sibacom_session_venue', $s['venue']);
                    update_post_meta($post_id, '_sibacom_session_category', $s['category']);
                    update_post_meta($post_id, '_sibacom_session_order', $s['order']);
                    update_post_meta($post_id, '_sibacom_session_featured', !empty($s['featured']) ? $s['featured'] : 'no');
                    update_post_meta($post_id, '_sibacom_session_visibility', !empty($s['visibility']) ? $s['visibility'] : 'visible');
                }
            }
        }

        // 6. Seed Competition Judges & Guests (sibacom_speaker)
        $speakers = array(
            array(
                'name'        => 'Dr. Bushra Naeem',
                'content'     => 'Senior research evaluator with deep expertise in embedded computer vision, smart robotics, and high-stakes coding evaluations.',
                'role_type'   => 'judge',
                'designation' => 'Associate Professor & Lead AI / Robotics Jury',
                'org'         => 'Sukkur IBA University',
                'category'    => 'Competition Judges',
                'topic'       => 'Algorithmic Resilience & Autonomous Robotics Adjudication',
                'linkedin'    => 'https://linkedin.com',
                'twitter'     => 'https://x.com',
                'github'      => 'https://github.com',
                'photo_url'   => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80',
                'featured'    => 'yes',
                'order'       => 1,
            ),
            array(
                'name'        => 'Tariq Mehmood',
                'content'     => 'Enterprise technology executive and software judge evaluating speed-programming, database optimization, and venture-ready technical solutions.',
                'role_type'   => 'judge',
                'designation' => 'Chief Technology Officer & Enterprise Hackathon Judge',
                'org'         => 'Techlogix Pakistan',
                'category'    => 'Industry Jury',
                'topic'       => 'Commercial Scalability & Full-Stack System Architectures',
                'linkedin'    => 'https://linkedin.com',
                'twitter'     => 'https://x.com',
                'github'      => 'https://github.com',
                'photo_url'   => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=400&q=80',
                'featured'    => 'yes',
                'order'       => 2,
            ),
            array(
                'name'        => 'Dr. Asim Khwaja',
                'content'     => 'Pioneering researcher in machine intelligence, localized foundation models, and high-throughput computational architectures.',
                'role_type'   => 'judge',
                'designation' => 'Director of Applied AI & Hackathon Jury Chair',
                'org'         => 'Center for Frontier Computing & AI',
                'category'    => 'Competition Judges',
                'topic'       => 'Frontier AI Models & Machine Intelligence Benchmarking',
                'linkedin'    => 'https://linkedin.com',
                'twitter'     => 'https://x.com',
                'github'      => 'https://github.com',
                'photo_url'   => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=400&q=80',
                'featured'    => 'yes',
                'order'       => 3,
            ),
            array(
                'name'        => 'Engr. Faraz Ahmed',
                'content'     => 'Industry veteran evaluating enterprise software architecture, low-latency microservices, and speed-programming competitions.',
                'role_type'   => 'judge',
                'designation' => 'Principal Cloud Architect & Speed-Programming Judge',
                'org'         => 'Systems Limited',
                'category'    => 'Industry Jury',
                'topic'       => 'Cloud-Native Microservices & High-Scale Systems',
                'linkedin'    => 'https://linkedin.com',
                'twitter'     => 'https://x.com',
                'github'      => 'https://github.com',
                'photo_url'   => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=400&q=80',
                'featured'    => 'yes',
                'order'       => 4,
            ),
            array(
                'name'        => 'Prof. Dr. Asif Ahmed Shaikh',
                'content'     => 'Distinguished academician, scholar, and institutional visionary serving as the Vice Chancellor of Sukkur IBA University, steering the institution to premier national excellence in computing, engineering, and innovation.',
                'role_type'   => 'guest',
                'designation' => 'Vice Chancellor & Chief Patron',
                'org'         => 'Sukkur IBA University',
                'category'    => 'Chief Guests',
                'topic'       => 'Inaugural Address: Innovation in Pakistani Higher Education',
                'linkedin'    => 'https://www.linkedin.com/school/sukkur-iba-university/',
                'twitter'     => 'https://x.com',
                'github'      => '',
                'photo_url'   => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=400&q=80',
                'featured'    => 'yes',
                'order'       => 5,
            ),
            array(
                'name'        => 'Engr. Zahid Hussain Khand',
                'content'     => 'Esteemed engineering educator and institutional administrator spearheading academic governance, faculty collaboration, and technical capacity building across university campuses.',
                'role_type'   => 'guest',
                'designation' => 'Registrar & Senior Engineer',
                'org'         => 'Sukkur IBA University',
                'category'    => 'Special Guests',
                'topic'       => 'Keynote: Engineering Governance & Future Skills',
                'linkedin'    => 'https://www.linkedin.com/school/sukkur-iba-university/',
                'twitter'     => 'https://x.com',
                'github'      => '',
                'photo_url'   => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=400&q=80',
                'featured'    => 'yes',
                'order'       => 6,
            ),
            array(
                'name'        => 'Dr. Sher Muhammad Daudpota',
                'content'     => 'Senior computer scientist, research mentor, and academic leader overseeing university quality enhancement and fostering algorithmic problem solving and international research initiatives.',
                'role_type'   => 'guest',
                'designation' => 'Director QEC & Professor of Computer Science',
                'org'         => 'Sukkur IBA University',
                'category'    => 'Special Guests',
                'topic'       => 'Academic Rigor & Algorithmic Excellence in Tech Competitions',
                'linkedin'    => 'https://www.linkedin.com/school/sukkur-iba-university/',
                'twitter'     => 'https://x.com',
                'github'      => '',
                'photo_url'   => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=400&q=80',
                'featured'    => 'yes',
                'order'       => 7,
            ),
            array(
                'name'        => 'Engr. Kashif Ali Memon',
                'content'     => 'Specialist in computer architecture, hardware-software co-design, and faculty advisor for the CSE Society (Technology Circuit).',
                'role_type'   => 'trainer',
                'designation' => 'Assistant Professor, Dept. of CSE',
                'org'         => 'Sukkur IBA University',
                'category'    => 'Trainers',
                'topic'       => 'Bridging the Embedded Hardware & High-Speed Software Divide',
                'linkedin'    => 'https://linkedin.com',
                'twitter'     => 'https://x.com',
                'github'      => 'https://github.com',
                'photo_url'   => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=400&q=80',
                'featured'    => 'no',
                'order'       => 8,
            ),
            array(
                'name'        => 'Syeda Mahnoor',
                'content'     => 'Specialist in multi-platform design systems, cognitive ergonomics, and accessibility for high-frequency mobile consumer applications.',
                'role_type'   => 'trainer',
                'designation' => 'Staff Product Designer',
                'org'         => 'Careem (Delivery Hero)',
                'category'    => 'Trainers',
                'topic'       => 'Heuristics of World-Class Neumorphic & Micro-UX Design',
                'linkedin'    => 'https://linkedin.com',
                'twitter'     => 'https://x.com',
                'github'      => 'https://github.com',
                'photo_url'   => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80',
                'featured'    => 'no',
                'order'       => 9,
            ),
        );

        foreach ($speakers as $spk) {
            $existing = get_page_by_title($spk['name'], OBJECT, 'sibacom_speaker');
            if (!$existing) {
                $post_id = wp_insert_post(array(
                    'post_title'   => $spk['name'],
                    'post_content' => $spk['content'],
                    'post_excerpt' => $spk['content'],
                    'post_type'    => 'sibacom_speaker',
                    'post_status'  => 'publish',
                    'menu_order'   => $spk['order'],
                ));
                if ($post_id) {
                    update_post_meta($post_id, '_sibacom_speaker_role_type', $spk['role_type']);
                    update_post_meta($post_id, '_sibacom_speaker_designation', $spk['designation']);
                    update_post_meta($post_id, '_sibacom_speaker_org', $spk['org']);
                    update_post_meta($post_id, '_sibacom_speaker_category', $spk['category']);
                    update_post_meta($post_id, '_sibacom_speaker_topic', $spk['topic']);
                    update_post_meta($post_id, '_sibacom_speaker_bio', $spk['content']);
                    update_post_meta($post_id, '_sibacom_speaker_linkedin', $spk['linkedin']);
                    if (!empty($spk['twitter'])) update_post_meta($post_id, '_sibacom_speaker_twitter', $spk['twitter']);
                    if (!empty($spk['github'])) update_post_meta($post_id, '_sibacom_speaker_github', $spk['github']);
                    update_post_meta($post_id, '_sibacom_speaker_photo_url', $spk['photo_url']);
                    update_post_meta($post_id, '_sibacom_speaker_featured', $spk['featured']);
                    update_post_meta($post_id, '_sibacom_speaker_order', $spk['order']);
                }
            }
        }

        // 7. Seed Sponsors (sibacom_sponsor)
        $sponsors = array(
            array(
                'name'  => 'Higher Education Commission (HEC)',
                'tier'  => 'Title Sponsor',
                'url'   => 'https://hec.gov.pk',
                'logo'  => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/cd/Higher_Education_Commission_Pakistan_logo.svg/320px-Higher_Education_Commission_Pakistan_logo.svg.png',
                'order' => 1,
            ),
            array(
                'name'  => 'Systems Limited',
                'tier'  => 'Main Sponsors',
                'url'   => 'https://www.systemsltd.com',
                'logo'  => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR61nJomjY7YfK9lGvQf3z_lT5u_kI0A-kxgA&s',
                'order' => 2,
            ),
            array(
                'name'  => '10Pearls',
                'tier'  => 'Gold Sponsors',
                'url'   => 'https://10pearls.com',
                'logo'  => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR-q3jS4j4j3Z8K8K_9K_K8K8K8K8K8K8K8KA&s',
                'order' => 3,
            ),
            array(
                'name'  => 'Ignite National Technology Fund',
                'tier'  => 'Silver Sponsors',
                'url'   => 'https://ignite.org.pk',
                'logo'  => 'https://ignite.org.pk/wp-content/themes/ignite/images/logo.png',
                'order' => 4,
            ),
            array(
                'name'  => 'Google Developer Groups (GDG)',
                'tier'  => 'Community Partners',
                'url'   => 'https://developers.google.com',
                'logo'  => 'https://developers.google.com/community/gdg/images/gdg-logo.png',
                'order' => 5,
            ),
            array(
                'name'  => 'IEEE Sukkur IBA Student Branch',
                'tier'  => 'Technical Co-Sponsors',
                'url'   => 'https://iba-suk.edu.pk',
                'logo'  => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/21/IEEE_logo.svg/320px-IEEE_logo.svg.png',
                'order' => 6,
            ),
        );

        foreach ($sponsors as $spn) {
            $existing = get_page_by_title($spn['name'], OBJECT, 'sibacom_sponsor');
            if (!$existing) {
                $post_id = wp_insert_post(array(
                    'post_title'  => $spn['name'],
                    'post_type'   => 'sibacom_sponsor',
                    'post_status' => 'publish',
                    'menu_order'  => $spn['order'],
                ));
                if ($post_id) {
                    update_post_meta($post_id, '_sibacom_sponsor_tier', $spn['tier']);
                    update_post_meta($post_id, '_sibacom_sponsor_url', $spn['url']);
                    update_post_meta($post_id, '_sibacom_sponsor_logo', $spn['logo']);
                    update_post_meta($post_id, '_sibacom_sponsor_order', $spn['order']);
                }
            }
        }

        // 8. Seed FAQs (sibacom_faq)
        $faqs = array(
            array(
                'q' => 'What is SIBACOM 2026?',
                'a' => 'SIBACOM (Sukkur IBA Annual Mega Olympiad) is the flagship collegiate technology festival, computing symposium, and engineering championship presented by Sukkur IBA University, jointly organized by the Computer Systems Engineering Society (CSE Society) and the Electrical Engineering Society (EE Society), supported by their academic partners: Department of Computer Systems Engineering and Department of Electrical Engineering. It brings together over 120 universities and 1,500+ student innovators.',
                'c' => 'General',
                'o' => 1,
            ),
            array(
                'q' => 'Who is eligible to participate in SIBACOM?',
                'a' => 'All currently enrolled undergraduate and graduate students from accredited higher education institutions across Pakistan are eligible. Valid student identification or an institutional verification letter is required.',
                'c' => 'Eligibility',
                'o' => 2,
            ),
            array(
                'q' => 'Can I participate in multiple competitions?',
                'a' => 'Yes, provided the scheduled competition time slots do not overlap. For instance, you can compete in the Speed Programming Prelims on Day 1 and attend the Hackathon or Workshops on Day 2.',
                'c' => 'Competitions',
                'o' => 3,
            ),
            array(
                'q' => 'How does event registration and fee payment work?',
                'a' => 'Click the "Register Now" button on any event competition card. You will be directed to the official verified registration form where you can submit team details and finalize registration.',
                'c' => 'Registration',
                'o' => 4,
            ),
            array(
                'q' => 'Is campus accommodation provided for outstation participants?',
                'a' => 'Yes. Sukkur IBA University maintains secure, air-conditioned campus hostel facilities for registered male and female outstation university delegations at a subsidized rate.',
                'c' => 'Logistics',
                'o' => 5,
            ),
            array(
                'q' => 'Where is Sukkur IBA University located and how do I reach it?',
                'a' => 'Sukkur IBA University is located on Airport Road, Sukkur, Sindh. It is conveniently accessible via Sukkur Airport (SKT), the Sukkur Railway Junction, and the M-5 Motorway. Dedicated shuttle buses will operate from designated transit points for registered delegates.',
                'c' => 'Logistics',
                'o' => 6,
            ),
        );

        foreach ($faqs as $faq) {
            $existing = get_page_by_title($faq['q'], OBJECT, 'sibacom_faq');
            if (!$existing) {
                $post_id = wp_insert_post(array(
                    'post_title'   => $faq['q'],
                    'post_content' => $faq['a'],
                    'post_type'    => 'sibacom_faq',
                    'post_status'  => 'publish',
                    'menu_order'   => $faq['o'],
                ));
                if ($post_id) {
                    update_post_meta($post_id, '_sibacom_faq_category', $faq['c']);
                    update_post_meta($post_id, '_sibacom_faq_order', $faq['o']);
                }
            }
        }

        return esc_html__('SIBACOM demo pages, navigation menus, event competitions, schedules, speakers, sponsors, and FAQs were successfully imported!', 'sibacom-manager');
    }
}

SIBACOM_Demo_Importer::init();
