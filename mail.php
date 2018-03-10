<?php
	if($_SERVER["REQUEST_METHOD"] == "POST") :

		header("Access-Control-Allow-Origin: *");
		require_once 'mail/mail.php';

		$form_mail = ( new SEND_MAIL(array(
			'to'			=> 'seva.kurochka@gmail.com',
			'from'		=> 'ourLanding@gmail.com',
			'subject'	=> 'Subject'
		)) )
		->template('mail/tpl/email.php', [
			'info'			=> $_POST['info'],
			'contacts'	=> $_POST['contacts']
		])
		->send();

	else:
		die('No direct access');
	endif;
?>