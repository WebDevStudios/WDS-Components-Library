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
		<h2 class="pattern-heading">Buttons</h2>

		<div class="pattern-document">
			<heading class="pattern-document__heading">
				<h3 class="pattern-document__title">Button - Orange</h3>
			</heading>

			<button type="button" class="button-orange">Click</button>
		</div>

		<div class="pattern-document">
			<heading class="pattern-document__heading">
				<h3 class="pattern-document__title">Button - Black</h3>
			</heading>

			<button type="button" class="button-black">Click</button>
		</div>

		<div class="pattern-document">
			<heading class="pattern-document__heading">
				<h3 class="pattern-document__title">Button - Outline</h3>
			</heading>

			<button type="button" class="button-outline">Click</button>
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

		<div class="pattern-document paragraph">
			<heading class="pattern-document__heading">
				<h3 class="pattern-document__title">Paragraph</h3>
			</heading>

			<div class="pattern-document__output">
				<p>A paragraph (from the Greek paragraphos, "to write beside" or "written beside") is a self-contained unit of a discourse in writing dealing with a particular point or idea. A paragraph consists of one or more sentences. Though not required by the syntax of any language, paragraphs are usually an expected part of formal writing, used to organize longer prose.</p>
			</div>
		</div>

		<div class="pattern-document preformatted">
			<heading class="pattern-document__heading">
				<h3 class="pattern-document__title">Preformatted</h3>
			</heading>

			<div class="pattern-document__output">
				<pre>P R E F O R M A T T E D T E X T
! " # $ % & ' ( ) * + , - . /
0 1 2 3 4 5 6 7 8 9 : ; < = > ?
@ A B C D E F G H I J K L M N O
P Q R S T U V W X Y Z [ \ ] ^ _
` a b c d e f g h i j k l m n o
p q r s t u v w x y z { | } ~</pre>
			</div>
		</div>
	</section>
</div>

<!-- From here down, we're adding syntax. Syntax & syntax headings cannot be indented, otherwise, they will not output correctly. -->
<h2 class="pattern-heading">Code Syntax</h2>

<h3 class="pattern-document__title">Sass / SCSS</h3>
```sass
{% include_relative _components/image-hero/scss/component-scss.scss %}
```

<h3 class="pattern-document__title">HTML</h3>
```html
{% include_relative _components/image-hero/component-output.html %}
```

<h3 class="pattern-document__title">PHP</h3>
```php
{% include_relative _components/image-hero/component-php.html %}
```
