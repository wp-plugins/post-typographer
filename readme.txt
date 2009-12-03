=== Plugin Name ===
Tags: typography, formatting, post, posts, plugin
Requires at least: 2.5
Tested up to: 2.8.6
Stable tag: 9

Adds non-breaking spaces, <nobr> tags, common spaces, tags and dashes where needed. Works with English texts only.

== Description ==

When you publish a post or update an already published post, this plugin will
format the post's content to certain typographic rules:

1. All hyphens between two words (surrounded by spaces) will be transformed to
m-dashes with the non-breaking spaces ahead of them.
2. All hyphens between digits (without spaces) will be transformed to n-dashes. 
But it tries to preserve phone numbers.
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
* my
4. Double and more spaces are replaced with the single ones.
5. All misplaced spaces near dots, colons, semicolons, exclamation 
marks and question marks are fixed, where possible.
6. Composed words with hyphens in them (e.g. "easy-to-use") will be wrapped in
<nobr></nobr> tags.

Porblems:

1. The plugin **won't** mess with the HTML tags or other mark-up tags delimited 
with < and >. It **will** mess with the Javascript code and such constructions 
as:`
	[code]
	bla bla bla
	[/code]
`
Though, since version 6 the mess is minimized for [code] and [video] tags.

2. The n-dash thing will mess up with the phone numbers that have only one 
hyphen in them. They will be confused with the value ranges.

== Installation ==

1. Upload `typopost.php` to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in your WordPress Admin section.

== Changelog ==

= 9 =
* Fixed: No longer removes backslashes from posts.
* Fixed: Tries not to mess with the files' extensions (like .txt).

= 8 =
* Added: Tries to remove unneded spaces before colons and semicolons without
messing with the smiles.
* Added: Word 'by' included to the list of words for `&nbsp;` after them.

= 7 =
* Fixed: No longer removes spaces before colons and semicolons - not to mess 
with the smiles.

= 6 =
* Fixed: Double (and more) warpping with the <nobr> tags.
* Fixed: <nobr> wrapping and some other formatting in the [code] and [video] 
embedded text.

= 5 =
* Added: Wrapping the composed words with hyphens with <nobr> tags.

= 4 =
* Fixed: Nasty double-space bug on post-updating.
* Fixed: M-dash placement didn't work in version 3.
* Fixed: N-dashes are now placed correctly even if the value ranges are near the
beginning or the end of the text.

= 3 =
* Added: Replaces misplaced spaces near punctuation marks.
* Fixed: Phone numbers and dates are now avoided (except single-hyphen phone 
numbers) when the hyphens in the value ranges are transformed into n-dashes.

= 2 =
* Added: Replaces 2 or more spaces with a single space in the text.
* Added: Word 'my' included to the list of words for `&nbsp;` after them.

= 1 =
* The first working version.

== Thanks to ==

[Typograf by Artemy Lebedev](http://www.artlebedev.ru/tools/typograf/)