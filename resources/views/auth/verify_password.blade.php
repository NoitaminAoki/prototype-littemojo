<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		.card {
			box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
			transition: 0.3s;
			width: 40%;
			margin: 20px auto;
		}

		.container {
			padding: 2px 16px;
		}
	</style>
</head>
<body>


	<div class="card">
		<div class="container">
			<h4><b>Verify your email address.</b></h4> 
			<p><a href="http://localhost:8000/partner/{{$token}}/reset-password">Click Here</a>.</p> 
		</div>
	</div>

</body>
</html> 
