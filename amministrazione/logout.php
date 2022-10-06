<?php
include '../acquisti/carrello.php';
session_start();

$carrello = $_SESSION['carrello'];
if($carrello !== NULL && method_exists($carrello, "vuotaCarrello")){
$carrello->vuotaCarrello();
}
session_unset();
header("Location: ../index.html");
  
