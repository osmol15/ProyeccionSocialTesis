<?php
require_once '../modelo/Peticiones_modelo.php';
require_once '../modelo/Bitacora_modelo.php';
session_start();
//AGREGA UNA NUEVA PETICION A LA BASE DE DATOS
if(isset($_POST['agregar'])) {
//PETICION CON RESPALDO
  if(is_uploaded_file($_FILES['fichero']['tmp_name'])) {
  if($_FILES['fichero']['size'] > 512000) {
    echo "<header>";
    echo "<script language='javascript'>"; 
    echo "alert('El archivo de respaldo excede los 512kb.')"; 
    echo "</script>";  
    echo "<script language='javascript'>window.location='../vista/AgregarPeticion.php'</script>;";
    echo "</header>";
  } else {
    $ruta = "../documentos/peticiones/".$_POST['nombreproyecto']."_".$_POST['fecha'];
    move_uploaded_file($_FILES['fichero']['tmp_name'],$ruta);
     $array = [
    "tipoproyecto" => $_POST['tipoproyecto'],
    "institucion" => $_POST['institucion'],
    "direccioninstitucion" => $_POST['direccioninstitucion'],
    "telfijo" => $_POST['telfijo'],
    "telmovil" => $_POST['telmovil'],
    "fecha" => $_POST['fecha'],
    "nombreproyecto" => $_POST['nombreproyecto'],
    "alumnosresponsables" => $_POST['alumnosresponsables'],
    "nombrecontacto" => $_POST['nombrecontacto'],
    "peticion" => $ruta,
    "requisitodepartamento" => $_POST['requisitodepartamento'],
    "requisitocarrera" => $_POST['requisitocarrera'],    
  ];
  $peticiones = new Peticiones();
  if(!$peticiones->agregarPeticion($array)) {
    echo "<header>";
    echo "<script language='javascript'>"; 
    echo "alert('Hubo un error al agregar la peticion.')"; 
    echo "</script>";  
    echo "<script language='javascript'>window.location='../vista/AgregarPeticion.php'</script>;";
    echo "</header>";
  } else {
  //INGRESA NUEVO REGISTRO A LA BITACORA DE LA BASE DE DATOS
      $log = new Bitacora();
      $array = [
      "idusuario" => $_SESSION["idusuario"],
      "detalle" => "El usuario: " .$_SESSION["usuario"]. " agrego la nueva peticion: " .$_POST['nombreproyecto']. "",
      ];
      $log1 = $log->agregarLog($array);
      
      echo "<header>";
      echo "<script language='javascript'>"; 
      echo "alert('Peticion agregada con exito.')"; 
      echo "</script>";  
      echo "<script language='javascript'>window.location='../vista/ListarPeticiones.php'</script>;";
      echo "</header>";
    }
  } 
//PETICION SIN RESPALDO
} else {
     $array = [
    "tipoproyecto" => $_POST['tipoproyecto'],
    "institucion" => $_POST['institucion'],
    "direccioninstitucion" => $_POST['direccioninstitucion'],
    "telfijo" => $_POST['telfijo'],
    "telmovil" => $_POST['telmovil'],
    "fecha" => $_POST['fecha'],
    "nombreproyecto" => $_POST['nombreproyecto'],
    "alumnosresponsables" => $_POST['alumnosresponsables'],
    "nombrecontacto" => $_POST['nombrecontacto'],
    "peticion" => "",
    "requisitodepartamento" => $_POST['requisitodepartamento'],
    "requisitocarrera" => $_POST['requisitocarrera'],    
    ];
    $peticiones = new Peticiones();
  if(!$peticiones->agregarPeticion($array)) {
    echo "<header>";
    echo "<script language='javascript'>"; 
    echo "alert('Hubo un error al agregar la peticion.')"; 
    echo "</script>";  
    echo "<script language='javascript'>window.location='../vista/AgregarPeticion.php'</script>;";
    echo "</header>";
  } else {
  //INGRESA NUEVO REGISTRO A LA BITACORA DE LA BASE DE DATOS
      $log = new Bitacora();
      $array = [
      "idusuario" => $_SESSION["idusuario"],
      "detalle" => "El usuario: " .$_SESSION["usuario"]. " agrego la nueva peticion: " .$_POST['nombreproyecto']. "",
      ];
      $log1 = $log->agregarLog($array);
      
      echo "<header>";
      echo "<script language='javascript'>"; 
      echo "alert('Peticion agregada con exito.')"; 
      echo "</script>";  
      echo "<script language='javascript'>window.location='../vista/ListarPeticiones.php'</script>;";
      echo "</header>";
    }
}
//ELIMINAR PETICION DE LA BASE DE DATOS
} else if(isset($_GET['delete_id'])) {
    $peticiones = new Peticiones();
    if(!$peticiones->borrarPeticion($_GET['delete_id'])) {
      echo "<header>";
      echo "<script language='javascript'>"; 
      echo "alert(' Hubo un problema al intentar borrar la peticion.')"; 
      echo "</script>";  
      echo "<script language='javascript'>window.location='../vista/ListarPeticiones.php'</script>;";
      echo "</header>";
    } else {
      echo "<header>";
      echo "<script language='javascript'>"; 
      echo "alert(' Peticion borrada con exito.')"; 
      echo "</script>";  
      echo "<script language='javascript'>window.location='../vista/ListarPeticiones.php'</script>;";
      echo "</header>";
      }
//MODIFICAR UNA PETICION EXISTENTE EN LA BASE DE DATOS
    } else if(isset($_POST['modificar'])) {
	//PETICION CON RESPALDO
  if(is_uploaded_file($_FILES['fichero']['tmp_name'])) {
  if($_FILES['fichero']['size'] > 512000) {
    echo "<header>";
    echo "<script language='javascript'>"; 
    echo "alert('El archivo de respaldo excede los 512kb.')"; 
    echo "</script>";  
    echo "<script language='javascript'>window.location='../vista/ListarPeticiones.php'</script>;";
    echo "</header>";
  } else {
    $ruta = "../documentos/peticiones/".$_POST['nombreproyecto']."_".$_POST['fecha'];
    move_uploaded_file($_FILES['fichero']['tmp_name'],$ruta);
     $array = [
    "idpeticiones" => $_POST['idpeticiones'], 
    "tipoproyecto" => $_POST['tipoproyecto'],
    "institucion" => $_POST['institucion'],
    "direccioninstitucion" => $_POST['direccioninstitucion'],
    "telfijo" => $_POST['telfijo'],
    "telmovil" => $_POST['telmovil'],
    "fecha" => $_POST['fecha'],
    "nombreproyecto" => $_POST['nombreproyecto'],
    "alumnosresponsables" => $_POST['alumnosresponsables'],
    "nombrecontacto" => $_POST['nombrecontacto'],
    "peticion" => $ruta,
    "requisitodepartamento" => $_POST['requisitodepartamento'],
    "requisitocarrera" => $_POST['requisitocarrera'],    
  ];
  $peticiones = new Peticiones();
  if(!$peticiones->actualizarPeticion($array)) {
    echo "<header>";
    echo "<script language='javascript'>"; 
    echo "alert('Hubo un error al modificar la peticion.')"; 
    echo "</script>";  
    echo "<script language='javascript'>window.location='../vista/ListarPeticiones.php'</script>;";
    echo "</header>";
  } else {
  //INGRESA NUEVO REGISTRO A LA BITACORA DE LA BASE DE DATOS
      $log = new Bitacora();
      $array = [
      "idusuario" => $_SESSION["idusuario"],
      "detalle" => "El usuario: " .$_SESSION["usuario"]. " modifico la peticion: " .$_POST['nombreproyecto']. "",
      ];
      $log1 = $log->agregarLog($array);
      
      echo "<header>";
      echo "<script language='javascript'>"; 
      echo "alert('Peticion agregada con exito.')"; 
      echo "</script>";  
      echo "<script language='javascript'>window.location='../vista/ListarPeticiones.php'</script>;";
      echo "</header>";
    }
  } 
//PETICION SIN RESPALDO
} else {
     $array = [
    "idpeticiones" => $_POST['idpeticiones'], 
    "tipoproyecto" => $_POST['tipoproyecto'],
    "institucion" => $_POST['institucion'],
    "direccioninstitucion" => $_POST['direccioninstitucion'],
    "telfijo" => $_POST['telfijo'],
    "telmovil" => $_POST['telmovil'],
    "fecha" => $_POST['fecha'],
    "nombreproyecto" => $_POST['nombreproyecto'],
    "alumnosresponsables" => $_POST['alumnosresponsables'],
    "nombrecontacto" => $_POST['nombrecontacto'],
    "peticion" => "",
    "requisitodepartamento" => $_POST['requisitodepartamento'],
    "requisitocarrera" => $_POST['requisitocarrera'],    
    ];
    $peticiones = new Peticiones();
  if(!$peticiones->actualizarPeticion($array)) {
    echo "<header>";
    echo "<script language='javascript'>"; 
    echo "alert('Hubo un error al modificar la peticion.')"; 
    echo "</script>";  
    echo "<script language='javascript'>window.location='../vista/ListarPeticiones.php'</script>;";
    echo "</header>";
  } else {
  //INGRESA NUEVO REGISTRO A LA BITACORA DE LA BASE DE DATOS
      $log = new Bitacora();
      $array = [
      "idusuario" => $_SESSION["idusuario"],
      "detalle" => "El usuario: " .$_SESSION["usuario"]. " modifico la peticion: " .$_POST['nombreproyecto']. "",
      ];
      $log1 = $log->agregarLog($array);
      
      echo "<header>";
      echo "<script language='javascript'>"; 
      echo "alert('Peticion modificada con exito.')"; 
      echo "</script>";  
      echo "<script language='javascript'>window.location='../vista/ListarPeticiones.php'</script>;";
      echo "</header>";
    }
  }
    }
?>