# Pricing Card Section

View an example of the Pricing Card Section on [CodePen](http://codepen.io/webdevstudios/pen/BjPvrE) or within the pattern library of the included theme.


## Usage
Add the PHP from `pricing-card-section.php` to your theme's `functions.php`, `template-tags.php`, or `components.php` folder (if you add the code to the latter, be sure you include or require the file in within `functions.php`).

Drop the `_pricing-card-section.scss` file into your theme's Sass folder, and use `@import 'pricing-card-section` in your main Sass import file. Run your preferred compliation step (`gulp styles`, for example).

The Pricing Card Section also includes metaboxes using either Advanced Custom Fields Pro, or CMB2. Please see below for specific instructions for using the ACF or CMB2 metaboxes.


### Using ACF Pro

This _requires_ ACF Pro to utilize the JSON file sync.

To use ACF Pro, create an `/acf-json/` directory in your theme. Copy the `acf-pricing-card-section.json` file to `/acf-json/`. Then, within the WordPress admin, go to Custom Fields > Field Groups. You'll see a 'Sync available' tab above the Field Group table--click it! Hover over the Pricing Card Section, and click the Sync link. Your field will be ready for use.

If you make additional customizations to the ACF Pricing Card Section fields (e.g. limit where the fields show), you may safely delete the `acf-pricing-card-section.json` file, which will be renamed `group_XXX.json` where XXX is the group identifier.

When adding code from `pricing-card-section.php`, be sure to grab the ACF-specific functions:

1. `_s_get_pricing_card_section_acf()`
1. `_s_the_pricing_card_section_acf()`


### Using CMB2

The _requires_ the [CMB2 plugin](https://wordpress.org/plugins/cmb2/), or for CMB2 to be included within your project via the theme or another plugin.

To use CMB2, copy the code in the `cmb2-pricing-card-section.php` file and paste it into `functions.php`. Or, add a `cmb2.php` or `metaboxes.php` and paste the code into one of those files, making sure to include or require the file within `functions.php`.

When adding code from `pricing-card-section.php`, be sure to grab the CMB2-specific functions for getting the pricing card section:

1. `_s_get_pricing_card_section_cmb2()`
1. `_s_the_pricing_card_section_cmb2()`

If you decide to use a prefix with your CMB2 fields, be sure to add that to the `get_post_meta()` calls in `_s_get_pricing_card_section_cmb2()`. E.g.:

```php
$cards = get_post_meta( $post_id, $prefix . 'pricing_card_group', true );
```
