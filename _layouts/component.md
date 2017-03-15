---
layout: default
---

<div class="component">
	
	{% if page.title %}
	<header class="entry-header">
		<h2 class="entry-title">{{page.title}}</h2>
	</header>
	{% endif %}

	{{ content }}
</div>
