<?php
require_once '../modelo/Usuarios_modelo.php';
require_once '../modelo/Bitacora_modelo.php';
require_once "../scripts/firephp/lib/FirePHPCore/fb.php";
session_start();
ob_start();
//ACTUALIZAR REGISTRO EXISTENTE DE USUARIO
if (isset($_POST['actualizar'])) {
  $array = [
    "pass" => $_POST['pass'],
    "idusuario" => $_POST['idusuario'],
    "usuario" => $_POST['usuario'],
    "nombre" => $_POST['nombre'],
    "apellido" => $_POST['apellido'],
    "telefono" => $_POST['telefono'],
    "correo" => $_POST['correo'],
  ];
  $usuario = new Usuarios();
  if(!$usuario->actualizarUsuario($array)) {
    echo "<header>";
    echo "<script language='javascript'>"; 
    echo "alert(':) Error al actualizar datos.')"; 
    echo "</script>";  
    echo "<script language='javascript'>window.location='../vista/bienvenida.php.php'</script>;";
    echo "</header>";
  } else {
    echo "<header>";
    echo "<script language='javascript'>"; 
    echo "alert(':) Datos Actualizados Exitosamente.')"; 
    echo "</script>";  
    echo "<script language='javascript'>window.location='../vista/bienvenida.php.php'</script>;";
    echo "</header>";
  }
//AGREGAR UN NUEVO REGISTRO DE USUARIO  
} else if (isset($_POST['agregar'])) {
    $array = [
      "tipousuario" => trim($_POST['tipousuario']),
      "usuario" => trim($_POST['usuario']),
      "iddepartamento" => trim($_POST['iddepartamento']),
      "nombre" => trim($_POST['nombre']),
      "apellido" => trim($_POST['apellido']),
      "pass" => trim($_POST['pass']),
      "telefono" => trim($_POST['telefono']),
      "correo" => trim($_POST['correo']),
    ];
    $usuario = new Usuarios();
  if($usuario->comprobarUsuario($array["usuario"])) {
    echo "<header>";
    echo "<script language='javascript'>"; 
    echo "alert(' Usuario ya existe.')"; 
    echo "</script>";  
    echo "<script language='javascript'>window.location='../vista/IngresarUsuario.php?usuario=" .$array['tipousuario']. "'</script>;";
    echo "</header>";
  } else {
    if(!$usuario->agregarUsuario($array)) {
      echo "<header>";
      echo "<script language='javascript'>"; 
      echo "alert(' Error al registrar usuario.')"; 
      echo "</script>";  
      echo "<script language='javascript'>window.location='../vista/bienvenida.html'</script>;";
      echo "</header>";
    } else {
    //INGRESO DEL REGISTRO A LA BITACORA
      $log = new Bitacora();
      $array = [
      "idusuario" => $_SESSION["idusuario"],
      "detalle" => "El usuario: " .$_SESSION["usuario"]. " agrego el nuevo usuario: " .$_POST['usuario']. "",
      ];
      $log1 = $log->agregarLog($array);
      
      echo "<header>";
      echo "<script language='javascript'>"; 
      echo "alert(' Usuario creado Exitosamente.')"; 
      echo "</script>";  
      echo "<script language='javascript'>window.location='../vista/ListarUsuarios.php'</script>;";
      echo "</header>";
    }
  }
  
}
?>