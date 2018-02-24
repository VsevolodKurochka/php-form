<html>
<head>
  <style>
  	body{
			font-family: Arial;
  	}
		.wrapper{
			background-color:#f7f7f7;
			margin:0;
			padding:70px 0 70px 0;
			width:100%;
		}
		@media (max-width: 768px){
			.wrapper{
				padding: 0;
			}
		}
		.container{
			width: 600px;
			max-width: 100%;
			margin-left: auto;
			margin-right: auto;
		}
		.container-inner{
			padding: 35px;
			background-color: #fff;
		}
		@media (max-width: 768px){
			.container-inner{
				padding: 15px;
			}
		}
		.title{
			background-color: #96588a;
			color: #fff;
			font-weight: bold;
			padding: 20px 30px;
			margin-bottom: 0;
			font-size: 30px
		}
		@media (max-width: 768px){
			.title{
				font-size: 20px;
			}
		}
		.subtitle{
			margin-top: 0;
			letter-spacing: 1px;
		}
		.footer-text{
			text-align: center; 
			font-size: 12px;
			color: #c09bb9;
		}
	</style>
</head>
<body>
  <div class="wrapper">
		<div class="container">
			<h1 class="title"><?php echo $this->variables['info']['title']; ?></h1>
			<div class="container-inner">
				<p class="subtitle"><?php echo $this->variables['info']['subtitle']; ?></p>
				<table rules="all" style="border: 1px solid #e5e5e5; width: 100%; color: #636363; margin-bottom: 60px;" cellpadding="15">
					<?php foreach ($this->variables['contacts'] as $contact => $contact_value) { ?>
						<tr>
							<th style="text-align: left; text-transform: uppercase"><?php echo $contact; ?></th>
							<td><?php echo $contact_value; ?></td>
						</tr>
					<?php
					} ?>
				</table>
				<p class="footer-text"><?php echo $this->variables['info']['subject']; ?></p>
			</div>
		</div>
	</div>
</body>
</html>