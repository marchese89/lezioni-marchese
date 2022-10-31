<?php 
include '../config/mysql-config.php';
session_start();

$codice = $_POST['codice_attivaz'];
$email = $_SESSION['user'];
$sql = "SELECT * FROM utente WHERE email='$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $argomento = $result->fetch_assoc();
    if($codice === $argomento['codice_attivaz']){
        $conn->query("UPDATE utente SET stato_account='1' WHERE email='$email'");
    }
}

header('Location: ../home-user.html');
?>