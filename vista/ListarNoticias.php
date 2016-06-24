<?php
if (session_start()) {
require_once '../modelo/Noticias_modelo.php';
$noti = new Noticias();
if($_SESSION["idtipousuario"]=="1") {
$noticias = $noti->getAll();
$mod = TRUE;
} else if ($_SESSION["idtipousuario"]=="2" || $_SESSION["idtipousuario"]=="5") {
$noticias = $noti->getNoticiasDepartamento($_SESSION["iddepartamento"]);
$mod = TRUE;
} else {
$noticias = $noti->getAll();
$mod = FALSE;
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
    <!--funcion para borrar -->
    <script type="text/javascript">
    function edt_id(id)
    {
    if(confirm('Seguro quiere editar ?'))
    {
    window.location.href='EditarNoticias.php?edit_id='+id;
    }
    }
    function delete_id(id)
    {
    if(confirm('Seguro que desea borrar ?'))
    {
    window.location.href='../controlador/Noticias_controlador.php?delete_id='+id;
    }
    }
    </script>
  </head>
  <body class="layout-top-nav">
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
        &nbsp;
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Noticias</a></li>
          <li><a href="#">Lista de Noticias</a></li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <!-- Default box -->
        <div class="box box-solid box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Lista de Noticias</h3>
          </div>
          <div class="box-body">
            <?php
            if ($noticias == 0) {
            echo "
            <h2 class='text-center'>No hay Noticias</h2>
            ";
            }else{
            ?>
            <table class="table table-bordered text-center">
              <thead>
                  <tr class="center aligned">
                  <th style="visibility:collapse;display:none">ID</th>
                  <th>Titulo</th>
                  <th>Detalle</th>
                  <?php
                  if($mod){
                  echo '<th colspan="2">Opciones</th>';
                  }
                  ?>
                </tr>
              </thead>
              <?php
              foreach ($noticias as $rows) {
              echo '<tr class="center aligned"> ';
                echo '<td style="visibility:collapse;display:none"><' .$rows["idnoticias"]. ' </td> ';
                echo '<td>' .$rows["titulo"]. '</td>';
                echo '<td>' .$rows["detalle"]. '</td>';
                if ($mod) {
                echo  ' <td align="center"><a href="javascript:edt_id(' .$rows["idnoticias"]. ')"><i title="Editar" class="ion-edit" style="font-size: 25px;"></i></a></td>';
                echo  '<td><a href="javascript:delete_id(' .$rows["idnoticias"]. ')"><i class="ion-close-round" style="font-size: 25px;" title="Eliminar"></i></a></td>';
                }
              echo ' </tr> ';
              }
              }
              ?>
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
</html>