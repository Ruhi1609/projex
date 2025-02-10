const BASE_URL = "http://localhost:81/CodeIgniter-3.1.9/";

function clearErros() {
    $(".has-error").removeClass("has-error");
    $(".help-block").html("");
}

function showErros(error_list) {
    clearErros();

    $.each(error_list, function(id, message){
        $(id).parent().parent().addClass("has-error");
        $(id).parent().siblings(".help-block").html(message)

    })
}

function loadingImg(message="") {
    return "<i class='fa fa-circle-o-notch fa-spin'></i>&nbsp;" + message
}