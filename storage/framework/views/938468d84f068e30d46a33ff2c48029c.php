<?php $__env->startSection('content'); ?>
<section class="cabecario">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('resumes.index')); ?>">Currículos</a></li>
          <li class="breadcrumb-item active" aria-current="page">Cadastrar</li>
        </ol>
      </nav>

      
      <?php
          // Guarda a rota na variável
          $rota = route('resumes.index');
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

    <article class="f1 container-form-create">

        <div class="container">

            <h4 class="fw-normal mb-4">Cadastro de Currículo</h4>

            <form class="form-padrao" id="form-companies-create" action="<?php echo e(route('resumes.store')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">

                    <div class="col-9 py-0 pe-5 form-l">

                        <div class="row">

                            <div class="col-6 form-campo">
                                <div class="mb-3">
                                    <input type="text" placeholder="Nome Completo" class="floatlabel form-control" id="nome" name="nome" required>
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
                                    <input type="email" placeholder="E-mail" class="floatlabel form-control" id="email" name="email" required>
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
                                        <input type="date" class="form-control active-floatlabel" id="data_nascimento" name="data_nascimento" required>
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
                                    <input type="text" placeholder="RG" class="floatlabel form-control" id="rg" name="rg" required placeholder="RG">
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
                                    <input type="text" placeholder="CPF" class="floatlabel form-control" id="cpf" name="cpf" required placeholder="CPF">
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
                                            <option value="Solteiro"> Solteiro</option>
                                            <option value="Casado"> Casado</option>
                                            <option value="Divorciado"> Divorciado</option>
                                            <option value="Viúvo"> Viúvo</option>
                                            <option value="Separado"> Separado</option>
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
                                            <option value="Sim"> Sim</option>
                                            <option value="Não"> Não</option>
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
                                            <option value="Homem"> Homem</option>
                                            <option value="Mulher"> Mulher</option>
                                            <option value="Prefiro não dizer"> Prefiro não dizer</option>
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
                                        <label for="cnh" class="label-floatlabel" class="form-label floatlabel-label">Possui CNH?</label>
                                        <select name="cnh" id="cnh" class="form-select active-floatlabel" required>
                                            <option></option>
                                            <option value="Sim"> Sim</option>
                                            <option value="Não"> Não</option>
                                            <option value="Em andamento"> Em andamento</option>
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
                                    <input type="text" placeholder="Instagram (opcional)" class="floatlabel form-control" id="instagram" name="instagram">
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
                                    <input type="text" placeholder="LinkedIn (opcional)" class="floatlabel form-control" id="linkedin" name="linkedin">
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
                                    <input type="text" placeholder="Telefone Celular" class="floatlabel form-control" id="telefone_celular" name="telefone_celular" required>
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
                                    <input type="text" placeholder="Telefone de Contato" class="floatlabel form-control" id="telefone_residencial" name="telefone_residencial">
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
                                    <input type="text" placeholder="Nome para contato" class="floatlabel form-control" id="nome_contato" name="nome_contato">
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
                                    <input type="text" placeholder="CEP" class="floatlabel form-control" id="cep" name="cep" required>
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
                                    <input type="text" placeholder="Rua" class="floatlabel form-control" id="logradouro" name="logradouro" required>
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
                                    <input type="text" placeholder="Número" class="floatlabel form-control" id="numero" name="numero" required>
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
                                    <input type="text" placeholder="Complemento" class="floatlabel form-control" id="complemento" name="complemento" required>
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
                                    <input type="text" placeholder="Bairro" class="floatlabel form-control" id="bairro" name="bairro" required>
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
                                    <input type="text" placeholder="Cidade" class="floatlabel form-control" id="cidade" name="cidade" required>
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

                            <div class="mb-3 form-campo col-6">
                                <div class="floatlabel-wrapper required">
                                    <label for="uf" class="label-floatlabel" class="form-label floatlabel-label">UF</label>
                                    <select name="uf" id="uf" class="form-select active-floatlabel" required>
                                        <option></option>
                                        <?php
                                        echo get_estados(old('uf'));
                                        ?>
                                    </select>
                                    <?php $__errorArgs = ['genero'];
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
                                        <input class="form-check-input" type="radio" name="reservista" id="reservista1" value="Sim">
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
                                        <input class="form-check-input" type="radio" name="reservista" id="reservista2" value="Não">
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
                                        <input class="form-check-input" type="radio" name="reservista" id="reservista3" value="Em andamento">
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
                                        <input class="form-check-input" type="radio" name="foi_jovem_aprendiz" id="foi_jovem_aprendiz1" value="Sim, da ASPPE">
                                        <label class="form-check-label" for="foi_jovem_aprendiz1">
                                            Sim, da ASPPE
                                        </label>
                                    </div>
                                    <div class="form-check form-check">
                                        <input class="form-check-input" type="radio" name="foi_jovem_aprendiz" id="foi_jovem_aprendiz2" value="Sim, de Outra Qualificadora">
                                        <label class="form-check-label" for="foi_jovem_aprendiz2">
                                            Sim, de Outra Qualificadora
                                        </label>
                                    </div>
                                    <div class="form-check form-check">
                                        <input class="form-check-input" type="radio" name="foi_jovem_aprendiz" id="foi_jovem_aprendiz3" value="Não">
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
                                            <input class="form-check-input" type="checkbox" name="escolaridade[]" id="escolaridade1" value="Ensino Médio Incompleto">
                                            <label class="form-check-label" for="escolaridade1">
                                                Ensino Médio Incompleto
                                            </label>
                                        </div>
                                        <div class="form-check form-check">
                                            <input class="form-check-input" type="checkbox" name="escolaridade[]" id="escolaridade2" value="Ensino Médio Completo">
                                            <label class="form-check-label" for="escolaridade2">
                                                Ensino Médio Completo
                                            </label>
                                        </div>
                                        <div class="form-check form-check">
                                            <input class="form-check-input" type="checkbox" name="escolaridade[]" id="escolaridade3" value="Outro">
                                            <label class="form-check-label" for="escolaridade3">
                                            Outro
                                            </label>
                                        </div>
                                        <div class="campo-escondido check-escolaridade">
                                            <input type="text" placeholder="Qual curso?" class="floatlabel form-control" id="escolaridade_outro" name="escolaridade_outro">
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
                                        <input class="form-check-input" type="checkbox" id="vagas_interesse1" value="Copa & Cozinha" name="vagas_interesse[]">
                                        <label class="form-check-label" for="vagas_interesse1">
                                            Copa & Cozinha
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="vagas_interesse2" value="Administrativo" name="vagas_interesse[]">
                                        <label class="form-check-label" for="vagas_interesse2">
                                            Administrativo
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="vagas_interesse3" value="Camareiro(a) de Hotel" name="vagas_interesse[]">
                                        <label class="form-check-label" for="vagas_interesse3">
                                            Camareiro(a) de Hotel
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="vagas_interesse4" value="Recepcionista" name="vagas_interesse[]">
                                        <label class="form-check-label" for="vagas_interesse4">
                                            Recepcionista
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="vagas_interesse5" value="Atendente de Lojas e Mercados (Comércio & Varejo)" name="vagas_interesse[]">
                                        <label class="form-check-label" for="vagas_interesse5">
                                            Atendente de Lojas e Mercados (Comércio & Varejo)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="vagas_interesse6" value="Construção e Reparos" name="vagas_interesse[]">
                                        <label class="form-check-label" for="vagas_interesse6">
                                            Construção e Reparos
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="vagas_interesse7" value="Conservação e Limpeza" name="vagas_interesse[]">
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
                                        <input class="form-check-input" type="checkbox" id="experiencia_profissional1" value="Nenhuma por enquanto" name="experiencia_profissional[]">
                                        <label class="form-check-label" for="experiencia_profissional1">
                                            Nenhuma por enquanto
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="experiencia_profissional2" value="Copa & Cozinha" name="experiencia_profissional[]">
                                        <label class="form-check-label" for="experiencia_profissional2">
                                            Copa & Cozinha
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="experiencia_profissional3" value="Administrativo" name="experiencia_profissional[]">
                                        <label class="form-check-label" for="experiencia_profissional3">
                                            Administrativo
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="experiencia_profissional4" value="Camareiro(a) de Hotel" name="experiencia_profissional[]">
                                        <label class="form-check-label" for="experiencia_profissional4">
                                            Camareiro(a) de Hotel
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="experiencia_profissional5" value="Recepcionista" name="experiencia_profissional[]">
                                        <label class="form-check-label" for="experiencia_profissional5">
                                            Recepcionista
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="experiencia_profissional6" value="Atendente de Lojas e Mercados (Comércio & Varejo)" name="experiencia_profissional[]">
                                        <label class="form-check-label" for="experiencia_profissional6">
                                            Atendente de Lojas e Mercados (Comércio & Varejo)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="experiencia_profissional7" value="TI (Tecnologia da Informação)" name="experiencia_profissional[]">
                                        <label class="form-check-label" for="experiencia_profissional7">
                                            TI (Tecnologia da Informação)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="experiencia_profissional8" value="Construção e Reparos" name="experiencia_profissional[]">
                                        <label class="form-check-label" for="experiencia_profissional8">
                                            Construção e Reparos
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="experiencia_profissional9" value="Conservação e Limpeza" name="experiencia_profissional[]">
                                        <label class="form-check-label" for="experiencia_profissional9">
                                            Conservação e Limpeza
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="experiencia_profissional10" value="Outro" name="experiencia_profissional[]">
                                        <label class="form-check-label" for="experiencia_profissional10">
                                            Outro
                                        </label>
                                    </div>
                                    <div class="campo-escondido check-experiencia">
                                        <input type="text" placeholder="Qual?" class="floatlabel form-control" id="experiencia_profissional_outro" name="experiencia_profissional_outro">
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
                                        <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme1" value="FEMININO: Baby Look P">
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
                                        <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme2" value="FEMININO: Baby Look M">
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
                                        <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme3" value="FEMININO: Baby Look G">
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
                                        <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme4" value="FEMININO: Baby Look GG">
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
                                        <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme5" value="MASCULINO:  P">
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
                                        <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme6" value="MASCULINO:  M">
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
                                        <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme7" value="MASCULINO:  G">
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
                                        <input class="form-check-input" type="radio" name="tamanho_uniforme" id="tamanho_uniforme8" value="MASCULINO:  GG">
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
                                        <input class="form-check-input" type="radio" name="informatica" id="informatica1" value="Básico">
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
                                        <input class="form-check-input" type="radio" name="informatica" id="informatica2" value="Intermediário">
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
                                        <input class="form-check-input" type="radio" name="informatica" id="informatica3" value="Avançado">
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
                                        <input class="form-check-input" type="radio" name="informatica" id="informatica3" value="Nenhum">
                                        <?php $__errorArgs = ['informatica'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        <label class="form-check-label" for="informatica3">
                                        Nenhum
                                        </label>
                                    </div>

                                </div>

                            </div>

                            <div class="d-flex col-6 form-campo">

                                <div class="mb-3 form-checkbox">
                                    <label for="ingles" class="form-label">Conhecimento de Inglês?</label>
                                    <div class="form-check form-check">
                                        <input class="form-check-input" type="radio" name="ingles" id="ingles1" value="Básico>
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
                                        <input class="form-check-input" type="radio" name="ingles" id="ingles2" value="Intermediário">
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
                                        <input class="form-check-input" type="radio" name="ingles" id="ingles3" value="Avançado">
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
                                        <input class="form-check-input" type="radio" name="ingles" id="ingles4" value="Nenhum">
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

                        <div class="col-9 bloco-submit d-flex mt-3">
                            <button type="submit" class="btn-padrao btn-cadastrar">Cadastrar</button>
                            <a href="<?php echo e(route('resumes.index')); ?>" class="btn-padrao btn-cancelar ms-3">Cancelar</a>
                        </div>

                    </div>

                    <div class="col-3 border-start py-0 ps-5 form-r">

                        <div class="mb-3 d-flex flex-column align-items-center">
                            <p class="fw-bold text-center">Enviar Currículo</p>

                            
                            <input type="file" id="file-upload" class="file-input"
                                accept=".pdf" name="curriculo_doc">

                            <div class="preview-container mb-3">

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

$('#uf').select2({
    placeholder: "Selecione",
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
$('#informatica').select2({
    placeholder: "Selecione",
});
$('#ingles').select2({
    placeholder: "Selecione",
});
$('#tamanho_uniforme').select2({
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
                    $('#uf').val(result.uf).select2();
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

    console.dir('aaa');

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
</script>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('css-custom'); ?>
<style>

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

/* Estilo para documentos */
.preview-doc {
    text-align: center;
    font-size: 14px;
    color: #333;
    margin-top: 10px;
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

/*Botãos submit e cancelar*/
.btn-cadastrar{
    background-color: #0056b3;
    padding: 10px 50px;
}

.btn-cadastrar:hover{
    background-color: #046dde;
}


        /*Cabeçario*/
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

article.container-form-create{
    box-shadow: none;
    padding: 0;
}

    </style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/flav6095/painelasppe.com.br/resources/views/resumes/create.blade.php ENDPATH**/ ?>