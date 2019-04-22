<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CajasMisterio</title>
    <link rel="shortcut icon" sizes="196x196" href="{{ asset('public/favicon.png')}} ">
    <link href="{{asset('public/Admin-assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/Admin-assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('public/Admin-assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/Admin-assets/css/style.css')}}" rel="stylesheet">

</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">Cajas</h1>

        </div>
        <h3>Welcome to CajasMisterio</h3>


        @if(Session::has('message'))
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('message') }}
            </div>
        @endif
        @if(Session::has('passmsg'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('passmsg') }}
            </div>
        @endif
        <form class="m-t" role="form" action="{{route('adminlogin')}}" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <input type="text" name="EmailId" value="{{ old('EmailId') }}" class="form-control" placeholder="EmailId">
                @if ($errors->has('EmailId'))
                    <span class="help-block">
                                        <strong style="color: red">{{ $errors->first('EmailId') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group">
                <input type="password" name="Password" class="form-control" placeholder="Password">
                @if ($errors->has('Password'))
                    <span class="help-block">
                                        <strong style="color: red">{{ $errors->first('Password') }}</strong>
                                    </span>
                @endif
            </div>
            <input type="hidden" value="1" name="RoleId">
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
            <a href="{{url('/forgotpassword')}}"><small>Forgot password</small></a>
        </form>

    </div>
</div>

<!-- Mainly scripts -->
<script src="{{asset('public/Admin-assets/js/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('public/Admin-assets/js/popper.min.js')}}"></script>
<script src="{{asset('public/Admin-assets/js/bootstrap.js')}}"></script>

</body>

</html>
