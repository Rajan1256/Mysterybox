@extends('layouts.Adminapp')

@section('header-css')
    <style>
        #labtxt{
            font-weight: bold;
        }
    </style>
@endsection

@section('AdminContent')
    <?php
            $editbox = DB::table('mysteryboxs')->where('MysteryboxId',$MysteryboxId)->first();
    ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Edit Mysterybox</h2>
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item">
                    <a href="index.html">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Forms</a>
                </li> -->
                <li class="breadcrumb-item active">
                    <strong>Edit Mysterybox.</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Edit <small>Mysterybox.</small></h5>

                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <!-- <ul class="dropdown-menu dropdown-user">
                                <li><a href="#" class="dropdown-item">Config option 1</a>
                                </li>
                                <li><a href="#" class="dropdown-item">Config option 2</a>
                                </li>
                            </ul> -->
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form method="post" id="mysteryboxid" action="{{route('updatemystery')}}">
                            {{csrf_field()}}

                            <input type="hidden" name="mysteryid" value="{{$editbox->MysteryboxId}}">
                            <div class="form-group">

                                <label id="labtxt">Mysterybox name</label>
                                <input type="text" name="boxname" placeholder="Enter mysterybox name" value="{{$editbox->MysteryboxName}}" class="form-control">
                                @if ($errors->has('boxname'))
                                    <span class="help-block">
                                        <strong style="color: red">{{ $errors->first('boxname') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label id="labtxt">Mysterybox base price</label>
                                <input type="text" name="boxbaseprice" placeholder="Enter mysterybox base price name" value="{{ $editbox->MysteryboxBasePrice }}" class="form-control">
                                @if ($errors->has('boxbaseprice'))
                                    <span class="help-block">
                                        <strong style="color: red">{{ $errors->first('boxbaseprice') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label id="labtxt">Probability percentage</label>
                                <input type="number" placeholder="Enter probability percentage" value="{{ $editbox->ProbabilityPercentage }}" class="form-control" name="percentage">
                                @if ($errors->has('percentage'))
                                    <span class="help-block">
                                        <strong style="color: red">{{ $errors->first('percentage') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label id="labtxt">Autobots max price</label>
                                <input type="text" placeholder="Autobots max price" name="maxprice" value="{{ $editbox->DummyUserMaxPrice }}"  class="form-control">
                                @if ($errors->has('maxprice'))
                                    <span class="help-block">
                                        <strong style="color: red">{{ $errors->first('maxprice') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label id="labtxt">Description</label>
                                <textarea class="form-control" placeholder="Enter description" name="description" >{{ $editbox->Description }}</textarea>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    {{--<button class="btn btn-white btn-sm" type="submit">Cancel</button>--}}
                                    <button type="submit" name="submit" id="" class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    <a class="btn btn-danger btn-sm" href="{{asset('Admin/showbox')}}" >Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="{{ asset('public/assets/js/jquery.validate.js') }}"></script>
    <script src="{{ asset('public/assets/js/additional-methods.min.js') }}"></script>




    <script>
        $(document).ready(function() {

            $("#mysteryboxid").validate({
                rules: {


                    boxname: {
                        required: true,
                        minlength:6,
                        maxlength:50
                    },
                    boxbaseprice: {
                        required: true,
                        number: true,
                        min: 0.1,
                    },
                    percentage: {
                        required: true,
                        integer: true,
                        range: [0, 100]
                    },
                    maxprice: {
                        required: true,
                        number:true,
                        min: 0.1,
                    },
                    description: {
                        required: true

                    },
                },

                messages: {
                    boxname:{
                        required:"Please enter your mysterybox name",
                    },
                    boxbaseprice:{
                        required:"Please enter mysterybox base price",
                        number: "Please enter proper base price",
                        min:"Zero not allow in base price"

                    },
                    percentage:{
                        required:"Please enter autobots percentage",
                        integer:"only number allow",
                        range:"up to 100 % is allow"
                    },
                    maxprice:{
                        required:"Please enter autobots max bid",
                        number: "Please enter proper autobots max price",
                        min:"Zero not allow in autobots max price"
                    },
                    description: {
                        required:"Please enter description"
                        
                    } 
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });

        });
    </script>
@endsection
