<?php
	/**
	 * SEND_MAIL
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

		private $variables = [];
		private $template = FALSE;

		function __construct($settings){
			$this->to = $settings['to'];
			$this->from = $settings['from'];
			$this->subject = $settings['subject'];
		}

		private function create_headers() {
			$headers  = "From: " . strip_tags($this->from) . "\r\n";
			$headers .= "Reply-To: ". strip_tags($this->from) . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html;charset=utf-8 \r\n";
			$headers .= "Content-Transfer-Encoding: 8bit \r\n";

			return $headers;
		}

		private function render(){
			ob_start();
			include($this->template);
			$output = ob_get_contents();
			ob_end_clean();
	    return $output;
		}

		public function template($template, $variables = []) {

			if(!file_exists($template)){
				throw new Exception('File not found');
			}

			$this->variables = $variables;
			$this->template = $template;

			return $this;
		}


		public function send() {
			return mail($this->to, $this->subject, $this->render(), $this->create_headers() );
		}
	}
?>