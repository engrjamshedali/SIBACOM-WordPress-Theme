# SIBACOM – Full Elementor Pro Visual Editing Guide

The **SIBACOM** event website is engineered for **100% visual editability** through **Elementor Pro** and **Elementor Free**. You never need to touch PHP, HTML, or CSS to modify headings, images, cards, colors, typography, or responsive layouts.

---

## 1. Importing the Pre-Built Elementor JSON Templates

The template includes 11 professionally-crafted Elementor JSON templates located in the `/elementor-templates/` directory:

1. `header.json` – Sticky Neumorphic Header with official university & society logos, nav menu, and CTA button.
2. `footer.json` – Institutional Footer with 4 columns, governance links, social links, and copyright text.
3. `home.json` – Complete 13-Section Homepage featuring Hero, 6 Event Info Cards, Events & Pricing, Highlights, About, Schedule, Speakers, Guests, Organizers, Sponsors, FAQs, Final CTA Banner, and Contact.
4. `about.json` – Dedicated About SIBACOM template with mission, vision, and campus highlights.
5. `events.json` – Dedicated Events & Competitions template with pricing tags, status badges, and external CTAs.
6. `schedule.json` – Dedicated Event Schedule Timeline template with interactive filters.
7. `speakers.json` – Dedicated Speakers and Adjudication Jury gallery template.
8. `guests.json` – Dedicated Dignitaries, Vice Chancellors, and Chief Guests template.
9. `organizers.json` – Institutional Organizing Bodies and Committee members template.
10. `sponsors.json` – Categorized Sponsor and Partner showcase template.
11. `contact.json` – Secretariat Contact and Directional Map template.

### How to Import Templates into Elementor:
1. Navigate to **Templates > Saved Templates** in your WordPress Admin.
2. Click **Import Templates** at the top.
3. Choose any `.json` file from `sibacom-wordpress/elementor-templates/` and click **Import Now**.
4. The template will now appear in your Elementor library, ready to be inserted into any page or assigned via the Theme Builder!

---

## 2. Opening and Editing Any Page with Elementor

1. Go to **Pages > All Pages** in your WordPress dashboard.
2. Hover over the page you want to customize (e.g. **Home**, **Events & Competitions**, or **Speakers & Judges**) and click **Edit with Elementor**.
3. The visual drag-and-drop editor will open.

### Customizing Frontend Elements:
- **Headings & Text:** Click directly on any text block on the screen to change words, font size, weight, line height, or letter spacing.
- **Logos & Images:** Click on any logo or photo. In the left panel, click the image thumbnail to replace it with any file from your WordPress Media Library.
- **Buttons & External URLs:** Click any button (e.g., "Register Now"). In the left panel, update the **Link** field to your preferred external registration form, Google Form, or event ticketing portal.
- **Colors & Neumorphic Shadows:** Switch to the **Style** tab in the left panel to modify background colors, gradients, soft UI box-shadows, or border radii.
- **Responsive Views (Desktop, Tablet, Mobile):** Click the **Responsive Mode** icon in the bottom panel of Elementor to preview and adjust margins, font sizes, and card padding specifically for mobile devices and tablets.

---

## 3. Dedicated SIBACOM Custom Elementor Widgets (15 Widgets)

When editing any page with Elementor, scroll down the left widget panel to find the **SIBACOM Elements** category containing 15 dedicated event widgets:

| Widget Name | Widget ID | Primary Controls & Tabs |
| :--- | :--- | :--- |
| **SIBACOM Hero Banner** | `sibacom_hero` | Title ("SIBACOM"), edition ("'26"), headline, campus background image, countdown target date, dual CTAs, badge text, styling controls. |
| **SIBACOM Event Information** | `sibacom_info` | 6 Neumorphic Event Info Cards (Date, Venue, Deadline, Category, Participation, Status) with custom overrides and card styling. |
| **SIBACOM Events & Pricing** | `sibacom_events` | Data source (Dynamic CPT vs Manual Repeater), category filter, column selector (2, 3, 4), pricing badges, live status pills, custom external CTA urls. |
| **SIBACOM Highlights Grid** | `sibacom_highlights` | Interactive repeater to add, edit, or reorder competitive tracks (icons, titles, descriptions, and badges) with soft UI hover effects. |
| **SIBACOM About Narrative** | `sibacom_about` | Narrative lead, vision, mission, and 4 quantitative metric counters with typography and color styling. |
| **SIBACOM Schedule Timeline** | `sibacom_schedule` | Chronological schedule timeline with day filters (All Days, Day 1, Day 2, Day 3), venue tags, speaker names, and session limit controls. |
| **SIBACOM Speakers Grid** | `sibacom_speakers` | Profile cards showing photos, names, designations, organizations, keynote topics, social links, and category filters. |
| **SIBACOM Guests & Dignitaries**| `sibacom_guests` | Portrait cards for Chief Guests, Vice Chancellors, and institutional patrons with emerald badges and border controls. |
| **SIBACOM Organizers Grid** | `sibacom_organizers`| Multi-tier display mode: Dynamic, Joint Organizers Only (CSE Society & EE Society side-by-side with equal prominence), Academic Partners Only (Dept of CSE & Dept of EE), or Manual Repeater. Controls for Section Titles, Subtitles, Badges, and Max Logo Height slider (40px–180px). |
| **SIBACOM Sponsor Gallery** | `sibacom_sponsors` | Tiered partner gallery (Title Sponsor, Gold, Silver, Supporting, Academic) with logo filters and order controls. |
| **SIBACOM FAQ Accordion** | `sibacom_faq` | Smooth expandable FAQ accordion pulling questions dynamically from CPT or custom manual repeater with icon styling. |
| **SIBACOM Final CTA Banner** | `sibacom_cta_banner`| High-conversion full-width gradient banner with badge, title, description, and external Register button. |
| **SIBACOM Contact Information**| `sibacom_contact` | Official secretariat physical address, support email, telephone, and location details. |
| **SIBACOM Event Countdown** | `sibacom_countdown` | Standalone real-time countdown timer to target event date with box shadows and digit colors. |
| **SIBACOM Social Links** | `sibacom_social` | Circular soft UI social icons for LinkedIn, Twitter/X, Facebook, Instagram, YouTube, and GitHub. |

---

## 4. Theme Builder Header & Footer Assignment (Elementor Pro)

If you are using **Elementor Pro**:
1. Go to **Templates > Theme Builder**.
2. Click **Header** > **Add New** (or select the imported `SIBACOM Sticky Header`).
3. Click **Publish** and add the display condition: **Entire Site**.
4. Repeat for **Footer** > **Add New** (or select `SIBACOM Global Footer`) and set display condition to **Entire Site**.
5. Your custom Elementor header and footer will now seamlessly render across every page of the website!
