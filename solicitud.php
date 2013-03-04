<?php

	function date2mes($n) {
		switch($n)
		{
		   case "1":
			  return "enero";
		   case "2":
			  return "febrero";
		   case "3":
			  return "marzo";
		   case "4":
			  return "abril";
		   case "5":
			  return "mayo";
		   case "6":
			  return "junio";
		   case "7":
			  return "julio";
		   case "8":
			  return "agosto";
		   case "9":
			  return "septiembre";
		   case "10":
			  return "octubre";
		   case "11":
			  return "noviembre";
		   case "12":
			  return "diciembre";
		} 
	}

	if (isset($_POST["nombre"]) && (strlen($_POST["nombre"]) > 0))
		$nombre = $_POST["nombre"];
	else
		$nombre = "____(nombre completo)____";
		
	if (isset($_POST["domicilio"]) && (strlen($_POST["domicilio"]) > 0))
		$domicilio = $_POST["domicilio"];
	else
		$domicilio = "____(domicilio completo)____";
	
	if (isset($_POST["tlf"]) && (strlen($_POST["tlf"]) > 0))
		$tlf = $_POST["tlf"];
	else
		$tlf = "____(telefono)____";
	
	if (isset($_POST["email"]) && (strlen($_POST["email"]) > 0))
		$email = $_POST["email"];
	else
		$email = "____(email)____";
	
	if (isset($_POST["nif"]) && (strlen($_POST["nif"]) > 0))
		$nif = $_POST["nif"];
	else
		$nif = "____(NIF)____";
	
	if (isset($_POST["web"]) && (strlen($_POST["web"]) > 0))
		$web = $_POST["web"];
	else
		$web = "____(web)____";
		
	if (isset($_POST["ciudad"]) && (strlen($_POST["ciudad"]) > 0))
		$ciudad = $_POST["ciudad"];
	else
		$ciudad = "____(ciudad)____";
	
	$contacto = $tlf . " / " . $email; 
	
	$diadenuncia = mktime(0, 0, 0, 3, 1, 2012);
	$hoy = mktime(4, 0, 0, date("n"), date("j"), date("Y"));
	$dias = floor(abs(($diadenuncia - $hoy) / (60 * 60 * 24)));
	$mes = date2mes(date("n"));
	$fecha_hoy = date("j") . " de " . $mes . " de " . date("Y");
	
	$formfile = "reclama/automodelo.odt";
	$tmpfname = tempnam("/tmp", "formwert");
	
	if (!copy($formfile, $tmpfname)) {
		echo "Error creando archivo temporal\n";
		return;
	} 
	
	$za = new ZipArchive();	
	$za->open($tmpfname);
	
	$xmlcontent = $za->getFromName("content.xml");

	$xmlcontent = str_replace("%NOMBRE%", $nombre, $xmlcontent);
	$xmlcontent = str_replace("%DIRECCION%", $domicilio, $xmlcontent);
	$xmlcontent = str_replace("%CONTACTO%", $contacto, $xmlcontent);
	$xmlcontent = str_replace("%NIF%", $nif, $xmlcontent);
	$xmlcontent = str_replace("%WEB%", $web, $xmlcontent);
	$xmlcontent = str_replace("%DIAS%", $dias, $xmlcontent);
	$xmlcontent = str_replace("%FECHAHOY%", $fecha_hoy, $xmlcontent);
	$xmlcontent = str_replace("%CIUDAD%", $ciudad, $xmlcontent);

	$za->deleteName("content.xml");
	$za->addFromString("content.xml", $xmlcontent);

	$za->close();

	header('Content-disposition: attachment; filename=wertdeenlaces_modelo.odt');
	header('Content-type: application/vnd.oasis.opendocument.text');
	readfile($tmpfname);
	unlink($tmpfname);
?>

