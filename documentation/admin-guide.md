# SIBACOM Website Manager – Admin Dashboard Guide

The **SIBACOM Website Manager** companion plugin provides an exhaustive, centralized administration architecture directly within WordPress to manage all structured event data, competitive modules, registration fee rules, speakers, and Elementor widgets without modifying code.

---

## 1. Complete 17-Item SIBACOM Admin Menu Structure

Once the plugin is activated, you will see the top-level **SIBACOM** menu in the WordPress admin sidebar containing 17 dedicated submenus:

```
SIBACOM
├── 1. Dashboard Overview      # Event metrics, competition counts, quick shortcuts
├── 2. General Settings        # Event name, dates, venue, 4 institutional logos
├── 3. Homepage Manager        # Section visibility toggles for all 13 sections
├── 4. Event Information       # The 6 Neumorphic Event Information Cards
├── 5. Event Pricing & Status  # Competitive categories CPT, pricing badges, status, CTAs
├── 6. Highlights Manager      # 6 Olympiad competitive pillar cards & icons
├── 7. Event Schedule          # Event session agenda CPT with timeline & venues
├── 8. Distinguished Speakers  # Keynote speakers, judges, trainers CPT & photos
├── 9. Guests & Dignitaries    # Patrons, vice chancellors, chief guests directory
├── 10. Organizing Committee   # Joint Organizers (CSE & EE Societies), Academic Partners, Sukkur IBA
├── 11. Sponsors & Partners    # Tiered industry sponsor gallery CPT
├── 12. FAQ Accordion          # Frequently asked questions CPT & categories
├── 13. Contact Secretariat    # Physical coordinates, helpline, inquiry dispatch
├── 14. Social Media Profiles  # LinkedIn, Twitter/X, Facebook, Instagram, YouTube, GitHub
├── 15. Footer Settings        # Governance text, copyright notice, footer narrative
├── 16. Elementor Components   # Visual registry of all 15 native Elementor widgets
├── 17. Documentation          # Integrated administrator handbook & developer docs
└── Demo Importer              # One-click complete site setup & page seeder
```

---

## 2. Comprehensive Admin Modules Walkthrough

### 1. Dashboard Overview (`SIBACOM > Dashboard`)
- Real-time event statistics: Total competitions, scheduled tracks, registered speakers, honorary dignitaries, confirmed sponsors, and active FAQs.
- Quick action shortcuts to add new competitions, sessions, speakers, and sponsors.
- System environment checks confirming Elementor Pro integration and PHP settings.

### 2. General Settings (`SIBACOM > General Settings`)
- **Official Event Name:** Standardized strictly to `SIBACOM` (uppercase, one word).
- **Event Tagline:** Official subtitle (e.g. `Connecting Ideas. Empowering Innovation. Building Tomorrow.`).
- **Dates & Location:** Human-readable dates and campus address (`Airport Road, Sukkur, Sindh, Pakistan`).
- **Official Registration Portal & CTA Button:**
  - **Enable/Disable Button:** Toggle the display of the primary register button in header and mobile drawer.
  - **Button Text:** Fully customizable label (e.g. `Register Now`, `Register for Event`, `Get Your Pass`).
  - **Registration URL / Link:** Destination link (e.g. `https://iba-suk.edu.pk/sibacom/register` or external Google Form / ticketing portal).
  - **Target Behavior:** Choose between opening in a new tab (`_blank`) or same tab (`_self`).
  - **Live Synchronization:** Changes apply automatically across the Header, Mobile Drawer, Hero Banner, Competitions Portal, Individual Competition Cards, Fee Calculator, Modal Dialogs, and Pre-Footer CTA Banner.
  - *Note:* Also fully editable in real-time under `Appearance > Customize > SIBACOM Registration & CTA Button`.
- **Official Logo Replacement Controls (Media Library Uploader):**
  1. **Sukkur IBA University Official Seal:** Primary institutional color logo.
  2. **Sukkur IBA University White / Monochrome Seal:** Inverted logo for dark footers.
  3. **CSE Society Official Logo:** Joint Primary Organizer (Computer Systems Engineering).
  4. **EE Society Official Logo:** Joint Primary Organizer (Electrical Engineering).
  5. **Department of Computer Systems Engineering (CSE) Logo:** Supporting Academic Partner.
  6. **Department of Electrical Engineering (EE) Logo:** Supporting Academic Partner.
  7. **Sukkur IBA Student Council (SISC) Logo:** Student governance council.
  - All logos are constrained with proportional scaling (`object-fit: contain`) across the header, organizer cards, and footer, ensuring 100% equal visual prominence.

### 3. Homepage Manager (`SIBACOM > Homepage Manager`)
- Individual master on/off toggles for all 13 sections on the homepage:
  1. Hero Section
  2. Event Information Cards (6 Cards)
  3. Event Registration and Pricing Section
  4. Event Highlights
  5. About SIBACOM
  6. Schedule Preview
  7. Featured Speakers
  8. Guests & Dignitaries
  9. Jointly Organized By & Academic Partners (Organizing Bodies)
  10. Sponsors & Partners
  11. FAQ Accordion
  12. Final CTA Banner
  13. Contact Secretariat
  2. Event Information Cards (6 Cards)
  3. Event Registration and Pricing Section
  4. Event Highlights
  5. About SIBACOM
  6. Schedule Preview
  7. Featured Speakers
  8. Guests & Dignitaries
  9. Organizing Institutions
  10. Sponsors & Partners
  11. FAQ Accordion
  12. Final CTA Banner
  13. Contact Secretariat

### 4. Event Information Cards (`SIBACOM > Event Information`)
Directly controls the 6 Neumorphic Event Information Cards appearing below the Hero:
- **Card 1 (Event Date):** Label, value (`Nov 20 – 22, 2026`), subtitle, icon class.
- **Card 2 (Official Venue):** Label, value (`Sukkur IBA University`), subtitle (`Academic Block-III`), icon class.
- **Card 3 (Registration Deadline):** Label, value (`Nov 10, 2026`), subtitle (`Strict Team Cutoff`), icon class.
- **Card 4 (Competition Categories):** Label, value (`14+ Modules`), subtitle, icon class.
- **Card 5 (Participation):** Label, value (`1,500+ Innovators`), subtitle, icon class.
- **Card 6 (Registration Status):** Label, value (`Registrations Live`), subtitle, icon class.

### 5. Event Pricing & Status (`SIBACOM > Event Pricing & Status`)
Dedicated management for competitive brackets (`sibacom_event` CPT):
- **Pricing Badges:** Free Registration, PKR 500, PKR 1,000, PKR 1,500, Team Entry.
- **Registration Status Lifecycle:**
  - `Registration Not Open Yet` (Upcoming)
  - `Registration Open` (Live)
  - `Registration Closing Soon` (Urgent / Warning)
  - `Registration Closed` (Finished)
  - `Fully Booked` (Max Capacity)
- **Status Calculation Mode:**
  - **Manual Mode:** Explicit administrator override.
  - **Auto Date-Based Mode:** Automatically evaluates current date against Open and Close dates.
- **External Registration CTA:**
  - Custom destination URL for official external registration portals (e.g. Google Forms, university registration system).
  - Custom button text override.

### 6. Event Schedule Manager (`SIBACOM > Schedule`)
- Multi-day agenda management (`sibacom_session` CPT).
- Fields: Session Title, Day (1, 2, or 3), Start & End Times, Speaker/Host, Venue/Hall, Category badge, Sort order.
- Supports frontend interactive day tab filtering (All Days, Day 1, Day 2, Day 3).

### 7. Distinguished Speakers & Judges (`SIBACOM > Speakers`)
- Custom Post Type `sibacom_speaker` filtered by `role_type = 'speaker'`.
- Fields: Full Name, Professional Designation, Organization, Category (Keynote Speakers, Competition Judges, Technical Trainers), Session Topic, Biography, Portrait Photograph uploader, Social links.
- Responsive portrait cards with circular or rounded framing and `object-fit: cover`.

### 8. Guests & Dignitaries (`SIBACOM > Guests`)
- Dedicated directory for institutional patrons, Vice Chancellors, Registrars, and state dignitaries (`role_type = 'guest'`).
- Displayed with emerald dignitary badges and executive presentation cards.

### 9. Organizing Committee & Academic Partners (`SIBACOM > Organizing Committee`)
A comprehensive control panel governing the event's dual-society leadership and academic partnerships:
- **Joint Primary Organizers Section Controls:**
  - Section Badge (default: `ORGANIZATIONAL LEADERSHIP`)
  - Section Title (default: `JOINTLY ORGANIZED BY`)
  - Section Subtitle (default: `Bringing together the Computer Systems Engineering and Electrical Engineering communities.`)
  - **CSE Society Settings:** Official Name, Narrative description, Academic Affiliation badge (`Department of Computer Systems Engineering`), and logo uploader.
  - **EE Society Settings:** Official Name, Narrative description, Academic Affiliation badge (`Department of Electrical Engineering`), and logo uploader.
  - Both societies are rendered in a balanced 2-column Neumorphic grid with 100% equal visual prominence and height.
- **Academic Partners Section Controls:**
  - Section Badge (default: `ACADEMIC EXCELLENCE & SUPPORT`)
  - Section Title (default: `ACADEMIC PARTNERS`)
  - Section Subtitle (default: `Providing technical oversight, academic mentorship, and rigorous jury evaluation for all competition modules.`)
  - **Department of CSE:** Title, academic mission narrative, and focus areas.
  - **Department of EE:** Title, academic mission narrative, and focus areas.
- **Institutional Identity Controls:**
  - **Sukkur IBA University:** Host institution title, description, and accreditation badges.
- **Student Governance:**
  - **Sukkur IBA Student Council (SISC):** Advisory oversight badge and description.

### 10. Sponsors & Partners (`SIBACOM > Sponsors`)
- Tiered partner management (`sibacom_sponsor` CPT).
- Tiers: Title Sponsors, Gold Sponsors, Silver Sponsors, Supporting Partners, Technology Partners, Community Partners.
- Fields: Company Name, Tier, Website Destination Link, Transparent Logo uploader, Sort order.

### 11. FAQ Accordion Manager (`SIBACOM > FAQs`)
- Structured Q&A items (`sibacom_faq` CPT).
- Accordion header question, detailed rich-text answer, display sort order.

### 12. Social Media Profiles (`SIBACOM > Social Media`)
- Official university & event profile links for LinkedIn, Twitter/X, Facebook, Instagram, YouTube, and GitHub.
- Automatically reflected in the footer, contact section, and mobile drawer.

### 13. Footer Settings (`SIBACOM > Footer Settings`)
- Three-tier organizational footer hierarchy:
  1. **Institution:** Sukkur IBA University (with white emblem).
  2. **Joint Organizers:** CSE Society & EE Society.
  3. **Academic Partners:** Department of Computer Systems Engineering & Department of Electrical Engineering.
- Footer brand description, quick links, and copyright text.

### 14. Elementor Components (`SIBACOM > Elementor Components`)
- Interactive visual catalog displaying all 15 custom Elementor widgets, their available controls across CONTENT, STYLE, and ADVANCED tabs, and usage tips.

---

## 3. Demo Content One-Click Setup

To seed the entire website with 9 complete pages, 6 competition categories, 10 schedule sessions, 6 speakers/guests, 6 sponsors, and 6 FAQs:
1. Navigate to **SIBACOM > Demo Import** (or **Tools > Import**).
2. Click **Import SIBACOM Demo Content**.
3. All pages and menus will be populated automatically without manual data entry.
