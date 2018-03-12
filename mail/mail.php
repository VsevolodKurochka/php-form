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

				$redirect = '';

				// If user enable redirect with adding to thx page
				if(isset($this->redirect_add_get_params)){

					// Set first element as true
					$first = true;

					// Create variable with our GET params
					$get_params = '';


					// If in our variables
					// we have contacts array(name, phone, email, etc)
					if( isset($this->variables['contacts']) ){

						// Iteration of our array with contacts info
						foreach ($this->variables['contacts'] as $contact => $contact_info) {

							// If it first element of array
							if($first){

								// Set false
								$first = false;

								// Start adding GET params with `?`
								$get_params .= '?' . $contact . '=' . $contact_info;
							}else{

								// adding GET params with `&`
								$get_params .= '&' . $contact . '=' . $contact_info;
							}
						}
					}

					$redirect .= $this->redirect . $get_params;
					
					
				}else{
					$redirect .= $this->redirect;
				}

				// Change location with our redirect(with or without addition information(email, phone, name, etc))
				header('Location: ' . $redirect);
			}
		}

		public function send() {
			mail($this->to, $this->subject, $this->render(), $this->create_headers() );
			$this->redirect();
		}
	}
?>