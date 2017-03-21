---
layout: default
---

<div class="patterns">

	<section class="colors">
		<h2>Colors</h2>
		{% for color in site.data.colors %}
			<div class="color">
				<div class="color__chip" style="background: {{color[1]}}"></div>
				<div class="color__name">{{color[0]}} : {{color[1]}}</div>
			</div>
		{% endfor %}
	</section>

	<section class="typography">
		<h2>Typography</h2>
		{% for font in site.data.fonts %}
			<div style="font-family: {{font[1]}}">{{font[0]}} : {{font[1]}}</div>
		{% endfor %}
	</section>
</div>
