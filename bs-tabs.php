<?php

/**
 * Show Snippets in Bootstrap tabs
 * [plugin=bs-tabs.php]key=word[/plugin]
 * key = keyword of your snippets
 */

/* backend */
$plugin = array();
$plugin['title'] = 'Tabs Plugin';
$plugin['description'] = '<p>Show Textsnippets in Bootstrap3 Tabs</p>';
$plugin['version'] = '0.1';
$plugin['author'] = 'flatCore DevTeam';

/* frontend */

if(FC_SOURCE == 'frontend') {
	
	global $db_content;
	global $languagePack;

	$tabs = $db_content->select("fc_textlib", "*",[
			"textlib_keywords" => $key,
			"textlib_lang" => $languagePack,
		
			"ORDER" => [
				"textlib_priority" => "DESC"
			]
	]);


	echo '<div class="card p-3 mt-3">';
	echo '<nav>';
	echo '<div class="nav nav-tabs" id="nav-tab" role="tablist">';
	
	$x = 0;
	foreach($tabs as $tab) {
		
		$id = 'tabid'.$tab['textlib_id'];
		
		if($x==0) {
			$class = 'nav-link active';
		} else {
			$class = 'nav-link';
		}
		
		echo '<button class="'.$class.'" data-bs-toggle="tab" data-bs-target="#'.$id.'" type="button" role="tab">'.$tab['textlib_permalink_name'].'</button>';
		$x++;
	}
	echo '</div>';
	echo '</nav>';
	
	
	echo '<div class="tab-content p-2" id="myTabContent">';
	
	$x = 0;
	foreach($tabs as $tab) {
		$id = 'tabid'.$tab['textlib_id'];
		if($x==0) {
			$class = 'tab-pane fade show active';
		} else {
			$class = 'tab-pane fade';
		}
		echo '<div class="'.$class.'" id="'.$id.'" role="tabpanel">';
		echo '<h5>'.$tab['textlib_title'].'</h5>';
		echo $tab['textlib_content'];
		echo '</div>';
		$x++;
	}
	
	echo '</div>';
	echo '</div>';
	

	
}

?>