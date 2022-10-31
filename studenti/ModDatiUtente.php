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


<table id="prev" cellspacing="0" cellspadding="0" width="1030" align="center" style="height: 646px">
    <tr style="height: 100px">
        <td align="center" colspan="4" style="color: #0e83cd;font-size: 26px">
            Modifica Dati Profilo
        </td>
    </tr>
    <tr align="center" style="height: 80px">
        <td nowrap>
            <label for="labeltesto" style="color: #0e83cd">Nome: </label>
            <label id="firstName"> <?php echo $argomento['nome']; ?></label>&nbsp;&nbsp;
        </td>
	</tr>
	<tr>
        <td style="padding-right: 50" nowrap>
            <label for="labeltesto" style="color: #0e83cd">Cognome: </label>
            <label id="cognome"><?php echo $argomento['cognome']; ?></label>&nbsp;&nbsp;
        </td>
    </tr>

    <tr align="center" style="height: 80px">

        <th nowrap>
            <label for="labeltesto" style="color: #0e83cd">Email: </label>
            <label id="vatNumber"> <?php echo $argomento['email']; ?></label>
        </th>
        <td nowrap>
            &nbsp;
        </td>

    </tr>
    <tr align="center" height="100">

        <th colspan="3">
        <button class="button" onclick=location.href="modifica-dati2.html">Modifica Dati</button>
        </th>
    </tr>
    <tr valign="bottom" >
        <th style="padding-bottom: 20px">
            <a href="home-user.html" class="collegamento">Indietro</a>


        </th>

    </tr>




</table>

