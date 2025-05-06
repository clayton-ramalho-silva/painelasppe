<?php $__env->startSection('content'); ?>

<section class="cabecario">

    <h1>Logs</h1>

    <div class="cabExtras">

        <div class="dropdown">
            <button class="dropdown-toggle" id="dropdownFiltroUsuarios" data-bs-toggle="dropdown" data-bs-auto-close="false" aria-expanded="false">
                <div class="btFiltros filtros">
                    <figure>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                    </figure>
                    <span>Filtros</span>
                </div>
            </button>

            

        </div>

    </div>

</section>

<section class="sessao">

    <article class="f-interna">

        <div class="table-container lista-logs">

            <ul class="tit-lista">
                <li class="col1">ID</li>
                <li class="col2">Data</li>
                <li class="col3">Ação</li>
                <li class="col4">Tabela</li>
                <li class="col5">ID do Registro</li>
                <li class="col6">Descrição</li>
                <li class="col7">Usuário</li>
            </ul>

            <?php if($logs->count() > 0): ?>

                <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <ul>
                    <li class="col1">
                        <b>ID</b>
                        <?php echo e($log->id); ?>

                    </li>
                    <li class="col2">
                        <b>Data</b>
                        <?php echo e($log->created_at->format('d/m/Y H:i')); ?>

                    </li>
                    <li class="col3">
                        <b>Ação</b>
                        <?php echo e($log->action); ?>

                    </li>
                    <li class="col4">
                        <b>Tabela</b>
                        <?php echo e($log->table_name); ?>

                    </li>
                    <li class="col5">
                        <b>ID do Registro</b>
                        <?php echo e($log->record_id); ?>

                    </li>
                    <li class="col6">
                        <b>Descrição</b>
                        <?php echo e($log->description); ?>

                    </li>
                    <li class="col7">
                        <b>Usuário</b>
                        <?php echo e($log->user ? $log->user->name : 'Sistema'); ?>

                    </li>

                </ul>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php else: ?>
            <span class="sem-resultado">Nenhum item encontrado</span>
            <?php endif; ?>

        </div>

        <table class="table" style="display: none">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Ação</td>
                    <td>Tabela</td>
                    <td>ID do Registro</td>
                    <td>Descrição</td>
                    <td>Usuário</td>
                    <td>Data</td>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($log->id); ?></td>
                        <td><?php echo e($log->action); ?></td>
                        <td><?php echo e($log->table_name); ?></td>
                        <td><?php echo e($log->record_id); ?></td>
                        <td><?php echo e($log->description); ?></td>
                        <td><?php echo e($log->user ? $log->user->name : 'Sistema'); ?></td>
                        <td><?php echo e($log->created_at->format('d/m/Y H:i')); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </article>

    <article class="f4 bts-interna">
        <a href="#" class="btInt btExportar">Exportar <small>Exporte em excel</small></a>

    </article>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-custom'); ?>
<style>
    td,tr{
        font-size: 12px;
    }
</style>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/flav6095/painelasppe.com.br/resources/views/logs/index.blade.php ENDPATH**/ ?>