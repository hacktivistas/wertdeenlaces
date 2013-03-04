<?php
# Hacktivistas.net 2012.
# Ley sinde wert - index.php
# If you touch it, you should write the nick and email here:
# fanta 

include_once('config/config.php');

$ip=htmlspecialchars(trim(addslashes(stripslashes(strip_tags($_SERVER["REMOTE_ADDR"])))));
$fecha = date("y/m/d");
$hora = date("H:i:s");
$status= 0;
$navegador=htmlspecialchars(trim(addslashes(stripslashes(strip_tags($_SERVER["HTTP_USER_AGENT"])))));
$code="http://www.wertdeenlaces.net/enlace.php";

# Contar visita
conectar();
mysql_query("INSERT INTO visitas (header, ip, fecha, hora) VALUES ('$navegador', '$ip', '$fecha', '$hora')");
$consultando=mysql_query("SELECT COUNT(*) FROM `visitas`");
$consultando2=mysql_query("SELECT COUNT(*) FROM `descargas`");
$visitas = mysql_fetch_array($consultando);
$descargas = mysql_fetch_array($consultando2);

# BROMA SGAE
$sgae = "195.76.238.3";
$wsgae = "http://www.sgae.es";
if ($ip == $sgae) {
	header("Location: $wsgae");
}

# BROMA PARTIDO POPULAR
$pp = "195.53.184.207";
$wpp = "http://www.pp.es";
if ($ip == $pp) {
	header("Location: $wpp");
}

# Some functions
function esEmailValido($email) # We use this function for check if the email have a valid format 
{
    #if (ereg("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@([_a-zA-Z0-9-]+\.)*[a-zA-Z0-9-]{2,200}\.[a-zA-Z]{2,6}$", $email ) )  deprecate, thx mari ;)
    if (preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", $email) )  
	{
       return true;
    }
	else
	{
       return false;
    }
}

function url_existe($url) # We use this function for check if the url exist
{
   $handle = @fopen($url, "r");

   if ($handle == false)
          return false;

   fclose($handle);
   
   return true;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Wert de enlaces - Lista de webs desobedientes a la ley Sinde-Wert</title>
	<link rel="shortcut icon" href="favicon.ico" />
	<meta name="description" content="Acción de autoinculpación ante la entrada en vigor de la Ley de inquisición Sinde-Wert">
	<link rel="image_src" href="http://www.wertdeenlaces.net/wert.png" />
	<link rel="stylesheet" href="fancybox/jquery.fancybox.css?v=2.0.5" type="text/css" media="screen" />
	<style type="text/css">
		body {
			margin: 0 auto;
			padding: 0;
			text-align: center;
			min-width: 960px;
		}
		img {
			border:0;
		}
		a, a:active, a:focus, a:visited {
			text-decoration:none;
			color:#8f8f8f;
			outline: none;
		}
		#cabecera {
			position: relative;
			background: url('fondo.jpg');
			widht: 100%;
			height: auto;
			border-bottom: 2px solid #000000;
			font: 12px Arial, sans-serif;
			color: #353535;
			zoom: 1;
		}
		#cabecera #logowert {
			position: absolute;
			width: 190px;
			height: 190px;
			bottom: 1px;
			left: 1px;
			z-index: 0;
		}
		#cabecera #pichita {
			display: none;
			position: absolute;
			top: 117px;
			left: 0px;
			z-index: 4;
		}
		#cabecera #logocabeza {
			position: absolute;
			top: 5px;
			left: 117px;
			z-index: 5;
		}
		#introduccion {
			position: relative;
			margin-left: 185px;
			padding-top: 50px;
			text-align: left;
			width: 630px;
			text-align: justify;
			line-height: 120%;
			z-index: 2;
			zoom: 1;
		}
		#introduccion2 {
			position: relative;
			margin-left: 185px;
			padding-top: 15px;
			text-align: left;
			width: 710px;
			text-align: left;
			line-height: 120%;
			z-index: 2;
			zoom: 1;
		}
		#introduccion #compartir {
			position: absolute;
			top: 20px;
			right: 1px;
			z-index: 6;
		}		
		.cosarara {
			background: #383838;
			color: #eeeeee;
			padding: 1px 2px;
			border-radius: 3px;
		}
		.cosararaenlace {
			background: #383838;
			color: #ffffff;
			padding: 1px 2px;
			border-radius: 3px;
		}
		#pestanitas {
			margin-left: 185px;
			margin-top: 20px;
			margin-bottom: 15px;
			width: 630px;
			text-align: right;
			zoom: 1;
		}
		.pestanaenelojo {
			display: inline;
			background: #eeeeee;
			padding: 1px 6px;
			margin-right: 4px;
			color: #595959;
			border: 1px solid #bfbfbf;
			border-radius: 5px;
			font: 14px Consolas, monospace;
			z-index:1000;
		}
		.pestanaenelojo:hover {
			background: #383838;
			color: #eeeeee;
			border: 1px solid #000000;
		}
		.pestanaenelojo2 {
			display: inline;
			margin-left: -13px;
			background: #eeeeee;
			padding: 1px 3px;
			color: #595959;
			border: 1px solid #bfbfbf;
			border-radius: 5px;
			font: 12px Consolas, monospace;
			z-index:1001;
			
		}
		.pestanaenelojo2:hover {
			background: #383838;
			color: #eeeeee;
			border: 1px solid #000000;
		}
		#arriba {
			background: #353535;
			width: 100%;
			height: 5px;
		}
		#contenido {
			background: #353535;
			width: 100%;
			
		}
		#pasos {
			position: relative;
			margin-left: 168px;
			width: 668px;
		}
		#pasos #paso1 {
			position: absolute;
			left: 1px;
			top: -25px;
		}
		#pasos #paso2 {
			position: absolute;
			right: 1px;
			top: 133px;
		}
		#pasosdentro {
			position: relative;
			margin: 0 auto;
			width: 569px;
			color: #eeeeee;
			font: 13px Arial, sans-serif;
		}
		#pasosdentro2 {
			position: relative;
			margin: 0 auto;
			width: 569px;
			color: #000000;
			font: 13px Arial, sans-serif;
		}
		#unop {
			padding-top: 20px;
			text-align: left;
		}
		#dosp {
			padding-top: 30px;
			padding-bottom: 20px;
			text-align: right;
		}
		.titulo {
			display: block;
			font-size: 16px;
			font-weight: bold;
			margin-bottom: 10px;
		}
		.ayhquelio {
			font-weight: bold;
			background: #eeeeee;
			color: #383838;
			padding: 1px 2px;
			border-radius: 3px;
		}
		#elenlace {
			display: block;
			background: #444444;
			border-radius: 3px;
			color: #EEEEEE;
			font: 12px Consolas,Courrier,monospace;
			margin-bottom: 5px;
			margin-top: 8px;
			padding: 5px 10px;
			width: 87%
		}
		#llevatelo {
			display: block;
			height: 33px;	
			width: 90%;
			border: 1px solid #444444;
		}
		#inputurl, #inputemail {
			widht: 40px;
			border: 1px solid #000000;
			border-radius: 3px;
		}
		#inputenviar {
			margin-top: 5px;
			background: #454545;
			color: #eeeeee;
			font: 12px, Arial, sans-serif;
			border: 1px solid #000000;
			border-radius: 3px;
		}
		.advertencia {
			display: inline;
			background: #c94141;
			color: #eeeeee;
			font: 11px Arial, sans-serif;
			padding: 1px 3px;
			border: 1px solid #000000;
			border-radius: 3px;
		}
		#nada {
			display: block;
			width: 100%;
			text-align: left;
			font: 11px Arial, sans-serif;
			color: #6b6b6b;
		}
		.ayhquelio2 {
			display: inline;
			background: #dbdbdb;
			padding: 1px 2px;
			border-radius: 3px;
		}
		#piedepagina {
			width: 100%;
			height: 100%;
			margin-top: 20px;
			padding: 10px 0px;
			background: #f9f9f9;
			color: #6b6b6b;
			font: 11px Arial, sans-serif;
			text-align: left;
		}
		.web {
			font: 12px Consolas, Courrier, monospace;
		}
		.demo {
			color: #8f8f8f;
		}
		#escondite {
			display: none;
		}
		.leamas {
			background: #eeeeee;
			padding: 0px 2px;
			color: #8f8f8f;
			border: 1px solid #bfbfbf;
			border-radius: 5px;
			font: 11px Consolas, monospace;
			cursor: pointer;			
		}
		#frmsol {
			display: none;
		}
	</style>

</head>
<body>
	<div id="arriba"></div>
	<div id="cabecera">
		<a href="http://www.wertdeenlaces.net" ><img src="wert.png" id="logowert" alt="wert" /></a>
		<!--<a href="http://www.wertdeenlaces.net" ><img src="pichita.png" id="pichita" alt="poyita" /></a>-->
		<a href="http://www.wertdeenlaces.net" ><img src="logocabeza.png" id="logocabeza" alt="wertdeenlaces.net" /></a>
		<div id="introduccion">
			<div id="compartir">
				<a href="http://www.identi.ca/index.php?action=newnotice&amp;status_textarea=http%3A%2F%2Fwww.wertdeenlaces.net%20-%20Wert%20de%20enlaces%20-%20Lista%20de%20webs%20desobedientes%20a%20la%20ley%20Sinde-Wert,%20¡Únete%20a%20la%20%23opwert!%20via%20%40Hacktivistas" rel="nofollow" target="_blank" title="Compartir en identi.ca"><img src="identica.png" alt="Compartir en identi.ca" /></a>
				<a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fwww.wertdeenlaces.net" rel="nofollow" target="_blank"  title="Compartir en facebook"><img src="facebook.png" title="Compartir en facebook" /></a>
				<a href="https://twitter.com/intent/tweet?text=http%3A%2F%2Fwww.wertdeenlaces.net%20-%20Wert%20de%20enlaces%20-%20Lista%20de%20webs%20desobedientes%20a%20la%20ley%20Sinde-Wert,%20¡Únete%20a%20la%20%23opwert!%20via%20%40Hacktivistas" rel="nofollow" target="_blank"  title="Compartir en twitter"><img src="twitter.png" title="Compartir en twitter" /></a>
				<a href="https://plus.google.com/share?url=http%3A%2F%2Fwww.wertdeenlaces.net" rel="nofollow" target="_blank"  title="Compartir en google plus"><img src="googlemas.png" title="Compartir en google +" /></a>
			</div>
			
			<p><b><span class="cosarara">¡Pretenden ignorarnos!</span></b> <i>22 de abril de 2012</i></p>
			
			<p>Esta vez te pedimos que <a class="cosararaenlace muestrameform" href="#form">rellenes este formulario</a> y lo hagas llegar a la Administración.
			Después de casi 2 meses de hacerse efectiva la ley Sinde-Wert sólo ha servido para gastar dinero del contribuyente.
			Como ciudadano tienes el derecho a conocer el estado de la tramitación de los procedimientos en los que tengas la condición de interesado, así como identificar al personal que lo está tramitando. No pueden hacer oídos sordos. <span class="leamas">Leer Más↓</span></p>
			
			<!-- FORMULARIO MODELO -->			
			<div id="frmsol">
				<p><span class="cosarara">Reclama tus derechos!</span></p>
				A Hacktivistas.net no le interesan tus datos personales y no los almacenamos.<br>
				De cualquier modo, puedes descargar el modelo y rellenar los campos tú mismo ;-)<br>
				Una vez impreso, podrás entregarlo en cualquier oficina de registro de tu Comunidad Autónoma.<br>
				<b><a href="http://www.060.es/060/appmanager/portal/desktop?_nfpb=true&_pageLabel=mostrarFichacontactar_oficinas&idContenido=057313&fia=oficinas060ContactarAdministracion&fia=oficinas060ContactarAdministracion">Consulta el listado de sedes y encuentra la más cercana aquí</a></b><br /><br />
				
					  <form action="solicitud.php" method="POST">
						  <table>
							<tr>
								<td align="right">Nombre</td>
								<td><input type="text" name="nombre" /></td>
							</tr>
							<tr>
								<td align="right">Domicilio</td>
								<td><input type="text" name="domicilio" /></td>
							</tr>
							<tr>
								<td align="right">Ciudad</td>
								<td><input type="text" name="ciudad" /></td>
							</tr>
							<tr>
								<td align="right">Teléfono</td>
								<td><input type="text" name="tlf" /></td>
							</tr>
							<tr>
								<td align="right">E-mail</td>
								<td><input type="text" name="email" /></td>
							</tr>
							<tr>
								<td align="right">NIF</td>
								<td><input type="text" name="nif" /></td>
							</tr>
							<tr>
								<td align="right">Web</td>
								<td><input type="text" name="web" /></td>
							</tr>
							<tr>
								<td></td>
								<td><input type="submit" value="Descarga el modelo"/></td>
							</tr>
						  </table>
					  </form>
			</div>
			<!-- FIN FORMULARIO MODELO -->
			
			
			
			
			
			

			<div id="escondite">
				<p><b><span class="cosarara">¡Misión completa!</span></b> <i>1 de marzo de 2012</i></p>
				<p><u><a href="http://hacktivistas.net/content/entra-en-vigor-la-ley-sinde-wert-contra-la">Sí, lo hemos hecho</a></u>. El 1 de marzo, <a href="https://twitter.com/#!/emenavarro">Eme Navarro</a> denunció las 250 webs que se habían unido hasta ese momento. Fue la primera denuncia usando la ley Sinde-Wert, nos hemos adelantado incluso al <i>enemigo ;-)</i><br>Estamos recibiendo más adhesiones y seguramente hagamos una segunda ronda de denuncias con las nuevas webs desobedientes.</p>
	
				<p><b><span class="cosarara">Ya</span> somos <a href="http://wertdeenlaces.net/index.php?lista" title="la lista">cientos de personas</a> las que hemos decidido desobedecer a la <a href="http://alt1040.com/2011/01/que-es-la-ley-sinde" title="que es la ley sinde" rel="nofollow" target="_blank">Ley Sinde-Wert</a></b>. Esta ley fue creada por la industria cultural y los lobbies norteamericanos para cerrar a su antojo cualquier página web (con o sin ánimo de lucro) que contenga enlaces a obras culturales. Dicha ley permite a una comisión (cuyos componentes no conocemos aún)  <i>ejercer un poder sin precedentes sobre Internet, sin garantías judiciales y en contra de las sentencias firmes dictadas por los jueces españoles que han sobreseído los casos de páginas de enlaces afirmando que no constituyen delito</i>.</p>
	
				<p><b>Tú también puedes unirte a esta lista de webs desobedientes</b>. Sólo tienes que compartir el enlace que ponemos a tu disposición más abajo. <a href="http://derechoynormas.blogspot.com/2012/02/cuando-empezaran-los-primeros-cierres.html" title="maeztu y cierres" rel="nofollow" target="_blank">El día 1 de marzo</a> (día en que entra en vigor la ley), a primera hora de la mañana, el autor de dicha obra se ha comprometido a presentar una denuncia a todas las webs de esta lista. Poniendo nuestras páginas en primera fila de forma conjunta y coordinada conseguiremos evidenciar los peligros de esta ley y al mismo tiempo demostrar su ineficacia. <b>Seremos la primera línea de choque de una ley diseñada por y para una industria obsoleta</b> que impide el surgimiento de otras formas de producción-distribución cultural y que amenaza la libertad en la red. Internet quiere ser libre y lo será.</p>

				<p>Únete a la lista desobediente siguiendo estos dos pasos (recibirás un mail de confirmación): </p>
			</div>			

		</div>
		<div id="pestanitas">
			<a class="pestanaenelojo" href="index.php?lista"><b>L</b>a lista de Sinde-Wert</a>
			<a class="pestanaenelojo" href="enlace.php" target="_blank"><b>D</b>escargar obra</a> <sup><a href="http://www.youtube.com/embed/0qadT4fxfwQ?autoplay=1" id="aframe" title="Video Clip Eme Navarro - Nobody's death" class="pestanaenelojo2 fancybox.iframe">vc</a></sup>
			<a class="pestanaenelojo" href="privacy.php" target="_blank"><b>P</b>rivacidad</a>
			<a class="pestanaenelojo" href="https://n-1.cc/mod/threaded_forums/topicposts.php?topic=1177953&group_guid=1177380" target="_blank"><b>F</b>AQ</a>
			<a class="pestanaenelojo muestrameform" href="#form"><b>M</b>odelo</a>
			<a class="pestanaenelojo" href="http://foro.wertdeenlaces.net" target="_blank"><b>+</b></a>
		</div>
	</div>


	<div id="contenido">
		<div id="pasos">
			<img src="paso1.png" id="paso1" alt="Paso 1" />
			<img src="paso2.png" id="paso2" alt="Paso 2" />
			<div id="pasosdentro">
				<div id="unop">
					<span class="titulo"><span class="ayhquelio">C</span>opie o comparta esta url en su web o red para enlazar a la obra↓</span>
					<div id="elenlace"><img src="labios.png" style="vertical-align: middle;" alt="labioswert" /> http://www.wertdeenlaces.net/enlace.php</div>
					<textarea id="llevatelo"><a href="http://www.wertdeenlaces.net" title="wertdeenlaces.net"><img src="http://wertdeenlaces.net/labios.png" style="vertical-align:middle;border:0;" alt="labioswert" /></a> <a href="http://www.wertdeenlaces.net/enlace.php" style="text-decoration:none;color:#383838;font:10px Consolas,Courrier,monospace;">Bájame</a></textarea>
					<br />
					<a href="http://identi.ca/index.php?action=newnotice&amp;status_textarea=http%3A%2F%2Fwww.wertdeenlaces.net%2Fenlace.php" rel="nofollow" target="_blank" title="Enlazar en identi.ca"><img src="identicag.png" id="identica" alt="Enlazar en identi.ca" /></a>
					<a href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fwww.wertdeenlaces.net%2Fenlace.php" rel="nofollow" target="_blank"  title="Enlazar en facebook"><img src="facebookg.png" id="facebook" alt="Enlazar en facebook" /></a>
					<a href="http://twitter.com/intent/tweet?text=http%3A%2F%2Fwww.wertdeenlaces.net%2Fenlace.php&amp;hashtags=opwert" rel="nofollow" target="_blank"  title="Enlazar en twitter"><img src="twitterg.png" id="twitter" alt="Enlazar en twitter" /></a>
					<a href="https://plus.google.com/share?url=http%3A%2F%2Fwww.wertdeenlaces.net%2Fenlace.php" rel="nofollow" target="_blank"  title="Enlazar en google plus"><img src="googlemasg.png" id="googlemas" alt="Enlazar en google +" /></a>
					<a href="http://www.tuenti.com/share?url=http%3A%2F%2Fwww.wertdeenlaces.net%2Fenlace.php" rel="nofollow" target="_blank"  title="Enlazar en tuenti"><img src="tuentig.png" id="tuenti" alt="Enlazar en tuenti" /></a>
				</div>
				<div id="dosp">
					<span class="titulo"><span class="ayhquelio">R</span>ellena el formulario para formar parte de la lista de Sinde-Wert↓</span>
					
						<form action="." method="POST">
							<?php
							if (isset($_POST['url'])) {
								$_POST['url'] = htmlspecialchars(trim(addslashes(stripslashes(strip_tags($_POST['url']))))); # never say never
								$_POST['email'] = htmlspecialchars(trim(addslashes(stripslashes(strip_tags($_POST['email']))))); # never say never
							
								if ($_POST['url'] == null) 	{
									echo "<b class=\"advertencia\">Por favor, introduzca una web</b><br />";
								}else{
									$url = $_POST['url'];
									
									# Otherwise url_existe() fails
									if (substr($url, 0, 7) != "http://")
									{
											$url = "http://" . $url;
									}
   
									if (url_existe($url)) # If the url is online
									{
										
										$shit=mysql_query("SELECT * FROM `webs` WHERE url='$url'");
										$nrows = mysql_num_rows($shit);
										
										if ($nrows == null) # If the url was in db.
										{
											# This fixes bug with dynamic templates, forcing it to use static content.
											if (strstr($url, "blogspot.com"))
											{
												$url = $url . '?v=0';
											}
											
											$s = file_get_contents("$url");
											if (ereg($code,$s)) # if the link still in the url
											{
												if ($_POST['email'] == null) # If the email is null
												{
													echo "<b class=\"advertencia\">El email es necesario para contactarte.</b><br />";
												}else{ # the email is not null
													$statusmail = esEmailValido($_POST[email]);
													if ($statusmail == 1) # if the email format is proper
													{
														
														$consulta=mysql_query("INSERT INTO webs (url, email, ip, fecha, hora, status) VALUES ('$_POST[url]', '$_POST[email]', '$ip', '$fecha', '$hora', '$status')");
														
																
														$to      = "$_POST[email]";
														$subject = "Gracias por enviarnos el enlace - wertdeenlaces";
														$message = 'En enlace nos ha llegado y va a ser revisado. Gracias :). Si quieres entrar a formar parte del debate te invitamos a hacerlo en http://foro.wertdeenlaces.net';
														$headers = 'From: wert-de-enlaces---lista-de-webs-desobedientes-a-la-ley-sinde-wert@grupos.n-1.cc' . "\r\n" .
														'Reply-To: wert-de-enlaces---lista-de-webs-desobedientes-a-la-ley-sinde-wert@grupos.n-1.cc' . "\r\n" .
														'X-Mailer: PHP/' . phpversion();
														utf8_encode($subjet);
														$message = utf8_encode($message);
														$message = utf8_decode($message);
														mail($to, $subject, $message, $headers);
														
														
														echo "<b class=\"advertencia\">Gracias. Hemos de revisar la url por lo que puede tardar en aparecer</b><br />";
													}else{ # the email is not proper :(, sorry mate
														echo "<b class=\"advertencia\">Error al introducir el email. Formato erróneo</b><br />";
													}		
												}
																			
											}else{ # when the link is not exist in the url
												echo "<b class=\"advertencia\">Lo sentimos pero no hemos encontrado el enlace a la obra en la URL especificada :(</b><br />";
											}
												
										}else{ # the url was inside
											echo "<b class=\"advertencia\">¡Tu web ya está incluída en la lista!</b><br />";
										}
										
									}else{ # the url is not online
										echo "<b class=\"advertencia\">La URL no existe, es incorrecta o no puede accederse a ella en estos momentos.</b><br />";
									}
								}
							}
						?>
						Web donde has enlazado a la obra <input name="url" type="text" maxlength="290" id="inputurl" value="http://">
						<br />
						Correo electrónico <input name="email" type="text"  maxlength="150" id="inputemail">
						<br />
						<input type="submit" value="Añadir web a la lista" id="inputenviar">
					</form>
					
					
				</div>
			</div>	
		</div>
	</div>


<div id="nada">
	

		

<?php
if (isset($_GET['lista'])) {	
	# LISTA DE SINDE WERT
	$shit=mysql_query("SELECT * FROM `webs` WHERE status=1");
	$nrows = mysql_num_rows($shit);
	echo "<div id=\"introduccion2\">";
	echo "<p><span class=\"cosarara\"><b>Lista de Sinde-Wert ($nrows):</b></span></p>";
	while ($row=mysql_fetch_array($shit)) {
		$web = "$row[1]";
		echo "<img src=\"http://wertdeenlaces.net/labiosg.png\" style=\"vertical-align:middle;\"> <a href=\"$web\" class=\"web\">$web</a><br />";
	}
	echo "</div>";
}
else{
	# INDEX
	?>
	<img src="contactoh.png" alt="mailto" style="vertical-align:middle;" />
	<?php
	
	$shit=mysql_query("SELECT COUNT(*) FROM `webs` WHERE status=1");
	$nrows = mysql_fetch_array($shit);

	echo "<span class=\"ayhquelio2\">$nrows[0]</span> webs en la lista ";
	echo "<span class=\"ayhquelio2\">$visitas[0]</span> visitas ";
	echo "<span class=\"ayhquelio2\">$descargas[0]</span> descargas de la obra ";
	
	echo '<p><a href="http://www.diagonalperiodico.net/IMG/pdf/manual_desobediencia.pdf" title="Descarga el Manual desobediencia ley Sinde" id="manual"><b>Manual de desobediencia a la ley Sinde</b><br /><img src="manualdesg.png" alt="manual desobediencia ley sinde" id="cambio" /></a></p>';
}
?>

<!-- fin nada -->
</div>

<div id="piedepagina">
	Copyleft 2012 <a href="http://hacktivistas.net" title="http://hacktivistas.net">Hacktivistas.Net</a> bajo licencia <a href="http://creativecommons.org/licenses/by-sa/3.0/"  title="http://creativecommons.org/licenses/by-sa/3.0/" >CC-by-sa</a> y <a href="http://www.gnu.org/copyleft/fdl.html"  title="http://www.gnu.org/copyleft/fdl.html" >GFDL</a>:
	<br /> 
	Eres <b>libre</b> de copiar, modificar y distribuir el contenido de esta web, como te dé la gana.
	

	<div class="demo">
		<marquee behavior="scroll" direction="left" scrollamount="1" width="350" speed="0">
		<p>
				<?php
				desconectar();
				$xmlblog = simplexml_load_file("https://www.n-1.cc/pg/groups/1177380/wert-de-enlaces-lista-de-webs-desobedientes-a-la-ley-sindewert/?view=rss"); 
				for($i=0;$i<=4;$i++) {
					$titulin = $xmlblog->channel->item[$i]->title;	
					$enlacelink = $xmlblog->channel->item[$i]->link;
					echo '<a href="'. $enlacelink .'" target="_blank">'. $titulin .'</a> | ';
				}
		
				?>		
		</p>
		</marquee>
	</div>
<!--fin pie-->
</div>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="fancybox/jquery.fancybox.pack.js?v=2.0.5"></script>
<script type="text/javascript" src="jquery.marquee.js"></script>
<script type="text/javascript">
	$(document).ready( function() {
		//$('#logowert').mouseover(function() {
			//$('#pichita').show();
		//});
		//$('#logowert').mouseout(function() {
			//$('#pichita').hide();
		//});
		//$('#pichita').mouseover(function() {
			//$('#pichita').show();
		//});
		$('#manual').mouseover(function() {
			$('#cambio').attr('src','manualdesc.jpg');
		});
		$('#manual').mouseout(function() {
			$('#cambio').attr('src','manualdesg.png');
		});
		$("#identica, #facebook, #twitter, #googlemas, #tuenti").mouseover(function() {
				var joselito = $(this).attr('id');
				$(this).attr("src",joselito+'.png');
			});
		$("#identica, #facebook, #twitter, #googlemas, #tuenti").mouseout(function() {
				var joselito = $(this).attr('id');
				$(this).attr("src",joselito+'g.png');
			});
		$('div.demo marquee').marquee('pointer').mouseover(function () {
			$(this).trigger('stop');
		}).mouseout(function () {
			$(this).trigger('start');
		}).mousemove(function (event) {
			if ($(this).data('drag') == true) {
				this.scrollLeft = $(this).data('scrollX') + ($(this).data('x') - event.clientX);
			}
		}).mousedown(function (event) {
			$(this).data('drag', true).data('x', event.clientX).data('scrollX', this.scrollLeft);
		}).mouseup(function () {
			$(this).data('drag', false);
		});
		
		$("#aframe").fancybox();
		
		$('.leamas').click(function() {
			$('#escondite').slideDown();
			$(this).hide();
		});
		$('.muestrameform').click(function() {
			$('#frmsol').slideDown();
		});
		
					
	});
</script>
<!-- Start of StatCounter Code for Default Guide -->
<script type="text/javascript">
var sc_project=7682066; 
var sc_invisible=1; 
var sc_security="5a89d2b5"; 
</script>
<script type="text/javascript"
src="http://www.statcounter.com/counter/counter.js"></script>
<noscript><div class="statcounter"><a title="tumblr
tracker" href="http://statcounter.com/tumblr/"
target="_blank"><img class="statcounter"
src="http://c.statcounter.com/7682066/0/5a89d2b5/1/"
alt="tumblr tracker"></a></div></noscript>
<!-- End of StatCounter Code for Default Guide -->

<!-- Piwik -->
<script type="text/javascript">
var pkBaseURL = (("https:" == document.location.protocol) ? "https://www.wertdeenlaces.net/pywik/" : "http://www.wertdeenlaces.net/pywik/");
document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
</script><script type="text/javascript">
try {
var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 2);
piwikTracker.trackPageView();
piwikTracker.enableLinkTracking();
} catch( err ) {}
</script><noscript><p><img src="http://www.wertdeenlaces.net/pywik/piwik.php?idsite=2" style="border:0" alt="" /></p></noscript>
<!-- End Piwik Tracking Code -->

</body>
</html>
