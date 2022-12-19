<?php
include '../config/mysql-config.php';
session_start();

$codice = $_POST['codice_attivaz'];
$email = $_SESSION['user'];

mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES utente WRITE");
$conn->query("BEGIN");

$sql = "SELECT * FROM utente WHERE email='$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $argomento = $result->fetch_assoc();
    if ($codice === $argomento['codice_attivaz']) {
        $r = $conn->query("UPDATE utente SET stato_account='1' WHERE email='$email'");
        if ($r) {
            $conn->query("COMMIT");
        } else {
            $conn->query("ROLLBACK");
        }
    }
}
$conn->query("UNLOCK TABLES");

$aut = $_POST['aut'];
if ($aut === 'stud') {
    header('Location: ../home-user.html');
}
if ($aut === 'ins') {
    header('Location: ../home-insegnante.html');
}
?>