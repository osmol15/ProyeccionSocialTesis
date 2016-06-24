<?php
if(session_start()) {
require_once '../modelo/Misc_modelo.php';
require_once '../modelo/Estudiantes_modelo.php';
if($_SESSION['idtipousuario'] == 2 OR $_SESSION['idtipousuario'] == 5) {
$est = new Estudiantes();
$estudiantes = $est->getEstudiantesDepto($_SESSION['iddepartamento']);
$misc = new Miscelaneo();
$carreras = $misc->getCarreras($_SESSION['iddepartamento']);
} else if($_SESSION['idtipousuario'] == 1) {
$est = new Estudiantes();
$estudiantes = $est->getAll();
$misc = new Miscelaneo();
$carreras = $misc->getAllCarreras();
} else {
echo "<header>";
  echo "<script language='javascript'>";
  echo "alert('No tienes los privilegios suficientes para cargar la pagina solicitada.')";
  echo "</script>";
echo "</header>";
echo "<body>";
  echo "<table ><tr><td>";
    echo "<a title='Atras'  href='javascript: history.go(-1)'><img align=left  WIDTH=50% HEIGHT=40% src='../images/back.png' alt='Atras'/></a>";
  echo "</td></tr><tr><td align=center style='padding-right: 100px;'>";
  echo "<label >Volver</label></td></tr></table>";
echo "</a>";
echo "</body> ";
exit();
}
} else {
echo "<header>";
echo "<script language='javascript'>";
echo "alert('No has iniciado sesion')";
echo "</script>";
echo "<script language='javascript'>window.location='index.php'</script>;";
echo "</header>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../styles/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../fonts/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../fonts/ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../styles/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
  page. However, you can choose any other skin. Make sure you
  apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="../styles/dist/css/skins/skin-red.min.css">
  
  <link rel="stylesheet" href="../scripts/datatables/dataTables.bootstrap.css">
</head>
<body class="layout-top-nav">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      &nbsp;
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Usuarios</a></li>
        <li><a href="#">Estudiantes Registrados</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box box-solid box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Listado de Estudiantes</h3>
        </div>
        <div class="box-body">
          <table id="example" class="table table-bordered table-striped text-center">
            <thead>
              <tr class="center aligned">
                <th>Carnet</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>CUM</th>
                <th>Carrera</th>
                <th colspan="2">Opciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($estudiantes as $estudiante) {
              ?>
              <tr class="center aligned">
                <td><?php echo $estudiante["carnet"]; ?> </td>
                <td><?php echo $estudiante["nombreestudiante"]; ?> </td>
                <td><?php echo $estudiante["apellidoestudiante"]; ?></td>
                <td><?php echo $estudiante["cum"]; ?> </td>
                <?php
                  foreach($carreras as $carrera) {
                  if(strcmp($estudiante["carrera"], $carrera["idcarrera"]) == 0){
                    echo '<td>' .$carrera["nombrecarrera"]. '</td>';
                  }
                }
                  if ($estudiante["carrera"] == "") {
                    echo '<td></td>';                
                }
                  if ($estudiante["nombreestudiante"] == "") {
                ?>
                <td>
                  hjkh
                </td>
                <td>
                  AS
                </td>
                <?php 
                }
                   else {  ?>
                <td>
                  
                </td>
                <?php
                 }
                ?>
              </tr>
              
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
</body>
<!-- jQuery 2.2.0 -->
<script src="../scripts/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../styles/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../styles/dist/js/app.min.js"></script>
<script src="../scripts/datatables/jquery.dataTables.min.js"></script>
<script src="../scripts/datatables/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function() {
$('#example').DataTable( {

"language": {
"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
}
} );
} );

</script>
<script type="text/javascript">
function delete_id(id)
{
if(confirm('Seguro que desea borrar ?'))
{
window.location.href='../controlador/Estudiantes_controlador.php?delete_id='+id;
}
}
</script>

</html>