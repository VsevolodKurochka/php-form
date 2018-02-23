<!DOCTYPE html>
<html lang="ru">
<head>
	<title>PHP form</title>
	<meta name="description" content="PHP form">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <!--[if lte IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <link href="css/style.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700,900&amp;amp;subset=cyrillic" rel="stylesheet">
  </head>
  <body>
  	<main class="main-wrapper">
  		<section class="section">
  			<div class="container">
  				<div class="vak xs-6">
  					<form class="form" action="mail.php" method="POST">
              <input type="hidden" name="info[subject]" value="Adventure Tours - Chernobyl">
              <input type="hidden" name="info[title]" value="Форма с модального окна">
              <input type="hidden" name="info[subtitle]" value="Детали заказа от <?php echo date('d-m-Y'); ?>">
  						<div class="form__row">
  							<input name="contacts[name]" type="text" placeholder="Имя"><span class="form-line"></span>
  						</div>
  						<div class="form__row">
  							<input name="contacts[email]" type="text" placeholder="E-mail"><span class="form-line"></span>
  						</div>
  						<div class="form__row">
  							<input name="contacts[phone]" type="text" placeholder="Телефон"><span class="form-line"></span>
  						</div>
  						<div class="form__row">
  							<button class="btn btn_main" type="submit">Получить!</button>
  						</div>
  						<!-- <input type="hidden" name="change_email" value="seva.kurochka@gmail.com">
  						<input type="hidden" name="form_place" value="First form">
  						<input type="hidden" name="change_location" value="thx.html">
  						<input type="hidden" name="subject" value="NEW"> -->
  					</form>
  				</div>
  			</div>
  		</section>
  	</main>
  </body>
</html>