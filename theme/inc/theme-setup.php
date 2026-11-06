<?php
/**
 * SIBACOM Theme Setup
 *
 * @package SIBACOM
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('sibacom_setup')) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     */
    function sibacom_setup() {
        // Make theme available for translation.
        load_theme_textdomain('sibacom', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        // Let WordPress manage the document title.
        add_theme_support('title-tag');

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support('post-thumbnails');

        // Register custom logo support.
        add_theme_support('custom-logo', array(
            'height'      => 80,
            'width'       => 280,
            'flex-width'  => true,
            'flex-height' => true,
        ));

        // Switch default core markup for search form, comment form, and comments to output valid HTML5.
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ));

        // Add support for full and wide align images.
        add_theme_support('align-wide');

        // Add support for responsive embeds.
        add_theme_support('responsive-embeds');

        // Register Navigation Menus
        register_nav_menus(array(
            'primary-menu' => esc_html__('Primary Menu', 'sibacom'),
            'footer-menu'  => esc_html__('Footer Menu', 'sibacom'),
        ));
    }
}
add_action('after_setup_theme', 'sibacom_setup');

/**
 * Enqueue scripts and styles.
 */
function sibacom_scripts() {
    // Google Fonts (Inter & Manrope)
    wp_enqueue_style(
        'sibacom-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Manrope:wght@600;700;800;900&display=swap',
        array(),
        null
    );

    // Font Awesome 6 Icons
    wp_enqueue_style(
        'font-awesome-6',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
        array(),
        '6.5.1'
    );

    // Theme Main Stylesheet
    wp_enqueue_style('sibacom-main', SIBACOM_THEME_URI . '/assets/css/main.css', array(), SIBACOM_THEME_VERSION);

    // Theme Neumorphism Stylesheet
    wp_enqueue_style('sibacom-neumorphism', SIBACOM_THEME_URI . '/assets/css/neumorphism.css', array('sibacom-main'), SIBACOM_THEME_VERSION);

    // Theme Electrical Circuits & Animated Signal Flow Stylesheet
    wp_enqueue_style('sibacom-circuits', SIBACOM_THEME_URI . '/assets/css/circuits.css', array('sibacom-neumorphism'), SIBACOM_THEME_VERSION);

    // Theme Responsive Stylesheet
    wp_enqueue_style('sibacom-responsive', SIBACOM_THEME_URI . '/assets/css/responsive.css', array('sibacom-circuits'), SIBACOM_THEME_VERSION);

    // Theme Root Style.css
    wp_enqueue_style('sibacom-style', get_stylesheet_uri(), array('sibacom-responsive'), SIBACOM_THEME_VERSION);

    // Scripts (Deferred for optimal performance & Core Web Vitals)
    wp_enqueue_script('sibacom-navigation', SIBACOM_THEME_URI . '/assets/js/navigation.js', array(), SIBACOM_THEME_VERSION, true);
    wp_script_add_data('sibacom-navigation', 'strategy', 'defer');

    wp_enqueue_script('sibacom-countdown', SIBACOM_THEME_URI . '/assets/js/countdown.js', array(), SIBACOM_THEME_VERSION, true);
    wp_script_add_data('sibacom-countdown', 'strategy', 'defer');

    wp_enqueue_script('sibacom-main-js', SIBACOM_THEME_URI . '/assets/js/main.js', array(), SIBACOM_THEME_VERSION, true);
    wp_script_add_data('sibacom-main-js', 'strategy', 'defer');

    // Retrieve Target Countdown Date from options if available
    $target_date = get_option('sibacom_hero_countdown_date', '2026-11-30T09:00:00');

    wp_localize_script('sibacom-countdown', 'sibacomData', array(
        'ajaxUrl'    => admin_url('admin-ajax.php'),
        'targetDate' => $target_date,
    ));
}
add_action('wp_enqueue_scripts', 'sibacom_scripts');

/**
 * Register widget area.
 */
function sibacom_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'sibacom'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here to appear in your sidebar.', 'sibacom'),
        'before_widget' => '<section id="%1$s" class="widget neu-card %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'sibacom_widgets_init');

/**
 * Synchronize and filter navigation menu objects:
 * 1. Removes the Sponsors page item from primary / header menus.
 * 2. Ensures the Events page item is present in the menu (placed right after About SIBACOM).
 * 3. Correctly flags current active state on the Events link.
 *
 * @param array $items Array of menu item post objects.
 * @param stdClass $args Object containing wp_nav_menu() arguments.
 * @return array Filtered menu items.
 */
function sibacom_filter_nav_menu_items($items, $args = null) {
    if (!is_array($items) || empty($items)) {
        return $items;
    }

    $filtered = array();
    $has_events = false;
    $about_index = -1;

    foreach ($items as $item) {
        $title = isset($item->title) ? strtolower(trim($item->title)) : '';
        $url = isset($item->url) ? strtolower(trim($item->url)) : '';

        // Exclude Sponsors / Partners & Sponsors from the menu
        if ($title === 'sponsors' || 
            strpos($title, 'sponsor') !== false || 
            strpos($url, '/sponsors') !== false || 
            strpos($url, 'sponsors.html') !== false) {
            continue;
        }

        if ($title === 'events' || 
            strpos($title, 'event') !== false || 
            strpos($url, '/events') !== false || 
            strpos($url, 'events.html') !== false ||
            strpos($url, '/competitions') !== false ||
            strpos($url, 'competitions.html') !== false) {
            $has_events = true;
        }

        $filtered[] = $item;

        if ($title === 'about' || strpos($title, 'about') !== false || strpos($url, '/about') !== false) {
            $about_index = count($filtered) - 1;
        }
    }

    // If Events is not yet in the menu, seamlessly inject it right after About
    if (!$has_events) {
        $events_page = function_exists('get_page_by_path') ? get_page_by_path('events') : null;
        $events_id = $events_page ? $events_page->ID : 0;
        $events_url = function_exists('home_url') ? home_url('/events/') : '/events/';

        $events_item = new stdClass();
        $events_item->ID = 999103;
        $events_item->db_id = 999103;
        $events_item->menu_item_parent = '0';
        $events_item->object_id = $events_id;
        $events_item->post_parent = 0;
        $events_item->type = 'custom';
        $events_item->object = 'custom';
        $events_item->type_label = 'Custom Link';
        $events_item->title = esc_html__('Events', 'sibacom');
        $events_item->url = $events_url;
        $events_item->target = '';
        $events_item->attr_title = '';
        $events_item->description = '';
        $events_item->classes = array('menu-item', 'menu-item-type-custom', 'menu-item-object-custom');
        $events_item->xfn = '';
        $events_item->current = function_exists('sibacom_is_nav_active') && sibacom_is_nav_active('events');
        $events_item->current_item_ancestor = false;
        $events_item->current_item_parent = false;

        if ($events_item->current) {
            $events_item->classes[] = 'current-menu-item';
        }

        if ($about_index >= 0) {
            array_splice($filtered, $about_index + 1, 0, array($events_item));
        } else {
            // If About was not found, insert as 2nd or 3rd item
            if (count($filtered) >= 2) {
                array_splice($filtered, 2, 0, array($events_item));
            } else {
                $filtered[] = $events_item;
            }
        }
    }

    return $filtered;
}
add_filter('wp_nav_menu_objects', 'sibacom_filter_nav_menu_items', 10, 2);

/**
 * Register SIBACOM Theme Dashboard in Appearance
 */
function sibacom_theme_admin_menu() {
    add_theme_page(
        esc_html__('SIBACOM Theme Dashboard', 'sibacom'),
        esc_html__('Theme Dashboard', 'sibacom'),
        'manage_options',
        'sibacom-dashboard',
        function() {
            if (class_exists('SIBACOM_Admin_Menu')) {
                SIBACOM_Admin_Menu::render_dashboard_overview();
            } else {
                $logo = function_exists('sibacom_get_logo_url') ? sibacom_get_logo_url() : SIBACOM_THEME_URI . '/assets/images/sibacom_logo.jpg';
                ?>
                <div class="wrap sibacom-admin-wrap" style="max-width:900px; margin-top:20px;">
                    <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 15px;">
                        <div style="background: #03326A; border-radius: 12px; padding: 4px; box-shadow: 0 4px 14px rgba(3, 50, 106, 0.3);">
                            <img src="<?php echo esc_url($logo); ?>" alt="SIBACOM Logo" width="56" height="56" style="height: 56px; width: 56px; border-radius: 8px; object-fit: contain; display: block;" />
                        </div>
                        <div>
                            <h1 style="margin: 0; font-size: 1.8rem; color: #173F91;"><?php esc_html_e('SIBACOM Theme Dashboard', 'sibacom'); ?></h1>
                            <p style="margin: 4px 0 0; color: #64748B;"><?php esc_html_e('Official Event Identity • Power to Progress', 'sibacom'); ?></p>
                        </div>
                    </div>
                    <div style="background:#fff; border:1px solid #ccd0d4; padding:25px; border-radius:8px; margin-top:15px; box-shadow:0 1px 3px rgba(0,0,0,0.05);">
                        <h2 style="color:#173F91; margin-top:0;"><?php esc_html_e('Welcome to SIBACOM 2026', 'sibacom'); ?></h2>
                        <p style="font-size:15px; line-height:1.6;"><?php esc_html_e('The official WordPress theme for Sukkur IBA University Annual Mega Olympiad & Innovation Competitions.', 'sibacom'); ?></p>
                        <div style="background:#EFF6FF; border-left:4px solid #173F91; padding:15px; margin:20px 0; border-radius:4px;">
                            <p style="margin:0; font-size:14px; color:#1E40AF;"><strong><?php esc_html_e('Companion Plugin Required:', 'sibacom'); ?></strong> <?php esc_html_e('Please activate the "SIBACOM Website Manager" plugin to enable the complete event administration dashboard, competition pricing, schedule sessions, and speaker management.', 'sibacom'); ?></p>
                        </div>
                        <p><a href="<?php echo esc_url(admin_url('plugins.php')); ?>" class="button button-primary" style="font-weight:700;"><?php esc_html_e('Manage Plugins &rarr;', 'sibacom'); ?></a></p>
                    </div>
                </div>
                <?php
            }
        }
    );
}
add_action('admin_menu', 'sibacom_theme_admin_menu', 20);

/**
 * Customize WordPress Login & Registration Interface with Official SIBACOM Logo & Branding
 */
function sibacom_custom_login_logo() {
    $logo_url = function_exists('sibacom_get_logo_url') ? sibacom_get_logo_url() : SIBACOM_THEME_URI . '/assets/images/sibacom_logo.jpg';
    ?>
    <style type="text/css">
        body.login {
            background: linear-gradient(135deg, #070B14 0%, #102E68 50%, #03326A 100%) !important;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif !important;
        }
        body.login #login h1 a {
            background-image: url('<?php echo esc_url($logo_url); ?>') !important;
            background-size: contain !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            background-color: #03326A !important;
            width: 110px !important;
            height: 110px !important;
            border-radius: 18px !important;
            box-shadow: 0 12px 36px rgba(3, 50, 106, 0.5), 0 0 0 2px rgba(255,255,255,0.18) !important;
            margin: 0 auto 24px auto !important;
            display: block !important;
        }
        body.login #loginform, body.login #registerform, body.login #lostpasswordform {
            background: rgba(255, 255, 255, 0.98) !important;
            border: 1px solid rgba(255, 255, 255, 0.3) !important;
            border-radius: 16px !important;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.35) !important;
            padding: 30px 26px !important;
        }
        body.login #loginform .button-primary, body.login #registerform .button-primary {
            background: linear-gradient(135deg, #173F91 0%, #03326A 100%) !important;
            border-color: #03326A !important;
            border-radius: 8px !important;
            padding: 8px 20px !important;
            font-weight: 700 !important;
            box-shadow: 0 4px 14px rgba(3, 50, 106, 0.4) !important;
        }
        body.login #backtoblog a, body.login #nav a {
            color: #94A3B8 !important;
            font-weight: 600 !important;
            transition: color 0.2s ease !important;
        }
        body.login #backtoblog a:hover, body.login #nav a:hover {
            color: #38BDF8 !important;
        }
    </style>
    <?php
}
add_action('login_enqueue_scripts', 'sibacom_custom_login_logo');

function sibacom_custom_login_url() {
    return home_url('/');
}
add_filter('login_headerurl', 'sibacom_custom_login_url');

function sibacom_custom_login_title() {
    return 'SIBACOM 2026 – Power to Progress';
}
add_filter('login_headertext', 'sibacom_custom_login_title');

/**
 * Output Favicon Meta Tags on wp_head
 */
function sibacom_output_favicon_meta() {
    if (function_exists('sibacom_the_favicon_meta')) {
        sibacom_the_favicon_meta();
    }
}
add_action('wp_head', 'sibacom_output_favicon_meta', 2);




