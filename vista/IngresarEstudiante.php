<?php
if(session_start()) {
if($_SESSION['idtipousuario'] == 2 OR $_SESSION['idtipousuario'] == 5) {
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

<script language="javascript">

function validar_texto(e)
{
tecla = (document.all) ? e.keyCode : e.which;
//Tecla de retroceso para borrar, siempre la permite
if (tecla===8) return true;
// Patron de entrada, en este caso solo acepta letras
//patron =/[A-Za-z]/;
//solo numeros
patron = /\d/;
//no acepta numeros
//patron = /\D/;
tecla_final = String.fromCharCode(tecla);
return patron.test(tecla_final);
}
function validar_texto2(e)
{
tecla = (document.all) ? e.keyCode : e.which;
//Tecla de retroceso para borrar, siempre la permite
if (tecla===8) return true;
// Patron de entrada, en este caso solo acepta letras
patron =/[A-Za-z]/;
//solo numeros
//patron = /\d/;
//no acepta numeros
//patron = /\D/;
tecla_final = String.fromCharCode(tecla);
return patron.test(tecla_final);
}
</script>
<?php
      function generaPass(){
      $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
      $longitudCadena=strlen($cadena);
      $pass = "";
      $longitudPass=10;
      for($i=1 ; $i<=$longitudPass ; $i++){
      $pos=rand(0,$longitudCadena-1);
      $pass .= substr($cadena,$pos,1);
      }
      return $pass;
}        ?>
<!-- <div class="content-container" id="content"> -->
<!--<div class="page page-forms-elements"> -->
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
        <li><a href="#"><i class="fa fa-dashboard"></i> Usuario</a></li>
        <li><a href="#">Registrar Estudiante</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Agregar Nuevo Estudiante</h3>
        </div>
        <div class="box-body">
          <form role="form" name="form1" class="form-horizontal" method="post" action="../controlador/Estudiantes_controlador.php" > <!-- form horizontal acts as a row -->
          
          
          <div class="form-group">
            <label class="col-md-2 control-label">Carnet de Estudiante:</label>
            <div class="col-md-10">
              <input id="carnet" name="carnet" class="form-control" type="text"  maxlength="7"  title="Se necesita el Carnet del Estudiante. Ingrese un formato de carnet valido ej. RH08017"  required="true"  pattern="[a-zA-Z][a-zA-Z]+[0-9][0-9][0-9][0-9][0-9]" style="text-transform:uppercase">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 control-label">Asignar una clave:</label>
            <div class="col-md-10">
              <input id="pass" maxlength="10" minlength="10" name="pass" class="form-control" type="text" value="<?php echo generaPass(); ?>" >
            </div>
          </div>
          <br>          
          <div class="clearfix right">
            <button class="btn btn-primary mr5" name="agregar" id="saveForm" type="submit">Guardar</button>
            <input id="tipousuario" name="tipousuario" type="hidden" value="4" >
            <input id="iddepartamento" name="departamento" type="hidden" value="<?php echo $_SESSION['iddepartamento'] ?>" >
            <button class="btn btn-default">Cancelar</button>
          </div>
        </form>
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