<?php
/*
Plugin Name: Post Typographer
Plugin URI: http://wordpress.org/extend/plugins/post-typographer/
Description: Formats the text according to typography rules. Works with English texts only.
Author: Andriy Moraru
Version: 9
Author URI: http://www.topforexnews.com
*/

//Flag to prevent infinite loop when the new post content is saved
$the_post_is_saving = 0;

function format_typo_post($post_ID)
{
	//Loop preventing
	global $the_post_is_saving;
	if ($the_post_is_saving) return $post_ID;

	//Don't know if it's required when dealing with publish_post (it is required when dealing with save_post)
	if (wp_is_post_revision($post_ID) || wp_is_post_autosave($post_ID)) return $post_ID;

	//Prepare parameters to fetch only one post with ID == $post_ID
	$args = array(
		'include' => $post_ID,
		'post_type' => 'any',
		'post_status' => null
	); 

	//Fetch post content
	$posts = get_posts($args);
	foreach ($posts as $post) $content = $post->post_content;

       	//Replace double (and more) spaces with single spaces
	$content = preg_replace('@ {2,}@', ' ', $content);

	//Add m-dashes with a preceeding non-breaking space, in place of the hyphens, where neeeded
	$content = str_replace(' - ', '&nbsp;&#8212; ', $content);

	//Prevent Wordpress from removing the backslashes
	$content = str_replace('\\', '\\\\', $content);

	//Get the array of strings made of text without HTML tags
	$without_html = preg_split('@<[\/\!]*?[^<>]*?>@', $content);
        //Get the array of HTML tags from the text
	$amount = preg_match_all('@<[\/\!]*?[^<>]*?>@', $content, $html);

	//Concatenate the text, making necessary replacements
	for ($i = 0; $i <= $amount; $i++)
	{
		//Get the array of strings made of text without text wrapped with [] tags
		$without_square = preg_split('@\[(video|code)\].*\[/(video|code)\]@', $without_html[$i]);
	        //Get the array of [] tags from the text
		$n_square = preg_match_all('@\[(video|code)\].*\[/(video|code)\]@', $without_html[$i], $square);
		for ($j = 0; $j <= $n_square; $j++)
		{
			//Remove space before the punctuation marks that are placed directly after the words
			$without_square[$j] = preg_replace('@ ((\. )|,|(: )|(; )|!|\?)@', "\$1", $without_square[$j]);
			//Add space after the punctuation marks where needed
			$without_square[$j] = preg_replace('@(,|!|\?)([a-z]+)@i', "\$1 \$2", $without_square[$j]);
			//Add n-dashes in place of hyphens in the numeric ranges, skipping the supposed phone numbers
			$without_square[$j] = preg_replace('@((^|[^\-^0-9])[0-9]+)-([0-9]+([^0-9^\-]|$))@', "\$1&#8211;\$3", $without_square[$j]);
			//Wrap composed words with hyphens with <nobr> tag 
			$without_square[$j] = preg_replace('@(([a-zA-Z]+)(-([a-zA-Z]+))+)@', "<nobr>\$1</nobr>", $without_square[$j]);
			//Add non-breaking spaces
			$new_content .= preg_replace("@(?<!')\b(at|or|and|the|a|by|an|in|on|of|for|to|as|i|or|my) @i", "\$1&nbsp;", $without_square[$j]);
			if ($j < $n_square) $new_content .= $square[0][$j];
		}
		if ($i < $amount) $new_content .= $html[0][$i];
	}

	//A rather ugly fix for recursive <nobr> wrapping
	$new_content = preg_replace('@<nobr>(<nobr>)+@', "<nobr>", $new_content);
	$new_content = preg_replace('@</nobr>(</nobr>)+@', "</nobr>", $new_content);

	//Prepare parameters for updating the post
	$my_post = array();
	$my_post['ID'] = $post_ID;
	$my_post['post_content'] = $new_content;
 
	//Update the post into the database
	$the_post_is_saving = 1;
	wp_update_post($my_post);
	$the_post_is_saving = 0;

	return $post_ID;
}

add_action('publish_post', 'format_typo_post');
?>