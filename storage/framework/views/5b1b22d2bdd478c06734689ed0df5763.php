

<?php $__env->startSection('content'); ?>

<form action="<?php echo e(route('interviews.import')); ?>" method="post" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="mb-3">
        <label for="file" class="form-label">Upload do Arquivo Excel: Interviews</label>
        <input type="file" name="file" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Importar</button>
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/flav6095/painelasppe.com.br/resources/views/imports/interviews.blade.php ENDPATH**/ ?>