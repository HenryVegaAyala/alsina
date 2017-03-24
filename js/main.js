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

