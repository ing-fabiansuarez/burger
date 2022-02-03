var getUrl = window.location;
var base_url = "https://casagrill.co/";

//TRAER PRODUCTOS DESDE LA BASE DE DATOS

$(document).ready(function() {
    reloadproducts();
    $("#categories-select").change(function() {
        reloadproducts();
    });
    $("#products-select").change(function() {
        reloadingredients();
        reloadadditions();
    });
});

function reloadproducts() {
    $.ajax({
        type: "post",
        url: base_url + "/productofcategory",
        data: "category=" + $("#categories-select").val(),
        success: function(r) {
            $("#products-select").html(r);
            reloadingredients();
            reloadadditions();
        },
    });
}

//TRAER INGREDIENTES DESDE LA BASE DE DATOS

function reloadingredients() {
    $.ajax({
        type: "post",
        url: base_url + "/ingredientsofproduct",
        data: "product=" + $("#products-select").val(),
        success: function(r) {
            $("#ingredients-div").html(r);
        },
    });
}

//TRAER ADICIONES DESDE LA BASE DE DATOS

function reloadadditions() {
    $.ajax({
        type: "post",
        url: base_url + "/additionsofproduct",
        data: "product=" + $("#products-select").val(),
        success: function(r) {
            $("#additions-div").html(r);
        },
    });
}