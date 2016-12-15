$(document).ready(function() {

    if ($('input[id=IsCnpj1]:checked').val() == 1 || $('#cnpj_cpf').text().length == 14) {
        radioCnpjChecked();
    } else if ($('input[id=IsCnpj0]:checked').val() == 0) {
        radioCpfChecked();
    } else {
        radioNAChecked();
    }

    $('#IsCnpj1').change(function() {
        radioRemoveError();
        radioCnpjChecked();
        $(".cnpj_cpf").val('');
        $('#CustomerCnpjCpf').prop('disabled', false);
    });

    $('#IsCnpj0').change(function() {
        radioRemoveError();
        radioCpfChecked();
        $(".cnpj_cpf").val('');
        $('#CustomerCnpjCpf').prop('disabled', false);
    });

    $('#IsCnpj2').change(function() {
        radioRemoveError();
        radioNAChecked();
    });
    
    $(".cnpj-mask").mask("00.000.000/0000-00", {placeholder: "__.___.___/____-__"});
    $(".cpf-mask").mask("000.000.000-00", {placeholder: "___.___.___-__"});
});

function radioCnpjChecked() {
    $("label[for='CustomerCnpjCpf']").html('CNPJ');
    $(".cnpj_cpf").mask("00.000.000/0000-00", {placeholder: "__.___.___/____-__"});
    $("#div_cpf").addClass('hidden-element');
    $("#div_cnpj").removeClass('hidden-element');
}

function radioCpfChecked() {
    $("label[for='CustomerCnpjCpf']").html('CPF');
    $(".cnpj_cpf").mask("000.000.000-00", {placeholder: "___.___.___-__"});
    $("#div_cpf").removeClass('hidden-element');
    $("#div_cnpj").addClass('hidden-element');
}

function radioNAChecked() {
    $("label[for='CustomerCnpjCpf']").html('N/A');
    $('#CustomerCnpjCpf').prop('disabled', true);
    $('#CustomerCnpjCpf').removeAttr('placeholder');
}

function radioRemoveError() {
    $('.is-cnpj').find('.error-message').remove();
    $('.is-cnpj').find('.form-group').removeClass('error');
}