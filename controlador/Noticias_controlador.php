<?php
require_once '../modelo/Noticias_modelo.php';
require_once "../scripts/firephp/lib/FirePHPCore/fb.php";
ob_start();
//ACTUALIZAR UN REGISTRO DE NOTICIA EXISTENTE EN LA BASE DE DATOS
if (isset($_POST['actualizar'])) {
  $array = [
    "titulo" => trim($_POST['titulo']),
    "detalle" => trim($_POST['detalle']),
    "idnoticia" => trim($_POST['idnoticia']),
  ];
  $noticia = new Noticias();
  if(!$noticia->actualizarNoticia($array)) {
    echo "<header>";
    echo "<script language='javascript'>"; 
    echo "alert('Hubo un error al actualizar la noticia.')"; 
    echo "</script>";  
    echo "<script language='javascript'>window.location='../vista/ListarNoticias.php'</script>;";
    echo "</header>";
  } else {
    echo "<header>";
    echo "<script language='javascript'>"; 
    echo "alert(' Datos Actualizados Exitosamente.')"; 
    echo "</script>";  
    echo "<script language='javascript'>window.location='../vista/ListarNoticias.php'</script>;";
    echo "</header>";
  }
  //AGREGAR UN NUEVO REGISTRO DE NOTICIA A LA BASE DE DATOS
} else if (isset($_POST['agregar'])) {
    $array = [
      "titulo" => trim($_POST['titulo']),
      "detalle" => trim($_POST['detalle']),
      "fecha" => trim($_POST['fecha']),
      "usuario" => trim($_POST['usuario']),
      "departamento" => $_POST['departamento'],
    ];
    $noticia = new Noticias();
    if(!$noticia->agregarNoticia($array)) {
      echo "<header>";
      echo "<script language='javascript'>"; 
      echo "alert(' Error al agregar noticia.')"; 
      echo "</script>";  
      echo "<script language='javascript'>window.location='../vista/ListarNoticias.php'</script>;";
      echo "</header>";
    } else {
      echo "<header>";
      echo "<script language='javascript'>"; 
      echo "alert(' Noticia creada exitosamente.')"; 
      echo "</script>";  
      echo "<script language='javascript'>window.location='../vista/ListarNoticias.php'</script>;";
      echo "</header>";
    }
    //ELIMINAR UN REGISTRO DE NOTICIA DE ACUERDO A SU ID
  } else if (isset($_GET['delete_id'])) {
    $idnoticia = $_GET['delete_id'];
    $noticia = new Noticias();
    if(!$noticia->borrarNoticia($idnoticia)) {
      echo "<header>";
      echo "<script language='javascript'>"; 
      echo "alert(' Hubo un problema al intentar borrar la noticia.')"; 
      echo "</script>";  
      echo "<script language='javascript'>window.location='../vista/ListarNoticias.php'</script>;";
      echo "</header>";
    } else {
      echo "<header>";
      echo "<script language='javascript'>"; 
      echo "alert(' Noticia borrada con exito.')"; 
      echo "</script>";  
      echo "<script language='javascript'>window.location='../vista/ListarNoticias.php'</script>;";
      echo "</header>";
    }
  }
?> 
