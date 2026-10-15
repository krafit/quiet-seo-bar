=== Quiet SEO Bar ===
Contributors: krafit
Tags: seo, the seo framework, admin, accessibility
Requires at least: 6.5
Tested up to: 7.1
Requires PHP: 8.0
Stable tag: 1.0.0
License: GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Replaces the bold SEO Bar of The SEO Framework in admin list tables with small, accessible status shapes.

== Description ==

Quiet SEO Bar is an extension for [The SEO Framework](https://wordpress.org/plugins/autodescription/). It turns the bold SEO Bar column in your post, page, term and user lists into a row of small status shapes that fit the rest of the WordPress admin.

Each state has its own shape, so you can tell them apart without relying on colour:

* Good: green circle
* Okay: yellow triangle
* Bad: red octagon
* Unknown: hollow grey ring
* Undefined: grey dash

The six default checks are grouped as title and description, indexing to archiving, and redirect.

Everything else stays as The SEO Framework built it: hover and focus tooltips, screen reader labels, and the refresh after Quick Edit.

= Filters =

* `quiet_seo_bar_colorize_good` (bool, default `true`): return `false` to show good states in neutral grey, so only problems and warnings carry colour.
* `quiet_seo_bar_group_items` (bool, default `true`): return `false` to space all items evenly.
* `quiet_seo_bar_load` (bool): whether to use the quiet SEO Bar on the current list screen.

= CSS custom properties =

Colours and sizes are set on `.tsf-seo-bar` and can be overridden in admin CSS: `--quiet-seo-bar-good`, `--quiet-seo-bar-okay`, `--quiet-seo-bar-bad`, `--quiet-seo-bar-neutral`, `--quiet-seo-bar-size`, `--quiet-seo-bar-gap`, `--quiet-seo-bar-group-gap`.

== Installation ==

1. Install and activate The SEO Framework 5.0 or later.
2. Upload the `quiet-seo-bar` folder to `/wp-content/plugins/` and activate the plugin.

== Changelog ==

= 1.0.0 =
* Initial release: small status shapes (circle, triangle, octagon, ring, dash) instead of coloured blocks in The SEO Framework's list table SEO Bar, with grouped default items and The SEO Framework's tooltips and screen reader labels intact.
* Developer: new filters `quiet_seo_bar_colorize_good`, `quiet_seo_bar_group_items` and `quiet_seo_bar_load`, plus `--quiet-seo-bar-*` CSS custom properties.

== Screenshots ==
1. Left: The SEO Framework’s default SEO Bar with big, colourful boxes. Right: the same list with Quiet SEO Bar’s small status shapes.