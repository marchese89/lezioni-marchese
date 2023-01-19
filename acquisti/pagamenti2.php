<?php 
session_start();
?>
<script src="https://js.stripe.com/v3/"></script>
<script src="pagamenti/checkout2.js?ts=<?=time()?>&quot" defer></script>
<?php session_start();?>
<table align="center" id="pannello_controllo">
	<tr id="titolo">
		<th colspan="4">Paga e Genera Fattura</th>
	</tr>
	
	<form id="payment-form">
	<tr><th>
	<tr><th style="font-size:20px">Paga <?php echo $_SESSION['importo'];?>&euro; in modo sicuro con Stripe</th></tr>
		<tr style="width: 500px" align="center">
			<th>
			<p>
				<div id="payment-element"
					style="width: 600px; margin-left: auto; margin-right: auto;">
					<!--Stripe.js injects the Payment Element-->
				</div>
				<p>
			</th>
		</tr>
		<tr>
			<th>
				<button id="submit">
					<div class="spinner hidden" id="spinner"></div>
					<span id="button-text">Paga Adesso</span>
				</button>
				<div id="payment-message" class="hidden"></div>
			</th>
		</tr>
		 <tr>
		<td align="center" id="indietro" ><strong><a
				href="pagamenti.html"> Indietro</a></strong></td>
	</tr>
	</form>

</table>