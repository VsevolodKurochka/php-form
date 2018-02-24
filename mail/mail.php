<?php
	/**
	 * WP_Mail
	 *
	 * A simple class for creating and
	 * sending Emails
	 *
	 * @author     Vsevolod Kurochka <seva.kurochka@gmail.com>
 */
	class SEND_MAIL
	{
		public $to = [];
		private $from = '';
		private $subject = '';

		private $variables = [];
		private $template = FALSE;


		function __construct(){}

		public function to($to){
			$this->to = $to;
			return $this;
		}

		public function from($from) {
			$this->from = $from;
			return $this;
		}

		public function subject($subject) {
			$this->subject = $subject;
			return $this;
		}

		private function create_headers() {
			$headers  = "From: " . strip_tags($this->from) . "\r\n";
			$headers .= "Reply-To: ". strip_tags($this->from) . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html;charset=utf-8 \r\n";
			$headers .= "Content-Transfer-Encoding: 8bit \r\n";

			return $headers;
		}

		public function create_template($template, $variables = []) {
			if(!file_exists($template)){
				throw new Exception('File not found');
			}

			$this->variables = $variables;
			$this->template = $template;

			return $this;
		}

		private function render(){
			$template = file_get_contents($this->template);
			preg_match_all('/\{\{\s*.+?\s*\}\}/', $template, $matches);
			foreach($matches[0] as $match){
				$var = str_replace('{', '', str_replace('}', '', preg_replace('/\s+/', '', $match)));
				if(isset($this->variables[$var])){
					$template = str_replace($match, $this->variables[$var], $template);
				}
			}
			return $template;
		}

		// private function build_body() {
		// 	$message 	= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
		// 	$message .= '<html xmlns="http://www.w3.org/1999/xhtml">';
		// 	$message .= '<head><meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/></head>';
		// 	$message .= '<body>';
		// 	$message .= '<div style="background-color:#f7f7f7;margin:0;padding:70px 0 70px 0;width:100%;">';
		// 		$message .= '<div style="width: 600px; max-width: 100%; margin-left: auto; margin-right: auto;">';
		// 			//$message .= '<h1 style="background-color: #96588a; color: #fff; font-weight: bold; padding: 20px 30px; margin-bottom: 0;">'.$_POST['info']['title'].'</h1>';
		// 			$message .= '<div style="padding: 35px; background-color: #fff;">';
		// 				//$message .= '<p style="margin-top: 0; letter-spacing: 1px;">'.$_POST['info']['subtitle'].'</p>';

		// 				$message .= '<table rules="all" style="border: 1px solid #e5e5e5; width: 100%; max-width: 100%; color: #636363; margin-bottom: 60px;" cellpadding="15">';

		// 					// foreach($message_fields as $field => $field_key) {

		// 					// 	$contact_field = $_POST['contacts'][$field];

		// 					// 	if( !empty($contact_field) && isset($contact_field) ){
		// 					// 		$message .= '<tr>';
		// 					// 		$message .= '<th style="text-align: left;">'.$field_key['title'].'</th>';
		// 					// 		$message .= '<td>'.strip_tags($contact_field).'</td>';
		// 					// 		$message .= '</tr>';
		// 					// 	}
		// 					// }

		// 				$message .= '</table>';

		// 				//$message .= '<p style="text-align: center; font-size: 12px; color: #c09bb9;">'.$settings['subject'].'</p>';

		// 			$message .= '</div>';
		// 		$message .= '</div>';
		// 	$message .= '</div>';
		// 	$message .= '</body></html>';

		// 	return $message;
		// }

		public function send() {
			return mail($this->to, $this->subject, $this->render(), $this->create_headers() );
		}
	}
?>