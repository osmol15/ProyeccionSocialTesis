<?php
/*
* CLASE PARA EL MANEJO DE TABLAS NO ESPECIFICAS
*/
require_once "../modelo/conexiondb.php";
class Miscelaneo extends conexion {
 private static $conn = null;
 
 /*
 *   Contructor de la clase
 */
 public function __construct() {
   self::$conn = parent::getInstance();
 }
 
 /*
 * Obtiene la lista de departamentos de la Facultad
 * de la tabla departamento
 */
 public function getDepartamentos() {
  $result = self::$conn->query("SELECT * FROM departamento");
  while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $rows[] = $row;
  }
  return $rows;
 }
 
 /*
 * Obtiene la lista de carreras de un departamento especifico
 * @param $deptid El codigo del departamento
 */
 public function getCarreras( $deptid ) {
  $result = self::$conn->query("SELECT * FROM carrera WHERE iddepartamento = '" .$deptid. "'");
  while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $rows[] = $row;
  }
  return $rows;
 }
 
 public function getAllCarreras() {
  $result = self::$conn->query("SELECT * FROM carrera");
  while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $rows[] = $row;
  }
  return $rows;
  }
}
?>
