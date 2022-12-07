<?php 
include_once 'acquisti/carrello.php';
include_once 'config/mysql-config.php';
session_start();

mysqli_autocommit($conn, FALSE);
$conn->query("LOCK TABLES utente READ,studente READ");
$conn->query("BEGIN");

if(isset($_SESSION['user'])){
    $email = $_SESSION['user'];
    if($email == 'admin'){
        header("Location: registrati.html");
    }
    $result1 = $conn->query("SELECT * FROM utente WHERE email='$email'");
    $utente = $result1->fetch_assoc();
    $id_ut = $utente['id'];
    $result2 = $conn->query("SELECT * FROM studente WHERE utente_s='$id_ut'");
    $conn->query("UNLOCK TABLES");
    if($result2->num_rows == 0){//l'utente non è uno studente
        header('Location: registrati.html');
    }else{
        ?>
        <script src="https://js.stripe.com/v3/"></script>
		<script src="pagamenti/checkout.js?ts=<?=time()?>&quot" defer></script>
        <table align="center" width="100%" id="pannello_controllo" cellspacing=0 cellpadding=0>
<tr id="titolo">
			<th colspan="4">Acquista</th>
		</tr>
		<tr style="height: 60px;font-size: 18px"><td>
		Paga <?php echo $_SESSION['carrello']->getTotale()?> &euro;
		</td></tr>
		
		<table border=0 width=500px align=center cellpadding="0" cellspacing="0" align=center>
		<tr style="height: 60px;width: 500px"><td><br>
		<br>
		<form id="payment-form">
      <div id="payment-element" style="width: 600px;">
        <!--Stripe.js injects the Payment Element-->
      </div>
      </table>
      <br>
      <br>
      <button id="submit">
        <div class="spinner hidden" id="spinner"></div>
        <span id="button-text">Paga Adesso</span>
      </button>
      <div id="payment-message" class="hidden"></div>
    </form>
    </td>
    </tr>
    
		</table>
      <?php   
    }
}else{
    header("Location: registrati.html");
}

?>