<?php

/**
 * Plugin: SIMPLE E-MAIL FORM
 * Version: Version: 0.1
 * Requirement: flatCore 2.0.+
 * License: GPL-3.0 License
 * copyright (c) 2021, Patrick Konstandin
 *
 */
 
$plugin = array();
$plugin['title'] = 'contact form';
$plugin['description'] = '<p>send requests via e-mail to prefs_mailer_adr</p>';
$plugin['version'] = '1.0';
$plugin['author'] = 'flatCore.org';

if(FC_SOURCE == 'frontend') {
	
	global $fc_prefs;
	global $fct_slug;
		
	$tpl = file_get_contents('content/plugins/ajaxform/form.tpl');
	$tpl = str_replace('{sender_name}', '', $tpl);
	$tpl = str_replace('{sender_mail}', '', $tpl);
	$tpl = str_replace('{sender_message}', '', $tpl);
	$tpl = str_replace('{csrf_token}', $_SESSION['visitor_csrf_token'], $tpl);
	
	echo '<div id="ajaxform_response"></div>';
	
	echo '<div class="card p-3 mb-3">';
	echo $tpl;
	echo '</div>';
}

?>

<script>
$(function () {

	$('#ajaxform').on('submit', function (e) {
		
		e.preventDefault();
		
		$.ajax({
	  	type: 'POST',
	    url: 'content/plugins/ajaxform/send.php',
	    data: $('#ajaxform').serialize(),
	    dataType : 'json',
	    success: function(response) { 

	       if(response.type == 'error') {
	       	output = '<div class="alert alert-danger">'+response.text+'</div>';
	       } else {
	       	output = '<div class="alert alert-success">'+response.text+'</div>';
	       
				 	$('#ajaxform input[type=text]').val('');
				 	$('#ajaxform input[type=email]').val('');
	       	$('#ajaxform textarea').val('');
	       	$('#ajaxform input[type=checkbox]').prop('checked', false);
	      }

      	$("#ajaxform_response").hide().html(output).slideDown();           
      	
	    },
	    async: false
	  });
  });
});
</script>