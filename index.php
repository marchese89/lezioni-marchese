<?php
include_once 'config/mysql-config.php';
include_once 'acquisti/carrello.php';
include_once 'script/funzioni-php.php';

session_cache_limiter('nocache');
session_start();

if (! isset($_SESSION['carrello'])) {
    $_SESSION['carrello'] = new Carrello();
}

$pagina_interna = filter_input(INPUT_GET, "pagina");

if (! empty($_SESSION['user']) && $_SESSION['user'] !== 'admin' && $pagina_interna === 'amministrazione/admin.php') {
    header("Location: index.html");
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Lezioni Marchese</title>

<meta charset="UTF-8">


<link href="fogliCSS/home.css?ts=<?=time()?>&quot" rel="stylesheet"
	type="text/css">
<link href="fogliCSS/menu.css?ts=<?=time()?>&quot" rel="stylesheet"
	type="text/css">
<link href="fogliCSS/pagina_login.css?ts=<?=time()?>&quot"
	rel="stylesheet" type="text/css">
<link href="fogliCSS/admin.css?ts=<?=time()?>&quot" rel="stylesheet"
	type="text/css">
<script type="text/javascript" src="script/jquery-2.1.1.js"></script>
<script type="text/javascript"
	src="script/validazione_campi/livevalidation_standalone.compressed.js?ts=<?=time()?>&quot"></script>
<script type="text/javascript" src="script/ajax/metodi_ajax.js"></script>

<meta name="keywords" content="lezioni private, lezioni informatica, lezioni matematica, corsi, e-commerce, 
corsi informatica, corsi matematica, esercizi, esercizi svolti, esercizi su commissione" />
</head>
<body>

	<table id="pagina_iniziale" cellaspacing=0 cellpaddin=0 >

		<tr id="prima_riga">
			<td colspan=2 id="pr_sinistra"></td>
			<td align=right id="pr_destra">
			
<?php
if (empty($_SESSION['user'])) {
    ?>
    <a href="login.html" ><b>Accedi</b></a>|<a
				href="registrati.html" ><b>Registrati</b></a>
   <?php
} else {
    if ($_SESSION['nomeUtente'] !== "amministratore") {
        $user = $_SESSION['user'];

        $r1 = $conn->query("SELECT * FROM utente WHERE email='$user'");
        $ut = $r1->fetch_assoc();
        $id = $ut['id'];
        $r2 = $conn->query("SELECT * FROM studente WHERE utente_s='$id'");
        if ($r2->num_rows > 0) {
            ?>
        <b>Ciao <?php echo $ut['nome']?></b> <a href="carrello.html"><b>Carrello</b></a><?php echo '<b>(' . $_SESSION['carrello']->nElementi() . ')</b>';?>
        <a href="home-user.html"><b>Il mio profilo</b></a>|<a
				href="amministrazione/logout.php"  ><b>Logout</b></a>
        <?php
        } else {
            ?>
            <a href="home-insegnante.html"><b>Il mio profilo</b></a>|<a
				href="amministrazione/logout.php" ><b>Logout</b></a>
        <?php
        }
    } else {
        ?>
        <b>Amministratore</b> <a href="home-insegnante.html"><b>Il mio
						profilo</b></a>|<a href="amministrazione/logout.php"
				class="collegamento"><b>Logout</b></a>
        <?php
    }
}
?>
		</td>
		</tr>
		<tr id="seconda_riga">
			<th style="margin-left: 0; align: left;" colspan="3"><a
				href="index.html"><font style="font-size: 30px;">Lezioni Marchese</font></a></th>
		</tr>
		<tr id="terza_riga">
			<th colspan="3"><a href="aree-tematiche.html">Aree Tematiche</a> <a
				href="lezioni-su-richiesta.html">Materiale su Richiesta</a> <a
				href="pagamenti.html">Pagamenti</a> <a href="informazioni.html">Informazioni</a><a
				href="contatti.html">Contatti</a> <a href="cookiepolicy.html">Coockie
					Policy</a></th>

		</tr>

	</table>
					<?php
    if (empty($pagina_interna)) {
        $pagina_interna = 'home.php';
    }
    try {
        include $pagina_interna;
    } catch (Exception $e) {}
    ?>
</body>
</html>
