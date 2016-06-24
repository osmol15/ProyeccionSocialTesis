<?php
require_once '../modelo/Estudiantes_modelo.php';
require_once '../modelo/Bitacora_modelo.php';
session_start();
//AGREGAR UN NUEVO ESTUDIANTE A LA DB 
if(isset($_POST['agregar'])) {
  $array = [
    "carnet" => trim($_POST['carnet']),
    "clave" => trim($_POST['pass']),
    "departamento" => $_POST['departamento'],
    "tipousuario" => $_POST['tipousuario'],  
  ];
  $estudiante = new Estudiantes();
  if(!$estudiante->ingresarEstudiante($array)) {
    echo "<header>";
    echo "<script language='javascript'>"; 
    echo "alert('Hubo un error al ingresar el registro de estudiante.')"; 
    echo "</script>";  
    echo "<script language='javascript'>window.location='../vista/IngresarEstudiante.php'</script>;";
    echo "</header>";
  } else {
       //INGRESA NUEVO REGISTRO A LA BITACORA
      $log = new Bitacora();
      $array = [
      "idusuario" => $_SESSION["idusuario"],
      "detalle" => "El usuario: " .$_SESSION["usuario"]. " agrego el nuevo estudiante: " .$_POST['carnet']. "",
      ];
      $log1 = $log->agregarLog($array);
      
      echo "<header>";
      echo "<script language='javascript'>"; 
      echo "alert('Estudiante agregago con exito.')"; 
      echo "</script>";  
      echo "<script language='javascript'>window.location='../vista/ListarEstudiantes.php'</script>;";
      echo "</header>";
  }
//MODIFICAR LOS DATOS DEL ESTUDIANTE EXISTENTE
} else if (isset($_POST['actualizar'])) {
  $ruta1 = "";
  $ruta2 = "";
  //COMPROBAR SUBIDA DE ARCHIVO DE CONSTANCIA
    if(is_uploaded_file($_FILES['fichero']['tmp_name'])) {
      if($_FILES['fichero']['size'] > 512000) {
	echo "<header>";
	echo "<script language='javascript'>"; 
	echo "alert('El archivo constancia excede los 512kb.')"; 
	echo "</script>";  
	echo "<script language='javascript'>window.location='../vista/EditarEstudiante.php'</script>;";
	echo "</header>";
      } else {
	$ruta1 = "../documentos/constancia60_".$_POST['carnet'].".pdf";
	move_uploaded_file($_FILES['fichero']['tmp_name'],$ruta);
      }
      //COMPROBAR SUBIDA DE ARCHIVO DE RECORD DE NOTAS
    } else if(is_uploaded_file($_FILES['fichero2']['tmp_name2'])) {
	if($_FILES['fichero2']['size'] > 512000) {
	  echo "<header>";
	  echo "<script language='javascript'>"; 
	  echo "alert('El archivo record de notas excede los 512kb.')"; 
	  echo "</script>";  
	  echo "<script language='javascript'>window.location='../vista/EditarEstudiante.php'</script>;";
	  echo "</header>";
      } else {
	$ruta2 = "../documentos/recordnotas_".$_POST['carnet'].".pdf";
	move_uploaded_file($_FILES['fichero2']['tmp_name2'],$ruta2);
      }
    }
    $array = [
      "carnet" => $_POST['carnet'],
      "nombre" => trim($_POST['nombreestudiante']),
      "apellido" => trim($_POST['apellidoestudiante']),
      "sexo" => $_POST['sexo'],
      "cum" => $_POST['cum'],
      "clave" => trim($_POST['pass']),
      "telfijo" => trim($_POST['telfijo']),
      "telmovil" => trim($_POST['telmovil']),
      "correo" => trim($_POST['correo']),
      "direccion" => trim($_POST['direccion']),
      "constancia60" => $ruta1,
      "recordnotas" => $ruta2,
      "carrera" => $_POST['carrera'],
    ];
    $estudiante = new Estudiantes();
    if(!$estudiante->editarEstudiante($array)) {
      echo "<header>";
      echo "<script language='javascript'>"; 
      echo "alert('Hubo un error al modificar los datos.')"; 
      echo "</script>";  
      echo "<script language='javascript'>window.location='../vista/EditarEstudiante.php'</script>;";
      echo "</header>";
    } else {
	echo "<header>";
	echo "<script language='javascript'>"; 
	echo "alert('Datos actualizados con exito.')"; 
	echo "</script>";  
	echo "<script language='javascript'>window.location='../vista/bienvenida.html'</script>;";
	echo "</header>";
    }
  }
  //Borrar un estudiante
  else if (isset($_GET['delete_id'])) {
    $carnet = $_GET['delete_id'];
    $estudiante = new Estudiantes();
    if(!$estudiante->borrarEstudiante($carnet)) {
      echo "<header>";
      echo "<script language='javascript'>"; 
      echo "alert(' Hubo un problema al intentar Eliminar al Estudiante.')"; 
      echo "</script>";  
      echo "<script language='javascript'>window.location='../vista/ListarEstudiantes.php'</script>;";
      echo "</header>";
    } else {
      echo "<header>";
      echo "<script language='javascript'>"; 
      echo "alert(' Estudiante Eliminado con exito.')"; 
      echo "</script>";  
      echo "<script language='javascript'>window.location='../vista/ListarEstudiantes.php'</script>;";
      echo "</header>";
    }
  }
?>
