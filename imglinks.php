<?php
	
/**
 * simple Gallery Plugin by
 * Patrick Konstandin - support@flatcore.org
 * Licence: CC BY-NC-SA 3.0 DE - http://creativecommons.org/licenses/by-nc-sa/3.0/de/
 */
	
$plugin = array();
$plugin['title'] = 'ImagesAndLinks';
$plugin['description'] = '<p>This Plugin generates a gallery from your Images.</p><p>Filter your Gallery by Keywords e.g. <strong>gallery</strong>. Include the Plugin via <code>[plugin=imglinks.php]key=keyword[/plugin]</code>';
$plugin['version'] = '0.1';
$plugin['author'] = 'flatCore.org';

global $fct_slug;
global $mod_slug;

$plugin_target = FC_INC_DIR . "/$fct_slug" . "$mod_slug";

if(FC_SOURCE !== 'backend') {
	
	global $db_content;
	global $languagePack;
	
	$images = $db_content->select("fc_media", "*",[
			"media_keywords" => $key,
			"media_lang" => $languagePack,
		
			"ORDER" => [
				"media_priority" => "DESC"
			]
	]);
		
	$cnt_images = count($images);

	echo '<div class="container">';
	echo '<div class="row">';
	for($i=0;$i<$cnt_images;$i++) {
		
		$filename = '';
		$link = '';
		$classes = '';
		$filename = basename($images[$i]['media_file']);
		$link = $images[$i]['media_url'];
		$text = $images[$i]['media_text'];
		$title = stripslashes($images[$i]['media_title']);
		$classes = str_replace(',',' ',$images[$i]['media_keywords']);
		$classes = str_replace('galerie',' ',$classes);		
		
		
		if($link == '') {
			$link_start = '<a class="lightbox" href="/content/images/'.$filename.'" title="'.$title.'">';
		} else {
			$link_start = '<a class="" href="'.$link.'" title="'.$title.'" target="_blank">';
		}

		echo '<div class="col-4 mb-3">';
		echo $link_start;
		echo '<img src="/content/images/'.$filename.'" class="img-thumbnail img-fluid">';
		echo '</a>';
		echo '</div>';


	
	}
	
	echo '</div>';
	echo '</div>';
}


?>
