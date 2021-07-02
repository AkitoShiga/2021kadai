<! docutype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo e(config('app.name')); ?></title>
  <script>window.Laravel = {csrfToken: '<?php echo e(csrf_token()); ?>'}</script>
  <script src="<?php echo e(mix('js/app.js')); ?>" defer></script>
</head>
<body>
  <div id="app">test</div>
</body>
</html>
<?php /**PATH /2021kadai/web/resources/views/index.blade.php ENDPATH**/ ?>