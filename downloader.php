<?php
	
/**
 * Download Images from your /content/images/ folder
 * [plugin=downloader.php]f=filename[/plugin]
 * filename: filename of your image
 *
 * Dependencies:
 * - Bootstrap Grid
 * - Fancybox (class name for links in this Plugin is 'lightbox')
 */
	
/* backend */
	
$plugin = array();
$plugin['title'] = 'Download Plugin';
$plugin['description'] = '<p>Offer Images for Download</p>';
$plugin['version'] = '0.1';
$plugin['author'] = 'Patrick Konstandin';


/* frontend */

if(FC_SOURCE == 'frontend') {
	
	global $fct_slug;
	global $mod_slug;

	$plugin_target = FC_INC_DIR . "/$fct_slug" . "$mod_slug";
	
	$allowed_path = "content/images/";
	$file = basename($_GET['f']);
	
	$download_file = 'content/images/'.basename($_GET['dlf']);
	
	if(is_file("$download_file")) {
		
		if(preg_match("/MSIE/i", $_SERVER["HTTP_USER_AGENT"]) ) { 
			header("Content-type: application/x-msdownload"); 
		} else { 
			header("Content-type: application/octetstream");
		}

		header("Content-Length: ".filesize($download_file)); 
		header("Content-Discription: Beschreibung des Downloads"); 
		header("Pragma: no-cache"); 
		header("Expires: 0"); 
		header("Content-Disposition: attachment; filename=$download_file");  
		readfile($download_file);
		exit;
		
		
	} else {
		echo '<a href="'.$plugin_target.'?dlf='.$f.'" class="btn btn-default btn-sm">Download</a>';
	}
	
	
}

?>