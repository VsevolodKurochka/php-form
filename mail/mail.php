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

		function __construct($settings){
			
			$this->to 				= $settings['to'];
			$this->from 			= $settings['from'];
			$this->subject 		= $settings['subject'];
			$this->variables  = $settings['variables'];
			$this->template 	= $settings['template'];


			if( isset($settings['redirect']) ) {
				$this->redirect = $settings['redirect'];
				
			}

			if( isset($settings['redirect_add_get_params']) ) {
				$this->redirect_add_get_params = $settings['redirect_add_get_params'];
			}
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

			if(!file_exists($this->template)){
				throw new Exception('File not found');
			}

			ob_start();

			include($this->template);
			$output = ob_get_contents();

			ob_end_clean();

			return $output;
		}

		private function redirect(){

			// If user enable redirect
			if( isset($this->redirect) ){

				// If user enable redirect with adding to thx page
				if(isset($this->redirect_add_get_params)){

					// Set first element as true
					$first = true;

					// Create variable with our GET params
					$get_params = '';


					// If in our variables
					// we have contact(name, phone, email, etc)
					if( isset($this->variables['contacts']) ){
						foreach ($this->variables['contacts'] as $contact => $contact_info) {
							if($first){
								$first = false;
								$get_params .= '?' . $contact . '=' . $contact_info;
							}else{
								$get_params .= '&' . $contact . '=' . $contact_info;
							}
						}
					}
					
					
				}else{
					$redirect = $this->redirect;
				}

				//header('Location: ' . $redirect);
			}
		}

		public function send() {
			//mail($this->to, $this->subject, $this->render(), $this->create_headers() );
			$this->redirect();
		}
	}
?>