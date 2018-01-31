<?php
	header("Access-Control-Allow-Origin: *");
	if($_SERVER["REQUEST_METHOD"] == "POST"){

		$default = array(
			'email' 		=> 'seva.kurochka@gmail.com',
			'sendfrom' 	=> 'ourLanding@gmail.com',
			'subject'  	=> 'Site Subject'
		);

		$settings = array(
			'email' 		=> ( !empty($_POST['changeEmail']) && isset($_POST['changeEmail']) ) ? $_POST['changeEmail'] : $default['email'],
			'subject' 	=> ( !empty($_POST['vsubject']) && isset($_POST['vsubject']) ) ? $_POST['vsubject'] : $default['subject']
		);

		$fields = array(
			'vname' 			=> array(
				'title' 		=> 'Name'
			),
			'vemail' 			=> array(
				'title' 		=> 'Email'
			), 
			'vphone' 			=> array(
				'title'			=> 'Phone'
			),
			'vcountForm' 	=> array(
				'title'			=> 'Form submission place'
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
			$message .= '<table rules="all" style="border: 1px solid #999;" cellpadding="10">';
			foreach($message_fields as $field => $field_key) {
				if( !empty($_POST[$field]) && isset($_POST[$field]) ){
					$message .= '<tr>';
					$message .= '<td><b>'.$field_key['title'].'</b></td>';
					$message .= '<td>'.strip_tags($_POST[$field]).'</td>';
					$message .= '</tr>';
				}
			}
			$message .= "</table>";
			$message .= "</body></html>";

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