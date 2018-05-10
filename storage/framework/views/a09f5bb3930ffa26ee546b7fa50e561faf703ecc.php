<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="row" >
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Member Deposit Profile</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="member_no" class="col-md-3 control-label">Member No: </label>
                        <div class="col-md-9">
                            <div class="col-md-9 col-md-pull-1" >
                                    <label for="member_no" class="form-control"> <?php echo e($users->member_no); ?> </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="member_name" class="col-md-3 control-label">Name (Last, First MI): </label>
                        <div class="col-md-9">
                            <div class="col-md-9 col-md-pull-1" >
                                <label for="member_name" class="form-control"> <?php echo e($users->name); ?> </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group spacer-body">
                        <div class="h4 col-md-6 text-primary"> <?php echo e($dtype->deposit_desc); ?> </div>
                        <div class="h4 col-md-6">
                            <label class="col-md-3 text-right text-primary"> Balance:   </label>
                           <label class="col-md-3 text-right" >
                                <?php $__currentLoopData = $dep; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposit): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                    <?php echo e(number_format($deposit->balance,2)); ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                           </label>
                        </div>
                        <div class="panel-group">
                            <div class="col-md-11">
                                <table class="table table-bordered table-responsive table-striped">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Reference</th>
                                            <th>Withdrawal</th>
                                            <th>Deposit</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                     <tbody>
                                        <tr>

                                            <?php $__currentLoopData = $dep; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposit): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                                <td><?php echo e($deposit->beg_bal_dt->toDateString()); ?></td>
                                                <td><?php echo e("Beginning Balance"); ?></td>
                                                <td class="text-right"><?php echo e(number_format(0,2)); ?></td>
                                                <td class="text-right"><?php echo e(number_format(0,2)); ?></td>
                                                <td class="text-right"><?php echo e(number_format($deposit->beg_bal,2)); ?></td>
                                                <p class="hide"> <?php echo e($bal = $deposit->beg_bal); ?> </p>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                        </tr>

                                    <?php $__currentLoopData = $depdtl; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposit_dtl): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <tr>
                                            <td><?php echo e($deposit_dtl->tran_date->toDateString()); ?></td>
                                            <td><?php echo e($deposit_dtl->tran_no); ?></td>
                                            <?php if($deposit_dtl->tran_type == 'W'): ?>
                                                <td class="text-right"><?php echo e(number_format($deposit_dtl->amount,2)); ?></td>
                                                <td class="text-right"><?php echo e(number_format(0,2)); ?></td>
                                                <p class="hide"> <?php echo e($bal = $bal - $deposit_dtl->amount); ?> </p>
                                            <?php else: ?>
                                                <td class="text-right"> <?php echo e(number_format(0,2)); ?></td>
                                                <td class="text-right"><?php echo e(number_format($deposit_dtl->amount,2)); ?></td>
                                                <p class="hide"> <?php echo e($bal = $bal + $deposit_dtl->amount); ?> </p>
                                            <?php endif; ?>
                                                <td class="text-right"> <?php echo e(number_format($bal,2)); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-1 for-bckbtn">
                                <button  class="btn btn-primary bck-button"  type="button" onclick="window.location='<?php echo e(url('/')); ?>'">Back</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.scega', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>