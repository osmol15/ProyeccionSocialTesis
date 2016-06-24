<?php
/*
* METODOS PARA EL MANEJO DE DATOS A/DE LA TABLA PROYECTOS
* @param $conn Variable para guardar la instancia de la conexion
*/
require_once "../scripts/firephp/lib/FirePHPCore/fb.php";
require_once "../modelo/conexiondb.php";
ob_start();
class Proyectos extends conexion {
  private static $conn = null;
/*
*   Contructor de la clase
*/
  public function __construct() {
    self::$conn = parent::getInstance();
  }

/*
*   Consigue los datos de la tabla de proyectos asociados a un carnet
*   para rellenar el formulario de registrarProyecto.php 
*   
*   @param $carnet El codigo del carnet del estudiante
*/
  public function getDatosProyecto( $carnet) {
    $query = "SELECT * FROM estudiante WHERE carnet = '". $carnet ."'";
    $result = self::$conn->query($query);
    
    /* array asociativo */
    return $row = $result->fetch_array(MYSQLI_ASSOC);
  }
  
/*
* Registra una nueva tupla hacia la tabla proyecto de la base de datos
*
* @param $array El arreglo que contiene todas las variables a ingresar a la db
*/
  public function registroProyecto( $array) {
    //PREPARA LA SENTENCIA SQL
    $query = self::$conn->prepare("INSERT INTO proyecto(carnet, idtipoinscripcion, tipoproyecto, numerodehoras, alumnosatendidos, notamateria, 
    nombreproyecto, institucion, direccioninstitucion, telfijo, telmovil, nombrecontacto, fechaini, fechafin, horario, fecha, tutor) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    //RELACIONA LOS PARAMETROS CON LA SENTENCIA
    $query->bind_param("sssssssssssssssss", $array["carnet"], $array["tipoinscripcion"], $array["tipoproyecto"], $array["numhoras"], $array["alumnosat"], 
    $array["notamateria"], $array["nombreproyecto"], $array["institucion"], $array["dirinstitucion"], $array["telfijo"], $array["telmovil"], 
    $array["nombrecontacto"], $array["fechaini"], $array["fechafin"], $array["horarios"], $array["fecha"], $array["tutor"]);
    //EJECUTA LA SENTENCIA Y DEVUELVE EL RESULTADO, FALSE SI FALLA
    $tupla = $query->execute(); 
    if(!$tupla) {
      $msj = 'Execute failed: (' . $query->errno . ') ' . $query->error;
      fb($msj,FirePHP::TRACE); //mensaje a enviar a consola en caso de error
    }
    return $tupla;
  }
  
  /*
  * Funcion para obtener todas las tuplas de la tabla proyecto
  */
  public function getAllProyectos() {
    $query = "SELECT * FROM proyecto";
    $result = self::$conn->query($query);
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $rows[] = $row;
    }
    return $rows;
  }
  
  /*
  * POR EL MOMENTO NO FUNCIONAL
  * @param $deptid El codigo del departamento a consultar
  */
  public function getDeptProyectos( $deptid ) {
    $result = self::$conn->query("SELECT * FROM proyecto WHERE ");
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $rows[] = $row;
    }
    return $rows;
  }
}
?>
