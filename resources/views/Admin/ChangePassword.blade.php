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

            <h1 class="logo-name">IN+</h1>

        </div>
        <h3>Welcome to IN+</h3>
    {{--<p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.--}}
    <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
        </p>
        <p>Change Your Password here?</p>


            <form class="m-t" role="form" action="{{ url('Admin/ChangePassword') }}" method="post">
            {{csrf_field()}}
            <input type="hidden" id="token" name="token" value="{{$newtoken}}">

            <div class="form-group">
                <input type="password" name="Password" class="form-control" placeholder="Password">
                @if ($errors->has('Password'))
                    <span class="help-block">
                                        <strong style="color: red">{{ $errors->first('Password') }}</strong>
                                    </span>
                @endif
            </div>


            <div class="form-group">
                <input type="password" name="ConformPassword" class="form-control" placeholder="Conform Password">
                @if ($errors->has('ConformPassword'))
                    <span class="help-block">
                                        <strong style="color: red">{{ $errors->first('ConformPassword') }}</strong>
                                    </span>
                @endif
            </div>


            <button type="submit" class="btn btn-primary block full-width m-b">Submit</button>
            <a href="{{url('/Admin')}}"><small>Back to login</small></a>
        </form>
        <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
    </div>
</div>

<!-- Mainly scripts -->
<script src="{{asset('public/Admin-assets/js/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('public/Admin-assets/js/popper.min.js')}}"></script>
<script src="{{asset('public/Admin-assets/js/bootstrap.js')}}"></script>

</body>

</html>
