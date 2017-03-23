---
title: Image Hero
path_slug: image-hero
layout: component
category: ui
---

<!-- Description -->
{% include_relative _description.md %}

<!-- Live Example -->
<iframe class="live-output" src="{{ site.baseurl }}/components/{{page.path_slug}}/component-live.html">
</iframe>

<!-- Usage -->
<h3 class="component__heading">Usage</h3>
{% include_relative _usage.md %}

<!-- Code -->
{% include code-tabs.html %}

<h3 class="component__heading">CMB2 Metabox</h3>
```php
{% include_relative component-cmb2.html %}
```

<h3 class="component__heading">ACF JSON</h3>
```json
{% include_relative component-acf-json.json %}
```
