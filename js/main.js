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

function jsAgregar(evt) {
    var evt = (evt) ? evt : ((event) ? event : null);
    if (evt.keyCode == 13) {
        //alert ('Has pulsado enter');
        var AddButton = $("#agregarCampo");
        //alert ('Has pulsado enter '+AddButton);
        AddButton.click();
    }
}