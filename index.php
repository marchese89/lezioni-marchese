<?php
session_cache_limiter('nocache');
session_start();
include 'acquisti/carrello.php';
include 'config/mysql-config.php';


if (empty($_SESSION['carrello'])) {
    $_SESSION['carrello'] = new Carrello();
}

$pagina_interna = filter_input(INPUT_GET, "pagina");

if (!empty($_SESSION['user']) && $_SESSION['user'] !== 'admin' && $pagina_interna === 'amministrazione/admin.php') {
    header("Location: index.html");
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Easy Learning</title>

<meta charset="UTF-8">


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

<link href="fogliCSS/home.css?ts=<?=time()?>&quot" rel="stylesheet"
	type="text/css">
<link href="fogliCSS/menu.css?ts=<?=time()?>&quot" rel="stylesheet"
	type="text/css">
<link href="fogliCSS/pagina_login.css?ts=<?=time()?>&quot"
	rel="stylesheet" type="text/css">
<script type="text/javascript" src="script/jquery-2.1.1.js"></script>
<script type="text/javascript"
	src="script/validazione_campi/livevalidation_standalone.compressed.js"></script>
<script type="text/javascript" src="script/ajax/metodi_ajax.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body>

	<div id="cookie">
		<br> Questo sito utilizza i cookie tecnici (indispensabili per il suo
		corretto funzionamento). <br> &Eacute; presente una pagina con
		ulteriori dettagli: <br> (<a href="cookiepolicy.html">leggi
			informativa completa</a>)<br> continuando la navigazione si accetta
		l'utilizzo dei cookie<br>
		<button onclick="accettaCookie()">Chiudi</button>

	</div>

	<table
		style="vertical-align: middle; white-space: nowrap; margin-right: auto; z-index: 1; top: 0; width: 100%; border-width: 0; border-spacing: 0;">
		<tr style="background-color: #e1e1e1">
			<td colspan=2></td>
			<td align=right>
			<?php
if (empty($_SESSION['user'])) {
    ?>
    <a href="login.html" class="collegamento"><b>Accedi</b></a>|<a href="registrati.html" class="collegamento"><b>Registrati</b></a>
   <?php
} else {
    if ($_SESSION['user'] !== "admin") {
        ?>
        <a href="home-user.html"><b>Il mio profilo</b></a>|<a href="amministrazione/logout.php" class="collegamento"><b>Logout</b></a>
        <?php
    } else {
        ?>
        <a href="index.php?pagina=amministrazione/admin.php"><b>Il mio profilo</b></a>|<a href="amministrazione/logout.php" class="collegamento"><b>Logout</b></a>
        <?php
    }
}
?>
		</td>
		</tr>
		<tr style="background-color: #e1e1e1">
			<td style="margin-left: 0; align: center;"><a href="index.html"><img
					src="images/logo.png" width="600" height="100" title="Home Page"
					alt="img"></a></td>
			<td></td>
			<th style="font-size: 18pt;">
				<div id="cssmenu">
					<ul>
						<li class='active has-sub'><a href="">Corsi</a>
							<ul>
								<li align=left><a href="">Scuole Superiori</a></li>
								<li align=left><a href="">Università</a></li>
								<li align=left><a href="">Corsi Extra</a></li>
							</ul></li>
					</ul>
					<ul>
						<li class='active has-sub'><a href="">Lezioni online</a></li>
					</ul>
					<ul>
						<li class='active has-sub'><a href="">Esercizi</a>
							<ul>
								<li align=left class='active has-sub'><a href="">Esercizi Svolti</a></li>
								<li align=left><a href="">Svolgimento Esercizi</a></li>
								<li align=left><a href="">Correzione Esercizi svolti</a></li>
							</ul></li>
					</ul>
					<ul>
						<li><a href="">Recensioni</a></li>
					</ul>
					<ul>
						<li><a href="lavora-con-noi.html">Lavora con noi</a></li>
					</ul>
					<ul>
						<li><a href="">Chi Siamo</a></li>
					</ul>
					<ul>
						<li><a href="">Contatti</a></li>
					</ul>
				</div>
			</th>

		</tr>

		<tr>
			<th colspan=3>


				<div id="mostraPagina" style="padding: 0; text-align: center">
				<?php
    if (empty($pagina_interna)) {
        $pagina_interna = 'home.php';
    }
    try {
        include $pagina_interna;
    } catch (Exception $e) {}
    ?>
                </div>
			</th>
		</tr>
		<tr>
		
		
		<tr>
			<th colspan=3
				style="background-color: #8f9296; height: 30px; display: none"><b>Easy
					Learning</b></th>
		</tr>
	</table>
</body>
</html>
