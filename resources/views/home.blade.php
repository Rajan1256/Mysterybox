@extends('layouts.app')
@section('header-css')

@endsection

@section('ClientContent')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-xs-12 text-center">
                    <p class="mystery-box-title">Fashion Mystery Box</p>
                    <img src="{{ url('/public/assets/img/box_ongoing.png')}}" class="fashion-mystery-box">
                </div>
                <div class="col-md-5 col-xs-12 white-bg p-30 br-5 box-shadow-violet">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="bidding mb-20">
                                <div class="label-text">
                                    <p>Final
                                        <br>bid price:</p>
                                </div>
                                <div class="pricing-text"><span>$30.50</span></div>
                            </div>
                            <div class="col-md-12">
                                <div class="listing-table">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td>$30.50</td>
                                            <td>great*****</td>
                                            <td>10:40:21 AM</td>
                                        </tr>
                                        <tr>
                                            <td>$29.50</td>
                                            <td>myste*****</td>
                                            <td>10:39:11 AM</td>
                                        </tr>
                                        <tr>
                                            <td>$29.00</td>
                                            <td>john.d*****</td>
                                            <td>10:39:01 AM</td>
                                        </tr>
                                        <tr>
                                            <td>$28.00</td>
                                            <td>myste*****</td>
                                            <td>10:38:41 AM</td>
                                        </tr>
                                        <tr>
                                            <td>$27.00</td>
                                            <td>great*****</td>
                                            <td>10:36:11 AM</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="countdown"><span>00 : 05</span></div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button class="btn btn-gradient width-100-per pt-10 pb-10 box-shadow-sky">Bid Now - $1.00</button>
                                <div class="mt-10 mb-10"><span class="title-line">- or -</span></div>
                            </div>
                            <div class="col-md-12">
                                <div class="max-bid">
                                    <div>
                                        <input type="text" class="form-control max-bid-input" placeholder="Enter your max bid">
                                    </div>
                                    <div>
                                        <button class="btn send-btn">Send Bid</button>
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

    </script>




@endsection
