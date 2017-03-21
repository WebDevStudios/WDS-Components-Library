---
layout: default
---

<div class="patterns">

	<section class="section-pattern">
		<h2 class="pattern-heading">Globals</h2>
		
		<div class="pattern-document colors">
			<header class="pattern-document__header">
				<h3 class="pattern-document__title">Colors</h3>
			</header>

			<div class="color-container">
				{% for color in site.data.colors %}
					<div class="color">
						<div class="color__chip" style="background: {{color[1]}}"></div>
						<div class="color__name">{{color[0]}} : {{color[1]}}</div>
					</div>
				{% endfor %}
			</div>
		</div>

		<div class="pattern-document fonts">
			<header class="pattern-document__header">
				<h3 class="pattern-document__title">Fonts</h3>
			</header>

			<div class="font-container">
				{% for font in site.data.fonts %}
					<div style="font-family: {{font[1]}}">{{font[0]}} : {{font[1]}}</div>
				{% endfor %}
			</div>
		</div>
	</section>

	<section class="section-pattern">
		<h2 class="pattern-heading">Typography</h2>

		<div class="pattern-document headings">
			<heading class="pattern-document__heading">
				<h3 class="pattern-document__title">Headings</h3>
			</heading>

			<div class="pattern-document__output">
				<h1>Heading 1</h1>
				<h2>Heading 2</h2>
				<h3>Heading 3</h3>
				<h4>Heading 4</h4>
				<h5>Heading 5</h5>
				<h6>Heading 6</h6>
			</div>
		</div>

		<div class="pattern-document inline-elements">
			<heading class="pattern-document__heading">
				<h3 class="pattern-document__title">Inline Elements</h3>
			</heading>

			<div class="pattern-document__output">
				<p><a href="#">This is a text link</a></p>

				<p><strong>Strong is used to indicate strong importance</strong></p>

				<p><em>This text has added emphasis</em></p>

				<p>The <b>b element</b> is stylistically different from normal text, without any special importance</p>

				<p>The <i>i element</i> is text that is set off from the normal text</p>

				<p>The <u>u element</u> is text with an unarticulated, though explicitly rendered, non-textual annotation</p>

				<p><del>This text is deleted</del> and <ins>this text is inserted</ins></p>

				<p><s>This text as a strikethrough</s></p>

				<p>Superscript<sup>®</sup></p>

				<p>Subscript for things like H<sub>2</sub>O</p>

				<p><small>This small text is small for fine print, etc</small></p>

				<p>Abbreviation: <abbr title="HyperText Markup Language">HTML</abbr></p>

				<p>Keyboard input: <kbd>Cmd</kbd></p>

				<p><q cite="">This text is a short inline quotation</q></p>

				<p><cite>This is a citation</cite></p>

				<p>The <dfn>dfn element</dfn> indicates a definition.</p>

				<p>The <mark>mark element</mark> indicates a highlight</p>

				<p><code>This is what inline code looks like</code></p>

				<p><samp>This is sample output from a computer program</samp></p>

				<p>The <var>variable element</var> such as <var>x</var> = <var>y</var></p>
			</div>
		</div>
	</section>
</div>
