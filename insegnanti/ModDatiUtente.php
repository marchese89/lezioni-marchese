<?php

include 'config/mysql-config.php';
if(!$conn){
    header("Location: ../index.html");
}
session_start();
$email_utente = $_SESSION['user'];


$sql = "SELECT * FROM utente WHERE email='$email_utente'";
$result = $conn->query($sql);
$argomento;
if ($result->num_rows > 0) {
    $argomento = $result->fetch_assoc();
} 

?>


<table id="pannello_controllo" cellspacing="0" cellspadding="0" width="100%" align="center" >
    <tr style="height: 70px" id="titolo">
        <th align="center" colspan="2" style="color: #0e83cd;font-size: 26px">
            Modifica Dati Profilo
        </th>
    </tr>
    <tr align="center" style="height: 60px">
        <td nowrap>
            <label for="labeltesto" style="color: #0e83cd">Nome: </label>
            <?php echo $argomento['nome']; ?>
        </td>
	</tr>
	<tr>
        <td style="padding-right: 50;height: 60px" nowrap>
            <label for="labeltesto" style="color: #0e83cd">Cognome: </label>
            <?php echo $argomento['cognome']; ?>
        </td>
    </tr>

    <tr align="center" style="height: 60px">

        <td nowrap>
            <label for="labeltesto" style="color: #0e83cd">Email: </label>
            <?php echo $argomento['email']; ?>
        </td>

    </tr>
    <tr align="center" height="60px">

        <td colspan="3">
        <button class="button" onclick=location.href="modifica-dati2-ins.html">Modifica Dati</button>
        </td>
    </tr>
   <tr>
	<td align="center" id="indietro" style="height: 60px"><strong><a
					href="home-insegnante.html">
					Indietro</a></strong></td>
		</tr>



</table>

