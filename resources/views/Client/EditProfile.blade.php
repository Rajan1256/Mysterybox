@extends('layouts.app')

@section('header-css')
    <style type="text/css" media="screen">

        #OpenImgUpload input[type=file] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
        }

    </style>
@endsection

@section('ClientContent')

    <section>
        <section>
            <form id="userForm" name="userForm" action="{{ url('/updateprofile') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="cropadd" id="cropadd">
                {{csrf_field()}}
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="page-title text-center"><h2>Edit Profile</h2></div>
                        @if(Session::has('successmessage'))
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ session('successmessage') }}
                            </div>
                        @endif
                        <div class="divider mb-20"></div>
                    </div>
                    <div class="col-md-3">
                        <div id="OpenImgUpload" class="circle-box">
                            <i class="fas fa-camera"></i>
                        <input type="file"  name="ProfileImage" id="ProfileImage" accept="image/jpg,image/png,image/jpeg,image/gif"/>
                            @if(Auth::user()->ProfileImage==null)
                                <img id="target" src="{{ asset('/public/assets/img/dummy-business.png')}}" width="100%">
                            @else
                                <img id="target" src="{{ asset('profile_images').'/'.Auth::user()->ProfileImage}}" width="100%">
                            @endif
                        </div>
                        @if(Session::has('errormessage'))
                                        <strong style="color: red">{{ session('errormessage') }}</strong>
                        @endif

                        <div style="color: #696969; font-size: 10px;">Note:(Please upload image with the size up to 2 MB)</div>
                    </div>

                    <div class="col-md-9">
                        <!-- <div class="full-name"><h4>John Doe</h4></div> -->
                        <div id="profile-info" class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" id="username" class="form-control" value="{{Auth::user()->name}}" placeholder="Enter Username" required>
                                </div>
                            </div>
                            {{--<div class="col-md-6">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label>Password</label>--}}
                                    {{--<input type="password" class="form-control" value="{{Auth::user()->password}}" placeholder="Enter Password" disabled="">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" class="form-control" value="{{Auth::user()->email}}" placeholder="Enter Email Address" disabled="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Birth Date</label>
                                    <input type="text"  id="dob" name="dob" class="form-control" value="{{Auth::user()->Dob}}" placeholder="YYYY-MM-DD"
                                           placeholder="yyyy-mm-dd" required>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-gradient width-120" type="submit"><span>Save Edit</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </section>
    </section>
@endsection

@section('footer')
    <script>$("#dob").datepicker({maxDate: 0,dateFormat: 'yy-mm-dd'});</script>
    <script>
        $(".tabbar").click(function(){
            $(".tabbar").removeClass("active");
            $(this).addClass("active");

        });
    </script>
    <script>$('#OpenImgUpload').click(function(){ $('#ProfileImage').trigger('click'); });</script>


    <script>

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#target').attr('src', e.target.result);
                    $('#cropadd').val(e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#ProfileImage").change(function(){
            readURL(this);
        });

    </script>
@endsection