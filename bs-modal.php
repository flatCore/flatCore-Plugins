<?php

/**
 * Show Textsnippets in Bootstrap Modal
 * [plugin=bs-modal.php]fcs=snippet[/plugin]
 * snippet = name of your snippet
 *
 * Modal: http://getbootstrap.com/javascript/#modals
 */

/* backend */
	
$plugin = array();
$plugin['title'] = 'Modal Plugin';
$plugin['description'] = '<p>Show Textsnippets in Bootstrap Modal</p>';
$plugin['version'] = '0.1';
$plugin['author'] = 'Patrick Konstandin';

/* frontend */

if(FC_SOURCE == 'frontend') {
	
	global $db_content;
	global $languagePack;
	
	$textlibData = $db_content->get("fc_textlib", "*",[
			"textlib_name" => $fcs,
			"textlib_lang" => $languagePack
	]);

	foreach($textlibData as $k => $v) {
		$$k = stripslashes($v);
	}
	
	
	echo '<button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#bsModal'.$fcs.'">'.$textlib_title.'</button>';
	
	echo '
	<div class="modal fade" id="bsModal'.$fcs.'" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title">'.$textlib_title.'</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        '.$textlib_content.'
      </div>
    </div>
  </div>
</div>';
}
?>