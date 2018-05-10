<?php $__env->startSection('content'); ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-heading text-center text-danger"><h1> Please Contact Coop Office for your Status! </h1> </div>
                <button class="btn btn-primary center-block" type="button" onclick="window.location='<?php echo e(url('/logout')); ?>'">LOGOUT</button>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.scega', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>