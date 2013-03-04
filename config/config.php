<?php 
function conectar()
{
	mysql_connect("localhost", "user", "passw");
	mysql_select_db("listasindewert");
}
function desconectar()
{
	mysql_close();
}
?>
