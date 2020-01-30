# Changelog

## 3.9.1 _(2020-01-12)_
* Fix: Revert to apply to the `the_excerpt` filter, which was mistakenly changed to `get_the_excerpt`
* Change: Update some inline documentation relating to third-party plugin hook support
* Unit tests:
    * Change: Implement a more generic approach to capture default values provided for a filter
    * New: Add test to verify the lack of any defined hover text doesn't remove zeroes from text
    * Fix: Correct typo in function name used

## 3.9 _(2020-01-08)_

### Highlights:

This minor release adds support for select third-party plugins (Advanced Custom Fields, Elementor), tweaks plugin initialization, fixes a minor bug, updates the plugin framework to 049, notes compatibility through WP 5.3+, creates CHANGELOG.md, and updates copyright date (2020).

### Details:

* New: Add support for third-party plugins: Advanced Custom Fields, Elementor
* New: Add filter `c2c_text_hover_third_party_filters` for filtering third party filters
* Fix: Define `uninstall()` as being `static`
* Change: Initialize plugin on `plugins_loaded` action instead of on load
* Change: Update plugin framework to 049
    * 049:
    * Correct last arg in call to `add_settings_field()` to be an array
    * Wrap help text for settings in `label` instead of `p`
    * Only use `label` for help text for checkboxes, otherwise use `p`
    * Ensure a `textarea` displays as a block to prevent orphaning of subsequent help text
    * Note compatibility through WP 5.1+
    * Update copyright date (2019)
* Change: Variablize the qTip2 version and use it when enqueuing its JS and CSS
* New: Add CHANGELOG.md and move all but most recent changelog entries into it
* New: Add inline documentation for hooks
* Unit tests:
     * Change: Update unit test install script and bootstrap to use latest WP unit test repo
     * Change: Explicitly check hook priority when checking that hook is registered
* Change: Note compatibility through WP 5.3+
* Change: Update copyright date (2020)
* Change: Update License URI to be HTTPS
* Change: Split paragraph in README.md's "Support" section into two

## 3.8 _(2018-08-01)_
* New: Ensure longer, more precise link strings match before shorter strings that might also match, regardless of order defined
* New: Add support for finding text to hover that may span more than one line or whose internal spaces vary in number and type
* Fix: Prevent hover text from being embedded within other hover text
* Change: Switch for using deprecated 'acronym' tag to using 'abbr'
* Change: Display fancy hover text as white text on a dark gray background
* Change: Cast return values of hooks to expected data types
* Change: Add version number when enqueuing CSS files
* Change: Update plugin framework to 048
    * 048:
    * When resetting options, delete the option rather than setting it with default values
    * Prevent double "Settings reset" admin notice upon settings reset
    * 047:
    * Don't save default setting values to database on install
    * Change "Cheatin', huh?" error messages to "Something went wrong.", consistent with WP core
    * Note compatibility through WP 4.9+
    * Drop compatibility with version of WP older than 4.7
    * 046:
    * Fix `reset_options()` to reference instance variable `$options`
    * Note compatibility through WP 4.7+
    * Update copyright date (2017)
    * 045:
    * Ensure `reset_options()` resets values saved in the database
* New: Add README.md
* New: Add GitHub link to readme
* Change: Store setting name in constant
* Unit tests:
    * Change: Improve test initialization
    * Change: Improve tests for settings handling
    * Change: Default `WP_TESTS_DIR` to `/tmp/wordpress-tests-lib` rather than erroring out if not defined via environment variable
    * Change: Enable more error output for unit tests
    * New: Add more tests
    * New: Add header comments to bootstrap
* Change: Note compatibility through WP 4.9+
* Change: Drop compatibility with version of WP older than 4.7.
* Change: Tweak plugin description
* Change: Minor code reformatting
* Change: Add example of better looking tooltip alongside basic tooltip example
* Change: Rename readme.txt section from 'Filters' to 'Hooks'
* Change: Modify formatting of hook name in readme to prevent being uppercased when shown in the Plugin Directory
* Change: Update installation instruction to prefer built-in installer over .zip file
* Change: Update copyright date (2018)

## 3.7.1 _(2016-06-10)_
* Change: Update qTip2 to v3.0.3.
    * Fixes a JS invalid .min.map file reference.
    * Add plugin IE6 support.
* Change: Update plugin framework to 044.
    * Add `reset_caches()` to clear caches and memoized data. Use it in `reset_options()` and `verify_config()`.
    * Add `verify_options()` with logic extracted from `verify_config()` for initializing default option attributes.
    * Add  `add_option()` to add a new option to the plugin's configuration.
    * Add filter 'sanitized_option_names' to allow modifying the list of whitelisted option names.
    * Change: Refactor `get_option_names()`.

## 3.7 _(2016-04-28)_
* New: Allow HTML to be matched for text hovering. Recommended only for non-block level tags.
* New: Allow single replacement (based on setting) for multibyte strings.
* Bugfix: Improve text replacement regex to account for text immediately bounded by HTML tags.
* Change: Update plugin framework to 043:
    * Change class name to `c2c_TextHover_Plugin_043` to be plugin-specific.
    * Disregard invalid lines supplied as part of a hash option value.
    * Set textdomain using a string instead of a variable.
    * Don't load textdomain from file.
    * Change admin page header from 'h2' to 'h1' tag.
    * Add `c2c_plugin_version()`.
    * Formatting improvements to inline docs.
* Change: Add support for language packs:
    * Set textdomain using a string instead of a variable.
    * Remove .pot file and /lang subdirectory.
    * Remove 'Domain Path' from plugin header.
* Change: Add many more unit tests.
* Change: Prevent web invocation of unit test bootstrap.php.
* New: Add LICENSE file.
* New: Add empty index.php to prevent files from being listed if web server has enabled directory listings.
* Change: Minor code reformatting.
* Change: Add proper docblocks to examples in readme.txt.
* Change: Note compatibility through WP 4.5+.
* Change: Dropped compatibility with version of WP older than 4.1.
* Change: Update copyright date (2016).

## 3.6 _(2015-02-19)_
* Improve support of '&' in text to be replaced by recognizing its encoded alternatives ('`&amp;`', '`&#038;`') as equivalents
* Support replacing multibyte strings. NOTE: Multibyte strings don't honor limiting their replacement within a piece of text to once
* Add class of 'c2c-text-hover' to acronym tags added by plugin
* Update packaged qTip2 JS library to v2.2.1
* Limit qTip2 only to acronyms added by the plugin
* Update plugin framework to 039
* Add more unit tests
* Explicitly declare `activation()` static
* Cast filtered value of `c2c_text_hover` filter as array
* Reformat plugin header
* Change regex delimiter from '|' to '~'
* Change documentation links to wp.org to be https
* Minor documentation spacing changes throughout
* Note compatibility through WP 4.1+
* Update copyright date (2015)
* Add plugin icon
* Regenerate .pot

## 3.5.1 _(2014-01-28)_
* Fix logic evaluation to properly honor `replace_once` checkbox value
* Minor code reformatting

## 3.5 _(2014-01-05)_
* Add setting to allow limiting text replacement to once per term per text
* Add filter `c2c_text_hover_once`
* Add qTip2 library for better looking hover popups
* Add setting to allow use of prettier tooltips (i.e. the qTip2 library). Default is true.
* Add filter `c2c_text_hover_use_pretty_tooltips`
* Add setting to allow text hover to apply to comments (default is for it not to)
* Add filter `c2c_text_hover_comments`
* Add `text_hover_comment_text()`
* Add preview for tooltips to plugin's settings page
* Add unit tests
* Add file assets/text-hover.js (to enable qTip)
* Add file assets/text-hover.css (to provide default styling for qTip)
* Update plugin framework to 037
* Better singleton implementation:
    * Add `get_instance()` static method for returning/creating singleton instance
    * Make static variable 'instance' private
    * Make constructor protected
    * Make class final
    * Additional related changes in plugin framework (protected constructor, erroring `__clone()` and `__wakeup()`)
* Add checks to prevent execution of code if file is directly accessed
* Re-license as GPLv2 or later (from X11)
* Add 'License' and 'License URI' header tags to readme.txt and plugin file
* Use explicit path for `require_once()`
* Discontinue use of PHP4-style constructor
* Discontinue use of explicit pass-by-reference for objects
* Remove ending PHP close tag
* Minor documentation improvements
* Minor code reformatting (spacing)
* Note compatibility through WP 3.8+
* Drop compatibility with version of WP older than 3.6
* Update copyright date (2014)
* Regenerate .pot
* Change donate link
* Add assets directory to plugin repository checkout
* Update screenshots
* Add third screenshot
* Move screenshots into repo's assets directory
* Add banner

## 3.2.2
* Fix bug where special characters were being double-escaped prior to use in regex
* Update plugin framework to 034

## 3.2.1
* Fix bug where `$x` (where x is number) when used in hover text gets removed on display
* Fix to properly escape shortcut keys prior to internal use in `preg_replace()`
* Update plugin framework to 032

## 3.2
* Fix bug with settings form not appearing in MS
* Update plugin framework to 030
* Remove support for `$c2c_text_hover` global
* Note compatibility through WP 3.3+
* Drop support for versions of WP older than 3.1
* Regenerate .pot
* Add 'Domain Path' directive to top of main plugin file
* Add link to plugin directory page to readme.txt
* Update copyright date (2012)

## 3.1.1
* Fix cross-browser (namely IE) handling of non-wrapping textarea text (flat out can't use CSS for it)
* Update plugin framework to version 028
* Change parent constructor invocation
* Create 'lang' subdirectory and move .pot file into it
* Regenerate .pot
* Tweaked description

## 3.1
* Fix to properly register activation and uninstall hooks
* Update plugin framework to version 023
* Save a static version of itself in class variable `$instance`
* Deprecate use of global variable `$c2c_text_hover` to store instance
* Add `__construct()` and `activation()`
* Note compatibility through WP 3.2+
* Drop compatibility with version of WP older than 3.0
* Minor code formatting changes (spacing)
* Fix plugin homepage and author links in description in readme.txt

## 3.0.3
* Update plugin framework to version 021
* Delete plugin options upon uninstallation
* Explicitly declare all class functions public static
* Note compatibility through WP 3.1+
* Update copyright date (2011)

## 3.0.2
* Update plugin framework to version 018
* Fix so that textarea displays vertical scrollbar when lines exceed visible textarea space

## 3.0.1
* Update plugin framework to version 016

## 3.0
* Re-implementation by extending `C2C_Plugin_015`, which among other things adds support for:
    * Reset of options to default values
    * Better sanitization of input values
    * Offload of core/basic functionality to generic plugin framework
    * Additional hooks for various stages/places of plugin operation
    * Easier localization support
* Full localization support
* Disable auto-wrapping of text in the textarea input field for hovers
* Allow filtering of text hover terms and replacement via `c2c_text_hover` filter
* Allow filtering of hooks that get text hover processing via `c2c_text_hover_filters` filter
* Allow filtering/overriding of case_sensitive option via `c2c_text_hover_case_sensitive` filter
* Filter `widget_text` for text hover
* Rename class from `TextHover` to `c2c_TextHover`
* Assign object instance to global variable, `$c2c_text_hover`, to allow for external manipulation
* Remove docs from top of plugin file (all that and more are in readme.txt)
* Update readme.txt
* Minor code reformatting (spacing)
* Add Filters and Upgrade Notice sections to readme.txt
* Note compatibility with WP 3.0+
* Drop support for versions of WordPress older than 2.8
* Add .pot file
* Update screenshot
* Add PHPDoc documentation
* Add package info to top of file
* Update copyright date
* Remove trailing whitespace

## 2.2
* Fixed bug that allowed text within tag attributes to be potentially replaced
* Fixed bug that prevented case sensitivity-related option from being taken into account
* Removed `$case_sensitive` argument from `text_replace()` function since it is controlled by a setting
* Changed pattern matching criteria to allow text-to-be-hovered to be book-ended on either side with single or double quotes (either plain or curly), square brackets, curly braces, or parentheses
* Added ability to filter text hover shortcuts via `c2c_text_hover_option_text_to_hover`
* Changed the number of rows for textarea input from 5 to 15
* Changed plugin_basename to be a class variable initialized during constructor
* Removed use of single-use temp variable (and instead directly used the value it was holding)
* Minor code reformatting (mostly spacing)

## 2.1
* (Privately released betas previewing features released as part of v2.2)

## 2.0
* Encapsulated all functionality into its own class
* Added 'Settings' link to plugin's plugin listing entry
* Noted compatibility with WP2.8+
* Dropped support for pre-WP2.6
* Updated screenshots
* Updated copyright date

## 1.0
* Initial release