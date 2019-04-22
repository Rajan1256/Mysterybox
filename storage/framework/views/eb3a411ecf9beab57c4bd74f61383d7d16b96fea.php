<?php $__env->startSection('header-css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('ClientContent'); ?>

        <section style="background-color: #f3f2fa">

            <form action="<?php echo e(route('updatePassword')); ?>" method="post">
                <?php echo e(csrf_field()); ?>


            <div class="container object-center-slide-up">
                <div class="row">
                    <div class="col-md-5 col-sm-12 mx-auto recovery">
                        <?php if(Session::has('errormessage')): ?>
                            <div class="alert alert-danger">
                                <?php echo e(session('errormessage')); ?>

                            </div>
                        <?php endif; ?>

                        <?php if(Session::has('successmessage')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session('successmessage')); ?>

                            </div>
                        <?php endif; ?>
                        <div class="col-md-12">
                            <div class="modal-title">Change Password</div>
                            <!-- <div class="sub-title">Enter the email you provided during registration</div> -->
                        </div>

                        <div class="col-md-12">
                            <div class="group">
                                <input id="old_password" name="old_password" type="password"/>
                                <label>Current Password</label>
                            </div>
                            <?php if($errors->has('old_password')): ?>
                                <span class="help-block">
                                        <strong style="color: red"><?php echo e($errors->first('old_password')); ?></strong>
                                    </span>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-12">
                            <div class="group">
                                <input name="new_password" id="new_password" type="password"/>
                                <label>New Password</label>
                                <?php if($errors->has('new_password')): ?>
                                    <span class="help-block">
                                        <strong style="color: red"><?php echo e($errors->first('new_password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="group">
                                <input type="password" name="confirm_password" id="confirm_password"/>
                                <label>Confirm Password</label>
                                <?php if($errors->has('confirm_password')): ?>
                                    <span class="help-block">
                                        <strong style="color: red"><?php echo e($errors->first('confirm_password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-12 text-center">
                            <button class="btn btn-gradient width-100-per pt-10 pb-10 box-shadow-sky">Save</button>
                        </div>

                        <div class="col-12 mx-auto">
                            <div class="back-arrow"><a href="<?php echo e(url('/')); ?>"><i class="fas fa-arrow-left"><span> &nbsp;&nbsp;Go Back</span></i></a></div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
<?php $__env->stopSection(); ?>
        </section>
<?php $__env->startSection('footer'); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>