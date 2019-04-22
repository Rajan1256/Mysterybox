<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="google-site-verification" content="BDWnoXvab73HH7co020X9R_PB_Bmld1JWM746KHJVOg" />
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">
    <link rel="shortcut icon" sizes="196x196" href="{{ asset('public/favicon.png')}} ">

    <title>CajasMisterio</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" rel="stylesheet" />
    <link href="{{ asset('/public/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/public/assets/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('/public/assets/css/input.css') }}" rel="stylesheet">

    <style>

        label.error{
            color:red; margin-top: 7px; z-index:0; position:relative; display:block; text-align: left;
        }

    </style>
    @yield('header-css')
</head>

<body>

<!-- Modal -->
<div class="modal fade" id="sign-up" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <div class="container">
                    <form name="registration" id="registration"  method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        {{csrf_field()}}
                    <div class="row">
                        <div class="close-icn"><a href="#" data-dismiss="modal" id="newerror"><img src="{{ asset('/public/assets/img/close.png')}}"></a></div>
                        <div class="col-md-12">
                            <div class="modal-title">Sign Up</div>
                        </div>

                        <div class="col-md-12">
                            <div class="group">
                                <input type="text" name="UserName" id="UserName" autocomplete="off"/>
                                <label>Name</label>
                            </div>
                            <label for="UserName"  class="error"></label>
                            <div class="group">
                                <input type="password" name="passwordreg" id="passwordreg" autocomplete="off"/>
                                <label>Password</label>
                                <i toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password"></i>
                            </div>
                            <label for="passwordreg"  class="error"></label>
                            <div class="group">
                                <input type="email" name="Email" id="Email" autocomplete="off"/>
                                <label>Email Address</label>
                            </div>
                            <label for="Email"  class="error"></label>

                            <!-- <div class="group">
                                <input type="file" name="ProfileImage" id="ProfileImage" accept="image/jpg,image/png,image/jpeg,image/gif"/>
                                <label>Profile Image</label>
                            </div>
                            <label for="ProfileImage"  class="error"></label> -->

                            <input type="hidden" name="RoleId" id="RoleId" value="2" />

                            <div class="group">
                                <input id="mydate" name="mydate" type="text"  autocomplete="off"/>
                                <label>Birth Date</label>
                            </div>
                            <label for="mydate"  class="error"></label>
                        </div>

                        <div class="col-md-12">
                            <label class="agree-terms"><span class="privacy-text">I agree to <a href="#"><u>Terms & Conditions</u></a> and <a href="#"><u>Security Privacy</u></a></span>
                                <input type="checkbox" name="agree" id="agree">
                                <span class="checkmark"></span>
                            </label>
                            <label for="agree"  class="error"></label>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="submit" name="submit" id="" class="btn btn-gradient width-100-per pt-10 pb-10 box-shadow-sky">Sign Up</button>
                            <div class="mt-10 mb-10"><span class="title-line">- or register with -</span></div>
                        </div>

                    </div>
                    </form>
                    <div class="col-10 mx-auto">
                        <div class="login-through">
                            <button class="fab fa-facebook btn btn-fb"><a href="{!! url('auth/facebook') !!}" style="color: inherit; Text-Decoration: None !important;"><span> Facebook</span></a></button>
                            <button class="fas fa-envelope btn btn-fb"><a href="{{ url('/redirect') }}" style="color: inherit; Text-Decoration: None !important;"><span> Email</span></a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="sign-in" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <div class="container">
                    <form name="login"  method="post" id="login"  data-type="json">
                        {{csrf_field()}}
                    <div class="row">
                        <div class="close-icn"><a href="#" data-dismiss="modal" id="clearerror"><img src="{{ asset('/public/assets/img/close.png')}}"></a></div>
                        <div class="col-md-12">
                            <div class="modal-title">Sign In</div>
                        </div>

                        <div class="col-md-12">
                            <div class="group">
                                <input type="text" name="email" id="email" autocomplete="off"/>
                                <label>Email Address</label>
                            </div>
                            <label for="email"  class="error"></label>

                            <div class="group">
                                <input type="password" name="password" id="password" autocomplete="off"/>
                                <label>Password</label>
                                <i toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password"></i>
                            </div>
                            <label for="password"  class="error"></label>
                        </div>


                        <input type="hidden" name="RoleId" id="RoleId" value="2" />
                        <div class="col-md-12">
                            <label class="agree-terms"><span class="privacy-text">Remember Me</span>
                                <input type="checkbox" checked="checked">
                                <span class="checkmark"></span>
                            </label>
                        </div>

                        <div class="col-md-12 text-center">
                            <button type="button" id="loginbutton" class="btn btn-gradient width-100-per pt-10 pb-10 box-shadow-sky">Sign In</button>
                            <div class="mt-10 mb-10"><a href="{{ route('password.request') }}"><span class="forgot-password">Forgot Password?</span></a></div>
                            <div class="mt-10 mb-10"><span class="title-line">- or login with -</span></div>
                        </div>
                        {{--<div class="col-10 mx-auto">--}}
                            {{--<div class="login-through">--}}
                                {{--<button class="fab fa-facebook btn btn-fb"><a href="{{ url('/redirectfacebook') }}"><span> Facebook</span></a></button>--}}
                                {{--<button class="fas fa-envelope btn btn-fb"><a href="{{ url('/redirect') }}"><span> Email</span></a></button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                    </form>

                    <div id="form_output1" style="color: red;"></div>
                <div class="col-10 mx-auto">
                    <div class="login-through">
                        <button class="fab fa-facebook btn btn-fb"><a href="{!! url('auth/facebook') !!}" style="color: inherit; Text-Decoration: None !important;"><span> Facebook</span></a></button>
                        <button class="fas fa-envelope btn btn-fb"><a href="{{ url('/redirect') }}" style="color: inherit; Text-Decoration: None !important;"><span> Email</span></a></button>
                    </div>
                </div>
                </div>
            </div>
        </div>

    </div>
</div>
        @if(Auth::guest())
            <nav class="navbar navbar-expand-md navbar-dark fixed-top violet-bg">
                <div class="container">
                    <a class="navbar-brand" href="{{url('/')}}"><img src="{{ asset('/public/assets/img/logo.png')}}"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                            <form class="form-inline my-2 my-lg-0">
                                <a href="#" data-toggle="modal" data-target="#sign-in" data-backdrop="static" data-keyboard="false">
                                    <button class="btn btn-border mr-10 width-120">Sign In</button>
                                </a>
                                <a href="#" data-toggle="modal" data-target="#sign-up" data-backdrop="static" data-keyboard="false">
                                    <button class="btn btn-gradient width-120" type="submit">Sign Up</button>
                                </a>
                            </form>
                    </div>
                </div>
            </nav>

        @else

                <nav class="navbar navbar-expand-md navbar-dark fixed-top violet-bg">
                    <div class="container">
                        <a class="navbar-brand" href="{{url('/')}}"><img src="{{ asset('/public/assets/img/logo.png')}}"></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <?php
                        $user_balance = DB::table('user_balances')->where('UserId',Auth::user()->id)->first();
                        ?>
                        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                            <div class="balance">
                                <p class="balance-label">Your Balance</p>
                                <p class="balance-value"><span>$</span>
                                @if($user_balance)
                                    {{$user_balance->Amount}}
                                    @else
                                    0
                                    @endif
                                </p>
                            </div>
                            
                            <div class="funding">
                                <a href="{{url('/fund')}}">
                                    <button class="btn btn-gradient width-120" type="submit">Add Funds</button>
                                </a>
                            </div>
                            <div id="profile-dropdown" class="dropdown">

                                @if(Auth::user()->ProfileImage==null)
                                    <div class="profile dropdown-toggle" data-toggle="dropdown"><img src="{{ asset('/public/assets/img/dummy-business.png')}}"></div>
                                    @else
                                <div class="profile dropdown-toggle" data-toggle="dropdown"><img src="{{ asset('profile_images').'/'.Auth::user()->ProfileImage}}"></div>
                                @endif

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{url('editProfile')}}">Profile</a>
                                    <a class="dropdown-item" href="{{url('changepassword')}}">Change Password</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
        @endif


@yield('ClientContent')


<footer class="violet-bg mt-170 dev-top-rm">
    <img src="{{ asset('/public/assets/img/footer-bg.png')}}" class="footer-img">
    <div class="container">
        <div class="row pt-60 vertical-center">
            <div class="col-md-4 device-center">
                <img src="{{ asset('/public/assets/img/logo.png')}}" class="footer-logo">
            </div>
            <div class="col-md-4 text-center">
                <div class="social-media">
                    <div class="facebook-icn"></div>
                    <div class="twitter-icn"></div>
                    <div class="instagram-icn"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="payment-through device-center"><img src="{{ asset('public/assets/img/card.png')}}"></div>
            </div>
        </div>
    </div>
    <div class="divider"></div>
    <div class="container">
        <div class="row vertical-center">
            <div class="col-md-4">
                <div class="copyright"><span>© 2018 CajasMisterio</span></div>
            </div>
            <div class="col-md-5">
                <div class="privacy-terms">
                    <div><a href="#"><span>Privacy Policy</span></a></div>
                    <div><a href="#"><span>Terms of Service</span></a></div>
                    <div><a href="#"><span>FAQ</span></a></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="age-restricted">
                    <div class="eighteen-plus"><span>18+</span></div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script language="javascript">
    window.onload=function() {
        $("label.error").html('');
        $('#login')[0].reset();
        $('#registration')[0].reset();
        $('#form_output1').html('');
    }
</script>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="{{ url('/public/assets/js/vendor/jquery-slim.min.js')}}"><\/script>')</script>
<script src="{{ asset('/public/assets/js/vendor/popper.min.js')}}"></script>
<script src="{{ asset('/public/assets/js/bootstrap.min.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<script>$("#mydate").datepicker({maxDate: 0,dateFormat: 'yy/mm/dd'}).datepicker("setDate", new Date());</script>
<script src="{{ asset('public/assets/js/jquery.validate.js') }}"></script>
<script src="{{ asset('public/assets/js/additional-methods.min.js') }}"></script>
<script type="text/javascript">
 $("body").on('click', '.toggle-password', function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#password");
        if (input.attr("type") === "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }

    });


    $("body").on('click', '.toggle-password', function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#passwordreg");
        if (input.attr("type") === "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }

    });

$("#clearerror").click(function() {
        $("label.error").html('');
        $('#login')[0].reset();
        $('#form_output1').html('');
    });


    $("#newerror").click(function() {
        $("label.error").html('');
        $('#registration')[0].reset();
    });

    $(function() {

    $("form[name='registration']").validate({
        ignore: "",
        rules: {

            UserName: "required",
            // ProfileImage:{
            //     required: true,
            //     accept: "image/*",
            //     filesize:2097152
            // },
            Email: {
                required: true,
                email: true,
                checkemail: true
            },
            passwordreg: {
                required: true,
                minlength: 6,
                maxlength: 15
            },
            mydate:"required",
            agree:"required"
        },

        messages: {
            UserName: "Please enter your name",
            Email:{
                required:"Please enter your email address",
                email:"Please enter a valid email address"
            },
            passwordreg:{
                required:"Please enter your password",
                minlength:"Minimum 6 characters password is allow",
                maxlength:"Maximun 15 characters password is allow"
            },
            // ProfileImage: {
            //      required:"Please select your profile image",
            //      accept:"Please select only jpg, jpeg, png files"
            // },
            mydate:"Please select your birth date",
            agree:"Please select terms and conditions"
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
        $.validator.addMethod('filesize', function (value, element, param) {
            return this.optional(element) || (element.files[0].size <= param)
        }, 'File size must be less than 2 mb');
        jQuery.validator.addMethod("checkemail", function(value, element) {
            var rtn_val = true;
            $.ajax({
                url: 'checkemail',
                type: 'POST',
                async: false,
                data: {
                    _token: "{{ csrf_token() }}",
                    email:value
                },
                success: function(data) {
                    if(data == 1){
                        //alert('exits');
                        rtn_val = false;
                    }else{
                        //alert('not exits');
                        rtn_val = true;
                    }
                }
            });
            return rtn_val;
        }, "This email is already exists.");
    });




    $(document).ready(function() {

        $("#login").validate({
            rules: {


                email: {
                    required: true,
                    email: true,
                    // checkemail: true
                },
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 15
                }
            },

            messages: {
                email:{
                    required:"Please enter your email address",
                    email:"Please enter a valid email address"
                },
                password:{
                    required:"Please enter your password",
                    minlength:"Minimum 6 characters password is allow",
                    maxlength:"Maximun 15 characters password is allow"
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });

    });



    $("#loginbutton").click(function(e) {

        $("#login").valid();
        e.preventDefault();
        var email = $('#email').val();
        var password = $('#password').val();
        var RoleId = $('#RoleId').val();
        $.ajax({
            type: "POST",
            url:"{{ route('login') }}",
            data : {
                "email":email,
                "password":password,
                "RoleId":RoleId,
                "_token":"{{ csrf_token() }}"},
            dataType:'json',
            success: function (response) {
                if(response.success) {
                    location.reload();
                }
            },
            error: function (jqXHR) {
                var response = $.parseJSON(jqXHR.responseText);
                if(response.message) {
                    $('#form_output1').html('<div class="alert alert-danger">'+response.message+'</div>');
                }
            }
        });
    });

</script>
@yield("footer")

</body>

</html>