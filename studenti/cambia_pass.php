<?php
if(!$conn || empty($_SESSION['user'])){
    header("Location: ../index.html");
}
?>


<form name="cambia_pw">
    <table width="1030" align="center" id="tabella"  style="height: 646px">
        <tr>
            <th height="80" colspan="2" width="50%" style="font-size: 26px; color: #0e83cd;">
                Modifica Password
            </th>
        </tr>
        <tr>
            <th  height="70" align="right">
                <label style="color: #0e83cd;">Vecchia Password: </label>
            </th>
            <th align="left">
                <input type="password" name="vecchiaPass">
            </th>
        </tr>
        <tr>
            <th  height="70" align="right">
                <label style="color: #0e83cd;">Nuova Password: </label>
            </th>
            <th align="left">
                <input type="password" name="nuovaPass" id="pass1">
                <script type="text/javascript">
                    var pass1_ = new LiveValidation('pass1', {onlyOnSubmit: true});
                    pass1_.add(Validate.Presence);
                </script>
            </th>
        </tr>
        <tr>
            <th  height="70" align="right">
                <label style="color: #0e83cd;">Conferma Password: </label>
            </th>
            <th align="left">
                <input type="password" name="confermaPass" id="pass2">
                <script type="text/javascript">
                    var pass2_ = new LiveValidation('pass2', {onlyOnSubmit: true});
                    pass2_.add(Validate.Presence);
                    pass2_.add(Validate.Confirmation, {match: 'pass1'});
                </script>
            </th>

        </tr>
        <tr>
            <th colspan="2">
                <input type="button" value="Modifica" onclick="cambiaPassUtente()">
                <br>

            </th>
        </tr>
        <tr>
            <td>
                &nbsp;
            </td>
        </tr>
        <tr height="70" valign="bottom">
            <th colspan="2">
                <a href="home-user.html" class="collegamento">indietro</a>

                <br>

            </th>
        </tr>

    </table>
</form>
