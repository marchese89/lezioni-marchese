<?php
if (! empty($_SESSION['user'])) {
    header("Location: index.html");
}
?>

<table id="pannello_controllo">

		<tr id="titolo">
			<th>Accesso</th>
		</tr>
	
	<form action="amministrazione/risultato_login.php" method="post">
	<tr>
		<td><label>Email</label></td>
	</tr>
	<tr>
		<td>
		<input type="text" name="email" id="email" maxlength="45" size="24" autofocus="true"> 
		<script type="text/javascript">
                                    var email1 = new LiveValidation('email', {onlyOnSubmit: true});
                                    email1.add(Validate.Presence);
                                    email1.add(Validate.Email);
                                </script></td>
	</tr>
	<tr>
		<td><label>Password</label></td>
	</tr>
	<tr>
		<td><input type="password" name="password" id="pass" maxlength="45"
			size="24"> <script type="text/javascript">
                                    var pass1_ = new LiveValidation('pass', {onlyOnSubmit: true});
                                    pass1_.add(Validate.Presence);
                                </script>
		
		</td>
	
	</tr>

	<tr>
		<td><input type="submit" value="Login"></td>
		
	</tr>

	</form>

	<tr>
		<td align="center" height="40"><a href="recupero_credenziali.html"
			class="collegamento">recupera password</a> <br></td>
	</tr>
	<tr valign="bottom">
		<td align="center" height="40"><a href="registrati.html"
			class="collegamento">registrati</a></td>
	</tr>
	<tr>
                    <?php
                    if (isset($_SESSION['loginCorretto']) && $_SESSION['loginCorretto'] === FALSE) {
                        ?>
                        <td><font color="red" size="4.5">Email o
				password non validi.</font></td>
                        <?php
                    } else {
                        ?>
                        <td>&nbsp;</td>
                    <?php } ?>
                </tr>
</table>