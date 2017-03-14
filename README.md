# WDS-Components-Library

The WDS Components Library is a collection of WordPress-ready components that can be dropped into any WordPress project. The WDS Components Library works really great with our starter theme [wd_s](https://github.com/WebDevStudios/wd_s), but can be used with any WordPress theme.


## Features

Integration with CMB2
Integration with ACF Pro


## Getting Started

Within each component folder, you'll find the code necessary to make each component work, along with a readme that will guide you in terms of where all the pieces belong. You can also see a practical example of how the components can be integrated by having a peek into the wd_s theme included in the project repo.


## Contributing

Your contributions are welcome. Here are some basic guidelines for contributing:

1. Create an [issue](https://github.com/WebDevStudios/WDS-Components-Library/issues) so we can discuss your brilliant idea.
1. Fork WDS Components Library
1. Create a feature branch off `master`, e.g. `git checkout -b feature/my-awesome-feature`
1. Commit your changes to your feature branch
1. Continue merging master into your feature branch while working
1. Test Test Test
1. Submit a [pull request](https://github.com/WebDevStudios/WDS-Components-Library/pulls)
1. If your pull request passes our tests, we'll merge your PR
1. Celebrate! :beers:


## Working Locally

The WDS Component Library is built on [Jekyll](https://jekyllrb.com/), so you'll need to make sure you have [Jekyll installed on your system](https://jekyllrb.com/docs/installation/).

Once Jekyll is installed, you can run the following commands in your terminal:

```
gem install bundler
bundle install
bundle exec jekyll serve
```

Once up and running, you can view your local Jekyll site by visiting the server address indicated in the terminal:

```
Configuration file: /[path-to-project]/wds-components/_config.yml
	Server address: http://127.0.0.1:4000/wds-component-library
  Server running... press ctrl-c to stop.
```
## Adding components

Here is the basic structure of a component within the Jekyll site:

```
components/
|-- your-component/  
|--|-- _intro.md  
|--|-- component.html (the HTML output)  
|--|-- component-tags.html (the PHP template tags required to generate output)  
|--|-- compontent-cmb2.html  
|--|-- component.js
|--|-- component-acf.json  
|--|-- output.html  
|--|-- index.md  
|--|-- sass/  
|--|--|-- your-component.scss
```