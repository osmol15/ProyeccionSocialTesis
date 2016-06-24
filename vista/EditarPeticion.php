<?php
if(session_start() AND isset($_GET['edit_id'])) {
if($_SESSION['idtipousuario'] == 1 ) {
require_once '../modelo/Peticiones_modelo.php';
require_once '../modelo/Misc_modelo.php';
$peticiones = new Peticiones();
$peticion = $peticiones->getPeticion($_GET['edit_id']);
$misc = new Miscelaneo();
//LISTAR TODOS LOS DEPARTAMENTOS PARA JEFATURA
if($_SESSION['idtipousuario']  == 1) {
$departamentos = $misc->getDepartamentos();
foreach($departamentos as $dept) {
$dep[] = array("id" => $dept['iddepartamento'], "val" => $dept['nombredepartamento']);
}
//ENVIAR SOLO EL NOMBRE DEL DEPARTAMENTO PARA COORDINADOR O AUXILIAR
} else {
$dep[] = array("id" => $_SESSION['iddepartamento'], "val" => $_SESSION['nombredepartamento']);
}
$carreras = $misc->getAllCarreras();
foreach($carreras as $cars) {
$car[$cars['iddepartamento']][] = array("id" => $cars['idcarrera'], "val" => $cars['nombrecarrera']);
}
$jsondept = json_encode($dep);
$jsoncar = json_encode($car);
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
echo "<script language='javascript'>window.location='bienvenida.html'</script>;";
echo "</header>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Modificar Peticion de Proyecto</title>
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
  <script type="text/javascript" src="../scripts/select_dependientes.js"></script>
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
  <script type='text/javascript'>
  <?php
  echo "var departamentos = $jsondept; \n";
  echo "var carreras = $jsoncar; \n";
  ?>
  function loadDepartamentos(){
  
  var select = document.getElementById("requisitodepartamento");
  select.onchange = actualizarCarreras;
  for(var i = 0; i < departamentos.length; i++){
  select.options[i] = new Option(departamentos[i].val,departamentos[i].id);
  }
  }
  function actualizarCarreras(){
  var seleccion = this;
  var iddepartamento = seleccion.value;
  var subcatSelect = document.getElementById("requisitocarrera");
  subcatSelect.options.length = 0; //delete all options if any present
  subcatSelect.disabled=false;
  for(var i = 0; i < carreras[iddepartamento].length; i++){
  subcatSelect.options[i] = new Option(carreras[iddepartamento][i].val,carreras[iddepartamento][i].id);
  }
  }
  </script>
</head>
<body class="layout-top-nav" onload="loadDepartamentos()">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      &nbsp;
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Peticiones</a></li>
        <li><a href="#">Modificar peticiones de proyecto</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box box-solid box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Agregar Proyectos a la base de Datos</h3>
        </div>
        <div class="box-body">
          <form role="form" name="form1" class="form-horizontal" enctype="multipart/form-data"  method="post"  action="../controlador/Peticiones_controlador.php" > <!-- form horizontal acts as a row -->
          <div class="form-group">
            <label class="col-md-3 control-label" for="tipoproyecto">Tipo de Servicio Social: </label>
            <div class="col-md-9">
              <span>
                <?php
                if ($_SESSION['idtipousuario'] == 1) { ?>
                <select name="tipoproyecto" required="true" class="form-control">
                  <option value="1" <?php if ($peticion['tipoproyecto'] == 1){ echo 'selected';}?>>INTERNO</option>
                  <option value="2" <?php if ($peticion['tipoproyecto'] == 2){ echo 'selected';}?>>EXTERNO</option>
                </select>
                <?php
                } else { ?>
                <select name="tipoproyecto" required="true" disabled="true" class="form-control">
                  <option value="3" <?php if ($peticion['tipoproyecto'] == 3){ echo 'selected';}?>>INSTRUCTOR</option>
                </select>
                <?php }
                ?>
              </span>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Nombre del Proyecto:</label>
            <div class="col-md-9">
              <input id="nombreproyecto" name="nombreproyecto" class="form-control" type="text" value="<?php echo $peticion['nombreproyecto'];?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Lugar de Ejecuci&oacute;n:</label>
            <div class="col-md-9">
              <input id="institucion" name="institucion" class="form-control" type="text" value="<?php echo $peticion['institucion'];?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Direccion de la instituci&oacute;n:</label>
            <div class="col-md-9">
              <input id="direccioninstitucion" name="direccioninstitucion" class="form-control" type="text" value="<?php echo $peticion['direccioninstitucion'];?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">N&uacute;mero de Alumnos Responsables:</label>
            <div class="col-md-9">
              <input id="alumnosresponsables" name="alumnosresponsables" class="form-control" type="number" value="<?php echo $peticion['alumnosresponsables'];?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Nombre de Contacto:</label>
            <div class="col-md-9">
              <input id="nombrecontacto" name="nombrecontacto" class="form-control" type="text" value="<?php echo $peticion['nombrecontacto'];?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Tel&eacute;fono Fijo:</label>
            <div class="col-md-9">
              <input id="telfijo" name="telfijo" onkeypress="return validar_texto(event)" class="form-control" maxlength="8" type="text" value="<?php echo $peticion['telfijo'];?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Tel&eacute;fono Movil:</label>
            <div class="col-md-9">
              <input id="telmovil" name="telmovil" onkeypress="return validar_texto(event)" class="form-control" maxlength="8" type="text" value="<?php echo $peticion['telmovil'];?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label" style="margin-top: 5px">Departamento Asignado:</label>
            <div class="col-md-9">
              <span>
                <select id="requisitodepartamento" name="requisitodepartamento"  required="true" class="form-control">
                </select>
              </span>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-md-3 control-label" style="margin-top: 5px">Carrera:</label>
            <div class="col-md-9">
              <span>
                <select disabled="disabled" id="requisitocarrera" name="requisitocarrera"  required="true" class="form-control">
                </select>
              </span>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Fecha:</label>
            <div class="col-md-9" id="datepickerDemo">
              <input type="date" name="fecha" class="form-control" step="1" min="<?php echo date("Y-m-d");?>"  value="<?php echo date("Y-m-d");?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Respaldo de Petici&oacute;n en .PDF:</label>
            <div class="col-md-9">
              <?php
              if ($peticion['peticion'] == "") {
              echo ' <input type="file" name="fichero" class="form-control" id="fichero" >';
              } else {
              echo   ' <label class="col-md-3 control-label" name=""fichero">' .$peticion['peticion']. '</label>';
              }
              ?>
            </div>
          </div>
          <br><br>
          <div class="pull-right">
            <input type="hidden" name="idpeticiones" value="<?php echo $peticion['idpeticiones']; ?>">
            <button class="btn btn-success" name="modificar" id="saveForm" type="submit">Guardar</button>
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