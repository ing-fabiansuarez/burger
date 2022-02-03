var getUrl = window.location;
var base_url = "https://casagrill.co/";

//TRAER FORMULARIO PARA CREAR LA ORDEN

$(document).ready(function() {
    reloadform();
    $("#typeshipping").change(function() {
        reloadform();
    });
});

function reloadform() {
    $.ajax({
        type: "get",
        url: base_url + "/formtypeshipping",
        data: "type=" + $("#typeshipping").val(),
        success: function(r) {
            $("#form-typeshipping").html(r);
        },
    });
}