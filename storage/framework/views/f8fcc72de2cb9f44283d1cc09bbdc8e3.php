<h1>Relatório de Candidatos por Vaga</h1>

<table border="1" cellpadding="10" cellspacing="0">
<thead>
    <tr>
        <td>Vaga</td>
        <td>Candidatos</td>
    </tr>
</thead>
<tbody>
    <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($job->titulo); ?></td>
            <td>
                <?php $__currentLoopData = $job->resumes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resume): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($resume->nome_candidato); ?> - <?php echo e($resume->email); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table><?php /**PATH /home1/flav6095/painelasppe.com.br/resources/views/reports/candidates_by_job_pdf.blade.php ENDPATH**/ ?>