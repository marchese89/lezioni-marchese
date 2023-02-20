<?php 
session_start();

$_SESSION['nome'] = $_POST['nome'];
$_SESSION['cognome'] = $_POST['cognome'];
$_SESSION['via'] = $_POST['via'] ;
$_SESSION['n_civico'] = $_POST['n_civico'];
$_SESSION['cap'] = $_POST['cap'];
$_SESSION['citta'] = $_POST['citta'];
$_SESSION['provincia'] = $_POST['provincia']; 
$_SESSION['cf'] = $_POST['cf']; 
$_SESSION['email'] = $_POST['email']; 
$_SESSION['descrizione'] = $_POST['descrizione'];
$_SESSION['prezzo'] = $_POST['prezzo'];
$_SESSION['qta'] = $_POST['qta'];
$_SESSION['importo'] = $_POST['importo'];
$_SESSION['note'] = $_POST['note'];


header('Location: ../pagamenti2.html');


?>