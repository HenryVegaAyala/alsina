/**
 * Created by HENRY on 20/03/2017.
 */

function stopRKey(evt) {
    var evt = (evt) ? evt : ((event) ? event : null);
    var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
    if ((evt.keyCode == 13) && (node.type == "text")) {

        return false;
    }
}

document.onkeypress = stopRKey;

function CalcularPesoRealTotal() {

    var pesoreal, ud, pesorealtotal, respesoreal, resud, respesorealtotal, i,
        fechallegada, fechacorte, diasgracia, cantdias, rescantdias, puxdia,
        costototal, respuxdia, rescostototal, pesovolumetrico, pesovolumetricototal,
        respesovolumetrico, respesovolumetricototal;

    /*Peso Real total*/
    pesoreal = document.getElementsByName("PESO_REAL[]");
    ud = document.getElementsByName("UD[]");
    pesorealtotal = document.getElementsByName("PESO_REAL_TOTAL[]");

    /*Cantidad de Dias*/
    fechallegada = $("#guia-fech_llega-kvdate").find("input").val();
    fechacorte = $("#guia-fech_corte-kvdate").find("input").val();
    diasgracia = document.getElementById("guia-di_gracia").value;
    cantdias = document.getElementsByName("CANT_DIAS[]");

    /*Costo Total*/
    puxdia = document.getElementsByName("PREC_X_DIA[]");
    costototal = document.getElementsByName("COST_TOTAL[]");

    /*Peso volumentrico total*/
    pesovolumetrico = document.getElementsByName("PESO_VOL[]");
    pesovolumetricototal = document.getElementsByName("PESO_V_TOTAL[]");

    for (i = 0; i < pesoreal.length; i++) {
        respesoreal = parseFloat(pesoreal[i].value, 2);
        resud = parseFloat(ud[i].value, 2);

        /*Peso Real total*/
        respesorealtotal = parseFloat((respesoreal * resud), 2);
        pesorealtotal[i].value = redondear2decimales(respesorealtotal);

        /*Cantidad de dias*/
        rescantdias = parseFloat(((restafechas(fechallegada, fechacorte) + 1) - diasgracia));
        cantdias[i].value = redondear2decimales(rescantdias);

        /*Costo Total*/
        respuxdia = parseFloat(puxdia[i].value, 2);
        rescostototal = parseFloat(respuxdia * resud * rescantdias);
        costototal[i].value = redondear2decimales(rescostototal);

        /*Peso volumentrico total*/
        respesovolumetrico = parseFloat(pesovolumetrico[i].value, 2);
        respesovolumetricototal = parseFloat(respesovolumetrico * resud);
        pesovolumetricototal[i].value = redondear2decimales(respesovolumetricototal);

    }

}

function CalcularPesoRealTotalActualizar() {

    var pesoreal, ud, pesorealtotal, respesoreal, resud, respesorealtotal, i,
        fechallegada, fechacorte, diasgracia, cantdias, rescantdias, puxdia,
        costototal, respuxdia, rescostototal, pesovolumetrico, pesovolumetricototal,
        respesovolumetrico, respesovolumetricototal,
        procesollegada, nuevafechallegada,
        procesocorte, nuevafechacorte;

    /*Peso Real total*/
    pesoreal = document.getElementsByName("PESO_REAL[]");
    ud = document.getElementsByName("UD[]");
    pesorealtotal = document.getElementsByName("PESO_REAL_TOTAL[]");

    /*Cantidad de Dias*/
    fechallegada = $("#guia-fech_llega-kvdate").find("input").val();
    fechacorte = $("#guia-fech_corte-kvdate").find("input").val();
    diasgracia = document.getElementById("guia-di_gracia").value;
    cantdias = document.getElementsByName("CANT_DIAS[]");

    procesollegada = fechallegada.split('-');
    nuevafechallegada = procesollegada[2] + '-' + procesollegada[1] + '-' + procesollegada[0];

    procesocorte = fechacorte.split('-');
    nuevafechacorte = procesocorte[2] + '-' + procesocorte[1] + '-' + procesocorte[0];

    /*Costo Total*/
    puxdia = document.getElementsByName("PREC_X_DIA[]");
    costototal = document.getElementsByName("COST_TOTAL[]");

    /*Peso volumentrico total*/
    pesovolumetrico = document.getElementsByName("PESO_VOL[]");
    pesovolumetricototal = document.getElementsByName("PESO_V_TOTAL[]");

    for (i = 0; i < pesoreal.length; i++) {
        respesoreal = parseFloat(pesoreal[i].value, 2);
        resud = parseFloat(ud[i].value, 2);

        /*Peso Real total*/
        respesorealtotal = parseFloat((respesoreal * resud), 2);
        pesorealtotal[i].value = redondear2decimales(respesorealtotal);

        /*Cantidad de dias*/
        rescantdias = parseFloat(((restafechas(nuevafechallegada, nuevafechacorte) + 1) - diasgracia));
        cantdias[i].value = redondear2decimales(rescantdias);

        /*Costo Total*/
        respuxdia = parseFloat(puxdia[i].value, 2);
        rescostototal = parseFloat(respuxdia * resud * rescantdias);
        costototal[i].value = redondear2decimales(rescostototal);

        /*Peso volumentrico total*/
        respesovolumetrico = parseFloat(pesovolumetrico[i].value, 2);
        respesovolumetricototal = parseFloat(respesovolumetrico * resud);
        pesovolumetricototal[i].value = redondear2decimales(respesovolumetricototal);

    }

}

function redondear2decimales(numero) {
    var original, resultado;
    original = parseFloat(numero);
    resultado = Math.round(original * 100) / 100;
    return resultado;
}

function restafechas(f1, f2) {
    var aFecha1 = f1.split('-');
    var aFecha2 = f2.split('-');
    var fFecha1 = Date.UTC(aFecha1[2], aFecha1[1] - 1, aFecha1[0]);
    var fFecha2 = Date.UTC(aFecha2[2], aFecha2[1] - 1, aFecha2[0]);
    var dif = fFecha2 - fFecha1;
    var dias = Math.floor(dif / (1000 * 60 * 60 * 24));
    return dias;
}

$(document).on("blur", "#guia-di_gracia", function () {

    var i, fechallegada, fechacorte, diasgracia, puxdia, ud, pesoreal, rescantdias, respuxdia, rescostototal, resud;

    fechallegada = $("#guia-fech_llega-kvdate").find("input").val();
    fechacorte = $("#guia-fech_corte-kvdate").find("input").val();
    diasgracia = document.getElementById("guia-di_gracia").value;
    puxdia = document.getElementsByName("PREC_X_DIA[]");
    ud = document.getElementsByName("UD[]");

    costototal = document.getElementsByName("COST_TOTAL[]");
    cantdias = document.getElementsByName("CANT_DIAS[]");

    /*Re-Operacion*/
    pesoreal = document.getElementsByName("PESO_REAL[]");
    for (i = 0; i < pesoreal.length; i++) {
        resud = parseFloat(ud[i].value, 2);

        rescantdias = parseFloat(((restafechas(fechallegada, fechacorte) + 1) - diasgracia));
        cantdias[i].value = redondear2decimales(rescantdias);

        respuxdia = parseFloat(puxdia[i].value, 2);
        rescostototal = parseFloat(respuxdia * resud * rescantdias);
        costototal[i].value = redondear2decimales(rescostototal);
    }

});

$(document).on("change", "#guia-fech_llega-kvdate", function () {

    var i, fechallegada, fechacorte, diasgracia, puxdia, ud, pesoreal, rescantdias, respuxdia, rescostototal, resud, cantdias;

    fechallegada = $("#guia-fech_llega-kvdate").find("input").val();
    fechacorte = $("#guia-fech_corte-kvdate").find("input").val();
    diasgracia = document.getElementById("guia-di_gracia").value;
    cantdias = document.getElementsByName("CANT_DIAS[]");
    puxdia = document.getElementsByName("PREC_X_DIA[]");
    ud = document.getElementsByName("UD[]");

    costototal = document.getElementsByName("COST_TOTAL[]");

    /*Re-Operacion*/
    pesoreal = document.getElementsByName("PESO_REAL[]");
    for (i = 0; i < pesoreal.length; i++) {
        resud = parseFloat(ud[i].value, 2);

        rescantdias = parseFloat(((restafechas(fechallegada, fechacorte) + 1) - diasgracia));
        cantdias[i].value = redondear2decimales(rescantdias);

        respuxdia = parseFloat(puxdia[i].value, 2);
        rescostototal = parseFloat(respuxdia * resud * rescantdias);
        costototal[i].value = redondear2decimales(rescostototal);

        /*Cantidad de dias*/
        rescantdias = parseFloat(((restafechas(fechallegada, fechacorte) + 1) - diasgracia));
        cantdias[i].value = redondear2decimales(rescantdias);
    }

});

$(document).on("change", "#guia-fech_corte-kvdate", function () {

    var i, fechallegada, fechacorte, diasgracia, puxdia, ud, pesoreal, rescantdias, respuxdia, rescostototal, resud, cantdias;

    fechallegada = $("#guia-fech_llega-kvdate").find("input").val();
    fechacorte = $("#guia-fech_corte-kvdate").find("input").val();
    diasgracia = document.getElementById("guia-di_gracia").value;
    cantdias = document.getElementsByName("CANT_DIAS[]");
    puxdia = document.getElementsByName("PREC_X_DIA[]");
    ud = document.getElementsByName("UD[]");
    costototal = document.getElementsByName("COST_TOTAL[]");

    /*Re-Operacion*/
    pesoreal = document.getElementsByName("PESO_REAL[]");
    for (i = 0; i < pesoreal.length; i++) {
        resud = parseFloat(ud[i].value, 2);

        rescantdias = parseFloat(((restafechas(fechallegada, fechacorte) + 1) - diasgracia));
        cantdias[i].value = redondear2decimales(rescantdias);

        respuxdia = parseFloat(puxdia[i].value, 2);
        rescostototal = parseFloat(respuxdia * resud * rescantdias);
        costototal[i].value = redondear2decimales(rescostototal);

        /*Cantidad de dias*/
        rescantdias = parseFloat(((restafechas(fechallegada, fechacorte) + 1) - diasgracia));
        cantdias[i].value = redondear2decimales(rescantdias);
    }

});

$(document).on("blur", "#guia-num_obra", function () {

    var numeroobra, numeroguia;

    numeroobra = document.getElementById("guia-num_obra").value;
    numeroguia = $("#guia-num_guia");

    var parametros = {
        "numeroobra": numeroobra
    };

    $.ajax({
        data: parametros,
        url: 'guia/numeroguia',
        type: 'post',
        update: '#guia-num_guia',
        beforeSend: function () {
            numeroguia.prop('disabled', true);
        },
        success: function (response) {

            numeroguia.prop('disabled', false);
            numeroguia.find('option').remove();

            $(response).each(function (i, v) {
                numeroguia.append('<option value="' + i.NUM_GUIA + '">' + v.NUM_GUIA + '</option>');
            })

            cursos.prop('disabled', false);
        },
        error: function () {
            numeroguia.prop('disabled', true);
        }
    });
});
