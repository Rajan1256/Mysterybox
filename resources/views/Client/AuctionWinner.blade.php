@extends('layouts.app')

@section('header-css')
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <style>

        .carousel1 {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 190px;
            height: 210px;
            margin: 0;
            -webkit-perspective: 800px;
            perspective: 800px;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        .carousel1-content {
            position: absolute;
            width: 100%;
            height: 100%;
            -webkit-transform-style: preserve-3d;
            transform-style: preserve-3d;
            -webkit-transform: translateZ(-182px) rotateY(0);
            transform: translateZ(-182px) rotateY(0);
            -webkit-animation: carousel1 10s infinite cubic-bezier(1, 0.015, 0.295, 1.225) forwards;
            animation: carousel1 10s infinite cubic-bezier(1, 0.015, 0.295, 1.225) forwards;
        }

        .carousel1-item {
            position: absolute;
            top: 0;
            left: 0;
            width: 190px;
            height: 210px;
            border-radius: 6px;
        }

        .carousel1-item:nth-child(1) {
            background: rgba(252, 192, 77, 0.9);
            -webkit-transform: rotateY(0) translateZ(182px);
            transform: rotateY(0) translateZ(182px);
        }

        .carousel1-item:nth-child(2) {
            background: rgba(49, 192, 204, 0.9);
            -webkit-transform: rotateY(120deg) translateZ(182px);
            transform: rotateY(120deg) translateZ(182px);
        }

        .carousel1-item:nth-child(3) {
            background: rgba(236, 233, 242, 0.9);
            -webkit-transform: rotateY(240deg) translateZ(182px);
            transform: rotateY(240deg) translateZ(182px);
        }

        @-webkit-keyframes
        carousel1 {  0%, 17.5% {
            -webkit-transform: translateZ(-182px) rotateY(0);
            transform: translateZ(-182px) rotateY(0);
        }
            27.5%, 45% {
                -webkit-transform: translateZ(-182px) rotateY(-120deg);
                transform: translateZ(-182px) rotateY(-120deg);
            }
            55%, 72.5% {
                -webkit-transform: translateZ(-182px) rotateY(-240deg);
                transform: translateZ(-182px) rotateY(-240deg);
            }
            82.5%, 100% {
                -webkit-transform: translateZ(-182px) rotateY(-360deg);
                transform: translateZ(-182px) rotateY(-360deg);
            }
        }
        @keyframes
        carousel1 {  0%, 17.5% {
            -webkit-transform: translateZ(-182px) rotateY(0);
            transform: translateZ(-182px) rotateY(0);
        }
            27.5%, 45% {
                -webkit-transform: translateZ(-182px) rotateY(-120deg);
                transform: translateZ(-182px) rotateY(-120deg);
            }
            55%, 72.5% {
                -webkit-transform: translateZ(-182px) rotateY(-240deg);
                transform: translateZ(-182px) rotateY(-240deg);
            }
            82.5%, 100% {
                -webkit-transform: translateZ(-182px) rotateY(-360deg);
                transform: translateZ(-182px) rotateY(-360deg);
            }
        }
    </style>
@endsection

@section('ClientContent')

    <?php
    $winner = \App\WinuserMysterybox::with('bid')->where('MysteryboxStatus',0)->first();
    ?>

    <!-- Modal -->
    <div class="modal fade" id="congratulation" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="close-icn"><a href="#" data-dismiss="modal"><img src="{{asset('public/assets/img/close.png')}}"></a></div>

                            <div class="col-md-12 text-center congo-bg">
                                <div class="modal-title">Congratulations!</div>
                            </div>

                            <div class="col-10 mx-auto text-center">
                                <div class="sub-title"><p>You won all these prizes ipsum dolor sit amet, consectetur adipiscing elit.</p></div>
                            </div>
                            @if($winner)
                                <?php
                                $ms = \App\MysteryBox::where('MysteryboxId',$winner['bid']['MysteryboxId'])->first();
                                $joinbox = \App\JoinProduct::with('Products')->where('MysteryboxId',$winner['bid']['MysteryboxId'])->get();
                                $counter=0;
                                $i = 0;
                                $s = 0;
                                ?>
                            @endif
                            <div class="col-md-12">
                                <div id="product-listing" class="carousel slide" data-ride="carousel">

                                    @if($winner)
                                        <ul class="carousel-indicators">
                                            <?php
                                            foreach($joinbox as $row) {

                                            foreach($row['products'] as $ps)
                                            {
                                            if($i==0){
                                            ?>
                                            <li data-target="#product-listing" data-slide-to="{{$i}}" class="active"></li>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <li data-target="#product-listing" data-slide-to="{{$i}}"></li>
                                            <?php
                                            }
                                            $i++;
                                            }
                                            }
                                            ?>
                                        </ul>
                                    @endif

                                    @if($winner)
                                        <div class="carousel-inner text-center">
                                            @foreach($joinbox as $row)
                                                @foreach($row['products'] as $ps)
                                                    <div class="carousel-item {{ $counter==0 ? 'active' : '' }}">
                                                        <img  src="{{ asset('public/ProductImg/'.$ps['ProductImage'])}}" height="220px" width="200px">
                                                        <div class="mt-20"><p class="product-name">{{$ps['ProductName']}}</p></div>
                                                    </div>
                                                    <?php
                                                    $counter++;
                                                    ?>
                                                @endforeach
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="sub-title">You can withdraw your prize anytime in your <a href="#"><u>profile</u></a>. <br>Make sure to fill-up your <a href="#"><u>delivery info</u></a>.</div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <a href="#"><button class="btn btn-gradient width-100-per pt-10 pb-10 box-shadow-sky mt-30">Bid Again</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--<nav class="navbar navbar-expand-md navbar-dark fixed-top violet-bg">--}}
    {{--<div class="container">--}}
    {{--<a class="navbar-brand" href="index.html"><img src="{{url('public/assets/img/logo.png')}}"></a>--}}
    {{--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">--}}
    {{--<span class="navbar-toggler-icon"></span>--}}
    {{--</button>--}}
    {{--<div class="collapse navbar-collapse" id="navbarsExampleDefault">--}}
    {{--<div class="balance">--}}
    {{--<p class="balance-label">Your Balance</p>--}}
    {{--<p class="balance-value"><span>$</span>100.00</p>--}}
    {{--</div>--}}
    {{--<div class="funding">--}}
    {{--<a href="add-fund.html">--}}
    {{--<button class="btn btn-gradient width-120" type="submit">Add Funds</button>--}}
    {{--</a>--}}
    {{--</div>--}}
    {{--<div id="profile-dropdown" class="dropdown">--}}
    {{--<div class="profile dropdown-toggle" data-toggle="dropdown"><img src="{{url('public/assets/img/profile.png')}}"></div>--}}
    {{--<div class="dropdown-menu">--}}
    {{--<a class="dropdown-item" href="profile-read.html">Profile</a>--}}
    {{--<a class="dropdown-item" href="index.html">Logout</a>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</nav>--}}

    <section>
        <div class="container">
            <div class="row bg-wave">
                <div class="col-lg-6 col-md-12 col-xs-12">
                    <div class="mystery-box-open">
                        @if($winner)
                            <?php
                            $ms = \App\MysteryBox::where('MysteryboxId',$winner['bid']['MysteryboxId'])->first();
                            $joinbox = \App\JoinProduct::with('Products')->where('MysteryboxId',$winner['bid']['MysteryboxId'])->get();
                            ?>
                            <p class="mystery-box-title">{{$ms->MysteryboxName}}</p>
                        @else
                            <p class="mystery-box-title">No one can bid</p>
                        @endif

                        @if($winner)
                            <div class="product-listing">
                                @if(count($joinbox)<=2)
                                    @foreach($joinbox as $row)
                                        @foreach($row['products'] as $ps)
                                            <div class="product1"><img  src="{{ asset('public/ProductImg/'.$ps['ProductImage'])}}" height="100px" width="100px"></div>
                                        @endforeach
                                    @endforeach
                                @else
                                    <div class="carousel1">
                                        <div class="carousel1-content">
                                            @foreach($joinbox as $row)
                                                @foreach($row['products'] as $ps)
                                                    <div class="carousel1-item">
                                                        <img  src="{{ asset('public/ProductImg/'.$ps['ProductImage'])}}" height="220px" width="200px">
                                                    </div>
                                                @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                        <img src="{{asset('public/assets/img/box_opened.png')}}" class="fashion-mystery-box-open">

                        @if($winner)
                            @if($winner['bid']['UserId']==Auth::user()->id)
                                <button data-toggle="modal" data-target="#congratulation" class="btn btn-claims">Claim your items</button>
                            @else
                            @endif
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-12 white-bg bg-corn box-shadow-violet p-30 br-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-gradient width-100-per pt-10 pb-10 box-shadow-sky">Auction is now closed.</button>
                                </div>
                                <div class="col-md-12">

                                    @if($winner)
                                        <?php
                                        $us = \App\User::where('id',$winner['bid']['UserId'])->first();
                                        $bt = \App\AutoBot::where('AutoBotId',$winner['bid']['AutoBotId'])->first();
                                        ?>
                                        <div class="bidding mt-20 mb-20">
                                            <div class="label-text"><p>Final<br>bid price:</p></div>
                                            <div class="pricing-text"><span>{{$winner['bid']['BidPrice']==''?'':'$'.$winner['bid']['BidPrice']}}</span></div>
                                        </div>
                                        <div class="winner-user">
                                            <span>Congratulations</span>
                                            @if($us)
                                                <span>{{$us->name}}</span>
                                                @else
                                                <span>{{$bt->UserName}}</span>
                                            @endif
                                        </div>
                                    @else
                                        <div class="bidding mt-20 mb-20">
                                            <div class="label-text"><p>Final<br>bid price:</p></div>
                                            <div class="pricing-text"><span>$</span></div>
                                        </div>
                                        <div class="winner-user">
                                            <span>Congratulations</span>
                                            <span></span>
                                        </div>
                                    @endif


                                    <div class="timer">
                                        <span>Next mystery box starts in...</span>
                                        <span><div id="counttime"></div></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')

    <script type="text/javascript">
        {{--var timeleft = 20;--}}
                {{--var downloadTimer = setInterval(function(){--}}
                {{--document.getElementById("counttime").innerHTML = timeleft + " seconds";--}}
                {{--timeleft -= 1;--}}
                {{--if(timeleft <= 0){--}}
                {{--clearInterval(downloadTimer);--}}
                {{--$.ajax({--}}
                {{--url:"{{route('deletetoken')}}",--}}
                {{--dataType: 'json',--}}
                {{--success:--}}
                {{--function(data){--}}
                {{--console.log(data);--}}
                {{--window.location = "http://localhost/NewProject";--}}
                {{--},--}}
                {{--});--}}
                {{--}--}}
                {{--}, 1000);--}}


        if(localStorage.getItem("counter")){
            if(localStorage.getItem("counter") <= 1){
                var value = 20;
            }else{
                var value = localStorage.getItem("counter");
            }
        }else{
            var value = 20;
        }

        document.getElementById('counttime').innerHTML = value+' seconds';

        var counter = function (){
            if(value <= 1){
                $.ajax({
                    url:"{{route('deletetoken')}}",
                    dataType: 'json',
                    success:
                        function(data){
                            console.log(data);
                            window.location = "http://localhost/NewProject/";
                        },
                });
                localStorage.setItem("counter", 20);
                value = 20;
            }else{
                value = parseInt(value)-1;
                localStorage.setItem("counter", value);
            }
            document.getElementById('counttime').innerHTML = value+' seconds';
        };

        var interval = setInterval(function (){counter();}, 1000);

    </script>
@endsection