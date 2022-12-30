<?php 
include_once 'acquisti/carrello.php';
include_once 'config/mysql-config.php';
session_start();



if(isset($_SESSION['user'])){

    $conn->query("LOCK TABLES utente READ,studente READ");
    $conn->query("BEGIN");
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
        <table align="center" id="pannello_controllo" >
<tr id="titolo">
			<th colspan="4">Acquista</th>
		</tr>
		<tr style="height: 60px;font-size: 18px"><td>
		Paga <?php echo $_SESSION['carrello']->getTotale()?> &euro;
		</td></tr>
		
		

		<form id="payment-form">
		<tr style="width: 500px" align="center"><td>
      <div id="payment-element" style="width: 600px;margin-left: auto;margin-right: auto;">
        <!--Stripe.js injects the Payment Element-->
      </div>
      </td>
    </tr>
    <tr><td>
      <button id="submit">
        <div class="spinner hidden" id="spinner"></div>
        <span id="button-text">Paga Adesso</span>
      </button>
      <div id="payment-message" class="hidden"></div>
      </td>
      </tr>
    </form>
    
    
		</table>
      <?php   
    }
}else{
    header("Location: registrati.html");
}

?>