@extends('layouts.app')

@section('header-css')

@endsection

@section('ClientContent')

        <section style="background-color: #f3f2fa">

            <form action="{{ route('updatePassword') }}" method="post">
                {{csrf_field()}}

            <div class="container object-center-slide-up">
                <div class="row">
                    <div class="col-md-5 col-sm-12 mx-auto recovery">
                        @if(Session::has('errormessage'))
                            <div class="alert alert-danger">
                                {{ session('errormessage') }}
                            </div>
                        @endif

                        @if(Session::has('successmessage'))
                            <div class="alert alert-success">
                                {{ session('successmessage') }}
                            </div>
                        @endif
                        <div class="col-md-12">
                            <div class="modal-title">Change Password</div>
                            <!-- <div class="sub-title">Enter the email you provided during registration</div> -->
                        </div>

                        <div class="col-md-12">
                            <div class="group">
                                <input id="old_password" name="old_password" type="password"/>
                                <label>Current Password</label>
                            </div>
                            @if ($errors->has('old_password'))
                                <span class="help-block">
                                        <strong style="color: red">{{ $errors->first('old_password') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="col-md-12">
                            <div class="group">
                                <input name="new_password" id="new_password" type="password"/>
                                <label>New Password</label>
                                @if ($errors->has('new_password'))
                                    <span class="help-block">
                                        <strong style="color: red">{{ $errors->first('new_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="group">
                                <input type="password" name="confirm_password" id="confirm_password"/>
                                <label>Confirm Password</label>
                                @if ($errors->has('confirm_password'))
                                    <span class="help-block">
                                        <strong style="color: red">{{ $errors->first('confirm_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12 text-center">
                            <button class="btn btn-gradient width-100-per pt-10 pb-10 box-shadow-sky">Save</button>
                        </div>

                        <div class="col-12 mx-auto">
                            <div class="back-arrow"><a href="{{url('/')}}"><i class="fas fa-arrow-left"><span> &nbsp;&nbsp;Go Back</span></i></a></div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
@endsection
        </section>
@section('footer')


@endsection