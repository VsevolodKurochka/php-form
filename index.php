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
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700,900&amp;amp;subset=cyrillic" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</head>
	<body>
		<section class="jumbotron">
			<div class="container">
				<h1>Submit the form!</h1>
				<div class="row">
					<div class="col-12 col-sm-6">
						<form class="form" action="mail.php" method="POST">
							<input type="hidden" name="info[subject]" value="Subject">
							<input type="hidden" name="info[title]" value="Title">
							<input type="hidden" name="info[subtitle]" value="Детали заказа от <?php echo date('d-m-Y'); ?>">
							<div class="input-group mb-3">
								<input name="contacts[name]" type="text" class="form-control" placeholder="Имя"><span class="form-line"></span>
							</div>
							<div class="input-group mb-3">
								<input name="contacts[email]" type="text" class="form-control" placeholder="E-mail"><span class="form-line"></span>
							</div>
							<div class="input-group mb-3">
								<input name="contacts[phone]" type="text" class="form-control" placeholder="Телефон"><span class="form-line"></span>
							</div>
							<div class="input-group">
								<button class="btn btn-primary" type="submit">Получить!</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
	</body>
</html>