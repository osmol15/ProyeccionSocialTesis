<?php
/*
* Clase para el manejo de acciones de la tabla estudiante
*/
require_once 'conexiondb.php';
require_once "../scripts/firephp/lib/FirePHPCore/fb.php";
class Estudiantes extends conexion {
  private static $conn = null;
  
  public function __construct() {
    self::$conn = parent::getInstance();
  }
  
  public function ingresarEstudiante( $array ) {
    //PREPARA LA SENTENCIA SQL
    $query = self::$conn->prepare("INSERT INTO estudiante(clave, carnet, departamento, tipousuario) 
    VALUES (?, ?, ?, ?)");
    //RELACIONA LOS PARAMETROS CON LA SENTENCIA
    $query->bind_param('sssi', $array["clave"], $array["carnet"], $array["departamento"], $array["tipousuario"]);
    //EJECUTA LA SENTENCIA Y DEVUELVE EL RESULTADO, FALSE SI FALLA
    $tupla = $query->execute(); 
    if(!$tupla) {
      $msj = 'Execute failed: (' . $query->errno . ') ' . $query->error;
      fb($msj,FirePHP::TRACE); //mensaje a enviar a consola en caso de error
    }
    return $tupla;
  }
  
  public function editarEstudiante( $array ) {
    //PREPARA LA SENTENCIA SQL
    $query = self::$conn->prepare("UPDATE estudiante SET nombreestudiante = ?, apellidoestudiante = ?, clave = ?, telfijo = ?, telmovil = ?, correo = ?, 
    carrera = ?, cum = ?, sexo = ?, direccion = ?, constancia60 = ?, recordnotas = ?
    WHERE carnet = ?");
    //RELACIONA LOS PARAMETROS CON LA SENTENCIA
    $query->bind_param('sssssssssssss', $array["nombre"], $array["apellido"], $array["clave"], $array["telfijo"], $array["telmovil"], $array["correo"], 
    $array["carrera"], $array["cum"], $array["sexo"], $array["direccion"], $array["constancia60"], $array["recordnotas"], $array["carnet"]);
    //EJECUTA LA SENTENCIA Y DEVUELVE EL RESULTADO, FALSE SI FALLA
    $tupla = $query->execute(); 
    if(!$tupla) {
      $msj = 'Execute failed: (' . $query->errno . ') ' . $query->error;
      fb($msj,FirePHP::TRACE); //mensaje a enviar a consola en caso de error
    }
    return $tupla;
  }
   /*
  * Elimina un estudiante de la base de datos que aun no haya actualizados datos
  *
  * @param $carnet El identificador del estudiante a eliminar
  */
 public function borrarEstudiante( $carnet ) {
    //PREPARA LA SENTENCIA SQL
    $query = self::$conn->prepare("DELETE FROM estudiante WHERE carnet = ?");
    //RELACIONA LOS PARAMETROS CON LA SENTENCIA
    $query->bind_param('s', $carnet);
    //EJECUTA LA SENTENCIA Y DEVUELVE EL RESULTADO, FALSE SI FALLA
    $tupla = $query->execute(); 
    if(!$tupla) {
      $msj = 'Execute failed: (' . $query->errno . ') ' . $query->error;
      fb($msj,FirePHP::TRACE); //mensaje a enviar a consola en caso de error
    }
    return $tupla;
  }
  
  public function getEstudiante( $carnet ) {
    $result = self::$conn->query("SELECT * FROM estudiante WHERE carnet = '" .$carnet. "'");
    $row = $result->fetch_array(MYSQLI_ASSOC);
    return $row;
  }
  
  public function getAll() {
    $result = self::$conn->query("SELECT * FROM estudiante");
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $rows[] = $row;
    }
    return $rows;
  }
  
  public function getEstudiantesDepto( $iddepto ) {
    $result = self::$conn->query("SELECT * FROM estudiante WHERE departamento = " .$iddepto);
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $rows[] = $row;
    }
    return $rows;
  }
}
?>
