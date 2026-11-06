<?php
/**
 * Template Name: SIBACOM Portal & Verification Template
 *
 * Unified Participant Portal, Staff Dashboard, Login & Registration,
 * and Payment Verification Interface with Official SIBACOM Logo.
 *
 * @package SIBACOM
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$logo_url   = function_exists('sibacom_get_logo_url') ? sibacom_get_logo_url() : SIBACOM_THEME_URI . '/assets/images/sibacom_logo.jpg';
$event_name = function_exists('sibacom_get_option') ? sibacom_get_option('event_name', 'SIBACOM 2026') : 'SIBACOM 2026';
$event_dates = function_exists('sibacom_get_option') ? sibacom_get_option('event_dates', 'November 30 – December 02, 2026') : 'November 30 – December 02, 2026';
$event_venue = function_exists('sibacom_get_option') ? sibacom_get_option('event_venue', 'Sukkur IBA University') : 'Sukkur IBA University';
?>
<div class="sibacom-circuit-bg" style="padding-top: 3.5rem; padding-bottom: 6rem; position: relative;">
    <?php if (function_exists('sibacom_the_circuit_bg')) { sibacom_the_circuit_bg('light'); } ?>
    
    <div class="sibacom-container" style="position: relative; z-index: 1;">
        
        <!-- ================= HERO HEADER ================= -->
        <header class="sibacom-section-header text-center" style="max-width: 820px; margin: 0 auto 3rem auto;">
            <!-- Official SIBACOM Emblem -->
            <div class="sibacom-portal-logo-wrap" style="display: flex; justify-content: center; margin-bottom: 1.5rem;">
                <div style="background: #03326A; padding: 5px; border-radius: 20px; box-shadow: 0 14px 40px rgba(3, 50, 106, 0.35), 0 0 0 1px rgba(255,255,255,0.18); display: inline-flex; align-items: center; justify-content: center;">
                    <img src="<?php echo esc_url($logo_url); ?>" alt="<?php esc_attr_e('SIBACOM Official Logo', 'sibacom'); ?>" width="88" height="88" class="sibacom-portal-hero-logo" style="height: 88px; width: 88px; aspect-ratio: 1/1; border-radius: 16px; object-fit: contain; display: block;" />
                </div>
            </div>

            <div class="sibacom-badge" style="margin-bottom: 1rem;">
                <span class="pulse-dot"></span>
                <span><?php esc_html_e('Verified Delegate & Secretariat System', 'sibacom'); ?></span>
            </div>

            <h1 class="font-display" style="font-size: clamp(2rem, 5vw, 3rem); line-height: 1.15; color: var(--sibacom-primary); margin-bottom: 0.75rem;">
                <?php echo esc_html($event_name); ?> <span class="sibacom-gradient-text"><?php esc_html_e('Official Portals', 'sibacom'); ?></span>
            </h1>

            <p style="font-size: 1.05rem; color: var(--sibacom-text-secondary); line-height: 1.6; margin: 0 auto;">
                <?php esc_html_e('Single sign-on access for registered contestants, student delegations, faculty mentors, and official desk coordinators. Powered by the official SIBACOM identity.', 'sibacom'); ?>
            </p>

            <!-- Nav Tabs Switcher -->
            <div class="sibacom-portal-tabs" role="tablist" style="display: flex; justify-content: center; gap: 0.75rem; flex-wrap: wrap; margin-top: 2rem;">
                <button type="button" class="sibacom-portal-tab-btn active" data-tab="participant" role="tab" aria-selected="true" style="padding: 0.75rem 1.45rem; border-radius: 9999px; font-weight: 700; font-size: 0.92rem; cursor: pointer; border: none; transition: all 0.25s ease;">
                    <i class="fa-solid fa-user-graduate" style="margin-right: 8px;"></i><?php esc_html_e('Participant Portal', 'sibacom'); ?>
                </button>
                <button type="button" class="sibacom-portal-tab-btn" data-tab="staff" role="tab" aria-selected="false" style="padding: 0.75rem 1.45rem; border-radius: 9999px; font-weight: 700; font-size: 0.92rem; cursor: pointer; border: none; transition: all 0.25s ease;">
                    <i class="fa-solid fa-id-badge" style="margin-right: 8px;"></i><?php esc_html_e('Staff & Secretariat', 'sibacom'); ?>
                </button>
                <button type="button" class="sibacom-portal-tab-btn" data-tab="verification" role="tab" aria-selected="false" style="padding: 0.75rem 1.45rem; border-radius: 9999px; font-weight: 700; font-size: 0.92rem; cursor: pointer; border: none; transition: all 0.25s ease;">
                    <i class="fa-solid fa-receipt" style="margin-right: 8px;"></i><?php esc_html_e('Payment Verification', 'sibacom'); ?>
                </button>
            </div>
        </header>

        <!-- ================= TAB 1: PARTICIPANT PORTAL ================= -->
        <div id="tab-participant" class="sibacom-portal-view active">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem; align-items: start;">
                
                <!-- Sign In & Registration Card -->
                <div class="neu-card" style="padding: 2.5rem 2rem; border-radius: 20px;">
                    <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 1px solid var(--sibacom-border);">
                        <div style="background: #03326A; padding: 3px; border-radius: 10px; box-shadow: 0 4px 12px rgba(3, 50, 106, 0.3); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <img src="<?php echo esc_url($logo_url); ?>" alt="SIBACOM Logo" width="44" height="44" style="height: 44px; width: 44px; aspect-ratio: 1/1; border-radius: 7px; object-fit: contain; display: block;" />
                        </div>
                        <div>
                            <h3 style="margin: 0; font-size: 1.25rem; color: var(--sibacom-primary); font-weight: 800;"><?php esc_html_e('Participant Sign In', 'sibacom'); ?></h3>
                            <span style="font-size: 0.78rem; color: var(--sibacom-text-secondary);"><?php esc_html_e('Access your delegate dashboard & passes', 'sibacom'); ?></span>
                        </div>
                    </div>

                    <form onsubmit="event.preventDefault(); window.sibacomSimulateLogin('participant');" style="display: flex; flex-direction: column; gap: 1.15rem;">
                        <div>
                            <label style="display: block; font-size: 0.88rem; font-weight: 700; margin-bottom: 0.35rem; color: var(--sibacom-text-primary);">
                                <?php esc_html_e('Registration Email / CNIC:', 'sibacom'); ?>
                            </label>
                            <input type="text" id="participant-email" value="delegate.lead@iba-suk.edu.pk" required style="width: 100%; padding: 0.75rem 1rem; border-radius: 10px; border: 1px solid var(--sibacom-border); background: #FFFFFF; font-size: 0.95rem; font-family: inherit;" />
                        </div>

                        <div>
                            <label style="display: block; font-size: 0.88rem; font-weight: 700; margin-bottom: 0.35rem; color: var(--sibacom-text-primary);">
                                <?php esc_html_e('Security PIN or Password:', 'sibacom'); ?>
                            </label>
                            <input type="password" id="participant-password" value="••••••••" required style="width: 100%; padding: 0.75rem 1rem; border-radius: 10px; border: 1px solid var(--sibacom-border); background: #FFFFFF; font-size: 0.95rem; font-family: inherit;" />
                        </div>

                        <div style="display: flex; justify-content: space-between; align-items: center; font-size: 0.82rem;">
                            <label style="display: flex; align-items: center; gap: 6px; cursor: pointer; color: var(--sibacom-text-secondary);">
                                <input type="checkbox" checked /> <?php esc_html_e('Remember on this device', 'sibacom'); ?>
                            </label>
                            <a href="#forgot" onclick="alert('Password reset link sent to registered email.');" style="color: var(--sibacom-techgreen); font-weight: 700; text-decoration: none;"><?php esc_html_e('Forgot credentials?', 'sibacom'); ?></a>
                        </div>

                        <button type="submit" class="sibacom-btn sibacom-btn-primary" style="width: 100%; justify-content: center; padding: 0.85rem; margin-top: 0.5rem;">
                            <span><?php esc_html_e('Sign In to Participant Portal', 'sibacom'); ?></span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>

                        <div style="text-align: center; font-size: 0.85rem; color: var(--sibacom-text-secondary); margin-top: 0.5rem;">
                            <?php esc_html_e('New team or solo contestant?', 'sibacom'); ?>
                            <a href="https://portal.sibacom.tech/" target="_blank" rel="noopener noreferrer" style="color: var(--sibacom-primary); font-weight: 800; text-decoration: underline; margin-left: 4px;"><?php esc_html_e('Register Now', 'sibacom'); ?></a>
                        </div>
                    </form>
                </div>

                <!-- Participant Dashboard Simulator (Live Delegate Pass) -->
                <div class="neu-card" style="padding: 2.5rem 2rem; border-radius: 20px; background: linear-gradient(180deg, #FFFFFF 0%, #F8FAFC 100%);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 0.5rem;">
                        <span class="sibacom-badge" style="background: rgba(7, 155, 88, 0.1); color: #079B58; border-color: rgba(7, 155, 88, 0.25);">
                            <i class="fa-solid fa-circle-check"></i> <?php esc_html_e('Verified Delegate Pass', 'sibacom'); ?>
                        </span>
                        <span style="font-family: monospace; font-size: 0.85rem; font-weight: 800; color: #173F91;">SIB-2026-9841</span>
                    </div>

                    <!-- Delegate Pass Box with Official SIBACOM Logo Watermark -->
                    <div style="background: linear-gradient(135deg, #03326A 0%, #102E68 60%, #070B14 100%); border-radius: 16px; padding: 1.75rem; color: #FFFFFF; position: relative; overflow: hidden; box-shadow: 0 10px 30px rgba(3, 50, 106, 0.35);">
                        <div style="position: absolute; right: -20px; bottom: -20px; opacity: 0.12; pointer-events: none;">
                            <img src="<?php echo esc_url($logo_url); ?>" alt="" width="160" height="160" style="width: 160px; height: 160px; object-fit: contain;" />
                        </div>

                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <img src="<?php echo esc_url($logo_url); ?>" alt="SIBACOM" width="38" height="38" style="height: 38px; width: 38px; border-radius: 6px; object-fit: contain; background: #03326A; padding: 2px;" />
                                <div>
                                    <div style="font-weight: 900; font-size: 1.1rem; letter-spacing: 0.02em;">SIBACOM 2026</div>
                                    <div style="font-size: 0.68rem; color: #38BDF8; font-weight: 700; text-transform: uppercase;">Power to Progress</div>
                                </div>
                            </div>
                            <span style="background: #079B58; color: #FFFFFF; font-size: 0.72rem; font-weight: 800; padding: 3px 10px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.05em;">VIP PASS</span>
                        </div>

                        <div style="margin-bottom: 1rem;">
                            <div style="font-size: 0.72rem; color: #94A3B8; text-transform: uppercase; letter-spacing: 0.05em;"><?php esc_html_e('Contestant Name', 'sibacom'); ?></div>
                            <div style="font-size: 1.25rem; font-weight: 800; color: #FFFFFF;">Muhammad Hamza &bull; Team Algorists</div>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; font-size: 0.85rem; border-top: 1px solid rgba(255,255,255,0.12); padding-top: 0.75rem;">
                            <div>
                                <span style="font-size: 0.68rem; color: #94A3B8; display: block;"><?php esc_html_e('Registered Track:', 'sibacom'); ?></span>
                                <strong style="color: #FBBF24;">Programming Challenge</strong>
                            </div>
                            <div>
                                <span style="font-size: 0.68rem; color: #94A3B8; display: block;"><?php esc_html_e('University Delegation:', 'sibacom'); ?></span>
                                <strong>Sukkur IBA University</strong>
                            </div>
                        </div>

                        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1.25rem; padding-top: 0.75rem; border-top: 1px dashed rgba(255,255,255,0.2);">
                            <span style="font-size: 0.75rem; color: #94A3B8; font-family: monospace;">BARCODE: ||| | | |||| | |||</span>
                            <span style="font-size: 0.78rem; font-weight: 700; color: #34D399;"><i class="fa-solid fa-shield-check" style="margin-right: 4px;"></i><?php esc_html_e('Dues Paid &bull; PKR 500', 'sibacom'); ?></span>
                        </div>
                    </div>

                    <div style="margin-top: 1.5rem; display: flex; gap: 0.75rem;">
                        <button type="button" class="sibacom-btn sibacom-btn-secondary" onclick="alert('Official SIBACOM Pass downloaded successfully.');" style="flex: 1; justify-content: center; font-size: 0.88rem;">
                            <i class="fa-solid fa-download"></i> <?php esc_html_e('Save Badge PDF', 'sibacom'); ?>
                        </button>
                        <a href="<?php echo esc_url(home_url('/schedule/')); ?>" class="sibacom-btn sibacom-btn-primary" style="flex: 1; justify-content: center; font-size: 0.88rem;">
                            <i class="fa-solid fa-clock"></i> <?php esc_html_e('View Session Timing', 'sibacom'); ?>
                        </a>
                    </div>
                </div>

            </div>
        </div>

        <!-- ================= TAB 2: STAFF & SECRETARIAT PORTAL ================= -->
        <div id="tab-staff" class="sibacom-portal-view" style="display: none;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem;">
                
                <!-- Staff Authentication -->
                <div class="neu-card" style="padding: 2.5rem 2rem; border-radius: 20px;">
                    <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 1px solid var(--sibacom-border);">
                        <div style="background: #03326A; padding: 3px; border-radius: 10px; box-shadow: 0 4px 12px rgba(3, 50, 106, 0.3); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <img src="<?php echo esc_url($logo_url); ?>" alt="SIBACOM Logo" width="44" height="44" style="height: 44px; width: 44px; aspect-ratio: 1/1; border-radius: 7px; object-fit: contain; display: block;" />
                        </div>
                        <div>
                            <h3 style="margin: 0; font-size: 1.25rem; color: #102E68; font-weight: 800;"><?php esc_html_e('Staff & Jury Desk', 'sibacom'); ?></h3>
                            <span style="font-size: 0.78rem; color: var(--sibacom-text-secondary);"><?php esc_html_e('Secretariat accreditation & check-in console', 'sibacom'); ?></span>
                        </div>
                    </div>

                    <form onsubmit="event.preventDefault(); window.sibacomSimulateLogin('staff');" style="display: flex; flex-direction: column; gap: 1.15rem;">
                        <div>
                            <label style="display: block; font-size: 0.88rem; font-weight: 700; margin-bottom: 0.35rem; color: var(--sibacom-text-primary);">
                                <?php esc_html_e('Official Staff ID / Faculty Portal Account:', 'sibacom'); ?>
                            </label>
                            <input type="text" id="staff-id" value="STAFF-CSE-2026-04" required style="width: 100%; padding: 0.75rem 1rem; border-radius: 10px; border: 1px solid var(--sibacom-border); background: #FFFFFF; font-size: 0.95rem; font-family: inherit;" />
                        </div>

                        <div>
                            <label style="display: block; font-size: 0.88rem; font-weight: 700; margin-bottom: 0.35rem; color: var(--sibacom-text-primary);">
                                <?php esc_html_e('Accreditation Access Key:', 'sibacom'); ?>
                            </label>
                            <input type="password" id="staff-key" value="••••••••••••" required style="width: 100%; padding: 0.75rem 1rem; border-radius: 10px; border: 1px solid var(--sibacom-border); background: #FFFFFF; font-size: 0.95rem; font-family: inherit;" />
                        </div>

                        <button type="submit" class="sibacom-btn sibacom-btn-primary" style="width: 100%; justify-content: center; padding: 0.85rem; margin-top: 0.5rem; background: linear-gradient(135deg, #102E68 0%, #03326A 100%);">
                            <i class="fa-solid fa-lock-open" style="margin-right: 6px;"></i>
                            <span><?php esc_html_e('Authenticate Secretariat Desk', 'sibacom'); ?></span>
                        </button>
                    </form>
                </div>

                <!-- Staff Operations Dashboard -->
                <div class="neu-card" style="padding: 2.5rem 2rem; border-radius: 20px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                        <h4 style="margin: 0; font-size: 1.1rem; color: var(--sibacom-primary); font-weight: 800;"><?php esc_html_e('Campus Desk Live Check-In', 'sibacom'); ?></h4>
                        <span style="font-size: 0.75rem; background: rgba(7, 155, 88, 0.1); color: #079B58; padding: 3px 8px; border-radius: 6px; font-weight: 700;">Desk 01 • Main Foyer</span>
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                        <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.85rem 1rem; background: #FFFFFF; border-radius: 10px; border: 1px solid var(--sibacom-border);">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <img src="<?php echo esc_url($logo_url); ?>" alt="SIBACOM" width="30" height="30" style="height: 30px; width: 30px; border-radius: 6px; object-fit: contain; background: #03326A; padding: 2px;" />
                                <div>
                                    <strong style="font-size: 0.88rem; color: var(--sibacom-text-primary);">Hamza Sheikh</strong>
                                    <span style="font-size: 0.75rem; color: var(--sibacom-text-secondary); display: block;">Track 06: Programming Challenge</span>
                                </div>
                            </div>
                            <span style="font-size: 0.75rem; color: #079B58; font-weight: 800;"><i class="fa-solid fa-check"></i> Checked-In</span>
                        </div>

                        <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.85rem 1rem; background: #FFFFFF; border-radius: 10px; border: 1px solid var(--sibacom-border);">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <img src="<?php echo esc_url($logo_url); ?>" alt="SIBACOM" width="30" height="30" style="height: 30px; width: 30px; border-radius: 6px; object-fit: contain; background: #03326A; padding: 2px;" />
                                <div>
                                    <strong style="font-size: 0.88rem; color: var(--sibacom-text-primary);">Ayesha Tariq &bull; Team RoboVolt</strong>
                                    <span style="font-size: 0.75rem; color: var(--sibacom-text-secondary); display: block;">Track 03: Robo War Arena</span>
                                </div>
                            </div>
                            <span style="font-size: 0.75rem; color: #079B58; font-weight: 800;"><i class="fa-solid fa-check"></i> Checked-In</span>
                        </div>

                        <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.85rem 1rem; background: #FFFFFF; border-radius: 10px; border: 1px solid var(--sibacom-border);">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <img src="<?php echo esc_url($logo_url); ?>" alt="SIBACOM" width="30" height="30" style="height: 30px; width: 30px; border-radius: 6px; object-fit: contain; background: #03326A; padding: 2px;" />
                                <div>
                                    <strong style="font-size: 0.88rem; color: var(--sibacom-text-primary);">Zain Ali &bull; Team SkyGlider</strong>
                                    <span style="font-size: 0.75rem; color: var(--sibacom-text-secondary); display: block;">Track 04: Drone Competition</span>
                                </div>
                            </div>
                            <span style="font-size: 0.75rem; color: #F59E0B; font-weight: 800;"><i class="fa-solid fa-hourglass-half"></i> Pending Desk Scan</span>
                        </div>
                    </div>

                    <div style="margin-top: 1.5rem; text-align: center;">
                        <button type="button" class="sibacom-btn sibacom-btn-secondary" onclick="alert('Staff QR scanner initialized.');" style="width: 100%; justify-content: center;">
                            <i class="fa-solid fa-qrcode"></i> <?php esc_html_e('Launch Camera Badge Scanner', 'sibacom'); ?>
                        </button>
                    </div>
                </div>

            </div>
        </div>

        <!-- ================= TAB 3: PAYMENT VERIFICATION & REGISTRATION CONFIRMATION ================= -->
        <div id="tab-verification" class="sibacom-portal-view" style="display: none;">
            <div style="max-width: 780px; margin: 0 auto;">
                
                <div class="neu-card" style="padding: 2.5rem 2rem; border-radius: 20px;">
                    <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 1px solid var(--sibacom-border);">
                        <div style="background: #03326A; padding: 4px; border-radius: 12px; box-shadow: 0 4px 12px rgba(3, 50, 106, 0.3); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <img src="<?php echo esc_url($logo_url); ?>" alt="SIBACOM Logo" width="50" height="50" style="height: 50px; width: 50px; aspect-ratio: 1/1; border-radius: 8px; object-fit: contain; display: block;" />
                        </div>
                        <div>
                            <h3 style="margin: 0; font-size: 1.35rem; color: var(--sibacom-primary); font-weight: 800;"><?php esc_html_e('Registration Confirmation & Fee Verification', 'sibacom'); ?></h3>
                            <span style="font-size: 0.82rem; color: var(--sibacom-text-secondary);"><?php esc_html_e('Track submission status, bank deposit receipt, and university invoice', 'sibacom'); ?></span>
                        </div>
                    </div>

                    <!-- Search by Tracking Code -->
                    <div style="display: flex; gap: 10px; margin-bottom: 2rem; flex-wrap: wrap;">
                        <input type="text" id="verify-tracking-input" value="SIB-2026-9841" placeholder="<?php esc_attr_e('Enter Tracking ID (e.g. SIB-2026-9841)', 'sibacom'); ?>" style="flex: 1; min-width: 240px; padding: 0.85rem 1rem; border-radius: 10px; border: 1px solid var(--sibacom-border); background: #FFFFFF; font-size: 0.95rem; font-family: monospace; font-weight: 700;" />
                        <button type="button" class="sibacom-btn sibacom-btn-primary" onclick="window.sibacomLookupTracking();">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <span><?php esc_html_e('Verify Status', 'sibacom'); ?></span>
                        </button>
                    </div>

                    <!-- Result Verified Slip -->
                    <div id="verify-result-box" style="background: #FFFFFF; border: 2px dashed #03326A; border-radius: 16px; padding: 2rem; position: relative; box-shadow: 0 8px 25px rgba(0,0,0,0.04);">
                        
                        <!-- Official SIBACOM Watermark & Header -->
                        <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 1.25rem; border-bottom: 1px solid var(--sibacom-border); margin-bottom: 1.25rem; flex-wrap: wrap; gap: 1rem;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="background: #03326A; padding: 3px; border-radius: 8px; display: inline-flex;">
                                    <img src="<?php echo esc_url($logo_url); ?>" alt="SIBACOM" width="40" height="40" style="height: 40px; width: 40px; aspect-ratio: 1/1; border-radius: 6px; object-fit: contain; display: block;" />
                                </div>
                                <div>
                                    <div style="font-weight: 900; font-size: 1.15rem; color: #03326A; line-height: 1.1;">SIBACOM 2026</div>
                                    <div style="font-size: 0.72rem; color: #079B58; font-weight: 700; text-transform: uppercase;">POWER TO PROGRESS &bull; OFFICIAL RECEIPT</div>
                                </div>
                            </div>
                            <div style="text-align: right;">
                                <span style="background: rgba(7, 155, 88, 0.1); color: #079B58; border: 1px solid rgba(7, 155, 88, 0.3); font-size: 0.78rem; font-weight: 800; padding: 4px 12px; border-radius: 20px; text-transform: uppercase;">
                                    <i class="fa-solid fa-circle-check"></i> <?php esc_html_e('Payment Confirmed', 'sibacom'); ?>
                                </span>
                            </div>
                        </div>

                        <!-- Data Fields Grid -->
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.25rem; font-size: 0.9rem; margin-bottom: 1.5rem;">
                            <div>
                                <span style="font-size: 0.75rem; color: var(--sibacom-text-secondary); display: block; text-transform: uppercase; font-weight: 700;"><?php esc_html_e('Tracking Reference', 'sibacom'); ?></span>
                                <strong style="font-family: monospace; color: var(--sibacom-primary); font-size: 1.05rem;">SIB-2026-9841</strong>
                            </div>
                            <div>
                                <span style="font-size: 0.75rem; color: var(--sibacom-text-secondary); display: block; text-transform: uppercase; font-weight: 700;"><?php esc_html_e('Registered Track', 'sibacom'); ?></span>
                                <strong>Circuit Design &bull; Track 01</strong>
                            </div>
                            <div>
                                <span style="font-size: 0.75rem; color: var(--sibacom-text-secondary); display: block; text-transform: uppercase; font-weight: 700;"><?php esc_html_e('Delegation', 'sibacom'); ?></span>
                                <strong>Mehran UET Jamshoro</strong>
                            </div>
                            <div>
                                <span style="font-size: 0.75rem; color: var(--sibacom-text-secondary); display: block; text-transform: uppercase; font-weight: 700;"><?php esc_html_e('Audited Fee Paid', 'sibacom'); ?></span>
                                <strong style="color: #079B58; font-size: 1.05rem;">PKR 500 / Team</strong>
                            </div>
                        </div>

                        <!-- Verification Footer -->
                        <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--sibacom-border); padding-top: 1rem; font-size: 0.78rem; color: var(--sibacom-text-secondary); flex-wrap: wrap; gap: 0.5rem;">
                            <span><?php esc_html_e('Verified by SIBACOM Treasury & Desk Secretariat on 04 Nov 2026', 'sibacom'); ?></span>
                            <button type="button" class="sibacom-btn sibacom-btn-secondary" onclick="window.print();" style="padding: 0.4rem 0.9rem; font-size: 0.78rem;">
                                <i class="fa-solid fa-print"></i> <?php esc_html_e('Print Formal Slip', 'sibacom'); ?>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
// Portal Interactive Switcher
document.addEventListener('DOMContentLoaded', function () {
    var tabs = document.querySelectorAll('.sibacom-portal-tab-btn');
    var views = document.querySelectorAll('.sibacom-portal-view');

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            var target = this.getAttribute('data-tab');

            tabs.forEach(function (t) {
                t.classList.remove('active');
                t.setAttribute('aria-selected', 'false');
                t.style.background = 'transparent';
                t.style.color = 'var(--sibacom-text-primary)';
            });

            views.forEach(function (v) {
                v.style.display = 'none';
                v.classList.remove('active');
            });

            this.classList.add('active');
            this.setAttribute('aria-selected', 'true');
            this.style.background = 'var(--sibacom-primary)';
            this.style.color = '#FFFFFF';

            var activeView = document.getElementById('tab-' + target);
            if (activeView) {
                activeView.style.display = 'block';
                activeView.classList.add('active');
            }
        });
    });

    // Style the initial active tab
    var initialActive = document.querySelector('.sibacom-portal-tab-btn.active');
    if (initialActive) {
        initialActive.style.background = 'var(--sibacom-primary)';
        initialActive.style.color = '#FFFFFF';
    }
});

window.sibacomSimulateLogin = function (role) {
    alert('Authentication successful for ' + role.toUpperCase() + ' portal! Active session verified by SIBACOM Security.');
};

window.sibacomLookupTracking = function () {
    var input = document.getElementById('verify-tracking-input');
    var code = (input && input.value ? input.value : '').trim().toUpperCase();
    if (!code) {
        alert('Please enter a valid tracking reference (e.g. SIB-2026-9841).');
        return;
    }
    var box = document.getElementById('verify-result-box');
    if (box) {
        box.style.opacity = '0.5';
        setTimeout(function () {
            box.style.opacity = '1';
            alert('Verification record confirmed for ' + code + ': Dues settled and badge activated.');
        }, 300);
    }
};
</script>
<?php
get_footer();

