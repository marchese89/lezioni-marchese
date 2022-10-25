<?php 
include 'config/mysql-config.php';

?>
<table align="center" width="100%" id="pannello_controllo"
	cellspacing="0" cellpadding="0">
	<thead>
		<tr id="titolo">
			<th>I miei Corsi</th>
		</tr>
	</thead>
	<tbody>
		<div id="inner">
	<?php
$inner;
if (isset($_GET['inner'])) {
    $inner = $_GET['inner'];
}
if (! empty($inner) && $inner != 'amministrazione/admin.php') {
    include $inner;
} else {
    ?>
		<tr>
				<td align="center"><strong><a
						href="elenco-corsi.html">
							Elenco corsi/lezioni inserite</a></strong></td>
			</tr>
		
		<tr>
			<td align="center"><strong><a
					href="index.php?pagina=amministrazione/admin.php&inner=prodotti_stampa/gerarchia_categorie.php">
					Esercizi</a></strong></td>
		</tr>
		<tr>
			<td align="center" id="indietro"><strong><a
					href="home-insegnante.html">
					Indietro</a></strong></td>
		</tr>
		<?php
}
?>
		</div>
	</tbody>
</table>