<?php
if(!$conn || empty($_SESSION['user'])){
    header("Location: ../index.html");
}
?>
<script>
function cambiaPassUtente() {

	
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
        	document.getElementById("vecchiaPass").value = "";
        	document.getElementById("pass1").value = "";
        	document.getElementById("pass2").value = "";
            document.getElementById("res").innerHTML = xmlhttp.responseText;
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

    xmlhttp.open("POST", "richieste_ajax/cambia_pw_insegnante.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(queryString);

}



function mostraPassword1() {
	  var x = document.getElementById("pass1");
	  if (x.type === "password") {
	    x.type = "text";
	  } else {
	    x.type = "password";
	  }
	}
function mostraPassword2() {
	  var x = document.getElementById("pass2");
	  if (x.type === "password") {
	    x.type = "text";
	  } else {
	    x.type = "password";
	  }
	}

function modifica_pass(){
	var x = document.getElementById("pass1");
	if (x.type === "text") {
	    x.type = "password";
	  }
	var y = document.getElementById("pass2");
	if (x.type === "text") {
  	    x.type = "password";
  	  }
}

</script>

<form name="cambia_pw" onsubmit="modifica_pass()" method="post" action="insegnanti/cambia_pw_insegnante.php">
    <table id="pannello_controllo">
        <tr id="titolo">
            <th>
                Modifica Password
            </th>
        </tr>
        <tr>
            <td>
                <label style="color: #0e83cd;">Vecchia Password</label>
            </td>
            </tr>
            <tr>
            <td>
                <input type="password" name="vecchiaPass" id="vecchiaPass">
            </td>
        </tr>
        <tr>
            <td>
                <label style="color: #0e83cd;">Nuova Password: </label>
            </td>
            </tr>
            <tr>
            <td>
            <p>
                <input type="password" name="nuovaPass" id="pass1">
                <script type="text/javascript">
                    var pass1_ = new LiveValidation('pass1', {onlyOnSubmit: true});
                    pass1_.add(Validate.Presence);
                    pass1_.add(Validate.Pass);
                </script>
                <p> <input type="checkbox" onclick="mostraPassword1()">Mostra
				Password
            </td>
        </tr>
        <tr>
            <td>
                <label style="color: #0e83cd;">Conferma Password: </label>
            </td>
            </tr>
            <tr>
            <td>
            <p>
                <input type="password" name="confermaPass" id="pass2">
                <script type="text/javascript">
                    var pass2_ = new LiveValidation('pass2', {onlyOnSubmit: true});
                    pass2_.add(Validate.Presence);
                    pass2_.add(Validate.Confirmation, {match: 'pass1'});
                </script>
                </p> <input type="checkbox" onclick="mostraPassword2()">Mostra
				Password
				<p>
            </td>

        </tr>
        <?php 
        if(isset($_SESSION['res_cambia_pw_admin'])){
            echo $_SESSION['res_cambia_pw_admin'];
            unset($_SESSION['res_cambia_pw_admin']);
        }
        ?>
        <tr>
			<th colspan="2"><label><p>La password deve essere lunga alemno 10
					caratteri,
					<p>contenere almeno una lettera maiuscola e una minuscola,
					
					<p>un numero, e uno tra i seguenti caratteri speciali: @ # ! ? . ,
						; :
					
					<p>non deve inoltre contenere più di due cifre uguali ripetute o
						più di due lettere ripetute
					
			</label></th>
		</tr>
        <tr>
            <td>
                <input type="submit" value="Modifica">
                <br>

            </td>
        </tr>
        <tr>
		<td align="center" id="indietro" colspan="2"><strong><a href="home-insegnante.html">
					Indietro</a></strong></td>
	</tr>

    </table>
</form>
