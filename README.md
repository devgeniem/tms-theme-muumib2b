# TMS MuumiB2B Theme

This document focuses on:
- page templates
- ACF flexible content layouts (components)
- runtime functionality related to those layouts
- password-protected content behavior
- site-wide settings page

## Overview

The theme is built with DustPress models + Dust templates + ACF flexible content.

## Page templates and model classes

The main content templates are implemented as model classes under `models/`:

- `models/page-front-page.php`
	- Template Name: `Etusivu`
	- Class: `PageFrontPage`
	- Uses front page specific layout set.

- `models/page.php`
	- Class: `Page`
	- Extends `PageExtend`.
	- Generic content page template behavior.

- `models/page-exhibition-one.php`
	- Template Name: `The door is always open -nayttely`
	- Class: `PageExhibitionOne`

- `models/page-exhibition-two.php`
	- Template Name: `Moomins Sea Adventure -nayttely`
	- Class: `PageExhibitionTwo`

- `models/page-exhibition-three.php`
	- Template Name: `Moomin Animations -nayttely`
	- Class: `PageExhibitionThree`

## Layout registration and availability

Layouts are registered as ACF flexible content rows in group classes:
- `lib/ACF/FrontPageGroup.php`
- `lib/ACF/PageGroup.php`
- `lib/ACF/ExhibitionOneGroup.php`
- `lib/ACF/ExhibitionTwoGroup.php`
- `lib/ACF/ExhibitionThreeGroup.php`

Layout classes are in `lib/ACF/Layouts/` and rendered in `partials/layouts/`.

### Front-end JS behaviors used by layouts

Global JS controllers are initialized by `assets/scripts/theme.js`.
Layout-driven behavior includes, for example:
- accordion interactions (`assets/scripts/accordion.js`)
- image carousel modal/slider behavior (`assets/scripts/image-carousel.js`)
- map lazy load toggle (`assets/scripts/map-layout.js`)
- countdown behavior (`assets/scripts/countdown.js`)
- modularity embedding behavior (`assets/scripts/modularity-layout.js`)
- rolling text behavior (`assets/scripts/rolling-text.js`)
- Gravity Forms compatibility patch (`assets/scripts/gravity-forms-patch.js`)

## Password-protected pages and custom login view

Password-protected content is explicitly handled in page templates.

Behavior:
- If `post_password_required()` is true (`models/page-extend.php`), normal layout rendering is skipped.
- Instead, a custom password hero view is rendered:
	- `partials/views/page/page-password-hero.dust`
	- contains custom visual hero + input form
	- uses `partials/ui/password_form.dust`
- Password form submits to:
	- `wp-login.php?action=postpass`
	- from `PageExtend::password_form_action()`

Customizable via site ACF-settings:
- `password_page_hero_img`
- `password_page_info_text`

## Site-wide settings page

The theme has a custom site-wide settings page implemented as a custom post type.

### ACF settings UI

Settings field group: `lib/ACF/SettingsGroup.php`

Main tabs include:
- Header settings
- Footer settings
- Map settings
- Social media settings
- 404 settings
- Archive settings
- Page settings
- Exception notice settings
- Sitemap settings
- Chat settings
- Password page settings
