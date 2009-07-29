=== Plugin Name ===
Tags: typograhy, formatting
Requires at least: 2.5
Tested up to: 2.8.2
Stable tag: 1

Adds non-breaking spaces and dashes where needed. Works with English texts only.

== Description ==

When you publish a post or update an already published post, this plugin will
format the post's content to certain typographic rules:

1. All hyphens between two words (surrounded by spaces) will be transformed to
m-dashes with the non-breaking spaces ahead of them.
2. All hyphens between digits (without spaces) will be transformed to n-dashes.
3. All spaces following these words will be replaced with the non-breaking 
spaces:
* at
* or 
* and
* the
* a
* an
* in
* on
* of
* for
* to
* as
* i
* or

Porblems:

1. The plugin **won't** mess with the HTML tags or other mark-up tags delimited 
with < and >. It **will** mess with the Javascript code and such constructions 
as:
`
	[code]
	bla bla bla
	[/code]
`

2. The n-dash thing will mess up with the phone numbers. They are not the value
ranges and should use hyphens, but I don't know how to make this plugin skip
hyphens in the phone numbers exclusively.

== Installation ==

1. Upload `typopost.php` to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in your WordPress Admin section.

== Changelog ==

= 1 =
* The first working version.

== Thanks to ==

[Typograf by Artemy Lebedev] http://www.artlebedev.ru/tools/typograf/