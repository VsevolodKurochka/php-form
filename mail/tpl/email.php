<html>
  <head>
    <style>
			.wrapper{
				background-color:#f7f7f7;
				margin:0;
				padding:70px 0 70px 0;
				width:100%;
			}
			.container{
				width: 600px;
				max-width: 100%;
				margin-left: auto;
				margin-right: auto;
			}
			.container-inner{
				padding: 35px; background-color: #fff;
			}
			.title{
				background-color: #96588a;
				color: #fff;
				font-weight: bold;
				padding: 20px 30px;
				margin-bottom: 0;
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
				<h1 class="title">{{title}}</h1>
				<div class="container-inner">
					<p class="subtitle">{{subtitle}}</p>
					<p class="footer-text">{{subject}}</p>
				</div>
			</div>
		</div>
  </body>
</html>