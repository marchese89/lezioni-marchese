<?php 
include_once 'acquisti/carrello.php';
include 'config/mysql-config.php';
session_start();
?>
<table align="center" width="100%" id="pannello_controllo" cellspacing=0 cellpadding=0>
<tr id="titolo">
			<th colspan="4">Carrello</th>
		</tr>
		<?php 
		$carrello = $_SESSION['carrello'];
		$cont_carello = $carrello->contenuto();
		if($carrello->nElementi() > 0){
		?>
	<table border=0 width=60% align=center cellpadding="0" cellspacing="0">
		
		<tr style="height: 60px">
		<td><label>Id</label></td>
		<td><label>Nome</label></td>
		<td><label>Prezzo</label></td>
		<td><label>Opzioni</label></td>
		</tr>
		<?php 
		
		
		for ($i = 0; $i < $carrello->nElementi(); $i++) {
		    ?>
		    <tr style="height: 60px">
		    	<td><?php echo $cont_carello[$i]->getId();?></td>
		    	<td><?php echo $cont_carello[$i]->getNome();?></td>
		    	<td><?php echo $cont_carello[$i]->getPrezzo();?>&euro;</td>
		    	<td><button class="button" onclick=location.href="acquisti/rimuovi_dal_carrello.php?tipo=<?php echo $cont_carello[$i]->getTipoElemento();?>&id=<?php echo $cont_carello[$i]->getId();?>">Rimuovi</button></td>
		    </tr>
		    <?php 
		}
		
		?>
		<tr style="height: 60px"><td colspan=4>Totale: <?php echo $carrello->getTotale()?>&euro;</td></tr>
		<tr style="height: 60px">
		<td colspan="4"><button class="button" onclick=location.href="acquista.html">Acquista</button></td>
		</tr>
	</table>
	<?php 
		}else{
		    ?>
		    <table border=0 width=60% align=center cellpadding="0" cellspacing="0">
		    <tr style="height: 120px">
		    <td style="font-size: 18px">Il tuo Carello &egrave; Vuoto!</td>
		    </tr>
		    </table>
		    <?php  
		}
	?>
</table>