<?php $__env->startSection('content'); ?>

<section class="cabecario">
    <h1>Vagas</h1>

    <div class="cabExtras">

        <div class="dropdown">
            <button class="dropdown-toggle" id="dropdownFiltroVagas" data-bs-toggle="dropdown" data-bs-auto-close="false" aria-expanded="false">
                <div class="btFiltros filtros">
                    <figure>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                    </figure>
                    <span>Filtros</span>
                </div>
            </button>

            <form id="filter-form-jobs" class="dropdown-menu bloco-filtros" aria-labelledby="dropdownFiltro">

                <div class="row d-flex">

                    <div class="col-6">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option>Todos</option>
                            <option value="aberta"> Aberta</option>
                            <option value="fechada"> Fechada</option>
                            <option value="espera"> Espera</option>
                            <option value="cancelada"> Cancelada</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="filtro_data" class="form-label">Filtrar por Data</label>
                        <select name="filtro_data" id="filtro_data" class="form-select">
                            <option>Todas</option>
                            <option value="7">Últimos 7 dias</option>
                            <option value="15">Últimos 15 dias</option>
                            <option value="30">Últimos 30 dias</option>
                            <option value="90">Últimos 90 dias</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="cargo" class="form-label">Setor</label>
                        <select name="cargo" id="cargo" class="form-select" >
                            <option>Todos</option>
                            <option value="Copa & Cozinha">Copa & Cozinha</option>
                            <option value="Administrativo">Administrativo</option>
                            <option value="Camareiro(a) de Hotel">Camareiro(a) de Hotel</option>
                            <option value="Recepcionista">Recepcionista</option>
                            <option value="Atendente de Lojas e Mercados (Comércio & Varejo)">Atendente de Lojas e Mercados (Comércio & Varejo)</option>
                            <option value="Construção e Reparos">Construção e Reparos</option>
                            <option value="Conservação e Limpeza">Conservação e Limpeza</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="recruiters" class="form-label" >Recrutador</label>
                        <select name="recruiters" id="recruiters" class="form-select">
                            <option>Todos</option>
                            <?php $__currentLoopData = $recruiters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recruiter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($recruiter->name); ?>" > <?php echo e($recruiter->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="sexo" class="form-label">Gênero</label>
                        <select name="sexo" id="sexo" class="form-select">
                            <option>Todos</option>
                            <option value="Masculino"> Masculino</option>
                            <option value="Feminino"> Feminino</option>
                            <option value="Indiferente"> Indiferente</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="cidade" class="form-label">Cidade:</label>
                        <select id="cidade" name="cidade" class="form-select">
                            <option>Todas</option>
                            <?php
                            echo get_cidades($jobs, 2);
                            ?>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="cidade" class="form-label">UF:</label>
                        <select name="uf" id="uf" class="form-select">
                            <option>Todos</option>
                            <?php
                            echo get_estados();
                            ?>
                        </select>
                    </div>


                    <div class="col-6">
                        <label for="informatica" class="form-label">Informática</label>
                        <select name="informatica" id="informatica" class="form-select">
                            <option>Todos</option>
                            <option value="Básico"> Básico</option>
                            <option value="Intermediário"> Intermediário</option>
                            <option value="Avançado"> Avançado</option>
                            <option value="Nenhum"> Nenhum</option>
                        </select>
                    </div>


                    <div class="col-6">
                        <label for="ingles" class="form-label">Inglês</label>
                        <select name="ingles" id="ingles" class="form-select">
                            <option>Todos</option>
                            <option value="Básico"> Básico</option>
                            <option value="Intermediário"> Intermediário</option>
                            <option value="Avançado"> Avançado</option>
                            <option value="Nenhum"> Nenhum</option>
                        </select>
                    </div>


                    <div class="col-6">
                        <label for="company" class="form-label">Empresa</label>
                        <select name="company" id="company_id" class="form-select" >
                            <option>Todas</option>
                            <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($company->nome_fantasia); ?>" > <?php echo e($company->nome_fantasia); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="col-6 mb-4">
                        <label for="min_salario" class="form-label">Salário (min):</label>
                        <input type="text" name="min_salario" id="min_salario" class="form-control">
                    </div>

                    <div class="col-6 mb-4">
                        <label for="max_salario" class="form-label">Salário (max):</label>
                        <input type="text" name="max_salario" id="max_salario" class="form-control">
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

        <h4>Vagas em Destaque</h4>

        <div class="table-container lista-vagas">

            <ul class="tit-lista">
                <li class="col1">Empresa</li>
                <li class="col2">Título</li>
                <li class="col3">Vagas</li>
                <li class="col4">Recrutador</li>
                <li class="col5" data-bs-toggle="tooltip" data-bs-placement="top" title="Ýnico processo contratação">Início</li>
                <li class="col6" data-bs-toggle="tooltip" data-bs-placement="top" title="Fim processo contratação">Fim</li>
                <li class="col7">Status</li>
            </ul>

            <?php if($jobs->count() > 0): ?>

            <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('jobs.edit', $job)); ?>">
                    <ul>
                        <li class="col1">
                            <?php if($job->company->logotipo): ?>
                                <b>Empresa</b>
                                <?php if(file_exists(public_path('documents/companies/images/'.$job->company->logotipo))): ?>
                                    <img src="<?php echo e(asset("documents/companies/images/{$job->company->logotipo}")); ?>" alt="<?php echo e($job->company->nome_fantasia); ?>" title="<?php echo e($job->company->nome_fantasia); ?>">
                                <?php else: ?>
                                    <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" data-aa="<?php echo e(asset("documents/companies/images/{$job->company->logotipo}")); ?>" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                                <?php endif; ?>
                            <?php else: ?>
                                <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>
                            <?php endif; ?>
                            <span>
                                <strong><?php echo e($job->company->nome_fantasia); ?></strong>
                            </span>
                        </li>
                        <li class="col2">
                            <b>Título</b>
                            <?php echo limite($job->cargo, 28); ?>

                        </li>
                        <li class="col3" data-bs-toggle="tooltip" data-bs-placement="top" title="Preenchidas/Disponíveis">
                            <b>Vagas</b>
                            <?php echo e($job->filled_positions); ?> / <?php echo e($job->qtd_vagas); ?>

                        </li>
                        <li class="col4">
                            <b>Recrutador</b>
                            <?php if(count($job->recruiters) <= 0): ?>
                            Nenhum recrutador associado
                            <?php else: ?>
                            <?php $__currentLoopData = $job->recruiters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recruiter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($recruiter->name); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </li>
                        <li class="col5">
                            <b>Início</b>
                            <?php if(!$job->data_inicio_contratacao): ?>
                                Processo não iniciado
                            <?php else: ?>
                                <?php echo e($job->data_inicio_contratacao->format('d/m/Y')); ?>


                            <?php endif; ?>
                        </li>
                        <li class="col6">
                            <b>Fim</b>
                            <?php if($job->data_fim_contratacao && $job->data_fim_contratacao !== null): ?>
                                <?php echo e($job->data_fim_contratacao->format('d/m/Y')); ?>


                            <?php elseif(!$job->data_inicio_contratacao): ?>

                            <?php else: ?>
                                Em andamento
                            <?php endif; ?>
                        </li>
                        <li class="col7">
                            <b>Status</b>
                            <?php switch($job->status):
                                case ('aberta'): ?>
                                    <i title="Aberta" class="status-aberta"></i>        
                                    <?php break; ?>
                                <?php case ('fechada'): ?>
                                    <i title="Fechada" class="status-fechada"></i>              
                                    <?php break; ?>
                                <?php case ('cancelada'): ?>
                                    <i title="Cancelada" class="status-cancelada"></i>        
                                    <?php break; ?>
                                <?php case ('espera'): ?>
                                    <i title="Espera" class="status-espera"></i>        
                                    <?php break; ?>
                            
                                <?php default: ?>
                                    
                            <?php endswitch; ?>                            
                        </li>

                    </ul>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php else: ?>
            <span class="sem-resultado">Nenhuma vaga encontrada</span>
            <?php endif; ?>

        </div>

    </article>

    <article class="f4 bts-interna">
        <a href="<?php echo e(route('jobs.create')); ?>" class="btInt btCadastrar">Cadastrar <small>Crie uma nova vaga</small></a>
        <a href="<?php echo e(route('reports.export.jobs')); ?>" class="btInt btExportar">Exportar <small>Exporte em excel</small></a>
        <a href="<?php echo e(route('companies.create')); ?>" class="btInt btHistorico">Histórico <small>Log de atividades</small></a>
    </article>

</section>
<?php $__env->stopSection(); ?>



<?php $__env->startPush('scripts-custom'); ?>
<script src="<?php echo e(asset('js/jquery.mask.js')); ?>"></script>
<script>
var envio   = '',
    filtros = [];

$(document).ready(function() {

    $('#min_salario').mask('#.##0,00', {reverse: true});
    $('#max_salario').mask('#.##0,00', {reverse: true});

    $('button').on('click', function(){
        envio = $(this).val();

        if(envio === 'limpar'){
            $('.form-check-input').prop('checked', true);
            $('#cidade').val('');
            $('#uf').val('Todos').select2();
        }

    });

    $('#status').select2({
        placeholder: "Selecione",
    });
    $('#filtro_data').select2({
        placeholder: "Selecione",
    });
    $('#cargo').select2({
        placeholder: "Selecione",
    });
    $('#recruiters').select2({
        placeholder: "Selecione",
    });
    $('#sexo').select2({
        placeholder: "Selecione",
    });
    $('#cidade').select2({
        placeholder: "Selecione",
    });
    $('#uf').select2({
        placeholder: "Selecione",
    });
    $('#informatica').select2({
        placeholder: "Selecione",
    });
    $('#ingles').select2({
        placeholder: "Selecione",
    });
    $('#company_id').select2({
        placeholder: "Selecione",
    });

    if(envio === 'limpar'){
        $('.bloco-filtros-ativos').slideUp(150);
        setTimeout(function(){
            $('.bloco-filtros-ativos span').html('');
        }, 170);
    }

    $('#filter-form-jobs').on('submit', function(e) {

        e.preventDefault();
        let formData = (envio === 'filtrar') ? $(this).serialize() : '';

        get_form_filters($(this).serializeArray());

        $.ajax({
            url: "<?php echo e(route('jobs.index')); ?>",
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

.status-aberta{
    background-color: #008000 !important;
}
.status-fechada{
    background-color: #ff0000 !important;
}
.status-espera{
    background-color: #ffff00 !important;
}
.status-cancelada{
    background-color: #808080 !important;
}

</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/flav6095/painelasppe.com.br/resources/views/jobs/index.blade.php ENDPATH**/ ?>