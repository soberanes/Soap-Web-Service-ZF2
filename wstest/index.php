<!doctype html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Web Service Test</title>
		<link rel="stylesheet" href="css/foundation.css" />
		<script src="js/vendor/modernizr.js"></script>
		<style type="text/css">
			body{
				background: #333333;font-family: 'Helvetica';
			}
			label{
				color: #FFF;
			}
			.response{
				min-height: 200px;
			}
		</style>
	</head>
	<body>
		<div class="row">
			<div class="large-12 columns" style="padding: 40px 0;">
				<form>
					<div class="row">
					    <div class="large-12 columns">
							<label>Método</label>
							<input id="checkbox1" type="checkbox"><label for="checkbox1">getHola</label>
							<input id="checkbox2" type="checkbox"><label for="checkbox2">getProducts</label>
					    </div>
						<div class="large-12 columns">
				      		<label>Respuesta</label>
				      		<div class="response"></div>
				      	</div>
				      	<div class="large-12 columns">
				      		<a href="#" class="button [tiny small large]">Default Button</a>
				      	</div>
				  	</div>
				</form>
			</div>
		</div>
		<script src="js/vendor/jquery.js"></script>
		<script src="js/foundation.min.js"></script>
		<script>
		  $(document).foundation();
		</script>
	</body>
</html>