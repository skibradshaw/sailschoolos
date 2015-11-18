<!doctype html>
<html class="no-js" lang="en">
	
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    

    <title>Sail School OS Login</title>

    <!-- Foundation core CSS -->
	{{-- Link to compiled, minimized and versioned css file. --}}
	<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">    



    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->	  
  </head>	
  
  <body>
 
  	<div class="row">
	  	<div class="large-8 large-centered columns">
		  	<h2>Sail School Operating System Login</h2>
	  	</div>
  	</div>
	  	
  	<div class="row" style="vertical-align: middle">
     
         
        <div class="large-4 large-centered columns">
			<form method="POST" action="/login">
			    {!! csrf_field() !!}
			
			    <div>
			        Email
			        <input type="email" name="email" value="{{ old('email') }}">
			    </div>
			
			    <div>
			        Password
			        <input type="password" name="password" id="password">
			    </div>
			
			    <div>
			        <input type="checkbox" name="remember"> Remember Me
			    </div>
			
			    <div>
			        <button type="submit" class="radius button">Login</button>
			    </div>
			</form> 
        </div>
  	</div>
  </body>

</html>
