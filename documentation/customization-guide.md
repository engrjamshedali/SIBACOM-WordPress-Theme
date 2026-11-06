# SIBACOM – Customization & Design System Guide

This guide details the **Neumorphic UI design system**, color palette, typography hierarchy, custom shortcodes, and brand guidelines for **SIBACOM – Sukkur IBA University**.

---

## 1. Official Color Palette & CSS Variables

The theme and companion plugin utilize standard CSS custom properties defined in `:root`. You can override these in **Appearance > Customize > SIBACOM Design & Colors** or via custom CSS:

| Token | Hex Value | Purpose / Application |
| :--- | :--- | :--- |
| `--sibacom-primary` | `#173F91` | Primary Royal Blue: Main brand identity, buttons, icons, headings |
| `--sibacom-navy` | `#102E68` | Deep Navy: Dark accents, footer backgrounds, secondary text |
| `--sibacom-techgreen` | `#079B58` | Technology Green: Live status badges, accents, button hovers |
| `--sibacom-bg` | `#F4F6FA` | Background: Soft neutral surface for Neumorphic shadows |
| `--sibacom-white` | `#FFFFFF` | Surface White: Card surfaces, header background |
| `--sibacom-text-primary` | `#17233D` | Primary Text: Headings and high-contrast titles |
| `--sibacom-text-secondary`| `#64748B` | Secondary Text: Body paragraphs, descriptions, metadata |

---

## 2. Neumorphic UI Shadow Tokens

The design system incorporates mathematically calibrated soft shadows to create depth, elevation, and tactile surfaces without overusing heavy skeuomorphism:

```css
/* Neumorphic Flat Card */
--neu-flat: 4px 4px 12px rgba(163, 177, 198, 0.28), -4px -4px 12px #FFFFFF;

/* Neumorphic Raised Card (Default) */
--neu-raised: 8px 8px 20px rgba(163, 177, 198, 0.38), -8px -8px 20px #FFFFFF;

/* Neumorphic Hover Elevation */
--neu-hover: 12px 12px 28px rgba(163, 177, 198, 0.48), -12px -12px 28px #FFFFFF;

/* Inset Shadow (Pressed Buttons / Form Fields) */
--neu-inset: inset 3px 3px 6px rgba(163, 177, 198, 0.35), inset -3px -3px 6px #FFFFFF;

/* Royal Blue Button Glow */
--neu-glow-primary: 0 10px 25px -5px rgba(23, 63, 145, 0.4);

/* Tech Green Button Glow */
--neu-glow-green: 0 10px 25px -5px rgba(7, 155, 88, 0.4);
```

---

## 3. Typography Standards

- **Primary Body Font:** `Inter` (Font weights: 400 Regular, 500 Medium, 600 Semi-Bold, 700 Bold).
- **Headings & Display Font:** `Manrope` (Font weights: 600 Semi-Bold, 700 Bold, 800 Extra-Bold).
- **Enqueued via Google Fonts:** Handled automatically in `inc/theme-setup.php` without third-party plugins.

---

## 4. Official Branding & Organizational Hierarchy Rules

SIBACOM adheres to a strict organizational hierarchy that must be respected across all pages, templates, and promotional materials:

1. **INSTITUTIONAL IDENTITY:**
   - **Sukkur IBA University** serves as the overarching institutional host. The official university crest must be preserved in authentic colors, properly proportioned, and positioned respectfully in the header, footer, and institutional sections.
2. **JOINT PRIMARY ORGANIZERS:**
   - **Computer Systems Engineering Society (CSE Society)**
   - **Electrical Engineering Society (EE Society)**
   - These two societies are the co-equal primary organizers of SIBACOM. Neither society may be presented as the sole organizer. Both must receive equal visual prominence, equal display dimensions, and equal prominence on desktop, tablet, and mobile layouts.
3. **SUPPORTING ACADEMIC PARTNERS:**
   - **Department of Computer Systems Engineering**
   - **Department of Electrical Engineering**
   - The departments provide academic oversight, curriculum alignment, and technical jury evaluation. They are supporting academic partners and must never be labeled as the primary event organizers or confused with the student societies.
4. **Strict Asset Preservation Guidelines:**
   - **Never recreate or redraw official logos:** Always use official SVG or high-resolution PNG/JPG files.
   - **Never distort aspect ratios:** All logo wrappers enforce `object-fit: contain` and strict max-height constraints.
   - **Never recolor official logos:** Official emblems must remain in their authentic, certified colors.
   - **No blurring, opacity, or transparency modifications:** All badges and logos must render sharply.

---

## 5. Shortcode Reference Table

All sections can be embedded anywhere across WordPress and Elementor via standard shortcodes:

| Shortcode | Parameters | Output |
| :--- | :--- | :--- |
| `[sibacom_hero]` | `title`, `headline`, `dates`, `venue`, `cta_url`, `countdown_date` | Complete Hero Section with campus background and countdown |
| `[sibacom_countdown]` | `target_date` (e.g. `2026-11-20T09:00:00`) | Standalone 4-unit countdown clock (Days, Hours, Mins, Secs) |
| `[sibacom_joint_organizers]` | `badge`, `title`, `subtitle` | Dedicated "JOINTLY ORGANIZED BY" 2-column grid featuring CSE Society & EE Society with equal visual prominence |
| `[sibacom_academic_partners]`| `badge`, `title`, `subtitle` | Dedicated "ACADEMIC PARTNERS" section featuring Dept of CSE & Dept of EE with academic styling |
| `[sibacom_organizers]` | `mode` (`all`, `joint_only`, `academic_only`) | Complete multi-tier hierarchy: Joint Primary Organizers, Academic Partners, Host University, and Student Council |
| `[sibacom_highlights]` | None | 6 Neumorphic cards of official Olympiad tracks |
| `[sibacom_about]` | None | About narrative, joint society vision, mission, and 4 metric counters |
| `[sibacom_schedule]` | `day` (`1`, `2`, `3`), `limit` (e.g. `6` or `-1`) | Chronological schedule timeline |
| `[sibacom_speakers]` | `limit` (e.g. `6` or `-1`) | Speaker and jury profile grid with topics & social links |
| `[sibacom_sponsors]` | None | Tiered sponsor and partner gallery |
| `[sibacom_faq]` | None | Expandable Neumorphic FAQ accordion |
| `[sibacom_contact]` | None | Secretariat address, support email, and phone cards |

