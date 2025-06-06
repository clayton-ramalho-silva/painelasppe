

<?php $__env->startSection('content'); ?>
<section class="cabecario">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('jobs.index')); ?>">Vagas</a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo e($job->company->nome_fantasia); ?> #<?php echo e($job->id); ?></li>
        </ol>
      </nav>

      
      <?php
          // Guarda a rota na variável
          $rota = route('jobs.index');
      ?>

      <?php if (isset($component)) { $__componentOriginal78eb9c36ebd15b0f8e38a41369c837c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal78eb9c36ebd15b0f8e38a41369c837c8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.voltar','data' => ['rota' => $rota]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('voltar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['rota' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($rota)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal78eb9c36ebd15b0f8e38a41369c837c8)): ?>
<?php $attributes = $__attributesOriginal78eb9c36ebd15b0f8e38a41369c837c8; ?>
<?php unset($__attributesOriginal78eb9c36ebd15b0f8e38a41369c837c8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal78eb9c36ebd15b0f8e38a41369c837c8)): ?>
<?php $component = $__componentOriginal78eb9c36ebd15b0f8e38a41369c837c8; ?>
<?php unset($__componentOriginal78eb9c36ebd15b0f8e38a41369c837c8); ?>
<?php endif; ?>
      

</section>

<section class="sessao">
    <article class="f2-1">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h3><?php echo e($job->cargo); ?></h3>
                </div>
                <div class="col">

                    <div class="container-acoes d-flex justify-content-between">
                        
                        <div class="tag-status">
                            
                                <?php switch($job->status):
                                    case ('fechada'): ?>                                         
                                        <svg 
                                            style="enable-background:new 0 0 16 16; fill: red;" 
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19,6a1,1,0,0,0-1,1v4a1,1,0,0,1-1,1H7.41l1.3-1.29A1,1,0,0,0,7.29,9.29l-3,3a1,1,0,0,0-.21.33,1,1,0,0,0,0,.76,1,1,0,0,0,.21.33l3,3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42L7.41,14H17a3,3,0,0,0,3-3V7A1,1,0,0,0,19,6Z"></path>
                                        </svg>
                                        <span>Fechada</span>
                                        <?php break; ?>                                
                                    <?php case ('espera'): ?>
                                    <svg 
                                        style="enable-background:new 0 0 16 16; fill: yellow;" 
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19,6a1,1,0,0,0-1,1v4a1,1,0,0,1-1,1H7.41l1.3-1.29A1,1,0,0,0,7.29,9.29l-3,3a1,1,0,0,0-.21.33,1,1,0,0,0,0,.76,1,1,0,0,0,.21.33l3,3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42L7.41,14H17a3,3,0,0,0,3-3V7A1,1,0,0,0,19,6Z"></path>
                                    </svg> Em espera
                                        <?php break; ?>
                                    <?php case ('cancelada'): ?>
                                    <svg 
                                        style="enable-background:new 0 0 16 16; fill: gray;" 
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19,6a1,1,0,0,0-1,1v4a1,1,0,0,1-1,1H7.41l1.3-1.29A1,1,0,0,0,7.29,9.29l-3,3a1,1,0,0,0-.21.33,1,1,0,0,0,0,.76,1,1,0,0,0,.21.33l3,3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42L7.41,14H17a3,3,0,0,0,3-3V7A1,1,0,0,0,19,6Z"></path>
                                    </svg> Em processo
                                        <?php break; ?>                              
                                    <?php default: ?>
                                        <svg 
                                            style="enable-background:new 0 0 16 16; fill: green;" 
                                            version="1.1" id="Layer_1_1_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" xml:space="preserve">
                                            <circle cx="8" cy="8" r="8"></circle>
                                        </svg> <span>Aberta </span>                                       
                                <?php endswitch; ?>                                
                        
                           
                            
                        </div>
                        <a href="<?php echo e(route('jobs.edit', $job)); ?>" class="btn-editar">
                            <div class="icone-editar">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                        
                            </div>
                            <span>Editar</span>
                        </a>
                    </div>

                </div>
            </div>
            <div class="row mt-5 mb-3 container-info">                
                <div class="col text-center">
                    <h4>0/<?php echo e($job->qtd_vagas); ?></h4>
                    <p>Qtd. Vagas</p>
                </div>
                <div class="col text-center">
                    <h4><?php echo e($job->resumes->count()); ?></h4>
                    <p>Currículos</p>
                </div>
                <div class="col text-center">
                    <h4>1</h4>
                    <p>Aprovados</p>
                </div>
                <div class="col text-center">
                    <h4>1</h4>
                    <p>Reprovados</p>
                </div>
                <div class="col text-center">
                    <h4>12</h4>
                    <p>Em avaliação</p>
                </div>
                
            </div>
        </div>

        
    </article>
    
    <article class="f1-2 bts-interna">
        <a href="<?php echo e(route('jobs.create')); ?>" class="btInt btCadastrar" data-bs-toggle="modal" data-bs-target="#associarCurriculoModal">Associar currículo <small>Associe alguém a uma vaga</small></a>        
        
        <!-- Modal -->
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="modal fade" id="associarCurriculoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <section class="cabecario">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-6">
                                                    <h1>Associar Currículo</h1> 
                                                </div>
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-8">
                                                            <div class="buscar">
                                                                <form class="formulario">
                                                                    <input type="text" placeholder="      Buscar">
                                                                        <button>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                                                        </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="cabExtras">
                    
                                                                <div class="btFiltros filtros">
                                                                    <figure>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                                                                    </figure>
                                                                    <span>Filtros</span>
                                                                </div>       
                    
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    </section>
                                
                                </div>
                                <div class="modal-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Tipo de vaga</th>
                                                <th>Entrevistado</th>
                                                <th>Em processo</th>                                                
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($resumes->isNotEmpty()): ?> 
                                                <?php $__currentLoopData = $resumes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resume): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                                                      
                                                    <tr>
                                                        <td><?php echo e($resume->informacoesPessoais->nome); ?></td>
                                                        <td>
                                                            <?php $__currentLoopData = $resume->vagas_interesse; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vaga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                                    <?php echo e($vaga); ?>, 
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </td>
                                                        <td><?php echo e($resume->interview ? 'Sim' : 'Não'); ?></td>
                                                        <td>
                                                            
                                                            Não
                                                        </td>                                                                                                                               
                                                        <td>        
                                                            <?php
                                                                $resumeAssociado = false;

                                                                foreach ($job->resumes as $curriculo) {
                                                                    if ($curriculo->id == $resume->id) {
                                                                        $resumeAssociado = true;
                                                                    }        
                                                                }
                                                            ?>

                                                            <?php if($resumeAssociado): ?>
                                                            <svg xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://www.w3.org/2000/svg" height="24" width="24" version="1.1" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/">
                                                                <g transform="translate(0 -1028.4)">
                                                                 <path d="m22 12c0 5.523-4.477 10-10 10-5.5228 0-10-4.477-10-10 0-5.5228 4.4772-10 10-10 5.523 0 10 4.4772 10 10z" transform="translate(0 1029.4)" fill="#27ae60"></path>
                                                                 <path d="m22 12c0 5.523-4.477 10-10 10-5.5228 0-10-4.477-10-10 0-5.5228 4.4772-10 10-10 5.523 0 10 4.4772 10 10z" transform="translate(0 1028.4)" fill="#2ecc71"></path>
                                                                 <path d="m16 1037.4-6 6-2.5-2.5-2.125 2.1 2.5 2.5 2 2 0.125 0.1 8.125-8.1-2.125-2.1z" fill="#27ae60"></path>
                                                                 <path d="m16 1036.4-6 6-2.5-2.5-2.125 2.1 2.5 2.5 2 2 0.125 0.1 8.125-8.1-2.125-2.1z" fill="#ecf0f1"></path>
                                                                </g>
                                                               </svg>
                                                               <span>Selecionado</span>
                                                            <?php else: ?>                                                            
                                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="24" width="24" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                                                <g id="E452_x2C__Control_x2C__multimedia_x2C__pause_x2C__stop">
                                                                    <g>
                                                                        <g>
                                                                            <path style="fill:yellow;" d="M256,26c127.03,0,230,102.97,230,230c0,127.03-102.97,230-230,230C128.97,486,26,383.03,26,256
                                                                                C26,128.97,128.97,26,256,26z"></path>
                                                                            <g>
                                                                                <path style="fill:#000;" d="M206,156c-5.523,0-10,4.477-10,10v180c0,5.522,4.477,10,10,10s10-4.478,10-10V166
                                                                                    C216,160.477,211.523,156,206,156z"></path>
                                                                                <path style="fill:#000;" d="M306,156c-5.522,0-10,4.477-10,10v180c0,5.522,4.478,10,10,10s10-4.478,10-10V166
                                                                                    C316,160.477,311.522,156,306,156z"></path>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                                <g id="Layer_1">
                                                                </g>
                                                                </svg>
                                                                <form action="<?php echo e(route('interviews.associarVaga')); ?>" method="POST" style="display:inline;">
                                                                    <?php echo csrf_field(); ?>                                       
                                                                    <input type="hidden" name="job_id" value="<?php echo e($job->id); ?>">   
                                                                    <input type="hidden" name="resume_id" value="<?php echo e($resume->id); ?>">                      
                                                                    <button type="submit" class="bg-transparent">Associar</button>
                                                                </form>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>    
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?> 
                                                <tr><p>Nenhuma vaga Cadastrada!</p></tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>                                
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </article>

    <article class="f2-1">
        <div class="container">
            <div class="row mb-3">
                <div class="col">
                    <h4>Mais informações</h4>
                </div>
            </div>        
            <div class="row mb-5">
                <div class="col-6">
                    <p>Empresa</p>
                    <h4><?php echo e($job->company->nome_fantasia); ?> (unidade <?php echo e($job->company->location->bairro); ?>)</h4>
                </div>
                <div class="col-2">
                    <p>Abertura</p>
                    <h4><?php echo e($job->created_at->format('d/m/y')); ?></h4>
                </div>
                <div class="col-2">
                    <p>Inicio</p>
                    <h4 class="text-success">10/11/24</h4>
                </div>
                <div class="col-2">
                    <p>Fechamento</p>
                    <h4 class="text-warning">10/11/24</h4>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-2">
                    <p>Recrutador</p>
                    <h4>
                        <?php if(count($job->recruiters) <= 0): ?>
                            Nenhum recrutador associado
                        <?php else: ?>                                
                            <?php $__currentLoopData = $job->recruiters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recruiter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($recruiter->name); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </h4>
                    <p>Cidade</p>
                    <h4><?php echo e($job->company->location->bairro); ?></h4>
                </div>
                <div class="col-2">
                    <p>Tipo de vaga</p>
                    <h4><?php echo e($job->cargo); ?></h4>
                    <p>Status</p>
                    <h4><?php echo e($job->status); ?></h4>
                </div>                
                <div class="col-8">
                    <div class="card">
                        <div class="card-header bg-transparent">
                          <p>Observações:</p>
                        </div>
                        <div class="card-body">
                            <?php if($job->observacoes->isNotEmpty()): ?>
                                <?php $__currentLoopData = $job->observacoes->sortByDesc('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $observacao): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                    
                                    <p class="card-text mb-2"><?php echo e($observacao->created_at->format('d/m/y')); ?> - <?php echo e($observacao->observacao); ?> </p>                                    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                            
                            <?php else: ?>                           
                                Nenhuma observação.
                            <?php endif; ?>                          
                          
                        </div>
                    </div>
                </div>
            </div>                
           
        </div>

        
    </article>

    <article class="f1-2 b-Blue">
        <h4>Currículos Associados</h4>
        <small class="text-white">Ordenada por mais novas</small>

        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>                        
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if($job->resumes->isNotEmpty()): ?> 
                    <?php $__currentLoopData = $job->resumes->sortByDesc('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resume): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>           
                        <tr>
                            <td class="ico-v">
                                <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><title></title><g id="User"><path d="M41.2452,33.0349a16,16,0,1,0-18.49,0A26.0412,26.0412,0,0,0,4,58a2,2,0,0,0,2,2H58a2,2,0,0,0,2-2A26.0412,26.0412,0,0,0,41.2452,33.0349ZM20,20A12,12,0,1,1,32,32,12.0137,12.0137,0,0,1,20,20ZM8.09,56A22.0293,22.0293,0,0,1,30,36h4A22.0293,22.0293,0,0,1,55.91,56Z"></path></g></svg>
                                <?php echo e($resume->informacoesPessoais->nome); ?>

                            </td>                                                    
                            <td class="m-actions">
                                
                                <span class="m-infos dropdown" data-bs-toggle="tooltip" data-bs-placement="top" title="Abrir ações">
                                    <button class="dropdown-toggle" type="button" id="dropdownMenuResumeActions-<?php echo e($resume->id); ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg version="1.1" id="Layer_1_1_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                                            <circle cx="2" cy="8" r="2"></circle>
                                            <circle cx="8" cy="8" r="2"></circle>
                                            <circle cx="14" cy="8" r="2"></circle>
                                    </svg>
                                    </button>
                                   
                                    
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuResumeActions-<?php echo e($job->id); ?>">                                      
                                        <a href="<?php echo e(route('resumes.edit', $resume)); ?>" class="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Editar">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                        </a>
                                        <form action="<?php echo e(route('resumes.destroy', $resume)); ?>" method="POST" style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn-icon" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Deletar"><svg id="i-trash" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" fill="#000">
                                                <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6"></path>
                                            </svg></button>
                                        </form>

                                        <?php if(!$resume->interview): ?>
                                            <form action="<?php echo e(route('interviews.interviewResume')); ?>" method="get" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="resume_id" value="<?php echo e($resume->id); ?>">
                                                <button type="submit" class="btn-icon" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Entrevistar"><svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                                                    <defs>
                                                      <style>
                                                        .cls-1 {
                                                          fill: #000;
                                                          stroke-width: 0px;
                                                        }
                                                      </style>
                                                    </defs>
                                                    <path class="cls-1" d="M38.044,29.161c1.766-1.046,2.956-2.965,2.956-5.161,0-3.309-2.691-6-6-6s-6,2.691-6,6c0,2.197,1.19,4.116,2.956,5.161-2.207.464-4.057,1.9-5.084,3.839h-1.872v-3.5c0-3.606-2.559-6.625-5.956-7.339,1.766-1.046,2.956-2.965,2.956-5.161,0-3.309-2.691-6-6-6s-6,2.691-6,6c0,2.197,1.19,4.116,2.956,5.161-3.397.714-5.956,3.732-5.956,7.339v3.5h-1c-1.103,0-2,.897-2,2v2c0,.737.405,1.375,1,1.722v5.278c0,1.103.897,2,2,2h34c1.654,0,3-1.346,3-3v-6.5c0-3.606-2.559-6.625-5.956-7.339ZM35,20c2.206,0,4,1.794,4,4s-1.794,4-4,4-4-1.794-4-4,1.794-4,4-4ZM16,13c2.206,0,4,1.794,4,4s-1.794,4-4,4-4-1.794-4-4,1.794-4,4-4ZM9,29.5c0-3.033,2.467-5.5,5.5-5.5h3c3.033,0,5.5,2.467,5.5,5.5v3.5h-14v-3.5ZM6,35h20.151c-.099.485-.151.986-.151,1.5v.5H6v-2ZM7,39h19v4c0,.352.072.686.184,1H7v-5ZM42,43c0,.551-.449,1-1,1h-12c-.551,0-1-.449-1-1v-6.5c0-3.033,2.467-5.5,5.5-5.5h3c3.033,0,5.5,2.467,5.5,5.5v6.5Z"></path>
                                                    <path class="cls-1" d="M41,2h-11c-1.654,0-3,1.346-3,3v5.333c0,.215-.071.428-.2.6l-2,2.667c-.343.458-.397,1.059-.141,1.57.255.512.77.829,1.341.829h15c1.654,0,3-1.346,3-3V5c0-1.654-1.346-3-3-3ZM42,13c0,.551-.449,1-1,1h-14l1.4-1.867c.387-.516.6-1.155.6-1.8v-5.333c0-.551.449-1,1-1h11c.551,0,1,.449,1,1v8Z"></path>
                                                    <path class="cls-1" d="M39,6h-7c-.552,0-1,.448-1,1s.448,1,1,1h7c.552,0,1-.448,1-1s-.448-1-1-1Z"></path>
                                                    <path class="cls-1" d="M37,10h-5c-.552,0-1,.448-1,1s.448,1,1,1h5c.552,0,1-.448,1-1s-.448-1-1-1Z"></path>
                                                  </svg></button>
                                            </form>

                                        <?php else: ?>

                                        <a href="<?php echo e(route('interviews.show', $resume->interview->id)); ?>" class="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Visualizar entrevista"><svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 49H24C24.2652 49 24.5196 48.8946 24.7071 48.7071C24.8946 48.5196 25 48.2652 25 48V44C25 42.6739 24.4732 41.4021 23.5355 40.4645C22.5979 39.5268 21.3261 39 20 39H10C8.67392 39 7.40215 39.5268 6.46447 40.4645C5.52678 41.4021 5 42.6739 5 44V48C5 48.2652 5.10536 48.5196 5.29289 48.7071C5.48043 48.8946 5.73478 49 6 49ZM7 44C7 43.2044 7.31607 42.4413 7.87868 41.8787C8.44129 41.3161 9.20435 41 10 41H20C20.7956 41 21.5587 41.3161 22.1213 41.8787C22.6839 42.4413 23 43.2044 23 44V47H7V44Z" fill="black"></path>
                                            <path d="M15 37C15.9889 37 16.9556 36.7068 17.7779 36.1574C18.6001 35.6079 19.241 34.8271 19.6194 33.9134C19.9978 32.9998 20.0969 31.9945 19.9039 31.0246C19.711 30.0546 19.2348 29.1637 18.5355 28.4645C17.8363 27.7652 16.9454 27.289 15.9755 27.0961C15.0055 26.9031 14.0002 27.0022 13.0866 27.3806C12.173 27.759 11.3921 28.3999 10.8427 29.2222C10.2932 30.0444 10 31.0111 10 32C10 33.3261 10.5268 34.5979 11.4645 35.5355C12.4021 36.4732 13.6739 37 15 37ZM15 29C15.5933 29 16.1734 29.1759 16.6667 29.5056C17.1601 29.8352 17.5446 30.3038 17.7716 30.852C17.9987 31.4001 18.0581 32.0033 17.9424 32.5853C17.8266 33.1672 17.5409 33.7018 17.1213 34.1213C16.7018 34.5409 16.1672 34.8266 15.5853 34.9424C15.0033 35.0581 14.4001 34.9987 13.8519 34.7716C13.3038 34.5446 12.8352 34.1601 12.5056 33.6667C12.1759 33.1734 12 32.5933 12 32C12 31.2044 12.3161 30.4413 12.8787 29.8787C13.4413 29.3161 14.2044 29 15 29V29Z" fill="black"></path>
                                            <path d="M32 13C32.5523 13 33 12.5523 33 12C33 11.4477 32.5523 11 32 11C31.4477 11 31 11.4477 31 12C31 12.5523 31.4477 13 32 13Z" fill="black"></path>
                                            <path d="M62 18H39V13C39 11.1435 38.2625 9.36301 36.9497 8.05025C35.637 6.7375 33.8565 6 32 6C30.1435 6 28.363 6.7375 27.0503 8.05025C25.7375 9.36301 25 11.1435 25 13V18H2C1.73478 18 1.48043 18.1054 1.29289 18.2929C1.10536 18.4804 1 18.7348 1 19V57C1 57.2652 1.10536 57.5196 1.29289 57.7071C1.48043 57.8946 1.73478 58 2 58H62C62.2652 58 62.5196 57.8946 62.7071 57.7071C62.8946 57.5196 63 57.2652 63 57V19C63 18.7348 62.8946 18.4804 62.7071 18.2929C62.5196 18.1054 62.2652 18 62 18ZM27 13C27 11.6739 27.5268 10.4021 28.4645 9.46447C29.4021 8.52678 30.6739 8 32 8C33.3261 8 34.5979 8.52678 35.5355 9.46447C36.4732 10.4021 37 11.6739 37 13V22H27V13ZM61 56H3V20H25V22H23V24H41V22H39V20H61V56Z" fill="black"></path>
                                            <path d="M59 52H5V54H59V52Z" fill="black"></path>
                                            <path d="M59 35H41V37H59V35Z" fill="black"></path>
                                            <path d="M59 39H32V41H59V39Z" fill="black"></path>
                                            <path d="M59 43H32V45H59V43Z" fill="black"></path>
                                            <path d="M59 47H32V49H59V47Z" fill="black"></path>
                                            </svg></a>                                    

                                        <?php endif; ?>
                                    
                                    </div>
                                </span>
                            </td>
                        </tr>
                        <!-- Componente de Modal para cada Job -->
                        <?php if (isset($component)) { $__componentOriginald184043a5152e9f4dbdf80e2e79c1448 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald184043a5152e9f4dbdf80e2e79c1448 = $attributes; } ?>
<?php $component = App\View\Components\JobResumeModal::resolve(['jobId' => $job->id] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('job-resume-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\JobResumeModal::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald184043a5152e9f4dbdf80e2e79c1448)): ?>
<?php $attributes = $__attributesOriginald184043a5152e9f4dbdf80e2e79c1448; ?>
<?php unset($__attributesOriginald184043a5152e9f4dbdf80e2e79c1448); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald184043a5152e9f4dbdf80e2e79c1448)): ?>
<?php $component = $__componentOriginald184043a5152e9f4dbdf80e2e79c1448; ?>
<?php unset($__componentOriginald184043a5152e9f4dbdf80e2e79c1448); ?>
<?php endif; ?>    
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?> 
                    <tr><p>Nenhuma vaga Cadastrada!</p></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </article>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-custom'); ?>
    <style>
        .breadcrumb-item{
    font-size: 23px;
    font-weight: 500;
}

.breadcrumb-item a{

    color: grey !important;
}

.breadcrumb-item.active{
    color: #009cff !important;
}


/* tag status e btn editar*/
.btn-editar{
    box-sizing: border-box;
    box-shadow: 0 3px 3px rgba(0, 0, 0, 0.16);
    font-family: 'Montserrat';
    font-size: 12px;
    letter-spacing: 2px;
    position: relative;
    border-radius: 50px;
    display: flex;
    justify-content: flex-start;
    align-items: center;
    width: 105px;
    padding: 5px 5px 5px 5px;

}
.tag-status{
    box-sizing: border-box;
    box-shadow: 0 3px 3px rgba(0, 0, 0, 0.16);
    font-family: 'Montserrat';
    font-size: 12px;
    letter-spacing: 2px;
    position: relative;
    border-radius: 50px;
    display: flex;
    justify-content: flex-start;
    align-items: center;    
    padding: 5px 20px 5px 20px;
    width: fit-content;
    
}

.tag-status span{
    color: #183550;
    margin-left: 15px;
}

.tag-status svg{
    overflow: visible;
    width: 20px;
    height: auto;    
}
.icone-editar{
    background: #F8F8F8;
    border-radius: 50px;
    -moz-border-radius: 50px;
    -webkit-border-radius: 50px;
    -ms-border-radius: 50px;
    width: 30px;
    height: 30px;
    display: flex;
    justify-content: center;
    align-items: center;    
}
.icone-editar svg{
    overflow: visible;
    width: 20px;
    height: auto;
    stroke: #183550;

}


.btn-editar span{
color: gray;
margin-left: 10px;
}

.container-info h4{
    font-size: 30px;
    font-weight: 400;
}

.container-info p{
    font-size: 12px;
    font-weight: 600;
}

.sessao h4{
    font-weight: 500;
    font-size: 15px;
}

.sessao p{
    font-weight: 500;
    font-size: 11px;
    color: #aaaaaa;
}


.f1-2.b-Blue small{
    font-size: 12px;
}

td{
    border: none;
}
    </style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/flav6095/painelasppe.com.br/resources/views/jobs/show.blade.php ENDPATH**/ ?>