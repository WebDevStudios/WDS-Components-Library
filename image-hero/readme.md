# Image Hero

View an example of the Image Hero on [CodePen](http://codepen.io/webdevstudios/pen/JGmXwm) or within the pattern library of the included theme.


## Usage
Add the PHP from `image-hero.php` to your theme's `functions.php`, `template-tags.php`, or `components.php` folder (if you add the code to the latter, be sure you include or require the file in within `functions.php`).

Drop the `_image-hero.scss` file into your theme's Sass folder, and use `@import 'image-hero` in your main Sass import file. Run your preferred compliation step (`gulp styles`, for example).

The video hero also includes metaboxes using either Advanced Custom Fields Pro, or CMB2.


### Using ACF Pro

This _requires_ ACF Pro to utilize the JSON file sync.

To use ACF Pro, create an `/acf-json/` directory in your theme. Copy the `acf-image-hero.json` file to `/acf-json/`. Then, within the WordPress admin, go to Custom Fields > Field Groups. You'll see a 'Sync available' tab above the Field Group table--click it! Hover over the Video Hero, and click the Sync link. Your field will be ready for use.

If you make additional customizations to the ACF Video hero fields (e.g. limit where the fields show), you may safely delete the `acf-image-hero.json` file, which will be renamed `group_XXX.json` where XXX is the group identifier.


### Using CMB2

The _requires_ the [CMB2 plugin](https://wordpress.org/plugins/cmb2/), or for CMB2 to be included within your project via the theme or another plugin.

To use CMB2, copy the infomation in the `cmb2-video-hero.php` file and paste it into `functions.php`. Or, add a `cmb2.php` or `metaboxes.php` and paste the code into one of those files, making sure to include or require the field within `functions.php`.

If you decide to use a prefix with your CMB2 fields, be sure to add that to the `_s_the_image_hero()`. E.g.:

```php
$image = get_post_meta($post_id, $prefix . 'image', true );
```

Additionally, when using CMB2 with images, you will want to make sure you append `_id` to the end of the image meta to get the image object, and not a URL. E.g.:

```php
$image = get_post_meta( $post_id, 'image_id', true );
```
