@extends('layouts.Adminapp')

@section('header-css')
    <style>
        #labtxt{
            font-weight: bold;
        }
    </style>
@endsection

@section('AdminContent')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Add Products</h2>
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item">
                    <a href="index.html">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Forms</a>
                </li> -->
                <li class="breadcrumb-item active">
                    <strong>Add Products.</strong>
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
                        <h5>Add <small>Products.</small></h5>
                        @if(Session::has('successmessage'))
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ session('successmessage') }}
                            </div>
                        @endif
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
                        <form method="post" id="productid" action="{{route('addproducts')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label id="labtxt">Product name</label>
                                <input type="text" name="productname" placeholder="Enter Product name" class="form-control" value="{{ old('productname') }}">
                                @if ($errors->has('productname'))
                                    <span class="help-block">
                                        <strong style="color: red">{{ $errors->first('productname') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="form-group">
                                <label id="labtxt">Product price</label>
                                <input type="text" name="productprice" placeholder="Enter Product price" class="form-control" value="{{ old('productprice') }}">
                                @if ($errors->has('productprice'))
                                    <span class="help-block">
                                        <strong style="color: red">{{ $errors->first('productprice') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="hr-line-dashed"></div>
                            <div class="form-group"><label id="labtxt">Upload product image</label>
                                <input type="file" name="productimage" placeholder="Enter mysterybox base price name" class="form-control">
                                @if ($errors->has('productimage'))
                                    <span class="help-block">
                                        <strong style="color: red">{{ $errors->first('productimage') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    {{--<button class="btn btn-white btn-sm" type="submit">Cancel</button>--}}
                                    <button type="submit" name="submit" id="" class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    <a class="btn btn-danger btn-sm" href="{{asset('Admin/showproduct')}}" >Cancel</a>
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

            $("#productid").validate({
                rules: {


                    productname: {
                        required: true,
                    },
                    productprice: {
                        required: true,
                        number: true,
                        min: 0.1,
                    },
                    productimage:{
                        required:true,
                        accept: "image/*",
                        filesize:2097152
                    },
                },

                messages: {
                    productname:{
                        required:"Please enter your product name",
                    },
                    productprice: {
                        required: "Please enter product price",
                        number: "Please enter proper product price",
                        min: "Zero not allow in product price"

                    },
                    productimage: {
                        required:"Please select product image here.",
                        accept:"Please select only jpg, jpeg, png files"
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
            $.validator.addMethod('filesize', function (value, element, param) {
                return this.optional(element) || (element.files[0].size <= param)
            }, 'File size must be less than 2 mb');
        });
    </script>
@endsection