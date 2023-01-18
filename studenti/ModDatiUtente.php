<?php

include 'config/mysql-config.php';
if(!$conn){
    header("Location: ../index.html");
}
session_start();
$email_utente = $_SESSION['user'];


$sql = "SELECT * FROM utente WHERE email='$email_utente'";
$result = $conn->query($sql);
$utente;
if ($result->num_rows > 0) {
    $utente = $result->fetch_assoc();
} 

$id_u = $utente['id'];

$result2 = $conn->query("SELECT * FROM studente WHERE utente_s = '$id_u'");
$studente = $result2->fetch_assoc();
?>


<table id="pannello_controllo" cellspacing="0" cellspadding="0" align="center" style="width: 100%">
    <tr style="height: 70px" id="titolo">
        <th align="center" colspan="4" style="color: #0e83cd;font-size: 26px">
            Modifica Dati Profilo
        </th>
    </tr>
    <tr align="center" style="height: 60px">
        <td nowrap>
            <label for="labeltesto" style="color: #0e83cd">Nome: </label>
            <?php echo $utente['nome']; ?>
        </td>
	</tr>
	<tr style="height: 60px">
        <td style="padding-right: 50" nowrap>
            <label for="labeltesto" style="color: #0e83cd">Cognome: </label>
            <?php echo $utente['cognome']; ?>
        </td>
    </tr>

    <tr align="center" style="height: 60px">

        <td nowrap>
            <label for="labeltesto" style="color: #0e83cd">Email: </label>
            <?php echo $utente['email']; ?>
        </td>

    </tr>
    <tr>
    <td nowrap>
    <label>Indirizzo:</label>&nbsp;
    <?php echo $studente['via'];?>&nbsp;<?php echo "n. ". $studente['n_civico'];?>&nbsp;
    <?php echo $studente['cap'];?>,&nbsp;<?php echo $studente['citta'];?>&nbsp;(<?php echo $studente['provincia']?>)
    </td>
    </tr>
    <tr align="center" style="height: 60px">

        <td>
        <button class="button" onclick=location.href="modifica-dati2.html">Modifica Dati</button>
        </td>
    </tr>
	<tr>
		<td align="center" id="indietro" ><strong><a href="home-user.html">
					Indietro</a></strong></td>
	</tr>



</table>

