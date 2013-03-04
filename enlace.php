<?php
include_once 'config/config.php';

$ip=$_SERVER["REMOTE_ADDR"];
$fecha = date("y/m/d");
$hora = date("H:i:s");
$navegador=$_SERVER["HTTP_USER_AGENT"];

conectar();
mysql_query("INSERT INTO descargas (header, ip, fecha, hora) VALUES ('$navegador', '$ip', '$fecha', '$hora')");
desconectar();

#HAN BORRADO CASI TODOS LOS MIRRORS.
#$vector = array(
#"http://www.4shared.com/mp3/4S9IuEzu/Nobodys_death_v3.html",
#"http://dl.dropbox.com/u/14898833/Nobody%27s%20death%20v3.mp3",
#"http://www.mediafire.com/?6q1t27dvt2yqe1d",
#"http://bayfiles.com/file/3dsn/olrEKI/Eme_Navarro_-_Nobody%27s_death.mp3",
#"https://rs743tl3.rapidshare.com/#!download|743tl3|676115796|1.zip|8899|R~BE0940801903431524A12CC99814A09F|0|0",
#"http://fileserve.com/file/ZXPR3Nr/1.zip",
#"http://wikisend.com/download/425536/Nobodys-death.mp3",
#"http://uploadmirrors.com/download/0X9JRZWN/Nobody_s_death_v3.mp3",
#"http://uploadmirrors.com/download/0UZ9ZJ18/Nobody_s_death_v3_0.mp3",
#"http://uploadmirrors.com/download/8RS0H8SY/Nobody_s_death_v3_1.mp3",
#"http://www.uploading.to/8xot2ytqcn0l",
#"http://www.uploading.to/33sv4nu4uerh",
#"http://uploadmirrors.com/download/0CDMQOCD/91.zip",
#"http://www.uploading.to/t95qtosiluro",
#"http://www.uploading.to/gn0gqu4yshi9",
#"http://uploadmirrors.com/download/0UNBQ2AS/o1.zip",
#"http://uploadmirrors.com/download/0HGTUMDM/v2.zip",
#"http://www.uploading.to/50qcygrlcjhm",
#"http://uploadmirrors.com/download/W1MLHAJA/b3.zip",
#"http://www.uploading.to/p0mlx3toy5rj",
#"http://uploadmirrors.com/download/0LLGIBKE/o4.zip",
#"http://www.uploading.to/u4n5facsdf2e",
#"http://uploadmirrors.com/download/XC0AG0YZ/Nobody_s_death_v3.zip"
#); 

# Ya no hace falta actualizar esto
#$numero = rand(0,sizeof($vector)-1);

#header("Location: $vector[$numero]");
#header("Location: $vector[1]");
#header("Location: http://wikisend.com/download/425536/Nobodys-death.mp3");
header("Location: Nobodysdeath.mp3");

?>
