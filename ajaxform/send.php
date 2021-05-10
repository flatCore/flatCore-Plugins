<?php

error_reporting(0);

define('FC_SOURCE', 'frontend');

include_once '../../../config.php';
include_once '../../../database.php';
include_once '../../../global/functions.php';

$fc_prefs = fc_get_preferences();

$recipient['name'] = $fc_prefs['prefs_mailer_name'];
$recipient['mail'] = $fc_prefs['prefs_mailer_adr'];

$prefs_mailer_adr = $recipient['mail'];
$prefs_mailer_name = $recipient['name'];

if(is_file('../../../content/config_smtp.php')) {
	include '../../../content/config_smtp.php';
	$prefs_mailer_type = 'smtp';
}
	
$send_mail = 'true';
$error_msg = '';
	
if(!function_exists('phpform_user_inputs')) {
	function phpform_user_inputs($user_submit) {
		$user_submit = strip_tags($user_submit);
		$user_submit = preg_replace( "/(content-type:|bcc:|cc:|to:|from:)/im", "",$user_submit);
		$user_submit = preg_replace('/\r\n|\r|\n/', '<br>', $user_submit);
		return $user_submit;
	}
}
	

foreach($_POST as $key => $val) {
	${"checked_$key"} = phpform_user_inputs($val); 
}

/* check user inputs */

if($_POST['visitor_csrf_token'] !== $_SESSION['visitor_csrf_token']) {
	$send_mail = "false";
	$error_msg .= '<li>Unable to process your request.</li>';	
}

if(($checked_af_sender_name == "") || ($checked_af_sender_mail == "") || ($checked_af_sender_message == "")) {
	$send_mail = "false";
	$error_msg .= '<li>All mandatory fields (*) must be filled out</li>';
}

if(!filter_var($checked_af_sender_mail, FILTER_VALIDATE_EMAIL)) {
	$send_mail = "false";
	$error_msg .= '<li>Something seems to be wrong with your email address.</li>';
}

if($_POST['privacy_policy'] != 'accept') {
	$send_mail = "false";
	$error_msg .= '<li>You need to confirm that you have read the privacy policy</li>';			
}

if($error_msg !== '') {
	
	$response = '<strong>One or more errors occurred:</strong>';
	$response .= '<ul>'.$error_msg.'</ul>';
	
	$output = json_encode(array('type' => 'error', 'text' => "$response"));
	die($output);
}

/* checks passed succesfully */

$send_date = date('Y-m-d h:i:s');
$send_subject = 'Message from '.$checked_af_sender_name;

$send_text  = '<body>';		
$send_text .= '<table cellpadding="2" border="0">';
$send_text .= '<tr><td>Name:</td><td>'.$checked_af_sender_name.'</td></tr>';
$send_text .= '<tr><td>E-Mail:</td><td>'.$checked_af_sender_mail.'</td></tr>';
$send_text .= '<tr><td>Message:</td><td>'.$checked_af_sender_message.'</td></tr>';
$send_text .= '<tr><td>Time:</td><td>'.$send_date.'</td></tr>';
$send_text .= '</table>';
$send_text .= '</body>';

$phpform_sendmail = fc_send_mail($recipient,$send_subject,$send_text);
if($phpform_sendmail == 1) {
	$output = json_encode(array('type' => 'success', 'text' => 'Thank you for your message.'));
	die($output);
} else {
	
	$output = json_encode(array('type' => 'error', 'text' => 'There has been an error. Please try again.'));
	die($output);
}


?>