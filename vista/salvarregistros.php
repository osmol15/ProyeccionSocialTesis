<?php
require_once '../modelo/Proyectos.php';
require_once '../modelo/Peticiones_modelo.php';

if (isset($_POST['horarios'])) {
    $archivo = $_POST['horarios'];
    $ruta = "../documentos/horarios/horario_" . $_POST['carnet'] . "_" . $_POST['fecha'] .".xls";
    if(file_put_contents($ruta,$archivo)) {
        $array = [
	"carnet" => $_POST['carnet'],
	"tipoinscripcion" => $_POST['tipoins'],
	"tipoproyecto" => $_POST['tipopro'],
	"numhoras" => $_POST['numhrs'],
	"alumnosat" => $_POST['alumnos'],
	"notamateria" => $_POST['notamat'],
	"nombreproyecto" => $_POST['nompro'],
	"institucion" => $_POST['inst'],
	"dirinstitucion" => $_POST['dirin'],
	"telfijo" => $_POST['telfijo'],
	"telmovil" => $_POST['telmovil'],
	"nombrecontacto" => $_POST['nomcon'],
	"fechaini" => $_POST['fechaini'],
	"fechafin" => $_POST['fechafin'],
	"fecha" => $_POST['fecha'],
	"tutor" => $_POST['tutor'],
	"horarios" => $ruta,
	];
	$proyecto = new Proyectos();
	if(!$proyecto->registroProyecto($array)) {
	  echo '0'; //ERROR AL CREAR REGISTRO
	} else {
	  $pet = new Peticiones();
	  $peticion = $pet->actualizarAlumnos($_POST['idpeticiones']);
	  echo '1'; //REGISTRO GUARDADO CON EXITO
	}
    } else {
      echo '0'; //ERROR AL CREAR ARCHIVO
    }  
} else if(isset($_POST['controltiempo'])) {
/* codigo para manejar los datos de control de tiempo */
} else if(isset($_POST['informeservicio'])) {
/* codigo para manejar los datos del informe del servicio social */
} else if(isset($_POST['planejecucion'])) {
/* codigo para manejar los datos del plan de ejecucion */
} else if (isset($_POST['hojaevaluacion'])) {
/* codigo para manejar los datos de la hoja de evaluacion */
}
?>
