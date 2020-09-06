<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Reach Account Activation</title>
	
	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

	<!-- Styles -->
	<style>
		html,
		body {
			background-color: #fff;
			color: #636b6f;
			font-family: 'Nunito', sans-serif;
			font-weight: 200;
			height: 100vh;
			margin: 0;
		}
	</style>
</head>

<body>
  <div class="containter">
		<h4>Hi {{ $user }}!</h4>
		<p>
			Congratulations! Your account is now activated. Welcome! Thank you for choosing REACH as your business partner!
		</p>

		<table class="table table-collapsed table-bordered">
			<thead>
				<tr>
					<th colspan="2">Account Details</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><strong>Username:</strong></td>
					<td>{{ $email }}</td>
				</tr>
				<tr>
					<td><strong>Password:</strong></td>
					<td>{{ $pword }}</td>
				</tr>
			</tbody>
		</table>
	</div>
</body>

</html>