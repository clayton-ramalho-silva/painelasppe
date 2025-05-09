<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Asppe - Cadastro de Currículo</title>

<!-- CSS Scripts -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


    <!-- Customized Bootstrap Stylesheet -->
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('css/estilos.css') }}" type="text/css" rel="stylesheet"> <meta charset="utf-8">

  <style>
body{
    background-color: #f6f6f6;
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
    
    /* Estilo para documentos */
    .preview-doc {
        text-align: center;
        font-size: 14px;
        color: #333;
        margin-top: 10px;
    }
    
    .btn-select-file{
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

    main{
        float: unset;
        margin: 0 auto;
    }

    .header{
        max-width: 1200px;
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin-bottom: 50px;
    }

    .container-logo{
        display: flex;
        justify-content: center;
        width: 100%;
    }
    
    .container-logo .logo{
        font-size: 0;
    }

    .header p{
        width: 100%;
        text-align: center;        
    }
</style>

</head>
<body>
    
    <div class="header">
        <div class="container-logo">
            <a href="https://asppe.org/" class="logo">ASPPE - Sistema</a>

        </div>
        <p class="mb-2 mt-3">Cadastre seu currículo.</p> 
        <p>Entraremos em contato assim que encontrarmos a vaga ideal para você.</p>
    </div>
    <main>
        <section class="sessao">
    
            <article class="f1 container-form-create">
        
                <div class="container">
        
                    <h4 class="fw-normal mb-4">Currículo cadastrado com Sucesso!</h4>
                    
                    <p>Retorne ao site da <a href="https://asppe.org/">Asppe!</a></p>
                    
                </div>
        
            </article>
        
        </section>

    </main>



    <!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


<!-- Template Javascript -->
<script src="{{ asset('js/main.js') }}"></script>

<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/jquery.mask.js') }}"></script>
<script src="{{ asset('js/floatlabels.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
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
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url : "{{ url('getCep') }}",
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

</body>
</html>