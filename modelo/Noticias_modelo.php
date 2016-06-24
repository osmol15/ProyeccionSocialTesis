<?php
/*
* CLASE PARA EL MANEJO DE DATOS DESDE/HACIA LA TABLA USUARIOS
*/
require_once "../scripts/firephp/lib/FirePHPCore/fb.php";
require_once "../modelo/conexiondb.php";
ob_start();
class Noticias extends conexion {
  private static $conn = null;

/*
*   Contructor de la clase
*/
  public function __construct() {
    self::$conn = parent::getInstance();
  }

/*
*   Recupera todas las noticias de la tabla de noticias
*   para rellenar el formulario de editar noticias 
*/
  public function getAll() {
    $query = "SELECT * FROM noticias";
    $result = self::$conn->query($query);

    /* array asociativo */
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $rows[] = $row;
      }
      return $rows;
  }  
  
/*
*   Consigue los noticias de la tabla de noticias asociadas a un usuario
*   para rellenar el formulario de editar noticias 
*   
*   @param $idusuario El codigo del usuario
*/
  public function getNoticiasUsuario( $idusuario ) {
    $query = "SELECT * FROM noticias WHERE usuario = '". $idusuario ."'";
    $result = self::$conn->query($query);

    /* array asociativo */
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $rows[] = $row;
      }
      return $rows;
  }
  
  /*
  *   Consigue los noticias de la tabla de noticias asociadas a un departamento
  *   para rellenar el formulario de editar noticias 
  *   
  *   @param $departamento El codigo del departamento
  */
  public function getNoticiasDepartamento( $departamento ) {
    $query = "SELECT * FROM noticias WHERE departamento = '". $departamento ."'";
    $result = self::$conn->query($query);

    /* array asociativo */
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      $rows[] = $row;
      }
      return $rows;
  }
  
/*
* Actualiza una tupla de noticia de la base de datos
*
* @param $array El arreglo que contiene todas las variables a ingresar a la db
*/
  public function actualizarNoticia( $array ) {
    //PREPARA LA SENTENCIA SQL
    $query = self::$conn->prepare("UPDATE noticias SET titulo = ?, detalle = ?
    WHERE idnoticias = ?");
    //RELACIONA LOS PARAMETROS CON LA SENTENCIA
    $query->bind_param('ssi', $array["titulo"], $array["detalle"], $array["idnoticia"]);
    //EJECUTA LA SENTENCIA Y DEVUELVE EL RESULTADO, FALSE SI FALLA
    $tupla = $query->execute(); 
    if(!$tupla) {
      $msj = 'Execute failed: (' . $query->errno . ') ' . $query->error;
      fb($msj,FirePHP::TRACE); //mensaje a enviar a consola en caso de error
    }
    return $tupla;
  }
  
  /*
  * Agrega una nueva noticia a la base de datos
  *
  * @param $array Los datos a ingresar a la base de datos
  */
  public function agregarNoticia( $array ) {
    //PREPARA LA SENTENCIA SQL
    $query = self::$conn->prepare("INSERT INTO noticias(titulo, detalle, fecha, usuario, departamento) VALUES (?, ?, ?, ?, ?)");    
    //RELACIONA LOS PARAMETROS CON LA SENTENCIA
    $query->bind_param('sssis', $array["titulo"], $array["detalle"], $array["fecha"], $array["usuario"], $array['departamento']);
    //EJECUTA LA SENTENCIA Y DEVUELVE EL RESULTADO, FALSE SI FALLA
    $tupla = $query->execute(); 
    if(!$tupla) {
      $msj = 'Execute failed: (' . $query->errno . ') ' . $query->error;
      fb($msj,FirePHP::TRACE); //mensaje a enviar a consola en caso de error
    }
    return $tupla;
    
  }
  
  /*
  * Elimina una noticia de la base de datos
  *
  * @param $id El identificador de la noticia a borrar
  */
  public function borrarNoticia( $id ) {
    //PREPARA LA SENTENCIA SQL
    $query = self::$conn->prepare("DELETE FROM noticias WHERE idnoticias = ?");
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
  * Obtiene una noticia de la base de datos
  *
  * @param $id El identificador de la noticia obtener
  */
  public function getNoticia( $id ) {
    //PREPARA LA SENTENCIA SQL
    $query = self::$conn->prepare("SELECT * FROM noticias WHERE idnoticias = ?");
    //RELACIONA LOS PARAMETROS CON LA SENTENCIA
    $query->bind_param('i', $id);
    //EJECUTA LA SENTENCIA Y DEVUELVE EL RESULTADO, FALSE SI FALLA
    $query->execute(); 
    $tupla = $query->get_result();
    if(!$tupla) {
      $msj = 'Execute failed: (' . $query->errno . ') ' . $query->error;
      fb($msj,FirePHP::TRACE); //mensaje a enviar a consola en caso de error
    }
    return $tupla->fetch_array(MYSQLI_ASSOC);
  }

}
?> 
