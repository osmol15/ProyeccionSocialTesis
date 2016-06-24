<?php
if(session_start()) {
if($_SESSION['idtipousuario'] == 4 ) {
require_once '../modelo/Estudiantes_modelo.php';
require_once '../modelo/Misc_modelo.php';
$est = new Estudiantes();
$estudiante = $est->getEstudiante($_SESSION['carnet']);
$misc = new Miscelaneo();
$carreras = $misc->getCarreras($_SESSION['iddepartamento']);
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
  <script language="javascript" src="../scripts/validar.js"></script>
  
  <script language="javascript">
  function comprobarClave(){
  clave1 = document.form1.pass.value;
  clave2 = document.form1.repass.value;
  if (clave1.length < 6 ){
  alert("Error: la clave debe contener por lo menos 6 caracteres!");
  document.form1.pass.focus();
  return false;
  }
  re = /[A-Z]/;
  if(!re.test(clave1)) {
  alert("Error: la clave debe contener por lo menos una letra mayuscula (A-Z)!");
  document.form1.pass.focus();
  return false;
  
  }
  re = /[0-9]/;
  if(!re.test(clave1)) {
  alert("Error: la clave debe contener por lo menos un numero (0-9)!");
  document.form1.pass.focus();
  return false;
  
  }
  if (clave1 !== clave2) {
  alert(':( Las claves no coinciden por favor vuelva a ingresarlos')
  return false;
  }
  else {
  
  return true;
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
        <li><a href="#"><i class="fa fa-dashboard"></i> Estudiante</a></li>
        <li><a href="#">Editar Información</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Title</h3>
        </div>
        <div class="box-body">
          <form role="form" name="form1" class="form-horizontal" method="post" enctype="multipart/form-data" action="../controlador/Estudiantes_controlador.php" onsubmit="return comprobarClave();"> <!-- form horizontal acts as a rEditarCoordinadorow -->
          <div class="form-group">
            <label class="col-md-3 control-label" style="margin-top: 5px">Carrera:</label>
            <div class="col-md-9">
              <span>
                <select name="carrera" class="form-control" required="true" >
                  <?php
                  foreach($carreras as $carrera) {  ?>
                  <option value="<?php echo $carrera["idcarrera"]; ?>" <?php  if($estudiante["carrera"]== $carrera["idcarrera"]){ echo 'selected';} ?>><?php echo $carrera["nombrecarrera"];?> </option>
                  <?php  } ?>
                </select>
              </span>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-md-3 control-label">Carnet de Estudiante:</label>
            <div class="col-md-9">
              <input id="carnet" name="carnet" class="form-control" type="text"  maxlength="7" readonly="true" value="<?php echo $estudiante["carnet"]; ?>" required="true"  pattern="[a-zA-Z][a-zA-Z]+[0-9][0-9][0-9][0-9][0-9]">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label" style="margin-top: 10px">Nombre:</label>
            <div class="col-md-9">
              <input id="nombreestudiante" name="nombreestudiante" class="form-control" type="text" value="<?php echo $estudiante["nombreestudiante"]; ?>" onkeypress="return soloLetras(event)" onpaste="return false" >
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label" style="margin-top: 10px">Apellido:</label>
            <div class="col-md-9">
              <input id="apellidoestudiante" name="apellidoestudiante" class="form-control" type="text" value="<?php echo $estudiante["apellidoestudiante"]; ?>" onkeypress="return soloLetras(event)" onpaste="return false">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label" style="margin-top: 5px">Sexo:</label>
            <div class="col-md-9">
              <span>
                <select name="sexo" class="form-control" required="true" >
                  <option value="f" <?php  if($estudiante["sexo"]=="f"){echo 'selected';} ?>>Femenino</option>
                  <option value="m" <?php  if($estudiante["sexo"]=="m"){echo 'selected';} ?>>Masculino</option>
                </select>
              </span>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">CUM:</label>
            <div class="col-md-9">
              <input id="cum" name="cum" class="form-control" type="number" min="7" max="10" step="0.01"  value="<?php echo $estudiante["cum"]; ?>" >
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Asignar una clave:</label>
            <div class="col-md-9">
              <input id="pass" name="pass" class="form-control" type="password" value="<?php echo $estudiante["clave"]; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Repetir clave:</label>
            <div class="col-md-9">
              <input id="repass" name="repass" class="form-control" type="password" value="<?php echo $estudiante["clave"]; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"style="margin-top: 10px"  >Tel&eacute;fono Fijo:</label>
            <div class="col-md-9">
              <input id="telfijo" name="telfijo" class="form-control" type="tel" maxlength="8"  value="<?php echo $estudiante["telfijo"]; ?>" onkeypress="return soloNumeros(event)" onpaste="return false">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"style="margin-top: 10px"  >Tel&eacute;fono Celular:</label>
            <div class="col-md-9">
              <input id="telmovil" name="telmovil" class="form-control" type="tel" maxlength="8"  value="<?php echo $estudiante["telmovil"]; ?>"  onkeypress="return soloNumeros(event)" onpaste="return false">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label" style="margin-top: 10px"  >Correo:</label>
            <div class="col-md-9">
              <input id="correo" name="correo" class="form-control" type="email"  value="<?php echo $estudiante["correo"]; ?>" >
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label" style="margin-top: 10px"  >Direcci&oacute;n:</label>
            <div class="col-md-9">
              <input id="direccion" name="direccion" class="form-control" type="text"  value="<?php echo $estudiante["direccion"]; ?>" >
            </div>
          </div>
          <?php  if($estudiante["constancia60"]== ""){ ?>
          <div class="form-group">
            <label class="col-md-3 control-label">Constancia de 60% en .PDF:</label>
            <div class="col-md-9">
              <input type="file" name="fichero" class="form-control" id="fichero" >
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Record de Notas en .PDF:</label>
            <div class="col-md-9">
              <input type="file" name="fichero2" class="form-control" id="fichero2" >
            </div>
          </div>            <?php } else {?>
          <div class="form-group">
            <label class="col-md-9 control-label">Las Constancias ya han sido cargadas.</label>
            <label class="col-md-9 control-label"><?php echo $estudiante["constancia60"]; ?></label>
            <label class="col-md-9 control-label"><?php echo $estudiante["recordnotas"]; ?></label>
          </div>
          <?php }?>
          <br>
          <div class="clearfix right">
            <button class="btn btn-primary mr5" name="actualizar" id="saveForm" type="submit">Actualizar</button>
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