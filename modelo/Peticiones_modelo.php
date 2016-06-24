<?php 
/*
* Clase para el manejo de funciones en la tabla peticiones
*/
require_once 'conexiondb.php';
require_once "../scripts/firephp/lib/FirePHPCore/fb.php";
ob_start();
class Peticiones extends conexion {
  private static $conn = null;

/*
* Constructor de la clase
*/
  public function __construct() {
    self::$conn = parent::getInstance();
  }
  
/* 
* Funcion para agregar una nueva peticion a la db
*
* @param $array Los datos de la peticion a insertar
*/
  public function agregarPeticion( $array ) {
    //PREPARA LA SENTENCIA SQL
    $query = self::$conn->prepare("INSERT INTO peticiones(tipoproyecto, institucion, direccioninstitucion, telfijo, telmovil, fecha, 
    nombreproyecto, alumnosresponsables, nombrecontacto, peticion, requisitodepartamento, requisitocarrera) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    //RELACIONA LOS PARAMETROS CON LA SENTENCIA
    $query->bind_param("ssssssssssss", $array["tipoproyecto"], $array["institucion"], $array["direccioninstitucion"], $array["telfijo"], $array["telmovil"], $array["fecha"], 
    $array["nombreproyecto"], $array["alumnosresponsables"], $array["nombrecontacto"], $array["peticion"], $array["requisitodepartamento"], $array["requisitocarrera"]);
    //EJECUTA LA SENTENCIA, DEVUELVE FALSE SI HAY ERROR
    $tupla = $query->execute();
    if(!$tupla) {
      $msj = 'Execute failed: (' . $query->error . ') ' . $query->error;
      fb($msj,FirePHP::TRACE); //mensaje a enviar a consola en caso de error
    }
    return $tupla;
  }
  
/*
* Funcion para obtener todas las petciones vinculadas a una carrera
*
* @param $idcarrera El codigo de la carrera vinculada
*/
  public function peticionesCarrera( $idcarrera ) {
    $result = self::$conn->query("SELECT * FROM peticiones WHERE requisitocarrera = '" .$idcarrera. "' AND alumnosresponsables > 0");
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $rows[] = $row;
    }
    return $rows;
  }

/*
* Funcion para obtener todos los registros de la tabla peticiones
*/
  public function getAll() {
    $result = self::$conn->query("SELECT * FROM peticiones WHERE alumnosresponsables > 0");
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $rows[] = $row;
    }
    return $rows;
  }
  
  /*
  * Funcion para actualizar el valor de alumnosresponsables
  * en la base de datos
  *
  * @param $idpeticiones El id de la peticion a actualizar
  */
  public function actualizarAlumnos( $idpeticiones ) {
    $result = self::$conn->query("UPDATE peticiones SET alumnosresponsables = alumnosresponsables - 1 WHERE idpeticiones = " .$idpeticiones);
    if (!$result) {
      return FALSE;
    } else {
      return TRUE;
    }
  }
  
  /*
  * Elimina una peticion de la base de datos
  *
  * @param $id El identificador de la peticion a borrar
  */
  public function borrarPeticion( $id ) {
    //PREPARA LA SENTENCIA SQL
    $query = self::$conn->prepare("UPDATE peticiones SET alumnosresponsables = 0 WHERE idpeticiones = ?");
    //RELACIONA LOS PARAMETROS CON LA SENTENCIA
    $query->bind_param('i', $id);
    //EJECUTA LA SENTENCIA Y DEVUELVE EL RESULTADO, FALSE SI FALLA
    $tupla = $query->execute(); 
    if(!$tupla) {
      $msj = 'Execute failed: (' . $query->errno . ') ' . $query->error;
      fb($msj,FirePHP::TRACE); //mensaje a enviar a consola en caso de error
    }
    return $tupla;
  }
  
  /*
  * Funcion para obtener una tupla de la tabla peticiones
  * de acuerdo al id
  *
  * @param $id El identificador de la peticion a obtener
  */
  public function getPeticion( $id ) {
     $result = self::$conn->query("SELECT * FROM peticiones WHERE idpeticiones = " .$id );
    return $row = $result->fetch_array(MYSQLI_ASSOC);
  }
  
  /*
  * Funcion para actualizar la informacion de una peticion
  * en especifico en la base de datos
  *
  * @param $array El arreglo que contiene la informacion a actualizar
  */
  public function actualizarPeticion( $array ) {
    //PREPARA LA SENTENCIA SQL
    $query = self::$conn->prepare("UPDATE peticiones SET tipoproyecto = ?, institucion = ?, direccioninstitucion = ?, telfijo = ?, telmovil = ?, fecha = ?, 
    nombreproyecto = ?, alumnosresponsables = ?, nombrecontacto = ?, peticion = ?, requisitodepartamento = ?, requisitocarrera = ? 
    WHERE idpeticiones = ?");
    //RELACIONA LOS PARAMETROS CON LA SENTENCIA
    $query->bind_param("ssssssssssssi", $array["tipoproyecto"], $array["institucion"], $array["direccioninstitucion"], $array["telfijo"], $array["telmovil"], $array["fecha"], 
    $array["nombreproyecto"], $array["alumnosresponsables"], $array["nombrecontacto"], $array["peticion"], $array["requisitodepartamento"], $array["requisitocarrera"], $array['idpeticiones']);
    //EJECUTA LA SENTENCIA, DEVUELVE FALSE SI HAY ERROR
    $tupla = $query->execute();
    if(!$tupla) {
      $msj = 'Execute failed: (' . $query->error . ') ' . $query->error;
      fb($msj,FirePHP::TRACE); //mensaje a enviar a consola en caso de error
    }
    return $tupla;
  }
}