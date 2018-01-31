// https://www.youtube.com/watch?v=bOkwPy4JNtA
(function(){
	window.addEventListener("DOMContentLoaded", function () {
		
		function log(logText){
			console.log(logText);
		}
		function hasClass(element, cls) {
			return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
		}
		function addClass(element, cls) {
			if(! hasClass(element, cls) ){
				element.classList += " " + cls;
			}
		}
		function removeClass(element, cls){
			if(hasClass(element, cls)){
				element.classList.remove(cls);
			}
		}
		function toggleClass(element, cls){
			if( hasClass(element, cls) ){
				removeClass(element, cls)
			}else{
				addClass(element, cls);
			}
		}

		// Validation
			function showError(container, message) {
				//container.className += ' error';
				addClass(container, 'vform__row_status_error');
				var msg = document.createElement('p');
				addClass(msg, 'vform__message vform__message_error');
				//msg.className = 'error-message';
				msg.innerHTML = message;
				container.appendChild(msg);
			}
			function hideError(container){
				//container.classList.remove('error');
				// removeClass(container, 'error');
				// var errorMessages = container.getElementsByClassName('vform__message');
				// while(errorMessages.length > 0){
				// 	errorMessages[0].remove();
				// }
			}

			// var errors = {
			// 	required: 'Required.',
			// 	noNumbers: 'There should not be numbers.',
			// 	email: 'Sorry, this doesn\'t look like a valid email.'
			// }

			var rules = {
				required: function(el){
					if(el.value != ''){
						return true;
					}
					return false;
				},
				noNumbers: function(el){
					var numbersReg = /\d/;
					if(numbersReg.test(el.value)){
						return false;
					}else{
						return true;
					}
				},
				numbers: function(el){
					return !isNaN(el.value);
				},
				email: function(el){
					var reg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
					return reg.test(el.value);
				}
			}


		for(var i = 0; i < document.forms.length; i++){
			document.forms[i].addEventListener('submit', formValidator);
		}
		function formValidator(event){
			event.preventDefault();

			var vform = this;
			var vformEl = vform.elements;
			var vformErrors = [];
			var allInputs = vform.getElementsByTagName("input");
			var allInputsLength = allInputs.length;
			var action = vform.getAttribute('action');

			for(var j = 0; j < allInputsLength; j++){
				var thisInput = allInputs[j];
				if(thisInput.dataset.rule){
					removeClass(vform, 'vform_error');
					removeClass(thisInput.parentNode, 'vform__row_status_error');

					var thisRule = thisInput.dataset.rule.split(' ');
					var thisRuleLength = thisRule.length;

					for(var k = 0; k < thisRuleLength; k++){

						if(thisRule[k] in rules){

							if(!rules[thisRule[k]](thisInput)){

								vformErrors.push({
									name: thisInput.name,
									error: thisRule[k]
								});

								
								addClass(thisInput.parentNode, 'vform__row_status_error');

								addClass(vform, 'vform_error');
								setTimeout(function(){
									removeClass(vform, 'vform_error');
								},1000);

							}

						}

					}

					thisInput.addEventListener('keydown', function(){

						var thisInputData = this.dataset.rule.split(' ');
						var thisInputDataLength = thisInputData.length;
						removeClass(this.parentNode, 'vform__row_status_error');

						for(var s = 0; s < thisInputDataLength; s++){

							if(thisInputData[s] in rules){

								if(!rules[thisInputData[s]](this)){
									removeClass(this.parentNode, 'vform__row_status_success');
									addClass(this.parentNode, 'vform__row_status_error');
								}else{
									removeClass(this.parentNode, 'vform__row_status_error');
									addClass(this.parentNode, 'vform__row_status_success');
								}

							}

						}

					});

				}

			}
			if( vformErrors.length == 0 ){
				var dataSend = new FormData(this);
				var httpSend = new XMLHttpRequest();
				httpSend.open('POST',action,true);

				var sending = document.createElement('p');
				addClass(sending, 'loading');
				sending.innerHTML = 'Идет отправка сообщения..';
				this.appendChild(sending);

				httpSend.onload = function(){
					if(this.readyState == 4 && this.status == 200){
						var loading = document.getElementsByClassName('loading')[0];
						addClass(sending, 'success');
						loading.innerHTML = 'Сообщение отправлено. Ждите звонка';
						setTimeout(function(){
							loading.remove();
							if( vformEl.changeLocation ){
								location.href = vformEl.changeLocation.value;
							}
						}, 1500);
					}
				};
				httpSend.send(dataSend);
			}
		}	
	});
})();