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
        rescantdias = parseFloat(((restafechas(fechallegada, fechacorte) - 1) * diasgracia));
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
    nuevafechallegada = procesollegada[2]+'-'+procesollegada[1]+'-'+procesollegada[0];

    procesocorte = fechacorte.split('-');
    nuevafechacorte = procesocorte[2]+'-'+procesocorte[1]+'-'+procesocorte[0];

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
        rescantdias = parseFloat(((restafechas(nuevafechallegada, nuevafechacorte) - 1) * diasgracia));
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

// function CalcularCantidadDias() {
//     // $(document).ready(function () {
//     var fechallegada, fechacorte, diasgracia, cantdias, rescantdias, pesoreal, i;
//     /*Cantidad de Dias*/
//     pesoreal = document.getElementsByName("PESO_REAL[]");
//     fechallegada = $("#guia-fech_llega-kvdate").find("input").val();
//     fechacorte = $("#guia-fech_corte-kvdate").find("input").val();
//     diasgracia = document.getElementById("guia-di_gracia").value;
//     cantdias = document.getElementsByName("CANT_DIAS[]");
//
//     // $("input[id=guia-fech_corte]").click(function () {
//     //     console.log(fechallegada, fechacorte, diasgracia);
//     for (i = 0; i < pesoreal.length; i++) {
//         rescantdias = parseFloat(((restafechas(fechallegada, fechacorte) - 1) * diasgracia));
//         cantdias[i].value = redondear2decimales(rescantdias);
//     }
//     //     });
//     // });
// }


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