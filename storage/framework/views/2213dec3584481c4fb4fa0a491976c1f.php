<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['type' => 'info', 'message']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['type' => 'info', 'message']); ?>
<?php foreach (array_filter((['type' => 'info', 'message']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
 
<div <?php echo e($attributes->merge(['class' => 'alert alert-'.$type])); ?>>
    <?php echo e($message); ?>

</div><?php /**PATH /home1/flav6095/painelasppe.com.br/resources/views/components/alert.blade.php ENDPATH**/ ?>