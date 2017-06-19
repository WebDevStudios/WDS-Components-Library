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
To add a new component, add a template part to the `components` directory. Components should be named `component-` + `name_of_component.php`. `name_of_component` _must_ match the name used within the ACF Components flexible content field group (including underscores). This allows the component display function to automatically grab the correct template part.

As an example, let's look at the image hero component. Within the flexible content field group, it is named `image_hero`. Therefore, it's template part must be named `component-image_hero.php`.

Please see the README.md within the `components` directory for more information.


## Changelog ##

### 0.0.0 ###
* First release

## Upgrade Notice ##

### 0.0.0 ###
First Release
