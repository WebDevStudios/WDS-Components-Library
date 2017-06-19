# WDS Component Library Component Templates
The WDS Components Library is driven by template parts, which helps establish better separation between logic and markup. New component templates may be added here, in this folder, or within the theme (parent or child) within `template-parts/components`.


## Adding a component
To add a new component, add a template part within this directory. Components should be named `component-` + `name_of_component.php`. `name_of_component` _must_ match the name used within the ACF Components flexible content field group (including underscores). This allows the component display function to automatically grab the correct template part.

As an example, let's look at the image hero component. Within the flexible content field group, it is named `image_hero`. Therefore, it's template part must be named `component-image_hero.php`.


## Working with ACF data
In order to allow the maximum amount of flexibility (and safety for our users), native WordPress functions should be uesd over ACF functions.

To prepare data to be used within flexible content, or on its own, it's a good idea to check for an optional prefix:

```php
// If we're using this within the components library, we need the flexible content name, and row count.
$component = get_post_meta( $post_id, 'component', true );
$prefix    = ( ! empty( $component ) ) ? 'component_' . $count . '_' : '';
```

This first checks if the component is used within the context of flexible content, and if it is, it adds a prefix of `component_` to our field, otherwise, it remains blank.

We then use this optional prefix when getting our component data:

```php
$image = get_post_meta( $post_id, $prefix . 'background_image', true );
```

If the component is used within the Components flexible content, the field name passed is actually `component_0_background_image`.

If the component is used on its own, the field name passed is simply `background_image`.

This allows us to maximize the flexibility of our components, while keeping our code DRY.


Copyright (c) 2017 [webdevstudios](https://webdevstudios.com)

Licensed under the GPLv2 license.
