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

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Reset Your Password</h3>
                    </div>
                    <div class="panel-body">

                    <form method="POST" action="/password/reset">
                        {!! csrf_field() !!}
                        <input type="hidden" name="token" value="{{ $token }}">

                        @if (count($errors) > 0)
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <div>
                            Email
                            <input type="email" name="email" value="{{ old('email') }}">
                        </div>

                        <div>
                            Password
                            <input type="password" name="password">
                        </div>

                        <div>
                            Confirm Password
                            <input type="password" name="password_confirmation">
                        </div>

                        <div>
                            <button type="submit">
                                Reset Password
                            </button>
                        </div>
                    </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
<script src="{{ asset('/js/all.js') }}"></script>
</body>

</html>
