<?php
////Modificar los codigos de departamento y carreras falta@ y hacer los select generados
include '../modelo/conSegura.php';
session_start();
$departamento = $_SESSION["nombredepartamento"];
$iddepart2 = $_SESSION["iddepartamento"];
if(isset($_POST["submit"]))//con isset no necesito dos paginas para la consulta sino q rediirge para llenar en la misma pagina
{
$institucion                       = $_POST["institucion"];
$direccioninstitucion              = $_POST["direccioninstitucion"];
$telfijo                           = $_POST["telfijo"];
$fecha                             = $_POST["fecha"];
$nombreinstructoria                    = $_POST["nombreinstructoria"];
$materia                        = $_POST["materia"];
$alumnosresponsables               = $_POST["alumnosresponsables"];
$catedratico                   = $_POST["catedratico"];
$requisitocarrera                  = $_POST["requisitocarrera"];
$numerodealumnosatender             = $_POST["numerodealumnosatender"];
$requisitodepartamento          =$_POST["requisitodepartamento"];
conectar();
$inser = "insert into peticionesinstructoria(tipoproyecto, institucion, direccioninstitucion, telfijo,"
. "  fecha, nombreinstructoria, materia, alumnosresponsables, numerodealumnosatender, catedratico, requisitocarrera, requisitodepartamento)"
."  values('3','$institucion','$direccioninstitucion','$telfijo', '$fecha','$nombreinstructoria', '$materia', '$alumnosresponsables', '$numerodealumnosatender', '$catedratico',  '$requisitocarrera', '$requisitodepartamento')";
//inserta la info en  los campos de la tabla inscripcion
if(mysql_query($inser))
{
echo "<header>";
    echo "<script language='javascript'>";
    echo "alert(':) Instructoria Agregada Exitosamente.')";
    
    echo "</script>";
    echo"<script language='javascript'>window.location='../modelo/AgregarPeticionInstructoria.php'</script>;";
echo "</header>";
exit();
}
else
{
echo mysql_error();
}
desconectar();
}//archivo upload
else {
?>
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
                    <li><a href="#"><i class="fa fa-dashboard"></i> Peticiones</a></li>
                    <li><a href="#">Registrar Petición</a></li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="box box-solid box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Agregar Proyectos a la Base de Datos</h3>
                    </div>
                    <div class="box-body">
                        <form role="form" name="form1" class="form-horizontal" enctype="multipart/form-data"  method="post"  action="../modelo/AgregarPeticionInstructoria.php" > <!-- form horizontal acts as a row -->
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="tipoproyecto">Tipo de Servicio Social: </label>
                            <div class="col-md-10">
                                <span>
                                    <select name="tipoproyecto" required="true" class="form-control">
                                        <option>INSTRUCTOR</option>
                                    </select>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Nombre del Proyecto:</label>
                            <div class="col-md-10">
                                <input id="nombreinstructoria" name="nombreinstructoria" class="form-control" type="text" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Materia:</label>
                            <div class="col-md-10">
                                <input id="materia" name="materia" class="form-control" type="text" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Lugar de Ejecuci&oacute;n:</label>
                            <div class="col-md-10">
                                <input id="institucion" name="institucion" class="form-control" type="text" value="UES Facultad Multidisciplinaria de Occidente" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Direccion de la instituci&oacute;n:</label>
                            <div class="col-md-10">
                                <input id="direccioninstitucion" name="direccioninstitucion" class="form-control" type="text"  value="Ave Fray Felipe De Jesus Moraga Sur, Santa Ana" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">N&uacute;mero de Alumnos Responsables:</label>
                            <div class="col-md-10">
                                <input id="alumnosresponsables" name="alumnosresponsables" class="form-control" type="number" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">N&uacute;mero de Alumnos a Atender:</label>
                            <div class="col-md-10">
                                <input id="numerodealumnosatender" name="numerodealumnosatender" class="form-control" type="number" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Nombre de Catedratico Encargado:</label>
                            <div class="col-md-10">
                                <input id="catedratico" name="catedratico" class="form-control" type="text" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Tel&eacute;fono Fijo:</label>
                            <div class="col-md-10">
                                <input id="telfijo" name="telfijo" onkeypress="return validar_texto(event)" class="form-control" maxlength="8" type="text" >
                            </div>
                        </div>
                        <?php
                        function generadepartamento()
                        {
                        $iddepart = $_SESSION["iddepartamento"];
                        conectar();
                        $consulta = mysql_query("SELECT * FROM carrera where iddepartamento = '$iddepart'");
                        desconectar();
                        // Voy imprimiendo el primer select compuesto por los departamentos
                        echo "<select name='requisitocarrera' id='requisitocarrera' class='form-control' required='true' onChange='cargaContenido(this.id)'>";
                            echo "<option value=''>Elige</option>";
                            while($registro=mysql_fetch_row($consulta))
                            {
                            echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
                            }
                        echo "</select>";
                        }
                        ?>
                        <div class="form-group">
                            <label class="col-md-2 control-label" style="margin-top: 5px">Carrera Asignada:</label>
                            <div class="col-md-10">
                                <span>
                                    <?php generadepartamento(); ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Fecha:</label>
                            <div class="col-md-10" id="datepickerDemo">
                                <input type="date" name="fecha" class="form-control" step="1" min="<?php echo date("Y-m-d");?>"  value="<?php echo date("Y-m-d");?>">
                            </div>
                        </div>
                        <br>
                        <div class="pull-right">
                            <input type="hidden" name="requisitodepartamento" id="requisitodepartamento" value="<?php echo $iddepart2; ?>">
                            <button class="btn btn-primary mr5" name="submit" id="saveForm" type="submit">Guardar</button>
                            <button class="btn btn-default">Cancelar</button>
                        </div>
                    </form>
                    <?php
                    }
                    ?>
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