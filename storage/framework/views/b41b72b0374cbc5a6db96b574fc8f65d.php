<?php $__env->startSection('content'); ?>

<section class="cabecario">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('companies.index')); ?>">Empresas</a></li>
          <li class="breadcrumb-item active" aria-current="page">Editar: <?php echo e($company->nome_fantasia); ?></li>
        </ol>
      </nav>

      
      <?php
          // Guarda a rota na variável
          $rota = route('companies.index');
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

            <h4 class="fw-normal mb-4">Cadastro da Empresa</h4>

            <form class="form-padrao" id="form-companies-create" action="<?php echo e(route('companies.update', $company)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="row">

                    <div class="col-9 py-0 pe-5 form-l">

                        <div class="row">

                            <div class="col-6 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="cnpj" name="cnpj" value="<?php echo e($company->cnpj); ?>" required  placeholder="CNPJ">
                                <?php $__errorArgs = ['cnpj'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="col-6 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="razao_social" name="razao_social" value="<?php echo e($company->razao_social); ?>" required placeholder="Razão Social">
                                <?php $__errorArgs = ['razao_social'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="col-6 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="nome_fantasia" name="nome_fantasia" value="<?php echo e($company->nome_fantasia); ?>" required placeholder="Nome Fantasia">
                                <?php $__errorArgs = ['nome_fantasia'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="col-6 mb-3 form-campo position-relative">
                                <i class="fas fa-spinner"></i>
                                <input type="text" class="form-control floatlabel" id="cep" name="cep" value="<?php echo e($company->location->cep); ?>" required placeholder="CEP">
                                <?php $__errorArgs = ['cep'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="col-12 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="logradouro" name="logradouro" value="<?php echo e($company->location->logradouro); ?>" required placeholder="Endereço">
                                <?php $__errorArgs = ['logradouro'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="col-3 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="numero" name="numero" value="<?php echo e($company->location->numero); ?>" required placeholder="Número">
                                <?php $__errorArgs = ['numero'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="col-3 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="complenento" name="complenento" value="<?php echo e($company->location->complenento); ?>" placeholder="Complemento">
                                <?php $__errorArgs = ['complenento'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="col-6 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="bairro" name="bairro" value="<?php echo e($company->location->bairro); ?>" required placeholder="Bairro">
                                <?php $__errorArgs = ['bairro'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="col-6 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="pais" name="pais" value="<?php echo e($company->location->pais); ?>" required placeholder="País">
                                <?php $__errorArgs = ['pais'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="col-4 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="cidade" name="cidade" value="<?php echo e($company->location->cidade); ?>" required placeholder="Cidade">
                                <?php $__errorArgs = ['cidade'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="mb-3 form-campo col-2">
                                <div class="floatlabel-wrapper required">
                                    <label for="uf" class="label-floatlabel" class="form-label floatlabel-label">UF</label>
                                    <select name="uf" id="uf" class="form-select active-floatlabel" required>
                                        <option></option>
                                        <?php
                                        echo get_estados($company->location->uf);
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

                            

                            <div class="col-6 mb-3 form-campo">
                                <input type="text" class="form-control floatlabel" id="nome_contato" name="nome_contato" value="<?php echo e($company->contacts->nome_contato); ?>" required placeholder="Nome do contato na empresa">
                                <?php $__errorArgs = ['nome_contato'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="col-6 mb-3 form-campo">
                                <input type="email" class="form-control floatlabel" id="email" name="email" value="<?php echo e($company->contacts->email); ?>" required placeholder="E-mail">
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="col-6 mb-3 form-campo">
                                <input type="tel" class="form-control floatlabel" id="telefone" name="telefone" value="<?php echo e($company->contacts->telefone); ?>" required placeholder="Telefone">
                                <?php $__errorArgs = ['telefone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="col-6 mb-3 form-campo">
                                <input type="tel" class="form-control floatlabel" id="whatsapp" name="whatsapp" value="<?php echo e($company->contacts->whatsapp); ?>" required placeholder="(Whatsapp)">
                                <?php $__errorArgs = ['whatsapp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="alert alert-danger"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                        </div>

                        <div class="col-9 bloco-ativo d-flex mb-3">
                            <h5>Status</h5>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status" id="status" <?php echo e($company->status == 'ativo' ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="status"><?php echo e($company->status == 'ativo' ? 'Ativo' : 'Inativo'); ?></label>
                            </div>
                        </div>

                        <div class="col-9 bloco-submit d-flex mt-3">
                            <button type="submit" class="btn-padrao btn-cadastrar">Atualizar</button>
                            <a href="<?php echo e(route('companies.index')); ?>" class="btn-padrao btn-cancelar ms-3">Cancelar</a>
                        </div>

                    </div>

                    <div class="col-3 border-start py-0 ps-5 form-r">

                        <div class="mb-3 d-flex flex-column align-items-center">
                            <p class="fw-bold text-center">Logotipo da empresa</p>
                            <?php
                                $logotipo = $company->logotipo;
                                $logotipoPath = $logotipo ? asset("documents/companies/images/{$logotipo}") : "https://github.com/mdo.png";
                            ?>


                            <input type="file" id="file-upload" class="file-input" accept="image/*" name="logotipo">
                            <div class="preview-container mb-3">
                                <img id="preview-image" src="<?php echo e($logotipoPath); ?>" class="preview-image" alt="Prévia do logotipo">
                            </div>
                            <label for="file-upload" class="btn-padrao btn-select-file">Selecionar</label>


                            

                            <?php $__errorArgs = ['logotipo'];
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
$('#telefone').mask(SPMaskBehavior, spOptions);
$('#whatsapp').mask('(00) 00000-0000', {clearIfNotMatch: true});
$('#cnpj').mask('00.000.000/0000-00', {clearIfNotMatch: true});
$('#cep').mask('00000-000', {clearIfNotMatch: true});
$('#numero').mask('0000000000');

$('#uf').select2({
    placeholder: "Selecione",
});

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

                    $.message('CEP env�lido, por favor verifique o n�mero informado', 2);

                } else {

                    $.message('CEP n�o encontrado, por favor verifique o n�mero informado', 2);

                }

            }
        });

    }

});

// Regras de validação
$("#form-companies-create").validate({
    rules:{
        cnpj:"required",
        razao_social:"required",
        nome_fantasia:"required",
        cep:"required",
        logradouro:"required",
        numero:"required",
        bairro:"required",
        pais:"required",
        cidade:"required",
        uf:"required",
        nome_contato:"required",
        telefone:"required",
        whatsapp:"required",
        email:{required: true, email:true},
    }
});

// Validação inicial
var validator = $( "#form-companies-create" ).validate();
validator.form();


document.getElementById('file-upload').addEventListener('change', function(event) {
    if (event.target.files.length === 0) {
        return; // Sai da função se nenhum arquivo for selecionado
    }

    const file = event.target.files[0]; // Obtém o arquivo selecionado

    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('preview-image').src = e.target.result; // Atualiza a imagem
    };
    reader.readAsDataURL(file);

});
</script>
<?php $__env->stopPush(); ?>



<?php $__env->startPush('css-custom'); ?>
<style>
article.container-form-create{
    box-shadow: none;
    padding: 0;
}
.fa-spinner{
    right: 26px !important;
}
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/flav6095/painelasppe.com.br/resources/views/companies/edit.blade.php ENDPATH**/ ?>