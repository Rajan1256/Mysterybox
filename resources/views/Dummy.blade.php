

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

<footer class="footer-bg">
    <div class="container">
        <div class="row pt-60 vertical-center">
            <div class="col-md-4">
                <img src="{{ url('/public/assets/img/logo.png')}}" class="footer-logo">
            </div>
            <div class="col-md-4 text-center">
                <div class="social-media">
                    <div class="facebook-icn"></div>
                    <div class="twitter-icn"></div>
                    <div class="instagram-icn"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="payment-through"><img src="{{ url('public/assets/img/card.png')}}"></div>
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
                    <div><span>Privacy Policy</span></div>
                    <div><span>Terms of Service</span></div>
                    <div><span>FAQ</span></div>
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

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="{{ url('/public/assets/js/vendor/jquery-slim.min.js')}}"><\/script>')</script>
<script src="{{ url('/public/assets/js/vendor/popper.min.js')}}"></script>
<script src="{{ url('/public/assets/js/bootstrap.min.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<script>$("#mydate").datepicker().datepicker("setDate", new Date());</script>

</body>
</html>