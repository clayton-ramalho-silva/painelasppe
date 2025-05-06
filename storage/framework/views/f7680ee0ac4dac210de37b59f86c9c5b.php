<?php $__env->startSection('content'); ?>
<section class="cabecario">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('users.index')); ?>">Entrevista</a></li>
          <li class="breadcrumb-item active" aria-current="page">Candidato: <?php echo e($resume->informacoesPessoais->nome); ?></li>
        </ol>
      </nav>

      
      <?php
          // Guarda a rota na variável
          $rota = route('users.index');
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

    <article class="f1">

        <div class="container">

            <div class="row mb-3 mt-3">
                <div class="col-4">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Associar a uma vaga
                    </button>
                </div>
            </div>

            <!-- Modal -->
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Vagas abertas</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Empresa</th>
                                                    <th>Título</th>
                                                    <th>Quantidade</th>
                                                    <th>Cidade</th>
                                                    <th>Vagas Preenchidas</th>
                                                    <th>Candidatos Selecionados</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if($jobs->count() > 0): ?>
                                                    <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                        <tr>
                                                            <td><?php echo e($job->company->nome_fantasia); ?></td>
                                                            <td><?php echo e($job->cargo); ?></td>
                                                            <td><?php echo e($job->qtd_vagas); ?></td>
                                                            <td><?php echo e($job->cidade); ?></td>
                                                            <td><?php echo e($job->filled_positions); ?></td>
                                                            <td><?php if($job->resumes->count() > 0): ?>
                                                                <?php echo e($job->resumes->count()); ?> candidatos
                                                            <?php else: ?>
                                                                Nenhum candidato selecionado
                                                            <?php endif; ?></td>
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
                                                                    <button disabled="disabled" class="btn btn-primagy btn-sm d-inline">Associado</button>
                                                                <?php else: ?>

                                                                <form action="<?php echo e(route('interviews.associarVaga')); ?>" method="POST" style="display:inline;">
                                                                    <?php echo csrf_field(); ?>
                                                                    <input type="hidden" name="job_id" value="<?php echo e($job->id); ?>">
                                                                    <input type="hidden" name="resume_id" value="<?php echo e($resume->id); ?>">
                                                                    <button type="submit" class="btn btn-success btn-sm">Associar</button>
                                                                </form>
                                                                <?php endif; ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <tr><p>Nenhuma vaga encontrada</p></tr>
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

            <form action="<?php echo e(route('resumes.update', $resume)); ?>" class="form-padrao" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="row">
                    <div class="col-8">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel" placeholder="Nome Completo" id="nome" name="nome" required value="<?php echo e($resume->informacoesPessoais->nome); ?>">
                            <?php $__errorArgs = ['nome'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper required">
                                <label for="date" class="label-floatlabel" class="form-label floatlabel-label">Data de Nascimento</label>
                                <input type="date" class="form-control active-floatlabel" id="data_nascimento" name="data_nascimento" value="<?php echo e($resume->informacoesPessoais->data_nascimento); ?>" required >
                                <?php $__errorArgs = ['data_nascimento'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper required">
                                <label for="estado_civil" class="label-floatlabel" class="form-label floatlabel-label">Estado Civil</label>
                                <select name="estado_civil" id="estado_civil" class="form-select active-floatlabel" required>
                                    <option value="Solteiro" <?php echo e($resume->informacoesPessoais->estado_civil === 'Solteiro' ? 'selected' : ''); ?> > Solteiro</option>
                                    <option value="Casado" <?php echo e($resume->informacoesPessoais->estado_civil === 'Casado' ? 'selected' : ''); ?>> Casado</option>
                                    <option value="Divorciado" <?php echo e($resume->informacoesPessoais->estado_civil === 'Divorciado' ? 'selected' : ''); ?>> Divorciado</option>
                                    <option value="Viúvo" <?php echo e($resume->informacoesPessoais->estado_civil === 'Viúvo' ? 'selected' : ''); ?>> Viúvo</option>
                                    <option value="Separado" <?php echo e($resume->informacoesPessoais->estado_civil === 'Separado' ? 'selected' : ''); ?>> Separado</option>
                                </select>
                                <?php $__errorArgs = ['estado_civil'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper required">
                                <label for="possui_filhos" class="label-floatlabel" class="form-label floatlabel-label">Possui filhos?</label>
                                <select name="possui_filhos" id="possui_filhos" class="form-select active-floatlabel" required>
                                    <option value="Sim" <?php echo e($resume->informacoesPessoais->possui_filhos === 'Sim' ? 'selected' : ''); ?>> Sim</option>
                                    <option value="Não" <?php echo e($resume->informacoesPessoais->possui_filhos === 'Não' ? 'selected' : ''); ?>> Não</option>
                                </select>
                                <?php $__errorArgs = ['possui_filhos'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper required">
                                <label for="sexo" class="label-floatlabel" class="form-label floatlabel-label">Gênero</label>
                                <select name="sexo" id="sexo" class="form-select active-floatlabel" required>
                                    <option value="Homem" <?php echo e($resume->informacoesPessoais->sexo === 'Homem' ? 'selected' : ''); ?>> Homem</option>
                                    <option value="Mulher" <?php echo e($resume->informacoesPessoais->sexo === 'Mulher' ? 'selected' : ''); ?>> Mulher</option>
                                    <option value="Prefiro não dizer" <?php echo e($resume->informacoesPessoais->sexo === 'Prefiro não dizer' ? 'selected' : ''); ?> > Prefiro não dizer</option>
                                </select>
                                <?php $__errorArgs = ['sexo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <p>Tem Reservista?</p>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="reservista" id="reservista1" value="Sim" <?php echo e($resume->informacoesPessoais->reservista === 'Sim' ? 'checked' : ''); ?>>
                                <?php $__errorArgs = ['reservista'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <label class="form-check-label" for="reservista1">
                                Sim
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="reservista" id="reservista2" value="Não" <?php echo e($resume->informacoesPessoais->reservista === 'Não' ? 'checked' : ''); ?>>
                                <?php $__errorArgs = ['reservista'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <label class="form-check-label" for="reservista2">
                                Não
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="reservista" id="reservista3" value="Em andamento" <?php echo e($resume->informacoesPessoais->reservista === 'Em andamento' ? 'checked' : ''); ?>>
                                <?php $__errorArgs = ['reservista'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <label class="form-check-label" for="reservista2">
                                Em andamento
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <label for="rg" class="form-label">RG</label>
                            <input type="text" class="form-control" id="rg" name="rg" required value="<?php echo e($resume->informacoesPessoais->rg); ?>">
                            <?php $__errorArgs = ['rg'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" required value="<?php echo e($resume->informacoesPessoais->cpf); ?>">
                            <?php $__errorArgs = ['cpf'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <label for="logradouro" class="form-label">Rua</label>
                            <input type="text" class="form-control" id="logradouro" name="logradouro" required value="<?php echo e($resume->contato->logradouro); ?>">
                            <?php $__errorArgs = ['logradouro'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="mb-3">
                            <label for="numero" class="form-label">Numero</label>
                            <input type="text" class="form-control" id="numero" name="numero" required value="<?php echo e($resume->contato->numero); ?>">
                            <?php $__errorArgs = ['numero'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <label for="complemento" class="form-label">Complemento</label>
                            <input type="text" class="form-control" id="complemento" name="complemento" value="<?php echo e($resume->contato->complemento); ?>">
                            <?php $__errorArgs = ['complemento'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <label for="bairro" class="form-label">Bairro</label>
                            <input type="text" class="form-control" id="bairro" name="bairro" required value="<?php echo e($resume->contato->bairro); ?>">
                            <?php $__errorArgs = ['bairro'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="cidade" class="form-label">Cidade</label>
                            <input type="text" class="form-control" id="cidade" name="cidade" required value="<?php echo e($resume->contato->cidade); ?>">
                            <?php $__errorArgs = ['cidade'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="mb-3">
                            <label for="uf" class="form-label">UF</label>
                            <input type="text" class="form-control" id="uf" name="uf" required value="<?php echo e($resume->contato->uf); ?>">
                            <?php $__errorArgs = ['uf'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="cep" class="form-label">CEP</label>
                            <input type="text" class="form-control" id="cep" name="cep" required value="<?php echo e($resume->contato->cep); ?>">
                            <?php $__errorArgs = ['cep'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" required value="<?php echo e($resume->contato->email); ?>">
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <label for="telefone_celular" class="form-label">Telefone Celular</label>
                            <input type="text" class="form-control" id="telefone_celular" name="telefone_celular" required value="<?php echo e($resume->contato->telefone_celular); ?>">
                            <?php $__errorArgs = ['telefone_celular'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <label for="telefone_residencial" class="form-label">Telefone de Contato</label>
                            <input type="text" class="form-control" id="telefone_residencial" name="telefone_residencial" value="<?php echo e($resume->contato->telefone_residencial); ?>">
                            <?php $__errorArgs = ['telefone_residencial'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <label for="nome_contato" class="form-label">Nome de contato</label>
                            <input type="text" class="form-control" id="nome_contato" name="nome_contato" value="<?php echo e($resume->contato->nome_contato); ?>">
                            <?php $__errorArgs = ['nome_contato'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper required">
                                <label for="sexo" class="label-floatlabel" class="form-label floatlabel-label">Possui CNH?</label>
                                <select name="cnh" id="cnh" class="form-select active-floatlabel" required>
                                    <option value="Sim" <?php echo e($resume->informacoesPessoais->cnh === 'Sim' ? 'selected' : ''); ?>> Sim</option>
                                    <option value="Não" <?php echo e($resume->informacoesPessoais->cnh === 'Não' ? 'selected' : ''); ?>> Não</option>
                                    <option value="Em andamento" <?php echo e($resume->informacoesPessoais->cnh === 'Em andamento' ? 'selected' : ''); ?>> Em andamento</option>
                                </select>
                                <?php $__errorArgs = ['cnh'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <input type="text" placeholder="Instagram (opcional)" class="floatlabel form-control" id="instagram" name="instagram" value="<?php echo e($resume->informacoesPessoais->instagram); ?>">
                            <?php $__errorArgs = ['instagram'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <input type="text" placeholder="LinkedIn (opcional)" class="floatlabel form-control" id="linkedin" name="linkedin" value="<?php echo e($resume->informacoesPessoais->linkedin); ?>">
                            <?php $__errorArgs = ['linkedin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Em quais vagas você está interessado?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="vagas_interesse" value="Copa & Cozinha" name="vagas_interesse[]" <?php if(in_array('Copa & Cozinha', $resume->vagas_interesse ?? [])): echo 'checked'; endif; ?> >
                                <label class="form-check-label" for="vagas_interesse">
                                    Copa & Cozinha
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="vagas_interesse" value="Administrativo" name="vagas_interesse[]" <?php if(in_array('Administrativo', $resume->vagas_interesse ?? [])): echo 'checked'; endif; ?>>
                                <label class="form-check-label" for="vagas_interesse">
                                    Administrativo
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="vagas_interesse" value="Camareiro(a) de Hotel" name="vagas_interesse[]" <?php if(in_array('Camareiro(a) de Hotel', $resume->vagas_interesse ?? [])): echo 'checked'; endif; ?>>
                                <label class="form-check-label" for="vagas_interesse">
                                    Camareiro(a) de Hotel
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="vagas_interesse" value="Recepcionista" name="vagas_interesse[]" <?php if(in_array('Recepcionista', $resume->vagas_interesse ?? [])): echo 'checked'; endif; ?>>
                                <label class="form-check-label" for="vagas_interesse">
                                    Recepcionista
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="vagas_interesse" value="Atendente de Lojas e Mercados (Comércio & Varejo)" name="vagas_interesse[]" <?php if(in_array('Atendente de Lojas e Mercados (Comércio & Varejo)', $resume->vagas_interesse ?? [])): echo 'checked'; endif; ?>>
                                <label class="form-check-label" for="vagas_interesse">
                                    Atendente de Lojas e Mercados (Comércio & Varejo)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="vagas_interesse" value="Construção e Reparos" name="vagas_interesse[]" <?php if(in_array('Construção e Reparos', $resume->vagas_interesse ?? [])): echo 'checked'; endif; ?>>
                                <label class="form-check-label" for="vagas_interesse">
                                    Construção e Reparos
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="vagas_interesse7" value="Conservação e Limpeza" name="vagas_interesse[]" <?php if(in_array('Conservação e Limpeza', $resume->vagas_interesse ?? [])): echo 'checked'; endif; ?>>
                                <label class="form-check-label" for="vagas_interesse7">
                                    Conservação e Limpeza
                                </label>
                            </div>
                            <?php $__errorArgs = ['vagas_interesse'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <label for="telefone_residencial" class="form-label">Já possui alguma experiência profissional?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="experiencia_profissional" value="Nenhuma por enquanto" name="experiencia_profissional[]" <?php if(in_array('Nenhuma por enquanto', $resume->experiencia_profissional ?? [])): echo 'checked'; endif; ?>>
                                <label class="form-check-label" for="experiencia_profissional">
                                    Nenhuma por enquanto
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="experiencia_profissional" value="Copa & Cozinha" name="experiencia_profissional[]" <?php if(in_array('Copa & Cozinha', $resume->experiencia_profissional ?? [])): echo 'checked'; endif; ?>>
                                <label class="form-check-label" for="experiencia_profissional">
                                    Copa & Cozinha
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="experiencia_profissional" value="Administrativo" name="experiencia_profissional[]" <?php if(in_array('Administrativo', $resume->experiencia_profissional ?? [])): echo 'checked'; endif; ?>>
                                <label class="form-check-label" for="experiencia_profissional">
                                    Administrativo
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="experiencia_profissional" value="Camareiro(a) de Hotel" name="experiencia_profissional[]" <?php if(in_array('Camareiro(a) de Hotel', $resume->experiencia_profissional ?? [])): echo 'checked'; endif; ?>>
                                <label class="form-check-label" for="experiencia_profissional">
                                    Camareiro(a) de Hotel
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="experiencia_profissional" value="Recepcionista" name="experiencia_profissional[]" <?php if(in_array('Recepcionista', $resume->experiencia_profissional ?? [])): echo 'checked'; endif; ?>>
                                <label class="form-check-label" for="experiencia_profissional">
                                    Recepcionista
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="experiencia_profissional" value="Atendente de Lojas e Mercados (Comércio & Varejo)" name="experiencia_profissional[]" <?php if(in_array('Atendente de Lojas e Mercados (Comércio & Varejo)', $resume->experiencia_profissional ?? [])): echo 'checked'; endif; ?>>
                                <label class="form-check-label" for="experiencia_profissional">
                                    Atendente de Lojas e Mercados (Comércio & Varejo)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="experiencia_profissional" value="TI (Tecnologia da Informação)" name="experiencia_profissional[]" <?php if(in_array('TI (Tecnologia da Informação)', $resume->experiencia_profissional ?? [])): echo 'checked'; endif; ?>>
                                <label class="form-check-label" for="experiencia_profissional">
                                    TI (Tecnologia da Informação)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="experiencia_profissional" value="Construção e Reparos" name="experiencia_profissional[]" <?php if(in_array('Construção e Reparos', $resume->experiencia_profissional ?? [])): echo 'checked'; endif; ?>>
                                <label class="form-check-label" for="experiencia_profissional">
                                    Construção e Reparos
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="experiencia_profissional9" value="Conservação e Limpeza" name="experiencia_profissional[]" <?php if(in_array('Conservação e Limpeza', $resume->experiencia_profissional ?? [])): echo 'checked'; endif; ?>>
                                <label class="form-check-label" for="experiencia_profissional9">
                                    Conservação e Limpeza
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="experiencia_profissional" value="Outro" name="experiencia_profissional[]" <?php if(in_array('Outro', $resume->experiencia_profissional ?? [])): echo 'checked'; endif; ?>>
                                <label class="form-check-label" for="experiencia_profissional">
                                    Outro:
                                </label>
                            </div>
                            <?php $__errorArgs = ['experiencia_profissional'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <label for="telefone_celular" class="form-label">Formação/Escolaridade*
                                (Especifique no campo "OUTRO" caso tenha Ensino Superior, Técnico ou outro)</label>
                                <div class="form-check form-check">
                                    <input class="form-check-input" type="radio" name="escolaridade" id="escolaridade1" value="Ensino Médio Incompleto" <?php echo e($resume->escolaridade->escolaridade === 'Ensino Médio Incompleto' ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="escolaridade1">
                                        Ensino Médio Incompleto
                                    </label>
                                </div>
                                <div class="form-check form-check">
                                    <input class="form-check-input" type="radio" name="escolaridade" id="escolaridade2" value="Ensino Médio Completo" <?php echo e($resume->escolaridade->escolaridade === 'Ensino Médio Completo' ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="escolaridade2">
                                        Ensino Médio Completo
                                    </label>
                                </div>
                                <div class="form-check form-check">
                                    <input class="form-check-input" type="radio" name="escolaridade" id="escolaridade3" value="Outro" <?php echo e($resume->escolaridade->escolaridade === 'Outro' ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="escolaridade3">
                                    Outro
                                    </label>
                                </div>
                                <?php $__errorArgs = ['escolaridade'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    

                    <div class="col-4">
                        <div class="mb-3">
                            <label for="telefone_celular" class="form-label">Já foi Jovem Aprendiz?</label>
                            <div class="form-check form-check">
                                <input class="form-check-input" type="radio" name="foi_jovem_aprendiz" id="foi_jovem_aprendiz1" value="Sim, da ASPPE" <?php echo e($resume->foi_jovem_aprendiz === 'Sim, da ASPPE' ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="foi_jovem_aprendiz1">
                                    Sim, da ASPPE
                                </label>
                            </div>
                            <div class="form-check form-check">
                                <input class="form-check-input" type="radio" name="foi_jovem_aprendiz" id="foi_jovem_aprendiz2" value="Sim, de Outra Qualificadora" <?php echo e($resume->foi_jovem_aprendiz === 'Sim, de Outra Qualificadora' ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="foi_jovem_aprendiz2">
                                    Sim, de Outra Qualificadora
                                </label>
                            </div>
                            <div class="form-check form-check">
                                <input class="form-check-input" type="radio" name="foi_jovem_aprendiz" id="foi_jovem_aprendiz3" value="Não" <?php echo e($resume->foi_jovem_aprendiz === 'Não' ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="participou_selecao3">
                                    Não
                                </label>
                            </div>
                            <?php $__errorArgs = ['foi_jovem_aprendiz'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <label for="informatica" class="form-label">Possui conhecimento de Informática?</label>
                            <select name="informatica" id="informatica" class="form-select" required>
                                <option value="Básico" <?php echo e($resume->escolaridade->informatica === 'Básico' ? 'selected' : ' '); ?>> Básico</option>
                                <option value="Intermediário" <?php echo e($resume->escolaridade->informatica === 'Intermediário' ? 'selected' : ' '); ?>> Intermediário</option>
                                <option value="Avançado" <?php echo e($resume->escolaridade->informatica === 'Avançado' ? 'selected' : ' '); ?>> Avançado</option>
                                <option value="Nenhum" <?php echo e($resume->escolaridade->informatica === 'Nenhum' ? 'selected' : ' '); ?>> Nenhum</option>
                            </select>
                            <?php $__errorArgs = ['informatica'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <label for="ingles" class="form-label">Possui conhecimento de Inglês?</label>
                            <select name="ingles" id="ingles" class="form-select" required>
                                <option value="Básico" <?php echo e($resume->escolaridade->ingles === 'Básico' ? 'selected' : ''); ?>> Básico</option>
                                <option value="Intermediário" <?php echo e($resume->escolaridade->ingles === 'Intermediário' ? 'selected' : ''); ?>> Intermediário</option>
                                <option value="Avançado" <?php echo e($resume->escolaridade->ingles === 'Avançado' ? 'selected' : ''); ?>> Avançado</option>
                                <option value="Nenhum" <?php echo e($resume->escolaridade->ingles === 'Nenhum' ? 'selected' : ''); ?>> Nenhum</option>
                            </select>
                            <?php $__errorArgs = ['ingles'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <label for="tamanho_uniforme" class="form-label">Tamanho para Confecção dos Uniformes</label>
                            <select name="tamanho_uniforme" id="tamanho_uniforme" class="form-select" required>
                                <option value="FEMININO: Baby Look P" <?php echo e($resume->informacoesPessoais->tamanho_uniforme === 'FEMININO: Baby Look P' ? 'selected' : ''); ?>> FEMININO: Baby Look P</option>
                                <option value="FEMININO: Baby Look M" <?php echo e($resume->informacoesPessoais->tamanho_uniforme === 'FEMININO: Baby Look M' ? 'selected' : ''); ?>> FEMININO: Baby Look M</option>
                                <option value="FEMININO: Baby Look G" <?php echo e($resume->informacoesPessoais->tamanho_uniforme === 'FEMININO: Baby Look G' ? 'selected' : ''); ?>> FEMININO: Baby Look G</option>
                                <option value="FEMININO: Baby Look GG" <?php echo e($resume->informacoesPessoais->tamanho_uniforme === 'FEMININO: Baby Look GG' ? 'selected' : ''); ?>> FEMININO: Baby Look GG</option>
                                <option value="MASCULINO:  P" <?php echo e($resume->informacoesPessoais->tamanho_uniforme === 'MASCULINO:  P' ? 'selected' : ''); ?>> MASCULINO:  P</option>
                                <option value="MASCULINO:  M" <?php echo e($resume->informacoesPessoais->tamanho_uniforme === 'MASCULINO:  M' ? 'selected' : ''); ?>> MASCULINO:  M</option>
                                <option value="MASCULINO:  G" <?php echo e($resume->informacoesPessoais->tamanho_uniforme === 'MASCULINO:  G' ? 'selected' : ''); ?>> MASCULINO:  G</option>
                                <option value="MASCULINO:  GG" <?php echo e($resume->informacoesPessoais->tamanho_uniforme === 'MASCULINO:  GG' ? 'selected' : ''); ?>> MASCULINO:  GG</option>
                            </select>
                            <?php $__errorArgs = ['tamanho_uniforme'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="mb-3">
                            <label for="curriculo_doc" class="form-label">Envie seu currículo</label>

                            <?php
                                $curriculo = $resume->curriculo_doc;
                                $curriculoPath = $curriculo ? asset("documents/resumes/curriculos/{$curriculo}") : "https://github.com/mdo.png";
                            ?>
                            <a href="<?php echo e($curriculoPath); ?>" target="_blank" > Curriculo atual </a>
                            <input type="file" class="form-control" id="curriculo_doc" name="curriculo_doc" value="<?php echo e($resume->curriculo_doc); ?>">
                            <?php $__errorArgs = ['curriculo_doc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                </div>

                <div class="row bg-light p-3 mb-2">
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary">Salvar Alterações no Currículo</button>

                    </div>
                </div>

            </form>
        </div>
            </article>
        </section>
        <section class="sessao mt-5">

            <article class="f1">

        <div class="container">
            <div class="row mb-3 mt-3">
                <div class="col-4">
                    <h4>Entrevista</h4>
                </div>
                <div class="col-4">
                    <div class="mb-6">
                        <p>Data Entrevista: <?php echo e($interview->created_at->format('d/m/Y')); ?></p>

                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-6">
                        <p>Hora Entrevista: <?php echo e($interview->created_at->format('H:i:s')); ?></p>

                    </div>
                </div>
            </div>

            <form action="<?php echo e(route('interviews.store')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="resume_id" value="<?php echo e($resume->id); ?>">
                <div class="row mb-3 mt-3">
                    <div class="col-3">
                        <div class="mb-3">
                            <label for="saude_candidato" class="form-label">Saúde do Candidato:</label>
                            <input type="text" class="form-control" id="saude_candidato" name="saude_candidato" required value="<?php echo e($interview->saude_candidato); ?>">
                            <?php $__errorArgs = ['saude_candidato'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="vacina_covid" class="form-label">Vacina COVID:</label>
                            <input type="text" class="form-control" id="vacina_covid" name="vacina_covid" required value="<?php echo e($interview->vacina_covid); ?>">
                            <?php $__errorArgs = ['vacina_covid'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>


                    <div class="col-3">
                        <div class="mb-3">
                            <label for="perfil" class="form-label">Perfil:</label>
                            <input type="text" class="form-control" id="perfil" name="perfil" required value="<?php echo e($interview->perfil); ?>">
                            <?php $__errorArgs = ['perfil'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="perfil_santa_casa" class="form-label">Perfil Santa Casa:</label>
                            <input type="text" class="form-control" id="perfil_santa_casa" name="perfil_santa_casa" required value="<?php echo e($interview->perfil_santa_casa); ?>">
                            <?php $__errorArgs = ['perfil_santa_casa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="classificacao" class="form-label">Classificação:</label>
                            <input type="text" class="form-control" id="classificacao" name="classificacao" required value="<?php echo e($interview->classificacao); ?>">
                            <?php $__errorArgs = ['classificacao'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>


                    <div class="col-3">
                        <div class="mb-3">
                            <label for="qual_formadora" class="form-label">Qual a formadora?(Caso já tenha sido jovem aprendiz.)</label>
                            <input type="text" class="form-control" id="qual_formadora" name="qual_formadora" required value="<?php echo e($interview->qual_formadora); ?>">
                            <?php $__errorArgs = ['qual_formadora'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="parecer_recrutador" class="form-label">Parecer do Entrevistador:</label>
                            <textarea type="text" class="form-control" id="parecer_recrutador" name="parecer_recrutador" ><?php echo e($interview->parecer_recrutador); ?></textarea>
                            <?php $__errorArgs = ['parecer_recrutador'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="curso_extracurricular" class="form-label">Cursos Extracurriculares:</label>
                            <textarea class="form-control" id="curso_extracurricular" name="curso_extracurricular" ><?php echo e($interview->curso_extracurricular); ?></textarea>
                            <?php $__errorArgs = ['curso_extracurricular'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="mb-3">
                            <label for="apresentacao_pessoal" class="form-label">Apresentação Pessoal:</label>
                            <textarea class="form-control" id="apresentacao_pessoal" name="apresentacao_pessoal" ><?php echo e($interview->apresentacao_pessoal); ?></textarea>
                            <?php $__errorArgs = ['apresentacao_pessoal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="experiencia_profissional" class="form-label">Experiência Profissional (Tempo de Empresa/Motivo da Saída):</label>
                            <textarea class="form-control" id="experiencia_profissional" name="experiencia_profissional" ><?php echo e($interview->experiencia_profissional); ?></textarea>
                            <?php $__errorArgs = ['experiencia_profissional'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="caracteristicas_positivas" class="form-label">Características Positivas:</label>
                            <textarea class="form-control" id="caracteristicas_positivas" name="caracteristicas_positivas" ><?php echo e($interview->caracteristicas_positivas); ?></textarea>
                            <?php $__errorArgs = ['caracteristicas_positivas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="habilidades" class="form-label">Habilidades:</label>
                            <textarea class="form-control" id="habilidades" name="habilidades" ><?php echo e($interview->habilidades); ?></textarea>
                            <?php $__errorArgs = ['habilidades'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="porque_ser_jovem_aprendiz" class="form-label">Porque gostaria de ser Jovem Aprendiz?</label>
                            <textarea class="form-control" id="porque_ser_jovem_aprendiz" name="porque_ser_jovem_aprendiz" ><?php echo e($interview->porque_ser_jovem_aprendiz); ?></textarea>
                            <?php $__errorArgs = ['porque_ser_jovem_aprendiz'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="qual_motivo_demissao" class="form-label">Por qual motivo pediria demissão:</label>
                            <textarea class="form-control" id="qual_motivo_demissao" name="qual_motivo_demissao" ><?php echo e($interview->qual_motivo_demissao); ?></textarea>
                            <?php $__errorArgs = ['qual_motivo_demissao'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="pretencao_candidato" class="form-label">Pretenções do candidato:</label>
                            <textarea class="form-control" id="pretencao_candidato" name="pretencao_candidato" ><?php echo e($interview->pretencao_candidato); ?></textarea>
                            <?php $__errorArgs = ['pretencao_candidato'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="objetivo_longo_prazo" class="form-label">Objetivos longo prazo:</label>
                            <textarea class="form-control" id="objetivo_longo_prazo" name="objetivo_longo_prazo" ><?php echo e($interview->objetivo_longo_prazo); ?></textarea>
                            <?php $__errorArgs = ['objetivo_longo_prazo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="pontos_melhoria" class="form-label">Pontos de Melhoria:</label>
                            <textarea class="form-control" id="pontos_melhoria" name="pontos_melhoria" ><?php echo e($interview->pontos_melhoria); ?></textarea>
                            <?php $__errorArgs = ['pontos_melhoria'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="familia" class="form-label">Família:</label>
                            <textarea class="form-control" id="familia" name="familia" ><?php echo e($interview->familia); ?></textarea>
                            <?php $__errorArgs = ['familia'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="disponibilidade_horario" class="form-label">Disponibilidade de Horário:</label>
                            <textarea class="form-control" id="disponibilidade_horario" name="disponibilidade_horario" ><?php echo e($interview->disponibilidade_horario); ?></textarea>
                            <?php $__errorArgs = ['disponibilidade_horario'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="sobre_candidato" class="form-label">Fale um pouco sobre você:</label>
                            <textarea class="form-control" id="sobre_candidato" name="sobre_candidato" ><?php echo e($interview->sobre_candidato); ?></textarea>
                            <?php $__errorArgs = ['sobre_candidato'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="rotina_candidato" class="form-label">Qual a sua rotina?</label>
                            <textarea class="form-control" id="rotina_candidato" name="rotina_candidato" ><?php echo e($interview->rotina_candidato); ?></textarea>
                            <?php $__errorArgs = ['rotina_candidato'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="familia_cras" class="form-label">Sua família é atendida no CRAS?</label>
                            <select name="familia_cras" id="familia_cras" class="form-select" required>
                                <option value="Sim" <?php echo e($interview->familia_cras === 'Sim' ? 'selected' : ''); ?>> Sim</option>
                                <option value="Não" <?php echo e($interview->familia_cras === 'Não' ? 'selected' : ''); ?>> Não</option>
                            </select>
                            <?php $__errorArgs = ['familia_cras'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="outros_idiomas" class="form-label">Outros idiomas?</label>
                            <textarea class="form-control" id="outros_idiomas" name="outros_idiomas" ><?php echo e($interview->outros_idiomas); ?></textarea>
                            <?php $__errorArgs = ['outros_idiomas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="fonte_curriculo" class="form-label">Fonte de Captação do Currículo</label>
                            <input type="text" class="form-control" id="fonte_curriculo" name="fonte_curriculo" required value="<?php echo e($interview->fonte_curriculo); ?>">
                            <?php $__errorArgs = ['fonte_curriculo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="sugestao_empresa" class="form-label">Sugestão Empresa</label>
                            <textarea class="form-control" id="sugestao_empresa" name="sugestao_empresa" ><?php echo e($interview->sugestao_empresa); ?></textarea>
                            <?php $__errorArgs = ['sugestao_empresa'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="observacoes" class="form-label">Observações:</label>
                            <textarea class="form-control" id="observacoes" name="observacoes" ><?php echo e($interview->observacoes); ?></textarea>
                            <?php $__errorArgs = ['observacoes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="mb-3">
                            <label for="pontuacao" class="form-label">Pontuação</label>
                            <input type="text" class="form-control" id="pontuacao" name="pontuacao" required value="<?php echo e($interview->pontuacao); ?>">
                            <?php $__errorArgs = ['pontuacao'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>
                <div class="row bg-light p-3 mb-2">
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary" disabled>Salvar Entrevista</button>

                    </div>
                </div>

            </form>

        </div>

    </article>

</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-custom'); ?>
<style>
article.container-form-create{
    box-shadow: none;
    padding: 0;
}


/* Esconde o input original */
.file-input {
    display: none;
}

/* Estiliza o botão */
.file-label {
    display: inline-block;
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s;
}

/* Efeito hover */
.file-label:hover {
    background-color: #0056b3;
}

/* Estiliza o texto do nome do arquivo */
.file-name {
    margin-left: 10px;
    font-size: 14px;
    color: #333;
}

/* Estiliza a prévia da imagem */
.preview-container {
    text-align: center;
    margin-top: 15px;
}

.preview-image {
    display: block;
    max-width: 200px;
    max-height: 200px;
    width: auto;
    height: auto;
    border-radius: 10px;
    border: 2px solid #ddd;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
}

.btn-select-file{
    background-color: gray;
}

.btn-select-file:hover{
    background-color: #a7a7a7;
}
        .btn-cadastrar{
    background-color: #0056b3;
    padding: 10px 50px;
}

.btn-cadastrar:hover{
    background-color: #046dde;
}

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
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/flav6095/painelasppe.com.br/resources/views/interviews/show1.blade.php ENDPATH**/ ?>