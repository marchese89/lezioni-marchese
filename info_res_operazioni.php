<?php
$messaggio;

if (isset($_SESSION['res_ordine'])) {
    if ($_SESSION['res_ordine'] == 'ok') {
        $messaggio = '<font size="6" color="#0e83cd">Ordine andato a buon fine</font>';
    } else {
        $messaggio = '<font size="6" color="red">Invio ordine fallito<br>Si prega di riprovare</font>';
    }
}

if (isset($_SESSION['res_preventivo'])) {
    if ($_SESSION['res_preventivo'] == 'ok') {
        $messaggio = '<font size="6" color="#0e83cd">Richiesta di Preventivo<br>inoltrata correttamente</font>';
        if (isset($_SESSION['email_inviata'])) {
            $messaggio .= '<br>&egrave; stata inviata una email di conferma.<br>(controllare eventualmente anche la posta indesiderata)';
            unset($_SESSION['email_inviata']);
        }
    } else {
        $messaggio = '<font size="6" color="red">Richiesta di Preventivo fallita<br>Si prega di riprovare</font>';
    }
    unset($_SESSION['res_preventivo']);
} else if (isset($_SESSION['registrazione'])) {
    if ($_SESSION['registrazione'] == 'ok') {
        $messaggio = '<font size="6" color="#0e83cd">Registrazione Effettuata correttamente</font><p>' .
                '<font size="4" color="#0e83cd">verr&agrave; inviata una email all\'indirizzo da lei indicato per l\'attivazione dell\'account.<font><br>'.
                '(controllare eventualmente anche la posta indesiderata)';
    } else {
        $messaggio = '<font size="6" color="red">Registrazione fallita<br>Si prega di riprovare</font>';
    }
    unset($_SESSION['registrazione']);
}


if (isset($_SESSION['recupero_credenziali'])) {
    if ($_SESSION['recupero_credenziali'] == 'ok') {
        $messaggio = '<font size="6" color="#0e83cd">La tua password &egrave; stata modificata</font><br>'.
            '<span style="font-size: 14px;color: #0e83cd" >&Eacute; stata inviata una email con la nuova password all\'indirizzo fornito durante la registrazione</span><br>'.
            '<span style="font-size: 14px;color: #0e83cd">(controllare eventualmente anche la posta indesiderata)</span>';
    } else if ($_SESSION['recupero_credenziali'] == "noemail") {
        $messaggio = '<font size="6" color="red">La sua email non &egrave; stata trovata<br>La preghiamo di riprovare</font>';
    } else if ($_SESSION['recupero_credenziali'] == "noquery") {
        $messaggio = '<font size="6" color="red">Si sono verificati dei problemi<br>La preghiamo di riprovare</font>';
    }
    unset($_SESSION['recupero_credenziali']);
}

?>

<table width="1030" border="0" style="margin-left: auto;margin-right: auto; height: 646px" valign="center" id="prev">
    <tr>
        <th height="100">
            &nbsp;
        </th>
    </tr>
    <tr>
        <th>
<?php echo $messaggio ?>
        </th>
    </tr>
    <tr>
        <th height="200">
            &nbsp;
        </th>
    </tr>
    <tr>
        <th>
            <a href="index.html">torna alla home</a>
        </th>
    </tr>

</table>
