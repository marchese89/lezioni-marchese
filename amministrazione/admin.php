


<table align="center" width="100%" id="pannello_controllo"
	cellspacing="0" cellpadding="0">
	<thead>
		<tr id="titolo">
			<th>Pannello Amministratore</th>
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
			<td align="center"><strong>
			<a href="">Vendite</a></strong></td>
		</tr>

		<tr>
			<td align="center"><strong><a
					href="">
						Studenti</a></strong></td>
		</tr>
		<tr>
			<td align="center"><strong><a
					href="index.php?pagina=amministrazione/admin.php&inner=amministrazione/province/gestisci_province.php">Insegnanti</a></strong></td>
		</tr>

		<tr>
			<td align="center" id="ultima_r"><strong><a
					href="">Cambia Credenziali</a></strong></td>
		</tr>
		<?php
}
?>
		</div>
	</tbody>
</table>

