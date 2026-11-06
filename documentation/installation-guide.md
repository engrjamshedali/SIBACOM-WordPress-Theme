# SIBACOM WordPress Event Website Template – Installation Guide

Welcome to **SIBACOM**, the premium, production-ready WordPress event website template for **Sukkur IBA University**, developed specifically for **WordPress** with complete **Elementor Pro** visual editability.

---

## 1. System Requirements

- **WordPress:** Version 5.8 or higher (Tested up to 6.7).
- **PHP:** Version 7.4 or higher (PHP 8.0, 8.1, 8.2 fully supported).
- **Page Builder:** Elementor (Free) and Elementor Pro (Recommended for Theme Builder & Form integrations).
- **Browser Compatibility:** Chrome, Edge, Safari, Firefox (Desktop, Tablet & Mobile).

---

## 2. Package Deliverables Overview

Inside the main `sibacom-wordpress` package, you have:

```
sibacom-wordpress/
├── theme/                        # Unzipped SIBACOM WordPress Theme
├── plugins/
│   └── sibacom-website-manager/  # Unzipped SIBACOM Website Manager Companion Plugin
├── elementor-templates/          # 11 Pre-built Elementor JSON Template Exports
├── demo-content/                 # WXR XML Demo Content & Options Export
├── documentation/                # Full Installation, Editing & Admin Guides
└── zips/
    ├── sibacom-theme.zip         # Installable Theme ZIP (Ready to upload)
    └── sibacom-website-manager.zip # Installable Companion Plugin ZIP (Ready to upload)
```

---

## 3. Step-by-Step Installation Instructions

### Step 1: Install the SIBACOM Theme
1. Log in to your WordPress Administrative Dashboard (`/wp-admin`).
2. Navigate to **Appearance > Themes**.
3. Click the **Add New Theme** button at the top, then click **Upload Theme**.
4. Click **Choose File** and select `sibacom-theme.zip` from the `/zips/` folder.
5. Click **Install Now**.
6. Once uploaded, click **Activate**.

---

### Step 2: Install the SIBACOM Website Manager Plugin
1. In your WordPress Admin Dashboard, navigate to **Plugins > Add New Plugin**.
2. Click **Upload Plugin** at the top.
3. Click **Choose File** and select `sibacom-website-manager.zip` from the `/zips/` folder.
4. Click **Install Now**.
5. Click **Activate Plugin**.
6. You will immediately see a prominent **SIBACOM** management menu with custom dashboard controls appear in your WordPress sidebar.

---

### Step 3: Install & Activate Elementor
1. Go to **Plugins > Add New Plugin**.
2. Search for **Elementor**.
3. Click **Install Now**, then click **Activate**.
4. (Optional but recommended) Upload and activate **Elementor Pro** to unlock the Theme Builder for visual header and footer editing.

---

### Step 4: Run the One-Click Demo Content Import
To populate the complete website with authentic Sukkur IBA University event pages, event schedules, keynote speakers, sponsor galleries, and FAQs in under 10 seconds:

1. In the WordPress sidebar, navigate to **SIBACOM > Demo Import**.
2. Click the large blue button: **Run One-Click Demo Import Now**.
3. Confirm the prompt.
4. The importer will automatically:
   - Create 9 complete pages: **Home**, **About SIBACOM**, **Events & Competitions**, **Event Schedule**, **Speakers & Judges**, **Guests & Dignitaries**, **Organizing Committee**, **Partners & Sponsors**, and **Contact Us**.
   - Configure **Home** as your static Front Page in **Settings > Reading**.
   - Create the **SIBACOM Primary Navigation** menu and assign it to the theme header.
   - Populate 6 national competitive categories with pricing badges and live status.
   - Populate 10 chronological event sessions with start/end times and hall allocations.
   - Populate 6 distinguished keynote speakers, judges, and honorary patrons.
   - Populate confirmed sponsor tiers (Sindh HEC, Systems Limited, Techlogix, PSEB, Contour, IEEE).
   - Populate 6 comprehensive FAQ accordion entries.
5. Once complete, click **View Homepage** to admire your live, fully-styled Neumorphic event website!

---

## 4. Alternative Manual Import (Optional via Tools > Import)
If your host restricts AJAX operations:
1. Go to **Tools > Import** in WordPress.
2. Select **WordPress**, then click **Install Now** and **Run Importer**.
3. Select `sibacom-demo-content.xml` located in `sibacom-wordpress/demo-content/`.
4. Click **Upload file and import**, map authors, and click **Submit**.

