<?php
if(session_start()) {
if($_SESSION["idtipousuario"]== 3 OR $_SESSION["idtipousuario"]== 4) {
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
}
else {
require_once '../controlador/Noticias_controlador.php';
}
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
}
?>
<!DOCTYPE html>
<html lang="es">
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
      <li><a href="#">Ingreso de nueva noticia</a></li>
    </ol>
  </section>
  <!-- Main content -->
  <div class="col-md-12"><section class="content">
      <!-- Default box -->
      <div class="box box-danger box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Crear Nueva Noticia</h3>
        </div>
        <div class="box-body">
          <form role="form" name="form1" class="form-horizontal" method="post" action="../controlador/Noticias_controlador.php" > <!-- form horizontal acts as a row -->
          <div class="form-group">
            <label class="col-md-2 control-label" >T&iacute;tulo:</label>
            <div class="col-md-10">
              <input id="titulo" name="titulo" class="form-control" type="text" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 control-label" >Detalle:</label>
            <div class="col-md-10">
              <textarea id="detalle" name="detalle" class="form-control" rows="5" cols="50" maxlenght="200" placeholder="200 caracteres maximo" required></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 control-label" >Fecha:</label>
            <div class="col-md-10">
              <input id="fecha" name="fecha" class="form-control" type="text" value="<?php date_default_timezone_set('America/El_Salvador'); echo date("Y"),"-", date("m"),"-", date("d")?>" readonly="readonly">
              <input type="hidden" name="usuario" value="<?php echo $_SESSION['idusuario'] ?>">
              <input type="hidden" name="departamento" value="<?php echo $_SESSION['iddepartamento'] ?>">
            </div>
          </div>          
          <br>
          <div class="pull-right">
            <button class="btn btn-primary mr5" name="agregar" id="saveForm" type="submit">Guardar</button>
            <button class="btn btn-default">Cancelar</button>
          </div>
        </form>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </section></div>
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