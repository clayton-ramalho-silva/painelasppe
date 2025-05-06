<?php $__env->startSection('content'); ?>
<section class="cabecario">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('users.index')); ?>">Nova Entrevista</a></li>
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

        <div class="container mt-3">

            <form class="form-padrao" id="form-companies-create" action="<?php echo e(route('resumes.update', $resume)); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="row">

                    <div class="col-9 py-0 pe-5 form-l">

                        <div class="row">

                            <div class="col-6 form-campo">
                                <div class="mb-3">
                                    <input type="text" placeholder="Nome Completo" class="floatlabel form-control" id="nome" name="nome" required value="<?php echo e($resume->informacoesPessoais->nome); ?>">
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

                            <div class="col-6 form-campo">
                                <div class="mb-3">
                                    <input type="email" placeholder="E-mail" class="floatlabel form-control" id="email" name="email" required value="<?php echo e($resume->contato->email); ?>">
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

                            <div class="col-6 form-campo">
                                <div class="mb-3">
                                    <div class="floatlabel-wrapper required">
                                        <label for="date" class="label-floatlabel" class="form-label floatlabel-label">Data de Nascimento</label>
                                        <input type="date" class="form-control active-floatlabel" id="data_nascimento" name="data_nascimento" value="<?php echo e($resume->informacoesPessoais->data_nascimento ? \Carbon\Carbon::parse($resume->informacoesPessoais->data_nascimento)->format('Y-m-d') : ''); ?>" required>
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

                            <div class="col-6 form-campo">
                                <div class="mb-3">
                                    <input type="text" placeholder="RG" class="floatlabel form-control" id="rg" name="rg" required value="<?php echo e($resume->informacoesPessoais->rg); ?>">
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

                            <div class="col-6 form-campo">
                                <div class="mb-3">
                                    <input type="text" placeholder="CPF" class="floatlabel form-control" id="cpf" name="cpf" required value="<?php echo e($resume->informacoesPessoais->cpf); ?>">
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

                            <div class="col-6 form-campo">
                                <div class="mb-3">
                                    <div class="floatlabel-wrapper required">
                                        <label for="estado_civil" class="label-floatlabel" class="form-label floatlabel-label">Estado Civil</label>
                                        <select name="estado_civil" id="estado_civil" class="form-select active-floatlabel" required>
                                            <option></option>
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

                            <div class="col-4 form-campo">
                                <div class="mb-3">
                                    <div class="floatlabel-wrapper required">
                                        <label for="possui_filhos" class="label-floatlabel" class="form-label floatlabel-label">Possui filhos?</label>
                                        <select name="possui_filhos" id="possui_filhos" class="form-select active-floatlabel" required>
                                            <option></option>
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

                            <div class="col-4 form-campo">
                                <div class="mb-3">
                                    <div class="floatlabel-wrapper required">
                                        <label for="sexo" class="label-floatlabel" class="form-label floatlabel-label">Gênero</label>
                                        <select name="sexo" id="sexo" class="form-select active-floatlabel" required>
                                            <option></option>
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

                            <div class="col-4 form-campo">
                                <div class="mb-3">
                                    <div class="floatlabel-wrapper required">
                                        <label for="sexo" class="label-floatlabel" class="form-label floatlabel-label">Possui CNH?</label>
                                        <select name="cnh" id="cnh" class="form-select active-floatlabel" required>
                                            <option></option>
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

                            <div class="col-6 form-campo">
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

                            <div class="col-6 form-campo">
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

                            <div class="col-4 form-campo">
                                <div class="mb-3">
                                    <input type="text" placeholder="Telefone Celular" class="floatlabel form-control" id="telefone_celular" name="telefone_celular" required value="<?php echo e($resume->contato->telefone_celular); ?>">
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

                            <div class="col-4 form-campo">
                                <div class="mb-3">
                                    <input type="text" placeholder="Telefone de Contato" class="floatlabel form-control" id="telefone_residencial" name="telefone_residencial" value="<?php echo e($resume->contato->telefone_residencial); ?>">
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

                            <div class="col-4 form-campo">
                                <div class="mb-3">
                                    <input type="text" placeholder="Nome para contato" class="floatlabel form-control" id="nome_contato" name="nome_contato" value="<?php echo e($resume->contato->nome_contato); ?>">
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

                            <h4 class="fw-normal mb-4 mt-4">Endereço</h4>

                            <div class="col-3 form-campo">
                                <div class="mb-3 position-relative">
                                    <i class="fas fa-spinner"></i>
                                    <input type="text" placeholder="CEP" class="floatlabel form-control" id="cep" name="cep" required value="<?php echo e($resume->contato->cep); ?>">
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

                            <div class="col-7 form-campo">
                                <div class="mb-3">
                                    <input type="text" placeholder="Rua" class="floatlabel form-control" id="logradouro" name="logradouro" required value="<?php echo e($resume->contato->logradouro); ?>">
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

                            <div class="col-2 form-campo">
                                <div class="mb-3">
                                    <input type="text" placeholder="Número" class="floatlabel form-control" id="numero" name="numero" required value="<?php echo e($resume->contato->numero); ?>">
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

                            <div class="col-6 form-campo">
                                <div class="mb-3">
                                    <input type="text" placeholder="Complemento" class="floatlabel form-control" id="complemento" name="complemento" required value="<?php echo e($resume->contato->complemento); ?>">
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

                            <div class="col-6 form-campo">
                                <div class="mb-3">
                                    <input type="text" placeholder="Bairro" class="floatlabel form-control" id="bairro" name="bairro" required value="<?php echo e($resume->contato->bairro); ?>">
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

                            <div class="col-6 form-campo">
                                <div class="mb-3">
                                    <input type="text" placeholder="Cidade" class="floatlabel form-control" id="cidade" name="cidade" required value="<?php echo e($resume->contato->cidade); ?>">
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

                            <div class="col-6 form-campo">
                                <div class="mb-3">
                                    <input type="text" placeholder="UF" class="floatlabel form-control" id="uf" name="uf" required value="<?php echo e($resume->contato->uf); ?>">
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

                            <h4 class="fw-normal mb-4 mt-4">Mais Informações</h4>

                            <div class="d-flex col-6 form-campo">

                                <div class="mb-3 form-checkbox">
                                    <label for="telefone_celular" class="form-label">Tem Reservista?</label>
                                    <div class="form-check form-check">
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

                                    <div class="form-check form-check">
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

                                    <div class="form-check form-check">
                                        <input class="form-check-input" type="radio" name="reservista" id="reservista3" value="Em andamento" <?php echo e($resume->informacoesPessoais->reservista === 'Em andamento' ? 'checked' : ''); ?>>
                                        <?php $__errorArgs = ['reservista'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <label class="form-check-label" for="reservista3">
                                        Em andamento
                                        </label>
                                    </div>
                                </div>

                            </div>

                            <div class="d-flex col-6 form-campo">

                                <div class="mb-3 form-checkbox">
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
                                        <label class="form-check-label" for="foi_jovem_aprendiz3">
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

                            <div class="d-flex col-6 form-campo">

                                <div class="mb-3 form-checkbox">
                                    <label for="telefone_celular" class="form-label">Formação/Escolaridade*
                                        (Especifique no campo "OUTRO" caso tenha Ensino Superior, Técnico ou outro)</label>
                                        <div class="form-check form-check">
                                            <input class="form-check-input" type="checkbox" name="escolaridade[]" id="escolaridade1" value="Ensino Médio Incompleto" <?php if(in_array('Ensino Médio Incompleto', $resume->escolaridade->escolaridade ?? [])): echo 'checked'; endif; ?>>
                                            <label class="form-check-label" for="escolaridade1">
                                                Ensino Médio Incompleto
                                            </label>
                                        </div>
                                        <div class="form-check form-check">
                                            <input class="form-check-input" type="checkbox" name="escolaridade[]" id="escolaridade2" value="Ensino Médio Completo" <?php if(in_array('Ensino Médio Completo', $resume->escolaridade->escolaridade ?? [])): echo 'checked'; endif; ?>>
                                            <label class="form-check-label" for="escolaridade2">
                                                Ensino Médio Completo
                                            </label>
                                        </div>
                                        <div class="form-check form-check">
                                            <input class="form-check-input" type="checkbox" name="escolaridade[]" id="escolaridade3" value="Outro" <?php if(in_array('Outro', $resume->escolaridade->escolaridade ?? [])): echo 'checked'; endif; ?>>
                                            <label class="form-check-label" for="escolaridade3">
                                            Outro
                                            </label>
                                        </div>
                                        <div class="campo-escondido check-escolaridade"<?php echo $resume->escolaridade->escolaridade === 'Outro' ? ' style="display:block"' : ''; ?>>
                                            <input type="text" placeholder="Qual curso?" class="floatlabel form-control" id="escolaridade_outro" name="escolaridade_outro" value="<?php echo e($resume->escolaridade->escolaridade_outro); ?>">
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

                            <div class="d-flex col-6 form-campo">
                                <div class="mb-3 form-checkbox">
                                    <label for="email" class="form-label">Em quais vagas você está interessado?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="vagas_interesse1" value="Copa & Cozinha" name="vagas_interesse[]" <?php if(in_array('Copa & Cozinha', $resume->vagas_interesse ?? [])): echo 'checked'; endif; ?> >
                                        <label class="form-check-label" for="vagas_interesse1">
                                            Copa & Cozinha
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="vagas_interesse2" value="Administrativo" name="vagas_interesse[]" <?php if(in_array('Administrativo', $resume->vagas_interesse ?? [])): echo 'checked'; endif; ?> >
                                        <label class="form-check-label" for="vagas_interesse2">
                                            Administrativo
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="vagas_interesse3" value="Camareiro(a) de Hotel" name="vagas_interesse[]" <?php if(in_array('Camareiro(a) de Hotel', $resume->vagas_interesse ?? [])): echo 'checked'; endif; ?> >
                                        <label class="form-check-label" for="vagas_interesse3">
                                            Camareiro(a) de Hotel
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="vagas_interesse4" value="Recepcionista" name="vagas_interesse[]" <?php if(in_array('Recepcionista', $resume->vagas_interesse ?? [])): echo 'checked'; endif; ?> >
                                        <label class="form-check-label" for="vagas_interesse4">
                                            Recepcionista
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="vagas_interesse5" value="Atendente de Lojas e Mercados (Comércio & Varejo)" name="vagas_interesse[]" <?php if(in_array('Atendente de Lojas e Mercados (Comércio & Varejo)', $resume->vagas_interesse ?? [])): echo 'checked'; endif; ?> >
                                        <label class="form-check-label" for="vagas_interesse5">
                                            Atendente de Lojas e Mercados (Comércio & Varejo)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="vagas_interesse6" value="Construção e Reparos" name="vagas_interesse[]" <?php if(in_array('Construção e Reparos', $resume->vagas_interesse ?? [])): echo 'checked'; endif; ?> >
                                        <label class="form-check-label" for="vagas_interesse6">
                                            Construção e Reparos
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="vagas_interesse7" value="Conservação e Limpeza" name="vagas_interesse[]" <?php if(in_array('Conservação e Limpeza', $resume->vagas_interesse ?? [])): echo 'checked'; endif; ?> >
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

                            <div class="d-flex col-6 form-campo">
                                <div class="mb-3 form-checkbox">
                                    <label for="telefone_residencial" class="form-label">Já possui alguma experiência profissional?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="experiencia_profissional1" value="Nenhuma por enquanto" name="experiencia_profissional[]" <?php if(in_array('Nenhuma por enquanto', $resume->experiencia_profissional ?? [])): echo 'checked'; endif; ?>>
                                        <label class="form-check-label" for="experiencia_profissional1">
                                            Nenhuma por enquanto
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="experiencia_profissional2" value="Copa & Cozinha" name="experiencia_profissional[]" <?php if(in_array('Copa & Cozinha', $resume->experiencia_profissional ?? [])): echo 'checked'; endif; ?>>
                                        <label class="form-check-label" for="experiencia_profissional2">
                                            Copa & Cozinha
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="experiencia_profissional3" value="Administrativo" name="experiencia_profissional[]" <?php if(in_array('Administrativo', $resume->experiencia_profissional ?? [])): echo 'checked'; endif; ?>>
                                        <label class="form-check-label" for="experiencia_profissional3">
                                            Administrativo
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="experiencia_profissional4" value="Camareiro(a) de Hotel" name="experiencia_profissional[]" <?php if(in_array('Camareiro(a) de Hotel', $resume->experiencia_profissional ?? [])): echo 'checked'; endif; ?>>
                                        <label class="form-check-label" for="experiencia_profissional4">
                                            Camareiro(a) de Hotel
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="experiencia_profissional5" value="Recepcionista" name="experiencia_profissional[]" <?php if(in_array('Recepcionista', $resume->experiencia_profissional ?? [])): echo 'checked'; endif; ?>>
                                        <label class="form-check-label" for="experiencia_profissional5">
                                            Recepcionista
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="experiencia_profissional6" value="Atendente de Lojas e Mercados (Comércio & Varejo)" name="experiencia_profissional[]" <?php if(in_array('Atendente de Lojas e Mercados (Comércio & Varejo)', $resume->experiencia_profissional ?? [])): echo 'checked'; endif; ?>>
                                        <label class="form-check-label" for="experiencia_profissional6">
                                            Atendente de Lojas e Mercados (Comércio & Varejo)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="experiencia_profissional7" value="TI (Tecnologia da Informação)" name="experiencia_profissional[]" <?php if(in_array('TI (Tecnologia da Informação)', $resume->experiencia_profissional ?? [])): echo 'checked'; endif; ?>>
                                        <label class="form-check-label" for="experiencia_profissional7">
                                            TI (Tecnologia da Informação)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="experiencia_profissional8" value="Construção e Reparos" name="experiencia_profissional[]" <?php if(in_array('Construção e Reparos', $resume->experiencia_profissional ?? [])): echo 'checked'; endif; ?>>
                                        <label class="form-check-label" for="experiencia_profissional8">
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
                                        <input class="form-check-input" type="checkbox" id="experiencia_profissional10" value="Outro" name="experiencia_profissional[]" <?php if(in_array('Outro', $resume->experiencia_profissional ?? [])): echo 'checked'; endif; ?>>
                                        <label class="form-check-label" for="experiencia_profissional10">
                                            Outro
                                        </label>
                                    </div>
                                    <div class="campo-escondido check-experiencia"<?php echo (in_array('Outro', $resume->experiencia_profissional ?? [])) ? ' style="display:block"' : ''; ?>>
                                        <input type="text" placeholder="Qual?" class="floatlabel form-control" id="experiencia_profissional_outro" name="experiencia_profissional_outro" value="<?php echo e($resume->experiencia_profissional_outro); ?>">
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

                            <div class="d-flex col-6 form-campo">

                                <div class="mb-3 form-checkbox">

                                    <label for="tamanho_uniforme" class="form-label">Tamanho para Confecção dos Uniformes</label>

                                    <div class="form-check form-check">
                                        <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme1" value="FEMININO: Baby Look P"<?php echo e($resume->informacoesPessoais->tamanho_uniforme === 'FEMININO: Baby Look P' ? ' checked' : ' '); ?>>
                                        <?php $__errorArgs = ['tamanho_uniforme'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <label class="form-check-label" for="tamanho_uniforme1">
                                            FEMININO: Baby Look P
                                        </label>
                                    </div>

                                    <div class="form-check form-check">
                                        <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme2" value="FEMININO: Baby Look M" <?php echo e($resume->informacoesPessoais->tamanho_uniforme === 'FEMININO: Baby Look M' ? ' checked' : ' '); ?>>
                                        <?php $__errorArgs = ['tamanho_uniforme'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <label class="form-check-label" for="tamanho_uniforme2">
                                        FEMININO: Baby Look M
                                        </label>
                                    </div>

                                    <div class="form-check form-check">
                                        <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme3" value="FEMININO: Baby Look G" <?php echo e($resume->informacoesPessoais->tamanho_uniforme === 'FEMININO: Baby Look G' ? ' checked' : ' '); ?>>
                                        <?php $__errorArgs = ['tamanho_uniforme'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <label class="form-check-label" for="tamanho_uniforme3">
                                        FEMININO: Baby Look G
                                        </label>
                                    </div>

                                    <div class="form-check form-check">
                                        <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme4" value="FEMININO: Baby Look GG" <?php echo e($resume->informacoesPessoais->tamanho_uniforme === 'FEMININO: Baby Look GG' ? ' checked' : ' '); ?>>
                                        <?php $__errorArgs = ['tamanho_uniforme'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <label class="form-check-label" for="tamanho_uniforme4">
                                        FEMININO: Baby Look GG
                                        </label>
                                    </div>

                                    <div class="form-check form-check">
                                        <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme5" value="MASCULINO:  P"<?php echo e($resume->informacoesPessoais->tamanho_uniforme === 'MASCULINO:  P' ? ' checked' : ' '); ?>>
                                        <?php $__errorArgs = ['tamanho_uniforme'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <label class="form-check-label" for="tamanho_uniforme5">
                                            MASCULINO:  P
                                        </label>
                                    </div>

                                    <div class="form-check form-check">
                                        <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme6" value="MASCULINO:  M" <?php echo e($resume->informacoesPessoais->tamanho_uniforme === 'MASCULINO:  M' ? ' checked' : ' '); ?>>
                                        <?php $__errorArgs = ['tamanho_uniforme'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <label class="form-check-label" for="tamanho_uniforme6">
                                        MASCULINO:  M
                                        </label>
                                    </div>

                                    <div class="form-check form-check">
                                        <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme7" value="MASCULINO:  G" <?php echo e($resume->informacoesPessoais->tamanho_uniforme === 'MASCULINO:  G' ? ' checked' : ' '); ?>>
                                        <?php $__errorArgs = ['tamanho_uniforme'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <label class="form-check-label" for="tamanho_uniforme7">
                                        MASCULINO:  G
                                        </label>
                                    </div>

                                    <div class="form-check form-check">
                                        <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme8" value="MASCULINO:  GG" <?php echo e($resume->informacoesPessoais->tamanho_uniforme === 'MASCULINO:  GG' ? ' checked' : ' '); ?>>
                                        <?php $__errorArgs = ['tamanho_uniforme'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <label class="form-check-label" for="tamanho_uniforme8">
                                        MASCULINO:  GG
                                        </label>
                                    </div>

                                </div>

                            </div>

                            <div class="d-flex col-6 form-campo">

                                <div class="mb-3 form-checkbox">
                                    <label for="informatica" class="form-label">Conhecimento de Informática?</label>
                                    <div class="form-check form-check">
                                        <input class="form-check-input" type="radio" name="informatica" id="informatica1" value="Básico"<?php echo e($resume->escolaridade->informatica === 'Básico' ? ' checked' : ' '); ?>>
                                        <?php $__errorArgs = ['informatica'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <label class="form-check-label" for="informatica1">
                                            Básico
                                        </label>
                                    </div>

                                    <div class="form-check form-check">
                                        <input class="form-check-input" type="radio" name="informatica" id="informatica2" value="Intermediário" <?php echo e($resume->escolaridade->informatica === 'Intermediário' ? ' checked' : ' '); ?>>
                                        <?php $__errorArgs = ['informatica'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <label class="form-check-label" for="informatica2">
                                        Intermediário
                                        </label>
                                    </div>

                                    <div class="form-check form-check">
                                        <input class="form-check-input" type="radio" name="informatica" id="informatica3" value="Avançado" <?php echo e($resume->escolaridade->informatica === 'Avançado' ? ' checked' : ' '); ?>>
                                        <?php $__errorArgs = ['informatica'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <label class="form-check-label" for="informatica3">
                                        Avançado
                                        </label>
                                    </div>

                                    <div class="form-check form-check">
                                        <input class="form-check-input" type="radio" name="informatica" id="informatica4" value="Nenhum" <?php echo e($resume->escolaridade->informatica === 'Nenhum' ? ' checked' : ' '); ?>>
                                        <?php $__errorArgs = ['informatica'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <label class="form-check-label" for="informatica4">
                                        Nenhum
                                        </label>
                                    </div>

                                </div>

                            </div>

                            <div class="d-flex col-6 form-campo">

                                <div class="mb-3 form-checkbox">
                                    <label for="ingles" class="form-label">Conhecimento de Inglês?</label>
                                    <div class="form-check form-check">
                                        <input class="form-check-input" type="radio" name="ingles" id="ingles1" value="Básico"<?php echo e($resume->escolaridade->ingles === 'Básico' ? ' checked' : ' '); ?>>
                                        <?php $__errorArgs = ['ingles'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <label class="form-check-label" for="ingles1">
                                            Básico
                                        </label>
                                    </div>

                                    <div class="form-check form-check">
                                        <input class="form-check-input" type="radio" name="ingles" id="ingles2" value="Intermediário" <?php echo e($resume->escolaridade->ingles === 'Intermediário' ? ' checked' : ' '); ?>>
                                        <?php $__errorArgs = ['ingles'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <label class="form-check-label" for="ingles2">
                                        Intermediário
                                        </label>
                                    </div>

                                    <div class="form-check form-check">
                                        <input class="form-check-input" type="radio" name="ingles" id="ingles3" value="Avançado" <?php echo e($resume->escolaridade->ingles === 'Avançado' ? ' checked' : ' '); ?>>
                                        <?php $__errorArgs = ['ingles'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <label class="form-check-label" for="ingles3">
                                        Avançado
                                        </label>
                                    </div>

                                    <div class="form-check form-check">
                                        <input class="form-check-input" type="radio" name="ingles" id="ingles4" value="Nenhum" <?php echo e($resume->escolaridade->ingles === 'Nenhum' ? ' checked' : ' '); ?>>
                                        <?php $__errorArgs = ['ingles'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <label class="form-check-label" for="ingles4">
                                        Nenhum
                                        </label>
                                    </div>

                                </div>

                            </div>

                            

                        </div>

                        <div class="col-9 d-flex bloco-submit mt-3">
                            <button type="submit" class="btn-padrao btn-cadastrar">Atualizar</button>
                            <a href="<?php echo e(route('resumes.index')); ?>" class="btn-padrao btn-cancelar ms-3">Cancelar</a>
                        </div>

                    </div>

                    <div class="col-3 border-start py-0 ps-5 form-r">

                        <div class="mb-3 d-flex flex-column align-items-center">

                            <p class="fw-bold text-center">Enviar Currículo</p>

                            
                            <div class="preview-container mb-3">
                                <?php
                                    $curriculo = $resume->curriculo_doc;
                                    $curriculoPath = $curriculo ? asset("documents/resumes/curriculos/{$curriculo}") : "https://github.com/mdo.png";
                                ?>
                                <?php if($curriculo): ?>
                                    <a href="<?php echo e($curriculoPath); ?>" target="_blank" > Baixar Currículo atual </a>
                                    <input type="file" id="file-upload" class="file-input"
                                accept=".pdf" name="curriculo_doc" value="<?php echo e($resume->curriculo_doc); ?>">

                                
                                <?php else: ?>
                                    <img id="preview-image" src="<?php echo e(asset('img/image-not-found.png')); ?>" class="preview-image" alt="Prévia do Currículo">
                                <?php endif; ?>

                                <div id="preview-doc" class="preview-doc" style="display: none;">
                                    <p id="file-name"></p>
                                    <a id="file-download" href="#" target="_blank" class="btn btn-sm btn-primary">Baixar</a>
                                </div>
                            </div>

                            <label for="file-upload" class="btn-select-file btn-padrao">Selecionar</label>

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

            </form>

        </div>

    </article>

</section>

<section class="sessao mt-5">

    <article class="f1">

        <div class="container mt-3">

            <form class="form-padrao" id="form-interview" action="<?php echo e(route('interviews.store')); ?>" method="post" enctype="multipart/form-data">

                <div class="row mb-3 mt-3">

                    <div class="col-12">
                        <h4>Entrevista</h4>
                    </div>

                    <div class="col-12 d-flex flex-wrap">

                        <div class="mb-6 bloco-data">
                            <p>
                                <b>Data Entrevista:</b> <?php echo e(\Carbon\Carbon::now('America/Sao_Paulo')->format('d/m/Y')); ?>

                            </p>
                        </div>

                        <div class="mb-6 bloco-data">
                            <p>
                                <b>Hora Entrevista:</b> <?php echo e(\Carbon\Carbon::now('America/Sao_Paulo')->format('H:i:s')); ?>

                            </p>
                        </div>

                    </div>

                </div>

                <?php echo csrf_field(); ?>
                <input type="hidden" name="resume_id" value="<?php echo e($resume->id); ?>">
                <div class="row mb-3 mt-3">

                    <div class="col-6 form-campo">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel" placeholder="Saúde do Candidato" id="saude_candidato" name="saude_candidato" required value="<?php echo e(old('saude_candidato')); ?>">
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

                    <div class="col-6 form-campo">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper required">
                                <label for="vacina_covid" class="label-floatlabel" class="form-label floatlabel-label">Vacina COVID</label>
                                <select name="vacina_covid" id="vacina_covid" class="form-select active-floatlabel" required>
                                    <option></option>
                                    <option value="Não pretende tomar" <?php echo e(old('vacina_covid') === 'Não pretende tomar' ? 'selected' : ''); ?>> Não pretende tomar</option>
                                    <option value="Pretende tomar" <?php echo e(old('vacina_covid') === 'Pretende tomar' ? 'selected' : ''); ?>> Pretende tomar</option>
                                    <option value="1 dose" <?php echo e(old('vacina_covid') === '1 dose' ? 'selected' : ''); ?>> 1 dose</option>
                                    <option value="2 doses" <?php echo e(old('vacina_covid') === '2 doses' ? 'selected' : ''); ?>> 2 doses</option>
                                    <option value="3 doses" <?php echo e(old('vacina_covid') === '3 doses' ? 'selected' : ''); ?>> 3 doses</option>
                                    <option value="4 doses" <?php echo e(old('vacina_covid') === '4 doses' ? 'selected' : ''); ?>> 4 doses</option>
                                    <option value="5 ou mais doses" <?php echo e(old('vacina_covid') === '5 ou mais doses' ? 'selected' : ''); ?>> 5 ou mais doses</option>
                                </select>
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
                    </div>

                    <div class="col-6 form-campo">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper required">
                                <label for="perfil" class="label-floatlabel" class="form-label floatlabel-label">Perfil</label>
                                <select name="perfil" id="perfil" class="form-select active-floatlabel" required>
                                    <option></option>
                                    <option value="Administrativo" <?php echo e(old('perfil') === 'Administrativo' ? 'selected' : ''); ?>> Administrativor</option>
                                    <option value="Operacional" <?php echo e(old('perfil') === 'Operacional' ? 'selected' : ''); ?>> Operacional</option>
                                    <option value="Adm / Operacional" <?php echo e(old('perfil') === 'Adm / Operacional' ? 'selected' : ''); ?>> Adm / Operacional</option>
                                </select>
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
                    </div>

                    <div class="col-6 form-campo">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper required">
                                <label for="perfil_santa_casa" class="label-floatlabel" class="form-label floatlabel-label">Perfil Santa Casa</label>
                                <select name="perfil_santa_casa" id="perfil_santa_casa" class="form-select active-floatlabel" required>
                                    <option></option>
                                    <option value="Sim" <?php echo e(old('perfil_santa_casa') === 'Sim' ? 'selected' : ''); ?>> Sim</option>
                                    <option value="Não" <?php echo e(old('perfil_santa_casa') === 'Não' ? 'selected' : ''); ?>> Não</option>
                                </select>
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
                    </div>

                    <div class="col-6 form-campo">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper required">
                                <label for="perfil_santa_casa" class="label-floatlabel" class="form-label floatlabel-label">Classificação</label>
                                <select name="classificacao" id="classificacao" class="form-select active-floatlabel" required>
                                    <option></option>
                                    <option value="A" <?php echo e(old('classificacao') === 'A' ? 'selected' : ''); ?>> A</option>
                                    <option value="B" <?php echo e(old('classificacao') === 'B' ? 'selected' : ''); ?>> B</option>
                                    <option value="C" <?php echo e(old('classificacao') === 'C' ? 'selected' : ''); ?>> C</option>
                                    <option value="D" <?php echo e(old('classificacao') === 'D' ? 'selected' : ''); ?>> D</option>
                                </select>
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
                    </div>

                    <div class="col-6 form-campo">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel" id="qual_formadora" name="qual_formadora" placeholder="Qual a formadora?(Caso já tenha sido jovem aprendiz.)" required value="<?php echo e(old('qual_formadora')); ?>">
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

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="sugestao_empresa" class="label-floatlabel" class="form-label floatlabel-label">Parecer do Entrevistador</label>
                                <textarea type="text" class="form-control" id="parecer_recrutador" name="parecer_recrutador"><?php echo e(old('parecer_recrutador')); ?></textarea>
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
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="curso_extracurricular" class="label-floatlabel" class="form-label floatlabel-label">Cursos Extracurriculares</label>
                                <textarea class="form-control" id="curso_extracurricular" name="curso_extracurricular" ><?php echo e(old('curso_extracurricular')); ?></textarea>
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
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="apresentacao_pessoal" class="label-floatlabel" class="form-label floatlabel-label">Apresentação Pessoal</label>
                                <textarea class="form-control" id="apresentacao_pessoal" name="apresentacao_pessoal" ><?php echo e(old('apresentacao_pessoal')); ?></textarea>
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
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="experiencia_profissional" class="label-floatlabel" class="form-label floatlabel-label">Experiência Profissional (Tempo de Empresa/Motivo da Saída)</label>
                                <textarea class="form-control" id="experiencia_profissional" name="experiencia_profissional" ><?php echo e(old('experiencia_profissional')); ?></textarea>
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
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="caracteristicas_positivas" class="label-floatlabel" class="form-label floatlabel-label">Características Positivas</label>
                                <textarea class="form-control" id="caracteristicas_positivas" name="caracteristicas_positivas" ><?php echo e(old('caracteristicas_positivas')); ?></textarea>
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
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="habilidades" class="label-floatlabel" class="form-label floatlabel-label">Habilidades</label>
                                <textarea class="form-control" id="habilidades" name="habilidades" ><?php echo e(old('habilidades')); ?></textarea>
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
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="porque_ser_jovem_aprendiz" class="label-floatlabel" class="form-label floatlabel-label">Porque gostaria de ser Jovem Aprendiz?</label>
                                <textarea class="form-control" id="porque_ser_jovem_aprendiz" name="porque_ser_jovem_aprendiz" ><?php echo e(old('porque_ser_jovem_aprendiz')); ?></textarea>
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
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="qual_motivo_demissao" class="label-floatlabel" class="form-label floatlabel-label">Por qual motivo pediria demissão</label>
                                <textarea class="form-control" id="qual_motivo_demissao" name="qual_motivo_demissao" ><?php echo e(old('qual_motivo_demissao')); ?></textarea>
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
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="pretencao_candidato" class="label-floatlabel" class="form-label floatlabel-label">Pretenções do candidato</label>
                                <textarea class="form-control" id="pretencao_candidato" name="pretencao_candidato" ><?php echo e(old('pretencao_candidato')); ?></textarea>
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
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="objetivo_longo_prazo" class="label-floatlabel" class="form-label floatlabel-label">Objetivos longo prazo</label>
                                <textarea class="form-control" id="objetivo_longo_prazo" name="objetivo_longo_prazo" ><?php echo e(old('objetivo_longo_prazo')); ?></textarea>
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
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="pontos_melhoria" class="label-floatlabel" class="form-label floatlabel-label">Pontos de Melhoria</label>
                                <textarea class="form-control" id="pontos_melhoria" name="pontos_melhoria" ><?php echo e(old('pontos_melhoria')); ?></textarea>
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
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="familia" class="label-floatlabel" class="form-label floatlabel-label">Família</label>
                                <textarea class="form-control" id="familia" name="familia" ><?php echo e(old('familia')); ?></textarea>
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
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="disponibilidade_horario" class="label-floatlabel" class="form-label floatlabel-label">Disponibilidade de Horário</label>
                                <textarea class="form-control" id="disponibilidade_horario" name="disponibilidade_horario" ><?php echo e(old('disponibilidade_horario')); ?></textarea>
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
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="sobre_candidato" class="label-floatlabel" class="form-label floatlabel-label">Fale um pouco sobre você</label>
                                <textarea class="form-control" id="sobre_candidato" name="sobre_candidato" ><?php echo e(old('sobre_candidato')); ?></textarea>
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
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="rotina_candidato" class="label-floatlabel" class="form-label floatlabel-label">Qual a sua rotina?</label>
                                <textarea class="form-control" id="rotina_candidato" name="rotina_candidato" ><?php echo e(old('rotina_candidato')); ?></textarea>
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
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="outros_idiomas" class="label-floatlabel" class="form-label floatlabel-label">Outros idiomas?</label>
                                <textarea class="form-control" id="outros_idiomas" name="outros_idiomas" ><?php echo e(old('outros_idiomas')); ?></textarea>
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
                    </div>

                    <div class="col-6 form-campo">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper required">
                                <label for="familia_cras" class="label-floatlabel" class="form-label floatlabel-label">Sua família é atendida no CRAS?</label>
                                <select name="familia_cras" id="familia_cras" class="form-select active-floatlabel" required>
                                    <option></option>
                                    <option value="Sim" <?php echo e(old('familia_cras') === 'Sim' ? 'selected' : ''); ?>> Sim</option>
                                    <option value="Não" <?php echo e(old('familia_cras') === 'Não' ? 'selected' : ''); ?>> Não</option>
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
                    </div>

                    <div class="col-6 form-campo">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel" id="fonte_curriculo" name="fonte_curriculo" placeholder="Fonte de Captação do Currículo" required value="<?php echo e(old('fonte_curriculo')); ?>">
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

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="sugestao_empresa" class="label-floatlabel" class="form-label floatlabel-label">Sugestão Empresa</label>
                                <textarea class="form-control" id="sugestao_empresa" name="sugestao_empresa" ><?php echo e(old('sugestao_empresa')); ?></textarea>
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
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="floatlabel-wrapper form-textarea">
                                <label for="observacoes" class="label-floatlabel" class="form-label floatlabel-label">Observações</label>
                                <textarea class="form-control" id="observacoes" name="observacoes" ><?php echo e(old('observacoes')); ?></textarea>
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
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <input type="text" class="form-control floatlabel" id="pontuacao" name="pontuacao" placeholder="Pontuação" required value="<?php echo e(old('pontuacao')); ?>">
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

                    <div class="col-4 mt-3 bloco-submit">
                        <button type="submit" class="btn btn-primary btn-padrao btn-cadastrar">Salvar Entrevista</button>
                    </div>

                    <div class="col-8"></div>

                </div>

            </form>

            

        </div>

    </article>

</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts-custom'); ?>
<script src="<?php echo e(asset('js/jquery.validate.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery.mask.js')); ?>"></script>
<script>
    var SPMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00000';
},
spOptions = {
    onKeyPress: function(val, e, field, options) {
        field.mask(SPMaskBehavior.apply({}, arguments), options);
    }
};

document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('file-upload').addEventListener('change', function (event) {
        if (event.target.files.length === 0) {
            return; // Sai da função se nenhum arquivo for selecionado
        }

        const file = event.target.files[0]; // Obtém o arquivo selecionado

        // Verifica se o arquivo é um PDF
        if (file.type !== "application/pdf") {
            alert("Por favor, selecione um arquivo PDF.");
            event.target.value = ""; // Limpa o campo
            return;
        }

        // Atualiza a prévia do documento
        document.getElementById("file-name").textContent = file.name;
        document.getElementById("file-download").href = URL.createObjectURL(file);
        document.getElementById("preview-doc").style.display = "block";
    });
});

$('#estado_civil').select2({
    placeholder: "Selecione",
});
$('#possui_filhos').select2({
    placeholder: "Selecione",
});
$('#sexo').select2({
    placeholder: "Selecione",
});
$('#cnh').select2({
    placeholder: "Selecione",
});
$('#vacina_covid').select2({
    placeholder: "Selecione",
});
$('#familia_cras').select2({
    placeholder: "Selecione",
});
$('#perfil').select2({
    placeholder: "Selecione",
});
$('#perfil_santa_casa').select2({
    placeholder: "Selecione",
});
$('#classificacao').select2({
    placeholder: "Selecione",
});

$('#rg').mask('00.000.000-0');
$('#cpf').mask('000.000.000-00');
$('#cep').mask('00000-000');
$('#telefone_celular').mask('(00) 00000-0000');
$('#telefone_residencial').mask(SPMaskBehavior, spOptions);

$('#cep').on('input', function(){

    var cep     = $(this).val(),
        digitos = cep.length;

    if(digitos === 9){

        $('.fa-spinner').show();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },
            url : "<?php echo e(url('getCep')); ?>",
            data : {'cep': cep},
            type : 'POST',
            dataType : 'json',
            success : function(result){

                $('.fa-spinner').hide();

                if(result.msg === '1'){

                    $('#cidade').val(result.cidade);
                    $('#bairro').val(result.bairro);
                    $('#uf').val(result.uf);
                    $('#logradouro').val(result.rua);

                    setTimeout(function(){
                        $('.floatlabel').trigger('change');
                    }, 150)

                } else if(result.msg === '3'){

                    $.message('CEP enválido, por favor verifique o número informado', 2);

                } else {

                    $.message('CEP não encontrado, por favor verifique o número informado', 2);

                }

            }
        });

    }

});

$('#escolaridade3').on('click', function(){

    if($(this).is(':checked')){
        $('.check-escolaridade').slideDown(150);
        $('#escolaridade_outro').prop('disabled', false);
    } else {
        $('.check-escolaridade').slideUp(150);
        $('#escolaridade_outro').prop('disabled', true);
    }

});

$('#experiencia_profissional10').on('click', function(){

    if($(this).is(':checked')){
        $('.check-experiencia').slideDown(150);
        $('#experiencia_profissional_outro').prop('disabled', false);
    } else {
        $('.check-experiencia').slideUp(150);
        $('#experiencia_profissional_outro').prop('disabled', true);
    }

});

$("#form-companies-create").validate({
    ignore: [],
    rules:{
        escolaridade:"required",
        nome:"required",
        email:"required",
        rg:"required",
        cpf:"required",
        telefone_celular:"required",
        data_nascimento:"required",
        estado_civil:"required",
        possui_filhos:"required",
        sexo:"required",
        cnh:"required",
        cep:"required",
        logradouro:"required",
        numero:"required",
        complemento:"required",
        bairro:"required",
        cidade:"required",
        uf:"required",
        informatica:"required",
        ingles:"required",
        tamanho_uniforme:"required",
    }
});

$("#form-interview").validate({
    ignore: [],
    rules:{
        saude_candidato:"required",
        vacina_covid:"required",
        perfil:"required",
        perfil_santa_casa:"required",
        classificacao:"required",
        qual_formadora:"required",
        familia_cras:"required",
        fonte_curriculo:"required",
        pontuacao:"required",
    }
});

var validator1 = $( "#form-companies-create" ).validate();
validator1.form();

$(document).find('.select2').each(function(){
    var input = $(this),
        val   = input[0].innerText;

    if(val && val !== 'Selecione'){
        input.find('.select2-selection').addClass('valid');
    }

})
</script>
<?php $__env->stopPush(); ?>

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
    cursor: pointer;
    height: 38px;
    padding: 12px 20px !important;
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/flav6095/painelasppe.com.br/resources/views/interviews/interviewResume.blade.php ENDPATH**/ ?>