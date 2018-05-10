<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>


                    <?php echo $__env->make('status.flash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/register')); ?>">
                            <?php echo e(csrf_field()); ?>

                            
                            <div class="form-group<?php echo e($errors->has('member_no') ? ' has-error' : ''); ?>">
                                <label for="member_no" class="col-md-4 control-label">Member No</label>

                                <div class="col-md-6">
                                    <input id="member_no" type="text" class="form-control" name="member_no" value="<?php echo e(old('member_no')); ?>">

                                    <?php if($errors->has('member_no')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('member_no')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            
                            <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>">

                                    <?php if($errors->has('name')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            
                            <div class="form-group<?php echo e($errors->has('date-of-birth') ? ' has-error' : ''); ?>">
                                <label for="date-of-birth" class="col-md-4 control-label">Date of Birth</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input class="form-control" id="date-of-birth" name="date-of-birth" placeholder="YYYY/MM/DD" type="date"/>

                                        <?php if($errors->has('date-of-birth')): ?>
                                            <span class="help-block">
                                        <strong><?php echo e($errors->first('date-of-birth')); ?></strong>
                                    </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>


                            
                            <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password">

                                    <?php if($errors->has('password')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            
                            <div class="form-group<?php echo e($errors->has('password_confirmation') ? ' has-error' : ''); ?>">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                    <?php if($errors->has('password_confirmation')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            
                            <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>">

                                    <?php if($errors->has('email')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            
                            <div class="form-group<?php echo e($errors->has('email_confirmation') ? ' has-error' : ''); ?>">
                                <label for="email-confirm" class="col-md-4 control-label">Confirm E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email-confirm" type="email" class="form-control" name="email_confirmation">

                                    <?php if($errors->has('email_confirmation')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('email_confirmation')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.scega', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>