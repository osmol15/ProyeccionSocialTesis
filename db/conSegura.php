<?php
function conectar()
{
	mysql_connect("localhost", "root", "");
	mysql_select_db("serviciosocialues");
}

function desconectar()
{
	mysql_close();
}
?>