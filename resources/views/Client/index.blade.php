@extends('layouts.app')

@section('header-css')
<style>

    body {
         line-height: 1.0;
    }

    #myModal .modal-dialog {
        top: 20%;
        margin: 0 auto;
    }


    @media screen and (max-width:574px) {
        .max-bid{
        display:block;
                }
        .max-bid div{
        flex:unset;
        display:block;
        width:100%;
        }
        .send-btn{
        margin-left:0px;
        margin-top:15px;
        }
    }

    @media screen and (max-width: 767px) {

        .max-bid{
                display:block;
                }
        .max-bid div{
        flex:unset;
        display:block;
        width:100%;	
        }
        .send-btn{
        margin-left:0px;
        margin-top:15px;		
        }
    }

</style>
@endsection

@section('ClientContent')
    <section>
        {{--@if (session('status'))--}}
            {{--<div class="alert alert-success">--}}
                {{--{{ session('status') }}--}}
            {{--</div>--}}
        {{--@endif--}}
        <div class="container">
            <div class="row bg-wave">
                <div class="col-lg-6 col-md-12 col-xs-12 text-center">
                    <div class="mystery-box-open"><p class="mystery-box-title"></p>
                        <img src="{{asset('public/assets/img/box_ongoing.png')}}" class="fashion-mystery-box"></div>
                </div>
                <div class="col-lg-4 col-md-12 col-xs-12 white-bg p-30 br-5 box-shadow-violet bidding-box">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="bidding mb-20">
                                <div class="label-text" id="taketext">

                                </div>
                                <div class="pricing-text"><span id="baseprice"></span></div>
                            </div>
                            <div class="col-md-12">
                                <div class="listing-table">
                                    <table>
                                        <tbody id="listbox">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="countdown"><span id="timetest"></span></div>
                            </div>

                            @if (Auth::guest())

                                <div class="col-md-12 text-center">
                                    <a href="#" data-toggle="modal" data-target="#myModal"><button id="mybutton" class="btn btn-gradient width-100-per pt-10 pb-10 box-shadow-sky">Bid Now - $1.00</button></a>
                                    <div class="mt-10 mb-10"><span class="title-line">- or -</span></div>
                                </div>
                                    <div class="col-md-12">
                                        &nbsp;
                                        <div class="max-bid">
                                            <div>
                                                <input type="text" class="form-control max-bid-input" placeholder="Enter your max bid">
                                            </div>
                                            <div>
                                                <a href="#" data-toggle="modal" data-target="#myModal"><button class="btn send-btn">Send Bid</button></a>


                                                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <div class="close-icn"><a href="#" data-dismiss="modal"><img src="{{ asset('/public/assets/img/close.png')}}"></a></div>
                                                            <div class="modal-header">
                                                                <div class="col-md-12">
                                                                    <div class="modal-title">Alert</div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-body">
                                                                <span class="privacy-text">
                                                                You have to login first in order to bid for the Mystery Box.
                                                                </span>
                                                            </div>
                                                            <div class="modal-footer">
                                                                    <form class="form-inline my-2 my-lg-0">
                                                                        <a href="#" data-toggle="modal" data-target="#sign-in" data-backdrop="static" data-keyboard="false" onclick="return signinFunction();">
                                                                            <button class="btn btn-border mr-10 width-120">Sign In</button>
                                                                        </a>
                                                                        <a href="#" data-toggle="modal" data-target="#sign-up" data-backdrop="static" data-keyboard="false" onclick="return signupFunction();">
                                                                            <button class="btn btn-gradient width-120" type="submit">Sign Up</button>
                                                                        </a>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                <div class="col-md-12 text-center">
                                    <form name="bidauctionforbutton"  method="post" action="" id="bidauctionforbutton"  data-type="json">
                                        {{csrf_field()}}
                                        <input type="hidden" name="bidbutton" id="bidbutton" value="1" readonly>
                                        <button id="AddBidButton" name="AddBidButton" class="btn btn-gradient width-100-per pt-10 pb-10 box-shadow-sky">Bid Now - $1.00</button>
                                        <label id="bidbutton" class="error" for="bidbutton"></label>
                                        <div class="mt-10 mb-10"><span class="title-line">- or -</span></div>
                                    </form>
                                </div>
                                <form name="bidauction"  method="post" id="bidauction" action="" data-type="json">
                                    {{csrf_field()}}
                                    <div class="col-md-12">
                                        &nbsp;
                                        <div class="max-bid">
                                            <div>
                                                <input type="text" name="bidprice" id="bidprice" class="form-control max-bid-input" placeholder="Enter your max bid">
                                            </div>
                                            <div>
                                                <button type="button" name="AddBid" id="AddBid" class="btn send-btn">Send Bid</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')

    <script type="text/javascript">

        function signinFunction ()
            {
                $('#myModal').hide();
                $('.modal-backdrop').hide();
            }

        function signupFunction ()
        {
            $('#myModal').hide();
            $('.modal-backdrop').hide();
        }


        $(document).ready(function(){
            sendRequest1();
            function sendRequest1(){
                $.ajax({
                    url:"{{route('getproductview')}}",
                    dataType: 'json',
                    success:
                        function(data){
                            $(".mystery-box-title").empty();
                            //console.log((data).pro.MysteryboxName);
                            //$.each((data).programs, function (key, val) {
                            //     console.log(data);
                            $(".mystery-box-title").html(''+data.pro.MysteryboxName +'');
                            //});
                        },
                    complete: function() {
                        // setTimeout(function(){
                        //     window.location.reload(1);
                        // }, 5000);
                        // Schedule the next request when the current one's complete
                        setTimeout(sendRequest1, 1000); // The interval set to 5 seconds

                        // clearInterval();
                    }
                });
            };
        });

        $(document).ready(function()
        {
            var myVar = setInterval(myTimer, 1000);
            //setTimeout(function() { clearInterval(myVar); }, 10000);
            function myTimer() {
                var d = new Date();
                var seconds = d.getMinutes() * 60 + d.getSeconds(); //convet 00:00 to seconds for easier caculation
                var fiveMin = 80.25 * 4; //five minutes is 320 seconds!
                var timeleft = fiveMin - seconds % fiveMin; // let's say 01:30, then current seconds is 90, 90%300 = 90, then 300-90 = 210. That's the time left!
                // console.log(timeleft);
                var result = parseInt(timeleft / 60) + ':' + timeleft % 60; //formart seconds into 00:00
                var minute = parseInt(timeleft / 60) > 9 ? parseInt(timeleft / 60) : '0' + parseInt(timeleft / 60);
                var second = timeleft % 60 > 9 ? timeleft % 60 : '0' + timeleft % 60;

                var result_zero = minute + ':' + second; //formart seconds into 00:00
                document.getElementById('timetest').innerHTML = result_zero;

                if(result == '0:1')
                {
                    sendRequest1();
                    function sendRequest1(){
                        $.ajax({
                            url:"{{route('getproduct')}}",
                            dataType: 'json',
                            success:
                                function(data){
                                    window.location = "http://localhost/NewProject/showproduct/"+data.token;
                                },
                        });
                    };
                }

                if(result >='5:1'  && result <= '5:20')
                {
                    $('#timetest').hide();
                    $('input[name="bidprice"]').hide();
                    $('button[name="AddBidButton"]').hide();
                    $('button[name="AddBid"]').hide();
                }
                else if(result >='0:1'  && result <= '5:1')
                {
                    $('#timetest').show();
                    $('input[name="bidprice"]').show();
                    $('button[name="AddBidButton"]').show();
                    $('button[name="AddBid"]').show();
                }
            }

        });


        $(document).ready(function()
        {

            $("form[id='bidauctionforbutton']").validate({
                ignore: "",
                rules: {

                    bidbutton: {
                        checkbidbuttonprice: true,
                        //checkbidtable:true,
                    }
                },

                submitHandler: function(form) {
                    form.submit();
                }
            });

            jQuery.validator.addMethod("checkbidbuttonprice", function(value, element) {
                var rtn_val = true;
                $.ajax({
                    url: 'checkbidbuttonprice',
                    type: 'POST',
                    async: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        buttonamount:value
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
            }, "Your Balance is less than current Bid please add money in your wallet.");
        });


        $(document).ready(function()
        {

            jQuery.validator.addMethod("dollarsscents", function (value, element) {
                return this.optional(element) || /^\d{0,4}(\.\d{0,2})?$/i.test(value);
            }, "You must include two decimal places");


                $("form[id='bidauction']").validate({
                rules: {

                    bidprice: {
                        required: true,
                        min: 0.1,
                        dollarsscents: true,
                        checkbidprice: true,
                        checkbidless:true,
                    }
                },

                messages: {
                    bidprice:{
                        required:"Please enter your bid",
                        dollarsscents:"Please enter a valid amount"
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });

            jQuery.validator.addMethod("checkbidprice", function(value, element) {
                var rtn_val = true;
                $.ajax({
                    url: 'checkbidprice',
                    type: 'POST',
                    async: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        useramount:value
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
            }, "Your Balance is less then current Bid please add money in your wallet.");


            jQuery.validator.addMethod("checkbidless", function(value, element) {
                var rtn_val = true;
                $.ajax({
                    url: 'checkbidless',
                    type: 'POST',
                    async: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        useramount:value
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
            }, "Your bid is less than to current bid!");
        });



        var fewSeconds = 3;
        $('#AddBidButton').click(function(){
            // Ajax request
            var btn = $(this);
            btn.prop('disabled', true);
            setTimeout(function(){
                btn.prop('disabled', false);
            }, fewSeconds*1000);
        });


        $("#AddBidButton").click(function(e) {
            $("#bidauctionforbutton").valid();
            if($("#bidauctionforbutton").valid()==true) {
                e.preventDefault();
                var bidprice = $('#bidbutton').val();


                $.ajax({
                    type: "POST",
                    url: "{{ route('addbid') }}",
                    data: {
                        "bidprice": bidprice,
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            //location.reload();
                        }
                    },
                    error: function (jqXHR) {
                        var response = $.parseJSON(jqXHR.responseText);
                        // if(response.message) {
                        //     $('#form_output1').html('<div class="alert alert-danger">'+response.message+'</div>');
                        // }
                    }
                });
            }
            else
            {

            }
        });



        $("#AddBid").click(function(e) {

            $("#bidauction").valid();

            if($("#bidauction").valid()==true)
            {
                e.preventDefault();
                var bidprice = $('#bidprice').val();
                $.ajax({
                    type: "POST",
                    url:"{{ route('addbidbutton') }}",
                    data : {
                        "bidprice":bidprice,
                        "_token":"{{ csrf_token() }}"},
                    dataType:'json',
                    success: function (response) {
                        if(response.success) {
                            $("#bidprice").val("");
                            // location.reload();
                        }
                    },
                    error: function (jqXHR) {
                        var response = $.parseJSON(jqXHR.responseText);
                        // if(response.message) {
                        //     $('#form_output1').html('<div class="alert alert-danger">'+response.message+'</div>');
                        // }
                    }
                });
            }
        });
    </script>



    <script>
    $(document).ready(function(){
    sendRequest();
    function sendRequest(){
    $.ajax({
    url:"{{route('getbid')}}",
    dataType: 'json',
    cache: false,
    success:
    function(data){
        //console.log(data.baseprice.MysteryboxBasePrice);
        $("#listbox").empty();
        $('#baseprice').empty();
        $('#taketext').empty();
    console.log(data.programs);

                if(data.programs.length > 0)
                {
                    var largest = 0;
                    $.each((data).programs, function (key, val) {

                            $.each(val.user, function (key2, valnew) {
                                var date = new Date(val.CreatedAt);
                                $("#listbox").append('<tr><td>$'+ val.BidPrice +'</td><td>'+ valnew.name +'</td><td>'+ date.toLocaleTimeString('en-US') +'</td></tr>');
                                if(largest < val.BidPrice) {
                                    largest = val.BidPrice;
                                    $('#taketext').append('<p>Final' + '<br>bid price:</p>');
                                    $("#baseprice").html('$'+largest);
                                }
                            });

                            $.each(val.autobot, function (key3, valnew3) {
                                var date = new Date(val.CreatedAt);
                                $("#listbox").append('<tr><td>$'+ val.BidPrice +'</td><td>'+ valnew3.UserName +'</td><td>'+ date.toLocaleTimeString('en-US') +'</td></tr>');
                                if(largest < val.BidPrice) {
                                    largest = val.BidPrice;
                                    $('#taketext').append('<p>Final' + '<br>bid price:</p>');
                                    $("#baseprice").html('$'+largest);
                                }
                            });


                    });
                }
                else
                {
                    $("#taketext").append('<p>Base' + '<br>price:</p>');
                    $("#baseprice").append('$'+data.baseprice.MysteryboxBasePrice);
                }

    },
    complete: function() {
    // setTimeout(function(){
    //     window.location.reload(1);
    // }, 5000);
    // Schedule the next request when the current one's complete
    setTimeout(sendRequest, 3000); // The interval set to 5 seconds

    // clearInterval();
    }
    });
    };
    });
    </script>
@endsection