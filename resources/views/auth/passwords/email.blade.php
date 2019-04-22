@extends('layouts.app')

@section('header-css')
<style>
    .bg-wave {
        background: url(/img/violet-wave.png);
        background-repeat: no-repeat;
        background: #f3f2fa;
    }
</style>
@endsection
@section('ClientContent')

    <section>
        <div class="container">
            <div class="row">
            <div class="col-md-5 col-sm-12 mx-auto recovery">
            
            <div class="col-md-12">
                <div class="modal-title">Recover Password</div>
                <div class="sub-title">Enter the email you provided during registration</div>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}
            <div class="col-md-12">
                <div class="group">
                    <input type="email" name="email" id="email" value="{{old('email')}}"/>
                    <label>Email Address</label>
                    @if ($errors->has('email'))
                    <span class="help-block">
                    <strong style="color: red">{{ $errors->first('email') }}</strong>
                </span>
                @endif
                </div>
            </div>

            <!-- <div class="col-md-12">
                <label class="agree-terms"><span class="privacy-text">Remember Me</span>
                    <input type="checkbox" checked="checked">
                    <span class="checkmark"></span>
                </label>
            </div> -->

            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-gradient width-100-per pt-10 pb-10 box-shadow-sky">Recover Password</button></a>
            </div>

            <div class="col-12 mx-auto">
                <div class="back-arrow"><a href="{{url('/')}}"><i class="fas fa-arrow-left"><span> &nbsp;&nbsp;Go Back</span></i></a></div>
            </div>
            </form>
        </div>
    </div>
</div>

</section>
@endsection
@section('footer')
    @endsection
