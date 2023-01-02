
<form action="amministrazione/recupera_credenziali.php" method="post">
    <table align="center"  style="border-collapse: collapse" id="pannello_controllo">
        <tr id="titolo">
            <th height="90">Recupero Credenziali</th>
        </tr>
        <tr>
            <td>
        <h3>Inserire l'email collegata all'account,<br>verr&agrave; generata una una password e inviata a quell'indirizzo</h3>
        </td>
        </tr>
        <tr>
            <td height='100px'>
                <input type="text" name="email" id="email">
                <script type="text/javascript">
                    var email1 = new LiveValidation('email',{onlyOnSubmit: true});
                    email1.add(Validate.Presence);
                    email1.add(Validate.Email);
                </script>

            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="invia">
            </td>
        </tr>
        <tr>
			<td align="center" id="indietro"><strong><a
					href="login.html">
					Indietro</a></strong></td>
		</tr>
    </table>
</form>

