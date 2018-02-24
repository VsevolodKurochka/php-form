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
		private $to = [];
		private $from = '';
		private $subject = '';


		function __construct($to, $from, $subject){
			$this->to = $to;
			$this->from = $from;
			$this->subject = $subject;
		}

		public function to($to){
			if(is_array($to)){
				$this->to = $to;
			}else{
				$this->to = [$to];
			}
			return $this;
		}

		private function build_headers() {
			$headers  = "From: " . strip_tags($this->from) . "\r\n";
			$headers .= "Reply-To: ". strip_tags($this->from) . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html;charset=utf-8 \r\n";
			$headers .= "Content-Transfer-Encoding: 8bit \r\n";

			return $headers;
		}

		private function build_body() {
			$message 	= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
			$message .= '<html xmlns="http://www.w3.org/1999/xhtml">';
			$message .= '<head><meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/></head>';
			$message .= '<body>';
			$message .= '<div style="background-color:#f7f7f7;margin:0;padding:70px 0 70px 0;width:100%;">';
				$message .= '<div style="width: 600px; max-width: 100%; margin-left: auto; margin-right: auto;">';
					$message .= '<h1 style="background-color: #96588a; color: #fff; font-weight: bold; padding: 20px 30px; margin-bottom: 0;">'.$_POST['info']['title'].'</h1>';
					$message .= '<div style="padding: 35px; background-color: #fff;">';
						$message .= '<p style="margin-top: 0; letter-spacing: 1px;">'.$_POST['info']['subtitle'].'</p>';

						$message .= '<table rules="all" style="border: 1px solid #e5e5e5; width: 100%; max-width: 100%; color: #636363; margin-bottom: 60px;" cellpadding="15">';

							foreach($message_fields as $field => $field_key) {

								$contact_field = $_POST['contacts'][$field];

								if( !empty($contact_field) && isset($contact_field) ){
									$message .= '<tr>';
									$message .= '<th style="text-align: left;">'.$field_key['title'].'</th>';
									$message .= '<td>'.strip_tags($contact_field).'</td>';
									$message .= '</tr>';
								}
							}

						$message .= '</table>';

						$message .= '<p style="text-align: center; font-size: 12px; color: #c09bb9;">'.$settings['subject'].'</p>';

					$message .= '</div>';
				$message .= '</div>';
			$message .= '</div>';
			$message .= '</body></html>';

			return $message;
		}

		public function send() {
			return wp_mail($this->to, $this->subject, $this->build_body, $this->build_headers)
		}
	}
?>