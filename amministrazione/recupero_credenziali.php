
<form action="amministrazione/recupera_credenziali.php" method="post">
    <table align="center"  style="border-collapse: collapse" id="prev">
        <tr>
            <th height="90">&nbsp;</th>
        </tr>
        <tr>
            <th height='70'>
        <h3>Inserire l'email collegata all'account,<br>verr&agrave; generata una una password e inviata a quell'indirizzo</h3>
        </th>
        </tr>
        <tr>
            <th height='100px'>
                <input type="text" name="email" id="email">
                <script type="text/javascript">
                    var email1 = new LiveValidation('email',{onlyOnSubmit: true});
                    email1.add(Validate.Presence);
                    email1.add(Validate.Email);
                </script>

            </th>
        </tr>
        <tr>
            <th style="padding-bottom: 30px">
                <input type="submit" value="invia">
            </th>
        </tr>
    </table>
</form>

