<?php
/**
 * connection settings
 * replace with your own hostname, database, username and password 
 */


error_reporting(0);

$hostname_conn = "127.0.0.1"; //direccion  del servidor
$database_conn = "serviciosocialues"; //nombre de la base de datos
$username_conn = "root";// usuario de db
$password_conn = "root";//contraseÃ±a de db

if(!$conn){
	$conn = mysql_connect($hostname_conn, $username_conn, $password_conn) or trigger_error(mysql_error(),E_USER_ERROR);
        
}
mysql_select_db($database_conn, $conn);