

//cambia la password dell'amministratore
function cambiaPass() {

    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            document.getElementById("res").innerHTML = xmlhttp.responseText;
            document.getElementById("old_p").innerHTML = "";
            document.getElementById("pass1").innerHTML = "";
            document.getElementById("pass2").innerHTML = "";
        }
    }
    var form = document.forms['cambia_pw'];
    var queryString = "";
    for (var i = 0; i < form.length; i++) {
        if (i !== 0) {
            queryString = queryString + '&' + document.forms['cambia_pw'][i].name + '=' + document.forms['cambia_pw'][i].value;
        } else {
            queryString = queryString + document.forms['cambia_pw'][i].name + '=' + document.forms['cambia_pw'][i].value;
        }
    }

    xmlhttp.open("POST", "richieste_ajax/cambia_pw_admin.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(queryString);

}


function ajaxUploadSupport() {

    var result = false;

    try {

        var xhr = new XMLHttpRequest();

        if ('onprogress' in xhr) {

            // Il browser supporta i W3C Progress Events

            result = true;

        } else {

            // Il browser non supporta i W3C Progress Events

        }

    } catch (e) {

        // Il browser è addirittura Internet Explorer 6 o 7...

    }



    return result;

}



var supportAjaxUpload = ajaxUploadSupport();

function progressFunc(e) {

    if (e.lengthComputable) {

        $('progress').attr({value: e.loaded, max: e.total});

    }

}

function _(el) {
    return document.getElementById(el);
}



/*
function completeHandler(event) {
    //_("status").innerHTML = event.target.responseText;
    _("loaded_n_total").innerHTML = "";
    var risposta = $.trim(event.target.responseText);
    if (risposta.substring(0, 3) == "okk") {
        _("status").innerHTML = "<font color='green'>file caricato correttamente</font>";
        _("progressBar").style.display = 'none';
        _("eliminaFile").style.display = 'block';
        _("puls_load").style.display = 'block';
    } else if (risposta.substring(0, 3) == "noo") {
        _("status").innerHTML = risposta.substr(3);
        _("back").style.display = 'block';
    } else {
        _("status").innerHTML = event.target.responseText;
    }
    timer_sessione();
    //_("progressBar").value = 100;
    //location.reload();
}
*/


function submitForm(supportAjaxUpload, formID) {

    if (supportAjaxUpload) {

        //dataToPost = new FormData($(formID)[0]);
        document.getElementById("da_nascondere").style.display = 'none';
        document.getElementById("progressBar").style.display = 'block';

        var file = _("file_prodotto").files[0];

        var formdata = new FormData();
        formdata.append("file_prodotto", file);
        var prodotto = _("prod");
        if (prodotto != null) {
            formdata.append("prod", _("prod").value);
        }
        var ajax = new XMLHttpRequest();
        ajax.upload.addEventListener("progress", progressHandler, false);
        ajax.addEventListener("load", completeHandler, false);
        ajax.addEventListener("error", errorHandler, false);
        ajax.addEventListener("abort", abortHandler, false);
        ajax.open("POST", "richieste_ajax/carica_file_prodotto.php");
        ajax.send(formdata);


    } else {
        _(formID).submit();

    }
    timer_sessione();
}

function indietroUpload() {
    _("da_nascondere").style.display = 'block';
    _("status").innerHTML = "";
    _("back").style.display = 'none';
    _("progressBar").style.display = 'none';
    if (_("carica") != null) {
        _("carica").style.display = 'none';
    }
}

function eliminaPDFprod() {
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            _("status").innerHTML = xmlhttp.responseText;
            _("eliminaFile").style.display = 'none';
            _("back").style.display = 'block';
            if (_("carica") != null) {
                _("carica").style.display = 'none';
            }
        }
    }

    var queryString = "";

    xmlhttp.open("POST", "richieste_ajax/eliminaPDFprod.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(queryString);
}



function timer_sessione() {

    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.open("GET", "richieste_ajax/pulisci_sessione.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send();
}



