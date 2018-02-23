<?php
	header("Access-Control-Allow-Origin: *");
	if($_SERVER["REQUEST_METHOD"] == "POST"){

		//print_r($_POST);
		$default = array(
			'email' 		=> 'seva.kurochka@gmail.com',
			'sendfrom' 	=> 'ourLanding@gmail.com',
			'subject'  	=> 'Site Subject'
		);

		$settings = array(
			'email' 		=> ( !empty($_POST['change_email']) && isset($_POST['change_email']) ) ? $_POST['change_email'] : $default['email'],
			'subject' 	=> ( !empty($_POST['info']['subject']) && isset($_POST['info']['subject']) ) ? $_POST['info']['subject'] : $default['subject']
		);

		$fields = array(
			'name' 			=> array(
				'title' 		=> 'Name'
			),
			'email' 			=> array(
				'title' 		=> 'Email'
			), 
			'phone' 			=> array(
				'title'			=> 'Phone'
			)
		);

		function createHeaders($from){
			$headers  = "From: " . strip_tags($from) . "\r\n";
			$headers .= "Reply-To: ". strip_tags($from) . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html;charset=utf-8 \r\n";
			$headers .= "Content-Transfer-Encoding: 8bit \r\n";

			return $headers;
		}

		function createMessage($message_fields){
			$message 	= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
			$message .= '<html xmlns="http://www.w3.org/1999/xhtml">';
			$message .= '<head><meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/></head>';
			$message .= '<body>';
			$message .= '<div style="background-color:#f7f7f7;margin:0;padding:70px 0 70px 0;width:100%;">';
				$message .= '<div style="width: 600px; max-width: 100%; margin-left: auto; margin-right: auto;">';
					$message .= '<h1 style="background-color: #96588a; color: #fff; font-weight: bold; 	font-family: "Helvetica Neue",Helvetica,Roboto,Arial,sans-serif;">'.$_POST['info']['title'].'</h1>';
					$message .= '<table rules="all" style="border: 1px solid #999; width: 100%" cellpadding="10">';

						foreach($message_fields as $field => $field_key) {

							$contact_field = $_POST['contacts'][$field];

							if( !empty($contact_field) && isset($contact_field) ){
								$message .= '<tr>';
								$message .= '<td><b>'.$field_key['title'].'</b></td>';
								$message .= '<td>'.strip_tags($contact_field).'</td>';
								$message .= '</tr>';
							}
						}

					$message .= '</table>';
				$message .= '</div>';
			$message .= '</div>';
			$message .= '</body></html>';

			return $message;	
		}

		$to 				= $settings['email']; 
		$subject 		= $settings['subject'];
		$sendfrom 	= $default['sendfrom'];
		
		$headers = createHeaders($sendfrom);
		$message = createMessage($fields);



		$send  			= mail($to, $subject, $message, $headers);
		
	}else{
		die('No direct access');
	}
	//${"data_{$field}"}
?>