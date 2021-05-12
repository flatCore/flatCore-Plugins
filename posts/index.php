<?php

/**
 * Plugin: show the most recent entries from fc_posts
 * Version: Version: 0.1
 * Requirement: flatCore 2.0.+
 * License: GPL-3.0 License
 *
 * type -> m = message, i = image, f = file, g = gallery, e = event, v = video, l = link
 * limit -> number of posts (default = 3)
 * [plugin=posts]type=m-i-f&limit=6[/plugin] display 6 posts of type message, image and file
 * [plugin=posts]type=e[/plugin] display 3 posts from type event
 *
 * Note: You should not mix post type event with other types. This would end up with unexpected results in the sorting.
 */
 

$plugin = array();
$plugin['title'] = 'Posts Plugin';
$plugin['description'] = '<p>show the most recent posts</p>';
$plugin['version'] = '1.0';
$plugin['author'] = 'flatCore.org';

if(FC_SOURCE == 'frontend') {
	
	global $db_posts;
	global $languagePack;
	global $lang;
	
	$time_string_now = time();
	
	$set_type = '';
	
	if($type != '') {
		$set_type = explode("-",$type);
	} else {
		$set_type = array("m");
	}
	
	if($limit == '') {
		$limit = 3;
	} else {
		$limit = (int) $limit;
	}
	
	if($type == 'e') {

		$posts = $db_posts->select("fc_posts", "*",[
			"AND" => [
				"OR" => [
					"post_type" => $set_type
				],
				"post_lang" => $languagePack,
				"post_status" => 1,
				"post_releasedate[<]" => $time_string_now,
				"post_event_startdate[>]" => $time_string_now
			],
			
			"ORDER" => ["post_event_startdate" => "ASC"],
			"LIMIT" => $limit,
			
			
		]);		

		
	} else {

		$posts = $db_posts->select("fc_posts", "*",[
			"AND" => [
				"OR" => [
					"post_type" => $set_type
				],
				"post_lang" => $languagePack,
				"post_status" => 1,
				"post_releasedate[<]" => $time_string_now
			],
			
			"ORDER" => ["post_releasedate" => "DESC"],
			"LIMIT" => $limit
		]);		
		
	}
	

	$cnt_posts = count($posts);
	
	if($cnt_posts < 1) {
		echo '<div class="alert alert-info my-3">No matches.</div>';
	}
	
	$card_tpl = file_get_contents('content/plugins/posts/card.tpl');
	
	echo '<div class="row row-cols-1 row-cols-md-3 g-4 my-3">';
	for($i=0;$i<$cnt_posts;$i++) {
		
		$post_image = explode('<->', $posts[$i]['post_images']);
		if($post_image[1] != '') {
			$img = '<img src="'.$post_image[1].'" class="card-img-top" alt="">';
		} else {
			$img = '';
		}
		
		$href = parse_url($posts[$i]['post_rss_url'], PHP_URL_PATH);
		
		$teaser = strip_tags(html_entity_decode($posts[$i]['post_teaser']));
		$teaser = implode(' ', array_slice(explode(' ', $teaser), 0, 25));
		$teaser .= ' <small><em>(...)</em></small>';
		$this_post = $card_tpl;
		$this_post = str_replace('{title}', $posts[$i]['post_title'], $this_post);
		$this_post = str_replace('{text}', $teaser, $this_post);
		$this_post = str_replace('{img}', $img, $this_post);
		$this_post = str_replace('{href}', $href, $this_post);
		$this_post = str_replace('{btn_read_more}', $lang['btn_read_more'], $this_post);
		
		echo '<div class="col">';
		echo $this_post;
		echo '</div>';
	}
	echo '</div>';
		
}
?>