<?php
if(session_start()) {
if($_SESSION['idtipousuario'] == 4) {
require_once '../modelo/Proyectos.php';
require_once '../modelo/Usuarios_modelo.php';
$carnetinicial = $_SESSION["carnet"];
$proyecto = new Proyectos();
$datos = $proyecto->getDatosProyecto($carnetinicial);
$nombreproyecto = $_POST["nombreproyecto"];
$institucion = $_POST["institucion"];
$direccion = $_POST["direccioninstitucion"];
$nombrecontacto = $_POST["nombrecontacto"];
$telfijo = $_POST["telfijo"];
$telmovil = $_POST["telmovil"];
$idtipoproyecto = $_POST["tipoproyecto"];
$idpeticiones = $_POST["idpeticiones"];

$users = new Usuarios();
$tutores = $users->getAllTutores();
} else {
echo "<header>";
  echo "<script language='javascript'>";
  echo "alert('No tienes los privilegios suficientes para cargar la pagina solicitada.')";
  echo "</script>";
echo "</header>";
echo "<body>";
  echo "<table ><tr><td>";
    echo "<a title='Atras'  href='javascript: history.go(-1)'><img align=left  WIDTH=50% HEIGHT=40% src='images/back.png' alt='Atras'/></a>";
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
  <script language="javascript" src="../scripts/validar.js"></script>
  <link rel="stylesheet" href="../scripts/datatables/dataTables.bootstrap.css">

  <link rel="stylesheet" href="../scripts/iCheck/all.css">
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
        <li><a href="#">Registrar Proyecto</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box box-solid box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Ficha de Inscripción</h3>
        </div>
        <div class="box-body">
          <div name="form1" class="form-horizontal" > <!-- form horizontal acts as a row -->
          <div class="form-group">
            <input id="idpeticiones" name="idpeticiones" type="hidden" value="<?php echo $idpeticiones;?>">
            <div class="col-md-6" style="width: 100%; text-align: right; padding-top: 2em;">
              <div class="ui-radio ui-radio-blue">
                <label class="ui-radio-inline">
                  <input type="radio" checked name="idtipoinscripcion" value="1" class="minimal">
                  <span>Inicial</span>
                </label>
                <label class="ui-radio-inline">
                  <input type="radio" name="idtipoinscripcion" value="2" class="minimal">
                  <span>Reincorporaci&oacute;n</span>
                </label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Apellidos:</label>
            <div class="col-md-9">
              <input id="apellidoestudiante" name="apellidoestudiante" class="form-control" type="letter" pattern="[A-Za-z ]+" value="<?php echo $datos["apellidoestudiante"]; ?>" required onkeypress="return soloLetras(event)" onpaste="return false">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Nombre Completo:</label>
            <div class="col-md-9">
              <input id="nombreestudiante" name="nombreestudiante" class="form-control" type="letter"  pattern="[A-Za-z ]+" value="<?php echo $datos["nombreestudiante"]; ?>" required onkeypress="return soloLetras(event)" onpaste="return false" >
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label" style="margin-top: 5px">Sexo:</label>
            <div class="col-md-9">
              <span>
                <select name="sexo" class="form-control"   disabled="true">
                  <option value="f"  <?php  if($datos["sexo"]=="f"){echo' selected';} ?>>Femenino</option>
                  <option value="m"  <?php  if($datos["sexo"]=="m"){echo' selected';} ?>>Masculino</option>
                </select>
              </span>
            </div>
            
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Carnet de Estudiante:</label>
            <div class="col-md-9">
              <input id="carnet" name="carnet" class="form-control" type="text"  maxlength="7" readonly="true" value="<?php echo $datos["carnet"]; ?>" title="Se necesita el Carnet del Estudiante. Ingrese un formato de carnet valido ej. RH08017"  required="true"  pattern="[a-zA-Z][a-zA-Z]+[0-9][0-9][0-9][0-9][0-9]">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label" style="margin-top: 5px">Carrera:</label>
            <div class="col-md-9">
              <span>
                <select name="carrera" class="form-control" disabled="true" >
                  <option value="1" <?php  if($datos["carrera"]=="1"){echo' selected';} ?>>I30515 - Ingenier&iacute;a de Sistemas Inform&aacute;ticos</option>
                  <option value="2" <?php  if($datos["carrera"]=="2"){echo' selected';} ?>>Arquitectura</option>
                  <option value="3"  <?php  if($datos["carrera"]=="3"){echo' selected';} ?>>Ingenier&iacute;a Industrial</option>
                  <option value="4"  <?php  if($datos["carrera"]=="4"){echo' selected';} ?>>Ingenier&iacute;a Civil</option>
                  <option value="5"  <?php  if($datos["carrera"]=="5"){echo' selected';} ?>>Ingenier&iacute;a Mec&aacute;nica</option>
                  <option value="6"  <?php  if($datos["carrera"]=="6"){echo' selected';} ?>>Ingenier&iacute;a Qu&iacute;mica</option>
                </select>
              </span>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Telefonos:</label>
            <div class="col-md-9">
              <input id="nombreestudiante" name="nombreestudiante" class="form-control" type="letter"  pattern="[A-Za-z ]+" value="<?php echo $datos["nombreestudiante"]; ?>" required onkeypress="return soloLetras(event)" onpaste="return false" >
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Fijo:</label>
            <div class="col-md-9">
              <input id="telfijo2" name="telfijo2" class="form-control" type="tel" maxlength="8" value="<?php echo $datos["telfijo"]; ?>" onkeypress="return soloNumeros(event)" onpaste="return false" >
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Celular:</label>
            <div class="col-md-9">
              <input id="telmovil2" name="telmovil2" class="form-control" type="tel" maxlength="8" value="<?php echo $datos["telmovil"]; ?>" onkeypress="return soloNumeros(event)" onpaste="return false" >
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label" style="margin-top: 10px"  >Correo:</label>
            <div class="col-md-9">
              <input id="correo" name="correo" class="form-control" type="email" value="<?php echo $datos["correo"]; ?>">
            </div>
          </div>          
          <div class="form-group">
            <label class="col-md-3 control-label">CUM:</label>
            <div class="col-md-9">
              <input id="cum" name="cum" class="form-control" type="number" min="7" max="10" step="0.01" value="<?php echo $datos["cum"]; ?>">
            </div>
          </div>          
          <div class="form-group">
            <label class="col-md-3 control-label" for="tipoproyecto">Tipo de Servicio Social: </label>
            <div class="col-md-9">
              <span>
                <select id="tipoproyecto" name="tipoproyecto" required="true" class="form-control"  >
                  <option value="1" <?php  if($idtipoproyecto=="1"){echo' selected';} ?>>INTERNO</option>
                  <option value="2" <?php  if($idtipoproyecto=="2"){echo' selected';} ?>>EXTERNO</option>
                </select>
              </span>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-md-3 control-label">N&uacute;mero de horas que solicita:</label>
            <div class="col-md-9">
              <input id="numerodehoras" name="numerodehoras" class="form-control" type="number" min="1" max="500">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Nombre del Proyecto:</label>
            <div class="col-md-9">
              <input id="nombreproyecto" name="nombreproyecto" class="form-control" type="text" value="<?php echo $nombreproyecto; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Instituci&oacute;n que demanda el servicio:</label>
            <div class="col-md-9">
              <input id="institucion" name="institucion" class="form-control" type="text" value="<?php echo $institucion; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Direcci&oacute;n:</label>
            <div class="col-md-9">
              <input id="direccioninstitucion" name="direccioninstitucion" class="form-control" type="text" value="<?php echo $direccion; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Telefonos de contacto de la instituci&oacute;n</label>
            <div class="col-md-9">
              <input id="institucion" name="institucion" class="form-control" type="text" value="<?php echo $institucion; ?>">
            </div>
          </div>
          <div class="form-group">            
            <label class="col-md-3 control-label">Fijo:</label>
            <div class="col-md-9">
              <input id="fijoIns" name="telfijo" class="form-control" type="tel" maxlength="8" value="<?php echo $telfijo; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Celular:</label>
            <div class="col-md-9">
              <input id="celularIns" name="telmovil" class="form-control" type="tel" maxlength="8" value="<?php echo $telmovil; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Nombre contacto institucional:</label>
            <div class="col-md-9">
              <input id="nombrecontacto" name="nombrecontacto" class="form-control" type="text" value="<?php echo $nombrecontacto; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Fecha Inicio:</label>
            <div class="col-md-9">
              <input id="fechaini" name="fechaini" class="form-control" type="date">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Fecha Fin:</label>
            <div class="col-md-9">
              <input id="fechafin" name="fechafin" class="form-control" type="date">              
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-12 control-label">Horario en que se realizar&aacute; el servicio social:</label>
            <table id="horarios" name="horarios" cellspacing="0" width="90%" class="table table-bordered text-center">
              <thead>
                <tr>
                  <th style="text-align:center"><b>Horario</b></th>
                  <th style="text-align:center"><b>Lunes</b></th>
                  <th style="text-align:center"><b>Martes</b></th>
                  <th style="text-align:center"><b>Miercoles</b></th>
                  <th style="text-align:center"><b>Jueves</b></th>
                  <th style="text-align:center""><b>Viernes</b></th>
                  <th style="text-align:center"><b>Sabado</b></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td align="center" id="hora"><b>Ma&ntilde;ana</b></td>
                  <td contenteditable="true" ></td>
                  <td contenteditable="true" ></td>
                  <td contenteditable="true" ></td>
                  <td contenteditable="true" ></td>
                  <td contenteditable="true" ></td>
                  <td contenteditable="true" ></td>
                </tr>
                <tr>
                  <td align="center" id="hora"><b>Tarde</b></td>
                  <td contenteditable="true" ></td>
                  <td contenteditable="true" ></td>
                  <td contenteditable="true" ></td>
                  <td contenteditable="true" ></td>
                  <td contenteditable="true" ></td>
                  <td contenteditable="true" ></td>
                </tr>
              </tbody>
            </table>
          </div>
          
          <div class="form-group">
            <label class="col-md-3 control-label" for="tutor">Tutor Asignado al proyecto: </label>
            <div class="col-md-9">
              <span>
                <select id="tutor" name="tutor" required="true" class="form-control">
                  <option value="0">Ninguno</option>
                  <?php
                  foreach($tutores as $tutor) {
                  echo '<option value="' .$tutor['idusuario']. '">' .$tutor['nombre']. '' .$tutor['apellido']. '</option>';
                  }
                  ?>
                </select>
              </span>
            </div>
          </div>          
          <div class="form-group">
            <label class="col-md-3 control-label">Fecha:</label>
            <div class="col-md-9" id="datepickerDemo">
              <input type="date" id="fecha" name="fecha" class="form-control" enabled="false"  value="<?php echo date("Y-m-d");?>">
            </div>
          </div>
          <div class="pull-right">
            <button class="btn btn-primary mr5" name="submit" id="saveForm" onclick="$('#horarios').enviarDatos({type:'excel',escape:'false',consoleLog:'true',htmlContent:'true'});">Guardar</button>
            <button class="btn btn-default">Cancelar</button>
          </div>
        </div>
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
<script src="../scripts/iCheck/icheck.js"></script>

<script>
  $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
</script>
</html>