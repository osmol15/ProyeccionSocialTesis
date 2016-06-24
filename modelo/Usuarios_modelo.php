<?php
/*
* CLASE PARA EL MANEJO DE DATOS DESDE/HACIA LA TABLA USUARIOS
*/
require_once "../scripts/firephp/lib/FirePHPCore/fb.php";
require_once "../modelo/conexiondb.php";
ob_start();
class Usuarios extends conexion {
  private static $conn = null;

/*
*   Contructor de la clase
*/
  public function __construct() {
    self::$conn = parent::getInstance();
  }
  
/*
*   Consigue los datos de la tabla de usuarios asociados a un carnet
*   para rellenar el formulario de editar usuarios 
*   
*   @param $carnet El codigo del carnet del estudiante
*/
  public function getDatosUsuario( $idusuario ) {
    $query = "SELECT * FROM usuario WHERE idusuario = '". $idusuario ."'";
    $result = self::$conn->query($query);
    
    /* array asociativo */
    return $row = $result->fetch_array(MYSQLI_ASSOC);
  }
  
/*
* Actualiza una tupla de usuario de la base de datos
*
* @param $array El arreglo que contiene todas las variables a ingresar a la db
*/
  public function actualizarUsuario( $array ) {
    //PREPARA LA SENTENCIA SQL
    $query = self::$conn->prepare("UPDATE usuario SET nombre = ?, apellido = ?, clave = ?, telefono = ?, correo = ?, usuario = ?
    WHERE idusuario = ?");
    //RELACIONA LOS PARAMETROS CON LA SENTENCIA
    $query->bind_param('sssissi', $array["nombre"], $array["apellido"], $array["pass"], $array["telefono"], $array["correo"], $array["usuario"], $array["idusuario"]);
    //EJECUTA LA SENTENCIA Y DEVUELVE EL RESULTADO, FALSE SI FALLA
    $tupla = $query->execute(); 
    if(!$tupla) {
      $msj = 'Execute failed: (' . $query->errno . ') ' . $query->error;
      fb($msj,FirePHP::TRACE); //mensaje a enviar a consola en caso de error
    }
    return $tupla;
  }
  
  /*
  * Agrega un nuevo usuario a la base de datos
  *
  * @param $array Los datos a ingresar a la base de datos
  */
  public function agregarUsuario( $array ) {
    //PREPARA LA SENTENCIA SQL
    $query = self::$conn->prepare("INSERT INTO usuario(idtipousuario, usuario, nombre, apellido, clave, telefono, correo, iddepartamento) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    //RELACIONA LOS PARAMETROS CON LA SENTENCIA
    $query->bind_param('issssisi', $array["tipousuario"], $array["usuario"], $array["nombre"], $array["apellido"], $array["pass"], $array["telefono"], $array["correo"], $array["iddepartamento"]);
    //EJECUTA LA SENTENCIA Y DEVUELVE EL RESULTADO, FALSE SI FALLA
    $tupla = $query->execute(); 
    if(!$tupla) {
      $msj = 'Execute failed: (' . $query->errno . ') ' . $query->error;
      fb($msj,FirePHP::TRACE); //mensaje a enviar a consola en caso de error
    }
    return $tupla;
  }
  
  /*
  * Comprueba si el campo usuario ya existe en la tabla usuario
  *
  * @param $usuario El valor del campo a comprobar
  */
  public function comprobarUsuario( $usuario ) {
    $query = "SELECT usuario FROM usuario WHERE usuario = '". $usuario ."'";
    $result = self::$conn->query($query);
    if($result->num_rows >0 ) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  
  /*
  * Funcion para obtener todos los usuarios de la tabla a excepcion de jefatura
  */
  public function getAll() {
    $result = self::$conn->query("SELECT * FROM usuario WHERE idtipousuario <> 1");
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $rows[] = $row;
    }
    return $rows;
  }
  
  /*
  * Funcion para obtener los usuarios de un departamento especifico
  * a excepcion de su coordinador
  *
  * @param $deptid El codigo del departamento a consultar
  */
  public function getUsuariosDept( $deptid ) {
    $result = self::$conn->query("SELECT * FROM usuario WHERE idtipousuario <> 2 AND iddepartamento = '" .$deptid. "'");
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $rows[] = $row;
    }
    return $rows;
  }
  
  /*
  * Funcion para obtener todos los tutores registrados
  * en la db
  */
  public function getAllTutores() {
    $result = self::$conn->query("SELECT * FROM usuario WHERE idtipousuario = 3 ");
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $rows[] = $row;
    }
    return $rows;
  }
}
?>