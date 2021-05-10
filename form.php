<?php

/**
 * Plugin: flatForm - SIMPLE E-MAIL FORM
 * Version: Version: 0.3
 * Requirement: flatCore & Swift Mailer
 * License: GNU General Public License
 * copyright (c) 2018, Patrick Konstandin
 * flatcore.org
 *
 * Instructions
 * 1. copy this file in /content/plugins/
 * 2. type in pages content [plugin=form.php][/plugin]
 */
$plugin = array();
$plugin['title'] = 'contact form';
$plugin['description'] = '<p>send requests via e-mail to prefs_mailer_adr</p>';
$plugin['version'] = '1.0';
$plugin['author'] = 'flatCore.org';

date_default_timezone_set('UTC');

if(FC_SOURCE == 'frontend') {
	
	global $fc_prefs;
	global $fct_slug;
	
	if($fct_slug == '') {
		$fct_slug = '/';
	}
	
	$recipient['name'] = $fc_prefs['prefs_mailer_name'];
	$recipient['mail'] = $fc_prefs['prefs_mailer_adr'];
	
	$send_mail = "true";
	
	if (!function_exists('phpform_user_inputs')) {
		function phpform_user_inputs($user_submit) {
			$user_submit = strip_tags($user_submit);
			$user_submit = preg_replace( "/(content-type:|bcc:|cc:|to:|from:)/im", "",$user_submit);
			$user_submit = preg_replace('/\r\n|\r|\n/', '<br>', $user_submit);
			return $user_submit;
		}
	}
	
	
	foreach($_REQUEST as $key => $val) {
		${"checked_$key"} = phpform_user_inputs($val); 
	}
	
	
	if($_POST['send']) {
		
		// required fields
		if(($checked_vorname == "") || ($checked_nachname == "") || ($checked_mail == "")) {
			$send_mail = "false";
			$error_msg .= '<p>Alle Pflichtfelder (*) müssen ausgefüllt werden</p>';
		}
		
		if(!filter_var($checked_mail, FILTER_VALIDATE_EMAIL)) {
			$send_mail = "false";
			$error_msg .= '<p>Mit der E-Mail Adresse <em>'.$checked_mail.'</em> scheint etwas nicht zu stimmen.</p>';
		}
		
		if($_POST['check1'] != 'datenschutzbestimmungen') {
			$send_mail = "false";
			$error_msg .= '<p><strong>Sie müssen bestätigen, dass Sie die Datenschutzbestimmungen gelesen haben</strong> ...</p>';			
		}
		

		/* honeypot */
		if($_POST['firstname'] != '') {
			$send_mail = "false";
			$error_msg .= '';
		}
		
		$send_date = date('Y-m-d h:i:s');
		$send_subject = 'Kontaktformular von '. $checked_vorname . ' '. $checked_nachname;
		
		$send_text  = '<body>';		
		$send_text .= '<table cellpadding="2" border="0">';
		$send_text .= '<tr><td>Name:</td><td>'.$checked_vorname.' '.$checked_nachname.'</td></tr>';
		$send_text .= '<tr><td>Telefon:</td><td>'.$checked_tel.'</td></tr>';
		$send_text .= '<tr><td>E-Mail:</td><td>'.$checked_mail.'</td></tr>';
		$send_text .= '<tr><td>Nachricht:</td><td>'.$checked_comment.'</td></tr>';
		$send_text .= '</table>';
				
		$send_text .= '</body>';
		
		/* SEND E-MAIL */
		if($send_mail == "true") {
			
			
			$phpform_sendmail = fc_send_mail($recipient,$send_subject,$send_text);
			
			if($phpform_sendmail == 1) {
				echo '<p class="alert alert-success"><strong>Vielen Dank für Ihre Anfrage.</strong></p>';
				unset($checked_firstname,$checked_anreise,$checked_abreise,$checked_personen,$checked_vorname,$checked_nachname,$checked_strasse,$checked_plz,$checked_ort,$checked_tel,$checked_mail,$checked_comment);
			} else {
				echo '<p class="alert alert-danger"><strong>Es ist ein Fehler aufgetreten</strong></p>';
			}
			
		}
		
		
		
	}
	
	if($error_msg != '') {
		echo '<div class="alert alert-danger">'.$error_msg.'</div>';
	}


	echo '<form class="form" action="'.$fct_slug.'" accept-charset="utf-8" method="POST">';
	
	/* honeypot */
	echo '<div class="form-group hidden">';
	echo '<label for="inputFirstname" class="col-sm-4 control-label">Firstname</label>';
	echo '<div class="col-sm-8">';
	echo '<input type="text" class="form-control" name="firstname" id="inputFirstname" value="'.$checked_firstname.'">';
	echo '</div>';
	echo '</div>';
	
		
	
	
	echo '<div class="row">';
	echo '<div class="col-md-6">';
	
	echo '<div class="form-group">';
	echo '<label for="vorname" class="control-label">Vorname</label>';
	echo '<input type="text" class="form-control" name="vorname" id="vorname" value="'.$checked_vorname.'">';
	echo '</div>';

	echo '</div>';
	echo '<div class="col-md-6">';	
	
	echo '<div class="form-group">';
	echo '<label for="nachname" class="control-label">Nachname</label>';
	echo '<input type="text" class="form-control" name="nachname" id="nachname" value="'.$checked_nachname.'">';
	echo '</div>';

	echo '</div>';
	echo '</div>';	
	

	
	echo '<div class="row">';
	echo '<div class="col-md-6">';
	
	echo '<div class="form-group">';
	echo '<label for="tel" class="control-label">Telefon</label>';
	echo '<input type="text" class="form-control" name="tel" id="tel" value="'.$checked_tel.'">';
	echo '</div>';

	echo '</div>';
	echo '<div class="col-md-6">';	
	
	echo '<div class="form-group">';
	echo '<label for="mail" class="control-label">E-Mail Adresse</label>';
	echo '<input type="text" class="form-control" name="mail" id="mail" value="'.$checked_mail.'">';
	echo '</div>';

	echo '</div>';
	echo '</div>';	

	
	echo '<hr>';

	echo '<div class="form-group">';
	echo '<label for="comment" class="control-label">Nachricht</label>';
	echo '<textarea class="form-control" name="comment" id="comment">'.$checked_comment.'</textarea>';
	echo '</div>';


	echo '<div class="row">';
	echo '<div class="col-md-9">';
	
	echo '<div class="form-group">';
	echo '<div class="checkbox">';
	echo '<label>';
	echo '<input type="checkbox" name="check1" value="datenschutzbestimmungen"> Ich habe die <a href="/datenschutz/">Datenschutzbestimmungen</a> gelesen, verstanden und akzeptiere sie.';
	echo '</label>';
	echo '</div>';
	echo '</div>';
	
	echo '</div>';
	echo '<div class="col-md-3">';

	echo '<div class="form-group">';
	echo '<div class="text-center">';
	echo '<input type="submit" class="btn btn-success btn-block" name="send" value="Senden">';
	echo '</div>';
	echo '</div>';
	
	echo '</div>';
	echo '</div>';	
	
	echo '</form>';
	
	
}
?>