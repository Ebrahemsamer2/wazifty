<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>You're Lost | WAZIFTY</title>
	
	<!-- Logo -->
    <link href="{{ asset('argon') }}/img/brand/browser_logo.jpg" rel="icon" type="image/png">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,700&display=swap" rel="stylesheet">

	<!-- Argon CSS -->
    <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">

    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    
	<link rel="stylesheet" href="/css/404.css">
</head>
<body>

	<div class="heading">
		<h1>WAZIFTY</h1>
		<p class="number"><i class="fas fa-exclamation-triangle"></i> 404</p>
		<p class="text">Sorry, We can not find your request.</p>
		<a href="/" class="btn btn-primary">Back to home</a> Or <br>
		<form autocomplete="off" method="POST" action="/">
			@csrf
			<input type="text" placeholder="Search jobs or companies" name="search" class="form-control">
			<input type="submit" name="searchsubmit" value="GO" class="btn btn-success">
		</form>
	</div>
</body>
</html>