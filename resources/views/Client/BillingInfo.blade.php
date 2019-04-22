@extends('layouts.app')

@section('header-css')


@endsection

@section('ClientContent')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="page-title text-center"><h2>Billing information</h2></div>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    {{--<div class="text-center mt-10 mb-30 page-sub-title"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lobortis massa et libero blandit, a egestas sem malesuada. Donec condimentum at urna.</p></div>--}}
                </div>
                <div class="col-md-3"></div>

                <div class="col-md-3 col-xs-12">
                    <a href="{{url('/fund')}}"><div class="tabbar">
                            <div class="violet-circle">1</div>
                            <span>Amount</span>
                        </div></a>
                    <a href="{{url('/billinginfo')}}"><div class="tabbar active">
                            <div class="violet-circle">2</div>
                            <span>Billing Information</span>
                        </div></a>
                    <a href="#"><div class="tabbar">
                            <div class="violet-circle">3</div>
                            <span>Credit Card Information</span>
                        </div></a>
                </div>
                @php
                    $userinfo = \App\UserInfo::where('UserId',Auth::user()->id)->first();
                @endphp
                <div class="col-md-9 col-xs-12 tab-content">
                    <form id="billinfinfoid" method="post" action="{{route('editbillinginfo')}}">
                        {{csrf_field()}}
                        <div class="white-bg box-shadow-violet">
                            <div id="billing-info" class="row">
                                <div class="col-md-12">
                                    <div class="title-tag"><h6>Basic Info</h6></div>
                                    <div class="divider"></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" name="FirstName" placeholder="First Name" class="form-control" value="{{$userinfo->FirstName}}">
                                        <label class="error" for="FirstName" style="color: red"></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" name="LastName" placeholder="Last Name" class="form-control" value="{{$userinfo->LastName}}">
                                        <label class="error" for="LastName" style="color: red"></label>
                                    </div>
                                </div>
                                <?php
                                $user = DB::table('users')->where('id',Auth::user()->id)->first();

                                ?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input type="text" name="EmailId" placeholder="Email Address" class="form-control" value="{{$user->email}}" disabled="">
                                    </div>
                                </div>
                                <div class="col-md-12 mt-20">
                                    <div class="title-tag"><h6>Billing Info</h6></div>
                                    <div class="divider"></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Department</label>
                                        <input type="text"  placeholder="Enter Department" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Postal code</label>
                                        <input type="text" id="PostelCode" name="PostelCode" value="{{$userinfo->PostelCode}}" placeholder="Enter Postal code" class="form-control">
                                        <label class="error" for="PostelCode" style="color: red"></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Additional address details</label>
                                        <input type="text" name="Address" value="{{$userinfo->Address}}" placeholder="Enter Additional address details" class="form-control">
                                        <label class="error" for="Address" style="color: red"></label>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <select id="country" name="country" class="form-control" style="{{$userinfo->CountryId==null?'':'color: #495057'}}">
                                            @if($userinfo->CountryId)
                                                @php
                                                    $country = DB::table('countrys')->where('CountryId',$userinfo->CountryId)->first();
                                                @endphp
                                                <option value="{{$country->CountryId}}">{{$country->CountryName}}</option>
                                            @else
                                                <option value="">Select</option>
                                            @endif
                                            @foreach($countries as $key => $country)
                                                <option value="{{$key}}"> {{$country}}</option>
                                            @endforeach
                                        </select>
                                        <label class="error" for="country" style="color: red"></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>State</label>
                                        <select id="state" name="state" class="form-control" style="{{$userinfo->StateId==null?'':'color: #495057'}}">
                                            @if($userinfo->StateId)
                                                @php
                                                    $state = DB::table('states')->where('StateId',$userinfo->StateId)->first();
                                                @endphp
                                                <option value="{{$state->StateId}}">{{$state->StateName}}</option>
                                            @else
                                                <option value="">Select</option>
                                            @endif
                                        </select>
                                        <label class="error" for="state" style="color: red"></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>City</label>

                                        <select id="city" name="city" class="form-control"  style="{{$userinfo->CityId==null?'':'color: #495057'}}">
                                            @if($userinfo->CityId)
                                                @php
                                                    $city = DB::table('citys')->where('CityId',$userinfo->CityId)->first();
                                                @endphp
                                                <option value="{{$city->CityId}}">{{$city->CityName}}</option>
                                            @else
                                                <option value="">Select</option>
                                            @endif
                                        </select>
                                        <label class="error" for="city" style="color: red"></label>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-20">
                                    <div class="title-tag"><h6>Billing Contact Info</h6></div>
                                    <div class="divider"></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Contact name</label>
                                        <input type="text" name="ContactName" value="{{$userinfo->ContactName}}" placeholder="Enter Contact name" class="form-control">
                                        <label class="error" for="ContactName" style="color: red"></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Telephone</label>
                                        <input type="text" name="TelePhone" value="{{$userinfo->TelePhone}}" placeholder="Enter Telephone" class="form-control">
                                        <label class="error" for="TelePhone" style="color: red"></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mobile</label>
                                        <input type="text" name="MobileNo" value="{{$userinfo->MobileNo}}" placeholder="Enter Phone No." class="form-control">
                                        <label class="error" for="MobileNo" style="color: red"></label>
                                    </div>
                                </div>
                                <div class="col-12 mx-auto">
                                    <div class="divider mt-10 mb-30"></div>
                                    <div>
                                        <button class="btn btn-border mr-10 width-120" type="submit">Cancel</button>
                                        <button type="submit" name="submit" id="" class="btn btn-gradient width-120" type="submit">Save</button>
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
    <script>
        $(".tabbar").click(function(){
            $(".tabbar").removeClass("active");
            $(this).addClass("active");
        });
    </script>


    <script type="text/javascript">
        $('#country').change(function(){
            var countryID = $(this).val();
            if(countryID){
                $.ajax({
                    type:"GET",
                    url:"{{url('get-state-list')}}?CountryId="+countryID,
                    success:function(res){
                        if(res){
                            $("#state").empty();
                            $("#state").append('<option>Select</option>');
                            $.each(res,function(key,value){
                                $("#state").append('<option value="'+key+'">'+value+'</option>');
                            });

                        }else{
                            $("#state").empty();
                        }
                    }
                });
            }else{
                $("#state").empty();
                $("#city").empty();
            }
        });
        $('#state').on('change',function(){
            var stateID = $(this).val();
            if(stateID){
                $.ajax({
                    type:"GET",
                    url:"{{url('get-city-list')}}?StateId="+stateID,
                    success:function(res){
                        if(res){
                            $("#city").empty();
                            $.each(res,function(key,value){
                                $("#city").append('<option value="'+key+'">'+value+'</option>');
                            });

                        }else{
                            $("#city").empty();
                        }
                    }
                });
            }else{
                $("#city").empty();
            }

        });
    </script>




    <script>
        $(document).ready(function() {

            $("#billinfinfoid").validate({
                rules: {


                    FirstName: {
                        required: true,
                        minlength:3,
                        maxlength:50
                    },
                    LastName: {
                        required: true,
                        minlength:3,
                        maxlength:50
                    },
                    PostelCode:{
                        required:true,
                        minlength: 4,
                        maxlength: 7
                    },
                    Address:{
                        required:true,
                    },
                    country:{
                        required:true,
                    },
                    state:{
                        required:true,
                    },
                    city:{
                        required:true,
                    },
                    ContactName:{
                        required:true,
                    },
                    MobileNo: {
                        required: true,
                        number: true,
                        customphone:true,
                        checkelogmobile: true
                    },
                    TelePhone:{
                        number: true,
                        telecall:true
                    }
                },

                messages: {
                    FirstName:{
                        required:"Please enter your first name",
                    },
                    LastName:{
                        required:"Please enter you Last name",
                    },
                    PostelCode:{
                        required:"Please enter postal code",
                        minlength:"Minimum 4 character postel code is allow without space",
                        maxlength:"Miximum 6 character postel code is allow without space"
                    },
                    Address:{
                        required:"Please enter your address here"
                    },
                    country:"Please select your country",
                    state:"Please select your state",
                    city:"Please select your city",
                    ContactName:"Please enter your contact name",
                    MobileNo: {
                        required: "Please enter your mobile number",
                        number: "Please enter only numeric value"
                    },
                    TelePhone: {
                        number: "Please enter only numeric value"
                    },


                },
                submitHandler: function(form) {
                    form.submit();
                }
            });

            jQuery.validator.addMethod("checkelogmobile", function(value, element) {
                var rtn_val = true;
                $.ajax({
                    url: 'checkelogmobile',
                    type: 'POST',
                    async: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        mobile:value
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
            }, "This mobile number is already exists.");

        });

        jQuery.validator.addMethod("customphone", function(phone_number, element) {
            phone_number = phone_number.replace(/\s+/g, "");
            return this.optional(element) || phone_number.length > 9 &&
                phone_number.match(/^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/);
        }, "Please enter a valid phone number");

        jQuery.validator.addMethod("telecall", function(phone_number, element) {
            phone_number = phone_number.replace(/\s+/g, "");
            return this.optional(element) || phone_number.length > 9 &&
                phone_number.match(/^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/);
        }, "Please enter a valid telephone number");

        document.getElementById('PostelCode').addEventListener('input', function (e) {
            e.target.value = e.target.value.replace(/[^\dA-Z]/g, '').replace(/(.{3})/g, '$1 ').trim();
        });
    </script>
@endsection