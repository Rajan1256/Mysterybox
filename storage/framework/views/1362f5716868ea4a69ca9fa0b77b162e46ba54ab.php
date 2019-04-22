<?php $__env->startSection('header-css'); ?>
    <link href="<?php echo e(asset('public/Admin-assets/css/plugins/dataTables/datatables.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css">
<style>
    .checkbox label:after {
        content: '';
        display: table;
        clear: both;
    }

    .checkbox .cr {
        position: relative;
        display: inline-block;
        border: 1px solid #a9a9a9;
        border-radius: .25em;
        width: 1.3em;
        height: 1.3em;
        float: left;
        margin-right: .5em;
    }

    .checkbox .cr .cr-icon {
        position: absolute;
        font-size: .8em;
        line-height: 0;
        top: 50%;
        left: 15%;
    }

    .checkbox label input[type="checkbox"] {
        display: none;
    }

    .checkbox label input[type="checkbox"]+.cr>.cr-icon {
        opacity: 0;
    }

    .checkbox label input[type="checkbox"]:checked+.cr>.cr-icon {
        opacity: 1;
    }

    .checkbox label input[type="checkbox"]:disabled+.cr {
        opacity: .5;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('AdminContent'); ?>


    <?php
        $joinbox = \App\JoinProduct::with('Products')->where('MysteryboxId',$MysteryboxId)->get();
        $joincount = \App\JoinProduct::with('Products')->where('MysteryboxId',$MysteryboxId)->count();
    ?>
    <?php 
        $joinpro = \App\JoinProduct::select('MysteryboxProductId')->where('MysteryboxId',$MysteryboxId)->get()->toArray();

        $remainpro = DB::table('mysterybox_products')->whereNotIn('MysteryboxProductId',$joinpro)->get();

        $products = DB::table('mysterybox_products')->where('IsDeleted',0)->get();

     ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
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
        </div>
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
                                <a data-toggle="modal" class="btn btn-primary" href="#modal-form">Assign here</a>
                            </div>

                            <div id="modal-form" class="modal fade" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-12 b-r"><h3 class="m-t-none m-b">Products</h3>

                                                    

                                                    <form role="form" method="post" action="<?php echo e(route('joinbox')); ?>">
                                                        <?php echo e(csrf_field()); ?>

                                                        <div class="form-group">
                                                            
                                                            <input type="hidden" name="mysteryboxid" value="<?php echo e($MysteryboxId); ?>">
                                                            <div class="container">
                                                                
                                                                <div class="row">
                                                                <?php if($joincount==0): ?>
                                                                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <div class="col">
                                                                        <img src="<?php echo e(asset('public/ProductImg/'.$rs->ProductImage)); ?>" height="100px" width="100px"><br><br>
                                                                                <div class="checkbox">
                                                                                    <label>
                                                                                        <input type="checkbox" name="selectedproduct[]" value="<?php echo e($rs->MysteryboxProductId); ?>">
                                                                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                                        <?php echo e($rs->ProductName); ?>

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php else: ?>
                                                                        <?php $__currentLoopData = $remainpro; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <div class="col">
                                                                        <img src="<?php echo e(asset('public/ProductImg/'.$rs->ProductImage)); ?>" height="100px" width="100px"><br><br>
                                                                            <div class="checkbox">
                                                                                <label>
                                                                                    <input type="checkbox" name="selectedproduct[]" value="<?php echo e($rs->MysteryboxProductId); ?>">
                                                                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                                                                    <?php echo e($rs->ProductName); ?>

                                                                                </label>
                                                                            </div>
                                                                            </div>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php endif; ?>
                                                            </div>

                                                            <script type="text/javascript">
                                                            $(document).ready(function() {
                                                            $('.selectpicker').multiselect();
                                                            });
                                                            </script>
                                                        </div>
                                                        <div>
                                                            <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"><strong>Add</strong></button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                <?php $__currentLoopData = $joinbox; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php $__currentLoopData = $row['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ps): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="gradeX">
                                        <td><?php echo e($ps['ProductName']); ?></td>
                                        <td><img src="<?php echo e(asset('public/ProductImg/'.$ps['ProductImage'])); ?>" height="50px" width="50px"></td>
                                        <td><?php echo e($ps['ProductPrice']); ?></td>
                                        <td class="center">
                                            
                                            <a href="javascript:void(0)" data-toggle="tooltip" onclick="deleteUser('<?php echo e($row->MysteryboxId); ?>','<?php echo e($row->MysteryboxProductId); ?>');">
                                            <button class="btn btn-danger btn-circle" type="button"><i class="fa fa-trash"></i>
                                            </button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

    <script>

        $(document).ready(function(){
            $('#mytable').DataTable({
                pageLength: 25,
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
                ]

            });

        });



        function deleteUser(id,pid)
        {

            swal({
                title: 'Are you sure?',
                text: "You won't to delete this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result) {
                    $.ajax({
                        url:"<?php echo e(route('removemsteryproduct')); ?>",
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            id:id,
                            pid:pid
                        },
                        success: function(data) {
                            swal({title: "", text: "Product deleted successfully.", type: "success"}).then(function(){
                                location.reload();
                            });
                        }
                    });
                }
            });
        }

    </script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="<?php echo e(asset('public/Admin-assets/js/plugins/dataTables/datatables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/Admin-assets/js/plugins/dataTables/dataTables.bootstrap4.min.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.Adminapp', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>