<?php $__env->startSection('content'); ?>
<section class="cabecario">

    <h1>Empresas</h1>

    <div class="cabExtras">

        <div class="dropdown">
            <button class="dropdown-toggle" id="dropdownFiltroEmpresas" data-bs-toggle="dropdown" data-bs-auto-close="false" aria-expanded="false">
                <div class="btFiltros filtros">
                    <figure>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                    </figure>
                    <span>Filtros</span>
                </div>
            </button>

            <form id="filter-form-companies" class="dropdown-menu bloco-filtros" aria-labelledby="dropdownFiltroEmpresas">

                <div class="row d-flex flex-column">

                    <div class="col d-flex flex-wrap justify-content-start">

                        <label for="status" class="form-label">Status</label>
                        <div class="form-check">
                            <label class="form-check-label" for="status1">
                                <input class="form-check-input" type="checkbox" name="status[]" id="status1" value="ativo" checked>Ativo
                            </label>
                        </div>

                        <div class="form-check">
                            <label class="form-check-label" for="status2">
                                <input class="form-check-input" type="checkbox" name="status[]" id="status2" value="inativo" checked>Inativo
                            </label>
                        </div>

                    </div>

                    <div class="col">
                        <label for="cidade" class="form-label">Cidade:</label>
                        <select id="cidade" name="cidade" class="form-select">
                            <option>Todas</option>
                            <?php
                            echo get_cidades($companies);
                            ?>
                        </select>
                    </div>

                    <div class="col">
                        <label for="cidade" class="form-label">UF:</label>
                        <select name="uf" id="uf" class="form-select">
                            <option>Todos</option>
                            <?php
                            echo get_estados();
                            ?>
                        </select>
                    </div>

                    <div class="col mb-4">
                        <label for="filtro_data" class="form-label">Data:</label>
                        <select name="filtro_data" id="filtro_data" class="form-select">
                            <option>Todas</option>
                            <option value="7">Últimos 7 dias</option>
                            <option value="15">Últimos 15 dias</option>
                            <option value="30">Últimos 30 dias</option>
                            <option value="90">Últimos 90 dias</option>
                        </select>
                    </div>

                    <div class="col mt-1 d-flex justify-content-between">
                        <button type="submit" class="btn btn-padrao btn-cadastrar" name="filtrar" value="filtrar">Filtrar</button>
                        <button type="submit" class="btn btn-padrao btn-cancelar" name="limpar" value="limpar">Limpar</button>
                    </div>

                </div>

            </form>

        </div>

    </div>

</section>

<div class="bloco-filtros-ativos">

    Filtros ativos <span></span>

</div>

<section class="sessao">

    <article class="f-interna">

        <div class="table-container lista-empresas">

            <ul class="tit-lista">
                <li class="col1">Nome</li>
                <li class="col2">E-mail</li>
                <li class="col3">Telefone</li>
                <li class="col4">Endereço</li>
                <li class="col5">Status</li>
            </ul>

            <?php if($companies->count() > 0): ?>

                <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('companies.edit', $company)); ?>"<?php echo ($company->status === 'inativo') ? ' class="inativo"' : ''; ?>>
                    <ul>
                        <li class="col1">
                            <b>Nome</b>
                            <!--<a href="<?php echo e(route('companies.edit', $company)); ?>">-->
                            <?php if($company->logotipo): ?>
                                <?php if(file_exists(public_path('documents/companies/images/'.$company->logotipo))): ?>
                                    <img src="<?php echo e(asset("documents/companies/images/{$company->logotipo}")); ?>" alt="<?php echo e($company->nome_fantasia); ?>" title="<?php echo e($company->nome_fantasia); ?>">
                                <?php else: ?>
                                    <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" data-aa="<?php echo e(asset("documents/companies/images/{$company->logotipo}")); ?>" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                <?php endif; ?>
                            <?php else: ?>
                                <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                            <?php endif; ?>
                            <span>
                                <strong><?php echo e($company->nome_fantasia); ?></strong><br><?php echo e($company->cnpj); ?>

                            </span>
                        </li>
                        <li class="col2">
                            <b>E-mail</b>
                            <?php echo e($company->contacts->email); ?>

                        </li>
                        <li class="col3">
                            <b>Telefone</b>
                            <?php echo e($company->contacts->telefone); ?>

                        </li>
                        <li class="col4">
                            <b>Endereço</b>
                            <?php echo e($company->location->logradouro.', '.$company->location->numero); ?>

                        </li>
                        <li class="col5">
                            <b>Status</b>
                            <i title="<?php echo e($company->status === 'inativo' ? 'Inativo' : 'Ativo'); ?>"></i>
                        </li>

                    </ul>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php else: ?>
            <span class="sem-resultado">Nenhuma empresa encontrada</span>
            <?php endif; ?>

        </div>

    </article>

    <article class="f4 bts-interna">
        <a href="<?php echo e(route('companies.create')); ?>" class="btInt btCadastrar">Cadastrar <small>Crie uma nova empresa</small></a>
        <a href="<?php echo e(route('reports.export.companies')); ?>" class="btInt btExportar">Exportar <small>Exporte em excel</small></a>
        <a href="<?php echo e(route('companies.create')); ?>" class="btInt btHistorico">Histórico <small>Log de atividades</small></a>
    </article>

</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts-custom'); ?>
<script>
var envio   = '',
    filtros = [];

$(document).ready(function() {

    $('button').on('click', function(){
        envio = $(this).val();

        if(envio === 'limpar'){
            $('.form-check-input').prop('checked', true);
            $('#cidade').val('');
            $('#uf').val('Todos').select2();
        }

    });

    $('#cidade').select2({
        placeholder: "Selecione",
    });
    $('#uf').select2({
        placeholder: "Selecione",
    });
    $('#filtro_data').select2({
        placeholder: "Selecione",
    });

    if(envio === 'limpar'){
        $('.bloco-filtros-ativos').slideUp(150);
        setTimeout(function(){
            $('.bloco-filtros-ativos span').html('');
        }, 170);
    }

    $('#filter-form-companies').on('submit', function(e) {

        e.preventDefault();
        let formData = (envio === 'filtrar') ? $(this).serialize() : '';

        get_form_filters($(this).serializeArray());

        $.ajax({
            url: "<?php echo e(route('companies.index')); ?>",
            type: "GET",
            data: formData,
            success: function(response) {
                $('.table-container').html($(response).find('.table-container').html());
                $('.dropdown-menu').removeClass('show');
            },
            error: function(xhr, status, error) {
                console.error("Erro ao buscar dados:", error);
            }
        });

    });

});
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('css-custom'); ?>
<style>
    td,tr{
        font-size: 12px;
    }
    .btInt{
    flex-wrap: nowrap;
}


.linha-tabela{
    cursor: pointer;
    transition: all 0.25s ease-in-out;
}
.linha-tabela:hover{
    box-shadow: 0 3px 3px rgba(0, 0, 0, 0.16) !important;
    border-radius: 8px;
}








</style>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/flav6095/painelasppe.com.br/resources/views/companies/index.blade.php ENDPATH**/ ?>