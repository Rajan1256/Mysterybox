@extends('layouts.Adminapp')

@section('header-css')
    <link href="{{ asset('public/Admin-assets/css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css">
@endsection

@section('AdminContent')


    <?php
        $product = \App\Product::get();
        // echo "<pre>";print_r($product->toArray());die;
    ?>
    
    <div class="row wrapper border-bottom white-bg page-heading">
        {{-- <div class="col-lg-10">
            <h2></h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Tables</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Products</strong>
                </li>
            </ol>
        </div> --}}
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Products</h5>
                            <div class="ibox-tools">
                                <a class="btn btn-primary" href="{{url('/Admin/products')}}">Add Product</a>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="mytable">
                                <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Product Image</th>
                                    <th>Product price</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($product as $ps)      
                                    <tr class="gradeX">
                                        <td>{{$ps['ProductName']}}</td>
                                        <td><img src="{{ asset('public/ProductImg/'.$ps['ProductImage'])}}" height="50px" width="50px"></td>
                                        <td>{{$ps['ProductPrice']}}</td>
                                        <td class="center">
                                            {{--<a href="{{url('/removemsteryproduct/'.$row->MysteryboxId.'/'.$row->MysteryboxProductId)}}">--}}
                                            <a href="{{url('/editproduct/'.$ps->MysteryboxProductId)}}">
                                            <button  class="btn btn-primary btn-circle" type="button"><i class="fa fa-edit"></i>
                                            </button>
                                            </a>
                                            <a href="javascript:void(0)" data-toggle="tooltip" onclick="deleteUser('{{ $ps->MysteryboxProductId}}');">
                                            <button class="btn btn-danger btn-circle" type="button"><i class="fa fa-trash"></i>
                                            </button>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

@endsection

@section('footer')

    <script>

        $(document).ready(function(){
            $('#mytable').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                        customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }
                    }
                ],
                columnDefs  : [
                    { targets: [1,3], orderable: false}
                    ]  

            });

        });



        function deleteUser(pid)
        {

            swal({
                title: 'Are you sure?',
                text: "You want to delete this!",
                icon: 'warning',
                buttons: true,
                dangerMode: true,
                // showCancelButton: true,
                // confirmButtonColor: '#d33',
                // cancelButtonColor: '#3085d6',
                // confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result) {
                    $.ajax({
                        url:"{{ route('removeproduct') }}",
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            pid:pid
                        },
                        success: function(data) {
                            swal({title: "", text: "Product deleted successfully.", type: "success"}).then(function(){
                                location.reload();
                            });
                        }
                    });
                }
                else{
                    swal("Your product data is safe!");
                }
            });
        }

    </script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('public/Admin-assets/js/plugins/dataTables/datatables.min.js')}}"></script>
    <script src="{{ asset('public/Admin-assets/js/plugins/dataTables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.js"></script>
@endsection