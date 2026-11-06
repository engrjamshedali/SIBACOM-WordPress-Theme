<?php
/**
 * SIBACOM Default Site Footer Template Part
 *
 * @package SIBACOM
 */

if (!defined('ABSPATH')) {
    exit;
}

$footer_desc     = sibacom_get_option('footer_description', 'SIBACOM (Sukkur IBA Annual Mega Olympiad) is the flagship collegiate technology festival, computing symposium, and engineering championship presented by Sukkur IBA University, jointly organized by the Computer Systems Engineering Society (CSE Society) and the Electrical Engineering Society (EE Society), supported by academic partners: Department of Computer Systems Engineering and Department of Electrical Engineering.');
$contact_email   = sibacom_get_option('contact_email', 'sibacom@iba-suk.edu.pk');
$contact_phone   = sibacom_get_option('contact_phone', '+92 71 5644000');
$contact_address = sibacom_get_option('contact_address', 'Sukkur IBA University, Airport Road, Sukkur, Sindh, Pakistan');
$copyright_text  = sibacom_get_option('copyright_text', '© 2026 SIBACOM – Sukkur IBA University. All Rights Reserved.');
$footer_reg_url  = function_exists('sibacom_get_register_url') ? sibacom_get_register_url() : 'https://portal.sibacom.tech/';

$white_iba_logo  = SIBACOM_THEME_URI . '/assets/images/sukkur_iba_white_logo.png';
$white_cse_logo  = SIBACOM_THEME_URI . '/assets/images/cse_society_logo_white.png';
$dept_cse_logo   = SIBACOM_THEME_URI . '/assets/images/cse_dept_logo.jpg';
$sisc_logo       = SIBACOM_THEME_URI . '/assets/images/sisc_logo.jpg';

$linkedin  = get_option('sibacom_social_linkedin', 'https://www.linkedin.com/school/sukkur-iba-university/');
$twitter   = get_option('sibacom_social_twitter', 'https://twitter.com/Sukkur_IBA');
$facebook  = get_option('sibacom_social_facebook', 'https://www.facebook.com/SukkurIBA.University');
$instagram = get_option('sibacom_social_instagram', 'https://www.instagram.com/sukkur_iba_official');
$youtube   = get_option('sibacom_social_youtube', '');
$github    = get_option('sibacom_social_github', '');
?>
<footer class="sibacom-footer" id="colophon">
    <?php if (function_exists('sibacom_the_footer_circuits')) { sibacom_the_footer_circuits(); } ?>
    <div class="sibacom-container">
        <div class="sibacom-footer-grid">
            
            <!-- Column 1: SIBACOM Brand & Description -->
            <div class="sibacom-footer-col">
                <div class="sibacom-footer-brand-wrap" style="display: flex; align-items: center; gap: 0.85rem; margin-bottom: 1.25rem; flex-wrap: wrap;">
                    <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php esc_attr_e('SIBACOM 2026', 'sibacom'); ?>" style="display: inline-flex; align-items: center; text-decoration: none;">
                        <div style="background: #03326A; border-radius: 8px; padding: 2px; border: 1px solid rgba(255,255,255,0.22); box-shadow: 0 4px 12px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <?php if (function_exists('sibacom_the_official_logo')) { sibacom_the_official_logo('footer', 'sibacom-footer-logo', 44); } else { ?>
                                <img src="<?php echo esc_url(SIBACOM_THEME_URI . '/assets/images/sibacom_logo.jpg'); ?>" alt="<?php esc_attr_e('SIBACOM Official Logo', 'sibacom'); ?>" width="44" height="44" style="height: 44px; width: 44px; aspect-ratio: 1/1; object-fit: contain; border-radius: 6px;" />
                            <?php } ?>
                        </div>
                    </a>
                    <div style="width: 1px; height: 32px; background: rgba(255,255,255,0.25);"></div>
                    <img src="<?php echo esc_url($white_iba_logo); ?>" alt="<?php esc_attr_e('Sukkur IBA University', 'sibacom'); ?>" width="130" height="42" loading="lazy" decoding="async" style="height: 42px; width: auto; max-width: 130px; object-fit: contain;" />
                    <div style="width: 1px; height: 32px; background: rgba(255,255,255,0.25);"></div>
                    <div style="display: flex; align-items: center; gap: 0.65rem;">
                        <?php sibacom_the_cse_society_logo('white', 'society-logo cse-society-logo', 36, 110); ?>
                        <?php sibacom_the_ee_society_logo('white', 'society-logo ee-society-logo', 36, 110); ?>
                    </div>
                </div>
                <p style="line-height: 1.7; color: #94A3B8; font-size: 0.95rem; margin-top: 0.5rem; word-break: break-word;"><?php echo esc_html($footer_desc); ?></p>
                <div style="display: flex; gap: 0.75rem; margin-top: 1.5rem; flex-wrap: wrap;">
                    <?php if (!empty($linkedin)) : ?>
                        <a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener noreferrer" style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 50%; background: rgba(255,255,255,0.08); display: flex; align-items: center; justify-content: center; color: #fff; transition: background 0.2s;" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                    <?php endif; ?>
                    <?php if (!empty($twitter)) : ?>
                        <a href="<?php echo esc_url($twitter); ?>" target="_blank" rel="noopener noreferrer" style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 50%; background: rgba(255,255,255,0.08); display: flex; align-items: center; justify-content: center; color: #fff; transition: background 0.2s;" aria-label="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
                    <?php endif; ?>
                    <?php if (!empty($facebook)) : ?>
                        <a href="<?php echo esc_url($facebook); ?>" target="_blank" rel="noopener noreferrer" style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 50%; background: rgba(255,255,255,0.08); display: flex; align-items: center; justify-content: center; color: #fff; transition: background 0.2s;" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <?php endif; ?>
                    <?php if (!empty($instagram)) : ?>
                        <a href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener noreferrer" style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 50%; background: rgba(255,255,255,0.08); display: flex; align-items: center; justify-content: center; color: #fff; transition: background 0.2s;" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <?php endif; ?>
                    <?php if (!empty($youtube)) : ?>
                        <a href="<?php echo esc_url($youtube); ?>" target="_blank" rel="noopener noreferrer" style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 50%; background: rgba(255,255,255,0.08); display: flex; align-items: center; justify-content: center; color: #fff; transition: background 0.2s;" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    <?php endif; ?>
                    <?php if (!empty($github)) : ?>
                        <a href="<?php echo esc_url($github); ?>" target="_blank" rel="noopener noreferrer" style="width: 44px; height: 44px; min-width: 44px; min-height: 44px; border-radius: 50%; background: rgba(255,255,255,0.08); display: flex; align-items: center; justify-content: center; color: #fff; transition: background 0.2s;" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Column 2: Quick Navigation Links -->
            <div class="sibacom-footer-col">
                <h4><?php esc_html_e('Quick Navigation', 'sibacom'); ?></h4>
                <ul class="sibacom-footer-links">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'sibacom'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/about/')); ?>"><?php esc_html_e('About SIBACOM', 'sibacom'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/events/')); ?>"><?php esc_html_e('Events & Competitions', 'sibacom'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/schedule/')); ?>"><?php esc_html_e('Event Schedule', 'sibacom'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/speakers/')); ?>"><?php esc_html_e('Speakers & Judges', 'sibacom'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/guests/')); ?>"><?php esc_html_e('Guests & Dignitaries', 'sibacom'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/organizers/')); ?>"><?php esc_html_e('Organizing Committee', 'sibacom'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/sponsors/')); ?>"><?php esc_html_e('Partners & Sponsors', 'sibacom'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact/')); ?>"><?php esc_html_e('Contact Secretariat', 'sibacom'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/#faq')); ?>"><?php esc_html_e('FAQ', 'sibacom'); ?></a></li>
                    <li><a href="<?php echo esc_url($footer_reg_url); ?>" target="_blank" rel="noopener noreferrer"><strong style="color: var(--sibacom-techgreen, #079B58);"><?php esc_html_e('Registration Portal', 'sibacom'); ?></strong> <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0.75rem; margin-left: 4px;"></i></a></li>
                </ul>
            </div>

            <!-- Column 3: Professional Footer Structure – 3 Distinct Groups -->
            <div class="sibacom-footer-col">
                <h4><?php esc_html_e('Organizational Structure', 'sibacom'); ?></h4>
                <div style="display: flex; flex-direction: column; gap: 1.15rem; margin-top: 0.65rem;">
                    
                    <!-- Group 0: Flagship Olympiad Identity -->
                    <div class="sibacom-footer-org-group">
                        <span class="sibacom-footer-org-label"><?php esc_html_e('Championship Identity', 'sibacom'); ?></span>
                        <div class="sibacom-footer-org-items">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="sibacom-footer-org-item">
                                <img src="<?php echo esc_url(function_exists('sibacom_get_logo_url') ? sibacom_get_logo_url() : SIBACOM_THEME_URI . '/assets/images/sibacom_logo.jpg'); ?>" alt="<?php esc_attr_e('SIBACOM Official Logo', 'sibacom'); ?>" width="24" height="24" loading="lazy" decoding="async" style="height: 24px; width: 24px; border-radius: 4px; object-fit: contain;" />
                                <span><?php esc_html_e('SIBACOM 2026 • Power to Progress', 'sibacom'); ?></span>
                            </a>
                        </div>
                    </div>

                    <!-- Group 1: Overarching Institutional Identity -->
                    <div class="sibacom-footer-org-group">
                        <span class="sibacom-footer-org-label"><?php esc_html_e('Institution', 'sibacom'); ?></span>
                        <div class="sibacom-footer-org-items">
                            <a href="https://iba-suk.edu.pk" target="_blank" rel="noopener noreferrer" class="sibacom-footer-org-item">
                                <img src="<?php echo esc_url($white_iba_logo); ?>" alt="<?php esc_attr_e('Sukkur IBA University', 'sibacom'); ?>" width="85" height="24" loading="lazy" decoding="async" style="height: 24px; width: auto; max-width: 85px; object-fit: contain;" />
                                <span><?php esc_html_e('Sukkur IBA University', 'sibacom'); ?></span>
                            </a>
                        </div>
                    </div>

                    <!-- Group 2: Joint Primary Organizers -->
                    <div class="sibacom-footer-org-group">
                        <span class="sibacom-footer-org-label"><?php esc_html_e('Joint Organizers', 'sibacom'); ?></span>
                        <div class="sibacom-footer-org-items">
                            <a href="<?php echo esc_url(home_url('/organizers/')); ?>" class="sibacom-footer-org-item">
                                <img src="<?php echo esc_url($white_cse_logo); ?>" alt="<?php esc_attr_e('CSE Society', 'sibacom'); ?>" width="75" height="20" loading="lazy" decoding="async" style="height: 20px; width: auto; max-width: 75px; object-fit: contain;" />
                                <span><?php esc_html_e('CSE Society', 'sibacom'); ?></span>
                            </a>
                            <a href="<?php echo esc_url(home_url('/organizers/')); ?>" class="sibacom-footer-org-item">
                                <?php if (function_exists('sibacom_the_ee_society_logo')) { sibacom_the_ee_society_logo('white', 'society-logo ee-society-logo', 20, 75); } ?>
                                <span><?php esc_html_e('EE Society', 'sibacom'); ?></span>
                            </a>
                        </div>
                    </div>

                    <!-- Group 3: Academic Partners -->
                    <div class="sibacom-footer-org-group">
                        <span class="sibacom-footer-org-label"><?php esc_html_e('Academic Partners', 'sibacom'); ?></span>
                        <div class="sibacom-footer-org-items">
                            <a href="<?php echo esc_url(home_url('/organizers/#academic-partners')); ?>" class="sibacom-footer-org-item">
                                <img src="<?php echo esc_url($dept_cse_logo); ?>" alt="<?php esc_attr_e('Department of Computer Systems Engineering', 'sibacom'); ?>" width="20" height="20" loading="lazy" decoding="async" style="height: 20px; width: 20px; border-radius: 4px; object-fit: cover;" />
                                <span><?php esc_html_e('Department of Computer Systems Engineering', 'sibacom'); ?></span>
                            </a>
                            <a href="<?php echo esc_url(home_url('/organizers/#academic-partners')); ?>" class="sibacom-footer-org-item">
                                <?php if (function_exists('sibacom_the_ee_dept_logo')) { sibacom_the_ee_dept_logo(20, 20); } ?>
                                <span><?php esc_html_e('Department of Electrical Engineering', 'sibacom'); ?></span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Column 4: Contact & Secretariat -->
            <div class="sibacom-footer-col">
                <h4><?php esc_html_e('Contact Secretariat', 'sibacom'); ?></h4>
                <p style="display: flex; gap: 0.6rem; margin-bottom: 0.8rem; align-items: flex-start; color: #94A3B8; font-size: 0.92rem;">
                    <i class="fa-solid fa-location-dot" style="color: var(--sibacom-techgreen, #079B58); margin-top: 4px;"></i>
                    <span><?php echo esc_html($contact_address); ?></span>
                </p>
                <p style="display: flex; gap: 0.6rem; margin-bottom: 0.8rem; align-items: center; color: #94A3B8; font-size: 0.92rem;">
                    <i class="fa-solid fa-envelope" style="color: var(--sibacom-techgreen, #079B58);"></i>
                    <a href="mailto:<?php echo esc_attr($contact_email); ?>" style="color: #E2E8F0; text-decoration: none; padding: 0.25rem 0; display: inline-flex; align-items: center; min-height: 44px;"><?php echo esc_html($contact_email); ?></a>
                </p>
                <p style="display: flex; gap: 0.6rem; align-items: center; color: #94A3B8; font-size: 0.92rem;">
                    <i class="fa-solid fa-phone" style="color: var(--sibacom-techgreen, #079B58);"></i>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $contact_phone)); ?>" style="color: #E2E8F0; text-decoration: none; padding: 0.25rem 0; display: inline-flex; align-items: center; min-height: 44px;"><?php echo esc_html($contact_phone); ?></a>
                </p>
                <div style="margin-top: 1.25rem;">
                    <a href="<?php echo esc_url($footer_reg_url); ?>" target="_blank" rel="noopener noreferrer" class="sibacom-btn sibacom-btn-primary" style="padding: 0.65rem 1.25rem; font-size: 0.88rem; display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; color: #fff; width: 100%; border-radius: 8px;">
                        <span><?php esc_html_e('Register Now', 'sibacom'); ?></span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>

        </div>

        <div class="sibacom-footer-bottom">
            <div class="sibacom-footer-bottom-main">
                <div class="sibacom-footer-copyright"><?php echo esc_html($copyright_text); ?></div>
                <div class="sibacom-footer-legal-links">
                    <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>"><?php esc_html_e('Privacy Policy', 'sibacom'); ?></a>
                    <a href="<?php echo esc_url(home_url('/terms/')); ?>"><?php esc_html_e('Terms & Conditions', 'sibacom'); ?></a>
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>"><?php esc_html_e('Secretariat Helpdesk', 'sibacom'); ?></a>
                </div>
            </div>
            <div class="sibacom-developer-credit">
                <div class="sibacom-credit-inner">
                    <span class="sibacom-credit-text">Engineered with <span class="sibacom-heart" role="img" aria-label="love">💚</span> by <a href="https://jamshedali.me" target="_blank" rel="noopener noreferrer" class="sibacom-credit-link sibacom-credit-name-jamshed">Jamshed Ali</a> in collaboration with <a href="https://auranix.tech" target="_blank" rel="noopener noreferrer" class="sibacom-credit-link sibacom-credit-name-auranix">AuraNix Technologies</a></span>
                </div>
            </div>
        </div>
    </div>
</footer>
