<?php
/**
 * SIBACOM Meta Boxes for Custom Post Types
 *
 * @package SIBACOM_Website_Manager
 */

if (!defined('ABSPATH')) {
    exit;
}

class SIBACOM_Meta_Boxes {

    public static function init() {
        add_action('add_meta_boxes', array(__CLASS__, 'register_meta_boxes'));
        add_action('save_post', array(__CLASS__, 'save_meta_boxes'));
    }

    public static function register_meta_boxes() {
        // Event Meta Box (Event Registration & Pricing)
        add_meta_box(
            'sibacom_event_details',
            esc_html__('Event Competition, Pricing & Registration Controls', 'sibacom-manager'),
            array(__CLASS__, 'render_event_box'),
            'sibacom_event',
            'normal',
            'high'
        );

        // Session Meta Box
        add_meta_box(
            'sibacom_session_details',
            esc_html__('Session Scheduling Details', 'sibacom-manager'),
            array(__CLASS__, 'render_session_box'),
            'sibacom_session',
            'normal',
            'high'
        );

        // Speaker & Guest Meta Box
        add_meta_box(
            'sibacom_speaker_details',
            esc_html__('Speaker & Guest Profile Configuration', 'sibacom-manager'),
            array(__CLASS__, 'render_speaker_box'),
            'sibacom_speaker',
            'normal',
            'high'
        );

        // Sponsor Meta Box
        add_meta_box(
            'sibacom_sponsor_details',
            esc_html__('Sponsor Configuration', 'sibacom-manager'),
            array(__CLASS__, 'render_sponsor_box'),
            'sibacom_sponsor',
            'normal',
            'high'
        );

        // FAQ Meta Box
        add_meta_box(
            'sibacom_faq_details',
            esc_html__('FAQ Category & Sorting', 'sibacom-manager'),
            array(__CLASS__, 'render_faq_box'),
            'sibacom_faq',
            'side',
            'default'
        );
    }

    /**
     * Render Event Competition & Pricing Meta Box
     */
    public static function render_event_box($post) {
        wp_nonce_field('sibacom_save_event_meta', 'sibacom_event_nonce');

        $date         = get_post_meta($post->ID, '_sibacom_event_date', true) ?: 'November 30, 2026';
        $start_time   = get_post_meta($post->ID, '_sibacom_event_start_time', true) ?: '09:00 AM';
        $end_time     = get_post_meta($post->ID, '_sibacom_event_end_time', true) ?: '05:00 PM';
        $venue        = get_post_meta($post->ID, '_sibacom_event_venue', true) ?: 'Academic Block-III, Sukkur IBA';
        $fee_type     = get_post_meta($post->ID, '_sibacom_event_fee_type', true) ?: 'paid';
        $fee_amount   = get_post_meta($post->ID, '_sibacom_event_fee_amount', true) ?: 'PKR 1,000';
        $reg_open     = get_post_meta($post->ID, '_sibacom_event_reg_open', true) ?: '2026-10-01';
        $reg_close    = get_post_meta($post->ID, '_sibacom_event_reg_close', true) ?: '2026-11-25';
        $status_mode  = get_post_meta($post->ID, '_sibacom_event_status_mode', true) ?: 'manual';
        $status       = get_post_meta($post->ID, '_sibacom_event_status', true) ?: 'open';
        $reg_url      = get_post_meta($post->ID, '_sibacom_event_reg_url', true);
        $btn_text     = get_post_meta($post->ID, '_sibacom_event_btn_text', true);
        $featured     = get_post_meta($post->ID, '_sibacom_event_featured', true) ?: 'yes';
        $visibility   = get_post_meta($post->ID, '_sibacom_event_visibility', true) ?: 'visible';
        $order        = get_post_meta($post->ID, '_sibacom_event_order', true) ?: '1';
        $banner_url   = get_post_meta($post->ID, '_sibacom_event_banner_url', true);
        ?>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; padding: 0.75rem 0;">
            <p>
                <label><strong><?php esc_html_e('Event / Competition Date:', 'sibacom-manager'); ?></strong></label><br>
                <input type="text" name="sibacom_event_date" value="<?php echo esc_attr($date); ?>" style="width: 100%;" placeholder="e.g. November 30, 2026">
            </p>
            <p>
                <label><strong><?php esc_html_e('Start Time & End Time:', 'sibacom-manager'); ?></strong></label><br>
                <div style="display: flex; gap: 0.5rem;">
                    <input type="text" name="sibacom_event_start_time" value="<?php echo esc_attr($start_time); ?>" style="width: 50%;" placeholder="09:00 AM">
                    <input type="text" name="sibacom_event_end_time" value="<?php echo esc_attr($end_time); ?>" style="width: 50%;" placeholder="05:00 PM">
                </div>
            </p>
            <p>
                <label><strong><?php esc_html_e('Venue / Laboratory / Hall:', 'sibacom-manager'); ?></strong></label><br>
                <input type="text" name="sibacom_event_venue" value="<?php echo esc_attr($venue); ?>" style="width: 100%;" placeholder="e.g. CSE Lab 2, Academic Block-III">
            </p>
            <p>
                <label><strong><?php esc_html_e('Pricing Category:', 'sibacom-manager'); ?></strong></label><br>
                <select name="sibacom_event_fee_type" style="width: 100%;">
                    <option value="free" <?php selected($fee_type, 'free'); ?>><?php esc_html_e('Free Registration', 'sibacom-manager'); ?></option>
                    <option value="paid" <?php selected($fee_type, 'paid'); ?>><?php esc_html_e('Standard Individual (PKR)', 'sibacom-manager'); ?></option>
                    <option value="team" <?php selected($fee_type, 'team'); ?>><?php esc_html_e('Team Registration', 'sibacom-manager'); ?></option>
                    <option value="special" <?php selected($fee_type, 'special'); ?>><?php esc_html_e('Special Category', 'sibacom-manager'); ?></option>
                </select>
            </p>
            <p>
                <label><strong><?php esc_html_e('Displayed Fee / Price Label:', 'sibacom-manager'); ?></strong></label><br>
                <input type="text" name="sibacom_event_fee_amount" value="<?php echo esc_attr($fee_amount); ?>" style="width: 100%;" placeholder="e.g. Free Registration, PKR 500, PKR 1,000, PKR 2,500/Team">
            </p>
            <p>
                <label><strong><?php esc_html_e('Registration Opening Date:', 'sibacom-manager'); ?></strong></label><br>
                <input type="text" name="sibacom_event_reg_open" value="<?php echo esc_attr($reg_open); ?>" style="width: 100%;" placeholder="e.g. October 15, 2026 or 2026-10-15">
            </p>
            <p>
                <label><strong><?php esc_html_e('Registration Closing Date:', 'sibacom-manager'); ?></strong></label><br>
                <input type="text" name="sibacom_event_reg_close" value="<?php echo esc_attr($reg_close); ?>" style="width: 100%;" placeholder="e.g. November 25, 2026 or 2026-11-25">
            </p>
            <p>
                <label><strong><?php esc_html_e('Status Calculation Mode:', 'sibacom-manager'); ?></strong></label><br>
                <select name="sibacom_event_status_mode" style="width: 100%;">
                    <option value="manual" <?php selected($status_mode, 'manual'); ?>><?php esc_html_e('Manual Override (Selected Below)', 'sibacom-manager'); ?></option>
                    <option value="auto" <?php selected($status_mode, 'auto'); ?>><?php esc_html_e('Automatic Date-Based Calculation', 'sibacom-manager'); ?></option>
                </select>
            </p>
            <p>
                <label><strong><?php esc_html_e('Registration Status (If Manual):', 'sibacom-manager'); ?></strong></label><br>
                <select name="sibacom_event_status" style="width: 100%;">
                    <option value="open" <?php selected($status, 'open'); ?>><?php esc_html_e('Registration Open', 'sibacom-manager'); ?></option>
                    <option value="not_open" <?php selected($status, 'not_open'); ?>><?php esc_html_e('Coming Soon', 'sibacom-manager'); ?></option>
                    <option value="closing_soon" <?php selected($status, 'closing_soon'); ?>><?php esc_html_e('Closing Soon', 'sibacom-manager'); ?></option>
                    <option value="closed" <?php selected($status, 'closed'); ?>><?php esc_html_e('Registration Closed', 'sibacom-manager'); ?></option>
                    <option value="full" <?php selected($status, 'full'); ?>><?php esc_html_e('Fully Booked', 'sibacom-manager'); ?></option>
                </select>
            </p>
            <p>
                <label><strong><?php esc_html_e('Custom External Registration URL (Leave blank to use global URL):', 'sibacom-manager'); ?></strong></label><br>
                <input type="url" name="sibacom_event_reg_url" value="<?php echo esc_attr($reg_url); ?>" style="width: 100%;" placeholder="https://forms.gle/... or external portal link">
            </p>
            <p>
                <label><strong><?php esc_html_e('Custom Button Text (Optional):', 'sibacom-manager'); ?></strong></label><br>
                <input type="text" name="sibacom_event_btn_text" value="<?php echo esc_attr($btn_text); ?>" style="width: 100%;" placeholder="Default: Register Now (or Coming Soon / Closed)">
            </p>
            <p>
                <label><strong><?php esc_html_e('Feature on Homepage Section:', 'sibacom-manager'); ?></strong></label><br>
                <select name="sibacom_event_featured" style="width: 100%;">
                    <option value="yes" <?php selected($featured, 'yes'); ?>><?php esc_html_e('Yes – Feature on Homepage', 'sibacom-manager'); ?></option>
                    <option value="no" <?php selected($featured, 'no'); ?>><?php esc_html_e('No – Only on All Events Page', 'sibacom-manager'); ?></option>
                </select>
            </p>
            <p>
                <label><strong><?php esc_html_e('Visibility Control:', 'sibacom-manager'); ?></strong></label><br>
                <select name="sibacom_event_visibility" style="width: 100%;">
                    <option value="visible" <?php selected($visibility, 'visible'); ?>><?php esc_html_e('Visible (Public & Homepage)', 'sibacom-manager'); ?></option>
                    <option value="hidden" <?php selected($visibility, 'hidden'); ?>><?php esc_html_e('Hidden (Do not display on frontend)', 'sibacom-manager'); ?></option>
                </select>
            </p>
            <p>
                <label><strong><?php esc_html_e('Display Sorting Order (1 to 7):', 'sibacom-manager'); ?></strong></label><br>
                <input type="number" name="sibacom_event_order" value="<?php echo esc_attr($order); ?>" style="width: 100%;" min="1" max="50">
            </p>
            <div style="grid-column: span 2;">
                <label><strong><?php esc_html_e('Event Banner / Image URL (or use Featured Image):', 'sibacom-manager'); ?></strong></label><br>
                <div style="display: flex; gap: 0.5rem;">
                    <input type="text" id="sibacom_event_banner_url" name="sibacom_event_banner_url" value="<?php echo esc_attr($banner_url); ?>" style="flex: 1;" placeholder="https://...">
                    <button type="button" class="button sibacom-media-upload-btn" data-target="#sibacom_event_banner_url"><?php esc_html_e('Select Media', 'sibacom-manager'); ?></button>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Compute Event Status helper
     */
    public static function get_event_status_info($post_id) {
        $mode       = get_post_meta($post_id, '_sibacom_event_status_mode', true) ?: 'manual';
        $status_val = get_post_meta($post_id, '_sibacom_event_status', true) ?: 'open';
        $open_date  = get_post_meta($post_id, '_sibacom_event_reg_open', true);
        $close_date = get_post_meta($post_id, '_sibacom_event_reg_close', true);
        $btn_custom = get_post_meta($post_id, '_sibacom_event_btn_text', true);
        $url_custom = get_post_meta($post_id, '_sibacom_event_reg_url', true);
        $global_url = get_option('sibacom_header_cta_url', '#contact');
        $dest_url   = !empty($url_custom) ? $url_custom : $global_url;

        if ($mode === 'auto' && !empty($open_date) && !empty($close_date)) {
            $now = time();
            $t_open  = strtotime($open_date);
            $t_close = strtotime($close_date);

            if ($t_open && $now < $t_open) {
                $status_val = 'not_open';
            } elseif ($t_close && $now > $t_close) {
                $status_val = 'closed';
            } elseif ($t_close && ($t_close - $now) <= (3 * DAY_IN_SECONDS)) {
                $status_val = 'closing_soon';
            } else {
                $status_val = 'open';
            }
        }

        switch ($status_val) {
            case 'open':
                $label     = esc_html__('Registration Open', 'sibacom-manager');
                $css_class = 'status-open';
                $btn_text  = !empty($btn_custom) ? $btn_custom : esc_html__('Register Now', 'sibacom-manager');
                $is_active = true;
                break;
            case 'closing_soon':
                $label     = esc_html__('Closing Soon', 'sibacom-manager');
                $css_class = 'status-closing';
                $btn_text  = !empty($btn_custom) ? $btn_custom : esc_html__('Register Now', 'sibacom-manager');
                $is_active = true;
                break;
            case 'not_open':
                $label     = esc_html__('Coming Soon', 'sibacom-manager');
                $css_class = 'status-upcoming';
                $btn_text  = !empty($btn_custom) ? $btn_custom : esc_html__('Coming Soon', 'sibacom-manager');
                $is_active = false;
                break;
            case 'full':
                $label     = esc_html__('Fully Booked', 'sibacom-manager');
                $css_class = 'status-full';
                $btn_text  = !empty($btn_custom) ? $btn_custom : esc_html__('Fully Booked', 'sibacom-manager');
                $is_active = false;
                break;
            case 'closed':
            default:
                $label     = esc_html__('Registration Closed', 'sibacom-manager');
                $css_class = 'status-closed';
                $btn_text  = !empty($btn_custom) ? $btn_custom : esc_html__('Registration Closed', 'sibacom-manager');
                $is_active = false;
                break;
        }

        return array(
            'key'       => $status_val,
            'label'     => $label,
            'class'     => $css_class,
            'btn_text'  => $btn_text,
            'url'       => $dest_url,
            'is_active' => $is_active,
            'status'    => $status_val,
        );
    }

    /**
     * Render Session Meta Box
     */
    public static function render_session_box($post) {
        wp_nonce_field('sibacom_save_session_meta', 'sibacom_session_nonce');

        $day       = get_post_meta($post->ID, '_sibacom_session_day', true) ?: '1';
        $start     = get_post_meta($post->ID, '_sibacom_session_start', true) ?: '10:00 AM';
        $end       = get_post_meta($post->ID, '_sibacom_session_end', true) ?: '11:30 AM';
        $duration  = get_post_meta($post->ID, '_sibacom_session_duration', true) ?: '90 mins';
        $speaker   = get_post_meta($post->ID, '_sibacom_session_speaker', true);
        $spk_photo = get_post_meta($post->ID, '_sibacom_session_speaker_photo', true);
        $venue     = get_post_meta($post->ID, '_sibacom_session_venue', true) ?: 'Nisar Ahmed Siddiqui Auditorium';
        $category  = get_post_meta($post->ID, '_sibacom_session_category', true) ?: 'keynote';
        $icon      = get_post_meta($post->ID, '_sibacom_session_icon', true) ?: 'fa-solid fa-microphone';
        $featured  = get_post_meta($post->ID, '_sibacom_session_featured', true) ?: 'no';
        $visible   = get_post_meta($post->ID, '_sibacom_session_visibility', true) ?: 'visible';
        $order     = get_post_meta($post->ID, '_sibacom_session_order', true) ?: '1';
        ?>
        <div class="sibacom-metabox-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; padding: 0.5rem 0;">
            <p>
                <label><strong><?php esc_html_e('Event Day:', 'sibacom-manager'); ?></strong></label><br>
                <select name="sibacom_session_day" style="width: 100%;">
                    <option value="1" <?php selected($day, '1'); ?>><?php esc_html_e('Day 1 (Full-Day Event)', 'sibacom-manager'); ?></option>
                    <option value="2" <?php selected($day, '2'); ?>><?php esc_html_e('Day 2 (Optional)', 'sibacom-manager'); ?></option>
                    <option value="3" <?php selected($day, '3'); ?>><?php esc_html_e('Day 3 (Optional)', 'sibacom-manager'); ?></option>
                </select>
            </p>
            <p>
                <label><strong><?php esc_html_e('Session Category Track:', 'sibacom-manager'); ?></strong></label><br>
                <select name="sibacom_session_category" style="width: 100%;">
                    <option value="keynote" <?php selected($category, 'keynote'); ?>><?php esc_html_e('Keynote Address', 'sibacom-manager'); ?></option>
                    <option value="competition" <?php selected($category, 'competition'); ?>><?php esc_html_e('Competition Sprint / Track', 'sibacom-manager'); ?></option>
                    <option value="workshop" <?php selected($category, 'workshop'); ?>><?php esc_html_e('Technical Workshop & Hands-on', 'sibacom-manager'); ?></option>
                    <option value="panel" <?php selected($category, 'panel'); ?>><?php esc_html_e('Panel Discussion / Fireside Chat', 'sibacom-manager'); ?></option>
                    <option value="ceremony" <?php selected($category, 'ceremony'); ?>><?php esc_html_e('Ceremony, Inaugural & Gala', 'sibacom-manager'); ?></option>
                    <option value="networking" <?php selected($category, 'networking'); ?>><?php esc_html_e('Networking Session & Meetup', 'sibacom-manager'); ?></option>
                    <option value="break" <?php selected($category, 'break'); ?>><?php esc_html_e('Luncheon / Refreshment Intermission', 'sibacom-manager'); ?></option>
                </select>
            </p>
            <p>
                <label><strong><?php esc_html_e('Start Time & End Time:', 'sibacom-manager'); ?></strong></label><br>
                <div style="display: flex; gap: 0.5rem;">
                    <input type="text" name="sibacom_session_start" value="<?php echo esc_attr($start); ?>" style="width: 50%;" placeholder="10:00 AM">
                    <input type="text" name="sibacom_session_end" value="<?php echo esc_attr($end); ?>" style="width: 50%;" placeholder="11:30 AM">
                </div>
            </p>
            <p>
                <label><strong><?php esc_html_e('Session Duration:', 'sibacom-manager'); ?></strong></label><br>
                <input type="text" name="sibacom_session_duration" value="<?php echo esc_attr($duration); ?>" style="width: 100%;" placeholder="e.g. 90 mins, 2 hours, 24 Hours">
            </p>
            <p>
                <label><strong><?php esc_html_e('Speaker / Presenter / Chair:', 'sibacom-manager'); ?></strong></label><br>
                <input type="text" name="sibacom_session_speaker" value="<?php echo esc_attr($speaker); ?>" style="width: 100%;" placeholder="e.g. Engr. Dr. Zahid Hussain">
            </p>
            <p>
                <label><strong><?php esc_html_e('Speaker Photograph / Avatar URL:', 'sibacom-manager'); ?></strong></label><br>
                <div style="display: flex; gap: 0.5rem;">
                    <input type="text" id="sibacom_session_speaker_photo" name="sibacom_session_speaker_photo" value="<?php echo esc_attr($spk_photo); ?>" style="flex: 1;" placeholder="https://...">
                    <button type="button" class="button sibacom-media-upload-btn" data-target="#sibacom_session_speaker_photo"><?php esc_html_e('Select Photo', 'sibacom-manager'); ?></button>
                </div>
            </p>
            <p>
                <label><strong><?php esc_html_e('Venue / Hall / Lab:', 'sibacom-manager'); ?></strong></label><br>
                <input type="text" name="sibacom_session_venue" value="<?php echo esc_attr($venue); ?>" style="width: 100%;" placeholder="e.g. Nisar Ahmed Siddiqui Auditorium">
            </p>
            <p>
                <label><strong><?php esc_html_e('Session Icon (FontAwesome):', 'sibacom-manager'); ?></strong></label><br>
                <input type="text" name="sibacom_session_icon" value="<?php echo esc_attr($icon); ?>" style="width: 100%;" placeholder="e.g. fa-solid fa-microphone, fa-code, fa-trophy">
            </p>
            <p>
                <label><strong><?php esc_html_e('Featured / Highlighted Status:', 'sibacom-manager'); ?></strong></label><br>
                <select name="sibacom_session_featured" style="width: 100%;">
                    <option value="no" <?php selected($featured, 'no'); ?>><?php esc_html_e('Standard Session Card', 'sibacom-manager'); ?></option>
                    <option value="yes" <?php selected($featured, 'yes'); ?>><?php esc_html_e('⭐ Highlighted / Featured Session', 'sibacom-manager'); ?></option>
                </select>
            </p>
            <p>
                <label><strong><?php esc_html_e('Schedule Visibility:', 'sibacom-manager'); ?></strong></label><br>
                <select name="sibacom_session_visibility" style="width: 100%;">
                    <option value="visible" <?php selected($visible, 'visible'); ?>><?php esc_html_e('Visible on Public Schedule', 'sibacom-manager'); ?></option>
                    <option value="hidden" <?php selected($visible, 'hidden'); ?>><?php esc_html_e('Hidden / Draft', 'sibacom-manager'); ?></option>
                </select>
            </p>
            <p style="grid-column: span 2;">
                <label><strong><?php esc_html_e('Display Order (Sorting):', 'sibacom-manager'); ?></strong></label><br>
                <input type="number" name="sibacom_session_order" value="<?php echo esc_attr($order); ?>" style="width: 120px;" min="1" max="100">
            </p>
        </div>
        <?php
    }

    /**
     * Render Speaker & Guest Meta Box
     */
    public static function render_speaker_box($post) {
        wp_nonce_field('sibacom_save_speaker_meta', 'sibacom_speaker_nonce');

        $role_type    = get_post_meta($post->ID, '_sibacom_speaker_role_type', true) ?: 'speaker';
        $designation  = get_post_meta($post->ID, '_sibacom_speaker_designation', true);
        $organization = get_post_meta($post->ID, '_sibacom_speaker_org', true);
        $category     = get_post_meta($post->ID, '_sibacom_speaker_category', true) ?: 'Keynote Speaker';
        $topic        = get_post_meta($post->ID, '_sibacom_speaker_topic', true);
        $bio          = get_post_meta($post->ID, '_sibacom_speaker_bio', true);
        $linkedin     = get_post_meta($post->ID, '_sibacom_speaker_linkedin', true);
        $twitter      = get_post_meta($post->ID, '_sibacom_speaker_twitter', true);
        $github       = get_post_meta($post->ID, '_sibacom_speaker_github', true);
        $featured     = get_post_meta($post->ID, '_sibacom_speaker_featured', true) ?: 'yes';
        $order        = get_post_meta($post->ID, '_sibacom_speaker_order', true) ?: '1';
        $photo_url    = get_post_meta($post->ID, '_sibacom_speaker_photo_url', true);
        ?>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; padding: 0.5rem 0;">
            <p>
                <label><strong><?php esc_html_e('Role Classification:', 'sibacom-manager'); ?></strong></label><br>
                <select name="sibacom_speaker_role_type" style="width: 100%;">
                    <option value="speaker" <?php selected($role_type, 'speaker'); ?>><?php esc_html_e('Keynote / Guest Speaker', 'sibacom-manager'); ?></option>
                    <option value="judge" <?php selected($role_type, 'judge'); ?>><?php esc_html_e('Competition Judge / Industry Jury', 'sibacom-manager'); ?></option>
                    <option value="guest" <?php selected($role_type, 'guest'); ?>><?php esc_html_e('Chief Guest / Dignitary / Special Guest', 'sibacom-manager'); ?></option>
                    <option value="trainer" <?php selected($role_type, 'trainer'); ?>><?php esc_html_e('Technical Trainer / Workshop Lead', 'sibacom-manager'); ?></option>
                </select>
                <span class="description" style="font-size: 11px; color: #64748B;"><?php esc_html_e('Choose Speaker or Judge to appear in the Distinguished Speakers & Industry Jury section.', 'sibacom-manager'); ?></span>
            </p>
            <p>
                <label><strong><?php esc_html_e('Display Category Tier:', 'sibacom-manager'); ?></strong></label><br>
                <select name="sibacom_speaker_category" style="width: 100%;">
                    <option value="Keynote Speakers" <?php selected($category, 'Keynote Speakers'); ?>><?php esc_html_e('Keynote Speakers', 'sibacom-manager'); ?></option>
                    <option value="Competition Judges" <?php selected($category, 'Competition Judges'); ?>><?php esc_html_e('Competition Judges', 'sibacom-manager'); ?></option>
                    <option value="Industry Jury" <?php selected($category, 'Industry Jury'); ?>><?php esc_html_e('Industry Jury', 'sibacom-manager'); ?></option>
                    <option value="Guest Speakers" <?php selected($category, 'Guest Speakers'); ?>><?php esc_html_e('Guest Speakers', 'sibacom-manager'); ?></option>
                    <option value="Chief Guests" <?php selected($category, 'Chief Guests'); ?>><?php esc_html_e('Chief Guests', 'sibacom-manager'); ?></option>
                    <option value="Special Guests" <?php selected($category, 'Special Guests'); ?>><?php esc_html_e('Special Guests', 'sibacom-manager'); ?></option>
                    <option value="Trainers" <?php selected($category, 'Trainers'); ?>><?php esc_html_e('Trainers', 'sibacom-manager'); ?></option>
                    <option value="Organizing Team" <?php selected($category, 'Organizing Team'); ?>><?php esc_html_e('Organizing Team', 'sibacom-manager'); ?></option>
                </select>
                <span class="description" style="font-size: 11px; color: #64748B;"><?php esc_html_e('Badge shown on the card (e.g. Competition Judges, Keynote Speakers).', 'sibacom-manager'); ?></span>
            </p>
            <p>
                <label><strong><?php esc_html_e('Designation / Academic Role:', 'sibacom-manager'); ?></strong></label><br>
                <input type="text" name="sibacom_speaker_designation" value="<?php echo esc_attr($designation); ?>" style="width: 100%;" placeholder="e.g. Associate Professor & Lead AI Jury">
            </p>
            <p>
                <label><strong><?php esc_html_e('Institution / Company / University:', 'sibacom-manager'); ?></strong></label><br>
                <input type="text" name="sibacom_speaker_org" value="<?php echo esc_attr($organization); ?>" style="width: 100%;" placeholder="e.g. Sukkur IBA University">
            </p>
            <p style="grid-column: span 2;">
                <label><strong><?php esc_html_e('Keynote Presentation Topic / Jury Evaluation Track:', 'sibacom-manager'); ?></strong></label><br>
                <input type="text" name="sibacom_speaker_topic" value="<?php echo esc_attr($topic); ?>" style="width: 100%;" placeholder="e.g. Algorithmic Resilience & Autonomous Robotics OR Sovereign AI Architectures">
            </p>
            <p style="grid-column: span 2;">
                <label><strong><?php esc_html_e('Short Biography / Profile Summary:', 'sibacom-manager'); ?></strong></label><br>
                <textarea name="sibacom_speaker_bio" rows="3" style="width: 100%;" placeholder="Eminent educationist and researcher driving nationwide academic excellence..."><?php echo esc_textarea($bio); ?></textarea>
            </p>
            <p>
                <label><strong><?php esc_html_e('LinkedIn Profile URL:', 'sibacom-manager'); ?></strong></label><br>
                <input type="url" name="sibacom_speaker_linkedin" value="<?php echo esc_attr($linkedin); ?>" style="width: 100%;" placeholder="https://linkedin.com/in/username">
            </p>
            <p>
                <label><strong><?php esc_html_e('Twitter / X Profile URL:', 'sibacom-manager'); ?></strong></label><br>
                <input type="url" name="sibacom_speaker_twitter" value="<?php echo esc_attr($twitter); ?>" style="width: 100%;" placeholder="https://x.com/username">
            </p>
            <p>
                <label><strong><?php esc_html_e('GitHub / Portfolio URL:', 'sibacom-manager'); ?></strong></label><br>
                <input type="url" name="sibacom_speaker_github" value="<?php echo esc_attr($github); ?>" style="width: 100%;" placeholder="https://github.com/username">
            </p>
            <p>
                <label><strong><?php esc_html_e('Feature on Homepage Grid:', 'sibacom-manager'); ?></strong></label><br>
                <select name="sibacom_speaker_featured" style="width: 100%;">
                    <option value="yes" <?php selected($featured, 'yes'); ?>><?php esc_html_e('Yes – Feature on Homepage', 'sibacom-manager'); ?></option>
                    <option value="no" <?php selected($featured, 'no'); ?>><?php esc_html_e('No – Only on Directory Page', 'sibacom-manager'); ?></option>
                </select>
            </p>
            <p>
                <label><strong><?php esc_html_e('Display Sorting Order:', 'sibacom-manager'); ?></strong></label><br>
                <input type="number" name="sibacom_speaker_order" value="<?php echo esc_attr($order); ?>" style="width: 100%;" min="1">
            </p>
            <div style="grid-column: span 2;">
                <label><strong><?php esc_html_e('Profile Photograph URL (or use Featured Image):', 'sibacom-manager'); ?></strong></label><br>
                <div style="display: flex; gap: 0.5rem;">
                    <input type="text" id="sibacom_speaker_photo_url" name="sibacom_speaker_photo_url" value="<?php echo esc_attr($photo_url); ?>" style="flex: 1;" placeholder="https://...">
                    <button type="button" class="button sibacom-media-upload-btn" data-target="#sibacom_speaker_photo_url"><?php esc_html_e('Select Media', 'sibacom-manager'); ?></button>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Render Sponsor Meta Box
     */
    public static function render_sponsor_box($post) {
        wp_nonce_field('sibacom_save_sponsor_meta', 'sibacom_sponsor_nonce');

        $url   = get_post_meta($post->ID, '_sibacom_sponsor_url', true);
        $tier  = get_post_meta($post->ID, '_sibacom_sponsor_tier', true) ?: 'Platinum Partner';
        $order = get_post_meta($post->ID, '_sibacom_sponsor_order', true) ?: '1';
        $logo  = get_post_meta($post->ID, '_sibacom_sponsor_logo', true);
        ?>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; padding: 0.5rem 0;">
            <p>
                <label><strong><?php esc_html_e('Website Destination URL:', 'sibacom-manager'); ?></strong></label><br>
                <input type="url" name="sibacom_sponsor_url" value="<?php echo esc_attr($url); ?>" style="width: 100%;" placeholder="https://company.com">
            </p>
            <p>
                <label><strong><?php esc_html_e('Sponsorship Tier:', 'sibacom-manager'); ?></strong></label><br>
                <select name="sibacom_sponsor_tier" style="width: 100%;">
                    <option value="Main Sponsors" <?php selected($tier, 'Main Sponsors'); ?>><?php esc_html_e('Main Sponsors', 'sibacom-manager'); ?></option>
                    <option value="Title Sponsor" <?php selected($tier, 'Title Sponsor'); ?>><?php esc_html_e('Title Sponsor', 'sibacom-manager'); ?></option>
                    <option value="Gold Sponsors" <?php selected($tier, 'Gold Sponsors'); ?>><?php esc_html_e('Gold Sponsors', 'sibacom-manager'); ?></option>
                    <option value="Silver Sponsors" <?php selected($tier, 'Silver Sponsors'); ?>><?php esc_html_e('Silver Sponsors', 'sibacom-manager'); ?></option>
                    <option value="Supporting Partners" <?php selected($tier, 'Supporting Partners'); ?>><?php esc_html_e('Supporting Partners', 'sibacom-manager'); ?></option>
                    <option value="Technology Partners" <?php selected($tier, 'Technology Partners'); ?>><?php esc_html_e('Technology Partners', 'sibacom-manager'); ?></option>
                    <option value="Community Partners" <?php selected($tier, 'Community Partners'); ?>><?php esc_html_e('Community Partners', 'sibacom-manager'); ?></option>
                </select>
            </p>
            <p>
                <label><strong><?php esc_html_e('Display Order:', 'sibacom-manager'); ?></strong></label><br>
                <input type="number" name="sibacom_sponsor_order" value="<?php echo esc_attr($order); ?>" style="width: 100%;" min="1">
            </p>
            <div style="grid-column: span 2;">
                <label><strong><?php esc_html_e('Sponsor Logo URL (or use Featured Image):', 'sibacom-manager'); ?></strong></label><br>
                <div style="display: flex; gap: 0.5rem;">
                    <input type="text" id="sibacom_sponsor_logo" name="sibacom_sponsor_logo" value="<?php echo esc_attr($logo); ?>" style="flex: 1;" placeholder="https://...">
                    <button type="button" class="button sibacom-media-upload-btn" data-target="#sibacom_sponsor_logo"><?php esc_html_e('Select Logo', 'sibacom-manager'); ?></button>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Render FAQ Meta Box
     */
    public static function render_faq_box($post) {
        wp_nonce_field('sibacom_save_faq_meta', 'sibacom_faq_nonce');

        $category = get_post_meta($post->ID, '_sibacom_faq_category', true) ?: 'General';
        $order    = get_post_meta($post->ID, '_sibacom_faq_order', true) ?: '1';
        ?>
        <p>
            <label><strong><?php esc_html_e('Category:', 'sibacom-manager'); ?></strong></label><br>
            <select name="sibacom_faq_category" style="width: 100%;">
                <option value="General" <?php selected($category, 'General'); ?>><?php esc_html_e('General', 'sibacom-manager'); ?></option>
                <option value="Eligibility" <?php selected($category, 'Eligibility'); ?>><?php esc_html_e('Eligibility', 'sibacom-manager'); ?></option>
                <option value="Competitions" <?php selected($category, 'Competitions'); ?>><?php esc_html_e('Competitions', 'sibacom-manager'); ?></option>
                <option value="Registration" <?php selected($category, 'Registration'); ?>><?php esc_html_e('Registration & Fees', 'sibacom-manager'); ?></option>
                <option value="Logistics" <?php selected($category, 'Logistics'); ?>><?php esc_html_e('Logistics & Travel', 'sibacom-manager'); ?></option>
            </select>
        </p>
        <p>
            <label><strong><?php esc_html_e('Sort Order:', 'sibacom-manager'); ?></strong></label><br>
            <input type="number" name="sibacom_faq_order" value="<?php echo esc_attr($order); ?>" style="width: 100%;" min="1">
        </p>
        <?php
    }

    /**
     * Save Meta Boxes
     */
    public static function save_meta_boxes($post_id) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!current_user_can('edit_post', $post_id)) return;

        // Event
        if (isset($_POST['sibacom_event_nonce']) && wp_verify_nonce($_POST['sibacom_event_nonce'], 'sibacom_save_event_meta')) {
            if (isset($_POST['sibacom_event_date'])) update_post_meta($post_id, '_sibacom_event_date', sanitize_text_field($_POST['sibacom_event_date']));
            if (isset($_POST['sibacom_event_start_time'])) update_post_meta($post_id, '_sibacom_event_start_time', sanitize_text_field($_POST['sibacom_event_start_time']));
            if (isset($_POST['sibacom_event_end_time'])) update_post_meta($post_id, '_sibacom_event_end_time', sanitize_text_field($_POST['sibacom_event_end_time']));
            if (isset($_POST['sibacom_event_venue'])) update_post_meta($post_id, '_sibacom_event_venue', sanitize_text_field($_POST['sibacom_event_venue']));
            if (isset($_POST['sibacom_event_fee_type'])) update_post_meta($post_id, '_sibacom_event_fee_type', sanitize_text_field($_POST['sibacom_event_fee_type']));
            if (isset($_POST['sibacom_event_fee_amount'])) update_post_meta($post_id, '_sibacom_event_fee_amount', sanitize_text_field($_POST['sibacom_event_fee_amount']));
            if (isset($_POST['sibacom_event_reg_open'])) update_post_meta($post_id, '_sibacom_event_reg_open', sanitize_text_field($_POST['sibacom_event_reg_open']));
            if (isset($_POST['sibacom_event_reg_close'])) update_post_meta($post_id, '_sibacom_event_reg_close', sanitize_text_field($_POST['sibacom_event_reg_close']));
            if (isset($_POST['sibacom_event_status_mode'])) update_post_meta($post_id, '_sibacom_event_status_mode', sanitize_text_field($_POST['sibacom_event_status_mode']));
            if (isset($_POST['sibacom_event_status'])) update_post_meta($post_id, '_sibacom_event_status', sanitize_text_field($_POST['sibacom_event_status']));
            if (isset($_POST['sibacom_event_reg_url'])) update_post_meta($post_id, '_sibacom_event_reg_url', esc_url_raw($_POST['sibacom_event_reg_url']));
            if (isset($_POST['sibacom_event_btn_text'])) update_post_meta($post_id, '_sibacom_event_btn_text', sanitize_text_field($_POST['sibacom_event_btn_text']));
            if (isset($_POST['sibacom_event_featured'])) update_post_meta($post_id, '_sibacom_event_featured', sanitize_text_field($_POST['sibacom_event_featured']));
            if (isset($_POST['sibacom_event_visibility'])) update_post_meta($post_id, '_sibacom_event_visibility', sanitize_text_field($_POST['sibacom_event_visibility']));
            if (isset($_POST['sibacom_event_order'])) {
                $order_val = intval($_POST['sibacom_event_order']);
                update_post_meta($post_id, '_sibacom_event_order', $order_val);
                global $wpdb;
                $wpdb->update($wpdb->posts, array('menu_order' => $order_val), array('ID' => $post_id));
                clean_post_cache($post_id);
            }
            if (isset($_POST['sibacom_event_banner_url'])) update_post_meta($post_id, '_sibacom_event_banner_url', esc_url_raw($_POST['sibacom_event_banner_url']));
        }

        // Session
        if (isset($_POST['sibacom_session_nonce']) && wp_verify_nonce($_POST['sibacom_session_nonce'], 'sibacom_save_session_meta')) {
            if (isset($_POST['sibacom_session_day'])) update_post_meta($post_id, '_sibacom_session_day', sanitize_text_field($_POST['sibacom_session_day']));
            if (isset($_POST['sibacom_session_start'])) update_post_meta($post_id, '_sibacom_session_start', sanitize_text_field($_POST['sibacom_session_start']));
            if (isset($_POST['sibacom_session_end'])) update_post_meta($post_id, '_sibacom_session_end', sanitize_text_field($_POST['sibacom_session_end']));
            if (isset($_POST['sibacom_session_duration'])) update_post_meta($post_id, '_sibacom_session_duration', sanitize_text_field($_POST['sibacom_session_duration']));
            if (isset($_POST['sibacom_session_speaker'])) update_post_meta($post_id, '_sibacom_session_speaker', sanitize_text_field($_POST['sibacom_session_speaker']));
            if (isset($_POST['sibacom_session_speaker_photo'])) update_post_meta($post_id, '_sibacom_session_speaker_photo', esc_url_raw($_POST['sibacom_session_speaker_photo']));
            if (isset($_POST['sibacom_session_venue'])) update_post_meta($post_id, '_sibacom_session_venue', sanitize_text_field($_POST['sibacom_session_venue']));
            if (isset($_POST['sibacom_session_category'])) update_post_meta($post_id, '_sibacom_session_category', sanitize_text_field($_POST['sibacom_session_category']));
            if (isset($_POST['sibacom_session_icon'])) update_post_meta($post_id, '_sibacom_session_icon', sanitize_text_field($_POST['sibacom_session_icon']));
            if (isset($_POST['sibacom_session_featured'])) update_post_meta($post_id, '_sibacom_session_featured', sanitize_text_field($_POST['sibacom_session_featured']));
            if (isset($_POST['sibacom_session_visibility'])) update_post_meta($post_id, '_sibacom_session_visibility', sanitize_text_field($_POST['sibacom_session_visibility']));
            if (isset($_POST['sibacom_session_order'])) {
                $order_val = intval($_POST['sibacom_session_order']);
                update_post_meta($post_id, '_sibacom_session_order', $order_val);
                global $wpdb;
                $wpdb->update($wpdb->posts, array('menu_order' => $order_val), array('ID' => $post_id));
                clean_post_cache($post_id);
            }
        }

        // Speaker & Guest
        if (isset($_POST['sibacom_speaker_nonce']) && wp_verify_nonce($_POST['sibacom_speaker_nonce'], 'sibacom_save_speaker_meta')) {
            if (isset($_POST['sibacom_speaker_role_type'])) update_post_meta($post_id, '_sibacom_speaker_role_type', sanitize_text_field($_POST['sibacom_speaker_role_type']));
            if (isset($_POST['sibacom_speaker_designation'])) update_post_meta($post_id, '_sibacom_speaker_designation', sanitize_text_field($_POST['sibacom_speaker_designation']));
            if (isset($_POST['sibacom_speaker_org'])) update_post_meta($post_id, '_sibacom_speaker_org', sanitize_text_field($_POST['sibacom_speaker_org']));
            if (isset($_POST['sibacom_speaker_category'])) update_post_meta($post_id, '_sibacom_speaker_category', sanitize_text_field($_POST['sibacom_speaker_category']));
            if (isset($_POST['sibacom_speaker_topic'])) update_post_meta($post_id, '_sibacom_speaker_topic', sanitize_text_field($_POST['sibacom_speaker_topic']));
            if (isset($_POST['sibacom_speaker_bio'])) update_post_meta($post_id, '_sibacom_speaker_bio', sanitize_textarea_field($_POST['sibacom_speaker_bio']));
            if (isset($_POST['sibacom_speaker_linkedin'])) update_post_meta($post_id, '_sibacom_speaker_linkedin', esc_url_raw($_POST['sibacom_speaker_linkedin']));
            if (isset($_POST['sibacom_speaker_twitter'])) update_post_meta($post_id, '_sibacom_speaker_twitter', esc_url_raw($_POST['sibacom_speaker_twitter']));
            if (isset($_POST['sibacom_speaker_github'])) update_post_meta($post_id, '_sibacom_speaker_github', esc_url_raw($_POST['sibacom_speaker_github']));
            if (isset($_POST['sibacom_speaker_featured'])) update_post_meta($post_id, '_sibacom_speaker_featured', sanitize_text_field($_POST['sibacom_speaker_featured']));
            if (isset($_POST['sibacom_speaker_order'])) {
                $order_val = intval($_POST['sibacom_speaker_order']);
                update_post_meta($post_id, '_sibacom_speaker_order', $order_val);
                global $wpdb;
                $wpdb->update($wpdb->posts, array('menu_order' => $order_val), array('ID' => $post_id));
                clean_post_cache($post_id);
            }
            if (isset($_POST['sibacom_speaker_photo_url'])) update_post_meta($post_id, '_sibacom_speaker_photo_url', esc_url_raw($_POST['sibacom_speaker_photo_url']));
        }

        // Sponsor
        if (isset($_POST['sibacom_sponsor_nonce']) && wp_verify_nonce($_POST['sibacom_sponsor_nonce'], 'sibacom_save_sponsor_meta')) {
            if (isset($_POST['sibacom_sponsor_url'])) update_post_meta($post_id, '_sibacom_sponsor_url', esc_url_raw($_POST['sibacom_sponsor_url']));
            if (isset($_POST['sibacom_sponsor_tier'])) update_post_meta($post_id, '_sibacom_sponsor_tier', sanitize_text_field($_POST['sibacom_sponsor_tier']));
            if (isset($_POST['sibacom_sponsor_order'])) {
                $order_val = intval($_POST['sibacom_sponsor_order']);
                update_post_meta($post_id, '_sibacom_sponsor_order', $order_val);
                global $wpdb;
                $wpdb->update($wpdb->posts, array('menu_order' => $order_val), array('ID' => $post_id));
                clean_post_cache($post_id);
            }
            if (isset($_POST['sibacom_sponsor_logo'])) update_post_meta($post_id, '_sibacom_sponsor_logo', esc_url_raw($_POST['sibacom_sponsor_logo']));
        }

        // FAQ
        if (isset($_POST['sibacom_faq_nonce']) && wp_verify_nonce($_POST['sibacom_faq_nonce'], 'sibacom_save_faq_meta')) {
            if (isset($_POST['sibacom_faq_category'])) update_post_meta($post_id, '_sibacom_faq_category', sanitize_text_field($_POST['sibacom_faq_category']));
            if (isset($_POST['sibacom_faq_order'])) {
                $order_val = intval($_POST['sibacom_faq_order']);
                update_post_meta($post_id, '_sibacom_faq_order', $order_val);
                global $wpdb;
                $wpdb->update($wpdb->posts, array('menu_order' => $order_val), array('ID' => $post_id));
                clean_post_cache($post_id);
            }
        }
    }
}

SIBACOM_Meta_Boxes::init();
