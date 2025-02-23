<?php
//Idea from
//http://blog.mailgun.com/double-opt-in-with-php-mailgun/

//Setup
$apiKey = 'd65db7c90a7c824756fda8638a78e1c0-us3';//See Account -> Extras -> API keys
$mailingListId = '1b27dd6423';// Create a MailingList in the control Panel first then see Setting

function SanitizeInputs($var) {
	$sane =  htmlspecialchars($var, ENT_QUOTES);
	return $sane;
}

function SanitizeEmail ($var) {
	$sane =  htmlspecialchars($var, ENT_QUOTES);
	$pattern = "/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/";
	return (preg_match($pattern, $sane, $res)) ? $res[0] : false;
}

function SendConfirmationEmail($recipientAddress, $subjectText, $recipientName) {
    global $apiKey, $mailingListId;

	include('MailChimp.php');
	$MailChimp = new MailChimp($apiKey);
	$result = $MailChimp->call('lists/subscribe', array(
		'id'                => $mailingListId,
		'email'             => array('email'=>$recipientAddress),
		'merge_vars'        => array('FNAME'=>$recipientName, 'LNAME'=>''),
		'double_optin'      => false,
		'update_existing'   => true,
		'replace_interests' => false,
		'send_welcome'      => false,
	));
	//$result Returns Array ( [email] => my@email.com [euid] => xxxxxx [leid] => xxxxxx )
}
