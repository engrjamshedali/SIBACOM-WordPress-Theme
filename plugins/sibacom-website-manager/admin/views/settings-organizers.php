<?php
/**
 * SIBACOM Organizers Settings View
 *
 * @package SIBACOM_Website_Manager
 */

if (!defined('ABSPATH')) {
    exit;
}

$get_val = function($key, $legacy_key, $default) {
    $val = get_option($key);
    if (is_string($val) && trim($val) !== '') {
        return trim($val);
    }
    if (!empty($legacy_key)) {
        $legacy = get_option($legacy_key);
        if (is_string($legacy) && trim($legacy) !== '') {
            return trim($legacy);
        }
    }
    return $default;
};
?>
<div class="wrap sibacom-admin-wrap">
    <div class="sibacom-admin-header">
        <div>
            <h1><?php esc_html_e('Organizers & Academic Partners Manager', 'sibacom-manager'); ?></h1>
            <p><?php esc_html_e('Manage institutional hierarchy, dual organizing societies, and supporting academic departments.', 'sibacom-manager'); ?></p>
        </div>
    </div>

    <form method="post" action="options.php">
        <?php settings_fields('sibacom_settings_group'); ?>

        <!-- SECTION 0: Section Headers & Hierarchy Badges -->
        <div class="sibacom-panel-card" style="border-left: 4px solid #173F91;">
            <h2><?php esc_html_e('Section Titles & Subtitles', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Customize headings and badges displayed on the homepage and organizers page.', 'sibacom-manager'); ?></p>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="sibacom-form-row">
                    <label for="sibacom_organizers_sec_badge"><?php esc_html_e('Primary Organizers Badge:', 'sibacom-manager'); ?></label>
                    <input type="text" id="sibacom_organizers_sec_badge" name="sibacom_organizers_sec_badge" value="<?php echo esc_attr($get_val('sibacom_organizers_sec_badge', '', 'Joint Primary Organizers')); ?>" />
                </div>
                <div class="sibacom-form-row">
                    <label for="sibacom_organizers_sec_title"><?php esc_html_e('Primary Organizers Section Title:', 'sibacom-manager'); ?></label>
                    <input type="text" id="sibacom_organizers_sec_title" name="sibacom_organizers_sec_title" value="<?php echo esc_attr($get_val('sibacom_organizers_sec_title', '', 'Co-Equal Student Engineering Societies')); ?>" />
                </div>
            </div>

            <div class="sibacom-form-row">
                <label for="sibacom_organizers_sec_subtitle"><?php esc_html_e('Primary Organizers Subtitle:', 'sibacom-manager'); ?></label>
                <textarea id="sibacom_organizers_sec_subtitle" name="sibacom_organizers_sec_subtitle" rows="2"><?php echo esc_textarea($get_val('sibacom_organizers_sec_subtitle', '', 'Bringing together the Computer Systems Engineering and Electrical Engineering communities.')); ?></textarea>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 15px;">
                <div class="sibacom-form-row">
                    <label for="sibacom_academic_sec_badge"><?php esc_html_e('Academic Partners Badge:', 'sibacom-manager'); ?></label>
                    <input type="text" id="sibacom_academic_sec_badge" name="sibacom_academic_sec_badge" value="<?php echo esc_attr($get_val('sibacom_academic_sec_badge', '', 'Academic Partners')); ?>" />
                </div>
                <div class="sibacom-form-row">
                    <label for="sibacom_academic_sec_title"><?php esc_html_e('Academic Partners Section Title:', 'sibacom-manager'); ?></label>
                    <input type="text" id="sibacom_academic_sec_title" name="sibacom_academic_sec_title" value="<?php echo esc_attr($get_val('sibacom_academic_sec_title', '', 'University Academic Departments')); ?>" />
                </div>
            </div>

            <div class="sibacom-form-row">
                <label for="sibacom_academic_sec_subtitle"><?php esc_html_e('Academic Partners Subtitle:', 'sibacom-manager'); ?></label>
                <textarea id="sibacom_academic_sec_subtitle" name="sibacom_academic_sec_subtitle" rows="2"><?php echo esc_textarea($get_val('sibacom_academic_sec_subtitle', '', 'Supporting academic departments providing faculty advisement, research laboratory facilities, and international judging standards.')); ?></textarea>
            </div>
        </div>

        <!-- 1. Joint Primary Organizers: CSE Society & EE Society -->
        <div class="sibacom-panel-card" style="border-left: 4px solid #173F91;">
            <h2><?php esc_html_e('1. Joint Primary Organizers (Equal Prominence)', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Both student societies are the co-equal primary organizers of SIBACOM.', 'sibacom-manager'); ?></p>

            <!-- 1A. CSE Society -->
            <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 20px; margin-bottom: 20px;">
                <h3 style="color: #173F91; margin-top: 0;"><?php esc_html_e('A. Computer Systems Engineering Society (CSE Society)', 'sibacom-manager'); ?></h3>
                
                <div class="sibacom-form-row">
                    <label for="sibacom_organizers_cse_society_title"><?php esc_html_e('Society Display Title:', 'sibacom-manager'); ?></label>
                    <input type="text" id="sibacom_organizers_cse_society_title" name="sibacom_organizers_cse_society_title" value="<?php echo esc_attr($get_val('sibacom_organizers_cse_society_title', 'sibacom_organizers_society_title', 'Computer Systems Engineering Society (CSE Society)')); ?>" />
                </div>

                <div class="sibacom-form-row">
                    <label for="sibacom_organizers_cse_society_desc"><?php esc_html_e('Society Scope / Narrative:', 'sibacom-manager'); ?></label>
                    <textarea id="sibacom_organizers_cse_society_desc" name="sibacom_organizers_cse_society_desc" rows="3"><?php echo esc_textarea($get_val('sibacom_organizers_cse_society_desc', 'sibacom_organizers_society_desc', 'The premier student engineering society of the Department of Computer Systems Engineering, pioneering technical competitions, algorithmic hackathons, and hardware-software innovation at Sukkur IBA University.')); ?></textarea>
                </div>

                <div class="sibacom-form-row">
                    <label for="sibacom_organizers_cse_society_affiliation"><?php esc_html_e('Academic Affiliation Label:', 'sibacom-manager'); ?></label>
                    <input type="text" id="sibacom_organizers_cse_society_affiliation" name="sibacom_organizers_cse_society_affiliation" value="<?php echo esc_attr($get_val('sibacom_organizers_cse_society_affiliation', '', 'Co-Equal Secretariat & Computing Track Lead')); ?>" />
                </div>
            </div>

            <!-- 1B. EE Society -->
            <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 20px;">
                <h3 style="color: #079B58; margin-top: 0;"><?php esc_html_e('B. Electrical Engineering Society (EE Society)', 'sibacom-manager'); ?></h3>
                
                <div class="sibacom-form-row">
                    <label for="sibacom_organizers_ee_society_title"><?php esc_html_e('Society Display Title:', 'sibacom-manager'); ?></label>
                    <input type="text" id="sibacom_organizers_ee_society_title" name="sibacom_organizers_ee_society_title" value="<?php echo esc_attr($get_val('sibacom_organizers_ee_society_title', '', 'Electrical Engineering Society (EE Society)')); ?>" />
                </div>

                <div class="sibacom-form-row">
                    <label for="sibacom_organizers_ee_society_desc"><?php esc_html_e('Society Scope / Narrative:', 'sibacom-manager'); ?></label>
                    <textarea id="sibacom_organizers_ee_society_desc" name="sibacom_organizers_ee_society_desc" rows="3"><?php echo esc_textarea($get_val('sibacom_organizers_ee_society_desc', '', 'The leading student engineering society of the Department of Electrical Engineering, driving excellence in circuit design, embedded robotics, telecommunications, and power systems at Sukkur IBA University.')); ?></textarea>
                </div>

                <div class="sibacom-form-row">
                    <label for="sibacom_organizers_ee_society_affiliation"><?php esc_html_e('Academic Affiliation Label:', 'sibacom-manager'); ?></label>
                    <input type="text" id="sibacom_organizers_ee_society_affiliation" name="sibacom_organizers_ee_society_affiliation" value="<?php echo esc_attr($get_val('sibacom_organizers_ee_society_affiliation', '', 'Co-Equal Secretariat & Electrical Track Lead')); ?>" />
                </div>
            </div>
        </div>

        <!-- 2. Academic Partners: Dept. of CSE & Dept. of EE -->
        <div class="sibacom-panel-card" style="border-left: 4px solid #102E68;">
            <h2><?php esc_html_e('2. Academic Partners (Departmental Affiliations)', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Supporting academic departments providing faculty advisement, laboratories, and standards.', 'sibacom-manager'); ?></p>

            <!-- 2A. Dept of CSE -->
            <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 20px; margin-bottom: 20px;">
                <h3 style="color: #102E68; margin-top: 0;"><?php esc_html_e('A. Department of Computer Systems Engineering', 'sibacom-manager'); ?></h3>
                
                <div class="sibacom-form-row">
                    <label for="sibacom_academic_cse_dept_title"><?php esc_html_e('Department Display Title:', 'sibacom-manager'); ?></label>
                    <input type="text" id="sibacom_academic_cse_dept_title" name="sibacom_academic_cse_dept_title" value="<?php echo esc_attr($get_val('sibacom_academic_cse_dept_title', 'sibacom_organizers_dept_title', 'Department of Computer Systems Engineering')); ?>" />
                </div>

                <div class="sibacom-form-row">
                    <label for="sibacom_academic_cse_dept_desc"><?php esc_html_e('Department Narrative & Support Scope:', 'sibacom-manager'); ?></label>
                    <textarea id="sibacom_academic_cse_dept_desc" name="sibacom_academic_cse_dept_desc" rows="3"><?php echo esc_textarea($get_val('sibacom_academic_cse_dept_desc', 'sibacom_organizers_dept_desc', 'Academic affiliation and supporting partner for the CSE Society, providing high-performance computing clusters, embedded systems labs, and faculty adjudication across computing and AI tracks.')); ?></textarea>
                </div>

                <div class="sibacom-form-row">
                    <label for="sibacom_academic_cse_dept_support"><?php esc_html_e('Academic Role / Facility Tag:', 'sibacom-manager'); ?></label>
                    <input type="text" id="sibacom_academic_cse_dept_support" name="sibacom_academic_cse_dept_support" value="<?php echo esc_attr($get_val('sibacom_academic_cse_dept_support', '', 'Computing Labs & Faculty Adjudication')); ?>" />
                </div>
            </div>

            <!-- 2B. Dept of EE -->
            <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 8px; padding: 20px;">
                <h3 style="color: #102E68; margin-top: 0;"><?php esc_html_e('B. Department of Electrical Engineering', 'sibacom-manager'); ?></h3>
                
                <div class="sibacom-form-row">
                    <label for="sibacom_academic_ee_dept_title"><?php esc_html_e('Department Display Title:', 'sibacom-manager'); ?></label>
                    <input type="text" id="sibacom_academic_ee_dept_title" name="sibacom_academic_ee_dept_title" value="<?php echo esc_attr($get_val('sibacom_academic_ee_dept_title', '', 'Department of Electrical Engineering')); ?>" />
                </div>

                <div class="sibacom-form-row">
                    <label for="sibacom_academic_ee_dept_desc"><?php esc_html_e('Department Narrative & Support Scope:', 'sibacom-manager'); ?></label>
                    <textarea id="sibacom_academic_ee_dept_desc" name="sibacom_academic_ee_dept_desc" rows="3"><?php echo esc_textarea($get_val('sibacom_academic_ee_dept_desc', '', 'Academic affiliation and supporting partner for the EE Society, providing state-of-the-art electronics, telecommunications, and power engineering laboratories, along with senior faculty mentorship.')); ?></textarea>
                </div>

                <div class="sibacom-form-row">
                    <label for="sibacom_academic_ee_dept_support"><?php esc_html_e('Academic Role / Facility Tag:', 'sibacom-manager'); ?></label>
                    <input type="text" id="sibacom_academic_ee_dept_support" name="sibacom_academic_ee_dept_support" value="<?php echo esc_attr($get_val('sibacom_academic_ee_dept_support', '', 'Electronics Labs & Technical Adjudication')); ?>" />
                </div>
            </div>
        </div>

        <!-- 3. Overarching Institutional Identity: Sukkur IBA University -->
        <div class="sibacom-panel-card" style="border-left: 4px solid #079B58;">
            <h2><?php esc_html_e('3. Overarching Institutional Identity (Sukkur IBA University)', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Top-ranked public sector chartered university hosting and patronizing the Olympiad.', 'sibacom-manager'); ?></p>

            <div class="sibacom-form-row">
                <label for="sibacom_organizers_uni_title"><?php esc_html_e('University Display Title:', 'sibacom-manager'); ?></label>
                <input type="text" id="sibacom_organizers_uni_title" name="sibacom_organizers_uni_title" value="<?php echo esc_attr($get_val('sibacom_organizers_uni_title', '', 'Sukkur IBA University')); ?>" />
            </div>

            <div class="sibacom-form-row">
                <label for="sibacom_organizers_uni_desc"><?php esc_html_e('University Narrative:', 'sibacom-manager'); ?></label>
                <textarea id="sibacom_organizers_uni_desc" name="sibacom_organizers_uni_desc" rows="3"><?php echo esc_textarea($get_val('sibacom_organizers_uni_desc', '', 'A top-ranked public sector university chartered by the Government of Sindh and recognized by HEC Pakistan, renowned for its merit-based admission, cutting-edge labs, and academic prestige.')); ?></textarea>
            </div>
        </div>

        <!-- 4. Student Leadership Council: SISC -->
        <div class="sibacom-panel-card">
            <h2><?php esc_html_e('4. Student Leadership Council (SISC)', 'sibacom-manager'); ?></h2>
            <p class="subtitle"><?php esc_html_e('Apex student council coordinating cross-campus operations and delegate relations.', 'sibacom-manager'); ?></p>

            <div class="sibacom-form-row">
                <label for="sibacom_organizers_sisc_title"><?php esc_html_e('Council Display Title:', 'sibacom-manager'); ?></label>
                <input type="text" id="sibacom_organizers_sisc_title" name="sibacom_organizers_sisc_title" value="<?php echo esc_attr($get_val('sibacom_organizers_sisc_title', '', 'SISC – Sukkur IBA Student Council')); ?>" />
            </div>

            <div class="sibacom-form-row">
                <label for="sibacom_organizers_sisc_desc"><?php esc_html_e('Council Narrative:', 'sibacom-manager'); ?></label>
                <textarea id="sibacom_organizers_sisc_desc" name="sibacom_organizers_sisc_desc" rows="3"><?php echo esc_textarea($get_val('sibacom_organizers_sisc_desc', '', 'The apex representative student leadership council of Sukkur IBA University, overseeing cross-departmental coordination, university-wide engagement, and delegate hospitality.')); ?></textarea>
            </div>
        </div>

        <p class="submit">
            <input type="submit" name="submit" class="button button-primary sibacom-btn-save" value="<?php esc_attr_e('Save Organizers Configuration', 'sibacom-manager'); ?>" />
        </p>
    </form>
</div>

<?php

