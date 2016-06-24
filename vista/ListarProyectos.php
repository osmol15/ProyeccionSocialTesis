<?php
if(session_start()) {
require '../modelo/Proyectos.php';
$proyect = new Proyectos();
$proyectos = $proyect->getAllProyectos();
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
    <link rel="stylesheet" href="../scripts/datatables/extensions/Responsive/css/dataTables.responsive.css">
  </head>
  <body class="layout-top-nav">
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
        &nbsp;
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Proyectos</a></li>
          <li><a href="#">Listado</a></li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <div class="box box-danger box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Listado de Proyectos</h3>
          </div>
          <div class="box-body">
            <table id="example" class="table table-bordered table-striped text-center dt-responsive nowrap" width="100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Carnet</th>
                  <th>Tutor</th>
                  <th>Proyecto</th>
                  <th>Instituci&oacute;n</th>
                  <th>Direcci&oacute;n</th>
                  <th>Num. Horas</th>
                  <th>Coordinador</th>
                  <th>Jefe</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach($proyectos as $proyecto) {
                ?>
                <tr class="center aligned">
                  <td><?php echo $proyecto["idproyecto"]; ?></td>
                  <td><?php echo $proyecto["carnet"]; ?></td>
                  <td><?php echo $proyecto["tutor"]; ?></td>
                  <td><?php echo $proyecto["nombreproyecto"]; ?></td>
                  <td><?php echo $proyecto["institucion"]; ?></td>
                  <td><?php echo $proyecto["direccioninstitucion"]; ?></td>
                  <td><?php echo $proyecto["numerodehoras"]; ?></td>
                  <td><?php
                    switch ($proyecto["firmacoordinador"]) {
                    case '0':
                    echo "<i class='ion-close-circled'></i>";
                    break;
                    case '1':
                    echo "<i class='ion-checkmark-circled'></i>";
                    break;
                    default:
                    echo "<i class='ion-close-circled'></i>";
                    break;
                    }
                  ?></td>
                  <td><?php
                    switch ($proyecto["firmajefe"]) {
                    case '0':
                    echo "<i class='ion-close-circled'></i>";
                    break;
                    case '1':
                    echo "<i class='ion-checkmark-circled'></i>";
                    break;
                    default:
                    echo "<i class='ion-close-circled'></i>";
                    break;
                    }
                  ?></td>
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
    <script src="../scripts/datatables/extensions/Responsive/js/dataTables.responsive.js"></script>
  <script>
  $(document).ready(function() {
  $('#example').DataTable( {
  "language": {
  "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json",
  }
  } );
  } );
  </script>
</html>