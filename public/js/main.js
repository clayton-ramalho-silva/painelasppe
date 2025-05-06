// Scripts do App
$.message = function(msg, type){

    var num    = Math.floor((Math.random() * 100000000) + 10000000),
        classe = (type == 1) ? 'msg-success' : 'msg-error',
        icon   = (type == 1) ? 'success' : 'error',
        base   = ($('.sistem-message').length > 0) ? 500 : 0;

    if(($('.sistem-message').length > 0)){

        $('.sistem-message').css('right','-100%');
        setTimeout(function(){
            $('.sistem-message').remove();
        },470);

    }

    setTimeout(function(){
        $('body').append('<div class="msg'+num+' sistem-message '+classe+'"><i class="icon-'+icon+'"></i><span>'+msg+'</span></div>');
    },0 + base);
    setTimeout(function(){
        $('.msg'+num+'').css('right','0');
    },150 + base);

    // Caso seja mensagem de erro, n�o esconde automaticamente
    //if(type == 1){

        setTimeout(function(){
            $('.msg'+num+'').css('right','-100%');
        },6000 + base);
        setTimeout(function(){
            $('.msg'+num+'').remove();
        },7000 + base);

    //}

}

let types = {
    'status[]': 'checkbox',
    'cidade': 'text',
    'uf': 'select',
    'filtro_data': 'select',
};

// Script de filtros
function get_form_filters($itens){

    let filtros   = '',
        nome      = '',
        data_name = '';

    $.each($itens, function(num, item){

        if(item.value && item.value !== 'Todos' && item.value !== 'Todas'){

            data_name = item.name;

            if(item.value === 'ativo'){
                nome = 'Ativos'
            } else if(item.value === 'inativo'){
                nome = 'Inativos'
            } else if(item.name === 'filtro_data'){
                nome = 'Últimos '+item.value+' dias';
            } else if(item.value === 'admin'){
                nome = 'Administrador';
            } else if(item.value === 'recruiter'){
                nome = 'Recrutador';
            } else if(item.name === 'ingles'){
                nome = 'Inglês: '+item.value;
            } else if(item.name === 'informatica'){
                nome = 'Informatica: '+item.value;
            } else if(item.name === 'recruiters'){
                nome = 'Recrutador: '+item.value;
            } else if(item.name === 'min_salario'){
                nome = 'Salário Min.: '+item.value;
                data_name = 'input-salario';
            } else if(item.name === 'max_salario'){
                nome = 'Salário Max.: '+item.value;
                data_name = 'input-salario';
            } else if(item.name === 'entrevistado'){
                nome = (item.value === '1') ? 'Já entrevistado' : 'Não entrevistado';
            } else if(item.name === 'cnh'){
                nome = 'CNH: '+item.value;
            } else if(item.name === 'min_age'){
                nome = 'Idade Min.: '+item.value;
            } else if(item.name === 'reservista'){
                nome = 'Reservista: '+item.value;
            } else if(item.name === 'foi_jovem_aprendiz'){
                nome = 'Reservista: '+item.value;
            } else if(item.name === 'escolaridade'){
                nome = 'Formação: '+item.value;
            } else if(item.name === 'vagas_interesse[]'){
                nome = 'Vaga: '+item.value;
            } else if(item.name === 'experiencia_profissional[]'){
                nome = 'Experiência: '+item.value;
                data_name = 'input-experiencia';
            } else {
                nome = item.value;
            }

            filtros += '<a class="bt-filtro" data-name="'+data_name+'" data-value="'+item.value+'" title="Remover filtro"><i>X</i>'+nome+'</a>';

        }

        // console.dir(num+' - '+item.name+' - '+item.value);

    });

    if(filtros === ''){
        $('.bloco-filtros-ativos').slideUp(150)
        $('.bloco-filtros-ativos span').html('');
    } else {
        $('.bloco-filtros-ativos').slideDown(150);
        $('.bloco-filtros-ativos span').html(filtros);
    }

}

$(document).on('click', '.bt-filtro', function(){

    var bt    = $(this),
        name  = bt.attr('data-name'),
        value = bt.attr('data-value'),
        num   = $('.bloco-filtros-ativos').find('a').length;

    if(num === 1){
        $('.bloco-filtros-ativos').slideUp(150)
        $('.bloco-filtros-ativos span').html('');
    }

    console.dir(num);
    console.dir(name);
    console.dir(types[name]);

    bt.hide();

    if(name === 'input-salario'){

        $('input[data-name="input-salario"]').hide();
        $('[name=min_salario]').val('').trigger('change');
        $('[name=max_salario]').val('').trigger('change');

    } else if(name === 'input-vagas'){

        var wanted_option = $('select[name="vagas_interesse[]"] option[value="'+ value +'"]');
        wanted_option.prop('selected', false);
        $('select[name="vagas_interesse[]"]').trigger('change.select2');

    } else if(name === 'input-experiencia'){

        var wanted_option = $('select[name="experiencia_profissional[]"] option[value="'+ value +'"]');
        wanted_option.prop('selected', false);
        $('select[name="experiencia_profissional[]"]').trigger('change.select2');

    } else {

        if(types[name] === 'checkbox'){
            $('input[type=checkbox][value='+value+']').prop("checked",false);
        } else {
            $('[name='+name+']').val('').trigger('change');
        }

    }

    $('.bloco-filtros').submit();

    setTimeout(function(){
        bt.remove();
    },300)

});

$(document).on('click', '.icon-error', function(){

    setTimeout(function(){
        $('.sistem-message').css('right','-100%');
    },200);
    setTimeout(function(){
        $('.sistem-message').remove();
    },500);

})

$(".btMenu").click(function(){

    if($("body").hasClass("fechado")){
        $("body").removeClass("fechado");
    } else{
        $("body").addClass("fechado");
    }

});

$(".btMenuRes").click(function(){

    if($("header").hasClass("aberto")){
        $("header").removeClass("aberto");
    } else{
        $("header").addClass("aberto");
    }

});

$('#filter-form-users').on('submit', function(e) {

    console.dir('aaa');

    e.preventDefault();
    let formData = (envio === 'filtrar') ? $(this).serialize() : '';

    get_form_filters($(this).serializeArray());

    $.ajax({
        url: "{{ route('users.index') }}",
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

/*
 $(document).ready(function(){
    $('#showMessageBtn').click(function(){
        $('#message').fadeIn();
    });
});
*/