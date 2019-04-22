@extends('layouts.Adminapp')

@section('header-css')

    <link href="{{ asset('public/Admin-assets/css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
@endsection

@section('AdminContent')

    @php
    $box = DB::table('mysteryboxs')->where('IsDeleted',0)->get();

    $currentbox = DB::table('mysteryboxs')->where('BoxStatus',0)->first();

        if($currentbox)
        {
            $boxid = $currentbox->MysteryboxId;
        }
        else
        {
            $boxid = 0;
        }

    @endphp
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
                    <strong>Mysterboxs</strong>
                </li>
            </ol>
        </div> --}}
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                {{-- <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Mystery Box</h5>
                        <div class="ibox-tools">
                                <a class="btn btn-primary" href="{{url('/Admin/products')}}">Add Product</a>
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#" class="dropdown-item">Config option 1</a>
                                </li>
                                <li><a href="#" class="dropdown-item">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div> --}}
                    <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Mystery Box</h5>
                                    <div class="ibox-tools">
                                        <a class="btn btn-primary" href="{{url('Admin/mysterybox')}}">Add Mysterybox</a>
                                    </div>
                                </div>
                            </div>
                    <div class="ibox-content">
                        @if(Session::has('successmessage'))
                            <div class="alert alert-success alert-dismissible">
                                {{ session('successmessage') }}
                            </div>
                        @endif
                        

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="mytable">
                                <thead>
                                <tr>
                                    <th>MysteryBox Name</th>
                                    <th>MysteryBox Base Price</th>
                                    <th>Percentage</th>
                                    <th>Autobot Max Price</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                    <th>Assign Product</th>
                                </tr>
                                </thead>
                                <tbody>
                                    
                                @foreach($box as $row)
                                <?php if(strlen($row->Description) > 30) {
                                    ?>
                                   
                                            <?php
                                    $readmore = '...'."<a data-toggle='modal' data-target='#{$row->MysteryboxId}' href='#'>Read More</a>";
                                    $Desc = substr($row->Description, 0, 30) .''. $readmore;
                                } else {
                                    $Desc = $row->Description;
                                }
                                ?>
                               
                                <tr class="gradeX">
                                    <td>{{$row->MysteryboxName}}</td>
                                    <td>{{$row->MysteryboxBasePrice}}</td>
                                    <td>{{$row->ProbabilityPercentage}}</td>
                                    <td class="center">{{$row->DummyUserMaxPrice}}</td>                                    
                                    <td><?php echo $Desc ?></td>
                                    <td class="center">


                                        @if($boxid == $row->MysteryboxId)
                                            <button  class="btn btn-primary btn-circle" type="button" onclick="editinfo();"><i class="fa fa-edit"></i>
                                            </button>
                                            &nbsp;&nbsp;
                                                <button class="btn btn-danger btn-circle"  type="button" onclick="deleteinfo();"><i class="fa fa-trash"></i>
                                                </button>
                                            @else

                                            <a href="{{url('/EditMysteryProduct/'.$row->MysteryboxId)}}">
                                                <button  class="btn btn-primary btn-circle" type="button"><i class="fa fa-edit"></i>
                                                </button>
                                            </a>
                                            &nbsp;&nbsp;
                                        <a href="javascript:void(0)" data-toggle="tooltip" onclick="deleteUser('{{ $row->MysteryboxId}}');">
                                        <button class="btn btn-danger btn-circle" type="button"><i class="fa fa-trash"></i>
                                        </button>
                                        </a>
                                            @endif
                                    </td>
                                    <td>
                                        <a href="{{url('/assignproduct/'.$row->MysteryboxId)}}">
                                        <button class="btn btn-primary active" type="button" aria-pressed="true">Assign Products</button>
                                        </a>
                                    </td>
                                </tr>
                            <div id="{{$row->MysteryboxId}}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                      
                                          <!-- Modal content-->
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h4 class="modal-title text-center">Description</h4>
                                            </div>
                                            <div class="modal-body">
                                              <p>{{$row->Description}}</p>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                      
                                        </div>
                                      </div>
                                    @endforeach
                                </tbody>
                                {{--<tfoot>--}}
                                {{--<tr>--}}
                                    {{--<th>Rendering engine</th>--}}
                                    {{--<th>Browser</th>--}}
                                    {{--<th>Platform(s)</th>--}}
                                    {{--<th>Engine version</th>--}}
                                    {{--<th>CSS grade</th>--}}
                                {{--</tr>--}}
                                {{--</tfoot>--}}
                            </table>
                        </div>

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
                    { targets: [6,5], orderable: false}
                    ]    
            });

        });

        function deleteUser(id)
        {

            swal({
                title: 'Are you sure?',
                text: "You want to delete this!",
                icon: 'warning',
                buttons: true,
                dangerMode: true,
                // type: 'warning',
                // showCancelButton: true,
                // confirmButtonColor: '#d33',
                // cancelButtonColor: '#3085d6',
                // confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result) {
                    $.ajax({
                        url:"{{ route('removemsterybox') }}",
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            id:id
                        },
                        success: function(data) {
                            swal({title: "", text: "Mysterybox deleted successfully.", icon: "success"}).then(function(){
                                location.reload();
                            });
                        }
                    });
                }
                else{
                    swal("Your mysterybox data is safe!");
                }
            });
        }

        function editinfo()
        {
            swal("Sorry!", "...You can not edit current running mysterybox!");
        }

        function deleteinfo()
        {
            swal("Sorry!", "...You can not delete current running mysterybox!");
        }
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('public/Admin-assets/js/plugins/dataTables/datatables.min.js')}}"></script>
    <script src="{{ asset('public/Admin-assets/js/plugins/dataTables/dataTables.bootstrap4.min.js')}}"></script>
@endsection