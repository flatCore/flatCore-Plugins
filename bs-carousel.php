<?php

/**
 * Create Twitter Bootstrap Carousel
 * Filter uploaded images by keyword and order by priority
 * example: [plugin=bs-carousel.php]key=keyword[/plugin]
 *
 * Requirement:	flatCore Theme which Bootstrap 5
 * License: GPL-3.0 License
 * copyright (c) 2021, Patrick Konstandin
 */

if(FC_SOURCE == 'frontend') {

	global $db_content;
	global $languagePack;
		
	$slides = $db_content->select("fc_media", "*",[
			"media_keywords" => $key,
			"media_lang" => $languagePack,
		
			"ORDER" => [
				"media_priority" => "DESC"
			]
	]);
	
	
	$cnt_slides = count($slides);
	
	
	for($i=0;$i<$cnt_slides;$i++) {
	
	  unset($active_item);
		if($i==0) {	$active_item = 'active'; }
		
		$item_src = str_replace('../content/', '/content/', $slides[$i]['media_file']);
	
		$carousel_imgs_str .= '
			<div class="carousel-item '.$active_item.'">
				<img src="'.$item_src.'" alt="'.$slides[$i]['media_file'].'">
			</div>';
			
	}
	
	echo '<div id="carousel'.$key.'" class="carousel slide" data-bs-ride="carousel">';
	
	echo '<div class="carousel-inner">';
	echo $carousel_imgs_str;
	echo '</div>';
	
	echo '</div>';
}