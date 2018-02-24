<?php
	if($_SERVER["REQUEST_METHOD"] == "POST") :

		header("Access-Control-Allow-Origin: *");
		require_once 'mail/mail.php';

		$form_mail = (new SEND_MAIL)
			->to('seva.kurochka@gmail.com')
			->from('from@gmail.com')
			->subject('Subject')
			->template('mail/tpl/email.php', [
				'title'			=> $_POST['info']['title'],
				'subtitle'	=> $_POST['info']['subtitle'],
				'subject'		=> $_POST['info']['subject'],
				'contacts'	=> $_POST['contacts']
			])
			->send();

	else:
		die('No direct access');
	endif;
?>