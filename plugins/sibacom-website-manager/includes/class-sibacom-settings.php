<?php
/**
 * SIBACOM Settings & Options Management
 *
 * @package SIBACOM_Website_Manager
 */

if (!defined('ABSPATH')) {
    exit;
}

class SIBACOM_Settings {

    public static function init() {
        add_action('admin_init', array(__CLASS__, 'register_settings'));
    }

    public static function register_settings() {
        $settings = array(
            // General & Logos
            'sibacom_official_logo_url',
            'sibacom_logo_url',
            'sibacom_event_name',
            'sibacom_event_tagline',
            'sibacom_event_description',
            'sibacom_event_dates',
            'sibacom_event_venue',
            'sibacom_event_location',
            'sibacom_university_logo_url',
            'sibacom_university_logo_white_url',
            'sibacom_society_logo_url', // Legacy fallback
            'sibacom_cse_society_logo_url',
            'sibacom_ee_society_logo_url',
            'sibacom_dept_logo_url', // Legacy fallback
            'sibacom_cse_dept_logo_url',
            'sibacom_ee_dept_logo_url',
            'sibacom_sisc_logo_url',
            'sibacom_contact_email',
            'sibacom_contact_phone',
            'sibacom_copyright_text',

            // Social Media
            'sibacom_social_linkedin',
            'sibacom_social_twitter',
            'sibacom_social_facebook',
            'sibacom_social_instagram',
            'sibacom_social_youtube',
            'sibacom_social_github',

            // Hero & Global Registration CTA
            'sibacom_hero_headline',
            'sibacom_hero_subtitle',
            'sibacom_hero_description',
            'sibacom_hero_bg_image_url',
            'sibacom_header_cta_enabled',
            'sibacom_header_cta_text',
            'sibacom_header_cta_url',
            'sibacom_header_cta_target',
            'sibacom_default_register_url',
            'sibacom_hero_secondary_cta_text',
            'sibacom_hero_secondary_cta_url',
            'sibacom_hero_countdown_date',

            // Event Information Cards (Section C)
            'sibacom_info_date_title',
            'sibacom_info_date_val',
            'sibacom_info_date_sub',
            'sibacom_info_date_pill',
            'sibacom_info_venue_title',
            'sibacom_info_venue_val',
            'sibacom_info_venue_sub',
            'sibacom_info_venue_pill',
            'sibacom_info_deadline_title',
            'sibacom_info_deadline_val',
            'sibacom_info_deadline_sub',
            'sibacom_info_deadline_pill',
            'sibacom_info_category_title',
            'sibacom_info_category_val',
            'sibacom_info_category_sub',
            'sibacom_info_category_pill',
            'sibacom_info_participation_title',
            'sibacom_info_participation_val',
            'sibacom_info_participation_sub',
            'sibacom_info_participation_pill',
            'sibacom_info_status_title',
            'sibacom_info_status_val',
            'sibacom_info_status_sub',
            'sibacom_info_status_pill',

            // Event Registration & Pricing Section Header (Section D)
            'sibacom_pricing_sec_badge',
            'sibacom_pricing_sec_title',
            'sibacom_pricing_sec_desc',
            'sibacom_pricing_default_cta_url',
            'sibacom_pricing_default_cta_text',

            // Homepage Section Visibility & Order Controls (Homepage Manager)
            'sibacom_section_hero_enabled',
            'sibacom_section_info_enabled',
            'sibacom_section_pricing_enabled',
            'sibacom_section_highlights_enabled',
            'sibacom_section_about_enabled',
            'sibacom_section_schedule_enabled',
            'sibacom_section_speakers_enabled',
            'sibacom_section_guests_enabled',
            'sibacom_section_organizers_enabled',
            'sibacom_section_sponsors_enabled',
            'sibacom_section_faq_enabled',
            'sibacom_section_cta_enabled',
            'sibacom_section_contact_enabled',

            // Speakers & Judges Section Settings
            'sibacom_speakers_sec_badge',
            'sibacom_speakers_sec_title',
            'sibacom_speakers_sec_desc',
            'sibacom_speakers_sec_columns',
            'sibacom_speakers_sec_limit',
            'sibacom_speakers_sec_btn_text',
            'sibacom_speakers_sec_btn_url',

            // Guests Section Settings
            'sibacom_guests_sec_badge',
            'sibacom_guests_sec_title',
            'sibacom_guests_sec_desc',

            // Schedule Section Settings
            'sibacom_schedule_sec_badge',
            'sibacom_schedule_sec_title',
            'sibacom_schedule_sec_desc',

            // Sponsors Section Settings
            'sibacom_sponsors_sec_badge',
            'sibacom_sponsors_sec_title',
            'sibacom_sponsors_sec_desc',

            // FAQ Section Settings
            'sibacom_faq_sec_badge',
            'sibacom_faq_sec_title',
            'sibacom_faq_sec_desc',

            // About
            'sibacom_about_badge',
            'sibacom_about_title',
            'sibacom_about_description',
            'sibacom_about_vision',
            'sibacom_about_mission',
            'sibacom_about_stat1_num',
            'sibacom_about_stat1_label',
            'sibacom_about_stat2_num',
            'sibacom_about_stat2_label',
            'sibacom_about_stat3_num',
            'sibacom_about_stat3_label',
            'sibacom_about_stat4_num',
            'sibacom_about_stat4_label',

            // Highlights
            'sibacom_highlights_badge',
            'sibacom_highlights_title',
            'sibacom_highlights_desc',

            // Organizers & Academic Partners Section Settings
            'sibacom_organizers_sec_badge',
            'sibacom_organizers_sec_title',
            'sibacom_organizers_sec_subtitle',
            'sibacom_academic_sec_badge',
            'sibacom_academic_sec_title',
            'sibacom_academic_sec_subtitle',

            // Joint Primary Organizers
            'sibacom_organizers_cse_society_title',
            'sibacom_organizers_cse_society_desc',
            'sibacom_organizers_cse_society_affiliation',
            'sibacom_organizers_ee_society_title',
            'sibacom_organizers_ee_society_desc',
            'sibacom_organizers_ee_society_affiliation',

            // Academic Partners
            'sibacom_academic_cse_dept_title',
            'sibacom_academic_cse_dept_desc',
            'sibacom_academic_cse_dept_support',
            'sibacom_academic_ee_dept_title',
            'sibacom_academic_ee_dept_desc',
            'sibacom_academic_ee_dept_support',

            // Overarching Institutional Identity
            'sibacom_organizers_uni_title',
            'sibacom_organizers_uni_desc',
            'sibacom_organizers_uni_badge',

            // Student Council
            'sibacom_organizers_sisc_title',
            'sibacom_organizers_sisc_desc',

            // Legacy keys for backward compatibility
            'sibacom_organizers_society_title',
            'sibacom_organizers_society_desc',
            'sibacom_organizers_dept_title',
            'sibacom_organizers_dept_desc',

            // Contact
            'sibacom_contact_badge',
            'sibacom_contact_heading',
            'sibacom_contact_description',
            'sibacom_contact_address',
            'sibacom_contact_map_embed',
            'sibacom_contact_venue_title',
            'sibacom_contact_venue_sub',
            'sibacom_contact_email_title',
            'sibacom_contact_email_sub',
            'sibacom_contact_phone_title',
            'sibacom_contact_phone_sub',
            'sibacom_bug_contact_title',
            'sibacom_bug_contact_name',
            'sibacom_bug_contact_role',
            'sibacom_bug_contact_email',
            'sibacom_bug_contact_desc',

            // Footer
            'sibacom_footer_description',
        );

        foreach ($settings as $setting) {
            register_setting('sibacom_settings_group', $setting);
        }
    }

    /**
     * Set Default Values on Activation
     */
    public static function set_defaults() {
        $defaults = array(
            'sibacom_event_name'        => 'SIBACOM',
            'sibacom_event_tagline'     => 'Sukkur IBA Annual Mega Olympiad & Innovation Competitions',
            'sibacom_event_description' => 'Pakistan’s premier collegiate technology festival convening top student programmers, robotics engineers, AI researchers, and startup founders for high-stakes competition at Sukkur IBA University.',
            'sibacom_event_dates'       => 'November 30, 2026',
            'sibacom_event_venue'       => 'Sukkur IBA University – Main Campus',
            'sibacom_event_location'    => 'Airport Road, Sukkur, Sindh, Pakistan',
            'sibacom_contact_email'     => 'sibacom@iba-suk.edu.pk',
            'sibacom_contact_phone'     => '+92 71 5644000',
            'sibacom_copyright_text'    => '© 2026 SIBACOM – Sukkur IBA University. All Rights Reserved.',

            'sibacom_social_linkedin'   => 'https://www.linkedin.com/school/sukkur-iba-university/',
            'sibacom_social_twitter'    => 'https://twitter.com/Sukkur_IBA',
            'sibacom_social_facebook'   => 'https://www.facebook.com/SukkurIBA.University',
            'sibacom_social_instagram'  => 'https://www.instagram.com/sukkur_iba_official',
            'sibacom_social_youtube'    => 'https://www.youtube.com/@SukkurIBAUniversityOfficial',
            'sibacom_social_github'     => 'https://github.com/cse-society-iba',

            'sibacom_hero_headline'     => 'Connecting Ideas. Empowering Innovation. Building Tomorrow.',
            'sibacom_hero_subtitle'     => 'Igniting Algorithmic Brilliance, Engineering Innovation & Technological Leadership.',
            'sibacom_hero_description'  => 'Pakistan’s premier collegiate technology festival convening top student programmers, robotics engineers, AI researchers, and startup founders for high-stakes competition at Sukkur IBA University.',
            'sibacom_header_cta_enabled'=> '1',
            'sibacom_header_cta_text'   => 'Register Now',
            'sibacom_header_cta_url'    => 'https://iba-suk.edu.pk/sibacom/register',
            'sibacom_header_cta_target' => '_blank',
            'sibacom_default_register_url' => 'https://iba-suk.edu.pk/sibacom/register',
            'sibacom_hero_secondary_cta_text' => 'Explore Event Details',
            'sibacom_hero_secondary_cta_url'  => '#events',
            'sibacom_hero_countdown_date'     => '2026-11-30T09:00:00',

            // Info Cards (Section C)
            'sibacom_info_date_title'          => 'Event Date',
            'sibacom_info_date_val'            => 'Nov 30, 2026',
            'sibacom_info_date_sub'            => '1-Day National Summit',
            'sibacom_info_date_pill'           => 'Official Dates',
            'sibacom_info_venue_title'         => 'Event Venue',
            'sibacom_info_venue_val'           => 'Academic Block-III',
            'sibacom_info_venue_sub'           => 'Sukkur IBA University',
            'sibacom_info_venue_pill'          => 'Main Campus',
            'sibacom_info_deadline_title'      => 'Registration Deadline',
            'sibacom_info_deadline_val'        => 'Nov 25, 2026',
            'sibacom_info_deadline_sub'        => '11:59 PM PKT Strict Cutoff',
            'sibacom_info_deadline_pill'       => 'Strict Cutoff',
            'sibacom_info_category_title'      => 'Event Category',
            'sibacom_info_category_val'        => 'Tech Olympiad',
            'sibacom_info_category_sub'        => '14+ Competitive Tracks',
            'sibacom_info_category_pill'       => '14+ Tracks',
            'sibacom_info_participation_title' => 'Participation',
            'sibacom_info_participation_val'   => '1,500+ Innovators',
            'sibacom_info_participation_sub'   => '120+ Universities Nationwide',
            'sibacom_info_participation_pill'  => 'Nationwide',
            'sibacom_info_status_title'        => 'Registration Status',
            'sibacom_info_status_val'          => 'Registration Open',
            'sibacom_info_status_sub'          => 'Verified Delegate Portals',
            'sibacom_info_status_pill'         => 'Live Now',

            // Pricing & Registration Section (Section D)
            'sibacom_pricing_sec_badge'        => 'Official Registrations & Fees',
            'sibacom_pricing_sec_title'        => 'Event Registration & Competitive Categories',
            'sibacom_pricing_sec_desc'         => 'Choose your competitive track, register your team, and confirm your participation in Pakistan’s premier technology summit.',
            'sibacom_pricing_default_cta_url'  => 'https://iba-suk.edu.pk/sibacom/register',
            'sibacom_pricing_default_cta_text' => 'Register Now',

            // Section Toggles
            'sibacom_section_hero_enabled'        => '1',
            'sibacom_section_info_enabled'        => '1',
            'sibacom_section_pricing_enabled'     => '1',
            'sibacom_section_highlights_enabled'  => '1',
            'sibacom_section_about_enabled'       => '1',
            'sibacom_section_schedule_enabled'    => '1',
            'sibacom_section_speakers_enabled'    => '1',
            'sibacom_section_guests_enabled'      => '1',
            'sibacom_section_organizers_enabled'  => '1',
            'sibacom_section_sponsors_enabled'    => '1',
            'sibacom_section_faq_enabled'         => '1',
            'sibacom_section_cta_enabled'         => '1',
            'sibacom_section_contact_enabled'     => '1',

            // Speakers & Judges Section Settings
            'sibacom_speakers_sec_badge'          => 'Expert Jury Panel',
            'sibacom_speakers_sec_title'          => 'Distinguished Competition Judges & Industry Jury',
            'sibacom_speakers_sec_desc'           => 'Meet the esteemed evaluators, senior industry architects, and academic leaders presiding over the competitive tracks at Sukkur IBA University.',
            'sibacom_speakers_sec_columns'        => '4',
            'sibacom_speakers_sec_limit'          => '4',
            'sibacom_speakers_sec_btn_text'       => 'View All Speakers & Judges',
            'sibacom_speakers_sec_btn_url'        => '/speakers/',

            // Guests Section Settings
            'sibacom_guests_sec_badge'            => 'Honorary Presence',
            'sibacom_guests_sec_title'            => 'Chief Guests & Distinguished Dignitaries',
            'sibacom_guests_sec_desc'             => 'Eminent academic leaders, government representatives, and institutional patrons presiding over SIBACOM 2026.',

            // Schedule Section Settings
            'sibacom_schedule_sec_badge'          => '1-Day Event Itinerary',
            'sibacom_schedule_sec_title'          => 'Program Schedule & Agenda',
            'sibacom_schedule_sec_desc'           => 'A comprehensive timeline of keynote sessions, competitive rounds, networking luncheons, and the grand closing ceremony.',

            // Sponsors Section Settings
            'sibacom_sponsors_sec_badge'          => 'Industry Collaboration',
            'sibacom_sponsors_sec_title'          => 'Official Sponsors & Strategic Partners',
            'sibacom_sponsors_sec_desc'           => 'Proudly supported by leading technology conglomerates, research councils, and national innovation funds.',

            // FAQ Section Settings
            'sibacom_faq_sec_badge'               => 'Common Inquiries',
            'sibacom_faq_sec_title'               => 'Frequently Asked Questions',
            'sibacom_faq_sec_desc'                => 'Find clear answers regarding participation eligibility, logistics, venue directions, and competition guidelines.',

            // About
            'sibacom_about_badge'       => 'About The Olympiad',
            'sibacom_about_title'       => 'Igniting Technology Leadership Across Pakistan',
            'sibacom_about_description' => 'SIBACOM (Sukkur IBA Annual Mega Olympiad) is the flagship national collegiate technology, hackathon, and computing summit presented by Sukkur IBA University, jointly organized by the Computer Systems Engineering Society (CSE Society) and the Electrical Engineering Society (EE Society), supported by their academic partners: Department of Computer Systems Engineering and Department of Electrical Engineering.',
            'sibacom_about_vision'      => 'To cultivate Pakistan’s foremost student technology ecosystem, empowering youth to translate theoretical computational science into sovereign engineering solutions.',
            'sibacom_about_mission'     => 'Providing a transparent, rigorous, and technologically advanced arena where students test hardware-software integration, competitive programming, and ethical AI systems.',
            'sibacom_about_stat1_num'   => '120+',
            'sibacom_about_stat1_label' => 'Participating Universities',
            'sibacom_about_stat2_num'   => '1,500+',
            'sibacom_about_stat2_label' => 'Student Innovators',
            'sibacom_about_stat3_num'   => 'PKR 1.5M',
            'sibacom_about_stat3_label' => 'Total Prize Pool',
            'sibacom_about_stat4_num'   => '14+',
            'sibacom_about_stat4_label' => 'Competition Modules',

            // Highlights
            'sibacom_highlights_badge' => 'Competitive Tracks & Pillars',
            'sibacom_highlights_title' => 'Empowering Pakistan’s Next Generation of Technologists',
            'sibacom_highlights_desc'  => 'Explore high-impact competitive categories designed to challenge algorithmic mastery, engineering resilience, and technical vision.',

            // Section Headers for Organizers & Academic Partners
            'sibacom_organizers_sec_badge'    => 'Primary Event Organizers',
            'sibacom_organizers_sec_title'    => 'JOINTLY ORGANIZED BY',
            'sibacom_organizers_sec_subtitle' => 'Bringing together the Computer Systems Engineering and Electrical Engineering communities.',
            'sibacom_academic_sec_badge'      => 'Academic Affiliations',
            'sibacom_academic_sec_title'      => 'ACADEMIC PARTNERS',
            'sibacom_academic_sec_subtitle'   => 'Supporting academic departments providing faculty advisement, research laboratory facilities, and international judging standards.',

            // 1. Joint Primary Organizers
            'sibacom_organizers_cse_society_title'       => 'Computer Systems Engineering Society (CSE Society)',
            'sibacom_organizers_cse_society_desc'        => 'The premier student engineering society of the Department of Computer Systems Engineering, pioneering technical competitions, algorithmic hackathons, and hardware-software innovation at Sukkur IBA University.',
            'sibacom_organizers_cse_society_affiliation' => 'Co-Equal Secretariat & Computing Track Lead',
            'sibacom_organizers_ee_society_title'        => 'Electrical Engineering Society (EE Society)',
            'sibacom_organizers_ee_society_desc'         => 'The leading student engineering society of the Department of Electrical Engineering, driving excellence in circuit design, embedded robotics, telecommunications, and power systems at Sukkur IBA University.',
            'sibacom_organizers_ee_society_affiliation'  => 'Co-Equal Secretariat & Electrical Track Lead',

            // 2. Academic Partners
            'sibacom_academic_cse_dept_title'   => 'Department of Computer Systems Engineering',
            'sibacom_academic_cse_dept_desc'    => 'Academic affiliation and supporting partner for the CSE Society, providing high-performance computing clusters, embedded systems labs, and faculty adjudication across computing and AI tracks.',
            'sibacom_academic_cse_dept_support' => 'Academic Oversight & Computing Labs',
            'sibacom_academic_ee_dept_title'    => 'Department of Electrical Engineering',
            'sibacom_academic_ee_dept_desc'     => 'Academic affiliation and supporting partner for the EE Society, providing state-of-the-art electronics, telecommunications, and power engineering laboratories, along with senior faculty mentorship.',
            'sibacom_academic_ee_dept_support'  => 'Technical Jury & Engineering Labs',

            // 3. Overarching Institutional Identity
            'sibacom_organizers_uni_title' => 'Sukkur IBA University',
            'sibacom_organizers_uni_desc'  => 'Top-ranked public sector university chartered by the Government of Sindh and recognized by HEC Pakistan, serving as the overarching institutional host and patron for SIBACOM.',
            'sibacom_organizers_uni_badge' => 'Overarching Institutional Identity',

            // 4. Student Leadership Council
            'sibacom_organizers_sisc_title' => 'SISC – Sukkur IBA Student Council',
            'sibacom_organizers_sisc_desc'  => 'The apex representative student leadership council of Sukkur IBA University, overseeing cross-departmental coordination, university-wide engagement, and delegate hospitality.',

            // Legacy keys for backward compatibility
            'sibacom_organizers_society_title' => 'Computer Systems Engineering Society (CSE Society)',
            'sibacom_organizers_society_desc'  => 'The premier student engineering society of the Department of Computer Systems Engineering, pioneering technical competitions, hackathons, and hardware-software innovation at Sukkur IBA University.',
            'sibacom_organizers_dept_title'    => 'Department of Computer Systems Engineering',
            'sibacom_organizers_dept_desc'     => 'Providing rigorous academic oversight, laboratory facilities, faculty advisement, and technological adjudication to ensure international competition standards.',

            // Contact
            'sibacom_contact_badge'       => 'Official Communications',
            'sibacom_contact_heading'     => 'Get in Touch with SIBACOM Committee',
            'sibacom_contact_description' => 'Connect with our campus event coordinators for university delegator inquiries, venue travel routes, or event accreditation.',
            'sibacom_contact_address'     => 'Sukkur IBA University, Airport Road, Sukkur, Sindh, Pakistan',
            'sibacom_contact_email'       => 'info@sibacom.tech',
            'sibacom_contact_phone'       => '03253171046',
            'sibacom_contact_venue_title' => 'Event Venue Location',
            'sibacom_contact_venue_sub'   => 'Accessible via Sukkur Airport & M-5 Motorway',
            'sibacom_contact_email_title' => 'Electronic Mail',
            'sibacom_contact_email_sub'   => 'Official Secretariat Helpdesk',
            'sibacom_contact_phone_title' => 'Telephone & Helpdesk',
            'sibacom_contact_phone_sub'   => 'Mon – Fri, 09:00 AM – 05:00 PM PKT',
            'sibacom_bug_contact_title'   => 'Bug Report',
            'sibacom_bug_contact_name'    => 'Jamshed Ali',
            'sibacom_bug_contact_role'    => 'Web Engineer _ SIBACOM EVENT',
            'sibacom_bug_contact_email'   => 'jamshed.ali@sibacom.tech',
            'sibacom_bug_contact_desc'    => 'For users to report any website bugs or technical issues',
            'sibacom_footer_description'  => 'SIBACOM (Sukkur IBA Annual Mega Olympiad) is the flagship collegiate technology festival, computing symposium, and engineering championship presented by Sukkur IBA University, jointly organized by the Computer Systems Engineering Society (CSE Society) and the Electrical Engineering Society (EE Society), supported by academic partners: Department of Computer Systems Engineering and Department of Electrical Engineering.',
        );

        foreach ($defaults as $key => $val) {
            $existing = get_option($key);
            if ($existing === false || $existing === '') {
                update_option($key, $val);
            }
        }
    }
}

SIBACOM_Settings::init();
