<?php
include 'acquisti/carrello.php';
include 'config/mysql-config.php';
session_cache_limiter('nocache');

session_start();
$_SESSION['user'] = '';

if (empty($_SESSION['carrello'])) {
    $_SESSION['carrello'] = new Carrello();
    $_SESSION['carrello']->setModPagamento("bonifico");
    $_SESSION['mod_pagamento'] = "bonifico";
}

$pagina_interna = filter_input(INPUT_GET, "pagina");

if ($pagina_interna == 'acquisti/vai_alla_cassa.php' && count($_SESSION['carrello']->contenuto()) == 0) {
    header("Location: index.html");
}

if ($pagina_interna == 'clienti/preventivo2.php' && $_SESSION['pagina_preventivo'] != 'preventivo') {
    header("Location: index.html");
}
if ($pagina_interna == 'clienti/preventivo3.php' && $_SESSION['pagina_preventivo'] != 'preventivo') {
    header("Location: index.html");
}
if ($pagina_interna == 'clienti/utente.php' || $pagina_interna == 'clienti/ModDatiUtente.php' || $pagina_interna == 'clienti/modifica_dati_p.php' || $pagina_interna == 'clienti/cambia_pass.php' || $pagina_interna == 'clienti/Indirizzi.php' || $pagina_interna == 'acquisti/ordini_cliente.php' || $pagina_interna == 'clienti/newsletter.php') {
    $cf_utente = $_SESSION['user'];
    $sql = "SELECT * FROM cliente WHERE cf='$cf_utente'";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        if ($row['stato_account'] === '0') {
            header("Location: index.php?pagina=clienti/attiva_account.php");
        }
    }
}

if ($_SESSION['user'] !== 'admin' && $pagina_interna === 'amministrazione/admin.php') {
    header("Location: index.html");
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Easy Learning</title>

<meta charset="UTF-8">


<style>
/* jssor slider bullet navigator skin 01 css */
/*
            .jssorb01 div           (normal)
            .jssorb01 div:hover     (normal mouseover)
            .jssorb01 .av           (active)
            .jssorb01 .av:hover     (active mouseover)
            .jssorb01 .dn           (mousedown)
            */
.jssorb01 {
	position: absolute;
}

.jssorb01 div, .jssorb01 div:hover, .jssorb01 .av {
	/*position: absolute;*/
	/* size of bullet elment */
	width: 30px;
	height: 30px;
	filter: alpha(opacity = 70);
	opacity: .7;
	overflow: hidden;
	cursor: pointer;
	border: #000 1px solid;
	border-radius: 16px;
}

.jssorb01 div {
	background-color: #f7a922;
}

.jssorb01 div:hover, .jssorb01 .av:hover {
	background-color: #d3d3d3;
}

.jssorb01 .av {
	background-color: #fc5f1b;
}

.jssorb01 .dn, .jssorb01 .dn:hover {
	background-color: #555555;
}

/* jssor slider arrow navigator skin 05 css */
/*
            .jssora05l                  (normal)
            .jssora05r                  (normal)
            .jssora05l:hover            (normal mouseover)
            .jssora05r:hover            (normal mouseover)
            .jssora05l.jssora05ldn      (mousedown)
            .jssora05r.jssora05rdn      (mousedown)
            */
.jssora05l, .jssora05r {
	display: block;
	position: relative;
	/* size of arrow element */
	width: 40px;
	height: 40px;
	cursor: pointer;
	overflow: hidden;
}

.jssora05l {
	background-position: -10px -40px;
}

.jssora05r {
	background-position: -70px -40px;
}

.jssora05l:hover {
	background-position: -130px -40px;
}

.jssora05r:hover {
	background-position: -190px -40px;
}

.jssora05l.jssora05ldn {
	background-position: -250px -40px;
}

.jssora05r.jssora05rdn {
	background-position: -310px -40px;
}
</style>


<script type="text/javascript">
            function getCookie(cname) {
                var name = cname + "=";
                var ca = document.cookie.split(';');
                    for(var i = 0; i < ca.length; i++) {
                        var c = ca[i];
                        while (c.charAt(0) === ' '){ 
                            c = c.substring(1);
                        }
                        if (c.indexOf(name) === 0){ 
                            return c.substring(name.length,c.length);
                        }
                    }
                return "";
            }
                    
            window.onpageshow = function (event) {
                
                var cookie = getCookie("_v");
                if(cookie.trim() === "%2B%2B%2B"){
                	document.getElementById("cookie").style.display = "none";
                }else{
                   document.getElementById("cookie").style.display = "block";
                }
                
                if (event.persisted) {
                    window.location.reload();
                }
            };
            

        </script>

<link href="fogliCSS/home.css?ts=<?=time()?>&quot" rel="stylesheet" type="text/css">
<link href="fogliCSS/menu.css?ts=<?=time()?>&quot" rel="stylesheet" type="text/css">
<script type="text/javascript" src="script/jquery-2.1.1.js"></script>
<script type="text/javascript"
	src="script/validazione_campi/livevalidation_standalone.compressed.js"></script>
<script type="text/javascript" src="script/ajax/metodi_ajax.js"></script>



</head>
<body style="background-color: #ffffff;">

	<div id="cookie">
		<br> Questo sito utilizza i cookie tecnici (indispensabili per il suo
		corretto funzionamento). <br> &Eacute; presente una pagina con
		ulteriori dettagli: <br> (<a href="cookiepolicy.html">leggi
			informativa completa</a>)<br> continuando la navigazione si accetta
		l'utilizzo dei cookie<br>
		<button onclick="accettaCookie()">Chiudi</button>

	</div>

	<table
		style="border-radius: 7px 7px 7px 7px; vertical-align: middle; white-space: nowrap; background-color: #e6e6e6; margin-left: auto; margin-right: auto; position: relative; z-index: 1; top: 0; width: 100%; border: 3px solid black; border-width: 0; border-spacing: 0;">

		<tr style="height: 20px;">
			<td colspan="8"></td>
		</tr>
		<tr>
			<td style="margin-left: 0; align: center;"><a href="index.html"><img
					src="images/logo.png" width="100" height="100" title="Home Page"
					alt="img"></a></td>
			<td style="font-size: 22pt;">Easy Learning</td>
			<td colspan="6"></td>
		</tr>
		<tr>
			<td colspan="2"></td>

			<th style="font-size: 18pt">
				<div id="cssmenu">
					<ul>
						<li class='active has-sub'><a href="">Corsi</a>
							<ul>
								<li class='active has-sub'><a href="">Corso 1</a></li>
								<li class='active has-sub'><a href="">Corso 2</a></li>
								<li class='active has-sub'><a href="">Corso 3</a></li>
							</ul></li>
					</ul>
					<ul>
						<li class='active has-sub'><a href="">Lezioni online</a></li>
					</ul>
					<ul>
						<li class='active has-sub'><a href="">Esercizi</a></li>
					</ul>
					<ul>
						<li class='active has-sub'><a href="">Recensioni</a></li>
					</ul>
					<ul>
						<li class='active has-sub'><a href="">Lavora con noi</a></li>
					</ul>
					<ul>
						<li class='active has-sub'><a href="">Contatti</a></li>
					</ul>
				</div>
			</th>

		</tr>

		</th>

		</tr>
		<tr>
			<th colspan="8" style="padding: 0; text-align: center">
				<div id="mostraPagina"></div>
			</th>
		</tr>
		<tr style="background-color: #fc5f1b">
			<td colspan="8" style="height: 60px; text-align: center; padding: 0">
				Tutti i marchi riportati appartengono ai legittimi proprietari;<br>
				marchi, nomi di prodotti, nomi commerciali, corporativi e società
				citati sono stati utilizzati<br> a scopo esplicativo ed a beneficio
				del possessore, senza alcun fine di violazione dei diritti di
				Copyright.
			</td>
		</tr>
		<tr>
			<th
				style="background-color: #8f9296; text-align: center; height: 40px; color: black"
				colspan="8">Easy Learning</th>
		</tr>

	</table>
</body>
</html>
