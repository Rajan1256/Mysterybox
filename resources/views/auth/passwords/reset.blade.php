@extends('layouts.app')

@section('header-css')
   
@endsection
@section('ClientContent')

    <section>

        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto recovery">
                    <div class="col-md-12">
                        <div class="modal-title">Change Password</div>
                        <div class="sub-title">Enter the email you provided during registration</div>
                    </div>
                    <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">
                    <div class="col-md-12">
                        <div class="group">
                            <input type="email" name="email" password="email"/>
                            <label>Email Address</label>
                        </div>
                    </div>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong style="color: red">{{ $errors->first('email') }}</strong>
                            </span>
                        @endif

                    <div class="col-md-12">
                        <div class="group">
                            <input type="password" name="password" id="password"/>
                            <label>New Password</label>
                        </div>
                    </div>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong style="color: red">{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    <div class="col-md-12">
                        <div class="group">
                            <input type="password" name="password_confirmation" id="password_confirmation" />
                            <label>Confirm Password</label>
                        </div>
                    </div>
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong style="color: red">{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-gradient width-100-per pt-10 pb-10 box-shadow-sky">Save</button></a>
                    </div>

                    <div class="col-12 mx-auto">
                        <div class="back-arrow"><a href="{{ route('password.request') }}"><i class="fas fa-arrow-left"><span> &nbsp;&nbsp;Go Back</span></i></a></div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </section>

@endsection
@section('footer')
@endsection







