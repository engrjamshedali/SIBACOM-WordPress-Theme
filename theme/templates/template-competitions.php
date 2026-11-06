<?php
/**
 * Template Name: SIBACOM Competitions & Rewards Template
 *
 * World-Class Dedicated Portal for SIBACOM 2026 Competitions, Fee Schedules & Cash Rewards
 * Sukkur IBA University • CSE Society & EE Society (SISC)
 * Single Source of Truth: Official SIBACOM 2026 Event Proposal
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
        $reg_portal_url    = function_exists('sibacom_get_register_url') ? sibacom_get_register_url() : (function_exists('sibacom_get_option') ? sibacom_get_option('header_cta_url', 'https://portal.sibacom.tech/') : get_option('sibacom_header_cta_url', 'https://portal.sibacom.tech/'));
        if (empty($reg_portal_url) || strpos($reg_portal_url, 'iba-suk.edu.pk') !== false) {
            $reg_portal_url = 'https://portal.sibacom.tech/';
        }
        $reg_portal_text   = function_exists('sibacom_get_register_text') ? sibacom_get_register_text() : (function_exists('sibacom_get_option') ? sibacom_get_option('header_cta_text', 'Register Now') : get_option('sibacom_header_cta_text', 'Register Now'));
        $reg_portal_target = function_exists('sibacom_get_register_target') ? sibacom_get_register_target() : '_blank';
        $reg_portal_rel    = ($reg_portal_target === '_blank') ? ' rel="noopener noreferrer"' : '';

// Centralized Official Competitions Data Source (Strictly Verified Proposal Records)
$official_competitions = array(
    array(
        'id'           => 'circuit-design',
        'number'       => '01',
        'title'        => 'Circuit Design Competition',
        'category'     => 'hardware',
        'category_lbl' => 'Hardware & Engineering',
        'track_code'   => 'A',
        'tagline'      => 'Three-stage electronic circuit design, breadboard prototyping & complex synthesis',
        'desc'         => 'Three stages: MCQ test, breadboard circuit design, and complex circuit design. Teams of two students. Top 10 advance to stage two, top five to the final, and top three are selected as winners.',
        'full_desc'    => 'The Circuit Design Competition is designed to cultivate creativity and technical innovation by challenging participants to design efficient, functional, and reliable electronic circuits. Working in groups of 2 students, teams progress through three rigorous stages: an eliminatory MCQ assessment, a hands-on breadboard circuit assembly task, and an advanced complex design challenge judged by senior engineering faculty.',
        'fee'          => 'PKR 500 / team',
        'fee_amount'   => 500,
        'fee_type'     => 'team',
        'team_size'    => 'Teams of 2 students',
        'min_team'     => 2,
        'max_team'     => 2,
        'format'       => '3-Stage Progressive Challenge',
        'rounds_count' => '3 Elimination Stages (MCQ -> Breadboard -> Complex)',
        'stages'       => array(
            array('num' => 1, 'name' => 'Stage 1: MCQs Test', 'desc' => 'Preliminary round featuring a set of MCQs to test theoretical electronics knowledge. Top 10 teams advance to stage two.'),
            array('num' => 2, 'name' => 'Stage 2: Breadboard Circuit Design', 'desc' => 'Hands-on circuit assembly on a breadboard. Moderately complex challenge evaluating practical skills, creativity, functionality, and efficiency. Top 5 teams advance to the final.'),
            array('num' => 3, 'name' => 'Stage 3: Complex Circuit Design Task', 'desc' => 'Ultimate challenge separating the best from the rest. The judges evaluate designs and select the top 3 teams as winners.')
        ),
        'rubric'       => array('Creativity and circuit architecture', 'Functionality under electrical test', 'Component efficiency & breadboard neatness', 'Practical circuit design and troubleshooting skills'),
        'venue'        => 'Academic Block-III Labs (Awaiting Final Allocation)',
        'venue_conf'   => false,
        'prizes'       => array('first' => 'PKR 15,000', 'second' => 'PKR 10,000', 'third' => 'PKR 5,000', 'total' => 30000),
        'workshop'     => null,
        'objectives'   => array('Develop creativity and innovation by challenging participants to design efficient and functional electronic circuits.', 'Enhance problem-solving skills and technical expertise in electronics.'),
        'image'        => 'theme/assets/images/competitions/circuit-design.jpg',
        'image_remote' => 'https://images.openai.com/static-rsc-4/bDop0_Vd8jzDvK0Rf_n9-MOHVluSROuVCkDIaLHs5gBbiq2wMqp8j0aR4oum0aQOWL3NcR9CNs3eCRRU4zF55fxk47uUPW2n0rWYg3WNgLIr6wrvzvWZCQXk5MmGoyezTS9jH5URTSFwOoMYss5Y8ZnZWM-6rd8DZ-cN3Nk-Fxg?purpose=inline',
        'image_credit' => 'Competition Teams | Ohio Northern University',
        'rules_notice' => 'Detailed competition guidelines and testing parameters will be announced by the organizing committee.'
    ),
    array(
        'id'           => 'e-games',
        'number'       => '02',
        'title'        => 'E-Games',
        'category'     => 'gaming',
        'category_lbl' => 'Gaming & E-Sports',
        'track_code'   => 'C',
        'tagline'      => 'Online esports tournament featuring FIFA, COD, CS:GO & PUBG with live broadcasting',
        'desc'         => 'FIFA, COD, CS:GO and PUBG. Online, team-based competition with live broadcasting. Maximum four members per team. Final game selection depends on participant interests.',
        'full_desc'    => 'E-Games brings competitive gaming and esports to SIBACOM 2026. Held entirely online with public live broadcasting, teams of up to 4 battle across leading titles (FIFA, Call of Duty, CS:GO, PUBG). Final game selection depends on participant interests. The tournament fosters strategic planning, sharp reflexes, communication, and high-pressure teamwork.',
        'fee'          => 'PKR 500 / team',
        'fee_amount'   => 500,
        'fee_type'     => 'team',
        'team_size'    => 'Maximum 4 members per team',
        'min_team'     => 1,
        'max_team'     => 4,
        'format'       => 'Online Tournament with Live Broadcasting',
        'rounds_count' => 'Bracket Elimination Rounds',
        'games'        => array('FIFA', 'COD (Call of Duty)', 'CS:GO', 'PUBG'),
        'stages'       => null,
        'rubric'       => array('Tournament knockout bracket victories', 'In-game strategic execution and objective control', 'Teamwork, tactical positioning and squad communication'),
        'venue'        => 'Online Platform / Live Broadcast Stream',
        'venue_conf'   => true,
        'prizes'       => array(
            'first' => 'PKR 5,000',
            'second' => 'PKR 4,000',
            'third' => 'PKR 2,500',
            'total' => 11500,
            'pool_note' => 'Proposal budget allocation notes PKR 30,000 across multiple game brackets.'
        ),
        'workshop'     => null,
        'objectives'   => array('Enhance strategy-making, teamwork, and competitive nerves of students.', 'Crown the premier gaming champions of Sukkur IBA University.'),
        'image'        => 'theme/assets/images/competitions/e-games.jpg',
        'image_remote' => 'https://images.openai.com/static-rsc-4/0lt24NIBYhQbMGeCE9yUQX5hklGiBGxPh0wcqnSb6chU4vGZt6vcAmvVsn8NBzQAiqDm7LCVSvY24r_iyeLwL41FCIGJ1-Fh0XVbjBgnHjio-2r6_Hj2VgPHItOFsO3ICUKLEC5VvPKdcospalWm8pk07Gqn0I60We77aAdToCo?purpose=inline',
        'image_credit' => 'Level up in life: The surprising benefits of Esports participation',
        'rules_notice' => 'Game servers, anti-cheat enforcement, and lobby regulations will be announced by the gaming committee.'
    ),
    array(
        'id'           => 'robo-war',
        'number'       => '03',
        'title'        => 'Robo War',
        'category'     => 'hardware',
        'category_lbl' => 'Hardware & Engineering',
        'track_code'   => 'A',
        'tagline'      => 'Combat robotics arena showdown backed by an Arduino robot-building workshop',
        'desc'         => 'Basic robot-building workshop with Arduino and related equipment, followed by a robot competition under specified eligibility guidelines.',
        'full_desc'    => 'Robo War is SIBACOM’s flagship combat robotics tournament. Before entering the battle arena, teams participate in an intensive hands-on workshop covering robot chassis construction, Arduino microcontrollers, and motor drive systems. Mentors provide equipment and assist in assembling functional bots. Teams then clash inside a protected arena testing structural durability, kinetic weapon mechanics, and pilot strategy.',
        'fee'          => 'PKR 500 / team',
        'fee_amount'   => 500,
        'fee_type'     => 'team',
        'team_size'    => 'Team-based (2 to 4 members)',
        'min_team'     => 2,
        'max_team'     => 4,
        'format'       => 'Arena Combat Tournament & Pre-Event Workshop',
        'rounds_count' => 'Workshop + Tournament Brackets',
        'workshop'     => array(
            'title' => 'Basic Robot-Building Workshop',
            'desc'  => 'Workshop introducing basic robotics. Mentors provide basic equipment (such as Arduino and related components) and assist participants in building an eligible bot.',
            'items' => array('Arduino microcontrollers', 'Motor drivers & DC gear motors', 'Chassis assembly', 'Radio control & wireless receivers')
        ),
        'stages'       => null,
        'rubric'       => array('Robotics & engineering design', 'Creativity and armor durability', 'Practical problem-solving', 'Live combat arena performance'),
        'venue'        => 'Specialized Combat Arena (Campus Grounds)',
        'venue_conf'   => false,
        'prizes'       => array('first' => 'PKR 20,000', 'second' => 'PKR 15,000', 'third' => 'PKR 10,000', 'total' => 45000),
        'objectives'   => array('Help students choose career paths in AI and robotics.', 'Build confidence to compete in national and international competitions.', 'Demonstrate live engineering to a large audience.'),
        'image'        => 'theme/assets/images/competitions/robo-war.jpg',
        'image_remote' => 'https://images.openai.com/static-rsc-4/_2C7lnY2GkZxUM4rGTYcxX4j-XQMiz6uj_mPm1ouvXUvajM1C9EeCofy1lYSsiFCc0W2B3iqVEhBDv367nS9wSnuJKLlsDI1DhZzN-lhir0dv9JCgNQQYMzjiTJq6zvrSFaxE_njgtA2KRussacK_snTfmxvqZ6guF1l22ilVbw?purpose=inline',
        'image_credit' => 'Horseshoe Las Vegas: BattleBots Destruct-A-Thon | Book Online',
        'rules_notice' => 'Detailed guidelines regarding eligible robot weight classes, dimensions, weapon safety, and arena rules will be announced by the organizing committee.'
    ),
    array(
        'id'           => 'drone-competition',
        'number'       => '04',
        'title'        => 'Drone Competition',
        'category'     => 'hardware',
        'category_lbl' => 'Hardware & Engineering',
        'track_code'   => 'A',
        'tagline'      => 'UAV aerial navigation, obstacle traversal & precision flight with hands-on workshop',
        'desc'         => 'Drone-building and flying workshop, covering components, assembly, control and safe flying. Challenges evaluate maneuverability, accuracy, speed and control.',
        'full_desc'    => 'The Drone Competition challenges teams across aerial agility, obstacle navigation, speed, and precision flight control. Participants begin with a hands-on workshop on UAV principles, component assembly, radio telemetry, and safe flying practices with live demonstrations. Teams then compete through designated obstacle challenges testing control, maneuverability, and speed.',
        'fee'          => 'PKR 500 / team',
        'fee_amount'   => 500,
        'fee_type'     => 'team',
        'team_size'    => 'Team-based (2 to 4 members)',
        'min_team'     => 2,
        'max_team'     => 4,
        'format'       => 'Flight Course Trials & Technical Workshop',
        'rounds_count' => 'Workshop + Aerial Obstacle Heats',
        'workshop'     => array(
            'title' => 'Drone-Building & Safe Flying Workshop',
            'desc'  => 'Comprehensive introduction to fundamental drone components, working principles, frame assembly, radio calibration, and safe aerial navigation with live equipment demonstrations.',
            'items' => array('Drone frames & aerodynamics', 'Brushless motors & ESCs', 'Flight control boards & sensors', 'Transmitters, receivers & fail-safes')
        ),
        'stages'       => null,
        'rubric'       => array('Maneuverability through aerial obstacles', 'Flight accuracy, altitude and stability', 'Course completion speed and time trials', 'Drone control and technical pilot skills'),
        'venue'        => 'Designated Drone Arena / Flight Zone',
        'venue_conf'   => false,
        'prizes'       => array('first' => 'PKR 20,000', 'second' => 'PKR 15,000', 'third' => 'PKR 10,000', 'total' => 45000),
        'objectives'   => array('Develop practical engineering, technical, and problem-solving skills in UAVs.', 'Enhance understanding of flight control systems, sensors, electronics, and aerial navigation.'),
        'image'        => 'theme/assets/images/competitions/drone-competition.jpg',
        'image_remote' => 'https://images.openai.com/static-rsc-4/ctq3MctLC3A5csbyVFxmOlgGhzeTREelDpYAx5jSNtXExSjnfnm5ofZ3q9YUNRS1hC4mSAzOJi9WU62eEUw-BIJ-6wA45-4pSioH1vHzTFXF5Yny5J2WoUqzPTsohPUkbY8P1eF2HfbigEzaXmEbsgtsn5E8CNMKtFvdffYhUB4?purpose=inline',
        'image_credit' => 'FAI 2026 Drone Racing World Cup spans 13 countries, 15 events | Prism News',
        'rules_notice' => 'Detailed guidelines regarding drone dimensions, battery specifications, fail-safe cutoffs, and arena flight safety will be announced by the committee.'
    ),
    array(
        'id'           => 'lfr',
        'number'       => '05',
        'title'        => 'Line Following Robot (LFR)',
        'category'     => 'hardware',
        'category_lbl' => 'Hardware & Engineering',
        'track_code'   => 'A',
        'tagline'      => 'High-speed autonomous line navigation with IR sensor & microcontroller workshop',
        'desc'         => 'Workshop on Arduino, IR sensors, motors, motor drivers and robotics programming. Robots compete on a specially designed track based on speed, accuracy and completion time.',
        'full_desc'    => 'The Line Following Robot (LFR) competition challenges teams to design and program autonomous robotic vehicles capable of traversing a complex track with speed, precision, and zero deviation. Includes a dedicated workshop providing hands-on training with Arduino, IR sensor arrays, motor drivers, and closed-loop control algorithms. Robots race on an intricate track evaluated on navigation and lap time.',
        'fee'          => 'PKR 500 / team',
        'fee_amount'   => 500,
        'fee_type'     => 'team',
        'team_size'    => 'Team-based (2 to 4 members)',
        'min_team'     => 2,
        'max_team'     => 4,
        'format'       => 'Track Time Trials & Hardware Workshop',
        'rounds_count' => 'Workshop + Timed Track Runs',
        'workshop'     => array(
            'title' => 'LFR Building & Automation Workshop',
            'desc'  => 'Hands-on training covering robotics concepts, IR sensors, motor control, microcontrollers (Arduino), motor drivers, and robotics programming.',
            'items' => array('Arduino microcontrollers', 'IR reflective sensor arrays', 'High-speed DC gear motors', 'Motor driver ICs/shields', 'Robotics programming & PID logic')
        ),
        'stages'       => null,
        'rubric'       => array('Speed and lap completion time', 'Line-tracking accuracy and path adherence', 'Successful navigation through sharp turns and intersections', 'Reliability and overall completion time'),
        'venue'        => 'Specialized LFR Track Arena',
        'venue_conf'   => false,
        'prizes'       => array('first' => 'PKR 20,000', 'second' => 'PKR 15,000', 'third' => 'PKR 10,000', 'total' => 45000),
        'objectives'   => array('Develop practical engineering, programming, and embedded automation skills.', 'Optimize autonomous robotic systems for speed, accuracy, and reliability.'),
        'image'        => 'theme/assets/images/competitions/lfr.jpg',
        'image_remote' => 'https://images.openai.com/static-rsc-4/M7JMToZs1ixVIaEkmEjs96P9LtjsewQeIGL2syusuZiEGUGpjeSM37YvSw-GFKY20zkRlOHnx6XivD1AASg2x4zOmOPLcl3drczDgNguoUBpGtEv26AalLQLYg2ZaWro9PPim7Chk-vGOmknl8MFfHwOmM8u_m1jmi25n7pBk0I?purpose=inline',
        'image_credit' => 'International Robot Challenge',
        'rules_notice' => 'Detailed guidelines regarding robot chassis size, weight, track specifications, line thickness, and timer calibration will be announced by the committee.'
    ),
    array(
        'id'           => 'programming-challenge',
        'number'       => '06',
        'title'        => 'Programming Challenge',
        'category'     => 'computing',
        'category_lbl' => 'Computing & Technology',
        'track_code'   => 'B',
        'tagline'      => 'Two-round timed algorithmic coding contest hosted on HackerRank platform',
        'desc'         => 'Two HackerRank-based online-assessed rounds, each at least 60 minutes. Maximum two students per team. Venue: Lab-II and English Lab, AB-I.',
        'full_desc'    => 'Programming is one of the core subjects of Computer Systems and Electrical Engineering. The SIBACOM Programming Challenge tests algorithmic brilliance, data structure mastery, and code execution speed. Working in teams of up to 2 in Sukkur IBA’s state-of-the-art computer labs, participants solve challenging problem sets evaluated automatically on HackerRank over two rigorous rounds.',
        'fee'          => 'PKR 500 / team',
        'fee_amount'   => 500,
        'fee_type'     => 'team',
        'team_size'    => 'Maximum 2 students per team',
        'min_team'     => 1,
        'max_team'     => 2,
        'format'       => 'Two-Round Online Automated Contest',
        'rounds_count' => '2 Rounds (Min. 60 Minutes each)',
        'stages'       => null,
        'rubric'       => array('Automated test suite pass rate on HackerRank', 'Time and space complexity efficiency', 'Solve time with penalty adjustments for incorrect submissions', 'Algorithmic robustness'),
        'venue'        => 'Lab-II and English Lab, Academic Block-I (AB-I)',
        'venue_conf'   => true,
        'prizes'       => array('first' => 'PKR 15,000', 'second' => 'PKR 10,000', 'third' => 'PKR 5,000', 'total' => 30000),
        'workshop'     => null,
        'objectives'   => array('Provide practical exposure to real-world coding problems and automated execution pipelines.', 'Sharpen algorithmic reasoning and execution speed under timed contest conditions.'),
        'image'        => 'theme/assets/images/competitions/programming-challenge.jpg',
        'image_remote' => 'https://images.openai.com/static-rsc-4/yXJtTOeu0g2ZLBkYbCqBdbUD2K5VbvIEqUsdftTmJiny04FBTknIxNqCakQXZibeNKWbiuAhZJym2iYyFFE2zdoSe9oexQ9p9n2_wYz7jkKpIQAyMZ6WXNvMU3ZYyhImQvikZAI63Khl9TKXNpY1UBE3hJpVfRGXMmiF7j5Y-zo?purpose=inline',
        'image_credit' => 'How Hackathons Can Boost Your Career as a Student | Mandala Suresh Kumar posted on the topic | LinkedIn',
        'rules_notice' => 'Contest environment details, language runtimes, and HackerRank contest access codes will be provided at the lab venue.'
    ),
    array(
        'id'           => 'ict-quiz',
        'number'       => '07',
        'title'        => 'ICT Quiz Contest',
        'category'     => 'computing',
        'category_lbl' => 'Computing & Technology',
        'track_code'   => 'B',
        'tagline'      => 'Individual fast-paced ICT knowledge battle hosted on Kahoot in the Auditorium',
        'desc'         => 'Individual participation, two rounds of 60 minutes each, initially using Kahoot. Venue: Auditorium.',
        'full_desc'    => 'The objective of the ICT Quiz Competition is to assess and enhance students’ knowledge of Information and Communication Technology (ICT) through an interactive, gamified environment. Competing individually in the Grand Auditorium over two 60-minute rounds on Kahoot, participants answer rapid-fire questions testing quick thinking, technical accuracy, and emerging technology awareness.',
        'fee'          => 'PKR 200 / participant',
        'fee_amount'   => 200,
        'fee_type'     => 'individual',
        'team_size'    => 'Individual participation (1 student)',
        'min_team'     => 1,
        'max_team'     => 1,
        'format'       => 'Two 60-Minute Interactive Kahoot Rounds',
        'rounds_count' => '2 Rounds (60 Minutes each)',
        'stages'       => null,
        'rubric'       => array('Kahoot interactive scoring combining accuracy and answer speed', 'Knowledge across ICT, computer architecture, networking, and software', 'Rapid decision-making under time pressure'),
        'venue'        => 'Auditorium, Sukkur IBA University',
        'venue_conf'   => true,
        'prizes'       => array('first' => 'PKR 15,000', 'second' => 'PKR 10,000', 'third' => 'PKR 5,000', 'total' => 30000),
        'workshop'     => null,
        'objectives'   => array('Assess and enhance students’ knowledge of ICT through an interactive and competitive learning environment.', 'Develop quick thinking, accuracy, time management, and awareness of emerging technologies.'),
        'image'        => 'theme/assets/images/competitions/ict-quiz.jpg',
        'image_remote' => 'https://images.openai.com/static-rsc-4/42fSbEDjAe2HAwDrjvBxcQDJO3keD5dqLxptTH_eySCnGygV_5Ep4zLGHwwZKM0Tno6b4tos3NsPlY0uLLgKNDfWpEyRRez5rmHTdPFQJ7Bl4FB_KJRBFiWcZK71Xm-9yLLCAayHHgqkIAVR5BJgTSEeKk9mmUH66U-Eto_EiP4?purpose=inline',
        'image_credit' => 'Techpoint Future: Fremtidens teknologi - Tangen videregående skole',
        'rules_notice' => 'Participants must bring a connected smartphone or laptop for live Kahoot quiz session participation.'
    ),
    array(
        'id'           => 'project-exhibition',
        'number'       => '08',
        'title'        => 'Project Exhibition — Hardware & Software',
        'category'     => 'computing',
        'category_lbl' => 'Computing & Technology',
        'track_code'   => 'B',
        'tagline'      => 'Dual-tier hardware and software showcase for Junior & Senior innovators',
        'desc'         => 'Hardware and software project categories, divided into junior (up to semester 5) and senior (semester 6 onwards). Maximum four members per team. Venues: VFX Lab, FYP Lab and Fab Lab.',
        'full_desc'    => 'The Project Exhibition is SIBACOM’s premiere stage for applied student engineering. Open to both hardware prototypes and software applications, it features distinct Junior (up to 5th semester) and Senior (6th semester onwards) categories. Participants are encouraged to focus on high-impact theme areas: Medical, Climate, Agriculture, and General/Miscellaneous. Arduino workshops are held for junior batches to encourage prototype development.',
        'fee'          => 'PKR 500 / team',
        'fee_amount'   => 500,
        'fee_type'     => 'team',
        'team_size'    => 'Maximum 4 members per team',
        'min_team'     => 1,
        'max_team'     => 4,
        'format'       => 'Exhibition Booth Demonstration & Jury Defense',
        'rounds_count' => 'Exhibition Display & Live Faculty Defense',
        'academic_cat' => array(
            'junior' => 'Junior Category: Students up to 5th semester (Includes Arduino workshops)',
            'senior' => 'Senior Category: Students from 6th semester onwards'
        ),
        'project_types'=> array('Hardware Projects', 'Software Projects'),
        'themes'       => array('Medical', 'Climate', 'Agriculture', 'Miscellaneous / General'),
        'workshop'     => array(
            'title' => 'Arduino Prototyping Workshop for Junior Batches',
            'desc'  => 'Targeted hands-on sessions for junior students to learn rapid hardware prototyping and embedded software integration.',
            'items' => array('Arduino boards & sensor interfacing', 'Circuit assembly', 'Prototype debugging')
        ),
        'stages'       => null,
        'rubric'       => array('Rubrics and value added to theme areas', 'Practical novelty and technical complexity', 'Live prototype stability and working demonstration', 'Quality of team presentation and defense'),
        'venue'        => 'VFX Lab, FYP Lab and Fab Lab',
        'venue_conf'   => true,
        'prizes'       => array(
            'first' => 'PKR 15,000 (Hardware) | PKR 15,000 (Software)',
            'second' => 'PKR 10,000 (Hardware) | PKR 10,000 (Software)',
            'third' => 'PKR 5,000 (Hardware) | PKR 5,000 (Software)',
            'total' => 60000,
            'subcategories' => array(
                'hardware' => array('first' => 'PKR 15,000', 'second' => 'PKR 10,000', 'third' => 'PKR 5,000', 'total' => 30000),
                'software' => array('first' => 'PKR 15,000', 'second' => 'PKR 10,000', 'third' => 'PKR 5,000', 'total' => 30000)
            )
        ),
        'objectives'   => array('Provide an authentic showcase for student projects that add tangible value to society.', 'Build confidence in junior and senior students to demonstrate working solutions live to juries.'),
        'image'        => 'theme/assets/images/competitions/project-exhibition.jpg',
        'image_remote' => 'https://images.openai.com/static-rsc-4/Q46kpZQhFG2jIiL9nnstIG99U2A4aQwJx7iGmrSF7Y5KZl4QB7wvVzGmjmW7CfxcWT8rEg1wREc24_CNrtaxVUiFEXHTv1KAIpORUJ1p0ghlHr2Rfth-IO2XqASjP3P5Bd-2popKJ9eHgCwZ6PUe586heK2XeD_GOlhiSuJmTOo?purpose=inline',
        'image_credit' => 'Department of EECE | GITAM University Bengaluru.',
        'rules_notice' => 'Booth dimensions, power supply availability, and poster display guidelines will be communicated to registered teams.'
    ),
    array(
        'id'           => 'tug-of-war',
        'number'       => '09',
        'title'        => 'Fun Activities – Tug of War',
        'category'     => 'sports',
        'category_lbl' => 'Sports & Fun Activities',
        'track_code'   => 'D',
        'tagline'      => 'High-energy team showdown of synchronized power, strategy & endurance',
        'desc'         => 'Team-based physical challenge focusing on teamwork, synchronization, strength, strategy and endurance.',
        'full_desc'    => 'The ultimate showdown of grit, strategy, and raw, explosive power. Teams lock hands on the rope, digging their heels into the ground for a high-stakes test of pure endurance. Far more than raw force, success hinges on mastering friction, leverage, and synchronized timing. This high-energy challenge pushes participants to manage collective momentum and experience applied physics in athletic motion.',
        'fee'          => 'PKR 300 / team',
        'fee_amount'   => 300,
        'fee_type'     => 'team',
        'team_size'    => 'Team-based athletic challenge (4 to 8 members)',
        'min_team'     => 4,
        'max_team'     => 8,
        'format'       => 'Knockout Bracket Heats on Grass Pitch',
        'rounds_count' => 'Elimination Heats to Finals',
        'workshop'     => null,
        'stages'       => null,
        'rubric'       => array('Synchronized pulling rhythm and collective momentum', 'Strategic application of friction, body angle, and foothold leverage', 'Endurance under sustained physical strain'),
        'venue'        => 'Campus Green Lawn / Sports Grounds',
        'venue_conf'   => false,
        'prizes'       => array('first' => 'PKR 15,000', 'second' => 'PKR 10,000', 'third' => 'PKR 5,000', 'total' => 30000),
        'objectives'   => array('Cultivate absolute unity, strategic alignment, and mental resilience under intense physical challenge.', 'Celebrate collective brilliance and applied physics in athletic motion.'),
        'image'        => 'theme/assets/images/competitions/tug-of-war.jpg',
        'image_remote' => 'https://images.openai.com/static-rsc-4/J2N4d8AmHB79VlYXfw-ld3bGVwSgesS2YMpBfg_v5j5Xras7IFHS9huw2bM6pjX4JgoRGcHKJKFe64YSxqoCFeTRYRa-HkWXxvaqi7kSbvcVAKaShTkqbi4MeEZt5lgm2Yfu5anB9BGXzT-93G2sUqNakJMopfq8JWChMXGaU-Y?purpose=inline',
        'image_credit' => 'History & Traditions - About Us - Schreyer Honors College (SHC) at Penn State University',
        'rules_notice' => 'Footwear restrictions, team weigh-in specifications, and match bracket rules will be announced before competition kick-off.'
    )
);

// Synchronize with WordPress CPT 'sibacom_event' if present (Admin dashboard updates take precedence)
if (post_type_exists('sibacom_event')) {
    $cpt_events = get_posts(array(
        'post_type'      => 'sibacom_event',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
    ));
    if (!empty($cpt_events)) {
        foreach ($cpt_events as $cpt_ev) {
            $ev_title     = trim(strtolower($cpt_ev->post_title));
            $m_venue      = get_post_meta($cpt_ev->ID, '_sibacom_event_venue', true);
            $m_fee_amount = get_post_meta($cpt_ev->ID, '_sibacom_event_fee_amount', true);
            $m_fee_type   = get_post_meta($cpt_ev->ID, '_sibacom_event_fee_type', true);
            $m_reg_url    = get_post_meta($cpt_ev->ID, '_sibacom_event_reg_url', true);
            $m_status     = get_post_meta($cpt_ev->ID, '_sibacom_event_status', true);
            $m_visibility = get_post_meta($cpt_ev->ID, '_sibacom_event_visibility', true);
            $m_btn_text   = get_post_meta($cpt_ev->ID, '_sibacom_event_btn_text', true);

            foreach ($official_competitions as &$comp_item) {
                $comp_title = trim(strtolower($comp_item['title']));
                $comp_slug  = str_replace('-', ' ', $comp_item['id']);
                if ($comp_title === $ev_title || 
                    strpos($comp_title, $ev_title) !== false || 
                    strpos($ev_title, $comp_title) !== false ||
                    strpos($ev_title, $comp_slug) !== false) {
                    
                    if (!empty($m_venue)) {
                        $comp_item['venue']      = $m_venue;
                        $comp_item['venue_conf'] = true;
                    }
                    if (!empty($m_fee_amount)) {
                        $comp_item['fee'] = $m_fee_amount;
                        if (preg_match('/(\d+[\d,]*)/', $m_fee_amount, $matches)) {
                            $comp_item['fee_amount'] = intval(str_replace(',', '', $matches[1]));
                        }
                    }
                    if (!empty($m_fee_type)) {
                        $comp_item['fee_type'] = $m_fee_type;
                    }
                    if (!empty($m_reg_url)) {
                        $comp_item['reg_url'] = $m_reg_url;
                    }
                    if (!empty($m_status)) {
                        $comp_item['status'] = $m_status;
                    }
                    if (!empty($m_visibility)) {
                        $comp_item['visibility'] = $m_visibility;
                    }
                    if (!empty($m_btn_text)) {
                        $comp_item['btn_text'] = $m_btn_text;
                    }
                    break;
                }
            }
            unset($comp_item);
        }

        // Filter out hidden competitions if marked as hidden by admin
        $official_competitions = array_values(array_filter($official_competitions, function($item) {
            return !isset($item['visibility']) || $item['visibility'] !== 'hidden';
        }));
    }
}

// Comprehensive Venues Allocation Matrix
$venues_list = array(
    array('name' => 'Auditorium', 'comps' => 'ICT Quiz Contest & Grand Prize Distribution Ceremony', 'building' => 'Main University Complex', 'capacity' => '800+ Seats', 'icon' => 'fa-landmark'),
    array('name' => 'Lab-II', 'comps' => 'Programming Challenge (Round 1 & 2)', 'building' => 'Academic Block-I (AB-I)', 'capacity' => '60 Workstations', 'icon' => 'fa-terminal'),
    array('name' => 'English Lab', 'comps' => 'Programming Challenge (Round 1 & 2)', 'building' => 'Academic Block-I (AB-I)', 'capacity' => '60 Workstations', 'icon' => 'fa-laptop-code'),
    array('name' => 'VFX Lab', 'comps' => 'Project Exhibition (Hardware & Software)', 'building' => 'Innovation Block', 'capacity' => 'High-Performance Graphics', 'icon' => 'fa-display'),
    array('name' => 'FYP Lab', 'comps' => 'Project Exhibition (Senior Final Year Projects)', 'building' => 'Engineering Complex', 'capacity' => 'Prototyping Benches', 'icon' => 'fa-microchip'),
    array('name' => 'Fab Lab', 'comps' => 'Project Exhibition (Rapid Fabrication & Hardware)', 'building' => 'Fab Lab Facility', 'capacity' => 'Machining & 3D Print', 'icon' => 'fa-cubes-stacked')
);

// Physical Campus Registration Desks
$desks_list = array(
    array('name' => 'Academic Block-1 (AB-I)', 'desc' => 'Lobby desk for CSE & EE students and inter-batch registrations.', 'icon' => 'fa-building-columns'),
    array('name' => 'Academic Block-2 (AB-II)', 'desc' => 'Help desk for cross-departmental, inter-faculty & guest delegation entries.', 'icon' => 'fa-landmark'),
    array('name' => 'Academic Block-3 (AB-III)', 'desc' => 'Central Secretariat desk for high-tech robotics, drones & arena modules.', 'icon' => 'fa-microchip'),
    array('name' => 'Knowledge Center', 'desc' => 'Central Library concourse desk for campus-wide participants & volunteers.', 'icon' => 'fa-book-bookmark')
);

// Expected Participating Universities
$universities_list = array(
    'Mehran University of Engineering and Technology, Jamshoro',
    'MUCET Khairpur Campus',
    'Quaid-e-Awam University (QUEST), Nawabshah',
    'QUEST Larkana Campus',
    'Shah Abdul Latif University (SALU), Khairpur',
    'SZABIST Larkana',
    'SZABIST Hyderabad',
    'ISRA University Hyderabad',
    'University of Sindh, Jamshoro',
    'Bahria University, Karachi',
    'Dawood University of Engineering and Technology (DUET), Karachi'
);
?>

<!-- SCOPED EVENTS EXPERIENCE: DEEP NAVY / MIDNIGHT LUXURY DESIGN SYSTEM -->
<style>
/* CSS Reset & Variables for Events Experience */
.sibacom-events-portal-dark {
  --ev-bg: #070B14;
  --ev-bg-card: rgba(13, 20, 36, 0.78);
  --ev-bg-card-hover: rgba(18, 29, 52, 0.92);
  --ev-bg-elevated: rgba(21, 32, 58, 0.85);
  --ev-border: rgba(255, 255, 255, 0.08);
  --ev-border-hover: rgba(0, 240, 255, 0.35);
  --ev-border-glow: rgba(59, 130, 246, 0.25);
  
  --ev-text-white: #FFFFFF;
  --ev-text-primary: #F8FAFC;
  --ev-text-secondary: #94A3B8;
  --ev-text-muted: #64748B;
  
  --ev-cyan: #00F0FF;
  --ev-cyan-glow: rgba(0, 240, 255, 0.4);
  --ev-blue: #3B82F6;
  --ev-indigo: #6366F1;
  --ev-purple: #A855F7;
  --ev-emerald: #10B981;
  --ev-amber: #F59E0B;
  
  background-color: var(--ev-bg);
  color: var(--ev-text-primary);
  font-family: var(--font-primary, 'Inter', -apple-system, BlinkMacSystemFont, sans-serif);
  position: relative;
  overflow: hidden;
  line-height: 1.6;
}

/* Smooth Scrolling & Anchor Offset for Sticky Header */
html {
  scroll-behavior: smooth;
}
#competitions-matrix,
#fee-calculator,
#prize-pool,
#campus-venues {
  scroll-margin-top: calc(var(--header-height, 82px) + 24px);
}

/* Ambient Radial Mesh Lighting */
.sibacom-events-portal-dark::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
  background: 
    radial-gradient(circle at 15% 10%, rgba(0, 240, 255, 0.07) 0%, transparent 45%),
    radial-gradient(circle at 85% 20%, rgba(59, 130, 246, 0.10) 0%, transparent 50%),
    radial-gradient(circle at 50% 60%, rgba(168, 85, 247, 0.05) 0%, transparent 60%),
    radial-gradient(circle at 20% 90%, rgba(16, 185, 129, 0.05) 0%, transparent 50%);
  z-index: 0;
}

/* Fine Technical Cyber Grid Background */
.ev-cyber-grid {
  position: absolute;
  inset: 0;
  background-image: 
    linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
  background-size: 52px 52px;
  pointer-events: none;
  z-index: 0;
}

.ev-content-wrap {
  position: relative;
  z-index: 1;
  max-width: 1240px;
  margin: 0 auto;
  padding: 2.5rem 1.25rem 6rem;
}

/* Gradient Typography */
.ev-gradient-cyan {
  background: linear-gradient(135deg, #00F0FF 0%, #38BDF8 50%, #3B82F6 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.ev-gradient-gold {
  background: linear-gradient(135deg, #FDE68A 0%, #F59E0B 70%, #D97706 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.ev-gradient-purple {
  background: linear-gradient(135deg, #C084FC 0%, #A855F7 60%, #6366F1 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

/* Glassmorphism Surface Base */
.ev-glass-panel {
  background: var(--ev-bg-card);
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  border: 1px solid var(--ev-border);
  border-radius: 20px;
  box-shadow: 0 16px 36px -10px rgba(0, 0, 0, 0.5);
  transition: transform 0.28s cubic-bezier(0.16, 1, 0.3, 1), border-color 0.28s ease, box-shadow 0.28s ease;
}
.ev-glass-panel:hover {
  border-color: var(--ev-border-hover);
  box-shadow: 0 20px 45px -12px rgba(0, 240, 255, 0.18);
}

/* Section Header Typography */
.ev-section-header {
  margin-bottom: 2.75rem;
}
.ev-section-kicker {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.35rem 0.9rem;
  border-radius: 9999px;
  background: rgba(0, 240, 255, 0.08);
  border: 1px solid rgba(0, 240, 255, 0.22);
  color: var(--ev-cyan);
  font-size: 0.78rem;
  font-family: monospace;
  font-weight: 700;
  letter-spacing: 0.05em;
  text-transform: uppercase;
  margin-bottom: 0.85rem;
}
.ev-section-title {
  font-size: clamp(1.85rem, 4vw, 2.75rem);
  font-weight: 800;
  color: var(--ev-text-white);
  line-height: 1.2;
  margin: 0 0 0.65rem;
  letter-spacing: -0.02em;
}
.ev-section-desc {
  font-size: 1.05rem;
  color: var(--ev-text-secondary);
  max-width: 760px;
  margin: 0;
  line-height: 1.65;
}

/* ================= HERO SECTION STYLES ================= */
.ev-hero-grid {
  display: grid;
  grid-template-columns: 1.15fr 0.85fr;
  gap: 2.5rem;
  align-items: stretch;
  margin-bottom: 4rem;
}
.ev-hero-main {
  padding: 2.75rem 2.25rem;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  border-left: 5px solid var(--ev-cyan);
}
.ev-society-lockup {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: space-between;
  gap: 0.85rem;
  margin-bottom: 1.5rem;
}
.ev-society-badge {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.12);
  padding: 0.35rem 0.85rem;
  border-radius: 9999px;
  font-size: 0.8rem;
  font-weight: 700;
  color: var(--ev-text-white);
}
.ev-pulse-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: var(--ev-cyan);
  box-shadow: 0 0 8px var(--ev-cyan);
  animation: evPulse 2s infinite;
}
@keyframes evPulse {
  0% { transform: scale(0.95); opacity: 0.8; }
  50% { transform: scale(1.25); opacity: 1; box-shadow: 0 0 14px var(--ev-cyan); }
  100% { transform: scale(0.95); opacity: 0.8; }
}
.ev-proposal-tag {
  font-family: monospace;
  font-size: 0.78rem;
  font-weight: 700;
  color: var(--ev-emerald);
  background: rgba(16, 185, 129, 0.12);
  border: 1px solid rgba(16, 185, 129, 0.25);
  padding: 0.3rem 0.75rem;
  border-radius: 9999px;
  display: inline-flex;
  align-items: center;
  gap: 6px;
}

.ev-hero-title {
  margin: 0 0 1rem;
  line-height: 1.1;
}
.ev-hero-subtitle-bar {
  display: block;
  font-size: clamp(0.95rem, 1.8vw, 1.25rem);
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.1em;
  color: var(--ev-cyan);
  margin-bottom: 0.65rem;
  font-family: monospace;
}
.ev-hero-headline-main {
  font-size: clamp(2.4rem, 5.2vw, 4.2rem);
  font-weight: 900;
  letter-spacing: -0.03em;
  color: var(--ev-text-white);
}
.ev-hero-lead {
  font-size: 1.12rem;
  color: var(--ev-text-secondary);
  line-height: 1.7;
  max-width: 680px;
  margin: 0 0 2rem;
}

/* Event Key Meta Pills */
.ev-meta-pills-wrap {
  display: flex;
  flex-wrap: wrap;
  gap: 0.85rem;
  margin-bottom: 2.25rem;
}
.ev-meta-pill {
  display: inline-flex;
  align-items: center;
  gap: 0.65rem;
  background: rgba(255, 255, 255, 0.04);
  border: 1px solid rgba(255, 255, 255, 0.1);
  padding: 0.65rem 1.15rem;
  border-radius: 12px;
  font-size: 0.88rem;
  color: var(--ev-text-white);
  backdrop-filter: blur(10px);
}
.ev-meta-pill i {
  font-size: 1.05rem;
}
.ev-meta-pill-prize {
  background: linear-gradient(135deg, rgba(245, 158, 11, 0.12) 0%, rgba(217, 119, 6, 0.18) 100%);
  border: 1px solid rgba(245, 158, 11, 0.4);
  box-shadow: 0 0 20px -5px rgba(245, 158, 11, 0.25);
}

/* Hero Action Buttons */
.ev-hero-actions {
  display: flex;
  flex-wrap: wrap;
  gap: 1rem;
}
.ev-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 0.65rem;
  padding: 0.85rem 1.65rem;
  border-radius: 12px;
  font-size: 0.95rem;
  font-weight: 700;
  text-decoration: none;
  cursor: pointer;
  transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
  min-height: 48px;
}
.ev-btn-primary {
  background: linear-gradient(135deg, #00F0FF 0%, #3B82F6 100%);
  color: #070B14;
  border: none;
  box-shadow: 0 10px 25px -5px rgba(0, 240, 255, 0.4);
}
.ev-btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 14px 30px -4px rgba(0, 240, 255, 0.6);
  color: #070B14;
}
.ev-btn-secondary {
  background: rgba(255, 255, 255, 0.06);
  color: var(--ev-text-white);
  border: 1px solid rgba(255, 255, 255, 0.18);
  backdrop-filter: blur(8px);
}
.ev-btn-secondary:hover {
  background: rgba(255, 255, 255, 0.12);
  border-color: rgba(255, 255, 255, 0.35);
  transform: translateY(-2px);
  color: var(--ev-text-white);
}
.ev-btn-outline-gold {
  background: rgba(245, 158, 11, 0.08);
  color: #FBBF24;
  border: 1px solid rgba(245, 158, 11, 0.3);
}
.ev-btn-outline-gold:hover {
  background: rgba(245, 158, 11, 0.15);
  border-color: #F59E0B;
  transform: translateY(-2px);
}

/* ================= TOURNAMENT HUD PANEL ================= */
.ev-hud-panel {
  padding: 2rem;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  border-top: 3px solid var(--ev-cyan);
}
.ev-hud-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  border-bottom: 1px dashed rgba(255, 255, 255, 0.12);
  padding-bottom: 0.85rem;
  margin-bottom: 1.5rem;
}
.ev-hud-title {
  font-family: monospace;
  font-size: 0.85rem;
  font-weight: 800;
  text-transform: uppercase;
  color: var(--ev-cyan);
  letter-spacing: 0.08em;
  display: flex;
  align-items: center;
  gap: 8px;
}
.ev-hud-status {
  display: flex;
  align-items: center;
  gap: 6px;
  font-family: monospace;
  font-size: 0.75rem;
  font-weight: 700;
  color: var(--ev-emerald);
}

/* Countdown Clock */
.ev-countdown-box {
  background: rgba(0, 0, 0, 0.4);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 14px;
  padding: 1.25rem 1rem;
  margin-bottom: 1.5rem;
  text-align: center;
}
.ev-countdown-label {
  font-size: 0.72rem;
  font-family: monospace;
  text-transform: uppercase;
  color: var(--ev-text-muted);
  letter-spacing: 0.1em;
  margin-bottom: 0.75rem;
}
.ev-countdown-digits {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 0.5rem;
}
.ev-digit-cell {
  background: rgba(255, 255, 255, 0.04);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 10px;
  padding: 0.6rem 0.25rem;
}
.ev-digit-val {
  font-size: clamp(1.4rem, 2.5vw, 1.85rem);
  font-weight: 900;
  color: var(--ev-text-white);
  font-family: monospace;
  line-height: 1;
}
.ev-digit-unit {
  font-size: 0.65rem;
  font-family: monospace;
  text-transform: uppercase;
  color: var(--ev-cyan);
  margin-top: 4px;
}

/* Quick Tracks Jump List */
.ev-hud-tracks {
  display: flex;
  flex-direction: column;
  gap: 0.65rem;
  margin-bottom: 1.5rem;
}
.ev-hud-track-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0.65rem 0.85rem;
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(255, 255, 255, 0.06);
  border-radius: 10px;
  font-size: 0.84rem;
  text-decoration: none;
  color: var(--ev-text-primary);
  transition: all 0.2s ease;
}
.ev-hud-track-row:hover {
  background: rgba(0, 240, 255, 0.08);
  border-color: rgba(0, 240, 255, 0.3);
  transform: translateX(4px);
  color: var(--ev-text-white);
}

/* ================= METRIC COUNTER CARDS ================= */
.ev-metrics-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 1.5rem;
  margin-bottom: 4rem;
}
.ev-metric-card {
  padding: 1.85rem;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  position: relative;
  overflow: hidden;
}
.ev-metric-card::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 3px;
  background: linear-gradient(90deg, transparent 0%, var(--card-accent, var(--ev-cyan)) 50%, transparent 100%);
}
.ev-metric-top {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.25rem;
}
.ev-metric-num {
  font-size: clamp(2.4rem, 4vw, 3rem);
  font-weight: 900;
  font-family: monospace;
  line-height: 1;
  color: var(--ev-text-white);
}
.ev-metric-icon {
  width: 48px;
  height: 48px;
  border-radius: 12px;
  background: rgba(255, 255, 255, 0.04);
  border: 1px solid rgba(255, 255, 255, 0.08);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.35rem;
  color: var(--card-accent, var(--ev-cyan));
}
.ev-metric-title {
  font-size: 1.15rem;
  font-weight: 800;
  color: var(--ev-text-white);
  margin: 0 0 0.35rem;
}
.ev-metric-desc {
  font-size: 0.88rem;
  color: var(--ev-text-secondary);
  margin: 0;
  line-height: 1.5;
}

/* ================= ADVISORY BANNER ================= */
.ev-advisory-banner {
  padding: 1.25rem 1.75rem;
  margin-bottom: 3.5rem;
  border-left: 4px solid var(--ev-cyan);
  display: flex;
  align-items: center;
  gap: 1.25rem;
}
.ev-advisory-icon {
  width: 42px;
  height: 42px;
  min-width: 42px;
  border-radius: 50%;
  background: rgba(0, 240, 255, 0.12);
  color: var(--ev-cyan);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.15rem;
}
.ev-advisory-text {
  font-size: 0.92rem;
  color: var(--ev-text-secondary);
  line-height: 1.6;
}

/* ================= FILTER & SEARCH BAR ================= */
.ev-filter-header {
  display: flex;
  flex-direction: column;
  gap: 1.75rem;
  margin-bottom: 2.5rem;
}
@media (min-width: 768px) {
  .ev-filter-header-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1.5rem;
  }
}
.ev-search-wrap {
  position: relative;
  width: 100%;
  max-width: 420px;
}
.ev-search-icon {
  position: absolute;
  left: 1.25rem;
  top: 50%;
  transform: translateY(-50%);
  color: var(--ev-cyan);
  pointer-events: none;
}
.ev-search-input {
  width: 100%;
  padding: 0.85rem 3rem 0.85rem 3rem;
  border-radius: 9999px;
  border: 1px solid rgba(255, 255, 255, 0.14);
  background: rgba(13, 20, 36, 0.8);
  color: var(--ev-text-white);
  font-size: 0.92rem;
  outline: none;
  backdrop-filter: blur(12px);
  transition: all 0.2s ease;
  box-sizing: border-box;
}
.ev-search-input:focus {
  border-color: var(--ev-cyan);
  box-shadow: 0 0 15px rgba(0, 240, 255, 0.25);
}
.ev-search-clear {
  position: absolute;
  right: 1rem;
  top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  color: var(--ev-text-muted);
  cursor: pointer;
  padding: 4px;
  display: none;
  font-size: 1.1rem;
}
.ev-search-clear:hover { color: var(--ev-text-white); }

.ev-filter-pills {
  display: flex;
  gap: 0.65rem;
  flex-wrap: wrap;
}
.ev-filter-btn {
  padding: 0.65rem 1.35rem;
  border-radius: 9999px;
  border: 1px solid rgba(255, 255, 255, 0.1);
  background: rgba(255, 255, 255, 0.04);
  color: var(--ev-text-secondary);
  font-size: 0.88rem;
  font-weight: 700;
  cursor: pointer;
  transition: all 0.2s ease;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  min-height: 42px;
}
.ev-filter-btn:hover {
  background: rgba(255, 255, 255, 0.08);
  color: var(--ev-text-white);
  border-color: rgba(255, 255, 255, 0.22);
}
.ev-filter-btn.active {
  background: linear-gradient(135deg, rgba(0, 240, 255, 0.15) 0%, rgba(59, 130, 246, 0.2) 100%);
  border-color: var(--ev-cyan);
  color: var(--ev-cyan);
  box-shadow: 0 0 15px rgba(0, 240, 255, 0.2);
}
.ev-filter-btn .badge-count {
  font-family: monospace;
  font-size: 0.72rem;
  background: rgba(0, 0, 0, 0.4);
  padding: 0.15rem 0.45rem;
  border-radius: 9999px;
  border: 1px solid rgba(255, 255, 255, 0.1);
}

/* ================= 9 COMPETITION CARDS ================= */
.ev-cards-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
  gap: 2rem;
  margin-bottom: 4rem;
}
.ev-card {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  border-radius: 20px;
  overflow: hidden;
  position: relative;
  border: 1px solid var(--ev-border);
  background: var(--ev-bg-card);
  transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), border-color 0.3s ease, box-shadow 0.3s ease;
}
.ev-card:hover {
  transform: translateY(-8px);
  border-color: var(--ev-border-hover);
  box-shadow: 0 25px 50px -15px rgba(0, 240, 255, 0.22);
}

/* Card Media Header */
.ev-card-media {
  position: relative;
  height: 220px;
  overflow: hidden;
  background: #0B1325;
}
.ev-card-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
}
.ev-card:hover .ev-card-img {
  transform: scale(1.08);
}
.ev-card-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(180deg, rgba(7, 11, 20, 0.3) 0%, rgba(7, 11, 20, 0.7) 60%, rgba(7, 11, 20, 0.98) 100%);
  pointer-events: none;
}
.ev-card-top-badges {
  position: absolute;
  top: 14px;
  left: 14px;
  right: 14px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  z-index: 2;
}
.ev-num-badge {
  font-family: monospace;
  font-size: 0.8rem;
  font-weight: 800;
  background: rgba(7, 11, 20, 0.85);
  color: var(--ev-cyan);
  padding: 0.3rem 0.75rem;
  border-radius: 8px;
  border: 1px solid rgba(0, 240, 255, 0.3);
  backdrop-filter: blur(8px);
}
.ev-fee-badge {
  font-family: monospace;
  font-size: 0.82rem;
  font-weight: 800;
  background: rgba(16, 185, 129, 0.92);
  color: #fff;
  padding: 0.3rem 0.85rem;
  border-radius: 8px;
  backdrop-filter: blur(8px);
  box-shadow: 0 4px 12px rgba(16, 185, 129, 0.35);
  display: inline-flex;
  align-items: center;
  gap: 5px;
}
.ev-card-title-overlay {
  position: absolute;
  bottom: 14px;
  left: 16px;
  right: 16px;
  z-index: 2;
}
.ev-track-tag {
  display: inline-block;
  font-size: 0.68rem;
  font-weight: 800;
  font-family: monospace;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  padding: 0.2rem 0.65rem;
  border-radius: 6px;
  margin-bottom: 6px;
}
.ev-track-tag.track-a { background: rgba(0, 240, 255, 0.18); color: var(--ev-cyan); border: 1px solid rgba(0, 240, 255, 0.3); }
.ev-track-tag.track-b { background: rgba(59, 130, 246, 0.18); color: #60A5FA; border: 1px solid rgba(59, 130, 246, 0.3); }
.ev-track-tag.track-c { background: rgba(168, 85, 247, 0.18); color: #C084FC; border: 1px solid rgba(168, 85, 247, 0.3); }
.ev-track-tag.track-d { background: rgba(16, 185, 129, 0.18); color: #34D399; border: 1px solid rgba(16, 185, 129, 0.3); }

.ev-card-heading {
  margin: 0;
  font-size: 1.35rem;
  font-weight: 800;
  color: var(--ev-text-white);
  line-height: 1.25;
}

/* Card Body Content */
.ev-card-body {
  padding: 1.5rem;
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
.ev-citation-row {
  font-size: 0.72rem;
  color: var(--ev-text-muted);
  margin-bottom: 0.85rem;
  display: flex;
  align-items: center;
  gap: 5px;
  border-bottom: 1px dashed rgba(255, 255, 255, 0.08);
  padding-bottom: 0.45rem;
}
.ev-card-tagline {
  font-size: 0.92rem;
  font-weight: 700;
  color: var(--ev-cyan);
  margin: 0 0 0.5rem;
  line-height: 1.45;
}
.ev-card-desc {
  font-size: 0.88rem;
  color: var(--ev-text-secondary);
  margin: 0 0 1.25rem;
  line-height: 1.6;
}

/* Technical Specs List */
.ev-specs-box {
  background: rgba(0, 0, 0, 0.25);
  border: 1px solid rgba(255, 255, 255, 0.06);
  border-radius: 12px;
  padding: 0.85rem 1rem;
  margin-bottom: 1.25rem;
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
  font-size: 0.82rem;
  font-family: monospace;
}
.ev-spec-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.ev-spec-label {
  color: var(--ev-text-muted);
  display: flex;
  align-items: center;
  gap: 6px;
}
.ev-spec-val {
  color: var(--ev-text-primary);
  font-weight: 700;
}

/* Workshop Banner in Card */
.ev-workshop-pill {
  padding: 0.5rem 0.85rem;
  background: rgba(245, 158, 11, 0.1);
  border: 1px solid rgba(245, 158, 11, 0.25);
  border-radius: 8px;
  color: #FBBF24;
  font-size: 0.8rem;
  margin-bottom: 1.25rem;
  display: flex;
  align-items: center;
  gap: 6px;
}

/* Prize Strip */
.ev-card-prize-strip {
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 12px;
  padding: 0.85rem 1rem;
  margin-bottom: 1.35rem;
}
.ev-prize-top {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 0.45rem;
  font-family: monospace;
  font-size: 0.82rem;
}
.ev-prize-chips {
  display: flex;
  justify-content: space-between;
  border-top: 1px dashed rgba(255, 255, 255, 0.08);
  padding-top: 0.45rem;
  font-size: 0.78rem;
  color: var(--ev-text-secondary);
}

/* Card Button Actions */
.ev-card-actions {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 0.75rem;
}
.ev-card-btn-details {
  background: rgba(255, 255, 255, 0.06);
  color: var(--ev-text-white);
  border: 1px solid rgba(255, 255, 255, 0.14);
  padding: 0.7rem 0.85rem;
  border-radius: 10px;
  font-weight: 700;
  font-size: 0.86rem;
  cursor: pointer;
  transition: all 0.2s ease;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  min-height: 44px;
}
.ev-card-btn-details:hover {
  background: rgba(255, 255, 255, 0.12);
  border-color: rgba(255, 255, 255, 0.3);
  transform: translateY(-2px);
}
.ev-card-btn-reg {
  background: linear-gradient(135deg, #00F0FF 0%, #3B82F6 100%);
  color: #070B14;
  border: none;
  padding: 0.7rem 0.85rem;
  border-radius: 10px;
  font-weight: 800;
  font-size: 0.86rem;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  transition: all 0.2s ease;
  min-height: 44px;
}
.ev-card-btn-reg:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px -3px rgba(0, 240, 255, 0.5);
  color: #070B14;
}

/* Empty Search State */
.ev-empty-state {
  display: none;
  text-align: center;
  padding: 4rem 1.5rem;
  max-width: 520px;
  margin: 2rem auto;
}
.ev-empty-icon {
  font-size: 3rem;
  color: var(--ev-cyan);
  margin-bottom: 1.25rem;
  opacity: 0.8;
}

/* ================= REGISTRATION CALCULATOR & SCHEDULE ================= */
.ev-calc-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 2.5rem;
  align-items: start;
  margin-bottom: 5rem;
}
@media (max-width: 992px) {
  .ev-calc-grid { grid-template-columns: 1fr; }
}

/* Dark Data Table Styling */
.ev-table-wrap {
  overflow-x: auto;
  border-radius: 18px;
  border: 1px solid var(--ev-border);
  background: var(--ev-bg-card);
  backdrop-filter: blur(14px);
  -webkit-overflow-scrolling: touch;
}
.ev-table {
  width: 100%;
  border-collapse: collapse;
  text-align: left;
  font-size: 0.92rem;
}
.ev-table th {
  padding: 1rem 1.25rem;
  background: rgba(255, 255, 255, 0.04);
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  font-family: monospace;
  font-size: 0.78rem;
  text-transform: uppercase;
  color: var(--ev-cyan);
  letter-spacing: 0.05em;
}
.ev-table td {
  padding: 0.95rem 1.25rem;
  border-bottom: 1px solid rgba(255, 255, 255, 0.04);
  color: var(--ev-text-primary);
}
.ev-table tr:hover td {
  background: rgba(255, 255, 255, 0.02);
}
.ev-table tfoot td {
  background: rgba(255, 255, 255, 0.05);
  font-weight: 800;
  border-top: 1px solid rgba(255, 255, 255, 0.15);
}

/* Calculator Box */
.ev-calc-box {
  padding: 2.25rem;
}
.ev-calc-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.25rem;
}
.ev-calc-checklist {
  display: flex;
  flex-direction: column;
  gap: 0.65rem;
  max-height: 320px;
  overflow-y: auto;
  margin-bottom: 1.5rem;
  padding-right: 6px;
}
.ev-calc-checklist::-webkit-scrollbar {
  width: 5px;
}
.ev-calc-checklist::-webkit-scrollbar-thumb {
  background: rgba(255, 255, 255, 0.15);
  border-radius: 9999px;
}
.ev-calc-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0.75rem 1rem;
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(255, 255, 255, 0.06);
  border-radius: 10px;
  cursor: pointer;
  transition: all 0.18s ease;
  user-select: none;
}
.ev-calc-item:hover {
  background: rgba(0, 240, 255, 0.05);
  border-color: rgba(0, 240, 255, 0.2);
}
.ev-calc-item input[type="checkbox"] {
  accent-color: var(--ev-cyan);
  width: 18px;
  height: 18px;
  cursor: pointer;
}
.ev-calc-presets {
  display: flex;
  gap: 0.5rem;
  flex-wrap: wrap;
  margin-bottom: 1.25rem;
}
.ev-preset-btn {
  background: rgba(255, 255, 255, 0.04);
  border: 1px solid rgba(255, 255, 255, 0.1);
  color: var(--ev-text-secondary);
  padding: 0.55rem 0.95rem;
  border-radius: 8px;
  font-size: 0.84rem;
  font-family: monospace;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s ease;
  min-height: 44px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  touch-action: manipulation;
}
.ev-preset-btn:hover {
  background: rgba(255, 255, 255, 0.08);
  color: var(--ev-text-white);
  border-color: rgba(255, 255, 255, 0.25);
}

.ev-calc-total-banner {
  padding: 1.5rem;
  background: linear-gradient(135deg, rgba(0, 240, 255, 0.08) 0%, rgba(59, 130, 246, 0.12) 100%);
  border: 1px solid rgba(0, 240, 255, 0.25);
  border-radius: 14px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.5rem;
}

/* ================= PRIZE DISTRIBUTION & 3D PODIUM ================= */
.ev-podium-section {
  margin-bottom: 5rem;
}
.ev-podium-hero {
  padding: 2.75rem 2.25rem;
  margin-bottom: 2.5rem;
  border-left: 5px solid #F59E0B;
  display: flex;
  flex-direction: column;
  gap: 2.5rem;
}
@media (min-width: 992px) {
  .ev-podium-hero {
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
  }
}
.ev-podium-visual {
  display: flex;
  align-items: flex-end;
  gap: 1rem;
  justify-content: center;
}
.ev-podium-col {
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
}
.ev-podium-card {
  border-radius: 16px 16px 0 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 1.25rem 0.85rem;
  box-sizing: border-box;
}
.ev-podium-1st {
  width: 145px;
  background: linear-gradient(180deg, rgba(245, 158, 11, 0.25) 0%, rgba(217, 119, 6, 0.35) 100%);
  border: 2px solid #F59E0B;
  box-shadow: 0 0 35px -5px rgba(245, 158, 11, 0.4);
  padding: 2.25rem 0.85rem 1.75rem;
}
.ev-podium-2nd {
  width: 125px;
  background: linear-gradient(180deg, rgba(203, 213, 225, 0.12) 0%, rgba(148, 163, 184, 0.18) 100%);
  border: 1px solid #94A3B8;
  padding: 1.65rem 0.85rem 1.25rem;
}
.ev-podium-3rd {
  width: 125px;
  background: linear-gradient(180deg, rgba(217, 119, 6, 0.12) 0%, rgba(180, 83, 9, 0.18) 100%);
  border: 1px solid #D97706;
  padding: 1.25rem 0.85rem 1rem;
}

/* ================= VENUES & CAMPUS SECTION ================= */
.ev-venues-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 1.5rem;
  margin-bottom: 3.5rem;
}
.ev-venue-card {
  padding: 1.65rem;
  border-top: 4px solid var(--ev-cyan);
}
.ev-desks-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 1.25rem;
  margin-bottom: 2.5rem;
}

/* ================= DETAILS MODAL ================= */
.ev-modal-overlay {
  display: none;
  position: fixed;
  inset: 0;
  z-index: 99999;
  background: rgba(7, 11, 20, 0.85);
  backdrop-filter: blur(14px);
  -webkit-backdrop-filter: blur(14px);
  align-items: center;
  justify-content: center;
  padding: 1.25rem;
}
.ev-modal-dialog {
  width: 100%;
  max-width: 820px;
  max-height: 90vh;
  display: flex;
  flex-direction: column;
  background: #0B1325;
  border: 1px solid rgba(0, 240, 255, 0.25);
  border-radius: 20px;
  box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.8);
  overflow: hidden;
  animation: evModalIn 0.25s cubic-bezier(0.16, 1, 0.3, 1);
}
@keyframes evModalIn {
  from { opacity: 0; transform: scale(0.95) translateY(10px); }
  to { opacity: 1; transform: scale(1) translateY(0); }
}
.ev-modal-header {
  padding: 1.75rem 2rem;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  background: rgba(255, 255, 255, 0.02);
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
}
.ev-modal-close {
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid rgba(255, 255, 255, 0.12);
  color: var(--ev-text-secondary);
  width: 44px;
  height: 44px;
  min-width: 44px;
  min-height: 44px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.25rem;
  cursor: pointer;
  transition: all 0.2s ease;
  touch-action: manipulation;
}
  justify-content: center;
  font-size: 1.2rem;
  cursor: pointer;
  transition: all 0.2s ease;
}
.ev-modal-close:hover {
  background: rgba(255, 255, 255, 0.2);
  color: var(--ev-text-white);
}
.ev-modal-body {
  padding: 2rem;
  overflow-y: auto;
  flex: 1;
  color: var(--ev-text-primary);
}
.ev-modal-footer {
  padding: 1.25rem 2rem;
  border-top: 1px solid rgba(255, 255, 255, 0.08);
  background: rgba(255, 255, 255, 0.02);
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 1rem;
}

/* Accessibility: prefers-reduced-motion */
@media (prefers-reduced-motion: reduce) {
  .ev-card, .ev-btn, .ev-pulse-dot, .ev-card-img {
    transition: none !important;
    animation: none !important;
  }
}

/* Mobile & Small Screens Adjustments */
@media (max-width: 992px) {
  .ev-hero-grid { grid-template-columns: 1fr; }
  .ev-hud-panel { border-top: none; border-left: 4px solid var(--ev-cyan); }
}
@media (max-width: 768px) {
  .ev-content-wrap { padding: 1.5rem 1rem 4rem; }
  .ev-hero-main { padding: 2rem 1.5rem; }
  .ev-hero-actions { flex-direction: column; }
  .ev-btn { width: 100%; justify-content: center; }
  .ev-card-actions { grid-template-columns: 1fr; }
  .ev-cards-grid { grid-template-columns: 1fr; }
  .ev-filter-btn { flex: 1 1 auto; justify-content: center; min-height: 44px; }
  .ev-search-wrap { max-width: 100%; }
  .ev-podium-hero { padding: 2rem 1.5rem; gap: 2rem; }
}
@media (max-width: 480px) {
  .ev-hero-main { padding: 1.5rem 1rem; }
  .ev-hero-headline-main { font-size: clamp(1.75rem, 7.5vw, 2.4rem); }
  .ev-hero-subtitle-bar { letter-spacing: 0.04em; }
  .ev-calc-box { padding: 1.35rem 1rem; }
  .ev-podium-hero { padding: 1.5rem 1rem; }
  .ev-podium-visual { gap: 0.5rem; width: 100%; }
  .ev-podium-1st { width: 95px; padding: 1.5rem 0.4rem 1rem; }
  .ev-podium-2nd { width: 82px; padding: 1.25rem 0.4rem 0.85rem; }
  .ev-podium-3rd { width: 82px; padding: 1rem 0.4rem 0.75rem; }
  .ev-venues-grid { grid-template-columns: 1fr; }
  .ev-desks-grid { grid-template-columns: 1fr; }
  .ev-modal-overlay { padding: 0.75rem; }
  .ev-modal-header { padding: 1.25rem 1rem; }
  .ev-modal-body { padding: 1.25rem 1rem; }
  .ev-modal-footer { padding: 1rem; flex-direction: column; align-items: stretch; text-align: center; }
  .ev-modal-footer > div { width: 100%; justify-content: center; }
}
@media (max-width: 360px) {
  .ev-content-wrap { padding: 1.25rem 0.65rem 3rem; }
  .ev-hero-main { padding: 1.25rem 0.75rem; }
  .ev-hero-headline-main { font-size: clamp(1.55rem, 7vw, 1.95rem); }
  .ev-calc-box { padding: 1.15rem 0.75rem; }
  .ev-podium-visual { gap: 0.35rem; }
  .ev-podium-1st { width: 82px; padding: 1.25rem 0.25rem 0.75rem; }
  .ev-podium-2nd { width: 70px; padding: 1rem 0.25rem 0.65rem; }
  .ev-podium-3rd { width: 70px; padding: 0.85rem 0.25rem 0.55rem; }
  .ev-podium-hero { padding: 1.25rem 0.75rem; }
}
@media (min-width: 1920px) {
  .ev-content-wrap { max-width: 1320px; }
}
</style>

<div class="sibacom-events-portal-dark" id="events-portal">
    <div class="ev-cyber-grid"></div>

    <div class="ev-content-wrap">
        
        <!-- ================= SECTION 1: HERO SECTION ================= -->
        <section class="ev-hero-grid">
            
            <!-- Left Editorial & High-Agency Typography Column -->
            <div class="ev-glass-panel ev-hero-main">
                <div>
                    <!-- Official SIBACOM Championship & Dual Societies Lockup -->
                    <div class="ev-society-lockup" style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                        <div style="background: #03326A; padding: 3px; border-radius: 10px; border: 1px solid rgba(255,255,255,0.15); box-shadow: 0 4px 14px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <img src="<?php echo esc_url(function_exists('sibacom_get_logo_url') ? sibacom_get_logo_url() : SIBACOM_THEME_URI . '/assets/images/sibacom_logo.jpg'); ?>" alt="SIBACOM" width="40" height="40" style="height: 40px; width: 40px; aspect-ratio: 1/1; border-radius: 7px; object-fit: contain; display: block;" />
                        </div>
                        <div class="ev-society-badge">
                            <span class="ev-pulse-dot"></span>
                            <span>Sukkur IBA University • CSE Society &amp; EE Society (SISC)</span>
                        </div>
                        <div class="ev-proposal-tag">
                            <i class="fa-solid fa-file-circle-check"></i>
                            <span>Official 2026 Proposal Specifications</span>
                        </div>
                    </div>

                    <!-- Imposing Hero Headline -->
                    <h1 class="ev-hero-title font-display">
                        <span class="ev-hero-subtitle-bar">SIBACOM 2026 — Competitions &amp; Rewards</span>
                        <span class="ev-hero-headline-main">COMPETE. INNOVATE. <span class="ev-gradient-cyan">DOMINATE.</span></span>
                    </h1>

                    <p class="ev-hero-lead">
                        Nine flagship competitive arenas across hardware prototyping, automated coding, combat robotics, drone aviation, and tactical esports. Jointly organized by the Electrical Engineering and Computer Systems Engineering Societies of Sukkur IBA University, featuring hands-on technical workshops and an audited PKR 345,000 cash honors fund.
                    </p>

                    <!-- Key Event Meta Pills -->
                    <div class="ev-meta-pills-wrap">
                        <div class="ev-meta-pill">
                            <i class="fa-regular fa-calendar-days" style="color: var(--ev-cyan);"></i>
                            <span><strong>Event Date:</strong> 26 November 2026 <small style="color: #FBBF24; margin-left: 4px;">(Proposed)</small></span>
                        </div>
                        <div class="ev-meta-pill">
                            <i class="fa-solid fa-location-dot" style="color: var(--ev-emerald);"></i>
                            <span><strong>Venue:</strong> Sukkur IBA University, Airport Road, Sukkur</span>
                        </div>
                        <div class="ev-meta-pill ev-meta-pill-prize">
                            <i class="fa-solid fa-trophy" style="color: #F59E0B;"></i>
                            <span><strong>Total Prize Pool:</strong> <span style="font-weight: 800; color: #FDE68A;">PKR 326,500 – 345,000</span></span>
                        </div>
                    </div>
                </div>

                <!-- Primary CTAs & Jump Links -->
                <div class="ev-hero-actions">
                    <a href="#competitions-matrix" class="ev-btn ev-btn-primary">
                        <span>Explore 9 Competitions</span>
                        <i class="fa-solid fa-arrow-down"></i>
                    </a>
                    <a href="<?php echo esc_url($reg_portal_url); ?>" target="<?php echo esc_attr($reg_portal_target); ?>"<?php echo $reg_portal_rel; ?> class="ev-btn ev-btn-secondary">
                        <span>Register Now</span>
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </a>
                    <a href="#fee-calculator" class="ev-btn ev-btn-secondary" style="font-size: 0.88rem;">
                        <i class="fa-solid fa-calculator" style="color: var(--ev-cyan);"></i>
                        <span>Fee Calculator</span>
                    </a>
                    <a href="#prize-pool" class="ev-btn ev-btn-outline-gold" style="font-size: 0.88rem;">
                        <i class="fa-solid fa-award"></i>
                        <span>Cash Prizes</span>
                    </a>
                </div>
            </div>

            <!-- Right Column: Interactive Tournament Operations HUD -->
            <div class="ev-glass-panel ev-hud-panel">
                <div>
                    <div class="ev-hud-header">
                        <div class="ev-hud-title">
                            <i class="fa-solid fa-radar" style="color: var(--ev-cyan);"></i>
                            <span>Tournament Operations HUD</span>
                        </div>
                        <div class="ev-hud-status">
                            <span class="ev-pulse-dot" style="background: var(--ev-emerald); box-shadow: 0 0 8px var(--ev-emerald);"></span>
                            <span>REGISTRATION ACTIVE</span>
                        </div>
                    </div>

                    <!-- Live Countdown Timer -->
                    <div class="ev-countdown-box">
                        <div class="ev-countdown-label">
                            <i class="fa-solid fa-hourglass-half" style="margin-right: 4px; color: var(--ev-cyan);"></i>
                            Countdown to Grand Kickoff • 26 Nov 2026
                        </div>
                        <div class="ev-countdown-digits">
                            <div class="ev-digit-cell">
                                <div class="ev-digit-val" id="ev-cd-days">295</div>
                                <div class="ev-digit-unit">Days</div>
                            </div>
                            <div class="ev-digit-cell">
                                <div class="ev-digit-val" id="ev-cd-hours">18</div>
                                <div class="ev-digit-unit">Hours</div>
                            </div>
                            <div class="ev-digit-cell">
                                <div class="ev-digit-val" id="ev-cd-mins">42</div>
                                <div class="ev-digit-unit">Mins</div>
                            </div>
                            <div class="ev-digit-cell">
                                <div class="ev-digit-val" id="ev-cd-secs">30</div>
                                <div class="ev-digit-unit">Secs</div>
                            </div>
                        </div>
                    </div>

                    <!-- 4 Flagship Tracks Fast Selector -->
                    <div style="font-size: 0.75rem; font-family: monospace; text-transform: uppercase; color: var(--ev-text-muted); margin-bottom: 0.65rem; letter-spacing: 0.08em;">
                        Official Competition Tracks
                    </div>
                    <div class="ev-hud-tracks">
                        <a href="javascript:void(0)" onclick="window.sibacomFilterCategory('hardware')" class="ev-hud-track-row">
                            <span style="display: flex; align-items: center; gap: 8px;">
                                <i class="fa-solid fa-microchip" style="color: var(--ev-cyan);"></i>
                                <span>Track A: Hardware &amp; Engineering</span>
                            </span>
                            <span style="font-family: monospace; font-size: 0.78rem; font-weight: 800; color: var(--ev-cyan);">4 Modules</span>
                        </a>
                        <a href="javascript:void(0)" onclick="window.sibacomFilterCategory('computing')" class="ev-hud-track-row">
                            <span style="display: flex; align-items: center; gap: 8px;">
                                <i class="fa-solid fa-laptop-code" style="color: #60A5FA;"></i>
                                <span>Track B: Computing &amp; Technology</span>
                            </span>
                            <span style="font-family: monospace; font-size: 0.78rem; font-weight: 800; color: #60A5FA;">3 Modules</span>
                        </a>
                        <a href="javascript:void(0)" onclick="window.sibacomFilterCategory('gaming')" class="ev-hud-track-row">
                            <span style="display: flex; align-items: center; gap: 8px;">
                                <i class="fa-solid fa-gamepad" style="color: #C084FC;"></i>
                                <span>Track C: Gaming &amp; E-Sports</span>
                            </span>
                            <span style="font-family: monospace; font-size: 0.78rem; font-weight: 800; color: #C084FC;">1 Module</span>
                        </a>
                        <a href="javascript:void(0)" onclick="window.sibacomFilterCategory('sports')" class="ev-hud-track-row">
                            <span style="display: flex; align-items: center; gap: 8px;">
                                <i class="fa-solid fa-person-running" style="color: #34D399;"></i>
                                <span>Track D: Sports &amp; Fun Activities</span>
                            </span>
                            <span style="font-family: monospace; font-size: 0.78rem; font-weight: 800; color: #34D399;">1 Module</span>
                        </a>
                    </div>
                </div>

                <div style="font-size: 0.75rem; color: var(--ev-text-muted); display: flex; align-items: center; gap: 6px; padding-top: 1rem; border-top: 1px dashed rgba(255,255,255,0.08);">
                    <i class="fa-solid fa-shield-halved" style="color: var(--ev-emerald);"></i>
                    <span>Verified Proposal Record • Sukkur IBA Students Council (SISC)</span>
                </div>
            </div>

        </section>

        <!-- ================= SECTION 2: COMPETITION STATISTICS COUNTERS ================= -->
        <section class="ev-metrics-grid" id="metrics-counters">
            <!-- Card 1 -->
            <div class="ev-glass-panel ev-metric-card" style="--card-accent: var(--ev-cyan);">
                <div class="ev-metric-top">
                    <span class="ev-metric-num" data-target="9" id="cnt-comps">09</span>
                    <div class="ev-metric-icon">
                        <i class="fa-solid fa-cubes"></i>
                    </div>
                </div>
                <div>
                    <h3 class="ev-metric-title">09 Flagship Activities</h3>
                    <p class="ev-metric-desc">Complete multi-discipline roster from circuit synthesis to algorithmic speed-coding.</p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="ev-glass-panel ev-metric-card" style="--card-accent: #60A5FA;">
                <div class="ev-metric-top">
                    <span class="ev-metric-num" data-target="4" id="cnt-tracks">04</span>
                    <div class="ev-metric-icon">
                        <i class="fa-solid fa-microchip"></i>
                    </div>
                </div>
                <div>
                    <h3 class="ev-metric-title">04 Competition Tracks</h3>
                    <p class="ev-metric-desc">Hardware &amp; Robotics, Computing &amp; Tech, E-Sports tournament, and Sportsmanship.</p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="ev-glass-panel ev-metric-card" style="--card-accent: #F59E0B;">
                <div class="ev-metric-top">
                    <span class="ev-metric-num" data-target="345" id="cnt-prizes">345K</span>
                    <div class="ev-metric-icon">
                        <i class="fa-solid fa-trophy"></i>
                    </div>
                </div>
                <div>
                    <h3 class="ev-metric-title">PKR 326,500–345,000</h3>
                    <p class="ev-metric-desc">Audited official cash honors pool presented as formal cheques in the Grand Auditorium.</p>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="ev-glass-panel ev-metric-card" style="--card-accent: var(--ev-emerald);">
                <div class="ev-metric-top">
                    <span class="ev-metric-num" data-target="700" id="cnt-certs">700+</span>
                    <div class="ev-metric-icon">
                        <i class="fa-solid fa-certificate"></i>
                    </div>
                </div>
                <div>
                    <h3 class="ev-metric-title">700+ Certificates</h3>
                    <p class="ev-metric-desc">Official institutional certificates of merit and participation for contestants and volunteers.</p>
                </div>
            </div>
        </section>

        <!-- ================= SECTION 3: OFFICIAL ADVISORY BANNER ================= -->
        <div class="ev-glass-panel ev-advisory-banner">
            <div class="ev-advisory-icon">
                <i class="fa-solid fa-circle-info"></i>
            </div>
            <div class="ev-advisory-text">
                <strong style="color: var(--ev-cyan);">Official Advisory Note:</strong> Images displayed above and throughout the competition tracks are illustrative website imagery selected to represent the technical disciplines, not photographs of confirmed SIBACOM activities.
            </div>
        </div>

        <!-- ================= SECTION 4: INTERACTIVE FILTERING & SEARCH SYSTEM ================= -->
        <section id="competitions-matrix" style="margin-bottom: 4rem;">
            <div class="ev-filter-header">
                <div class="ev-filter-header-top">
                    <div>
                        <div class="ev-section-kicker">
                            <i class="fa-solid fa-filter"></i>
                            <span>Categorized Competition Matrix</span>
                        </div>
                        <h2 class="ev-section-title">Official Competition Segments</h2>
                        <p class="ev-section-desc">
                            Filter by engineering discipline or search by technology (Arduino, HackerRank, Kahoot, IR sensors), team size, or venue.
                        </p>
                    </div>

                    <!-- Modern Search Input -->
                    <div class="ev-search-wrap">
                        <i class="fa-solid fa-magnifying-glass ev-search-icon"></i>
                        <input type="text" id="sibacom-event-search" class="ev-search-input" placeholder="Search by name, Arduino, Kahoot, venue..." aria-label="Search competitions">
                        <button type="button" id="ev-search-clear-btn" class="ev-search-clear" aria-label="Clear search">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>

                <!-- 5 Filter Pills -->
                <div class="ev-filter-pills" role="tablist">
                    <button type="button" class="ev-filter-btn sibacom-cat-btn active" data-category="all" role="tab" aria-selected="true">
                        <i class="fa-solid fa-list-check"></i>
                        <span>All Competitions</span>
                        <span class="badge-count">9</span>
                    </button>
                    <button type="button" class="ev-filter-btn sibacom-cat-btn" data-category="hardware" role="tab" aria-selected="false">
                        <i class="fa-solid fa-microchip" style="color: var(--ev-cyan);"></i>
                        <span>Track A: Hardware &amp; Robotics</span>
                        <span class="badge-count">4</span>
                    </button>
                    <button type="button" class="ev-filter-btn sibacom-cat-btn" data-category="computing" role="tab" aria-selected="false">
                        <i class="fa-solid fa-code" style="color: #60A5FA;"></i>
                        <span>Track B: Computing &amp; Tech</span>
                        <span class="badge-count">3</span>
                    </button>
                    <button type="button" class="ev-filter-btn sibacom-cat-btn" data-category="gaming" role="tab" aria-selected="false">
                        <i class="fa-solid fa-gamepad" style="color: #C084FC;"></i>
                        <span>Track C: Gaming &amp; E-Sports</span>
                        <span class="badge-count">1</span>
                    </button>
                    <button type="button" class="ev-filter-btn sibacom-cat-btn" data-category="sports" role="tab" aria-selected="false">
                        <i class="fa-solid fa-person-running" style="color: #34D399;"></i>
                        <span>Track D: Sports &amp; Fun</span>
                        <span class="badge-count">1</span>
                    </button>
                </div>
            </div>

            <!-- ================= SECTION 5: 9 COMPETITION CARDS ================= -->
            <div class="ev-cards-grid" id="sibacom-competitions-grid">
                <?php foreach ($official_competitions as $comp) : 
                    $track_class = 'track-' . strtolower($comp['track_code']);
                ?>
                    <article class="ev-card sibacom-comp-card" data-id="<?php echo esc_attr($comp['id']); ?>" data-category="<?php echo esc_attr($comp['category']); ?>">
                        
                        <!-- Media Header with Image Zoom & Badges -->
                        <div class="ev-card-media">
                            <img src="<?php echo esc_url($comp['image']); ?>" 
                                 onerror="this.onerror=null; this.src='<?php echo esc_url($comp['image_remote']); ?>';" 
                                 alt="<?php echo esc_attr($comp['image_credit']); ?>" 
                                 class="ev-card-img"
                                 loading="lazy" 
                                 decoding="async" 
                                 width="400" 
                                 height="220" />
                            <div class="ev-card-overlay"></div>
                            
                            <!-- Badges -->
                            <div class="ev-card-top-badges">
                                <span class="ev-num-badge">#<?php echo esc_html($comp['number']); ?></span>
                                <?php if (!empty($comp['status']) && $comp['status'] === 'closed') : ?>
                                    <span class="ev-fee-badge" style="background: rgba(239,68,68,0.2); border-color: rgba(239,68,68,0.4); color: #FCA5A5;">
                                        <i class="fa-solid fa-lock"></i><?php esc_html_e('Closed', 'sibacom'); ?>
                                    </span>
                                <?php else : ?>
                                    <span class="ev-fee-badge">
                                        <i class="fa-solid fa-tag"></i><?php echo esc_html($comp['fee']); ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <!-- Bottom Title Overlay -->
                            <div class="ev-card-title-overlay">
                                <span class="ev-track-tag <?php echo esc_attr($track_class); ?>">
                                    Track <?php echo esc_html($comp['track_code']); ?> • <?php echo esc_html($comp['category_lbl']); ?>
                                </span>
                                <h3 class="ev-card-heading font-display">
                                    <?php echo esc_html($comp['title']); ?>
                                </h3>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="ev-card-body">
                            <div>
                                <!-- Image Source Citation -->
                                <div class="ev-citation-row">
                                    <i class="fa-solid fa-camera-retro"></i>
                                    <span style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">Illustrative: <?php echo esc_html($comp['image_credit']); ?></span>
                                </div>

                                <p class="ev-card-tagline">
                                    <?php echo esc_html($comp['tagline']); ?>
                                </p>
                                <p class="ev-card-desc">
                                    <?php echo esc_html($comp['desc']); ?>
                                </p>

                                <!-- Core Specifications List -->
                                <div class="ev-specs-box">
                                    <div class="ev-spec-row">
                                        <span class="ev-spec-label"><i class="fa-solid fa-users"></i>Team Size:</span>
                                        <span class="ev-spec-val"><?php echo esc_html($comp['team_size']); ?></span>
                                    </div>
                                    <div class="ev-spec-row">
                                        <span class="ev-spec-label"><i class="fa-solid fa-location-dot"></i>Venue:</span>
                                        <span class="ev-spec-val" style="color: <?php echo $comp['venue_conf'] ? 'var(--ev-cyan)' : '#F59E0B'; ?>;">
                                            <?php echo $comp['venue_conf'] ? esc_html($comp['venue']) : 'Awaiting Final Allocation'; ?>
                                        </span>
                                    </div>
                                    <div class="ev-spec-row">
                                        <span class="ev-spec-label"><i class="fa-solid fa-trophy"></i>Cash Honors:</span>
                                        <span class="ev-spec-val" style="color: #FBBF24;">PKR <?php echo number_format($comp['prizes']['total']); ?></span>
                                    </div>
                                </div>

                                <?php if (!empty($comp['workshop'])) : ?>
                                    <div class="ev-workshop-pill">
                                        <i class="fa-solid fa-wrench"></i>
                                        <span><strong>Workshop:</strong> <?php echo esc_html($comp['workshop']['title']); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Prize Bar Strip -->
                            <div class="ev-card-prize-strip">
                                <div class="ev-prize-top">
                                    <span><i class="fa-solid fa-award" style="color: #F59E0B; margin-right: 4px;"></i>Winner Awards:</span>
                                    <strong style="color: var(--ev-cyan);">Cheques on Stage</strong>
                                </div>
                                <div class="ev-prize-chips">
                                    <span>1st: <strong style="color: #FDE68A;"><?php echo esc_html($comp['prizes']['first']); ?></strong></span>
                                    <span>2nd: <strong style="color: #E2E8F0;"><?php echo esc_html($comp['prizes']['second']); ?></strong></span>
                                    <span>3rd: <strong style="color: #FED7AA;"><?php echo esc_html($comp['prizes']['third']); ?></strong></span>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="ev-card-actions">
                                <button type="button" class="ev-card-btn-details" onclick="window.sibacomOpenDetails('<?php echo esc_js($comp['id']); ?>');">
                                    <i class="fa-solid fa-eye"></i>
                                    <span><?php esc_html_e('View Details', 'sibacom'); ?></span>
                                </button>
                                <?php
                                $comp_reg_url = !empty($comp['reg_url']) ? $comp['reg_url'] : $reg_portal_url;
                                $comp_btn_txt = !empty($comp['btn_text']) ? $comp['btn_text'] : __('Register', 'sibacom');
                                $is_closed    = !empty($comp['status']) && $comp['status'] === 'closed';
                                ?>
                                <?php if ($is_closed) : ?>
                                    <span class="ev-card-btn-reg" style="opacity: 0.6; cursor: not-allowed; background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.15);">
                                        <span><?php esc_html_e('Registration Closed', 'sibacom'); ?></span>
                                        <i class="fa-solid fa-lock"></i>
                                    </span>
                                <?php else : ?>
                                    <a href="<?php echo esc_url($comp_reg_url); ?>" target="<?php echo esc_attr($reg_portal_target); ?>"<?php echo $reg_portal_rel; ?> class="ev-card-btn-reg">
                                        <span><?php echo esc_html($comp_btn_txt); ?></span>
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>

                    </article>
                <?php endforeach; ?>
            </div>

            <!-- Empty State -->
            <div id="sibacom-empty-search" class="ev-glass-panel ev-empty-state">
                <i class="fa-solid fa-magnifying-glass ev-empty-icon"></i>
                <h3 style="font-size: 1.35rem; font-weight: 800; color: var(--ev-text-white); margin: 0 0 0.5rem;">No matching competitions found</h3>
                <p style="font-size: 0.92rem; color: var(--ev-text-secondary); margin: 0 0 1.5rem;">
                    Try clearing your search query or selecting "All Competitions".
                </p>
                <button type="button" class="ev-btn ev-btn-primary" onclick="document.getElementById('sibacom-event-search').value=''; window.sibacomFilterCategory('all');">
                    <span>Reset All Filters</span>
                    <i class="fa-solid fa-rotate-left"></i>
                </button>
            </div>
        </section>

        <!-- ================= SECTION 6: REGISTRATION FEE SCHEDULE & CALCULATOR ================= -->
        <section id="fee-calculator" class="ev-calc-grid">
            
            <!-- Left: Complete Official Fee Schedule Table -->
            <div class="ev-table-wrap">
                <div style="padding: 1.5rem 1.5rem 1rem; border-bottom: 1px solid rgba(255,255,255,0.08);">
                    <div class="ev-section-kicker" style="margin-bottom: 0.5rem;">
                        <i class="fa-solid fa-receipt"></i>
                        <span>Transparent Tariff</span>
                    </div>
                    <h3 style="margin: 0 0 0.25rem; font-size: 1.35rem; color: var(--ev-text-white); font-weight: 800;">Official Registration Fee Schedule</h3>
                    <p style="margin: 0; font-size: 0.85rem; color: var(--ev-text-secondary);">Directly transcribed from the official SIBACOM 2026 Event Proposal.</p>
                </div>
                <table class="ev-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Competition</th>
                            <th>Participation Type</th>
                            <th style="text-align: right;">Fee</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td style="font-family: monospace; color: var(--ev-cyan);">01</td><td><strong>Circuit Design</strong></td><td style="color: var(--ev-text-muted);">Team (2 Students)</td><td style="text-align: right; font-weight: 800; color: var(--ev-cyan);">PKR 500 / team</td></tr>
                        <tr><td style="font-family: monospace; color: var(--ev-cyan);">02</td><td><strong>E-Games</strong></td><td style="color: var(--ev-text-muted);">Team (Max 4)</td><td style="text-align: right; font-weight: 800; color: var(--ev-cyan);">PKR 500 / team</td></tr>
                        <tr><td style="font-family: monospace; color: var(--ev-cyan);">03</td><td><strong>Robo War</strong></td><td style="color: var(--ev-text-muted);">Team (Workshop included)</td><td style="text-align: right; font-weight: 800; color: var(--ev-cyan);">PKR 500 / team</td></tr>
                        <tr><td style="font-family: monospace; color: var(--ev-cyan);">04</td><td><strong>Drone Competition</strong></td><td style="color: var(--ev-text-muted);">Team (Workshop included)</td><td style="text-align: right; font-weight: 800; color: var(--ev-cyan);">PKR 500 / team</td></tr>
                        <tr><td style="font-family: monospace; color: var(--ev-cyan);">05</td><td><strong>Line Following Robot (LFR)</strong></td><td style="color: var(--ev-text-muted);">Team (Workshop included)</td><td style="text-align: right; font-weight: 800; color: var(--ev-cyan);">PKR 500 / team</td></tr>
                        <tr><td style="font-family: monospace; color: var(--ev-cyan);">06</td><td><strong>Programming Challenge</strong></td><td style="color: var(--ev-text-muted);">Team (Max 2 Students)</td><td style="text-align: right; font-weight: 800; color: var(--ev-cyan);">PKR 500 / team</td></tr>
                        <tr style="background: rgba(16, 185, 129, 0.08);"><td style="font-family: monospace; color: var(--ev-emerald);">07</td><td><strong style="color: #6EE7B7;">ICT Quiz Contest</strong></td><td style="color: #6EE7B7;">Individual (Kahoot)</td><td style="text-align: right; font-weight: 800; color: #6EE7B7;">PKR 200 / person</td></tr>
                        <tr><td style="font-family: monospace; color: var(--ev-cyan);">08</td><td><strong>Project Exhibition (HW &amp; SW)</strong></td><td style="color: var(--ev-text-muted);">Team (Max 4 Members)</td><td style="text-align: right; font-weight: 800; color: var(--ev-cyan);">PKR 500 / team</td></tr>
                        <tr><td style="font-family: monospace; color: var(--ev-cyan);">09</td><td><strong>Tug of War</strong></td><td style="color: var(--ev-text-muted);">Team (4 to 8 Members)</td><td style="text-align: right; font-weight: 800; color: var(--ev-cyan);">PKR 300 / team</td></tr>
                    </tbody>
                </table>
            </div>

            <!-- Right: Interactive Delegation Fee Calculator -->
            <div class="ev-glass-panel ev-calc-box">
                <div class="ev-calc-header">
                    <div>
                        <div class="ev-section-kicker" style="margin-bottom: 0.35rem;">
                            <i class="fa-solid fa-calculator"></i>
                            <span>Interactive Tally</span>
                        </div>
                        <h3 style="margin: 0; font-size: 1.35rem; color: var(--ev-text-white); font-weight: 800;">Delegation Fee Calculator</h3>
                    </div>
                    <span id="calc-count-pill" style="font-family: monospace; font-size: 0.78rem; font-weight: 800; background: var(--ev-cyan); color: #070B14; padding: 0.25rem 0.75rem; border-radius: 9999px;">0 Selected</span>
                </div>
                <p style="font-size: 0.88rem; color: var(--ev-text-secondary); margin: 0 0 1rem;">
                    Select the modules your student delegation or society squad will participate in:
                </p>

                <!-- Quick Presets -->
                <div class="ev-calc-presets">
                    <button type="button" class="ev-preset-btn" onclick="window.sibacomCalcSelectCategory('hardware');">+ Hardware (4)</button>
                    <button type="button" class="ev-preset-btn" onclick="window.sibacomCalcSelectCategory('computing');">+ Computing (3)</button>
                    <button type="button" class="ev-preset-btn" onclick="window.sibacomCalcSelectAll();">Select All (9)</button>
                    <button type="button" class="ev-preset-btn" onclick="window.sibacomResetCalculator();">Clear All</button>
                </div>

                <!-- Checklist -->
                <div class="ev-calc-checklist" id="calc-checklist">
                    <?php foreach ($official_competitions as $c) : ?>
                        <label class="ev-calc-item">
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <input type="checkbox" class="sibacom-calc-cb" value="<?php echo esc_attr($c['fee_amount']); ?>" data-category="<?php echo esc_attr($c['category']); ?>" data-name="<?php echo esc_attr($c['title']); ?>">
                                <div>
                                    <span style="font-weight: 700; color: var(--ev-text-primary); font-size: 0.9rem; display: block;"><?php echo esc_html($c['title']); ?></span>
                                    <small style="font-size: 0.75rem; color: var(--ev-text-muted);"><?php echo esc_html($c['team_size']); ?></small>
                                </div>
                            </div>
                            <span style="font-family: monospace; font-weight: 800; color: var(--ev-cyan);"><?php echo esc_html($c['fee']); ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>

                <!-- Live Total Banner -->
                <div class="ev-calc-total-banner">
                    <div>
                        <span style="font-size: 0.75rem; font-family: monospace; text-transform: uppercase; color: var(--ev-text-muted); display: block;">Calculated Total Fee</span>
                        <span id="calc-total-display" class="font-display" style="font-size: 2.2rem; font-weight: 900; color: var(--ev-text-white); line-height: 1.1;">PKR 0</span>
                    </div>
                    <button type="button" class="ev-preset-btn" onclick="window.sibacomResetCalculator();" style="padding: 0.5rem 1rem;">
                        <i class="fa-solid fa-rotate-left" style="margin-right: 4px;"></i>Reset
                    </button>
                </div>

                <a href="<?php echo esc_url($reg_portal_url); ?>" target="<?php echo esc_attr($reg_portal_target); ?>"<?php echo $reg_portal_rel; ?> class="ev-btn ev-btn-primary" style="width: 100%;">
                    <span>Proceed to Official Registration Portal</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

        </section>

        <!-- ================= SECTION 7: PRIZE POOL & 3D PODIUM SECTION ================= -->
        <section id="prize-pool" class="ev-podium-section">
            <div class="ev-section-header">
                <div class="ev-section-kicker" style="background: rgba(245, 158, 11, 0.12); border-color: rgba(245, 158, 11, 0.3); color: #FBBF24;">
                    <i class="fa-solid fa-award"></i>
                    <span>Official Cash Honors &amp; Awards</span>
                </div>
                <h2 class="ev-section-title">SIBACOM 2026 Prize Pool &amp; Honors</h2>
                <p class="ev-section-desc">
                    Comprehensive cash prize fund verified from the official event proposal. Direct prize cheques presented on stage during the Auditorium Grand Award Ceremony.
                </p>
            </div>

            <!-- Grand Podium Hero -->
            <div class="ev-glass-panel ev-podium-hero">
                <div>
                    <span style="font-family: monospace; font-size: 0.82rem; text-transform: uppercase; font-weight: 800; color: #F59E0B; display: block; margin-bottom: 6px;">
                        Audited Official Cash Prize Allocation
                    </span>
                    <div class="font-display" style="font-size: clamp(2.5rem, 5.5vw, 4rem); font-weight: 900; color: var(--ev-text-white); line-height: 1.05;">
                        PKR 326,500 – 345,000
                    </div>
                    <p style="font-size: 1rem; color: var(--ev-text-secondary); margin: 0.85rem 0 0; max-width: 520px; line-height: 1.6;">
                        Presented via formal printed cheques during the Grand Award Ceremony in the Auditorium in the concluding hours of SIBACOM.
                    </p>
                </div>

                <!-- 3D-Inspired Podium Visual -->
                <div class="ev-podium-visual">
                    <!-- 2nd Place -->
                    <div class="ev-podium-col">
                        <div style="font-size: 0.78rem; font-weight: 800; color: #94A3B8; margin-bottom: 8px;">2nd Place</div>
                        <div class="ev-podium-card ev-podium-2nd">
                            <i class="fa-solid fa-medal" style="font-size: 1.85rem; color: #94A3B8; margin-bottom: 6px;"></i>
                            <div style="font-size: 0.95rem; font-weight: 800; color: #E2E8F0;">10K – 15K</div>
                            <div style="font-size: 0.72rem; color: #94A3B8;">Silver Shield</div>
                        </div>
                    </div>

                    <!-- 1st Place (Center / Elevated) -->
                    <div class="ev-podium-col">
                        <div style="font-size: 0.85rem; font-weight: 800; color: #F59E0B; margin-bottom: 8px;">
                            <i class="fa-solid fa-crown" style="margin-right: 4px;"></i>1st Place
                        </div>
                        <div class="ev-podium-card ev-podium-1st">
                            <i class="fa-solid fa-trophy" style="font-size: 2.5rem; color: #F59E0B; margin-bottom: 8px;"></i>
                            <div style="font-size: 1.15rem; font-weight: 900; color: #FEF3C7;">15K – 20K</div>
                            <div style="font-size: 0.75rem; font-weight: 700; color: #FDE68A;">Gold Trophy</div>
                        </div>
                    </div>

                    <!-- 3rd Place -->
                    <div class="ev-podium-col">
                        <div style="font-size: 0.78rem; font-weight: 800; color: #D97706; margin-bottom: 8px;">3rd Place</div>
                        <div class="ev-podium-card ev-podium-3rd">
                            <i class="fa-solid fa-award" style="font-size: 1.65rem; color: #D97706; margin-bottom: 6px;"></i>
                            <div style="font-size: 0.95rem; font-weight: 800; color: #FED7AA;">5K – 10K</div>
                            <div style="font-size: 0.72rem; color: #FDBA74;">Bronze Shield</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Complete Table Breakdown from Proposal -->
            <div class="ev-table-wrap" style="margin-bottom: 2.5rem;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.08); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 0.5rem;">
                    <h3 style="margin: 0; font-size: 1.2rem; color: var(--ev-text-white); font-weight: 800;">Competition-Wise Cash Distribution Table</h3>
                    <small style="color: var(--ev-text-muted); font-family: monospace;">Scroll horizontally if viewing on small screens</small>
                </div>
                <table class="ev-table">
                    <thead>
                        <tr>
                            <th>Competition</th>
                            <th>1st Prize</th>
                            <th>2nd Prize</th>
                            <th>3rd Prize</th>
                            <th style="text-align: right;">Subtotal (PKR)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td><strong>Circuit Design</strong></td><td style="color: #FBBF24; font-weight: 700;">15,000</td><td>10,000</td><td>5,000</td><td style="text-align: right; font-weight: 800; color: var(--ev-cyan);">30,000</td></tr>
                        <tr><td><strong>Programming Challenge</strong></td><td style="color: #FBBF24; font-weight: 700;">15,000</td><td>10,000</td><td>5,000</td><td style="text-align: right; font-weight: 800; color: var(--ev-cyan);">30,000</td></tr>
                        <tr><td><strong>ICT Quiz</strong></td><td style="color: #FBBF24; font-weight: 700;">15,000</td><td>10,000</td><td>5,000</td><td style="text-align: right; font-weight: 800; color: var(--ev-cyan);">30,000</td></tr>
                        <tr><td><strong>E-Games</strong></td><td style="color: #FBBF24; font-weight: 700;">5,000</td><td>4,000</td><td>2,500</td><td style="text-align: right; font-weight: 800; color: var(--ev-cyan);">11,500 <small style="color: var(--ev-text-muted);">(Pool: 30k)</small></td></tr>
                        <tr><td><strong>Robo War</strong></td><td style="color: #FBBF24; font-weight: 700;">20,000</td><td>15,000</td><td>10,000</td><td style="text-align: right; font-weight: 800; color: var(--ev-cyan);">45,000</td></tr>
                        <tr><td><strong>Drone Competition</strong></td><td style="color: #FBBF24; font-weight: 700;">20,000</td><td>15,000</td><td>10,000</td><td style="text-align: right; font-weight: 800; color: var(--ev-cyan);">45,000</td></tr>
                        <tr style="background: rgba(255,255,255,0.02);"><td><strong>Project Exhibition – Hardware</strong></td><td style="color: #FBBF24; font-weight: 700;">15,000</td><td>10,000</td><td>5,000</td><td style="text-align: right; font-weight: 800; color: var(--ev-cyan);">30,000</td></tr>
                        <tr style="background: rgba(255,255,255,0.02);"><td><strong>Project Exhibition – Software</strong></td><td style="color: #FBBF24; font-weight: 700;">15,000</td><td>10,000</td><td>5,000</td><td style="text-align: right; font-weight: 800; color: var(--ev-cyan);">30,000</td></tr>
                        <tr><td><strong>Line Following Robot (LFR)</strong></td><td style="color: #FBBF24; font-weight: 700;">20,000</td><td>15,000</td><td>10,000</td><td style="text-align: right; font-weight: 800; color: var(--ev-cyan);">45,000</td></tr>
                        <tr><td><strong>Tug of War</strong></td><td style="color: #FBBF24; font-weight: 700;">15,000</td><td>10,000</td><td>5,000</td><td style="text-align: right; font-weight: 800; color: var(--ev-cyan);">30,000</td></tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="color: var(--ev-cyan);">Grand Total Cash Prize Fund</td>
                            <td style="color: #FBBF24;">155,000</td>
                            <td>109,000</td>
                            <td>62,500</td>
                            <td style="text-align: right; color: var(--ev-cyan);">PKR 326,500 – 345,000</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Additional Honors Beyond Cash -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.5rem;">
                <div class="ev-glass-panel" style="padding: 1.65rem; border-top: 3px solid #F59E0B;">
                    <i class="fa-solid fa-money-check-dollar" style="font-size: 1.6rem; color: #F59E0B; margin-bottom: 0.85rem;"></i>
                    <h4 style="margin: 0 0 0.45rem; font-size: 1.1rem; color: var(--ev-text-white); font-weight: 800;">Winner Prize Cheques</h4>
                    <p style="font-size: 0.88rem; color: var(--ev-text-secondary); margin: 0; line-height: 1.55;">
                        Ceremonial and printed winner cheques (40 printed cheques allocated) handed over on stage during the award ceremony.
                    </p>
                </div>
                <div class="ev-glass-panel" style="padding: 1.65rem; border-top: 3px solid var(--ev-emerald);">
                    <i class="fa-solid fa-certificate" style="font-size: 1.6rem; color: var(--ev-emerald); margin-bottom: 0.85rem;"></i>
                    <h4 style="margin: 0 0 0.45rem; font-size: 1.1rem; color: var(--ev-text-white); font-weight: 800;">700+ Official Certificates</h4>
                    <p style="font-size: 0.88rem; color: var(--ev-text-secondary); margin: 0; line-height: 1.55;">
                        Official certificates of merit and participation provided to all verified contestants and student volunteers.
                    </p>
                </div>
                <div class="ev-glass-panel" style="padding: 1.65rem; border-top: 3px solid var(--ev-cyan);">
                    <i class="fa-solid fa-microchip" style="font-size: 1.6rem; color: var(--ev-cyan); margin-bottom: 0.85rem;"></i>
                    <h4 style="margin: 0 0 0.45rem; font-size: 1.1rem; color: var(--ev-text-white); font-weight: 800;">Hardware Kits for Teams</h4>
                    <p style="font-size: 0.88rem; color: var(--ev-text-secondary); margin: 0; line-height: 1.55;">
                        Official Arduino kits, chassis, sensors, wheels, transmitters, and receivers provided for hands-on workshop learning.
                    </p>
                </div>
            </div>
        </section>

        <!-- ================= SECTION 8: CAMPUS & VENUE EXPERIENCE ================= -->
        <section id="campus-venues" style="margin-bottom: 4rem;">
            <div class="ev-section-header">
                <div class="ev-section-kicker">
                    <i class="fa-solid fa-building"></i>
                    <span>Campus Facilities &amp; Laboratories</span>
                </div>
                <h2 class="ev-section-title">Designated Event Venues &amp; Laboratories</h2>
                <p class="ev-section-desc">
                    All officially designated competition venues located on Sukkur IBA University’s 20-acre modern campus on Airport Road, Sukkur.
                </p>
            </div>

            <!-- 6 Venue Cards -->
            <div class="ev-venues-grid">
                <?php foreach ($venues_list as $v) : ?>
                    <div class="ev-glass-panel ev-venue-card">
                        <div style="display: flex; align-items: center; gap: 0.85rem; margin-bottom: 0.85rem;">
                            <div style="width: 44px; height: 44px; border-radius: 12px; background: rgba(0, 240, 255, 0.1); color: var(--ev-cyan); display: flex; align-items: center; justify-content: center; font-size: 1.25rem;">
                                <i class="fa-solid <?php echo esc_attr($v['icon']); ?>"></i>
                            </div>
                            <div>
                                <h4 style="margin: 0; font-size: 1.15rem; color: var(--ev-text-white); font-weight: 800;"><?php echo esc_html($v['name']); ?></h4>
                                <span style="font-size: 0.78rem; font-family: monospace; color: var(--ev-cyan);"><?php echo esc_html($v['building']); ?> • <?php echo esc_html($v['capacity']); ?></span>
                            </div>
                        </div>
                        <div style="font-size: 0.88rem; color: var(--ev-text-secondary); line-height: 1.55;">
                            <strong style="color: var(--ev-text-white);">Allocated Activity:</strong> <?php echo esc_html($v['comps']); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- 4 Physical Campus Registration Desks -->
            <div style="margin-bottom: 2rem;">
                <h3 style="font-size: 1.35rem; color: var(--ev-text-white); font-weight: 800; margin: 0 0 1.25rem;">
                    <i class="fa-solid fa-map-location-dot" style="margin-right: 8px; color: var(--ev-emerald);"></i>
                    Physical Campus Help Desks
                </h3>
                <div class="ev-desks-grid">
                    <?php foreach ($desks_list as $d) : ?>
                        <div class="ev-glass-panel" style="padding: 1.35rem;">
                            <div style="display: flex; align-items: center; gap: 0.65rem; margin-bottom: 0.5rem;">
                                <i class="fa-solid <?php echo esc_attr($d['icon']); ?>" style="color: var(--ev-emerald);"></i>
                                <h4 style="margin: 0; font-size: 0.98rem; color: var(--ev-text-white); font-weight: 700;"><?php echo esc_html($d['name']); ?></h4>
                            </div>
                            <p style="font-size: 0.82rem; color: var(--ev-text-secondary); margin: 0; line-height: 1.5;"><?php echo esc_html($d['desc']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Expected Participating Universities & Map Action -->
            <div class="ev-glass-panel" style="padding: 2.25rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.25rem;">
                    <h3 class="font-display" style="font-size: 1.25rem; color: var(--ev-text-white); margin: 0;">
                        <i class="fa-solid fa-graduation-cap" style="margin-right: 8px; color: var(--ev-cyan);"></i>
                        Expected Participating Universities &amp; Colleges
                    </h3>
                    <a href="https://maps.google.com/?q=Sukkur+IBA+University+Airport+Road+Sukkur" target="_blank" rel="noopener noreferrer" class="ev-btn ev-btn-secondary" style="font-size: 0.84rem; padding: 0.5rem 1rem;">
                        <i class="fa-solid fa-location-crosshairs" style="color: var(--ev-cyan);"></i>
                        <span>View University Location on Google Maps</span>
                    </a>
                </div>
                <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                    <?php foreach ($universities_list as $u) : ?>
                        <span style="padding: 0.4rem 0.85rem; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 8px; color: var(--ev-text-secondary); font-size: 0.82rem; font-family: monospace;">
                            <?php echo esc_html($u); ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

    </div>
</div>

<!-- ================= DYNAMIC DETAILS MODAL ================= -->
<div id="sibacom-detail-modal" class="ev-modal-overlay" role="dialog" aria-modal="true" aria-labelledby="mdl-title">
    <div class="ev-modal-dialog">
        
        <!-- Modal Header with Official SIBACOM Identity -->
        <div class="ev-modal-header">
            <div style="display: flex; align-items: center; gap: 14px;">
                <div style="background: #03326A; padding: 3px; border-radius: 10px; border: 1px solid rgba(255,255,255,0.15); box-shadow: 0 4px 12px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <img src="<?php echo esc_url(function_exists('sibacom_get_logo_url') ? sibacom_get_logo_url() : SIBACOM_THEME_URI . '/assets/images/sibacom_logo.jpg'); ?>" alt="SIBACOM Logo" width="46" height="46" style="height: 46px; width: 46px; aspect-ratio: 1/1; border-radius: 7px; object-fit: contain; display: block;" />
                </div>
                <div>
                    <span id="mdl-cat-badge" style="display: inline-block; font-size: 0.72rem; font-family: monospace; font-weight: 800; text-transform: uppercase; color: var(--ev-cyan); background: rgba(0, 240, 255, 0.1); border: 1px solid rgba(0, 240, 255, 0.25); padding: 0.2rem 0.65rem; border-radius: 6px; margin-bottom: 4px;"></span>
                    <h2 id="mdl-title" class="font-display" style="margin: 0; font-size: 1.75rem; color: #FFFFFF; font-weight: 800; line-height: 1.2;"></h2>
                    <div id="mdl-tagline" style="font-size: 0.92rem; color: #38BDF8; font-weight: 600; margin-top: 3px;"></div>
                </div>
            </div>
            <button type="button" class="ev-modal-close" onclick="window.sibacomCloseDetails();" aria-label="Close modal">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Modal Body Content -->
        <div id="mdl-body" class="ev-modal-body">
            <!-- Populated dynamically via JavaScript -->
        </div>

        <!-- Modal Footer -->
        <div class="ev-modal-footer">
            <div id="mdl-fee-summary" style="font-size: 0.92rem; font-family: monospace; font-weight: 700; color: var(--ev-cyan);"></div>
            <div style="display: flex; gap: 0.75rem;">
                <button type="button" class="ev-btn ev-btn-secondary" onclick="window.sibacomCloseDetails();" style="padding: 0.6rem 1.25rem;">Close</button>
                <a id="mdl-register-btn" href="<?php echo esc_url($reg_portal_url); ?>" target="<?php echo esc_attr($reg_portal_target); ?>"<?php echo $reg_portal_rel; ?> class="ev-btn ev-btn-primary" style="padding: 0.6rem 1.45rem;">
                    <span>Register for Event</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- ================= JAVASCRIPT CONTROLLERS ================= -->
<script>
window.sibacomCompetitionsData = <?php echo json_encode($official_competitions); ?>;

// Category Filter Controller
window.sibacomFilterCategory = function(cat) {
    var buttons = document.querySelectorAll('.sibacom-cat-btn');
    buttons.forEach(function(btn) {
        if (btn.getAttribute('data-category') === cat) {
            btn.classList.add('active');
            btn.setAttribute('aria-selected', 'true');
        } else {
            btn.classList.remove('active');
            btn.setAttribute('aria-selected', 'false');
        }
    });

    var cards = document.querySelectorAll('.sibacom-comp-card');
    var visibleCount = 0;
    var searchInput = document.getElementById('sibacom-event-search');
    var searchVal = (searchInput && searchInput.value ? searchInput.value : '').toLowerCase().trim();

    cards.forEach(function(card) {
        var cardCat = card.getAttribute('data-category') || '';
        var cardText = card.textContent.toLowerCase();

        var matchesCat = (cat === 'all' || cardCat === cat);
        var matchesSearch = (!searchVal || cardText.indexOf(searchVal) !== -1);

        if (matchesCat && matchesSearch) {
            card.style.display = 'flex';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });

    var emptyState = document.getElementById('sibacom-empty-search');
    if (emptyState) {
        emptyState.style.display = visibleCount === 0 ? 'block' : 'none';
    }
};

// Search & Clear Controller
document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.getElementById('sibacom-event-search');
    var clearBtn = document.getElementById('ev-search-clear-btn');

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            if (clearBtn) {
                clearBtn.style.display = this.value ? 'block' : 'none';
            }
            var activeBtn = document.querySelector('.sibacom-cat-btn.active');
            var currentCat = activeBtn ? activeBtn.getAttribute('data-category') : 'all';
            window.sibacomFilterCategory(currentCat);
        });

        // Keyboard shortcut: '/' focuses search input
        window.addEventListener('keydown', function(e) {
            if (e.key === '/' && document.activeElement !== searchInput) {
                var isInput = ['INPUT', 'TEXTAREA', 'SELECT'].indexOf(document.activeElement.tagName) !== -1;
                if (!isInput) {
                    e.preventDefault();
                    searchInput.focus();
                }
            }
        });
    }

    if (clearBtn && searchInput) {
        clearBtn.addEventListener('click', function() {
            searchInput.value = '';
            clearBtn.style.display = 'none';
            var activeBtn = document.querySelector('.sibacom-cat-btn.active');
            var currentCat = activeBtn ? activeBtn.getAttribute('data-category') : 'all';
            window.sibacomFilterCategory(currentCat);
            searchInput.focus();
        });
    }

    var catButtons = document.querySelectorAll('.sibacom-cat-btn');
    catButtons.forEach(function(btn) {
        btn.addEventListener('click', function() {
            var cat = this.getAttribute('data-category');
            window.sibacomFilterCategory(cat);
        });
    });

    // Checkbox calculator listener
    var calcCheckboxes = document.querySelectorAll('.sibacom-calc-cb');
    calcCheckboxes.forEach(function(cb) {
        cb.addEventListener('change', window.sibacomUpdateCalculator);
    });

    // Check URL parameters for direct deep-linking (?module=... or ?category=...)
    var urlParams = new URLSearchParams(window.location.search);
    var modParam = urlParams.get('module') || urlParams.get('event');
    if (modParam) {
        window.sibacomOpenDetails(modParam);
    }
    var catParam = urlParams.get('category') || urlParams.get('track');
    if (catParam) {
        window.sibacomFilterCategory(catParam);
    }

    // Modal close on Escape key
    window.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            window.sibacomCloseDetails();
        }
    });

    // Initialize Animated Counters
    window.sibacomInitCounters();

    // Initialize Live Countdown
    window.sibacomInitCountdown();
});

// Calculator Controller
window.sibacomUpdateCalculator = function() {
    var checkboxes = document.querySelectorAll('.sibacom-calc-cb:checked');
    var targetTotal = 0;
    checkboxes.forEach(function(cb) {
        targetTotal += parseInt(cb.value, 10) || 0;
    });

    var display = document.getElementById('calc-total-display');
    if (display) {
        window.sibacomAnimateNumber(display, targetTotal, 'PKR ');
    }
    var pill = document.getElementById('calc-count-pill');
    if (pill) {
        pill.textContent = checkboxes.length + ' Selected';
    }
};

window.sibacomResetCalculator = function() {
    var checkboxes = document.querySelectorAll('.sibacom-calc-cb');
    checkboxes.forEach(function(cb) {
        cb.checked = false;
    });
    window.sibacomUpdateCalculator();
};

window.sibacomCalcSelectCategory = function(cat) {
    var checkboxes = document.querySelectorAll('.sibacom-calc-cb');
    checkboxes.forEach(function(cb) {
        if (cb.getAttribute('data-category') === cat) {
            cb.checked = true;
        }
    });
    window.sibacomUpdateCalculator();
};

window.sibacomCalcSelectAll = function() {
    var checkboxes = document.querySelectorAll('.sibacom-calc-cb');
    checkboxes.forEach(function(cb) {
        cb.checked = true;
    });
    window.sibacomUpdateCalculator();
};

// Smooth Number Animation
window.sibacomAnimateNumber = function(el, target, prefix, suffix) {
    prefix = prefix || '';
    suffix = suffix || '';
    var currentText = el.textContent.replace(/[^0-9]/g, '');
    var current = parseInt(currentText, 10) || 0;
    var duration = 400;
    var startTime = performance.now();

    function update(now) {
        var elapsed = now - startTime;
        var progress = Math.min(elapsed / duration, 1);
        var ease = 1 - Math.pow(1 - progress, 3);
        var val = Math.round(current + (target - current) * ease);
        el.textContent = prefix + val.toLocaleString() + suffix;
        if (progress < 1) {
            requestAnimationFrame(update);
        } else {
            el.textContent = prefix + target.toLocaleString() + suffix;
        }
    }
    requestAnimationFrame(update);
};

// Detail Modal Controller
window.sibacomOpenDetails = function(compId) {
    var comp = window.sibacomCompetitionsData.find(function(c) { return c.id === compId; });
    if (!comp) return;

    var catBadge = document.getElementById('mdl-cat-badge');
    if (catBadge) catBadge.textContent = 'Track ' + comp.track_code + ' • ' + comp.category_lbl;
    var titleEl = document.getElementById('mdl-title');
    if (titleEl) titleEl.textContent = comp.title;
    var taglineEl = document.getElementById('mdl-tagline');
    if (taglineEl) taglineEl.textContent = comp.tagline;
    var feeSumEl = document.getElementById('mdl-fee-summary');
    if (feeSumEl) feeSumEl.textContent = 'Registration: ' + comp.fee + ' | ' + comp.team_size;

    var regBtn = document.getElementById('mdl-register-btn');
    if (regBtn) {
        var baseRegUrl = <?php echo json_encode(esc_url($reg_portal_url)); ?>;
        regBtn.href = comp.reg_url ? comp.reg_url : (baseRegUrl ? baseRegUrl : 'https://portal.sibacom.tech/');
        if (comp.status === 'closed') {
            regBtn.innerHTML = '<span>Registration Closed</span> <i class="fa-solid fa-lock"></i>';
            regBtn.style.opacity = '0.6';
            regBtn.style.pointerEvents = 'none';
        } else {
            regBtn.innerHTML = '<span>' + (comp.btn_text ? comp.btn_text : 'Register for Track ' + comp.track_code) + '</span> <i class="fa-solid fa-arrow-right"></i>';
            regBtn.style.opacity = '1';
            regBtn.style.pointerEvents = 'auto';
        }
    }

    var html = '';
    html += '<div style="margin-bottom: 1.5rem;"><h4 style="font-size: 0.8rem; font-family: monospace; text-transform: uppercase; color: var(--ev-cyan); margin: 0 0 0.4rem;">01. Overview & Activity Details</h4>';
    html += '<p style="margin: 0; font-size: 0.95rem; line-height: 1.7; color: #CBD5E1;">' + comp.full_desc + '</p></div>';

    if (comp.stages && comp.stages.length) {
        html += '<div style="margin-bottom: 1.5rem;"><h4 style="font-size: 0.8rem; font-family: monospace; text-transform: uppercase; color: var(--ev-cyan); margin: 0 0 0.5rem;">02. Format & Progression Stages</h4>';
        comp.stages.forEach(function(stg) {
            html += '<div style="padding: 0.75rem 1rem; background: rgba(255,255,255,0.03); border-radius: 8px; border: 1px solid rgba(255,255,255,0.08); margin-bottom: 0.5rem;">';
            html += '<strong style="color: #F8FAFC;">' + stg.name + ':</strong> ';
            html += '<span style="color: #94A3B8; font-size: 0.9rem;">' + stg.desc + '</span></div>';
        });
        html += '</div>';
    } else {
        html += '<div style="margin-bottom: 1.5rem;"><h4 style="font-size: 0.8rem; font-family: monospace; text-transform: uppercase; color: var(--ev-cyan); margin: 0 0 0.5rem;">02. Competition Format</h4>';
        html += '<div style="padding: 0.75rem 1rem; background: rgba(255,255,255,0.03); border-radius: 8px; border: 1px solid rgba(255,255,255,0.08); color: #94A3B8; font-size: 0.9rem;">';
        html += '<strong>Format:</strong> ' + comp.format + ' • <strong>Rounds:</strong> ' + comp.rounds_count + '</div></div>';
    }

    if (comp.workshop) {
        html += '<div style="margin-bottom: 1.5rem; padding: 1rem 1.25rem; background: rgba(245,158,11,0.08); border-radius: 10px; border: 1px solid rgba(245,158,11,0.25);">';
        html += '<h4 style="font-size: 0.85rem; font-family: monospace; text-transform: uppercase; color: #FBBF24; margin: 0 0 0.35rem;"><i class="fa-solid fa-wrench" style="margin-right: 6px;"></i>03. Pre-Event Technical Workshop</h4>';
        html += '<strong style="display: block; font-size: 0.95rem; color: #FEF3C7; margin-bottom: 4px;">' + comp.workshop.title + '</strong>';
        html += '<p style="font-size: 0.88rem; color: #FDE68A; margin: 0 0 0.65rem; line-height: 1.55;">' + comp.workshop.desc + '</p>';
        html += '<div style="display: flex; flex-wrap: wrap; gap: 6px;">';
        comp.workshop.items.forEach(function(it) {
            html += '<span style="font-size: 0.75rem; font-family: monospace; background: rgba(0,0,0,0.4); border: 1px solid rgba(245,158,11,0.4); padding: 0.2rem 0.55rem; border-radius: 6px; color: #FDE68A;">' + it + '</span>';
        });
        html += '</div></div>';
    }

    html += '<div style="margin-bottom: 1.5rem;"><h4 style="font-size: 0.8rem; font-family: monospace; text-transform: uppercase; color: var(--ev-cyan); margin: 0 0 0.5rem;">04. Adjudication & Evaluation Rubric</h4><ul style="margin: 0; padding-left: 1.25rem; font-size: 0.9rem; color: #94A3B8;">';
    comp.rubric.forEach(function(r) {
        html += '<li style="margin-bottom: 4px;">' + r + '</li>';
    });
    html += '</ul></div>';

    html += '<div style="margin-bottom: 1.5rem;"><h4 style="font-size: 0.8rem; font-family: monospace; text-transform: uppercase; color: var(--ev-cyan); margin: 0 0 0.5rem;">05. Official Cash Prizes (PKR ' + comp.prizes.total.toLocaleString() + ')</h4>';
    html += '<div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 0.5rem; text-align: center;">';
    html += '<div style="padding: 0.75rem; background: rgba(245,158,11,0.15); border: 1px solid rgba(245,158,11,0.35); border-radius: 8px;"><strong style="color: #FEF3C7;">1st: ' + comp.prizes.first + '</strong></div>';
    html += '<div style="padding: 0.75rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px;"><strong style="color: #E2E8F0;">2nd: ' + comp.prizes.second + '</strong></div>';
    html += '<div style="padding: 0.75rem; background: rgba(217,119,6,0.12); border: 1px solid rgba(217,119,6,0.3); border-radius: 8px;"><strong style="color: #FED7AA;">3rd: ' + comp.prizes.third + '</strong></div>';
    html += '</div>';
    if (comp.prizes.pool_note) {
        html += '<div style="margin-top: 6px; padding: 0.5rem; background: rgba(245,158,11,0.08); border-radius: 6px; font-size: 0.75rem; color: #FBBF24; font-family: monospace;">' + comp.prizes.pool_note + '</div>';
    }
    html += '</div>';

    html += '<div style="padding: 0.85rem 1rem; background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.25); border-radius: 8px; font-size: 0.85rem; color: #FCA5A5;">';
    html += '<strong><i class="fa-solid fa-shield-halved" style="margin-right: 5px;"></i>Rules Notice:</strong> "' + comp.rules_notice + '"</div>';

    var bodyEl = document.getElementById('mdl-body');
    if (bodyEl) bodyEl.innerHTML = html;

    var modalEl = document.getElementById('sibacom-detail-modal');
    if (modalEl) {
        modalEl.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
};

window.sibacomCloseDetails = function() {
    var modalEl = document.getElementById('sibacom-detail-modal');
    if (modalEl) {
        modalEl.style.display = 'none';
        document.body.style.overflow = '';
    }
};

// Animated Counters Trigger via IntersectionObserver
window.sibacomInitCounters = function() {
    var section = document.getElementById('metrics-counters');
    if (!section || !('IntersectionObserver' in window)) return;

    var animated = false;
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting && !animated) {
                animated = true;
                
                var c1 = document.getElementById('cnt-comps');
                if (c1) window.sibacomAnimateNumber(c1, 9, '0');
                
                var c2 = document.getElementById('cnt-tracks');
                if (c2) window.sibacomAnimateNumber(c2, 4, '0');
                
                var c3 = document.getElementById('cnt-prizes');
                if (c3) window.sibacomAnimateNumber(c3, 345, '', 'K');
                
                var c4 = document.getElementById('cnt-certs');
                if (c4) window.sibacomAnimateNumber(c4, 700, '', '+');
                
                observer.unobserve(section);
            }
        });
    }, { threshold: 0.2 });

    observer.observe(section);
};

// Live Countdown Timer
window.sibacomInitCountdown = function() {
    var targetDate = new Date('2026-11-26T09:00:00+05:00').getTime();

    function update() {
        var now = new Date().getTime();
        var diff = targetDate - now;

        if (diff <= 0) {
            diff = 0;
        }

        var days = Math.floor(diff / (1000 * 60 * 60 * 24));
        var hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var mins = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        var secs = Math.floor((diff % (1000 * 60)) / 1000);

        var dEl = document.getElementById('ev-cd-days');
        var hEl = document.getElementById('ev-cd-hours');
        var mEl = document.getElementById('ev-cd-mins');
        var sEl = document.getElementById('ev-cd-secs');

        if (dEl) dEl.textContent = days;
        if (hEl) hEl.textContent = hours < 10 ? '0' + hours : hours;
        if (mEl) mEl.textContent = mins < 10 ? '0' + mins : mins;
        if (sEl) sEl.textContent = secs < 10 ? '0' + secs : secs;
    }

    update();
    setInterval(update, 1000);
};
</script>

<?php
    } // End of else (non-Elementor fallback)
endwhile;

get_footer();
