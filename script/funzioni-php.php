<?php


function trova_id_insegnante($email)
{
    $conn = mysqli_connect("localhost", "root", "[]x?,U*<VkcbFRF,WM]T", "easy-learning");
    
    $result = $conn->query("SELECT * FROM utente WHERE email='$email'");
    $utente = $result->fetch_assoc();
    $id_utente = $utente['id'];
    $result = $conn->query("SELECT * FROM insegnante WHERE utente_i='$id_utente'");
    $insegnante = $result->fetch_assoc();
    $id_insegnante = $insegnante['id'];
    return $id_insegnante;
}
?>