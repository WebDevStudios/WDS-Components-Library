# WDS Component Library #
**Contributors:**      webdevstudios  
**Donate link:**       https://webdevstudios.com
**Tags:**  
**Requires at least:** 4.4  
**Tested up to:**      4.7.2 
**Stable tag:**        0.0.0  
**License:**           GPLv2  
**License URI:**       http://www.gnu.org/licenses/gpl-2.0.html  

## Description ##

The WDS Components Library is a collection of WordPress-ready components that can be dropped into any WordPress project. The WDS Components Library works really great with our starter theme [wd_s](https://github.com/WebDevStudios/wd_s), but can be used with any WordPress theme.


## Features ##
Integration with [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/pro/).

## Installation ##

### Manual Installation ###

1. Upload the entire `/wds-component-library` directory to the `/wds-content/plugins/` directory.
2. Activate WDS Component Library through the 'Plugins' menu in WordPress.

## Frequently Asked Questions ##


## Screenshots ##


## Contributing ##
1. Create an issue so we can discuss your brilliant idea.  
1. Fork WDS Components Library  
1. Create a feature branch off master, e.g. git checkout -b feature/my-awesome-feature  
1. Commit your changes to your feature branch  
1. Continue merging master into your feature branch while working  
1. Test Test Test  
1. Submit a pull request  
1. If your pull request passes our tests, we'll merge your PR  
1. Celebrate! 🍻  


## Working Locally ##

### Prerequisites ###
The WDS Component Library is built with the [WDS Plugin Generator](https://github.com/WebDevStudios/generator-plugin-wp), so a basic knowledge of adding includes with the plugin generator is a good start.

You will also need [ACF Pro](https://www.advancedcustomfields.com/pro/) to view / add / update custom fields.

You will also need [node](https://nodejs.org/download/).

Once you have all prerequisites, run

```
npm install
```

within the `wds-components-library` directory.


### Adding Components ###
To add a new component, run

```
yo plugin-wp:include <component-name>
```

within the plugin directory.

Assets, including styles and scripts, for each component should be contained to their own partials within `assets/css/sass/components` or `assets/scripts/components`, respectively.

To add a component to the flexible content field for the components CPT, add a case for the flexible content field group in the `display_component()` function within `class-component.php`.

Example:
``` php
public function display_component( $post_id = 0 ) {

    // Get the post id.
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }

    // Get our data.
    $component = get_post_meta( $post_id, 'component', true );

    // Determine which layout to grab.
    foreach ( (array) $component as $count => $component ) {

        switch ( $component ) {

            // Image Hero.
            case 'image_hero' :

                wds_component_library()->image_hero->image_hero_markup( $post_id, $count );
                break;

            // My new component.
            case 'my_new_component' :

                wds_component_library()->my_new_component->my_new_component_markup( $post_id, $count );
                break;
        }
    }
}
```


## Changelog ##

### 0.0.0 ###
* First release

## Upgrade Notice ##

### 0.0.0 ###
First Release
