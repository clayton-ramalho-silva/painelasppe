<?php $__env->startSection('content'); ?>
<section class="cabecario">
    <h1>Currículos</h1>

    <div class="cabExtras">

        <div class="dropdown">
            <button class="dropdown-toggle" id="dropdownFiltro"  data-bs-toggle="dropdown" data-bs-auto-close="false" aria-expanded="false">
                <div class="btFiltros filtros">
                    <figure>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                    </figure>
                    <span>Filtros</span>
                </div>
            </button>

            <form id="filter-form" class="dropdown-menu bloco-filtros" aria-labelledby="dropdownFiltro">

                <div class="row d-flex">
                    <div class="col-12">
                        <label for="nome" class="form-label">Nome do Candidato</label>
                        <input type="text" name="nome" id="nome" class="form-control" value="<?php echo e(request('nome')); ?>" placeholder="Buscar por nome...">
                    </div>
                    <div class="col-6">
                        <label for="vagas_interesse" class="form-label">Vagas de Interesse</label>
                        <select name="vagas_interesse[]" id="vagas_interesse" class="form-select" multiple>
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
                        <label for="experiencia_profissional" class="form-label">Experiência Profissional</label>
                        <select name="experiencia_profissional[]" id="experiencia_profissional" class="form-select" multiple>
                            <option value="Nenhuma por enquanto">Nenhuma por enquanto</option>
                            <option value="Copa & Cozinha">Copa & Cozinha</option>
                            <option value="Administrativo">Administrativo</option>
                            <option value="Camareiro(a) de Hotel">Camareiro(a) de Hotel</option>
                            <option value="Recepcionista">Recepcionista</option>
                            <option value="Atendente de Lojas e Mercados (Comércio & Varejo)">Atendente de Lojas e Mercados (Comércio & Varejo)</option>
                            <option value="TI (Tecnologia da Informação">TI (Tecnologia da Informação)</option>
                            <option value="Construção e Reparos">Construção e Reparos</option>
                            <option value="Conservação e Limpeza">Conservação e Limpeza</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select select2">
                            <option>Todos</option>
                            <option value="ativo"> Disponível</option>
                            <option value="reprovado"> Em processo</option>
                            <option value="aprovado"> Contratado</option>
                            <option value="inativo"> Inativo</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="sexo" class="form-label">Gênero</label>
                        <select name="sexo" id="sexo" class="form-select select2">
                            <option>Todos</option>
                            <option value="Homem"> Homem</option>
                            <option value="Mulher"> Mulher</option>
                            <option value="Prefiro não dizer"> Prefiro não dizer</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="cnh" class="form-label">Possui CNH?</label>
                        <select name="cnh" id="cnh" class="form-select select2">
                            <option>Todos</option>
                            <option value="Sim"> Sim</option>
                            <option value="Não"> Não</option>
                            <option value="Em andamento"> Em andamento</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="min_age" class="form-label">Idade mínima:</label>
                        <input type="number" name="min_age" id="min_age" class="form-control">
                    </div>

                    <div class="col-6">
                        <label for="reservista" class="form-label">Possui Reservista?</label>
                        <select name="reservista" id="reservista" class="form-select select2">
                            <option>Todos</option>
                            <option value="Sim"> Sim</option>
                            <option value="Não"> Não</option>
                            <option value="Em andamento"> Em andamento</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="foi_jovem_aprendiz" class="form-label">Já foi Jovem Aprendiz?</label>
                        <select name="foi_jovem_aprendiz" id="foi_jovem_aprendiz" class="form-select select2">
                            <option>Todos</option>
                            <option value="Sim, da ASPPE"> Sim, da ASPPE</option>
                            <option value="Sim, de Outra Qualificadora"> Sim, de Outra Qualificadora</option>
                            <option value="Não"> Não</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="escolaridade" class="form-label">Formação/Escolaridade</label>
                        <select name="escolaridade" id="escolaridade" class="form-select select2">
                            <option>Todos</option>
                            <option value="Ensino Médio Incompleto"> Ensino Médio Incompleto</option>
                            <option value="Ensino Médio Completo"> Ensino Médio Completo</option>
                            <option value="Outro"> Outro</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="informatica" class="form-label">Informática</label>
                        <select name="informatica" id="informatica" class="form-select select2">
                            <option>Todos</option>
                            <option value="Básico"> Básico</option>
                            <option value="Intermediário"> Intermediário</option>
                            <option value="Avançado"> Avançado</option>
                            <option value="Nenhum"> Nenhum</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="ingles" class="form-label">Inglês</label>
                        <select name="ingles" id="ingles" class="form-select select2">
                            <option>Todos</option>
                            <option value="Básico"> Básico</option>
                            <option value="Intermediário"> Intermediário</option>
                            <option value="Avançado"> Avançado</option>
                            <option value="Nenhum"> Nenhum</option>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="cidade" class="form-label">Cidade:</label>
                        <select id="cidade" name="cidade" class="form-select select2">
                            <option>Todas</option>
                            <?php
                            echo get_cidades($resumes, 3);
                            ?>
                        </select>
                    </div>

                    <div class="col-6 mb-4">
                        <label for="entrevistado" class="form-label">Entrevistado</label>
                        <select name="entrevistado" id="entrevistado" class="form-select select2">
                            <option>Todos</option>
                            <option value="1">Já entrevistado</option>
                            <option value="0">Não entrevistado</option>
                        </select>
                    </div>

                    <div class="col-6 mb-4">
                        <label for="filtro_data" class="form-label">Filtrar por Data</label>
                        <select name="filtro_data" id="filtro_data" class="form-select select2">
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

        <h4>Currículos em Destaque</h4>

        

        <div class="table-container lista-curriculos">

            <ul class="tit-lista">
                <li class="col1">Nome</li>
                <li class="col2">Tipo de vaga</li>
                <li class="col3">CNH</li>
                <li class="col4">Informática</li>
                <li class="col5">Inglês</li>
                <li class="col6">Entrevistado</li>
                <li class="col7">Status</li>
            </ul>

            <?php if($resumes->count() > 0): ?>

                <?php $__currentLoopData = $resumes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resume): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <ul onclick="window.location='<?php echo e(route('resumes.edit', $resume)); ?>'" >
                    <?php                       

                        $dataNascimento = optional($resume->informacoesPessoais)->data_nascimento;
                        $idadeDiff = $dataNascimento ? \Carbon\Carbon::parse($dataNascimento)->diff(\Carbon\Carbon::now()) : null;
                        $idadeFormatada = $idadeDiff ? $idadeDiff->format('%y anos e %m meses') : 'N/A';

                        //Verifica se a idade é maior que 22 anos e 8 meses
                        $idadeEmMeses = $idadeDiff ? ($idadeDiff->y * 12 + $idadeDiff->m) : 0;
                        $limiteEmMeses = (22 * 12) + 8;
                    ?>
                    <li class="col1">
                        <div class="col-icon">
                            <b>Nome</b>
                            <svg class="ico-lista" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path></g></svg>

                        </div>
                        <div class="col-info">
                            <span class="info-nome">
                                <strong><?php echo e($resume->informacoesPessoais->nome); ?></strong>
                            </span>
                            <?php if($idadeEmMeses > $limiteEmMeses): ?>
                                <p class="badge bg-danger"><?php echo e($idadeFormatada); ?></p>
                            <?php else: ?>
                                <p class="badge bg-light text-dark"><?php echo e($idadeFormatada); ?></p>
                            <?php endif; ?>

                        </div>

                    </li>
                    <li class="col2">
                        <b>Tipo de Vaga</b>
                        <?php $__currentLoopData = $resume->vagas_interesse; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vaga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($vaga); ?>,
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </li>
                    <li class="col3">
                        <b>CNH</b>
                        <?php echo e($resume->informacoesPessoais->cnh); ?>

                    </li>
                    <li class="col4">
                        <b>Informática</b>
                        <?php echo e($resume->escolaridade->informatica); ?>

                    </li>
                    <li class="col5">
                        <b>Inglês</b>
                        <?php echo e($resume->escolaridade->ingles); ?>

                    </li>
                    <li class="col6">
                        <b>Entrevista</b>
                        <?php if($resume->interview): ?>
                            <a href="<?php echo e(route('interviews.show', $resume->interview->id)); ?>" class="link-entrevista text-success fw-bold"  data-bs-toggle="tooltip" data-bs-placement="top" title="Ver entrevista">Sim</a>
                        <?php else: ?>
                            <a href="<?php echo e(route('interviews.interviewResume', $resume)); ?>"  class="link-entrevista text-danger fw-bold" data-bs-toggle="tooltip" data-bs-placement="top" title="Entrevistar">Não</a>
                        <?php endif; ?>
                    </li>
                    <li class="col7">
                        <b>Status</b>
                        <?php
                            $temSelecaoAprovada = $resume->selections->contains('status_selecao', 'aprovado');
                            $temSelecao = $resume->selections;                            
                            
                            if($resume->status === 'inativo'){

                                $classe = 'status-inativo'; // Colocar cor vermelha
                                $status = 'Inativo';

                            } else {

                                if(($resume->interview)){

                                    if($resume->selections->contains('status_selecao', 'aprovado')){
                                        $classe = 'status-contratado'; // Colocar cor Verde
                                        $status = 'Contratado';
                                    } else {
                                        $classe = 'status-em-processo'; // Colocar cor Amarela
                                        $status = 'Em processo';
                                    }

                                } else {

                                    $classe = 'status-ativo'; // Colocar cor Cinza
                                    $status = 'Disponível';

                                }
                            }
                            

                              

                           
                            //dd($temSelecaoAprovada);
                        ?>

                        <i class="<?php echo e($classe); ?>" title="<?php echo e($status); ?>"></i><?php echo e($status); ?>


                        
                    </li>

                </ul>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php else: ?>
            <span class="sem-resultado">Nenhum currículo encontrado</span>
            <?php endif; ?>

            
        </div>
        <!-- No final da página, após a tabela ou lista de currículos -->
        <div class="pagination-wrapper">
            <?php echo e($resumes->appends(request()->query())->links('vendor.pagination.custom')); ?>

            <p class="pagination-info">Mostrando <?php echo e($resumes->firstItem()); ?> a <?php echo e($resumes->lastItem()); ?> de <?php echo e($resumes->total()); ?> currículos</p>
        </div>

    </article>

    <article class="f4 bts-interna">
        <a href="<?php echo e(route('resumes.create')); ?>" class="btInt btCadastrar">Cadastrar <small>Criar um novo currículo</small></a>
        <a href="<?php echo e(route('reports.export.resumes')); ?>" class="btInt btExportar">Exportar <small>Exporte em excel</small></a>
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

    $('button').on('click', function(){
        envio = $(this).val();

        if(envio === 'limpar'){
            $('.form-check-input').prop('checked', true);
            $('#cidade').val('');
            $('#uf').val('Todos').select2();
        }

    });

    $('.bloco-filtros .select2').select2({
        placeholder: "Selecione",
    });

    if(envio === 'limpar'){
        $('.bloco-filtros-ativos').slideUp(150);
        setTimeout(function(){
            $('.bloco-filtros-ativos span').html('');
        }, 170);
    }

    $('.bloco-filtros').on('submit', function(e) {
        e.preventDefault();

        let formData = $(this).serializeArray(); // Captura os campos dos formulários

        // Adiciona os selects múltiplos manualmente
        $('#vagas_interesse option:selected').each(function(){
            formData.push({ name: 'vagas_interesse[]', value: $(this).val()});
        });

        $('#experiencia_profissional option:selected').each(function(){
            formData.push({ name: 'experiencia_profissional[]', value: $(this).val() });
        });

        get_form_filters($(this).serializeArray());

        $.ajax({
            url: "<?php echo e(route('resumes.index')); ?>",
            type: "GET",
            data: $.param(formData), // Serializa os dados corretamente
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
.subtitulo{
    font-weight: 500;
    font-size: 12px;
    color: #aaa;
}
.btInt{
flex-wrap: nowrap;
}

.lista-curriculos{
    overflow: scroll;
    height: 500px;
}

.linha-tabela{
    cursor: pointer;
    transition: all 0.25s ease-in-out;
}
.linha-tabela:hover{
    box-shadow: 0 3px 3px rgba(0, 0, 0, 0.16) !important;
    border-radius: 8px;
}

.col-icon{
    width: 20%;
}

.col-info{
    width: 80%;
}

.col-info .info-nome{
    float: left;
    width: 100%;
}
/* 
a[rel="prev"] svg, 
span[arial-label="&laquo; Previous"] svg,
a[rel="next"] svg,
svg.w-5.h-5{
    width: 20px !important;
} */

.bloco-filtros .col-12{
    margin-bottom: 11px;
}
.bloco-filtros .col-12 .form-label {
    width: 100%;
    margin: 0 !important;
    font-weight: 700;
    padding-bottom: 7px;
    color: #333333;


}



/* css paginate */
/* Em seu arquivo CSS */
.pagination-container {
    margin-top: 20px;
}

.pagination {
    display: flex;
    list-style: none;
    padding: 0;
    justify-content: center;
}

.page-item {
    margin: 0 2px;
}

.page-link {
    display: block;
    padding: 8px 12px;
    border-radius: 4px;
    border: 1px solid #ddd;
    color: #007bff;
    text-decoration: none;
    transition: background-color 0.2s;
}

.page-item.active .page-link {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}

.page-item.disabled .page-link {
    color: #6c757d;
    pointer-events: none;
    cursor: default;
    background-color: #fff;
    border-color: #ddd;
}

.page-link:hover {
    background-color: #f8f9fa;
}

/* Estilo responsivo */
@media (max-width: 576px) {
    .pagination {
        flex-wrap: wrap;
    }
    
    .page-item {
        margin-bottom: 5px;
    }
}

</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/flav6095/painelasppe.com.br/resources/views/resumes/index.blade.php ENDPATH**/ ?>