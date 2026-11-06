<?php
/**
 * SIBACOM Custom Post Types & Taxonomies
 *
 * @package SIBACOM_Website_Manager
 */

if (!defined('ABSPATH')) {
    exit;
}

class SIBACOM_CPT {

    public static function init() {
        add_action('init', array(__CLASS__, 'register_post_types'));
        add_action('init', array(__CLASS__, 'register_taxonomies'));

        // Custom admin columns for Speakers & Judges
        add_filter('manage_sibacom_speaker_posts_columns', array(__CLASS__, 'speaker_columns'));
        add_action('manage_sibacom_speaker_posts_custom_column', array(__CLASS__, 'speaker_custom_columns'), 10, 2);
        add_filter('manage_edit-sibacom_speaker_sortable_columns', array(__CLASS__, 'speaker_sortable_columns'));
        add_action('restrict_manage_posts', array(__CLASS__, 'speaker_role_filter_dropdown'));
        add_filter('parse_query', array(__CLASS__, 'speaker_filter_query'));
    }

    public static function register_post_types() {
        // 1. Events & Pricing (Module Competitions & Registration CTAs)
        register_post_type('sibacom_event', array(
            'labels' => array(
                'name'               => esc_html__('Event Competitions & Pricing', 'sibacom-manager'),
                'singular_name'      => esc_html__('Event Competition', 'sibacom-manager'),
                'add_new'            => esc_html__('Add New Event', 'sibacom-manager'),
                'add_new_item'       => esc_html__('Add New Event Competition', 'sibacom-manager'),
                'edit_item'          => esc_html__('Edit Event Competition', 'sibacom-manager'),
                'new_item'           => esc_html__('New Event Competition', 'sibacom-manager'),
                'view_item'          => esc_html__('View Event Competition', 'sibacom-manager'),
                'search_items'       => esc_html__('Search Events', 'sibacom-manager'),
                'not_found'          => esc_html__('No event competitions found', 'sibacom-manager'),
                'all_items'          => esc_html__('All Events & Pricing', 'sibacom-manager'),
                'menu_name'          => esc_html__('Events & Pricing', 'sibacom-manager'),
            ),
            'public'        => true,
            'show_ui'       => true,
            'show_in_menu'  => 'sibacom-dashboard',
            'supports'      => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
            'has_archive'   => false,
            'hierarchical'  => false,
            'show_in_rest'  => true,
            'menu_icon'     => 'dashicons-tickets-alt',
        ));

        // 2. Schedule Sessions
        register_post_type('sibacom_session', array(
            'labels' => array(
                'name'               => esc_html__('Schedule Sessions', 'sibacom-manager'),
                'singular_name'      => esc_html__('Session', 'sibacom-manager'),
                'add_new'            => esc_html__('Add New Session', 'sibacom-manager'),
                'add_new_item'       => esc_html__('Add New Session', 'sibacom-manager'),
                'edit_item'          => esc_html__('Edit Session', 'sibacom-manager'),
                'new_item'           => esc_html__('New Session', 'sibacom-manager'),
                'view_item'          => esc_html__('View Session', 'sibacom-manager'),
                'search_items'       => esc_html__('Search Sessions', 'sibacom-manager'),
                'not_found'          => esc_html__('No sessions found', 'sibacom-manager'),
                'all_items'          => esc_html__('All Sessions', 'sibacom-manager'),
                'menu_name'          => esc_html__('Schedule', 'sibacom-manager'),
            ),
            'public'        => true,
            'show_ui'       => true,
            'show_in_menu'  => 'sibacom-dashboard',
            'supports'      => array('title', 'editor', 'thumbnail', 'page-attributes'),
            'has_archive'   => false,
            'hierarchical'  => false,
            'show_in_rest'  => true,
            'menu_icon'     => 'dashicons-clock',
        ));

        // 3. Speakers, Judges & Guests
        register_post_type('sibacom_speaker', array(
            'labels' => array(
                'name'               => esc_html__('Speakers & Judges', 'sibacom-manager'),
                'singular_name'      => esc_html__('Speaker / Judge', 'sibacom-manager'),
                'add_new'            => esc_html__('Add New Profile', 'sibacom-manager'),
                'add_new_item'       => esc_html__('Add New Speaker or Judge', 'sibacom-manager'),
                'edit_item'          => esc_html__('Edit Speaker/Judge Profile', 'sibacom-manager'),
                'new_item'           => esc_html__('New Speaker/Judge', 'sibacom-manager'),
                'view_item'          => esc_html__('View Profile', 'sibacom-manager'),
                'search_items'       => esc_html__('Search Speakers & Judges', 'sibacom-manager'),
                'not_found'          => esc_html__('No speakers or judges found', 'sibacom-manager'),
                'all_items'          => esc_html__('All Speakers & Judges', 'sibacom-manager'),
                'menu_name'          => esc_html__('Speakers & Judges', 'sibacom-manager'),
            ),
            'public'        => true,
            'show_ui'       => true,
            'show_in_menu'  => 'sibacom-dashboard',
            'supports'      => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
            'has_archive'   => false,
            'hierarchical'  => false,
            'show_in_rest'  => true,
            'menu_icon'     => 'dashicons-businessperson',
        ));

        // 4. Sponsors & Partners
        register_post_type('sibacom_sponsor', array(
            'labels' => array(
                'name'               => esc_html__('Sponsors & Partners', 'sibacom-manager'),
                'singular_name'      => esc_html__('Sponsor', 'sibacom-manager'),
                'add_new'            => esc_html__('Add New Sponsor', 'sibacom-manager'),
                'add_new_item'       => esc_html__('Add New Sponsor', 'sibacom-manager'),
                'edit_item'          => esc_html__('Edit Sponsor', 'sibacom-manager'),
                'new_item'           => esc_html__('New Sponsor', 'sibacom-manager'),
                'view_item'          => esc_html__('View Sponsor', 'sibacom-manager'),
                'search_items'       => esc_html__('Search Sponsors', 'sibacom-manager'),
                'not_found'          => esc_html__('No sponsors found', 'sibacom-manager'),
                'all_items'          => esc_html__('All Sponsors', 'sibacom-manager'),
                'menu_name'          => esc_html__('Sponsors', 'sibacom-manager'),
            ),
            'public'        => true,
            'show_ui'       => true,
            'show_in_menu'  => 'sibacom-dashboard',
            'supports'      => array('title', 'thumbnail', 'page-attributes'),
            'has_archive'   => false,
            'hierarchical'  => false,
            'show_in_rest'  => true,
            'menu_icon'     => 'dashicons-awards',
        ));

        // 5. FAQs
        register_post_type('sibacom_faq', array(
            'labels' => array(
                'name'               => esc_html__('FAQs', 'sibacom-manager'),
                'singular_name'      => esc_html__('FAQ', 'sibacom-manager'),
                'add_new'            => esc_html__('Add New FAQ', 'sibacom-manager'),
                'add_new_item'       => esc_html__('Add New FAQ', 'sibacom-manager'),
                'edit_item'          => esc_html__('Edit FAQ', 'sibacom-manager'),
                'new_item'           => esc_html__('New FAQ', 'sibacom-manager'),
                'view_item'          => esc_html__('View FAQ', 'sibacom-manager'),
                'search_items'       => esc_html__('Search FAQs', 'sibacom-manager'),
                'not_found'          => esc_html__('No FAQs found', 'sibacom-manager'),
                'all_items'          => esc_html__('All FAQs', 'sibacom-manager'),
                'menu_name'          => esc_html__('FAQs', 'sibacom-manager'),
            ),
            'public'        => true,
            'show_ui'       => true,
            'show_in_menu'  => 'sibacom-dashboard',
            'supports'      => array('title', 'editor', 'page-attributes'),
            'has_archive'   => false,
            'hierarchical'  => false,
            'show_in_rest'  => true,
            'menu_icon'     => 'dashicons-editor-help',
        ));
    }

    public static function register_taxonomies() {
        // Speaker & Guest Category Taxonomy
        register_taxonomy('sibacom_speaker_category', 'sibacom_speaker', array(
            'labels' => array(
                'name'          => esc_html__('Speaker & Guest Categories', 'sibacom-manager'),
                'singular_name' => esc_html__('Category', 'sibacom-manager'),
                'all_items'     => esc_html__('All Categories', 'sibacom-manager'),
                'edit_item'     => esc_html__('Edit Category', 'sibacom-manager'),
                'add_new_item'  => esc_html__('Add New Category', 'sibacom-manager'),
            ),
            'hierarchical' => true,
            'show_ui'      => true,
            'show_in_rest' => true,
        ));

        // Event Category Taxonomy
        register_taxonomy('sibacom_event_category', 'sibacom_event', array(
            'labels' => array(
                'name'          => esc_html__('Event Categories', 'sibacom-manager'),
                'singular_name' => esc_html__('Event Category', 'sibacom-manager'),
                'all_items'     => esc_html__('All Categories', 'sibacom-manager'),
                'edit_item'     => esc_html__('Edit Category', 'sibacom-manager'),
                'add_new_item'  => esc_html__('Add New Category', 'sibacom-manager'),
            ),
            'hierarchical' => true,
            'show_ui'      => true,
            'show_in_rest' => true,
        ));

        // Sponsor Tiers Taxonomy
        register_taxonomy('sibacom_sponsor_tier', 'sibacom_sponsor', array(
            'labels' => array(
                'name'          => esc_html__('Sponsorship Tiers', 'sibacom-manager'),
                'singular_name' => esc_html__('Tier', 'sibacom-manager'),
                'all_items'     => esc_html__('All Tiers', 'sibacom-manager'),
                'edit_item'     => esc_html__('Edit Tier', 'sibacom-manager'),
                'add_new_item'  => esc_html__('Add New Tier', 'sibacom-manager'),
            ),
            'hierarchical' => true,
            'show_ui'      => true,
            'show_in_rest' => true,
        ));
    }

    /**
     * Define Admin Columns for Speakers & Judges
     */
    public static function speaker_columns($columns) {
        $new_cols = array();
        $new_cols['cb']          = $columns['cb'];
        $new_cols['photo']       = esc_html__('Photo', 'sibacom-manager');
        $new_cols['title']       = esc_html__('Name', 'sibacom-manager');
        $new_cols['role_type']   = esc_html__('Role Type', 'sibacom-manager');
        $new_cols['category']    = esc_html__('Category Tier', 'sibacom-manager');
        $new_cols['designation'] = esc_html__('Designation & Org', 'sibacom-manager');
        $new_cols['topic']       = esc_html__('Keynote / Evaluation Domain', 'sibacom-manager');
        $new_cols['featured']    = esc_html__('Featured', 'sibacom-manager');
        $new_cols['order']       = esc_html__('Order', 'sibacom-manager');
        $new_cols['date']        = $columns['date'];
        return $new_cols;
    }

    /**
     * Render Custom Column Data
     */
    public static function speaker_custom_columns($column, $post_id) {
        switch ($column) {
            case 'photo':
                $photo_url = get_post_meta($post_id, '_sibacom_speaker_photo_url', true);
                if (empty($photo_url) && has_post_thumbnail($post_id)) {
                    $photo_url = get_the_post_thumbnail_url($post_id, 'thumbnail');
                }
                if ($photo_url) {
                    echo '<img src="' . esc_url($photo_url) . '" style="width: 42px; height: 42px; border-radius: 50%; object-fit: cover; border: 1px solid #CBD5E1;">';
                } else {
                    echo '<span class="dashicons dashicons-businessperson" style="font-size: 32px; color: #94A3B8;"></span>';
                }
                break;

            case 'role_type':
                $role = get_post_meta($post_id, '_sibacom_speaker_role_type', true) ?: 'speaker';
                if ($role === 'judge') {
                    echo '<span style="background: #E0E7FF; color: #3730A3; font-weight: 700; font-size: 11px; padding: 3px 8px; border-radius: 9999px;">' . esc_html__('Judge / Jury', 'sibacom-manager') . '</span>';
                } elseif ($role === 'guest') {
                    echo '<span style="background: #FEF3C7; color: #92400E; font-weight: 700; font-size: 11px; padding: 3px 8px; border-radius: 9999px;">' . esc_html__('Chief Guest', 'sibacom-manager') . '</span>';
                } else {
                    echo '<span style="background: #DCFCE7; color: #166534; font-weight: 700; font-size: 11px; padding: 3px 8px; border-radius: 9999px;">' . esc_html__('Speaker', 'sibacom-manager') . '</span>';
                }
                break;

            case 'category':
                $category = get_post_meta($post_id, '_sibacom_speaker_category', true);
                echo esc_html($category ?: '—');
                break;

            case 'designation':
                $desig = get_post_meta($post_id, '_sibacom_speaker_designation', true);
                $org   = get_post_meta($post_id, '_sibacom_speaker_org', true);
                echo '<strong>' . esc_html($desig ?: '—') . '</strong>';
                if ($org) {
                    echo '<br><span style="color: #64748B; font-size: 12px;">' . esc_html($org) . '</span>';
                }
                break;

            case 'topic':
                $topic = get_post_meta($post_id, '_sibacom_speaker_topic', true);
                echo esc_html($topic ? wp_trim_words($topic, 8) : '—');
                break;

            case 'featured':
                $featured = get_post_meta($post_id, '_sibacom_speaker_featured', true);
                echo ($featured === 'yes') ? '<span style="color: #079B58; font-weight: bold;">✔ Yes</span>' : '<span style="color: #94A3B8;">No</span>';
                break;

            case 'order':
                $order = get_post_meta($post_id, '_sibacom_speaker_order', true);
                echo intval($order ?: 1);
                break;
        }
    }

    /**
     * Make columns sortable
     */
    public static function speaker_sortable_columns($columns) {
        $columns['order']     = 'order';
        $columns['role_type'] = 'role_type';
        return $columns;
    }

    /**
     * Dropdown filter for Speaker / Judge / Guest roles in WP admin
     */
    public static function speaker_role_filter_dropdown($post_type) {
        if ($post_type !== 'sibacom_speaker') return;

        $current = isset($_GET['speaker_role_filter']) ? sanitize_text_field($_GET['speaker_role_filter']) : '';
        ?>
        <select name="speaker_role_filter">
            <option value=""><?php esc_html_e('All Roles (Speakers, Judges, Guests)', 'sibacom-manager'); ?></option>
            <option value="speaker" <?php selected($current, 'speaker'); ?>><?php esc_html_e('Speakers Only', 'sibacom-manager'); ?></option>
            <option value="judge" <?php selected($current, 'judge'); ?>><?php esc_html_e('Judges & Jury Only', 'sibacom-manager'); ?></option>
            <option value="guest" <?php selected($current, 'guest'); ?>><?php esc_html_e('Chief Guests Only', 'sibacom-manager'); ?></option>
        </select>
        <?php
    }

    /**
     * Filter WP Admin Query when role filter is active
     */
    public static function speaker_filter_query($query) {
        global $pagenow;
        if (is_admin() && $pagenow === 'edit.php' && isset($_GET['post_type']) && $_GET['post_type'] === 'sibacom_speaker') {
            if (!empty($_GET['speaker_role_filter'])) {
                $query->query_vars['meta_key']   = '_sibacom_speaker_role_type';
                $query->query_vars['meta_value'] = sanitize_text_field($_GET['speaker_role_filter']);
            }
        }
    }
}

SIBACOM_CPT::init();
