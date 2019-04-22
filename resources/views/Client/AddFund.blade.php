@extends('layouts.app')

@section('header-css')

@endsection

@section('ClientContent')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="page-title text-center"><h2>Add Funds</h2></div>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="text-center mt-10 mb-30 page-sub-title"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lobortis massa et libero blandit, a egestas sem malesuada. Donec condimentum at urna.</p></div>
                </div>
                <div class="col-md-3"></div>

                <div class="col-md-3 col-xs-12">



                    <a href="{{url('/fund')}}"><div class="tabbar active">
                            <div class="violet-circle">1</div>
                            <span>Amount</span>
                        </div></a>

                    <a href="{{url('/billinginfo')}}"><div class="tabbar">
                            <div class="violet-circle">2</div>
                            <span>Billing Information</span>
                        </div></a>
                    <a href="#"><div class="tabbar">
                            <div class="violet-circle">3</div>
                            <span>Credit Card Information</span>
                        </div></a>

                </div>

                <div class="col-md-9 col-xs-12 tab-content">
                    @if ($message = Session::get('success'))

                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>

                        <?php Session::forget('success');?>
                    @endif

                    @if ($message = Session::get('error'))

                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>

                        <?php Session::forget('error');?>
                    @endif
                    <form name="bidauctionforbutton"  method="post" action="{{route('addamount')}}" id="bidauctionforbutton"  data-type="json">
                        {{csrf_field()}}
                        <div class="white-bg box-shadow-violet">
                            <div class="row">
                                <div class="col-8 mx-auto">
                                    <div class="mt-30 fund-amount">
                                        <label>Amount</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">$</span>
                                            </div>
                                            <div></div>
                                            <input type="text" id="amount" name="amount" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    @if ($errors->has('amount'))
                                        <span class="help-block">
                                        <strong style="color: red">{{ $errors->first('amount') }}</strong>
                                    </span>
                                    @endif
                                    <div class="mb-60">
                                        <button type="button" class="amt-capsule" name="5" value="5">$5</button>
                                        <button type="button" class="amt-capsule" name="10" value="10">$10</button>
                                        <button type="button" class="amt-capsule" name="25" value="25">$25</button>
                                        <button type="button" class="amt-capsule" name="100" value="100">$100</button>
                                    </div>
                                </div>
                                <div class="col-10 mx-auto">
                                    <div class="divider mt-10 mb-30"></div>
                                    <div class="total-price">
                                        <?php
                                        $user_balance = DB::table('user_balances')->where('UserId',Auth::user()->id)->first();
                                        ?>

                                        <div><label>Total: </label><span class="value-text">
                                            @if($user_balance)
                                                    ${{$user_balance->Amount}}
                                                @else
                                                    $0
                                                @endif</span></div>
                                        <div><button type="submit" name="Addamount" id="Addamount" class="btn btn-gradient width-120">Add Money</button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('footer')

    <script type="text/javascript">

        $('.amt-capsule').click(function(){
            var value = $(this).attr('value');
            $('#amount').val(value);
        });
        $('#amount').val(100);

    </script>

@endsection