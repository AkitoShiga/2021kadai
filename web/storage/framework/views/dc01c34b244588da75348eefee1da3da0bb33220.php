<?php $__env->startSection('title', '登録認証'); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">登録認証</div>
        <div class="card-body">
          <a href='<?php echo e($url); ?>'>こちらのリンク</a>をクリックして、メールを認証して下さい。
        </div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mail', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /2021kadai/web/resources/views/mails/verification_mail.blade.php ENDPATH**/ ?>