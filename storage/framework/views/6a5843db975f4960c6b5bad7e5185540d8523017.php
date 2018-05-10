<!doctype html>

<html >

<head>

    <meta charset="UTF-8">

    <meta name="viewport"

          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Online Loan Application</title>




</head>

<body>







<?php echo e(dd($member_name)); ?>


<?php echo e(dd($data)); ?>


<?php $__currentLoopData = $comaker; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
    <?php echo e($row['comaker_id']); ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>


<?php $__currentLoopData = $loan_app; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
<?php echo e($loan->loan_id); ?>

<?php echo e($loan->member_no); ?>

<?php echo e($loan->loan_app_date); ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

<?php echo e($comaker->comaker_id); ?>

<?php $__currentLoopData = $comaker; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $make): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
    <?php echo e(dd($make->comaker_id)); ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>


Scega Webmaster.

</body>

</html>
